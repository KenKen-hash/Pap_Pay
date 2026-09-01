@php
    $employee = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Employee payroll and payslip dashboard">
    <title>My Payslips | adminHMD</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../../khen/assets/css/style.css">

    <style>
        /* =========================================================
           GLOBAL RESPONSIVE FIX
        ========================================================= */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden !important;
        }

        body {
            min-height: 100vh;
        }

        .admin-shell {
            width: 100%;
            max-width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /*
         * IMPORTANT:
         * Do NOT give admin-main width:100%.
         *
         * The sidebar already occupies part of the screen.
         * admin-main must only use the remaining available space.
         */
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

        .dashboard-content>.container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .page-heading,
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

        /* =========================================================
           PANELS
        ========================================================= */

        .panel {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .panel-body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .panel-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        /* =========================================================
           LATEST PAYSLIP
        ========================================================= */

        .latest-payslip-content {
            min-width: 0;
            flex: 1 1 auto;
        }

        .latest-payslip-content h5,
        .latest-payslip-content p {
            overflow-wrap: anywhere;
        }

        .latest-payslip-actions {
            flex: 0 1 auto;
            min-width: 0;
            max-width: 100%;
        }

        .latest-payslip-actions .btn {
            white-space: nowrap;
        }

        /* =========================================================
           PAYSLIP TABLE - DESKTOP
        ========================================================= */

        .payslip-table-wrapper {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .payslip-table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 0;
            table-layout: fixed;
        }

        .payslip-table th,
        .payslip-table td {
            vertical-align: middle;
            overflow-wrap: anywhere;
        }

        .payslip-table th {
            white-space: nowrap;
        }

        .payslip-table th:nth-child(1) {
            width: 22%;
        }

        .payslip-table th:nth-child(2) {
            width: 13%;
        }

        .payslip-table th:nth-child(3) {
            width: 17%;
        }

        .payslip-table th:nth-child(4) {
            width: 15%;
        }

        .payslip-table th:nth-child(5) {
            width: 13%;
        }

        .payslip-table th:nth-child(6) {
            width: 20%;
        }

        .payslip-table td {
            white-space: normal;
        }

        .payslip-period {
            min-width: 0;
        }

        .payslip-action {
            white-space: nowrap !important;
        }

        /* =========================================================
           EMPTY PAYSLIP
        ========================================================= */

        .empty-payslip {
            text-align: center !important;
            padding: 4rem 1rem !important;
        }

        /* =========================================================
           NAVBAR RESPONSIVENESS
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

        .navbar-actions {
            min-width: 0;
            flex-shrink: 0;
        }

        .profile-button {
            max-width: 100%;
        }

        .profile-name {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* =========================================================
           MODAL
        ========================================================= */

        #payslipConcernModal .modal-dialog {
            width: calc(100% - 2rem);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        #payslipConcernModal .modal-content {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

        #payslipConcernModal .modal-header,
        #payslipConcernModal .modal-body,
        #payslipConcernModal .modal-footer {
            min-width: 0;
        }

        #payslipConcernModal .modal-title {
            overflow-wrap: anywhere;
        }

        #payslipConcernModal .form-control,
        #payslipConcernModal .form-select {
            width: 100%;
            max-width: 100%;
        }

        #payslipConcernModal textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 1199.98px) {

            .latest-payslip-body {
                align-items: flex-start !important;
            }

            .latest-payslip-actions {
                flex-direction: column !important;
                width: auto;
            }

            .latest-payslip-actions .btn {
                width: 100%;
            }

            .payslip-table {
                table-layout: auto;
            }

            .payslip-table th,
            .payslip-table td {
                font-size: .9rem;
            }
        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767.98px) {

            /* ---------------------------------------------
               Content spacing
            --------------------------------------------- */

            .dashboard-content>.container-fluid {
                padding-left: .75rem !important;
                padding-right: .75rem !important;
            }

            .page-heading {
                padding-top: .25rem;
            }

            .page-heading h1 {
                font-size: 1.45rem;
            }

            .page-heading .text-muted {
                font-size: .875rem;
                line-height: 1.45;
            }

            /* ---------------------------------------------
               Latest Payslip
            --------------------------------------------- */

            .latest-payslip-body {
                display: flex !important;
                flex-direction: column !important;
                align-items: stretch !important;
                padding: 1rem !important;
                gap: 1rem !important;
            }

            .latest-payslip-content {
                width: 100%;
                flex: none;
            }

            .latest-payslip-content h5 {
                font-size: 1rem;
            }

            .latest-payslip-content p {
                font-size: .875rem;
                line-height: 1.45;
            }

            .latest-payslip-actions {
                width: 100%;
                max-width: 100%;
                display: flex !important;
                flex-direction: column !important;
                gap: .5rem !important;
            }

            .latest-payslip-actions .btn {
                width: 100%;
                max-width: 100%;
                white-space: normal;
            }

            /* ---------------------------------------------
               Payslip History Header
            --------------------------------------------- */

            .payslip-history-header {
                padding: 1rem !important;
            }

            .payslip-history-header h2 {
                font-size: 1rem;
            }

            .payslip-history-header p {
                font-size: .85rem;
            }

            /* =================================================
               MOBILE PAYSLIP TABLE -> CARDS
            ================================================= */

            .payslip-table-wrapper {
                overflow: visible;
            }

            .payslip-table,
            .payslip-table thead,
            .payslip-table tbody,
            .payslip-table tr,
            .payslip-table th,
            .payslip-table td {
                display: block;
                width: 100%;
            }

            /* Hide desktop table header */

            .payslip-table thead {
                display: none;
            }

            /* Each payslip becomes a card */

            .payslip-table tbody tr {
                margin: 0 .75rem .75rem;
                padding: .9rem;
                width: calc(100% - 1.5rem);
                border: 1px solid #e2e8f0;
                border-radius: .75rem;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
            }

            .payslip-table tbody tr:last-child {
                margin-bottom: 0;
            }

            .payslip-table td {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 1rem;
                width: 100%;
                padding: .65rem 0;
                border-bottom: 1px solid #edf0f4;
                text-align: right;
                white-space: normal !important;
            }

            .payslip-table td:last-child {
                border-bottom: 0;
            }

            .payslip-table td::before {
                content: attr(data-label);
                flex: 0 0 40%;
                font-size: .75rem;
                font-weight: 700;
                color: #6c757d;
                text-align: left;
                text-transform: uppercase;
                letter-spacing: .02em;
            }

            .payslip-table td.payslip-period {
                display: block;
                text-align: left;
                padding-top: 0;
            }

            .payslip-table td.payslip-period::before {
                display: block;
                margin-bottom: .3rem;
            }

            .payslip-table td.payslip-action {
                display: block;
                text-align: left;
                padding-bottom: 0;
            }

            .payslip-table td.payslip-action::before {
                display: block;
                margin-bottom: .5rem;
            }

            .payslip-table .payslip-action .btn {
                width: 100%;
            }

            /* ---------------------------------------------
               Empty state should NOT become a card
            --------------------------------------------- */

            .payslip-table tbody tr.empty-row {
                display: block;
                margin: 0;
                padding: 0;
                width: 100%;
                border: 0;
                box-shadow: none;
                background: transparent;
            }

            .payslip-table tbody tr.empty-row td {
                display: block;
                width: 100%;
                border: 0;
                text-align: center;
            }

            .payslip-table tbody tr.empty-row td::before {
                display: none;
            }

            .empty-payslip {
                padding: 3rem 1rem !important;
            }

            /* ---------------------------------------------
               Modal
            --------------------------------------------- */

            #payslipConcernModal .modal-dialog {
                width: calc(100% - 1rem);
                max-width: none;
                margin: .5rem auto;
            }

            #payslipConcernModal .modal-header {
                padding: .9rem 1rem;
            }

            #payslipConcernModal .modal-body {
                padding: 1rem;
            }

            #payslipConcernModal .modal-footer {
                padding: .75rem 1rem 1rem;
                display: flex;
                flex-direction: column-reverse;
                gap: .5rem;
            }

            #payslipConcernModal .modal-footer .btn {
                width: 100%;
                margin: 0;
            }
        }

        /* =========================================================
           SMALL PHONE
        ========================================================= */

        @media (max-width: 575.98px) {

            .dashboard-content>.container-fluid {
                padding-left: .6rem !important;
                padding-right: .6rem !important;
            }

            .admin-navbar .container-fluid {
                padding-left: .65rem !important;
                padding-right: .65rem !important;
            }

            .page-heading h1 {
                font-size: 1.3rem;
            }

            .page-heading .text-muted {
                font-size: .82rem;
            }

            .panel {
                border-radius: .65rem;
            }

            .latest-payslip-body {
                padding: .85rem !important;
            }

            .payslip-history-header {
                padding: .85rem !important;
            }

            .payslip-table tbody tr {
                margin-left: .6rem;
                margin-right: .6rem;
                width: calc(100% - 1.2rem);
            }

            #payslipConcernModal .modal-dialog {
                width: calc(100% - .7rem);
                margin: .35rem auto;
            }

            #payslipConcernModal .modal-header {
                padding: .8rem;
            }

            #payslipConcernModal .modal-body {
                padding: .8rem;
            }

            #payslipConcernModal .modal-footer {
                padding: .7rem .8rem .8rem;
            }
        }

        /* =========================================================
           VERY SMALL PHONE
        ========================================================= */

        @media (max-width: 380px) {

            .dashboard-content>.container-fluid {
                padding-left: .5rem !important;
                padding-right: .5rem !important;
            }

            .admin-navbar .container-fluid {
                padding-left: .5rem !important;
                padding-right: .5rem !important;
            }

            .page-heading h1 {
                font-size: 1.2rem;
            }

            .latest-payslip-body {
                padding: .75rem !important;
            }

            .payslip-history-header {
                padding: .75rem !important;
            }

            .payslip-table tbody tr {
                margin-left: .5rem;
                margin-right: .5rem;
                width: calc(100% - 1rem);
                padding: .75rem;
            }

            .payslip-table td {
                gap: .5rem;
            }

            .payslip-table td::before {
                flex-basis: 38%;
            }

            #payslipConcernModal .modal-dialog {
                width: calc(100% - .4rem);
                margin: .2rem auto;
            }

            #payslipConcernModal .modal-title {
                font-size: 1rem;
            }
        }

        /* =========================================================
           LANDSCAPE MOBILE
        ========================================================= */

        @media (max-height: 500px) and (orientation: landscape) {

            #payslipConcernModal .modal-dialog {
                margin: .4rem auto;
            }

            #payslipConcernModal .modal-content {
                max-height: calc(100vh - .8rem);
                overflow-y: auto;
            }
        }
    </style>
