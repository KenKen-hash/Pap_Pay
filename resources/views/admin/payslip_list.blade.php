<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Pap Pay Payroll and Payslip Management">
    <meta name="theme-color" content="#172554">

    <title>Payslip | Pap Pay</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>

        .department-card {
            cursor: pointer;
            transition: .25s;
        }

        .department-card:hover {
            transform: translateY(-3px);
            border-color: #198754;
            box-shadow: 0 0 15px rgba(25, 135, 84, .15);
        }

        /*
        ============================================================
        PAYROLL PREVIEW TABLE
        ============================================================
        */

        .payroll-preview-wrapper {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            border-radius: 8px;
        }

        .payroll-preview-table {
            min-width: 2050px;
            margin-bottom: 0;
        }

        .payroll-preview-table th {
            white-space: nowrap;
            vertical-align: middle;
            font-size: 12px;
        }

        .payroll-preview-table td {
            vertical-align: middle;
            white-space: nowrap;
            font-size: 13px;
        }

        /*
        ============================================================
        CONFIGURATION BADGES
        ============================================================
        */

        .config-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            font-size: 12px;
            font-weight: 600;
        }

        /*
        ============================================================
        MONEY
        ============================================================
        */

        .money-positive {
            color: #198754;
            font-weight: 700;
        }

        .money-negative {
            color: #dc3545;
            font-weight: 700;
        }

        /*
        ============================================================
        MINUTES
        ============================================================
        */

        .minutes-badge {
            min-width: 70px;
            display: inline-block;
            text-align: center;
        }

        /*
        ============================================================
        PREVIEW SUMMARY
        ============================================================
        */

        .preview-summary-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            background: #fff;
            height: 100%;
        }

        .preview-summary-label {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .preview-summary-value {
            font-size: 20px;
            font-weight: 700;
        }

        /*
        ============================================================
        EMPLOYEE CONTAINER
        ============================================================
        */

        .employee-config-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px;
            margin-top: 10px;
        }

        /*
        ============================================================
        PAYROLL PERIOD BADGE
        ============================================================
        */

        .payroll-period-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            background: #eef6ff;
            border: 1px solid #cfe2ff;
            color: #0d6efd;
            font-size: 12px;
            font-weight: 600;
        }

        /*
        ============================================================
        MOBILE
        ============================================================
        */

        @media (max-width: 768px) {

            .payroll-preview-table {
                min-width: 2050px;
            }

            .preview-summary-value {
                font-size: 18px;
            }

        }

    </style>

</head>


<body>

