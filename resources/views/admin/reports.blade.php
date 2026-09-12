<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reports | Pap Pay</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        /* =========================================================
           PAP PAY TYPOGRAPHY
           Matches the typography used on the Home dashboard
        ========================================================= */

        :root {
            --pp-text-strong: #172033;
            --pp-text-muted: #64748b;
        }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Helvetica, Arial, sans-serif;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* =========================================================
           REPORTS PAGE HEADING
        ========================================================= */

        .reports-page-heading {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 1.8rem;
            padding: 4px 2px;
        }

        .reports-page-heading h1 {
            color: var(--pp-text-strong);
            font-size: clamp(1.55rem, 2.4vw, 2.15rem);
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.2;
            margin: 0 0 5px;
        }

        .reports-page-heading p {
            color: var(--pp-text-muted) !important;
            font-size: clamp(.92rem, 1.1vw, 1.02rem);
            line-height: 1.6;
            max-width: 950px;
            margin: 0;
        }

        /* =========================================================
           SUMMARY / METRIC CARDS
           Same typography style as Home dashboard
        ========================================================= */

        .report-summary-card {
            border-radius: 18px;
            border: 1px solid rgba(0, 0, 0, .04) !important;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .05) !important;
            transition: transform .2s ease, box-shadow .2s ease;
            height: 100%;
        }

        .report-summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, .08) !important;
        }

        .report-summary-card .card-body {
            position: relative;
            min-height: 145px;
            padding: 20px 21px;
        }

        .report-summary-card small {
            display: block;
            color: var(--pp-text-muted);
            font-size: .85rem;
            font-weight: 600;
            line-height: 1.35;
            margin-bottom: 7px;
        }

        .report-summary-card h2 {
            color: var(--pp-text-strong);
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -.025em;
            margin: 0;
        }

        .report-summary-card .summary-icon {
            position: absolute;
            right: 20px;
            bottom: 18px;
            font-size: 2.25rem;
        }

        /* =========================================================
           REPORT OPTION CARDS
        ========================================================= */

        .report-option-card {
            border: 1px solid rgba(0, 0, 0, .04) !important;
            border-radius: 18px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .05) !important;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .report-option-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, .08) !important;
        }

        .report-option-card .card-body {
            padding: 32px 24px;
        }

        .report-option-card .report-icon {
            font-size: 2.75rem;
            line-height: 1;
        }

        .report-option-card h5 {
            color: var(--pp-text-strong);
            font-size: 1.05rem;
            font-weight: 750;
            letter-spacing: -.015em;
            line-height: 1.35;
            margin-top: 18px !important;
            margin-bottom: 7px;
        }

        .report-option-card p {
            color: var(--pp-text-muted) !important;
            font-size: .92rem;
            line-height: 1.55;
            margin-bottom: 0;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        .dashboard-content {
            min-width: 0;
        }

        .dashboard-content > .container-fluid {
            min-width: 0;
        }

        .reports-page-heading > div {
            min-width: 0;
        }

        @media (max-width: 991.98px) {

            .reports-page-heading {
                margin-bottom: 1.5rem;
            }

            .report-summary-card .card-body {
                min-height: 130px;
            }

            .report-summary-card h2 {
                font-size: 1.85rem;
            }

            .report-option-card .card-body {
                padding: 28px 20px;
            }
        }

        @media (max-width: 767.98px) {

            .reports-page-heading {
                margin-bottom: 1.4rem;
                padding: 3px 1px;
            }

            .reports-page-heading h1 {
                font-size: 1.75rem;
            }

            .reports-page-heading p {
                font-size: .94rem;
            }

            .report-summary-card .card-body {
                min-height: 120px;
                padding: 18px;
            }

            .report-summary-card small {
                font-size: .83rem;
            }

            .report-summary-card h2 {
                font-size: 1.8rem;
            }

            .report-summary-card .summary-icon {
                right: 18px;
                bottom: 16px;
                font-size: 2rem;
            }

            .report-option-card .card-body {
                padding: 26px 20px;
            }

            .report-option-card .report-icon {
                font-size: 2.5rem;
            }

            .report-option-card h5 {
                font-size: 1rem;
            }

            .report-option-card p {
                font-size: .9rem;
            }
        }

        @media (max-width: 575.98px) {

            .dashboard-content > .container-fluid {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .reports-page-heading {
                margin-bottom: 1.3rem;
            }

            .reports-page-heading h1 {
                font-size: 1.55rem;
                letter-spacing: -.03em;
            }

            .reports-page-heading p {
                font-size: .92rem;
                line-height: 1.55;
            }

            .report-summary-card .card-body {
                min-height: 112px;
                padding: 17px 18px;
            }

            .report-summary-card small {
                font-size: .82rem;
            }

            .report-summary-card h2 {
                font-size: 1.65rem;
            }

            .report-summary-card .summary-icon {
                right: 16px;
                bottom: 15px;
                font-size: 1.85rem;
            }

            .report-option-card .card-body {
                padding: 24px 18px;
            }

            .report-option-card .report-icon {
                font-size: 2.3rem;
            }

            .report-option-card h5 {
                font-size: .98rem;
                margin-top: 15px !important;
            }

            .report-option-card p {
                font-size: .88rem;
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

                <a class="nav-link active"
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
        ====================================================== -->

        <div class="admin-main">

            <!-- NAVBAR -->

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

                    <!-- PAGE HEADING -->

                    <div class="reports-page-heading">

                        <div>

                            <h1>
                                Reports Dashboard
                            </h1>

                            <p>
                                Generate and download reports from every module of the Payroll Management System.
                            </p>

                        </div>

                    </div>

                    <!-- =================================================
                         SUMMARY CARDS
                    ================================================== -->

                    <div class="row g-4 mb-5">

                        <!-- TOTAL EMPLOYEES -->

                        <div class="col-xl-3 col-md-6">

                            <div class="card report-summary-card">

                                <div class="card-body">

                                    <small>
                                        Total Employees
                                    </small>

                                    <h2>
                                        {{ $employeeCount }}
                                    </h2>

                                    <i class="bi bi-people text-primary summary-icon"></i>

                                </div>

                            </div>

                        </div>

                        <!-- ATTENDANCE -->

                        <div class="col-xl-3 col-md-6">

                            <div class="card report-summary-card">

                                <div class="card-body">

                                    <small>
                                        Attendance Records
                                    </small>

                                    <h2>
                                        {{ $attendanceCount }}
                                    </h2>

                                    <i class="bi bi-calendar-check text-success summary-icon"></i>

                                </div>

                            </div>

                        </div>

                        <!-- LEAVE -->

                        <div class="col-xl-3 col-md-6">

                            <div class="card report-summary-card">

                                <div class="card-body">

                                    <small>
                                        Leave Requests
                                    </small>

                                    <h2>
                                        {{ $leaveCount }}
                                    </h2>

                                    <i class="bi bi-calendar-x text-danger summary-icon"></i>

                                </div>

                            </div>

                        </div>

                        <!-- PAYSLIPS -->

                        <div class="col-xl-3 col-md-6">

                            <div class="card report-summary-card">

                                <div class="card-body">

                                    <small>
                                        Released Payslips
                                    </small>

                                    <h2>
                                        {{ $releasedPayslips }}
                                    </h2>

                                    <i class="bi bi-receipt text-warning summary-icon"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- =================================================
                         REPORT MODULES
                    ================================================== -->

                    <div class="row g-4">

                        <!-- PAYROLL REPORTS -->

                        <div class="col-md-6 col-lg-4">

                            <a href="{{ route('reports.payroll') }}"
                                class="text-decoration-none">

                                <div class="card report-option-card shadow-sm h-100">

                                    <div class="card-body text-center">

                                        <i class="bi bi-cash-stack display-4 text-success report-icon"></i>

                                        <h5>
                                            Payroll Reports
                                        </h5>

                                        <p>
                                            Payroll summaries and payroll periods.
                                        </p>

                                    </div>

                                </div>

                            </a>

                        </div>

                        <!-- ATTENDANCE REPORTS -->

                        <div class="col-md-6 col-lg-4">

                            <a href="{{ route('reports.attendance') }}"
                                class="text-decoration-none">

                                <div class="card report-option-card shadow-sm h-100">

                                    <div class="card-body text-center">

                                        <i class="bi bi-calendar-check display-4 text-primary report-icon"></i>

                                        <h5>
                                            Attendance Reports
                                        </h5>

                                        <p>
                                            Daily attendance records.
                                        </p>

                                    </div>

                                </div>

                            </a>

                        </div>

                        <!-- EMPLOYEE REPORTS -->

                        <div class="col-md-6 col-lg-4">

                            <a href="{{ route('reports.employee') }}"
                                class="text-decoration-none">

                                <div class="card report-option-card shadow-sm h-100">

                                    <div class="card-body text-center">

                                        <i class="bi bi-people display-4 text-info report-icon"></i>

                                        <h5>
                                            Employee Reports
                                        </h5>

                                        <p>
                                            Employee master list.
                                        </p>

                                    </div>

                                </div>

                            </a>

                        </div>

                        <!-- LEAVE REPORTS -->

                        <div class="col-md-6 col-lg-4">

                            <a href="{{ route('reports.leave') }}"
                                class="text-decoration-none">

                                <div class="card report-option-card shadow-sm h-100">

                                    <div class="card-body text-center">

                                        <i class="bi bi-calendar-x display-4 text-danger report-icon"></i>

                                        <h5>
                                            Leave Reports
                                        </h5>

                                        <p>
                                            Leave applications.
                                        </p>

                                    </div>

                                </div>

                            </a>

                        </div>

                        <!-- OFFICIAL BUSINESS -->

                        <div class="col-md-6 col-lg-4">

                            <a href="{{ route('reports.ob') }}"
                                class="text-decoration-none">

                                <div class="card report-option-card shadow-sm h-100">

                                    <div class="card-body text-center">

                                        <i class="bi bi-briefcase display-4 text-secondary report-icon"></i>

                                        <h5>
                                            Official Business
                                        </h5>

                                        <p>
                                            Official Business records.
                                        </p>

                                    </div>

                                </div>

                            </a>

                        </div>

                        <!-- SALARY REPORTS -->

                        <div class="col-md-6 col-lg-4">

                            <a href="{{ route('reports.salary') }}"
                                class="text-decoration-none">

                                <div class="card report-option-card shadow-sm h-100">

                                    <div class="card-body text-center">

                                        <i class="bi bi-wallet2 display-4 text-warning report-icon"></i>

                                        <h5>
                                            Salary Reports
                                        </h5>

                                        <p>
                                            Salary configuration.
                                        </p>

                                    </div>

                                </div>

                            </a>

                        </div>

                        <!-- GOVERNMENT CONTRIBUTIONS -->

                        <div class="col-md-6 col-lg-4">

                            <a href="{{ route('reports.contributions') }}"
                                class="text-decoration-none">

                                <div class="card report-option-card shadow-sm h-100">

                                    <div class="card-body text-center">

                                        <i class="bi bi-bank display-4 text-success report-icon"></i>

                                        <h5>
                                            Government Contributions
                                        </h5>

                                        <p>
                                            SSS, PhilHealth, Pag-IBIG and HMO.
                                        </p>

                                    </div>

                                </div>

                            </a>

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

</body>

</html>
