<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('user');

        // Search by employee name or employee ID
        if ($request->filled('search')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('employee_id', 'like', '%' . $request->search . '%');
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



    public function record(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id'
        ]);

        $attendance = Attendance::firstOrCreate(
            [
                'user_id' => $request->employee_id,
                'date' => today()
            ]
        );

        $now = now();

        $type = "";

        /*
MORNING TIME IN
OR
AFTERNOON TIME IN
*/

        if (!$attendance->morning_time_in && !$attendance->afternoon_time_in) {

            /*
    If it is already 12:00 PM or later,
    treat the first scan as Afternoon Time In.
    */
            if ($now->hour >= 12) {

                $attendance->afternoon_time_in = $now;

                $attendance->status = "Present";

                $type = "Afternoon Time In";
            } else {

                $attendance->morning_time_in = $now;

                $attendance->status = "Present";

                $type = "Morning Time In";
            }
        }

        /*
    MORNING TIME OUT
    */ elseif (!$attendance->morning_time_out) {

            $attendance->morning_time_out = $now;

            $morningMinutes =
                $attendance->morning_time_in
                ->diffInMinutes($attendance->morning_time_out);

            $attendance->hours_worked =
                round($morningMinutes / 60, 2);

            $type = "Morning Time Out";
        }

        /*
    AFTERNOON TIME IN
    */ elseif (!$attendance->afternoon_time_in) {

            $attendance->afternoon_time_in = $now;
            $type = "Afternoon Time In";
        }

        /*
    AFTERNOON TIME OUT
    */ elseif (!$attendance->afternoon_time_out) {

            $attendance->afternoon_time_out = $now;

            $totalMinutes = 0;

            /*
Morning Hours
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
Afternoon Hours
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

            $attendance->hours_worked =

                round($totalMinutes / 60, 2);

            $type = "Afternoon Time Out";
        }

        /*
    Attendance already completed
    */ else {

            return response()->json([
                "success" => false,
                "message" => "Attendance already completed today."
            ]);
        }

        $attendance->save();

        return response()->json([

            "success" => true,

            "message" => $type . " recorded successfully.",

            "type" => $type,

            "time" => $now->format('h:i:s A'),

            "employee" => $attendance->user->name,

            "hours_worked" => number_format($attendance->hours_worked, 2)

        ]);
    }
}
