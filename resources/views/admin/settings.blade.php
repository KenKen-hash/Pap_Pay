<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Settings | adminHMD</title>

  <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="{{ route ('admin-dashboard') }}" aria-label="adminHMD dashboard">
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

  <a class="nav-link active" href="{{ route('settings') }}">
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
              <span class="page-icon"><i class="bi bi-gear" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Workspace</p>
                <h1 class="h3 mb-1">Settings</h1>
                <p class="text-muted mb-0">Customize workspace defaults, security options, and notification preferences.</p>
              </div>
            </div>
            
          </div>

          <section class="row g-3">
            <div class="col-12 col-xl-6">
              <form class="panel needs-validation" novalidate>
                <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-sliders" aria-hidden="true"></i><span>General Settings</span></h2><p class="text-muted mb-0">Configure workspace identity and defaults.</p></div></div>
                <div class="mb-3"><label class="form-label" for="workspaceName">Workspace name</label><input class="form-control" id="workspaceName" type="text" value="adminHMD Workspace" required><div class="invalid-feedback">Workspace name is required.</div></div>
                <div class="mb-3"><label class="form-label" for="defaultLanguage">Default language</label><select class="form-select" id="defaultLanguage"><option selected>English</option><option>Bangla</option><option>Spanish</option></select></div>
                <button class="btn btn-primary" type="submit"><i class="bi bi-check2-circle" aria-hidden="true"></i> Save Settings</button>
              </form>
            </div>
            <div class="col-12 col-xl-6">
              <div class="panel h-100">
                <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-toggles2" aria-hidden="true"></i><span>Preferences</span></h2><p class="text-muted mb-0">Control notifications and security options.</p></div></div>
                <div class="settings-list">
                  <label class="settings-row"><span><strong>Email alerts</strong><small>Receive important account updates.</small></span><input class="form-check-input" type="checkbox" checked></label>
                  <label class="settings-row"><span><strong>Weekly reports</strong><small>Send summary reports every Monday.</small></span><input class="form-check-input" type="checkbox" checked></label>
                  <label class="settings-row"><span><strong>Two-factor authentication</strong><small>Require extra verification for admins.</small></span><input class="form-check-input" type="checkbox"></label>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Workspace settings page.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../khen/assets/js/main.js"></script>
</body>
</html>
