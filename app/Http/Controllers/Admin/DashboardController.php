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
        $totalEmployees = User::where('role', 'employee')
            ->where('status', 'Active')
            ->count();

        $totalUsers = User::where('status', 'Active')->count();
        // Present Today
        $presentToday = Attendance::whereDate('date', today())
            ->whereHas('user', function ($query) {
                $query->where('status', 'Active');
            })
            ->count();

        // Pending Leave Requests
        $pendingLeaves = LeaveRequest::where('status', 'Pending')
            ->whereHas('user', function ($query) {
                $query->where('status', 'Active');
            })
            ->count();

        // Pending Official Business Requests
        $pendingOB = OfficialBusiness::where('status', 'pending')
            ->whereHas('user', function ($query) {
                $query->where('status', 'Active');
            })
            ->count();

        // Payroll Records
        $payrollCount = Payroll::whereHas('user', function ($query) {
            $query->where('status', 'Active');
        })
            ->whereMonth('pay_date', now()->month)
            ->count();

        // Employees without Time In today
        $absentToday = $totalEmployees - $presentToday;

        // Attendance Percentage Today
        $attendanceRate = $totalEmployees > 0
            ? round(($presentToday / $totalEmployees) * 100, 1)
            : 0;

        $recentEmployees = User::where('status', 'Active')
            ->latest()
            ->take(5)
            ->get();

        $attendanceChart = [];

        for ($i = 0; $i < 6; $i++) {

            $date = Carbon::now()
                ->startOfWeek()
                ->addDays($i);

            $attendanceChart[] = [

                'day' => $date->format('D'),

                'count' => Attendance::whereDate('date', $date)
                    ->where('status', 'Present')
                    ->whereHas('user', function ($query) {
                        $query->where('status', 'Active');
                    })
                    ->count()

            ];
        }

        $maxAttendance = collect($attendanceChart)->max('count');

        $maxAttendance = max($maxAttendance, 1);

        return view('admin.admin-dashboard', compact(
            'totalUsers',
            'totalEmployees',
            'recentEmployees',
            'presentToday',
            'pendingLeaves',
            'pendingOB',
            'payrollCount',
            'absentToday',
            'attendanceChart',
            'maxAttendance',
            'attendanceRate'

        ));
    }
}
