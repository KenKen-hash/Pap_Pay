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
use App\Models\AdditionalEarning;
use App\Models\TeachingLoad;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        $employees = User::with([
            'salaryConfig'
        ])
            ->where('role', 'employee')
            ->where('department', $department)
            ->orderBy('last_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Load All Existing Additional Earnings
        |--------------------------------------------------------------------------
        */

        $employeeIds = $employees->pluck('id');


        $additionalEarnings = AdditionalEarning::whereIn(
            'user_id',
            $employeeIds
        )
            ->orderBy('id')
            ->get()
            ->groupBy('user_id');


        /*
        |--------------------------------------------------------------------------
        | Load All Existing Teaching Loads
        |--------------------------------------------------------------------------
        */

        $teachingLoads = TeachingLoad::whereIn(
            'user_id',
            $employeeIds
        )
            ->orderBy('id')
            ->get()
            ->groupBy('user_id');


        /*
        |--------------------------------------------------------------------------
        | Attach Configured Entries To Each Employee
        |--------------------------------------------------------------------------
        |
        | This keeps compatibility with any existing Blade code that accesses:
        |
        | $employee->additionalEarnings
        | $employee->teachingLoads
        |
        */

        foreach ($employees as $employee) {

            $employee->additionalEarnings =
                $additionalEarnings->get(
                    $employee->id,
                    collect()
                );

            $employee->teachingLoads =
                $teachingLoads->get(
                    $employee->id,
                    collect()
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Department View
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Pass Existing Entries To Blade
        |--------------------------------------------------------------------------
        */

        return view(
            $view,
            compact(
                'department',
                'employees',
                'departmentConfig',
                'additionalEarnings',
                'teachingLoads'
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

            /*
            |--------------------------------------------------------------------------
            | Browser compatibility fields
            |--------------------------------------------------------------------------
            */

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


            /*
            |--------------------------------------------------------------------------
            | Multiple Additional Earnings
            |--------------------------------------------------------------------------
            */

            'additional_earnings' =>
                'nullable|array',

            'additional_earnings.*.amount' =>
                'required|numeric|min:0',

            'additional_earnings.*.remarks' =>
                'nullable|string|max:1000',


            /*
            |--------------------------------------------------------------------------
            | Multiple Teaching Loads
            |--------------------------------------------------------------------------
            */

            'teaching_loads' =>
                'nullable|array',

            'teaching_loads.*.department' =>
                'required|in:Elementary,JHS,SHS,College',

            'teaching_loads.*.subject' =>
                'required|string|max:255',

            'teaching_loads.*.units' =>
                'nullable|integer|min:0',

            'teaching_loads.*.rate' =>
                'required|numeric|min:0',

            'teaching_loads.*.remarks' =>
                'nullable|string|max:1000',


            /*
            |--------------------------------------------------------------------------
            | Legacy Fields
            |--------------------------------------------------------------------------
            */

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
        | Get Department Default
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
                    $departmentConfig->teaching_load_unit_required
                    ?? 0
                );

            $teachingLoadPrice =
                (float) (
                    $departmentConfig->teaching_load_price
                    ?? 0
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Legacy Honorarium
        |--------------------------------------------------------------------------
        */

        $honorarium =
            isset($validated['honorarium'])
                ? (float) $validated['honorarium']
                : 0;


        /*
        |--------------------------------------------------------------------------
        | Save Everything In One Transaction
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $departmentConfig,
            $teachingLoadRequiredUnit,
            $teachingLoadPrice,
            $honorarium
        ) {

            /*
            |--------------------------------------------------------------------------
            | Basic Salary
            |--------------------------------------------------------------------------
            */

            $basicSalary =
                (float) (
                    $validated['basic_salary'] ?? 0
                );


            /*
            |--------------------------------------------------------------------------
            | Automatic Daily Rate
            |--------------------------------------------------------------------------
            */

            $dailyRate =
                $basicSalary / 26;


            /*
            |--------------------------------------------------------------------------
            | Automatic Overtime Rate
            |--------------------------------------------------------------------------
            */

            $overtimeRate =
                $dailyRate / 8;


            /*
            |--------------------------------------------------------------------------
            | Payroll Period
            |--------------------------------------------------------------------------
            */

            $payrollPeriod =
                $validated['payroll_period']
                ??
                (
                    $departmentConfig->payroll_period
                    ?? 'Every 15 Days'
                );


            /*
            |--------------------------------------------------------------------------
            | Save Employee Salary Configuration
            |--------------------------------------------------------------------------
            */

            EmployeeSalaryConfig::updateOrCreate(
                [
                    'user_id' =>
                        $validated['user_id'],
                ],
                [
                    'basic_salary' =>
                        $basicSalary,

                    'payroll_period' =>
                        $payrollPeriod,

                    'daily_rate' =>
                        round(
                            $dailyRate,
                            2
                        ),

                    'overtime_rate' =>
                        round(
                            $overtimeRate,
                            2
                        ),

                    'late_deduction_rate' =>
                        $validated['late_deduction_rate']
                        ?? 0,

                    'undertime_deduction_rate' =>
                        $validated['undertime_deduction_rate']
                        ?? 0,

                    'sss' =>
                        $validated['sss']
                        ?? 0,

                    'philhealth' =>
                        $validated['philhealth']
                        ?? 0,

                    'pagibig' =>
                        $validated['pagibig']
                        ?? 0,

                    'hmo' =>
                        $validated['hmo']
                        ?? 0,

                    /*
                    |--------------------------------------------------------------------------
                    | Legacy Fields
                    |--------------------------------------------------------------------------
                    */

                    'honorarium' =>
                        $honorarium,

                    'teaching_load_units_taken' =>
                        $validated['teaching_load_units_taken']
                        ?? 0,

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


            /*
            |--------------------------------------------------------------------------
            | Replace Existing Additional Earnings
            |--------------------------------------------------------------------------
            */

            AdditionalEarning::where(
                'user_id',
                $validated['user_id']
            )->delete();


            /*
            |--------------------------------------------------------------------------
            | Save Additional Earnings
            |--------------------------------------------------------------------------
            */

            foreach (
                $validated['additional_earnings'] ?? []
                as $earning
            ) {

                AdditionalEarning::create([
                    'user_id' =>
                        $validated['user_id'],

                    'amount' =>
                        (float) $earning['amount'],

                    'remarks' =>
                        $earning['remarks'] ?? null,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Replace Existing Teaching Loads
            |--------------------------------------------------------------------------
            */

            TeachingLoad::where(
                'user_id',
                $validated['user_id']
            )->delete();


            /*
            |--------------------------------------------------------------------------
            | Save Multiple Teaching Loads
            |--------------------------------------------------------------------------
            */

            foreach (
                $validated['teaching_loads'] ?? []
                as $teachingLoad
            ) {

                TeachingLoad::create([
                    'user_id' =>
                        $validated['user_id'],

                    'department' =>
                        $teachingLoad['department'],

                    'subject' =>
                        $teachingLoad['subject'],

                    /*
                    |--------------------------------------------------------------------------
                    | Units
                    |--------------------------------------------------------------------------
                    */

                    'units' =>
                        (int) (
                            $teachingLoad['units']
                            ?? 0
                        ),

                    'rate' =>
                        (float) $teachingLoad['rate'],

                    'remarks' =>
                        $teachingLoad['remarks'] ?? null,
                ]);
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Return Saved Additional Earnings
        |--------------------------------------------------------------------------
        */

        $savedAdditionalEarnings =
            AdditionalEarning::where(
                'user_id',
                $validated['user_id']
            )
                ->orderBy('id')
                ->get([
                    'id',
                    'user_id',
                    'amount',
                    'remarks',
                ]);


        /*
        |--------------------------------------------------------------------------
        | Return Saved Teaching Loads
        |--------------------------------------------------------------------------
        */

        $savedTeachingLoads =
            TeachingLoad::where(
                'user_id',
                $validated['user_id']
            )
                ->orderBy('id')
                ->get([
                    'id',
                    'user_id',
                    'department',
                    'subject',
                    'units',
                    'rate',
                    'remarks',
                ]);


        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' =>
                true,

            'message' =>
                'Employee salary configuration saved successfully.',

            'daily_rate' =>
                round(
                    (
                        (float) (
                            $validated['basic_salary'] ?? 0
                        )
                    ) / 26,
                    2
                ),

            'overtime_rate' =>
                round(
                    (
                        (
                            (float) (
                                $validated['basic_salary'] ?? 0
                            )
                        ) / 26
                    ) / 8,
                    2
                ),

            'additional_earnings' =>
                $savedAdditionalEarnings,

            'teaching_loads' =>
                $savedTeachingLoads,
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
        ]);


        /*
        |--------------------------------------------------------------------------
        | Find Existing Department Configuration
        |--------------------------------------------------------------------------
        */

        $departmentConfig =
            DepartmentSalaryConfig::where(
                'department',
                $validated['department']
            )->first();


        /*
        |--------------------------------------------------------------------------
        | Create New Department Configuration If Needed
        |--------------------------------------------------------------------------
        */

        if (!$departmentConfig) {

            $departmentConfig =
                new DepartmentSalaryConfig();

            $departmentConfig->department =
                $validated['department'];

            $departmentConfig->default_basic_salary = 0;
            $departmentConfig->daily_rate = 0;
            $departmentConfig->overtime_rate = 0;
            $departmentConfig->honorarium = 0;
            $departmentConfig->teaching_load_unit_required = 0;
            $departmentConfig->teaching_load_price = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Save Only Current Default Configuration Fields
        |--------------------------------------------------------------------------
        */

        $departmentConfig->late_deduction_rate =
            $validated['late_deduction_rate'] ?? 0;

        $departmentConfig->undertime_deduction_rate =
            $validated['undertime_deduction_rate'] ?? 0;

        $departmentConfig->payroll_period =
            $validated['payroll_period'];

        $departmentConfig->sss =
            $validated['sss'] ?? 0;

        $departmentConfig->philhealth =
            $validated['philhealth'] ?? 0;

        $departmentConfig->pagibig =
            $validated['pagibig'] ?? 0;

        $departmentConfig->hmo =
            $validated['hmo'] ?? 0;

        $departmentConfig->save();


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


            /*
            |--------------------------------------------------------------------------
            | Create Employee Configuration If None Exists
            |--------------------------------------------------------------------------
            */

            if (!$employeeConfig) {

                $defaultBasicSalary =
                    (float) (
                        $departmentConfig
                        ->default_basic_salary
                        ?? 0
                    );

                $dailyRate =
                    $defaultBasicSalary / 26;

                $overtimeRate =
                    $dailyRate / 8;


                EmployeeSalaryConfig::create([

                    'user_id' =>
                        $employee->id,

                    'basic_salary' =>
                        $defaultBasicSalary,

                    'payroll_period' =>
                        $departmentConfig
                        ->payroll_period
                        ??
                        'Every 15 Days',

                    'daily_rate' =>
                        round(
                            $dailyRate,
                            2
                        ),

                    'overtime_rate' =>
                        round(
                            $overtimeRate,
                            2
                        ),

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
            | Synchronize Legacy Teaching Load Values
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
            | Synchronize Department Defaults Only For Employees
            | Still Using Department Defaults
            |--------------------------------------------------------------------------
            */

            if (
                $employeeConfig->use_department_default
                === true
            ) {

                $defaultBasicSalary =
                    (float) (
                        $departmentConfig
                        ->default_basic_salary
                        ?? 0
                    );

                $dailyRate =
                    $defaultBasicSalary / 26;

                $overtimeRate =
                    $dailyRate / 8;


                $employeeConfig->basic_salary =
                    $defaultBasicSalary;

                $employeeConfig->payroll_period =
                    $departmentConfig
                    ->payroll_period
                    ??
                    'Every 15 Days';

                $employeeConfig->daily_rate =
                    round(
                        $dailyRate,
                        2
                    );

                $employeeConfig->overtime_rate =
                    round(
                        $overtimeRate,
                        2
                    );

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


        /*
        |--------------------------------------------------------------------------
        | Return Response
        |--------------------------------------------------------------------------
        */

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

        $employees = User::where(
            'role',
            'employee'
        )
            ->whereIn(
                'department',
                $departments
            )
            ->orderBy('last_name')
            ->get([
                'id',
                'employee_id',
                'first_name',
                'last_name',
                'department'
            ]);

        return response()->json(
            $employees
        );
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

        $attendance =
            Attendance::where(
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

        $basicSalary =
            (float) (
                $config->basic_salary ?? 0
            );


        $dailyRate =
            $basicSalary / 26;


        /*
        |--------------------------------------------------------------------------
        | Overtime Rate
        |--------------------------------------------------------------------------
        */

        $overtimeRate =
            $dailyRate / 8;


        /*
        |--------------------------------------------------------------------------
        | Holiday Configuration
        |--------------------------------------------------------------------------
        */

        $holidays =
            Holiday::whereBetween(
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
        | Worked Holiday Attendance
        |--------------------------------------------------------------------------
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
        | Holiday Pay
        |--------------------------------------------------------------------------
        */

        $holidayPay = 0;

        $holidayDatesWorked = [];


        foreach (
            $workedHolidayAttendance
            as $record
        ) {

            $attendanceDate =
                Carbon::parse(
                    $record->date
                )->format('Y-m-d');


            $holiday =
                $holidays->get(
                    $attendanceDate
                );


            if (!$holiday) {
                continue;
            }


            if (
                in_array(
                    $attendanceDate,
                    $holidayDatesWorked
                )
            ) {
                continue;
            }


            $holidayDatesWorked[] =
                $attendanceDate;


            $holidayRate =
                (float) (
                    $holiday->pay_rate ?? 100
                );


            $holidayMultiplier =
                $holidayRate / 100;


            $holidayDayPay =
                $dailyRate *
                $holidayMultiplier;


            $holidayPay +=
                $holidayDayPay;
        }


        /*
        |--------------------------------------------------------------------------
        | Normal Basic Pay
        |--------------------------------------------------------------------------
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
        | Overtime
        |--------------------------------------------------------------------------
        */

        $overtimeHours =
            $overtimeMinutes / 60;


        $overtimePay =
            $overtimeHours *
            $overtimeRate;


        /*
        |--------------------------------------------------------------------------
        | Legacy Honorarium
        |--------------------------------------------------------------------------
        */

        $honorarium =
            (float) (
                $config->honorarium ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | Multiple Additional Earnings
        |--------------------------------------------------------------------------
        */

        $additionalEarnings =
            AdditionalEarning::where(
                'user_id',
                $employee->id
            )
            ->orderBy('id')
            ->get();


        $additionalEarningsTotal =
            (float) $additionalEarnings->sum(
                'amount'
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
        | Legacy Required Teaching Units
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
        | Legacy Teaching Load Price
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
        | Legacy Additional Teaching Units
        |--------------------------------------------------------------------------
        */

        $additionalTeachingUnits =
            (int) (
                $config->teaching_load_units_taken
                ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | Legacy Teaching Load Calculation
        |--------------------------------------------------------------------------
        */

        $legacyTeachingLoad = 0;

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


            $legacyTeachingLoad =
                $fullTeachingLoadPay / 2;
        }


        /*
        |--------------------------------------------------------------------------
        | Multiple Additional Teaching Loads
        |--------------------------------------------------------------------------
        */

        $teachingLoads =
            TeachingLoad::where(
                'user_id',
                $employee->id
            )
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Calculate Multiple Teaching Load Pay
        |--------------------------------------------------------------------------
        */

        $teachingLoadRateTotal =
            (float) $teachingLoads->sum(
                'rate'
            );


        $additionalTeachingLoadPay =
            $teachingLoadRateTotal > 0
                ? $teachingLoadRateTotal / 2
                : 0;


        /*
        |--------------------------------------------------------------------------
        | Total Teaching Load Pay
        |--------------------------------------------------------------------------
        */

        $teachingLoad =
            $legacyTeachingLoad +
            $additionalTeachingLoadPay;


        /*
        |--------------------------------------------------------------------------
        | Total Teaching Load Rate
        |--------------------------------------------------------------------------
        */

        $totalTeachingLoadRate =
            $teachingLoadPrice +
            $teachingLoadRateTotal;


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
            + $additionalEarningsTotal
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
                round(
                    $overtimeRate,
                    2
                ),

            'overtime_pay' =>
                round(
                    $overtimePay,
                    2
                ),

            'daily_rate' =>
                round(
                    $dailyRate,
                    2
                ),

            'holiday_pay' =>
                round(
                    $holidayPay,
                    2
                ),

            'holiday_dates_worked' =>
                $holidayDatesWorked,

            'teaching_load_units' =>
                $additionalTeachingUnits,

            'teaching_load_required_unit' =>
                $teachingLoadRequiredUnit,

            'teaching_load_rate' =>
                round(
                    $totalTeachingLoadRate,
                    2
                ),

            'teaching_load' =>
                round(
                    $teachingLoad,
                    2
                ),

            'legacy_teaching_load' =>
                round(
                    $legacyTeachingLoad,
                    2
                ),

            'additional_teaching_load_pay' =>
                round(
                    $additionalTeachingLoadPay,
                    2
                ),

            'teaching_load_entries' =>
                $teachingLoads,

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

            'additional_earnings_total' =>
                round(
                    $additionalEarningsTotal,
                    2
                ),

            'additional_earnings' =>
                $additionalEarnings,

            'sss' =>
                $sss,

            'philhealth' =>
                $philhealth,

            'pagibig' =>
                $pagibig,

            'hmo' =>
                $hmo,

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


            $config =
                $employee->salaryConfig;


            if (!$config) {
                continue;
            }


            $calculation =
                $this->calculatePayroll(
                    $employee,
                    $config,
                    $request->period_start,
                    $request->period_end
                );


            $preview[] = [

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

                'basic_salary' =>
                    (float) (
                        $config->basic_salary ?? 0
                    ),

                'daily_rate' =>
                    $calculation['daily_rate'],

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

                'overtime_rate' =>
                    $calculation['overtime_rate'],

                'late_deduction_rate' =>
                    $calculation['late_deduction_rate'],

                'undertime_deduction_rate' =>
                    $calculation['undertime_deduction_rate'],

                'basic_pay' =>
                    $calculation['basic_pay'],

                'holiday_pay' =>
                    $calculation['holiday_pay'],

                'overtime_pay' =>
                    $calculation['overtime_pay'],

                'honorarium' =>
                    $calculation['honorarium'],

                'additional_earnings_total' =>
                    $calculation['additional_earnings_total'],

                'additional_earnings' =>
                    $calculation['additional_earnings'],

                'teaching_load_units' =>
                    $calculation['teaching_load_units'],

                'teaching_load_required_unit' =>
                    $calculation['teaching_load_required_unit'],

                'teaching_load_rate' =>
                    $calculation['teaching_load_rate'],

                'teaching_load' =>
                    $calculation['teaching_load'],

                'additional_teaching_load_pay' =>
                    $calculation['additional_teaching_load_pay'],

                'teaching_load_entries' =>
                    $calculation['teaching_load_entries'],

                'benefits' =>
                    $calculation['benefits'],

                'late_deduction' =>
                    $calculation['late_deduction'],

                'undertime_deduction' =>
                    $calculation['undertime_deduction'],

                'gross_salary' =>
                    $calculation['gross_salary'],

                'net_salary' =>
                    $calculation['net_salary'],
            ];
        }


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


            $config =
                $employee->salaryConfig;


            if (!$config) {
                continue;
            }


            $calculation =
                $this->calculatePayroll(
                    $employee,
                    $config,
                    $request->period_start,
                    $request->period_end
                );


            $totalHonorariumAndAdditional =
                $calculation['honorarium']
                +
                $calculation['additional_earnings_total'];


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
                    round(
                        $totalHonorariumAndAdditional,
                        2
                    ),

                'teaching_load_pay' =>
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
