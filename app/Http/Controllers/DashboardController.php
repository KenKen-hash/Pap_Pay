<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\OfficialBusiness;
use App\Models\Payroll;
use App\Models\Announcement;
use App\Models\Notification;


class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        $presentDays = Attendance::where(
            'user_id',
            $employee->id
        )
        ->whereMonth('date', now()->month)
        ->count();

        $leaveBalance = 12;

        $pendingRequests = LeaveRequest::where(
            'user_id',
            $employee->id
        )
        ->where('status', 'Pending')
        ->count();

        $obCount = OfficialBusiness::where(
            'user_id',
            $employee->id
        )
        ->count();

        $latestSalary = Payroll::where(
            'user_id',
            $employee->id
        )
        ->latest('pay_date')
        ->first();

        $recentAttendance = Attendance::where(
            'user_id',
            $employee->id
        )
        ->latest('date')
        ->take(5)
        ->get();

        $announcements = Announcement::latest()
            ->take(5)
            ->get();
        
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

       return view('employee.dashboard', compact(
        'employee',
        'presentDays',
        'leaveBalance',
        'pendingRequests',
        'obCount',
        'latestSalary',
        'recentAttendance',
        'announcements',
        'notifications'
    ));
        
    }
}