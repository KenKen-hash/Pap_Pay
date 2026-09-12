<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Pap Pay Employee Management">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Employee Management | Pap Pay</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>

        /* =========================================================
           GENERAL
        ========================================================= */

        body {
            background: #f5f7fb;
        }

        .dashboard-content {
            min-height: calc(100vh - 70px);
        }


        /* =========================================================
           NOTIFICATIONS
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
            font-size: .85rem;
            color: #64748b;
            margin-top: 3px;
        }

        .notification-time {
            display: block;
            font-size: .75rem;
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
           PAGE HEADER
           Matches Home dashboard typography and spacing
        ========================================================= */

        .employee-page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 1.8rem;
            padding: 4px 2px;
        }

        .employee-page-title {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            min-width: 0;
        }

        .employee-page-icon {
            width: 55px;
            height: 55px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #198754, #20c997);
            color: #fff;
            font-size: 25px;
            box-shadow: 0 8px 20px rgba(25, 135, 84, .18);
            flex-shrink: 0;
        }

        .employee-page-title h1 {
            color: #1e293b;
            font-size: clamp(1.55rem, 2.4vw, 2.15rem);
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.2;
            margin: 0 0 5px;
        }

        .employee-page-title p {
            color: #64748b !important;
            font-size: clamp(.92rem, 1.1vw, 1.02rem);
            font-weight: 400;
            line-height: 1.6;
            max-width: 950px;
            margin: 0;
        }


        /* =========================================================
           METRIC CARDS
        ========================================================= */

        .metric-card {
            border-radius: 18px;
            padding: 22px;
            border: 1px solid rgba(0, 0, 0, .04);
            background: #fff;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .05);
        }

        .metric-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .metric-label {
            font-size: .85rem;
            font-weight: 600;
            color: #64748b;
        }

        .metric-value {
            font-size: 2rem;
            font-weight: 800;
            margin-top: 5px;
        }

        .metric-primary {
            border-left: 5px solid #0d6efd;
        }

        .metric-success {
            border-left: 5px solid #198754;
        }

        .metric-warning {
            border-left: 5px solid #ffc107;
        }


        /* =========================================================
           DEPARTMENT CARDS
        ========================================================= */

        .department-card {
            display: block;
            position: relative;
            height: 100%;
            padding: 30px 25px;
            border-radius: 20px;
            background: #fff;
            border: 1px solid #e9edf3;
            box-shadow: 0 7px 22px rgba(15, 23, 42, .06);
            text-decoration: none;
            color: inherit;
            transition: all .25s ease;
            overflow: hidden;
        }

        .department-card::before {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            right: -40px;
            top: -45px;
            background: rgba(25, 135, 84, .06);
        }

        .department-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 32px rgba(15, 23, 42, .12);
            border-color: rgba(25, 135, 84, .25);
        }

        .department-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 18px;
        }

        .department-card h4 {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .department-card p {
            color: #64748b;
            min-height: 44px;
            margin-bottom: 18px;
        }

        .department-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: .85rem;
            font-weight: 700;
            color: #198754;
            background: #ecfdf3;
            padding: 7px 12px;
            border-radius: 30px;
        }

        .department-arrow {
            position: absolute;
            right: 24px;
            bottom: 24px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #198754;
            transition: .2s;
        }

        .department-card:hover .department-arrow {
            background: #198754;
            color: white;
        }


        /* =========================================================
           DEPARTMENT COLORS
        ========================================================= */

        .icon-elementary {
            background: #e8f1ff;
            color: #0d6efd;
        }

        .icon-jhs {
            background: #eaf8ef;
            color: #198754;
        }

        .icon-shs {
            background: #fff0f0;
            color: #dc3545;
        }

        .icon-college {
            background: #fff7df;
            color: #d99a00;
        }

        .icon-admin {
            background: #e8f8fb;
            color: #0dcaf0;
        }

        .icon-laborers {
            background: #eef0f2;
            color: #6c757d;
        }


        /* =========================================================
           DEPARTMENT MODAL
        ========================================================= */

        .department-modal .modal-dialog {
            max-width: 1250px;
            height: calc(100vh - 30px);
            margin: 15px auto;
        }

        .department-modal .modal-content {
            height: 100%;
            border: 0;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .25);
        }

        .department-modal .modal-header {
            flex-shrink: 0;
            padding: 22px 26px;
            background: linear-gradient(135deg, #198754, #157347);
            color: #fff;
            border: 0;
        }

        .department-modal .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 1;
        }

        .department-modal .modal-title {
            font-weight: 700;
        }

        .department-modal .modal-body {
            flex: 1 1 auto;
            min-height: 0;
            padding: 25px;
            background: #f8fafc;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .department-search {
            border-radius: 12px;
            padding: 11px 15px;
        }

        .employee-table-wrapper {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e9edf3;
            overflow-x: auto;
        }

        .employee-table {
            margin-bottom: 0;
            min-width: 850px;
        }

        .employee-table thead th {
            background: #f8fafc;
            color: #475569;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .03em;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px;
            white-space: nowrap;
        }

        .employee-table tbody td {
            padding: 14px;
            vertical-align: middle;
            border-color: #f1f5f9;
        }

        .employee-table tbody tr:hover {
            background: #f8fafc;
        }

        .employee-avatar {
            width: 43px;
            height: 43px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        .employee-name {
            font-weight: 700;
            color: #1e293b;
        }

        .employee-id {
            font-size: .78rem;
            color: #64748b;
        }


        /* =========================================================
           ACTION BUTTONS
        ========================================================= */

        .employee-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .employee-action {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            border: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: .2s;
            text-decoration: none;
            flex-shrink: 0;
        }

        .employee-action:hover {
            transform: translateY(-2px);
        }

        .action-view {
            background: #e8f1ff;
            color: #0d6efd;
        }

        .action-edit {
            background: #fff7df;
            color: #b77900;
        }

        .action-delete {
            background: #fff0f0;
            color: #dc3545;
        }

        .action-face {
            background: #eaf8ef;
            color: #198754;
        }

        .action-reactivate {
            background: #eaf8ef;
            color: #198754;
        }


        /* =========================================================
           VIEW EMPLOYEE MODAL
           FIXED: FULL HEIGHT + INTERNAL SCROLL
        ========================================================= */

        .employee-view-modal .modal-dialog {
            max-width: 950px;
            height: calc(100vh - 30px);
            margin: 15px auto;
        }

        .employee-view-modal .modal-content {
            height: 100%;
            border: 0;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .25);
        }

        .employee-view-header {
            flex-shrink: 0;
            background: linear-gradient(135deg, #198754, #157347);
            color: #fff;
            padding: 25px;
            border: 0;
        }

        .employee-profile-top {
            display: flex;
            align-items: center;
            gap: 18px;
            min-width: 0;
        }

        .employee-profile-photo {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, .8);
            background: #fff;
            flex-shrink: 0;
        }

        .employee-profile-name {
            font-size: 1.4rem;
            font-weight: 700;
        }

        .employee-profile-position {
            opacity: .9;
        }

        .employee-view-modal .modal-body {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
            background: #fff;
        }

        .employee-info-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 17px;
            height: 100%;
        }

        .employee-info-label {
            display: block;
            font-size: .72rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 5px;
        }

        .employee-info-value {
            color: #1e293b;
            font-weight: 600;
            word-break: break-word;
        }


        /* =========================================================
           EDIT MODAL
           FIXED: FULL HEIGHT + INTERNAL SCROLL
        ========================================================= */

        .edit-modal .modal-dialog {
            max-width: 1050px;
            height: calc(100vh - 30px);
            margin: 15px auto;
        }

        .edit-modal .modal-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 0;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .25);
        }

        .edit-modal .modal-header {
            flex-shrink: 0;
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: #fff;
            padding: 22px 25px;
            border: 0;
        }

        .edit-modal .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .edit-modal form {
            min-height: 0;
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
        }

        .edit-modal .modal-body {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
            background: #f8fafc;
            padding: 25px;
        }

        .edit-modal .modal-footer {
            flex-shrink: 0;
            background: #fff;
            border-top: 1px solid #e2e8f0;
            padding: 15px 25px;
            z-index: 2;
        }

        .form-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 18px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .form-section-title {
            font-weight: 700;
            color: #1e293b;
            padding-bottom: 12px;
            margin-bottom: 18px;
            border-bottom: 1px solid #e2e8f0;
        }

        .edit-modal .form-label {
            font-size: .82rem;
            font-weight: 700;
            color: #475569;
        }

        .edit-modal .form-control,
        .edit-modal .form-select {
            border-radius: 10px;
            min-height: 43px;
        }

        .edit-modal textarea.form-control {
            min-height: 100px;
        }


        /* =========================================================
           FACE REGISTRATION
        ========================================================= */

        .face-registration-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            padding: 25px;
        }

        .face-registration-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eaf8ef;
            color: #198754;
            font-size: 32px;
        }


        /* =========================================================
           DELETE / DEACTIVATE MODAL
        ========================================================= */

        .danger-modal .modal-content {
            border: 0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .25);
        }

        .danger-modal .modal-header {
            background: #dc3545;
            color: #fff;
            border: 0;
        }

        .danger-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #fff0f0;
            color: #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 15px;
        }


        /* =========================================================
           INACTIVE MODAL
        ========================================================= */

        .inactive-modal .modal-dialog {
            max-width: 1050px;
            height: calc(100vh - 30px);
            margin: 15px auto;
        }

        .inactive-modal .modal-content {
            height: 100%;
            border: 0;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .25);
        }

        .inactive-modal .modal-header {
            flex-shrink: 0;
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #212529;
            border: 0;
        }

        .inactive-modal .modal-body {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
        }


        /* =========================================================
           BOOTSTRAP MODAL VISIBILITY
        ========================================================= */

        .modal {
            z-index: 1060 !important;
        }

        .modal-backdrop {
            z-index: 1050 !important;
            background-color: #0f172a;
        }

        .modal-backdrop.show {
            opacity: .65;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 768px) {

            .employee-page-header {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }

            .employee-page-title {
                width: 100%;
            }

            .employee-page-title h1 {
                font-size: clamp(1.45rem, 5vw, 1.85rem);
            }

            .employee-page-title p {
                font-size: .95rem;
            }

            .employee-page-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
            }

            .employee-page-header > .btn {
                width: 100%;
                justify-content: center;
            }

            .department-card {
                padding: 24px 20px;
            }

            .department-modal .modal-dialog,
            .employee-view-modal .modal-dialog,
            .edit-modal .modal-dialog,
            .inactive-modal .modal-dialog {
                height: calc(100vh - 10px);
                margin: 5px auto;
                max-width: calc(100% - 10px);
            }

            .department-modal .modal-body,
            .edit-modal .modal-body,
            .employee-view-modal .modal-body {
                padding: 15px;
            }

            .employee-profile-top {
                align-items: flex-start;
            }

            .employee-profile-photo {
                width: 65px;
                height: 65px;
            }

            .employee-profile-name {
                font-size: 1.1rem;
            }

            .edit-modal .modal-header,
            .employee-view-header {
                padding: 18px;
            }

            .edit-modal .modal-footer {
                padding: 12px 15px;
            }

        }

    </style>

