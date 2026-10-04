<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficialBusiness;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\AuditLogService;
use App\Models\Notification;

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
    | Mark Attendance as Official Business
    |--------------------------------------------------------------------------
    |
    | The current attendance structure uses:
    | time_in, time_out, hours_worked, late_minutes,
    | undertime_minutes, overtime_minutes, status, remarks, etc.
    |
    | The old morning/afternoon time fields are no longer used.
    |
    */

        $attendance->status = 'Present';
        $attendance->remarks = 'Official Business';

        $attendance->save();

        /*
    |--------------------------------------------------------------------------
    | Audit Log - Approved Official Business
    |--------------------------------------------------------------------------
    */

        AuditLogService::log(
            'Official Business Approved',
            'Admin ' .
                Auth::user()->name .
                ' approved Official Business request OB-' .
                str_pad($ob->id, 5, '0', STR_PAD_LEFT) .
                ' for employee ' .
                $ob->user->name .
                '.'
        );

        /*
|--------------------------------------------------------------------------
| Employee Notification
|--------------------------------------------------------------------------
*/

        Notification::create([

            'user_id' => $ob->user_id,

            'title' => 'Official Business Approved',

            'message' => 'Your Official Business request OB-' .
                str_pad($ob->id, 5, '0', STR_PAD_LEFT) .
                ' has been approved.',

            'type' => 'ob_approved',

            'url' => '/employee/file-ob',

        ]);

        return back()->with('success', 'Official Business approved successfully.');
    }

    public function reject($id)
    {
        $ob = OfficialBusiness::findOrFail($id);

        $ob->status = 'Rejected';

        $ob->save();

        /*
    |--------------------------------------------------------------------------
    | Audit Log - Rejected Official Business
    |--------------------------------------------------------------------------
    */

        AuditLogService::log(
            'Official Business Rejected',
            'Admin ' .
                Auth::user()->name .
                ' rejected Official Business request OB-' .
                str_pad($ob->id, 5, '0', STR_PAD_LEFT) .
                ' for employee ' .
                $ob->user->name .
                '.'
        );

        /*
|--------------------------------------------------------------------------
| Employee Notification
|--------------------------------------------------------------------------
*/

        Notification::create([

            'user_id' => $ob->user_id,

            'title' => 'Official Business Rejected',

            'message' => 'Your Official Business request OB-' .
                str_pad($ob->id, 5, '0', STR_PAD_LEFT) .
                ' has been rejected.',

            'type' => 'ob_rejected',

            'url' => '/employee/file-ob',

        ]);

        return back()->with('success', 'Official Business rejected.');
    }
}
