<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Employee Dashboard - School Management System">
  <title>Dashboard | Employee Portal</title>

  <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
  
  <style>
    /* Hero Section */
    .hero-banner {
      position: relative;
      border-radius: 1rem;
      overflow: hidden;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    }
    
    .hero-banner img {
      width: 100%;
      height: 280px;
      object-fit: cover;
      filter: brightness(0.7);
    }
    
    .hero-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 2rem;
      background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 100%);
      color: #fff;
    }
    
    .hero-overlay h2 {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .hero-overlay p {
      font-size: 1rem;
      opacity: 0.9;
      margin-bottom: 0;
      max-width: 600px;
    }
    
    /* Quick Action Cards */
    .quick-action {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 2rem 1.5rem;
      background: #fff;
      border-radius: 1rem;
      text-decoration: none;
      color: inherit;
      transition: all 0.25s ease;
      border: 1px solid rgba(0,0,0,0.08);
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
      height: 100%;
    }
    
    .quick-action:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
      border-color: transparent;
    }
    
    .quick-action-icon {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.75rem;
      margin-bottom: 1rem;
    }
    
    .quick-action-icon.leave {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
    }
    
    .quick-action-icon.payslip {
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
      color: #fff;
    }
    
    .quick-action-icon.attendance {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      color: #fff;
    }
    
    .quick-action h5 {
      font-weight: 600;
      margin-bottom: 0.25rem;
    }
    
    .quick-action p {
      font-size: 0.875rem;
      color: #6c757d;
      margin: 0;
    }
    
    /* Salary Panel */
    .salary-panel {
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
      border-radius: 1rem;
      padding: 1.75rem;
      color: #fff;
      height: 100%;
    }
    
    .salary-panel .panel-label {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      opacity: 0.7;
      margin-bottom: 0.25rem;
    }
    
    .salary-panel .panel-title {
      font-size: 1.125rem;
      font-weight: 600;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .salary-amount {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      letter-spacing: -0.02em;
    }
    
    .salary-period {
      font-size: 0.875rem;
      opacity: 0.7;
      margin-bottom: 1.5rem;
    }
    
    .salary-breakdown {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      padding-top: 1rem;
      border-top: 1px solid rgba(255,255,255,0.15);
    }
    
    .salary-item {
      display: flex;
      justify-content: space-between;
      font-size: 0.9rem;
    }
    
    .salary-item span:first-child {
      opacity: 0.8;
    }
    
    .salary-item span:last-child {
      font-weight: 600;
    }
    
    .salary-item.deduction span:last-child {
      color: #f87171;
    }
    
    .salary-item.addition span:last-child {
      color: #4ade80;
    }
    
    /* Welcome Card */
    .welcome-card {
      background: #fff;
      border-radius: 1rem;
      padding: 1.5rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
      border: 1px solid rgba(0,0,0,0.08);
    }
    
    .welcome-card .avatar-lg {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #e9ecef;
    }
    
    .welcome-card h4 {
      margin: 0 0 0.25rem 0;
      font-weight: 600;
    }
    
    .welcome-card p {
      margin: 0;
      color: #6c757d;
      font-size: 0.9rem;
    }
    
    .welcome-card .badge {
      font-size: 0.75rem;
      font-weight: 500;
    }
    
    /* Info Cards */
    .info-card {
      background: #fff;
      border-radius: 1rem;
      padding: 1.25rem;
      border: 1px solid rgba(0,0,0,0.08);
      height: 100%;
    }
    
    .info-card .info-icon {
      width: 40px;
      height: 40px;
      border-radius: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      margin-bottom: 0.75rem;
    }
    
    .info-card h6 {
      font-size: 0.8rem;
      color: #6c757d;
      margin-bottom: 0.25rem;
      font-weight: 500;
    }
    
    .info-card .info-value {
      font-size: 1.25rem;
      font-weight: 700;
      margin-bottom: 0;
    }
    
    /* Section Headers */
    .section-header {
      margin-bottom: 1rem;
    }
    
    .section-header h3 {
      font-size: 1.125rem;
      font-weight: 600;
      margin: 0;
    }
    
    .section-header p {
      font-size: 0.875rem;
      color: #6c757d;
      margin: 0.25rem 0 0 0;
    }

    
  </style>
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="{{ route ('dashboard') }}" aria-label="Employee Portal dashboard">
          <span class="brand-icon"><i class="bi bi-mortarboard-fill" aria-hidden="true"></i></span>
          <span class="brand-copy">
            <span class="brand-title">Employee Portal</span>
            <span class="brand-subtitle">School Management</span>
          </span>
        </a>
      </div>

      <nav class="sidebar-nav">
        <a class="nav-link active" href="{{ route ('dashboard') }}" aria-current="page">
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
        <a class="nav-link" href="{{ route ('payslip') }}">
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
        <span class="sidebar-footer-text">System Online</span>
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

          <form class="d-none d-md-flex ms-3 flex-grow-1"
      action="{{ route('search') }}"
      method="GET">

    <input class="form-control search-input"
           type="search"
           name="search"
           placeholder="Search attendance, leave, payroll..."
           required>

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
        <div class="container-fluid px-3 px-lg-4 py-4">
          
          <!-- Welcome Card -->
          <div class="welcome-card">
            <img class="avatar-lg" src="{{ $employee->photo
    ? asset('storage/'.$employee->photo)
    : asset('images/default-avatar.png')
}}" alt="{{ $employee->name ?? 'Employee' }}">
            <div class="flex-grow-1">
              <h4>Welcome back,{{ $employee->name }}!</h4>
              <p>{{ $employee->position ?? 'Staff' }} • {{ $employee->department ?? 'Department' }}</p>
            </div>
            <div class="d-none d-md-block text-end">
              <span class="badge text-bg-success">Active</span>
              <p class="mb-0 mt-2 text-muted small">Employee ID: {{ $employee->employee_id ?? 'EMP-0000' }}</p>
            </div>
          </div>

          <!-- Hero Banner with School Image -->
          <div class="hero-banner">
            <img src="../../../../khen/assets/images/image.png" alt="School Campus">
            <div class="hero-overlay">
              <h2><i class="bi bi-mortarboard me-2"></i>Pap Pay Payroll Management System</h2>
              <p>Your centralized portal for managing attendance, leave requests, payroll information, and official business records. Access all your employment essentials in one secure platform.</p>
            </div>
          </div>

          <!-- Quick Stats Row -->
          <section class="row g-3 mb-4" aria-label="Quick stats">
            <div class="col-6 col-lg-3">
              <div class="info-card">
                <div class="info-icon bg-primary bg-opacity-10 text-primary">
                  <i class="bi bi-calendar-check"></i>
                </div>
                <h6>Days Present (This Month)</h6>
                <p class="info-value">{{ $presentDays ?? 0 }}</p>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="info-card">
                <div class="info-icon bg-warning bg-opacity-10 text-warning">
                  <i class="bi bi-calendar-minus"></i>
                </div>
                <h6>Leave Balance</h6>
                <p class="info-value">{{ $leaveBalance ?? 0 }}days</p>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="info-card">
                <div class="info-icon bg-success bg-opacity-10 text-success">
                  <i class="bi bi-clock-history"></i>
                </div>
                <h6>Pending Requests</h6>
                <p class="info-value">{{ $pendingRequests ?? 0 }}</p>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="info-card">
                <div class="info-icon bg-info bg-opacity-10 text-info">
                  <i class="bi bi-briefcase"></i>
                </div>
                <h6>OB Records</h6>
                <p class="info-value">{{ $obCount ?? 0 }}</p>
              </div>
            </div>
          </section>

          <!-- Main Content Grid -->
          <section class="row g-4">
            
            <!-- Quick Actions -->
            <div class="col-12 col-lg-8">
              <div class="section-header">
                <h3><i class="bi bi-lightning-charge text-warning me-2"></i>Quick Actions</h3>
                <p>Access frequently used features</p>
              </div>
              
              <div class="row g-3">
                <div class="col-12 col-sm-4">
                  <a href="{{ route ('file_leave') }}" class="quick-action">
                    <div class="quick-action-icon leave">
                      <i class="bi bi-calendar-plus"></i>
                    </div>
                    <h5>File Leave</h5>
                    <p>Submit leave request</p>
                  </a>
                </div>
                <div class="col-12 col-sm-4">
                  <a href="{{ route ('payslip') }}" class="quick-action">
                    <div class="quick-action-icon payslip">
                      <i class="bi bi-receipt"></i>
                    </div>
                    <h5>View Payslip</h5>
                    <p>Download pay stubs</p>
                  </a>
                </div>
                <div class="col-12 col-sm-4">
                  <a href="{{ route ('attendance') }}" class="quick-action">
                    <div class="quick-action-icon attendance">
                      <i class="bi bi-calendar-check"></i>
                    </div>
                    <h5>Attendance</h5>
                    <p>View attendance log</p>
                  </a>
                </div>
              </div>

              <!-- Additional Quick Links -->
              <div class="row g-3 mt-2">
                <div class="col-6 col-sm-3">
                  <a href="{{ route ('file_ob') }}" class="quick-action py-3">
                    <i class="bi bi-briefcase fs-4 text-secondary mb-2"></i>
                    <h6 class="mb-0">File OB</h6>
                  </a>
                </div>
                <div class="col-6 col-sm-3">
                  <a href="{{ route ('my_profile') }}" class="quick-action py-3">
                    <i class="bi bi-person fs-4 text-secondary mb-2"></i>
                    <h6 class="mb-0">My Profile</h6>
                  </a>
                </div>               
              </div>
            </div>

            <!-- Latest Salary Panel -->
            <div class="col-12 col-lg-4">
              <div class="section-header">
                <h3><i class="bi bi-wallet2 text-success me-2"></i>Latest Salary</h3>
                <p>Most recent payroll information</p>
              </div>
              
              <div class="salary-panel">
                <div class="panel-label">Net Pay</div>
                <div class="salary-amount">
    ₱{{ number_format($latestSalary->net_pay ?? 0, 2) }}
