<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuditLogService;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;

class HolidayController extends Controller
{
    /**
     * Display Holiday Page
     */
    public function index()
    {
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        $totalHolidays = Holiday::count();
        $regularHolidays = Holiday::where('holiday_type', 'Regular')->count();
        $specialHolidays = Holiday::where('holiday_type', 'Special')->count();
        $emergencyHolidays = Holiday::where('holiday_type', 'Emergency')->count();

        return view('admin.holiday.index', compact(
            'holidays',
            'totalHolidays',
            'regularHolidays',
            'specialHolidays',
            'emergencyHolidays'
        ));
    }

    /**
     * Store Holiday
     */
    public function store(Request $request)
    {
        $request->validate([
            'holiday_name' => 'required|string|max:255',
            'holiday_date' => 'required|date',
            'holiday_type' => 'required|string|max:255',

            'pay_rate' => 'required|numeric|min:0',
            'department' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        // Check duplicate holiday
        $exists = Holiday::where('holiday_date', $request->holiday_date)
            ->where('department', $request->department)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'holiday_date' => 'A holiday already exists for this date and department.'
            ])->withInput();
        }

        $holiday = Holiday::create([
            'holiday_name' => $request->holiday_name,
            'holiday_date' => $request->holiday_date,
            'holiday_type' => $request->holiday_type,

            'pay_rate' => $request->pay_rate,
            'department' => $request->department,
            'remarks' => $request->remarks,
            'is_active' => $request->is_active,
        ]);


        /*
|--------------------------------------------------------------------------
| Notify Employees About New Holiday
|--------------------------------------------------------------------------
*/

        $employeesQuery = User::where('role', 'employee')
            ->where('status', 'Active');

        if (!empty($holiday->department)) {

            $employeesQuery->where(
                'department',
                $holiday->department
            );
        }

        $employees = $employeesQuery->get();

        foreach ($employees as $employee) {

            Notification::create([

                'user_id' => $employee->id,

                'title' => 'New Holiday Posted',

                'message' => $holiday->holiday_name .
                    ' has been posted for ' .
                    Carbon::parse($holiday->holiday_date)
                    ->format('F d, Y') .
                    ($holiday->department
                        ? ' for ' . $holiday->department . '.'
                        : '.'),

                'is_read' => false,

                'type' => 'holiday',

                'url' => null,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Audit Log - Created Holiday
        |--------------------------------------------------------------------------
        */

        AuditLogService::log(
            'Holiday Created',
            'Admin ' .
                Auth::user()->name .
                ' created holiday "' .
                $request->holiday_name .
                '" for ' .
                $request->holiday_date .
                '.'
        );

        return redirect()
            ->route('holidays.index')
            ->with('success', 'Holiday added successfully.');
    }

    /**
     * Update Holiday
     */
    public function update(Request $request, Holiday $holiday)
    {
        $request->validate([

            'holiday_name' => 'required|string|max:255',

            'holiday_date' => 'required|date',

            'holiday_type' => 'required|string|max:255',

            'pay_rate' => 'required|numeric|min:0',

            'department' => 'nullable|string|max:255',

            'remarks' => 'nullable|string',

            'is_active' => 'required|boolean',

        ]);

        $holiday->update($request->all());

        /*
        |--------------------------------------------------------------------------
        | Audit Log - Updated Holiday
        |--------------------------------------------------------------------------
        */

        AuditLogService::log(
            'Holiday Updated',
            'Admin ' .
                Auth::user()->name .
                ' updated holiday "' .
                $holiday->holiday_name .
                '" for ' .
                $holiday->holiday_date .
                '.'
        );

        return redirect()
            ->route('holidays.index')
            ->with('success', 'Holiday updated successfully.');
    }

    /**
     * Delete Holiday
     */
    public function destroy(Holiday $holiday)
    {
        $holidayName = $holiday->holiday_name;
        $holidayDate = $holiday->holiday_date;

        $holiday->delete();

        /*
        |--------------------------------------------------------------------------
        | Audit Log - Deleted Holiday
        |--------------------------------------------------------------------------
        */

        AuditLogService::log(
            'Holiday Deleted',
            'Admin ' .
                Auth::user()->name .
                ' deleted holiday "' .
                $holidayName .
                '" for ' .
                $holidayDate .
                '.'
        );

        return redirect()
            ->route('holidays.index')
            ->with('success', 'Holiday deleted successfully.');
    }
}
