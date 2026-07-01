<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    /**
     * Display the employee attendance page.
     */
   public function index(Request $request)
{
    $employee = Auth::user();

    $query = Attendance::where('user_id', $employee->id);

    if ($request->filled('date')) {
        $query->whereDate('date', $request->date);
    }

    $attendanceRecords = $query
        ->latest('date')
        ->paginate(10)
        ->withQueryString();

    $todayAttendance = Attendance::where('user_id', $employee->id)
        ->whereDate('date', today())
        ->first();

    $presentDays = Attendance::where('user_id', $employee->id)
        ->where('status', 'Present')
        ->count();

    $lateDays = Attendance::where('user_id', $employee->id)
        ->where('status', 'Late')
        ->count();

    $absentDays = Attendance::where('user_id', $employee->id)
        ->where('status', 'Absent')
        ->count();

    $leaveDays = Attendance::where('user_id', $employee->id)
        ->where('status', 'Leave')
        ->count();

    $officialBusinessDays = Attendance::where('user_id', $employee->id)
        ->where('status', 'Official Business')
        ->count();

    return view('employee.attendance', compact(
        'employee',
        'todayAttendance',
        'attendanceRecords',
        'presentDays',
        'lateDays',
        'absentDays',
        'leaveDays',
        'officialBusinessDays'
    ));
}
}   