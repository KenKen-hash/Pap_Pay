@php
    $employee = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="adminHMD professional admin dashboard template">

    <title>Announcements | PAP Pay</title>


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


    <style>

        /* =========================================================
           GLOBAL RESPONSIVE RESET
           ========================================================= */

        html {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

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

        img,
        svg,
        video,
        iframe {
            max-width: 100%;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        a,
        small,
        strong {
            max-width: 100%;
        }


        /* =========================================================
           MAIN APPLICATION SHELL
           ========================================================= */

        .admin-shell {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

        .admin-main {
            min-width: 0 !important;
            max-width: 100%;
            overflow-x: hidden;
        }

        .dashboard-content {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }


        /* =========================================================
           NAVBAR
           ========================================================= */

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

        .admin-navbar form {
            min-width: 0;
            max-width: 100%;
        }

        .admin-navbar .search-input {
            width: 100%;
            min-width: 0;
            max-width: 100%;
        }

        .navbar-actions {
            min-width: 0;
            flex-shrink: 0;
        }


        /* =========================================================
           PAGE CONTAINER
           ========================================================= */

        .announcement-container {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0 auto;
        }

        .announcement-container > .row {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-left: 0;
            margin-right: 0;
        }

        .announcement-container .row > * {
            min-width: 0;
        }


        /* =========================================================
           PAGE HEADER
           ========================================================= */

        .announcement-page-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .announcement-page-header h2 {
            margin: 0;
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-page-header p {
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =========================================================
           SEARCH
           ========================================================= */

        .announcement-search-row {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-left: 0;
            margin-right: 0;
        }

        .announcement-search-wrapper {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .announcement-search-wrapper .input-group {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .announcement-search-wrapper .input-group-text {
            flex: 0 0 auto;
        }

        .announcement-search-wrapper input {
            min-width: 0;
            width: 100%;
            max-width: 100%;
        }


        /* =========================================================
           ANNOUNCEMENT CARD
           ========================================================= */

        .announcement-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }

        .announcement-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 12px 25px rgba(0, 0, 0, .12) !important;
        }

        .announcement-card .card-body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
        }


        /* =========================================================
           ANNOUNCEMENT HEADER
           ========================================================= */

        .announcement-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            display: flex;

            justify-content: space-between;
            align-items: flex-start;

            gap: 1rem;
        }

        .announcement-title-area {
            flex: 1 1 auto;
            min-width: 0;
            max-width: 100%;
        }

        .announcement-title {
            margin: 0;

            max-width: 100%;

            overflow-wrap: anywhere;
            word-break: break-word;

            line-height: 1.35;
        }

        .announcement-title-icon {
            display: inline;
        }

        .announcement-meta {
            display: block;

            max-width: 100%;

            overflow-wrap: anywhere;
            word-break: break-word;

            line-height: 1.5;
        }

        .announcement-badge {
            flex: 0 0 auto;

            white-space: nowrap;

            max-width: 100%;
        }


        /* =========================================================
           ANNOUNCEMENT MESSAGE
           ========================================================= */

        .announcement-message {
            width: 100%;
            max-width: 100%;

            margin-bottom: 1rem;

            overflow-wrap: anywhere;
            word-break: break-word;

            white-space: pre-wrap;

            line-height: 1.7;
        }


        /* =========================================================
           ATTACHMENT
           ========================================================= */

        .announcement-attachment {
            max-width: 100%;

            white-space: normal;

            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =========================================================
           EMPTY STATE
           ========================================================= */

        .announcement-empty {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            overflow: hidden;
        }

        .announcement-empty .card-body {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            overflow: hidden;
        }

        .announcement-empty p {
            max-width: 100%;

            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =========================================================
           FOOTER
           ========================================================= */

        .admin-footer {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            overflow-x: hidden;
        }

        .admin-footer .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .admin-footer span {
            max-width: 100%;

            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =========================================================
           TABLET
           992px AND BELOW
           ========================================================= */

        @media (max-width: 991.98px) {

            .admin-shell {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                overflow-x: hidden !important;
            }

            .admin-main {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                overflow-x: hidden !important;
            }

            .dashboard-content {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                overflow-x: hidden !important;
            }


            /* -----------------------------------------
               Navbar
               ----------------------------------------- */

            .admin-navbar {
                width: 100% !important;
                max-width: 100% !important;
            }

            .admin-navbar .container-fluid {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;
            }

            .admin-navbar form {
                min-width: 0;
                max-width: 100%;
            }


            /* -----------------------------------------
               Page
               ----------------------------------------- */

            .announcement-container {
                width: 100% !important;
                max-width: 100% !important;

                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }


            /* -----------------------------------------
               Announcement header
               ----------------------------------------- */

            .announcement-header {
                gap: .75rem;
            }

        }


        /* =========================================================
           MOBILE
           768px AND BELOW
           ========================================================= */

        @media (max-width: 767.98px) {

            html,
            body {
                width: 100%;
                max-width: 100%;

                overflow-x: hidden !important;
            }


            /* =====================================================
               IMPORTANT:
               MAIN CONTENT MUST USE FULL MOBILE WIDTH
               ===================================================== */

            .admin-shell {
                display: block !important;

                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                overflow-x: hidden !important;
            }

            .admin-main {
                display: block !important;

                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                margin-left: 0 !important;
                padding-left: 0 !important;

                overflow-x: hidden !important;
            }

            .dashboard-content {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                margin-left: 0 !important;
                padding-left: 0 !important;

                overflow-x: hidden !important;
            }


            /* =====================================================
               MOBILE SIDEBAR
               ===================================================== */

            .admin-sidebar {
                position: fixed !important;

                top: 0 !important;
                left: 0 !important;
                bottom: 0 !important;

                width: min(280px, 86vw) !important;
                max-width: 86vw !important;

                z-index: 1050 !important;

                transform: translateX(-105%) !important;

                transition:
                    transform .25s ease,
                    box-shadow .25s ease !important;

                overflow-y: auto !important;
                overflow-x: hidden !important;
            }


            /*
             * These selectors cover the common sidebar-open
             * classes used by the template JavaScript.
             */

            body.sidebar-open .admin-sidebar,
            .admin-shell.sidebar-open .admin-sidebar,
            .admin-sidebar.sidebar-open,
            .admin-sidebar.is-open,
            .admin-sidebar.show {
                transform: translateX(0) !important;

                box-shadow:
                    10px 0 30px rgba(0, 0, 0, .18) !important;
            }


            /* =====================================================
               SIDEBAR BACKDROP
               ===================================================== */

            .sidebar-backdrop {
                position: fixed !important;

                inset: 0 !important;

                z-index: 1040 !important;

                background: rgba(15, 23, 42, .45);

                opacity: 0;
                visibility: hidden;

                transition:
                    opacity .25s ease,
                    visibility .25s ease !important;
            }

            body.sidebar-open .sidebar-backdrop,
            .admin-shell.sidebar-open .sidebar-backdrop,
            .sidebar-backdrop.show,
            .sidebar-backdrop.is-visible {
                opacity: 1 !important;
                visibility: visible !important;
            }


            /* =====================================================
               NAVBAR
               ===================================================== */

            .admin-navbar {
                width: 100% !important;
                max-width: 100% !important;

                position: relative;
                z-index: 1000;
            }

            .admin-navbar .container-fluid {
                width: 100% !important;
                max-width: 100% !important;

                padding-left: .75rem !important;
                padding-right: .75rem !important;
            }

            .sidebar-toggle {
                flex: 0 0 auto;

                width: 44px;
                height: 44px;
            }

            .admin-navbar form {
                display: none !important;
            }

            .navbar-actions {
                display: flex;

                align-items: center;

                gap: .35rem;

                margin-left: auto !important;

                min-width: 0;

                flex-shrink: 0;
            }

            .icon-button {
                flex: 0 0 auto;
            }

            .profile-button {
                flex: 0 0 auto;

                max-width: 44px;

                overflow: hidden;
            }


            /* =====================================================
               MAIN PAGE CONTAINER
               ===================================================== */

            .announcement-container {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                padding:
                    1rem !important;

                overflow-x: hidden !important;
            }


            /* =====================================================
               PAGE HEADER
               ===================================================== */

            .announcement-page-header {
                width: 100%;

                margin-bottom: 1rem !important;
            }

            .announcement-page-header h2 {
                font-size: 1.65rem;

                line-height: 1.25;

                margin-bottom: .5rem !important;
            }

            .announcement-page-header p {
                font-size: .9rem;

                line-height: 1.55;
            }


            /* =====================================================
               SEARCH
               ===================================================== */

            .announcement-search-row {
                width: 100% !important;
                max-width: 100% !important;

                margin-bottom: 1rem !important;
            }

            .announcement-search-wrapper {
                width: 100% !important;
                max-width: 100% !important;

                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .announcement-search-wrapper .input-group {
                width: 100% !important;
                max-width: 100% !important;
            }

            .announcement-search-wrapper input {
                min-width: 0 !important;

                width: 100% !important;

                font-size: .9rem;
            }


            /* =====================================================
               ANNOUNCEMENT CARD
               ===================================================== */

            .announcement-card {
                width: 100% !important;
                max-width: 100% !important;

                margin-bottom: 1rem !important;

                border-radius: 1rem !important;
            }

            .announcement-card .card-body {
                width: 100% !important;
                max-width: 100% !important;

                padding: 1rem !important;
            }


            /* =====================================================
               ANNOUNCEMENT HEADER
               ===================================================== */

            .announcement-header {
                display: flex !important;

                flex-direction: column !important;

                align-items: stretch !important;

                justify-content: flex-start !important;

                gap: .75rem !important;
            }

            .announcement-title-area {
                width: 100% !important;
                max-width: 100% !important;
            }

            .announcement-title {
                font-size: 1.2rem;

                line-height: 1.4;
            }

            .announcement-meta {
                margin-top: .35rem;

                font-size: .78rem;

                line-height: 1.5;
            }

            .announcement-badge {
                align-self: flex-start;

                width: auto;

                max-width: 100%;

                font-size: .72rem;

                white-space: nowrap;
            }


            /* =====================================================
               DIVIDER
               ===================================================== */

            .announcement-card hr {
                margin-top: .9rem;
                margin-bottom: .9rem;
            }


            /* =====================================================
               MESSAGE
               ===================================================== */

            .announcement-message {
                font-size: .9rem;

                line-height: 1.65;

                margin-top: .75rem !important;
            }


            /* =====================================================
               ATTACHMENT
               ===================================================== */

            .announcement-attachment {
                width: 100% !important;

                display: block;

                text-align: center;

                padding-left: .75rem;
                padding-right: .75rem;
            }


            /* =====================================================
               EMPTY STATE
               ===================================================== */

            .announcement-empty {
                width: 100% !important;
                max-width: 100% !important;

                border-radius: 1rem !important;
            }

            .announcement-empty .card-body {
                padding:
                    3rem 1rem !important;
            }

            .announcement-empty i {
                font-size: 3.5rem !important;
            }

            .announcement-empty h4 {
                font-size: 1.2rem;

                line-height: 1.4;
            }

            .announcement-empty p {
                font-size: .9rem;

                line-height: 1.6;
            }


            /* =====================================================
               FOOTER
               ===================================================== */

            .admin-footer {
                width: 100% !important;
                max-width: 100% !important;

                overflow-x: hidden !important;
            }

            .admin-footer .container-fluid {
                width: 100% !important;
                max-width: 100% !important;

                display: flex !important;

                flex-direction: column !important;

                align-items: flex-start !important;

                gap: .65rem !important;

                padding:
                    1rem !important;
            }

            .admin-footer span {
                width: 100%;

                max-width: 100%;

                font-size: .8rem;

                line-height: 1.5;
            }

        }


        /* =========================================================
           SMALL PHONES
           576px AND BELOW
           ========================================================= */

        @media (max-width: 575.98px) {

            .announcement-container {
                padding: .75rem !important;
            }


            /* Navbar */

            .admin-navbar .container-fluid {
                padding-left: .65rem !important;
                padding-right: .65rem !important;
            }

            .sidebar-toggle {
                width: 40px;
                height: 40px;
            }

            .icon-button {
                width: 38px;
                height: 38px;

                padding: 0;
            }

            .profile-button {
                width: 40px;
                max-width: 40px;

                padding: 0 !important;
            }


            /* Header */

            .announcement-page-header h2 {
                font-size: 1.45rem;
            }

            .announcement-page-header p {
                font-size: .85rem;
            }


            /* Search */

            .announcement-search-wrapper input {
                font-size: .85rem;
            }


            /* Cards */

            .announcement-card .card-body {
                padding: .9rem !important;
            }

            .announcement-title {
                font-size: 1.1rem;
            }

            .announcement-message {
                font-size: .875rem;
            }

            .announcement-badge {
                font-size: .68rem;
            }


            /* Empty state */

            .announcement-empty .card-body {
                padding:
                    2.5rem .85rem !important;
            }

            .announcement-empty i {
                font-size: 3rem !important;
            }

            .announcement-empty h4 {
                font-size: 1.1rem;
            }

            .announcement-empty p {
                font-size: .82rem;
            }


            /* Footer */

            .admin-footer span {
                font-size: .75rem;
            }

        }


        /* =========================================================
           VERY SMALL PHONES
           380px AND BELOW
           ========================================================= */

        @media (max-width: 380px) {

            .announcement-container {
                padding: .6rem !important;
            }


            .admin-navbar .container-fluid {
                padding-left: .5rem !important;
                padding-right: .5rem !important;
            }


            .sidebar-toggle {
                width: 38px;
                height: 38px;
            }


            .icon-button {
                width: 36px;
                height: 36px;
            }


            .profile-button {
                width: 38px;
                max-width: 38px;
            }


            .announcement-page-header h2 {
                font-size: 1.3rem;
            }

            .announcement-page-header p {
                font-size: .8rem;
            }


            .announcement-search-wrapper input {
                font-size: .8rem;
            }


            .announcement-card {
                border-radius: .85rem !important;
            }

            .announcement-card .card-body {
                padding: .75rem !important;
            }


            .announcement-title {
                font-size: 1rem;
            }

            .announcement-meta {
                font-size: .72rem;
            }

            .announcement-message {
                font-size: .82rem;

                line-height: 1.6;
            }


            .announcement-badge {
                font-size: .62rem;
            }


            .announcement-attachment {
                font-size: .75rem;
            }


            .announcement-empty .card-body {
                padding:
                    2rem .65rem !important;
            }

            .announcement-empty i {
                font-size: 2.7rem !important;
            }

            .announcement-empty h4 {
                font-size: 1rem;
            }

            .announcement-empty p {
                font-size: .78rem;
            }

        }


        /* =========================================================
           EXTRA PROTECTION AGAINST HORIZONTAL OVERFLOW
           ========================================================= */

        .container,
        .container-fluid,
        .row,
        [class*="col-"] {
            min-width: 0;
        }

        .card,
        .card-body,
        .input-group {
            min-width: 0;
            max-width: 100%;
        }

        input,
        textarea,
        select,
        button {
            max-width: 100%;
        }

        a {
            overflow-wrap: anywhere;
        }

    </style>

</head>


<body>


<div class="admin-shell">


    <!-- =========================================================
         SIDEBAR BACKDROP
         ========================================================= -->

    <div class="sidebar-backdrop"
        data-sidebar-close>
    </div>


    <!-- =========================================================
         SIDEBAR
         ========================================================= -->

    <aside class="admin-sidebar"
        id="adminSidebar"
        aria-label="Main navigation">


        <!-- SIDEBAR HEADER -->

         <div class="sidebar-header">

            <a class="brand-mark"
               href="{{ route('dashboard') }}"
               aria-label="Admin Dashboard">

                <img src="../../../khen/assets/images/logo.jpg"
                     alt="Pap Pay Logo"
                     class="brand-logo">

            </a>

        </div>


        <!-- SIDEBAR NAVIGATION -->

        <nav class="sidebar-nav">


            <a class="nav-link"
                href="{{ route('dashboard') }}">

                <span class="nav-icon">

                    <i class="bi bi-house-door"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>


            <a class="nav-link"
                href="{{ route('attendance') }}">

                <span class="nav-icon">

                    <i class="bi bi-calendar-check"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Attendance
                </span>

            </a>


            <a class="nav-link"
                href="{{ route('file_leave') }}">

                <span class="nav-icon">

                    <i class="bi bi-calendar-plus"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    File Leave
                </span>

            </a>


            <a class="nav-link"
                href="{{ route('file_ob') }}">

                <span class="nav-icon">

                    <i class="bi bi-briefcase"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    File OB
                </span>

            </a>


            <a class="nav-link"
                href="{{ route('payslip') }}">

                <span class="nav-icon">

                    <i class="bi bi-receipt"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Payslip
                </span>

            </a>


            <a class="nav-link active"
                href="{{ route('employee.announcements') }}"
                aria-current="page">

                <span class="nav-icon">

                    <i class="bi bi-megaphone"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Announcements
                </span>

            </a>


            <a class="nav-link"
                href="{{ route('my_profile') }}">

                <span class="nav-icon">

                    <i class="bi bi-person"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    My Profile
                </span>

            </a>


        </nav>


        <!-- =====================================================
             SIDEBAR USER
             ===================================================== -->

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


        <!-- =====================================================
             SIDEBAR FOOTER
             ===================================================== -->

        <div class="sidebar-footer">

            <span class="status-dot"></span>

            <span class="sidebar-footer-text">
                System running smoothly
            </span>

        </div>


    </aside>


    <!-- =========================================================
         MAIN
         ========================================================= -->

    <div class="admin-main">


        <!-- =====================================================
             NAVBAR
             ===================================================== -->

        <nav class="navbar admin-navbar navbar-expand bg-white">


            <div class="container-fluid px-3 px-lg-4">


                <!-- SIDEBAR TOGGLE -->

                <button class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="false"
                    aria-label="Toggle sidebar">

                    <span></span>
                    <span></span>
                    <span></span>

                </button>


                <!-- NAVBAR SEARCH -->

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
                                aria-hidden="true">
                            </i>

                        </button>


                        <div class="dropdown-menu dropdown-menu-end notification-menu">


                            <div class="dropdown-header fw-bold text-body">
                                Notifications
                            </div>


                            <a class="dropdown-item"
                                href="{{ route('employee.announcements') }}">

                                <span class="notification-title">
                                    New announcement
                                </span>

                                <span class="notification-time">
                                    Recent
                                </span>

                            </a>


                            <a class="dropdown-item"
                                href="{{ route('attendance') }}">

                                <span class="notification-title">
                                    Attendance records
                                </span>

                                <span class="notification-time">
                                    View attendance
                                </span>

                            </a>


                            <a class="dropdown-item"
                                href="{{ route('payslip') }}">

                                <span class="notification-title">
                                    Payslip
                                </span>

                                <span class="notification-time">
                                    View payslips
                                </span>

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


        <!-- =====================================================
             PAGE CONTENT
             ===================================================== -->

        <main class="dashboard-content">


            <div class="container-fluid announcement-container px-3 px-lg-4 py-4">


                <!-- =================================================
                     PAGE HEADER
                     ================================================= -->

                <div class="announcement-page-header mb-4">


                    <h2 class="fw-bold mb-2">
                        Announcements
                    </h2>


                    <p class="text-muted mb-0">

                        Stay updated with the latest announcements
                        from the administrator.

                    </p>


                </div>


                <!-- =================================================
                     SEARCH
                     ================================================= -->

                <div class="row announcement-search-row mb-4">


                    <div class="col-12 col-lg-6 announcement-search-wrapper">


                        <div class="input-group shadow-sm">


                            <span class="input-group-text bg-white">

                                <i class="bi bi-search"></i>

                            </span>


                            <input type="text"
                                id="announcementSearch"
                                class="form-control"
                                placeholder="Search announcements..."
                                autocomplete="off">


                        </div>


                    </div>


                </div>


                <!-- =================================================
                     ANNOUNCEMENTS
                     ================================================= -->

                <div class="row">


                    <div class="col-12">


                        @forelse($announcements as $announcement)


                            <!-- ANNOUNCEMENT CARD -->

                            <div class="card shadow-sm border-0 rounded-4 mb-4 announcement-card">


                                <div class="card-body">


                                    <!-- HEADER -->

                                    <div class="announcement-header">


                                        <div class="announcement-title-area">


                                            <h4 class="fw-bold announcement-title">


                                                <span class="announcement-title-icon">

                                                    <i class="bi bi-megaphone-fill text-primary me-1"></i>

                                                </span>


                                                {{ $announcement->title }}


                                            </h4>


                                            <small class="text-muted announcement-meta">


                                                Administrator


                                                <span class="mx-1">
                                                    •
                                                </span>


                                                {{ $announcement->created_at->diffForHumans() }}


                                            </small>


                                        </div>


                                        <span class="badge bg-primary announcement-badge">

                                            Announcement

                                        </span>


                                    </div>


                                    <hr>


                                    <!-- MESSAGE -->

                                    <p class="announcement-message">

                                        {{ $announcement->message }}

                                    </p>


                                    <!-- ATTACHMENT -->

                                    @if ($announcement->attachment)

                                        <a href="{{ asset('storage/' . $announcement->attachment) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-outline-primary btn-sm announcement-attachment">

                                            <i class="bi bi-paperclip me-1"></i>

                                            View Attachment

                                        </a>

                                    @endif


                                </div>


                            </div>


                        @empty


                            <!-- EMPTY STATE -->

                            <div class="card shadow-sm rounded-4 border-0 announcement-empty">


                                <div class="card-body text-center py-5">


                                    <i class="bi bi-megaphone display-2 text-secondary"></i>


                                    <h4 class="mt-4">

                                        No Announcements

                                    </h4>


                                    <p class="text-muted mb-0">

                                        There are no announcements
                                        from the administrator.

                                    </p>


                                </div>


                            </div>


                        @endforelse


                        <!-- NO SEARCH RESULTS -->

                        @if ($announcements->count() > 0)

                            <div id="noSearchResults"
                                class="card shadow-sm rounded-4 border-0"
                                style="display:none;">


                                <div class="card-body text-center py-5">


                                    <i class="bi bi-search display-5 text-secondary"></i>


                                    <h5 class="mt-3">

                                        No matching announcements

                                    </h5>


                                    <p class="text-muted mb-0">

                                        Try a different search term.

                                    </p>


                                </div>


                            </div>

                        @endif


                    </div>


                </div>


            </div>


        </main>


        <!-- =====================================================
             FOOTER
             ===================================================== -->

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

                    •

                    Distributed by

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

                    Responsive announcement system.

                </span>


            </div>


        </footer>


    </div>

</div>


<!-- =========================================================
     BOOTSTRAP
     ========================================================= -->

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

<script src="../../../../khen/assets/js/main.js"></script>


<!-- =========================================================
     RESPONSIVE SIDEBAR + SEARCH
     ========================================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | SIDEBAR
    |--------------------------------------------------------------------------
    */

    const sidebarToggle =
        document.querySelector('[data-sidebar-toggle]');

    const sidebar =
        document.getElementById('adminSidebar');

    const backdrop =
        document.querySelector('[data-sidebar-close]');

    const shell =
        document.querySelector('.admin-shell');


    function isMobile() {

        return window.innerWidth <= 767.98;

    }


    function openMobileSidebar() {

        if (!sidebar || !isMobile()) {
            return;
        }

        document.body.classList.add('sidebar-open');

        if (shell) {
            shell.classList.add('sidebar-open');
        }

        sidebar.classList.add('is-open');

        if (backdrop) {
            backdrop.classList.add('is-visible');
        }

        if (sidebarToggle) {
            sidebarToggle.setAttribute(
                'aria-expanded',
                'true'
            );
        }

    }


    function closeMobileSidebar() {

        document.body.classList.remove('sidebar-open');

        if (shell) {
            shell.classList.remove('sidebar-open');
        }

        if (sidebar) {
            sidebar.classList.remove('is-open');
        }

        if (backdrop) {
            backdrop.classList.remove('is-visible');
        }

        if (sidebarToggle) {
            sidebarToggle.setAttribute(
                'aria-expanded',
                'false'
            );
        }

    }


    if (sidebarToggle) {

        sidebarToggle.addEventListener(
            'click',
            function (event) {

                if (!isMobile()) {
                    return;
                }

                event.preventDefault();
                event.stopPropagation();

                if (
                    document.body.classList.contains(
                        'sidebar-open'
                    )
                ) {

                    closeMobileSidebar();

                } else {

                    openMobileSidebar();

                }

            },
            true
        );

    }


    if (backdrop) {

        backdrop.addEventListener(
            'click',
            function () {

                if (isMobile()) {
                    closeMobileSidebar();
                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE SIDEBAR WHEN NAVIGATION LINK IS CLICKED
    |--------------------------------------------------------------------------
    */

    if (sidebar) {

        sidebar.querySelectorAll('.nav-link')
            .forEach(function (link) {

                link.addEventListener(
                    'click',
                    function () {

                        if (isMobile()) {
                            closeMobileSidebar();
                        }

                    }
                );

            });

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE SIDEBAR WHEN SCREEN BECOMES DESKTOP
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        'resize',
        function () {

            if (!isMobile()) {
                closeMobileSidebar();
            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ANNOUNCEMENT SEARCH
    |--------------------------------------------------------------------------
    */

    const search =
        document.getElementById(
            'announcementSearch'
        );

    const cards =
        document.querySelectorAll(
            '.announcement-card'
        );

    const noResults =
        document.getElementById(
            'noSearchResults'
        );


    if (search) {

        search.addEventListener(
            'input',
            function () {

                const value =
                    this.value
                        .trim()
                        .toLowerCase();

                let visibleCards = 0;


                cards.forEach(
                    function (card) {

                        const text =
                            card.innerText
                                .toLowerCase();


                        if (
                            value === '' ||
                            text.includes(value)
                        ) {

                            card.style.display = '';

                            visibleCards++;

                        } else {

                            card.style.display = 'none';

                        }

                    }
                );


                if (noResults) {

                    if (
                        value !== '' &&
                        visibleCards === 0
                    ) {

                        noResults.style.display = '';

                    } else {

                        noResults.style.display = 'none';

                    }

                }

            }
        );

    }

});

</script>


</body>

</html>
