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

    <title>Official Business | adminHMD</title>


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
         RESPONSIVE OFFICIAL BUSINESS PAGE
         ========================================================= -->

    <style>

        /* ========================================================
           GLOBAL RESPONSIVE SAFETY
           ======================================================== */

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


        /* ========================================================
           MAIN ADMIN LAYOUT
           ======================================================== */

        .admin-shell {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

        /*
         * Desktop sidebar is 280px.
         * The main content must occupy only the remaining width.
         */
        .admin-main {
            width: calc(100% - var(--sidebar-width)) !important;
            max-width: calc(100% - var(--sidebar-width)) !important;
            min-width: 0 !important;
            margin-left: var(--sidebar-width);
            overflow-x: hidden;
        }


        /*
         * Sidebar mini mode.
         */
        body.sidebar-mini .admin-main {
            width: calc(100% - var(--sidebar-mini-width)) !important;
            max-width: calc(100% - var(--sidebar-mini-width)) !important;
            margin-left: var(--sidebar-mini-width);
        }


        /* ========================================================
           NAVBAR
           ======================================================== */

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

        .navbar-actions {
            min-width: 0;
            flex-shrink: 0;
        }

        .search-input {
            min-width: 0;
            width: 100%;
        }


        /* ========================================================
           MAIN CONTENT
           ======================================================== */

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


        /* ========================================================
           PAGE HEADING
           ======================================================== */

        .page-heading {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .page-heading-copy {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .page-heading h1,
        .page-heading p {
            max-width: 100%;
            overflow-wrap: anywhere;
        }


        /* ========================================================
           METRIC CARDS

           Desktop:
           4 cards

           Tablet:
           2 cards per row

           Mobile:
           1 card per row
           ======================================================== */

        .ob-metrics {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .ob-metrics > [class*="col-"] {
            min-width: 0;
        }

        .ob-metrics .metric-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            height: 100%;
        }

        .ob-metrics .metric-top {
            min-width: 0;
            max-width: 100%;
        }

        .ob-metrics .metric-label,
        .ob-metrics .metric-meta {
            min-width: 0;
            max-width: 100%;
            overflow-wrap: anywhere;
        }

        .ob-metrics .metric-icon {
            flex-shrink: 0;
        }


        /* ========================================================
           PANELS
           ======================================================== */

        .ob-panel {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .ob-panel .panel-header,
        .ob-panel .panel-body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }


        /* ========================================================
           FORMS
           ======================================================== */

        .ob-form {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .ob-form .row {
            width: auto;
            max-width: 100%;
            min-width: 0;
        }

        .ob-form .row > [class*="col-"] {
            min-width: 0;
        }

        .ob-form .form-control,
        .ob-form .form-select,
        .ob-form textarea {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .ob-form textarea {
            resize: vertical;
        }


        /* ========================================================
           TIME INPUTS
           ======================================================== */

        .time-field {
            width: 100%;
            min-width: 0;
        }


        /* ========================================================
           SEARCH/FILTER AREA
           ======================================================== */

        .ob-filter-form {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .ob-filter-form .row {
            width: auto;
            max-width: 100%;
            min-width: 0;
        }

        .ob-filter-form .row > [class*="col-"] {
            min-width: 0;
        }

        .ob-filter-form .form-control,
        .ob-filter-form .form-select,
        .ob-filter-form button {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }


        /* ========================================================
           BUTTONS
           ======================================================== */

        .ob-form-actions {
            width: 100%;
            max-width: 100%;
        }


        /* ========================================================
           TABLE

           Only the table scrolls horizontally.
           The page itself NEVER becomes horizontally scrollable.
           ======================================================== */

        .ob-table-wrapper {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .ob-table {
            width: 100%;
            min-width: 1050px;
            margin-bottom: 0;
        }

        .ob-table th,
        .ob-table td {
            white-space: nowrap;
            vertical-align: middle;
        }

        .ob-table td.purpose-cell {
            white-space: normal;
            min-width: 220px;
            max-width: 350px;
            overflow-wrap: anywhere;
        }

        .ob-table td.destination-cell {
            white-space: normal;
            min-width: 160px;
            max-width: 250px;
            overflow-wrap: anywhere;
        }


        /* ========================================================
           FOOTER
           ======================================================== */

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


        /* ========================================================
           TABLET
           <= 991.98px

           Sidebar becomes off-canvas.
           Main content uses complete viewport width.
           ======================================================== */

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

            /*
             * Metric cards become 2 columns.
             */
            .ob-metrics > .col-xl-3 {
                width: 50%;
            }

        }


        /* ========================================================
           SMALL TABLET / LARGE PHONE
           <= 767.98px
           ======================================================== */

        @media (max-width: 767.98px) {

            .dashboard-content > .container-fluid {
                padding-left: 0.85rem !important;
                padding-right: 0.85rem !important;
            }


            /*
             * Navbar
             */

            .admin-navbar .container-fluid {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }

            .navbar-actions {
                gap: 0.35rem;
            }


            /*
             * Metric cards become one column.
             */

            .ob-metrics > .col-12,
            .ob-metrics > .col-sm-6,
            .ob-metrics > .col-xl-3 {
                width: 100%;
            }


            /*
             * Form action buttons.
             */

            .ob-form-actions {
                flex-direction: column !important;
                align-items: stretch !important;
            }

            .ob-form-actions .btn {
                width: 100%;
            }


            /*
             * Filter buttons.
             */

            .ob-filter-form button {
                width: 100%;
            }


            /*
             * Panel spacing.
             */

            .ob-panel .panel-body {
                padding-left: 1rem;
                padding-right: 1rem;
            }

        }


        /* ========================================================
           MOBILE
           <= 575.98px
           ======================================================== */

        @media (max-width: 575.98px) {

            .dashboard-content > .container-fluid {
                padding-left: 0.65rem !important;
                padding-right: 0.65rem !important;
            }


            /*
             * Page heading.
             */

            .page-heading h1 {
                font-size: 1.55rem;
                line-height: 1.25;
            }

            .page-heading p {
                font-size: 0.9rem;
            }


            /*
             * Cards.
             */

            .ob-metrics {
                --bs-gutter-x: 0.75rem;
                --bs-gutter-y: 0.75rem;
            }

            .ob-metrics .metric-card {
                min-height: 140px;
            }


            /*
             * Panels.
             */

            .ob-panel {
                border-radius: 0.75rem;
            }

            .ob-panel .panel-header {
                padding: 1rem;
            }

            .ob-panel .panel-body {
                padding: 1rem;
            }


            /*
             * Navbar profile name stays hidden.
             */

            .profile-name {
                display: none !important;
            }


            /*
             * Form labels.
             */

            .ob-form .form-label {
                font-size: 0.9rem;
            }


            /*
             * Table.
             */

            .ob-table {
                min-width: 1000px;
            }

        }


        /* ========================================================
           VERY SMALL PHONES
           <= 380px
           ======================================================== */

        @media (max-width: 380px) {

            .dashboard-content > .container-fluid {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .admin-navbar .container-fluid {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .ob-panel .panel-header,
            .ob-panel .panel-body {
                padding-left: 0.8rem;
                padding-right: 0.8rem;
            }

            .ob-metrics .metric-card {
                padding: 1rem;
                min-height: 130px;
            }

            .ob-metrics .metric-value {
                font-size: 1.8rem;
            }

        }


        /* ========================================================
           PRINT
           ======================================================== */

        @media print {

            .admin-sidebar,
            .admin-navbar,
            .sidebar-backdrop,
            .admin-footer,
            .ob-form,
            .ob-filter-form,
            .ob-form-actions {
                display: none !important;
            }

            .admin-main {
                width: 100% !important;
                max-width: 100% !important;
                margin-left: 0 !important;
            }

            .dashboard-content > .container-fluid {
                padding: 0 !important;
            }

            .ob-table-wrapper {
                overflow: visible;
            }

            .ob-table {
                min-width: 0;
            }

        }

    </style>

</head>


<body>

    <div class="admin-shell">


        <!-- =====================================================
             SIDEBAR BACKDROP
             ===================================================== -->

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


                <a class="nav-link"
                    href="{{ route('file_leave') }}">

                    <span class="nav-icon">

                        <i class="bi bi-calendar-plus"
                            aria-hidden="true"></i>

                    </span>

                    <span class="nav-text">
                        File Leave
                    </span>

                </a>


                <a class="nav-link active"
                    href="{{ route('file_ob') }}"
                    aria-current="page">

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

                                <span class="notification-dot"></span>

                                <i class="bi bi-bell"
                                    aria-hidden="true"></i>

                            </button>


                            <div class="dropdown-menu dropdown-menu-end notification-menu">

                                <div class="dropdown-header fw-bold text-body">

                                    Notifications

                                </div>


                                <a class="dropdown-item"
                                    href="#">

                                    <span class="notification-title">

                                        New user registered

                                    </span>

                                    <span class="notification-time">

                                        4 minutes ago

                                    </span>

                                </a>


                                <a class="dropdown-item"
                                    href="#">

                                    <span class="notification-title">

                                        Revenue target reached

                                    </span>

                                    <span class="notification-time">

                                        32 minutes ago

                                    </span>

                                </a>


                                <a class="dropdown-item"
                                    href="#">

                                    <span class="notification-title">

                                        Security review completed

                                    </span>

                                    <span class="notification-time">

                                        1 hour ago

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


            <!-- =================================================
                 MAIN CONTENT
                 ================================================= -->

            <main class="dashboard-content">


                <div class="container-fluid px-3 px-lg-4 py-4">


                    <!-- =================================================
                         PAGE HEADER
                         ================================================= -->

                    <div class="page-heading">

                        <div class="page-heading-copy">

                            <div>

                                <h1 class="h3 mb-1">

                                    Official Business

                                </h1>


                                <p class="text-muted mb-0">

                                    Submit and monitor your Official Business requests.

                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         SUMMARY CARDS
                         ================================================= -->

                    <section class="row g-3 mt-3 ob-metrics">


                        <!-- PENDING -->

                        <div class="col-12 col-sm-6 col-xl-3">

                            <article class="metric-card metric-warning h-100">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Pending

                                    </span>


                                    <span class="metric-icon">

                                        <i class="bi bi-hourglass-split"></i>

                                    </span>

                                </div>


                                <div class="metric-value">

                                    {{ $pendingOB }}

                                </div>


                                <div class="metric-meta">

                                    Pending Requests

                                </div>

                            </article>

                        </div>


                        <!-- APPROVED -->

                        <div class="col-12 col-sm-6 col-xl-3">

                            <article class="metric-card metric-success h-100">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Approved

                                    </span>


                                    <span class="metric-icon">

                                        <i class="bi bi-check-circle-fill"></i>

                                    </span>

                                </div>


                                <div class="metric-value">

                                    {{ $approvedOB }}

                                </div>


                                <div class="metric-meta">

                                    Approved Requests

                                </div>

                            </article>

                        </div>


                        <!-- REJECTED -->

                        <div class="col-12 col-sm-6 col-xl-3">

                            <article class="metric-card metric-danger h-100">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Rejected

                                    </span>


                                    <span class="metric-icon">

                                        <i class="bi bi-x-circle-fill"></i>

                                    </span>

                                </div>


                                <div class="metric-value">

                                    {{ $rejectedOB }}

                                </div>


                                <div class="metric-meta">

                                    Rejected Requests

                                </div>

                            </article>

                        </div>


                        <!-- TOTAL -->

                        <div class="col-12 col-sm-6 col-xl-3">

                            <article class="metric-card metric-primary h-100">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Total OB

                                    </span>


                                    <span class="metric-icon">

                                        <i class="bi bi-briefcase-fill"></i>

                                    </span>

                                </div>


                                <div class="metric-value">

                                    {{ $totalOB }}

                                </div>


                                <div class="metric-meta">

                                    Total Requests

                                </div>

                            </article>

                        </div>

                    </section>


                    <!-- =================================================
                         OFFICIAL BUSINESS FORM
                         ================================================= -->

                    <section class="panel mt-4 ob-panel">


                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1">

                                    File Official Business

                                </h2>


                                <p class="text-muted mb-0">

                                    Complete the information below.

                                </p>

                            </div>

                        </div>


                        <div class="panel-body">


                            <!-- SUCCESS -->

                            @if (session('success'))

                                <div class="alert alert-success">

                                    {{ session('success') }}

                                </div>

                            @endif


                            <!-- ERRORS -->

                            @if ($errors->any())

                                <div class="alert alert-danger">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $error)

                                            <li>
                                                {{ $error }}
                                            </li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif


                            <!-- FORM -->

                            <form action="{{ route('file_ob.store') }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="ob-form">

                                @csrf


                                <div class="row g-3">


                                    <!-- PURPOSE -->

                                    <div class="col-12">

                                        <label class="form-label">

                                            Purpose

                                        </label>


                                        <textarea name="purpose"
                                            class="form-control"
                                            rows="3"
                                            required>{{ old('purpose') }}</textarea>

                                    </div>


                                    <!-- DESTINATION -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Destination

                                        </label>


                                        <input type="text"
                                            name="destination"
                                            class="form-control"
                                            value="{{ old('destination') }}"
                                            required>

                                    </div>


                                    <!-- DATE -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Date

                                        </label>


                                        <input type="date"
                                            name="ob_date"
                                            class="form-control"
                                            min="{{ now()->toDateString() }}"
                                            required>

                                    </div>


                                    <!-- MORNING TIME IN -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Morning Time In

                                        </label>


                                        <input type="time"
                                            name="morning_time_in"
                                            class="form-control time-field">

                                    </div>


                                    <!-- MORNING TIME OUT -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Morning Time Out

                                        </label>


                                        <input type="time"
                                            name="morning_time_out"
                                            class="form-control time-field">

                                    </div>


                                    <!-- AFTERNOON TIME IN -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Afternoon Time In

                                        </label>


                                        <input type="time"
                                            name="afternoon_time_in"
                                            class="form-control time-field">

                                    </div>


                                    <!-- AFTERNOON TIME OUT -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Afternoon Time Out

                                        </label>


                                        <input type="time"
                                            name="afternoon_time_out"
                                            class="form-control time-field">

                                    </div>


                                    <!-- ATTACHMENT -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Attachment

                                        </label>


                                        <input type="file"
                                            name="proof_images[]"
                                            class="form-control"
                                            multiple
                                            accept=".jpg,.jpeg,.png">

                                    </div>


                                    <!-- ACTIONS -->

                                    <div class="col-12">

                                        <div class="ob-form-actions d-flex flex-column flex-sm-row gap-2 justify-content-end">


                                            <button type="reset"
                                                class="btn btn-outline-secondary">

                                                Reset

                                            </button>


                                            <button type="submit"
                                                class="btn btn-primary">

                                                <i class="bi bi-send-fill me-1"></i>

                                                Submit Request

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </section>


                    <!-- =================================================
                         SEARCH / FILTER
                         ================================================= -->

                    <section class="panel mt-4 ob-panel">


                        <div class="panel-body">


                            <form method="GET"
                                class="ob-filter-form">


                                <div class="row g-3">


                                    <!-- SEARCH -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label d-md-none">

                                            Search

                                        </label>


                                        <input type="text"
                                            name="search"
                                            class="form-control"
                                            placeholder="Search purpose or destination..."
                                            value="{{ request('search') }}">

                                    </div>


                                    <!-- STATUS -->

                                    <div class="col-12 col-md-3">

                                        <label class="form-label d-md-none">

                                            Status

                                        </label>


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


                                    <!-- SEARCH BUTTON -->

                                    <div class="col-12 col-md-3 d-flex">

                                        <button type="submit"
                                            class="btn btn-primary w-100">

                                            <i class="bi bi-search me-1"></i>

                                            Search

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>


                        <!-- HISTORY HEADER -->

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1">

                                    Official Business History

                                </h2>


                                <p class="text-muted mb-0">

                                    All your submitted OB requests

                                </p>

                            </div>

                        </div>


                        <!-- HISTORY TABLE -->

                        <div class="panel-body">


                            <div class="ob-table-wrapper">


                                <table class="table align-middle table-hover ob-table">


                                    <thead>

                                        <tr>

                                            <th>
                                                Date
                                            </th>

                                            <th>
                                                Destination
                                            </th>

                                            <th>
                                                Purpose
                                            </th>

                                            <th>
                                                Time
                                            </th>

                                            <th>
                                                Attendance Period
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                            <th>
                                                Proof
                                            </th>

                                            <th>
                                                Action
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                        @forelse($officialBusinesses ?? [] as $ob)

                                            <tr>


                                                <!-- DATE -->

                                                <td>

                                                    {{ \Carbon\Carbon::parse($ob->ob_date)->format('M d, Y') }}

                                                </td>


                                                <!-- DESTINATION -->

                                                <td class="destination-cell">

                                                    {{ $ob->destination }}

                                                </td>


                                                <!-- PURPOSE -->

                                                <td class="purpose-cell">

                                                    {{ $ob->purpose }}

                                                </td>


                                                <!-- TIME -->

                                                <td>

                                                    @if ($ob->departure_time && $ob->expected_return_time)

                                                        {{ \Carbon\Carbon::parse($ob->departure_time)->format('h:i A') }}

                                                        -

                                                        {{ \Carbon\Carbon::parse($ob->expected_return_time)->format('h:i A') }}

                                                    @else

                                                        <span class="text-muted">

                                                            Not specified

                                                        </span>

                                                    @endif

                                                </td>


                                                <!-- ATTENDANCE PERIOD -->

                                                <td>

                                                    @switch($ob->attendance_period)

                                                        @case('morning')

                                                            <span class="badge bg-info">

                                                                Morning

                                                            </span>

                                                        @break


                                                        @case('afternoon')

                                                            <span class="badge bg-warning text-dark">

                                                                Afternoon

                                                            </span>

                                                        @break


                                                        @case('whole_day')

                                                            <span class="badge bg-success">

                                                                Whole Day

                                                            </span>

                                                        @break


                                                        @default

                                                            <span class="text-muted">

                                                                --

                                                            </span>

                                                    @endswitch

                                                </td>


                                                <!-- STATUS -->

                                                <td>

                                                    @if ($ob->status == 'Pending')

                                                        <span class="badge bg-warning text-dark">

                                                            Pending

                                                        </span>

                                                    @elseif ($ob->status == 'Approved')

                                                        <span class="badge bg-success">

                                                            Approved

                                                        </span>

                                                    @elseif ($ob->status == 'Rejected')

                                                        <span class="badge bg-danger">

                                                            Rejected

                                                        </span>

                                                    @else

                                                        <span class="badge bg-secondary">

                                                            Unknown

                                                        </span>

                                                    @endif

                                                </td>


                                                <!-- PROOF -->

                                                <td>

                                                    @if ($ob->proof_images)

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary">

                                                            View

                                                        </button>

                                                    @else

                                                        <span class="text-muted">

                                                            None

                                                        </span>

                                                    @endif

                                                </td>


                                                <!-- ACTION -->

                                                <td>

                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-primary">

                                                        View

                                                    </button>

                                                </td>

                                            </tr>


                                        @empty

                                            <tr>

                                                <td colspan="8"
                                                    class="text-center py-5">


                                                    <i class="bi bi-inbox fs-1 text-muted"></i>


                                                    <h5 class="mt-3">

                                                        No Official Business found

                                                    </h5>


                                                    <p class="text-muted">

                                                        Your OB requests will appear here after submission

                                                    </p>

                                                </td>

                                            </tr>

                                        @endforelse


                                    </tbody>

                                </table>

                            </div>


                            <!-- PAGINATION -->

                            <div class="mt-3">

                                {{ $officialBusinesses->links() }}

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

                        Analytics chart examples.

                    </span>

                </div>

            </footer>


        </div>

    </div>


    <!-- =========================================================
         BOOTSTRAP
         ========================================================= -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>


    <!-- =========================================================
         MAIN TEMPLATE JS
         ========================================================= -->

    <script src="../../../../khen/assets/js/main.js"></script>


</body>

</html>
