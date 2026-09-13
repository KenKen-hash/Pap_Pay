@php
    $employee = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Profile | PAP Pay</title>


     <link rel="icon" type="image/x-icon" href="../../../../khen/assets/images/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('khen/assets/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('khen/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Main Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('khen/assets/css/style.css') }}">

    <style>
        /* =========================================================
           PROFILE PAGE RESPONSIVE FIX
           ========================================================= */

        html,
        body {
            width: 100%;
            min-width: 0;
            margin: 0;
            padding: 0;
        }

        body {
            overflow-x: hidden;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
        }

        /* ---------------------------------------------------------
           APPLICATION SHELL
           --------------------------------------------------------- */

        .admin-shell {
            width: 100%;
            min-width: 0;
        }

        .admin-main {
            min-width: 0;
            width: 100%;
        }

        .dashboard-content {
            width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

        /* ---------------------------------------------------------
           NAVBAR
           --------------------------------------------------------- */

        .admin-navbar {
            width: 100%;
            min-width: 0;
            position: relative;
            z-index: 1000;
        }

        .admin-navbar .container-fluid {
            width: 100%;
            min-width: 0;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: .5rem;
            flex-shrink: 0;
        }

        .profile-button {
            min-width: 0;
        }

        .profile-button .profile-name {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Keep Bootstrap dropdown behavior normal */
        .admin-navbar .dropdown {
            position: relative;
        }

        .admin-navbar .dropdown-menu {
            min-width: 180px;
            max-width: calc(100vw - 20px);
            z-index: 2000;
        }

        .admin-navbar .notification-menu {
            width: 320px;
            max-width: calc(100vw - 20px);
        }

        .admin-navbar .dropdown-item {
            white-space: normal;
            overflow-wrap: break-word;
        }

        /* ---------------------------------------------------------
           PAGE CONTAINER
           --------------------------------------------------------- */

        .profile-page-container {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .profile-content-row {
            width: 100%;
            min-width: 0;
        }

        .profile-content-row > [class*="col-"] {
            min-width: 0;
        }

        /* ---------------------------------------------------------
           PAGE HEADING
           --------------------------------------------------------- */

        .profile-page-heading {
            width: 100%;
            min-width: 0;
        }

        .profile-page-heading-copy {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            min-width: 0;
        }

        .profile-page-heading-copy > div {
            min-width: 0;
        }

        .profile-page-heading h1,
        .profile-page-heading p {
            overflow-wrap: break-word;
            word-break: normal;
        }

        .profile-page-heading p {
            max-width: 100%;
        }

        /* ---------------------------------------------------------
           PROFILE CARD
           --------------------------------------------------------- */

        .profile-card {
            width: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .profile-cover {
            width: 100%;
            overflow: hidden;
        }

        .profile-cover img {
            display: block;
            width: 100%;
            height: 220px;
            object-fit: cover;
            object-position: center;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            max-width: 120px;
            object-fit: cover;
        }

        .profile-card h2,
        .profile-card p {
            overflow-wrap: break-word;
            word-break: normal;
        }

        .profile-card .badge {
            max-width: 100%;
            white-space: normal;
            overflow-wrap: break-word;
        }

        .profile-card .info-list {
            width: 100%;
            min-width: 0;
        }

        .profile-card .info-list > div {
            min-width: 0;
        }

        .profile-card .info-list strong {
            display: block;
            max-width: 100%;
            overflow-wrap: break-word;
            word-break: normal;
            white-space: normal;
        }

        /* ---------------------------------------------------------
           EDIT FORM
           --------------------------------------------------------- */

        .profile-edit-form {
            width: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .profile-edit-form .panel-header {
            width: 100%;
            min-width: 0;
        }

        .profile-form-body {
            width: 100%;
            min-width: 0;
        }

        .profile-form-body > [class*="col-"] {
            min-width: 0;
        }

        .profile-edit-form .form-control,
        .profile-edit-form .form-select {
            width: 100%;
            min-width: 0;
            max-width: 100%;
        }

        .profile-edit-form textarea {
            width: 100%;
            max-width: 100%;
            resize: vertical;
        }

        .profile-edit-form .form-label {
            display: block;
            max-width: 100%;
            overflow-wrap: break-word;
        }

        .profile-edit-form small {
            display: block;
            max-width: 100%;
            overflow-wrap: break-word;
        }

        /* ---------------------------------------------------------
           BUTTON
           --------------------------------------------------------- */

        .profile-save-button {
            min-width: 140px;
        }

        /* ---------------------------------------------------------
           FOOTER
           --------------------------------------------------------- */

        .admin-footer {
            width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

        .admin-footer .container-fluid {
            width: 100%;
            min-width: 0;
        }

        .admin-footer span {
            overflow-wrap: break-word;
        }

        /* =========================================================
           TABLET
           ========================================================= */

        @media (max-width: 1199.98px) {

            .profile-cover img {
                height: 200px;
            }

            .profile-photo {
                width: 110px;
                height: 110px;
                max-width: 110px;
            }
        }

        /* =========================================================
           TABLET / SMALL LAPTOP
           ========================================================= */

        @media (max-width: 991.98px) {

            .profile-content-row {
                --bs-gutter-x: 1rem;
                --bs-gutter-y: 1rem;
            }

            .profile-cover img {
                height: 210px;
            }

            .profile-page-container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .profile-edit-form .profile-form-body {
                padding: 1rem !important;
            }

            .admin-navbar .container-fluid {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }

        /* =========================================================
           MOBILE
           ========================================================= */

        @media (max-width: 767.98px) {

            html,
            body {
                width: 100%;
                max-width: 100%;
                overflow-x: hidden;
            }

            .admin-shell,
            .admin-main,
            .dashboard-content {
                width: 100%;
                max-width: 100%;
                min-width: 0;
            }

            /* -----------------------------------------------------
               NAVBAR
               ----------------------------------------------------- */

            .admin-navbar .container-fluid {
                padding-left: .75rem !important;
                padding-right: .75rem !important;
            }

            .navbar-actions {
                gap: .3rem;
            }

            .admin-navbar .icon-button {
                flex-shrink: 0;
            }

            .profile-button {
                flex-shrink: 0;
            }

            .profile-button .profile-name {
                display: none !important;
            }

            /*
             * Do not force dropdowns to display.
             * Bootstrap controls visibility with .show.
             */

            .admin-navbar .dropdown-menu {
                position: absolute;
                right: 0;
                left: auto;
                min-width: 180px;
                width: auto;
                max-width: calc(100vw - 16px);
            }

            .admin-navbar .notification-menu {
                width: 290px;
                max-width: calc(100vw - 16px);
            }

            /* -----------------------------------------------------
               PAGE
               ----------------------------------------------------- */

            .profile-page-container {
                padding: 1rem !important;
            }

            .profile-page-heading {
                margin-bottom: 1rem;
            }

            .profile-page-heading-copy {
                gap: .75rem;
            }

            .profile-page-heading h1 {
                font-size: 1.5rem;
                line-height: 1.2;
            }

            .profile-page-heading p {
                font-size: .875rem;
                line-height: 1.5;
            }

            .profile-page-heading .page-icon {
                flex: 0 0 auto;
            }

            /* -----------------------------------------------------
               PROFILE CARD
               ----------------------------------------------------- */

            .profile-card {
                height: auto !important;
            }

            .profile-cover img {
                height: 200px;
            }

            .profile-photo {
                width: 100px;
                height: 100px;
                max-width: 100px;
            }

            .profile-card h2 {
                font-size: 1.2rem;
            }

            .profile-card p {
                font-size: .9rem;
            }

            .profile-card .info-list {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .profile-card .info-list > div {
                margin-bottom: 1rem !important;
            }

            .profile-card .info-list strong {
                font-size: .9rem;
                line-height: 1.45;
            }

            /* -----------------------------------------------------
               FORM
               ----------------------------------------------------- */

            .profile-edit-form {
                height: auto !important;
            }

            .profile-edit-form .panel-header {
                padding: 1rem !important;
            }

            .profile-edit-form .panel-header h4 {
                font-size: 1.1rem;
            }

            .profile-edit-form .profile-form-body {
                padding: 1rem !important;
            }

            .profile-edit-form .form-label {
                font-size: .875rem;
                margin-bottom: .4rem;
            }

            .profile-edit-form .form-control,
            .profile-edit-form .form-select {
                min-height: 44px;
                font-size: .9rem;
            }

            .profile-edit-form textarea {
                min-height: 100px;
            }

            .profile-save-button {
                width: 100%;
                min-height: 44px;
            }

            /* -----------------------------------------------------
               FOOTER
               ----------------------------------------------------- */

            .admin-footer .container-fluid {
                padding: 1rem !important;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: .5rem;
            }

            .admin-footer span {
                width: 100%;
                font-size: .8rem;
                line-height: 1.5;
            }
        }

        /* =========================================================
           SMALL PHONE
           ========================================================= */

        @media (max-width: 575.98px) {

            .admin-navbar .container-fluid {
                padding-left: .6rem !important;
                padding-right: .6rem !important;
            }

            .navbar-actions {
                gap: .2rem;
            }

            .profile-page-container {
                padding: .75rem !important;
            }

            .profile-page-heading-copy {
                gap: .6rem;
            }

            .profile-page-heading h1 {
                font-size: 1.35rem;
            }

            .profile-page-heading p {
                font-size: .82rem;
            }

            .profile-cover img {
                height: 170px;
            }

            .profile-photo {
                width: 88px;
                height: 88px;
                max-width: 88px;
            }

            .profile-card h2 {
                font-size: 1.1rem;
            }

            .profile-card p {
                font-size: .82rem;
            }

            .profile-card .info-list {
                padding-left: .85rem;
                padding-right: .85rem;
            }

            .profile-card .info-list strong {
                font-size: .85rem;
            }

            .profile-edit-form .panel-header {
                padding: .9rem !important;
            }

            .profile-edit-form .profile-form-body {
                padding: .9rem !important;
            }

            .profile-edit-form .form-control,
            .profile-edit-form .form-select {
                min-height: 42px;
                font-size: .85rem;
            }

            .profile-edit-form textarea {
                font-size: .85rem;
            }

            .admin-footer .container-fluid {
                padding: .75rem !important;
            }

            .admin-footer span {
                font-size: .75rem;
            }
        }

        /* =========================================================
           VERY SMALL PHONE
           ========================================================= */

        @media (max-width: 380px) {

            .admin-navbar .container-fluid {
                padding-left: .45rem !important;
                padding-right: .45rem !important;
            }

            .profile-page-container {
                padding: .6rem !important;
            }

            .profile-page-heading-copy {
                gap: .5rem;
            }

            .profile-page-heading h1 {
                font-size: 1.2rem;
            }

            .profile-page-heading p {
                font-size: .78rem;
            }

            .profile-cover img {
                height: 150px;
            }

            .profile-photo {
                width: 78px;
                height: 78px;
                max-width: 78px;
            }

            .profile-card h2 {
                font-size: 1rem;
            }

            .profile-card p {
                font-size: .78rem;
            }

            .profile-card .badge {
                font-size: .65rem;
                padding: .3rem .45rem;
            }

            .profile-card .info-list {
                padding-left: .7rem;
                padding-right: .7rem;
            }

            .profile-card .info-list strong {
                font-size: .8rem;
            }

            .profile-edit-form .panel-header {
                padding: .75rem !important;
            }

            .profile-edit-form .profile-form-body {
                padding: .75rem !important;
            }

            .profile-edit-form .panel-header h4 {
                font-size: 1rem;
            }

            .profile-edit-form .form-label {
                font-size: .8rem;
            }

            .profile-edit-form .form-control,
            .profile-edit-form .form-select {
                min-height: 40px;
                font-size: .8rem;
            }

            .profile-edit-form textarea {
                min-height: 90px;
            }

            .profile-save-button {
                min-height: 42px;
                font-size: .85rem;
            }
        }

        /* =========================================================
           MODAL RESPONSIVENESS
           ========================================================= */

        .profile-message-modal .modal-dialog {
            width: auto;
            max-width: 500px;
            margin: 1.75rem auto;
        }

        .profile-message-modal .modal-content {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
            border-radius: .75rem;
        }

        .profile-message-modal .modal-body {
            overflow-wrap: break-word;
            word-break: normal;
        }

        .profile-message-modal .modal-body ul {
            padding-left: 1.25rem;
        }

        @media (max-width: 575.98px) {

            .profile-message-modal .modal-dialog {
                width: calc(100% - 1.5rem);
                max-width: none;
                margin: .75rem auto;
            }

            .profile-message-modal .modal-header,
            .profile-message-modal .modal-body,
            .profile-message-modal .modal-footer {
                padding: .9rem;
            }

            .profile-message-modal .modal-title {
                font-size: 1rem;
            }

            .profile-message-modal .modal-body {
                font-size: .875rem;
            }

            .profile-message-modal .modal-footer .btn {
                width: 100%;
            }
        }

        /* =========================================================
           ACCESSIBILITY
           ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

    <div class="admin-shell">

        <!-- SIDEBAR BACKDROP -->
        <div class="sidebar-backdrop" data-sidebar-close></div>

        <!-- =====================================================
             SIDEBAR
             ===================================================== -->

        <aside class="admin-sidebar"
            id="adminSidebar"
            aria-label="Main navigation">

             <div class="sidebar-header">

            <a class="brand-mark"
               href="{{ route('dashboard') }}"
               aria-label="Admin Dashboard">

                <img src="../../../khen/assets/images/logo.jpg"
                     alt="Pap Pay Logo"
                     class="brand-logo">

            </a>

        </div>


            <nav class="sidebar-nav">

                <a class="nav-link"
                    href="{{ route('dashboard') }}">

                    <span class="nav-icon">
                        <i class="bi bi-house-door" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Dashboard
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('attendance') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-check" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Attendance
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('file_leave') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-plus" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        File Leave
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('file_ob') }}">

                    <span class="nav-icon">
                        <i class="bi bi-briefcase" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        File OB
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('payslip') }}">

                    <span class="nav-icon">
                        <i class="bi bi-receipt" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Payslip
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('employee.announcements') }}">

                    <span class="nav-icon">
                        <i class="bi bi-megaphone" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Announcements
                    </span>

                </a>


                <a class="nav-link active"
                    href="{{ route('my_profile') }}"
                    aria-current="page">

                    <span class="nav-icon">
                        <i class="bi bi-person" aria-hidden="true"></i>
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
                    Active Workspace
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
                        action="{{ route('search') }}"
                        method="GET">

                        <input class="form-control search-input"
                            type="search"
                            name="search"
                            placeholder="Search attendance, leave, payroll..."
                            required>

                    </form>


                    <!-- NAVBAR ACTIONS -->

                    <div class="navbar-actions ms-auto">


                        <!-- NOTIFICATIONS -->

                        <div class="dropdown">

                            <button class="icon-button"
                                type="button"
                                data-bs-toggle="dropdown"
                                data-bs-display="static"
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
                                    href="{{ route('employee.announcements') }}">

                                    <span class="notification-title">
                                        New announcement
                                    </span>

                                    <span class="notification-time">
                                        View announcements
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
                                data-bs-display="static"
                                aria-expanded="false"
                                aria-label="Open profile menu">

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

                                        <i class="bi bi-person me-2"></i>
                                        Profile

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

                                            <i class="bi bi-box-arrow-right me-2"></i>
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

                <div class="container-fluid profile-page-container px-3 px-lg-4 py-4">


                    <!-- =================================================
                         PAGE HEADING
                         ================================================= -->

                    <div class="page-heading profile-page-heading">

                        <div class="page-heading-copy profile-page-heading-copy">

                            <span class="page-icon">

                                <i class="bi bi-person-badge"
                                    aria-hidden="true"></i>

                            </span>


                            <div>

                                <p class="eyebrow mb-1">
                                    Account
                                </p>

                                <h1 class="h3 mb-1">
                                    Profile
                                </h1>

                                <p class="text-muted mb-0">
                                    Manage your personal details, bio, and
                                    contact preferences.
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         PROFILE CONTENT
                         ================================================= -->

                    <section class="row g-3 profile-content-row">


                        <!-- =================================================
                             LEFT PROFILE CARD
                             ================================================= -->

                        <div class="col-12 col-xl-4">

                            <div class="panel h-100 text-center profile-card">

                                <!-- COVER -->

                                <div class="profile-cover">

                                    <img src="{{ asset('khen/assets/images/image.png') }}"
                                        alt="Pap Pay Cover">

                                </div>


                                <!-- PHOTO -->

                                <img class="avatar-img avatar-xl profile-photo"
                                    src="{{ $employee->photo
                                        ? asset('storage/' . $employee->photo)
                                        : asset('images/default-avatar.png') }}"
                                    alt="{{ $employee->name ?? 'Employee' }}">


                                <!-- NAME -->

                                <h2 class="h5 mt-3 mb-1">

                                    {{ $employee->name ?? 'Employee Name' }}

                                </h2>


                                <!-- POSITION -->

                                <p class="text-muted mb-3">

                                    {{ $employee->position ?? 'Position' }}

                                </p>


                                <!-- BADGES -->

                                <div class="d-flex justify-content-center gap-2 flex-wrap px-3">

                                    <span class="badge text-bg-primary">

                                        {{ $employee->department ?? 'Department' }}

                                    </span>


                                    <span class="badge text-bg-success">

                                        {{ $employee->status ?? 'Active' }}

                                    </span>

                                </div>


                                <hr>


                                <!-- INFORMATION -->

                                <div class="info-list mt-3 text-start px-3">


                                    <div class="mb-3">

                                        <span class="text-muted">
                                            Employee ID
                                        </span>

                                        <strong class="d-block">

                                            {{ $employee->employee_id ?? 'Not Set' }}

                                        </strong>

                                    </div>


                                    <div class="mb-3">

                                        <span class="text-muted">
                                            Email
                                        </span>

                                        <strong class="d-block">

                                            {{ $employee->email ?? 'Not Set' }}

                                        </strong>

                                    </div>


                                    <div class="mb-3">

                                        <span class="text-muted">
                                            Contact Number
                                        </span>

                                        <strong class="d-block">

                                            {{ $employee->contact_number ?? 'Not Set' }}

                                        </strong>

                                    </div>


                                    <div class="mb-3">

                                        <span class="text-muted">
                                            Employment Type
                                        </span>

                                        <strong class="d-block">

                                            {{ $employee->employment_type ?? 'Regular' }}

                                        </strong>

                                    </div>


                                    <div class="mb-3">

                                        <span class="text-muted">
                                            Hire Date
                                        </span>

                                        <strong class="d-block">

                                            {{ $employee->hire_date ?? 'Not Available' }}

                                        </strong>

                                    </div>


                                    <div class="mb-3">

                                        <span class="text-muted">
                                            Status
                                        </span>

                                        <strong class="d-block">

                                            {{ $employee->status ?? 'Active' }}

                                        </strong>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- =================================================
                             RIGHT EDIT FORM
                             ================================================= -->

                        <div class="col-12 col-xl-8">

                            <form action="{{ route('my_profile.update') }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="panel profile-edit-form">

                                @csrf
                                @method('PATCH')


                                <!-- HEADER -->

                                <div class="panel-header">

                                    <h4 class="mb-0">
                                        Edit Profile
                                    </h4>

                                </div>


                                <!-- FORM BODY -->

                                <div class="row g-3 p-3 profile-form-body">


                                    <!-- PHOTO -->

                                    <div class="col-12">

                                        <label class="form-label">
                                            Profile Photo
                                        </label>

                                        <input type="file"
                                            name="photo"
                                            class="form-control"
                                            accept="image/*">

                                    </div>


                                    <!-- FIRST NAME -->

                                    <div class="col-12 col-md-4">

                                        <label class="form-label">
                                            First Name
                                        </label>

                                        <input type="text"
                                            name="first_name"
                                            class="form-control"
                                            value="{{ old('first_name', $employee->first_name) }}">

                                    </div>


                                    <!-- MIDDLE NAME -->

                                    <div class="col-12 col-md-4">

                                        <label class="form-label">
                                            Middle Name
                                        </label>

                                        <input type="text"
                                            name="middle_name"
                                            class="form-control"
                                            value="{{ old('middle_name', $employee->middle_name) }}">

                                    </div>


                                    <!-- LAST NAME -->

                                    <div class="col-12 col-md-4">

                                        <label class="form-label">
                                            Last Name
                                        </label>

                                        <input type="text"
                                            name="last_name"
                                            class="form-control"
                                            value="{{ old('last_name', $employee->last_name) }}">

                                    </div>


                                    <!-- EMAIL -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">
                                            Email
                                        </label>

                                        <input type="email"
                                            name="email"
                                            class="form-control"
                                            value="{{ old('email', $employee->email) }}">

                                    </div>


                                    <!-- CONTACT -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">
                                            Contact Number
                                        </label>

                                        <input type="text"
                                            name="contact_number"
                                            class="form-control"
                                            value="{{ old('contact_number', $employee->contact_number) }}">

                                    </div>


                                    <!-- GENDER -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">
                                            Gender
                                        </label>

                                        <select name="gender"
                                            class="form-select">

                                            <option value="">
                                                Select
                                            </option>

                                            <option value="Male"
                                                {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>

                                                Male

                                            </option>

                                            <option value="Female"
                                                {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>

                                                Female

                                            </option>

                                        </select>

                                    </div>


                                    <!-- BIRTH DATE -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">
                                            Birth Date
                                        </label>

                                        <input type="date"
                                            name="birth_date"
                                            class="form-control"
                                            value="{{ old('birth_date', $employee->birth_date) }}">

                                    </div>


                                    <!-- ADDRESS -->

                                    <div class="col-12">

                                        <label class="form-label">
                                            Address
                                        </label>

                                        <textarea name="address"
                                            rows="3"
                                            class="form-control">{{ old('address', $employee->address) }}</textarea>

                                    </div>


                                    <!-- EMERGENCY PERSON -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">
                                            Emergency Contact Person
                                        </label>

                                        <input type="text"
                                            name="emergency_contact_person"
                                            class="form-control"
                                            value="{{ old('emergency_contact_person', $employee->emergency_contact_person) }}">

                                    </div>


                                    <!-- EMERGENCY NUMBER -->

                                    <div class="col-12 col-md-6">

                                        <label class="form-label">
                                            Emergency Contact Number
                                        </label>

                                        <input type="text"
                                            name="emergency_contact_number"
                                            class="form-control"
                                            value="{{ old('emergency_contact_number', $employee->emergency_contact_number) }}">

                                    </div>


                                    <!-- BIO -->

                                    <div class="col-12">

                                        <label class="form-label">
                                            Bio
                                        </label>

                                        <textarea name="bio"
                                            rows="4"
                                            class="form-control">{{ old('bio', $employee->bio) }}</textarea>

                                    </div>


                                    <!-- PASSWORD -->

                                    <div class="col-12">

                                        <label class="form-label">
                                            New Password
                                        </label>

                                        <input type="password"
                                            name="password"
                                            class="form-control"
                                            autocomplete="new-password">

                                        <small class="text-muted mt-1">
                                            Leave blank if you don't want to
                                            change it.
                                        </small>

                                    </div>


                                    <!-- SAVE -->

                                    <div class="col-12 text-end">

                                        <button type="submit"
                                            class="btn btn-primary profile-save-button">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Save Changes

                                        </button>

                                    </div>

                                </div>

                            </form>

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
                            rel="noopener noreferrer"
                            class="fw-bold text-success"
                            href="https://github.com/HasanMahmudDev">

                            Md. Hasan Mahmud

                        </a>

                        •

                        Distributed by

                        <a target="_blank"
                            rel="noopener noreferrer"
                            class="fw-bold text-success"
                            href="https://themewagon.com">

                            ThemeWagon

                        </a>

                    </span>


                    <span>
                        Professional dashboard template.
                    </span>


                    <span>
                        Profile management page.
                    </span>

                </div>

            </footer>

        </div>

    </div>


    <!-- =========================================================
         SUCCESS MODAL
         ========================================================= -->

    @if (session('success'))

        <div class="modal fade profile-message-modal"
            id="profileSuccessModal"
            tabindex="-1"
            aria-labelledby="profileSuccessModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title text-success"
                            id="profileSuccessModalLabel">

                            <i class="bi bi-check-circle-fill me-2"></i>
                            Success

                        </h5>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>


                    <div class="modal-body">

                        {{ session('success') }}

                    </div>


                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-success"
                            data-bs-dismiss="modal">

                            OK

                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endif


    <!-- =========================================================
         VALIDATION ERROR MODAL
         ========================================================= -->

    @if ($errors->any())

        <div class="modal fade profile-message-modal"
            id="profileErrorModal"
            tabindex="-1"
            aria-labelledby="profileErrorModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title text-danger"
                            id="profileErrorModalLabel">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Please check your information

                        </h5>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>


                    <div class="modal-body">

                        <p class="mb-2">
                            Please correct the following:
                        </p>

                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>


                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal">

                            OK

                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endif


    <!-- =========================================================
         JAVASCRIPT
         ========================================================= -->

    <script src="{{ asset('khen/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('khen/assets/js/main.js') }}"></script>


    <!-- =========================================================
         SHOW MESSAGE MODALS AUTOMATICALLY
         ========================================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const successModalElement =
                document.getElementById('profileSuccessModal');

            const errorModalElement =
                document.getElementById('profileErrorModal');


            /*
             * SUCCESS MODAL
             */

            if (successModalElement) {

                const successModal =
                    new bootstrap.Modal(successModalElement, {
                        backdrop: true,
                        keyboard: true
                    });

                successModal.show();

            }


            /*
             * ERROR MODAL
             */

            if (errorModalElement) {

                const errorModal =
                    new bootstrap.Modal(errorModalElement, {
                        backdrop: true,
                        keyboard: true
                    });

                errorModal.show();

            }

        });
    </script>

</body>

</html>
