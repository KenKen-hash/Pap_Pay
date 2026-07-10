<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>Forms | adminHMD</title>

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
                <a class="nav-link active" href="{{ route('official_business') }}">
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

                <div class="container-fluid px-3 px-lg-4 py-4">

                    <h2 class="mb-4">

                        Official Business Management

                    </h2>

                    <div class="row mb-4">

                        <div class="col-md-3">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6>Pending</h6>

                                    <h2>{{ $pendingOB }}</h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6>Approved</h6>

                                    <h2>{{ $approvedOB }}</h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6>Rejected</h6>

                                    <h2>{{ $rejectedOB }}</h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6>Total</h6>

                                    <h2>{{ $totalOB }}</h2>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card shadow-sm">


                        <div class="card-body">

                            <form method="GET" class="mb-4">

                                <div class="row">

                                    <div class="col-md-5">

                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search employee or employee ID..."
                                            value="{{ request('search') }}">

                                    </div>

                                    <div class="col-md-3">

                                        <select name="status" class="form-select">

                                            <option value="">All Status</option>

                                            <option value="Pending"
                                                {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="Approved"
                                                {{ request('status') == 'Approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>

                                            <option value="Rejected"
                                                {{ request('status') == 'Rejected' ? 'selected' : '' }}>
                                                Rejected
                                            </option>

                                        </select>

                                    </div>

                                    <div class="col-md-2">

                                        <input type="date" name="date" class="form-control"
                                            value="{{ request('date') }}">

                                    </div>

                                    <div class="col-md-2">

                                        <button class="btn btn-primary w-100">

                                            Search

                                        </button>

                                    </div>

                                </div>

                            </form>

                            <div class="table-responsive">

                                <table class="table table-hover align-middle">

                                    <thead>

                                        <tr>

                                            <th>Employee</th>

                                            <th>Date</th>

                                            <th>Destination</th>

                                            <th>Time</th>

                                            <th>Status</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @forelse($officialBusinesses as $ob)
                                            <tr>

                                                <td>

                                                    <strong>{{ $ob->user->name }}</strong>

                                                    <br>

                                                    <small class="text-muted">

                                                        {{ $ob->user->employee_id }}

                                                    </small>

                                                </td>

                                                <td>

                                                    {{ $ob->ob_date->format('M d, Y') }}

                                                </td>

                                                <td>

                                                    {{ $ob->destination }}

                                                </td>

                                                <td>

                                                    {{ \Carbon\Carbon::parse($ob->departure_time)->format('h:i A') }}

                                                    -

                                                    {{ \Carbon\Carbon::parse($ob->expected_return_time)->format('h:i A') }}

                                                </td>

                                                <td>

                                                    @if ($ob->status == 'Pending')
                                                        <span class="badge bg-warning">

                                                            Pending

                                                        </span>
                                                    @elseif($ob->status == 'Approved')
                                                        <span class="badge bg-success">

                                                            Approved

                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">

                                                            Rejected

                                                        </span>
                                                    @endif

                                                </td>

                                                <td>

                                                    <button class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#obModal{{ $ob->id }}">

                                                        <i class="bi bi-eye"></i>
                                                        View

                                                    </button>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="6" class="text-center">

                                                    No Official Business Requests

                                                </td>

                                            </tr>
                                        @endforelse


                                    </tbody>

                                </table>

                            </div>

                            <div class="mt-3">

                                {{ $officialBusinesses->links() }}

                                @foreach($officialBusinesses as $ob)

                                  </div>

<div class="modal fade"
     id="obModal{{ $ob->id }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Official Business Details
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>Employee</strong><br>
                        {{ $ob->user->name }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Department</strong><br>
                        {{ $ob->user->department }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Date</strong><br>
                        {{ $ob->ob_date->format('F d, Y') }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Destination</strong><br>
                        {{ $ob->destination }}
                    </div>

                    <div class="col-12 mb-3">
                        <strong>Purpose</strong><br>
                        {{ $ob->purpose }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Departure</strong><br>
                        {{ \Carbon\Carbon::parse($ob->departure_time)->format('h:i A') }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Expected Return</strong><br>
                        {{ \Carbon\Carbon::parse($ob->expected_return_time)->format('h:i A') }}
                    </div>

                    <div class="col-12 mb-3">

                        <strong>Proof Images</strong>

                        <div class="row mt-2">

                            @if($ob->proof_images)

                                @foreach($ob->proof_images as $image)

                                    <div class="col-md-3 mb-3">

                                        <img
                                            src="{{ asset('storage/'.$image) }}"
                                            class="img-fluid rounded border">

                                    </div>

                                @endforeach

                            @else

                                <p class="text-muted">
                                    No proof uploaded.
                                </p>

                            @endif

                      

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                @if($ob->status=='Pending')

                    <form
                        action="{{ route('official_business.approve',$ob->id) }}"
                        method="POST">

                        @csrf

                        <button class="btn btn-success">
                            Approve
                        </button>

                    </form>

                    <form
                        action="{{ route('official_business.reject',$ob->id) }}"
                        method="POST">

                        @csrf

                        <button class="btn btn-danger">
                            Reject
                        </button>

                    </form>

                @else

                    <span class="badge bg-secondary fs-6">

                        {{ $ob->status }}

                    </span>

                @endif

            </div>

        </div>

    </div>

</div>

@endforeach

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
                    <span>Form component examples.</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>
</body>

</html>