</head>


<body>

    <div class="admin-shell">

        <!-- SIDEBAR BACKDROP -->
        <div class="sidebar-backdrop" data-sidebar-close></div>


        <!-- =========================================================
         SIDEBAR
    ========================================================== -->

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
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

                <a class="nav-link" href="{{ route('dashboard') }}">

                    <span class="nav-icon">
                        <i class="bi bi-house-door" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Dashboard
                    </span>

                </a>


                <a class="nav-link" href="{{ route('attendance') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-check" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Attendance
                    </span>

                </a>


                <a class="nav-link" href="{{ route('file_leave') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-plus" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        File Leave
                    </span>

                </a>


                <a class="nav-link" href="{{ route('file_ob') }}">

                    <span class="nav-icon">
                        <i class="bi bi-briefcase" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        File OB
                    </span>

                </a>


                <a class="nav-link active" href="{{ route('payslip') }}" aria-current="page">

                    <span class="nav-icon">
                        <i class="bi bi-receipt" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Payslip
                    </span>

                </a>


                <a class="nav-link" href="{{ route('employee.announcements') }}">

                    <span class="nav-icon">
                        <i class="bi bi-megaphone" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Announcements
                    </span>

                </a>


                <a class="nav-link" href="{{ route('my_profile') }}">

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
                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
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


        <!-- =========================================================
         MAIN AREA
    ========================================================== -->

        <div class="admin-main">


            <!-- =====================================================
             NAVBAR
        ====================================================== -->

            <nav class="navbar admin-navbar navbar-expand bg-white">

                <div class="container-fluid px-3 px-lg-4">


                    <!-- Sidebar Toggle -->

                    <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar"
                        aria-expanded="true" aria-label="Toggle sidebar">

                        <span></span>
                        <span></span>
                        <span></span>

                    </button>


                    <!-- Search -->

                    <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">

                        <input class="form-control search-input" type="search"
                            placeholder="Search users, orders, reports" aria-label="Search">

                    </form>


                    <!-- Navbar Actions -->

                    <div class="navbar-actions ms-auto">


                        <!-- Theme -->

                        <button class="icon-button theme-toggle" type="button" data-theme-toggle
                            aria-label="Switch color theme" title="Switch color theme">

                            <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>

                        </button>


                        <!-- Notifications -->

                        <div class="dropdown">

                            <button class="icon-button" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                aria-label="Notifications">

                                <span class="notification-dot"></span>

                                <i class="bi bi-bell" aria-hidden="true"></i>

                            </button>


                            <div class="dropdown-menu dropdown-menu-end notification-menu">

                                <div class="dropdown-header fw-bold text-body">
                                    Notifications
                                </div>


                                <a class="dropdown-item" href="users.html">

                                    <span class="notification-title">
                                        New user registered
                                    </span>

                                    <span class="notification-time">
                                        4 minutes ago
                                    </span>

                                </a>


                                <a class="dropdown-item" href="charts.html">

                                    <span class="notification-title">
                                        Revenue target reached
                                    </span>

                                    <span class="notification-time">
                                        32 minutes ago
                                    </span>

                                </a>


                                <a class="dropdown-item" href="settings.html">

                                    <span class="notification-title">
                                        Security review completed
                                    </span>

                                    <span class="notification-time">
                                        1 hour ago
                                    </span>

                                </a>

                            </div>

                        </div>


                        <!-- Profile -->

                        <div class="dropdown">

                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <img class="avatar-img avatar-sm"
                                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                                    alt="{{ $employee->name ?? 'Employee' }}">

                                <span class="profile-name d-none d-sm-inline">
                                    {{ $employee->name ?? 'Employee' }}
                                </span>

                            </button>


                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>

                                    <a class="dropdown-item" href="{{ route('my_profile') }}">

                                        My Profile

                                    </a>

                                </li>


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


            <!-- =====================================================
             PAGE CONTENT
        ====================================================== -->

            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4 py-4">


                    <!-- =================================================
                     PAGE HEADER
                ================================================== -->

                    <div class="page-heading">

                        <div class="page-heading-copy">

                            <div>

                                <p class="eyebrow mb-1">
                                    Employee Payroll
                                </p>

                                <h1 class="h3 mb-1">
                                    My Payslips
                                </h1>

                                <p class="text-muted mb-0">
                                    Download and review all payslips released by HR.
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                     LATEST PAYSLIP
                ================================================== -->

                    <section class="panel mt-4">

                        <div
                            class="panel-body latest-payslip-body
                                d-flex flex-column flex-md-row
                                justify-content-between
                                align-items-center gap-3">


                            <!-- Text -->

                            <div class="latest-payslip-content">

                                <h5 class="mb-1">
                                    Latest Payslip
                                </h5>

                                <p class="text-muted mb-0">
                                    Your most recent payroll record is ready for download.
                                </p>

                            </div>


                            <!-- Buttons -->

                            <div
                                class="latest-payslip-actions
                                    d-flex flex-column flex-sm-row gap-2">


                                @if ($payslips->first())
                                    <a href="{{ route('payslip.download', $payslips->first()->id) }}"
                                        class="btn btn-primary">

                                        <i class="bi bi-download me-1"></i>

                                        Download Latest

                                    </a>
                                @else
                                    <button class="btn btn-secondary" type="button" disabled>

                                        No Payslip Yet

                                    </button>
                                @endif


                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#payslipConcernModal">

                                    <i class="bi bi-exclamation-circle me-1"></i>

                                    Appeal / Report Concern

                                </button>

                            </div>

                        </div>

                    </section>


                    <!-- =================================================
                     PAYSLIP HISTORY
                ================================================== -->

                    <section class="panel mt-4">


                        <!-- Header -->

                        <div class="panel-header payslip-history-header">

                            <div>

                                <h2 class="h5 mb-1">
                                    Payslip History
                                </h2>

                                <p class="text-muted mb-0">
                                    All released payslips from HR
                                </p>

                            </div>

                        </div>


                        <!-- Table -->

                        <div class="payslip-table-wrapper">

                            <table class="table align-middle payslip-table">

                                <thead>

                                    <tr>

                                        <th>
                                            Pay Period
                                        </th>

                                        <th>
                                            Gross
                                        </th>

                                        <th>
                                            Deductions
                                        </th>

                                        <th>
                                            Net Pay
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

                                    @forelse($payslips as $p)
                                        <tr>

                                            <td class="payslip-period" data-label="Pay Period">

                                                {{ $p->period_start->format('M d, Y') }}
                                                -
                                                {{ $p->period_end->format('M d, Y') }}

                                            </td>


                                            <td data-label="Gross">

                                                ₱ {{ number_format($p->gross_salary, 2) }}

                                            </td>


                                            <td data-label="Deductions">

                                                ₱
                                                {{ number_format(
                                                    $p->sss + $p->philhealth + $p->pagibig + $p->hmo + $p->late_deduction + $p->undertime_deduction,
                                                    2,
                                                ) }}

                                            </td>


                                            <td data-label="Net Pay" class="fw-bold">

                                                ₱ {{ number_format($p->net_salary, 2) }}

                                            </td>


                                            <td data-label="Status">

                                                @if ($p->status == 'Generated')
                                                    <span class="badge bg-warning">
                                                        Generated
                                                    </span>
                                                @elseif ($p->status == 'Sent')
                                                    <span class="badge bg-success">
                                                        Sent
                                                    </span>
                                                @elseif ($p->status == 'Viewed')
                                                    <span class="badge bg-info">
                                                        Viewed
                                                    </span>
                                                @endif

                                            </td>


                                            <td class="payslip-action" data-label="Action">

                                                @if (in_array($p->status, ['Generated', 'Sent', 'Viewed']))
                                                    <a href="{{ route('payslip.download', $p->id) }}"
                                                        class="btn btn-sm btn-outline-primary">

                                                        <i class="bi bi-download"></i>

                                                        Download

                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-secondary" type="button" disabled>

                                                        Not Available

                                                    </button>
                                                @endif

                                            </td>

                                        </tr>

                                    @empty

                                        <tr class="empty-row">

                                            <td colspan="6" class="text-center py-5 empty-payslip">

                                                <i class="bi bi-receipt fs-1 text-muted"></i>

                                                <h5 class="mt-3">
                                                    No Payslip Found
                                                </h5>

                                                <p class="text-muted mb-0">
                                                    Your payslips will appear here once released by HR
                                                </p>

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </section>

                </div>

            </main>


            <!-- =====================================================
             FOOTER
        ====================================================== -->

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">

                    <span>
                        Copyright 2026 adminHMD.
                        <br>

                        Developed by

                        <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">

                            Md. Hasan Mahmud

                        </a>

                        • Distributed by

                        <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">

                            ThemeWagon

                        </a>

                    </span>


                    <span>
                        Professional dashboard template.
                    </span>


                    <span>
                        Responsive table examples.
                    </span>

                </div>

            </footer>

        </div>

    </div>


    <!-- =========================================================
     PAYSLIP CONCERN MODAL
