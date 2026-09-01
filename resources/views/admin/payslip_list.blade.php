<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Payslip | Pap Pay</title>

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

        .payroll-preview-table {
            min-width: 1900px;
        }

        .payroll-preview-table th {
            white-space: nowrap;
            vertical-align: middle;
        }

        .payroll-preview-table td {
            vertical-align: middle;
            white-space: nowrap;
        }

        .config-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            font-size: 12px;
            font-weight: 600;
        }

        .money-positive {
            color: #198754;
            font-weight: 700;
        }

        .money-negative {
            color: #dc3545;
            font-weight: 700;
        }

        .minutes-badge {
            min-width: 70px;
            display: inline-block;
            text-align: center;
        }

        .preview-summary-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            background: #fff;
            height: 100%;
        }

        .preview-summary-label {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .preview-summary-value {
            font-size: 20px;
            font-weight: 700;
        }

        .employee-config-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .payroll-preview-table {
                min-width: 1700px;
            }
        }
    </style>
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
                    <span class="nav-icon">
                        <i class="bi bi-speedometer2"></i>
                    </span>
                    <span class="nav-text">Home</span>
                </a>

                <a class="nav-link" href="{{ route('employees.index') }}">
                    <span class="nav-icon">
                        <i class="bi bi-people"></i>
                    </span>
                    <span class="nav-text">Employees</span>
                </a>

                <a class="nav-link" href="{{ route('attendance_list') }}">
                    <span class="nav-icon">
                        <i class="bi bi-calendar-check"></i>
                    </span>
                    <span class="nav-text">Attendance</span>
                </a>

                <a class="nav-link" href="{{ route('admin.leaves') }}">
                    <span class="nav-icon">
                        <i class="bi bi-calendar-x"></i>
                    </span>
                    <span class="nav-text">Leave Requests</span>
                </a>

                <a class="nav-link" href="{{ route('official_business') }}">
                    <span class="nav-icon">
                        <i class="bi bi-briefcase"></i>
                    </span>
                    <span class="nav-text">Official Business (OB)</span>
                </a>

                <a class="nav-link" href="{{ route('holidays.index') }}">
                    <span class="nav-icon">
                        <i class="bi bi-gear"></i>
                    </span>
                    <span class="nav-text">Holidays</span>
                </a>

                <a class="nav-link" href="{{ route('payroll') }}">
                    <span class="nav-icon">
                        <i class="bi bi-cash-stack"></i>
                    </span>
                    <span class="nav-text">Payroll</span>
                </a>

                <a class="nav-link active" href="{{ route('payslip_list') }}">
                    <span class="nav-icon">
                        <i class="bi bi-receipt"></i>
                    </span>
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
                    <span class="nav-icon">
                        <i class="bi bi-bar-chart"></i>
                    </span>
                    <span class="nav-text">Reports</span>
                </a>

                <a class="nav-link" href="{{ route('announcements') }}">
                    <span class="nav-icon">
                        <i class="bi bi-megaphone"></i>
                    </span>
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

                    <!-- PAGE HEADER -->

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


                    <!-- GENERATE PAYSLIPS -->

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-header bg-white">

                            <h4 class="fw-bold mb-0">

                                <i class="bi bi-receipt-cutoff text-success me-2"></i>

                                Generate Employee Payslips

                            </h4>

                        </div>

                        <div class="card-body">

                            <!-- PAYROLL PERIOD -->

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

                            <!-- DEPARTMENTS -->

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

                                                    <input class="form-check-input department-checkbox"
                                                        type="checkbox" value="{{ $department }}"
                                                        id="{{ $department }}">

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

                            <!-- EMPLOYEES -->

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


                            <!-- PREVIEW / GENERATE BUTTONS -->

                            <div class="text-end mt-4">

                                <button class="btn btn-success btn-lg" id="previewPayroll">

                                    <i class="bi bi-search me-2"></i>

                                    Preview Payroll

                                </button>

                                <button class="btn btn-primary btn-lg ms-2 d-none" id="generatePayslips">

                                    <i class="bi bi-file-earmark-text me-2"></i>

                                    Generate Payslips

                                </button>

                            </div>


                            <!-- PAYROLL PREVIEW -->

                            <div id="payrollPreviewSection" class="card shadow mt-4 d-none">

                                <div class="card-header bg-success text-white">

                                    <h5 class="mb-0">
                                        Payroll Preview
                                    </h5>

                                </div>

                                <div class="card-body">

                                    <!-- SUMMARY -->

                                    <div class="row g-3 mb-4">

                                        <div class="col-xl-3 col-md-6">

                                            <div class="preview-summary-card">

                                                <div class="preview-summary-label">
                                                    Employees
                                                </div>

                                                <div class="preview-summary-value" id="summaryEmployees">
                                                    0
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-xl-3 col-md-6">

                                            <div class="preview-summary-card">

                                                <div class="preview-summary-label">
                                                    Total Late Minutes
                                                </div>

                                                <div class="preview-summary-value text-danger" id="summaryLate">
                                                    0
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-xl-3 col-md-6">

                                            <div class="preview-summary-card">

                                                <div class="preview-summary-label">
                                                    Total Undertime Minutes
                                                </div>

                                                <div class="preview-summary-value text-warning" id="summaryUndertime">
                                                    0
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-xl-3 col-md-6">

                                            <div class="preview-summary-card">

                                                <div class="preview-summary-label">
                                                    Total Overtime Minutes
                                                </div>

                                                <div class="preview-summary-value text-success" id="summaryOvertime">
                                                    0
                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- TABLE -->

                                    <div class="table-responsive">

                                        <table class="table table-bordered table-hover payroll-preview-table">

                                            <thead class="table-success">

                                                <tr>

                                                    <th>Employee</th>

                                                    <th>Department</th>

                                                    <th>Basic Salary</th>

                                                    <th>Daily Rate</th>

                                                    <th>Additional Units</th>

                                                    <th>Additional Units Pay</th>

                                                    <th>Honorarium</th>

                                                    <th>OT Rate / Hour</th>

                                                    <th>Late Deduction / Min</th>

                                                    <th>Undertime Deduction / Min</th>

                                                    <th>Attendance</th>

                                                    <th>Holidays</th>

                                                    <!-- ADDED HOLIDAY PAY -->

                                                    <th>Holiday Pay</th>

                                                    <th>Late Minutes</th>

                                                    <th>Undertime Minutes</th>

                                                    <th>Overtime Minutes</th>

                                                    <th>Overtime Pay</th>

                                                    <th>Late Deduction</th>

                                                    <th>Undertime Deduction</th>

                                                    <th>Gross Salary</th>

                                                    <th>Benefits</th>

                                                    <th>Net Salary</th>

                                                </tr>

                                            </thead>

                                            <tbody id="payrollPreviewBody">

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- GENERATED PAYSLIPS -->

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

                                <button class="btn btn-outline-success btn-sm" onclick="location.reload()">

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

                                        @forelse($payslips as $period => $items)
                                            <tr>

                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td>

                                                    {{ \Carbon\Carbon::parse($items->first()->period_start)->format('M d, Y') }}

                                                    -

                                                    {{ \Carbon\Carbon::parse($items->first()->period_end)->format('M d, Y') }}

                                                </td>

                                                <td>
                                                    {{ $items->count() }} Employees
                                                </td>

                                                <td>
                                                    {{ $items->first()->created_at->format('M d, Y h:i A') }}
                                                </td>

                                                <td>

                                                    <span class="badge bg-success">

                                                        {{ $items->first()->status }}

                                                    </span>

                                                </td>

                                                <td class="text-center">

                                                    <a href="{{ route('admin.payslips.history', [
                                                        'period_start' => $items->first()->period_start,
                                                        'period_end' => $items->first()->period_end,
                                                    ]) }}"
                                                        class="btn btn-sm btn-outline-primary">

                                                        <i class="bi bi-eye"></i>

                                                    </a>

                                                    <a href="{{ route('admin.payslips.download', [
                                                        'period_start' => $items->first()->period_start,
                                                        'period_end' => $items->first()->period_end,
                                                    ]) }}"
                                                        class="btn btn-sm btn-outline-danger">

                                                        <i class="bi bi-file-earmark-pdf"></i>

                                                    </a>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="6" class="text-center text-muted">

                                                    No generated payslips yet.

                                                </td>

                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </main>

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">
                </div>

            </footer>

        </div>

    </div>


    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>


    <script>
        const employeeContainer =
            document.getElementById('employeeContainer');

        const departmentCheckboxes =
            document.querySelectorAll('.department-checkbox');


        /*
        ============================================================
        LOAD EMPLOYEES
        ============================================================
        */

        departmentCheckboxes.forEach(box => {

            box.addEventListener('change', loadEmployees);

        });


        function loadEmployees() {

            const selectedDepartments = [];

            document
                .querySelectorAll('.department-checkbox:checked')
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

                .then(response => {

                    if (!response.ok) {
                        throw new Error("Failed to load employees.");
                    }

                    return response.json();

                })

                .then(employees => {

                    let html = `

                    <div class="form-check mb-3">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="selectAll"
                            checked>

                        <label class="form-check-label fw-bold">
                            Select All
                        </label>

                    </div>

                    <hr>

                `;


                    if (!employees.length) {

                        html += `

                        <div class="text-center text-muted py-3">

                            <i class="bi bi-person-x fs-2"></i>

                            <p class="mt-2 mb-0">
                                No employees found.
                            </p>

                        </div>

                    `;

                    }


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

                                    ${employee.first_name ?? ''}
                                    ${employee.last_name ?? ''}

                                </strong>

                                <br>

                                <small>

                                    ${employee.employee_id ?? ''}
                                    •
                                    ${employee.department ?? ''}

                                </small>

                            </label>

                        </div>

                    `;

                    });


                    employeeContainer.innerHTML = html;


                    const selectAll =
                        document.getElementById('selectAll');


                    if (selectAll) {

                        selectAll.addEventListener(
                            'change',
                            function() {

                                document
                                    .querySelectorAll('.employee-checkbox')
                                    .forEach(box => {

                                        box.checked =
                                            this.checked;

                                    });

                            }
                        );

                    }

                })

                .catch(error => {

                    console.error(error);

                    employeeContainer.innerHTML = `

                    <div class="alert alert-danger mb-0">

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        Unable to load employees.

                    </div>

                `;

                });

        }


        /*
        ============================================================
        MONEY FORMATTER
        ============================================================
        */

        function money(value) {

            value = Number(value ?? 0);

            return '₱ ' + value.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

        }


        /*
        ============================================================
        NUMBER FORMATTER
        ============================================================
        */

        function number(value) {

            return Number(value ?? 0).toLocaleString(undefined, {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            });

        }


        /*
        ============================================================
        PAYROLL PREVIEW
        ============================================================
        */

        document
            .getElementById('previewPayroll')
            .addEventListener('click', function() {

                const start =
                    document.getElementById('period_start').value;

                const end =
                    document.getElementById('period_end').value;


                const employees = [];

                document
                    .querySelectorAll('.employee-checkbox:checked')
                    .forEach(box => {

                        employees.push(box.value);

                    });


                if (!start || !end) {

                    alert(
                        'Please select the payroll start date and end date.'
                    );

                    return;

                }


                if (employees.length === 0) {

                    alert(
                        'Please select at least one employee.'
                    );

                    return;

                }


                const button = this;

                button.disabled = true;

                button.innerHTML = `

                    <span class="spinner-border spinner-border-sm me-2"></span>

                    Calculating...

                `;


                fetch("{{ route('payslip.preview') }}", {

                        method: "POST",

                        headers: {

                            "Content-Type": "application/json",

                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,

                            "Accept": "application/json"

                        },

                        body: JSON.stringify({

                            period_start: start,

                            period_end: end,

                            employees: employees

                        })

                    })

                    .then(response => {

                        if (!response.ok) {

                            return response.json()
                                .then(error => {

                                    throw error;

                                });

                        }

                        return response.json();

                    })

                    .then(data => {

                        if (!data.success) {

                            alert(
                                data.message ??
                                'Unable to calculate payroll.'
                            );

                            return;

                        }


                        const tbody =
                            document.getElementById(
                                "payrollPreviewBody"
                            );


                        tbody.innerHTML = "";


                        let totalLate = 0;

                        let totalUndertime = 0;

                        let totalOvertime = 0;


                        data.preview.forEach(employee => {

                            /*
                            ------------------------------------------------
                            Configuration values
                            ------------------------------------------------
                            */

                            const basicSalary =
                                Number(
                                    employee.basic_salary ??
                                    employee.salary ??
                                    0
                                );

                            const dailyRate =
                                Number(
                                    employee.daily_rate ??
                                    0
                                );


                            /*
                            ------------------------------------------------
                            ADDITIONAL TEACHING LOAD
                            ------------------------------------------------
                            */

                            const additionalUnits =
                                Number(
                                    employee.teaching_load_units ??
                                    0
                                );

                            const additionalUnitsPay =
                                Number(
                                    employee.teaching_load ??
                                    0
                                );


                            /*
                            ------------------------------------------------
                            HONORARIUM
                            ------------------------------------------------
                            */

                            const honorarium =
                                Number(
                                    employee.honorarium ??
                                    employee.honorarium_amount ??
                                    0
                                );


                            const overtimeRate =
                                Number(
                                    employee.overtime_rate ??
                                    employee.ot_rate ??
                                    0
                                );

                            const lateRate =
                                Number(
                                    employee.late_deduction_rate ??
                                    0
                                );

                            const undertimeRate =
                                Number(
                                    employee.undertime_deduction_rate ??
                                    0
                                );


                            /*
                            ------------------------------------------------
                            Attendance values
                            ------------------------------------------------
                            */

                            const lateMinutes =
                                Number(
                                    employee.late_minutes ??
                                    0
                                );

                            const undertimeMinutes =
                                Number(
                                    employee.undertime_minutes ??
                                    0
                                );

                            const overtimeMinutes =
                                Number(
                                    employee.overtime_minutes ??
                                    0
                                );


                            /*
                            ------------------------------------------------
                            Computed values
                            ------------------------------------------------
                            */

                            const overtimePay =
                                Number(
                                    employee.overtime_pay ??
                                    (
                                        overtimeMinutes / 60
                                    ) * overtimeRate
                                );


                            const lateDeduction =
                                Number(
                                    employee.late_deduction ??
                                    lateMinutes * lateRate
                                );


                            const undertimeDeduction =
                                Number(
                                    employee.undertime_deduction ??
                                    undertimeMinutes *
                                    undertimeRate
                                );


                            const grossSalary =
                                Number(
                                    employee.gross_salary ??
                                    0
                                );


                            const benefits =
                                Number(
                                    employee.benefits ??
                                    0
                                );


                            const netSalary =
                                Number(
                                    employee.net_salary ??
                                    (
                                        grossSalary +
                                        overtimePay +
                                        benefits -
                                        lateDeduction -
                                        undertimeDeduction
                                    )
                                );


                            /*
                            ------------------------------------------------
                            Summary totals
                            ------------------------------------------------
                            */

                            totalLate += lateMinutes;

                            totalUndertime += undertimeMinutes;

                            totalOvertime += overtimeMinutes;


                            /*
                            ------------------------------------------------
                            TABLE ROW
                            ------------------------------------------------
                            */

                            tbody.innerHTML += `

                            <tr>

                                <td>

                                    <strong>
                                        ${employee.name ?? ''}
                                    </strong>

                                </td>


                                <td>
                                    ${employee.department ?? ''}
                                </td>


                                <td>
                                    ${money(basicSalary)}
                                </td>


                                <td>
                                    ${money(dailyRate)}
                                </td>


                                <!-- ADDITIONAL UNITS -->

                                <td class="text-center">

                                    <span class="config-badge">

                                        ${number(additionalUnits)}

                                        ${additionalUnits === 1
                                            ? 'unit'
                                            : 'units'}

                                    </span>

                                </td>


                                <!-- ADDITIONAL UNITS PAY -->

                                <td class="money-positive">

                                    ${money(additionalUnitsPay)}

                                </td>


                                <!-- HONORARIUM -->

                                <td class="money-positive">

                                    ${money(honorarium)}

                                </td>


                                <td>

                                    <span class="config-badge">
                                        ${money(overtimeRate)} / hour
                                    </span>

                                </td>


                                <td>

                                    <span class="config-badge">
                                        ${money(lateRate)} / min
                                    </span>

                                </td>


                                <td>

                                    <span class="config-badge">
                                        ${money(undertimeRate)} / min
                                    </span>

                                </td>


                                <td class="text-center fw-bold">

                                    ${number(
                                        employee.total_attendance
                                    )}

                                </td>


                                <td class="text-center">

                                    ${number(
                                        employee.total_holidays
                                    )}

                                </td>


                                <!-- HOLIDAY PAY -->

                                <td class="money-positive">

                                    ${money(
                                        employee.holiday_pay ?? 0
                                    )}

                                </td>


                                <td class="text-center">

                                    <span class="badge bg-danger minutes-badge">

                                        ${number(lateMinutes)} min

                                    </span>

                                    <div class="small text-danger mt-1">

                                        ${money(lateDeduction)}

                                    </div>

                                </td>


                                <td class="text-center">

                                    <span class="badge bg-warning text-dark minutes-badge">

                                        ${number(undertimeMinutes)} min

                                    </span>

                                    <div class="small text-danger mt-1">

                                        ${money(undertimeDeduction)}

                                    </div>

                                </td>


                                <td class="text-center">

                                    <span class="badge bg-success minutes-badge">

                                        ${number(overtimeMinutes)} min

                                    </span>

                                    <div class="small text-success mt-1">

                                        ${money(overtimePay)}

                                    </div>

                                </td>


                                <td class="money-positive">

                                    ${money(overtimePay)}

                                </td>


                                <td class="money-negative">

                                    - ${money(lateDeduction)}

                                </td>


                                <td class="money-negative">

                                    - ${money(undertimeDeduction)}

                                </td>


                                <td>

                                    ${money(grossSalary)}

                                </td>


                                <td>

                                    ${money(benefits)}

                                </td>


                                <td class="fw-bold text-success">

                                    ${money(netSalary)}

                                </td>

                            </tr>

                        `;

                        });


                        /*
                        ----------------------------------------------------
                        UPDATE SUMMARY
                        ----------------------------------------------------
                        */

                        document.getElementById(
                                "summaryEmployees"
                            ).textContent =
                            data.preview.length;


                        document.getElementById(
                                "summaryLate"
                            ).textContent =
                            `${number(totalLate)} min`;


                        document.getElementById(
                                "summaryUndertime"
                            ).textContent =
                            `${number(totalUndertime)} min`;


                        document.getElementById(
                                "summaryOvertime"
                            ).textContent =
                            `${number(totalOvertime)} min`;


                        /*
                        ----------------------------------------------------
                        SHOW PREVIEW
                        ----------------------------------------------------
                        */

                        document
                            .getElementById(
                                "payrollPreviewSection"
                            )
                            .classList.remove("d-none");


                        document
                            .getElementById(
                                "generatePayslips"
                            )
                            .classList.remove("d-none");

                    })

                    .catch(error => {

                        console.error(error);

                        alert(
                            error.message ??
                            'An error occurred while calculating payroll.'
                        );

                    })

                    .finally(() => {

                        button.disabled = false;

                        button.innerHTML = `

                        <i class="bi bi-search me-2"></i>

                        Preview Payroll

                    `;

                    });

            });


        /*
        ============================================================
        GENERATE PAYSLIPS
        ============================================================
        */

        document
            .getElementById("generatePayslips")
            .addEventListener("click", function() {

                const employees = [];

                document
                    .querySelectorAll(".employee-checkbox:checked")
                    .forEach(box => {

                        employees.push(box.value);

                    });


                const start =
                    document.getElementById(
                        "period_start"
                    ).value;


                const end =
                    document.getElementById(
                        "period_end"
                    ).value;


                if (!start || !end) {

                    alert(
                        'Please select the payroll period.'
                    );

                    return;

                }


                if (employees.length === 0) {

                    alert(
                        'Please select at least one employee.'
                    );

                    return;

                }


                if (!confirm(
                        'Generate payslips for the selected employees?'
                    )) {

                    return;

                }


                const button = this;

                button.disabled = true;

                button.innerHTML = `

                    <span class="spinner-border spinner-border-sm me-2"></span>

                    Generating...

                `;


                fetch("{{ route('payslip.generate') }}", {

                        method: "POST",

                        headers: {

                            "Content-Type": "application/json",

                            "Accept": "application/json",

                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content

                        },

                        body: JSON.stringify({

                            period_start: start,

                            period_end: end,

                            employees: employees

                        })

                    })

                    .then(response => {

                        if (!response.ok) {

                            return response.json()
                                .then(error => {

                                    throw error;

                                });

                        }

                        return response.json();

                    })

                    .then(data => {

                        if (data.success) {

                            alert(

                                `${data.generated} payslip(s) generated successfully.\n\n` +

                                `${data.skipped} employee(s) were skipped because a payslip already exists for the selected payroll period.`

                            );

                            location.reload();

                            return;

                        }


                        alert(
                            data.message ??
                            'Unable to generate payslips.'
                        );

                    })

                    .catch(error => {

                        console.error(error);

                        alert(
                            error.message ??
                            'An error occurred while generating payslips.'
                        );

                    })

                    .finally(() => {

                        button.disabled = false;

                        button.innerHTML = `

                        <i class="bi bi-file-earmark-text me-2"></i>

                        Generate Payslips

                    `;

                    });

            });
    </script>

</body>

</html>
