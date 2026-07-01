<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use App\Models\OfficialBusiness;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Employees
        $totalEmployees = User::where('role', 'employee')->count();

        // Present Today
        $presentToday = Attendance::whereDate('date', today())
            ->where('status', 'Present')
            ->count();

        // Pending Leave Requests
        $pendingLeaves = LeaveRequest::where('status', 'pending')->count();

        // Pending Official Business Requests
        $pendingOB = OfficialBusiness::where('status', 'pending')->count();

        // Payroll Records
        $payrollCount = Payroll::count();

        // Employees without Time In today
        $absentToday = $totalEmployees - $presentToday;

        // Attendance Percentage Today
        $attendanceRate = $totalEmployees > 0
            ? round(($presentToday / $totalEmployees) * 100, 1)
            : 0;

        return view('admin.admin-dashboard', compact(
            'totalEmployees',
            'presentToday',
            'pendingLeaves',
            'pendingOB',
            'payrollCount',
            'absentToday',
            'attendanceRate'
        ));
    }
}