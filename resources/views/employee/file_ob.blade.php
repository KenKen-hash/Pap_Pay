@php
    $employee = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Charts | adminHMD</title>

  <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="index.html" aria-label="adminHMD dashboard">
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
        <a class="nav-link" href="{{ route ('file_leave') }}">
          <span class="nav-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
          <span class="nav-text">File Leave</span>
        </a>
         <a class="nav-link active" href="{{ route ('file_ob') }}" aria-current="page">
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
                <div class="dropdown-header fw-bold text-body">Notifications</div>
                <a class="dropdown-item" href="users.html">
                  <span class="notification-title">New user registered</span>
                  <span class="notification-time">4 minutes ago</span>
                </a>
                <a class="dropdown-item" href="charts.html">
                  <span class="notification-title">Revenue target reached</span>
                  <span class="notification-time">32 minutes ago</span>
                </a>
                <a class="dropdown-item" href="settings.html">
                  <span class="notification-title">Security review completed</span>
                  <span class="notification-time">1 hour ago</span>
                </a>
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

    <!-- ========================= -->
    <!-- PAGE HEADER -->
    <!-- ========================= -->

    <div class="page-heading">

        <div class="page-heading-copy">

            <span class="page-icon">
                <i class="bi bi-briefcase-fill"></i>
            </span>

            <div>

                <p class="eyebrow mb-1">
                    Employee Portal
                </p>

                <h1 class="h3 mb-1">
                    Official Business
                </h1>

                <p class="text-muted mb-0">
                    Submit and monitor your Official Business requests.
                </p>

            </div>

        </div>

    </div>


    <!-- ========================= -->
    <!-- EMPLOYEE CARD -->
    <!-- ========================= -->

    <section class="panel mt-3">

        <div class="panel-body">

            <div class="row align-items-center gy-4">

                <div class="col-12 col-lg-8">

                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-3">

                        <img
                            src="{{ $employee->photo ? asset('storage/'.$employee->photo) : asset('images/default-avatar.png') }}"
                            class="rounded-circle shadow"
                            width="90"
                            height="90"
                            style="object-fit:cover;"
                        >

                        <div class="text-center text-sm-start">

                            <h3 class="mb-1">

                                {{ $employee->name }}

                            </h3>

                            <p class="text-muted mb-2">

                                {{ $employee->position }}

                            </p>

                            <span class="badge bg-primary">

                                {{ $employee->department }}

                            </span>

                            <span class="badge bg-success">

                                Employee ID :
                                {{ $employee->employee_id }}

                            </span>

                        </div>

                    </div>

                </div>

                <div class="col-12 col-lg-4 text-center text-lg-end">

                    <small class="text-muted">

                        Today

                    </small>

                    <h4>

                        {{ now()->format('F d, Y') }}

                    </h4>

                </div>

            </div>

        </div>

    </section>


    <!-- ========================= -->
    <!-- SUMMARY CARDS -->
    <!-- ========================= -->

    <section class="row g-3 mt-3">

        <div class="col-12 col-sm-6 col-xl-3">

            <article class="metric-card metric-warning h-100">

                <div class="metric-top">

                    <span class="metric-label">

                        Pending

                    </span>

                    <span class="metric-icon">

                        <i class="bi bi-hourglass-split"></i>

                    </span>

                </div>

                <div class="metric-value">

                    3

                </div>

                <div class="metric-meta">

                    Pending Requests

                </div>

            </article>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <article class="metric-card metric-success h-100">

                <div class="metric-top">

                    <span class="metric-label">

                        Approved

                    </span>

                    <span class="metric-icon">

                        <i class="bi bi-check-circle-fill"></i>

                    </span>

                </div>

                <div class="metric-value">

                    12

                </div>

                <div class="metric-meta">

                    Approved Requests

                </div>

            </article>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <article class="metric-card metric-danger h-100">

                <div class="metric-top">

                    <span class="metric-label">

                        Rejected

                    </span>

                    <span class="metric-icon">

                        <i class="bi bi-x-circle-fill"></i>

                    </span>

                </div>

                <div class="metric-value">

                    1

                </div>

                <div class="metric-meta">

                    Rejected Requests

                </div>

            </article>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <article class="metric-card metric-primary h-100">

                <div class="metric-top">

                    <span class="metric-label">

                        Total OB

                    </span>

                    <span class="metric-icon">

                        <i class="bi bi-briefcase-fill"></i>

                    </span>

                </div>

                <div class="metric-value">

                    16

                </div>

                <div class="metric-meta">

                    Total Requests

                </div>

            </article>

        </div>

    </section>


    <!-- ========================= -->
    <!-- OFFICIAL BUSINESS FORM -->
    <!-- ========================= -->

    <section class="panel mt-4">

        <div class="panel-header">

            <div>

                <h2 class="h5 mb-1">

                    File Official Business

                </h2>

                <p class="text-muted mb-0">

                    Complete the information below.

                </p>

            </div>

        </div>

        <div class="panel-body">

            <form>

                <div class="row g-3">

                    <div class="col-12">

                        <label class="form-label">

                            Purpose

                        </label>

                        <textarea
                            class="form-control"
                            rows="3"
                            placeholder="Enter purpose of official business..."
                        ></textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">

                            Destination

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Destination"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">

                            Supervisor

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Immediate Supervisor"
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">

                            Date

                        </label>

                        <input
                            type="date"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">

                            Time From

                        </label>

                        <input
                            type="time"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">

                            Time To

                        </label>

                        <input
                            type="time"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">

                            Transportation

                        </label>

                        <select class="form-select">

                            <option>Company Vehicle</option>

                            <option>Personal Vehicle</option>

                            <option>Public Transportation</option>

                            <option>Walking</option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">

                            Attachment

                        </label>

                        <input
                            type="file"
                            class="form-control"
                        >

                    </div>


                    <div class="col-12">

                        <label class="form-label">

                            Additional Remarks

                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Optional remarks..."
                        ></textarea>

                    </div>

                    <div class="col-12 d-flex flex-column flex-sm-row gap-2 justify-content-end">

                        <button
                            type="reset"
                            class="btn btn-outline-secondary"
                        >

                            Reset

                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-send-fill me-1"></i>

                            Submit Request

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </section>
    <section class="panel mt-4">

    <div class="panel-header">

        <div>

            <h2 class="h5 mb-1">
                Official Business History
            </h2>

            <p class="text-muted mb-0">
                All your submitted OB requests
            </p>

        </div>

    </div>

    <div class="panel-body">

        <div class="table-responsive">

            <table class="table align-middle table-hover">

                <thead>

                    <tr>
                        <th>Date</th>
                        <th>Destination</th>
                        <th>Purpose</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($officialBusinesses ?? [] as $ob)

                        <tr>

                            <td>
                                {{ \Carbon\Carbon::parse($ob->ob_date)->format('M d, Y') }}
                            </td>

                            <td>
                                {{ $ob->destination }}
                            </td>

                            <td>
                                {{ $ob->purpose }}
                            </td>

                            <td>
                                {{ $ob->time_from }} - {{ $ob->time_to }}
                            </td>

                            <td>

                                @if($ob->status == 'Pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($ob->status == 'Approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($ob->status == 'Rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Unknown</span>
                                @endif

                            </td>

                            <td>
                                {{ $ob->remarks ?? '-' }}
                            </td>

                            <td>

                                <button class="btn btn-sm btn-outline-primary">
                                    View
                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-inbox fs-1 text-muted"></i>

                                <h5 class="mt-3">
                                    No Official Business found
                                </h5>

                                <p class="text-muted">
                                    Your OB requests will appear here after submission
                                </p>

                            </td>

                        </tr>
                        
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>
</main>


      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Analytics chart examples.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../khen/assets/js/main.js"></script>
</body>
</html>
