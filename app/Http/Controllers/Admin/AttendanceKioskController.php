<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceLog;
use Carbon\Carbon;

class AttendanceKioskController extends Controller
{
    public function record(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $userId = $request->user_id;

        $today = Carbon::today();

        $attendance = AttendanceLog::firstOrCreate(
            [
                'user_id' => $userId,
                'attendance_date' => $today
            ],
            [
                'work_hours' => 0
            ]
        );

        $now = Carbon::now();

        $time = $now->format('H:i:s');

        $hour = $now->hour;

        /*
        Morning In
        12:00 AM - 10:59 AM
        */

        if ($hour < 11) {

            if (!$attendance->morning_in) {

                $attendance->morning_in = $time;
                $attendance->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Morning Time In recorded successfully.',
                    'type' => 'Morning Time In',
                    'time' => $time
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Morning Time In already recorded.'
            ]);
        }

        /*
        Morning Out
        11:00 AM - 12:59 PM
        */

        if ($hour < 13) {

            if (!$attendance->morning_out) {

                $attendance->morning_out = $time;
                $attendance->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Morning Time Out recorded successfully.',
                    'type' => 'Morning Time Out',
                    'time' => $time
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Morning Time Out already recorded.'
            ]);
        }

        /*
        Afternoon In
        1:00 PM - 3:59 PM
        */

        if ($hour < 16) {

            if (!$attendance->afternoon_in) {

                $attendance->afternoon_in = $time;
                $attendance->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Afternoon Time In recorded successfully.',
                    'type' => 'Afternoon Time In',
                    'time' => $time
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Afternoon Time In already recorded.'
            ]);
        }

        /*
        Afternoon Out
        4:00 PM onwards
        */

        if (!$attendance->afternoon_out) {

            $attendance->afternoon_out = $time;

            if (
                $attendance->morning_in &&
                $attendance->morning_out &&
                $attendance->afternoon_in &&
                $attendance->afternoon_out
            ) {

                $morningHours = Carbon::parse($attendance->morning_in)
                    ->diffInMinutes(Carbon::parse($attendance->morning_out));

                $afternoonHours = Carbon::parse($attendance->afternoon_in)
                    ->diffInMinutes(Carbon::parse($attendance->afternoon_out));

                $attendance->work_hours = round(
                    ($morningHours + $afternoonHours) / 60,
                    2
                );
            }

            $attendance->save();

            return response()->json([
                'success' => true,
                'message' => 'Afternoon Time Out recorded successfully.',
                'type' => 'Afternoon Time Out',
                'time' => $time,
                'work_hours' => $attendance->work_hours
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Attendance already completed today.'
        ]);
    }
}
