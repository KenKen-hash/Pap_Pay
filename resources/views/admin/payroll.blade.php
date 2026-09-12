<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pap Pay Payroll Configuration">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payroll Configuration | Pap Pay</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        /* =========================================================
           PAP PAY PAYROLL CONFIGURATION
           RESPONSIVE LAYOUT
        ========================================================= */

        :root {
            --pp-text-strong: #172033;
            --pp-text-muted: #64748b;
            --pp-border: #e8edf3;
            --pp-card-shadow: 0 5px 18px rgba(15, 23, 42, .05);
            --pp-card-shadow-hover: 0 9px 26px rgba(15, 23, 42, .09);

            --pp-primary: #435ebe;
            --pp-success: #198754;
            --pp-info: #0dcaf0;
            --pp-warning: #f59e0b;
            --pp-danger: #dc3545;
        }

        /* =========================================================
           GLOBAL
        ========================================================= */

        html,
        body {
            width: 100%;
            max-width: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden !important;
        }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Helvetica, Arial, sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            color: var(--pp-text-strong);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        img,
        svg,
        video,
        canvas {
            max-width: 100%;
        }

        input,
        select,
        textarea,
        button {
            max-width: 100%;
        }

        /* =========================================================
           MAIN SHELL
        ========================================================= */

        .admin-shell {
            width: 100%;
            max-width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /*
         * IMPORTANT:
         * Do NOT use width:100% here.
         * The sidebar already occupies part of the viewport.
         */

        .admin-main {
            min-width: 0;
            width: auto;
            max-width: 100%;
            flex: 1 1 auto;
            overflow-x: hidden;
        }

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
            overflow-x: hidden;
        }

        /* =========================================================
           PAGE HEADING
           SAME STYLE AS HOME
        ========================================================= */

        .payroll-page-heading {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 1.8rem;
            padding: 4px 2px;
        }

        .payroll-page-heading h1 {
            color: var(--pp-text-strong);
            font-size: clamp(1.55rem, 2.4vw, 2.15rem);
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.2;
            margin: 0 0 5px;
        }

        .payroll-page-heading p {
            color: var(--pp-text-muted) !important;
            font-size: clamp(.92rem, 1.1vw, 1.02rem);
            line-height: 1.6;
            max-width: 950px;
            margin: 0;
        }

        /* =========================================================
           SUMMARY METRIC CARDS
        ========================================================= */

        .payroll-metrics {
            width: 100%;
            margin-bottom: 2rem;
        }

        .summary-card {
            width: 100%;
            min-height: 128px;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .04) !important;
            border-radius: 18px !important;
            box-shadow: var(--pp-card-shadow) !important;
            overflow: hidden;
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--pp-card-shadow-hover) !important;
        }

        .summary-card .card-body {
            min-height: 128px;
            padding: 20px 21px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .summary-card small {
            display: block;
            margin-bottom: 7px;
            color: var(--pp-text-muted) !important;
            font-size: .85rem;
            font-weight: 600;
            line-height: 1.35;
        }

        .summary-card h2,
        .summary-card h5 {
            color: var(--pp-text-strong);
            margin: 0;
            font-weight: 800 !important;
            line-height: 1.2;
        }

        .summary-card h2 {
            font-size: 2rem;
        }

        .summary-card h5 {
            font-size: 1.1rem;
            white-space: nowrap;
        }

        .metric-primary {
            border-left: 4px solid var(--pp-primary) !important;
        }

        .metric-success {
            border-left: 4px solid var(--pp-success) !important;
        }

        .metric-warning {
            border-left: 4px solid var(--pp-warning) !important;
        }

        .metric-info {
            border-left: 4px solid var(--pp-info) !important;
        }

        /* =========================================================
           DEPARTMENT GRID
        ========================================================= */

        .department-grid {
            width: 100%;
            margin-top: 0;
        }

        .department-grid > [class*="col-"] {
            min-width: 0;
        }

        .department-link {
            display: block;
            width: 100%;
            height: 100%;
            color: inherit;
            text-decoration: none !important;
        }

        .department-card {
            width: 100%;
            min-width: 0;
            min-height: 250px;
            height: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 36px 24px !important;

            background: #fff;
            border: 1px solid var(--pp-border) !important;
            border-radius: 18px !important;
            box-shadow: var(--pp-card-shadow) !important;

            text-align: center;

            transition:
                transform .22s ease,
                box-shadow .22s ease,
                border-color .22s ease;

            overflow: hidden;
        }

        .department-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--pp-card-shadow-hover) !important;
        }

        .department-card i {
            display: block;
            font-size: 3rem !important;
            line-height: 1;
        }

        .department-card h4 {
            color: var(--pp-text-strong);
            font-size: 1.2rem;
            font-weight: 750;
            letter-spacing: -.015em;
            line-height: 1.3;

            margin-top: 1.15rem !important;
            margin-bottom: .45rem;
        }

        .department-card p {
            max-width: 320px;
            margin: 0;

            color: var(--pp-text-muted) !important;
            font-size: .92rem;
            line-height: 1.55;
        }

        /* =========================================================
           EXISTING PAYROLL ACCORDION
        ========================================================= */

        .payroll-accordion .accordion-item {
            border: none;
            border-radius: 18px;
            overflow: hidden;
        }

        .payroll-accordion .accordion-button {
            background: #198754;
            color: #fff;
            padding: 22px;
            box-shadow: none;
        }

        .payroll-accordion .accordion-button small {
            color: #d7f7e3;
        }

        .payroll-accordion .accordion-button:not(.collapsed) {
            background: #157347;
            color: white;
        }

        .payroll-accordion .accordion-button::after {
            filter: brightness(0) invert(1);
        }

        /* =========================================================
           SALARY TABLE
        ========================================================= */

        .salary-table-wrap {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .salary-table {
            width: 100%;
        }

        .salary-table thead {
            background: #f8f9fa;
        }

        .salary-table thead th {
            font-weight: 600;
            border: none;
            padding: 16px;
            white-space: nowrap;
        }

        .salary-table tbody td {
            padding: 18px 16px;
            vertical-align: middle;
        }

        .salary-table tbody tr {
            transition: .25s;
        }

        .salary-table tbody tr:hover {
            background: #f8f9fa;
        }

        .salary-table img {
            object-fit: cover;
        }

        /* =========================================================
           MODAL
        ========================================================= */

        .modal-dialog {
            width: auto;
            max-width: min(800px, calc(100vw - 24px));
            margin: .75rem auto;
        }

        .modal-content {
            width: 100%;
            max-width: 100%;
            border: 0;
            border-radius: 20px;
            overflow: hidden;
        }

        .modal-header {
            padding: 22px;
        }

        .modal-header small {
            opacity: .85;
        }

        .modal-body {
            width: 100%;
            max-width: 100%;
            padding: 20px;
            background: #f8f9fa;

            max-height: calc(100vh - 170px);
            overflow-x: hidden;
            overflow-y: auto;
        }

        .modal-footer {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .modal .card {
            width: 100%;
            max-width: 100%;
            border-radius: 16px;
        }

        .modal .card-header {
            font-weight: 600;
            background: #fff;
        }

        .modal label {
            font-size: .85rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .input-group {
            max-width: 100%;
        }

        .input-group-text {
            font-weight: 600;
        }

        #modalPhoto {
            object-fit: cover;
            background: #fff;
        }

        #departmentFields {
            width: 100%;
            max-width: 100%;
        }

        #departmentFields .card {
            animation: fadeIn .25s ease;
        }

        #departmentFields .row {
            width: 100%;
            max-width: 100%;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .admin-footer {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

        /* =========================================================
           ANIMATION
        ========================================================= */

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================================================
           LARGE TABLET
        ========================================================= */

        @media (max-width: 1199.98px) {

            .summary-card h5 {
                font-size: 1rem;
            }

            .department-card {
                min-height: 235px;
                padding: 32px 22px !important;
            }

            .department-card i {
                font-size: 2.75rem !important;
            }

        }

        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 991.98px) {

            .payroll-page-heading {
                margin-bottom: 1.5rem;
            }

            .summary-card {
                min-height: 118px;
            }

            .summary-card .card-body {
                min-height: 118px;
            }

            .department-card {
                min-height: 225px;
            }

        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767.98px) {

            .payroll-page-heading {
                gap: 12px;
                margin-bottom: 1.4rem;
                padding: 2px 0;
            }

            .payroll-page-heading h1 {
                font-size: 1.55rem;
            }

            .payroll-page-heading p {
                font-size: .92rem;
            }

            .payroll-metrics {
                margin-bottom: 1.5rem;
            }

            .summary-card {
                min-height: 110px;
                border-radius: 16px !important;
            }

            .summary-card .card-body {
                min-height: 110px;
                padding: 18px;
            }

            .summary-card h2 {
                font-size: 1.8rem;
            }

            .summary-card h5 {
                font-size: 1.05rem;
            }

            .department-card {
                min-height: 215px;
                padding: 30px 20px !important;
                border-radius: 16px !important;
            }

            .department-card i {
                font-size: 2.55rem !important;
            }

            .department-card h4 {
                font-size: 1.1rem;
            }

            .department-card p {
                font-size: .88rem;
            }

            .modal-dialog {
                max-width: calc(100vw - 16px);
                margin: .5rem auto;
            }

            .modal-header {
                padding: 17px;
            }

            .modal-body {
                padding: 15px;
                max-height: calc(100vh - 145px);
            }

            .salary-table {
                min-width: 950px;
            }

        }

        /* =========================================================
           SMALL PHONES
        ========================================================= */

        @media (max-width: 575.98px) {

            .dashboard-content .container-fluid {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .payroll-page-heading {
                margin-bottom: 1.25rem;
            }

            .payroll-page-heading h1 {
                font-size: 1.5rem;
                letter-spacing: -.025em;
            }

            .payroll-page-heading p {
                font-size: .9rem;
                line-height: 1.5;
            }

            .summary-card {
                min-height: 104px;
            }

            .summary-card .card-body {
                min-height: 104px;
                padding: 16px;
            }

            .summary-card small {
                font-size: .82rem;
            }

            .summary-card h2 {
                font-size: 1.65rem;
            }

            .summary-card h5 {
                font-size: 1rem;
                white-space: normal;
            }

            .department-card {
                min-height: 205px;
                padding: 26px 18px !important;
                border-radius: 16px !important;
            }

            .department-card i {
                font-size: 2.35rem !important;
            }

            .department-card h4 {
                font-size: 1.05rem;
                margin-top: .9rem !important;
            }

            .department-card p {
                font-size: .86rem;
            }

            .modal-dialog {
                max-width: calc(100vw - 12px);
                margin: .35rem auto;
            }

            .modal-content {
                border-radius: 16px;
            }

            .modal-header {
                padding: 15px;
            }

            .modal-body {
                padding: 12px;
            }

            .modal-footer {
                padding: 10px 12px;
                gap: 8px;
            }

            .modal-footer .btn {
                width: 100%;
                flex: 1 1 100%;
            }

            #modalPhoto {
                width: 70px !important;
                height: 70px !important;
            }

        }

        /* =========================================================
           VERY SMALL PHONES
        ========================================================= */

        @media (max-width: 380px) {

            .dashboard-content .container-fluid {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            .payroll-page-heading h1 {
                font-size: 1.4rem;
            }

            .payroll-page-heading p {
                font-size: .85rem;
            }

            .summary-card .card-body {
                padding: 14px;
            }

            .summary-card h2 {
                font-size: 1.5rem;
            }

            .summary-card h5 {
                font-size: .92rem;
            }

            .department-card {
                min-height: 190px;
                padding: 22px 14px !important;
            }

            .department-card i {
                font-size: 2.1rem !important;
            }

            .department-card h4 {
                font-size: 1rem;
            }

            .department-card p {
                font-size: .82rem;
            }

        }
    </style>
</head>

<body>

    <div class="admin-shell">

        <div class="sidebar-backdrop" data-sidebar-close></div>

        <!-- =====================================================
             SIDEBAR
        ====================================================== -->

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

                <a class="nav-link active"
                    href="{{ route('payroll') }}">

                    <span class="nav-icon">
                        <i class="bi bi-cash-stack"></i>
                    </span>

                    <span class="nav-text">
                        Payroll
                    </span>

                </a>

                <a class="nav-link"
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

        <!-- =====================================================
             MAIN
        ====================================================== -->

        <div class="admin-main">

            <!-- =================================================
                 NAVBAR
            ================================================== -->

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

                        <!-- Theme -->

                        <button class="icon-button theme-toggle"
                            type="button"
                            data-theme-toggle
                            aria-label="Switch color theme"
                            title="Switch color theme">

                            <i class="bi bi-moon-stars"
                                data-theme-icon
                                aria-hidden="true"></i>

                        </button>

                        <!-- Notifications -->

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

                        <!-- Profile -->

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

            <!-- =================================================
                 PAGE CONTENT
            ================================================== -->

            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4">

                    <!-- =================================================
                         PAGE HEADING
                    ================================================== -->

                    <section class="payroll-page-heading">

                        <div>

                            <h1>
                                Payroll Configuration
                            </h1>

                            <p>
                                Configure salary, hourly rate, allowances and deductions for every employee.
                            </p>

                        </div>

                    </section>

                    <!-- =================================================
                         SUMMARY METRICS
                    ================================================== -->

                    <div class="row g-3 payroll-metrics">

                        <!-- Total Employees -->

                        <div class="col-xl-3 col-md-6">

                            <div class="card summary-card metric-primary">

                                <div class="card-body">

                                    <small>
                                        Total Employees
                                    </small>

                                    <h2>
                                        {{ $employees->flatten()->count() }}
                                    </h2>

                                </div>

                            </div>

                        </div>

                        <!-- Configured -->

                        <div class="col-xl-3 col-md-6">

                            <div class="card summary-card metric-success">

                                <div class="card-body">

                                    <small>
                                        Configured
                                    </small>

                                    <h2 class="fw-bold text-success">

                                        {{ $employees->flatten()->whereNotNull('payrollSetting')->count() }}

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <!-- Pending -->

                        <div class="col-xl-3 col-md-6">

                            <div class="card summary-card metric-warning">

                                <div class="card-body">

                                    <small>
                                        Pending
                                    </small>

                                    <h2 class="fw-bold text-warning">

                                        {{ $employees->flatten()->whereNull('payrollSetting')->count() }}

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <!-- Payroll Schedule -->

                        <div class="col-xl-3 col-md-6">

                            <div class="card summary-card metric-info">

                                <div class="card-body">

                                    <small>
                                        Payroll Schedule
                                    </small>

                                    <h5>
                                        Every 15 Days
                                    </h5>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- =================================================
                         DEPARTMENT CARDS
                    ================================================== -->

                    <div class="row g-3 g-lg-4 department-grid">

                        <!-- Elementary -->

                        <div class="col-xl-4 col-md-6">

                            <a href="{{ route('payroll.department', 'Elementary') }}"
                                class="department-link">

                                <div class="card department-card">

                                    <i class="bi bi-house-door-fill display-4 text-primary"></i>

                                    <h4>
                                        Elementary
                                    </h4>

                                    <p>
                                        Configure payroll for elementary teachers.
                                    </p>

                                </div>

                            </a>

                        </div>

                        <!-- Junior High School -->

                        <div class="col-xl-4 col-md-6">

                            <a href="{{ route('payroll.department', 'JHS') }}"
                                class="department-link">

                                <div class="card department-card">

                                    <i class="bi bi-book-fill display-4 text-success"></i>

                                    <h4>
                                        Junior High School
                                    </h4>

                                    <p>
                                        Configure payroll for JHS.
                                    </p>

                                </div>

                            </a>

                        </div>

                        <!-- Senior High -->

                        <div class="col-xl-4 col-md-6">

                            <a href="{{ route('payroll.department', 'SHS') }}"
                                class="department-link">

                                <div class="card department-card">

                                    <i class="bi bi-journal-bookmark-fill display-4 text-danger"></i>

                                    <h4>
                                        Senior High
                                    </h4>

                                    <p>
                                        Configure payroll for SHS.
                                    </p>

                                </div>

                            </a>

                        </div>

                        <!-- College -->

                        <div class="col-xl-4 col-md-6">

                            <a href="{{ route('payroll.department', 'College') }}"
                                class="department-link">

                                <div class="card department-card">

                                    <i class="bi bi-mortarboard-fill display-4 text-warning"></i>

                                    <h4>
                                        College
                                    </h4>

                                    <p>
                                        Configure payroll for college faculty.
                                    </p>

                                </div>

                            </a>

                        </div>

                        <!-- Administrative -->

                        <div class="col-xl-4 col-md-6">

                            <a href="{{ route('payroll.department', 'Admin') }}"
                                class="department-link">

                                <div class="card department-card">

                                    <i class="bi bi-building-fill display-4 text-info"></i>

                                    <h4>
                                        Administrative
                                    </h4>

                                    <p>
                                        Configure payroll for office personnel.
                                    </p>

                                </div>

                            </a>

                        </div>

                        <!-- Laborers -->

                        <div class="col-xl-4 col-md-6">

                            <a href="{{ route('payroll.department', 'Laborers') }}"
                                class="department-link">

                                <div class="card department-card">

                                    <i class="bi bi-person-workspace display-4 text-secondary"></i>

                                    <h4>
                                        Laborers
                                    </h4>

                                    <p>
                                        Configure payroll for maintenance personnel.
                                    </p>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>

            </main>

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">
                </div>

            </footer>

        </div>

    </div>

    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>

    <script>

        // =========================================================
        // Employee Search
        // =========================================================

        const search = document.getElementById("employeeSearch");

        if (search) {

            search.addEventListener("keyup", function () {

                let value = this.value.toLowerCase();

                document
                    .querySelectorAll(".employee-row")
                    .forEach(row => {

                        row.style.display =
                            row.innerText
                                .toLowerCase()
                                .includes(value)
                                ? ""
                                : "none";

                    });

            });

        }

        // =========================================================
        // Department Filter
        // =========================================================

        const departmentFilter =
            document.getElementById("departmentFilter");

        if (departmentFilter) {

            departmentFilter.addEventListener("change", function () {

                let value = this.value;

                document
                    .querySelectorAll(".department-container")
                    .forEach(section => {

                        if (value === "") {

                            section.style.display = "";

                            return;

                        }

                        section.style.display =
                            section.innerText.includes(value)
                                ? ""
                                : "none";

                    });

            });

        }

        // =========================================================
        // Payroll Modal
        // =========================================================

        const payrollModalElement =
            document.getElementById("payrollModal");

        let payrollModal = null;

        if (payrollModalElement) {

            payrollModal =
                new bootstrap.Modal(payrollModalElement);

        }

        document
            .querySelectorAll(".configurePayroll")
            .forEach(button => {

                button.addEventListener("click", function () {

                    const userId =
                        document.getElementById("user_id");

                    const modalPhoto =
                        document.getElementById("modalPhoto");

                    const modalName =
                        document.getElementById("modalName");

                    const modalEmployeeID =
                        document.getElementById("modalEmployeeID");

                    const modalDepartment =
                        document.getElementById("modalDepartment");

                    const modalPosition =
                        document.getElementById("modalPosition");

                    if (userId) {

                        userId.value =
                            this.dataset.id;

                    }

                    if (modalPhoto) {

                        modalPhoto.src =
                            this.dataset.photo;

                    }

                    if (modalName) {

                        modalName.innerText =
                            this.dataset.name;

                    }

                    if (modalEmployeeID) {

                        modalEmployeeID.innerText =
                            this.dataset.employeeid;

                    }

                    if (modalDepartment) {

                        modalDepartment.innerText =
                            this.dataset.department;

                    }

                    if (modalPosition) {

                        modalPosition.innerText =
                            this.dataset.position;

                    }

                    loadDepartmentFields(
                        this.dataset.department
                    );

                    if (payrollModal) {

                        payrollModal.show();

                    }

                });

            });

        // =========================================================
        // Show Department Form
        // =========================================================

        function loadDepartmentFields(department) {

            let html = "";

            // =====================================================
            // PRIMARY
            // =====================================================

            if (department === "Primary") {

                html = `

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-header bg-light">

                            <h5 class="mb-0">
                                <i class="bi bi-cash-coin me-2"></i>
                                Department Earnings
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Other Allowance
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="other_allowance"
                                            class="form-control"
                                            value="0">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                `;

            }

            // =====================================================
            // SECONDARY
            // =====================================================

            if (department === "Secondary") {

                html = `

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-header bg-light">

                            <h5 class="mb-0">
                                <i class="bi bi-cash-coin me-2"></i>
                                Department Earnings
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row g-4">

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Teaching Load Pay
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="teaching_load"
                                            class="form-control"
                                            value="0">

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Advisory Allowance
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="advisory_allowance"
                                            class="form-control"
                                            value="0">

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Other Allowance
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="other_allowance"
                                            class="form-control"
                                            value="0">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                `;

            }

            // =====================================================
            // TERTIARY
            // =====================================================

            if (department === "Tertiary") {

                html = `

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-header bg-light">

                            <h5 class="mb-0">
                                <i class="bi bi-cash-coin me-2"></i>
                                Department Earnings
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row g-4">

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Teaching Load Pay
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="teaching_load"
                                            class="form-control"
                                            value="0">

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Laboratory Rate
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="laboratory_rate"
                                            class="form-control"
                                            value="0">

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Other Allowance
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="other_allowance"
                                            class="form-control"
                                            value="0">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                `;

            }

            // =====================================================
            // NON TEACHING
            // =====================================================

            if (department === "Non-Teaching") {

                html = `

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-header bg-light">

                            <h5 class="mb-0">
                                <i class="bi bi-cash-coin me-2"></i>
                                Department Earnings
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Other Allowance
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="other_allowance"
                                            class="form-control"
                                            value="0">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                `;

            }

            const departmentFields =
                document.getElementById("departmentFields");

            if (departmentFields) {

                departmentFields.innerHTML = html;

            }

        }

        // =========================================================
        // Auto Compute Daily & Hourly
        // =========================================================

        document.addEventListener("input", function (e) {

            if (e.target.name === "monthly_rate") {

                let monthly =
                    parseFloat(e.target.value) || 0;

                let daily =
                    monthly / 22;

                let hourly =
                    daily / 8;

                document
                    .querySelectorAll("[name='daily_rate']")
                    .forEach(input => {

                        input.value =
                            daily.toFixed(2);

                    });

                document
                    .querySelectorAll("[name='hourly_rate']")
                    .forEach(input => {

                        input.value =
                            hourly.toFixed(2);

                    });

            }

        });

        // =========================================================
        // Deduction Total
        // =========================================================

        document.addEventListener("input", function () {

            let total = 0;

            document
                .querySelectorAll(".deduction")
                .forEach(input => {

                    total +=
                        parseFloat(input.value) || 0;

                });

            const monthlyDeduction =
                document.getElementById("monthlyDeduction");

            const payrollDeduction =
                document.getElementById("payrollDeduction");

            if (monthlyDeduction) {

                monthlyDeduction.innerHTML =
                    "₱" +
                    total.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    });

            }

            if (payrollDeduction) {

                payrollDeduction.innerHTML =
                    "₱" +
                    (total / 2).toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    });

            }

        });

        // =========================================================
        // Allowance Total
        // =========================================================

        document.addEventListener("input", function () {

            let total = 0;

            document
                .querySelectorAll(".allowance")
                .forEach(function (input) {

                    total +=
                        parseFloat(input.value) || 0;

                });

            const totalElement =
                document.getElementById("allowanceTotal");

            if (totalElement) {

                totalElement.innerHTML =
                    "₱" +
                    total.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    });

            }

        });

        // =========================================================
        // Save Payroll Configuration
        // =========================================================

        const savePayrollButton =
            document.getElementById("savePayroll");

        if (savePayrollButton) {

            savePayrollButton.addEventListener(
                "click",
                function () {

                    let form =
                        document.getElementById("payrollForm");

                    if (!form) {

                        alert(
                            "Payroll form could not be found."
                        );

                        return;

                    }

                    let formData =
                        new FormData(form);

                    fetch(
                        "{{ route('payroll.save') }}",
                        {
                            method: "POST",

                            headers: {
                                "X-CSRF-TOKEN":
                                    document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        .content
                            },

                            body: formData
                        }
                    )
                    .then(response => {

                        if (!response.ok) {

                            throw new Error(
                                "Server returned an error."
                            );

                        }

                        return response.json();

                    })
                    .then(data => {

                        if (data.success) {

                            alert(
                                "Payroll configuration saved successfully."
                            );

                            if (payrollModal) {

                                payrollModal.hide();

                            }

                            location.reload();

                        } else {

                            alert(
                                data.message ||
                                "Failed to save payroll configuration."
                            );

                        }

                    })
                    .catch(error => {

                        console.error(error);

                        alert(
                            "Failed to save payroll configuration."
                        );

                    });

                }
            );

        }

    </script>

</body>

</html>
