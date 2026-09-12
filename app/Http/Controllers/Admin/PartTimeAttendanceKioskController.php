<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PartTimeSubject;
use App\Models\PartTimeAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PartTimeAttendanceKioskController extends Controller
{
    /**
     * Display Part-Time Attendance Kiosk.
     */
    public function index()
    {
        return view('admin.part_time_attendance_kiosk');
    }


    /**
     * Get Part-Time employees with face recognition data.
     */
   public function faces()
{
    try {

        $employees = User::where('employment_type', 'Part-Time')
            ->where('face_registered', true)
            ->whereNotNull('face_embedding')
            ->get();

        $data = [];

        foreach ($employees as $employee) {

            $name = trim(
                ($employee->first_name ?? '') . ' ' .
                ($employee->middle_name ?? '') . ' ' .
                ($employee->last_name ?? '')
            );

            /*
            |--------------------------------------------------------------------------
            | Get the existing face embedding
            |--------------------------------------------------------------------------
            |
            | The regular PapPay face-recognition system stores the
            | face data in users.face_embedding.
            |
            */

            $descriptor = $employee->face_embedding;

            /*
            |--------------------------------------------------------------------------
            | Convert JSON string to array
            |--------------------------------------------------------------------------
            */

            if (is_string($descriptor)) {

                $descriptor = json_decode(
                    $descriptor,
                    true
                );

            }

            /*
            |--------------------------------------------------------------------------
            | Skip invalid face data
            |--------------------------------------------------------------------------
            */

            if (
                !is_array($descriptor) ||
                count($descriptor) !== 128
            ) {
                continue;
            }

            $data[] = [

                'id' =>
                    $employee->id,

                'name' =>
                    $name,

                'employee_id' =>
                    $employee->employee_id,

                'department' =>
                    $employee->department,

                'position' =>
                    $employee->position,

                'photo' =>
                    $employee->photo
                        ? asset(
                            'storage/' .
                            $employee->photo
                        )
                        : asset(
                            'images/default-avatar.png'
                        ),

                /*
                |--------------------------------------------------------------------------
                | SAME FACE DATA USED BY REGULAR KIOSK
                |--------------------------------------------------------------------------
                */

                'descriptor' =>
                    array_values($descriptor),

            ];
        }

        return response()->json($data);

    } catch (\Throwable $e) {

        \Log::error(
            'Part-Time Attendance Faces Error',
            [
                'message' =>
                    $e->getMessage(),

                'file' =>
                    $e->getFile(),

                'line' =>
                    $e->getLine(),
            ]
        );

        return response()->json([

            'success' =>
                false,

            'message' =>
                'Unable to load Part-Time employee face data.',

        ], 500);
    }
}


    /**
     * Record Part-Time Attendance.
     */
    public function record(Request $request)
    {
        $request->validate([
            'employee_id' =>
                'required|exists:users,id',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Find employee
        |--------------------------------------------------------------------------
        */

        $employee =
            User::findOrFail(
                $request->employee_id
            );


        /*
        |--------------------------------------------------------------------------
        | Verify Part-Time employee
        |--------------------------------------------------------------------------
        */

        if (
            $employee->employment_type !== 'Part-Time'
        ) {

            return response()->json([

                'success' =>
                    false,

                'message' =>
                    'This employee is not registered as Part-Time.',

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Current date and time
        |--------------------------------------------------------------------------
        */

        $now =
            Carbon::now();

        $today =
            $now->toDateString();

        $day =
            $now->format('l');


        /*
        |--------------------------------------------------------------------------
        | Get today's active subject assignments
        |--------------------------------------------------------------------------
        */

        $subjects =
            PartTimeSubject::where(
                'user_id',
                $employee->id
            )
            ->where(
                'day_of_week',
                $day
            )
            ->where(
                'is_active',
                true
            )
            ->orderBy(
                'start_time'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | No subject today
        |--------------------------------------------------------------------------
        */

        if ($subjects->isEmpty()) {

            return response()->json([

                'success' =>
                    false,

                'message' =>
                    'No subject is scheduled for ' .
                    ($employee->first_name ?? 'this employee') .
                    ' today.',

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Find currently active subject
        |--------------------------------------------------------------------------
        */

        $currentTime =
            $now->format('H:i:s');

        $subject = null;


        foreach ($subjects as $item) {

            $startTime =
                Carbon::parse(
                    $item->start_time
                )->format('H:i:s');

            $endTime =
                Carbon::parse(
                    $item->end_time
                )->format('H:i:s');


            if (
                $currentTime >= $startTime &&
                $currentTime <= $endTime
            ) {

                $subject =
                    $item;

                break;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | No active subject at current time
        |--------------------------------------------------------------------------
        */

        if (!$subject) {

            return response()->json([

                'success' =>
                    false,

                'message' =>
                    'There is no active subject schedule for you at this time.',

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Find today's attendance
        |--------------------------------------------------------------------------
        */

        $attendance =
            PartTimeAttendance::where(
                'user_id',
                $employee->id
            )
            ->where(
                'part_time_subject_id',
                $subject->id
            )
            ->whereDate(
                'attendance_date',
                $today
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | TIME IN
        |--------------------------------------------------------------------------
        */

        if (!$attendance) {

            $attendance =
                PartTimeAttendance::create([

                    'user_id' =>
                        $employee->id,

                    'part_time_subject_id' =>
                        $subject->id,

                    'attendance_date' =>
                        $today,

                    'time_in' =>
                        $now->format('H:i:s'),

                    'time_out' =>
                        null,

                    'status' =>
                        'Present',

                ]);


            return response()->json([

                'success' =>
                    true,

                'type' =>
                    'TIME IN',

                'time' =>
                    $now->format('h:i A'),

                'hours_worked' =>
                    0,

                'subject' =>
                    $subject->subject_name,

                'schedule' =>
                    Carbon::parse(
                        $subject->start_time
                    )->format('h:i A')
                    .
                    ' - '
                    .
                    Carbon::parse(
                        $subject->end_time
                    )->format('h:i A'),

                'message' =>
                    'Time-in recorded successfully.',

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | TIME OUT
        |--------------------------------------------------------------------------
        */

        if (
            $attendance->time_in &&
            !$attendance->time_out
        ) {

            $attendance->time_out =
                $now->format('H:i:s');

            $attendance->status =
                'Present';

            $attendance->save();


            /*
            |--------------------------------------------------------------------------
            | Calculate hours worked
            |--------------------------------------------------------------------------
            */

            $timeIn =
                Carbon::parse(
                    $attendance->time_in
                );

            $timeOut =
                Carbon::parse(
                    $attendance->time_out
                );


            $minutes =
                $timeIn->diffInMinutes(
                    $timeOut
                );


            $hoursWorked =
                round(
                    $minutes / 60,
                    2
                );


            return response()->json([

                'success' =>
                    true,

                'type' =>
                    'TIME OUT',

                'time' =>
                    $now->format('h:i A'),

                'hours_worked' =>
                    $hoursWorked,

                'subject' =>
                    $subject->subject_name,

                'schedule' =>
                    Carbon::parse(
                        $subject->start_time
                    )->format('h:i A')
                    .
                    ' - '
                    .
                    Carbon::parse(
                        $subject->end_time
                    )->format('h:i A'),

                'message' =>
                    'Time-out recorded successfully.',

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Already completed
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' =>
                false,

            'message' =>
                'Attendance for this subject has already been completed today.',

        ]);

    }
}
