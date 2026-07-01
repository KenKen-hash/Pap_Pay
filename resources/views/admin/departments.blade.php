<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Components | adminHMD</title>

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
  <a class="nav-link active" href="{{ route('admin-dashboard') }}">
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
                <a class="dropdown-item" href="{{ route ('employees.index') }}">
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
                <li><a class="dropdown-item" {{ route ('payroll') }}">Profile</a></li>
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
              <span class="page-icon"><i class="bi bi-grid-3x3-gap" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">UI Kit</p>
                <h1 class="h3 mb-1">Components</h1>
                <p class="text-muted mb-0">Buttons, badges, progress, accordions, and reusable interface blocks.</p>
              </div>
            </div>
            
          </div>

          <section class="row g-3">
            <div class="col-12 col-xl-6"><div class="panel h-100"><h2 class="h5 mb-3 section-title"><i class="bi bi-cursor" aria-hidden="true"></i><span>Buttons</span></h2><div class="d-flex flex-wrap gap-2"><button class="btn btn-primary" type="button">Primary</button><button class="btn btn-outline-secondary" type="button">Secondary</button><button class="btn btn-success" type="button">Success</button><button class="btn btn-danger" type="button">Danger</button><button class="btn btn-warning" type="button">Warning</button></div><h2 class="h5 mt-4 mb-3">Badges</h2><div class="d-flex flex-wrap gap-2"><span class="badge text-bg-primary">Primary</span><span class="badge text-bg-success">Success</span><span class="badge text-bg-warning">Warning</span><span class="badge text-bg-danger">Danger</span></div></div></div>
            <div class="col-12 col-xl-6"><div class="panel h-100"><h2 class="h5 mb-3 section-title"><i class="bi bi-reception-4" aria-hidden="true"></i><span>Progress</span></h2><div class="progress mb-3"><div class="progress-bar progress-72" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">72%</div></div><div class="progress mb-3"><div class="progress-bar bg-success progress-58" role="progressbar" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">58%</div></div><div class="progress"><div class="progress-bar bg-warning progress-42" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100">42%</div></div></div></div>
            <div class="col-12"><div class="panel"><h2 class="h5 mb-3 section-title"><i class="bi bi-menu-button-wide" aria-hidden="true"></i><span>Accordion</span></h2><div class="accordion" id="componentAccordion"><div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Reusable layout</button></h3><div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#componentAccordion"><div class="accordion-body">Use the admin shell, panel, metric-card, and table styles for consistent pages.</div></div></div><div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Responsive behavior</button></h3><div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#componentAccordion"><div class="accordion-body">The sidebar becomes a mobile overlay and a compact mini sidebar on desktop.</div></div></div></div></div></div>
          </section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Reusable UI components.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../khen/assets/js/main.js"></script>
</body>
</html>