</div>

<div class="salary-period">
    <i class="bi bi-calendar3 me-1"></i>
    {{ $latestSalary->pay_period ?? 'No Payslip Available' }}
</div>
                
                <div class="salary-breakdown">
                  <div class="salary-item addition">
                    <span>Basic Salary</span>
                    <span>₱{{ number_format($latestSalary?->basic_pay ?? 0, 2) }}</span>
                  </div>
                  <div class="salary-item addition">
                    <span>Allowances</span>
                    <span>+₱{{ number_format($latestSalary?->allowances ?? 0, 2) }}</span>
                  </div>
                  <div class="salary-item deduction">
    <span>Tax</span>
    <span>-₱{{ number_format($latestSalary->tax ?? 0, 2) }}</span>
</div>

<div class="salary-item deduction">
    <span>SSS/PhilHealth/Pag-IBIG</span>
    <span>-₱{{ number_format(
        ($latestSalary->sss ?? 0) +
        ($latestSalary->philhealth ?? 0) +
        ($latestSalary->pagibig ?? 0)
    , 2) }}</span>
</div>
                
                <a href="{{ route ('payslip') }}" class="btn btn-light btn-sm w-100 mt-3">
                  <i class="bi bi-download me-1"></i> View Full Payslip
                </a>
              </div>
            </div>
          </section>

          <!-- Recent Activity Section -->
          <section class="row g-4 mt-2">
            <div class="col-12 col-lg-6">
              <div class="panel h-100">
                <div class="panel-header">
                  <div>
                    <h2 class="h5 mb-1 section-title">
                      <i class="bi bi-clock-history" aria-hidden="true"></i>
                      <span>Recent Attendance</span>
                    </h2>
                    <p class="text-muted mb-0">Your attendance for the past week</p>
                  </div>
                  <a class="btn btn-light btn-sm" href="{{ route ('attendance') }}">View All</a>
                </div>

                <div class="table-responsive">
                  <table class="table table-sm align-middle mb-0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($recentAttendance as $record)
                      <tr>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->time_in }}</td>
                        <td>{{ $record->time_out }}</td>
                        <td><span class="badge
