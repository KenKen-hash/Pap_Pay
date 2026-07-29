<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Charts | adminHMD</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        .department-card {

            cursor: pointer;

            transition: .25s;

        }

        .department-card:hover {

            transform: translateY(-3px);

            border-color: #198754;

            box-shadow: 0 0 15px rgba(25, 135, 84, .15);

        }
    </style>
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

                <a class="nav-link" href="{{ route('payroll') }}">
                    <span class="nav-icon"><i class="bi bi-cash-stack"></i></span>
                    <span class="nav-text">Payroll</span>
                </a>

                <a class="nav-link active" href="{{ route('payslip_list') }}">
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
                                <li><a class="dropdown-item" href= " {{ route('payroll') }}">Profile</a></li>
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

                    <div class="page-heading mb-4">

                        <div class="page-heading-copy">

                            <span class="page-icon">
                                <i class="bi bi-receipt-cutoff"></i>
                            </span>

                            <div>

                                <p class="eyebrow mb-1">
                                    Payroll Management
                                </p>

                                <h1 class="h3 mb-1">
                                    Payslip Management
                                </h1>

                                <p class="text-muted mb-0">
                                    Generate, distribute, and manage employee payslips for every payroll cycle.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-white">

                        <h4 class="fw-bold mb-0">

                            <i class="bi bi-receipt-cutoff text-success me-2"></i>

                            Generate Employee Payslips

                        </h4>

                    </div>

                    <div class="card-body">

                        <!-- Payroll Period -->

                        <div class="row mb-4">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Payroll Start Date

                                </label>

                                <input type="date" id="period_start" class="form-control">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Payroll End Date

                                </label>

                                <input type="date" id="period_end" class="form-control">

                            </div>

                        </div>

                        <hr>

                        <!-- Departments -->

                        <h5 class="fw-bold mb-3">

                            Select Department(s)

                        </h5>

                        <div class="row">

                            @php

                                $departments = ['Elementary', 'JHS', 'SHS', 'College', 'Admin', 'Laborers'];

                            @endphp

                            @foreach ($departments as $department)
                                <div class="col-lg-4 col-md-6 mb-3">

                                    <div class="card border department-card h-100">

                                        <div class="card-body">

                                            <div class="form-check">

                                                <input class="form-check-input department-checkbox" type="checkbox"
                                                    value="{{ $department }}" id="{{ $department }}">

                                                <label class="form-check-label fw-semibold"
                                                    for="{{ $department }}">

                                                    {{ $department }}

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <hr>

                        <!-- Employee List -->

                        <h5 class="fw-bold mb-3">

                            Employees

                        </h5>

                        <div id="employeeContainer" class="border rounded p-4 bg-light">

                            <div class="text-center text-muted">

                                <i class="bi bi-people fs-1"></i>

                                <p class="mt-3 mb-0">

                                    Select one or more departments to load employees.

                                </p>

                            </div>

                        </div>

                        <div class="text-end mt-4">

                            <button class="btn btn-success btn-lg" id="previewPayroll">

                                <i class="bi bi-search me-2"></i>

                                Preview Payroll

                            </button>

                            <div id="previewContainer" class="mt-4"></div>

                        </div>

                    </div>

                </div>




                <!-- ==========================================
     GENERATED PAYSLIPS
