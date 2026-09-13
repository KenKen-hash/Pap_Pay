<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayslipConcern;
use App\Models\Payslip;
use App\Models\Notification;
use App\Models\Attendance;
use App\Models\AdditionalEarning;
use App\Models\DepartmentSalaryConfig;
use App\Models\Holiday;
use App\Models\TeachingLoad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayslipConcernController extends Controller
{
    /**
     * Display all payslip concerns.
     */
    public function index()
    {
        $concerns = PayslipConcern::with([
            'user',
            'payslip'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'admin.payslip_concerns',
            compact('concerns')
        );
    }


    /**
     * Show a specific payslip concern.
     */
    public function show($id)
    {
        $concern = PayslipConcern::with([
            'user',
            'payslip'
        ])->findOrFail($id);

        return view(
            'admin.payslip_concern_show',
            compact('concern')
        );
    }


    /**
     * Update the concern status and admin response.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' =>
                'required|in:Pending,Reviewed,Resolved,Rejected',

            'admin_response' =>
                'nullable|string|max:5000',
        ]);


        $concern = PayslipConcern::findOrFail($id);


        $concern->update([
            'status' =>
                $request->status,

            'admin_response' =>
                $request->admin_response,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Notify Employee
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'user_id' =>
                $concern->user_id,

            'title' =>
                'Payslip Concern Updated',

            'message' =>
                'Your payslip concern has been updated to "' .
                $request->status .
                '".',

            'type' =>
                'payslip_concern',

            'url' =>
                route('payslip'),
        ]);


        return back()->with(
            'success',
            'Payslip concern updated successfully.'
        );
    }


    /**
     * Show the manual correction form.
     */
    public function editCorrection($id)
    {
        $concern = PayslipConcern::with([
            'user',
            'payslip'
        ])->findOrFail($id);


        return view(
            'admin.payslip_concern_correction',
            compact('concern')
        );
    }


    /**
     * Manually correct a payslip.
     *
     * This updates the existing payslip.
     * It does NOT create another payslip.
     */
    public function updateCorrection(Request $request, $id)
    {
        $request->validate([

            'daily_rate' =>
                'required|numeric|min:0',

            'ot' =>
                'required|numeric|min:0',

            'honorarium' =>
                'required|numeric|min:0',

            'teaching_load' =>
                'required|numeric|min:0',

            'sss' =>
                'required|numeric|min:0',

            'philhealth' =>
                'required|numeric|min:0',

            'pagibig' =>
                'required|numeric|min:0',

            'hmo' =>
                'required|numeric|min:0',

            'late_deduction' =>
                'required|numeric|min:0',

            'undertime_deduction' =>
                'required|numeric|min:0',

            'admin_response' =>
                'required|string|max:5000',
        ]);


        $concern = PayslipConcern::with([
            'user',
            'payslip'
        ])->findOrFail($id);


        $payslip = $concern->payslip;


        if (!$payslip) {
            return back()->with(
                'error',
                'The payslip associated with this concern could not be found.'
            );
        }


        DB::transaction(function () use (
            $request,
            $concern,
            $payslip
        ) {

            /*
            |--------------------------------------------------------------------------
            | Basic Pay
            |--------------------------------------------------------------------------
            |
            | The daily rate is a rate, not the total basic pay.
            | Therefore, multiply it by the employee's actual present days.
            |
            */

            $presentDays =
                max(
                    0,
                    (int)($payslip->present_days ?? 0)
                );


            $dailyRate =
                max(
                    0,
                    (float)$request->daily_rate
                );


            $basicPay =
                $dailyRate * $presentDays;


            /*
            |--------------------------------------------------------------------------
            | Existing Holiday Pay
            |--------------------------------------------------------------------------
            */

            $holidayPay =
                max(
                    0,
                    (float)($payslip->holiday_pay ?? 0)
                );


            /*
            |--------------------------------------------------------------------------
            | Manual Overtime
            |--------------------------------------------------------------------------
            */

            $overtime =
                max(
                    0,
                    (float)$request->ot
                );


            /*
            |--------------------------------------------------------------------------
            | Honorarium / Additional Earnings
            |--------------------------------------------------------------------------
            */

            $honorarium =
                max(
                    0,
                    (float)$request->honorarium
                );


            /*
            |--------------------------------------------------------------------------
            | Teaching Load
            |--------------------------------------------------------------------------
            */

            $teachingLoad =
                max(
                    0,
                    (float)$request->teaching_load
                );


            /*
            |--------------------------------------------------------------------------
            | Gross Salary
            |--------------------------------------------------------------------------
            */

            $grossSalary =
                $basicPay
                + $holidayPay
                + $overtime
                + $honorarium
                + $teachingLoad;


            /*
            |--------------------------------------------------------------------------
            | Benefits
            |--------------------------------------------------------------------------
            |
            | The payroll system divides benefits by 2 for normal payroll
            | periods and by 4 for weekly payroll.
            |
            | Laborers are always weekly in the main PayrollController.
            |
            */

            $employee =
                $concern->user;


            $payrollPeriod =
                $employee && $employee->salaryConfig
                    ? $employee->salaryConfig->payroll_period
                    : null;


            $isWeeklyPayroll =
                $employee &&
                (
                    $employee->department === 'Laborers'
                    ||
                    $payrollPeriod === 'Weekly'
                );


            $benefitDivisor =
                $isWeeklyPayroll
                    ? 4
                    : 2;


            $benefits =
                (
                    (float)$request->sss
                    + (float)$request->philhealth
                    + (float)$request->pagibig
                    + (float)$request->hmo
                ) / $benefitDivisor;


            /*
            |--------------------------------------------------------------------------
            | Total Deductions
            |--------------------------------------------------------------------------
            */

            $lateDeduction =
                max(
                    0,
                    (float)$request->late_deduction
                );


            $undertimeDeduction =
                max(
                    0,
                    (float)$request->undertime_deduction
                );


            $totalDeductions =
                $benefits
                + $lateDeduction
                + $undertimeDeduction;


            /*
            |--------------------------------------------------------------------------
            | Net Salary
            |--------------------------------------------------------------------------
            */

            $netSalary =
                max(
                    0,
                    $grossSalary - $totalDeductions
                );


            /*
            |--------------------------------------------------------------------------
            | Update Existing Payslip
            |--------------------------------------------------------------------------
            */

            $updateData = [

                'daily_rate' =>
                    $dailyRate,

                'holiday_pay' =>
                    $holidayPay,

                'ot' =>
                    $overtime,

                'honorarium' =>
                    $honorarium,

                'sss' =>
                    max(0, (float)$request->sss),

                'philhealth' =>
                    max(0, (float)$request->philhealth),

                'pagibig' =>
                    max(0, (float)$request->pagibig),

                'hmo' =>
                    max(0, (float)$request->hmo),

                'late_deduction' =>
                    $lateDeduction,

                'undertime_deduction' =>
                    $undertimeDeduction,

                'gross_salary' =>
                    $grossSalary,

                'benefits' =>
                    $benefits,

                'net_salary' =>
                    $netSalary,

                'status' =>
                    'Sent',

                'version' =>
                    ($payslip->version ?? 1) + 1,
            ];


            /*
            |--------------------------------------------------------------------------
            | Teaching Load Column
            |--------------------------------------------------------------------------
            |
            | The actual PayrollController saves the teaching load amount
            | into teaching_load_pay.
            |
            */

            if (
                array_key_exists(
                    'teaching_load_pay',
                    $payslip->getAttributes()
                )
            ) {
                $updateData['teaching_load_pay'] =
                    $teachingLoad;
            }

            /*
            |--------------------------------------------------------------------------
            | Backward Compatibility
            |--------------------------------------------------------------------------
            |
            | If the existing database still has teaching_load instead,
            | update that column as well.
            |
            */

            if (
                array_key_exists(
                    'teaching_load',
                    $payslip->getAttributes()
                )
            ) {
                $updateData['teaching_load'] =
                    $teachingLoad;
            }


            $payslip->update(
                $updateData
            );


            /*
            |--------------------------------------------------------------------------
            | Resolve Concern
            |--------------------------------------------------------------------------
            */

            $concern->update([

                'status' =>
                    'Resolved',

                'admin_response' =>
                    $request->admin_response,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Notify Employee
            |--------------------------------------------------------------------------
            */

            Notification::create([

                'user_id' =>
                    $concern->user_id,

                'title' =>
                    'Payslip Corrected',

                'message' =>
                    'Your payslip for ' .
                    $payslip->period_start->format('M d, Y') .
                    ' - ' .
                    $payslip->period_end->format('M d, Y') .
                    ' has been manually corrected.',

                'type' =>
                    'payslip_corrected',

                'url' =>
                    route('payslip'),
            ]);
        });


        return redirect()
            ->route(
                'admin.payslip-concerns.show',
                $concern->id
            )
            ->with(
                'success',
                'Payslip corrected successfully.'
            );
    }


    /**
     * Recalculate an existing payslip using the SAME payroll
     * calculation rules used by the main PayrollController.
     *
     * This updates the existing payslip.
     * It does NOT create another payslip.
     */
    public function recalculate($id)
    {
        $concern = PayslipConcern::with([
            'user',
            'payslip'
        ])->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Get Payslip and Employee
        |--------------------------------------------------------------------------
        */

        $payslip =
            $concern->payslip;

        $employee =
            $concern->user;


        /*
        |--------------------------------------------------------------------------
        | Make Sure Payslip Exists
        |--------------------------------------------------------------------------
        */

        if (!$payslip) {

            return back()->with(
                'error',
                'The payslip associated with this concern could not be found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Make Sure Employee Exists
        |--------------------------------------------------------------------------
        */

        if (!$employee) {

            return back()->with(
                'error',
                'The employee associated with this concern could not be found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Salary Configuration
        |--------------------------------------------------------------------------
        */

        $config =
            $employee->salaryConfig;


        if (!$config) {

            return back()->with(
                'error',
                'This employee does not have a salary configuration.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Payroll Period
        |--------------------------------------------------------------------------
        */

        $periodStart =
            $payslip->period_start;

        $periodEnd =
            $payslip->period_end;


        /*
        |--------------------------------------------------------------------------
        | ATTENDANCE
        |--------------------------------------------------------------------------
        |
        | This follows the Attendance query from the main PayrollController.
        |
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
        |--------------------------------------------------------------------------
        | WORKED ATTENDANCE
        |--------------------------------------------------------------------------
        |
        | The main payroll system determines attendance using time_in.
        |
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
        |--------------------------------------------------------------------------
        | PRESENT DAYS
        |--------------------------------------------------------------------------
        */

        $presentDays =
            $workedAttendance->count();


        /*
        |--------------------------------------------------------------------------
        | SALARY
        |--------------------------------------------------------------------------
        */

        $basicSalary =
            max(
                0,
                (float)(
                    $config->basic_salary ?? 0
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
        |--------------------------------------------------------------------------
        | HOLIDAYS
        |--------------------------------------------------------------------------
        */

        $holidays =
            Holiday::where(
                'is_active',
                1
            )
                ->whereBetween(
                    'date',
                    [
                        $periodStart,
                        $periodEnd
                    ]
                )
                ->where(
                    function ($query) use ($employee) {

                        $query
                            ->whereNull(
                                'department'
                            )
                            ->orWhere(
                                'department',
                                $employee->department
                            );
                    }
                )
                ->get();


        /*
        |--------------------------------------------------------------------------
        | HOLIDAY PAY
        |--------------------------------------------------------------------------
        */

        $holidayPay = 0;

        $holidayDatesWorked = [];

        foreach ($holidays as $holiday) {

            $holidayDate =
                $holiday->date
                    ? \Carbon\Carbon::parse(
                        $holiday->date
                    )->format('Y-m-d')
                    : null;


            if (!$holidayDate) {
                continue;
            }


            $workedThatHoliday =
                $workedAttendance->contains(
                    function ($record) use (
                        $holidayDate
                    ) {

                        return \Carbon\Carbon::parse(
                            $record->date
                        )->format('Y-m-d')
                        ===
                        $holidayDate;
                    }
                );


            if ($workedThatHoliday) {

                $payRate =
                    (float)(
                        $holiday->pay_rate ?? 100
                    );


                $holidayPay +=
                    $dailyRate
                    * (
                        $payRate / 100
                    );


                $holidayDatesWorked[] =
                    $holidayDate;
            } else {

                $holidayPay +=
                    $dailyRate;
            }
        }


        $totalHolidays =
            $holidays->count();


        $workedHolidayDays =
            count(
                $holidayDatesWorked
            );


        /*
        |--------------------------------------------------------------------------
        | NORMAL WORKED DAYS
        |--------------------------------------------------------------------------
        */

        $normalWorkedDays =
            max(
                0,
                $presentDays
                - $workedHolidayDays
            );


        /*
        |--------------------------------------------------------------------------
        | BASIC PAY
        |--------------------------------------------------------------------------
        */

        $basicPay =
            $dailyRate
            * $normalWorkedDays;


        /*
        |--------------------------------------------------------------------------
        | ATTENDANCE MINUTES
        |--------------------------------------------------------------------------
        */

        $lateMinutes =
            max(
                0,
                (int)$attendance->sum(
                    'late_minutes'
                )
            );


        $undertimeMinutes =
            max(
                0,
                (int)$attendance->sum(
                    'undertime_minutes'
                )
            );


        $overtimeMinutes =
            max(
                0,
                (int)$attendance->sum(
                    'overtime_minutes'
                )
            );


        $overtimeHours =
            $overtimeMinutes / 60;


        /*
        |--------------------------------------------------------------------------
        | OVERTIME PAY
        |--------------------------------------------------------------------------
        */

        $overtimePay =
            $overtimeHours
            * $overtimeRate;


        /*
        |--------------------------------------------------------------------------
        | ADDITIONAL EARNINGS
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
            max(
                0,
                (float)$additionalEarnings->sum(
                    'amount'
                )
            );


        /*
        |--------------------------------------------------------------------------
        | HONORARIUM
        |--------------------------------------------------------------------------
        |
        | The main PayrollController has this variable.
        |
        | However, its current gross salary calculation does NOT add
        | the configured honorarium separately.
        |
        | The generated Payslip's "honorarium" field is populated with
        | additional_earnings_total for compatibility.
        |
        | Therefore, to reproduce the actual generated payslip,
        | we use the additional earnings total here.
        |
        */

        $honorarium =
            $additionalEarningsTotal;


        /*
        |--------------------------------------------------------------------------
        | DEPARTMENT TEACHING LOAD CONFIGURATION
        |--------------------------------------------------------------------------
        */

        $departmentConfig =
            DepartmentSalaryConfig::where(
                'department',
                $employee->department
            )->first();


        $teachingLoadRequiredUnit =
            $departmentConfig
                && $departmentConfig->teaching_load_required_unit !== null
                ? (float)$departmentConfig->teaching_load_required_unit
                : (float)(
                    $config->teaching_load_required_unit ?? 0
                );


        $teachingLoadPrice =
            $departmentConfig
                && $departmentConfig->teaching_load_price !== null
                ? (float)$departmentConfig->teaching_load_price
                : (float)(
                    $config->teaching_load_price ?? 0
                );


        /*
        |--------------------------------------------------------------------------
        | LEGACY TEACHING LOAD
        |--------------------------------------------------------------------------
        */

        $additionalTeachingUnits =
            max(
                0,
                (int)(
                    $config->teaching_load_units_taken ?? 0
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

            $legacyTeachingLoad =
                (
                    $additionalTeachingUnits
                    /
                    $teachingLoadRequiredUnit
                )
                * $teachingLoadPrice;


            $legacyTeachingLoad /=
                2;
        }


        /*
        |--------------------------------------------------------------------------
        | TEACHING LOAD RECORDS
        |--------------------------------------------------------------------------
        */

        $teachingLoads =
            TeachingLoad::where(
                'user_id',
                $employee->id
            )
                ->orderBy('id')
                ->get();


        $teachingLoadRateTotal =
            max(
                0,
                (float)$teachingLoads->sum(
                    'rate'
                )
            );


        $additionalTeachingLoadPay =
            $teachingLoadRateTotal > 0
                ? $teachingLoadRateTotal / 2
                : 0;


        $teachingLoad =
            $additionalTeachingLoadPay;


        /*
        |--------------------------------------------------------------------------
        | BENEFITS
        |--------------------------------------------------------------------------
        */

        $sss =
            max(
                0,
                (float)(
                    $config->sss ?? 0
                )
            );


        $philhealth =
            max(
                0,
                (float)(
                    $config->philhealth ?? 0
                )
            );


        $pagibig =
            max(
                0,
                (float)(
                    $config->pagibig ?? 0
                )
            );


        /*
        |--------------------------------------------------------------------------
        | HMO
        |--------------------------------------------------------------------------
        |
        | HMO only applies to Regular employees in the main payroll logic.
        |
        */

        $hmo =
            ($employee->employment_type ?? null)
                === 'Regular'
                ? max(
                    0,
                    (float)(
                        $config->hmo ?? 0
                    )
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | PAYROLL PERIOD / BENEFIT DIVISOR
        |--------------------------------------------------------------------------
        */

        $payrollPeriod =
            $config->payroll_period ?? null;


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
        |--------------------------------------------------------------------------
        | DEDUCTION RATES
        |--------------------------------------------------------------------------
        */

        $lateDeductionRate =
            max(
                0,
                (float)(
                    $config->late_deduction_rate ?? 0
                )
            );


        $undertimeDeductionRate =
            max(
                0,
                (float)(
                    $config->undertime_deduction_rate ?? 0
                )
            );


        /*
        |--------------------------------------------------------------------------
        | DEDUCTIONS
        |--------------------------------------------------------------------------
        */

        $lateDeduction =
            $lateMinutes
            * $lateDeductionRate;


        $undertimeDeduction =
            $undertimeMinutes
            * $undertimeDeductionRate;


        /*
        |--------------------------------------------------------------------------
        | GROSS SALARY
        |--------------------------------------------------------------------------
        |
        | This matches the original PayrollController:
        |
        | basic pay
        | + holiday pay
        | + overtime pay
        | + additional earnings
        | + teaching load
        |
        */

        $grossSalary =
            $basicPay
            + $holidayPay
            + $overtimePay
            + $additionalEarningsTotal
            + $teachingLoad;


        /*
        |--------------------------------------------------------------------------
        | NET SALARY
        |--------------------------------------------------------------------------
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
        |--------------------------------------------------------------------------
        | TEACHING LOAD BREAKDOWN
        |--------------------------------------------------------------------------
        */

        $collegeLoad =
            $teachingLoads
                ->where(
                    'department',
                    'College'
                )
                ->sum('rate') / 2;


        $shsLoad =
            $teachingLoads
                ->where(
                    'department',
                    'Senior High School'
                )
                ->sum('rate') / 2;


        $jhsLoad =
            $teachingLoads
                ->where(
                    'department',
                    'Junior High School'
                )
                ->sum('rate') / 2;


        $elementaryLoad =
            $teachingLoads
                ->where(
                    'department',
                    'Elementary'
                )
                ->sum('rate') / 2;


        $kindergartenLoad =
            $teachingLoads
                ->where(
                    'department',
                    'Kindergarten'
                )
                ->sum('rate') / 2;


        $nurseryLoad =
            $teachingLoads
                ->where(
                    'department',
                    'Nursery'
                )
                ->sum('rate') / 2;


        /*
        |--------------------------------------------------------------------------
        | UPDATE EXISTING PAYSLIP
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $payslip,
            $concern,
            $employee,
            $presentDays,
            $workedHolidayDays,
            $lateMinutes,
            $undertimeMinutes,
            $overtimeMinutes,
            $overtimeHours,
            $dailyRate,
            $holidayPay,
            $overtimePay,
            $honorarium,
            $teachingLoad,
            $sss,
            $philhealth,
            $pagibig,
            $hmo,
            $lateDeduction,
            $undertimeDeduction,
            $grossSalary,
            $benefits,
            $netSalary
        ) {

            $updateData = [

                'present_days' =>
                    $presentDays,

                'worked_holidays' =>
                    $workedHolidayDays,

                'late_minutes' =>
                    $lateMinutes,

                'undertime_minutes' =>
                    $undertimeMinutes,

                'overtime_minutes' =>
                    $overtimeMinutes,

                'overtime_hours' =>
                    $overtimeHours,

                'daily_rate' =>
                    $dailyRate,

                'holiday_pay' =>
                    $holidayPay,

                'ot' =>
                    $overtimePay,

                'honorarium' =>
                    $honorarium,

                'sss' =>
                    $sss,

                'philhealth' =>
                    $philhealth,

                'pagibig' =>
                    $pagibig,

                'hmo' =>
                    $hmo,

                'late_deduction' =>
                    $lateDeduction,

                'undertime_deduction' =>
                    $undertimeDeduction,

                'gross_salary' =>
                    $grossSalary,

                'benefits' =>
                    $benefits,

                'net_salary' =>
                    $netSalary,

                'status' =>
                    'Sent',

                'version' =>
                    ($payslip->version ?? 1) + 1,
            ];


            /*
            |--------------------------------------------------------------------------
            | Teaching Load Pay
            |--------------------------------------------------------------------------
            */

            if (
                array_key_exists(
                    'teaching_load_pay',
                    $payslip->getAttributes()
                )
            ) {

                $updateData[
                    'teaching_load_pay'
                ] =
                    $teachingLoad;
            }


            /*
            |--------------------------------------------------------------------------
            | Backward Compatibility
            |--------------------------------------------------------------------------
            */

            if (
                array_key_exists(
                    'teaching_load',
                    $payslip->getAttributes()
                )
            ) {

                $updateData[
                    'teaching_load'
                ] =
                    $teachingLoad;
            }


            $payslip->update(
                $updateData
            );


            /*
            |--------------------------------------------------------------------------
            | Resolve Concern
            |--------------------------------------------------------------------------
            */

            $concern->update([

                'status' =>
                    'Resolved',

                'admin_response' =>
                    'Your payslip was reviewed and recalculated based on the current payroll, salary configuration, and attendance records.',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Notify Employee
            |--------------------------------------------------------------------------
            */

            Notification::create([

                'user_id' =>
                    $employee->id,

                'title' =>
                    'Payslip Corrected',

                'message' =>
                    'Your payslip for ' .
                    $payslip->period_start->format('M d, Y') .
                    ' - ' .
                    $payslip->period_end->format('M d, Y') .
                    ' has been recalculated and corrected.',

                'type' =>
                    'payslip_corrected',

                'url' =>
                    route('payslip'),
            ]);
        });


        return back()->with(
            'success',
            'Payslip has been recalculated successfully and the concern was resolved.'
        );
    }
}
