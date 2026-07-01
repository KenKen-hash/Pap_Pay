<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>File Leave</title>

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
        <a class="nav-link " href="{{ route ('dashboard') }}">
          <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
          <span class="nav-text">Dashboard</span>
        </a>
        <a class="nav-link" href="{{ route ('attendance') }}">
          <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
          <span class="nav-text">Attendace</span>
        </a>
        <a class="nav-link active" href="{{ route ('file_leave') }}" aria-current="page">
          <span class="nav-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
          <span class="nav-text">File Leave</span>
        </a>
         <a class="nav-link" href="{{ route ('file_ob') }}">
          <span class="nav-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
          <span class="nav-text">File OB</span>
        </a>
         <a class="nav-link" href="{{ route ('payslip') }}">
          <span class="nav-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
          <span class="nav-text">Payslip</span>
        </a>
        <a class="nav-link" href="{{ route ('my_profile') }}">
          <span class="nav-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
          <span class="nav-text">Profile</span>
        </a>
      </nav>


      <div class="sidebar-user">
        <img class="avatar-img avatar-md sidebar-user-avatar" src="../../../../khen/assets/images/avatar/avatar.jpg" alt="Admin Hasan">
        <strong>Admin Hasan</strong>
        <small>Active Workspace</small>
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
            <input class="form-control search-input" type="search" placeholder="Search users, orders, reports" aria-label="Search">
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

    <div class="dropdown-header fw-bold">
        Notifications
    </div>

    @forelse($notifications as $notification)

        <a class="dropdown-item"
           href="{{ url($notification->url) }}">

            <span class="notification-title">
                {{ $notification->title }}
            </span>

            <span class="notification-time">
                {{ $notification->message }}
            </span>

        </a>

    @empty

        <div class="dropdown-item text-muted">
            No notifications
        </div>

    @endforelse

</div>
            </div>

            <div class="dropdown">
              <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="avatar-img avatar-sm" src="../../../../khen/assets/images/avatar/avatar.jpg" alt="Admin Hasan">
                <span class="profile-name d-none d-sm-inline">Admin Hasan</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                <li><a class="dropdown-item" href="settings.html">Account settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="login.html">Sign out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon">
                    <i class="bi bi-calendar2-check"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1">Employee</p>
                    <h1 class="h3 mb-1">Leave Application</h1>
                    <p class="text-muted mb-0">
                        Submit your leave request for approval.
                    </p>
                </div>
            </div>

            <div class="heading-actions">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>


        <section class="row g-3">

            <div class="col-lg-8">

                @if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

                <form
                    action="{{ route('leave.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="panel">

                    @csrf

                    <div class="panel-header">

                        <div>

                            <h2 class="h5 mb-1 section-title">

                                <i class="bi bi-calendar-plus"></i>

                                <span>Leave Request Form</span>

                            </h2>

                            <p class="text-muted">

                                Complete all required fields.

                            </p>

                        </div>

                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Employee Name
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ Auth::user()->name }}"
                                readonly>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Employee ID
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ Auth::user()->employee_id }}"
                                readonly>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Department
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ Auth::user()->department }}"
                                readonly>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Position
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ Auth::user()->position }}"
                                readonly>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Leave Type
                            </label>

                            <select
                                class="form-select"
                                name="leave_type"
                                required>

                                <option value="">Select Leave</option>

                                <option>Vacation Leave</option>
                                <option>Sick Leave</option>
                                <option>Emergency Leave</option>
                                <option>Maternity Leave</option>
                                <option>Paternity Leave</option>
                                <option>Bereavement Leave</option>
                                <option>Leave Without Pay</option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                Start Date
                            </label>

                            <input
                                type="date"
                                id="start_date"
                                name="start_date"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                End Date
                            </label>

                            <input
                                type="date"
                                id="end_date"
                                name="end_date"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                Total Days
                            </label>

                            <input
                                id="days"
                                name="days"
                                class="form-control"
                                readonly>

                        </div>

                        <div class="col-12">

                            <label class="form-label">

                                Reason

                            </label>

                            <textarea
                                class="form-control"
                                rows="5"
                                name="reason"
                                required></textarea>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Attachment

                            </label>

                            <input
                                type="file"
                                class="form-control"
                                name="attachment">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Emergency Contact

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="emergency_contact"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Contact Number

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="contact_number"
                                required>

                        </div>

                    </div>

                    <div class="mt-4 text-end">

                        <button
                            class="btn btn-primary">

                            <i class="bi bi-send"></i>

                            Submit Leave Request

                        </button>

                    </div>

                </form>

            </div>


            <div class="col-lg-4">

                <div class="panel">

                    <h5>

                        Leave Status

                    </h5>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Pending</span>

                        <span class="badge bg-warning">

                            {{ Auth::user()->leaveRequests()->where('status','Pending')->count() }}

                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Approved</span>

                        <span class="badge bg-success">

                            {{ Auth::user()->leaveRequests()->where('status','Approved')->count() }}

                        </span>

                    </div>

                    <div class="d-flex justify-content-between">

                        <span>Rejected</span>

                        <span class="badge bg-danger">

                            {{ Auth::user()->leaveRequests()->where('status','Rejected')->count() }}
                        </span>

                    </div>

                </div>

            </div>

        </section>

    </div>
</main>

<script>

const start=document.getElementById('start_date');

const end=document.getElementById('end_date');

const days=document.getElementById('days');

function calculateDays(){

if(start.value && end.value){

let s=new Date(start.value);

let e=new Date(end.value);

let diff=(e-s)/(1000*60*60*24)+1;

days.value=diff>0?diff:0;

}

}

start.addEventListener('change',calculateDays);

end.addEventListener('change',calculateDays);

</script>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Validated user creation form.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../khen/assets/js/main.js"></script>
</body>
</html>
