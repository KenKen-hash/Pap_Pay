
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Pap Pay Payroll and Payslip Management">
    <meta name="theme-color" content="#172554">

    <title>Payslip | Pap Pay</title>

    <link rel="icon" type="image/x-icon" href="../../../../khen/assets/images/favicon.png">
    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>

        /*
        ============================================================
        DEPARTMENT CARDS
        ============================================================
        */

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
        PREVIEW BATCH
        ============================================================
        */

        .preview-batch-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            transition: .2s;
        }

        .preview-batch-card:hover {
            box-shadow: 0 5px 18px rgba(0, 0, 0, .06);
        }

        .preview-batch-status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 6px;
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffe69c;
            font-size: 12px;
            font-weight: 600;
        }


        /*
        ============================================================
        PREVIEW EMPLOYEE TABLE
        ============================================================
        */

        .preview-employee-table-wrapper {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            border-radius: 8px;
        }

        .preview-employee-table {
            min-width: 1000px;
            margin-bottom: 0;
        }

        .preview-employee-table th,
        .preview-employee-table td {
            vertical-align: middle;
            white-space: nowrap;
        }


        /*
        ============================================================
        PREVIEW DETAIL CARDS
        ============================================================
        */

        .preview-detail-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            background: #fff;
            height: 100%;
        }

        .preview-detail-label {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .preview-detail-value {
            font-size: 18px;
            font-weight: 700;
        }


        /*
        ============================================================
        PREVIEW ACTION BUTTONS
        ============================================================
        */

        .preview-action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
            flex-wrap: wrap;
        }


        /*
        ============================================================
        MODALS
        ============================================================
        */

        .employee-preview-modal .modal-dialog {
            max-width: 1200px;
        }

        .employee-preview-modal .modal-body {
            max-height: 75vh;
            overflow-y: auto;
        }

        .employee-detail-modal .modal-dialog {
            max-width: 1100px;
        }

        .employee-detail-modal .modal-body {
            max-height: 75vh;
            overflow-y: auto;
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

            .preview-employee-table {
                min-width: 1000px;
            }

            .employee-preview-modal .modal-body,
            .employee-detail-modal .modal-body {
                max-height: 70vh;
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

                <button
                    class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="true"
                    aria-label="Toggle sidebar"
                >

                    <span></span>
                    <span></span>
                    <span></span>

                </button>


                <!-- SEARCH -->

                <form
                    class="d-none d-md-flex ms-3 flex-grow-1 admin-search-form"
                    role="search"
                    autocomplete="off"
                    data-admin-search
                >

                    <div class="admin-search-wrapper">

                        <i class="bi bi-search admin-search-icon"></i>

                        <input
                            id="adminSearchInput"
                            class="form-control search-input admin-search-input"
                            type="search"
                            placeholder="Search Pap Pay..."
                            aria-label="Search Pap Pay"
                            aria-autocomplete="list"
                            aria-controls="adminSearchResults"
                            aria-expanded="false"
                        >

                        <button
                            type="button"
                            class="admin-search-clear"
                            id="adminSearchClear"
                            aria-label="Clear search"
                            title="Clear search"
                        >

                            <i class="bi bi-x-lg"></i>

                        </button>

                        <div
                            class="admin-search-results"
                            id="adminSearchResults"
                            role="listbox"
                            aria-label="Search results"
                        ></div>

                    </div>

                </form>


                <!-- NAVBAR ACTIONS -->

                <div class="navbar-actions ms-auto">


                    <!-- NOTIFICATIONS -->

                    <div class="dropdown">

                        <button
                            class="icon-button"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="Notifications"
                        >

                            @if (($unreadNotifications ?? 0) > 0)

                                <span class="notification-dot"></span>

                            @endif

                            <i
                                class="bi bi-bell"
                                aria-hidden="true"
                            ></i>

                        </button>


                        <div class="dropdown-menu dropdown-menu-end notification-menu">

                            <div class="dropdown-header fw-bold text-body">
                                Notifications
                            </div>


                            @forelse($notifications ?? [] as $notification)

                                <a
                                    class="dropdown-item {{ !$notification->is_read ? 'notification-unread' : '' }}"
                                    href="{{ route('admin.notifications.read', $notification->id) }}"
                                >

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


                            <a
                                href="{{ route('admin.notifications') }}"
                                class="dropdown-item text-center"
                            >

                                View all notifications

                            </a>

                        </div>

                    </div>


                    <!-- PROFILE -->

                    <div class="dropdown">

                        <button
                            class="profile-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >

                            <img
                                class="avatar-img avatar-sm"
                                src="{{ Auth::user()->photo
                                    ? asset('storage/' . Auth::user()->photo)
                                    : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                alt="{{ Auth::user()->name }}"
                            >

                            <span class="profile-name d-none d-sm-inline">

                                {{ Auth::user()->name }}

                            </span>

                        </button>


                        <ul class="dropdown-menu dropdown-menu-end">

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

                                <label
                                    class="form-label fw-semibold"
                                    for="period_start"
                                >
                                    Payroll Start Date
                                </label>

                                <input
                                    type="date"
                                    id="period_start"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-6">

                                <label
                                    class="form-label fw-semibold"
                                    for="period_end"
                                >
                                    Payroll End Date
                                </label>

                                <input
                                    type="date"
                                    id="period_end"
                                    class="form-control"
                                >

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


                        <div
                            id="employeeContainer"
                            class="border rounded p-4 bg-light"
                        >

                            <div class="text-center text-muted">

                                <i class="bi bi-people fs-1"></i>

                                <p class="mt-3 mb-0">
                                    Select one or more departments to load employees.
                                </p>

                            </div>

                        </div>


                        <!-- BUTTON -->

                        <div class="text-end mt-4">

                            <button
                                class="btn btn-success btn-lg"
                                id="previewPayroll"
                                type="button"
                            >

                                <i class="bi bi-search me-2"></i>

                                Preview Payroll

                            </button>


                            <button
                                class="btn btn-primary btn-lg ms-2 d-none"
                                id="generatePayslips"
                                type="button"
                            >

                                <i class="bi bi-file-earmark-text me-2"></i>

                                Generate Payslips

                            </button>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     PAYSLIP PREVIEW BATCH
                     ================================================= -->

                <div
                    id="payslipPreviewBatches"
                    class="card shadow-sm border-0 mb-4 d-none"
                >

                    <div class="card-header bg-white border-0 py-3">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                            <div>

                                <h5 class="fw-bold mb-1">

                                    <i class="bi bi-search text-warning me-2"></i>

                                    Payslip Preview

                                </h5>

                                <small class="text-muted">

                                    Payroll batches prepared for review before payslip generation.

                                </small>

                            </div>


                            <span
                                id="previewBatchStatus"
                                class="preview-batch-status"
                            >

                                Preview

                            </span>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

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
                                            Previewed On
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th class="text-center">
                                            Actions
                                        </th>

                                    </tr>

                                </thead>


                                <tbody id="previewBatchBody">

                                </tbody>

                            </table>

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
                                type="button"
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


        <!-- ========================================================
             FOOTER
             ======================================================== -->

        <footer class="admin-footer">

            <div class="container-fluid px-3 px-lg-4">
            </div>

        </footer>

    </div>

</div>


<!-- ============================================================
     PREVIEW EMPLOYEES MODAL
     ============================================================ -->

<div
    class="modal fade employee-preview-modal"
    id="previewEmployeesModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">

                        <i class="bi bi-receipt-cutoff text-warning me-2"></i>

                        Payslip Preview

                    </h5>

                    <small
                        id="previewModalPeriod"
                        class="text-muted"
                    ></small>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body">


                <!-- SUMMARY -->

                <div class="row g-3 mb-4">

                    <div class="col-xl-3 col-md-6">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Employees
                            </div>

                            <div
                                class="preview-detail-value"
                                id="modalEmployeeCount"
                            >
                                0
                            </div>

                        </div>

                    </div>


                    <div class="col-xl-3 col-md-6">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Late Minutes
                            </div>

                            <div
                                class="preview-detail-value text-danger"
                                id="modalLateMinutes"
                            >
                                0 min
                            </div>

                        </div>

                    </div>


                    <div class="col-xl-3 col-md-6">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Undertime Minutes
                            </div>

                            <div
                                class="preview-detail-value text-warning"
                                id="modalUndertimeMinutes"
                            >
                                0 min
                            </div>

                        </div>

                    </div>


                    <div class="col-xl-3 col-md-6">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Overtime Minutes
                            </div>

                            <div
                                class="preview-detail-value text-success"
                                id="modalOvertimeMinutes"
                            >
                                0 min
                            </div>

                        </div>

                    </div>

                </div>


                <!-- EMPLOYEES -->

                <div class="preview-employee-table-wrapper">

                    <table class="table table-hover align-middle preview-employee-table">

                        <thead class="table-light">

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
                                    Gross Salary
                                </th>

                                <th>
                                    Benefits
                                </th>

                                <th>
                                    Net Salary
                                </th>

                                <th class="text-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody id="previewEmployeeModalBody">

                        </tbody>

                    </table>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >

                    Close

                </button>


                <button
                    type="button"
                    class="btn btn-primary"
                    id="modalGenerateAllPayslips"
                >

                    <i class="bi bi-file-earmark-text me-2"></i>

                    Generate Payslips

                </button>

            </div>

        </div>

    </div>

</div>


<!-- ============================================================
     EMPLOYEE PAYROLL DETAIL MODAL
     ============================================================ -->

<div
    class="modal fade employee-detail-modal"
    id="employeeDetailModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title fw-bold"
                        id="employeeDetailName"
                    >
                        Employee Payroll
                    </h5>

                    <small
                        class="text-muted"
                        id="employeeDetailDepartment"
                    ></small>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body">

                <div class="row g-3">


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Basic Salary
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailBasicSalary"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Daily Rate
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailDailyRate"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Payroll Period
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailPayrollPeriod"
                            >
                                -
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Attendance
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailAttendance"
                            >
                                0
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Holidays Worked
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailWorkedHolidays"
                            >
                                0
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Holiday Pay
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailHolidayPay"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Additional Earnings
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailAdditionalEarnings"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Teaching Load Pay
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailTeachingLoad"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Overtime Pay
                            </div>

                            <div
                                class="preview-detail-value text-success"
                                id="detailOvertimePay"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Late Deduction
                            </div>

                            <div
                                class="preview-detail-value text-danger"
                                id="detailLateDeduction"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Undertime Deduction
                            </div>

                            <div
                                class="preview-detail-value text-warning"
                                id="detailUndertimeDeduction"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Benefits
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailBenefits"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-12">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Gross Salary
                            </div>

                            <div
                                class="preview-detail-value"
                                id="detailGrossSalary"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>


                    <div class="col-12">

                        <div class="preview-detail-card">

                            <div class="preview-detail-label">
                                Net Salary
                            </div>

                            <div
                                class="preview-detail-value text-success"
                                id="detailNetSalary"
                            >
                                ₱ 0.00
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>


                <button
                    type="button"
                    class="btn btn-primary"
                    id="detailGeneratePayslip"
                >

                    <i class="bi bi-file-earmark-text me-2"></i>

                    Generate Payslip

                </button>

            </div>

        </div>

    </div>

</div>


<!-- ============================================================
     ADMIN SEARCH PAGES
     ============================================================ -->

<script>

window.papPayAdminSearchPages = [

    {
        title: 'Home',
        description: 'Admin dashboard and system overview',
        keywords: 'home dashboard admin overview',
        icon: 'bi-speedometer2',
        url: @json(route('admin-dashboard'))
    },

    {
        title: 'Employees',
        description: 'Manage employee accounts and records',
        keywords: 'employee employees staff users accounts personnel',
        icon: 'bi-people-fill',
        url: @json(route('employees.index'))
    },

    {
        title: 'Attendance',
        description: 'Review employee attendance records',
        keywords: 'attendance time in time out present absent late undertime overtime',
        icon: 'bi-calendar-check-fill',
        url: @json(route('attendance_list'))
    },

    {
        title: 'Leave Requests',
        description: 'Review and approve employee leave requests',
        keywords: 'leave leaves vacation absence request requests approval approve',
        icon: 'bi-calendar-x-fill',
        url: @json(route('admin.leaves'))
    },

    {
        title: 'Official Business',
        description: 'Manage official business requests',
        keywords: 'official business ob field work travel request requests',
        icon: 'bi-briefcase-fill',
        url: @json(route('official_business'))
    },

    {
        title: 'Holidays',
        description: 'Manage holidays and holiday settings',
        keywords: 'holiday holidays calendar dates pay rate',
        icon: 'bi-calendar-event-fill',
        url: @json(route('holidays.index'))
    },

    {
        title: 'Payroll',
        description: 'Process and manage employee payroll',
        keywords: 'payroll salary salaries wages earnings deductions sss philhealth pagibig hmo',
        icon: 'bi-cash-stack',
        url: @json(route('payroll'))
    },

    {
        title: 'Payslips',
        description: 'View and manage employee payslips',
        keywords: 'payslip payslips salary slip payment compensation',
        icon: 'bi-receipt-cutoff',
        url: @json(route('payslip_list'))
    },

    {
        title: 'Payslip Concerns',
        description: 'Review employee payslip concerns',
        keywords: 'payslip concern concerns issue issues complaint complaints payroll problem',
        icon: 'bi-exclamation-circle-fill',
        url: @json(route('admin.payslip-concerns.index'))
    },

    {
        title: 'Reports',
        description: 'Generate HR and payroll reports',
        keywords: 'report reports analytics statistics summary attendance payroll employee',
        icon: 'bi-bar-chart-fill',
        url: @json(route('reports'))
    },

    {
        title: 'Announcements',
        description: 'Publish and manage system announcements',
        keywords: 'announcement announcements notice notices news publish message',
        icon: 'bi-megaphone-fill',
        url: @json(route('announcements'))
    }

];

</script>


<!-- ============================================================
     SCRIPTS
     ============================================================ -->

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

<script src="../../../../khen/assets/js/main.js"></script>

<script src="{{ asset('khen/assets/js/payslip-search.js') }}"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    ============================================================
    ELEMENTS
    ============================================================
    */

    const employeeContainer =
        document.getElementById('employeeContainer');


    const departmentCheckboxes =
        document.querySelectorAll('.department-checkbox');


    const previewPayrollButton =
        document.getElementById('previewPayroll');


    const generatePayslipsButton =
        document.getElementById('generatePayslips');


    const previewBatchSection =
        document.getElementById('payslipPreviewBatches');


    const previewBatchBody =
        document.getElementById('previewBatchBody');


    const previewEmployeesModalElement =
        document.getElementById('previewEmployeesModal');


    const employeeDetailModalElement =
        document.getElementById('employeeDetailModal');


    const previewEmployeesModal =
        new bootstrap.Modal(
            previewEmployeesModalElement
        );


    const employeeDetailModal =
        new bootstrap.Modal(
            employeeDetailModalElement
        );


    /*
    ============================================================
    PREVIEW STATE
    ============================================================
    */

    let previewEmployees = [];

    let currentPreviewEmployee = null;


    /*
    ============================================================
    LOADED EMPLOYEES
    ============================================================
    */

    /*
     * This array now contains ALL employees returned by the
     * selected departments.
     *
     * There is no longer any employee-selection checkbox.
     */

    let loadedEmployees = [];


    /*
    ============================================================
    PREVIEW LOCAL STORAGE
    ============================================================
    */

    const PREVIEW_BATCH_STORAGE_KEY =
        'pap_pay_active_payslip_preview_batch';


    /*
    ------------------------------------------------------------
    GET SAVED PREVIEW BATCH
    ------------------------------------------------------------
    */

    function getStoredPreviewBatch() {

        try {

            const stored =
                localStorage.getItem(
                    PREVIEW_BATCH_STORAGE_KEY
                );


            if (!stored) {

                return null;

            }


            const batch =
                JSON.parse(stored);


            if (
                !batch ||
                !Array.isArray(batch.employees) ||
                batch.employees.length === 0
            ) {

                return null;

            }


            return batch;

        } catch (error) {

            console.error(
                'Unable to restore saved payslip preview batch:',
                error
            );


            return null;

        }

    }


    /*
    ------------------------------------------------------------
    SAVE PREVIEW BATCH
    ------------------------------------------------------------
    */

    function savePreviewBatch() {

        if (!previewEmployees.length) {

            clearPreviewBatch();

            return;

        }


        const start =
            document
                .getElementById('period_start')
                ?.value ?? '';


        const end =
            document
                .getElementById('period_end')
                ?.value ?? '';


        const existingBatch =
            getStoredPreviewBatch();


        const previewedAt =
            existingBatch?.previewed_at ??
            new Date().toISOString();


        try {

            localStorage.setItem(

                PREVIEW_BATCH_STORAGE_KEY,

                JSON.stringify({

                    period_start:
                        start,

                    period_end:
                        end,

                    employees:
                        previewEmployees,

                    previewed_at:
                        previewedAt

                })

            );

        } catch (error) {

            console.error(
                'Unable to save payslip preview batch:',
                error
            );

        }

    }


    /*
    ------------------------------------------------------------
    CLEAR PREVIEW BATCH
    ------------------------------------------------------------
    */

    function clearPreviewBatch() {

        localStorage.removeItem(
            PREVIEW_BATCH_STORAGE_KEY
        );

    }


    /*
    ------------------------------------------------------------
    RESTORE PREVIEW BATCH
    ------------------------------------------------------------
    */

    function restorePreviewBatch() {

        const batch =
            getStoredPreviewBatch();


        if (!batch) {

            return;

        }


        const startInput =
            document.getElementById(
                'period_start'
            );


        const endInput =
            document.getElementById(
                'period_end'
            );


        if (
            startInput &&
            batch.period_start
        ) {

            startInput.value =
                batch.period_start;

        }


        if (
            endInput &&
            batch.period_end
        ) {

            endInput.value =
                batch.period_end;

        }


        previewEmployees =
            batch.employees;


        renderPreviewBatch(

            batch.period_start,

            batch.period_end,

            batch.previewed_at

        );


        previewBatchSection
            .classList
            .remove('d-none');


        generatePayslipsButton
            .classList
            .add('d-none');

    }


    /*
    ============================================================
    LOAD EMPLOYEES
    ============================================================
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
            .querySelectorAll(
                '.department-checkbox:checked'
            )
            .forEach(box => {

                selectedDepartments.push(
                    box.value
                );

            });


        /*
        --------------------------------------------------------
        NO DEPARTMENT SELECTED
        --------------------------------------------------------
        */

        if (selectedDepartments.length === 0) {

            loadedEmployees = [];


            employeeContainer.innerHTML = `

                <div class="text-center text-muted">

                    <i class="bi bi-people fs-1"></i>

                    <p class="mt-3 mb-0">

                        Select one or more departments
                        to load employees.

                    </p>

                </div>

            `;

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


        /*
        --------------------------------------------------------
        LOAD ALL EMPLOYEES FROM SELECTED DEPARTMENTS
        --------------------------------------------------------
        */

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

            /*
            IMPORTANT:

            Every employee returned by the selected departments
            is automatically included.

            No employee checkbox is created anymore.
            */

            loadedEmployees =
                Array.isArray(employees)
                    ? employees
                    : [];


            let html = `

                <div class="d-flex align-items-center gap-3 mb-3">

                    <div
                        class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center"
                        style="width: 42px; height: 42px;"
                    >

                        <i class="bi bi-people-fill"></i>

                    </div>

                    <div>

                        <div class="fw-bold">
                            ${loadedEmployees.length} employee(s) loaded
                        </div>

                        <small class="text-muted">
                            All employees from the selected department(s)
                            will automatically be included in the payroll preview.
                        </small>

                    </div>

                </div>

                <hr>

            `;


            if (!loadedEmployees.length) {

                html += `

                    <div class="text-center text-muted py-3">

                        <i class="bi bi-person-x fs-2"></i>

                        <p class="mt-2 mb-0">

                            No employees found.

                        </p>

                    </div>

                `;

            } else {

                html += `

                    <div class="row g-2">

                `;


                loadedEmployees.forEach(employee => {

                    const fullName =
                        `${employee.first_name ?? ''} ${employee.last_name ?? ''}`.trim();


                    html += `

                        <div class="col-lg-6 col-xl-4">

                            <div class="border rounded bg-white p-3 h-100">

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px;"
                                    >

                                        <i class="bi bi-person text-secondary"></i>

                                    </div>

                                    <div class="overflow-hidden">

                                        <strong class="d-block text-truncate">
                                            ${fullName}
                                        </strong>

                                        <small class="text-muted">

                                            ${employee.employee_id ?? ''}

                                            •

                                            ${employee.department ?? ''}

                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>

                    `;

                });


                html += `

                    </div>

                `;

            }


            employeeContainer.innerHTML =
                html;

        })

        .catch(error => {

            console.error(error);


            loadedEmployees = [];


            employeeContainer.innerHTML = `

                <div class="alert alert-danger mb-0">

                    <i class="bi bi-exclamation-triangle me-2"></i>

                    Unable to load employees.

                </div>

            `;

        });

    }


    /*
    ============================================================
    FORMATTERS
    ============================================================
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


    function formatDate(date) {

        if (!date) {

            return '';

        }


        return new Date(
            date + 'T00:00:00'
        ).toLocaleDateString(
            undefined,
            {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            }
        );

    }


    /*
    ------------------------------------------------------------
    FORMAT SAVED PREVIEW DATE
    ------------------------------------------------------------
    */

    function formatPreviewDate(date) {

        if (!date) {

            return new Date().toLocaleString(
                undefined,
                {
                    dateStyle: 'medium',
                    timeStyle: 'short'
                }
            );

        }


        const parsedDate =
            new Date(date);


        if (Number.isNaN(
            parsedDate.getTime()
        )) {

            return new Date().toLocaleString(
                undefined,
                {
                    dateStyle: 'medium',
                    timeStyle: 'short'
                }
            );

        }


        return parsedDate.toLocaleString(
            undefined,
            {
                dateStyle: 'medium',
                timeStyle: 'short'
            }
        );

    }


    /*
    ============================================================
    GET SELECTED EMPLOYEES
    ============================================================
    */

    /*
     * The old employee-checkbox process has been removed.
     *
     * Every employee loaded from the selected departments
     * is automatically included.
     */

    function getSelectedEmployeeIds() {

        return loadedEmployees.map(
            employee => employee.id
        );

    }


    /*
    ============================================================
    PREVIEW PAYROLL
    ============================================================
    */

    previewPayrollButton.addEventListener(
        'click',
        function () {

            const start =
                document
                    .getElementById(
                        'period_start'
                    )
                    .value;


            const end =
                document
                    .getElementById(
                        'period_end'
                    )
                    .value;


            /*
            ----------------------------------------------------
            ALL LOADED EMPLOYEES ARE INCLUDED AUTOMATICALLY
            ----------------------------------------------------
            */

            const employees =
                getSelectedEmployeeIds();


            if (!start || !end) {

                alert(
                    'Please select the payroll start date and end date.'
                );

                return;

            }


            if (
                new Date(start) >
                new Date(end)
            ) {

                alert(
                    'Payroll start date cannot be later than the payroll end date.'
                );

                return;

            }


            if (employees.length === 0) {

                alert(
                    'Please select at least one department with employees before previewing the payroll.'
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


                /*
                ----------------------------------------------------
                STORE SERVER CALCULATIONS
                ----------------------------------------------------
                */

                previewEmployees =
                    Array.isArray(data.preview)
                        ? data.preview
                        : [];


                if (!previewEmployees.length) {

                    throw new Error(
                        'No payroll records were returned for the selected employees.'
                    );

                }


                /*
                ----------------------------------------------------
                SAVE PREVIEW BATCH
                ----------------------------------------------------
                */

                savePreviewBatch();


                /*
                ----------------------------------------------------
                CREATE PREVIEW BATCH
                ----------------------------------------------------
                */

                renderPreviewBatch(
                    start,
                    end
                );


                /*
                ----------------------------------------------------
                SHOW PREVIEW BATCH
                ----------------------------------------------------
                */

                previewBatchSection
                    .classList
                    .remove('d-none');


                /*
                ----------------------------------------------------
                HIDE OLD GENERATE BUTTON
                ----------------------------------------------------
                */

                generatePayslipsButton
                    .classList
                    .add('d-none');


                /*
                ----------------------------------------------------
                SCROLL TO PREVIEW
                ----------------------------------------------------
                */

                previewBatchSection
                    .scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

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

        }
    );


    /*
    ============================================================
    RENDER PREVIEW BATCH
    ============================================================
    */

    function renderPreviewBatch(
        start,
        end,
        savedPreviewDate = null
    ) {

        const previewDate =
            formatPreviewDate(
                savedPreviewDate
            );


        previewBatchBody.innerHTML = `

            <tr>

                <td>
                    1
                </td>


                <td>

                    ${formatDate(start)}

                    -

                    ${formatDate(end)}

                </td>


                <td>

                    <strong>
                        ${previewEmployees.length}
                    </strong>

                    Employees

                </td>


                <td>
                    ${previewDate}
                </td>


                <td>

                    <span class="preview-batch-status">

                        Preview

                    </span>

                </td>


                <td class="text-center">

                    <button
                        type="button"
                        class="btn btn-sm btn-outline-primary"
                        id="viewPreviewBatch"
                    >

                        <i class="bi bi-eye me-1"></i>

                        View

                    </button>


                    <button
                        type="button"
                        class="btn btn-sm btn-primary"
                        id="generatePreviewBatch"
                    >

                        <i class="bi bi-file-earmark-text me-1"></i>

                        Generate Payslips

                    </button>

                </td>

            </tr>

        `;


        document
            .getElementById(
                'viewPreviewBatch'
            )
            .addEventListener(
                'click',
                function () {

                    openPreviewEmployeesModal();

                }
            );


        document
            .getElementById(
                'generatePreviewBatch'
            )
            .addEventListener(
                'click',
                function () {

                    generateAllPreviewEmployees();

                }
            );

    }


    /*
    ============================================================
    OPEN PREVIEW EMPLOYEES MODAL
    ============================================================
    */

    function openPreviewEmployeesModal() {

        const start =
            document
                .getElementById(
                    'period_start'
                )
                .value;


        const end =
            document
                .getElementById(
                    'period_end'
                )
                .value;


        document
            .getElementById(
                'previewModalPeriod'
            )
            .textContent =
                `${formatDate(start)} - ${formatDate(end)}`;


        renderPreviewEmployees();


        previewEmployeesModal.show();

    }


    /*
    ============================================================
    RENDER PREVIEW EMPLOYEES
    ============================================================
    */

    function renderPreviewEmployees() {

        const tbody =
            document.getElementById(
                'previewEmployeeModalBody'
            );


        tbody.innerHTML = '';


        if (!previewEmployees.length) {

            tbody.innerHTML = `

                <tr>

                    <td
                        colspan="7"
                        class="text-center text-muted py-4"
                    >

                        <i class="bi bi-person-x fs-3"></i>

                        <div class="mt-2">

                            No employees remaining
                            in this preview batch.

                        </div>

                    </td>

                </tr>

            `;


            updatePreviewModalSummary();

            return;

        }


        previewEmployees.forEach(
            (employee, index) => {

                const payrollPeriod =
                    employee.payroll_period ??
                    (
                        employee.is_weekly_payroll
                            ? 'Weekly'
                            : 'Every 15 Days'
                    );


                const row =
                    document.createElement(
                        'tr'
                    );


                row.innerHTML = `

                    <td>

                        <strong>
                            ${employee.name ?? ''}
                        </strong>

                        <br>

                        <small class="text-muted">

                            ${employee.employee_id ?? ''}

                        </small>

                    </td>


                    <td>

                        ${employee.department ?? ''}

                    </td>


                    <td>

                        <span class="payroll-period-badge">

                            ${payrollPeriod}

                        </span>

                    </td>


                    <td>

                        ${money(
                            employee.gross_salary
                        )}

                    </td>


                    <td>

                        ${money(
                            employee.benefits
                        )}

                    </td>


                    <td class="fw-bold text-success">

                        ${money(
                            employee.net_salary
                        )}

                    </td>


                    <td>

                        <div class="preview-action-buttons">


                            <!-- VIEW -->

                            <button
                                type="button"
                                class="btn btn-sm btn-outline-primary view-employee-preview"
                                data-index="${index}"
                            >

                                <i class="bi bi-eye"></i>

                                View

                            </button>


                            <!-- GENERATE -->

                            <button
                                type="button"
                                class="btn btn-sm btn-primary generate-single-preview"
                                data-index="${index}"
                            >

                                <i class="bi bi-file-earmark-text"></i>

                                Generate Payslip

                            </button>


                            <!-- EXCLUDE -->

                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger exclude-preview"
                                data-index="${index}"
                            >

                                <i class="bi bi-person-dash"></i>

                                Exclude

                            </button>

                        </div>

                    </td>

                `;


                tbody.appendChild(row);

            }
        );


        /*
        --------------------------------------------------------
        VIEW EMPLOYEE
        --------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.view-employee-preview'
            )
            .forEach(button => {

                button.addEventListener(
                    'click',
                    function () {

                        const index =
                            Number(
                                this.dataset.index
                            );


                        openEmployeeDetail(
                            previewEmployees[index]
                        );

                    }
                );

            });


        /*
        --------------------------------------------------------
        GENERATE SINGLE EMPLOYEE
        --------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.generate-single-preview'
            )
            .forEach(button => {

                button.addEventListener(
                    'click',
                    function () {

                        const index =
                            Number(
                                this.dataset.index
                            );


                        generateSingleEmployee(
                            previewEmployees[index]
                        );

                    }
                );

            });


        /*
        --------------------------------------------------------
        EXCLUDE EMPLOYEE
        --------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.exclude-preview'
            )
            .forEach(button => {

                button.addEventListener(
                    'click',
                    function () {

                        const index =
                            Number(
                                this.dataset.index
                            );


                        excludeEmployee(index);

                    }
                );

            });


        updatePreviewModalSummary();

    }


    /*
    ============================================================
    UPDATE PREVIEW SUMMARY
    ============================================================
    */

    function updatePreviewModalSummary() {

        let totalLate = 0;

        let totalUndertime = 0;

        let totalOvertime = 0;


        previewEmployees.forEach(
            employee => {

                totalLate +=
                    Number(
                        employee.late_minutes ?? 0
                    );


                totalUndertime +=
                    Number(
                        employee.undertime_minutes ?? 0
                    );


                totalOvertime +=
                    Number(
                        employee.overtime_minutes ?? 0
                    );

            }
        );


        document
            .getElementById(
                'modalEmployeeCount'
            )
            .textContent =
                previewEmployees.length;


        document
            .getElementById(
                'modalLateMinutes'
            )
            .textContent =
                `${number(totalLate)} min`;


        document
            .getElementById(
                'modalUndertimeMinutes'
            )
            .textContent =
                `${number(totalUndertime)} min`;


        document
            .getElementById(
                'modalOvertimeMinutes'
            )
            .textContent =
                `${number(totalOvertime)} min`;


        /*
        --------------------------------------------------------
        UPDATE BATCH EMPLOYEE COUNT
        --------------------------------------------------------
        */

        const batchRow =
            previewBatchBody.querySelector(
                'tr'
            );


        if (batchRow) {

            const employeeCell =
                batchRow.children[2];


            employeeCell.innerHTML = `

                <strong>
                    ${previewEmployees.length}
                </strong>

                Employees

            `;

        }

    }


    /*
    ============================================================
    EMPLOYEE DETAIL VIEW
    ============================================================
    */

    function openEmployeeDetail(employee) {

        currentPreviewEmployee =
            employee;


        document
            .getElementById(
                'employeeDetailName'
            )
            .textContent =
                employee.name ??
                'Employee Payroll';


        document
            .getElementById(
                'employeeDetailDepartment'
            )
            .textContent =
                employee.department ??
                '';


        document
            .getElementById(
                'detailBasicSalary'
            )
            .textContent =
                money(
                    employee.basic_salary
                );


        document
            .getElementById(
                'detailDailyRate'
            )
            .textContent =
                money(
                    employee.daily_rate
                );


        document
            .getElementById(
                'detailPayrollPeriod'
            )
            .textContent =
                employee.payroll_period ??
                (
                    employee.is_weekly_payroll
                        ? 'Weekly'
                        : 'Every 15 Days'
                );


        document
            .getElementById(
                'detailAttendance'
            )
            .textContent =
                `${number(
                    employee.present_days ??
                    employee.total_attendance ??
                    0
                )} day(s)`;


        document
            .getElementById(
                'detailWorkedHolidays'
            )
            .textContent =
                number(
                    employee.worked_holidays
                );


        document
            .getElementById(
                'detailHolidayPay'
            )
            .textContent =
                money(
                    employee.holiday_pay
                );


        document
            .getElementById(
                'detailAdditionalEarnings'
            )
            .textContent =
                money(
                    employee.additional_earnings_total
                );


        document
            .getElementById(
                'detailTeachingLoad'
            )
            .textContent =
                money(
                    employee.additional_teaching_load_pay ??
                    employee.teaching_load
                );


        document
            .getElementById(
                'detailOvertimePay'
            )
            .textContent =
                money(
                    employee.overtime_pay
                );


        document
            .getElementById(
                'detailLateDeduction'
            )
            .textContent =
                money(
                    employee.late_deduction
                );


        document
            .getElementById(
                'detailUndertimeDeduction'
            )
            .textContent =
                money(
                    employee.undertime_deduction
                );


        document
            .getElementById(
                'detailBenefits'
            )
            .textContent =
                money(
                    employee.benefits
                );


        document
            .getElementById(
                'detailGrossSalary'
            )
            .textContent =
                money(
                    employee.gross_salary
                );


        document
            .getElementById(
                'detailNetSalary'
            )
            .textContent =
                money(
                    employee.net_salary
                );


        employeeDetailModal.show();

    }


    /*
    ============================================================
    DETAIL MODAL - GENERATE EMPLOYEE
    ============================================================
    */

    document
        .getElementById(
            'detailGeneratePayslip'
        )
        .addEventListener(
            'click',
            function () {

                if (!currentPreviewEmployee) {

                    return;

                }


                generateSingleEmployee(
                    currentPreviewEmployee
                );

            }
        );


    /*
    ============================================================
    GENERATE SINGLE EMPLOYEE
    ============================================================
    */

    function generateSingleEmployee(employee) {

        if (!employee) {

            return;

        }


        const start =
            document
                .getElementById(
                    'period_start'
                )
                .value;


        const end =
            document
                .getElementById(
                    'period_end'
                )
                .value;


        if (!confirm(
            `Generate payslip for ${employee.name}?`
        )) {

            return;

        }


        const employeeId =
            employee.id;


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
                        [employeeId]

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
                    'Unable to generate payslip.'
                );

            }


            alert(
                `${data.generated} payslip(s) generated successfully.`
            );


            /*
            --------------------------------------------------------
            REMOVE GENERATED EMPLOYEE FROM PREVIEW
            --------------------------------------------------------
            */

            previewEmployees =
                previewEmployees.filter(
                    item =>
                        Number(item.id) !==
                        Number(employeeId)
                );


            /*
            --------------------------------------------------------
            SAVE REMAINING PREVIEW BATCH
            --------------------------------------------------------
            */

            if (previewEmployees.length) {

                savePreviewBatch();

            } else {

                clearPreviewBatch();

            }


            employeeDetailModal.hide();


            renderPreviewEmployees();


            /*
            --------------------------------------------------------
            IF NO EMPLOYEES REMAIN
            --------------------------------------------------------
            */

            if (!previewEmployees.length) {

                previewEmployeesModal.hide();

                previewBatchSection
                    .classList
                    .add('d-none');

            }


            /*
            --------------------------------------------------------
            REFRESH GENERATED HISTORY
            --------------------------------------------------------
            */

            setTimeout(
                () => location.reload(),
                500
            );

        })

        .catch(error => {

            console.error(error);


            alert(
                error?.message ??
                'Unable to generate payslip.'
            );

        });

    }


    /*
    ============================================================
    EXCLUDE EMPLOYEE
    ============================================================
    */

    function excludeEmployee(index) {

        const employee =
            previewEmployees[index];


        if (!employee) {

            return;

        }


        if (!confirm(
            `Exclude ${employee.name} from this payslip generation?`
        )) {

            return;

        }


        /*
        IMPORTANT:

        Excluding does NOT delete anything from the database.

        It only removes the employee from the current
        browser-side preview batch.
        */

        previewEmployees.splice(
            index,
            1
        );


        /*
        --------------------------------------------------------
        SAVE REMAINING PREVIEW BATCH
        --------------------------------------------------------
        */

        if (previewEmployees.length) {

            savePreviewBatch();

        } else {

            clearPreviewBatch();

        }


        renderPreviewEmployees();


        if (!previewEmployees.length) {

            alert(
                'All employees have been excluded from this preview batch.'
            );


            previewEmployeesModal.hide();


            previewBatchSection
                .classList
                .add('d-none');

        }

    }


    /*
    ============================================================
    GENERATE ALL REMAINING EMPLOYEES
    ============================================================
    */

    document
        .getElementById(
            'modalGenerateAllPayslips'
        )
        .addEventListener(
            'click',
            function () {

                generateAllPreviewEmployees();

            }
        );


    function generateAllPreviewEmployees() {

        const start =
            document
                .getElementById(
                    'period_start'
                )
                .value;


        const end =
            document
                .getElementById(
                    'period_end'
                )
                .value;


        const employees =
            previewEmployees.map(
                employee =>
                    employee.id
            );


        if (!employees.length) {

            alert(
                'There are no employees remaining in this preview batch.'
            );

            return;

        }


        if (!confirm(
            `Generate payslips for ${employees.length} employee(s)?`
        )) {

            return;

        }


        const button =
            document.getElementById(
                'modalGenerateAllPayslips'
            );


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


            /*
            --------------------------------------------------------
            ALL REMAINING EMPLOYEES HAVE BEEN PROCESSED
            --------------------------------------------------------
            */

            clearPreviewBatch();


            location.reload();

        })

        .catch(error => {

            console.error(error);


            alert(
                error?.message ??
                'An error occurred while generating payslips.'
            );

        })

        .finally(() => {

            button.disabled = false;


            button.innerHTML = `

                <i class="bi bi-file-earmark-text me-2"></i>

                Generate Payslips

            `;

        });

    }


    /*
    ============================================================
    RESTORE SAVED PREVIEW AFTER PAGE LOAD
    ============================================================
    */

    restorePreviewBatch();

});

</script>

</body>

</html>