<div class="admin-shell">

    <div class="sidebar-backdrop" data-sidebar-close></div>


    <!-- ============================================================
         SIDEBAR
         ============================================================ -->

    <aside class="admin-sidebar"
           id="adminSidebar"
           aria-label="Main navigation">

        <div class="sidebar-header">

            <a class="brand-mark"
               href="{{ route('admin-dashboard') }}"
               aria-label="Admin Dashboard">

                <img src="../../../khen/assets/images/logo.jpg"
                     alt="Pap Pay Logo"
                     class="brand-logo">

            </a>

        </div>


        <nav class="sidebar-nav">

            <a class="nav-link"
               href="{{ route('admin-dashboard') }}">

                <span class="nav-icon">
                    <i class="bi bi-speedometer2"></i>
                </span>

                <span class="nav-text">
                    Home
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('employees.index') }}">

                <span class="nav-icon">
                    <i class="bi bi-people"></i>
                </span>

                <span class="nav-text">
                    Employees
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('attendance_list') }}">

                <span class="nav-icon">
                    <i class="bi bi-calendar-check"></i>
                </span>

                <span class="nav-text">
                    Attendance
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('admin.leaves') }}">

                <span class="nav-icon">
                    <i class="bi bi-calendar-x"></i>
                </span>

                <span class="nav-text">
                    Leave Requests
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('official_business') }}">

                <span class="nav-icon">
                    <i class="bi bi-briefcase"></i>
                </span>

                <span class="nav-text">
                    Official Business (OB)
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('holidays.index') }}">

                <span class="nav-icon">
                    <i class="bi bi-gear"></i>
                </span>

                <span class="nav-text">
                    Holidays
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('payroll') }}">

                <span class="nav-icon">
                    <i class="bi bi-cash-stack"></i>
                </span>

                <span class="nav-text">
                    Payroll
                </span>

            </a>


            <a class="nav-link active"
               href="{{ route('payslip_list') }}">

                <span class="nav-icon">
                    <i class="bi bi-receipt"></i>
                </span>

                <span class="nav-text">
                    Payslips
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('admin.payslip-concerns.index') }}">

                <span class="nav-icon">
                    <i class="bi bi-exclamation-circle"></i>
                </span>

                <span class="nav-text">
                    Payslip Concerns
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('reports') }}">

                <span class="nav-icon">
                    <i class="bi bi-bar-chart"></i>
                </span>

                <span class="nav-text">
                    Reports
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('announcements') }}">

                <span class="nav-icon">
                    <i class="bi bi-megaphone"></i>
                </span>

                <span class="nav-text">
                    Announcements
                </span>

            </a>

        </nav>


        <!-- SIDEBAR USER -->

        <div class="sidebar-user">

            <img class="avatar-img avatar-md sidebar-user-avatar"
                 src="{{ Auth::user()->photo
                    ? asset('storage/' . Auth::user()->photo)
                    : asset('khen/assets/images/avatar/avatar.jpg') }}"
                 alt="{{ Auth::user()->name }}">

            <strong>
                {{ Auth::user()->name }}
            </strong>

            <small>
                {{ ucfirst(Auth::user()->role ?? 'Employee') }}
            </small>

        </div>


        <div class="sidebar-footer">

            <span class="status-dot"></span>

            <span class="sidebar-footer-text">
                System running smoothly
            </span>

        </div>

    </aside>


    <!-- ============================================================
         MAIN
         ============================================================ -->

    <div class="admin-main">


        <!-- ========================================================
             NAVBAR
             ======================================================== -->

        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">

                <button class="sidebar-toggle"
                        type="button"
                        data-sidebar-toggle
                        aria-controls="adminSidebar"
                        aria-expanded="true"
                        aria-label="Toggle sidebar">

                    <span></span>
                    <span></span>
                    <span></span>

                </button>


                <form class="d-none d-md-flex ms-3 flex-grow-1"
                      role="search">

                    <input class="form-control search-input"
                           type="search"
                           placeholder="Search users, orders, reports"
                           aria-label="Search">

                </form>


                <div class="navbar-actions ms-auto">


                    <!-- THEME -->

                    <button class="icon-button theme-toggle"
                            type="button"
                            data-theme-toggle
                            aria-label="Switch color theme"
                            title="Switch color theme">

                        <i class="bi bi-moon-stars"
                           data-theme-icon
                           aria-hidden="true"></i>

                    </button>


                    <!-- NOTIFICATIONS -->

                    <div class="dropdown">

                        <button class="icon-button"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                aria-label="Notifications">

                            @if (($unreadNotifications ?? 0) > 0)

                                <span class="notification-dot"></span>

                            @endif

                            <i class="bi bi-bell"
                               aria-hidden="true"></i>

                        </button>


                        <div class="dropdown-menu dropdown-menu-end notification-menu">

                            <div class="dropdown-header fw-bold text-body">
                                Notifications
                            </div>


                            @forelse($notifications ?? [] as $notification)

                                <a class="dropdown-item {{ !$notification->is_read ? 'notification-unread' : '' }}"
                                   href="{{ route('admin.notifications.read', $notification->id) }}">

                                    <span class="notification-title">
                                        {{ $notification->title }}
                                    </span>

                                    <span class="notification-message">
                                        {{ $notification->message }}
                                    </span>

                                    <span class="notification-time">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>

                                </a>

                            @empty

                                <div class="dropdown-item text-muted text-center py-3">

                                    <i class="bi bi-bell-slash"></i>

                                    <br>

                                    No notifications

                                </div>

                            @endforelse


                            <div class="dropdown-divider"></div>


                            <a href="{{ route('admin.notifications') }}"
                               class="dropdown-item text-center">

                                View all notifications

                            </a>

                        </div>

                    </div>


                    <!-- PROFILE -->

                    <div class="dropdown">

                        <button class="profile-button dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                            <img class="avatar-img avatar-sm"
                                 src="{{ Auth::user()->photo
                                    ? asset('storage/' . Auth::user()->photo)
                                    : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                 alt="{{ Auth::user()->name }}">

                            <span class="profile-name d-none d-sm-inline">
                                {{ Auth::user()->name }}
                            </span>

                        </button>


                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <form method="POST"
                                      action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                            class="dropdown-item">

                                        Sign out

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </nav>


        <!-- ========================================================
             PAGE CONTENT
             ======================================================== -->

        <main class="dashboard-content">

            <div class="container-fluid px-3 px-lg-4 py-4">


                <!-- PAGE HEADER -->

                <div class="page-heading mb-4">

                    <div class="page-heading-copy">

                        <div>

                            <h1 class="h3 mb-1">
                                Payslip Management
                            </h1>

                            <p class="text-muted mb-0">
                                Generate, distribute, and manage employee payslips for every payroll cycle.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     GENERATE PAYSLIPS
                     ================================================= -->

                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-white">

                        <h4 class="fw-bold mb-0">

                            <i class="bi bi-receipt-cutoff text-success me-2"></i>

                            Generate Employee Payslips

                        </h4>

                    </div>


                    <div class="card-body">


                        <!-- PAYROLL PERIOD -->

                        <div class="row mb-4">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Payroll Start Date
                                </label>

                                <input type="date"
                                       id="period_start"
                                       class="form-control">

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Payroll End Date
                                </label>

                                <input type="date"
                                       id="period_end"
                                       class="form-control">

                            </div>

                        </div>


                        <hr>


                        <!-- DEPARTMENTS -->

                        <h5 class="fw-bold mb-3">
                            Select Department(s)
                        </h5>


                        <div class="row">

                            @php

                                $departments = [
                                    'Elementary',
                                    'JHS',
                                    'SHS',
                                    'College',
                                    'Admin',
                                    'Laborers'
                                ];

                            @endphp


                            @foreach ($departments as $department)

                                <div class="col-lg-4 col-md-6 mb-3">

                                    <div class="card border department-card h-100">

                                        <div class="card-body">

                                            <div class="form-check">

                                                <input
                                                    class="form-check-input department-checkbox"
                                                    type="checkbox"
                                                    value="{{ $department }}"
                                                    id="{{ $department }}"
                                                >


                                                <label
                                                    class="form-check-label fw-semibold"
                                                    for="{{ $department }}"
                                                >

                                                    {{ $department }}

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        <hr>


                        <!-- EMPLOYEES -->

                        <h5 class="fw-bold mb-3">
                            Employees
                        </h5>


                        <div id="employeeContainer"
                             class="border rounded p-4 bg-light">

                            <div class="text-center text-muted">

                                <i class="bi bi-people fs-1"></i>

                                <p class="mt-3 mb-0">
                                    Select one or more departments to load employees.
                                </p>

                            </div>

                        </div>


                        <!-- BUTTONS -->

                        <div class="text-end mt-4">

                            <button
                                class="btn btn-success btn-lg"
                                id="previewPayroll"
                            >

                                <i class="bi bi-search me-2"></i>

                                Preview Payroll

                            </button>


                            <button
                                class="btn btn-primary btn-lg ms-2 d-none"
                                id="generatePayslips"
                            >

                                <i class="bi bi-file-earmark-text me-2"></i>

                                Generate Payslips

                            </button>

                        </div>


                        <!-- =================================================
                             PAYROLL PREVIEW
                             ================================================= -->

                        <div
                            id="payrollPreviewSection"
                            class="card shadow mt-4 d-none"
                        >

                            <div class="card-header bg-success text-white">

                                <h5 class="mb-0">
                                    Payroll Preview
                                </h5>

                            </div>


                            <div class="card-body">


                                <!-- SUMMARY -->

                                <div class="row g-3 mb-4">


                                    <div class="col-xl-3 col-md-6">

                                        <div class="preview-summary-card">

                                            <div class="preview-summary-label">
                                                Employees
                                            </div>

                                            <div
                                                class="preview-summary-value"
                                                id="summaryEmployees"
                                            >
                                                0
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-xl-3 col-md-6">

                                        <div class="preview-summary-card">

                                            <div class="preview-summary-label">
                                                Total Late Minutes
                                            </div>

                                            <div
                                                class="preview-summary-value text-danger"
                                                id="summaryLate"
                                            >
                                                0 min
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-xl-3 col-md-6">

                                        <div class="preview-summary-card">

                                            <div class="preview-summary-label">
                                                Total Undertime Minutes
                                            </div>

                                            <div
                                                class="preview-summary-value text-warning"
                                                id="summaryUndertime"
                                            >
                                                0 min
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-xl-3 col-md-6">

                                        <div class="preview-summary-card">

                                            <div class="preview-summary-label">
                                                Total Overtime Minutes
                                            </div>

                                            <div
                                                class="preview-summary-value text-success"
                                                id="summaryOvertime"
                                            >
                                                0 min
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <!-- TABLE -->

                                <div class="payroll-preview-wrapper">

                                    <table class="table table-bordered table-hover payroll-preview-table">

                                        <thead class="table-success">

                                            <tr>

                                                <th>
                                                    Employee
                                                </th>

                                                <th>
                                                    Department
                                                </th>

                                                <th>
                                                    Payroll Period
                                                </th>

                                                <th>
                                                    Basic Salary
                                                </th>

                                                <th>
                                                    Daily Rate
                                                </th>

                                                <th>
                                                    Attendance
                                                </th>

                                                <th>
                                                    Holidays
                                                </th>

                                                <th>
                                                    Worked Holidays
                                                </th>

                                                <th>
                                                    Holiday Pay
                                                </th>

                                                <th>
                                                    Additional Earnings
                                                </th>

                                                <th>
                                                    Teaching Load Pay
                                                </th>

                                                <th>
                                                    OT Rate / Hour
                                                </th>

                                                <th>
                                                    Late Deduction / Min
                                                </th>

                                                <th>
                                                    Undertime Deduction / Min
                                                </th>

                                                <th>
                                                    Late Minutes
                                                </th>

                                                <th>
                                                    Undertime Minutes
                                                </th>

                                                <th>
                                                    Overtime Minutes
                                                </th>

                                                <th>
                                                    Overtime Pay
                                                </th>

                                                <th>
                                                    Late Deduction
                                                </th>

                                                <th>
                                                    Undertime Deduction
                                                </th>

                                                <th>
                                                    Gross Salary
                                                </th>

                                                <th>
                                                    Benefits
                                                </th>

                                                <th>
                                                    Net Salary
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody id="payrollPreviewBody">

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     GENERATED PAYSLIPS
                     ================================================= -->

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white border-0 py-3">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">

                                    <i class="bi bi-clock-history text-primary me-2"></i>

                                    Generated Payslips

                                </h5>

                                <small class="text-muted">
                                    History of all generated payroll payslips.
                                </small>

                            </div>


                            <button
                                class="btn btn-outline-success btn-sm"
                                onclick="location.reload()"
                            >

                                <i class="bi bi-arrow-repeat me-2"></i>

                                Refresh

                            </button>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead class="table-light">

                                    <tr>

                                        <th>
                                            #
                                        </th>

                                        <th>
                                            Payroll Period
                                        </th>

                                        <th>
                                            Employees
                                        </th>

                                        <th>
                                            Generated On
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th class="text-center">
                                            Actions
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($payslips as $period => $items)

                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>


                                            <td>

                                                {{ \Carbon\Carbon::parse($items->first()->period_start)->format('M d, Y') }}

                                                -

                                                {{ \Carbon\Carbon::parse($items->first()->period_end)->format('M d, Y') }}

                                            </td>


                                            <td>
                                                {{ $items->count() }} Employees
                                            </td>


                                            <td>
                                                {{ $items->first()->created_at->format('M d, Y h:i A') }}
                                            </td>


                                            <td>

                                                <span class="badge bg-success">

                                                    {{ $items->first()->status }}

                                                </span>

                                            </td>


                                            <td class="text-center">

                                                <a
                                                    href="{{ route('admin.payslips.history', [
                                                        'period_start' => $items->first()->period_start,
                                                        'period_end' => $items->first()->period_end,
                                                    ]) }}"
                                                    class="btn btn-sm btn-outline-primary"
                                                    title="View payslips"
                                                >

                                                    <i class="bi bi-eye"></i>

                                                </a>


                                                <a
                                                    href="{{ route('admin.payslips.download', [
                                                        'period_start' => $items->first()->period_start,
                                                        'period_end' => $items->first()->period_end,
                                                    ]) }}"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Download PDF"
                                                >

                                                    <i class="bi bi-file-earmark-pdf"></i>

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="6"
                                                class="text-center text-muted"
                                            >

                                                No generated payslips yet.

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </main>


        <!-- FOOTER -->

        <footer class="admin-footer">

            <div class="container-fluid px-3 px-lg-4">
            </div>

        </footer>

    </div>

