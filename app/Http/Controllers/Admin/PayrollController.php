<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeSalaryConfig;
use App\Models\DepartmentSalaryConfig;
use App\Models\Attendance;
use App\Models\Payslip;
use App\Services\PayrollService;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')
            ->orderBy('department')
            ->orderBy('name')
            ->get()
            ->groupBy('department');

        $payslips = Payslip::latest()
            ->get()
            ->groupBy(function ($item) {
                return $item->period_start . '_' . $item->period_end;
            });

        return view('admin.payroll', compact(
            'employees',
            'payslips'
        ));
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

        $preview = [];

        foreach ($request->employees as $employeeId) {

            $employee = User::with('salaryConfig')->find($employeeId);

            if (!$employee) {
                continue;
            }

            $config = $employee->salaryConfig;

            if (!$config) {
                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

            $attendance = Attendance::where('user_id', $employee->id)
                ->whereBetween('date', [
                    $request->period_start,
                    $request->period_end
                ])
                ->get();

            $presentDays = $attendance
                ->where('status', 'Present')
                ->count();

            $lateMinutes = $attendance->sum('late_minutes');

            $undertimeMinutes = $attendance->sum('undertime_minutes');

            /*
        |--------------------------------------------------------------------------
        | Earnings
        |--------------------------------------------------------------------------
        */

            $basicPay = $config->daily_rate * $presentDays;

            $grossSalary =
                $basicPay +
                $config->ot_rate +
                $config->honorarium +
                $config->teaching_load;

            /*
        |--------------------------------------------------------------------------
        | Benefits
        |--------------------------------------------------------------------------
        */

            $benefits =
                (
                    $config->sss +
                    $config->philhealth +
                    $config->pagibig +
                    $config->hmo
                ) / 2;

            /*
        |--------------------------------------------------------------------------
        | Deductions
        |--------------------------------------------------------------------------
        */

            $lateDeduction =
                $lateMinutes *
                $config->late_deduction_rate;

            $undertimeDeduction =
                $undertimeMinutes *
                $config->undertime_deduction_rate;

            /*
        |--------------------------------------------------------------------------
        | Net Salary
        |--------------------------------------------------------------------------
        */

            $netSalary =
                $grossSalary
                - $benefits
                - $lateDeduction
                - $undertimeDeduction;

            $preview[] = [

                'id' => $employee->id,

                'name' =>
                $employee->first_name . ' ' .
                    $employee->last_name,

                'department' => $employee->department,

                'present_days' => $presentDays,

                'late_minutes' => $lateMinutes,

                'undertime_minutes' => $undertimeMinutes,

                'gross_salary' => round($grossSalary, 2),

                'benefits' => round($benefits, 2),

                'late_deduction' => round($lateDeduction, 2),

                'undertime_deduction' => round($undertimeDeduction, 2),

                'net_salary' => round($netSalary, 2),

            ];
        }

        return response()->json([
            'success' => true,
            'preview' => $preview
        ]);
    }

    public function generatePayslips(Request $request)
    {
        $request->validate([

            'period_start' => 'required|date',

            'period_end' => 'required|date',

            'employees' => 'required|array',

        ]);
        $generated = 0;
        $skipped = 0;

        foreach ($request->employees as $employeeId) {

            $employee = User::with('salaryConfig')->find($employeeId);

            $existingPayslip = Payslip::where('user_id', $employeeId)
                ->where('period_start', $request->period_start)
                ->where('period_end', $request->period_end)
                ->exists();

            if ($existingPayslip) {

                $skipped++;

                continue;
            }

            if (!$employee || !$employee->salaryConfig) {
                continue;
            }

            $config = $employee->salaryConfig;

            $attendance = Attendance::where('user_id', $employee->id)
                ->whereBetween('date', [
                    $request->period_start,
                    $request->period_end
                ])
                ->get();

            $presentDays = $attendance
                ->where('status', 'Present')
                ->count();

            $lateMinutes = $attendance->sum('late_minutes');

            $undertimeMinutes = $attendance->sum('undertime_minutes');

            $basicPay =
                $config->daily_rate *
                $presentDays;

            $grossSalary =
                $basicPay +
                $config->ot_rate +
                $config->honorarium +
                $config->teaching_load;

            $benefits =
                (
                    $config->sss +
                    $config->philhealth +
                    $config->pagibig +
                    $config->hmo
                ) / 2;

            $lateDeduction =
                $lateMinutes *
                $config->late_deduction_rate;

            $undertimeDeduction =
                $undertimeMinutes *
                $config->undertime_deduction_rate;

            $netSalary =
                $grossSalary
                - $benefits
                - $lateDeduction
                - $undertimeDeduction;

            Payslip::create([

                'user_id' => $employee->id,

                'period_start' => $request->period_start,

                'period_end' => $request->period_end,

                'present_days' => $presentDays,

                'late_minutes' => $lateMinutes,

                'undertime_minutes' => $undertimeMinutes,

                'daily_rate' => $config->daily_rate,

                'ot' => $config->ot_rate,

                'honorarium' => $config->honorarium,

                'teaching_load' => $config->teaching_load,

                'sss' => $config->sss,

                'philhealth' => $config->philhealth,

                'pagibig' => $config->pagibig,

                'hmo' => $config->hmo,

                'late_deduction' => $lateDeduction,

                'undertime_deduction' => $undertimeDeduction,

                'gross_salary' => $grossSalary,

                'benefits' => $benefits,

                'net_salary' => $netSalary,

                'status' => 'Generated',

            ]);

            $generated++;
        }

        return response()->json([
            'success' => true,
            'generated' => $generated,
            'skipped' => $skipped,
        ]);
    }
}
