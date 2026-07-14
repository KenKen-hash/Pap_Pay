<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Profile | adminHMD</title>

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
                <a class="nav-link" href="{{ route('admin-dashboard') }}">
                    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
                    <span class="nav-text">Dashboard</span>
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

                <a class="nav-link active" href="{{ route('payroll') }}">
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
                            <div class="dropdown">
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

                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                        <div>
                            <h2 class="fw-bold mb-1">
                                <i class="bi bi-cash-stack text-success"></i>
                                Payroll Management
                            </h2>

                            <p class="text-muted mb-0">
                                Configure employee salaries before generating payroll.
                            </p>
                        </div>

                        <div>

                            <button class="btn btn-success">

                                <i class="bi bi-calendar-range"></i>

                                Payroll Period

                            </button>

                        </div>

                    </div>



                    <!-- SUMMARY -->

                    <div class="row g-3 mb-4">

                        <div class="col-xl-3 col-md-6">

                            <div class="card border-0 shadow-sm payroll-summary">

                                <div class="card-body">

                                    <small>Total Employees</small>

                                    <h2 class="fw-bold">

                                        {{ $employees->flatten()->count() }}

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6">

                            <div class="card border-0 shadow-sm payroll-summary">

                                <div class="card-body">

                                    <small>Configured</small>

                                    <h2 class="fw-bold text-success">

                                        {{ $employees->flatten()->whereNotNull('payrollSetting')->count() }}

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6">

                            <div class="card border-0 shadow-sm payroll-summary">

                                <div class="card-body">

                                    <small>Pending</small>

                                    <h2 class="fw-bold text-danger">

                                        {{ $employees->flatten()->whereNull('payrollSetting')->count() }}

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6">

                            <div class="card border-0 shadow-sm payroll-summary">

                                <div class="card-body">

                                    <small>Current Payroll</small>

                                    <h5 class="fw-bold">

                                        July 1 - July 15

                                    </h5>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- SEARCH -->

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-8">

                                    <input type="text" id="employeeSearch" class="form-control"
                                        placeholder="Search employee...">

                                </div>

                                <div class="col-md-4">

                                    <select class="form-select">

                                        <option>July 1 - July 15</option>

                                        <option>July 16 - July 31</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- DEPARTMENTS -->

                    @foreach ($employees as $department => $departmentEmployees)
                        <div class="department-section mb-5">

                            <div class="d-flex align-items-center mb-3">

                                <h4 class="fw-bold">

                                    {{ strtoupper($department) }}

                                </h4>

                                <span class="badge bg-primary ms-3">

                                    {{ $departmentEmployees->count() }}

                                </span>

                            </div>



                            <div class="row g-4">

                                @foreach ($departmentEmployees as $employee)
                                    <div class="col-xl-4 col-lg-6 employee-card">

                                        <div class="card border-0 shadow payroll-card h-100">

                                            <div class="card-body">

                                                <div class="d-flex">

                                                    <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                                        class="rounded-circle me-3" width="70" height="70">

                                                    <div>

                                                        <h5 class="fw-bold mb-1">

                                                            {{ $employee->name }}

                                                        </h5>

                                                        <small class="text-muted">

                                                            {{ $employee->employee_id }}

                                                        </small>

                                                        <br>

                                                        <small>

                                                            {{ $employee->position }}

                                                        </small>

                                                    </div>

                                                </div>



                                                <hr>



                                                <div class="mb-2">

                                                    <span class="badge bg-info">

                                                        {{ $employee->department }}

                                                    </span>

                                                </div>



                                                @if ($employee->payrollSetting)
                                                    <span class="badge bg-success">

                                                        Payroll Configured

                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">

                                                        Not Configured

                                                    </span>
                                                @endif



                                                <div class="mt-4 d-grid">

                                                    <button class="btn btn-success configurePayroll"
                                                        data-id="{{ $employee->id }}"
                                                        data-name="{{ $employee->name }}"
                                                        data-photo="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                                        data-employeeid="{{ $employee->employee_id }}"
                                                        data-position="{{ $employee->position }}"
                                                        data-department="{{ $employee->department }}">

                                                        <i class="bi bi-gear"></i>

                                                        Configure Payroll

                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>
                    @endforeach

                </div>

            </main>

            <footer class="admin-footer">
                <div class="container-fluid px-3 px-lg-4">
                    <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success"
                            href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a
                            target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a>
                    </span>
                    <span>Professional dashboard template.</span>
                    <span>Profile management page.</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Payroll Configuration Modal -->
    <div class="modal fade" id="payrollModal" tabindex="-1">

        <div class="modal-dialog modal-xl modal-dialog-scrollable">

            <div class="modal-content">

                <div class="modal-header bg-success text-white">

                    <h5 class="modal-title">

                        <i class="bi bi-cash-stack"></i>

                        Payroll Configuration

                    </h5>

                    <button class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <!-- Employee Information -->

                    <div class="row mb-4">

                        <div class="col-md-3 text-center">

                            <img id="modalPhoto" src="" class="rounded-circle border" width="120"
                                height="120">

                        </div>

                        <div class="col-md-9">

                            <h4 id="modalName"></h4>

                            <p class="mb-1">

                                <strong>ID:</strong>

                                <span id="modalEmployeeID"></span>

                            </p>

                            <p class="mb-1">

                                <strong>Department:</strong>

                                <span id="modalDepartment"></span>

                            </p>

                            <p class="mb-0">

                                <strong>Position:</strong>

                                <span id="modalPosition"></span>

                            </p>

                        </div>

                    </div>

                    <hr>

                    <!-- Payroll Period -->

                    <div class="card mb-4">

                        <div class="card-header bg-light">

                            Payroll Period

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <label>Start Date</label>

                                    <input type="date" id="payrollStart" class="form-control">

                                </div>

                                <div class="col-md-6">

                                    <label>End Date</label>

                                    <input type="date" id="payrollEnd" class="form-control">

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Dynamic Department Fields -->

                    <div id="departmentFields">

                        <div id="primaryForm" class="department-form d-none">
                            @include('admin.payroll.partials.primary')
                        </div>

                        <div id="secondaryForm" class="department-form d-none">
                            @include('admin.payroll.partials.secondary')
                        </div>

                        <div id="tertiaryForm" class="department-form d-none">
                            @include('admin.payroll.partials.tertiary')
                        </div>

                        <div id="nonTeachingForm" class="department-form d-none">
                            @include('admin.payroll.partials.non_teaching')
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">

                        Close

                    </button>

                    <button class="btn btn-success" id="savePayroll">

                        Save Payroll Settings

                    </button>

                </div>

            </div>

        </div>

    </div>

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>

    <script>
        document.getElementById('employeeSearch')

            .addEventListener('keyup', function() {

                let value = this.value.toLowerCase();

                document.querySelectorAll('.employee-card').forEach(function(card) {

                    card.style.display =

                        card.innerText.toLowerCase().includes(value)

                        ?

                        ''

                        :

                        'none';

                });

            });

        const payrollModal = new bootstrap.Modal(
            document.getElementById('payrollModal')
        );

        document.querySelectorAll('.configurePayroll').forEach(button => {

            button.addEventListener('click', function() {

                document.getElementById('modalPhoto').src =
                    this.dataset.photo;

                document.getElementById('modalName').innerText =
                    this.dataset.name;

                document.getElementById('modalEmployeeID').innerText =
                    this.dataset.employeeid;

                document.getElementById('modalDepartment').innerText =
                    this.dataset.department;

                document.getElementById('modalPosition').innerText =
                    this.dataset.position;

                loadDepartmentFields(
                    this.dataset.department
                );

                payrollModal.show();

            });

        });

        function loadDepartmentFields(department) {

            document.querySelectorAll('.department-form').forEach(form => {

                form.classList.add('d-none');

            });

            switch (department) {

                case 'Primary':

                    document
                        .getElementById('primaryForm')
                        .classList.remove('d-none');

                    break;

                case 'Secondary':

                    document
                        .getElementById('secondaryForm')
                        .classList.remove('d-none');

                    break;

                case 'Tertiary':

                    document
                        .getElementById('tertiaryForm')
                        .classList.remove('d-none');

                    break;

                case 'Non-Teaching':

                    document
                        .getElementById('nonTeachingForm')
                        .classList.remove('d-none');

                    break;
            }
        }
        document.addEventListener("input", function(e) {

            if (e.target.name === "monthly_rate") {

                let monthly = parseFloat(e.target.value) || 0;

                // 22 working days per month
                let daily = monthly / 22;

                // 8 working hours per day
                let hourly = daily / 8;

                document.querySelectorAll("[name='daily_rate']").forEach(input => {
                    input.value = daily.toFixed(2);
                });

                document.querySelectorAll("[name='hourly_rate']").forEach(input => {
                    input.value = hourly.toFixed(2);
                });

            }

        });
    </script>

    <style>
        .payroll-summary {

            border-radius: 18px;

            transition: .3s;

        }

        .payroll-summary:hover {

            transform: translateY(-5px);

        }

        .payroll-card {

            border-radius: 20px;

            transition: .3s;

        }

        .payroll-card:hover {

            transform: translateY(-8px);

            box-shadow: 0 12px 25px rgba(0, 0, 0, .15);

        }

        .department-section {

            padding-bottom: 20px;

            border-bottom: 1px solid #eee;

        }

        @media(max-width:768px) {

            .payroll-card {

                margin-bottom: 10px;

            }

        }
    </style>
</body>

</html>