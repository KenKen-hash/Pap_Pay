<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                <div>
                    <h2 class="fw-bold">
                        <i class="bi bi-sliders text-success"></i>
                        Salary Configuration
                    </h2>

                    <p class="text-muted mb-0">
                        Configure salary, hourly rate, allowances and deductions for every employee.
                    </p>
                </div>

            </div>





            <div class="row g-3 mb-4">

                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 summary-card">
                        <div class="card-body">
                            <small class="text-muted">Total Employees</small>
                            <h2 class="fw-bold">
                                {{ $employees->flatten()->count() }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 summary-card">
                        <div class="card-body">
                            <small class="text-muted">Configured</small>
                            <h2 class="fw-bold text-success">
                                {{ $employees->flatten()->whereNotNull('payrollSetting')->count() }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 summary-card">
                        <div class="card-body">
                            <small class="text-muted">Pending</small>
                            <h2 class="fw-bold text-warning">
                                {{ $employees->flatten()->whereNull('payrollSetting')->count() }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 summary-card">
                        <div class="card-body">
                            <small class="text-muted">Payroll Schedule</small>
                            <h5 class="fw-bold">
                                Every 15 Days
                            </h5>
                        </div>
                    </div>
                </div>

            </div>






            <div class="row g-4">

                <div class="col-md-4">
                    <a href="{{ route('payroll.department', 'Elementary') }}" class="text-decoration-none">
                        <div class="card shadow h-100 text-center p-5">
                            <i class="bi bi-house-door-fill display-4 text-primary"></i>

                            <h4 class="mt-3">
                                Elementary
                            </h4>

                            <p class="text-muted">
                                Configure payroll for elementary teachers.
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('payroll.department', 'JHS') }}" class="text-decoration-none">
                        <div class="card shadow h-100 text-center p-5">
                            <i class="bi bi-book-fill display-4 text-success"></i>

                            <h4 class="mt-3">
                                Junior High School
                            </h4>

                            <p class="text-muted">
                                Configure payroll for JHS.
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('payroll.department', 'SHS') }}" class="text-decoration-none">
                        <div class="card shadow h-100 text-center p-5">
                            <i class="bi bi-journal-bookmark-fill display-4 text-danger"></i>

                            <h4 class="mt-3">
                                Senior High
                            </h4>

                            <p class="text-muted">
                                Configure payroll for SHS.
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('payroll.department', 'College') }}" class="text-decoration-none">
                        <div class="card shadow h-100 text-center p-5">
                            <i class="bi bi-mortarboard-fill display-4 text-warning"></i>

                            <h4 class="mt-3">
                                College
                            </h4>

                            <p class="text-muted">
                                Configure payroll for college faculty.
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('payroll.department', 'Admin') }}" class="text-decoration-none">
                        <div class="card shadow h-100 text-center p-5">
                            <i class="bi bi-building-fill display-4 text-info"></i>

                            <h4 class="mt-3">
                                Administrative
                            </h4>

                            <p class="text-muted">
                                Configure payroll for office personnel.
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('payroll.department', 'Laborers') }}" class="text-decoration-none">
                        <div class="card shadow h-100 text-center p-5">
                            <i class="bi bi-person-workspace display-4 text-secondary"></i>

                            <h4 class="mt-3">
                                Laborers
                            </h4>

                            <p class="text-muted">
                                Configure payroll for maintenance personnel.
                            </p>
                        </div>
                    </a>
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
                <span>Profile management page.</span>
            </div>
        </footer>
    </div>
</div>

<!-- Payroll Configuration Modal -->

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../../khen/assets/js/main.js"></script>

