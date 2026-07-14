<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Modals | adminHMD</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
</head>

<body>
    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('admin-dashboard') }}" aria-label="adminHMD dashboard">
                    <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
                    <span class="brand-copy">
                        <span class="brand-title">adminHMD</span>
                        <span class="brand-subtitle">Admin Template</span>
                    </span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <a class="nav-link " href="{{ route('admin-dashboard') }}">
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

                <a class="nav-link active" href="{{ route('announcements') }}">
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

                        <h2 class="fw-bold mb-1 d-flex align-items-center">
                            <i class="bi bi-megaphone-fill text-primary me-3 ms-3"></i>
                            <span>Announcements</span>
                        </h2>

                        <p class="text-muted mb-0">
                            Create announcements and notify every employee in real time.
                        </p>

                    </div>

                    <button class="btn btn-primary shadow-sm">

                        <i class="bi bi-plus-circle"></i>

                        New Announcement

                    </button>

                </div>

                <div class="row g-3 mb-4">

                    <div class="col-lg-3 col-md-6">

                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-body">

                                <small class="text-muted">
                                    Total Announcements
                                </small>

                                <h2 class="fw-bold mt-2">

                                    {{ $announcements->count() }}

                                </h2>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-body">

                                <small class="text-muted">

                                    Attachments

                                </small>

                                <h2 class="fw-bold mt-2">

                                    {{ $announcements->whereNotNull('attachment')->count() }}

                                </h2>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-body">

                                <small class="text-muted">

                                    Latest Post

                                </small>

                                <h6 class="mt-3">

                                    @if ($announcements->count())
                                        {{ $announcements->first()->created_at->diffForHumans() }}
                                    @else
                                        --
                                    @endif

                                </h6>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-body">

                                <small class="text-muted">

                                    This Month

                                </small>

                                <h2 class="fw-bold mt-2">

                                    {{ $announcements->where('created_at', '>=', now()->startOfMonth())->count() }}

                                </h2>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row g-4">

                    <div class="col-xl-5">

                        <!-- Create Form -->
                        <div class="card border-0 shadow rounded-4">

                            <div class="card-header bg-white">

                                <h5 class="fw-bold">

                                    <i class="bi bi-pencil-square text-primary"></i>

                                    Create Announcement

                                </h5>

                            </div>

                            <div class="card-body">

                                <form method="POST" action="{{ route('announcements.store') }}"
                                    enctype="multipart/form-data">

                                    @csrf

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Title

                                        </label>

                                        <input type="text" class="form-control" name="title" required>

                                    </div>

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Announcement

                                        </label>

                                        <textarea rows="6" class="form-control" name="message" required></textarea>

                                    </div>

                                    <div class="mb-4">

                                        <label class="form-label">

                                            Attachment

                                        </label>

                                        <input type="file" class="form-control" name="attachment">

                                    </div>

                                    <button class="btn btn-primary w-100">

                                        <i class="bi bi-send-fill"></i>

                                        Publish Announcement

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-7">

                        <!-- Announcement List -->

                        <div class="card border-0 shadow rounded-4">

                            <div class="card-header bg-white">

                                <h5 class="fw-bold">

                                    Recent Announcements

                                </h5>

                            </div>

                            <div class="card-body">

                                @forelse($announcements as $announcement)
                                    <div class="border rounded-4 p-3 mb-3">

                                        <div class="d-flex justify-content-between">

                                            <div>

                                                <h5 class="mb-1">

                                                    <i class="bi bi-megaphone-fill text-primary"></i>

                                                    {{ $announcement->title }}

                                                </h5>

                                                <small class="text-muted">

                                                    {{ $announcement->created_at->format('F d, Y • h:i A') }}

                                                </small>

                                            </div>

                                            <span class="badge bg-primary">

                                                Posted

                                            </span>

                                        </div>

                                        <hr>

                                        <p class="mb-3">

                                            {{ $announcement->message }}

                                        </p>

                                        @if ($announcement->attachment)
                                            <a href="{{ asset('storage/' . $announcement->attachment) }}"
                                                target="_blank" class="btn btn-outline-primary btn-sm">

                                                <i class="bi bi-paperclip"></i>

                                                View Attachment

                                            </a>
                                        @endif

                                    </div>

                                @empty

                                    <div class="text-center py-5">

                                        <i class="bi bi-megaphone display-3 text-secondary"></i>

                                        <h5 class="mt-3">

                                            No Announcements Yet

                                        </h5>

                                        <p class="text-muted">

                                            Publish your first announcement.

                                        </p>

                                    </div>
                                @endforelse

                            </div>

                        </div>

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
                    <span>Modal component examples.</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>
</body>

</html>
