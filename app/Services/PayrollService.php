<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\DepartmentSalaryConfig;
use App\Models\EmployeeSalaryConfig;
use App\Models\User;


class PayrollService
{
    public function compute(User $employee, $startDate, $endDate)
    {
        // Employee configuration
        $config = EmployeeSalaryConfig::where('user_id', $employee->id)->first();

        // Department defaults
        $department = DepartmentSalaryConfig::where(
            'department',
            $employee->department
        )->first();

        // Use employee configuration first; otherwise department defaults
        $dailyRate = $config->daily_rate ?? $department->daily_rate ?? 0;

        $lateRate = $config->late_deduction_rate
            ?? $department->late_deduction_rate
            ?? 0;

        $undertimeRate = $config->undertime_deduction_rate
            ?? $department->undertime_deduction_rate
            ?? 0;

        $sss = $config->sss ?? $department->sss ?? 0;
        $philhealth = $config->philhealth ?? $department->philhealth ?? 0;
        $pagibig = $config->pagibig ?? $department->pagibig ?? 0;
        $hmo = $config->hmo ?? $department->hmo ?? 0;

        $ot = $config->ot_rate ?? 0;
        $honorarium = $config->honorarium ?? 0;
        $teaching = $config->teaching_load ?? 0;

        // Attendance within the selected period
        $attendance = Attendance::where('user_id', $employee->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $presentDays = $attendance
            ->whereIn('status', ['Present', 'Late'])
            ->count();

        $lateMinutes = $attendance->sum('late_minutes');

        $undertimeMinutes = $attendance->sum('undertime_minutes');

        $grossSalary =
            ($dailyRate * $presentDays)
            + $ot
            + $honorarium
            + $teaching;

        $benefits =
            ($sss + $philhealth + $pagibig + $hmo) / 2;

        $lateDeduction =
            $lateMinutes * $lateRate;

        $undertimeDeduction =
            $undertimeMinutes * $undertimeRate;

        $netSalary =
            $grossSalary
            - $benefits
            - $lateDeduction
            - $undertimeDeduction;

        return [
            'present_days' => $presentDays,

            'late_minutes' => $lateMinutes,

            'undertime_minutes' => $undertimeMinutes,

            'gross_salary' => $grossSalary,

            'benefits' => $benefits,

            'late_deduction' => $lateDeduction,

            'undertime_deduction' => $undertimeDeduction,

            'net_salary' => $netSalary,
        ];
    }
}