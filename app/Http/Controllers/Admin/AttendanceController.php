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
     *
     * If no date is selected, today's attendance is displayed.
     */
    public function index(Request $request)
    {
        $query = Attendance::with('user', 'holiday');

        /*
        |--------------------------------------------------------------------------
        | Search employee
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('user', function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere(
                        'employee_id',
                        'like',
                        '%' . $search . '%'
                    );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Date filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date')) {

            $query->whereDate('date', $request->date);

        } else {

            $query->whereDate('date', today());
        }

        /*
        |--------------------------------------------------------------------------
        | Attendance list
        |--------------------------------------------------------------------------
        */

        $attendances = $query
            ->latest('date')
            ->latest('time_in')
            ->paginate(20)
            ->withQueryString();

        return view(
            'admin.attendance_list',
            compact('attendances')
        );
    }


    /**
     * Record employee attendance from the kiosk.
     *
     * RULE:
     *
     * 1st scan = Time In
     * 2nd scan = Time Out
     * 3rd scan = rejected
     *
     * Schedule:
     *
     * Monday-Friday:
     * 8:00 AM - 5:30 PM
     *
     * Saturday:
     * 8:00 AM - 12:00 PM
     *
     * Sunday:
     * No regular attendance schedule.
     */
    public function record(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Current date and time
        |--------------------------------------------------------------------------
        */

        $now = now();

        $today = $now->toDateString();

        /*
        |--------------------------------------------------------------------------
        | Find employee
        |--------------------------------------------------------------------------
        */

        $user = \App\Models\User::findOrFail(
            $request->employee_id
        );

        /*
        |--------------------------------------------------------------------------
        | Sunday protection
        |--------------------------------------------------------------------------
        |
        | Sunday is not a regular working day.
        |
        */

        if ($now->isSunday()) {

            return response()->json([
                'success' => false,
                'message' => 'Attendance is not scheduled on Sundays.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Find or create today's attendance
        |--------------------------------------------------------------------------
        */

        $attendance = Attendance::firstOrCreate(
            [
                'user_id' => $user->id,
                'date' => $today,
            ],
            [
                'hours_worked' => 0,
                'late_minutes' => 0,
                'undertime_minutes' => 0,
                'overtime_minutes' => 0,
                'status' => 'Present',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Holiday detection
        |--------------------------------------------------------------------------
        |
        | Holiday::isHoliday() should determine whether the date is a
        | holiday applicable to this employee's department.
        |
        */

        $holiday = Holiday::isHoliday(
            $today,
            $user->department
        );

        if ($holiday && !$attendance->holiday_id) {

            $attendance->holiday_id = $holiday->id;
        }

        /*
        |--------------------------------------------------------------------------
        | FIRST SCAN = TIME IN
        |--------------------------------------------------------------------------
        */

        if (!$attendance->time_in) {

            $attendance->time_in = $now;

            /*
            |--------------------------------------------------------------------------
            | Calculate late
            |--------------------------------------------------------------------------
            |
            | Official start:
            | 8:00 AM
            |
            | Grace period:
            | 15 minutes
            |
            | 8:00 - 8:15 = not late
            |
            | Once employee goes beyond the 15-minute allowance,
            | the ENTIRE period from 8:00 AM is counted as late.
            |
            | Example:
            |
            | 8:10 AM = 0 late minutes
            | 8:15 AM = 0 late minutes
            | 8:16 AM = 16 late minutes
            | 8:30 AM = 30 late minutes
            | 9:00 AM = 60 late minutes
            |
            */

            $startTime = $this->getStartTime($now);

            $graceTime = $startTime->copy()
                ->addMinutes(15);

            if ($now->greaterThan($graceTime)) {

                $attendance->late_minutes =
                    $startTime->diffInMinutes($now);

            } else {

                $attendance->late_minutes = 0;
            }

            /*
            |--------------------------------------------------------------------------
            | Update initial status
            |--------------------------------------------------------------------------
            */

            $this->updateStatus($attendance);

            $attendance->save();

            return response()->json([

                'success' => true,

                'message' => 'Time In recorded successfully.',

                'type' => 'Time In',

                'time' => $now->format('h:i:s A'),

                'employee' => $user->name,

                'status' => $attendance->status,

                'hours_worked' => number_format(
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

        /*
        |--------------------------------------------------------------------------
        | SECOND SCAN = TIME OUT
        |--------------------------------------------------------------------------
        */

        if (!$attendance->time_out) {

            $attendance->time_out = $now;

            /*
            |--------------------------------------------------------------------------
            | Calculate total worked minutes
            |--------------------------------------------------------------------------
            */

            $workedMinutes =
                $attendance->time_in
                    ->diffInMinutes(
                        $attendance->time_out
                    );

            /*
            |--------------------------------------------------------------------------
            | Store total worked hours
            |--------------------------------------------------------------------------
            */

            $attendance->hours_worked =
                round($workedMinutes / 60, 2);

            /*
            |--------------------------------------------------------------------------
            | Calculate undertime
            |--------------------------------------------------------------------------
            |
            | Weekdays:
            | Expected end = 5:30 PM
            |
            | Saturday:
            | Expected end = 12:00 PM
            |
            */

            $endTime = $this->getEndTime($now);

            if ($now->lessThan($endTime)) {

                $attendance->undertime_minutes =
                    $now->diffInMinutes($endTime);

            } else {

                $attendance->undertime_minutes = 0;
            }

            /*
            |--------------------------------------------------------------------------
            | Calculate overtime
            |--------------------------------------------------------------------------
            |
            | Weekdays:
            | after 5:30 PM
            |
            | Saturday:
            | after 12:00 PM
            |
            */

            if ($now->greaterThan($endTime)) {

                $attendance->overtime_minutes =
                    $endTime->diffInMinutes($now);

            } else {

                $attendance->overtime_minutes = 0;
            }

            /*
            |--------------------------------------------------------------------------
            | Holiday status
            |--------------------------------------------------------------------------
            */

            $this->updateStatus($attendance);

            $attendance->save();

            return response()->json([

                'success' => true,

                'message' => 'Time Out recorded successfully.',

                'type' => 'Time Out',

                'time' => $now->format('h:i:s A'),

                'employee' => $user->name,

                'status' => $attendance->status,

                'hours_worked' => number_format(
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

        /*
        |--------------------------------------------------------------------------
        | THIRD SCAN
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' => false,

            'message' =>
                'Attendance already completed for today.',

            'type' => 'Completed',

            'time' =>
                $now->format('h:i:s A'),

            'employee' =>
                $user->name,

            'status' =>
                $attendance->status,
        ], 422);
    }


    /**
     * Get the employee's official starting time.
     *
     * Monday-Friday = 8:00 AM
     * Saturday = 8:00 AM
     */
    private function getStartTime(Carbon $date)
    {
        return $date->copy()
            ->setTime(8, 0, 0);
    }


    /**
     * Get the employee's official ending time.
     *
     * Monday-Friday = 5:30 PM
     * Saturday = 12:00 PM
     */
    private function getEndTime(Carbon $date)
    {
        if ($date->isSaturday()) {

            return $date->copy()
                ->setTime(12, 0, 0);
        }

        return $date->copy()
            ->setTime(17, 30, 0);
    }


    /**
     * Determine attendance status.
     *
     * Possible statuses:
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
     * Worked Holiday & Late
     * Worked Holiday & Undertime
     * Worked Holiday & Overtime
     * Worked Holiday & Late & Undertime
     * Worked Holiday & Late & Overtime
     * Worked Holiday & Undertime & Overtime
     * Worked Holiday & Late & Undertime & Overtime
     */
    private function updateStatus(Attendance $attendance)
    {
        $statuses = [];

        /*
        |--------------------------------------------------------------------------
        | Holiday
        |--------------------------------------------------------------------------
        */

        if ($attendance->holiday_id) {

            $statuses[] = 'Worked Holiday';
        }

        /*
        |--------------------------------------------------------------------------
        | Late
        |--------------------------------------------------------------------------
        */

        if (($attendance->late_minutes ?? 0) > 0) {

            $statuses[] = 'Late';
        }

        /*
        |--------------------------------------------------------------------------
        | Undertime
        |--------------------------------------------------------------------------
        */

        if (($attendance->undertime_minutes ?? 0) > 0) {

            $statuses[] = 'Undertime';
        }

        /*
        |--------------------------------------------------------------------------
        | Overtime
        |--------------------------------------------------------------------------
        */

        if (($attendance->overtime_minutes ?? 0) > 0) {

            $statuses[] = 'Overtime';
        }

        /*
        |--------------------------------------------------------------------------
        | No issue
        |--------------------------------------------------------------------------
        */

        if (empty($statuses)) {

            $attendance->status = 'Present';

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Combine statuses
        |--------------------------------------------------------------------------
        */

        $attendance->status =
            implode(' & ', $statuses);
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

        $hours = intdiv(
            $minutes,
            60
        );

        $remainingMinutes =
            $minutes % 60;

        if (
            $hours > 0 &&
            $remainingMinutes > 0
        ) {

            return $hours . 'h ' .
                $remainingMinutes . 'm';

        } elseif ($hours > 0) {

            return $hours . 'h';

        }

        return $remainingMinutes . 'm';
    }
}
