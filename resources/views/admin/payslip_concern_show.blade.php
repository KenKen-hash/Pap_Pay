@php
    $admin = Auth::user();
    $payslip = $concern->payslip;
    $employee = $concern->user;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payslip Concern</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../../khen/assets/css/style.css">

</head>

<body>

<div class="admin-shell">

    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar">

        <div class="sidebar-header">

            <a
                class="brand-mark"
                href="{{ route('admin-dashboard') }}"
            >

                <span class="brand-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </span>

                <span class="brand-copy">

                    <span class="brand-title">
                        Pap Pay
                    </span>

                    <span class="brand-subtitle">
                        Payroll Management
                    </span>

                </span>

            </a>

        </div>


        <nav class="sidebar-nav">

            <a
                class="nav-link"
                href="{{ route('admin-dashboard') }}"
            >

                <span class="nav-icon">
                    <i class="bi bi-house-door"></i>
                </span>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>


            <a
                class="nav-link"
                href="{{ route('payslip_list') }}"
            >

                <span class="nav-icon">
                    <i class="bi bi-receipt"></i>
                </span>

                <span class="nav-text">
                    Payslips
                </span>

            </a>


            <a
                class="nav-link active"
                href="{{ route('admin.payslip-concerns.index') }}"
            >

                <span class="nav-icon">
                    <i class="bi bi-exclamation-circle"></i>
                </span>

                <span class="nav-text">
                    Payslip Concerns
                </span>

            </a>

        </nav>


        <div class="sidebar-user">

            <img
                class="avatar-img avatar-md sidebar-user-avatar"
                src="{{ $admin->photo
                    ? asset('storage/' . $admin->photo)
                    : asset('images/default-avatar.png') }}"
                alt="{{ $admin->name }}"
            >

            <strong>
                {{ $admin->name }}
            </strong>

            <small>
                Administrator
            </small>

        </div>

    </aside>


    <div class="admin-main">

        {{-- NAVBAR --}}

        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">

                <button
                    class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                </button>


                <div class="navbar-actions ms-auto">

                    <div class="dropdown">

                        <button
                            class="profile-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                        >

                            <img
                                class="avatar-img avatar-sm"
                                src="{{ $admin->photo
                                    ? asset('storage/' . $admin->photo)
                                    : asset('images/default-avatar.png') }}"
                                alt="{{ $admin->name }}"
                            >

                            <span class="profile-name d-none d-sm-inline">
                                {{ $admin->name }}
                            </span>

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a
                                    class="dropdown-item"
                                    href="{{ route('my_profile') }}"
                                >
                                    My Profile
                                </a>

                            </li>

                            <li>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item"
                                    >
                                        Sign out
                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </nav>


        {{-- CONTENT --}}

        <main class="dashboard-content">

            <div class="container-fluid px-3 px-lg-4 py-4">


                {{-- BACK BUTTON --}}

                <div class="mb-3">

                    <a
                        href="{{ route('admin.payslip-concerns.index') }}"
                        class="btn btn-outline-secondary"
                    >

                        <i class="bi bi-arrow-left me-1"></i>

                        Back to Concerns

                    </a>

                </div>


                {{-- SUCCESS --}}

                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                @endif


                {{-- ERROR --}}

                @if(session('error'))

                    <div class="alert alert-danger alert-dismissible fade show">

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        {{ session('error') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                @endif


                <div class="row g-4">


                    {{-- LEFT SIDE --}}

                    <div class="col-12 col-xl-8">


                        {{-- EMPLOYEE --}}

                        <section class="panel">

                            <div class="panel-header">

                                <div>

                                    <h2 class="h5 mb-1">
                                        Employee Information
                                    </h2>

                                    <p class="text-muted mb-0">
                                        Employee who submitted this concern
                                    </p>

                                </div>

                            </div>


                            <div class="panel-body">

                                <div class="d-flex align-items-center gap-3">

                                    <img
                                        src="{{ $employee->photo
                                            ? asset('storage/' . $employee->photo)
                                            : asset('images/default-avatar.png') }}"
                                        width="70"
                                        height="70"
                                        class="rounded-circle"
                                        style="object-fit:cover;"
                                    >

                                    <div>

                                        <h5 class="mb-1">
                                            {{ $employee->name }}
                                        </h5>

                                        <p class="text-muted mb-1">
                                            {{ $employee->position }}
                                        </p>

                                        <span class="badge bg-primary">
                                            {{ $employee->department }}
                                        </span>

                                        <span class="badge bg-dark">
                                            ID: {{ $employee->employee_id }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </section>


                        {{-- EMPLOYEE CONCERN --}}

                        <section class="panel mt-4">

                            <div class="panel-header">

                                <div>

                                    <h2 class="h5 mb-1">
                                        Employee's Concern
                                    </h2>

                                </div>

                                <div>

                                    @if($concern->status === 'Pending')

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @elseif($concern->status === 'Reviewed')

                                        <span class="badge bg-info">
                                            Reviewed
                                        </span>

                                    @elseif($concern->status === 'Resolved')

                                        <span class="badge bg-success">
                                            Resolved
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>

                                    @endif

                                </div>

                            </div>


                            <div class="panel-body">

                                <h6>
                                    Reason
                                </h6>

                                <div class="bg-light rounded p-3">

                                    {!! nl2br(e($concern->reason)) !!}

                                </div>


                                {{-- ATTACHMENT --}}

                                @if($concern->attachment)

                                    <div class="mt-4">

                                        <h6>
                                            Employee Attachment
                                        </h6>

                                        <a
                                            href="{{ asset('storage/' . $concern->attachment) }}"
                                            target="_blank"
                                            class="btn btn-outline-primary"
                                        >

                                            <i class="bi bi-paperclip me-1"></i>

                                            View Attachment

                                        </a>

                                    </div>

                                @endif

                            </div>

                        </section>


                        {{-- PAYSLIP --}}

                        @if($payslip)

                            <section class="panel mt-4">

                                <div class="panel-header">

                                    <div>

                                        <h2 class="h5 mb-1">
                                            Payslip Information
                                        </h2>

                                        <p class="text-muted mb-0">
                                            Payslip involved in the concern
                                        </p>

                                    </div>

                                </div>


                                <div class="panel-body">

                                    <div class="row g-3">

                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Pay Period
                                            </small>

                                            <strong class="d-block">
                                                {{ $payslip->period_start->format('M d, Y') }}
                                                -
                                                {{ $payslip->period_end->format('M d, Y') }}
                                            </strong>

                                        </div>


                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Present Days
                                            </small>

                                            <strong class="d-block">
                                                {{ $payslip->present_days }}
                                            </strong>

                                        </div>


                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Daily Rate
                                            </small>

                                            <strong class="d-block">
                                                ₱ {{ number_format($payslip->daily_rate, 2) }}
                                            </strong>

                                        </div>


                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Holiday Pay
                                            </small>

                                            <strong class="d-block">
                                                ₱ {{ number_format($payslip->holiday_pay, 2) }}
                                            </strong>

                                        </div>


                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Overtime
                                            </small>

                                            <strong class="d-block">
                                                ₱ {{ number_format($payslip->ot, 2) }}
                                            </strong>

                                        </div>


                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Gross Salary
                                            </small>

                                            <strong class="d-block">
                                                ₱ {{ number_format($payslip->gross_salary, 2) }}
                                            </strong>

                                        </div>


                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Benefits
                                            </small>

                                            <strong class="d-block">
                                                ₱ {{ number_format($payslip->benefits, 2) }}
                                            </strong>

                                        </div>


                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Late Deduction
                                            </small>

                                            <strong class="d-block">
                                                ₱ {{ number_format($payslip->late_deduction, 2) }}
                                            </strong>

                                        </div>


                                        <div class="col-6 col-md-4">

                                            <small class="text-muted">
                                                Undertime Deduction
                                            </small>

                                            <strong class="d-block">
                                                ₱ {{ number_format($payslip->undertime_deduction, 2) }}
                                            </strong>

                                        </div>


                                        <div class="col-12">

                                            <hr>

                                            <div class="d-flex justify-content-between">

                                                <strong>
                                                    Net Salary
                                                </strong>

                                                <strong class="text-success fs-5">
                                                    ₱ {{ number_format($payslip->net_salary, 2) }}
                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </section>

                        @endif

                    </div>


                    {{-- RIGHT SIDE --}}

                    <div class="col-12 col-xl-4">


                        {{-- ACTIONS --}}

                        <section class="panel">

                            <div class="panel-header">

                                <h2 class="h5 mb-0">
                                    Concern Actions
                                </h2>

                            </div>


                            <div class="panel-body">


                                {{-- RECALCULATE --}}

                                <div class="mb-3">

                                    <h6>
                                        Recalculate
                                    </h6>

                                    <p class="small text-muted">
                                        Recalculate this payslip using the
                                        employee's current salary and
                                        attendance records.
                                    </p>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.payslip-concerns.recalculate',
                                            $concern->id
                                        ) }}"
                                        onsubmit="return confirm(
                                            'Recalculate this payslip using the current payroll records?'
                                        );"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-primary w-100"
                                        >

                                            <i class="bi bi-calculator me-1"></i>

                                            Recalculate Payslip

                                        </button>

                                    </form>

                                </div>


                                <hr>


                                {{-- MANUAL CORRECTION --}}

                                <div class="mb-3">

                                    <h6>
                                        Manual Correction
                                    </h6>

                                    <p class="small text-muted">
                                        Manually change the payroll values
                                        if the employee's concern is valid.
                                    </p>

                                    <a
                                        href="{{ route(
                                            'admin.payslip-concerns.correct',
                                            $concern->id
                                        ) }}"
                                        class="btn btn-outline-primary w-100"
                                    >

                                        <i class="bi bi-pencil-square me-1"></i>

                                        Correct Payslip

                                    </a>

                                </div>


                                <hr>


                                {{-- STATUS --}}

                                <div>

                                    <h6>
                                        Update Status
                                    </h6>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.payslip-concerns.status',
                                            $concern->id
                                        ) }}"
                                    >

                                        @csrf

                                        <div class="mb-3">

                                            <select
                                                name="status"
                                                class="form-select"
                                                required
                                            >

                                                <option
                                                    value="Pending"
                                                    @selected($concern->status === 'Pending')
                                                >
                                                    Pending
                                                </option>

                                                <option
                                                    value="Reviewed"
                                                    @selected($concern->status === 'Reviewed')
                                                >
                                                    Reviewed
                                                </option>

                                                <option
                                                    value="Resolved"
                                                    @selected($concern->status === 'Resolved')
                                                >
                                                    Resolved
                                                </option>

                                                <option
                                                    value="Rejected"
                                                    @selected($concern->status === 'Rejected')
                                                >
                                                    Rejected
                                                </option>

                                            </select>

                                        </div>


                                        <div class="mb-3">

                                            <textarea
                                                name="admin_response"
                                                class="form-control"
                                                rows="4"
                                                placeholder="Write your response to the employee..."
                                            >{{ $concern->admin_response }}</textarea>

                                        </div>


                                        <button
                                            type="submit"
                                            class="btn btn-dark w-100"
                                        >

                                            <i class="bi bi-check2-circle me-1"></i>

                                            Save Response

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </section>

                    </div>

                </div>

            </div>

        </main>

    </div>

</div>


<script src="../../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../../../khen/assets/js/main.js"></script>

</body>

</html>
