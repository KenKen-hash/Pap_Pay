<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Pap Pay Subject Assignment">

    <title>Subject Assignment | Pap Pay</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>

        /* =========================================================
           PAGE
        ========================================================= */

        .subject-assignment-page {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }


        /* =========================================================
           CARDS
        ========================================================= */

        .subject-card {
            border: 1px solid #e9ecef;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .subject-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f2;
            background: #fff;
        }

        .subject-card-header h2 {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0;
        }

        .subject-card-header p {
            font-size: 0.85rem;
            margin: 4px 0 0;
        }

        .subject-card-body {
            padding: 20px;
        }


        /* =========================================================
           FORM
        ========================================================= */

        .form-label {
            font-weight: 600;
            font-size: 0.86rem;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            min-height: 43px;
            border-radius: 9px;
        }

        .form-text {
            font-size: 0.75rem;
        }


        /* =========================================================
           EMPLOYEE PREVIEW
        ========================================================= */

        .employee-info {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 15px;
            background: #f8f9fa;
            height: 100%;
        }

        .employee-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .employee-info-label {
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 3px;
        }

        .employee-info-value {
            font-weight: 700;
            font-size: 0.95rem;
            word-break: break-word;
        }

        .employment-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.74rem;
            font-weight: 600;
            background: #eef7f1;
            color: #198754;
            white-space: nowrap;
        }


        /* =========================================================
           SUMMARY
        ========================================================= */

        .assignment-summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .summary-item {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 16px;
            background: #fff;
            min-width: 0;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f8f4;
            color: #198754;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .summary-label {
            font-size: 0.76rem;
            color: #6c757d;
            margin-bottom: 3px;
        }

        .summary-value {
            font-size: 1.15rem;
            font-weight: 700;
            word-break: break-word;
        }


        /* =========================================================
           TABLE
        ========================================================= */

        .subject-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .subject-table {
            width: 100%;
            min-width: 1100px;
            margin: 0;
            vertical-align: middle;
        }

        .subject-table th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            color: #6c757d;
            white-space: nowrap;
            background: #f8f9fa;
            padding: 13px 12px;
        }

        .subject-table td {
            padding: 14px 12px;
            font-size: 0.87rem;
        }

        .subject-name {
            font-weight: 700;
        }

        .rate-value {
            font-weight: 700;
        }

        .schedule-value {
            white-space: nowrap;
        }


        /* =========================================================
           NOTE
        ========================================================= */

        .assignment-note {
            border-left: 4px solid #198754;
            background: #f5faf7;
            border-radius: 8px;
            padding: 13px 15px;
            font-size: 0.82rem;
            color: #495057;
        }


        /* =========================================================
           BUTTONS
        ========================================================= */

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #6c757d;
        }

        .empty-state-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.6;
        }

        .empty-state h5 {
            font-size: 1rem;
            font-weight: 700;
            color: #495057;
        }


        /* =========================================================
           ALERTS
        ========================================================= */

        .page-alert {
            border-radius: 10px;
            font-size: 0.85rem;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1199.98px) {

            .assignment-summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 767.98px) {

            .subject-card-header,
            .subject-card-body {
                padding: 15px;
            }

            .assignment-summary {
                grid-template-columns: 1fr 1fr;
                gap: 9px;
            }

            .summary-item {
                padding: 13px;
            }

            .summary-value {
                font-size: 1rem;
            }

            .employee-info {
                padding: 13px;
            }

            .action-buttons {
                justify-content: stretch;
            }

            .action-buttons .btn {
                flex: 1 1 auto;
            }

        }


        @media (max-width: 575.98px) {

            .assignment-summary {
                grid-template-columns: 1fr;
            }

            .summary-item {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .summary-icon {
                margin: 0;
                flex-shrink: 0;
            }

            .summary-content {
                min-width: 0;
            }

            .subject-card-header h2 {
                font-size: 0.98rem;
            }

            .subject-card-header p {
                font-size: 0.78rem;
            }

            .btn {
                width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .employee-info {
                min-height: auto;
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

    <aside class="admin-sidebar"
           id="adminSidebar"
           aria-label="Main navigation">

        <div class="sidebar-header">

            <a class="brand-mark"
               href="{{ route('admin-dashboard') }}"
               aria-label="Pap Pay dashboard">

                <span class="brand-icon">
                    <i class="bi bi-grid-1x2-fill"
                       aria-hidden="true"></i>
                </span>

                <span class="brand-copy">

                    <span class="brand-title">
                        Pap Pay
                    </span>

                    <span class="brand-subtitle">
                        Payroll Management
                    </span>

                </span>

            </a>

        </div>


        <nav class="sidebar-nav">

            <a class="nav-link"
               href="{{ route('admin-dashboard') }}">

                <span class="nav-icon">
                    <i class="bi bi-speedometer2"></i>
                </span>

                <span class="nav-text">
                    Dashboard
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


            <a class="nav-link active"
               href="{{ route('subject_assignment') }}">

                <span class="nav-icon">
                    <i class="bi bi-journal-bookmark"></i>
                </span>

                <span class="nav-text">
                    Subject Assignment
                </span>

            </a>


            <a class="nav-link"
               href="{{ route('settings') }}">

                <span class="nav-icon">
                    <i class="bi bi-gear"></i>
                </span>

                <span class="nav-text">
                    Settings
                </span>

            </a>

        </nav>


        <!-- SIDEBAR USER -->

        <div class="sidebar-user">

            <img
                class="avatar-img avatar-md sidebar-user-avatar"
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

                <button
                    class="sidebar-toggle"
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
                    class="d-none d-md-flex ms-3 flex-grow-1"
                    role="search">

                    <input
                        class="form-control search-input"
                        type="search"
                        placeholder="Search employees, subjects..."
                        aria-label="Search">

                </form>


                <div class="navbar-actions ms-auto">

                    <button
                        class="icon-button theme-toggle"
                        type="button"
                        data-theme-toggle
                        aria-label="Switch color theme"
                        title="Switch color theme">

                        <i
                            class="bi bi-moon-stars"
                            data-theme-icon
                            aria-hidden="true">
                        </i>

                    </button>


                    <div class="dropdown">

                        <button
                            class="icon-button"
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

                            <a
                                class="dropdown-item"
                                href="{{ route('employees.index') }}">

                                <span class="notification-title">
                                    Employee management
                                </span>

                                <span class="notification-time">
                                    View employees
                                </span>

                            </a>


                            <a
                                class="dropdown-item"
                                href="{{ route('payroll') }}">

                                <span class="notification-title">
                                    Payroll
                                </span>

                                <span class="notification-time">
                                    Manage payroll
                                </span>

                            </a>


                            <a
                                class="dropdown-item"
                                href="{{ route('subject_assignment') }}">

                                <span class="notification-title">
                                    Subject assignments
                                </span>

                                <span class="notification-time">
                                    Manage assignments
                                </span>

                            </a>

                        </div>

                    </div>


                    <!-- PROFILE -->

                    <div class="dropdown">

                        <button
                            class="profile-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <img
                                class="avatar-img avatar-sm"
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

                                <a
                                    class="dropdown-item"
                                    href="{{ route('employees.index') }}">

                                    Employees

                                </a>

                            </li>


                            <li>

                                <a
                                    class="dropdown-item"
                                    href="{{ route('settings') }}">

                                    Account settings

                                </a>

                            </li>


                            <li>

                                <hr class="dropdown-divider">

                            </li>


                            <li>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}">

                                    @csrf

                                    <button
                                        type="submit"
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

            <div class="container-fluid px-3 px-lg-4 py-4 subject-assignment-page">


                <!-- PAGE HEADING -->

                <div class="page-heading mb-4">

                    <div class="page-heading-copy">

                        <span class="page-icon">

                            <i
                                class="bi bi-journal-bookmark"
                                aria-hidden="true">
                            </i>

                        </span>


                        <div>

                            <p class="eyebrow mb-1">
                                Payroll Management
                            </p>

                            <h1 class="h3 mb-1">
                                Subject Assignment
                            </h1>

                            <p class="text-muted mb-0">
                                Assign subjects and payroll information to
                                part-time employees.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     SUCCESS
                ================================================== -->

                @if(session('success'))

                    <div class="alert alert-success page-alert alert-dismissible fade show"
                         role="alert">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif


                <!-- =================================================
                     ERROR
                ================================================== -->

                @if(session('error'))

                    <div class="alert alert-danger page-alert alert-dismissible fade show"
                         role="alert">

                        <i class="bi bi-exclamation-circle me-2"></i>

                        {{ session('error') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif


                <!-- =================================================
                     VALIDATION ERRORS
                ================================================== -->

                @if($errors->any())

                    <div class="alert alert-danger page-alert">

                        <strong>
                            Please correct the following:
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- =================================================
                     SUMMARY
                ================================================== -->

                <div class="assignment-summary">


                    <!-- PART-TIME EMPLOYEES -->

                    <div class="summary-item">

                        <div class="summary-icon">

                            <i class="bi bi-people"></i>

                        </div>

                        <div class="summary-content">

                            <div class="summary-label">
                                Part-Time Employees
                            </div>

                            <div class="summary-value">
                                {{ $partTimeEmployees->count() ?? 0 }}
                            </div>

                        </div>

                    </div>


                    <!-- ASSIGNED SUBJECTS -->

                    <div class="summary-item">

                        <div class="summary-icon">

                            <i class="bi bi-journal-text"></i>

                        </div>

                        <div class="summary-content">

                            <div class="summary-label">
                                Assigned Subjects
                            </div>

                            <div class="summary-value">
                                {{ $assignments->count() ?? 0 }}
                            </div>

                        </div>

                    </div>


                    <!-- AVERAGE RATE -->

                    <div class="summary-item">

                        <div class="summary-icon">

                            <i class="bi bi-currency-exchange"></i>

                        </div>

                        <div class="summary-content">

                            <div class="summary-label">
                                Average Rate / Subject
                            </div>

                            <div class="summary-value">

                                ₱{{ number_format($averageRate ?? 0, 2) }}

                            </div>

                        </div>

                    </div>


                    <!-- CLASSES -->

                    <div class="summary-item">

                        <div class="summary-icon">

                            <i class="bi bi-calendar3"></i>

                        </div>

                        <div class="summary-content">

                            <div class="summary-label">
                                Default Classes / Month
                            </div>

                            <div class="summary-value">

                                {{ number_format($defaultClassesPerMonth ?? 0, 0) }}

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     ASSIGN SUBJECT
                ================================================== -->

                <div class="subject-card mb-4">

                    <div class="subject-card-header">

                        <h2>

                            <i class="bi bi-plus-circle me-2"></i>

                            Assign Subject

                        </h2>

                        <p class="text-muted">

                            Create a subject assignment for a part-time
                            employee.

                        </p>

                    </div>


                    <div class="subject-card-body">

                        <form
                            method="POST"
                            action="{{ route('subject_assignment.store') }}">

                            @csrf


                            <div class="row g-3">


                                <!-- =================================================
                                     EMPLOYEE
                                ================================================== -->

                                <div class="col-12 col-lg-6">

                                    <label
                                        for="employee_id"
                                        class="form-label">

                                        Part-Time Employee

                                    </label>

                                    <select
                                        name="employee_id"
                                        id="employee_id"
                                        class="form-select @error('employee_id') is-invalid @enderror"
                                        required>

                                        <option value="">
                                            Select Part-Time Employee
                                        </option>

                                        @foreach($partTimeEmployees ?? [] as $employee)

                                            <option
                                                value="{{ $employee->id }}"
                                                data-name="{{ trim(($employee->first_name ?? '') . ' ' . ($employee->last_name ?? '')) }}"
                                                data-type="{{ $employee->employment_type ?? 'Part-Time' }}"
                                                data-photo="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}>

                                                {{ trim(($employee->first_name ?? '') . ' ' . ($employee->last_name ?? '')) }}

                                                —

                                                {{ $employee->employee_id }}

                                            </option>

                                        @endforeach

                                    </select>

                                    @error('employee_id')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <div class="form-text">

                                        Only employees whose employment type is
                                        Part-Time should appear here.

                                    </div>

                                </div>


                                <!-- =================================================
                                     EMPLOYEE INFORMATION
                                ================================================== -->

                                <div class="col-12 col-lg-6">

                                    <label class="form-label">
                                        Employee Information
                                    </label>

                                    <div class="employee-info">

                                        <div class="d-flex align-items-center gap-3">

                                            <img
                                                id="employeePreviewPhoto"
                                                class="employee-avatar"
                                                src="{{ asset('khen/assets/images/avatar/avatar.jpg') }}"
                                                alt="Employee">

                                            <div class="min-width-0">

                                                <div class="employee-info-label">
                                                    Selected Employee
                                                </div>

                                                <div
                                                    id="employeePreviewName"
                                                    class="employee-info-value">

                                                    No employee selected

                                                </div>

                                                <span
                                                    id="employeePreviewType"
                                                    class="employment-badge mt-1">

                                                    Part-Time

                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <!-- =================================================
                                     SUBJECT NAME
                                ================================================== -->

                                <div class="col-12 col-md-6">

                                    <label
                                        for="subject_name"
                                        class="form-label">

                                        Subject Name

                                    </label>

                                    <input
                                        type="text"
                                        name="subject_name"
                                        id="subject_name"
                                        class="form-control @error('subject_name') is-invalid @enderror"
                                        value="{{ old('subject_name') }}"
                                        placeholder="e.g. Mathematics"
                                        maxlength="255"
                                        required>

                                    @error('subject_name')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                <!-- =================================================
                                     RATE PER SUBJECT
                                ================================================== -->

                                <div class="col-12 col-md-6">

                                    <label
                                        for="rate_per_subject"
                                        class="form-label">

                                        Rate Per Subject

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            name="rate_per_subject"
                                            id="rate_per_subject"
                                            class="form-control @error('rate_per_subject') is-invalid @enderror"
                                            value="{{ old('rate_per_subject') }}"
                                            min="0"
                                            step="0.01"
                                            placeholder="0.00"
                                            required>

                                    </div>

                                    @error('rate_per_subject')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <div class="form-text">

                                        Rate assigned for each subject.

                                    </div>

                                </div>


                                <!-- =================================================
                                     CLASSES PER MONTH
                                ================================================== -->

                                <div class="col-12 col-md-4">

                                    <label
                                        for="classes_per_month"
                                        class="form-label">

                                        Classes Per Month

                                    </label>

                                    <input
                                        type="number"
                                        name="classes_per_month"
                                        id="classes_per_month"
                                        class="form-control @error('classes_per_month') is-invalid @enderror"
                                        value="{{ old('classes_per_month', $defaultClassesPerMonth ? round($defaultClassesPerMonth) : 4) }}"
                                        min="1"
                                        step="1"
                                        required>

                                    @error('classes_per_month')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <div class="form-text">

                                        Expected number of classes per month.

                                    </div>

                                </div>


                                <!-- =================================================
                                     DAY OF WEEK
                                ================================================== -->

                                <div class="col-12 col-md-4">

                                    <label
                                        for="day_of_week"
                                        class="form-label">

                                        Day of Week

                                    </label>

                                    <select
                                        name="day_of_week"
                                        id="day_of_week"
                                        class="form-select @error('day_of_week') is-invalid @enderror"
                                        required>

                                        <option value="">
                                            Select Day
                                        </option>

                                        <option
                                            value="Monday"
                                            {{ old('day_of_week') === 'Monday' ? 'selected' : '' }}>
                                            Monday
                                        </option>

                                        <option
                                            value="Tuesday"
                                            {{ old('day_of_week') === 'Tuesday' ? 'selected' : '' }}>
                                            Tuesday
                                        </option>

                                        <option
                                            value="Wednesday"
                                            {{ old('day_of_week') === 'Wednesday' ? 'selected' : '' }}>
                                            Wednesday
                                        </option>

                                        <option
                                            value="Thursday"
                                            {{ old('day_of_week') === 'Thursday' ? 'selected' : '' }}>
                                            Thursday
                                        </option>

                                        <option
                                            value="Friday"
                                            {{ old('day_of_week') === 'Friday' ? 'selected' : '' }}>
                                            Friday
                                        </option>

                                        <option
                                            value="Saturday"
                                            {{ old('day_of_week') === 'Saturday' ? 'selected' : '' }}>
                                            Saturday
                                        </option>

                                        <option
                                            value="Sunday"
                                            {{ old('day_of_week') === 'Sunday' ? 'selected' : '' }}>
                                            Sunday
                                        </option>

                                    </select>

                                    @error('day_of_week')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <div class="form-text">

                                        Select the regular teaching day.

                                    </div>

                                </div>


                                <!-- =================================================
                                     START TIME
                                ================================================== -->

                                <div class="col-12 col-md-4">

                                    <label
                                        for="start_time"
                                        class="form-label">

                                        Start Time

                                    </label>

                                    <input
                                        type="time"
                                        name="start_time"
                                        id="start_time"
                                        class="form-control @error('start_time') is-invalid @enderror"
                                        value="{{ old('start_time') }}"
                                        required>

                                    @error('start_time')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <div class="form-text">

                                        Regular class starting time.

                                    </div>

                                </div>


                                <!-- =================================================
                                     END TIME
                                ================================================== -->

                                <div class="col-12 col-md-4">

                                    <label
                                        for="end_time"
                                        class="form-label">

                                        End Time

                                    </label>

                                    <input
                                        type="time"
                                        name="end_time"
                                        id="end_time"
                                        class="form-control @error('end_time') is-invalid @enderror"
                                        value="{{ old('end_time') }}"
                                        required>

                                    @error('end_time')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <div class="form-text">

                                        Regular class ending time.

                                    </div>

                                </div>


                                <!-- =================================================
                                     PAYROLL EXPLANATION
                                ================================================== -->

                                <div class="col-12">

                                    <div class="assignment-note">

                                        <strong>

                                            <i class="bi bi-info-circle me-1"></i>

                                            Part-Time Payroll

                                        </strong>

                                        <br>

                                        The employee is paid according to
                                        assigned subjects. The subject rate,
                                        classes per month, and actual
                                        attendance will be used when
                                        calculating the employee's part-time
                                        payroll.

                                        <br><br>

                                        The assigned day and class schedule
                                        will be used to determine the
                                        employee's expected teaching
                                        schedule.

                                        <br><br>

                                        For a 15-day payroll period, the
                                        monthly subject amount can be
                                        divided by <strong>2</strong> during
                                        payroll calculation.

                                    </div>

                                </div>


                                <!-- =================================================
                                     BUTTONS
                                ================================================== -->

                                <div class="col-12">

                                    <div class="action-buttons">

                                        <button
                                            type="reset"
                                            class="btn btn-light border">

                                            <i class="bi bi-arrow-counterclockwise me-1"></i>

                                            Clear

                                        </button>


                                        <button
                                            type="submit"
                                            class="btn btn-success">

                                            <i class="bi bi-check2-circle me-1"></i>

                                            Save Assignment

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>


                <!-- =================================================
                     CURRENT ASSIGNMENTS
                ================================================== -->

                <div class="subject-card">

                    <div class="subject-card-header">

                        <h2>

                            <i class="bi bi-list-check me-2"></i>

                            Current Subject Assignments

                        </h2>

                        <p class="text-muted">

                            Manage subjects assigned to part-time employees.

                        </p>

                    </div>


                    <div class="subject-card-body p-0">

                        @if(isset($assignments) && $assignments->count())

                            <div class="subject-table-wrapper">

                                <table class="table subject-table mb-0">

                                    <thead>

                                        <tr>

                                            <th>
                                                Employee
                                            </th>

                                            <th>
                                                Employment Type
                                            </th>

                                            <th>
                                                Subject
                                            </th>

                                            <th>
                                                Rate / Subject
                                            </th>

                                            <th>
                                                Classes / Month
                                            </th>

                                            <th>
                                                Day
                                            </th>

                                            <th>
                                                Start Time
                                            </th>

                                            <th>
                                                End Time
                                            </th>

                                            <th>
                                                Actions
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @foreach($assignments as $assignment)

                                            <tr>

                                                <!-- EMPLOYEE -->

                                                <td>

                                                    <div class="fw-bold">

                                                        {{ $assignment->employee->first_name ?? '' }}

                                                        {{ $assignment->employee->last_name ?? '' }}

                                                    </div>

                                                    <small class="text-muted">

                                                        {{ $assignment->employee->employee_id ?? 'N/A' }}

                                                    </small>

                                                </td>


                                                <!-- EMPLOYMENT TYPE -->

                                                <td>

                                                    <span class="employment-badge">

                                                        {{ $assignment->employee->employment_type ?? 'Part-Time' }}

                                                    </span>

                                                </td>


                                                <!-- SUBJECT -->

                                                <td>

                                                    <span class="subject-name">

                                                        {{ $assignment->subject_name }}

                                                    </span>

                                                </td>


                                                <!-- RATE -->

                                                <td>

                                                    <span class="rate-value">

                                                        ₱{{ number_format($assignment->rate_per_subject, 2) }}

                                                    </span>

                                                </td>


                                                <!-- CLASSES -->

                                                <td>

                                                    {{ $assignment->classes_per_month }}

                                                </td>


                                                <!-- DAY -->

                                                <td>

                                                    <span class="schedule-value">

                                                        {{ $assignment->day_of_week }}

                                                    </span>

                                                </td>


                                                <!-- START TIME -->

                                                <td>

                                                    <span class="schedule-value">

                                                        {{ \Carbon\Carbon::parse($assignment->start_time)->format('h:i A') }}

                                                    </span>

                                                </td>


                                                <!-- END TIME -->

                                                <td>

                                                    <span class="schedule-value">

                                                        {{ \Carbon\Carbon::parse($assignment->end_time)->format('h:i A') }}

                                                    </span>

                                                </td>


                                                <!-- ACTION -->

                                                <td>

                                                    <div class="d-flex gap-1">

                                                        <a
                                                            href="{{ route('subject_assignment.edit', $assignment->id) }}"
                                                            class="btn btn-sm btn-outline-primary"
                                                            title="Edit">

                                                            <i class="bi bi-pencil"></i>

                                                        </a>


                                                        <form
                                                            method="POST"
                                                            action="{{ route('subject_assignment.destroy', $assignment->id) }}"
                                                            onsubmit="return confirm('Are you sure you want to remove this subject assignment?');">

                                                            @csrf

                                                            @method('DELETE')

                                                            <button
                                                                type="submit"
                                                                class="btn btn-sm btn-outline-danger"
                                                                title="Delete">

                                                                <i class="bi bi-trash"></i>

                                                            </button>

                                                        </form>

                                                    </div>

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        @else

                            <div class="empty-state">

                                <div class="empty-state-icon">

                                    <i class="bi bi-journal-x"></i>

                                </div>

                                <h5>
                                    No Subject Assignments
                                </h5>

                                <p class="mb-0">

                                    No subjects have been assigned to
                                    part-time employees yet.

                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </main>


        <!-- =========================================================
             FOOTER
        ========================================================== -->

        <footer class="admin-footer">

            <div class="container-fluid px-3 px-lg-4">

                <span>

                    Copyright 2026 Pap Pay.

                    <br>

                    Developed by

                    <a
                        target="_blank"
                        class="fw-bold text-success"
                        href="https://github.com/HasanMahmudDev">

                        Md. Hasan Mahmud

                    </a>

                    • Distributed by

                    <a
                        target="_blank"
                        class="fw-bold text-success"
                        href="https://themewagon.com">

                        ThemeWagon

                    </a>

                </span>


                <span>
                    Payroll Management System.
                </span>


                <span>
                    Subject Assignment.
                </span>

            </div>

        </footer>

    </div>

</div>


<!-- =============================================================
     SCRIPTS
============================================================= -->

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../../khen/assets/js/main.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const employeeSelect =
        document.getElementById('employee_id');

    const employeePreviewName =
        document.getElementById('employeePreviewName');

    const employeePreviewType =
        document.getElementById('employeePreviewType');

    const employeePreviewPhoto =
        document.getElementById('employeePreviewPhoto');


    if (!employeeSelect) {
        return;
    }


    function updateEmployeePreview() {

        const selectedOption =
            employeeSelect.options[
                employeeSelect.selectedIndex
            ];


        if (!employeeSelect.value) {

            employeePreviewName.textContent =
                'No employee selected';

            employeePreviewType.textContent =
                'Part-Time';

            employeePreviewPhoto.src =
                "{{ asset('khen/assets/images/avatar/avatar.jpg') }}";

            return;
        }


        const name =
            selectedOption.dataset.name ||
            selectedOption.text.trim();


        const type =
            selectedOption.dataset.type ||
            'Part-Time';


        const photo =
            selectedOption.dataset.photo ||
            "{{ asset('khen/assets/images/avatar/avatar.jpg') }}";


        employeePreviewName.textContent =
            name;

        employeePreviewType.textContent =
            type;

        employeePreviewPhoto.src =
            photo;

    }


    employeeSelect.addEventListener(
        'change',
        updateEmployeePreview
    );


    updateEmployeePreview();

});

</script>

</body>
</html>