<script>
    // ==========================
    // Employee Search
    // ==========================
    const search = document.getElementById("employeeSearch");

    if (search) {
        search.addEventListener("keyup", function() {

            let value = this.value.toLowerCase();

            document.querySelectorAll(".employee-row").forEach(row => {

                row.style.display =
                    row.innerText.toLowerCase().includes(value) ?
                    "" :
                    "none";

            });

        });
    }

    // ==========================
    // Department Filter
    // ==========================
    const departmentFilter = document.getElementById("departmentFilter");

    if (departmentFilter) {

        departmentFilter.addEventListener("change", function() {

            let value = this.value;

            document.querySelectorAll(".department-container").forEach(section => {

                if (value === "") {

                    section.style.display = "";

                    return;

                }

                section.style.display =
                    section.innerText.includes(value) ?
                    "" :
                    "none";

            });

        });

    }

    // ==========================
    // Payroll Modal
    // ==========================
    const payrollModal = new bootstrap.Modal(
        document.getElementById('payrollModal')
    );

    document.querySelectorAll('.configurePayroll').forEach(button => {

        button.addEventListener('click', function() {

            document.getElementById("user_id").value = this.dataset.id;

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

    // ==========================
    // Show Department Form
    // ==========================
    function loadDepartmentFields(department) {

        let html = '';

        // ============================================
        // PRIMARY
        // ============================================

        if (department === "Primary") {

            html = `
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-light">

            <h5 class="mb-0">

                <i class="bi bi-cash-coin me-2"></i>

                Department Earnings

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <label class="form-label">

                        Other Allowance

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            ₱

                        </span>

                        <input
                            type="number"
                            name="other_allowance"
                            class="form-control"
                            value="0">

                    </div>

                </div>

            </div>

        </div>

    </div>
    `;
        }

        // ============================================
        // SECONDARY
        // ============================================

        if (department === "Secondary") {

            html = `
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-light">

            <h5 class="mb-0">

                <i class="bi bi-cash-coin me-2"></i>

                Department Earnings

            </h5>

        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-4">

                    <label class="form-label">

                        Teaching Load Pay

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">₱</span>

                        <input
                            type="number"
                            name="teaching_load"
                            class="form-control"
                            value="0">

                    </div>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Advisory Allowance

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">₱</span>

                        <input
                            type="number"
                            name="advisory_allowance"
                            class="form-control"
                            value="0">

                    </div>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Other Allowance

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">₱</span>

                        <input
                            type="number"
                            name="other_allowance"
                            class="form-control"
                            value="0">

                    </div>

                </div>

            </div>

        </div>

    </div>
    `;
        }

        // ============================================
        // TERTIARY
        // ============================================

        if (department === "Tertiary") {

            html = `
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-light">

            <h5 class="mb-0">

                <i class="bi bi-cash-coin me-2"></i>

                Department Earnings

            </h5>

        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-4">

                    <label class="form-label">

                        Teaching Load Pay

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">₱</span>

                        <input
                            type="number"
                            name="teaching_load"
                            class="form-control"
                            value="0">

                    </div>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Laboratory Rate

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">₱</span>

                        <input
                            type="number"
                            name="laboratory_rate"
                            class="form-control"
                            value="0">

                    </div>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Other Allowance

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">₱</span>

                        <input
                            type="number"
                            name="other_allowance"
                            class="form-control"
                            value="0">

                    </div>

                </div>

            </div>

        </div>

    </div>
    `;
        }

        // ============================================
        // NON TEACHING
        // ============================================

        if (department === "Non-Teaching") {

            html = `
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-light">

            <h5 class="mb-0">

                <i class="bi bi-cash-coin me-2"></i>

                Department Earnings

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <label class="form-label">

                        Other Allowance

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            ₱

                        </span>

                        <input
                            type="number"
                            name="other_allowance"
                            class="form-control"
                            value="0">

                    </div>

                </div>

            </div>

        </div>

    </div>
    `;
        }

        document.getElementById("departmentFields").innerHTML = html;

    }

    // ==========================
    // Auto Compute Daily & Hourly
    // (Temporary - Will Remove in Phase 2)
    // ==========================
    document.addEventListener("input", function(e) {

        if (e.target.name === "monthly_rate") {

            let monthly = parseFloat(e.target.value) || 0;

            let daily = monthly / 22;

            let hourly = daily / 8;

            document.querySelectorAll("[name='daily_rate']").forEach(input => {
                input.value = daily.toFixed(2);
            });

            document.querySelectorAll("[name='hourly_rate']").forEach(input => {
                input.value = hourly.toFixed(2);
            });

        }

    });





    document.addEventListener("input", function() {

        let total = 0;

        document.querySelectorAll(".deduction").forEach(input => {

            total += parseFloat(input.value) || 0;

        });

        document.getElementById("monthlyDeduction").innerHTML =

            "₱" + total.toLocaleString(undefined, {
                minimumFractionDigits: 2
            });

        document.getElementById("payrollDeduction").innerHTML =

            "₱" + (total / 2).toLocaleString(undefined, {
                minimumFractionDigits: 2
            });

    });

    document.addEventListener("input", function() {

        let total = 0;

        document.querySelectorAll(".allowance").forEach(function(input) {

            total += parseFloat(input.value) || 0;

        });

        const totalElement = document.getElementById("allowanceTotal");

        if (totalElement) {

            totalElement.innerHTML =

                "₱" +

                total.toLocaleString(undefined, {

                    minimumFractionDigits: 2

                });

        }

    });

    // ==========================
    // Save Payroll Configuration
    // ==========================
    document.getElementById("savePayroll").addEventListener("click", function() {

        let form = document.getElementById("payrollForm");

        let formData = new FormData(form);

        fetch("{{ route('payroll.save') }}", {

                method: "POST",

                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },

                body: formData

            })
            .then(response => response.json())
            .then(data => {

                if (data.success) {

                    alert("Payroll configuration saved successfully.");

                    payrollModal.hide();

                    location.reload();

                }

            })
            .catch(error => {

                console.error(error);

                alert("Failed to save payroll configuration.");

            });

    });
</script>

<style>
    .summary-card {

        border-radius: 18px;

        transition: .25s;

    }

    .summary-card:hover {

        transform: translateY(-4px);

    }

    .payroll-accordion .accordion-item {

        border: none;

        border-radius: 18px;

        overflow: hidden;

    }

    .payroll-accordion .accordion-button {

        background: #198754;

        color: #fff;

        padding: 22px;

        box-shadow: none;

    }

    .payroll-accordion .accordion-button small {

        color: #d7f7e3;

    }

    .payroll-accordion .accordion-button:not(.collapsed) {

        background: #157347;

        color: white;

    }

    .payroll-accordion .accordion-button::after {

        filter: brightness(0) invert(1);

    }

    .salary-table thead {

        background: #f8f9fa;

    }

    .salary-table thead th {

        font-weight: 600;

        border: none;

        padding: 16px;

    }

    .salary-table tbody td {

        padding: 18px 16px;

        vertical-align: middle;

    }

    .salary-table tbody tr {

        transition: .25s;

    }

    .salary-table tbody tr:hover {

        background: #f8f9fa;

    }

    .salary-table img {

        object-fit: cover;

    }

    @media(max-width:768px) {

        .salary-table {

            min-width: 950px;

        }

    }

    .modal-content {

        border-radius: 20px;

    }

    .modal-header {

        padding: 22px;

    }

    .modal-header small {

        opacity: .85;

    }

    .modal-body {

        background: #f8f9fa;

    }

    .modal .card {

        border-radius: 16px;

    }

    .modal .card-header {

        font-weight: 600;

        background: #fff;

    }

    .modal label {

        font-size: .85rem;

        font-weight: 600;

        margin-bottom: 6px;

    }

    .input-group-text {

        font-weight: 600;

    }

    #modalPhoto {

        object-fit: cover;

        background: #fff;

    }

    #departmentFields .card {

        animation: fadeIn .25s ease;

    }

    @keyframes fadeIn {

        from {

            opacity: 0;

            transform: translateY(10px);

        }

        to {

            opacity: 1;

            transform: translateY(0);

        }

    }
</style>

</body>

</html>