</div>


<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../../khen/assets/js/main.js"></script>


<script>

    /*
    ================================================================
    ELEMENTS
    ================================================================
    */

    const employeeContainer =
        document.getElementById('employeeContainer');

    const departmentCheckboxes =
        document.querySelectorAll('.department-checkbox');


    /*
    ================================================================
    LOAD EMPLOYEES
    ================================================================
    */

    departmentCheckboxes.forEach(box => {

        box.addEventListener(
            'change',
            loadEmployees
        );

    });


    function loadEmployees() {

        const selectedDepartments = [];


        document
            .querySelectorAll('.department-checkbox:checked')
            .forEach(box => {

                selectedDepartments.push(
                    box.value
                );

            });


        if (selectedDepartments.length === 0) {

            employeeContainer.innerHTML = `

                <div class="text-center text-muted">

                    <i class="bi bi-people fs-1"></i>

                    <p class="mt-3 mb-0">
                        Select one or more departments to load employees.
                    </p>

                </div>

            `;

            document
                .getElementById('payrollPreviewSection')
                .classList.add('d-none');

            document
                .getElementById('generatePayslips')
                .classList.add('d-none');

            return;

        }


        const params =
            new URLSearchParams();


        selectedDepartments.forEach(
            department => {

                params.append(
                    'departments[]',
                    department
                );

            }
        );


        fetch(
            "{{ route('payslip.employees') }}?" +
            params.toString()
        )

        .then(response => {

            if (!response.ok) {

                throw new Error(
                    'Failed to load employees.'
                );

            }

            return response.json();

        })

        .then(employees => {

            let html = `

                <div class="form-check mb-3">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="selectAll"
                        checked
                    >

                    <label
                        class="form-check-label fw-bold"
                        for="selectAll"
                    >
                        Select All
                    </label>

                </div>

                <hr>

            `;


            if (!employees.length) {

                html += `

                    <div class="text-center text-muted py-3">

                        <i class="bi bi-person-x fs-2"></i>

                        <p class="mt-2 mb-0">
                            No employees found.
                        </p>

                    </div>

                `;

            }


            employees.forEach(employee => {

                const fullName =
                    `${employee.first_name ?? ''} ${employee.last_name ?? ''}`.trim();


                html += `

                    <div class="form-check mb-2">

                        <input
                            class="form-check-input employee-checkbox"
                            type="checkbox"
                            checked
                            value="${employee.id}"
                        >

                        <label class="form-check-label">

                            <strong>
                                ${fullName}
                            </strong>

                            <br>

                            <small class="text-muted">

                                ${employee.employee_id ?? ''}

                                •

                                ${employee.department ?? ''}

                            </small>

                        </label>

                    </div>

                `;

            });


            employeeContainer.innerHTML =
                html;


            const selectAll =
                document.getElementById('selectAll');


            if (selectAll) {

                selectAll.addEventListener(
                    'change',
                    function() {

                        document
                            .querySelectorAll('.employee-checkbox')
                            .forEach(box => {

                                box.checked =
                                    this.checked;

                            });

                    }
                );

            }

        })

        .catch(error => {

            console.error(error);

            employeeContainer.innerHTML = `

                <div class="alert alert-danger mb-0">

                    <i class="bi bi-exclamation-triangle me-2"></i>

                    Unable to load employees.

                </div>

            `;

        });

    }


    /*
    ================================================================
    MONEY FORMATTER
    ================================================================
    */

    function money(value) {

        const amount =
            Number(value ?? 0);


        return '₱ ' +
            amount.toLocaleString(
                undefined,
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }
            );

    }


    /*
    ================================================================
    NUMBER FORMATTER
    ================================================================
    */

    function number(value) {

        return Number(value ?? 0)
            .toLocaleString(
                undefined,
                {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                }
            );

    }


    /*
    ================================================================
    PAYROLL PREVIEW
    ================================================================

    IMPORTANT:

    The browser DOES NOT calculate payroll anymore.

    All payroll values come directly from:

        PayrollController::calculatePayroll()

    This prevents the preview from using old variables or formulas.
    ================================================================
    */

    document
        .getElementById('previewPayroll')
        .addEventListener(
            'click',
            function() {


                const start =
                    document
                        .getElementById('period_start')
                        .value;


                const end =
                    document
                        .getElementById('period_end')
                        .value;


                const employees = [];


                document
                    .querySelectorAll(
                        '.employee-checkbox:checked'
                    )
                    .forEach(box => {

                        employees.push(
                            box.value
                        );

                    });


                if (!start || !end) {

                    alert(
                        'Please select the payroll start date and end date.'
                    );

                    return;

                }


                if (new Date(start) > new Date(end)) {

                    alert(
                        'Payroll start date cannot be later than the payroll end date.'
                    );

                    return;

                }


                if (employees.length === 0) {

                    alert(
                        'Please select at least one employee.'
                    );

                    return;

                }


                const button = this;


                button.disabled = true;


                button.innerHTML = `

                    <span class="spinner-border spinner-border-sm me-2"></span>

                    Calculating...

                `;


                fetch(
                    "{{ route('payslip.preview') }}",
                    {

                        method: "POST",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "X-CSRF-TOKEN":
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    .content,

                            "Accept":
                                "application/json"

                        },

                        body: JSON.stringify({

                            period_start:
                                start,

                            period_end:
                                end,

                            employees:
                                employees

                        })

                    }
                )

                .then(response => {

                    if (!response.ok) {

                        return response
                            .json()
                            .then(error => {

                                throw error;

                            });

                    }

                    return response.json();

                })

                .then(data => {

                    if (!data.success) {

                        throw new Error(
                            data.message ??
                            'Unable to calculate payroll.'
                        );

                    }


                    const tbody =
                        document.getElementById(
                            'payrollPreviewBody'
                        );


                    tbody.innerHTML = '';


                    let totalLate = 0;

                    let totalUndertime = 0;

                    let totalOvertime = 0;


                    /*
                    ====================================================
                    NO EMPLOYEES RETURNED
                    ====================================================
                    */

                    if (
                        !Array.isArray(data.preview) ||
                        data.preview.length === 0
                    ) {

                        tbody.innerHTML = `

                            <tr>

                                <td
                                    colspan="23"
                                    class="text-center text-muted py-4"
                                >

                                    <i class="bi bi-person-x fs-3"></i>

                                    <div class="mt-2">
                                        No payroll records were returned.
                                    </div>

                                    <small>
                                        Check the selected employees,
                                        salary configuration, and payroll dates.
                                    </small>

                                </td>

                            </tr>

                        `;

                    }


                    /*
                    ====================================================
                    DISPLAY SERVER CALCULATIONS
                    ====================================================
                    */

                    data.preview.forEach(employee => {


                        /*
                        ------------------------------------------------
                        ACTUAL SALARY CONFIGURATION
                        ------------------------------------------------
                        */

                        const basicSalary =
                            Number(
                                employee.basic_salary ?? 0
                            );


                        const dailyRate =
                            Number(
                                employee.daily_rate ?? 0
                            );


                        const overtimeRate =
                            Number(
                                employee.overtime_rate ?? 0
                            );


                        const lateRate =
                            Number(
                                employee.late_deduction_rate ?? 0
                            );


                        const undertimeRate =
                            Number(
                                employee.undertime_deduction_rate ?? 0
                            );


                        /*
                        ------------------------------------------------
                        ACTUAL ATTENDANCE
                        ------------------------------------------------
                        */

                        const attendance =
                            Number(
                                employee.present_days ??
                                employee.total_attendance ??
                                0
                            );


                        const holidays =
                            Number(
                                employee.total_holidays ?? 0
                            );


                        const workedHolidays =
                            Number(
                                employee.worked_holidays ?? 0
                            );


                        const lateMinutes =
                            Number(
                                employee.late_minutes ?? 0
                            );


                        const undertimeMinutes =
                            Number(
                                employee.undertime_minutes ?? 0
                            );


                        const overtimeMinutes =
                            Number(
                                employee.overtime_minutes ?? 0
                            );


                        /*
                        ------------------------------------------------
                        ACTUAL PAYROLL RESULTS
                        ------------------------------------------------
                        */

                        const holidayPay =
                            Number(
                                employee.holiday_pay ?? 0
                            );


                        const additionalEarnings =
                            Number(
                                employee.additional_earnings_total ?? 0
                            );


                        const teachingLoadPay =
                            Number(
                                employee.additional_teaching_load_pay ??
                                employee.teaching_load ??
                                0
                            );


                        const overtimePay =
                            Number(
                                employee.overtime_pay ?? 0
                            );


                        const lateDeduction =
                            Number(
                                employee.late_deduction ?? 0
                            );


                        const undertimeDeduction =
                            Number(
                                employee.undertime_deduction ?? 0
                            );


                        const grossSalary =
                            Number(
                                employee.gross_salary ?? 0
                            );


                        const benefits =
                            Number(
                                employee.benefits ?? 0
                            );


                        const netSalary =
                            Number(
                                employee.net_salary ?? 0
                            );


                        /*
                        ------------------------------------------------
                        PAYROLL PERIOD
                        ------------------------------------------------
                        */

                        const payrollPeriod =
                            employee.payroll_period ??
                            (
                                employee.is_weekly_payroll
                                    ? 'Weekly'
                                    : 'Every 15 Days'
                            );


                        /*
                        ------------------------------------------------
                        SUMMARY
                        ------------------------------------------------
                        */

                        totalLate +=
                            lateMinutes;


                        totalUndertime +=
                            undertimeMinutes;


                        totalOvertime +=
                            overtimeMinutes;


                        /*
                        ------------------------------------------------
                        TABLE ROW
                        ------------------------------------------------
                        */

                        tbody.innerHTML += `

                            <tr>

                                <!-- EMPLOYEE -->

                                <td>

                                    <strong>
                                        ${employee.name ?? ''}
                                    </strong>

                                </td>


                                <!-- DEPARTMENT -->

                                <td>
                                    ${employee.department ?? ''}
                                </td>


                                <!-- PAYROLL PERIOD -->

                                <td>

                                    <span class="payroll-period-badge">

                                        ${payrollPeriod}

                                    </span>

                                </td>


                                <!-- BASIC SALARY -->

                                <td>
                                    ${money(basicSalary)}
                                </td>


                                <!-- DAILY RATE -->

                                <td>
                                    ${money(dailyRate)}
                                </td>


                                <!-- ATTENDANCE -->

                                <td class="text-center fw-bold">

                                    ${number(attendance)} day(s)

                                </td>


                                <!-- HOLIDAYS -->

                                <td class="text-center">

                                    ${number(holidays)}

                                </td>


                                <!-- WORKED HOLIDAYS -->

                                <td class="text-center">

                                    ${number(workedHolidays)}

                                </td>


                                <!-- HOLIDAY PAY -->

                                <td class="money-positive">

                                    ${money(holidayPay)}

                                </td>


                                <!-- ADDITIONAL EARNINGS -->

                                <td class="money-positive">

                                    ${money(additionalEarnings)}

                                </td>


                                <!-- TEACHING LOAD PAY -->

                                <td class="money-positive">

                                    ${money(teachingLoadPay)}

                                </td>


                                <!-- OVERTIME RATE -->

                                <td>

                                    <span class="config-badge">

                                        ${money(overtimeRate)}
                                        / hour

                                    </span>

                                </td>


                                <!-- LATE RATE -->

                                <td>

                                    <span class="config-badge">

                                        ${money(lateRate)}
                                        / min

                                    </span>

                                </td>


                                <!-- UNDERTIME RATE -->

                                <td>

                                    <span class="config-badge">

                                        ${money(undertimeRate)}
                                        / min

                                    </span>

                                </td>


                                <!-- LATE MINUTES -->

                                <td class="text-center">

                                    <span class="badge bg-danger minutes-badge">

                                        ${number(lateMinutes)}
                                        min

                                    </span>

                                </td>


                                <!-- UNDERTIME MINUTES -->

                                <td class="text-center">

                                    <span class="badge bg-warning text-dark minutes-badge">

                                        ${number(undertimeMinutes)}
                                        min

                                    </span>

                                </td>


                                <!-- OVERTIME MINUTES -->

                                <td class="text-center">

                                    <span class="badge bg-success minutes-badge">

                                        ${number(overtimeMinutes)}
                                        min

                                    </span>

                                </td>


                                <!-- OVERTIME PAY -->

                                <td class="money-positive">

                                    ${money(overtimePay)}

                                </td>


                                <!-- LATE DEDUCTION -->

                                <td class="money-negative">

                                    - ${money(lateDeduction)}

                                </td>


                                <!-- UNDERTIME DEDUCTION -->

                                <td class="money-negative">

                                    - ${money(undertimeDeduction)}

                                </td>


                                <!-- GROSS -->

                                <td class="fw-bold">

                                    ${money(grossSalary)}

                                </td>


                                <!-- BENEFITS -->

                                <td>

                                    ${money(benefits)}

                                </td>


                                <!-- NET -->

                                <td class="fw-bold text-success">

                                    ${money(netSalary)}

                                </td>

                            </tr>

                        `;

                    });


                    /*
                    ====================================================
                    UPDATE SUMMARY
                    ====================================================
                    */

                    document.getElementById(
                        'summaryEmployees'
                    ).textContent =
                        data.preview.length;


                    document.getElementById(
                        'summaryLate'
                    ).textContent =
                        `${number(totalLate)} min`;


                    document.getElementById(
                        'summaryUndertime'
                    ).textContent =
                        `${number(totalUndertime)} min`;


                    document.getElementById(
                        'summaryOvertime'
                    ).textContent =
                        `${number(totalOvertime)} min`;


                    /*
                    ====================================================
                    SHOW PREVIEW
                    ====================================================
                    */

                    document
                        .getElementById(
                            'payrollPreviewSection'
                        )
                        .classList.remove(
                            'd-none'
                        );


                    /*
                    ====================================================
                    SHOW GENERATE BUTTON
                    ====================================================
                    */

                    document
                        .getElementById(
                            'generatePayslips'
                        )
                        .classList.remove(
                            'd-none'
                        );

                })

                .catch(error => {

                    console.error(error);


                    let message =
                        'An error occurred while calculating payroll.';


                    if (error?.message) {

                        message =
                            error.message;

                    }


                    if (
                        error?.errors &&
                        typeof error.errors === 'object'
                    ) {

                        const validationMessages = [];


                        Object.values(
                            error.errors
                        ).forEach(messages => {

                            if (Array.isArray(messages)) {

                                messages.forEach(message => {

                                    validationMessages.push(
                                        message
                                    );

                                });

                            }

                        });


                        if (validationMessages.length) {

                            message =
                                validationMessages.join('\n');

                        }

                    }


                    alert(message);

                })

                .finally(() => {

                    button.disabled = false;


                    button.innerHTML = `

                        <i class="bi bi-search me-2"></i>

                        Preview Payroll

                    `;

                });

            });


    /*
    ================================================================
    GENERATE PAYSLIPS
    ================================================================

    The browser only sends:

        period_start
        period_end
        employee IDs

    The PayrollController performs the complete calculation again.

    Therefore Preview and Generate use the SAME payroll formula.
    ================================================================
    */

    document
        .getElementById('generatePayslips')
        .addEventListener(
            'click',
            function() {


                const employees = [];


                document
                    .querySelectorAll(
                        '.employee-checkbox:checked'
                    )
                    .forEach(box => {

                        employees.push(
                            box.value
                        );

                    });


                const start =
                    document
                        .getElementById('period_start')
                        .value;


                const end =
                    document
                        .getElementById('period_end')
                        .value;


                if (!start || !end) {

                    alert(
                        'Please select the payroll period.'
                    );

                    return;

                }


                if (new Date(start) > new Date(end)) {

                    alert(
                        'Payroll start date cannot be later than the payroll end date.'
                    );

                    return;

                }


                if (employees.length === 0) {

                    alert(
                        'Please select at least one employee.'
                    );

                    return;

                }


                if (
                    !confirm(
                        'Generate payslips for the selected employees using the payroll calculation for this period?'
                    )
                ) {

                    return;

                }


                const button = this;


                button.disabled = true;


                button.innerHTML = `

                    <span class="spinner-border spinner-border-sm me-2"></span>

                    Generating...

                `;


                fetch(
                    "{{ route('payslip.generate') }}",
                    {

                        method: "POST",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    .content

                        },

                        body: JSON.stringify({

                            period_start:
                                start,

                            period_end:
                                end,

                            employees:
                                employees

                        })

                    }
                )

                .then(response => {

                    if (!response.ok) {

                        return response
                            .json()
                            .then(error => {

                                throw error;

                            });

                    }

                    return response.json();

                })

                .then(data => {

                    if (!data.success) {

                        throw new Error(
                            data.message ??
                            'Unable to generate payslips.'
                        );

                    }


                    alert(

                        `${data.generated} payslip(s) generated successfully.\n\n` +

                        `${data.skipped} employee(s) were skipped because a payslip already exists for the selected payroll period.`

                    );


                    location.reload();

                })

                .catch(error => {

                    console.error(error);


                    let message =
                        'An error occurred while generating payslips.';


                    if (error?.message) {

                        message =
                            error.message;

                    }


                    if (
                        error?.errors &&
                        typeof error.errors === 'object'
                    ) {

                        const validationMessages = [];


                        Object.values(
                            error.errors
                        ).forEach(messages => {

                            if (Array.isArray(messages)) {

                                messages.forEach(message => {

                                    validationMessages.push(
                                        message
                                    );

                                });

                            }

                        });


                        if (validationMessages.length) {

                            message =
                                validationMessages.join('\n');

                        }

                    }


                    alert(message);

                })

                .finally(() => {

                    button.disabled = false;


                    button.innerHTML = `

                        <i class="bi bi-file-earmark-text me-2"></i>

                        Generate Payslips

                    `;

                });

            });

</script>

</body>

</html>
