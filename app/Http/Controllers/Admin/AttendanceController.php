<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Holiday;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display attendance records.
     */
    public function index(Request $request)
    {
        $query = Attendance::with('user');

        // Search by employee name or employee ID
        if ($request->filled('search')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere(
                        'employee_id',
                        'like',
                        '%' . $request->search . '%'
                    );
            });
        }

        /*
        If no date is selected,
        automatically show today's attendance only.
        */

        if ($request->filled('date')) {

            $query->whereDate('date', $request->date);

        } else {

            $query->whereDate('date', today());
        }

        $attendances = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view(
            'admin.attendance_list',
            compact('attendances')
        );
    }


    /**
     * Record employee attendance.
     *
     * Sequence:
     *
     * 1. Morning Time In
     * 2. Morning Time Out
     * 3. Afternoon Time In
     * 4. Afternoon Time Out
     */
    public function record(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id'
        ]);

        /*
        Find or create today's attendance record.
        */

        $attendance = Attendance::firstOrCreate(
            [
                'user_id' => $request->employee_id,
                'date' => today()
            ],
            [
                'hours_worked' => 0,
                'late_minutes' => 0,
                'undertime_minutes' => 0,
                'overtime_minutes' => 0,
                'status' => 'Present',
            ]
        );

        $user = $attendance->user;

        /*
        ============================================================
        HOLIDAY CHECK
        ============================================================
        */

        $holiday = Holiday::isHoliday(
            today(),
            $user->department
        );

        if ($holiday && !$attendance->holiday_id) {
            $attendance->holiday_id = $holiday->id;
        }

        /*
        Current time.
        */

        $now = now();

        $type = '';


        /*
        ============================================================
        1. MORNING TIME IN / AFTERNOON TIME IN
        ============================================================
        */

        if (
            !$attendance->morning_time_in &&
            !$attendance->afternoon_time_in
        ) {

            /*
            If the first scan is at 12:00 PM or later,
            treat it as Afternoon Time In.
            */

            if ($now->hour >= 12) {

                $attendance->afternoon_time_in = $now;

                /*
                Afternoon late:
                After 1:00 PM = Late.
                */

                $afternoonStart = $now->copy()
                    ->setTime(13, 0, 0);

                if ($now->greaterThan($afternoonStart)) {

                    $attendance->late_minutes =
                        $now->diffInMinutes($afternoonStart);

                } else {

                    $attendance->late_minutes = 0;
                }

                $attendance->status = 'Present';

                $type = 'Afternoon Time In';

            } else {

                /*
                Morning Time In.
                */

                $attendance->morning_time_in = $now;

                /*
                Morning late:
                After 8:00 AM = Late.
                */

                $morningStart = $now->copy()
                    ->setTime(8, 0, 0);

                if ($now->greaterThan($morningStart)) {

                    $attendance->late_minutes =
                        $now->diffInMinutes($morningStart);

                } else {

                    $attendance->late_minutes = 0;
                }

                $attendance->status = 'Present';

                $type = 'Morning Time In';
            }
        }


        /*
        ============================================================
        2. MORNING TIME OUT
        ============================================================
        */

        elseif (!$attendance->morning_time_out) {

            $attendance->morning_time_out = $now;

            /*
            Calculate morning worked minutes.
            */

            if ($attendance->morning_time_in) {

                $morningMinutes =
                    $attendance->morning_time_in
                        ->diffInMinutes(
                            $attendance->morning_time_out
                        );

                /*
                Morning undertime:
                Leaving before 12:00 PM.
                */

                $morningEnd = $now->copy()
                    ->setTime(12, 0, 0);

                if ($now->lessThan($morningEnd)) {

                    $attendance->undertime_minutes =
                        $now->diffInMinutes($morningEnd);

                } else {

                    $attendance->undertime_minutes = 0;
                }

                /*
                Current hours worked.
                */

                $attendance->hours_worked =
                    round($morningMinutes / 60, 2);
            }

            /*
            Update status.
            */

            $this->updateStatus($attendance);

            $type = 'Morning Time Out';
        }


        /*
        ============================================================
        3. AFTERNOON TIME IN
        ============================================================
        */

        elseif (!$attendance->afternoon_time_in) {

            $attendance->afternoon_time_in = $now;

            /*
            Afternoon late:
            After 1:00 PM = Late.
            */

            $afternoonStart = $now->copy()
                ->setTime(13, 0, 0);

            $afternoonLateMinutes = 0;

            if ($now->greaterThan($afternoonStart)) {

                $afternoonLateMinutes =
                    $now->diffInMinutes($afternoonStart);
            }

            /*
            Add afternoon late to existing
            morning late minutes.
            */

            $attendance->late_minutes =
                ($attendance->late_minutes ?? 0)
                + $afternoonLateMinutes;

            /*
            Update status.
            */

            $this->updateStatus($attendance);

            $type = 'Afternoon Time In';
        }


        /*
        ============================================================
        4. AFTERNOON TIME OUT
        ============================================================
        */

        elseif (!$attendance->afternoon_time_out) {

            $attendance->afternoon_time_out = $now;

            $totalMinutes = 0;


            /*
            --------------------------------------------------------
            MORNING HOURS
            --------------------------------------------------------
            */

            if (
                $attendance->morning_time_in &&
                $attendance->morning_time_out
            ) {

                $totalMinutes +=
                    $attendance->morning_time_in
                        ->diffInMinutes(
                            $attendance->morning_time_out
                        );
            }


            /*
            --------------------------------------------------------
            AFTERNOON HOURS
            --------------------------------------------------------
            */

            if (
                $attendance->afternoon_time_in &&
                $attendance->afternoon_time_out
            ) {

                $totalMinutes +=
                    $attendance->afternoon_time_in
                        ->diffInMinutes(
                            $attendance->afternoon_time_out
                        );
            }


            /*
            ========================================================
            TOTAL HOURS WORKED
            ========================================================
            */

            $attendance->hours_worked =
                round($totalMinutes / 60, 2);


            /*
            ========================================================
            AFTERNOON UNDERTIME
            ========================================================

            Normal afternoon schedule:
            1:00 PM - 5:00 PM

            Leaving before 5:00 PM = Undertime.
            */

            $afternoonEnd = $now->copy()
                ->setTime(17, 0, 0);

            $afternoonUndertimeMinutes = 0;

            if ($now->lessThan($afternoonEnd)) {

                $afternoonUndertimeMinutes =
                    $now->diffInMinutes($afternoonEnd);
            }


            /*
            Add afternoon undertime to morning undertime.
            */

            $attendance->undertime_minutes =
                ($attendance->undertime_minutes ?? 0)
                + $afternoonUndertimeMinutes;


            /*
            ========================================================
            OVERTIME
            ========================================================

            Normal duty hours:

            8:00 AM - 12:00 PM = 4 hours
            1:00 PM - 5:00 PM  = 4 hours

            Total = 8 hours.

            Any actual worked time above 8 hours
            becomes overtime.
            */

            $normalDutyMinutes = 8 * 60;

            if ($totalMinutes > $normalDutyMinutes) {

                $attendance->overtime_minutes =
                    $totalMinutes - $normalDutyMinutes;

            } else {

                $attendance->overtime_minutes = 0;
            }


            /*
            ========================================================
            UPDATE STATUS
            ========================================================
            */

            $this->updateStatus($attendance);

            $type = 'Afternoon Time Out';
        }


        /*
        ============================================================
        ATTENDANCE ALREADY COMPLETED
        ============================================================
        */

        else {

            return response()->json([
                'success' => false,
                'message' => 'Attendance already completed today.'
            ]);
        }


        /*
        ============================================================
        SAVE
        ============================================================
        */

        $attendance->save();


        /*
        ============================================================
        RESPONSE
        ============================================================
        */

        return response()->json([

            'success' => true,

            'message' =>
                $type . ' recorded successfully.',

            'type' => $type,

            'time' =>
                $now->format('h:i:s A'),

            'employee' =>
                $attendance->user->name,

            'status' =>
                $attendance->status,

            'hours_worked' =>
                number_format(
                    $attendance->hours_worked ?? 0,
                    2
                ),

            'late_minutes' =>
                $attendance->late_minutes ?? 0,

            'undertime_minutes' =>
                $attendance->undertime_minutes ?? 0,

            'overtime_minutes' =>
                $attendance->overtime_minutes ?? 0,

            'late' =>
                $this->formatMinutes(
                    $attendance->late_minutes ?? 0
                ),

            'undertime' =>
                $this->formatMinutes(
                    $attendance->undertime_minutes ?? 0
                ),

            'overtime' =>
                $this->formatMinutes(
                    $attendance->overtime_minutes ?? 0
                ),
        ]);
    }


    /**
     * Determine attendance status.
     *
     * Examples:
     *
     * Present
     * Late
     * Undertime
     * Overtime
     * Late & Undertime
     * Late & Overtime
     * Undertime & Overtime
     * Late, Undertime & Overtime
     * Worked Holiday
     */
    private function updateStatus(Attendance $attendance)
    {
        $statuses = [];

        /*
        Late
        */

        if (($attendance->late_minutes ?? 0) > 0) {
            $statuses[] = 'Late';
        }

        /*
        Undertime
        */

        if (($attendance->undertime_minutes ?? 0) > 0) {
            $statuses[] = 'Undertime';
        }

        /*
        Overtime
        */

        if (($attendance->overtime_minutes ?? 0) > 0) {
            $statuses[] = 'Overtime';
        }

        /*
        No attendance issue.
        */

        if (empty($statuses)) {

            if ($attendance->holiday_id) {

                $attendance->status = 'Worked Holiday';

            } else {

                $attendance->status = 'Present';
            }

            return;
        }

        /*
        Combine statuses.

        Example:
        Late & Undertime
        Late & Overtime
        Undertime & Overtime
        Late, Undertime & Overtime
        */

        $attendance->status = implode(' & ', $statuses);
    }


    /**
     * Convert minutes into readable format.
     *
     * Examples:
     *
     * 30  = 30m
     * 60  = 1h
     * 90  = 1h 30m
     * 120 = 2h
     */
    private function formatMinutes($minutes)
    {
        $minutes = (int) $minutes;

        if ($minutes <= 0) {
            return '0m';
        }

        $hours = intdiv($minutes, 60);

        $remainingMinutes = $minutes % 60;

        if ($hours > 0 && $remainingMinutes > 0) {

            return $hours . 'h ' .
                $remainingMinutes . 'm';

        } elseif ($hours > 0) {

            return $hours . 'h';

        } else {

            return $remainingMinutes . 'm';
        }
    }
}
