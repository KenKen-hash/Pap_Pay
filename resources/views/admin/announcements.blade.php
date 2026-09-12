<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Announcement | Pap Pay</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        /* =========================================================
           PAP PAY PAGE FOUNDATION
        ========================================================= */

        :root {
            --pp-text-strong: #172033;
            --pp-text-muted: #64748b;
            --pp-border: #e8edf3;
            --pp-card-shadow: 0 5px 18px rgba(15, 23, 42, 0.05);

            --pp-primary: #435ebe;
            --pp-success: #198754;
            --pp-info: #0dcaf0;
            --pp-warning: #f59e0b;
            --pp-danger: #dc3545;
        }

        html,
        body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Helvetica, Arial, sans-serif;
            font-size: 1rem;
            line-height: 1.6;
        }

        .admin-shell {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        .admin-main {
            min-width: 0;
            max-width: 100%;
        }

        .dashboard-content {
            min-width: 0;
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        .dashboard-content > .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }


        /* =========================================================
           PAGE HEADING
           SAME TYPOGRAPHY AS HOME
        ========================================================= */

        .announcement-page-heading {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 1.8rem;
            padding: 4px 2px;
            min-width: 0;
        }

        .announcement-page-heading h1 {
            color: var(--pp-text-strong);
            font-size: clamp(1.55rem, 2.4vw, 2.15rem);
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.2;
            margin: 0 0 5px;
        }

        .announcement-page-heading p {
            color: var(--pp-text-muted) !important;
            font-size: clamp(0.92rem, 1.1vw, 1.02rem);
            line-height: 1.6;
            max-width: 950px;
            margin: 0;
        }


        /* =========================================================
           METRIC CARDS
           SAME OVERALL DESIGN AS THE FIRST DASHBOARD CARDS
        ========================================================= */

        .announcement-metrics {
            margin-bottom: 1.8rem;
        }

        .announcement-metric-card {
            width: 100%;
            min-height: 128px;
            padding: 20px 21px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.04);
            border-radius: 18px;
            box-shadow: var(--pp-card-shadow);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .announcement-metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .announcement-metric-card .metric-label {
            display: block;
            color: var(--pp-text-muted);
            font-size: 0.85rem;
            font-weight: 600;
            line-height: 1.35;
            margin-bottom: 0;
        }

        .announcement-metric-card .metric-value {
            display: block;
            color: var(--pp-text-strong);
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-top: 7px;
            letter-spacing: -0.025em;
        }

        .announcement-metric-card .metric-subvalue {
            display: block;
            color: var(--pp-text-muted);
            font-size: 0.92rem;
            font-weight: 600;
            line-height: 1.35;
            margin-top: 10px;
        }

        .announcement-metric-card.metric-primary {
            border-left: 4px solid var(--pp-primary);
        }

        .announcement-metric-card.metric-success {
            border-left: 4px solid var(--pp-success);
        }

        .announcement-metric-card.metric-info {
            border-left: 4px solid var(--pp-info);
        }

        .announcement-metric-card.metric-warning {
            border-left: 4px solid var(--pp-warning);
        }


        /* =========================================================
           MAIN CONTENT CARDS
        ========================================================= */

        .announcement-content-card {
            width: 100%;
            min-width: 0;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.04);
            border-radius: 18px;
            box-shadow: var(--pp-card-shadow);
            overflow: hidden;
        }

        .announcement-content-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--pp-border);
            padding: 20px 22px;
        }

        .announcement-content-card .card-header h5 {
            color: var(--pp-text-strong);
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1.35;
            margin: 0;
        }

        .announcement-content-card .card-body {
            padding: 22px;
            min-width: 0;
        }


        /* =========================================================
           FORM
        ========================================================= */

        .announcement-form .form-label {
            color: var(--pp-text-strong);
            font-size: 0.86rem;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .announcement-form .form-control {
            min-height: 44px;
            border-color: #dfe5ec;
            border-radius: 10px;
            font-size: 0.94rem;
            box-shadow: none;
        }

        .announcement-form textarea.form-control {
            min-height: 145px;
            resize: vertical;
        }

        .announcement-form .form-control:focus {
            border-color: var(--pp-primary);
            box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.10);
        }

        .announcement-form .btn-primary {
            min-height: 45px;
            border-radius: 10px;
            font-weight: 600;
        }


        /* =========================================================
           ANNOUNCEMENT LIST
        ========================================================= */

        .announcement-item {
            width: 100%;
            min-width: 0;
            background: #ffffff;
            border: 1px solid var(--pp-border) !important;
            border-radius: 15px !important;
            padding: 18px !important;
            margin-bottom: 14px !important;
            overflow: hidden;
        }

        .announcement-item:last-child {
            margin-bottom: 0 !important;
        }

        .announcement-item-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            min-width: 0;
        }

        .announcement-item-title {
            min-width: 0;
            flex: 1 1 auto;
        }

        .announcement-item-title h5 {
            color: var(--pp-text-strong);
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.4;
            margin: 0 0 4px;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-item-title h5 i {
            margin-right: 5px;
        }

        .announcement-item-date {
            color: var(--pp-text-muted);
            font-size: 0.8rem;
            line-height: 1.45;
        }

        .announcement-status {
            flex: 0 0 auto;
            white-space: nowrap;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 999px;
            padding: 6px 10px;
        }

        .announcement-item hr {
            border-color: var(--pp-border);
            opacity: 1;
            margin: 15px 0;
        }

        .announcement-item-message {
            color: #475569;
            font-size: 0.94rem;
            line-height: 1.65;
            margin-bottom: 15px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-item .btn {
            border-radius: 9px;
            font-size: 0.82rem;
            font-weight: 600;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .announcement-empty {
            padding: 45px 20px !important;
        }

        .announcement-empty i {
            opacity: 0.75;
        }

        .announcement-empty h5 {
            color: var(--pp-text-strong);
            font-weight: 700;
        }

        .announcement-empty p {
            color: var(--pp-text-muted);
            margin-bottom: 0;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .new-announcement-btn {
            flex: 0 0 auto;
            border-radius: 10px;
            font-weight: 600;
            white-space: nowrap;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1199.98px) {

            .announcement-content-card .card-header {
                padding: 18px 20px;
            }

            .announcement-content-card .card-body {
                padding: 20px;
            }

        }


        @media (max-width: 991.98px) {

            .announcement-page-heading {
                margin-bottom: 1.5rem;
            }

            .announcement-metric-card {
                min-height: 118px;
                padding: 18px 19px;
            }

            .announcement-metric-card .metric-value {
                font-size: 1.85rem;
            }

            .announcement-content-card .card-header {
                padding: 18px;
            }

            .announcement-content-card .card-body {
                padding: 18px;
            }

        }


        @media (max-width: 767.98px) {

            .announcement-page-heading {
                display: block;
                margin-bottom: 1.4rem;
                padding: 3px 1px;
            }

            .announcement-page-heading h1 {
                font-size: 1.65rem;
            }

            .announcement-page-heading p {
                font-size: 0.93rem;
                max-width: 100%;
            }

            .new-announcement-btn {
                margin-top: 15px;
            }

            .announcement-metric-card {
                min-height: 110px;
                padding: 18px;
            }

            .announcement-metric-card .metric-label {
                font-size: 0.83rem;
            }

            .announcement-metric-card .metric-value {
                font-size: 1.8rem;
            }

            .announcement-item-header {
                gap: 10px;
            }

        }


        @media (max-width: 575.98px) {

            .dashboard-content > .container-fluid {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .announcement-page-heading h1 {
                font-size: 1.55rem;
                letter-spacing: -0.03em;
            }

            .announcement-page-heading p {
                font-size: 0.92rem;
            }

            .announcement-metric-card {
                min-height: 105px;
                padding: 17px;
                border-radius: 16px;
            }

            .announcement-metric-card .metric-label {
                font-size: 0.81rem;
            }

            .announcement-metric-card .metric-value {
                font-size: 1.65rem;
            }

            .announcement-metric-card .metric-subvalue {
                font-size: 0.84rem;
            }

            .announcement-content-card {
                border-radius: 16px;
            }

            .announcement-content-card .card-header {
                padding: 16px;
            }

            .announcement-content-card .card-body {
                padding: 16px;
            }

            .announcement-content-card .card-header h5 {
                font-size: 0.98rem;
            }

            .announcement-item {
                padding: 15px !important;
                border-radius: 13px !important;
            }

            .announcement-item-header {
                display: block;
            }

            .announcement-status {
                display: inline-block;
                margin-top: 10px;
            }

            .announcement-item-title h5 {
                font-size: 0.95rem;
            }

            .announcement-item-date {
                font-size: 0.77rem;
            }

            .announcement-item-message {
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .new-announcement-btn {
                width: 100%;
                margin-top: 14px;
            }

        }


        /* =========================================================
           PREVENT BOOTSTRAP ROWS FROM CREATING OVERFLOW
        ========================================================= */

        .dashboard-content .row {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .dashboard-content [class*="col-"] {
            min-width: 0;
        }

        .dashboard-content .card {
            min-width: 0;
            max-width: 100%;
        }

        img {
            max-width: 100%;
        }

        button,
        input,
        textarea,
        select {
            max-width: 100%;
        }

        /* Prevent long announcement text from creating horizontal scrolling */
        .announcement-item,
        .announcement-item *,
        .announcement-content-card,
        .announcement-content-card * {
            max-width: 100%;
        }

    </style>
</head>

<body>

    <div class="admin-shell">

        <div class="sidebar-backdrop" data-sidebar-close></div>

        <!-- =====================================================
             SIDEBAR
        ====================================================== -->

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">

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


                <a class="nav-link active"
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
                 PAGE CONTENT
            ================================================== -->

            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4 py-4">


                    <!-- =================================================
                         PAGE HEADING
                    ================================================== -->

                    <div class="announcement-page-heading">

                        <div>

                            <h1>
                                Announcements
                            </h1>

                            <p>
                                Create announcements and notify every employee in real time.
                            </p>

                        </div>


                      

                    </div>


                    <!-- =================================================
                         METRIC CARDS
                    ================================================== -->

                    <div class="row g-3 announcement-metrics">


                        <!-- TOTAL -->

                        <div class="col-xl-3 col-md-6">

                            <div class="announcement-metric-card metric-primary">

                                <span class="metric-label">
                                    Total Announcements
                                </span>

                                <span class="metric-value">
                                    {{ $announcements->count() }}
                                </span>

                            </div>

                        </div>


                        <!-- ATTACHMENTS -->

                        <div class="col-xl-3 col-md-6">

                            <div class="announcement-metric-card metric-success">

                                <span class="metric-label">
                                    Attachments
                                </span>

                                <span class="metric-value">
                                    {{ $announcements->whereNotNull('attachment')->count() }}
                                </span>

                            </div>

                        </div>


                        <!-- LATEST -->

                        <div class="col-xl-3 col-md-6">

                            <div class="announcement-metric-card metric-info">

                                <span class="metric-label">
                                    Latest Post
                                </span>

                                <span class="metric-subvalue">

                                    @if ($announcements->count())

                                        {{ $announcements->first()->created_at->diffForHumans() }}

                                    @else

                                        --

                                    @endif

                                </span>

                            </div>

                        </div>


                        <!-- THIS MONTH -->

                        <div class="col-xl-3 col-md-6">

                            <div class="announcement-metric-card metric-warning">

                                <span class="metric-label">
                                    This Month
                                </span>

                                <span class="metric-value">

                                    {{ $announcements->where('created_at', '>=', now()->startOfMonth())->count() }}

                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         MAIN ANNOUNCEMENT AREA
                    ================================================== -->

                    <div class="row g-4">


                        <!-- =================================================
                             CREATE ANNOUNCEMENT
                        ================================================== -->

                        <div class="col-xl-5">

                            <div class="announcement-content-card">

                                <div class="card-header">

                                    <h5>

                                        <i class="bi bi-pencil-square text-primary me-1"></i>

                                        Create Announcement

                                    </h5>

                                </div>


                                <div class="card-body">

                                    <form method="POST"
                                        action="{{ route('announcements.store') }}"
                                        enctype="multipart/form-data"
                                        class="announcement-form">

                                        @csrf


                                        <!-- TITLE -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Title
                                            </label>

                                            <input type="text"
                                                class="form-control"
                                                name="title"
                                                required>

                                        </div>


                                        <!-- MESSAGE -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Announcement
                                            </label>

                                            <textarea rows="6"
                                                class="form-control"
                                                name="message"
                                                required></textarea>

                                        </div>


                                        <!-- ATTACHMENT -->

                                        <div class="mb-4">

                                            <label class="form-label">
                                                Attachment
                                            </label>

                                            <input type="file"
                                                class="form-control"
                                                name="attachment">

                                        </div>


                                        <!-- SUBMIT -->

                                        <button type="submit"
                                            class="btn btn-primary w-100">

                                            <i class="bi bi-send-fill me-1"></i>

                                            Publish Announcement

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>


                        <!-- =================================================
                             ANNOUNCEMENT LIST
                        ================================================== -->

                        <div class="col-xl-7">

                            <div class="announcement-content-card">

                                <div class="card-header">

                                    <h5>
                                        Recent Announcements
                                    </h5>

                                </div>


                                <div class="card-body">


                                    @forelse($announcements as $announcement)

                                        <div class="announcement-item">


                                            <div class="announcement-item-header">


                                                <div class="announcement-item-title">

                                                    <h5>

                                                        <i class="bi bi-megaphone-fill text-primary"></i>

                                                        {{ $announcement->title }}

                                                    </h5>


                                                    <div class="announcement-item-date">

                                                        {{ $announcement->created_at->format('F d, Y • h:i A') }}

                                                    </div>

                                                </div>


                                                <span class="badge bg-primary announcement-status">

                                                    Posted

                                                </span>

                                            </div>


                                            <hr>


                                            <p class="announcement-item-message">

                                                {{ $announcement->message }}

                                            </p>


                                            @if ($announcement->attachment)

                                                <a href="{{ asset('storage/' . $announcement->attachment) }}"
                                                    target="_blank"
                                                    class="btn btn-outline-primary btn-sm">

                                                    <i class="bi bi-paperclip me-1"></i>

                                                    View Attachment

                                                </a>

                                            @endif


                                        </div>


                                    @empty

                                        <div class="text-center announcement-empty">

                                            <i class="bi bi-megaphone display-3 text-secondary"></i>

                                            <h5 class="mt-3">
                                                No Announcements Yet
                                            </h5>

                                            <p>
                                                Publish your first announcement.
                                            </p>

                                        </div>

                                    @endforelse


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </main>


            <!-- =================================================
                 FOOTER
            ================================================== -->

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">

                </div>

            </footer>

        </div>

    </div>


    <!-- =========================================================
         SCRIPTS
    ========================================================= -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>

</body>

</html>
