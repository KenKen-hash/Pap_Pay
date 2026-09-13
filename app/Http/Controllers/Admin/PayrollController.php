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
    | PAYROLL INDEX
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
    | DEPARTMENT PAYROLL
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

        $employeeIds = $employees->pluck('id');

        $additionalEarnings = AdditionalEarning::whereIn(
            'user_id',
            $employeeIds
        )
            ->orderBy('id')
            ->get()
            ->groupBy('user_id');

        $teachingLoads = TeachingLoad::whereIn(
            'user_id',
            $employeeIds
        )
            ->orderBy('id')
            ->get()
            ->groupBy('user_id');

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
                'departmentConfig',
                'additionalEarnings',
                'teachingLoads'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE EMPLOYEE SALARY CONFIGURATION
    |--------------------------------------------------------------------------
    */

    public function save(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',

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

            'additional_earnings' =>
                'nullable|array',

            'additional_earnings.*.amount' =>
                'required|numeric|min:0',

            'additional_earnings.*.remarks' =>
                'nullable|string|max:1000',

            'teaching_loads' =>
                'nullable|array',

            'teaching_loads.*.department' =>
                'required|in:Elementary,JHS,SHS,College,Kindergarten,Nursery',

            'teaching_loads.*.subject' =>
                'required|string|max:255',

            'teaching_loads.*.units' =>
                'nullable|integer|min:0',

            'teaching_loads.*.rate' =>
                'required|numeric|min:0',

            'teaching_loads.*.remarks' =>
                'nullable|string|max:1000',

            'honorarium' =>
                'nullable|numeric|min:0',

            'teaching_load_units_taken' =>
                'nullable|integer|min:0',
        ]);

        $employee = User::findOrFail(
            $validated['user_id']
        );

        $departmentConfig =
            DepartmentSalaryConfig::where(
                'department',
                $employee->department
            )->first();

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

        $honorarium =
            max(
                0,
                (float) (
                    $validated['honorarium'] ?? 0
                )
            );

        DB::transaction(function () use (
            $validated,
            $departmentConfig,
            $teachingLoadRequiredUnit,
            $teachingLoadPrice,
            $honorarium,
            $employee
        ) {
            $basicSalary =
                max(
                    0,
                    (float) (
                        $validated['basic_salary'] ?? 0
                    )
                );

            $dailyRate =
                $basicSalary > 0
                    ? $basicSalary / 26
                    : 0;

            $overtimeRate =
                $dailyRate > 0
                    ? $dailyRate / 8
                    : 0;

            /*
             * Laborers are always weekly.
             * Other departments retain their configured period.
             */

            $payrollPeriod =
                $employee->department === 'Laborers'
                    ? 'Weekly'
                    : (
                        $validated['payroll_period']
                        ??
                        (
                            $departmentConfig->payroll_period
                            ?? 'Every 15 Days'
                        )
                    );

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
                        max(
                            0,
                            (float) (
                                $validated['late_deduction_rate']
                                ?? 0
                            )
                        ),

                    'undertime_deduction_rate' =>
                        max(
                            0,
                            (float) (
                                $validated['undertime_deduction_rate']
                                ?? 0
                            )
                        ),

                    'sss' =>
                        max(
                            0,
                            (float) (
                                $validated['sss']
                                ?? 0
                            )
                        ),

                    'philhealth' =>
                        max(
                            0,
                            (float) (
                                $validated['philhealth']
                                ?? 0
                            )
                        ),

                    'pagibig' =>
                        max(
                            0,
                            (float) (
                                $validated['pagibig']
                                ?? 0
                            )
                        ),

                    'hmo' =>
                        max(
                            0,
                            (float) (
                                $validated['hmo']
                                ?? 0
                            )
                        ),

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
             * Replace employee additional earnings.
             */

            AdditionalEarning::where(
                'user_id',
                $validated['user_id']
            )->delete();

            foreach (
                $validated['additional_earnings'] ?? []
                as $earning
            ) {
                AdditionalEarning::create([
                    'user_id' =>
                        $validated['user_id'],

                    'amount' =>
                        max(
                            0,
                            (float) (
                                $earning['amount']
                                ?? 0
                            )
                        ),

                    'remarks' =>
                        $earning['remarks']
                        ?? null,
                ]);
            }


            /*
             * Replace employee teaching loads.
             */

            TeachingLoad::where(
                'user_id',
                $validated['user_id']
            )->delete();

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

                    'units' =>
                        (int) (
                            $teachingLoad['units']
                            ?? 0
                        ),

                    'rate' =>
                        max(
                            0,
                            (float) (
                                $teachingLoad['rate']
                                ?? 0
                            )
                        ),

                    'remarks' =>
                        $teachingLoad['remarks']
                        ?? null,
                ]);
            }
        });


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


        $basicSalary =
            max(
                0,
                (float) (
                    $validated['basic_salary']
                    ?? 0
                )
            );

        $dailyRate =
            $basicSalary > 0
                ? $basicSalary / 26
                : 0;

        $overtimeRate =
            $dailyRate > 0
                ? $dailyRate / 8
                : 0;


        return response()->json([
            'success' =>
                true,

            'message' =>
                'Employee salary configuration saved successfully.',

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

            'payroll_period' =>
                $employee->department === 'Laborers'
                    ? 'Weekly'
                    : (
                        $validated['payroll_period']
                        ??
                        (
                            $departmentConfig->payroll_period
                            ?? 'Every 15 Days'
                        )
                    ),

            'additional_earnings' =>
                $savedAdditionalEarnings,

            'teaching_loads' =>
                $savedTeachingLoads,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE DEPARTMENT CONFIGURATION
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


        $departmentConfig =
            DepartmentSalaryConfig::where(
                'department',
                $validated['department']
            )->first();


        if (!$departmentConfig) {
            $departmentConfig =
                new DepartmentSalaryConfig();

            $departmentConfig->department =
                $validated['department'];

            $departmentConfig->default_basic_salary =
                0;

            $departmentConfig->daily_rate =
                0;

            $departmentConfig->overtime_rate =
                0;

            $departmentConfig->honorarium =
                0;

            $departmentConfig->teaching_load_unit_required =
                0;

            $departmentConfig->teaching_load_price =
                0;
        }


        $departmentConfig->late_deduction_rate =
            max(
                0,
                (float) (
                    $validated['late_deduction_rate']
                    ?? 0
                )
            );


        $departmentConfig->undertime_deduction_rate =
            max(
                0,
                (float) (
                    $validated['undertime_deduction_rate']
                    ?? 0
                )
            );


        /*
         * Laborers are always Weekly.
         * All other departments use their selected period.
         */

        $departmentConfig->payroll_period =
            $validated['department'] === 'Laborers'
                ? 'Weekly'
                : $validated['payroll_period'];


        $departmentConfig->sss =
            max(
                0,
                (float) (
                    $validated['sss']
                    ?? 0
                )
            );


        $departmentConfig->philhealth =
            max(
                0,
                (float) (
                    $validated['philhealth']
                    ?? 0
                )
            );


        $departmentConfig->pagibig =
            max(
                0,
                (float) (
                    $validated['pagibig']
                    ?? 0
                )
            );


        $departmentConfig->hmo =
            max(
                0,
                (float) (
                    $validated['hmo']
                    ?? 0
                )
            );


        $departmentConfig->save();


        /*
         * Synchronize employees that still use
         * department defaults.
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

                $defaultBasicSalary =
                    max(
                        0,
                        (float) (
                            $departmentConfig
                            ->default_basic_salary
                            ?? 0
                        )
                    );


                $dailyRate =
                    $defaultBasicSalary > 0
                        ? $defaultBasicSalary / 26
                        : 0;


                $overtimeRate =
                    $dailyRate > 0
                        ? $dailyRate / 8
                        : 0;


                EmployeeSalaryConfig::create([
                    'user_id' =>
                        $employee->id,

                    'basic_salary' =>
                        $defaultBasicSalary,

                    'payroll_period' =>
                        $departmentConfig->payroll_period
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


            $employeeConfig->teaching_load_unit_required =
                $departmentConfig
                ->teaching_load_unit_required
                ?? 0;


            $employeeConfig->teaching_load_price =
                $departmentConfig
                ->teaching_load_price
                ?? 0;


            if (
                $employeeConfig->use_department_default
                === true
            ) {

                $defaultBasicSalary =
                    max(
                        0,
                        (float) (
                            $departmentConfig
                            ->default_basic_salary
                            ?? 0
                        )
                    );


                $dailyRate =
                    $defaultBasicSalary > 0
                        ? $defaultBasicSalary / 26
                        : 0;


                $overtimeRate =
                    $dailyRate > 0
                        ? $dailyRate / 8
                        : 0;


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


            /*
             * Laborers remain Weekly even when their
             * employee configuration was previously saved.
             */

            if ($employee->department === 'Laborers') {
                $employeeConfig->payroll_period =
                    'Weekly';
            }


            $employeeConfig->save();
        }


        return response()->json([
            'success' =>
                true,

            'message' =>
                'Department payroll configuration saved successfully and employee configurations were synchronized.',

            'payroll_period' =>
                $departmentConfig->payroll_period,

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
    | GET EMPLOYEES
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
    | CALCULATE PAYROLL
    |--------------------------------------------------------------------------
    */

    private function calculatePayroll(
        User $employee,
        $config,
        $periodStart,
        $periodEnd
    ) {
        /*
         * IMPORTANT:
         *
         * The actual attendance table uses:
         *
         * user_id
         * date
         * time_in
         * time_out
         * hours_worked
         * late_minutes
         * undertime_minutes
         * overtime_minutes
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
            ->orderBy('date')
            ->get();


        /*
         * A worked attendance record is one with
         * an actual time_in.
         */

        $workedAttendance =
            $attendance->filter(
                function ($record) {

                    return !empty(
                        $record->time_in
                    );
                }
            );


        /*
         * Number of actual present attendance records.
         */

        $presentDays =
            $workedAttendance->count();


        /*
         * SAFE SALARY VALUES
         */

        $basicSalary =
            max(
                0,
                (float) (
                    $config->basic_salary
                    ?? 0
                )
            );


        $dailyRate =
            $basicSalary > 0
                ? $basicSalary / 26
                : 0;


        $overtimeRate =
            $dailyRate > 0
                ? $dailyRate / 8
                : 0;


        /*
         * HOLIDAYS
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


        $totalHolidays =
            $holidays->count();


        /*
         * HOLIDAY PAY
         */

        $holidayPay = 0;

        $holidayDatesWorked = [];


        foreach (
            $holidays as $holidayDate => $holiday
        ) {

            $holidayRate =
                max(
                    0,
                    (float) (
                        $holiday->pay_rate
                        ?? 100
                    )
                );


            $holidayMultiplier =
                $holidayRate / 100;


            $holidayAttendance =
                $workedAttendance->first(
                    function ($record) use (
                        $holidayDate
                    ) {

                        return Carbon::parse(
                            $record->date
                        )->format('Y-m-d')
                        ===
                        $holidayDate;
                    }
                );


            if ($holidayAttendance) {

                $holidayDatesWorked[] =
                    $holidayDate;


                $holidayPay +=
                    $dailyRate *
                    $holidayMultiplier;

            } else {

                $holidayPay +=
                    $dailyRate;
            }
        }


        $workedHolidayDays =
            count(
                $holidayDatesWorked
            );


        /*
         * Ordinary worked days exclude
         * worked holidays.
         */

        $normalWorkedDays =
            max(
                0,
                $presentDays -
                $workedHolidayDays
            );


        /*
         * BASIC PAY
         */

        $basicPay =
            $dailyRate *
            $normalWorkedDays;


        /*
         * ATTENDANCE MINUTES
         */

        $lateMinutes =
            max(
                0,
                (int) $attendance->sum(
                    'late_minutes'
                )
            );


        $undertimeMinutes =
            max(
                0,
                (int) $attendance->sum(
                    'undertime_minutes'
                )
            );


        $overtimeMinutes =
            max(
                0,
                (int) $attendance->sum(
                    'overtime_minutes'
                )
            );


        /*
         * OVERTIME
         */

        $overtimeHours =
            $overtimeMinutes / 60;


        $overtimePay =
            $overtimeHours *
            $overtimeRate;


        /*
         * LEGACY HONORARIUM
         */

        $honorarium =
            max(
                0,
                (float) (
                    $config->honorarium
                    ?? 0
                )
            );


        /*
         * ADDITIONAL EARNINGS
         */

        $additionalEarnings =
            AdditionalEarning::where(
                'user_id',
                $employee->id
            )
            ->orderBy('id')
            ->get();


        $additionalEarningsTotal =
            max(
                0,
                (float) (
                    $additionalEarnings->sum(
                        'amount'
                    )
                )
            );


        /*
         * DEPARTMENT CONFIGURATION
         */

        $departmentConfig =
            DepartmentSalaryConfig::where(
                'department',
                $employee->department
            )->first();


        $teachingLoadRequiredUnit =
            (int) (
                $departmentConfig
                ->teaching_load_unit_required
                ??
                $config->teaching_load_unit_required
                ??
                0
            );


        $teachingLoadPrice =
            max(
                0,
                (float) (
                    $departmentConfig
                    ->teaching_load_price
                    ??
                    $config->teaching_load_price
                    ??
                    0
                )
            );


        /*
         * LEGACY TEACHING LOAD
         */

        $additionalTeachingUnits =
            max(
                0,
                (int) (
                    $config->teaching_load_units_taken
                    ?? 0
                )
            );


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
         * ACTUAL MULTIPLE TEACHING LOAD ENTRIES
         */

        $teachingLoads =
            TeachingLoad::where(
                'user_id',
                $employee->id
            )
            ->orderBy('id')
            ->get();


        /*
         * IMPORTANT:
         *
         * Each TeachingLoad.rate is already
         * the configured amount for that entry.
         *
         * Units are NOT multiplied.
         *
         * Because payroll is every 15 days,
         * the configured rate is divided by 2.
         */

        $teachingLoadRateTotal =
            max(
                0,
                (float) (
                    $teachingLoads->sum(
                        'rate'
                    )
                )
            );


        /*
         * 15-DAY TEACHING LOAD PAY
         */

        $additionalTeachingLoadPay =
            $teachingLoadRateTotal > 0
                ? $teachingLoadRateTotal / 2
                : 0;


        /*
         * ACTUAL TEACHING LOAD
         */

        $teachingLoad =
            $additionalTeachingLoadPay;


        /*
         * ACTUAL TEACHING LOAD RATE
         */

        $totalTeachingLoadRate =
            $teachingLoadRateTotal;


        /*
         * TEACHING LOAD BREAKDOWN
         *
         * Each configured rate is divided by 2
         * for the current 15-day payroll.
         */

        $collegeLoad =
            $teachingLoads
                ->where('department', 'College')
                ->sum('rate') / 2;


        $shsLoad =
            $teachingLoads
                ->where('department', 'SHS')
                ->sum('rate') / 2;


        $jhsLoad =
            $teachingLoads
                ->where('department', 'JHS')
                ->sum('rate') / 2;


        $elementaryLoad =
            $teachingLoads
                ->where('department', 'Elementary')
                ->sum('rate') / 2;


        $kindergartenLoad =
            $teachingLoads
                ->where('department', 'Kindergarten')
                ->sum('rate') / 2;


        $nurseryLoad =
            $teachingLoads
                ->where('department', 'Nursery')
                ->sum('rate') / 2;


        /*
         * BENEFITS
         */

        $sss =
            max(
                0,
                (float) (
                    $config->sss
                    ?? 0
                )
            );


        $philhealth =
            max(
                0,
                (float) (
                    $config->philhealth
                    ?? 0
                )
            );


        $pagibig =
            max(
                0,
                (float) (
                    $config->pagibig
                    ?? 0
                )
            );


        /*
         * HMO is Regular employees only.
         */

        $hmo =
            (
                ($employee->employment_type ?? null)
                ===
                'Regular'
            )
                ? max(
                    0,
                    (float) (
                        $config->hmo
                        ?? 0
                    )
                )
                : 0;


        /*
         * LABORERS ARE WEEKLY.
         */

        $payrollPeriod =
            $config->payroll_period
            ?? null;


        $isWeeklyPayroll =
            $employee->department === 'Laborers'
            ||
            $payrollPeriod === 'Weekly';


        $benefitDivisor =
            $isWeeklyPayroll
                ? 4
                : 2;


        $benefits =
            (
                $sss
                + $philhealth
                + $pagibig
                + $hmo
            )
            /
            $benefitDivisor;


        /*
         * LATE DEDUCTION
         */

        $lateDeductionRate =
            max(
                0,
                (float) (
                    $config->late_deduction_rate
                    ?? 0
                )
            );


        $lateDeduction =
            $lateMinutes *
            $lateDeductionRate;


        /*
         * UNDERTIME DEDUCTION
         */

        $undertimeDeductionRate =
            max(
                0,
                (float) (
                    $config->undertime_deduction_rate
                    ?? 0
                )
            );


        $undertimeDeduction =
            $undertimeMinutes *
            $undertimeDeductionRate;


        /*
         * GROSS SALARY
         */

        $grossSalary =
            $basicPay
            + $holidayPay
            + $overtimePay
            + $additionalEarningsTotal
            + $teachingLoad;


        /*
         * NET SALARY
         */

        $netSalary =
            max(
                0,
                $grossSalary
                - $benefits
                - $lateDeduction
                - $undertimeDeduction
            );


        /*
         * RETURN ACTUAL PAYROLL VARIABLES
         */

        return [

            /*
             * Attendance
             */

            'attendance' =>
                $attendance,

            'present_days' =>
                $presentDays,

            'total_attendance' =>
                $presentDays,


            /*
             * Payroll period
             */

            'payroll_period' =>
                $isWeeklyPayroll
                    ? 'Weekly'
                    : (
                        $payrollPeriod
                        ?? 'Every 15 Days'
                    ),

            'is_weekly_payroll' =>
                $isWeeklyPayroll,

            'benefit_divisor' =>
                $benefitDivisor,


            /*
             * Holidays
             */

            'worked_holidays' =>
                $workedHolidayDays,

            'total_holidays' =>
                $totalHolidays,

            'holiday_dates_worked' =>
                $holidayDatesWorked,


            /*
             * Attendance minutes
             */

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


            /*
             * Rates
             */

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
                $lateDeductionRate,

            'undertime_deduction_rate' =>
                $undertimeDeductionRate,


            /*
             * Payroll earnings
             */

            'basic_pay' =>
                round(
                    $basicPay,
                    2
                ),

            'holiday_pay' =>
                round(
                    $holidayPay,
                    2
                ),

            'overtime_pay' =>
                round(
                    $overtimePay,
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


            /*
             * Teaching load
             */

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

            /*
             * Individual teaching-load amounts
             * for the 15-day payslip.
             */

            'college_load_pay' =>
                round(
                    $collegeLoad,
                    2
                ),

            'shs_load_pay' =>
                round(
                    $shsLoad,
                    2
                ),

            'jhs_load_pay' =>
                round(
                    $jhsLoad,
                    2
                ),

            'elementary_load_pay' =>
                round(
                    $elementaryLoad,
                    2
                ),

            'kindergarten_load_pay' =>
                round(
                    $kindergartenLoad,
                    2
                ),

            'nursery_load_pay' =>
                round(
                    $nurseryLoad,
                    2
                ),


            /*
             * Benefits
             */

            'sss' =>
                $sss,

            'philhealth' =>
                $philhealth,

            'pagibig' =>
                $pagibig,

            'hmo' =>
                $hmo,

            'benefits' =>
                round(
                    $benefits,
                    2
                ),


            /*
             * Deductions
             */

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
             * Final payroll
             */

            'gross_salary' =>
                round(
                    $grossSalary,
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
    | PREVIEW PAYROLL
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
            $request->employees as $employeeId
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


                /*
                 * Actual salary configuration
                 */

                'basic_salary' =>
                    (float) (
                        $config->basic_salary
                        ?? 0
                    ),

                'daily_rate' =>
                    $calculation['daily_rate'],

                'payroll_period' =>
                    $calculation['payroll_period'],

                'is_weekly_payroll' =>
                    $calculation['is_weekly_payroll'],

                'benefit_divisor' =>
                    $calculation['benefit_divisor'],


                /*
                 * Actual attendance
                 */

                'total_attendance' =>
                    $calculation['present_days'],

                'present_days' =>
                    $calculation['present_days'],

                'total_holidays' =>
                    $calculation['total_holidays'],

                'worked_holidays' =>
                    $calculation['worked_holidays'],


                /*
                 * Minutes
                 */

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


                /*
                 * Rates
                 */

                'late_deduction_rate' =>
                    $calculation['late_deduction_rate'],

                'undertime_deduction_rate' =>
                    $calculation['undertime_deduction_rate'],


                /*
                 * Earnings
                 */

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


                /*
                 * Teaching load
                 */

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

                'college_load_pay' =>
                    $calculation['college_load_pay'],

                'shs_load_pay' =>
                    $calculation['shs_load_pay'],

                'jhs_load_pay' =>
                    $calculation['jhs_load_pay'],

                'elementary_load_pay' =>
                    $calculation['elementary_load_pay'],

                'kindergarten_load_pay' =>
                    $calculation['kindergarten_load_pay'],

                'nursery_load_pay' =>
                    $calculation['nursery_load_pay'],


                /*
                 * Deductions
                 */

                'benefits' =>
                    $calculation['benefits'],

                'late_deduction' =>
                    $calculation['late_deduction'],

                'undertime_deduction' =>
                    $calculation['undertime_deduction'],


                /*
                 * Final
                 */

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
    | GENERATE PAYSLIPS
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
            $request->employees as $employeeId
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
             * Prevent duplicate payslips.
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


            $config =
                $employee->salaryConfig;


            if (!$config) {
                continue;
            }


            /*
             * Use the exact same calculation
             * used by Preview.
             */

            $calculation =
                $this->calculatePayroll(
                    $employee,
                    $config,
                    $request->period_start,
                    $request->period_end
                );


            /*
             * The existing payslip table has an
             * honorarium column.
             *
             * We store the actual additional earnings
             * there for compatibility.
             */

            $totalHonorariumAndAdditional =
                $calculation[
                    'additional_earnings_total'
                ];


            Payslip::create([

                'user_id' =>
                    $employee->id,

                'period_start' =>
                    $request->period_start,

                'period_end' =>
                    $request->period_end,


                /*
                 * Attendance
                 */

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


                /*
                 * Rates
                 */

                'daily_rate' =>
                    $calculation['daily_rate'],


                /*
                 * Earnings
                 */

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


                /*
                 * Benefits
                 */

                'sss' =>
                    $calculation['sss'],

                'philhealth' =>
                    $calculation['philhealth'],

                'pagibig' =>
                    $calculation['pagibig'],

                'hmo' =>
                    $calculation['hmo'],


                /*
                 * Deductions
                 */

                'late_deduction' =>
                    $calculation['late_deduction'],

                'undertime_deduction' =>
                    $calculation['undertime_deduction'],


                /*
                 * Final payroll
                 */

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
