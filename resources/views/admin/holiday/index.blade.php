<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Settings | adminHMD</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
</head>

<body>
    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('admin-dashboard') }}" aria-label="Admin Dashboard">
                    <img src="../../../khen/assets/images/logo.jpg" alt="Pap Pay Logo" class="brand-logo">
                </a>
            </div>

            <nav class="sidebar-nav">
                <a class="nav-link" href="{{ route('admin-dashboard') }}">
                    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
                    <span class="nav-text">Home</span>
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

                <a class="nav-link active" href="{{ route('holidays.index') }}">
                    <span class="nav-icon"><i class="bi bi-gear"></i></span>
                    <span class="nav-text">Holidays</span>
                </a>
                <a class="nav-link" href="{{ route('payroll') }}">
                    <span class="nav-icon"><i class="bi bi-cash-stack"></i></span>
                    <span class="nav-text">Payroll</span>
                </a>

                <a class="nav-link" href="{{ route('payslip_list') }}">
                    <span class="nav-icon"><i class="bi bi-receipt"></i></span>
                    <span class="nav-text">Payslips</span>
                </a>
                <a class="nav-link" href="{{ route('admin.payslip-concerns.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-exclamation-circle"></i>
                    </span>

                    <span class="nav-text">
                        Payslip Concerns
                    </span>

                </a>

                <a class="nav-link" href="{{ route('reports') }}">
                    <span class="nav-icon"><i class="bi bi-bar-chart"></i></span>
                    <span class="nav-text">Reports</span>
                </a>

                <a class="nav-link" href="{{ route('announcements') }}">
                    <span class="nav-icon"><i class="bi bi-megaphone"></i></span>
                    <span class="nav-text">Announcements</span>
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

                                @if (($unreadNotifications ?? 0) > 0)
                                    <span class="notification-dot"></span>
                                @endif

                                <i class="bi bi-bell" aria-hidden="true"></i>
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

                                <a href="{{ route('admin.notifications') }}" class="dropdown-item text-center">
                                    View all notifications
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

                    <!-- Page Heading -->
                    <div class="page-heading">
                        <div class="page-heading-copy">
                            

                            <div>

                                <h1 class="h3 mb-1">Holiday Management</h1>
                                <p class="text-muted mb-0">
                                    Manage holidays that affect attendance and payroll computation.
                                </p>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            {{ session('success') }}

                            <button class="btn-close" data-bs-dismiss="alert"></button>

                        </div>
                    @endif

                    <!-- Statistics -->
                    <section class="row g-3 mt-2">

                        <div class="col-md-3">
                            <div class="metric-card metric-primary">
                                <div class="metric-top">
                                    <span class="metric-label">
                                        Total Holidays
                                    </span>
                                </div>

                                <div class="metric-value">
                                    {{ $totalHolidays }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="metric-card metric-success">
                                <div class="metric-top">
                                    <span class="metric-label">
                                        Regular Holidays
                                    </span>
                                </div>

                                <div class="metric-value">
                                    {{ $regularHolidays }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="metric-card metric-info">
                                <div class="metric-top">
                                    <span class="metric-label">
                                        Special Holidays
                                    </span>
                                </div>

                                <div class="metric-value">
                                    {{ $specialHolidays }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="metric-card metric-warning">
                                <div class="metric-top">
                                    <span class="metric-label">
                                        Emergency Holidays
                                    </span>
                                </div>

                                <div class="metric-value">
                                    {{ $emergencyHolidays }}
                                </div>
                            </div>
                        </div>

                    </section>

                    <!-- Holiday Table -->
                    <section class="panel mt-4">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1 section-title">
                                    <i class="bi bi-calendar3"></i>
                                    <span>Holiday List</span>
                                </h2>

                                <p class="text-muted mb-0">
                                    View and manage all holidays used in attendance and payroll.
                                </p>

                            </div>

                            <div class="d-flex flex-wrap gap-2">

                                <input type="search" class="form-control form-control-sm table-search"
                                    placeholder="Search Holiday">

                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addHolidayModal">

                                    <i class="bi bi-plus-circle"></i>
                                    Add Holiday

                                </button>

                            </div>

                        </div>

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead>

                                    <tr>

                                        <th>Holiday</th>

                                        <th>Date</th>

                                        <th>Type</th>

                                        <th>Department</th>

                                        <th>Pay Rate</th>

                                        <th>Status</th>

                                        <th width="180">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($holidays as $holiday)
                                        <tr>

                                            <td>{{ $holiday->holiday_name }}</td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($holiday->holiday_date)->format('F d, Y') }}
                                            </td>

                                            <td>

                                                @if ($holiday->holiday_type == 'Regular')
                                                    <span class="badge bg-success">
                                                        Regular
                                                    </span>
                                                @elseif($holiday->holiday_type == 'Special')
                                                    <span class="badge bg-info">
                                                        Special
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Emergency
                                                    </span>
                                                @endif

                                            </td>

                                            <td>

                                                {{ $holiday->department ?? 'All Departments' }}

                                            </td>

                                            <td>

                                                {{ $holiday->pay_rate }}%

                                            </td>

                                            <td>

                                                @if ($holiday->is_active)
                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        Inactive
                                                    </span>
                                                @endif

                                            </td>

                                            <td>

                                                <button class="btn btn-warning btn-sm editHolidayBtn"
                                                    data-update-url="{{ route('holidays.update', $holiday->id) }}"
                                                    data-name="{{ $holiday->holiday_name }}"
                                                    data-date="{{ $holiday->holiday_date }}"
                                                    data-type="{{ $holiday->holiday_type }}"
                                                    data-department="{{ $holiday->department }}"
                                                    data-payrate="{{ $holiday->pay_rate }}"
                                                    data-status="{{ $holiday->is_active }}"
                                                    data-remarks="{{ $holiday->remarks }}" data-bs-toggle="modal"
                                                    data-bs-target="#editHolidayModal">

                                                    <i class="bi bi-pencil-square"></i>

                                                </button>

                                                <button class="btn btn-danger btn-sm deleteHolidayBtn"
                                                    data-delete-url="{{ route('holidays.destroy', $holiday->id) }}"
                                                    data-name="{{ $holiday->holiday_name }}" data-bs-toggle="modal"
                                                    data-bs-target="#deleteHolidayModal">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="7" class="text-center py-5">

                                                <i class="bi bi-calendar-x display-5 text-secondary"></i>

                                                <h5 class="mt-3">

                                                    No Holidays Found

                                                </h5>

                                                <p class="text-muted">

                                                    Click "Add Holiday" to create your first holiday.

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

            <!-- Add Holiday Modal -->
            <div class="modal fade" id="addHolidayModal" tabindex="-1">

                <div class="modal-dialog modal-lg">

                    <div class="modal-content">

                        <form action="{{ route('holidays.store') }}" method="POST">

                            @csrf

                            <div class="modal-header">

                                <h5 class="modal-title">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Add Holiday
                                </h5>

                                <button class="btn-close" data-bs-dismiss="modal"></button>

                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <!-- Holiday Name -->
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Holiday Name
                                        </label>

                                        <input type="text" class="form-control" name="holiday_name" required>

                                    </div>

                                    <!-- Holiday Date -->
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Holiday Date
                                        </label>

                                        <input type="date" class="form-control" name="holiday_date" required>

                                    </div>

                                    <!-- Holiday Type -->
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Holiday Type
                                        </label>

                                        <select class="form-select" name="holiday_type">

                                            <option value="Regular">Regular</option>
                                            <option value="Special">Special</option>
                                            <option value="Emergency">Emergency</option>

                                        </select>

                                    </div>

                                    <!-- Department -->
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Department
                                        </label>

                                        <select class="form-select" name="department">

                                            <option value="">All Departments</option>
                                            <option value="Elementary">Elementary</option>
                                            <option value="JHS">JHS</option>
                                            <option value="SHS">SHS</option>
                                            <option value="College">College</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Laborers">Laborers</option>

                                        </select>

                                    </div>

                                    <!-- Pay Rate -->
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Pay Rate (%)
                                        </label>

                                        <input type="number" class="form-control" name="pay_rate" value="100"
                                            min="0" step="0.01" required>

                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Status
                                        </label>

                                        <select class="form-select" name="is_active">

                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>

                                        </select>

                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-12">

                                        <label class="form-label">
                                            Remarks
                                        </label>

                                        <textarea class="form-control" rows="3" name="remarks"></textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                                    Cancel

                                </button>

                                <button type="submit" class="btn btn-primary">

                                    Save Holiday

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>




            <div class="modal fade" id="editHolidayModal" tabindex="-1">

                <div class="modal-dialog modal-lg">

                    <div class="modal-content">

                        <form id="editHolidayForm" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="modal-header">

                                <h5 class="modal-title">

                                    Edit Holiday

                                </h5>

                                <button class="btn-close" data-bs-dismiss="modal"></button>

                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>Holiday Name</label>

                                        <input type="text" id="edit_holiday_name" name="holiday_name"
                                            class="form-control" required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Holiday Date</label>

                                        <input type="date" id="edit_holiday_date" name="holiday_date"
                                            class="form-control" required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Holiday Type</label>

                                        <select id="edit_holiday_type" name="holiday_type" class="form-select">

                                            <option value="Regular">Regular</option>
                                            <option value="Special">Special</option>
                                            <option value="Emergency">Emergency</option>

                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Department</label>

                                        <select id="edit_department" class="form-select" name="department">

                                            <option value="">All Departments</option>
                                            <option value="Elementary">Elementary</option>
                                            <option value="JHS">JHS</option>
                                            <option value="SHS">SHS</option>
                                            <option value="College">College</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Laborers">Laborers</option>

                                        </select>

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label">

                                            Pay Rate (%)

                                        </label>

                                        <input id="edit_pay_rate" type="number" name="pay_rate"
                                            class="form-control" min="0" step="0.01" required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Status</label>

                                        <select id="edit_status" name="is_active" class="form-select">

                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>

                                        </select>

                                    </div>

                                    <div class="col-12">

                                        <label>Remarks</label>

                                        <textarea id="edit_remarks" name="remarks" rows="3" class="form-control"></textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">

                                <button class="btn btn-secondary" data-bs-dismiss="modal">

                                    Cancel

                                </button>

                                <button type="submit" class="btn btn-warning">

                                    Update Holiday

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <div class="modal fade" id="deleteHolidayModal">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" id="deleteHolidayForm">

                            @csrf

                            @method('DELETE')

                            <div class="modal-header">

                                <h5 class="modal-title">

                                    Delete Holiday

                                </h5>

                                <button class="btn-close" data-bs-dismiss="modal"></button>

                            </div>

                            <div class="modal-body text-center">

                                <h5 id="deleteHolidayName"></h5>

                                <p>

                                    Are you sure you want to delete this holiday?

                                </p>

                            </div>

                            <div class="modal-footer">

                                <button class="btn btn-secondary" data-bs-dismiss="modal">

                                    Cancel

                                </button>

                                <button class="btn btn-danger">

                                    Delete

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <footer class="admin-footer">
                <div class="container-fluid px-3 px-lg-4">
                    <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success"
                            href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a
                            target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a>
                    </span>
                    <span>Professional dashboard template.</span>
                    <span>Workspace settings page.</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>


    <script>
        document.querySelectorAll('.editHolidayBtn').forEach(button => {

            button.addEventListener('click', function() {

                document.getElementById('editHolidayForm').action =
                    this.dataset.updateUrl;

                document.getElementById('edit_holiday_name').value =
                    this.dataset.name;

                document.getElementById('edit_holiday_date').value =
                    this.dataset.date;

                document.getElementById('edit_holiday_type').value =
                    this.dataset.type;

                document.getElementById('edit_department').value =
                    this.dataset.department;

                document.getElementById('edit_pay_rate').value =
                    this.dataset.payrate;

                document.getElementById('edit_status').value =
                    this.dataset.status;

                document.getElementById('edit_remarks').value =
                    this.dataset.remarks;

            });

        });
    </script>

    <script>
        document.querySelectorAll('.deleteHolidayBtn').forEach(button => {

            button.addEventListener('click', function() {

                document.getElementById('deleteHolidayForm').action =
                    this.dataset.deleteUrl;

                document.getElementById('deleteHolidayName').innerHTML = this.dataset.name;

            });

        });
    </script>
</body>

</html>
