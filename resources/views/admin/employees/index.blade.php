<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Users | adminHMD</title>

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
                    <span class="nav-text">Statistics</span>
                </a>

                <a class="nav-link active" href="{{ route('employees.index') }}">
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
                        <input class="form-control search-input" type="search" placeholder="Search users, roles, teams"
                            aria-label="Search">
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
                    <div class="page-heading">
                        <div class="page-heading-copy">
                            <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                            <div>
                                <p class="eyebrow mb-1">Management</p>
                                <h1 class="h3 mb-1">Users</h1>
                                <p class="text-muted mb-0">Review accounts, roles, account status, and team ownership.
                                </p>
                            </div>
                        </div>

                    </div>

                    <section class="row g-3 mt-1">

                        <div class="col-md-4">
                            <div class="metric-card metric-primary">
                                <div class="metric-top">
                                    <span class="metric-label">
                                        Total Users
                                    </span>
                                </div>

                                <div class="metric-value">
                                    {{ $elementaryEmployees->count() +
                                        $jhsEmployees->count() +
                                        $shsEmployees->count() +
                                        $collegeEmployees->count() +
                                        $adminEmployees->count() +
                                        $laborerEmployees->count() }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="metric-card metric-success">
                                <div class="metric-top">
                                    <span class="metric-label">
                                        Active
                                    </span>
                                </div>

                                <div class="metric-value">
                                    {{ $elementaryEmployees->where('status', 'Active')->count() +
                                        $jhsEmployees->where('status', 'Active')->count() +
                                        $shsEmployees->where('status', 'Active')->count() +
                                        $collegeEmployees->where('status', 'Active')->count() +
                                        $adminEmployees->where('status', 'Active')->count() +
                                        $laborerEmployees->where('status', 'Active')->count() }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="metric-card metric-warning" style="cursor:pointer;" data-bs-toggle="modal"
                                data-bs-target="#inactiveEmployeesModal">
                                <div class="metric-top">
                                    <span class="metric-label">
                                        Inactive
                                    </span>
                                </div>

                                <div class="metric-value">
                                    {{ $inactiveEmployees->count() }}
                                </div>
                            </div>
                        </div>

                    </section>

                    <section class="panel mt-3">
                        <div class="panel-header">
                            <div>
                                <h2 class="h5 mb-1 section-title"><i class="bi bi-table"
                                        aria-hidden="true"></i><span>User List</span></h2>
                                <p class="text-muted mb-0">Search, review, and manage team member accounts.</p>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <input class="form-control form-control-sm table-search" type="search"
                                    placeholder="Search users" data-table-search="usersTable"
                                    aria-label="Search users">
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-person-plus"></i>
                                    Add User
                                </a>
                            </div>
                        </div>

                    </section>

                    {{-- Elementary --}}
                    @include('admin.employees.table', [
                        'title' => 'Elementary Department',
                        'employees' => $elementaryEmployees,
                    ])

                    {{-- Junior High School --}}
                    @include('admin.employees.table', [
                        'title' => 'Junior High School (JHS)',
                        'employees' => $jhsEmployees,
                    ])

                    {{-- Senior High School --}}
                    @include('admin.employees.table', [
                        'title' => 'Senior High School (SHS)',
                        'employees' => $shsEmployees,
                    ])

                    {{-- College --}}
                    @include('admin.employees.table', [
                        'title' => 'College Department',
                        'employees' => $collegeEmployees,
                    ])

                    {{-- Admin --}}
                    @include('admin.employees.table', [
                        'title' => 'Administrative Personnel',
                        'employees' => $adminEmployees,
                    ])

                    {{-- Laborers --}}
                    @include('admin.employees.table', [
                        'title' => 'Laborers',
                        'employees' => $laborerEmployees,
                    ])
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

    <!-- Inactive Employees Modal -->

    <div class="modal fade" id="inactiveEmployeesModal" tabindex="-1">

        <div class="modal-dialog modal-xl">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Inactive Employees

                    </h5>

                    <button class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Name</th>

                                <th>Department</th>

                                <th>Position</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($inactiveEmployees as $employee)
                                <tr>

                                    <td>{{ $employee->employee_id }}</td>

                                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>

                                    <td>{{ $employee->department }}</td>

                                    <td>{{ $employee->position }}</td>

                                    <td>

                                        <span class="badge bg-danger">

                                            Inactive

                                        </span>

                                    </td>

                                    <td>

                                        <button class="btn btn-success reactivateEmployee"
                                            data-id="{{ $employee->id }}">

                                            <i class="bi bi-arrow-repeat"></i>

                                            Reactivate

                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center">

                                        No inactive employees.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>
    <script>
        document.querySelectorAll(".viewEmployee").forEach(button => {

            button.addEventListener("click", function() {

                let url = this.dataset.url;

                fetch(url)

                    .then(response => response.json())

                    .then(employee => {

                        document.getElementById("employeeDetails").innerHTML = `

<div class="row">

<div class="col-md-4 text-center">

<img
src="${employee.photo
? '/storage/'+employee.photo
: '/images/default-avatar.png'}"
class="rounded-circle border mb-3"
width="150"
height="150"
style="object-fit:cover;">

<h4>

${employee.first_name} ${employee.last_name}

</h4>

<p class="text-muted">

${employee.position}

</p>

</div>

<div class="col-md-8">

<table class="table table-bordered">

<tr>

<th>Employee ID</th>

<td>${employee.employee_id ?? '-'}</td>

</tr>

<tr>

<th>Email</th>

<td>${employee.email ?? '-'}</td>

</tr>

<tr>

<th>Department</th>

<td>${employee.department ?? '-'}</td>

</tr>

<tr>

<th>Position</th>

<td>${employee.position ?? '-'}</td>

</tr>

<tr>

<th>Status</th>

<td>${employee.status ?? '-'}</td>

</tr>

<tr>

<th>Gender</th>

<td>${employee.gender ?? '-'}</td>

</tr>

<tr>

<th>Birth Date</th>

<td>${employee.birth_date ?? '-'}</td>

</tr>

<tr>

<th>Contact Number</th>

<td>${employee.contact_number ?? '-'}</td>

</tr>

<tr>

<th>Address</th>

<td>${employee.address ?? '-'}</td>

</tr>

<tr>

<th>Employment Type</th>

<td>${employee.employment_type ?? '-'}</td>

</tr>

<tr>

<th>Salary Grade</th>

<td>${employee.salary_grade ?? '-'}</td>

</tr>

<tr>

<th>Emergency Contact</th>

<td>${employee.emergency_contact_person ?? '-'}</td>

</tr>

<tr>

<th>Emergency Number</th>

<td>${employee.emergency_contact_number ?? '-'}</td>

</tr>

<tr>

<th>Hire Date</th>

<td>${employee.hire_date ?? '-'}</td>

</tr>

<tr>

<th>Bio</th>

<td>${employee.bio ?? '-'}</td>

</tr>

</table>

</div>

</div>

`;

                        new bootstrap.Modal(document.getElementById("employeeModal")).show();

                    });

            });

        });


        document.querySelectorAll(".editEmployee").forEach(button => {

            button.addEventListener("click", function() {

                let url = this.dataset.url;

                fetch(url)

                    .then(response => response.json())

                    .then(employee => {

                        document.getElementById("employee_id").value = employee.id;

                        document.getElementById("first_name").value = employee.first_name ?? "";
                        document.getElementById("middle_name").value = employee.middle_name ?? "";
                        document.getElementById("last_name").value = employee.last_name ?? "";
                        document.getElementById("email").value = employee.email ?? "";
                        document.getElementById("contact_number").value = employee.contact_number ?? "";
                        document.getElementById("department").value = employee.department ?? "";
                        document.getElementById("position").value = employee.position ?? "";
                        document.getElementById("gender").value = employee.gender ?? "";
                        document.getElementById("employment_type").value = employee.employment_type ??
                            "";
                        document.getElementById("status").value = employee.status ?? "";
                        document.getElementById("salary_grade").value = employee.salary_grade ?? "";
                        document.getElementById("birth_date").value = employee.birth_date ?? "";
                        document.getElementById("address").value = employee.address ?? "";
                        document.getElementById("emergency_contact_person").value = employee
                            .emergency_contact_person ?? "";
                        document.getElementById("emergency_contact_number").value = employee
                            .emergency_contact_number ?? "";
                        document.getElementById("bio").value = employee.bio ?? "";

                        new bootstrap.Modal(document.getElementById("editEmployeeModal")).show();

                    });

            });

        });

        document.getElementById("editEmployeeForm").addEventListener("submit", function(e) {

            e.preventDefault();

            const id = document.getElementById("employee_id").value;

            const formData = new FormData(this);

            fetch("/admin/employees/" + id, {

                    method: "POST",

                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    },

                    body: formData

                })

                .then(async response => {

                    const data = await response.json();

                    if (!response.ok) {
                        console.log(data);
                        alert("Update failed. Check the browser console (F12).");
                        return;
                    }

                    alert(data.message);

                    bootstrap.Modal.getInstance(document.getElementById("editEmployeeModal")).hide();

                    location.reload();

                })

                .catch(error => {

                    console.error(error);

                    alert("Something went wrong.");

                });

        });

        document.querySelectorAll(".deactivateEmployee").forEach(button => {

            button.addEventListener("click", function() {

                document.getElementById("deactivateEmployeeId").value = this.dataset.id;

                document.getElementById("deactivateEmployeeName").textContent = this.dataset.name;

                new bootstrap.Modal(
                    document.getElementById("deactivateEmployeeModal")
                ).show();

            });

        });
        document.getElementById("confirmDeactivateEmployee").addEventListener("click", function() {

            const id = document.getElementById("deactivateEmployeeId").value;

            fetch("/admin/employees/" + id, {

                    method: "POST",

                    headers: {

                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,

                        "Accept": "application/json"

                    },

                    body: new URLSearchParams({

                        "_method": "DELETE"

                    })

                })

                .then(response => response.json())

                .then(data => {

                    if (data.success) {

                        alert(data.message);

                        location.reload();

                    } else {

                        alert(data.message);

                    }

                });

        });



        document.querySelectorAll(".reactivateEmployee").forEach(button => {

            button.addEventListener("click", function() {

                const id = this.dataset.id;

                fetch("/admin/employees/" + id + "/reactivate", {

                        method: "PUT",

                        headers: {

                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,

                            "Accept": "application/json"

                        }

                    })

                    .then(r => r.json())

                    .then(data => {

                        alert(data.message);

                        location.reload();

                    });

            });

        });
    </script>


</body>

</html>
