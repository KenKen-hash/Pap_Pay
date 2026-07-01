<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
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
        <a class="brand-mark" href="{{ route ('dashboard') }}" aria-label="adminHMD dashboard">
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
    <img
        class="avatar-img avatar-md sidebar-user-avatar"
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
          <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar" aria-expanded="true" aria-label="Toggle sidebar">
            <span></span>
            <span></span>
            <span></span>
          </button>

          <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
            <input class="form-control search-input" type="search" placeholder="Search users, roles, teams" aria-label="Search">
          </form>

          <div class="navbar-actions ms-auto">
            <button class="icon-button theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
              <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
            </button>
            <div class="dropdown">
              <button class="icon-button" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                <span class="notification-dot"></span>
                <i class="bi bi-bell" aria-hidden="true"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end notification-menu">
                <div class="dropdown-header fw-bold text-body">Notifications</div>
                <a class="dropdown-item" href="{{ route('employees.index') }}">
                  <span class="notification-title">New user registered</span>
                  <span class="notification-time">4 minutes ago</span>
                </a>
                <a class="dropdown-item" href="{{ route ('payslip_list') }}">
                  <span class="notification-title">Revenue target reached</span>
                  <span class="notification-time">32 minutes ago</span>
                </a>
                <a class="dropdown-item" href="{{ route ('settings') }}">
                  <span class="notification-title">Security review completed</span>
                  <span class="notification-time">1 hour ago</span>
                </a>
              </div>
            </div>

            <div class="dropdown">
              <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                <li><a class="dropdown-item" href="{{ route ('payroll') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route ('settings') }}">Account settings</a></li>
                <li><hr class="dropdown-divider"></li>
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
                <p class="text-muted mb-0">Review accounts, roles, account status, and team ownership.</p>
              </div>
            </div>
           <button class="btn btn-outline-secondary btn-sm">

<i class="bi bi-download"></i>

Export

</button>
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
                {{ $employees->total() }}
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
                {{ $employees->where('status','Active')->count() }}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="metric-card metric-warning">
            <div class="metric-top">
                <span class="metric-label">
                    Inactive
                </span>
            </div>

            <div class="metric-value">
                {{ $employees->where('status','Inactive')->count() }}
            </div>
        </div>
    </div>

</section>

          <section class="panel mt-3">
            <div class="panel-header">
              <div>
                <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>User List</span></h2>
                <p class="text-muted mb-0">Search, review, and manage team member accounts.</p>
              </div>
              <div class="d-flex flex-wrap gap-2">
                <input class="form-control form-control-sm table-search" type="search" placeholder="Search users" data-table-search="usersTable" aria-label="Search users">
                <a href="{{ route('users.choose') }}"
class="btn btn-primary btn-sm">

<i class="bi bi-person-plus"></i>

Add User

</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0" id="usersTable" data-searchable-table>
                <thead>

<tr>

<th>Photo</th>

<th>Employee ID</th>

<th>Name</th>

<th>Email</th>

<th>Department</th>

<th>Position</th>

<th>Status</th>

<th>Hire Date</th>

<th width="170">
Action
</th>

</tr>

</thead>
               <tbody>

@forelse($employees as $employee)

<tr>

<td>

<img
src="{{ $employee->photo
        ? asset('storage/'.$employee->photo)
        : asset('images/default-avatar.png') }}"
class="rounded-circle"
width="50"
height="50">

</td>

<td>

{{ $employee->employee_id }}

</td>

<td>

<strong>

{{ $employee->first_name }}
{{ $employee->last_name }}

</strong>

</td>

<td>

{{ $employee->email }}

</td>

<td>

{{ $employee->department }}

</td>

<td>

{{ $employee->position }}

</td>

<td>

@if($employee->status=="Active")

<span class="badge bg-success">

{{ $employee->status }}

</span>

@else

<span class="badge bg-secondary">

{{ $employee->status }}

</span>

@endif

</td>

<td>

{{ \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') }}

</td>

<td>
<div class="d-flex justify-content-center gap-2">

<a href="#" class="btn btn-sm btn-outline-primary">
<i class="bi bi-eye"></i>
</a>

<a href="#" class="btn btn-sm btn-outline-warning">
<i class="bi bi-pencil"></i>
</a>

<form>
<button class="btn btn-sm btn-outline-danger">
<i class="bi bi-trash"></i>
</button>
</form>

</div>
</td>

</tr>

@empty

<tr>

<td colspan="9" class="text-center">

No employees found.

</td>

</tr>

@endforelse

</tbody>
              </table>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
              <p class="text-muted small mb-0">Showing

{{ $employees->firstItem() }}

to

{{ $employees->lastItem() }}

of

{{ $employees->total() }}

employees</p>
            {{ $employees->links() }}
            </div>
          </section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a> </span>
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
