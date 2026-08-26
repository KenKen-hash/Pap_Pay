<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayslipConcern;
use App\Models\Payslip;
use App\Models\Notification;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\NotificationHelper;

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
     * This updates the existing payslip instead of creating
     * another payslip for the same employee and payroll period.
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

        DB::transaction(function () use (
            $request,
            $concern,
            $payslip
        ) {

            /*
            |--------------------------------------------------------------------------
            | Earnings
            |--------------------------------------------------------------------------
            */

            $grossSalary =
                $request->daily_rate
                + $request->ot
                + $request->honorarium
                + $request->teaching_load
                + ($payslip->holiday_pay ?? 0);


            /*
            |--------------------------------------------------------------------------
            | Benefits
            |--------------------------------------------------------------------------
            */

            $benefits =
                (
                    $request->sss
                    + $request->philhealth
                    + $request->pagibig
                    + $request->hmo
                ) / 2;


            /*
            |--------------------------------------------------------------------------
            | Total Deductions
            |--------------------------------------------------------------------------
            */

            $totalDeductions =
                $benefits
                + $request->late_deduction
                + $request->undertime_deduction;


            /*
            |--------------------------------------------------------------------------
            | Net Salary
            |--------------------------------------------------------------------------
            */

            $netSalary =
                $grossSalary -
                $totalDeductions;


            /*
            |--------------------------------------------------------------------------
            | Update Existing Payslip
            |--------------------------------------------------------------------------
            */

            $payslip->update([

                'daily_rate' =>
                    $request->daily_rate,

                'ot' =>
                    $request->ot,

                'honorarium' =>
                    $request->honorarium,

                'teaching_load' =>
                    $request->teaching_load,

                'sss' =>
                    $request->sss,

                'philhealth' =>
                    $request->philhealth,

                'pagibig' =>
                    $request->pagibig,

                'hmo' =>
                    $request->hmo,

                'late_deduction' =>
                    $request->late_deduction,

                'undertime_deduction' =>
                    $request->undertime_deduction,

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
            ]);


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
                    route(
                        'payslip'
                    ),
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
     * Recalculate an existing payslip using:
     *
     * - Attendance
     * - Employee salary configuration
     * - Manual overtime configuration
     * - Holiday work
     * - Late deductions
     * - Undertime deductions
     *
     * IMPORTANT:
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

        $payslip = $concern->payslip;

        $employee = $concern->user;

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
        | Salary Configuration
        |--------------------------------------------------------------------------
        */

        $config = $employee->salaryConfig;

        if (!$config) {
            return back()->with(
                'error',
                'This employee does not have a salary configuration.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

        $attendance = Attendance::where(
            'user_id',
            $employee->id
        )
            ->whereBetween('date', [
                $payslip->period_start,
                $payslip->period_end
            ])
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Present Days
        |--------------------------------------------------------------------------
        */

        $presentDays = $attendance
            ->where('status', 'Present')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Worked Holidays
        |--------------------------------------------------------------------------
        */

        $workedHolidayDays = $attendance
            ->whereIn('status', [
                'Work on Holiday',
                'Worked Holiday'
            ])
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Late Minutes
        |--------------------------------------------------------------------------
        */

        $lateMinutes =
            $attendance->sum('late_minutes');


        /*
        |--------------------------------------------------------------------------
        | Undertime Minutes
        |--------------------------------------------------------------------------
        */

        $undertimeMinutes =
            $attendance->sum('undertime_minutes');


        /*
        |--------------------------------------------------------------------------
        | Basic Pay
        |--------------------------------------------------------------------------
        */

        $basicPay =
            ($config->daily_rate ?? 0)
            * $presentDays;


        /*
        |--------------------------------------------------------------------------
        | Holiday Pay
        |--------------------------------------------------------------------------
        */

        $holidayPay =
            ($config->daily_rate ?? 0)
            * 2
            * $workedHolidayDays;


        /*
        |--------------------------------------------------------------------------
        | Manual Overtime
        |--------------------------------------------------------------------------
        |
        | Your current system uses the OT amount entered by the admin.
        |
        | We are NOT calculating overtime from attendance yet.
        |
        */

        $overtime =
            $config->ot_rate ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Honorarium
        |--------------------------------------------------------------------------
        */

        $honorarium =
            $config->honorarium ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Teaching Load
        |--------------------------------------------------------------------------
        */

        $teachingLoad =
            $config->teaching_load ?? 0;


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
        */

        $benefits =
            (
                ($config->sss ?? 0)
                + ($config->philhealth ?? 0)
                + ($config->pagibig ?? 0)
                + ($config->hmo ?? 0)
            ) / 2;


        /*
        |--------------------------------------------------------------------------
        | Late Deduction
        |--------------------------------------------------------------------------
        */

        $lateDeduction =
            $lateMinutes
            * ($config->late_deduction_rate ?? 0);


        /*
        |--------------------------------------------------------------------------
        | Undertime Deduction
        |--------------------------------------------------------------------------
        */

        $undertimeDeduction =
            $undertimeMinutes
            * ($config->undertime_deduction_rate ?? 0);


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
        | Update Payslip + Concern
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
            $config,
            $holidayPay,
            $overtime,
            $honorarium,
            $teachingLoad,
            $lateDeduction,
            $undertimeDeduction,
            $grossSalary,
            $benefits,
            $netSalary
        ) {

            /*
            |--------------------------------------------------------------------------
            | Update Existing Payslip
            |--------------------------------------------------------------------------
            */

            $payslip->update([

                'present_days' =>
                    $presentDays,

                'worked_holidays' =>
                    $workedHolidayDays,

                'late_minutes' =>
                    $lateMinutes,

                'undertime_minutes' =>
                    $undertimeMinutes,

                'daily_rate' =>
                    $config->daily_rate ?? 0,

                'holiday_pay' =>
                    $holidayPay,

                /*
                 * Manual OT
                 */
                'ot' =>
                    $overtime,

                'honorarium' =>
                    $honorarium,

                'teaching_load' =>
                    $teachingLoad,

                'sss' =>
                    $config->sss ?? 0,

                'philhealth' =>
                    $config->philhealth ?? 0,

                'pagibig' =>
                    $config->pagibig ?? 0,

                'hmo' =>
                    $config->hmo ?? 0,

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

                /*
                 * Make corrected payslip available
                 * to the employee.
                 */
                'status' =>
                    'Sent',

                /*
                 * Increment correction version.
                 */
                'version' =>
                    ($payslip->version ?? 1) + 1,
            ]);


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


        /*
        |--------------------------------------------------------------------------
        | Return
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Payslip has been recalculated successfully and the concern was resolved.'
        );
    }
}