</head>


<body>

<div class="admin-shell">

    <div class="sidebar-backdrop" data-sidebar-close></div>


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->

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


            <a class="nav-link active"
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


    <!-- =========================================================
         MAIN
    ========================================================== -->

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
                           placeholder="Search users, roles, teams"
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


        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <main class="dashboard-content">

            <div class="container-fluid px-3 px-lg-4 py-4">


                <div class="employee-page-header">

                    <div class="employee-page-title">

                        <div>

                            <h1>
                                Employee Management
                            </h1>

                            <p>
                                Select a department to view and manage its employees.
                            </p>

                        </div>

                    </div>


                    <a href="{{ route('users.create') }}"
                       class="btn btn-primary">

                        <i class="bi bi-person-plus me-1"></i>

                        Add User

                    </a>

                </div>


                <!-- METRICS -->

                <section class="row g-3 mb-4">

                    <div class="col-md-4">

                        <div class="metric-card metric-primary">

                            <div class="metric-top">

                                <span class="metric-label">
                                    Total Users
                                </span>

                                <i class="bi bi-people text-primary"></i>

                            </div>

                            <div class="metric-value">

                                {{
                                    $elementaryEmployees->count()
                                    + $jhsEmployees->count()
                                    + $shsEmployees->count()
                                    + $collegeEmployees->count()
                                    + $adminEmployees->count()
                                    + $laborerEmployees->count()
                                }}

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="metric-card metric-success">

                            <div class="metric-top">

                                <span class="metric-label">
                                    Active
                                </span>

                                <i class="bi bi-person-check text-success"></i>

                            </div>

                            <div class="metric-value">

                                {{
                                    $elementaryEmployees->where('status', 'Active')->count()
                                    + $jhsEmployees->where('status', 'Active')->count()
                                    + $shsEmployees->where('status', 'Active')->count()
                                    + $collegeEmployees->where('status', 'Active')->count()
                                    + $adminEmployees->where('status', 'Active')->count()
                                    + $laborerEmployees->where('status', 'Active')->count()
                                }}

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="metric-card metric-warning"
                             style="cursor:pointer;"
                             data-bs-toggle="modal"
                             data-bs-target="#inactiveEmployeesModal">

                            <div class="metric-top">

                                <span class="metric-label">
                                    Inactive
                                </span>

                                <i class="bi bi-person-x text-warning"></i>

                            </div>

                            <div class="metric-value">
                                {{ $inactiveEmployees->count() }}
                            </div>

                        </div>

                    </div>

                </section>


                <!-- DEPARTMENT CARDS -->

                <div class="row g-4">


                    <div class="col-xl-4 col-md-6">

                        <button type="button"
                                class="department-card w-100 text-start border-0"
                                data-bs-toggle="modal"
                                data-bs-target="#elementaryModal">

                            <div class="department-icon icon-elementary">

                                <i class="bi bi-house-door-fill"></i>

                            </div>

                            <h4>
                                Elementary
                            </h4>

                            <p>
                                View and manage elementary teachers and personnel.
                            </p>

                            <span class="department-count">

                                <i class="bi bi-people-fill"></i>

                                {{ $elementaryEmployees->count() }} Users

                            </span>

                            <span class="department-arrow">

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </button>

                    </div>


                    <div class="col-xl-4 col-md-6">

                        <button type="button"
                                class="department-card w-100 text-start border-0"
                                data-bs-toggle="modal"
                                data-bs-target="#jhsModal">

                            <div class="department-icon icon-jhs">

                                <i class="bi bi-book-fill"></i>

                            </div>

                            <h4>
                                Junior High School
                            </h4>

                            <p>
                                View and manage Junior High School personnel.
                            </p>

                            <span class="department-count">

                                <i class="bi bi-people-fill"></i>

                                {{ $jhsEmployees->count() }} Users

                            </span>

                            <span class="department-arrow">

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </button>

                    </div>


                    <div class="col-xl-4 col-md-6">

                        <button type="button"
                                class="department-card w-100 text-start border-0"
                                data-bs-toggle="modal"
                                data-bs-target="#shsModal">

                            <div class="department-icon icon-shs">

                                <i class="bi bi-journal-bookmark-fill"></i>

                            </div>

                            <h4>
                                Senior High School
                            </h4>

                            <p>
                                View and manage Senior High School personnel.
                            </p>

                            <span class="department-count">

                                <i class="bi bi-people-fill"></i>

                                {{ $shsEmployees->count() }} Users

                            </span>

                            <span class="department-arrow">

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </button>

                    </div>


                    <div class="col-xl-4 col-md-6">

                        <button type="button"
                                class="department-card w-100 text-start border-0"
                                data-bs-toggle="modal"
                                data-bs-target="#collegeModal">

                            <div class="department-icon icon-college">

                                <i class="bi bi-mortarboard-fill"></i>

                            </div>

                            <h4>
                                College
                            </h4>

                            <p>
                                View and manage college faculty and employees.
                            </p>

                            <span class="department-count">

                                <i class="bi bi-people-fill"></i>

                                {{ $collegeEmployees->count() }} Users

                            </span>

                            <span class="department-arrow">

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </button>

                    </div>


                    <div class="col-xl-4 col-md-6">

                        <button type="button"
                                class="department-card w-100 text-start border-0"
                                data-bs-toggle="modal"
                                data-bs-target="#adminModal">

                            <div class="department-icon icon-admin">

                                <i class="bi bi-building-fill"></i>

                            </div>

                            <h4>
                                Administrative
                            </h4>

                            <p>
                                View and manage administrative personnel.
                            </p>

                            <span class="department-count">

                                <i class="bi bi-people-fill"></i>

                                {{ $adminEmployees->count() }} Users

                            </span>

                            <span class="department-arrow">

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </button>

                    </div>


                    <div class="col-xl-4 col-md-6">

                        <button type="button"
                                class="department-card w-100 text-start border-0"
                                data-bs-toggle="modal"
                                data-bs-target="#laborersModal">

                            <div class="department-icon icon-laborers">

                                <i class="bi bi-person-workspace"></i>

                            </div>

                            <h4>
                                Laborers
                            </h4>

                            <p>
                                View and manage maintenance and labor personnel.
                            </p>

                            <span class="department-count">

                                <i class="bi bi-people-fill"></i>

                                {{ $laborerEmployees->count() }} Users

                            </span>

                            <span class="department-arrow">

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </button>

                    </div>

                </div>

            </div>

        </main>


        <footer class="admin-footer">

            <div class="container-fluid px-3 px-lg-4"></div>

        </footer>

    </div>

