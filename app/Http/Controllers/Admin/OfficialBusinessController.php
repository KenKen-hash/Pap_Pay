<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficialBusiness;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class OfficialBusinessController extends Controller
{
    public function index(Request $request)
    {
        $query = OfficialBusiness::with('user');

        /*
    |--------------------------------------------------------------------------
    | Search Employee
    |--------------------------------------------------------------------------
    */

        if ($request->filled('search')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('employee_id', 'like', '%' . $request->search . '%');
            });
        }

        /*
    |--------------------------------------------------------------------------
    | Status Filter
    |--------------------------------------------------------------------------
    */

        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        /*
    |--------------------------------------------------------------------------
    | Date Filter
    |--------------------------------------------------------------------------
    */

        if ($request->filled('date')) {

            $query->whereDate('ob_date', $request->date);
        }

        $officialBusinesses = $query
            ->latest()
            ->paginate(10);

        return view('admin.official_business', [

            'officialBusinesses' => $officialBusinesses,

            'pendingOB' => OfficialBusiness::where('status', 'Pending')->count(),

            'approvedOB' => OfficialBusiness::where('status', 'Approved')->count(),

            'rejectedOB' => OfficialBusiness::where('status', 'Rejected')->count(),

            'totalOB' => OfficialBusiness::count(),

        ]);
    }
    public function approve($id)
    {
        $ob = OfficialBusiness::findOrFail($id);

        // Already approved
        if ($ob->status == 'Approved') {
            return back()->with('info', 'Already approved.');
        }

        // Update OB Status
        $ob->status = 'Approved';
        $ob->save();

        /*
    |--------------------------------------------------------------------------
    | Create or Update Attendance
    |--------------------------------------------------------------------------
    */

        $attendance = Attendance::firstOrCreate(

            [
                'user_id' => $ob->user_id,
                'date'    => $ob->ob_date,
            ],

            [
                'status' => 'Present'
            ]

        );

        /*
    |--------------------------------------------------------------------------
    | Fill Attendance Time
    |--------------------------------------------------------------------------
    */

        $departure = Carbon::parse($ob->departure_time)->format('H:i:s');
        $return    = Carbon::parse($ob->expected_return_time)->format('H:i:s');

        if ($departure < '12:00:00') {

            $attendance->morning_time_out = $departure;
        } else {

            $attendance->afternoon_time_out = $departure;
        }

        if ($return < '12:00:00') {

            $attendance->morning_time_in = $return;
        } else {

            $attendance->afternoon_time_in = $return;
        }

        $attendance->remarks = 'Official Business';

        $attendance->save();

        return back()->with('success', 'Official Business approved successfully.');
    }
    public function reject($id)
    {
        $ob = OfficialBusiness::findOrFail($id);

        $ob->status = 'Rejected';

        $ob->save();

        return back()->with('success', 'Official Business rejected.');
    }
}
