<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Attendance List | Pap Pay</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        /* =========================================================
           PAP PAY ATTENDANCE PAGE
           Typography and metric styling matched to Home dashboard
           ========================================================= */

        :root {
            --pp-text-strong: #172033;
            --pp-text-muted: #64748b;
            --pp-border: #e8edf3;
            --pp-card-shadow: 0 5px 18px rgba(15, 23, 42, .05);
            --pp-primary: #435ebe;
            --pp-success: #198754;
            --pp-warning: #f59e0b;
            --pp-danger: #dc3545;
        }

        /* =========================================================
           GLOBAL TYPOGRAPHY
           ========================================================= */

        body {
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Helvetica,
                Arial,
                sans-serif;

            font-size: 1rem;
            line-height: 1.6;
            color: var(--pp-text-strong);
        }

        /* =========================================================
           PAGE HEADER
           Matches Home dashboard heading style
           ========================================================= */

        .attendance-page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 1.8rem;
            padding: 4px 2px;
        }

        .attendance-page-heading {
            min-width: 0;
        }

        .attendance-page-heading h1 {
            color: var(--pp-text-strong);
            font-size: clamp(1.55rem, 2.4vw, 2.15rem);
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.2;
            margin: 0 0 5px;
        }

        .attendance-page-heading p {
            color: var(--pp-text-muted) !important;
            font-size: clamp(.92rem, 1.1vw, 1.02rem);
            font-weight: 400;
            line-height: 1.6;
            max-width: 950px;
            margin: 0;
        }

        /* =========================================================
           ACTION BUTTONS
           ========================================================= */

        .attendance-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-shrink: 0;
        }

        .attendance-actions .btn {
            min-height: 42px;
            border-radius: 10px;
            padding: 9px 15px;
            font-size: .88rem;
            font-weight: 600;
            line-height: 1.2;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            white-space: nowrap;
            transition: all .2s ease;
        }

        .attendance-actions .btn:hover {
            transform: translateY(-1px);
        }

        /* =========================================================
           FILTER AREA
           ========================================================= */

        .attendance-filter {
            margin-bottom: 1.5rem;
        }

        .attendance-filter .form-control {
            min-height: 44px;
            border: 1px solid #dfe5ec;
            border-radius: 10px;
            padding: 9px 13px;
            font-size: .9rem;
            color: var(--pp-text-strong);
            box-shadow: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .attendance-filter .form-control:focus {
            border-color: rgba(67, 94, 190, .5);
            box-shadow: 0 0 0 3px rgba(67, 94, 190, .08);
        }

        .attendance-filter .btn {
            min-height: 44px;
            border-radius: 10px;
            font-size: .88rem;
            font-weight: 600;
        }

        /* =========================================================
           METRIC CARDS
           Designed to match the Home dashboard cards
           ========================================================= */

        .attendance-metrics {
            margin-bottom: 1.8rem;
        }

        .attendance-metric-col {
            display: flex;
        }

        .attendance-metric-card {
            position: relative;
            width: 100%;
            min-height: 128px;
            padding: 20px 21px;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .04);
            border-radius: 18px;
            box-shadow: var(--pp-card-shadow);
            overflow: hidden;
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .attendance-metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 9px 25px rgba(15, 23, 42, .08);
        }

        .attendance-metric-card::after {
            content: "";
            position: absolute;
            right: -25px;
            bottom: -35px;
            width: 95px;
            height: 95px;
            border-radius: 50%;
            background: rgba(67, 94, 190, .035);
            pointer-events: none;
        }

        .attendance-metric-card.metric-primary {
            border-left: 4px solid var(--pp-primary);
        }

        .attendance-metric-card.metric-success {
            border-left: 4px solid var(--pp-success);
        }

        .attendance-metric-card.metric-warning {
            border-left: 4px solid var(--pp-warning);
        }

        .attendance-metric-card.metric-danger {
            border-left: 4px solid var(--pp-danger);
        }

        .attendance-metric-label {
            position: relative;
            z-index: 1;
            display: block;
            color: #64748b;
            font-size: .85rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 5px;
        }

        .attendance-metric-value {
            position: relative;
            z-index: 1;
            color: var(--pp-text-strong);
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -.025em;
            margin: 0;
        }

        .attendance-metric-value.success {
            color: var(--pp-success);
        }

        .attendance-metric-value.warning {
            color: #d98b00;
        }

        .attendance-metric-value.danger {
            color: var(--pp-danger);
        }

        /* =========================================================
           TABLE CARD
           ========================================================= */

        .attendance-table-card {
            border: 1px solid rgba(0, 0, 0, .04) !important;
            border-radius: 18px !important;
            background: #fff;
            box-shadow: var(--pp-card-shadow) !important;
            overflow: hidden;
        }

        .attendance-table-card .card-body {
            padding: 22px;
        }

        .attendance-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .attendance-table {
            min-width: 1050px;
            margin-bottom: 0;
        }

        .attendance-table thead th {
            color: #64748b;
            background: #f8fafc;
            border-bottom: 1px solid #e9edf3;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .01em;
            text-transform: uppercase;
            white-space: nowrap;
            padding: 13px 12px;
        }

        .attendance-table tbody td {
            color: #334155;
            font-size: .88rem;
            font-weight: 400;
            border-bottom: 1px solid #eef1f5;
            padding: 13px 12px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .attendance-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .attendance-table tbody tr {
            transition: background-color .15s ease;
        }

        .attendance-table tbody tr:hover {
            background: #f8fafc;
        }

        .attendance-table .employee-name {
            color: var(--pp-text-strong);
            font-size: .88rem;
            font-weight: 700;
            line-height: 1.35;
        }

        .attendance-table .employee-department {
            display: block;
            color: #94a3b8;
            font-size: .76rem;
            font-weight: 400;
            line-height: 1.4;
            margin-top: 2px;
        }

        .attendance-table .hours-value {
            color: var(--pp-text-strong);
            font-weight: 700;
        }

        /* =========================================================
           STATUS BADGES
           ========================================================= */

        .attendance-table .badge {
            border-radius: 999px;
            padding: 6px 9px;
            font-size: .72rem;
            font-weight: 700;
            line-height: 1;
        }

        /* =========================================================
           PAGINATION
           ========================================================= */

        .attendance-pagination {
            margin-top: 20px;
        }

        .attendance-pagination .pagination {
            margin-bottom: 0;
            flex-wrap: wrap;
            gap: 4px;
        }

        .attendance-pagination .page-link {
            border-radius: 8px !important;
            border: 1px solid #e2e8f0;
            color: #475569;
            font-size: .82rem;
            font-weight: 600;
            margin: 0;
        }

        .attendance-pagination .page-item.active .page-link {
            background-color: var(--pp-primary);
            border-color: var(--pp-primary);
            color: #fff;
        }

        /* =========================================================
           EMPTY STATE
           ========================================================= */

        .attendance-empty-state {
            color: #64748b;
            font-size: .9rem;
            font-weight: 500;
            padding: 45px 20px !important;
        }

        /* =========================================================
           NOTIFICATION MENU
           ========================================================= */

        .notification-menu {
            width: 350px;
            max-width: 90vw;
        }

        .notification-menu .dropdown-item {
            padding: 12px 16px;
            white-space: normal;
        }

        .notification-title {
            display: block;
            font-weight: 600;
            color: #1e293b;
        }

        .notification-message {
            display: block;
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 3px;
        }

        .notification-time {
            display: block;
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 5px;
        }

        .notification-unread {
            background-color: #eff6ff;
        }

        .notification-unread:hover {
            background-color: #dbeafe;
        }

        /* =========================================================
           RESPONSIVE
           ========================================================= */

        @media (max-width: 991.98px) {
            .attendance-page-header {
                align-items: flex-start;
            }

            .attendance-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .attendance-actions .btn {
                flex: 0 0 auto;
            }

            .attendance-metric-card {
                min-height: 120px;
            }
        }

        @media (max-width: 767.98px) {
            .attendance-page-header {
                gap: 15px;
                margin-bottom: 1.45rem;
                padding: 2px 0;
            }

            .attendance-page-heading h1 {
                font-size: 1.55rem;
                letter-spacing: -.03em;
            }

            .attendance-page-heading p {
                font-size: .92rem;
                line-height: 1.55;
            }

            .attendance-actions {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                width: 100%;
                gap: 8px;
            }

            .attendance-actions .btn {
                width: 100%;
                padding-left: 8px;
                padding-right: 8px;
                font-size: .8rem;
            }

            .attendance-metrics {
                --bs-gutter-y: 12px;
            }

            .attendance-metric-card {
                min-height: 115px;
                padding: 18px;
                border-radius: 16px;
            }

            .attendance-metric-label {
                font-size: .82rem;
            }

            .attendance-metric-value {
                font-size: 1.8rem;
            }

            .attendance-table-card .card-body {
                padding: 15px;
            }
        }

        @media (max-width: 575.98px) {
            .attendance-page-header {
                margin-bottom: 1.25rem;
            }

            .attendance-page-heading h1 {
                font-size: 1.45rem;
            }

            .attendance-page-heading p {
                font-size: .88rem;
            }

            .attendance-actions {
                grid-template-columns: 1fr;
            }

            .attendance-actions .btn {
                min-height: 42px;
            }

            .attendance-filter {
                margin-bottom: 1.25rem;
            }

            .attendance-filter .row {
                --bs-gutter-y: 10px;
            }

            .attendance-metric-card {
                min-height: 105px;
                padding: 17px;
                border-radius: 15px;
            }

            .attendance-metric-label {
                font-size: .8rem;
            }

            .attendance-metric-value {
                font-size: 1.65rem;
            }

            .attendance-table-card .card-body {
                padding: 10px;
            }
        }

        /* =========================================================
           PRINT
           ========================================================= */

        @media print {
            body {
                background: #fff !important;
            }

            .admin-sidebar,
            .admin-navbar,
            .attendance-page-header,
            .attendance-filter,
            .attendance-metrics,
            .admin-footer,
            .sidebar-backdrop {
                display: none !important;
            }

            .admin-main {
                margin: 0 !important;
                width: 100% !important;
            }

            .dashboard-content {
                padding: 0 !important;
                margin: 0 !important;
            }

            .attendance-table-card {
                border: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }

            .attendance-table-card .card-body {
                padding: 0 !important;
            }

            .attendance-table-wrapper {
                overflow: visible !important;
            }

            .attendance-table {
                min-width: 0 !important;
                width: 100% !important;
            }

            .attendance-table thead th,
            .attendance-table tbody td {
                font-size: 10px !important;
                padding: 6px !important;
            }

            .attendance-pagination {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="admin-shell">

        <div class="sidebar-backdrop" data-sidebar-close></div>

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">

            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('admin-dashboard') }}" aria-label="Admin Dashboard">
                    <img src="../../../khen/assets/images/logo.jpg"
                        alt="Pap Pay Logo"
                        class="brand-logo">
                </a>
            </div>

            <nav class="sidebar-nav">

                <a class="nav-link" href="{{ route('admin-dashboard') }}">
                    <span class="nav-icon">
                        <i class="bi bi-speedometer2"></i>
                    </span>
                    <span class="nav-text">Home</span>
                </a>

                <a class="nav-link" href="{{ route('employees.index') }}">
                    <span class="nav-icon">
                        <i class="bi bi-people"></i>
                    </span>
                    <span class="nav-text">Employees</span>
                </a>

                <a class="nav-link active" href="{{ route('attendance_list') }}">
                    <span class="nav-icon">
                        <i class="bi bi-calendar-check"></i>
                    </span>
                    <span class="nav-text">Attendance</span>
                </a>

                <a class="nav-link" href="{{ route('admin.leaves') }}">
                    <span class="nav-icon">
                        <i class="bi bi-calendar-x"></i>
                    </span>
                    <span class="nav-text">Leave Requests</span>
                </a>

                <a class="nav-link" href="{{ route('official_business') }}">
                    <span class="nav-icon">
                        <i class="bi bi-briefcase"></i>
                    </span>
                    <span class="nav-text">Official Business (OB)</span>
                </a>

                <a class="nav-link" href="{{ route('holidays.index') }}">
                    <span class="nav-icon">
                        <i class="bi bi-gear"></i>
                    </span>
                    <span class="nav-text">Holidays</span>
                </a>

                <a class="nav-link" href="{{ route('payroll') }}">
                    <span class="nav-icon">
                        <i class="bi bi-cash-stack"></i>
                    </span>
                    <span class="nav-text">Payroll</span>
                </a>

                <a class="nav-link" href="{{ route('payslip_list') }}">
                    <span class="nav-icon">
                        <i class="bi bi-receipt"></i>
                    </span>
                    <span class="nav-text">Payslips</span>
                </a>

                <a class="nav-link" href="{{ route('admin.payslip-concerns.index') }}">
                    <span class="nav-icon">
                        <i class="bi bi-exclamation-circle"></i>
                    </span>

                    <span class="nav-text">
                        Payslip Concerns
                    </span>
                </a>

                <a class="nav-link" href="{{ route('reports') }}">
                    <span class="nav-icon">
                        <i class="bi bi-bar-chart"></i>
                    </span>
                    <span class="nav-text">Reports</span>
                </a>

                <a class="nav-link" href="{{ route('announcements') }}">
                    <span class="nav-icon">
                        <i class="bi bi-megaphone"></i>
                    </span>
                    <span class="nav-text">Announcements</span>
                </a>

            </nav>

            <div class="sidebar-user">

                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ Auth::user()->photo
                        ? asset('storage/' . Auth::user()->photo)
                        : asset('khen/assets/images/avatar/avatar.jpg') }}"
                    alt="{{ Auth::user()->name }}">

                <strong>{{ Auth::user()->name }}</strong>

                <small>{{ ucfirst(Auth::user()->role ?? 'Employee') }}</small>

            </div>

            <div class="sidebar-footer">
                <span class="status-dot"></span>
                <span class="sidebar-footer-text">
                    System running smoothly
                </span>
            </div>

        </aside>


        <div class="admin-main">

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


                    <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">

                        <input class="form-control search-input"
                            type="search"
                            placeholder="Search users, orders, reports"
                            aria-label="Search">

                    </form>


                    <div class="navbar-actions ms-auto">

                        <button class="icon-button theme-toggle"
                            type="button"
                            data-theme-toggle
                            aria-label="Switch color theme"
                            title="Switch color theme">

                            <i class="bi bi-moon-stars"
                                data-theme-icon
                                aria-hidden="true"></i>

                        </button>


                        <div class="dropdown">

                            <button class="icon-button"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                aria-label="Notifications">

                                @if (($unreadNotifications ?? 0) > 0)
                                    <span class="notification-dot"></span>
                                @endif

                                <i class="bi bi-bell" aria-hidden="true"></i>

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

                                    <form method="POST" action="{{ route('logout') }}">

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


            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4 py-4">


                    <!-- =====================================================
                         PAGE HEADER
                         ===================================================== -->

                    <div class="attendance-page-header">

                        <div class="attendance-page-heading">

                            <h1>Attendance List</h1>

                            <p>
                                Complete employee attendance records
                            </p>

                        </div>


                        <div class="attendance-actions">

                            <a href="{{ route('attendance.export.csv', request()->query()) }}"
                                class="btn btn-success">

                                <i class="bi bi-file-earmark-excel"></i>

                                <span>CSV</span>

                            </a>


                            <a href="{{ route('attendance.export.pdf', request()->query()) }}"
                                class="btn btn-danger">

                                <i class="bi bi-file-earmark-pdf"></i>

                                <span>PDF</span>

                            </a>


                            <button onclick="printAttendance()"
                                class="btn btn-dark">

                                <i class="bi bi-printer"></i>

                                <span>Print</span>

                            </button>

                        </div>

                    </div>


                    <!-- =====================================================
                         FILTER
                         ===================================================== -->

                    <form method="GET"
                        class="attendance-filter">

                        <div class="row g-3">

                            <div class="col-lg-5 col-md-12">

                                <input type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    class="form-control"
                                    placeholder="Search Employee Name or Employee ID">

                            </div>


                            <div class="col-lg-3 col-md-6">

                                <input type="date"
                                    name="date"
                                    value="{{ request('date') }}"
                                    class="form-control">

                            </div>


                            <div class="col-lg-2 col-md-3">

                                <button class="btn btn-primary w-100">

                                    Search

                                </button>

                            </div>


                            <div class="col-lg-2 col-md-3">

                                <a href="{{ route('attendance_list') }}"
                                    class="btn btn-secondary w-100">

                                    Today

                                </a>

                            </div>

                        </div>

                    </form>


                    <!-- =====================================================
                         SUMMARY / METRICS
                         ===================================================== -->

                    <div class="row g-3 attendance-metrics">


                        <div class="col-xl-3 col-md-6 attendance-metric-col">

                            <div class="attendance-metric-card metric-primary">

                                <span class="attendance-metric-label">
                                    Total Records
                                </span>

                                <h2 class="attendance-metric-value">
                                    {{ $attendances->total() }}
                                </h2>

                            </div>

                        </div>


                        <div class="col-xl-3 col-md-6 attendance-metric-col">

                            <div class="attendance-metric-card metric-success">

                                <span class="attendance-metric-label">
                                    Present Today
                                </span>

                                <h2 class="attendance-metric-value success">
                                    {{ $attendances->where('status', 'Present')->count() }}
                                </h2>

                            </div>

                        </div>


                        <div class="col-xl-3 col-md-6 attendance-metric-col">

                            <div class="attendance-metric-card metric-warning">

                                <span class="attendance-metric-label">
                                    Late
                                </span>

                                <h2 class="attendance-metric-value warning">
                                    {{ $attendances->where('status', 'Late')->count() }}
                                </h2>

                            </div>

                        </div>


                        <div class="col-xl-3 col-md-6 attendance-metric-col">

                            <div class="attendance-metric-card metric-danger">

                                <span class="attendance-metric-label">
                                    Absent / Leave
                                </span>

                                <h2 class="attendance-metric-value danger">
                                    {{ $attendances->whereIn('status', ['Absent', 'Leave'])->count() }}
                                </h2>

                            </div>

                        </div>

                    </div>


                    <!-- =====================================================
                         ATTENDANCE TABLE
                         ===================================================== -->

                    <div id="printArea">

                        <div class="card attendance-table-card">

                            <div class="card-body">

                                <div class="attendance-table-wrapper">

                                    <table class="table table-hover align-middle attendance-table">

                                        <thead>

                                            <tr>

                                                <th>ID</th>

                                                <th>Employee</th>

                                                <th>Date</th>

                                                <th>Morning In</th>

                                                <th>Morning Out</th>

                                                <th>Afternoon In</th>

                                                <th>Afternoon Out</th>

                                                <th>Hours</th>

                                                <th>Status</th>

                                                <th>Remarks</th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            @forelse($attendances as $attendance)

                                                <tr>

                                                    <td>
                                                        {{ $attendance->user->employee_id }}
                                                    </td>


                                                    <td>

                                                        <div class="employee-name">
                                                            {{ $attendance->user->name }}
                                                        </div>

                                                        <span class="employee-department">
                                                            {{ $attendance->user->department }}
                                                        </span>

                                                    </td>


                                                    <td>
                                                        {{ $attendance->date->format('M d, Y') }}
                                                    </td>


                                                    <td>

                                                        {{ $attendance->morning_time_in
                                                            ? \Carbon\Carbon::parse($attendance->morning_time_in)->format('h:i A')
                                                            : '-' }}

                                                    </td>


                                                    <td>

                                                        {{ $attendance->morning_time_out
                                                            ? \Carbon\Carbon::parse($attendance->morning_time_out)->format('h:i A')
                                                            : '-' }}

                                                    </td>


                                                    <td>

                                                        {{ $attendance->afternoon_time_in
                                                            ? \Carbon\Carbon::parse($attendance->afternoon_time_in)->format('h:i A')
                                                            : '-' }}

                                                    </td>


                                                    <td>

                                                        {{ $attendance->afternoon_time_out
                                                            ? \Carbon\Carbon::parse($attendance->afternoon_time_out)->format('h:i A')
                                                            : '-' }}

                                                    </td>


                                                    <td class="hours-value">

                                                        {{ number_format($attendance->hours_worked, 2) }}

                                                    </td>


                                                    <td>

                                                        @switch($attendance->status)

                                                            @case('Present')

                                                                <span class="badge bg-success">
                                                                    Present
                                                                </span>

                                                            @break


                                                            @case('Late')

                                                                <span class="badge bg-warning text-dark">
                                                                    Late
                                                                </span>

                                                            @break


                                                            @case('Absent')

                                                                <span class="badge bg-danger">
                                                                    Absent
                                                                </span>

                                                            @break


                                                            @case('Leave')

                                                                <span class="badge bg-info">
                                                                    Leave
                                                                </span>

                                                            @break


                                                            @case('Official Business')

                                                                <span class="badge bg-primary">
                                                                    OB
                                                                </span>

                                                            @break


                                                            @default

                                                                <span class="badge bg-secondary">
                                                                    {{ $attendance->status }}
                                                                </span>

                                                        @endswitch

                                                    </td>


                                                    <td>
                                                        {{ $attendance->remarks ?? '-' }}
                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="10"
                                                        class="text-center attendance-empty-state">

                                                        No attendance records found.

                                                    </td>

                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>


                                <!-- =================================================
                                     PAGINATION
                                     ================================================= -->

                                <div class="attendance-pagination">

                                    {{ $attendances->links() }}

                                </div>

                            </div>

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


    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>

    <script>

        function printAttendance() {

            const printContents =
                document.getElementById("printArea").innerHTML;

            const originalContents =
                document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

            location.reload();

        }

    </script>

</body>

</html>
