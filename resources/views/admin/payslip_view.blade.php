@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            <h3 class="mb-0">
                Employee Payslip
            </h3>

        </div>

        <div class="card-body">

            <h4>
                {{ $payslip->user->first_name }}
                {{ $payslip->user->last_name }}
            </h4>

            <hr>

            <p>

                <strong>Payroll Period:</strong>

                {{ $payslip->period_start }}

                -

                {{ $payslip->period_end }}

            </p>

            <p>

                <strong>Present Days:</strong>

                {{ $payslip->present_days }}

            </p>

            <p>

                <strong>Late Minutes:</strong>

                {{ $payslip->late_minutes }}

            </p>

            <p>

                <strong>Undertime Minutes:</strong>

                {{ $payslip->undertime_minutes }}

            </p>

            <p>

                <strong>Gross Salary:</strong>

                ₱{{ number_format($payslip->gross_salary,2) }}

            </p>

            <p>

                <strong>Benefits:</strong>

                ₱{{ number_format($payslip->benefits,2) }}

            </p>

            <p class="fs-4 text-success">

                <strong>

                    Net Salary:

                    ₱{{ number_format($payslip->net_salary,2) }}

                </strong>

            </p>

        </div>

    </div>

</div>

@endsection