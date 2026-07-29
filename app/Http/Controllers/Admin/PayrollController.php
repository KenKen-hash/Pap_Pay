<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeSalaryConfig;
use App\Models\DepartmentSalaryConfig;
use App\Models\Attendance;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')
            ->orderBy('department')
            ->orderBy('name')
            ->get()
            ->groupBy('department');

        return view('admin.payroll', compact('employees'));
    }

    public function department($department)
    {
        // Get department default configuration
        $departmentConfig = DepartmentSalaryConfig::where(
            'department',
            $department
        )->first();

        // Get employees in the selected department
        $employees = User::with('salaryConfig')
            ->where('role', 'employee')
            ->where('department', $department)
            ->orderBy('last_name')
            ->get();

        if ($department == 'Elementary') {
            return view(
                'admin.payroll.elementary',
                compact('department', 'employees', 'departmentConfig')
            );
        }

        if ($department == 'JHS') {
            return view(
                'admin.payroll.jhs',
                compact('department', 'employees', 'departmentConfig')
            );
        }

        if ($department == 'Admin') {
            return view(
                'admin.payroll.admin',
                compact('department', 'employees', 'departmentConfig')
            );
        }

        if ($department == 'SHS') {
            return view(
                'admin.payroll.shs',
                compact('department', 'employees', 'departmentConfig')
            );
        }

        if ($department == 'College') {
            return view(
                'admin.payroll.college',
                compact('department', 'employees', 'departmentConfig')
            );
        }

        return view(
            'admin.payroll.laborers',
            compact('department', 'employees', 'departmentConfig')
        );
    }



    public function save(Request $request)
    {
        $request->validate([

            'user_id' => 'required|exists:users,id',

            'basic_salary' => 'nullable|numeric',

            'daily_rate' => 'nullable|numeric',

            'overtime_rate' => 'nullable|numeric',

            'late_deduction_rate' => 'nullable|numeric',

            'undertime_deduction_rate' => 'nullable|numeric',

            'payroll_period' => 'nullable|in:Monthly,Every 15 Days,Weekly',

            'sss' => 'nullable|numeric',

            'philhealth' => 'nullable|numeric',

            'pagibig' => 'nullable|numeric',

            'hmo' => 'nullable|numeric',

            'ot_rate' => 'nullable|numeric',

            'honorarium' => 'nullable|numeric',

            'teaching_load' => 'nullable|numeric',

        ]);

        EmployeeSalaryConfig::updateOrCreate(

            [

                'user_id' => $request->user_id

            ],

            [

                'basic_salary' => $request->basic_salary,

                'payroll_period' => $request->payroll_period,

                'daily_rate' => $request->daily_rate,

                'overtime_rate' => $request->overtime_rate,

                'late_deduction_rate' => $request->late_deduction_rate,

                'undertime_deduction_rate' => $request->undertime_deduction_rate,

                'sss' => $request->sss,

                'philhealth' => $request->philhealth,

                'pagibig' => $request->pagibig,

                'hmo' => $request->hmo,

                'ot_rate' => $request->ot_rate,

                'honorarium' => $request->honorarium,

                'teaching_load' => $request->teaching_load,

                'use_department_default' => false

            ]

        );

        return response()->json([

            'success' => true

        ]);
    }

    public function saveDepartmentConfig(Request $request)
    {
        $request->validate([

            'department' => 'required|string',

            'default_basic_salary' => 'required|numeric|min:0',

            'daily_rate' => 'nullable|numeric|min:0',

            'overtime_rate' => 'nullable|numeric|min:0',

            'late_deduction_rate' => 'nullable|numeric|min:0',

            'undertime_deduction_rate' => 'nullable|numeric|min:0',

            'payroll_period' => 'required',

            'sss' => 'nullable|numeric|min:0',

            'philhealth' => 'nullable|numeric|min:0',

            'pagibig' => 'nullable|numeric|min:0',

            'hmo' => 'nullable|numeric|min:0',

        ]);

        DepartmentSalaryConfig::updateOrCreate(

            [
                'department' => $request->department
            ],

            [
                'default_basic_salary' => $request->default_basic_salary,

                'daily_rate' => $request->daily_rate,

                'overtime_rate' => $request->overtime_rate,

                'late_deduction_rate' => $request->late_deduction_rate,

                'undertime_deduction_rate' => $request->undertime_deduction_rate,

                'payroll_period' => $request->payroll_period,

                'sss' => $request->sss,

                'philhealth' => $request->philhealth,

                'pagibig' => $request->pagibig,

                'hmo' => $request->hmo,
            ]

        );

        return response()->json([
            'success' => true
        ]);
    }

    public function getEmployees(Request $request)
    {
        $departments = $request->departments;

        $employees = User::where('role', 'employee')
            ->whereIn('department', $departments)
            ->orderBy('last_name')
            ->get([
                'id',
                'employee_id',
                'first_name',
                'last_name',
                'department'
            ]);

        return response()->json($employees);
    }

    public function previewPayroll(Request $request)
    {
        $request->validate([
            'period_start' => 'required|date',
            'period_end'   => 'required|date',
            'employees'    => 'required|array',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Preview request received.',
            'employees' => $request->employees,
            'period_start' => $request->period_start,
            'period_end' => $request->period_end,
        ]);
    }
}
