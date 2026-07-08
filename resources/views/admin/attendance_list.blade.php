<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Add User | adminHMD</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
</head>

<body>
    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('admin-dashboard') }}" aria-label="adminHMD dashboard">
                    <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
                    <span class="brand-copy">
                        <span class="brand-title">adminHMD</span>
                        <span class="brand-subtitle">Admin Template</span>
                    </span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <a class="nav-link " href="{{ route('admin-dashboard') }}">
                    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>

                <a class="nav-link" href="{{ route('employees.index') }}">
                    <span class="nav-icon"><i class="bi bi-people"></i></span>
                    <span class="nav-text">Employees</span>
                </a>

                <a class="nav-link active" href="{{ route('attendance_list') }}">
                    <span class="nav-icon"><i class="bi bi-calendar-check"></i></span>
                    <span class="nav-text">Attendance</span>
                </a>

                <a class="nav-link" href="{{ route('admin.leaves') }}">
                    <span class="nav-icon"><i class="bi bi-calendar-x"></i></span>
                    <span class="nav-text">Leave Requests</span>
                </a>
                <a class="nav-link" href="{{ route('official_business') }}">
                    <span class="nav-icon"><i class="bi bi-briefcase"></i></span>
                    <span class="nav-text">Official Business (OB)</span>
                </a>

                <a class="nav-link" href="{{ route('payroll') }}">
                    <span class="nav-icon"><i class="bi bi-cash-stack"></i></span>
                    <span class="nav-text">Payroll</span>
                </a>

                <a class="nav-link" href="{{ route('payslip_list') }}">
                    <span class="nav-icon"><i class="bi bi-receipt"></i></span>
                    <span class="nav-text">Payslips</span>
                </a>

                <a class="nav-link" href="{{ route('reports') }}">
                    <span class="nav-icon"><i class="bi bi-bar-chart"></i></span>
                    <span class="nav-text">Reports</span>
                </a>

                <a class="nav-link" href="{{ route('announcements') }}">
                    <span class="nav-icon"><i class="bi bi-megaphone"></i></span>
                    <span class="nav-text">Announcements</span>
                </a>

                <a class="nav-link" href="{{ route('settings') }}">
                    <span class="nav-icon"><i class="bi bi-gear"></i></span>
                    <span class="nav-text">Settings</span>
                </a>
            </nav>

            <div class="sidebar-user">
                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ Auth::user()->photo
                        ? asset('storage/' . Auth::user()->photo)
                        : asset('khen/assets/images/avatar/avatar.jpg') }}"
                    alt="{{ Auth::user()->name }}">

                <strong>{{ Auth::user()->name }}</strong>

                <small>{{ ucfirst(Auth::user()->role ?? 'Employee') }}</small>
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

                    <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
                        <input class="form-control search-input" type="search"
                            placeholder="Search users, orders, reports" aria-label="Search">
                    </form>

                    <div class="navbar-actions ms-auto">
                        <button class="icon-button theme-toggle" type="button" data-theme-toggle
                            aria-label="Switch color theme" title="Switch color theme">
                            <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
                        </button>
                        <div class="dropdown">
                            <button class="icon-button" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="Notifications">
                                <span class="notification-dot"></span>
                                <i class="bi bi-bell" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end notification-menu">
                                <div class="dropdown-header fw-bold text-body">Notifications</div>
                                <a class="dropdown-item" href="{{ route('employees.index') }}">
                                    <span class="notification-title">New user registered</span>
                                    <span class="notification-time">4 minutes ago</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('payslip_list') }}">
                                    <span class="notification-title">Revenue target reached</span>
                                    <span class="notification-time">32 minutes ago</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    <span class="notification-title">Security review completed</span>
                                    <span class="notification-time">1 hour ago</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
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
                                <li><a class="dropdown-item" href="{{ route('payroll') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('settings') }}">Account settings</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Sign out
                                    </button>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="dashboard-content">
                <div class="container-fluid px-3 px-lg-4 py-4">

                    <!-- HEADER -->
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4">

                        <div>
                            <h2 class="fw-bold mb-1">Attendance List</h2>
                            <p class="text-muted mb-0">Complete employee attendance records</p>
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div class="d-flex gap-2 mt-3 mt-lg-0">

                            <a href="{{ route('attendance.export.csv', request()->query()) }}"
                                class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i>
                                CSV
                            </a>

                            <a href="{{ route('attendance.export.pdf', request()->query()) }}"
                                class="btn btn-danger">
                                <i class="bi bi-file-earmark-pdf"></i>
                                PDF
                            </a>

                            <button onclick="printAttendance()" class="btn btn-dark">
                                <i class="bi bi-printer"></i>
                                Print
                            </button>

                        </div>
                    </div>

                    <!-- FILTER -->
                    <form method="GET" class="row g-3 mb-4">

                        <div class="col-lg-5 col-md-12">

                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control" placeholder="Search Employee Name or Employee ID">

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <input type="date" name="date" value="{{ request('date') }}"
                                class="form-control">

                        </div>

                        <div class="col-lg-2 col-md-3">

                            <button class="btn btn-primary w-100">

                                Search

                            </button>

                        </div>

                        <div class="col-lg-2 col-md-3">

                            <a href="{{ route('attendance_list') }}" class="btn btn-secondary w-100">

                                Today

                            </a>

                        </div>

                    </form>

                    <!-- SUMMARY CARDS -->
                    <div class="row g-3 mb-4">


                        <div class="col-md-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6>Total Records</h6>
                                    <h3 class="fw-bold">{{ $attendances->total() }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6>Present Today</h6>
                                    <h3 class="fw-bold text-success">
                                        {{ $attendances->where('status', 'Present')->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6>Late</h6>
                                    <h3 class="fw-bold text-warning">
                                        {{ $attendances->where('status', 'Late')->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6>Absent / Leave</h6>
                                    <h3 class="fw-bold text-danger">
                                        {{ $attendances->whereIn('status', ['Absent', 'Leave'])->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TABLE -->
                    <div id="printArea">
                        <div class="card shadow-sm border-0">

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-hover align-middle">

                                        <thead class="table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Employee</th>
                                                <th>Date</th>
                                                <th>Morning In</th>
                                                <th>Morning Out</th>
                                                <th>Afternoon In</th>
                                                <th>Afternoon Out</th>
                                                <th>Hours</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse($attendances as $attendance)
                                                <tr>

                                                    <td>{{ $attendance->user->employee_id }}</td>

                                                    <td>
                                                        <div class="fw-semibold">{{ $attendance->user->name }}</div>
                                                        <small
                                                            class="text-muted">{{ $attendance->user->department }}</small>
                                                    </td>

                                                    <td>{{ $attendance->date->format('M d, Y') }}</td>

                                                    <td>
                                                        {{ $attendance->morning_time_in ? \Carbon\Carbon::parse($attendance->morning_time_in)->format('h:i A') : '-' }}
                                                    </td>

                                                    <td>
                                                        {{ $attendance->morning_time_out ? \Carbon\Carbon::parse($attendance->morning_time_out)->format('h:i A') : '-' }}
                                                    </td>

                                                    <td>
                                                        {{ $attendance->afternoon_time_in
                                                            ? \Carbon\Carbon::parse($attendance->afternoon_time_in)->format('h:i A')
                                                            : '-' }}
                                                    </td>

                                                    <td>
                                                        {{ $attendance->afternoon_time_out
                                                            ? \Carbon\Carbon::parse($attendance->afternoon_time_out)->format('h:i A')
                                                            : '-' }}
                                                    </td>

                                                    <td class="fw-bold">
                                                        {{ number_format($attendance->hours_worked, 2) }}
                                                    </td>

                                                    <td>
                                                        @switch($attendance->status)
                                                            @case('Present')
                                                                <span class="badge bg-success">Present</span>
                                                            @break

                                                            @case('Late')
                                                                <span class="badge bg-warning text-dark">Late</span>
                                                            @break

                                                            @case('Absent')
                                                                <span class="badge bg-danger">Absent</span>
                                                            @break

                                                            @case('Leave')
                                                                <span class="badge bg-info">Leave</span>
                                                            @break

                                                            @case('Official Business')
                                                                <span class="badge bg-primary">OB</span>
                                                            @break

                                                            @default
                                                                <span
                                                                    class="badge bg-secondary">{{ $attendance->status }}</span>
                                                        @endswitch
                                                    </td>

                                                    <td>{{ $attendance->remarks ?? '-' }}</td>

                                                </tr>

                                                @empty

                                                    <tr>
                                                        <td colspan="10" class="text-center py-5">
                                                            No attendance records found.
                                                        </td>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                    <!-- PAGINATION -->
                                    <div class="mt-3">
                                        {{ $attendances->links() }}
                                    </div>

                                </div>
                            </div>

                        </div>
                </main>


                <footer class="admin-footer">
                    <div class="container-fluid px-3 px-lg-4">
                        <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success"
                                href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a
                                target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a>
                        </span>
                        <span>Professional dashboard template.</span>
                        <span>Validated user creation form.</span>
                    </div>
                </footer>
            </div>
        </div>

        <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../../../khen/assets/js/main.js"></script>
        <script>
            function printAttendance() {

                const printContents =
                    document.getElementById("printArea").innerHTML;

                const originalContents =
                    document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;

                location.reload();

            }
        </script>
    </body>

    </html>