</div>


<!-- =============================================================
     DEPARTMENT MODALS
============================================================== -->

@php

    $departmentModals = [

        [
            'id' => 'elementaryModal',
            'title' => 'Elementary Department',
            'icon' => 'bi-house-door-fill',
            'employees' => $elementaryEmployees,
        ],

        [
            'id' => 'jhsModal',
            'title' => 'Junior High School (JHS)',
            'icon' => 'bi-book-fill',
            'employees' => $jhsEmployees,
        ],

        [
            'id' => 'shsModal',
            'title' => 'Senior High School (SHS)',
            'icon' => 'bi-journal-bookmark-fill',
            'employees' => $shsEmployees,
        ],

        [
            'id' => 'collegeModal',
            'title' => 'College Department',
            'icon' => 'bi-mortarboard-fill',
            'employees' => $collegeEmployees,
        ],

        [
            'id' => 'adminModal',
            'title' => 'Administrative Personnel',
            'icon' => 'bi-building-fill',
            'employees' => $adminEmployees,
        ],

        [
            'id' => 'laborersModal',
            'title' => 'Laborers',
            'icon' => 'bi-person-workspace',
            'employees' => $laborerEmployees,
        ],

    ];

@endphp


@foreach($departmentModals as $department)

<div class="modal fade department-modal"
     id="{{ $department['id'] }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <div>

                    <h5 class="modal-title mb-1">

                        <i class="bi {{ $department['icon'] }} me-2"></i>

                        {{ $department['title'] }}

                    </h5>

                    <small>

                        {{ $department['employees']->count() }}
                        employee(s) registered in this department.

                    </small>

                </div>


                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <div class="modal-body">


                <div class="row mb-3">

                    <div class="col-md-6">

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search"></i>

                            </span>

                            <input type="search"
                                   class="form-control department-search"
                                   placeholder="Search employee..."
                                   data-department-search="{{ $department['id'] }}">

                        </div>

                    </div>


                    <div class="col-md-6 text-md-end mt-2 mt-md-0">

                        <span class="badge bg-light text-dark p-2">

                            <i class="bi bi-people me-1"></i>

                            {{ $department['employees']->count() }}

                            Employees

                        </span>

                    </div>

                </div>


                <div class="employee-table-wrapper">

                    <table class="table employee-table">

                        <thead>

                            <tr>

                                <th>
                                    Employee
                                </th>

                                <th>
                                    Employee ID
                                </th>

                                <th>
                                    Employment Type
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

                        @forelse($department['employees'] as $employee)

                            <tr class="employee-row"
                                data-search="{{ strtolower(
                                    ($employee->first_name ?? '') . ' ' .
                                    ($employee->middle_name ?? '') . ' ' .
                                    ($employee->last_name ?? '') . ' ' .
                                    ($employee->employee_id ?? '') . ' ' .
                                    ($employee->position ?? '') . ' ' .
                                    ($employee->employment_type ?? '')
                                ) }}">


                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <img class="employee-avatar"
                                             src="{{ $employee->photo
                                                ? asset('storage/' . $employee->photo)
                                                : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                             alt="{{ $employee->name }}">

                                        <div>

                                            <div class="employee-name">

                                                {{ $employee->first_name }}
                                                {{ $employee->middle_name }}
                                                {{ $employee->last_name }}

                                            </div>

                                            <div class="employee-id">

                                                {{ $employee->email }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <span class="badge bg-light text-dark border">

                                        {{ $employee->employee_id ?? 'N/A' }}

                                    </span>

                                </td>


                                <td>

                                    {{ $employee->employment_type ?? 'N/A' }}

                                </td>


                                <td>

                                    @if($employee->status === 'Active')

                                        <span class="badge bg-success-subtle text-success border border-success-subtle">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Active

                                        </span>

                                    @else

                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="employee-actions justify-content-center">


                                        <!-- VIEW -->

                                        <button type="button"
                                                class="employee-action action-view viewEmployee"
                                                title="View Employee"
                                                data-url="{{ route('employees.show', $employee->id) }}">

                                            <i class="bi bi-eye"></i>

                                        </button>


                                        <!-- EDIT -->

                                        <button type="button"
                                                class="employee-action action-edit editEmployee"
                                                title="Edit Employee"
                                                data-url="{{ route('employees.show', $employee->id) }}">

                                            <i class="bi bi-pencil"></i>

                                        </button>


                                        <!-- FACE REGISTRATION -->

                                        <a href="{{ url('/admin/employees/' . $employee->id . '/face-registration') }}"
                                           class="employee-action action-face"
                                           title="Face Registration">

                                            <i class="bi bi-person-bounding-box"></i>

                                        </a>


                                        <!-- DEACTIVATE / REACTIVATE -->

                                        @if($employee->status === 'Active')

                                            <button type="button"
                                                    class="employee-action action-delete deactivateEmployee"
                                                    title="Deactivate Employee"
                                                    data-id="{{ $employee->id }}"
                                                    data-name="{{ $employee->first_name }} {{ $employee->last_name }}">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        @else

                                            <button type="button"
                                                    class="employee-action action-reactivate reactivateEmployee"
                                                    title="Reactivate Employee"
                                                    data-id="{{ $employee->id }}">

                                                <i class="bi bi-arrow-repeat"></i>

                                            </button>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr class="empty-row">

                                <td colspan="5"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-people display-5 d-block mb-2"></i>

                                        No employees found in this department.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endforeach


<!-- =============================================================
     VIEW EMPLOYEE MODAL
============================================================== -->

<div class="modal fade employee-view-modal"
     id="employeeModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header employee-view-header">

                <div class="employee-profile-top">

                    <img id="viewEmployeePhoto"
                         class="employee-profile-photo"
                         src="{{ asset('khen/assets/images/avatar/avatar.jpg') }}"
                         alt="Employee">

                    <div>

                        <div class="employee-profile-name"
                             id="viewEmployeeName">

                            Employee

                        </div>

                        <div class="employee-profile-position"
                             id="viewEmployeePosition">

                            Employee information

                        </div>

                    </div>

                </div>


                <button type="button"
                        class="btn-close ms-auto"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <div class="modal-body p-4">

                <div class="row g-3"
                     id="employeeDetails">

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================
     EDIT EMPLOYEE MODAL
============================================================== -->

<div class="modal fade edit-modal"
     id="editEmployeeModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <div>

                    <h5 class="modal-title">

                        <i class="bi bi-pencil-square me-2"></i>

                        Edit Employee

                    </h5>

                    <small>

                        Update employee account and employment information.

                    </small>

                </div>


                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <form id="editEmployeeForm">

                @csrf


                <div class="modal-body">


                    <input type="hidden"
                           id="employee_id"
                           name="id">


                    <!-- PERSONAL INFORMATION -->

                    <div class="form-section">

                        <div class="form-section-title">

                            <i class="bi bi-person me-2 text-primary"></i>

                            Personal Information

                        </div>


                        <div class="row g-3">


                            <div class="col-md-4">

                                <label class="form-label">
                                    First Name
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="first_name"
                                       name="first_name">

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Middle Name
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="middle_name"
                                       name="middle_name">

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Last Name
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="last_name"
                                       name="last_name">

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email">

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Contact Number
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="contact_number"
                                       name="contact_number">

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Gender
                                </label>

                                <select class="form-select"
                                        id="gender"
                                        name="gender">

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option value="Male">
                                        Male
                                    </option>

                                    <option value="Female">
                                        Female
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Birth Date
                                </label>

                                <input type="date"
                                       class="form-control"
                                       id="birth_date"
                                       name="birth_date">

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Address
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="address"
                                       name="address">

                            </div>

                        </div>

                    </div>


                    <!-- EMPLOYMENT -->

                    <div class="form-section">

                        <div class="form-section-title">

                            <i class="bi bi-briefcase me-2 text-primary"></i>

                            Employment Information

                        </div>


                        <div class="row g-3">


                            <div class="col-md-4">

                                <label class="form-label">
                                    Department
                                </label>

                                <select class="form-select"
                                        id="department"
                                        name="department">

                                    <option value="Elementary">
                                        Elementary
                                    </option>

                                    <option value="JHS">
                                        JHS
                                    </option>

                                    <option value="SHS">
                                        SHS
                                    </option>

                                    <option value="College">
                                        College
                                    </option>

                                    <option value="Admin">
                                        Administrative
                                    </option>

                                    <option value="Laborers">
                                        Laborers
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Position
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="position"
                                       name="position">

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Employment Type
                                </label>

                                <select class="form-select"
                                        id="employment_type"
                                        name="employment_type">

                                    <option value="">
                                        Select
                                    </option>

                                    <option value="Regular">
                                        Regular
                                    </option>

                                    <option value="Contractual">
                                        Contractual
                                    </option>

                                    <option value="Part-Time">
                                        Part-Time
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Status
                                </label>

                                <select class="form-select"
                                        id="status"
                                        name="status">

                                    <option value="Active">
                                        Active
                                    </option>

                                    <option value="Inactive">
                                        Inactive
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Salary Grade
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="salary_grade"
                                       name="salary_grade">

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Hire Date
                                </label>

                                <input type="date"
                                       class="form-control"
                                       id="hire_date"
                                       name="hire_date">

                            </div>

                        </div>

                    </div>


                    <!-- GOVERNMENT BENEFITS / IDENTIFICATION -->

                    <div class="form-section">

                        <div class="form-section-title">

                            <i class="bi bi-card-checklist me-2 text-success"></i>

                            Government Benefits Numbers

                        </div>

                        <div class="row g-3">

                            <div class="col-md-3">

                                <label class="form-label">
                                    SSS Number
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="sss_number"
                                       name="sss_number"
                                       maxlength="30"
                                       autocomplete="off">

                            </div>

                            <div class="col-md-3">

                                <label class="form-label">
                                    PhilHealth Number
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="philhealth_number"
                                       name="philhealth_number"
                                       maxlength="30"
                                       autocomplete="off">

                            </div>

                            <div class="col-md-3">

                                <label class="form-label">
                                    Pag-IBIG Number
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="pagibig_number"
                                       name="pagibig_number"
                                       maxlength="30"
                                       autocomplete="off">

                            </div>

                            <div class="col-md-3">

                                <label class="form-label">
                                    TIN
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="tin"
                                       name="tin"
                                       maxlength="30"
                                       autocomplete="off">

                            </div>

                        </div>

                        <div class="small text-muted mt-2">
                            Enter the employee's government-issued benefit and tax identification numbers.
                        </div>

                    </div>


                    <!-- EMERGENCY -->

                    <div class="form-section">

                        <div class="form-section-title">

                            <i class="bi bi-shield-exclamation me-2 text-danger"></i>

                            Emergency Contact

                        </div>


                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Emergency Contact Person
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="emergency_contact_person"
                                       name="emergency_contact_person">

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Emergency Contact Number
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="emergency_contact_number"
                                       name="emergency_contact_number">

                            </div>


                            <div class="col-12">

                                <label class="form-label">
                                    Bio
                                </label>

                                <textarea class="form-control"
                                          id="bio"
                                          name="bio"
                                          rows="3"></textarea>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">

                        Cancel

                    </button>


                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-check-lg me-1"></i>

                        Save Changes

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- =============================================================
     DEACTIVATE MODAL
============================================================== -->

<div class="modal fade danger-modal"
     id="deactivateEmployeeModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-person-x me-2"></i>

                    Deactivate Employee

                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <div class="modal-body text-center p-4">

                <div class="danger-icon">

                    <i class="bi bi-exclamation-triangle"></i>

                </div>


                <h5 class="fw-bold">
                    Deactivate this employee?
                </h5>


                <p class="text-muted">
                    You are about to deactivate:
                </p>


                <div class="alert alert-danger">

                    <strong id="deactivateEmployeeName">
                        Employee
                    </strong>

                </div>


                <p class="small text-muted mb-0">

                    The employee account will remain in the system
                    but will be marked as inactive.

                </p>


                <input type="hidden"
                       id="deactivateEmployeeId">

            </div>


            <div class="modal-footer">

                <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                    Cancel

                </button>


                <button type="button"
                        class="btn btn-danger"
                        id="confirmDeactivateEmployee">

                    <i class="bi bi-person-x me-1"></i>

                    Deactivate Employee

                </button>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================
     INACTIVE EMPLOYEES MODAL
============================================================== -->

<div class="modal fade inactive-modal"
     id="inactiveEmployeesModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <div>

                    <h5 class="modal-title">

                        <i class="bi bi-person-x me-2"></i>

                        Inactive Employees

                    </h5>

                    <small>

                        Manage employees whose accounts are currently inactive.

                    </small>

                </div>


                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <div class="modal-body p-4">

                <div class="employee-table-wrapper">

                    <table class="table employee-table">

                        <thead>

                            <tr>

                                <th>
                                    Employee
                                </th>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Department
                                </th>

                                <th>
                                    Position
                                </th>

                                <th>
                                    Status
                                </th>

                                <th class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                        @forelse($inactiveEmployees as $employee)

                            <tr>

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <img class="employee-avatar"
                                             src="{{ $employee->photo
                                                ? asset('storage/' . $employee->photo)
                                                : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                             alt="{{ $employee->name }}">

                                        <div>

                                            <div class="employee-name">

                                                {{ $employee->first_name }}
                                                {{ $employee->last_name }}

                                            </div>

                                            <div class="employee-id">

                                                {{ $employee->email }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    {{ $employee->employee_id ?? 'N/A' }}

                                </td>


                                <td>

                                    {{ $employee->department ?? 'N/A' }}

                                </td>


                                <td>

                                    {{ $employee->position ?? 'N/A' }}

                                </td>


                                <td>

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                </td>


                                <td class="text-center">

                                    <button type="button"
                                            class="btn btn-success btn-sm reactivateEmployee"
                                            data-id="{{ $employee->id }}">

                                        <i class="bi bi-arrow-repeat me-1"></i>

                                        Reactivate

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-5">

                                    <i class="bi bi-person-check display-5 text-muted d-block mb-2"></i>

                                    <span class="text-muted">
                                        No inactive employees.
                                    </span>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================
     JAVASCRIPT
============================================================== -->

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../../khen/assets/js/main.js"></script>


<script>

document.addEventListener("DOMContentLoaded", function () {


    /* =========================================================
       CSRF
    ========================================================= */

    const csrfMeta =
        document.querySelector('meta[name="csrf-token"]');

    const csrfToken =
        csrfMeta ? csrfMeta.getAttribute("content") : "";


    /* =========================================================
       DEPARTMENT SEARCH
    ========================================================= */

    document.querySelectorAll("[data-department-search]")
        .forEach(searchInput => {

            searchInput.addEventListener("input", function () {

                const modalId =
                    this.dataset.departmentSearch;

                const searchValue =
                    this.value.toLowerCase().trim();

                const modal =
                    document.getElementById(modalId);

                if (!modal) {
                    return;
                }

                modal.querySelectorAll(".employee-row")
                    .forEach(row => {

                        const searchText =
                            row.dataset.search || "";

                        row.style.display =
                            searchText.includes(searchValue)
                                ? ""
                                : "none";

                    });

            });

        });


    /* =========================================================
       VIEW EMPLOYEE
    ========================================================= */

    document.querySelectorAll(".viewEmployee")
        .forEach(button => {

            button.addEventListener("click", function () {

                const url = this.dataset.url;

                fetch(url, {

                    method: "GET",

                    headers: {
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }

                })

                .then(response => {

                    if (!response.ok) {
                        throw new Error("Failed to load employee.");
                    }

                    return response.json();

                })

                .then(employee => {

                    const photo =
                        employee.photo
                            ? "/storage/" + employee.photo
                            : "/khen/assets/images/avatar/avatar.jpg";


                    document.getElementById("viewEmployeePhoto").src =
                        photo;


                    document.getElementById("viewEmployeeName").textContent =
                        `${employee.first_name ?? ""} ${employee.last_name ?? ""}`.trim();


                    document.getElementById("viewEmployeePosition").textContent =
                        employee.position ?? "Employee";


                    const details =
                        document.getElementById("employeeDetails");


                    details.innerHTML = `

                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Employee ID
                                </span>

                                <div class="employee-info-value">
                                    ${employee.employee_id ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Email
                                </span>

                                <div class="employee-info-value">
                                    ${employee.email ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Department
                                </span>

                                <div class="employee-info-value">
                                    ${employee.department ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Position
                                </span>

                                <div class="employee-info-value">
                                    ${employee.position ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Gender
                                </span>

                                <div class="employee-info-value">
                                    ${employee.gender ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Birth Date
                                </span>

                                <div class="employee-info-value">
                                    ${employee.birth_date ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Contact Number
                                </span>

                                <div class="employee-info-value">
                                    ${employee.contact_number ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Employment Type
                                </span>

                                <div class="employee-info-value">
                                    ${employee.employment_type ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Salary Grade
                                </span>

                                <div class="employee-info-value">
                                    ${employee.salary_grade ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Hire Date
                                </span>

                                <div class="employee-info-value">
                                    ${employee.hire_date ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Status
                                </span>

                                <div class="employee-info-value">

                                    <span class="badge ${
                                        employee.status === "Active"
                                            ? "bg-success"
                                            : "bg-danger"
                                    }">

                                        ${employee.status ?? "-"}

                                    </span>

                                </div>

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Address
                                </span>

                                <div class="employee-info-value">
                                    ${employee.address ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Emergency Contact
                                </span>

                                <div class="employee-info-value">
                                    ${employee.emergency_contact_person ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Emergency Number
                                </span>

                                <div class="employee-info-value">
                                    ${employee.emergency_contact_number ?? "-"}
                                </div>

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="employee-info-card">

                                <span class="employee-info-label">
                                    Bio
                                </span>

                                <div class="employee-info-value">
                                    ${employee.bio ?? "-"}
                                </div>

                            </div>

                        </div>

                    `;


                    const modalElement =
                        document.getElementById("employeeModal");


                    bootstrap.Modal
                        .getOrCreateInstance(modalElement)
                        .show();

                })

                .catch(error => {

                    console.error(error);

                    alert("Unable to load employee information.");

                });

            });

        });


    /* =========================================================
       EDIT EMPLOYEE
    ========================================================= */

    document.querySelectorAll(".editEmployee")
        .forEach(button => {

            button.addEventListener("click", function () {

                const url = this.dataset.url;


                fetch(url, {

                    method: "GET",

                    headers: {
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }

                })

                .then(response => {

                    if (!response.ok) {
                        throw new Error("Failed to load employee.");
                    }

                    return response.json();

                })

                .then(employee => {


                    document.getElementById("employee_id").value =
                        employee.id ?? "";


                    document.getElementById("first_name").value =
                        employee.first_name ?? "";


                    document.getElementById("middle_name").value =
                        employee.middle_name ?? "";


                    document.getElementById("last_name").value =
                        employee.last_name ?? "";


                    document.getElementById("email").value =
                        employee.email ?? "";


                    document.getElementById("contact_number").value =
                        employee.contact_number ?? "";


                    document.getElementById("department").value =
                        employee.department ?? "";


                    document.getElementById("position").value =
                        employee.position ?? "";


                    document.getElementById("gender").value =
                        employee.gender ?? "";


                    document.getElementById("employment_type").value =
                        employee.employment_type ?? "";


                    document.getElementById("status").value =
                        employee.status ?? "";


                    document.getElementById("salary_grade").value =
                        employee.salary_grade ?? "";


                    document.getElementById("birth_date").value =
                        employee.birth_date ?? "";


                    document.getElementById("address").value =
                        employee.address ?? "";


                    document.getElementById("emergency_contact_person").value =
                        employee.emergency_contact_person ?? "";


                    document.getElementById("emergency_contact_number").value =
                        employee.emergency_contact_number ?? "";


                    document.getElementById("hire_date").value =
                        employee.hire_date ?? "";


                    document.getElementById("sss_number").value =
                        employee.sss_number ?? "";


                    document.getElementById("philhealth_number").value =
                        employee.philhealth_number ?? "";


                    document.getElementById("pagibig_number").value =
                        employee.pagibig_number ?? "";


                    document.getElementById("tin").value =
                        employee.tin ?? "";


                    document.getElementById("bio").value =
                        employee.bio ?? "";


                    const modalElement =
                        document.getElementById("editEmployeeModal");


                    bootstrap.Modal
                        .getOrCreateInstance(modalElement)
                        .show();

                })

                .catch(error => {

                    console.error(error);

                    alert("Unable to load employee information.");

                });

            });

        });


    /* =========================================================
       UPDATE EMPLOYEE
       FIXED: USE LARAVEL PUT METHOD SPOOFING
    ========================================================= */

    const editForm =
        document.getElementById("editEmployeeForm");


    if (editForm) {

        editForm.addEventListener("submit", function (event) {

            event.preventDefault();


            const id =
                document.getElementById("employee_id").value;


            if (!id) {

                alert("Employee ID is missing.");

                return;

            }


            const formData =
                new FormData(this);


            formData.set("_method", "PUT");


            fetch("/admin/employees/" + id, {

                method: "POST",

                headers: {

                    "X-CSRF-TOKEN": csrfToken,

                    "Accept": "application/json",

                    "X-Requested-With": "XMLHttpRequest"

                },

                body: formData

            })

            .then(async response => {

                const contentType =
                    response.headers.get("content-type") || "";


                let data;


                if (contentType.includes("application/json")) {

                    data = await response.json();

                } else {

                    const text =
                        await response.text();

                    console.error("Server response:", text);

                    throw new Error(
                        "The server returned an unexpected response."
                    );

                }


                if (!response.ok) {

                    console.error(data);


                    if (data.errors) {

                        const validationErrors =
                            Object.values(data.errors)
                                .flat()
                                .join("\n");

                        throw new Error(validationErrors);

                    }


                    throw new Error(
                        data.message ||
                        "Employee update failed."
                    );

                }


                alert(
                    data.message ||
                    "Employee updated successfully."
                );


                const modalElement =
                    document.getElementById("editEmployeeModal");


                bootstrap.Modal
                    .getInstance(modalElement)
                    ?.hide();


                setTimeout(() => {

                    location.reload();

                }, 300);

            })

            .catch(error => {

                console.error(error);

                alert(error.message);

            });

        });

    }


    /* =========================================================
       DEACTIVATE EMPLOYEE
    ========================================================= */

    document.querySelectorAll(".deactivateEmployee")
        .forEach(button => {

            button.addEventListener("click", function () {


                document.getElementById(
                    "deactivateEmployeeId"
                ).value = this.dataset.id;


                document.getElementById(
                    "deactivateEmployeeName"
                ).textContent = this.dataset.name;


                const modalElement =
                    document.getElementById(
                        "deactivateEmployeeModal"
                    );


                bootstrap.Modal
                    .getOrCreateInstance(modalElement)
                    .show();

            });

        });


    /* =========================================================
       CONFIRM DEACTIVATE
    ========================================================= */

    const confirmDeactivate =
        document.getElementById(
            "confirmDeactivateEmployee"
        );


    if (confirmDeactivate) {

        confirmDeactivate.addEventListener("click", function () {


            const id =
                document.getElementById(
                    "deactivateEmployeeId"
                ).value;


            fetch("/admin/employees/" + id, {

                method: "POST",

                headers: {

                    "X-CSRF-TOKEN": csrfToken,

                    "Accept": "application/json",

                    "Content-Type":
                        "application/x-www-form-urlencoded",

                    "X-Requested-With":
                        "XMLHttpRequest"

                },

                body: "_method=DELETE"

            })

            .then(async response => {

                const data =
                    await response.json();


                if (!response.ok) {

                    throw new Error(
                        data.message ||
                        "Unable to deactivate employee."
                    );

                }


                if (data.success) {

                    alert(
                        data.message ||
                        "Employee deactivated successfully."
                    );


                    const modalElement =
                        document.getElementById(
                            "deactivateEmployeeModal"
                        );


                    bootstrap.Modal
                        .getInstance(modalElement)
                        ?.hide();


                    setTimeout(() => {

                        location.reload();

                    }, 300);

                } else {

                    alert(
                        data.message ||
                        "Unable to deactivate employee."
                    );

                }

            })

            .catch(error => {

                console.error(error);

                alert(error.message);

            });

        });

    }


    /* =========================================================
       REACTIVATE EMPLOYEE
    ========================================================= */

    document.querySelectorAll(".reactivateEmployee")
        .forEach(button => {

            button.addEventListener("click", function () {


                const id =
                    this.dataset.id;


                fetch(
                    "/admin/employees/" +
                    id +
                    "/reactivate",
                    {

                        method: "PUT",

                        headers: {

                            "X-CSRF-TOKEN": csrfToken,

                            "Accept": "application/json",

                            "X-Requested-With":
                                "XMLHttpRequest"

                        }

                    }
                )

                .then(async response => {

                    const data =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            "Unable to reactivate employee."
                        );

                    }


                    alert(
                        data.message ||
                        "Employee reactivated successfully."
                    );


                    const modalElement =
                        document.getElementById(
                            "inactiveEmployeesModal"
                        );


                    bootstrap.Modal
                        .getInstance(modalElement)
                        ?.hide();


                    setTimeout(() => {

                        location.reload();

                    }, 300);

                })

                .catch(error => {

                    console.error(error);

                    alert(error.message);

                });

            });

        });


    /* =========================================================
       CLEAN UP BOOTSTRAP BACKDROP
    ========================================================= */

    document.querySelectorAll(".modal")
        .forEach(modal => {

            modal.addEventListener("hidden.bs.modal", function () {


                document.querySelectorAll(".modal-backdrop")
                    .forEach(backdrop => backdrop.remove());


                document.body.classList.remove("modal-open");


                document.body.style.removeProperty("padding-right");

            });

        });

});

</script>


</body>

</html>
