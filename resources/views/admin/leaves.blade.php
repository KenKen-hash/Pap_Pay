<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Leave Request | Pap Pay</title>

    <link rel="icon" type="image/x-icon" href="../../../../khen/assets/images/favicon.png">
    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        /* =========================================================
           PAP PAY - LEAVE MANAGEMENT PAGE
           Dashboard Typography + Metric Card Styling
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

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Helvetica, Arial, sans-serif;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* =========================================================
           PAGE HEADING
        ========================================================= */

        .page-heading {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 1.8rem;
            padding: 4px 2px;
        }

        .page-heading-copy {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            width: 100%;
        }

        .page-heading h1,
        .page-heading .h3 {
            color: var(--pp-text-strong);
            font-size: clamp(1.55rem, 2.4vw, 2.15rem) !important;
            font-weight: 800 !important;
            letter-spacing: -0.035em;
            line-height: 1.2;
            margin: 0 0 5px !important;
        }

        .page-heading p {
            color: var(--pp-text-muted) !important;
            font-size: clamp(.92rem, 1.1vw, 1.02rem);
            line-height: 1.6;
            max-width: 950px;
            margin: 0 !important;
        }

        /* =========================================================
           METRIC CARDS
           Styled to match the Home dashboard cards
        ========================================================= */

        .leave-metric-card {
            position: relative;
            width: 100%;
            min-height: 128px;
            padding: 20px 21px;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .04);
            border-radius: 18px;
            box-shadow: var(--pp-card-shadow);
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .leave-metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
        }

        .leave-metric-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            border-radius: 18px 0 0 18px;
        }

        .leave-metric-card.metric-warning::before {
            background: var(--pp-warning);
        }

        .leave-metric-card.metric-success::before {
            background: var(--pp-success);
        }

        .leave-metric-card.metric-danger::before {
            background: var(--pp-danger);
        }

        .leave-metric-card.metric-primary::before {
            background: var(--pp-primary);
        }

        .leave-metric-label {
            display: block;
            font-size: .85rem;
            font-weight: 600;
            color: var(--pp-text-muted);
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .leave-metric-value {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .leave-metric-description {
            margin: 5px 0 0;
            font-size: .88rem;
            color: var(--pp-text-muted);
            line-height: 1.45;
        }

        .leave-metric-value.text-warning {
            color: var(--pp-warning) !important;
        }

        .leave-metric-value.text-success {
            color: var(--pp-success) !important;
        }

        .leave-metric-value.text-danger {
            color: var(--pp-danger) !important;
        }

        .leave-metric-value.text-primary {
            color: var(--pp-primary) !important;
        }

        /* =========================================================
           MAIN PANEL
        ========================================================= */

        .leave-requests-panel {
            background: #fff;
            border: 1px solid var(--pp-border);
            border-radius: 18px;
            box-shadow: var(--pp-card-shadow);
            overflow: hidden;
        }

        .leave-panel-header {
            padding: 22px 24px;
            border-bottom: 1px solid var(--pp-border);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--pp-text-strong);
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: -0.015em;
            line-height: 1.3;
            margin: 0 0 5px;
        }

        .section-title i {
            color: var(--pp-primary);
            font-size: 1.05rem;
        }

        .leave-panel-header p {
            color: var(--pp-text-muted) !important;
            font-size: .9rem;
            line-height: 1.5;
        }

        /* =========================================================
           TABLE
        ========================================================= */

        .leave-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .leave-table {
            min-width: 1050px;
            margin-bottom: 0;
        }

        .leave-table thead th {
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--pp-border);
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .02em;
            text-transform: uppercase;
            white-space: nowrap;
            padding: 13px 15px;
        }

        .leave-table tbody td {
            color: #334155;
            font-size: .9rem;
            font-weight: 400;
            padding: 14px 15px;
            border-bottom: 1px solid #eef2f6;
            vertical-align: middle;
        }

        .leave-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .leave-table tbody strong {
            color: var(--pp-text-strong);
            font-weight: 700;
        }

        .leave-table tbody small {
            color: var(--pp-text-muted);
            font-size: .78rem;
        }

        .employee-avatar {
            width: 45px;
            height: 45px;
            min-width: 45px;
            object-fit: cover;
        }

        /* =========================================================
           STATUS BADGES
        ========================================================= */

        .leave-status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            line-height: 1.2;
            white-space: nowrap;
        }

        .leave-status-pending {
            background: rgba(245, 158, 11, .12);
            color: #b77900;
        }

        .leave-status-approved {
            background: rgba(25, 135, 84, .12);
            color: #157347;
        }

        .leave-status-rejected {
            background: rgba(220, 53, 69, .10);
            color: #bb2d3b;
        }

        /* =========================================================
           VIEW BUTTON
        ========================================================= */

        .view-leave-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* =========================================================
           MODAL
        ========================================================= */

        #leaveModal .modal-dialog {
            max-width: 1100px;
        }

        #leaveModal .modal-content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(15, 23, 42, .18);
        }

        #leaveModal .modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--pp-border);
            background: #fff;
        }

        #leaveModal .modal-title {
            color: var(--pp-text-strong);
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -.015em;
        }

        #leaveModal .modal-body {
            padding: 24px;
        }

        #leaveModal .modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--pp-border);
        }

        #employeePhoto {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 4px solid #f1f5f9;
        }

        #employeeName {
            color: var(--pp-text-strong);
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        #employeeDepartment,
        #employeePosition {
            color: var(--pp-text-muted);
            font-size: .9rem;
            margin-bottom: 3px;
        }

        .leave-details-table {
            margin-bottom: 0;
        }

        .leave-details-table th {
            width: 160px;
            color: var(--pp-text-muted);
            font-size: .84rem;
            font-weight: 700;
            padding: 12px 10px;
            border-bottom: 1px solid #eef2f6;
        }

        .leave-details-table td {
            color: var(--pp-text-strong);
            font-size: .9rem;
            font-weight: 500;
            padding: 12px 10px;
            border-bottom: 1px solid #eef2f6;
            word-break: break-word;
        }

        .remarks-label {
            display: block;
            color: var(--pp-text-strong);
            font-size: .88rem;
            font-weight: 700;
            margin-bottom: 7px;
        }

        #remarks {
            resize: vertical;
            min-height: 100px;
            border-color: #dce3eb;
            border-radius: 10px;
            font-size: .9rem;
        }

        #remarks:focus {
            border-color: var(--pp-primary);
            box-shadow: 0 0 0 .2rem rgba(67, 94, 190, .12);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 991.98px) {
            .dashboard-content .container-fluid {
                padding-top: 1.25rem !important;
                padding-bottom: 1.25rem !important;
            }

            .page-heading {
                margin-bottom: 1.45rem;
            }

            .leave-panel-header {
                padding: 19px 20px;
            }

            #leaveModal .modal-body {
                padding: 20px;
            }
        }

        @media (max-width: 767.98px) {
            .page-heading {
                padding: 2px 0;
                margin-bottom: 1.25rem;
            }

            .page-heading h1,
            .page-heading .h3 {
                font-size: 1.55rem !important;
            }

            .page-heading p {
                font-size: .92rem;
            }

            .row.g-3.mb-4 {
                --bs-gutter-y: .8rem;
            }

            .leave-metric-card {
                min-height: 118px;
                padding: 18px 19px;
            }

            .leave-metric-value {
                font-size: 1.8rem;
            }

            .leave-panel-header {
                padding: 18px;
            }

            .section-title {
                font-size: 1rem;
            }

            .leave-table thead th,
            .leave-table tbody td {
                padding-left: 12px;
                padding-right: 12px;
            }

            #leaveModal .modal-dialog {
                margin: .5rem;
            }

            #leaveModal .modal-body {
                padding: 18px;
            }

            #employeePhoto {
                width: 110px;
                height: 110px;
            }

            #employeeName {
                font-size: 1.1rem;
            }

            .leave-details-table th {
                width: 120px;
            }

            #leaveModal .modal-footer {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                padding: 14px 18px;
            }

            #leaveModal .modal-footer .btn {
                flex: 1 1 auto;
            }
        }

        @media (max-width: 575.98px) {
            .dashboard-content .container-fluid {
                padding-left: .85rem !important;
                padding-right: .85rem !important;
            }

            .page-heading h1,
            .page-heading .h3 {
                font-size: 1.4rem !important;
            }

            .page-heading p {
                font-size: .88rem;
            }

            .leave-metric-card {
                min-height: 110px;
                padding: 17px 18px;
            }

            .leave-metric-label {
                font-size: .8rem;
            }

            .leave-metric-value {
                font-size: 1.65rem;
            }

            .leave-metric-description {
                font-size: .82rem;
            }

            .leave-requests-panel {
                border-radius: 15px;
            }

            .leave-panel-header {
                padding: 16px;
            }

            .section-title {
                font-size: .95rem;
            }

            .leave-panel-header p {
                font-size: .82rem;
            }

            #leaveModal .modal-dialog {
                margin: .35rem;
            }

            #leaveModal .modal-body {
                padding: 15px;
            }

            #leaveModal .modal-header {
                padding: 15px 16px;
            }

            #leaveModal .modal-footer {
                padding: 12px 15px;
            }

            #leaveModal .modal-footer .btn {
                width: 100%;
                flex: 1 1 100%;
            }

            .leave-details-table th,
            .leave-details-table td {
                display: block;
                width: 100%;
                padding: 8px 5px;
            }

            .leave-details-table th {
                border-bottom: 0;
                padding-bottom: 2px;
            }

            .leave-details-table td {
                padding-top: 2px;
            }
        }

        /* =========================================================
           PRINT
        ========================================================= */

        @media print {
            .admin-sidebar,
            .admin-navbar,
            .admin-footer,
            .sidebar-backdrop,
            .page-heading,
            .row.g-3.mb-4,
            .modal,
            .btn {
                display: none !important;
            }

            .admin-main {
                margin: 0 !important;
                width: 100% !important;
            }

            .leave-requests-panel {
                box-shadow: none;
                border: 1px solid #ddd;
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
                    <img src="../../../khen/assets/images/logo.jpg" alt="Pap Pay Logo" class="brand-logo">
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

                <a class="nav-link" href="{{ route('attendance_list') }}">
                    <span class="nav-icon">
                        <i class="bi bi-calendar-check"></i>
                    </span>
                    <span class="nav-text">Attendance</span>
                </a>

                <a class="nav-link active" href="{{ route('admin.leaves') }}">
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
                    <span class="nav-text">Payslip Concerns</span>
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
                <span class="sidebar-footer-text">System running smoothly</span>
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

                    <div class="navbar-actions ms-auto">


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

                                        <button type="submit" class="dropdown-item">
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

                    <!-- PAGE HEADING -->

                    <div class="page-heading">

                        <div class="page-heading-copy">

                            <div>

                                <h1>
                                    Leave Management
                                </h1>

                                <p>
                                    Manage employee leave requests, approvals and leave records.
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- METRICS -->

                    <div class="row g-3 mb-4">

                        <div class="col-xl-3 col-md-6">

                            <div class="leave-metric-card metric-warning h-100">

                                <span class="leave-metric-label">
                                    Pending Requests
                                </span>

                                <h2 class="leave-metric-value text-warning">
                                    {{ $pending }}
                                </h2>

                                <p class="leave-metric-description">
                                    Awaiting approval
                                </p>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6">

                            <div class="leave-metric-card metric-success h-100">

                                <span class="leave-metric-label">
                                    Approved
                                </span>

                                <h2 class="leave-metric-value text-success">
                                    {{ $approved }}
                                </h2>

                                <p class="leave-metric-description">
                                    Approved leaves
                                </p>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6">

                            <div class="leave-metric-card metric-danger h-100">

                                <span class="leave-metric-label">
                                    Rejected
                                </span>

                                <h2 class="leave-metric-value text-danger">
                                    {{ $rejected }}
                                </h2>

                                <p class="leave-metric-description">
                                    Rejected requests
                                </p>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6">

                            <div class="leave-metric-card metric-primary h-100">

                                <span class="leave-metric-label">
                                    Employees on Leave
                                </span>

                                <h2 class="leave-metric-value text-primary">
                                    {{ $onLeaveToday }}
                                </h2>

                                <p class="leave-metric-description">
                                    Today
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- LEAVE REQUESTS -->

                    <section class="leave-requests-panel">

                        <div class="leave-panel-header">

                            <h2 class="section-title">

                                <i class="bi bi-calendar2-check"></i>

                                Employee Leave Requests

                            </h2>

                            <p class="mb-0">
                                Review, approve or reject employee leave applications.
                            </p>

                        </div>

                        <div class="leave-table-wrapper">

                            <table class="table table-hover align-middle leave-table">

                                <thead>

                                    <tr>

                                        <th>Leave ID</th>
                                        <th>Employee</th>
                                        <th>Department</th>
                                        <th>Leave Type</th>
                                        <th>Leave Period</th>
                                        <th>Days</th>
                                        <th>Status</th>
                                        <th>Filed On</th>
                                        <th class="text-end">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($leaveRequests as $leave)

                                        <tr>

                                            <td>

                                                <strong>
                                                    LV-{{ str_pad($leave->id, 5, '0', STR_PAD_LEFT) }}
                                                </strong>

                                            </td>

                                            <td>

                                                <div class="d-flex align-items-center">

                                                    @if ($leave->user->photo)

                                                        <img src="{{ asset('storage/' . $leave->user->photo) }}"
                                                            class="rounded-circle me-2 employee-avatar"
                                                            alt="{{ $leave->user->name }}">

                                                    @else

                                                        <img src="{{ asset('images/default-avatar.png') }}"
                                                            class="rounded-circle me-2 employee-avatar"
                                                            alt="Default avatar">

                                                    @endif

                                                    <div>

                                                        <strong>
                                                            {{ $leave->user->name }}
                                                        </strong>

                                                        <br>

                                                        <small>
                                                            {{ $leave->user->employee_id }}
                                                        </small>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>
                                                {{ $leave->user->department }}
                                            </td>

                                            <td>
                                                {{ $leave->leave_type }}
                                            </td>

                                            <td>

                                                {{ $leave->start_date->format('M d, Y') }}

                                                <br>

                                                <small>to</small>

                                                <br>

                                                {{ $leave->end_date->format('M d, Y') }}

                                            </td>

                                            <td>
                                                {{ $leave->days }}
                                            </td>

                                            <td>

                                                @if ($leave->status == 'Pending')

                                                    <span class="leave-status-badge leave-status-pending">
                                                        Pending
                                                    </span>

                                                @elseif($leave->status == 'Approved')

                                                    <span class="leave-status-badge leave-status-approved">
                                                        Approved
                                                    </span>

                                                @else

                                                    <span class="leave-status-badge leave-status-rejected">
                                                        Rejected
                                                    </span>

                                                @endif

                                            </td>

                                            <td>
                                                {{ $leave->created_at->format('M d, Y') }}
                                            </td>

                                            <td class="text-end">

                                                <button class="btn btn-primary btn-sm viewLeaveBtn view-leave-btn"
                                                    data-id="{{ $leave->id }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#leaveModal">

                                                    <i class="bi bi-eye"></i>

                                                    View

                                                </button>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="9" class="text-center py-5">

                                                <h5 class="mb-0">
                                                    No leave requests found.
                                                </h5>

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </section>

                </div>

            </main>

            <!-- LEAVE MODAL -->

            <div class="modal fade"
                id="leaveModal"
                tabindex="-1"
                aria-labelledby="leaveModalLabel"
                aria-hidden="true">

                <div class="modal-dialog modal-xl modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="leaveModalLabel">
                                Leave Request Details
                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>

                        </div>

                        <div class="modal-body">

                            <div class="row g-4">

                                <div class="col-md-4 text-center">

                                    <img id="employeePhoto"
                                        src=""
                                        class="rounded-circle mb-3"
                                        alt="Employee Photo">

                                    <h4 id="employeeName"></h4>

                                    <p id="employeeDepartment"></p>

                                    <p id="employeePosition"></p>

                                </div>

                                <div class="col-md-8">

                                    <table class="table leave-details-table">

                                        <tr>

                                            <th>Leave Type</th>

                                            <td id="leaveType"></td>

                                        </tr>

                                        <tr>

                                            <th>Leave Period</th>

                                            <td id="leavePeriod"></td>

                                        </tr>

                                        <tr>

                                            <th>Total Days</th>

                                            <td id="leaveDays"></td>

                                        </tr>

                                        <tr>

                                            <th>Status</th>

                                            <td id="leaveStatus"></td>

                                        </tr>

                                        <tr>

                                            <th>Reason</th>

                                            <td id="leaveReason"></td>

                                        </tr>

                                        <tr>

                                            <th>Attachment</th>

                                            <td id="attachment"></td>

                                        </tr>

                                    </table>

                                    <div class="mt-4">

                                        <label class="remarks-label">
                                            Remarks
                                        </label>

                                        <textarea class="form-control"
                                            id="remarks"
                                            rows="4"></textarea>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button class="btn btn-success" id="approveBtn">
                                Approve
                            </button>

                            <button class="btn btn-danger" id="rejectBtn">
                                Reject
                            </button>

                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">
                </div>

            </footer>

        </div>

    </div>

    <input type="hidden" id="leaveId">

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>

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

<script src="{{ asset('khen/assets/js/admin-search.js') }}"></script>


    <script src="{{ asset('khen/assets/js/leave_request-search.js') }}"></script>
    <script>

    <script>
        /* =========================================================
           VIEW LEAVE REQUEST
        ========================================================= */

        document.querySelectorAll('.viewLeaveBtn').forEach(button => {

            button.addEventListener('click', function() {

                const id = this.dataset.id;

                fetch('/admin/leaves/' + id)

                    .then(response => {

                        if (!response.ok) {
                            throw new Error('Failed to load leave request.');
                        }

                        return response.json();

                    })

                    .then(data => {

                        document.getElementById('employeeName').innerHTML =
                            data.user.name;

                        document.getElementById('leaveId').value =
                            data.id;

                        document.getElementById('employeeDepartment').innerHTML =
                            data.user.department;

                        document.getElementById('employeePosition').innerHTML =
                            data.user.position;

                        document.getElementById('leaveType').innerHTML =
                            data.leave_type;

                        document.getElementById('leavePeriod').innerHTML =
                            data.start_date + " - " + data.end_date;

                        document.getElementById('leaveDays').innerHTML =
                            data.days;

                        document.getElementById('leaveStatus').innerHTML =
                            data.status;

                        document.getElementById('leaveReason').innerHTML =
                            data.reason;

                        document.getElementById('remarks').value =
                            data.remarks ?? '';

                        if (data.user.photo) {

                            document.getElementById('employeePhoto').src =
                                '/storage/' + data.user.photo;

                        } else {

                            document.getElementById('employeePhoto').src =
                                '/images/default-avatar.png';

                        }

                        if (data.attachment) {

                            document.getElementById('attachment').innerHTML =
                                '<a href="/storage/' +
                                data.attachment +
                                '" target="_blank" class="btn btn-outline-primary btn-sm">' +
                                '<i class="bi bi-paperclip me-1"></i>' +
                                'Download Attachment' +
                                '</a>';

                        } else {

                            document.getElementById('attachment').innerHTML =
                                '<span class="text-muted">No attachment uploaded</span>';

                        }

                    })

                    .catch(error => {

                        console.error(error);

                        alert('Unable to load the leave request details.');

                    });

            });

        });


        /* =========================================================
           APPROVE LEAVE
        ========================================================= */

        document.getElementById('approveBtn').addEventListener('click', function() {

            const id = document.getElementById('leaveId').value;

            fetch(`/admin/leaves/${id}/status`, {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'X-CSRF-TOKEN':
                            document.querySelector('meta[name="csrf-token"]').content

                    },

                    body: JSON.stringify({

                        status: 'Approved',

                        remarks:
                            document.getElementById('remarks').value

                    })

                })

                .then(res => res.json())

                .then(response => {

                    if (response.success) {

                        alert(response.message);

                        location.reload();

                    } else {

                        alert(response.message);

                    }

                })

                .catch(error => {

                    console.error(error);

                    alert('Something went wrong while approving the leave request.');

                });

        });


        /* =========================================================
           REJECT LEAVE
        ========================================================= */

        document.getElementById('rejectBtn').addEventListener('click', function() {

            const id = document.getElementById('leaveId').value;

            fetch(`/admin/leaves/${id}/status`, {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'X-CSRF-TOKEN':
                            document.querySelector('meta[name="csrf-token"]').content

                    },

                    body: JSON.stringify({

                        status: 'Rejected',

                        remarks:
                            document.getElementById('remarks').value

                    })

                })

                .then(res => res.json())

                .then(response => {

                    if (response.success) {

                        alert(response.message);

                        location.reload();

                    } else {

                        alert(response.message);

                    }

                })

                .catch(error => {

                    console.error(error);

                    alert('Something went wrong while rejecting the leave request.');

                });

        });
    </script>

</body>

</html>
