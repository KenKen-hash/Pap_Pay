@php
    $employee = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="adminHMD professional admin dashboard template">

    <title>File Leave | PAP Pay</title>

     <link rel="icon" type="image/x-icon" href="../../../../khen/assets/images/favicon.png">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="../../../../khen/assets/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <!-- Main Template CSS -->
    <link rel="stylesheet"
        href="../../../../khen/assets/css/style.css">


    <!-- =========================================================
         LEAVE PAGE RESPONSIVE FIXES
         ========================================================= -->

    <style>

        /*
        ============================================================
        GLOBAL RESPONSIVE SAFETY
        ============================================================
        */

        html,
        body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }


        /*
        ============================================================
        MAIN LAYOUT

        The sidebar is fixed at 280px on desktop.
        Therefore the main area must explicitly occupy:

            100% - sidebar width

        This prevents the Leave page from becoming wider than
        the laptop screen.
        ============================================================
        */

        .admin-shell {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

        .admin-main {
            width: calc(100% - var(--sidebar-width)) !important;
            max-width: calc(100% - var(--sidebar-width)) !important;
            min-width: 0 !important;
            margin-left: var(--sidebar-width);
            overflow-x: hidden;
        }


        /*
        ============================================================
        SIDEBAR MINI MODE
        ============================================================
        */

        body.sidebar-mini .admin-main {
            width: calc(100% - var(--sidebar-mini-width)) !important;
            max-width: calc(100% - var(--sidebar-mini-width)) !important;
            margin-left: var(--sidebar-mini-width);
        }


        /*
        ============================================================
        NAVBAR
        ============================================================
        */

        .admin-navbar {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .admin-navbar .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }


        /*
        ============================================================
        MAIN CONTENT
        ============================================================
        */

        .dashboard-content {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

        .dashboard-content > .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }


        /*
        ============================================================
        PAGE HEADING
        ============================================================
        */

        .page-heading,
        .page-heading-copy {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .page-heading h1,
        .page-heading p {
            max-width: 100%;
            overflow-wrap: break-word;
        }


        /*
        ============================================================
        METRIC CARDS

        EXACT SAME BOOTSTRAP STRUCTURE AS ATTENDANCE:

            row g-3 mt-3
            col-md-6 col-xl-3

        DO NOT CHANGE THIS TO A CUSTOM GRID.
        ============================================================
        */

        .leave-metrics {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .leave-metrics > [class*="col-"] {
            min-width: 0;
        }

        .leave-metrics .metric-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .leave-metrics .metric-top {
            min-width: 0;
            max-width: 100%;
        }

        .leave-metrics .metric-label,
        .leave-metrics .metric-meta {
            min-width: 0;
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: normal;
        }

        .leave-metrics .metric-icon {
            flex-shrink: 0;
        }


        /*
        ============================================================
        LEAVE FORM PANEL
        ============================================================
        */

        .leave-form-panel {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .leave-form-panel .panel-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .leave-form-panel .row {
            width: auto;
            max-width: 100%;
            min-width: 0;
        }

        .leave-form-panel .row > [class*="col-"] {
            min-width: 0;
        }

        .leave-form-panel .form-control,
        .leave-form-panel .form-select,
        .leave-form-panel textarea {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .leave-form-panel textarea {
            resize: vertical;
        }


        /*
        ============================================================
        SUBMIT BUTTON
        ============================================================
        */

        .leave-submit-area {
            width: 100%;
            max-width: 100%;
        }


        /*
        ============================================================
        LEAVE HISTORY

        The table itself may naturally be wider than a phone.
        Only the TABLE gets horizontal scrolling, not the page.
        ============================================================
        */

        .leave-history-panel {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .leave-history-table-wrapper {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .leave-history-table {
            width: 100%;
            min-width: 720px;
        }


        /*
        ============================================================
        FOOTER
        ============================================================
        */

        .admin-footer {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .admin-footer .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }


        /*
        ============================================================
        TABLET

        At <= 991px the sidebar becomes an off-canvas sidebar,
        so the main content must use the complete screen width.
        ============================================================
        */

        @media (max-width: 991.98px) {

            .admin-main {
                width: 100% !important;
                max-width: 100% !important;
                margin-left: 0 !important;
            }

            body.sidebar-mini .admin-main {
                width: 100% !important;
                max-width: 100% !important;
                margin-left: 0 !important;
            }

            .dashboard-content > .container-fluid {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

        }


        /*
        ============================================================
        MOBILE
        ============================================================
        */

        @media (max-width: 767.98px) {

            .dashboard-content > .container-fluid {
                padding-left: 0.85rem !important;
                padding-right: 0.85rem !important;
            }


            /*
            Attendance-compatible metric layout:

            col-md-6 means the cards become full width below
            the md breakpoint.
            */

            .leave-metrics {
                --bs-gutter-x: 1rem;
                --bs-gutter-y: 1rem;
            }


            .leave-form-panel {
                padding: 1.1rem;
            }


            .leave-form-panel .panel-header {
                align-items: flex-start;
            }


            .leave-submit-area {
                text-align: left !important;
            }


            .leave-submit-area .btn {
                width: 100%;
            }

        }


        /*
        ============================================================
        SMALL PHONES
        ============================================================
        */

        @media (max-width: 575.98px) {

            .dashboard-content > .container-fluid {
                padding-left: 0.65rem !important;
                padding-right: 0.65rem !important;
            }


            .leave-form-panel {
                padding: 1rem;
            }


            .leave-metrics .metric-card {
                min-height: 146px;
            }


            .leave-form-panel .section-title {
                max-width: 100%;
            }


            .leave-form-panel .section-title span {
                overflow-wrap: break-word;
            }


            .page-heading {
                margin-bottom: 1rem;
            }

        }


        /*
        ============================================================
        EXTRA SMALL PHONES
        ============================================================
        */

        @media (max-width: 380px) {

            .dashboard-content > .container-fluid {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }


            .leave-form-panel {
                padding: 0.85rem;
            }


            .leave-metrics .metric-card {
                padding: 1rem;
                min-height: 135px;
            }

        }

    </style>

</head>


<body>

    <div class="admin-shell">


        <!-- SIDEBAR BACKDROP -->

        <div class="sidebar-backdrop"
            data-sidebar-close>
        </div>


        <!-- =====================================================
             SIDEBAR
             ===================================================== -->

        <aside class="admin-sidebar"
            id="adminSidebar"
            aria-label="Main navigation">


            <!-- BRAND -->

            <div class="sidebar-header">

            <a class="brand-mark"
               href="{{ route('dashboard') }}"
               aria-label="Admin Dashboard">

                <img src="../../../khen/assets/images/logo.jpg"
                     alt="Pap Pay Logo"
                     class="brand-logo">

            </a>

        </div>


            <!-- NAVIGATION -->

            <nav class="sidebar-nav">


                <a class="nav-link"
                    href="{{ route('dashboard') }}">

                    <span class="nav-icon">

                        <i class="bi bi-house-door"
                            aria-hidden="true"></i>

                    </span>

                    <span class="nav-text">
                        Dashboard
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('attendance') }}">

                    <span class="nav-icon">

                        <i class="bi bi-calendar-check"
                            aria-hidden="true"></i>

                    </span>

                    <span class="nav-text">
                        Attendance
                    </span>

                </a>


                <a class="nav-link active"
                    href="{{ route('file_leave') }}"
                    aria-current="page">

                    <span class="nav-icon">

                        <i class="bi bi-calendar-plus"
                            aria-hidden="true"></i>

                    </span>

                    <span class="nav-text">
                        File Leave
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('file_ob') }}">

                    <span class="nav-icon">

                        <i class="bi bi-briefcase"
                            aria-hidden="true"></i>

                    </span>

                    <span class="nav-text">
                        File OB
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('payslip') }}">

                    <span class="nav-icon">

                        <i class="bi bi-receipt"
                            aria-hidden="true"></i>

                    </span>

                    <span class="nav-text">
                        Payslip
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('employee.announcements') }}">

                    <span class="nav-icon">

                        <i class="bi bi-megaphone"
                            aria-hidden="true"></i>

                    </span>

                    <span class="nav-text">
                        Announcements
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('my_profile') }}">

                    <span class="nav-icon">

                        <i class="bi bi-person"
                            aria-hidden="true"></i>

                    </span>

                    <span class="nav-text">
                        My Profile
                    </span>

                </a>

            </nav>


            <!-- SIDEBAR USER -->

            <div class="sidebar-user">

                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ $employee->photo
                        ? asset('storage/' . $employee->photo)
                        : asset('images/default-avatar.png') }}"
                    alt="{{ $employee->name ?? 'Employee' }}">


                <strong>
                    {{ $employee->name ?? 'Employee Name' }}
                </strong>


                <small>
                    {{ $employee->position ?? 'Position' }}
                </small>

            </div>


            <!-- SIDEBAR FOOTER -->

            <div class="sidebar-footer">

                <span class="status-dot"></span>

                <span class="sidebar-footer-text">
                    System running smoothly
                </span>

            </div>

        </aside>


        <!-- =====================================================
             MAIN
             ===================================================== -->

        <div class="admin-main">


            <!-- =================================================
                 NAVBAR
                 ================================================= -->

            <nav class="navbar admin-navbar navbar-expand bg-white">

                <div class="container-fluid px-3 px-lg-4">


                    <!-- SIDEBAR TOGGLE -->

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


                    <!-- SEARCH -->

                    <form class="d-none d-md-flex ms-3 flex-grow-1"
                        role="search">

                        <input class="form-control search-input"
                            type="search"
                            placeholder="Search users, orders, reports"
                            aria-label="Search">

                    </form>


                    <!-- NAVBAR ACTIONS -->

                    <div class="navbar-actions ms-auto">


                        <!-- NOTIFICATIONS -->

                        <div class="dropdown">

                            <button class="icon-button"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                aria-label="Notifications">

                                <span class="notification-dot"></span>

                                <i class="bi bi-bell"
                                    aria-hidden="true"></i>

                            </button>


                            <div class="dropdown-menu dropdown-menu-end notification-menu">

                                <div class="dropdown-header fw-bold">

                                    Notifications

                                </div>


                                @forelse($notifications as $notification)

                                    <a class="dropdown-item"
                                        href="{{ url($notification->url) }}">

                                        <span class="notification-title">

                                            {{ $notification->title }}

                                        </span>


                                        <span class="notification-time">

                                            {{ $notification->message }}

                                        </span>

                                    </a>

                                @empty

                                    <div class="dropdown-item text-muted">

                                        No notifications

                                    </div>

                                @endforelse

                            </div>

                        </div>


                        <!-- PROFILE -->

                        <div class="dropdown">

                            <button class="profile-button dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <img class="avatar-img avatar-sm"
                                    src="{{ $employee->photo
                                        ? asset('storage/' . $employee->photo)
                                        : asset('images/default-avatar.png') }}"
                                    alt="{{ $employee->name ?? 'Employee' }}">


                                <span class="profile-name d-none d-sm-inline">

                                    {{ $employee->name ?? 'Employee' }}

                                </span>

                            </button>


                            <ul class="dropdown-menu dropdown-menu-end">


                                <li>

                                    <a class="dropdown-item"
                                        href="{{ route('my_profile') }}">

                                        My Profile

                                    </a>

                                </li>


                                <li>

                                    <hr class="dropdown-divider">

                                </li>


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


            <!-- =================================================
                 CONTENT
                 ================================================= -->

            <main class="dashboard-content">


                <div class="container-fluid px-3 px-lg-4 py-4">


                    <!-- =================================================
                         PAGE HEADING
                         ================================================= -->

                    <div class="page-heading">

                        <div class="page-heading-copy">

                            <div>

                                <br>

                                <h1 class="h3 mb-1">

                                    Leave Application

                                </h1>


                                <p class="text-muted mb-0">

                                    Submit your leave request for approval.

                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         METRIC CARDS

                         SAME STRUCTURE AS ATTENDANCE
                         ================================================= -->

                    <section class="row g-3 mt-3 leave-metrics">


                        <!-- PENDING -->

                        <div class="col-md-6 col-xl-3">

                            <article class="metric-card metric-warning">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Pending

                                    </span>


                                    <span class="metric-icon">

                                        <i class="bi bi-clock-history"></i>

                                    </span>

                                </div>


                                <div class="metric-value">

                                    {{ Auth::user()->leaveRequests()->where('status', 'Pending')->count() }}

                                </div>


                                <div class="metric-meta">

                                    Pending Leave Requests

                                </div>

                            </article>

                        </div>


                        <!-- APPROVED -->

                        <div class="col-md-6 col-xl-3">

                            <article class="metric-card metric-success">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Approved

                                    </span>


                                    <span class="metric-icon">

                                        <i class="bi bi-check-circle-fill"></i>

                                    </span>

                                </div>


                                <div class="metric-value">

                                    {{ Auth::user()->leaveRequests()->where('status', 'Approved')->count() }}

                                </div>


                                <div class="metric-meta">

                                    Approved Leave Requests

                                </div>

                            </article>

                        </div>


                        <!-- REJECTED -->

                        <div class="col-md-6 col-xl-3">

                            <article class="metric-card metric-danger">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Rejected

                                    </span>


                                    <span class="metric-icon">

                                        <i class="bi bi-x-circle-fill"></i>

                                    </span>

                                </div>


                                <div class="metric-value">

                                    {{ Auth::user()->leaveRequests()->where('status', 'Rejected')->count() }}

                                </div>


                                <div class="metric-meta">

                                    Rejected Leave Requests

                                </div>

                            </article>

                        </div>


                        <!-- TOTAL -->

                        <div class="col-md-6 col-xl-3">

                            <article class="metric-card metric-primary">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Total Requests

                                    </span>


                                    <span class="metric-icon">

                                        <i class="bi bi-clipboard-check-fill"></i>

                                    </span>

                                </div>


                                <div class="metric-value">

                                    {{ Auth::user()->leaveRequests()->count() }}

                                </div>


                                <div class="metric-meta">

                                    All Leave Requests

                                </div>

                            </article>

                        </div>


                    </section>


                    <!-- =================================================
                         ALERTS
                         ================================================= -->

                    @if (session('success'))

                        <div class="alert alert-success mt-4">

                            {{ session('success') }}

                        </div>

                    @endif


                    @if ($errors->has('duplicate'))

                        <div class="alert alert-danger mt-4">

                            <i class="bi bi-exclamation-triangle-fill"></i>

                            {{ $errors->first('duplicate') }}

                        </div>

                    @endif


                    @if (session('error'))

                        <div class="alert alert-danger mt-4">

                            {{ session('error') }}

                        </div>

                    @endif


                    <!-- =================================================
                         LEAVE REQUEST FORM

                         FULL WIDTH
                         ================================================= -->

                    <section class="mt-4">


                        <form action="{{ route('leave.store') }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="panel shadow-sm leave-form-panel">

                            @csrf


                            <!-- FORM HEADER -->

                            <div class="panel-header">

                                <div>

                                    <h2 class="h4 mb-2 section-title">

                                        <i class="bi bi-calendar-plus"></i>

                                        <span>
                                            Leave Request Form
                                        </span>

                                    </h2>


                                    <p class="text-muted mb-4">

                                        Complete all required fields.

                                    </p>

                                </div>

                            </div>


                            <!-- FORM FIELDS -->

                            <div class="row g-3">


                                <!-- LEAVE TYPE -->

                                <div class="col-12 col-lg-6">

                                    <label class="form-label">

                                        Leave Type

                                    </label>


                                    <select class="form-select"
                                        name="leave_type"
                                        required>

                                        <option value="">

                                            Select Leave Type

                                        </option>


                                        <option value="Vacation Leave">

                                            Vacation Leave

                                        </option>


                                        <option value="Sick Leave">

                                            Sick Leave

                                        </option>


                                        <option value="Emergency Leave">

                                            Emergency Leave

                                        </option>


                                        <option value="Maternity Leave">

                                            Maternity Leave

                                        </option>


                                        <option value="Paternity Leave">

                                            Paternity Leave

                                        </option>


                                        <option value="Bereavement Leave">

                                            Bereavement Leave

                                        </option>


                                        <option value="Leave Without Pay">

                                            Leave Without Pay

                                        </option>


                                        <option value="Study Leave">

                                            Study Leave

                                        </option>


                                        <option value="Special Leave">

                                            Special Leave

                                        </option>

                                    </select>

                                </div>


                                <!-- LEAVE PAY TYPE -->

                                <div class="col-12 col-lg-6">

                                    <label class="form-label">

                                        Leave Pay Type

                                    </label>


                                    <select class="form-select"
                                        name="leave_pay_type"
                                        required>

                                        <option value="">

                                            Select Leave Pay Type

                                        </option>


                                        <option value="Leave with pay">

                                            Leave With Pay

                                        </option>


                                        <option value="Leave without pay">

                                            Leave Without Pay

                                        </option>

                                    </select>

                                </div>


                                <!-- START DATE -->

                                <div class="col-12 col-sm-6 col-lg-3">

                                    <label class="form-label">

                                        Start Date

                                    </label>


                                    <input type="date"
                                        id="start_date"
                                        name="start_date"
                                        class="form-control"
                                        required>

                                </div>


                                <!-- END DATE -->

                                <div class="col-12 col-sm-6 col-lg-3">

                                    <label class="form-label">

                                        End Date

                                    </label>


                                    <input type="date"
                                        id="end_date"
                                        name="end_date"
                                        class="form-control"
                                        required>

                                </div>


                                <!-- EXPECTED RETURN -->

                                <div class="col-12 col-sm-6 col-lg-3">

                                    <label class="form-label">

                                        Expected Return Date

                                    </label>


                                    <input type="date"
                                        name="return_date"
                                        class="form-control"
                                        required>

                                </div>


                                <!-- TOTAL DAYS -->

                                <div class="col-12 col-sm-6 col-lg-3">

                                    <label class="form-label">

                                        Total Days

                                    </label>


                                    <input type="text"
                                        id="days"
                                        name="days"
                                        class="form-control"
                                        readonly>

                                </div>


                                <!-- REASON -->

                                <div class="col-12">

                                    <label class="form-label">

                                        Reason for Leave

                                    </label>


                                    <textarea class="form-control"
                                        rows="6"
                                        name="reason"
                                        placeholder="Explain the reason for your leave..."
                                        required></textarea>

                                </div>


                                <!-- ATTACHMENT -->

                                <div class="col-12 col-lg-6">

                                    <label class="form-label">

                                        Attachment

                                    </label>


                                    <input type="file"
                                        class="form-control"
                                        id="attachment"
                                        name="attachment">


                                    <small class="text-muted">

                                        Required for Sick Leave.

                                    </small>

                                </div>

                            </div>


                            <!-- SUBMIT -->

                            <div class="mt-4 text-end leave-submit-area">

                                <button type="submit"
                                    class="btn btn-primary btn-lg px-5">

                                    <i class="bi bi-send"></i>

                                    Submit Leave Request

                                </button>

                            </div>

                        </form>

                    </section>


                    <!-- =================================================
                         LEAVE HISTORY
                         ================================================= -->

                    <section class="mt-4">


                        <div class="panel leave-history-panel">


                            <div class="panel-header d-flex justify-content-between align-items-center">

                                <div>

                                    <h5 class="mb-1">

                                        <i class="bi bi-clock-history"></i>

                                        Leave History

                                    </h5>


                                    <small class="text-muted">

                                        Your previous leave requests

                                    </small>

                                </div>

                            </div>


                            <div class="leave-history-table-wrapper">

                                <table class="table align-middle leave-history-table">

                                    <thead>

                                        <tr>

                                            <th>
                                                Date Filed
                                            </th>

                                            <th>
                                                Leave Type
                                            </th>

                                            <th>
                                                Period
                                            </th>

                                            <th>
                                                Days
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                            <th width="130">
                                                Action
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                        @forelse($leaveHistory as $leave)

                                            <tr>


                                                <!-- DATE FILED -->

                                                <td>

                                                    {{ $leave->created_at->format('M d, Y') }}

                                                </td>


                                                <!-- TYPE -->

                                                <td>

                                                    {{ $leave->leave_type }}

                                                </td>


                                                <!-- PERIOD -->

                                                <td>

                                                    {{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }}

                                                    -

                                                    {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}

                                                </td>


                                                <!-- DAYS -->

                                                <td>

                                                    {{ $leave->days }}

                                                </td>


                                                <!-- STATUS -->

                                                <td>

                                                    @if ($leave->status == 'Approved')

                                                        <span class="badge bg-success">

                                                            Approved

                                                        </span>

                                                    @elseif ($leave->status == 'Rejected')

                                                        <span class="badge bg-danger">

                                                            Rejected

                                                        </span>

                                                    @elseif ($leave->status == 'Cancelled')

                                                        <span class="badge bg-secondary">

                                                            Cancelled

                                                        </span>

                                                    @else

                                                        <span class="badge bg-warning text-dark">

                                                            Pending

                                                        </span>

                                                    @endif

                                                </td>


                                                <!-- ACTION -->

                                                <td>

                                                    @if ($leave->status === 'Pending')

                                                        <form action="{{ route('leave.cancel', $leave->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to cancel this leave request?')">

                                                            @csrf

                                                            @method('DELETE')


                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm">

                                                                <i class="bi bi-x-circle"></i>

                                                                Cancel

                                                            </button>

                                                        </form>

                                                    @else

                                                        <span class="text-muted">

                                                            --

                                                        </span>

                                                    @endif

                                                </td>


                                            </tr>

                                        @empty


                                            <tr>

                                                <td colspan="6"
                                                    class="text-center text-muted py-5">

                                                    <i class="bi bi-calendar-x fs-1"></i>


                                                    <h5 class="mt-3">

                                                        No leave requests yet.

                                                    </h5>

                                                </td>

                                            </tr>


                                        @endforelse


                                    </tbody>

                                </table>

                            </div>


                            <div class="mt-3">

                                {{ $leaveHistory->links() }}

                            </div>


                        </div>

                    </section>


                </div>

            </main>


            <!-- =================================================
                 FOOTER
                 ================================================= -->

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">

                    <span>

                        Copyright 2026 adminHMD.

                        <br>

                        Developed by

                        <a target="_blank"
                            class="fw-bold text-success"
                            href="https://github.com/HasanMahmudDev">

                            Md. Hasan Mahmud

                        </a>

                        • Distributed by

                        <a target="_blank"
                            class="fw-bold text-success"
                            href="https://themewagon.com">

                            ThemeWagon

                        </a>

                    </span>


                    <span>

                        Professional dashboard template.

                    </span>


                    <span>

                        Validated user creation form.

                    </span>

                </div>

            </footer>


        </div>

    </div>


    <!-- =========================================================
         DATE CALCULATION
         ========================================================= -->

    <script>

        const startDate =
            document.getElementById('start_date');

        const endDate =
            document.getElementById('end_date');

        const totalDays =
            document.getElementById('days');


        function calculateDays() {

            if (!startDate.value || !endDate.value) {

                totalDays.value = '';

                return;

            }


            const start =
                new Date(startDate.value + 'T00:00:00');

            const end =
                new Date(endDate.value + 'T00:00:00');


            const difference =
                Math.round(
                    (end - start) /
                    (1000 * 60 * 60 * 24)
                ) + 1;


            totalDays.value =
                difference > 0
                    ? difference
                    : 0;

        }


        startDate.addEventListener(
            'change',
            calculateDays
        );


        endDate.addEventListener(
            'change',
            calculateDays
        );


        /* =====================================================
           SICK LEAVE ATTACHMENT
           ===================================================== */

        const leaveType =
            document.querySelector(
                'select[name="leave_type"]'
            );


        const attachment =
            document.getElementById('attachment');


        if (leaveType && attachment) {

            leaveType.addEventListener(
                'change',
                function () {

                    attachment.required =
                        this.value === 'Sick Leave';

                }
            );

        }

    </script>


    <!-- Bootstrap JS -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>


    <!-- Template JS -->

    <script src="../../../../khen/assets/js/main.js"></script>


</body>

</html>
