<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeSalaryConfig;
use App\Models\DepartmentSalaryConfig;
use App\Models\Attendance;
use App\Models\Payslip;
use App\Models\Holiday;
use Carbon\Carbon;

class PayrollController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Payroll Configuration Main Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $employees = User::where('role', 'employee')
            ->orderBy('department')
            ->orderBy('name')
            ->get();

        $employees = $employees->groupBy('department');

        $payslips = Payslip::latest()
            ->get()
            ->groupBy(function ($item) {
                return $item->period_start . '_' . $item->period_end;
            });

        return view(
            'admin.payroll',
            compact('employees', 'payslips')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Department Payroll Configuration
    |--------------------------------------------------------------------------
    */

    public function department($department)
    {
        $departmentConfig = DepartmentSalaryConfig::where(
            'department',
            $department
        )->first();

        $employees = User::with('salaryConfig')
            ->where('role', 'employee')
            ->where('department', $department)
            ->orderBy('last_name')
            ->get();

        switch ($department) {

            case 'Elementary':
                $view = 'admin.payroll.elementary';
                break;

            case 'JHS':
                $view = 'admin.payroll.jhs';
                break;

            case 'SHS':
                $view = 'admin.payroll.shs';
                break;

            case 'College':
                $view = 'admin.payroll.college';
                break;

            case 'Admin':
                $view = 'admin.payroll.admin';
                break;

            case 'Laborers':
                $view = 'admin.payroll.laborers';
                break;

            default:
                abort(404);
        }

        return view(
            $view,
            compact(
                'department',
                'employees',
                'departmentConfig'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Save Individual Employee Salary Configuration
    |--------------------------------------------------------------------------
    */

    public function save(Request $request)
    {
        $validated = $request->validate([

            'user_id' =>
                'required|exists:users,id',

            'basic_salary' =>
                'nullable|numeric|min:0',

            'daily_rate' =>
                'nullable|numeric|min:0',

            'overtime_rate' =>
                'nullable|numeric|min:0',

            'late_deduction_rate' =>
                'nullable|numeric|min:0',

            'undertime_deduction_rate' =>
                'nullable|numeric|min:0',

            'payroll_period' =>
                'nullable|in:Monthly,Every 15 Days,Weekly',

            'sss' =>
                'nullable|numeric|min:0',

            'philhealth' =>
                'nullable|numeric|min:0',

            'pagibig' =>
                'nullable|numeric|min:0',

            'hmo' =>
                'nullable|numeric|min:0',

            'honorarium' =>
                'nullable|numeric|min:0',

            'teaching_load_units_taken' =>
                'nullable|integer|min:0',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Get Employee
        |--------------------------------------------------------------------------
        */

        $employee = User::findOrFail(
            $validated['user_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Get Current Department Default
        |--------------------------------------------------------------------------
        */

        $departmentConfig =
            DepartmentSalaryConfig::where(
                'department',
                $employee->department
            )->first();


        /*
        |--------------------------------------------------------------------------
        | Department Teaching Load Values
        |--------------------------------------------------------------------------
        */

        $teachingLoadRequiredUnit = 0;

        $teachingLoadPrice = 0;


        if ($departmentConfig) {

            $teachingLoadRequiredUnit =
                (int) (
                    $departmentConfig
                        ->teaching_load_unit_required
                    ?? 0
                );


            $teachingLoadPrice =
                (float) (
                    $departmentConfig
                        ->teaching_load_price
                    ?? 0
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Honorarium
        |--------------------------------------------------------------------------
        */

        $honorarium =
            isset($validated['honorarium'])
                ? (float) $validated['honorarium']
                : 0;


        /*
        |--------------------------------------------------------------------------
        | Save Employee Configuration
        |--------------------------------------------------------------------------
        */

        EmployeeSalaryConfig::updateOrCreate(

            [
                'user_id' =>
                    $validated['user_id'],
            ],

            [

                'basic_salary' =>
                    $validated['basic_salary'] ?? 0,

                'payroll_period' =>
                    $validated['payroll_period']
                    ?? (
                        $departmentConfig->payroll_period
                        ?? 'Every 15 Days'
                    ),

                'daily_rate' =>
                    $validated['daily_rate'] ?? 0,

                'overtime_rate' =>
                    $validated['overtime_rate'] ?? 0,

                'late_deduction_rate' =>
                    $validated['late_deduction_rate'] ?? 0,

                'undertime_deduction_rate' =>
                    $validated['undertime_deduction_rate'] ?? 0,

                'sss' =>
                    $validated['sss'] ?? 0,

                'philhealth' =>
                    $validated['philhealth'] ?? 0,

                'pagibig' =>
                    $validated['pagibig'] ?? 0,

                'hmo' =>
                    $validated['hmo'] ?? 0,

                'honorarium' =>
                    $honorarium,

                'teaching_load_units_taken' =>
                    $validated['teaching_load_units_taken'] ?? 0,

                'teaching_load_unit_required' =>
                    $teachingLoadRequiredUnit,

                'teaching_load_price' =>
                    $teachingLoadPrice,

                'teaching_load' =>
                    0,

                'use_department_default' =>
                    false,
            ]
        );


        return response()->json([

            'success' =>
                true,

            'message' =>
                'Employee salary configuration saved successfully.',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Save Department Default Salary Configuration
    |--------------------------------------------------------------------------
    */

    public function saveDepartmentConfig(Request $request)
    {
        $validated = $request->validate([

            'department' =>
                'required|string',

            'default_basic_salary' =>
                'required|numeric|min:0',

            'daily_rate' =>
                'nullable|numeric|min:0',

            'overtime_rate' =>
                'nullable|numeric|min:0',

            'late_deduction_rate' =>
                'nullable|numeric|min:0',

            'undertime_deduction_rate' =>
                'nullable|numeric|min:0',

            'payroll_period' =>
                'required|in:Monthly,Every 15 Days,Weekly',

            'sss' =>
                'nullable|numeric|min:0',

            'philhealth' =>
                'nullable|numeric|min:0',

            'pagibig' =>
                'nullable|numeric|min:0',

            'hmo' =>
                'nullable|numeric|min:0',

            'honorarium' =>
                'nullable|numeric|min:0',

            'teaching_load_unit_required' =>
                'required|integer|min:0',

            'teaching_load_price' =>
                'nullable|numeric|min:0',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Save Department Default
        |--------------------------------------------------------------------------
        */

        $departmentConfig =
            DepartmentSalaryConfig::updateOrCreate(

                [
                    'department' =>
                        $validated['department'],
                ],

                [

                    'default_basic_salary' =>
                        $validated['default_basic_salary'],

                    'daily_rate' =>
                        $validated['daily_rate'] ?? 0,

                    'overtime_rate' =>
                        $validated['overtime_rate'] ?? 0,

                    'late_deduction_rate' =>
                        $validated['late_deduction_rate'] ?? 0,

                    'undertime_deduction_rate' =>
                        $validated['undertime_deduction_rate'] ?? 0,

                    'payroll_period' =>
                        $validated['payroll_period'],

                    'sss' =>
                        $validated['sss'] ?? 0,

                    'philhealth' =>
                        $validated['philhealth'] ?? 0,

                    'pagibig' =>
                        $validated['pagibig'] ?? 0,

                    'hmo' =>
                        $validated['hmo'] ?? 0,

                    'honorarium' =>
                        $validated['honorarium'] ?? 0,

                    'teaching_load_unit_required' =>
                        $validated['teaching_load_unit_required'],

                    'teaching_load_price' =>
                        $validated['teaching_load_price'] ?? 0,
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | Synchronize Existing Employees
        |--------------------------------------------------------------------------
        */

        $employees =
            User::where(
                'role',
                'employee'
            )
                ->where(
                    'department',
                    $validated['department']
                )
                ->get();


        foreach ($employees as $employee) {

            $employeeConfig =
                EmployeeSalaryConfig::where(
                    'user_id',
                    $employee->id
                )->first();


            if (!$employeeConfig) {

                EmployeeSalaryConfig::create([

                    'user_id' =>
                        $employee->id,

                    'basic_salary' =>
                        $departmentConfig
                            ->default_basic_salary
                            ?? 0,

                    'payroll_period' =>
                        $departmentConfig
                            ->payroll_period
                            ?? 'Every 15 Days',

                    'daily_rate' =>
                        $departmentConfig
                            ->daily_rate
                            ?? 0,

                    'overtime_rate' =>
                        $departmentConfig
                            ->overtime_rate
                            ?? 0,

                    'late_deduction_rate' =>
                        $departmentConfig
                            ->late_deduction_rate
                            ?? 0,

                    'undertime_deduction_rate' =>
                        $departmentConfig
                            ->undertime_deduction_rate
                            ?? 0,

                    'sss' =>
                        $departmentConfig
                            ->sss
                            ?? 0,

                    'philhealth' =>
                        $departmentConfig
                            ->philhealth
                            ?? 0,

                    'pagibig' =>
                        $departmentConfig
                            ->pagibig
                            ?? 0,

                    'hmo' =>
                        $departmentConfig
                            ->hmo
                            ?? 0,

                    'honorarium' =>
                        $departmentConfig
                            ->honorarium
                            ?? 0,

                    'teaching_load_units_taken' =>
                        0,

                    'teaching_load_unit_required' =>
                        $departmentConfig
                            ->teaching_load_unit_required
                            ?? 0,

                    'teaching_load_price' =>
                        $departmentConfig
                            ->teaching_load_price
                            ?? 0,

                    'teaching_load' =>
                        0,

                    'use_department_default' =>
                        true,
                ]);

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Synchronize Teaching Load
            |--------------------------------------------------------------------------
            */

            $employeeConfig->teaching_load_unit_required =
                $departmentConfig
                    ->teaching_load_unit_required
                    ?? 0;


            $employeeConfig->teaching_load_price =
                $departmentConfig
                    ->teaching_load_price
                    ?? 0;


            /*
            |--------------------------------------------------------------------------
            | Synchronize Department Defaults
            |--------------------------------------------------------------------------
            */

            if (
                $employeeConfig->use_department_default
                === true
            ) {

                $employeeConfig->basic_salary =
                    $departmentConfig
                        ->default_basic_salary
                        ?? 0;

                $employeeConfig->payroll_period =
                    $departmentConfig
                        ->payroll_period
                        ?? 'Every 15 Days';

                $employeeConfig->daily_rate =
                    $departmentConfig
                        ->daily_rate
                        ?? 0;

                $employeeConfig->overtime_rate =
                    $departmentConfig
                        ->overtime_rate
                        ?? 0;

                $employeeConfig->late_deduction_rate =
                    $departmentConfig
                        ->late_deduction_rate
                        ?? 0;

                $employeeConfig->undertime_deduction_rate =
                    $departmentConfig
                        ->undertime_deduction_rate
                        ?? 0;

                $employeeConfig->sss =
                    $departmentConfig
                        ->sss
                        ?? 0;

                $employeeConfig->philhealth =
                    $departmentConfig
                        ->philhealth
                        ?? 0;

                $employeeConfig->pagibig =
                    $departmentConfig
                        ->pagibig
                        ?? 0;

                $employeeConfig->hmo =
                    $departmentConfig
                        ->hmo
                        ?? 0;

                $employeeConfig->honorarium =
                    $departmentConfig
                        ->honorarium
                        ?? 0;
            }


            $employeeConfig->save();
        }


        return response()->json([

            'success' =>
                true,

            'message' =>
                'Department payroll configuration saved successfully and employee configurations were synchronized.',

            'teaching_load_unit_required' =>
                (int) (
                    $departmentConfig
                        ->teaching_load_unit_required
                    ?? 0
                ),

            'teaching_load_price' =>
                (float) (
                    $departmentConfig
                        ->teaching_load_price
                    ?? 0
                ),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Get Employees
    |--------------------------------------------------------------------------
    */

    public function getEmployees(Request $request)
    {
        $departments = $request->departments;

        if (!is_array($departments)) {
            $departments = [$departments];
        }

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


    /*
    |--------------------------------------------------------------------------
    | Calculate Payroll
    |--------------------------------------------------------------------------
    */

    private function calculatePayroll(
        User $employee,
        $config,
        $periodStart,
        $periodEnd
    ) {

        /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

        $attendance = Attendance::where(
            'user_id',
            $employee->id
        )
            ->whereBetween(
                'date',
                [
                    $periodStart,
                    $periodEnd
                ]
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Worked Days
        |--------------------------------------------------------------------------
        |
        | An employee is considered to have worked if they have
        | either morning or afternoon time-in.
        |
        */

        $workedAttendance =
            $attendance->filter(
                function ($record) {

                    return
                        !empty(
                            $record->morning_time_in
                        )
                        ||
                        !empty(
                            $record->afternoon_time_in
                        );
                }
            );


        $presentDays =
            $workedAttendance->count();


        /*
        |--------------------------------------------------------------------------
        | Daily Rate
        |--------------------------------------------------------------------------
        */

        $dailyRate =
            (float) (
                $config->daily_rate ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | HOLIDAY CONFIGURATION
        |--------------------------------------------------------------------------
        |
        | Get active holidays that fall inside the payroll period.
        |
        */

        $holidays = Holiday::whereBetween(
            'holiday_date',
            [
                $periodStart,
                $periodEnd
            ]
        )
            ->where(
                'is_active',
                true
            )
            ->where(
                function ($query) use ($employee) {

                    $query
                        ->whereNull('department')
                        ->orWhere(
                            'department',
                            ''
                        )
                        ->orWhere(
                            'department',
                            $employee->department
                        );
                }
            )
            ->get()
            ->keyBy(
                function ($holiday) {

                    return Carbon::parse(
                        $holiday->holiday_date
                    )->format('Y-m-d');
                }
            );


        /*
        |--------------------------------------------------------------------------
        | Total Holidays
        |--------------------------------------------------------------------------
        */

        $totalHolidays =
            $holidays->count();


        /*
        |--------------------------------------------------------------------------
        | WORKED HOLIDAY ATTENDANCE
        |--------------------------------------------------------------------------
        |
        | IMPORTANT FIX:
        |
        | We DO NOT depend only on the attendance status.
        |
        | The employee may have:
        |
        |     status = Present
        |
        | while the date itself is a configured holiday.
        |
        | Therefore we determine whether the employee worked by
        | checking their actual time-in and then matching the date
        | against the Holiday table.
        |
        */

        $workedHolidayAttendance =
            $workedAttendance->filter(
                function ($record) use ($holidays) {

                    $attendanceDate =
                        Carbon::parse(
                            $record->date
                        )->format('Y-m-d');


                    return $holidays->has(
                        $attendanceDate
                    );
                }
            );


        /*
        |--------------------------------------------------------------------------
        | Worked Holiday Days
        |--------------------------------------------------------------------------
        */

        $workedHolidayDays =
            $workedHolidayAttendance->count();


        /*
        |--------------------------------------------------------------------------
        | HOLIDAY PAY
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | Daily Rate = ₱1,000
        |
        | Holiday pay rate = 200
        |
        | Holiday Pay:
        |
        | ₱1,000 × (200 / 100)
        | = ₱2,000
        |
        |--------------------------------------------------------------------------
        */

        $holidayPay = 0;

        $holidayDatesWorked = [];


        foreach (
            $workedHolidayAttendance
            as $record
        ) {

            /*
            |--------------------------------------------------------------------------
            | Normalize Attendance Date
            |--------------------------------------------------------------------------
            */

            $attendanceDate =
                Carbon::parse(
                    $record->date
                )->format('Y-m-d');


            /*
            |--------------------------------------------------------------------------
            | Find Matching Holiday
            |--------------------------------------------------------------------------
            */

            $holiday =
                $holidays->get(
                    $attendanceDate
                );


            /*
            |--------------------------------------------------------------------------
            | Safety Check
            |--------------------------------------------------------------------------
            */

            if (!$holiday) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Payment
            |--------------------------------------------------------------------------
            |
            | This is important because there could theoretically
            | be more than one attendance record for the same date.
            |
            */

            if (
                in_array(
                    $attendanceDate,
                    $holidayDatesWorked
                )
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Mark Holiday As Worked
            |--------------------------------------------------------------------------
            */

            $holidayDatesWorked[] =
                $attendanceDate;


            /*
            |--------------------------------------------------------------------------
            | Read Holiday Rate
            |--------------------------------------------------------------------------
            */

            $holidayRate =
                (float) (
                    $holiday->pay_rate ?? 100
                );


            /*
            |--------------------------------------------------------------------------
            | Convert Percentage To Multiplier
            |--------------------------------------------------------------------------
            |
            | 100 = 1.00
            | 125 = 1.25
            | 150 = 1.50
            | 200 = 2.00
            | 250 = 2.50
            |
            */

            $holidayMultiplier =
                $holidayRate / 100;


            /*
            |--------------------------------------------------------------------------
            | Calculate Holiday Pay
            |--------------------------------------------------------------------------
            */

            $holidayDayPay =
                $dailyRate *
                $holidayMultiplier;


            /*
            |--------------------------------------------------------------------------
            | Add To Total Holiday Pay
            |--------------------------------------------------------------------------
            */

            $holidayPay +=
                $holidayDayPay;
        }


        /*
        |--------------------------------------------------------------------------
        | Normal Basic Pay
        |--------------------------------------------------------------------------
        |
        | Worked holidays are removed from normal basic pay because
        | holidayPay already contains the total pay for those days.
        |
        */

        $normalWorkedDays =
            $presentDays -
            count($holidayDatesWorked);


        if ($normalWorkedDays < 0) {
            $normalWorkedDays = 0;
        }


        $basicPay =
            $dailyRate *
            $normalWorkedDays;


        /*
        |--------------------------------------------------------------------------
        | Attendance Minutes
        |--------------------------------------------------------------------------
        */

        $lateMinutes =
            (int) $attendance->sum(
                'late_minutes'
            );


        $undertimeMinutes =
            (int) $attendance->sum(
                'undertime_minutes'
            );


        $overtimeMinutes =
            (int) $attendance->sum(
                'overtime_minutes'
            );


        /*
        |--------------------------------------------------------------------------
        | Overtime Rate
        |--------------------------------------------------------------------------
        */

        $overtimeRate =
            (float) (
                $config->overtime_rate ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | Overtime Hours
        |--------------------------------------------------------------------------
        */

        $overtimeHours =
            $overtimeMinutes / 60;


        /*
        |--------------------------------------------------------------------------
        | Overtime Pay
        |--------------------------------------------------------------------------
        */

        $overtimePay =
            $overtimeHours *
            $overtimeRate;


        /*
        |--------------------------------------------------------------------------
        | Honorarium
        |--------------------------------------------------------------------------
        */

        $honorarium =
            (float) (
                $config->honorarium ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | Department Teaching Load Configuration
        |--------------------------------------------------------------------------
        */

        $departmentConfig =
            DepartmentSalaryConfig::where(
                'department',
                $employee->department
            )->first();


        /*
        |--------------------------------------------------------------------------
        | Required Teaching Units
        |--------------------------------------------------------------------------
        */

        $teachingLoadRequiredUnit =
            (int) (
                $departmentConfig
                    ->teaching_load_unit_required
                ??
                $config->teaching_load_unit_required
                ??
                0
            );


        /*
        |--------------------------------------------------------------------------
        | Teaching Load Price
        |--------------------------------------------------------------------------
        */

        $teachingLoadPrice =
            (float) (
                $departmentConfig
                    ->teaching_load_price
                ??
                $config->teaching_load_price
                ??
                0
            );


        /*
        |--------------------------------------------------------------------------
        | Employee Additional Teaching Units
        |--------------------------------------------------------------------------
        */

        $additionalTeachingUnits =
            (int) (
                $config->teaching_load_units_taken
                ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | Teaching Load
        |--------------------------------------------------------------------------
        */

        if (
            $additionalTeachingUnits > 0
            &&
            $teachingLoadRequiredUnit > 0
            &&
            $teachingLoadPrice > 0
        ) {

            $fullTeachingLoadPay =
                (
                    $additionalTeachingUnits
                    /
                    $teachingLoadRequiredUnit
                )
                *
                $teachingLoadPrice;


            $teachingLoad =
                $fullTeachingLoadPay / 2;

        } else {

            $teachingLoad = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Gross Salary
        |--------------------------------------------------------------------------
        */

        $grossSalary =
            $basicPay
            + $holidayPay
            + $overtimePay
            + $honorarium
            + $teachingLoad;


        /*
        |--------------------------------------------------------------------------
        | Benefits
        |--------------------------------------------------------------------------
        */

        $sss =
            (float) (
                $config->sss ?? 0
            );


        $philhealth =
            (float) (
                $config->philhealth ?? 0
            );


        $pagibig =
            (float) (
                $config->pagibig ?? 0
            );


        $hmo =
            (float) (
                $config->hmo ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | 15-Day Benefits
        |--------------------------------------------------------------------------
        */

        $benefits =
            (
                $sss
                + $philhealth
                + $pagibig
                + $hmo
            ) / 2;


        /*
        |--------------------------------------------------------------------------
        | Late Deduction
        |--------------------------------------------------------------------------
        */

        $lateDeductionRate =
            (float) (
                $config->late_deduction_rate ?? 0
            );


        $lateDeduction =
            $lateMinutes *
            $lateDeductionRate;


        /*
        |--------------------------------------------------------------------------
        | Undertime Deduction
        |--------------------------------------------------------------------------
        */

        $undertimeDeductionRate =
            (float) (
                $config->undertime_deduction_rate ?? 0
            );


        $undertimeDeduction =
            $undertimeMinutes *
            $undertimeDeductionRate;


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


        /*
        |--------------------------------------------------------------------------
        | Return Calculation
        |--------------------------------------------------------------------------
        */

        return [

            'attendance' =>
                $attendance,

            'present_days' =>
                $presentDays,

            'worked_holidays' =>
                $workedHolidayDays,

            'total_holidays' =>
                $totalHolidays,

            'late_minutes' =>
                $lateMinutes,

            'undertime_minutes' =>
                $undertimeMinutes,

            'overtime_minutes' =>
                $overtimeMinutes,

            'overtime_hours' =>
                round(
                    $overtimeHours,
                    2
                ),

            'overtime_rate' =>
                $overtimeRate,

            'overtime_pay' =>
                round(
                    $overtimePay,
                    2
                ),

            'daily_rate' =>
                $dailyRate,


            /*
            |--------------------------------------------------------------------------
            | Holiday Information
            |--------------------------------------------------------------------------
            */

            'holiday_pay' =>
                round(
                    $holidayPay,
                    2
                ),

            'holiday_dates_worked' =>
                $holidayDatesWorked,


            /*
            |--------------------------------------------------------------------------
            | Teaching Load
            |--------------------------------------------------------------------------
            */

            'teaching_load_units' =>
                $additionalTeachingUnits,

            'teaching_load_required_unit' =>
                $teachingLoadRequiredUnit,

            'teaching_load_rate' =>
                round(
                    $teachingLoadPrice,
                    2
                ),

            'teaching_load' =>
                round(
                    $teachingLoad,
                    2
                ),


            /*
            |--------------------------------------------------------------------------
            | Earnings
            |--------------------------------------------------------------------------
            */

            'basic_pay' =>
                round(
                    $basicPay,
                    2
                ),

            'honorarium' =>
                round(
                    $honorarium,
                    2
                ),


            /*
            |--------------------------------------------------------------------------
            | Benefits
            |--------------------------------------------------------------------------
            */

            'sss' =>
                $sss,

            'philhealth' =>
                $philhealth,

            'pagibig' =>
                $pagibig,

            'hmo' =>
                $hmo,


            /*
            |--------------------------------------------------------------------------
            | Deductions
            |--------------------------------------------------------------------------
            */

            'late_deduction_rate' =>
                $lateDeductionRate,

            'undertime_deduction_rate' =>
                $undertimeDeductionRate,

            'late_deduction' =>
                round(
                    $lateDeduction,
                    2
                ),

            'undertime_deduction' =>
                round(
                    $undertimeDeduction,
                    2
                ),


            /*
            |--------------------------------------------------------------------------
            | Totals
            |--------------------------------------------------------------------------
            */

            'gross_salary' =>
                round(
                    $grossSalary,
                    2
                ),

            'benefits' =>
                round(
                    $benefits,
                    2
                ),

            'net_salary' =>
                round(
                    $netSalary,
                    2
                ),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Payroll
    |--------------------------------------------------------------------------
    */

    public function previewPayroll(Request $request)
    {
        $request->validate([

            'period_start' =>
                'required|date',

            'period_end' =>
                'required|date',

            'employees' =>
                'required|array',

        ]);


        $preview = [];


        foreach (
            $request->employees
            as $employeeId
        ) {

            $employee =
                User::with(
                    'salaryConfig'
                )->find(
                    $employeeId
                );


            if (!$employee) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Employee Salary Configuration
            |--------------------------------------------------------------------------
            */

            $config =
                $employee->salaryConfig;


            if (!$config) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Calculate Payroll
            |--------------------------------------------------------------------------
            */

            $calculation =
                $this->calculatePayroll(
                    $employee,
                    $config,
                    $request->period_start,
                    $request->period_end
                );


            /*
            |--------------------------------------------------------------------------
            | Preview Data
            |--------------------------------------------------------------------------
            */

            $preview[] = [

                /*
                |--------------------------------------------------------------------------
                | Employee Information
                |--------------------------------------------------------------------------
                */

                'id' =>
                    $employee->id,

                'name' =>
                    trim(
                        $employee->first_name
                        . ' '
                        . $employee->last_name
                    ),

                'department' =>
                    $employee->department,


                /*
                |--------------------------------------------------------------------------
                | Salary Configuration
                |--------------------------------------------------------------------------
                */

                'basic_salary' =>
                    (float) (
                        $config->basic_salary ?? 0
                    ),

                'daily_rate' =>
                    $calculation['daily_rate'],


                /*
                |--------------------------------------------------------------------------
                | Attendance
                |--------------------------------------------------------------------------
                */

                'total_attendance' =>
                    $calculation['present_days'],

                'present_days' =>
                    $calculation['present_days'],

                'total_holidays' =>
                    $calculation['total_holidays'],

                'worked_holidays' =>
                    $calculation['worked_holidays'],

                'late_minutes' =>
                    $calculation['late_minutes'],

                'undertime_minutes' =>
                    $calculation['undertime_minutes'],

                'overtime_minutes' =>
                    $calculation['overtime_minutes'],

                'overtime_hours' =>
                    $calculation['overtime_hours'],


                /*
                |--------------------------------------------------------------------------
                | Pay Rates
                |--------------------------------------------------------------------------
                */

                'overtime_rate' =>
                    $calculation['overtime_rate'],

                'late_deduction_rate' =>
                    $calculation['late_deduction_rate'],

                'undertime_deduction_rate' =>
                    $calculation['undertime_deduction_rate'],


                /*
                |--------------------------------------------------------------------------
                | Earnings
                |--------------------------------------------------------------------------
                */

                'basic_pay' =>
                    $calculation['basic_pay'],

                'holiday_pay' =>
                    $calculation['holiday_pay'],

                'overtime_pay' =>
                    $calculation['overtime_pay'],

                'honorarium' =>
                    $calculation['honorarium'],


                /*
                |--------------------------------------------------------------------------
                | Teaching Load
                |--------------------------------------------------------------------------
                */

                'teaching_load_units' =>
                    $calculation['teaching_load_units'],

                'teaching_load_required_unit' =>
                    $calculation['teaching_load_required_unit'],

                'teaching_load_rate' =>
                    $calculation['teaching_load_rate'],

                'teaching_load' =>
                    $calculation['teaching_load'],


                /*
                |--------------------------------------------------------------------------
                | Benefits
                |--------------------------------------------------------------------------
                */

                'benefits' =>
                    $calculation['benefits'],


                /*
                |--------------------------------------------------------------------------
                | Deductions
                |--------------------------------------------------------------------------
                */

                'late_deduction' =>
                    $calculation['late_deduction'],

                'undertime_deduction' =>
                    $calculation['undertime_deduction'],


                /*
                |--------------------------------------------------------------------------
                | Totals
                |--------------------------------------------------------------------------
                */

                'gross_salary' =>
                    $calculation['gross_salary'],

                'net_salary' =>
                    $calculation['net_salary'],
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Return Preview
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' =>
                true,

            'preview' =>
                $preview,

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Payslips
    |--------------------------------------------------------------------------
    */

    public function generatePayslips(Request $request)
    {
        $request->validate([

            'period_start' =>
                'required|date',

            'period_end' =>
                'required|date',

            'employees' =>
                'required|array',
        ]);


        $generated = 0;

        $skipped = 0;


        foreach (
            $request->employees
            as $employeeId
        ) {

            $employee =
                User::with(
                    'salaryConfig'
                )->find(
                    $employeeId
                );


            if (!$employee) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Payslip
            |--------------------------------------------------------------------------
            */

            $existingPayslip =
                Payslip::where(
                    'user_id',
                    $employeeId
                )
                    ->where(
                        'period_start',
                        $request->period_start
                    )
                    ->where(
                        'period_end',
                        $request->period_end
                    )
                    ->exists();


            if ($existingPayslip) {

                $skipped++;

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Salary Configuration
            |--------------------------------------------------------------------------
            */

            $config =
                $employee->salaryConfig;


            if (!$config) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Calculate Payroll
            |--------------------------------------------------------------------------
            */

            $calculation =
                $this->calculatePayroll(
                    $employee,
                    $config,
                    $request->period_start,
                    $request->period_end
                );


            /*
            |--------------------------------------------------------------------------
            | Create Payslip
            |--------------------------------------------------------------------------
            */

            Payslip::create([

                'user_id' =>
                    $employee->id,

                'period_start' =>
                    $request->period_start,

                'period_end' =>
                    $request->period_end,

                'present_days' =>
                    $calculation['present_days'],

                'worked_holidays' =>
                    $calculation['worked_holidays'],

                'late_minutes' =>
                    $calculation['late_minutes'],

                'undertime_minutes' =>
                    $calculation['undertime_minutes'],

                'overtime_minutes' =>
                    $calculation['overtime_minutes'],

                'overtime_hours' =>
                    $calculation['overtime_hours'],

                'daily_rate' =>
                    $calculation['daily_rate'],

                'holiday_pay' =>
                    $calculation['holiday_pay'],

                'ot' =>
                    $calculation['overtime_pay'],

                'honorarium' =>
                    $calculation['honorarium'],

                'teaching_load' =>
                    $calculation['teaching_load'],

                'sss' =>
                    $calculation['sss'],

                'philhealth' =>
                    $calculation['philhealth'],

                'pagibig' =>
                    $calculation['pagibig'],

                'hmo' =>
                    $calculation['hmo'],

                'late_deduction' =>
                    $calculation['late_deduction'],

                'undertime_deduction' =>
                    $calculation['undertime_deduction'],

                'gross_salary' =>
                    $calculation['gross_salary'],

                'benefits' =>
                    $calculation['benefits'],

                'net_salary' =>
                    $calculation['net_salary'],

                'status' =>
                    'Generated',
            ]);


            $generated++;
        }


        return response()->json([

            'success' =>
                true,

            'generated' =>
                $generated,

            'skipped' =>
                $skipped,

            'message' =>
                $generated .
                ' payslip(s) generated successfully.',
        ]);
    }
}
