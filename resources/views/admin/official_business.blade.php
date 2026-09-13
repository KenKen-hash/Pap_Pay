<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="adminHMD professional admin dashboard template">

    <title>Official Business | Pap Pay</title>

    <link rel="stylesheet"
        href="../../../../khen/assets/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet"
        href="../../../../khen/assets/css/style.css">


    <style>
        /* =========================================================
           PAP PAY - OFFICIAL BUSINESS
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


        /* =========================================================
           GLOBAL TYPOGRAPHY
           ========================================================= */

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Helvetica, Arial, sans-serif;

            font-size: 1rem;
            line-height: 1.6;
        }


        /* =========================================================
           PAGE HEADING
           Same typography as Home dashboard
           ========================================================= */

        .ob-page-heading {
            display: flex;
            align-items: flex-start;
            gap: 18px;

            margin-bottom: 1.8rem;
            padding: 4px 2px;
        }


        .ob-page-heading h1 {
            color: var(--pp-text-strong);

            font-size: clamp(1.55rem, 2.4vw, 2.15rem);

            font-weight: 800;

            letter-spacing: -0.035em;

            line-height: 1.2;

            margin: 0 0 5px;
        }


        .ob-page-heading p {
            color: var(--pp-text-muted) !important;

            font-size: clamp(.92rem, 1.1vw, 1.02rem);

            line-height: 1.6;

            max-width: 950px;

            margin: 0;
        }


        /* =========================================================
           METRIC CARDS
           Same overall design as Home dashboard
           ========================================================= */

        .ob-metric-card {
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


        .ob-metric-card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 24px rgba(15, 23, 42, .08);
        }


        .ob-metric-card::before {
            content: "";

            position: absolute;

            left: 0;
            top: 0;
            bottom: 0;

            width: 4px;

            border-radius: 18px 0 0 18px;
        }


        .ob-metric-card.metric-warning::before {
            background: var(--pp-warning);
        }


        .ob-metric-card.metric-success::before {
            background: var(--pp-success);
        }


        .ob-metric-card.metric-danger::before {
            background: var(--pp-danger);
        }


        .ob-metric-card.metric-primary::before {
            background: var(--pp-primary);
        }


        .ob-metric-label {
            display: block;

            font-size: .85rem;

            font-weight: 600;

            color: var(--pp-text-muted);

            line-height: 1.4;

            margin-bottom: 4px;
        }


        .ob-metric-value {
            font-size: 2rem;

            font-weight: 800;

            line-height: 1.2;

            margin: 0;

            letter-spacing: -0.02em;
        }


        .ob-metric-description {
            margin: 5px 0 0;

            font-size: .88rem;

            color: var(--pp-text-muted);

            line-height: 1.45;
        }


        .ob-metric-value.text-warning {
            color: var(--pp-warning) !important;
        }


        .ob-metric-value.text-success {
            color: var(--pp-success) !important;
        }


        .ob-metric-value.text-danger {
            color: var(--pp-danger) !important;
        }


        .ob-metric-value.text-primary {
            color: var(--pp-primary) !important;
        }


        /* =========================================================
           MAIN OFFICIAL BUSINESS PANEL
           ========================================================= */

        .ob-main-panel {
            background: #fff;

            border: 1px solid var(--pp-border);

            border-radius: 18px;

            box-shadow: var(--pp-card-shadow);

            overflow: hidden;
        }


        .ob-panel-body {
            padding: 24px;
        }


        /* =========================================================
           SEARCH / FILTERS
           ========================================================= */

        .ob-filter-form {
            margin-bottom: 1.5rem;
        }


        .ob-filter-form .form-control,
        .ob-filter-form .form-select {
            min-height: 42px;

            border-color: #dce3eb;

            border-radius: 9px;

            font-size: .9rem;
        }


        .ob-filter-form .form-control:focus,
        .ob-filter-form .form-select:focus {
            border-color: var(--pp-primary);

            box-shadow:
                0 0 0 .2rem rgba(67, 94, 190, .12);
        }


        .ob-search-button {
            min-height: 42px;

            border-radius: 9px;

            font-size: .9rem;

            font-weight: 600;
        }


        /* =========================================================
           OB HISTORY BUTTON
           ========================================================= */

        .ob-history-button {
            min-height: 42px;

            border-radius: 9px;

            font-size: .9rem;

            font-weight: 600;
        }


        /* =========================================================
           TABLE
           ========================================================= */

        .ob-table-wrapper {
            width: 100%;

            overflow-x: auto;

            -webkit-overflow-scrolling: touch;
        }


        .ob-table {
            min-width: 700px;

            margin-bottom: 0;
        }


        .ob-table thead th {
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


        .ob-table tbody td {
            color: #334155;

            font-size: .9rem;

            font-weight: 400;

            padding: 14px 15px;

            border-bottom: 1px solid #eef2f6;

            vertical-align: middle;
        }


        .ob-table tbody tr:last-child td {
            border-bottom: 0;
        }


        .ob-table tbody strong {
            color: var(--pp-text-strong);

            font-weight: 700;
        }


        .ob-table tbody small {
            color: var(--pp-text-muted);

            font-size: .78rem;
        }


        /* =========================================================
           PURPOSE DISPLAY
           ========================================================= */

        .ob-purpose-display {
            width: 100%;

            min-height: 100px;

            height: auto;

            padding: 12px 13px;

            text-align: left !important;

            white-space: pre-wrap;

            overflow-wrap: anywhere;

            word-break: break-word;

            display: block;
        }


        /* =========================================================
           STATUS BADGES
           ========================================================= */

        .ob-status-badge {
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


        .ob-status-pending {
            background: rgba(245, 158, 11, .12);

            color: #b77900;
        }


        .ob-status-approved {
            background: rgba(25, 135, 84, .12);

            color: #157347;
        }


        .ob-status-rejected {
            background: rgba(220, 53, 69, .10);

            color: #bb2d3b;
        }


        /* =========================================================
           VIEW BUTTON
           ========================================================= */

        .ob-view-button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            font-weight: 600;

            white-space: nowrap;
        }


        /* =========================================================
           PAGINATION
           ========================================================= */

        .ob-pagination {
            margin-top: 1.25rem;
        }


        .ob-pagination nav {
            display: flex;

            justify-content: center;
        }


        .ob-pagination .pagination {
            margin-bottom: 0;

            flex-wrap: wrap;
        }


        /* =========================================================
           MODAL
           ========================================================= */

        .ob-modal .modal-dialog {
            max-width: 900px;
        }


        .ob-modal .modal-content {
            border: 0;

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, .18);
        }


        .ob-modal .modal-header {
            padding: 18px 22px;

            border-bottom: 1px solid var(--pp-border);

            background: #fff;
        }


        .ob-modal .modal-title {
            color: var(--pp-text-strong);

            font-size: 1.15rem;

            font-weight: 800;

            letter-spacing: -.015em;
        }


        .ob-modal .modal-body {
            padding: 24px;
        }


        .ob-modal .modal-footer {
            padding: 15px 22px;

            border-top: 1px solid var(--pp-border);
        }


        .ob-modal .form-label {
            color: var(--pp-text-strong);

            font-size: .85rem;

            font-weight: 700;

            margin-bottom: 6px;
        }


        .ob-modal .form-control.bg-light {
            color: #334155;

            background: #f8fafc !important;

            border-color: #e3e8ee;

            border-radius: 9px;

            min-height: 42px;

            font-size: .9rem;

            line-height: 1.5;
        }


        .ob-modal .form-control.bg-light[style*="min-height"] {
            min-height: 80px;
        }


        /* =========================================================
           ESTIMATED COST DISPLAY
           ========================================================= */

        .ob-cost-display {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

            min-height: 42px;

            padding: 10px 13px;
        }


        .ob-cost-display .cost-value {
            color: #334155;

            font-weight: 600;

            margin-left: auto;

            text-align: right;
        }


        .ob-total-cost {
            color: var(--pp-primary) !important;

            font-size: 1rem;

            font-weight: 800 !important;
        }


        .ob-proof-image {
            display: block;

            width: 100%;

            max-height: 230px;

            object-fit: cover;

            border: 1px solid #e1e7ee !important;

            border-radius: 10px !important;

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }


        .ob-proof-image:hover {
            transform: translateY(-2px);

            box-shadow:
                0 6px 18px rgba(15, 23, 42, .10);
        }


        /* =========================================================
           HISTORY MODAL
           ========================================================= */

        .ob-history-modal .modal-dialog {
            max-width: 1100px;
        }


        .ob-history-table-wrapper {
            width: 100%;

            overflow-x: auto;

            -webkit-overflow-scrolling: touch;
        }


        .ob-history-table {
            min-width: 900px;

            margin-bottom: 0;
        }


        .ob-history-table thead th {
            background: #f8fafc;

            color: #64748b;

            border-bottom: 1px solid var(--pp-border);

            font-size: .75rem;

            font-weight: 700;

            letter-spacing: .02em;

            text-transform: uppercase;

            white-space: nowrap;

            padding: 12px 13px;
        }


        .ob-history-table tbody td {
            color: #334155;

            font-size: .86rem;

            padding: 12px 13px;

            border-bottom: 1px solid #eef2f6;

            vertical-align: middle;
        }


        .ob-history-table tbody tr:last-child td {
            border-bottom: 0;
        }


        .ob-history-purpose {
            min-width: 220px;

            max-width: 350px;

            text-align: left !important;

            white-space: pre-wrap;

            overflow-wrap: anywhere;

            word-break: break-word;
        }


        /* =========================================================
           RESPONSIVE
           ========================================================= */

        @media (max-width: 991.98px) {

            .dashboard-content .container-fluid {
                padding-top: 1.25rem !important;

                padding-bottom: 1.25rem !important;
            }


            .ob-page-heading {
                margin-bottom: 1.45rem;
            }


            .ob-panel-body {
                padding: 20px;
            }


            .ob-modal .modal-body {
                padding: 20px;
            }

        }


        @media (max-width: 767.98px) {

            .ob-page-heading {
                padding: 2px 0;

                margin-bottom: 1.25rem;
            }


            .ob-page-heading h1 {
                font-size: 1.55rem;
            }


            .ob-page-heading p {
                font-size: .92rem;
            }


            .ob-metric-card {
                min-height: 118px;

                padding: 18px 19px;
            }


            .ob-metric-value {
                font-size: 1.8rem;
            }


            .ob-panel-body {
                padding: 18px;
            }


            .ob-filter-form .row {
                row-gap: 10px;
            }


            .ob-modal .modal-dialog {
                margin: .5rem;
            }


            .ob-modal .modal-body {
                padding: 18px;
            }


            .ob-modal .modal-footer {
                display: flex;

                flex-wrap: wrap;

                gap: 8px;

                padding: 14px 18px;
            }


            .ob-modal .modal-footer form {
                flex: 1 1 auto;
            }


            .ob-modal .modal-footer form .btn,
            .ob-modal .modal-footer > .btn {
                width: 100%;
            }


            .ob-history-modal .modal-dialog {
                margin: .5rem;
            }

        }


        @media (max-width: 575.98px) {

            .dashboard-content .container-fluid {
                padding-left: .85rem !important;

                padding-right: .85rem !important;
            }


            .ob-page-heading h1 {
                font-size: 1.4rem;
            }


            .ob-page-heading p {
                font-size: .88rem;
            }


            .ob-metric-card {
                min-height: 110px;

                padding: 17px 18px;
            }


            .ob-metric-label {
                font-size: .8rem;
            }


            .ob-metric-value {
                font-size: 1.65rem;
            }


            .ob-metric-description {
                font-size: .82rem;
            }


            .ob-main-panel {
                border-radius: 15px;
            }


            .ob-panel-body {
                padding: 15px;
            }


            .ob-table thead th,
            .ob-table tbody td {
                padding-left: 12px;

                padding-right: 12px;
            }


            .ob-modal .modal-dialog {
                margin: .35rem;
            }


            .ob-modal .modal-header {
                padding: 15px 16px;
            }


            .ob-modal .modal-body {
                padding: 15px;
            }


            .ob-modal .modal-footer {
                padding: 12px 15px;
            }


            .ob-modal .modal-footer form {
                flex: 1 1 100%;
            }


            .ob-modal .modal-footer form .btn,
            .ob-modal .modal-footer > .btn {
                width: 100%;
            }


            .ob-history-modal .modal-dialog {
                margin: .35rem;
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
            .ob-page-heading,
            .ob-filter-form,
            .ob-pagination,
            .modal,
            .btn {
                display: none !important;
            }


            .admin-main {
                margin: 0 !important;

                width: 100% !important;
            }


            .ob-main-panel {
                box-shadow: none;

                border: 1px solid #ddd;
            }

        }
    </style>

</head>


<body>

    <div class="admin-shell">

        <div class="sidebar-backdrop"
            data-sidebar-close>
        </div>


        <!-- =====================================================
             SIDEBAR
             ===================================================== -->

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


                <a class="nav-link active"
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


        <!-- =====================================================
             MAIN
             ===================================================== -->

        <div class="admin-main">


            <!-- =================================================
                 NAVBAR
                 ================================================= -->

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


            <!-- =================================================
                 MAIN CONTENT
                 ================================================= -->

            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4 py-4">


                    <!-- PAGE HEADING -->

                    <div class="ob-page-heading">

                        <div>

                            <h1>
                                Official Business Management
                            </h1>

                            <p>
                                Manage employee official business requests, approvals and records.
                            </p>

                        </div>

                    </div>


                    <!-- =================================================
                         SUMMARY METRICS
                         ================================================= -->

                    <div class="row g-3 mb-4">


                        <!-- PENDING -->

                        <div class="col-xl-3 col-md-6">

                            <div class="ob-metric-card metric-warning h-100">

                                <span class="ob-metric-label">
                                    Pending
                                </span>

                                <h2 class="ob-metric-value text-warning">
                                    {{ $pendingOB }}
                                </h2>

                                <p class="ob-metric-description">
                                    Awaiting approval
                                </p>

                            </div>

                        </div>


                        <!-- APPROVED -->

                        <div class="col-xl-3 col-md-6">

                            <div class="ob-metric-card metric-success h-100">

                                <span class="ob-metric-label">
                                    Approved
                                </span>

                                <h2 class="ob-metric-value text-success">
                                    {{ $approvedOB }}
                                </h2>

                                <p class="ob-metric-description">
                                    Approved requests
                                </p>

                            </div>

                        </div>


                        <!-- REJECTED -->

                        <div class="col-xl-3 col-md-6">

                            <div class="ob-metric-card metric-danger h-100">

                                <span class="ob-metric-label">
                                    Rejected
                                </span>

                                <h2 class="ob-metric-value text-danger">
                                    {{ $rejectedOB }}
                                </h2>

                                <p class="ob-metric-description">
                                    Rejected requests
                                </p>

                            </div>

                        </div>


                        <!-- TOTAL -->

                        <div class="col-xl-3 col-md-6">

                            <div class="ob-metric-card metric-primary h-100">

                                <span class="ob-metric-label">
                                    Total
                                </span>

                                <h2 class="ob-metric-value text-primary">
                                    {{ $totalOB }}
                                </h2>

                                <p class="ob-metric-description">
                                    All official business requests
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         OFFICIAL BUSINESS PANEL
                         ================================================= -->

                    <div class="ob-main-panel">


                        <div class="ob-panel-body">


                            <!-- SEARCH / FILTER -->

                            <form method="GET"
                                class="ob-filter-form">

                                <div class="row g-2">


                                    <div class="col-lg-4 col-md-6">

                                        <input type="text"
                                            name="search"
                                            class="form-control"
                                            placeholder="Search employee or employee ID..."
                                            value="{{ request('search') }}">

                                    </div>


                                    <div class="col-lg-2 col-md-6">

                                        <select name="status"
                                            class="form-select">

                                            <option value="">
                                                All Status
                                            </option>


                                            <option value="Pending"
                                                {{ request('status') == 'Pending' ? 'selected' : '' }}>

                                                Pending

                                            </option>


                                            <option value="Approved"
                                                {{ request('status') == 'Approved' ? 'selected' : '' }}>

                                                Approved

                                            </option>


                                            <option value="Rejected"
                                                {{ request('status') == 'Rejected' ? 'selected' : '' }}>

                                                Rejected

                                            </option>

                                        </select>

                                    </div>


                                    <div class="col-lg-2 col-md-6">

                                        <input type="date"
                                            name="date"
                                            class="form-control"
                                            value="{{ request('date') }}">

                                    </div>


                                    <div class="col-lg-2 col-md-6">

                                        <button class="btn btn-primary w-100 ob-search-button"
                                            type="submit">

                                            <i class="bi bi-search me-1"></i>

                                            Search

                                        </button>

                                    </div>


                                    <!-- OB HISTORY -->

                                    <div class="col-lg-2 col-md-6">

                                        <button type="button"
                                            class="btn btn-outline-primary w-100 ob-history-button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#obHistoryModal">

                                            <i class="bi bi-clock-history me-1"></i>

                                            OB History

                                        </button>

                                    </div>

                                </div>

                            </form>


                            <!-- TABLE -->

                            <div class="ob-table-wrapper">

                                <table class="table table-hover align-middle ob-table">

                                    <thead>

                                        <tr>

                                            <th>
                                                Employee
                                            </th>

                                            <th>
                                                Date
                                            </th>

                                            <th>
                                                Purpose
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                            <th>
                                                Action
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @forelse($officialBusinesses as $ob)

                                            <tr>

                                                <td>

                                                    <strong>
                                                        {{ $ob->user->name }}
                                                    </strong>

                                                    <br>

                                                    <small>

                                                        {{ $ob->user->employee_id }}

                                                    </small>

                                                </td>


                                                <td>

                                                    {{ $ob->ob_date->format('M d, Y') }}

                                                    @if($ob->ob_date_to && $ob->ob_date_to->format('Y-m-d') !== $ob->ob_date->format('Y-m-d'))

                                                        <br>

                                                        <small>
                                                            to {{ $ob->ob_date_to->format('M d, Y') }}
                                                        </small>

                                                    @endif

                                                </td>


                                                <td style="max-width: 350px;">

                                                    <div style="
                                                        text-align: left;
                                                        white-space: pre-wrap;
                                                        overflow-wrap: anywhere;
                                                        word-break: break-word;
                                                    ">

                                                        {{ $ob->purpose }}

                                                    </div>

                                                </td>


                                                <td>

                                                    @if ($ob->status == 'Pending')

                                                        <span class="ob-status-badge ob-status-pending">
                                                            Pending
                                                        </span>

                                                    @elseif($ob->status == 'Approved')

                                                        <span class="ob-status-badge ob-status-approved">
                                                            Approved
                                                        </span>

                                                    @else

                                                        <span class="ob-status-badge ob-status-rejected">
                                                            Rejected
                                                        </span>

                                                    @endif

                                                </td>


                                                <td>

                                                    <button class="btn btn-sm btn-outline-primary ob-view-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#obModal{{ $ob->id }}">

                                                        <i class="bi bi-eye"></i>

                                                        View

                                                    </button>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="5"
                                                    class="text-center py-5">

                                                    <h5 class="mb-0">
                                                        No Official Business Requests
                                                    </h5>

                                                </td>

                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>


                            <!-- PAGINATION -->

                            <div class="ob-pagination">

                                {{ $officialBusinesses->links() }}

                            </div>


                        </div>

                    </div>

                </div>

            </main>


            <!-- =====================================================
                 OB HISTORY MODAL
                 ===================================================== -->

            <div class="modal fade ob-modal ob-history-modal"
                id="obHistoryModal"
                tabindex="-1"
                aria-labelledby="obHistoryModalLabel"
                aria-hidden="true">

                <div class="modal-dialog modal-xl modal-dialog-scrollable">

                    <div class="modal-content">


                        <!-- HISTORY HEADER -->

                        <div class="modal-header">

                            <div>

                                <h5 class="modal-title"
                                    id="obHistoryModalLabel">

                                    <i class="bi bi-clock-history me-2"></i>

                                    Official Business Filing History

                                </h5>

                                <small class="text-muted">

                                    Complete record of all employee Official Business filings

                                </small>

                            </div>


                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close">

                            </button>

                        </div>


                        <!-- HISTORY BODY -->

                        <div class="modal-body">

                            @php
                                $obHistory = \App\Models\OfficialBusiness::with('user')
                                    ->latest()
                                    ->get();
                            @endphp


                            <div class="ob-history-table-wrapper">

                                <table class="table table-hover align-middle ob-history-table">

                                    <thead>

                                        <tr>

                                            <th>
                                                #
                                            </th>

                                            <th>
                                                Employee
                                            </th>

                                            <th>
                                                Employee ID
                                            </th>

                                            <th>
                                                Date From
                                            </th>

                                            <th>
                                                Date To
                                            </th>

                                            <th>
                                                Purpose
                                            </th>

                                            <th>
                                                Total Cost
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                            <th>
                                                Filed On
                                            </th>

                                            <th>
                                                Action
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @forelse($obHistory as $history)

                                            <tr>

                                                <td>

                                                    {{ $loop->iteration }}

                                                </td>


                                                <td>

                                                    <strong>
                                                        {{ $history->user->name ?? 'Unknown Employee' }}
                                                    </strong>

                                                </td>


                                                <td>

                                                    {{ $history->user->employee_id ?? 'N/A' }}

                                                </td>


                                                <td>

                                                    {{ $history->ob_date
                                                        ? \Carbon\Carbon::parse($history->ob_date)->format('M d, Y')
                                                        : 'Not specified' }}

                                                </td>


                                                <td>

                                                    {{ $history->ob_date_to
                                                        ? \Carbon\Carbon::parse($history->ob_date_to)->format('M d, Y')
                                                        : ($history->ob_date
                                                            ? \Carbon\Carbon::parse($history->ob_date)->format('M d, Y')
                                                            : 'Not specified') }}

                                                </td>


                                                <td>

                                                    <div class="ob-history-purpose">

                                                        {{ $history->purpose }}

                                                    </div>

                                                </td>


                                                <td>

                                                    ₱{{ number_format(
                                                        (float) ($history->transportation_cost ?? 0)
                                                        + (float) ($history->meals_cost ?? 0)
                                                        + (float) ($history->lodging_cost ?? 0)
                                                        + (float) ($history->others_cost ?? 0)
                                                        + (float) ($history->registration_fee ?? 0),
                                                        2
                                                    ) }}

                                                </td>


                                                <td>

                                                    @if($history->status === 'Pending')

                                                        <span class="ob-status-badge ob-status-pending">
                                                            Pending
                                                        </span>

                                                    @elseif($history->status === 'Approved')

                                                        <span class="ob-status-badge ob-status-approved">
                                                            Approved
                                                        </span>

                                                    @else

                                                        <span class="ob-status-badge ob-status-rejected">
                                                            Rejected
                                                        </span>

                                                    @endif

                                                </td>


                                                <td>

                                                    {{ $history->created_at
                                                        ? $history->created_at->format('M d, Y h:i A')
                                                        : 'N/A' }}

                                                </td>


                                                <td>

                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-primary ob-view-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#obModal{{ $history->id }}">

                                                        <i class="bi bi-eye"></i>

                                                        View

                                                    </button>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="10"
                                                    class="text-center py-5">

                                                    <i class="bi bi-clock-history fs-1 text-muted"></i>

                                                    <h5 class="mt-3 mb-1">

                                                        No OB Filing History

                                                    </h5>

                                                    <p class="text-muted mb-0">

                                                        No Official Business records have been filed yet.

                                                    </p>

                                                </td>

                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>


                        <!-- HISTORY FOOTER -->

                        <div class="modal-footer">

                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                                Close

                            </button>

                        </div>


                    </div>

                </div>

            </div>


            <!-- =====================================================
                 VIEW MODALS
                 ===================================================== -->

            @foreach($officialBusinesses as $ob)

                <div class="modal fade ob-modal"
                    id="obModal{{ $ob->id }}"
                    tabindex="-1"
                    aria-labelledby="obModalLabel{{ $ob->id }}"
                    aria-hidden="true">

                    <div class="modal-dialog modal-lg modal-dialog-scrollable">

                        <div class="modal-content">


                            <!-- MODAL HEADER -->

                            <div class="modal-header">

                                <h5 class="modal-title"
                                    id="obModalLabel{{ $ob->id }}">

                                    Official Business Details

                                </h5>


                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">

                                </button>

                            </div>


                            <!-- MODAL BODY -->

                            <div class="modal-body">

                                <div class="row g-3">


                                    <!-- EMPLOYEE -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Employee
                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->user->name }}

                                        </div>

                                    </div>


                                    <!-- EMPLOYEE ID -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Employee ID
                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->user->employee_id }}

                                        </div>

                                    </div>


                                    <!-- DEPARTMENT -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Department
                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->user->department ?? 'Not specified' }}

                                        </div>

                                    </div>


                                    <!-- STATUS -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Status
                                        </label>

                                        <div class="form-control bg-light">

                                            @if($ob->status === 'Pending')

                                                <span class="ob-status-badge ob-status-pending">
                                                    Pending
                                                </span>

                                            @elseif($ob->status === 'Approved')

                                                <span class="ob-status-badge ob-status-approved">
                                                    Approved
                                                </span>

                                            @else

                                                <span class="ob-status-badge ob-status-rejected">
                                                    Rejected
                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    <!-- PURPOSE -->

                                    <div class="col-12">

                                        <label class="form-label">
                                            Purpose
                                        </label>

                                        <div class="form-control bg-light ob-purpose-display">

                                            {{ $ob->purpose }}

                                        </div>

                                    </div>


                                    <!-- DATE FROM -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Date From
                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->ob_date
                                                ? \Carbon\Carbon::parse($ob->ob_date)->format('F d, Y')
                                                : 'Not specified' }}

                                        </div>

                                    </div>


                                    <!-- DATE TO -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Date To
                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->ob_date_to
                                                ? \Carbon\Carbon::parse($ob->ob_date_to)->format('F d, Y')
                                                : ($ob->ob_date
                                                    ? \Carbon\Carbon::parse($ob->ob_date)->format('F d, Y')
                                                    : 'Not specified') }}

                                        </div>

                                    </div>


                                    <!-- TRANSPORTATION COST -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Transportation Cost
                                        </label>

                                        <div class="form-control bg-light ob-cost-display">

                                            <span>
                                                Transportation
                                            </span>

                                            <span class="cost-value">

                                                ₱{{ number_format((float) ($ob->transportation_cost ?? 0), 2) }}

                                            </span>

                                        </div>

                                    </div>


                                    <!-- MEALS COST -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Meals Cost
                                        </label>

                                        <div class="form-control bg-light ob-cost-display">

                                            <span>
                                                Meals
                                            </span>

                                            <span class="cost-value">

                                                ₱{{ number_format((float) ($ob->meals_cost ?? 0), 2) }}

                                            </span>

                                        </div>

                                    </div>


                                    <!-- LODGING COST -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Lodging Cost
                                        </label>

                                        <div class="form-control bg-light ob-cost-display">

                                            <span>
                                                Lodging
                                            </span>

                                            <span class="cost-value">

                                                ₱{{ number_format((float) ($ob->lodging_cost ?? 0), 2) }}

                                            </span>

                                        </div>

                                    </div>


                                    <!-- OTHERS COST -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Others Cost
                                        </label>

                                        <div class="form-control bg-light ob-cost-display">

                                            <span>
                                                Others
                                            </span>

                                            <span class="cost-value">

                                                ₱{{ number_format((float) ($ob->others_cost ?? 0), 2) }}

                                            </span>

                                        </div>

                                    </div>


                                    <!-- REGISTRATION FEE -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Registration Fee
                                        </label>

                                        <div class="form-control bg-light ob-cost-display">

                                            <span>
                                                Registration
                                            </span>

                                            <span class="cost-value">

                                                ₱{{ number_format((float) ($ob->registration_fee ?? 0), 2) }}

                                            </span>

                                        </div>

                                    </div>


                                    <!-- TOTAL ESTIMATED COST -->

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Total Estimated Cost
                                        </label>

                                        <div class="form-control bg-light ob-cost-display">

                                            <span>
                                                Total
                                            </span>

                                            <span class="cost-value ob-total-cost">

                                                ₱{{ number_format(
                                                    (float) ($ob->transportation_cost ?? 0)
                                                    + (float) ($ob->meals_cost ?? 0)
                                                    + (float) ($ob->lodging_cost ?? 0)
                                                    + (float) ($ob->others_cost ?? 0)
                                                    + (float) ($ob->registration_fee ?? 0),
                                                    2
                                                ) }}

                                            </span>

                                        </div>

                                    </div>


                                    <!-- PROOF IMAGES -->

                                    <div class="col-12">

                                        <label class="form-label">
                                            Attachment / Proof Images
                                        </label>


                                        @if($ob->proof_images)

                                            <div class="row g-3 mt-1">

                                                @foreach($ob->proof_images as $image)

                                                    <div class="col-6 col-md-4">

                                                        <a href="{{ asset('storage/' . $image) }}"
                                                            target="_blank">

                                                            <img src="{{ asset('storage/' . $image) }}"
                                                                class="img-fluid ob-proof-image"
                                                                alt="OB Proof Image">

                                                        </a>

                                                    </div>

                                                @endforeach

                                            </div>

                                        @else

                                            <div class="form-control bg-light">

                                                No proof uploaded.

                                            </div>

                                        @endif

                                    </div>


                                </div>

                            </div>


                            <!-- MODAL FOOTER -->

                            <div class="modal-footer">


                                @if($ob->status == 'Pending')


                                    <!-- APPROVE -->

                                    <form action="{{ route('official_business.approve', $ob->id) }}"
                                        method="POST">

                                        @csrf

                                        <button type="submit"
                                            class="btn btn-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Approve

                                        </button>

                                    </form>


                                    <!-- REJECT -->

                                    <form action="{{ route('official_business.reject', $ob->id) }}"
                                        method="POST">

                                        @csrf

                                        <button type="submit"
                                            class="btn btn-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Reject

                                        </button>

                                    </form>


                                @else

                                    <span class="badge bg-secondary fs-6">

                                        {{ $ob->status }}

                                    </span>

                                @endif


                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">

                                    Close

                                </button>

                            </div>


                        </div>

                    </div>

                </div>

            @endforeach


            <!-- =================================================
                 FOOTER
                 ================================================= -->

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">

                </div>

            </footer>

        </div>

    </div>


    <!-- =========================================================
         JAVASCRIPT
         ========================================================= -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

    <script src="../../../../khen/assets/js/main.js"></script>

</body>

</html>