========================================================== -->

    <div class="modal fade" id="payslipConcernModal" tabindex="-1" aria-labelledby="payslipConcernModalLabel"
        aria-hidden="true">


        <div class="modal-dialog modal-dialog-centered">


            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <div class="min-w-0">

                        <h5 class="modal-title" id="payslipConcernModalLabel">

                            Appeal / Report Payslip Concern

                        </h5>

                        <small class="text-muted">

                            Please provide the details of your concern.

                        </small>

                    </div>


                    <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>


                <!-- Form -->

                <form method="POST" action="{{ route('payslip.concern.store') }}" enctype="multipart/form-data">

                    @csrf


                    <div class="modal-body">


                        <!-- Payslip -->

                        <div class="mb-3">

                            <label for="payslip_id" class="form-label fw-semibold">

                                Payslip

                            </label>


                            <select name="payslip_id" id="payslip_id" class="form-select" required>

                                <option value="">
                                    Select the payslip you have a concern about
                                </option>


                                @foreach ($payslips as $p)
                                    <option value="{{ $p->id }}">

                                        {{ $p->period_start->format('M d, Y') }}
                                        -
                                        {{ $p->period_end->format('M d, Y') }}

                                        — ₱{{ number_format($p->net_salary, 2) }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <!-- Reason -->

                        <div class="mb-3">

                            <label for="reason" class="form-label fw-semibold">

                                Reason / Concern

                            </label>


                            <textarea name="reason" id="reason" class="form-control" rows="5"
                                placeholder="Please explain your concern about this payslip..." maxlength="2000" required></textarea>


                            <div class="form-text">

                                Please provide enough information for HR to investigate your concern.

                            </div>

                        </div>


                        <!-- Attachment -->

                        <div class="mb-3">

                            <label for="attachment" class="form-label fw-semibold">

                                Upload Payslip / Supporting Document

                            </label>


                            <input type="file" name="attachment" id="attachment" class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png">


                            <div class="form-text">

                                Optional. PDF, JPG, or PNG only. Maximum 5MB.

                            </div>

                        </div>


                        <!-- Notice -->

                        <div class="alert alert-warning mb-0">

                            <i class="bi bi-info-circle me-1"></i>

                            Your concern will be sent to HR/Admin for review.
                            Please make sure the information you provide is accurate.

                        </div>

                    </div>


                    <!-- Modal Footer -->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Cancel

                        </button>


                        <button type="submit" class="btn btn-danger">

                            <i class="bi bi-send me-1"></i>

                            Submit Concern

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <!-- =========================================================
     JAVASCRIPT
========================================================== -->

    <script src="../../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../../khen/assets/js/main.js"></script>

</body>

</html>
