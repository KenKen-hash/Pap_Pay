@php
    $employee = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Tables | adminHMD</title>

  <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../../../../../khen/assets/css/style.css">
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
        <a class="nav-link" href="{{ route ('dashboard') }}">
          <span class="nav-icon"><i class="bi bi-house-door" aria-hidden="true"></i></span>
          <span class="nav-text">Dashboard</span>
        </a>
        <a class="nav-link" href="{{ route ('attendance') }}">
          <span class="nav-icon"><i class="bi bi-calendar-check" aria-hidden="true"></i></span>
          <span class="nav-text">Attendance</span>
        </a>
        <a class="nav-link" href="{{ route ('file_leave') }}">
          <span class="nav-icon"><i class="bi bi-calendar-plus" aria-hidden="true"></i></span>
          <span class="nav-text">File Leave</span>
        </a>
        <a class="nav-link" href="{{ route ('file_ob') }}">
          <span class="nav-icon"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
          <span class="nav-text">File OB</span>
        </a>
        <a class="nav-link active" href="{{ route ('payslip') }}" aria-current="page">
          <span class="nav-icon"><i class="bi bi-receipt" aria-hidden="true"></i></span>
          <span class="nav-text">Payslip</span>
        </a>
        <a class="nav-link" href="{{ route ('my_profile') }}">
          <span class="nav-icon"><i class="bi bi-person" aria-hidden="true"></i></span>
          <span class="nav-text">My Profile</span>
        </a>
      </nav>

      <div class="sidebar-user">
        <img class="avatar-img avatar-md sidebar-user-avatar" src="{{ $employee->photo
    ? asset('storage/'.$employee->photo)
    : asset('images/default-avatar.png')
}}" alt="{{ $employee->name ?? 'Employee' }}">
        <strong>{{ $employee->name ?? 'Employee Name' }}</strong>
        <small>{{ $employee->position ?? 'Position' }}</small>
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
                <img class="avatar-img avatar-sm" src="{{ $employee->photo
    ? asset('storage/'.$employee->photo)
    : asset('images/default-avatar.png')
}}" alt="{{ $employee->name ?? 'Employee' }}">
                <span class="profile-name d-none d-sm-inline">{{ $employee->name ?? 'Employee' }}</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route ('my_profile') }}">My Profile</a></li>

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

<main class="dashboard-content">

<div class="container-fluid px-3 px-lg-4 py-4">

    <!-- PAGE HEADER -->
    <div class="page-heading">

        <div class="page-heading-copy">

            <span class="page-icon">
                <i class="bi bi-receipt-cutoff"></i>
            </span>

            <div>

                <p class="eyebrow mb-1">Employee Payroll</p>

                <h1 class="h3 mb-1">My Payslips</h1>

                <p class="text-muted mb-0">
                    Download and review all payslips released by HR.
                </p>

            </div>

        </div>

    </div>


    <!-- EMPLOYEE INFO CARD -->
    <section class="panel mt-3">

        <div class="panel-body">

            <div class="row align-items-center gy-3">

                <div class="col-12 col-lg-8">

                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-3">

                        <img
                            src="{{ $employee->photo ? asset('storage/'.$employee->photo) : asset('images/default-avatar.png') }}"
                            class="rounded-circle shadow"
                            width="85"
                            height="85"
                            style="object-fit:cover;"
                        >

                        <div class="text-center text-sm-start">

                            <h4 class="mb-1">
                                {{ $employee->name }}
                            </h4>

                            <p class="text-muted mb-1">
                                {{ $employee->position }}
                            </p>

                            <span class="badge bg-primary">
                                {{ $employee->department }}
                            </span>

                            <span class="badge bg-dark">
                                ID: {{ $employee->employee_id }}
                            </span>

                        </div>

                    </div>

                </div>

                <div class="col-12 col-lg-4 text-center text-lg-end">

                    <small class="text-muted">Payroll Records</small>

                    <h5>
                        {{ $payslips->count() }} Payslips
                    </h5>

                </div>

            </div>

        </div>

    </section>


    <!-- LATEST PAYSLIP HIGHLIGHT -->
    <section class="panel mt-4">

        <div class="panel-body d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

            <div>

                <h5 class="mb-1">
                    Latest Payslip
                </h5>

                <p class="text-muted mb-0">
                    Your most recent payroll record is ready for download.
                </p>

            </div>

            @if($payslips->first())

                <a href="{{ route('payslip.download', $payslips->first()->id) }}"
                   class="btn btn-primary">

                    <i class="bi bi-download me-1"></i>
                    Download Latest

                </a>

            @else

                <button class="btn btn-secondary" disabled>
                    No Payslip Yet
                </button>

            @endif

        </div>

    </section>


    <!-- PAYSLIP LIST -->
    <section class="panel mt-4">

        <div class="panel-header">

            <div>

                <h2 class="h5 mb-1">Payslip History</h2>

                <p class="text-muted mb-0">
                    All released payslips from HR
                </p>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>
                        <th>Pay Period</th>
                        <th>Gross</th>
                        <th>Deductions</th>
                        <th>Net Pay</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($payslips as $p)

                    <tr>

                        <td>
                            {{ $p->pay_period }}
                        </td>

                        <td>
                            ₱ {{ number_format($p->gross_pay ?? 0, 2) }}
                        </td>

                        <td>
                            ₱ {{ number_format(($p->tax + $p->sss + $p->philhealth + $p->pagibig), 2) }}
                        </td>

                        <td class="fw-bold">
                            ₱ {{ number_format($p->net_pay ?? 0, 2) }}
                        </td>

                        <td>

                            @if($p->status == 'released')
                                <span class="badge bg-success">Released</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif

                        </td>

                        <td>

                            @if($p->status == 'released')

                                <a href="{{ route('payslip.download', $p->id) }}"
                                   class="btn btn-sm btn-outline-primary">

                                    Download

                                </a>

                            @else

                                <button class="btn btn-sm btn-secondary" disabled>
                                    Not Available
                                </button>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center py-5">

                            <i class="bi bi-receipt fs-1 text-muted"></i>

                            <h5 class="mt-3">No Payslip Found</h5>

                            <p class="text-muted">
                                Your payslips will appear here once released by HR
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

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Responsive table examples.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../../khen/assets/js/main.js"></script>
</body>
</html>
