<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Dashboard | adminHMD</title>

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
                <a class="nav-link active" href="{{ route('admin-dashboard') }}">
                    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
                    <span class="nav-text">Statistics</span>
                </a>

                <a class="nav-link" href="{{ route('employees.index') }}">
                    <span class="nav-icon"><i class="bi bi-people"></i></span>
                    <span class="nav-text">Employees</span>
                </a>

                <a class="nav-link" href="{{ route('attendance_list') }}">
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

                    <!-- PAGE HEADER -->
                    <div class="page-heading">
                        <div>
                            <h1 class="h3">HR & Payroll Dashboard</h1>
                            <p class="text-muted">Monitor employees, attendance, payroll, and HR operations in real
                                time.</p>
                        </div>
                    </div>

                    <!-- METRICS -->
                    <section class="row g-3">

                        <div class="col-xl-3 col-sm-6">
                            <div class="metric-card metric-primary">
                                <div class="metric-label">Total Users
                            </div>

                            <div class="metric-value">
                                {{ number_format($totalUsers) }}
                            </div>

                            <div class="metric-meta">
                                <span class="text-success">
                                    Employees + Administrators
                                </span>
                            </div>
                        </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="metric-card metric-success">
                        <div class="metric-label">Present Today</div>
                        <div class="metric-value">{{ $presentToday ?? 0 }}</div>
                        <div class="metric-meta">Attendance rate</div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="metric-card metric-warning">
                        <div class="metric-label">Pending Leaves</div>
                        <div class="metric-value">{{ $pendingLeaves ?? 0 }}</div>
                        <div class="metric-meta">Requires approval</div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="metric-card metric-danger">
                        <div class="metric-label">Payroll Processed</div>
                        <div class="metric-value">{{ $payrollCount ?? 0 }}</div>
                        <div class="metric-meta">This month</div>
                    </div>
                </div>

                </section>
                <section class="panel mt-4">
                    <div class="panel-header">

                        <div>

                            <h2>

                                Attendance Overview

                            </h2>

                            <p>

                                Monday - Saturday Attendance

                            </p>

                        </div>

                        <div class="badge bg-primary">

                            Live

                        </div>

                    </div>

                    <div class="chart-bars">

                        @foreach ($attendanceChart as $day)
                            <div class="attendance-bar">

                                <div class="attendance-value">

                                    {{ $day['count'] }}

                                </div>

                                <div class="attendance-fill"
                                    style="height:{{ ($day['count'] / $maxAttendance) * 220 }}px;">

                                </div>

                                <div class="attendance-day">

                                    {{ $day['day'] }}

                                </div>

                            </div>
                        @endforeach

                    </div>
                </section>
                <section class="panel mt-4">
                    <div class="panel-header">
                        <h2>Recent Employees</h2>
                        <a href="{{ route('employees.index') }}" class="btn btn-sm btn-light">View All</a>
                    </div>

                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Date Hired</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentEmployees ?? [] as $emp)
                                <tr>
                                    <td>{{ $emp->name }}</td>
                                    <td>{{ $emp->department }}</td>
                                    <td>{{ $emp->position }}</td>
                                    <td>
                                        <span class="badge text-bg-success">{{ $emp->status }}</span>
                                    </td>
                                    <td>{{ $emp->hire_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted text-center">No recent employees</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>
                <footer class="admin-footer">
                    <div class="container-fluid px-3 px-lg-4">
                        <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank"
                                class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan
                                Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success"
                                href="https://themewagon.com">ThemeWagon</a> </span>
                        <span>Professional dashboard template.</span>
                    </div>
                </footer>
        </div>
    </div>

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>
</body>

</html>
