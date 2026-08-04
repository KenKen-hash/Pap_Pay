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
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // ===========================
    // Reports Dashboard
    // ===========================
    public function index()
    {
        return view('admin.reports', [

            'employeeCount'       => User::where('role', 'employee')->count(),
            'attendanceCount'     => Attendance::count(),
            'leaveCount'          => LeaveRequest::count(),
            'obCount'             => OfficialBusiness::count(),
            'payslipCount'        => Payslip::count(),
            'salaryConfigCount'   => EmployeeSalaryConfig::count(),
            'releasedPayslips'    => Payslip::where('status', 'Released')->count(),

        ]);
    }

    // ===========================
    // Payroll Query (Reusable)
    // ===========================
    private function payrollQuery(Request $request)
    {
        $query = Payslip::with('user');

        // Payroll Period
        if ($request->filled('start')) {
            $query->whereDate('period_start', '>=', $request->start);
        }

        if ($request->filled('end')) {
            $query->whereDate('period_end', '<=', $request->end);
        }

        // Department
        if ($request->filled('department')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('department', $request->department);
            });
        }

        // Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query->latest();
    }


    private function attendanceQuery(Request $request)
    {
        $query = Attendance::with('user');

        // Date From
        if ($request->filled('start')) {
            $query->whereDate('date', '>=', $request->start);
        }

        // Date To
        if ($request->filled('end')) {
            $query->whereDate('date', '<=', $request->end);
        }

        // Department
        if ($request->filled('department')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('department', $request->department);
            });
        }

        // Attendance Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query->latest();
    }

    private function employeeQuery(Request $request)
    {
        $query = User::where('role', 'employee');

        // Department
        if ($request->filled('department')) {

            $query->where('department', $request->department);
        }

        // Employee Status
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        return $query->orderBy('name');
    }

    private function leaveQuery(Request $request)
    {
        $query = LeaveRequest::with('user');

        // Date Range
        if ($request->filled('start')) {
            $query->whereDate('start_date', '>=', $request->start);
        }

        if ($request->filled('end')) {
            $query->whereDate('end_date', '<=', $request->end);
        }

        // Leave Type
        if ($request->filled('leave_type')) {
            $query->where('leave_type', $request->leave_type);
        }

        // Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query->latest();
    }


    private function obQuery(Request $request)
    {
        $query = OfficialBusiness::with('user');

        // Date From
        if ($request->filled('start')) {
            $query->whereDate('ob_date', '>=', $request->start);
        }

        // Date To
        if ($request->filled('end')) {
            $query->whereDate('ob_date', '<=', $request->end);
        }

        // Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query->latest();
    }

    private function salaryQuery(Request $request)
    {
        $query = EmployeeSalaryConfig::with('user');

        // Department Filter
        if ($request->filled('department')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('department', $request->department);
            });
        }

        return $query->latest();
    }


    private function contributionsQuery(Request $request)
    {
        $query = EmployeeSalaryConfig::with('user');

        if ($request->filled('department')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('department', $request->department);
            });
        }

        return $query->latest();
    }

    // ===========================
    // Payroll Report
    // ===========================
    public function payroll(Request $request)
    {
        $payslips = $this->payrollQuery($request)->get();

        $totalEmployees = $payslips->count();

        $grossPayroll = $payslips->sum('gross_salary');

        $netPayroll = $payslips->sum('net_salary');

        $totalBenefits = $payslips->sum('benefits');

        $totalDeductions =
            $payslips->sum('sss') +
            $payslips->sum('philhealth') +
            $payslips->sum('pagibig') +
            $payslips->sum('hmo') +
            $payslips->sum('late_deduction') +
            $payslips->sum('undertime_deduction');

        $generated = $request->filled('start') ||
            $request->filled('end') ||
            $request->filled('department') ||
            $request->filled('status');

        return view('admin.reports.payroll', compact(
            'payslips',
            'totalEmployees',
            'grossPayroll',
            'netPayroll',
            'totalBenefits',
            'totalDeductions',
            'generated'
        ));
    }

    // ===========================
    // Payroll PDF
    // ===========================
    public function payrollPdf(Request $request)
    {
        $payslips = $this->payrollQuery($request)->get();

        $totalEmployees = $payslips->count();

        $grossPayroll = $payslips->sum('gross_salary');

        $netPayroll = $payslips->sum('net_salary');

        $totalBenefits = $payslips->sum('benefits');

        $totalDeductions =
            $payslips->sum('sss') +
            $payslips->sum('philhealth') +
            $payslips->sum('pagibig') +
            $payslips->sum('hmo') +
            $payslips->sum('late_deduction') +
            $payslips->sum('undertime_deduction');

        $pdf = Pdf::loadView(
            'admin.reports.pdf.payroll',
            compact(
                'payslips',
                'totalEmployees',
                'grossPayroll',
                'netPayroll',
                'totalBenefits',
                'totalDeductions'
            )
        );

        return $pdf->setPaper('a4', 'landscape')
            ->download('Payroll_Report.pdf');
    }

    public function attendancePdf(Request $request)
    {
        $attendance = $this->attendanceQuery($request)->get();

        $totalRecords = $attendance->count();

        $presentCount = $attendance->where('status', 'Present')->count();

        $lateCount = $attendance->where('status', 'Late')->count();

        $absentCount = $attendance->where('status', 'Absent')->count();

        $totalHours = $attendance->sum('hours_worked');

        $pdf = Pdf::loadView(
            'admin.reports.pdf.attendance',
            compact(
                'attendance',
                'totalRecords',
                'presentCount',
                'lateCount',
                'absentCount',
                'totalHours'
            )
        );

        return $pdf->setPaper('a4', 'landscape')
            ->download('Attendance_Report.pdf');
    }

    // ===========================
    // Payroll Excel
    // ===========================
    public function payrollExcel(Request $request)
    {
        $payslips = $this->payrollQuery($request)->get();

        $fileName = 'Payroll_Report_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($payslips) {

            $file = fopen('php://output', 'w');

            // Header Row
            fputcsv($file, [
                'Employee ID',
                'Employee Name',
                'Department',
                'Payroll Period',
                'Gross Salary',
                'Benefits',
                'SSS',
                'PhilHealth',
                'Pag-IBIG',
                'HMO',
                'Late Deduction',
                'Undertime Deduction',
                'Net Salary',
                'Status',
            ]);

            // Data Rows
            foreach ($payslips as $pay) {

                fputcsv($file, [

                    $pay->user->employee_id,

                    $pay->user->name,

                    $pay->user->department,

                    $pay->period_start . ' - ' . $pay->period_end,

                    $pay->gross_salary,

                    $pay->benefits,

                    $pay->sss,

                    $pay->philhealth,

                    $pay->pagibig,

                    $pay->hmo,

                    $pay->late_deduction,

                    $pay->undertime_deduction,

                    $pay->net_salary,

                    $pay->status,

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function attendanceExcel(Request $request)
    {
        $attendance = $this->attendanceQuery($request)->get();

        $fileName = 'Attendance_Report_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($attendance) {

            $file = fopen('php://output', 'w');

            // Header Row
            fputcsv($file, [
                'Employee ID',
                'Employee Name',
                'Department',
                'Date',
                'Morning Time In',
                'Morning Time Out',
                'Afternoon Time In',
                'Afternoon Time Out',
                'Hours Worked',
                'Status',
            ]);

            // Data Rows
            foreach ($attendance as $record) {

                fputcsv($file, [

                    $record->user->employee_id,

                    $record->user->name,

                    $record->user->department,

                    optional($record->date)->format('Y-m-d'),

                    optional($record->morning_time_in)->format('h:i:s A'),

                    optional($record->morning_time_out)->format('h:i:s A'),

                    optional($record->afternoon_time_in)->format('h:i:s A'),

                    optional($record->afternoon_time_out)->format('h:i:s A'),

                    $record->hours_worked,

                    $record->status,

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ===========================
    // Attendance Report
    // ===========================
    public function attendance(Request $request)
    {
        $attendance = $this->attendanceQuery($request)->get();

        $generated =
            $request->filled('start') ||
            $request->filled('end') ||
            $request->filled('department') ||
            $request->filled('status');

        $totalRecords = $attendance->count();

        $presentCount = $attendance->where('status', 'Present')->count();

        $lateCount = $attendance->where('status', 'Late')->count();

        $absentCount = $attendance->where('status', 'Absent')->count();

        $totalHours = $attendance->sum('hours_worked');

        $departments = User::where('role', 'employee')
            ->select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        return view(
            'admin.reports.attendance',
            compact(
                'attendance',
                'generated',
                'totalRecords',
                'presentCount',
                'lateCount',
                'absentCount',
                'totalHours',
                'departments'
            )
        );
    }

    // ===========================
    // Employee Report
    // ===========================
    public function employee(Request $request)
    {
        $employees = $this->employeeQuery($request)->get();

        $generated =
            $request->filled('department') ||
            $request->filled('status');

        $totalEmployees = $employees->count();

        $activeEmployees = $employees->where('status', 'Active')->count();

        $inactiveEmployees = $employees->where('status', 'Inactive')->count();

        $departmentCount = $employees
            ->pluck('department')
            ->unique()
            ->count();

        $departments = User::where('role', 'employee')
            ->select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        return view(
            'admin.reports.employee',
            compact(
                'employees',
                'generated',
                'totalEmployees',
                'activeEmployees',
                'inactiveEmployees',
                'departmentCount',
                'departments'
            )
        );
    }

    // ===========================
    // Employee PDF
    // ===========================
    public function employeePdf(Request $request)
    {
        $employees = $this->employeeQuery($request)->get();

        $totalEmployees = $employees->count();

        $activeEmployees = $employees->where('status', 'Active')->count();

        $inactiveEmployees = $employees->where('status', 'Inactive')->count();

        $pdf = Pdf::loadView(
            'admin.reports.pdf.employee',
            compact(
                'employees',
                'totalEmployees',
                'activeEmployees',
                'inactiveEmployees'
            )
        );

        return $pdf->download('Employee_Report.pdf');
    }

    // ===========================
    // Employee Excel (CSV)
    // ===========================
    public function employeeExcel(Request $request)
    {
        $employees = $this->employeeQuery($request)->get();

        $fileName = 'Employee_Report_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($employees) {

            $file = fopen('php://output', 'w');

            // Header Row
            fputcsv($file, [
                'Employee ID',
                'Employee Name',
                'Department',
                'Email',
                'Contact Number',
                'Status',
            ]);

            // Data
            foreach ($employees as $employee) {

                fputcsv($file, [

                    $employee->employee_id,

                    $employee->name,

                    $employee->department,

                    $employee->email,

                    $employee->contact_number,

                    $employee->status,

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ===========================
    // Leave Report
    // ===========================
    public function leave(Request $request)
    {
        $leaves = $this->leaveQuery($request)->get();

        $generated =
            $request->filled('start') ||
            $request->filled('end') ||
            $request->filled('leave_type') ||
            $request->filled('status');

        $totalLeaves = $leaves->count();

        $approvedLeaves = $leaves->where('status', 'Approved')->count();

        $pendingLeaves = $leaves->where('status', 'Pending')->count();

        $rejectedLeaves = $leaves->where('status', 'Rejected')->count();

        $leaveTypes = LeaveRequest::select('leave_type')
            ->distinct()
            ->orderBy('leave_type')
            ->pluck('leave_type');

        return view(
            'admin.reports.leave',
            compact(
                'leaves',
                'generated',
                'totalLeaves',
                'approvedLeaves',
                'pendingLeaves',
                'rejectedLeaves',
                'leaveTypes'
            )
        );
    }

    // ===========================
    // Leave PDF
    // ===========================
    public function leavePdf(Request $request)
    {
        $leaves = $this->leaveQuery($request)->get();

        $totalLeaves = $leaves->count();

        $approvedLeaves = $leaves->where('status', 'Approved')->count();

        $pendingLeaves = $leaves->where('status', 'Pending')->count();

        $rejectedLeaves = $leaves->where('status', 'Rejected')->count();

        $pdf = Pdf::loadView(
            'admin.reports.pdf.leave',
            compact(
                'leaves',
                'totalLeaves',
                'approvedLeaves',
                'pendingLeaves',
                'rejectedLeaves'
            )
        );

        return $pdf->download('Leave_Report.pdf');
    }

    // ===========================
    // Leave Excel (CSV)
    // ===========================
    public function leaveExcel(Request $request)
    {
        $leaves = $this->leaveQuery($request)->get();

        $fileName = 'Leave_Report_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($leaves) {

            $file = fopen('php://output', 'w');

            // Header Row
            fputcsv($file, [
                'Employee ID',
                'Employee Name',
                'Department',
                'Leave Type',
                'Start Date',
                'End Date',
                'Total Days',
                'Status',
            ]);

            foreach ($leaves as $leave) {

                $days = \Carbon\Carbon::parse($leave->start_date)
                    ->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;

                fputcsv($file, [

                    $leave->user->employee_id,

                    $leave->user->name,

                    $leave->user->department,

                    $leave->leave_type,

                    $leave->start_date,

                    $leave->end_date,

                    $days,

                    $leave->status,

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ===========================
    // Official Business Report
    // ===========================
    public function ob(Request $request)
    {
        $obs = $this->obQuery($request)->get();

        $generated =
            $request->filled('start') ||
            $request->filled('end') ||
            $request->filled('status');

        $totalOB = $obs->count();

        $approvedOB = $obs->where('status', 'Approved')->count();

        $pendingOB = $obs->where('status', 'Pending')->count();

        $rejectedOB = $obs->where('status', 'Rejected')->count();

        return view(
            'admin.reports.ob',
            compact(
                'obs',
                'generated',
                'totalOB',
                'approvedOB',
                'pendingOB',
                'rejectedOB'
            )
        );
    }

    // ===========================
    // Official Business PDF
    // ===========================
    public function obPdf(Request $request)
    {
        $obs = $this->obQuery($request)->get();

        $totalOB = $obs->count();

        $approvedOB = $obs->where('status', 'Approved')->count();

        $pendingOB = $obs->where('status', 'Pending')->count();

        $rejectedOB = $obs->where('status', 'Rejected')->count();

        $pdf = Pdf::loadView(
            'admin.reports.pdf.ob',
            compact(
                'obs',
                'totalOB',
                'approvedOB',
                'pendingOB',
                'rejectedOB'
            )
        );

        return $pdf->download('Official_Business_Report.pdf');
    }

    // ===========================
    // Official Business Excel (CSV)
    // ===========================
    public function obExcel(Request $request)
    {
        $obs = $this->obQuery($request)->get();

        $fileName = 'Official_Business_Report_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($obs) {

            $file = fopen('php://output', 'w');

            // Header Row
            fputcsv($file, [
                'Employee ID',
                'Employee Name',
                'Department',
                'Purpose',
                'Destination',
                'OB Date',
                'Morning Time Out',
                'Morning Time In',
                'Afternoon Time Out',
                'Afternoon Time In',
                'Status',
            ]);

            foreach ($obs as $ob) {

                fputcsv($file, [

                    optional($ob->user)->employee_id,

                    optional($ob->user)->name,

                    optional($ob->user)->department,

                    $ob->purpose,

                    $ob->destination,

                    optional($ob->ob_date)->format('Y-m-d'),

                    $ob->morning_time_out,

                    $ob->morning_time_in,

                    $ob->afternoon_time_out,

                    $ob->afternoon_time_in,

                    $ob->status,

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ===========================
    // Salary Report
    // ===========================
    public function salary(Request $request)
    {
        $salaries = $this->salaryQuery($request)->get();

        $generated = $request->filled('department');

        $totalEmployees = $salaries->count();

        $totalBasicSalary = $salaries->sum('basic_salary');

        $totalDailyRate = $salaries->sum('daily_rate');

        $averageBasicSalary = $totalEmployees > 0
            ? $totalBasicSalary / $totalEmployees
            : 0;

        return view(
            'admin.reports.salary',
            compact(
                'salaries',
                'generated',
                'totalEmployees',
                'totalBasicSalary',
                'totalDailyRate',
                'averageBasicSalary'
            )
        );
    }

    // ===========================
    // Salary PDF
    // ===========================
    public function salaryPdf(Request $request)
    {
        $salaries = $this->salaryQuery($request)->get();

        $totalEmployees = $salaries->count();

        $totalBasicSalary = $salaries->sum('basic_salary');

        $totalDailyRate = $salaries->sum('daily_rate');

        $averageBasicSalary = $totalEmployees > 0
            ? $totalBasicSalary / $totalEmployees
            : 0;

        $pdf = Pdf::loadView(
            'admin.reports.pdf.salary',
            compact(
                'salaries',
                'totalEmployees',
                'totalBasicSalary',
                'totalDailyRate',
                'averageBasicSalary'
            )
        );

        return $pdf->download('Salary_Report.pdf');
    }

    // ===========================
    // Salary Excel (CSV)
    // ===========================
    public function salaryExcel(Request $request)
    {
        $salaries = $this->salaryQuery($request)->get();

        $fileName = 'Salary_Report_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($salaries) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Employee ID',
                'Employee Name',
                'Department',
                'Basic Salary',
                'Daily Rate',
                'Payroll Period',
                'OT Rate',
                'Honorarium',
                'Teaching Load',
                'SSS',
                'PhilHealth',
                'Pag-IBIG',
                'HMO'
            ]);

            foreach ($salaries as $salary) {

                fputcsv($file, [

                    optional($salary->user)->employee_id,

                    optional($salary->user)->name,

                    optional($salary->user)->department,

                    $salary->basic_salary,

                    $salary->daily_rate,

                    $salary->payroll_period,

                    $salary->ot_rate,

                    $salary->honorarium,

                    $salary->teaching_load,

                    $salary->sss,

                    $salary->philhealth,

                    $salary->pagibig,

                    $salary->hmo,

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ===========================
    // Government Contributions
    // ===========================
    public function contributions(Request $request)
    {
        $contributions = $this->contributionsQuery($request)->get();

        $generated = $request->filled('department');

        $totalEmployees = $contributions->count();

        $totalSSS = $contributions->sum('sss');

        $totalPhilHealth = $contributions->sum('philhealth');

        $totalPagibig = $contributions->sum('pagibig');

        $totalHMO = $contributions->sum('hmo');

        $grandTotal =
            $totalSSS +
            $totalPhilHealth +
            $totalPagibig +
            $totalHMO;

        return view(
            'admin.reports.contributions',
            compact(
                'contributions',
                'generated',
                'totalEmployees',
                'totalSSS',
                'totalPhilHealth',
                'totalPagibig',
                'totalHMO',
                'grandTotal'
            )
        );
    }


    // ===========================
    // Government Contributions PDF
    // ===========================
    public function contributionsPdf(Request $request)
    {
        $contributions = $this->contributionsQuery($request)->get();

        $totalEmployees = $contributions->count();

        $totalSSS = $contributions->sum('sss');

        $totalPhilHealth = $contributions->sum('philhealth');

        $totalPagibig = $contributions->sum('pagibig');

        $totalHMO = $contributions->sum('hmo');

        $grandTotal =
            $totalSSS +
            $totalPhilHealth +
            $totalPagibig +
            $totalHMO;

        $pdf = Pdf::loadView(
            'admin.reports.pdf.contributions',
            compact(
                'contributions',
                'totalEmployees',
                'totalSSS',
                'totalPhilHealth',
                'totalPagibig',
                'totalHMO',
                'grandTotal'
            )
        );

        return $pdf->download('Government_Contributions_Report.pdf');
    }

    // ===========================
    // Government Contributions Excel (CSV)
    // ===========================
    public function contributionsExcel(Request $request)
    {
        $contributions = $this->contributionsQuery($request)->get();

        $fileName = 'Government_Contributions_Report_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($contributions) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [

                'Employee ID',

                'Employee Name',

                'Department',

                'SSS',

                'PhilHealth',

                'Pag-IBIG',

                'HMO',

                'Total Contributions'

            ]);

            foreach ($contributions as $contribution) {

                $total =
                    $contribution->sss +
                    $contribution->philhealth +
                    $contribution->pagibig +
                    $contribution->hmo;

                fputcsv($file, [

                    optional($contribution->user)->employee_id,

                    optional($contribution->user)->name,

                    optional($contribution->user)->department,

                    $contribution->sss,

                    $contribution->philhealth,

                    $contribution->pagibig,

                    $contribution->hmo,

                    $total

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
