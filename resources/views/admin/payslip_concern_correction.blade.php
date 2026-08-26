@php
    $employee = $concern->user;
    $payslip = $concern->payslip;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Correct Payslip | Pap Pay</title>

    <link rel="stylesheet" href="{{ asset('khen/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('khen/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('khen/assets/css/style.css') }}">

    <style>
        .correction-header {
            border-radius: 16px;
            padding: 24px;
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
        }

        .employee-card {
            border-radius: 16px;
            border: 1px solid #e5e7eb;
        }

        .employee-avatar {
            width: 75px;
            height: 75px;
            object-fit: cover;
            border-radius: 50%;
        }

        .calculation-card {
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            background: #fff;
        }

        .calculation-card .card-header {
            background: transparent;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 600;
        }

        .amount-input {
            font-weight: 600;
        }

        .summary-card {
            border-radius: 16px;
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
        }

        .net-pay {
            font-size: 1.7rem;
            font-weight: 700;
        }

        .concern-box {
            border-left: 4px solid #ffc107;
            background: #fff8e1;
            border-radius: 8px;
            padding: 16px;
        }

        .original-value {
            color: #6c757d;
            font-size: 0.85rem;
        }

        @media (max-width: 576px) {
            .correction-header {
                padding: 18px;
            }

            .net-pay {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>

<div class="admin-shell">

    <div class="sidebar-backdrop" data-sidebar-close></div>

    {{-- ========================================================= --}}
    {{-- SIDEBAR --}}
    {{-- ========================================================= --}}

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">

        <div class="sidebar-header">

            <a class="brand-mark" href="{{ route('admin-dashboard') }}">

                <span class="brand-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </span>

                <span class="brand-copy">
                    <span class="brand-title">Pap Pay</span>
                    <span class="brand-subtitle">Payroll Management</span>
                </span>

            </a>

        </div>

        <nav class="sidebar-nav">

            <a class="nav-link" href="{{ route('admin-dashboard') }}">
                <span class="nav-icon">
                    <i class="bi bi-house-door"></i>
                </span>
                <span class="nav-text">Dashboard</span>
            </a>

            <a class="nav-link" href="{{ route('attendance_list') }}">
                <span class="nav-icon">
                    <i class="bi bi-calendar-check"></i>
                </span>
                <span class="nav-text">Attendance</span>
            </a>

            <a class="nav-link" href="{{ route('admin.leaves') }}">
                <span class="nav-icon">
                    <i class="bi bi-calendar-plus"></i>
                </span>
                <span class="nav-text">Leave Requests</span>
            </a>

            <a class="nav-link" href="{{ route('official_business') }}">
                <span class="nav-icon">
                    <i class="bi bi-briefcase"></i>
                </span>
                <span class="nav-text">Official Business</span>
            </a>

            <a class="nav-link" href="{{ route('payslip_list') }}">
                <span class="nav-icon">
                    <i class="bi bi-receipt"></i>
                </span>
                <span class="nav-text">Payslips</span>
            </a>

            <a class="nav-link active"
               href="{{ route('admin.payslip-concerns.index') }}">

                <span class="nav-icon">
                    <i class="bi bi-exclamation-circle"></i>
                </span>

                <span class="nav-text">Payslip Concerns</span>

            </a>

            <a class="nav-link" href="{{ route('employees.index') }}">
                <span class="nav-icon">
                    <i class="bi bi-people"></i>
                </span>
                <span class="nav-text">Employees</span>
            </a>

            <a class="nav-link" href="{{ route('payroll') }}">
                <span class="nav-icon">
                    <i class="bi bi-cash-stack"></i>
                </span>
                <span class="nav-text">Payroll</span>
            </a>

            <a class="nav-link" href="{{ route('reports') }}">
                <span class="nav-icon">
                    <i class="bi bi-bar-chart"></i>
                </span>
                <span class="nav-text">Reports</span>
            </a>

        </nav>

    </aside>


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <div class="admin-main">

        {{-- NAVBAR --}}

        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">

                <button
                    class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="true">

                    <span></span>
                    <span></span>
                    <span></span>

                </button>

                <div class="ms-3">

                    <strong>Payslip Correction</strong>

                </div>

                <div class="navbar-actions ms-auto">

                    <div class="dropdown">

                        <button
                            class="profile-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown">

                            <span class="profile-name">
                                Admin
                            </span>

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <form method="POST"
                                      action="{{ route('logout') }}">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item">

                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Sign out

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </nav>


        {{-- ========================================================= --}}
        {{-- CONTENT --}}
        {{-- ========================================================= --}}

        <main class="dashboard-content">

            <div class="container-fluid px-3 px-lg-4 py-4">


                {{-- ================================================= --}}
                {{-- HEADER --}}
                {{-- ================================================= --}}

                <div class="correction-header mb-4">

                    <div class="d-flex align-items-center gap-3">

                        <div>

                            <i class="bi bi-pencil-square fs-2"></i>

                        </div>

                        <div>

                            <div class="small opacity-75">
                                PAYSLIP CONCERN
                            </div>

                            <h1 class="h3 mb-1">
                                Correct Payslip
                            </h1>

                            <p class="mb-0 opacity-75">
                                Review the employee's concern and correct
                                the payroll values if necessary.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SUCCESS / ERROR MESSAGES --}}
                {{-- ================================================= --}}

                @if (session('success'))

                    <div class="alert alert-success alert-dismissible fade show">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif


                @if (session('error'))

                    <div class="alert alert-danger alert-dismissible fade show">

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        {{ session('error') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif


                @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>
                            Please correct the following:
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- EMPLOYEE INFORMATION --}}
                {{-- ================================================= --}}

                <div class="card employee-card mb-4">

                    <div class="card-body">

                        <div class="row align-items-center gy-3">

                            <div class="col-12 col-lg-8">

                                <div class="d-flex align-items-center gap-3">

                                    <img
                                        src="{{ $employee->photo
                                            ? asset('storage/' . $employee->photo)
                                            : asset('images/default-avatar.png') }}"
                                        class="employee-avatar shadow-sm"
                                        alt="{{ $employee->name }}">

                                    <div>

                                        <h4 class="mb-1">
                                            {{ $employee->name }}
                                        </h4>

                                        <p class="text-muted mb-1">

                                            {{ $employee->position ?? 'Employee' }}

                                        </p>

                                        <span class="badge bg-primary">

                                            {{ $employee->department }}

                                        </span>

                                        <span class="badge bg-dark">

                                            ID:
                                            {{ $employee->employee_id }}

                                        </span>

                                    </div>

                                </div>

                            </div>


                            <div class="col-12 col-lg-4 text-lg-end">

                                <div class="text-muted small">
                                    Pay Period
                                </div>

                                <strong>

                                    {{ $payslip->period_start->format('M d, Y') }}

                                    -

                                    {{ $payslip->period_end->format('M d, Y') }}

                                </strong>

                                <div class="mt-2">

                                    <span class="badge bg-warning text-dark">

                                        Concern:
                                        {{ $concern->status }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- EMPLOYEE CONCERN --}}
                {{-- ================================================= --}}

                <div class="card mb-4">

                    <div class="card-header">

                        <i class="bi bi-chat-left-text me-2"></i>

                        Employee's Concern

                    </div>

                    <div class="card-body">

                        <div class="concern-box">

                            <div class="fw-bold mb-2">
                                Reason for Concern
                            </div>

                            <div>
                                {{ $concern->reason }}
                            </div>

                        </div>


                        @if ($concern->attachment)

                            <div class="mt-3">

                                <strong>
                                    <i class="bi bi-paperclip me-1"></i>
                                    Attachment:
                                </strong>

                                <a
                                    href="{{ asset('storage/' . $concern->attachment) }}"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary ms-2">

                                    <i class="bi bi-eye me-1"></i>
                                    View Attachment

                                </a>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- ORIGINAL PAYSLIP --}}
                {{-- ================================================= --}}

                <div class="card calculation-card mb-4">

                    <div class="card-header">

                        <i class="bi bi-receipt me-2"></i>

                        Original Payslip

                    </div>

                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-md-4">

                                <div class="text-muted small">
                                    Gross Salary
                                </div>

                                <strong>
                                    ₱ {{ number_format($payslip->gross_salary, 2) }}
                                </strong>

                            </div>

                            <div class="col-md-4">

                                <div class="text-muted small">
                                    Benefits / Deductions
                                </div>

                                <strong>
                                    ₱ {{ number_format($payslip->benefits, 2) }}
                                </strong>

                            </div>

                            <div class="col-md-4">

                                <div class="text-muted small">
                                    Net Salary
                                </div>

                                <strong class="text-success">
                                    ₱ {{ number_format($payslip->net_salary, 2) }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- CORRECTION FORM --}}
                {{-- ================================================= --}}

                <form
                    method="POST"
                    action="{{ route(
                        'admin.payslip-concerns.update-correction',
                        $concern->id
                    ) }}">

                    @csrf


                    {{-- ============================================= --}}
                    {{-- EARNINGS --}}
                    {{-- ============================================= --}}

                    <div class="card calculation-card mb-4">

                        <div class="card-header">

                            <i class="bi bi-plus-circle me-2 text-success"></i>

                            Earnings

                        </div>

                        <div class="card-body">

                            <div class="row g-3">


                                {{-- DAILY RATE --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">

                                        Daily Rate

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="daily_rate"
                                            id="daily_rate"
                                            class="form-control amount-input"
                                            value="{{ old(
                                                'daily_rate',
                                                $payslip->daily_rate
                                            ) }}"
                                            required>

                                    </div>

                                    <div class="original-value mt-1">

                                        Original:
                                        ₱ {{ number_format($payslip->daily_rate, 2) }}

                                    </div>

                                </div>


                                {{-- OVERTIME --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">

                                        Overtime Pay

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="ot"
                                            id="ot"
                                            class="form-control amount-input"
                                            value="{{ old(
                                                'ot',
                                                $payslip->ot
                                            ) }}"
                                            required>

                                    </div>

                                    <div class="original-value mt-1">

                                        Original:
                                        ₱ {{ number_format($payslip->ot, 2) }}

                                    </div>

                                    <small class="text-muted">

                                        This is the manually entered
                                        overtime amount.

                                    </small>

                                </div>


                                {{-- HONORARIUM --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">

                                        Honorarium

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="honorarium"
                                            id="honorarium"
                                            class="form-control amount-input"
                                            value="{{ old(
                                                'honorarium',
                                                $payslip->honorarium
                                            ) }}"
                                            required>

                                    </div>

                                    <div class="original-value mt-1">

                                        Original:
                                        ₱ {{ number_format($payslip->honorarium, 2) }}

                                    </div>

                                </div>


                                {{-- TEACHING LOAD --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">

                                        Teaching Load

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="teaching_load"
                                            id="teaching_load"
                                            class="form-control amount-input"
                                            value="{{ old(
                                                'teaching_load',
                                                $payslip->teaching_load
                                            ) }}"
                                            required>

                                    </div>

                                    <div class="original-value mt-1">

                                        Original:
                                        ₱ {{ number_format($payslip->teaching_load, 2) }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ============================================= --}}
                    {{-- BENEFITS / DEDUCTIONS --}}
                    {{-- ============================================= --}}

                    <div class="card calculation-card mb-4">

                        <div class="card-header">

                            <i class="bi bi-dash-circle me-2 text-danger"></i>

                            Benefits and Deductions

                        </div>

                        <div class="card-body">

                            <div class="row g-3">


                                {{-- SSS --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        SSS
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="sss"
                                            id="sss"
                                            class="form-control amount-input deduction-input"
                                            value="{{ old(
                                                'sss',
                                                $payslip->sss
                                            ) }}"
                                            required>

                                    </div>

                                </div>


                                {{-- PHILHEALTH --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        PhilHealth
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="philhealth"
                                            id="philhealth"
                                            class="form-control amount-input deduction-input"
                                            value="{{ old(
                                                'philhealth',
                                                $payslip->philhealth
                                            ) }}"
                                            required>

                                    </div>

                                </div>


                                {{-- PAGIBIG --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Pag-IBIG
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="pagibig"
                                            id="pagibig"
                                            class="form-control amount-input deduction-input"
                                            value="{{ old(
                                                'pagibig',
                                                $payslip->pagibig
                                            ) }}"
                                            required>

                                    </div>

                                </div>


                                {{-- HMO --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        HMO
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="hmo"
                                            id="hmo"
                                            class="form-control amount-input deduction-input"
                                            value="{{ old(
                                                'hmo',
                                                $payslip->hmo
                                            ) }}"
                                            required>

                                    </div>

                                </div>


                                {{-- LATE --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">

                                        Late Deduction

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="late_deduction"
                                            id="late_deduction"
                                            class="form-control amount-input deduction-input"
                                            value="{{ old(
                                                'late_deduction',
                                                $payslip->late_deduction
                                            ) }}"
                                            required>

                                    </div>

                                    <div class="original-value mt-1">

                                        Late Minutes:
                                        {{ $payslip->late_minutes }}

                                    </div>

                                </div>


                                {{-- UNDERTIME --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">

                                        Undertime Deduction

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="undertime_deduction"
                                            id="undertime_deduction"
                                            class="form-control amount-input deduction-input"
                                            value="{{ old(
                                                'undertime_deduction',
                                                $payslip->undertime_deduction
                                            ) }}"
                                            required>

                                    </div>

                                    <div class="original-value mt-1">

                                        Undertime Minutes:
                                        {{ $payslip->undertime_minutes }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- LIVE CALCULATION SUMMARY --}}
                    {{-- ================================================= --}}

                    <div class="card summary-card mb-4">

                        <div class="card-body">

                            <h5 class="mb-3">

                                <i class="bi bi-calculator me-2"></i>

                                Corrected Payroll Preview

                            </h5>

                            <div class="row g-3">

                                <div class="col-md-4">

                                    <div class="text-muted small">
                                        Gross Salary
                                    </div>

                                    <div
                                        id="grossPreview"
                                        class="fs-5 fw-bold">

                                        ₱ 0.00

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <div class="text-muted small">
                                        Total Deductions
                                    </div>

                                    <div
                                        id="deductionsPreview"
                                        class="fs-5 fw-bold text-danger">

                                        ₱ 0.00

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <div class="text-muted small">
                                        Corrected Net Salary
                                    </div>

                                    <div
                                        id="netPreview"
                                        class="net-pay text-success">

                                        ₱ 0.00

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- ADMIN RESPONSE --}}
                    {{-- ================================================= --}}

                    <div class="card calculation-card mb-4">

                        <div class="card-header">

                            <i class="bi bi-chat-left-text me-2"></i>

                            Response to Employee

                        </div>

                        <div class="card-body">

                            <label class="form-label fw-semibold">

                                Admin Response

                            </label>

                            <textarea
                                name="admin_response"
                                rows="5"
                                class="form-control"
                                placeholder="Explain what was corrected and why..."
                                required>{{ old(
                                    'admin_response',
                                    $concern->admin_response
                                ) }}</textarea>

                            <small class="text-muted">

                                This response will be saved with the
                                payslip concern and can be shown to the
                                employee.

                            </small>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- ACTION BUTTONS --}}
                    {{-- ================================================= --}}

                    <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-5">

                        <a
                            href="{{ route(
                                'admin.payslip-concerns.show',
                                $concern->id
                            ) }}"
                            class="btn btn-outline-secondary">

                            <i class="bi bi-arrow-left me-1"></i>

                            Back to Concern

                        </a>


                        <button
                            type="submit"
                            class="btn btn-success px-4">

                            <i class="bi bi-check-circle me-1"></i>

                            Save Correction & Resolve Concern

                        </button>

                    </div>

                </form>

            </div>

        </main>


        {{-- FOOTER --}}

        <footer class="admin-footer">

            <div class="container-fluid px-3 px-lg-4">

                <span>
                    Copyright 2026 Pap Pay.
                </span>

                <span>
                    Payroll Management System
                </span>

            </div>

        </footer>

    </div>

