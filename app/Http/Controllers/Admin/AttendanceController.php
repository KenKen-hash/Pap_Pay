<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\LeaveRequest;
use App\Models\OfficialBusiness;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display attendance records.
     *
     * The page displays only:
     *
     * 1. Employees who scanned through the kiosk
     * 2. Employees with approved Leave
     * 3. Employees with approved Official Business
     * 4. Employees marked Absent by the end-of-day scheduler
     *
     * Employees who have not scanned yet are NOT automatically
     * displayed as Absent during the day.
     *
     * NO PAGINATION:
     * All applicable records for the selected date are displayed
     * on one page.
     */
    public function index(Request $request)
    {
        $date = $request->filled('date')
            ? Carbon::parse($request->date)->toDateString()
            : today()->toDateString();

        /*
        |--------------------------------------------------------------------------
        | Actual attendance records
        |--------------------------------------------------------------------------
        |
        | These are records actually created by:
        |
        | - The kiosk
        | - The end-of-day Absent scheduler
        |
        */

        $attendanceQuery = Attendance::with('user', 'holiday')
            ->whereDate('date', $date);

        /*
        |--------------------------------------------------------------------------
        | Search actual attendance
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $attendanceQuery->whereHas('user', function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere(
                        'employee_id',
                        'like',
                        '%' . $search . '%'
                    );

            });
        }

        $attendanceRecords = $attendanceQuery
            ->get()
            ->keyBy('user_id');

        /*
        |--------------------------------------------------------------------------
        | Approved Leave
        |--------------------------------------------------------------------------
        |
        | Leave is displayed even when there is no attendance record.
        |
        */

        $leaveQuery = LeaveRequest::with('user')
            ->where('status', 'Approved')
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date);

        /*
        |--------------------------------------------------------------------------
        | Search approved Leave
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $leaveQuery->whereHas('user', function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere(
                        'employee_id',
                        'like',
                        '%' . $search . '%'
                    );

            });
        }

        $approvedLeaves = $leaveQuery->get();

        /*
        |--------------------------------------------------------------------------
        | Approved Official Business
        |--------------------------------------------------------------------------
        |
        | Official Business is displayed even when there is no
        | attendance record.
        |
        */

        $obQuery = OfficialBusiness::with('user')
            ->where('status', 'Approved')
            ->whereDate('ob_date', '<=', $date)
            ->whereDate('ob_date_to', '>=', $date);

        /*
        |--------------------------------------------------------------------------
        | Search approved Official Business
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $obQuery->whereHas('user', function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere(
                        'employee_id',
                        'like',
                        '%' . $search . '%'
                    );

            });
        }

        $approvedOfficialBusinesses = $obQuery->get();

        /*
        |--------------------------------------------------------------------------
        | Build display collection
        |--------------------------------------------------------------------------
        */

        $records = collect();

        /*
        |--------------------------------------------------------------------------
        | Add actual attendance records
        |--------------------------------------------------------------------------
        */

        foreach ($attendanceRecords as $attendance) {

            $records->push($attendance);
        }

        /*
        |--------------------------------------------------------------------------
        | Add approved Leave records
        |--------------------------------------------------------------------------
        |
        | A temporary Attendance model is created only for display.
        |
        | IMPORTANT:
        |
        | This temporary model is NOT saved to the database.
        |
        */

        foreach ($approvedLeaves as $leave) {

            /*
            |--------------------------------------------------------------------------
            | Do not duplicate an employee who already has an attendance record.
            |--------------------------------------------------------------------------
            */

            if ($attendanceRecords->has($leave->user_id)) {
                continue;
            }

            $attendance = new Attendance([
                'user_id' => $leave->user_id,
                'date' => $date,
                'time_in' => null,
                'time_out' => null,
                'hours_worked' => 0,
                'late_minutes' => 0,
                'undertime_minutes' => 0,
                'overtime_minutes' => 0,
                'status' => 'Leave',
                'remarks' => $leave->leave_type
                    ? 'Leave - ' . $leave->leave_type
                    : 'Leave',
            ]);

            $attendance->setRelation(
                'user',
                $leave->user
            );

            /*
            |--------------------------------------------------------------------------
            | Attach holiday relation if applicable.
            |--------------------------------------------------------------------------
            */

            $holiday = Holiday::isHoliday(
                $date,
                $leave->user->department
            );

            if ($holiday) {
                $attendance->setRelation(
                    'holiday',
                    $holiday
                );
            }

            $records->push($attendance);
        }

        /*
        |--------------------------------------------------------------------------
        | Add approved Official Business records
        |--------------------------------------------------------------------------
        */

        foreach ($approvedOfficialBusinesses as $officialBusiness) {

            /*
            |--------------------------------------------------------------------------
            | Do not duplicate an employee who already has an attendance record.
            |--------------------------------------------------------------------------
            */

            if ($attendanceRecords->has($officialBusiness->user_id)) {
                continue;
            }

            $attendance = new Attendance([
                'user_id' => $officialBusiness->user_id,
                'date' => $date,
                'time_in' => null,
                'time_out' => null,
                'hours_worked' => 0,
                'late_minutes' => 0,
                'undertime_minutes' => 0,
                'overtime_minutes' => 0,
                'status' => 'Official Business',
                'remarks' => 'Official Business'
                    . ($officialBusiness->purpose
                        ? ' - ' . $officialBusiness->purpose
                        : ''),
            ]);

            $attendance->setRelation(
                'user',
                $officialBusiness->user
            );

            /*
            |--------------------------------------------------------------------------
            | Attach holiday relation if applicable.
            |--------------------------------------------------------------------------
            */

            $holiday = Holiday::isHoliday(
                $date,
                $officialBusiness->user->department
            );

            if ($holiday) {
                $attendance->setRelation(
                    'holiday',
                    $holiday
                );
            }

            $records->push($attendance);
        }

        /*
        |--------------------------------------------------------------------------
        | Sort records
        |--------------------------------------------------------------------------
        |
        | Employees with actual Time In records appear first.
        |
        | Employees without Time In, such as:
        |
        | - Leave
        | - Official Business
        | - Absent
        |
        | appear afterward alphabetically.
        |
        */

        $records = $records
            ->sort(function ($a, $b) {

                /*
                |--------------------------------------------------------------------------
                | Time In records first
                |--------------------------------------------------------------------------
                */

                if ($a->time_in && !$b->time_in) {
                    return -1;
                }

                if (!$a->time_in && $b->time_in) {
                    return 1;
                }

                /*
                |--------------------------------------------------------------------------
                | If both have Time In, latest Time In first.
                |--------------------------------------------------------------------------
                */

                if ($a->time_in && $b->time_in) {

                    return $b->time_in->timestamp
                        <=> $a->time_in->timestamp;
                }

                /*
                |--------------------------------------------------------------------------
                | Otherwise alphabetical employee name.
                |--------------------------------------------------------------------------
                */

                return strcasecmp(
                    $a->user->name ?? '',
                    $b->user->name ?? ''
                );
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | NO PAGINATION
        |--------------------------------------------------------------------------
        |
        | Return every applicable record for the selected date.
        |
        */

        $attendances = $records;

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
     * 3rd scan = Rejected
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

        $user = User::findOrFail(
            $request->employee_id
        );

        /*
        |--------------------------------------------------------------------------
        | Sunday protection
        |--------------------------------------------------------------------------
        */

        if ($now->isSunday()) {

            return response()->json([
                'success' => false,
                'message' => 'Attendance is not scheduled on Sundays.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Check approved Leave BEFORE creating attendance
        |--------------------------------------------------------------------------
        |
        | Employees who are on approved Leave must not be able
        | to create a kiosk attendance record.
        |
        */

        $approvedLeave = LeaveRequest::where(
            'user_id',
            $user->id
        )
            ->where('status', 'Approved')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->exists();

        if ($approvedLeave) {

            return response()->json([
                'success' => false,
                'message' => 'Attendance cannot be recorded because the employee is on approved leave.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Check approved Official Business BEFORE creating attendance
        |--------------------------------------------------------------------------
        */

        $approvedOfficialBusiness = OfficialBusiness::where(
            'user_id',
            $user->id
        )
            ->where('status', 'Approved')
            ->whereDate('ob_date', '<=', $today)
            ->whereDate('ob_date_to', '>=', $today)
            ->exists();

        if ($approvedOfficialBusiness) {

            return response()->json([
                'success' => false,
                'message' => 'Attendance cannot be recorded because the employee has approved Official Business today.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Find or create today's attendance
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | An attendance record is only created when the employee
        | actually scans.
        |
        | No attendance record is automatically created merely
        | because the employee exists in the system.
        |
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
                'remarks' => 'Kiosk attendance',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Holiday detection
        |--------------------------------------------------------------------------
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
            | Calculate Late
            |--------------------------------------------------------------------------
            |
            | 8:00 - 8:15 = 0 late
            | 8:16 = 16 late minutes
            | 8:30 = 30 late minutes
            |
            */

            $startTime = $this->getStartTime($now);

            $graceTime = $startTime
                ->copy()
                ->addMinutes(15);

            if ($now->greaterThan($graceTime)) {

                $attendance->late_minutes =
                    $startTime->diffInMinutes($now);

            } else {

                $attendance->late_minutes = 0;
            }

            /*
            |--------------------------------------------------------------------------
            | Update status
            |--------------------------------------------------------------------------
            */

            $this->updateStatus($attendance);

            $attendance->save();

            return response()->json([

                'success' => true,

                'message' =>
                    'Time In recorded successfully.',

                'type' =>
                    'Time In',

                'time' =>
                    $now->format('h:i:s A'),

                'employee' =>
                    $user->name,

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
            */

            if ($now->greaterThan($endTime)) {

                $attendance->overtime_minutes =
                    $endTime->diffInMinutes($now);

            } else {

                $attendance->overtime_minutes = 0;
            }

            /*
            |--------------------------------------------------------------------------
            | Update status
            |--------------------------------------------------------------------------
            */

            $this->updateStatus($attendance);

            $attendance->save();

            return response()->json([

                'success' => true,

                'message' =>
                    'Time Out recorded successfully.',

                'type' =>
                    'Time Out',

                'time' =>
                    $now->format('h:i:s A'),

                'employee' =>
                    $user->name,

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

        /*
        |--------------------------------------------------------------------------
        | THIRD SCAN = REJECTED
        |--------------------------------------------------------------------------
        |
        | The employee already has both:
        |
        | - Time In
        | - Time Out
        |
        | Therefore no additional scan is accepted.
        |
        */

        return response()->json([

            'success' => false,

            'message' =>
                'Attendance already completed for today.',

            'type' =>
                'Completed',

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
     * IMPORTANT:
     *
     * Absent is NOT determined here.
     *
     * Absent is determined by the scheduled end-of-day
     * MarkAbsent command.
     */
    private function updateStatus(Attendance $attendance)
    {
        $statuses = [];

        /*
        |--------------------------------------------------------------------------
        | Worked on Holiday
        |--------------------------------------------------------------------------
        |
        | A holiday becomes "Worked on Holiday" only when the
        | employee actually has a kiosk Time In.
        |
        */

        if (
            $attendance->holiday_id &&
            $attendance->time_in
        ) {

            $statuses[] = 'Worked on Holiday';
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

            if (!$attendance->remarks) {

                $attendance->remarks =
                    'Kiosk attendance';
            }

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Combine statuses
        |--------------------------------------------------------------------------
        */

        $attendance->status =
            implode(' & ', $statuses);

        /*
        |--------------------------------------------------------------------------
        | Attendance remarks
        |--------------------------------------------------------------------------
        */

        $remarks = [];

        if (
            $attendance->holiday_id &&
            $attendance->time_in
        ) {

            $remarks[] = 'Worked on Holiday';
        }

        if (($attendance->late_minutes ?? 0) > 0) {

            $remarks[] =
                'Late: ' .
                $this->formatMinutes(
                    $attendance->late_minutes
                );
        }

        if (($attendance->undertime_minutes ?? 0) > 0) {

            $remarks[] =
                'Undertime: ' .
                $this->formatMinutes(
                    $attendance->undertime_minutes
                );
        }

        if (($attendance->overtime_minutes ?? 0) > 0) {

            $remarks[] =
                'Overtime: ' .
                $this->formatMinutes(
                    $attendance->overtime_minutes
                );
        }

        if (!empty($remarks)) {

            $attendance->remarks =
                implode(' | ', $remarks);
        }
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
