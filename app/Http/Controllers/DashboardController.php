<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\OfficialBusiness;
use App\Models\Payroll;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Payslip;


class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        $presentDays = Attendance::where('user_id', $employee->id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->where('status', 'Present')
            ->count();

        $leaveBalance = 0;

        $pendingRequests =
            LeaveRequest::where('user_id', $employee->id)
            ->where('status', 'Pending')
            ->count()

            +

            OfficialBusiness::where('user_id', $employee->id)
            ->where('status', 'Pending')
            ->count();

        $obCount = OfficialBusiness::where('user_id', $employee->id)
            ->count();

        $employee = auth()->user();

        $recentAttendance = Attendance::where('user_id', $employee->id)
            ->orderByDesc('date')
            ->take(5)
            ->get();

        $announcements = Announcement::latest()
            ->take(5)
            ->get();

        $latestSalary = Payslip::where('user_id', $employee->id)
            ->latest('period_end')
            ->first();

        $notifications = collect();

        return view('employee.dashboard', compact(
            'employee',
            'presentDays',
            'leaveBalance',
            'pendingRequests',
            'obCount',
            'recentAttendance',
            'announcements',
            'latestSalary',
            'notifications'
        ));
    }
}