@if($record->status == 'Present') text-bg-success
@elseif($record->status == 'Late') text-bg-warning
@else text-bg-danger
@endif">{{ $record->status }}</span></td>
                      </tr>
                      @empty
                      <tr>
                        <td>Jun 23, 2026</td>
                        <td>7:45 AM</td>
                        <td>5:02 PM</td>
                        <td><span class="badge text-bg-success">Present</span></td>
                      </tr>
                      <tr>
                        <td>Jun 22, 2026</td>
                        <td>7:52 AM</td>
                        <td>5:15 PM</td>
                        <td><span class="badge text-bg-success">Present</span></td>
                      </tr>
                      <tr>
                        <td>Jun 21, 2026</td>
                        <td>8:05 AM</td>
                        <td>5:00 PM</td>
                        <td><span class="badge text-bg-warning">Late</span></td>
                      </tr>
                      <tr>
                        <td>Jun 20, 2026</td>
                        <td>7:38 AM</td>
                        <td>5:10 PM</td>
                        <td><span class="badge text-bg-success">Present</span></td>
                      </tr>
                      <tr>
                        <td>Jun 19, 2026</td>
                        <td>—</td>
                        <td>—</td>
                        <td><span class="badge text-bg-secondary">Weekend</span></td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="panel h-100">
                <div class="panel-header">
                  <div>
                    <h2 class="h5 mb-1 section-title">
                      <i class="bi bi-bell" aria-hidden="true"></i>
                      <span>Announcements</span>
                    </h2>
                    <p class="text-muted mb-0">Latest updates from HR</p>
                  </div>
                </div>

                <div class="activity-list">
                  @forelse($announcements ?? [] as $announcement)
                  <div class="activity-item">
                    <span class="activity-dot bg-{{ $announcement->color }}"></span>
                    <div>
                      <p class="mb-1 fw-semibold">{{ $announcement->title }}</p>
                      <p class="text-muted small mb-0">{{ $announcement->description }}</p>
                    </div>
                  </div>
                  @empty
                  <div class="activity-item">
                    <span class="activity-dot bg-primary"></span>
                    <div>
                      <p class="mb-1 fw-semibold">Payroll Schedule Update</p>
                      <p class="text-muted small mb-0">June payroll will be released on the 25th.</p>
                    </div>
                  </div>
                  <div class="activity-item">
                    <span class="activity-dot bg-success"></span>
                    <div>
                      <p class="mb-1 fw-semibold">Faculty Meeting</p>
                      <p class="text-muted small mb-0">Monthly faculty meeting scheduled for June 28.</p>
                    </div>
                  </div>
                  <div class="activity-item">
                    <span class="activity-dot bg-warning"></span>
                    <div>
                      <p class="mb-1 fw-semibold">Leave Filing Reminder</p>
                      <p class="text-muted small mb-0">Please file leaves at least 3 days in advance.</p>
                    </div>
                  </div>
                  <div class="activity-item">
                    <span class="activity-dot bg-info"></span>
                    <div>
                      <p class="mb-1 fw-semibold">System Maintenance</p>
                      <p class="text-muted small mb-0">Portal maintenance on Sunday, 2-4 AM.</p>
                    </div>
                  </div>
                  @endforelse
                </div>
              </div>
            </div>
          </section>

        </div>
      </main>

      <footer class="admin-footer">
    <div class="container-fluid px-3 px-lg-4">
        <span>
            © 2026 Pap Pay Payroll Management System <br>
            Developed by Pap Pay Capstone Team
        </span>

        <span>Version 1.0</span>
    </div>
</footer>
    </div>
  </div>

  <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../khen/assets/js/main.js"></script>
</body>
</html>
