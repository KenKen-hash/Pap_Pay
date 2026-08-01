<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\OfficialBusiness;
use App\Models\Payslip;
use App\Models\EmployeeSalaryConfig;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Dashboard
    public function index()
    {
        return view('admin.reports', [

            'employeeCount' => User::where('role', 'employee')->count(),

            'attendanceCount' => Attendance::count(),

            'leaveCount' => LeaveRequest::count(),

            'obCount' => OfficialBusiness::count(),

            'payslipCount' => Payslip::count(),

            'salaryConfigCount' => EmployeeSalaryConfig::count(),

            'releasedPayslips' => Payslip::where('status', 'Released')->count(),

        ]);
    }

    // Payroll Report
    public function payroll(Request $request)
    {
        $query = Payslip::with('user');

        if ($request->filled('start')) {
            $query->whereDate('period_start', '>=', $request->start);
        }

        if ($request->filled('end')) {
            $query->whereDate('period_end', '<=', $request->end);
        }

        if ($request->filled('department')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('department', $request->department);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payslips = $query->latest()->paginate(20);

        return view(
            'admin.reports.payroll',
            [

                'payslips' => $payslips,

                'totalEmployees' => $payslips->count(),

                'grossPayroll' => $payslips->sum('gross_salary'),

                'netPayroll' => $payslips->sum('net_salary'),

                'totalBenefits' => $payslips->sum('benefits'),

                'totalDeductions' =>

                $payslips->sum('sss')
                    + $payslips->sum('philhealth')
                    + $payslips->sum('pagibig')
                    + $payslips->sum('hmo')
                    + $payslips->sum('late_deduction')
                    + $payslips->sum('undertime_deduction'),

            ]
        );
    }

    // Attendance Report
    public function attendance()
    {
        $attendance = Attendance::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.reports.attendance', compact('attendance'));
    }

    // Employee Report
    public function employee()
    {
        $employees = User::where('role', 'employee')
            ->paginate(20);

        return view('admin.reports.employee', compact('employees'));
    }

    // Leave Report
    public function leave()
    {
        $leaves = LeaveRequest::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.reports.leave', compact('leaves'));
    }

    // Official Business
    public function ob()
    {
        $obs = OfficialBusiness::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.reports.ob', compact('obs'));
    }

    // Salary Report
    public function salary()
    {
        $salaries = EmployeeSalaryConfig::with('user')
            ->paginate(20);

        return view('admin.reports.salary', compact('salaries'));
    }

    // Government Contributions
    public function contributions()
    {
        $contributions = EmployeeSalaryConfig::with('user')
            ->paginate(20);

        return view('admin.reports.contributions', compact('contributions'));
    }
}
