<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeSalaryConfig;
use App\Models\DepartmentSalaryConfig;

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
}