=========================================== -->

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white border-0 py-3">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">

                                    <i class="bi bi-clock-history text-primary me-2"></i>

                                    Generated Payslips

                                </h5>

                                <small class="text-muted">

                                    History of all generated payroll payslips.

                                </small>

                            </div>

                            <button class="btn btn-outline-success btn-sm">

                                <i class="bi bi-arrow-repeat me-2"></i>

                                Refresh

                            </button>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead class="table-light">

                                    <tr>

                                        <th>#</th>

                                        <th>Payroll Period</th>

                                        <th>Employees</th>

                                        <th>Generated On</th>

                                        <th>Status</th>

                                        <th class="text-center">

                                            Actions

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td>1</td>

                                        <td>

                                            July 1 - July 15, 2026

                                        </td>

                                        <td>

                                            48 Employees

                                        </td>

                                        <td>

                                            July 15, 2026

                                        </td>

                                        <td>

                                            <span class="badge bg-success">

                                                Distributed

                                            </span>

                                        </td>

                                        <td class="text-center">

                                            <button class="btn btn-sm btn-outline-primary">

                                                <i class="bi bi-eye"></i>

                                            </button>

                                            <button class="btn btn-sm btn-outline-danger">

                                                <i class="bi bi-file-earmark-pdf"></i>

                                            </button>

                                            <button class="btn btn-sm btn-outline-success">

                                                <i class="bi bi-send-check"></i>

                                            </button>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>2</td>

                                        <td>

                                            June 16 - June 30, 2026

                                        </td>

                                        <td>

                                            47 Employees

                                        </td>

                                        <td>

                                            June 30, 2026

                                        </td>

                                        <td>

                                            <span class="badge bg-success">

                                                Distributed

                                            </span>

                                        </td>

                                        <td class="text-center">

                                            <button class="btn btn-sm btn-outline-primary">

                                                <i class="bi bi-eye"></i>

                                            </button>

                                            <button class="btn btn-sm btn-outline-danger">

                                                <i class="bi bi-file-earmark-pdf"></i>

                                            </button>

                                            <button class="btn btn-sm btn-outline-success">

                                                <i class="bi bi-send-check"></i>

                                            </button>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>3</td>

                                        <td>

                                            June 1 - June 15, 2026

                                        </td>

                                        <td>

                                            46 Employees

                                        </td>

                                        <td>

                                            June 15, 2026

                                        </td>

                                        <td>

                                            <span class="badge bg-success">

                                                Distributed

                                            </span>

                                        </td>

                                        <td class="text-center">

                                            <button class="btn btn-sm btn-outline-primary">

                                                <i class="bi bi-eye"></i>

                                            </button>

                                            <button class="btn btn-sm btn-outline-danger">

                                                <i class="bi bi-file-earmark-pdf"></i>

                                            </button>

                                            <button class="btn btn-sm btn-outline-success">

                                                <i class="bi bi-send-check"></i>

                                            </button>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

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
                    <span>Analytics chart examples.</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>


    <script>
        const employeeContainer = document.getElementById('employeeContainer');

        const departmentCheckboxes =
            document.querySelectorAll('.department-checkbox');

        departmentCheckboxes.forEach(box => {

            box.addEventListener('change', loadEmployees);

        });

        function loadEmployees() {

            const selectedDepartments = [];

            document.querySelectorAll('.department-checkbox:checked')
                .forEach(box => {

                    selectedDepartments.push(box.value);

                });

            if (selectedDepartments.length === 0) {

                employeeContainer.innerHTML = `

            <div class="text-center text-muted">

                <i class="bi bi-people fs-1"></i>

                <p class="mt-3">

                    Select one or more departments to load employees.

                </p>

            </div>

        `;

                return;

            }

            fetch(
                    "{{ route('payslip.employees') }}?departments[]=" +
                    selectedDepartments.join("&departments[]=")
                )

                .then(response => response.json())

                .then(employees => {

                    let html = `

            <div class="form-check mb-3">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="selectAll"
                    checked>

                <label
                    class="form-check-label fw-bold">

                    Select All

                </label>

            </div>

            <hr>

        `;

                    employees.forEach(employee => {

                        html += `

                <div class="form-check mb-2">

                    <input
                        class="form-check-input employee-checkbox"
                        type="checkbox"
                        checked
                        value="${employee.id}">

                    <label class="form-check-label">

                        <strong>

                            ${employee.first_name}
                            ${employee.last_name}

                        </strong>

                        <br>

                        <small>

                            ${employee.employee_id}
                            •
                            ${employee.department}

                        </small>

                    </label>

                </div>

            `;

                    });

                    employeeContainer.innerHTML = html;

                    document.getElementById('selectAll')
                        .addEventListener('change', function() {

                            document
                                .querySelectorAll('.employee-checkbox')
                                .forEach(box => {

                                    box.checked = this.checked;

                                });

                        });

                });

        }

        document.getElementById('previewPayroll').addEventListener('click', function() {

            const employees = [];

            document.querySelectorAll('.employee-checkbox:checked').forEach(box => {
                employees.push(box.value);
            });

            fetch("{{ route('payslip.preview') }}", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    },

                    body: JSON.stringify({

                        period_start: document.getElementById("period_start").value,

                        period_end: document.getElementById("period_end").value,

                        employees: employees

                    })

                })

                .then(response => response.json())

                .then(data => {

                    console.log(data);

                    document.getElementById("previewContainer").innerHTML = `
            <div class="alert alert-success">
                Preview request received successfully.
            </div>
        `;

                })

                .catch(error => {

                    console.error(error);

                });

        });
    </script>

</body>

</html>