</div>


<script src="{{ asset('khen/assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('khen/assets/js/main.js') }}"></script>


<script>
    /*
    |--------------------------------------------------------------------------
    | Live Payslip Calculation
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    | Overtime is manually entered by the admin.
    | We DO NOT calculate overtime from attendance here.
    |
    */

    function getValue(id) {

        const element = document.getElementById(id);

        if (!element) {
            return 0;
        }

        return parseFloat(element.value) || 0;
    }


    function formatMoney(value) {

        return '₱ ' + value.toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

    }


    function calculatePayslip() {

        /*
        |--------------------------------------------------------------------------
        | Earnings
        |--------------------------------------------------------------------------
        */

        const dailyRate = getValue('daily_rate');

        const overtime = getValue('ot');

        const honorarium = getValue('honorarium');

        const teachingLoad = getValue('teaching_load');


        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        | Your current controller calculates gross salary as:
        |
        | daily_rate
        | + ot
        | + honorarium
        | + teaching_load
        |
        | This Blade follows the SAME calculation.
        |
        */

        const grossSalary =
            dailyRate +
            overtime +
            honorarium +
            teachingLoad;


        /*
        |--------------------------------------------------------------------------
        | Deductions
        |--------------------------------------------------------------------------
        */

        const sss = getValue('sss');

        const philhealth = getValue('philhealth');

        const pagibig = getValue('pagibig');

        const hmo = getValue('hmo');

        const lateDeduction =
            getValue('late_deduction');

        const undertimeDeduction =
            getValue('undertime_deduction');


        const totalDeductions =
            sss +
            philhealth +
            pagibig +
            hmo +
            lateDeduction +
            undertimeDeduction;


        /*
        |--------------------------------------------------------------------------
        | Net Salary
        |--------------------------------------------------------------------------
        */

        const netSalary =
            grossSalary -
            totalDeductions;


        /*
        |--------------------------------------------------------------------------
        | Display
        |--------------------------------------------------------------------------
        */

        document.getElementById('grossPreview').textContent =
            formatMoney(grossSalary);

        document.getElementById('deductionsPreview').textContent =
            formatMoney(totalDeductions);

        document.getElementById('netPreview').textContent =
            formatMoney(netSalary);

    }


    /*
    |--------------------------------------------------------------------------
    | Listen for Changes
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll(
        'input[type="number"]'
    ).forEach(function (input) {

        input.addEventListener(
            'input',
            calculatePayslip
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Initial Calculation
    |--------------------------------------------------------------------------
    */

    calculatePayslip();

</script>

</body>

</html>
