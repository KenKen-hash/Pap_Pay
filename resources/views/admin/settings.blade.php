@php
    $admin = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="PAP Pay administrator account settings"
    >

    <meta
        name="theme-color"
        content="#172554"
    >

    <title>Account Settings | PAP Pay</title>


    <!-- Favicon -->
    <link
        rel="icon"
        type="image/x-icon"
        href="{{ asset('khen/assets/images/favicon.png') }}"
    >


    <!-- Bootstrap -->
    <link
        rel="stylesheet"
        href="{{ asset('khen/assets/css/bootstrap.min.css') }}"
    >


    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="{{ asset('khen/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}"
    >


    <!-- Main Dashboard CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('khen/assets/css/style.css') }}"
    >


    <style>

        /* =========================================================
           GLOBAL
           ========================================================= */

        :root {
            --admin-sidebar-width: 270px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
            padding: 0;
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

        img {
            max-width: 100%;
        }


        /* =========================================================
           ADMIN SHELL
           ========================================================= */

        .admin-shell {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }


        /* =========================================================
           ADMIN SIDEBAR
           ========================================================= */

        .admin-sidebar {
            width: var(--admin-sidebar-width);
            max-width: var(--admin-sidebar-width);
            min-width: var(--admin-sidebar-width);
        }


        /* =========================================================
           IMPORTANT MAIN WIDTH FIX

           The sidebar occupies 270px.
           The main area must use only the remaining viewport width.
           ========================================================= */

        .admin-main {
            width: calc(100% - var(--admin-sidebar-width));
            max-width: calc(100% - var(--admin-sidebar-width));
            min-width: 0;
            margin-left: var(--admin-sidebar-width);
            overflow-x: hidden;
        }


        /* =========================================================
           NAVBAR
           ========================================================= */

        .admin-navbar {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: visible;
        }

        .admin-navbar .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: .5rem;
            flex-shrink: 0;
            min-width: 0;
        }

        .profile-button {
            min-width: 0;
            max-width: 100%;
        }

        .profile-button .profile-name {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

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


        /* =========================================================
           DASHBOARD CONTENT
           ========================================================= */

        .dashboard-content {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }


        /* =========================================================
           SETTINGS PAGE CONTAINER
           ========================================================= */

        .settings-page-container {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
        }

        .settings-content-row {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-left: 0;
            margin-right: 0;
        }

        .settings-content-row > [class*="col-"] {
            min-width: 0;
            max-width: 100%;
        }


        /* =========================================================
           PAGE HEADING
           ========================================================= */

        .settings-page-heading {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .settings-page-heading-copy {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            min-width: 0;
            max-width: 100%;
        }

        .settings-page-heading-copy > div {
            min-width: 0;
            max-width: 100%;
        }

        .settings-page-heading h1,
        .settings-page-heading p {
            max-width: 100%;
            overflow-wrap: break-word;
            word-break: normal;
        }

        .settings-page-heading p {
            margin-right: 0;
        }


        /* =========================================================
           PANELS
           ========================================================= */

        .panel,
        .settings-panel,
        .admin-account-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .settings-panel {
            overflow: hidden;
        }

        .settings-panel + .settings-panel {
            margin-top: 1rem;
        }

        .settings-panel .panel-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .settings-panel-body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .settings-panel-body > [class*="col-"] {
            min-width: 0;
            max-width: 100%;
        }


        /* =========================================================
           ACCOUNT SUMMARY CARD
           ========================================================= */

        .admin-account-card {
            overflow: hidden;
        }

        .admin-account-cover {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

        .admin-account-cover img {
            display: block;
            width: 100%;
            max-width: 100%;
            height: 190px;
            object-fit: cover;
            object-position: center;
        }

        .admin-account-photo {
            display: block;
            width: 110px;
            height: 110px;
            max-width: 110px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #fff;
            margin: -55px auto 0;
            position: relative;
            z-index: 2;
            background: #fff;
        }

        .admin-account-card h2,
        .admin-account-card p {
            max-width: 100%;
            overflow-wrap: break-word;
            word-break: normal;
        }

        .admin-account-card .badge {
            max-width: 100%;
            white-space: normal;
            overflow-wrap: break-word;
        }

        .admin-account-info {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .admin-account-info > div {
            min-width: 0;
            max-width: 100%;
        }

        .admin-account-info strong {
            display: block;
            width: 100%;
            max-width: 100%;
            overflow-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }


        /* =========================================================
           FORMS
           ========================================================= */

        .settings-form {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .settings-form .row {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-left: 0;
            margin-right: 0;
        }

        .settings-form .row > * {
            min-width: 0;
            max-width: 100%;
        }

        .settings-form .form-control,
        .settings-form .form-select {
            display: block;
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .settings-form .form-label {
            display: block;
            width: 100%;
            max-width: 100%;
            overflow-wrap: break-word;
            margin-bottom: .4rem;
            font-weight: 600;
        }

        .settings-form small {
            display: block;
            width: 100%;
            max-width: 100%;
            overflow-wrap: break-word;
        }

        .settings-form .form-control {
            min-height: 42px;
        }


        /* =========================================================
           PHOTO UPLOAD
           ========================================================= */

        .photo-upload-wrapper {
            display: flex;
            align-items: center;
            gap: 1rem;
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .photo-upload-info {
            flex: 1 1 auto;
            min-width: 0;
            max-width: 100%;
        }

        .photo-upload-info strong,
        .photo-upload-info small {
            max-width: 100%;
            overflow-wrap: break-word;
        }

        .photo-upload-info .form-control {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .settings-photo-preview {
            display: block;
            width: 72px;
            height: 72px;
            max-width: 72px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #dee2e6;
            flex: 0 0 auto;
        }


        /* =========================================================
           BUTTONS
           ========================================================= */

        .settings-save-button {
            min-width: 135px;
            max-width: 100%;
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
            overflow-wrap: break-word;
        }


        /* =========================================================
           LARGE DESKTOP
           ========================================================= */

        @media (min-width: 1200px) {

            .admin-account-cover img {
                height: 190px;
            }

        }


        /* =========================================================
           TABLET / SMALL LAPTOP
           ========================================================= */

        @media (max-width: 1199.98px) {

            .admin-account-cover img {
                height: 175px;
            }

            .admin-account-photo {
                width: 100px;
                height: 100px;
                max-width: 100px;
                margin-top: -50px;
            }

        }


        /* =========================================================
           TABLET
           ========================================================= */

        @media (max-width: 991.98px) {

            /*
             * On tablet/mobile the sidebar becomes an overlay
             * through the dashboard CSS.
             * Therefore the main area must use the entire screen.
             */

            .admin-main {
                width: 100%;
                max-width: 100%;
                min-width: 0;
                margin-left: 0;
            }

            .settings-content-row {
                --bs-gutter-x: 1rem;
                --bs-gutter-y: 1rem;
            }

            .settings-page-container {
                width: 100%;
                max-width: 100%;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .admin-navbar .container-fluid {
                width: 100%;
                max-width: 100%;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .admin-account-cover img {
                height: 190px;
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
                min-width: 0;
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

            .admin-navbar {
                width: 100%;
                max-width: 100%;
            }

            .admin-navbar .container-fluid {
                width: 100%;
                max-width: 100%;
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

            .settings-page-container {
                width: 100%;
                max-width: 100%;
                padding: 1rem !important;
            }

            .settings-page-heading {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
            }

            .settings-page-heading-copy {
                width: 100%;
                max-width: 100%;
                gap: .75rem;
            }

            .settings-page-heading h1 {
                font-size: 1.5rem;
                line-height: 1.2;
            }

            .settings-page-heading p {
                font-size: .875rem;
                line-height: 1.5;
            }


            /* -----------------------------------------------------
               ACCOUNT CARD
               ----------------------------------------------------- */

            .admin-account-card {
                width: 100%;
                max-width: 100%;
                height: auto !important;
            }

            .admin-account-cover img {
                height: 190px;
            }

            .admin-account-photo {
                width: 96px;
                height: 96px;
                max-width: 96px;
                margin-top: -48px;
            }

            .admin-account-card h2 {
                font-size: 1.2rem;
            }

            .admin-account-card p {
                font-size: .9rem;
            }

            .admin-account-info {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .admin-account-info > div {
                margin-bottom: 1rem !important;
            }

            .admin-account-info strong {
                font-size: .9rem;
                line-height: 1.45;
            }


            /* -----------------------------------------------------
               SETTINGS PANELS
               ----------------------------------------------------- */

            .settings-panel {
                width: 100%;
                max-width: 100%;
            }

            .settings-panel .panel-header {
                width: 100%;
                max-width: 100%;
                padding: 1rem !important;
            }

            .settings-panel .panel-header h4 {
                font-size: 1.05rem;
            }

            .settings-panel-body {
                width: 100%;
                max-width: 100%;
                padding: 1rem !important;
            }

            .settings-form .form-label {
                font-size: .875rem;
            }

            .settings-form .form-control {
                width: 100%;
                max-width: 100%;
                min-height: 44px;
                font-size: .9rem;
            }

            .settings-save-button {
                width: 100%;
                max-width: 100%;
                min-height: 44px;
            }


            /* -----------------------------------------------------
               PHOTO
               ----------------------------------------------------- */

            .photo-upload-wrapper {
                width: 100%;
                max-width: 100%;
                align-items: flex-start;
            }


            /* -----------------------------------------------------
               FOOTER
               ----------------------------------------------------- */

            .admin-footer .container-fluid {
                width: 100%;
                max-width: 100%;
                padding: 1rem !important;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: .5rem;
            }

            .admin-footer span {
                width: 100%;
                max-width: 100%;
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

            .settings-page-container {
                padding: .75rem !important;
            }

            .settings-page-heading-copy {
                gap: .6rem;
            }

            .settings-page-heading h1 {
                font-size: 1.35rem;
            }

            .settings-page-heading p {
                font-size: .82rem;
            }

            .admin-account-cover img {
                height: 165px;
            }

            .admin-account-photo {
                width: 86px;
                height: 86px;
                max-width: 86px;
                margin-top: -43px;
            }

            .admin-account-card h2 {
                font-size: 1.1rem;
            }

            .admin-account-card p {
                font-size: .82rem;
            }

            .admin-account-info {
                padding-left: .85rem;
                padding-right: .85rem;
            }

            .admin-account-info strong {
                font-size: .85rem;
            }

            .settings-panel .panel-header {
                padding: .9rem !important;
            }

            .settings-panel-body {
                padding: .9rem !important;
            }

            .settings-form .form-control {
                min-height: 42px;
                font-size: .85rem;
            }

            .settings-form .form-label {
                font-size: .82rem;
            }

            .photo-upload-wrapper {
                gap: .75rem;
            }

            .settings-photo-preview {
                width: 62px;
                height: 62px;
                max-width: 62px;
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

            .settings-page-container {
                padding: .6rem !important;
            }

            .settings-page-heading-copy {
                gap: .5rem;
            }

            .settings-page-heading h1 {
                font-size: 1.2rem;
            }

            .settings-page-heading p {
                font-size: .78rem;
            }

            .admin-account-cover img {
                height: 145px;
            }

            .admin-account-photo {
                width: 76px;
                height: 76px;
                max-width: 76px;
                margin-top: -38px;
            }

            .admin-account-card h2 {
                font-size: 1rem;
            }

            .admin-account-card p {
                font-size: .78rem;
            }

            .admin-account-info {
                padding-left: .7rem;
                padding-right: .7rem;
            }

            .admin-account-info strong {
                font-size: .8rem;
            }

            .settings-panel .panel-header {
                padding: .75rem !important;
            }

            .settings-panel-body {
                padding: .75rem !important;
            }

            .settings-panel .panel-header h4 {
                font-size: 1rem;
            }

            .settings-form .form-label {
                font-size: .8rem;
            }

            .settings-form .form-control {
                min-height: 40px;
                font-size: .8rem;
            }

            .settings-save-button {
                min-height: 42px;
                font-size: .85rem;
            }

        }


        /* =========================================================
           MESSAGE MODAL
           ========================================================= */

        .settings-message-modal .modal-dialog {
            width: auto;
            max-width: 500px;
            margin: 1.75rem auto;
        }

        .settings-message-modal .modal-content {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
            border-radius: .75rem;
        }

        .settings-message-modal .modal-body {
            overflow-wrap: break-word;
            word-break: normal;
        }

        .settings-message-modal .modal-body ul {
            padding-left: 1.25rem;
        }

        @media (max-width: 575.98px) {

            .settings-message-modal .modal-dialog {
                width: calc(100% - 1.5rem);
                max-width: none;
                margin: .75rem auto;
            }

            .settings-message-modal .modal-header,
            .settings-message-modal .modal-body,
            .settings-message-modal .modal-footer {
                padding: .9rem;
            }

            .settings-message-modal .modal-title {
                font-size: 1rem;
            }

            .settings-message-modal .modal-body {
                font-size: .875rem;
            }

            .settings-message-modal .modal-footer .btn {
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


    <!-- =========================================================
         SIDEBAR BACKDROP
         ========================================================= -->

    <div
        class="sidebar-backdrop"
        data-sidebar-close
    ></div>


    <!-- =========================================================
         ADMIN SIDEBAR
         ========================================================= -->

    <aside
        class="admin-sidebar"
        id="adminSidebar"
        aria-label="Main navigation"
    >

        <div class="sidebar-header">

            <a
                class="brand-mark"
                href="{{ route('admin-dashboard') }}"
                aria-label="Admin Dashboard"
            >

                <img
                    src="{{ asset('khen/assets/images/logo.jpg') }}"
                    alt="Pap Pay Logo"
                    class="brand-logo"
                >

            </a>

        </div>


        <nav class="sidebar-nav">

            <a
                class="nav-link"
                href="{{ route('admin-dashboard') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-grid-1x2"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>


            <a
                class="nav-link"
                href="{{ route('employees.index') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-people"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Employees
                </span>

            </a>


            <a
                class="nav-link"
                href="{{ route('attendance_list') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-calendar-check"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Attendance
                </span>

            </a>


            <a
                class="nav-link"
                href="{{ route('admin.leaves') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-calendar-minus"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Leave Requests
                </span>

                @if(isset($pendingLeaves) && $pendingLeaves > 0)

                    <span class="nav-badge">
                        {{ $pendingLeaves }}
                    </span>

                @endif

            </a>


            <a
                class="nav-link"
                href="{{ route('official_business') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-briefcase"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Official Business
                </span>

                @if(isset($pendingOB) && $pendingOB > 0)

                    <span class="nav-badge">
                        {{ $pendingOB }}
                    </span>

                @endif

            </a>


            <a
                class="nav-link"
                href="{{ route('holidays.index') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-calendar-event"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Holidays
                </span>

            </a>


            <a
                class="nav-link"
                href="{{ route('payroll') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-cash-stack"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Payroll
                </span>

            </a>


            <a
                class="nav-link"
                href="{{ route('payslip_list') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-receipt"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Payslips
                </span>

            </a>


            <a
                class="nav-link"
                href="{{ route('admin.payslip-concerns.index') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-exclamation-circle"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Payslip Concerns
                </span>

                @if(isset($unreadPayslipConcerns) && $unreadPayslipConcerns > 0)

                    <span class="nav-badge">
                        {{ $unreadPayslipConcerns }}
                    </span>

                @endif

            </a>


            <a
                class="nav-link"
                href="{{ route('reports') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-bar-chart"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Reports
                </span>

            </a>


            <a
                class="nav-link"
                href="{{ route('announcements') }}"
            >

                <span class="nav-icon">
                    <i
                        class="bi bi-megaphone"
                        aria-hidden="true"
                    ></i>
                </span>

                <span class="nav-text">
                    Announcements
                </span>

            </a>

        </nav>


        <!-- =====================================================
             SIDEBAR USER
             ===================================================== -->

        <div class="sidebar-user">

            <img
                class="avatar-img avatar-md sidebar-user-avatar"
                src="{{ $admin->photo
                    ? asset('storage/' . $admin->photo)
                    : asset('khen/assets/images/avatar/avatar.jpg') }}"
                alt="{{ $admin->name ?? 'Administrator' }}"
            >

            <strong>
                {{ $admin->name ?? 'Administrator' }}
            </strong>

            <small>
                Administrator
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
         ADMIN MAIN
         ========================================================= -->

    <div class="admin-main">


        <!-- =====================================================
             NAVBAR
             ===================================================== -->

        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">


                <!-- SIDEBAR TOGGLE -->

                <button
                    class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="true"
                    aria-label="Toggle sidebar"
                >

                    <span></span>
                    <span></span>
                    <span></span>

                </button>


                <!-- SEARCH -->

                <form
                    class="d-none d-md-flex ms-3 flex-grow-1"
                    action="{{ route('search') }}"
                    method="GET"
                >

                    <input
                        class="form-control search-input"
                        type="search"
                        name="search"
                        placeholder="Search employees, attendance, payroll..."
                        required
                    >

                </form>


                <!-- NAVBAR ACTIONS -->

                <div class="navbar-actions ms-auto">


                    <!-- NOTIFICATIONS -->

                    <div class="dropdown">

                        <button
                            class="icon-button"
                            type="button"
                            data-bs-toggle="dropdown"
                            data-bs-display="static"
                            aria-expanded="false"
                            aria-label="Notifications"
                        >

                            @if(isset($unreadNotifications) && $unreadNotifications > 0)

                                <span class="notification-dot"></span>

                            @endif

                            <i
                                class="bi bi-bell"
                                aria-hidden="true"
                            ></i>

                        </button>


                        <div class="dropdown-menu dropdown-menu-end notification-menu">

                            <div class="dropdown-header fw-bold text-body">

                                Notifications

                            </div>


                            @if(isset($notifications) && $notifications->count())

                                @foreach($notifications as $notification)

                                    <a
                                        class="dropdown-item"
                                        href="{{ route('admin.notifications') }}"
                                    >

                                        <span class="notification-title">
                                            {{ $notification->title ?? 'Notification' }}
                                        </span>

                                        <span class="notification-time">
                                            {{ $notification->created_at?->diffForHumans() ?? '' }}
                                        </span>

                                    </a>

                                @endforeach

                            @else

                                <div class="dropdown-item text-muted">

                                    No new notifications.

                                </div>

                            @endif


                            <div class="dropdown-divider"></div>


                            <a
                                class="dropdown-item text-center fw-semibold"
                                href="{{ route('admin.notifications') }}"
                            >

                                View all notifications

                            </a>

                        </div>

                    </div>


                    <!-- PROFILE -->

                    <div class="dropdown">

                        <button
                            class="profile-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            data-bs-display="static"
                            aria-expanded="false"
                            aria-label="Open profile menu"
                        >

                            <img
                                class="avatar-img avatar-sm"
                                src="{{ $admin->photo
                                    ? asset('storage/' . $admin->photo)
                                    : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                alt="{{ $admin->name ?? 'Administrator' }}"
                            >

                            <span class="profile-name d-none d-sm-inline">
                                {{ $admin->name ?? 'Administrator' }}
                            </span>

                        </button>


                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a
                                    class="dropdown-item"
                                    href="{{ route('settings') }}"
                                >

                                    <i class="bi bi-person-gear me-2"></i>

                                    Account Settings

                                </a>

                            </li>


                            <li>

                                <hr class="dropdown-divider">

                            </li>


                            <li>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item"
                                    >

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


        <!-- =====================================================
             MAIN CONTENT
             ===================================================== -->

        <main class="dashboard-content">

            <div class="container-fluid settings-page-container px-3 px-lg-4 py-4">


                <!-- =================================================
                     PAGE HEADING
                     ================================================= -->

                <div class="page-heading settings-page-heading mb-4">

                    <div class="page-heading-copy settings-page-heading-copy">

                        <span class="page-icon">

                            <i
                                class="bi bi-person-gear"
                                aria-hidden="true"
                            ></i>

                        </span>


                        <div>

                            <p class="eyebrow mb-1">
                                Account
                            </p>

                            <h1 class="h3 mb-1">
                                Account Settings
                            </h1>

                            <p class="text-muted mb-0">
                                Manage your basic account information, profile
                                photo, and password.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     SETTINGS CONTENT
                     ================================================= -->

                <section class="row g-3 settings-content-row">


                    <!-- =================================================
                         LEFT ACCOUNT SUMMARY
                         ================================================= -->

                    <div class="col-12 col-xl-4">

                        <div class="panel h-100 text-center admin-account-card">


                            <!-- COVER -->

                            <div class="admin-account-cover">

                                <img
                                    src="{{ asset('khen/assets/images/image.png') }}"
                                    alt="PAP Pay Cover"
                                >

                            </div>


                            <!-- PHOTO -->

                            <img
                                class="admin-account-photo"
                                src="{{ $admin->photo
                                    ? asset('storage/' . $admin->photo)
                                    : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                alt="{{ $admin->name ?? 'Administrator' }}"
                            >


                            <!-- NAME -->

                            <h2 class="h5 mt-3 mb-1">

                                {{ $admin->name ?? 'Administrator' }}

                            </h2>


                            <!-- ROLE -->

                            <p class="text-muted mb-3">

                                {{ $admin->position ?? 'Administrator' }}

                            </p>


                            <!-- BADGES -->

                            <div class="d-flex justify-content-center gap-2 flex-wrap px-3">

                                <span class="badge text-bg-primary">

                                    Administrator

                                </span>


                                <span class="badge text-bg-success">

                                    {{ ucfirst($admin->status ?? 'Active') }}

                                </span>

                            </div>


                            <hr>


                            <!-- ACCOUNT INFORMATION -->

                            <div class="admin-account-info mt-3 text-start px-3">


                                <div class="mb-3">

                                    <span class="text-muted">
                                        Email
                                    </span>

                                    <strong>
                                        {{ $admin->email ?? 'Not Set' }}
                                    </strong>

                                </div>


                                <div class="mb-3">

                                    <span class="text-muted">
                                        Contact Number
                                    </span>

                                    <strong>
                                        {{ $admin->contact ?? 'Not Set' }}
                                    </strong>

                                </div>


                                <div class="mb-3">

                                    <span class="text-muted">
                                        Department
                                    </span>

                                    <strong>
                                        {{ $admin->department ?? 'Administration' }}
                                    </strong>

                                </div>


                                <div class="mb-3">

                                    <span class="text-muted">
                                        Account Status
                                    </span>

                                    <strong>
                                        {{ ucfirst($admin->status ?? 'Active') }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         RIGHT SETTINGS
                         ================================================= -->

                    <div class="col-12 col-xl-8">


                        <!-- =================================================
                             BASIC INFORMATION
                             ================================================= -->

                        <form
                            action="{{ route('settings.information.update') }}"
                            method="POST"
                            class="panel settings-panel settings-form"
                        >

                            @csrf
                            @method('PATCH')


                            <div class="panel-header">

                                <h4 class="mb-0">

                                    <i class="bi bi-person me-2"></i>

                                    Basic Information

                                </h4>

                            </div>


                            <div class="row g-3 p-3 settings-panel-body">


                                <!-- FIRST NAME -->

                                <div class="col-12 col-md-4">

                                    <label
                                        for="first_name"
                                        class="form-label"
                                    >
                                        First Name
                                    </label>

                                    <input
                                        id="first_name"
                                        type="text"
                                        name="first_name"
                                        class="form-control"
                                        value="{{ old('first_name', $admin->first_name) }}"
                                        maxlength="100"
                                        required
                                    >

                                </div>


                                <!-- MIDDLE NAME -->

                                <div class="col-12 col-md-4">

                                    <label
                                        for="middle_name"
                                        class="form-label"
                                    >
                                        Middle Name
                                    </label>

                                    <input
                                        id="middle_name"
                                        type="text"
                                        name="middle_name"
                                        class="form-control"
                                        value="{{ old('middle_name', $admin->middle_name) }}"
                                        maxlength="100"
                                    >

                                </div>


                                <!-- LAST NAME -->

                                <div class="col-12 col-md-4">

                                    <label
                                        for="last_name"
                                        class="form-label"
                                    >
                                        Last Name
                                    </label>

                                    <input
                                        id="last_name"
                                        type="text"
                                        name="last_name"
                                        class="form-control"
                                        value="{{ old('last_name', $admin->last_name) }}"
                                        maxlength="100"
                                        required
                                    >

                                </div>


                                <!-- EMAIL -->

                                <div class="col-12 col-md-7">

                                    <label
                                        for="email"
                                        class="form-label"
                                    >
                                        Email Address
                                    </label>

                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email', $admin->email) }}"
                                        maxlength="255"
                                        required
                                    >

                                </div>


                                <!-- CONTACT -->

                                <div class="col-12 col-md-5">

                                    <label
                                        for="contact"
                                        class="form-label"
                                    >
                                        Contact Number
                                    </label>

                                    <input
                                        id="contact"
                                        type="text"
                                        name="contact"
                                        class="form-control"
                                        value="{{ old('contact', $admin->contact) }}"
                                        maxlength="30"
                                    >

                                </div>


                                <!-- SAVE -->

                                <div class="col-12 text-end">

                                    <button
                                        type="submit"
                                        class="btn btn-primary settings-save-button"
                                    >

                                        <i class="bi bi-check-circle me-1"></i>

                                        Save Changes

                                    </button>

                                </div>

                            </div>

                        </form>


                        <!-- =================================================
                             PROFILE PHOTO
                             ================================================= -->

                        <form
                            action="{{ route('settings.profile.update') }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="panel settings-panel settings-form"
                        >

                            @csrf
                            @method('PATCH')


                            <div class="panel-header">

                                <h4 class="mb-0">

                                    <i class="bi bi-camera me-2"></i>

                                    Profile Photo

                                </h4>

                            </div>


                            <div class="p-3 settings-panel-body">


                                <div class="photo-upload-wrapper">


                                    <!-- CURRENT PHOTO -->

                                    <img
                                        class="settings-photo-preview"
                                        src="{{ $admin->photo
                                            ? asset('storage/' . $admin->photo)
                                            : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                        alt="Current profile photo"
                                    >


                                    <!-- UPLOAD -->

                                    <div class="photo-upload-info">

                                        <label
                                            for="photo"
                                            class="form-label"
                                        >
                                            Choose a new profile photo
                                        </label>

                                        <input
                                            id="photo"
                                            type="file"
                                            name="photo"
                                            class="form-control"
                                            accept=".jpg,.jpeg,.png,.webp"
                                            required
                                        >

                                        <small class="text-muted mt-1">

                                            JPG, JPEG, PNG, or WEBP.
                                            Maximum file size: 2 MB.

                                        </small>

                                    </div>

                                </div>


                                <div class="text-end mt-3">

                                    <button
                                        type="submit"
                                        class="btn btn-primary settings-save-button"
                                    >

                                        <i class="bi bi-upload me-1"></i>

                                        Update Photo

                                    </button>

                                </div>

                            </div>

                        </form>


                        <!-- =================================================
                             PASSWORD
                             ================================================= -->

                        <form
                            action="{{ route('settings.password.update') }}"
                            method="POST"
                            class="panel settings-panel settings-form"
                        >

                            @csrf
                            @method('PATCH')


                            <div class="panel-header">

                                <h4 class="mb-0">

                                    <i class="bi bi-shield-lock me-2"></i>

                                    Change Password

                                </h4>

                            </div>


                            <div class="row g-3 p-3 settings-panel-body">


                                <!-- CURRENT PASSWORD -->

                                <div class="col-12">

                                    <label
                                        for="current_password"
                                        class="form-label"
                                    >
                                        Current Password
                                    </label>

                                    <input
                                        id="current_password"
                                        type="password"
                                        name="current_password"
                                        class="form-control"
                                        autocomplete="current-password"
                                        required
                                    >

                                </div>


                                <!-- NEW PASSWORD -->

                                <div class="col-12 col-md-6">

                                    <label
                                        for="password"
                                        class="form-label"
                                    >
                                        New Password
                                    </label>

                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        autocomplete="new-password"
                                        minlength="8"
                                        required
                                    >

                                    <small class="text-muted mt-1">

                                        Minimum of 8 characters.

                                    </small>

                                </div>


                                <!-- CONFIRM PASSWORD -->

                                <div class="col-12 col-md-6">

                                    <label
                                        for="password_confirmation"
                                        class="form-label"
                                    >
                                        Confirm New Password
                                    </label>

                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        class="form-control"
                                        autocomplete="new-password"
                                        minlength="8"
                                        required
                                    >

                                </div>


                                <!-- SAVE -->

                                <div class="col-12 text-end">

                                    <button
                                        type="submit"
                                        class="btn btn-primary settings-save-button"
                                    >

                                        <i class="bi bi-key me-1"></i>

                                        Change Password

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </section>

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

                    <a
                        target="_blank"
                        rel="noopener noreferrer"
                        class="fw-bold text-success"
                        href="https://github.com/HasanMahmudDev"
                    >
                        Md. Hasan Mahmud
                    </a>

                    •

                    Distributed by

                    <a
                        target="_blank"
                        rel="noopener noreferrer"
                        class="fw-bold text-success"
                        href="https://themewagon.com"
                    >
                        ThemeWagon
                    </a>

                </span>


                <span>
                    Professional dashboard template.
                </span>


                <span>
                    Account settings page.
                </span>

            </div>

        </footer>

    </div>

</div>


<!-- =========================================================
     SUCCESS MODAL
     ========================================================= -->

@if (session('success'))

    <div
        class="modal fade settings-message-modal"
        id="settingsSuccessModal"
        tabindex="-1"
        aria-labelledby="settingsSuccessModalLabel"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5
                        class="modal-title text-success"
                        id="settingsSuccessModalLabel"
                    >

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Success

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>


                <div class="modal-body">

                    {{ session('success') }}

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-success"
                        data-bs-dismiss="modal"
                    >
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

    <div
        class="modal fade settings-message-modal"
        id="settingsErrorModal"
        tabindex="-1"
        aria-labelledby="settingsErrorModalLabel"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5
                        class="modal-title text-danger"
                        id="settingsErrorModalLabel"
                    >

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>

                        Please check your information

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

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

                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-dismiss="modal"
                    >
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


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const successModalElement =
            document.getElementById('settingsSuccessModal');

        const errorModalElement =
            document.getElementById('settingsErrorModal');


        /* =====================================================
           SUCCESS MODAL
           ===================================================== */

        if (successModalElement) {

            const successModal =
                new bootstrap.Modal(successModalElement, {
                    backdrop: true,
                    keyboard: true
                });

            successModal.show();

        }


        /* =====================================================
           ERROR MODAL
           ===================================================== */

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
