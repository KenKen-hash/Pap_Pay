<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

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

        Holiday::create([
            'holiday_name' => $request->holiday_name,
            'holiday_date' => $request->holiday_date,
            'holiday_type' => $request->holiday_type,

            'pay_rate' => $request->pay_rate,
            'department' => $request->department,
            'remarks' => $request->remarks,
            'is_active' => $request->is_active,
        ]);

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

        return redirect()
            ->route('holidays.index')
            ->with('success', 'Holiday updated successfully.');
    }

    /**
     * Delete Holiday
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return redirect()
            ->route('holidays.index')
            ->with('success', 'Holiday deleted successfully.');
    }
}
