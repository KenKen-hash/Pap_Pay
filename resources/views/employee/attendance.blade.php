@php
    $employee = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Attendance</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
</head>

<body>
    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('dashboard') }}" aria-label="adminHMD dashboard">
                    <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
                    <span class="brand-copy">
                        <span class="brand-title">adminHMD</span>
                        <span class="brand-subtitle">Admin Template</span>
                    </span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <span class="nav-icon"><i class="bi bi-house-door" aria-hidden="true"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a class="nav-link active" href="{{ route('attendance') }}" aria-current="page">
                    <span class="nav-icon"><i class="bi bi-calendar-check" aria-hidden="true"></i></span>
                    <span class="nav-text">Attendance</span>
                </a>
                <a class="nav-link" href="{{ route('file_leave') }}">
                    <span class="nav-icon"><i class="bi bi-calendar-plus" aria-hidden="true"></i></span>
                    <span class="nav-text">File Leave</span>
                </a>
                <a class="nav-link" href="{{ route('file_ob') }}">
                    <span class="nav-icon"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
                    <span class="nav-text">File OB</span>
                </a>
                <a class="nav-link" href="{{ route('payslip') }}">
                    <span class="nav-icon"><i class="bi bi-receipt" aria-hidden="true"></i></span>
                    <span class="nav-text">Payslip</span>
                </a>
                <a class="nav-link" href="{{ route('my_profile') }}">
                    <span class="nav-icon"><i class="bi bi-person" aria-hidden="true"></i></span>
                    <span class="nav-text">My Profile</span>
                </a>
            </nav>

            <div class="sidebar-user">
                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                    alt="{{ $employee->name ?? 'Employee' }}">
                <strong>{{ $employee->name ?? 'Employee Name' }}</strong>
                <small>{{ $employee->position ?? 'Position' }}</small>
            </div>

            <div class="sidebar-footer">
                <span class="status-dot"></span>
                <span class="sidebar-footer-text">System running smoothly</span>
            </div>
        </aside>

        <div class="admin-main">
            <nav class="navbar admin-navbar navbar-expand bg-white">
                <div class="container-fluid px-3 px-lg-4">
                    <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar"
                        aria-expanded="true" aria-label="Toggle sidebar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <form class="d-none d-md-flex ms-3 flex-grow-1" action="{{ route('search') }}" method="GET">

                        <input class="form-control search-input" type="search" name="search"
                            placeholder="Search attendance records..." required>

                    </form>

                    <div class="navbar-actions ms-auto">
                        <button class="icon-button theme-toggle" type="button" data-theme-toggle
                            aria-label="Switch color theme" title="Switch color theme">
                            <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
                        </button>
                        <div class="dropdown">
                            <button class="icon-button" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                aria-label="Notifications">
                                <span class="notification-dot"></span>
                                <i class="bi bi-bell" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end notification-menu">
                                <div class="dropdown-header fw-bold text-body">Notifications</div>
                                <a class="dropdown-item" href="{{ route('attendance') }}">
                                    <span class="notification-title">New user registered</span>
                                    <span class="notification-time">4 minutes ago</span>
                                </a>
                                <a class="dropdown-item" href="charts.html">
                                    <span class="notification-title">Revenue target reached</span>
                                    <span class="notification-time">32 minutes ago</span>
                                </a>
                                <a class="dropdown-item" href="settings.html">
                                    <span class="notification-title">Security review completed</span>
                                    <span class="notification-time">1 hour ago</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown">

                                <img class="avatar-img avatar-sm"
                                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                                    alt="{{ $employee->name }}">

                                <span class="profile-name d-none d-sm-inline">
                                    {{ $employee->name }}
                                </span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('my_profile') }}">
                                        My Profile
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
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

            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4 py-4">

                    <!-- Employee Card -->

                    <section class="panel mt-3">

                        <div class="panel-body">

                            <div class="row align-items-center">

                                <div class="col-lg-8">

                                    <div class="d-flex align-items-center gap-3">

                                        <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                                            class="rounded-circle shadow" width="90" height="90"
                                            style="object-fit:cover;">

                                        <div>

                                            <h3 class="mb-1">

                                                Welcome,
                                                {{ $employee->name }}

                                            </h3>

                                            <p class="text-muted mb-1">

                                                {{ $employee->position }}

                                            </p>

                                            <span class="badge bg-primary">

                                                {{ $employee->department }}

                                            </span>

                                            <span class="badge bg-success">

                                                Employee ID :
                                                {{ $employee->employee_id }}

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-4 text-end">

                                    <h5 class="text-muted">

                                        Today

                                    </h5>

                                    <h3>

                                        {{ now()->format('F d, Y') }}

                                    </h3>

                                </div>

                            </div>

                        </div>

                    </section>

                    <!-- Page Heading -->
                    <div class="page-heading">
                        <div class="page-heading-copy">

                            <span class="page-icon">
                                <i class="bi bi-calendar-check"></i>
                            </span>

                            <div>
                                <br>
                                <h1 class="h3 mb-1">
                                    Attendance
                                </h1>

                                <p class="text-muted mb-0">
                                    View your daily attendance records monitored through the Face Recognition Attendance
                                    System.
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Summary Cards -->

                    <section class="row g-3 mt-3">

                        <div class="col-md-6 col-xl-3">

                            <article class="metric-card metric-success">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Present

                                    </span>

                                    <span class="metric-icon">

                                        <i class="bi bi-check-circle-fill"></i>

                                    </span>

                                </div>

                                <div class="metric-value">

                                    {{ $presentDays }}

                                </div>

                                <div class="metric-meta">

                                    Total Present Days

                                </div>

                            </article>

                        </div>

                        <div class="col-md-6 col-xl-3">

                            <article class="metric-card metric-warning">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Late

                                    </span>

                                    <span class="metric-icon">

                                        <i class="bi bi-alarm-fill"></i>

                                    </span>

                                </div>

                                <div class="metric-value">

                                    {{ $lateDays }}

                                </div>

                                <div class="metric-meta">

                                    Late Records

                                </div>

                            </article>

                        </div>

                        <div class="col-md-6 col-xl-3">

                            <article class="metric-card metric-danger">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Absent

                                    </span>

                                    <span class="metric-icon">

                                        <i class="bi bi-x-circle-fill"></i>

                                    </span>

                                </div>

                                <div class="metric-value">

                                    {{ $absentDays }}

                                </div>

                                <div class="metric-meta">

                                    Absent Records

                                </div>

                            </article>

                        </div>

                        <div class="col-md-6 col-xl-3">

                            <article class="metric-card metric-primary">

                                <div class="metric-top">

                                    <span class="metric-label">

                                        Leave / OB

                                    </span>

                                    <span class="metric-icon">

                                        <i class="bi bi-briefcase-fill"></i>

                                    </span>

                                </div>

                                <div class="metric-value">

                                    {{ $leaveDays + $officialBusinessDays }}

                                </div>

                                <div class="metric-meta">

                                    Leave & Official Business

                                </div>

                            </article>

                        </div>

                    </section>



                    <!-- Today's Attendance -->

                    <section class="panel mt-4">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1">

                                    Today's Attendance

                                </h2>

                                <p class="text-muted mb-0">

                                    Automatically recorded by the Face Recognition System

                                </p>

                            </div>

                        </div>

                        <div class="row g-3">

                            <div class="col-md-3">

                                <div class="border rounded p-3 text-center">

                                    <small class="text-muted">

                                        Morning Time In

                                    </small>

                                    <h4 class="mt-2">

                                        {{ $todayAttendance && $todayAttendance->morning_time_in
                                            ? \Carbon\Carbon::parse($todayAttendance->morning_time_in)->format('h:i A')
                                            : '--' }}

                                    </h4>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="border rounded p-3 text-center">

                                    <small class="text-muted">

                                        Morning Time Out

                                    </small>

                                    <h4 class="mt-2">

                                        {{ $todayAttendance && $todayAttendance->morning_time_out
                                            ? \Carbon\Carbon::parse($todayAttendance->morning_time_out)->format('h:i A')
                                            : '--' }}

                                    </h4>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="border rounded p-3 text-center">

                                    <small class="text-muted">

                                        Afternoon Time In

                                    </small>

                                    <h4 class="mt-2">

                                        {{ $todayAttendance && $todayAttendance->afternoon_time_in
                                            ? \Carbon\Carbon::parse($todayAttendance->afternoon_time_in)->format('h:i A')
                                            : '--' }}

                                    </h4>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="border rounded p-3 text-center">

                                    <small class="text-muted">

                                        Afternoon Time Out

                                    </small>

                                    <h4 class="mt-2">

                                        {{ $todayAttendance && $todayAttendance->afternoon_time_out
                                            ? \Carbon\Carbon::parse($todayAttendance->afternoon_time_out)->format('h:i A')
                                            : '--' }}

                                    </h4>

                                </div>

                            </div>

                        </div>

                    </section>



                    <!-- Attendance Calendar Filter -->

                    <section class="panel mt-4">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1">

                                    Attendance Search

                                </h2>

                                <p class="text-muted">

                                    Select a specific attendance date.

                                </p>

                            </div>

                        </div>

                        <form method="GET" action="{{ route('attendance') }}">

                            <div class="row g-3 align-items-end">

                                <div class="col-md-5">

                                    <label class="form-label">

                                        Select Date

                                    </label>

                                    <input type="date" name="date" class="form-control"
                                        value="{{ request('date') }}">

                                </div>

                                <div class="col-md-3">

                                    <button class="btn btn-primary w-100">

                                        <i class="bi bi-search"></i>

                                        Search Attendance

                                    </button>

                                </div>

                                <div class="col-md-2">

                                    <a href="{{ route('attendance') }}" class="btn btn-outline-secondary w-100">

                                        Reset

                                    </a>

                                </div>

                                <div class="col-md-2">

                                    <a href="{{ route('attendance') }}?date={{ now()->toDateString() }}"
                                        class="btn btn-success w-100">

                                        Today

                                    </a>

                                </div>

                            </div>

                        </form>

                    </section>



                    <!-- Attendance History -->

                    <section class="panel mt-4">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1">

                                    Attendance History

                                </h2>

                                <p class="text-muted">

                                    All attendance records from the Face Recognition Attendance System.

                                </p>

                            </div>

                        </div>

                        <table class="table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>Date</th>

                                    <th>Morning In</th>

                                    <th>Morning Out</th>

                                    <th>Afternoon In</th>

                                    <th>Afternoon Out</th>

                                    <th>Hours Worked</th>

                                    <th>Status</th>

                                    <th>Remarks</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($attendanceRecords as $attendance)
                                    <tr>

                                        <td>

                                            {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}

                                        </td>

                                        <td>

                                            {{ $attendance->morning_time_in ? \Carbon\Carbon::parse($attendance->morning_time_in)->format('h:i A') : '--' }}

                                        </td>

                                        <td>

                                            {{ $attendance->morning_time_out ? \Carbon\Carbon::parse($attendance->morning_time_out)->format('h:i A') : '--' }}

                                        </td>

                                        <td>

                                            {{ $attendance->afternoon_time_in
                                                ? \Carbon\Carbon::parse($attendance->afternoon_time_in)->format('h:i A')
                                                : '--' }}

                                        </td>

                                        <td>

                                            {{ $attendance->afternoon_time_out
                                                ? \Carbon\Carbon::parse($attendance->afternoon_time_out)->format('h:i A')
                                                : '--' }}

                                        </td>

                                        <td>

                                            {{ $attendance->hours_worked }}

                                            hrs

                                        </td>

                                        <td>

                                            @if ($attendance->status == 'Present')
                                                <span class="badge bg-success">

                                                    Present

                                                </span>
                                            @elseif($attendance->status == 'Late')
                                                <span class="badge bg-warning text-dark">

                                                    Late

                                                </span>
                                            @elseif($attendance->status == 'Absent')
                                                <span class="badge bg-danger">

                                                    Absent

                                                </span>
                                            @elseif($attendance->status == 'Leave')
                                                <span class="badge bg-primary">

                                                    Leave

                                                </span>
                                            @elseif($attendance->status == 'Official Business')
                                                <span class="badge bg-info text-dark">

                                                    Official Business

                                                </span>
                                            @else
                                                <span class="badge bg-secondary">

                                                    Unknown

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            {{ $attendance->remarks ?? '-' }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="8" class="text-center py-5">

                                            <i class="bi bi-calendar-x fs-1 text-muted"></i>

                                            <h5 class="mt-3">

                                                No attendance record found.

                                            </h5>

                                            <p class="text-muted">

                                                Attendance will automatically appear here after successful Eye
                                                Recognition.

                                            </p>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                </div>

                <div class="d-flex justify-content-end mt-3">

                    {{ $attendanceRecords->links() }}

                </div>

                </section>

        </div>

        </main>


        <footer class="admin-footer">
            <div class="container-fluid px-3 px-lg-4">
                <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success"
                        href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a
                        target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a>
                </span>
                <span>Professional dashboard template.</span>
                <span>User management dashboard.</span>
            </div>
        </footer>
    </div>
    </div>

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>
</body>

</html>
