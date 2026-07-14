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

    <style>

        .announcement-card{

transition:.3s;

}

.announcement-card:hover{

transform:translateY(-4px);

box-shadow:0 12px 25px rgba(0,0,0,.12)!important;

}
    </style>
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
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <span class="nav-icon"><i class="bi bi-house-door" aria-hidden="true"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a class="nav-link" href="{{ route('attendance') }}">
                    <span class="nav-icon"><i class="bi bi-calendar-check" aria-hidden="true"></i></span>
                    <span class="nav-text">Attendance</span>
                </a>
                <a class="nav-link" href="{{ route('file_leave') }}">
                    <span class="nav-icon"><i class="bi bi-calendar-plus" aria-hidden="true"></i></span>
                    <span class="nav-text">File Leave</span>
                </a>
                <a class="nav-link" href="{{ route('file_ob') }}">
                    <span class="nav-icon"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
                    <span class="nav-text">File OB</span>
                </a>
                <a class="nav-link" href="{{ route('payslip') }}">
                    <span class="nav-icon"><i class="bi bi-receipt" aria-hidden="true"></i></span>
                    <span class="nav-text">Payslip</span>
                </a>
                <a class="nav-link active" href="{{ route('employee.announcements') }}" aria-current="page">
                    <span class="nav-icon">
                        <i class="bi bi-megaphone" aria-hidden="true"></i>
                    </span>
                    <span class="nav-text">Announcements</span>
                </a>
                <a class="nav-link" href="{{ route('my_profile') }}">
                    <span class="nav-icon"><i class="bi bi-person" aria-hidden="true"></i></span>
                    <span class="nav-text">My Profile</span>
                </a>
            </nav>

            <div class="sidebar-user">
                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                    alt="{{ $employee->name ?? 'Employee' }}">
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
                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="avatar-img avatar-sm"
                                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                                    alt="{{ $employee->name ?? 'Employee' }}">
                                <span
                                    class="profile-name d-none d-sm-inline">{{ $employee->name ?? 'Employee' }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('my_profile') }}">My Profile</a></li>

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

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="mb-4">

        <h2 class="fw-bold d-flex align-items-center">

            <i class="bi bi-megaphone-fill text-primary me-3 ms-2"></i>

            Announcements

        </h2>

        <p class="text-muted">

            Stay updated with the latest announcements from the administrator.

        </p>

    </div>

    <div class="row mb-4">

    <div class="col-lg-6">

        <div class="input-group shadow-sm">

            <span class="input-group-text bg-white">

                <i class="bi bi-search"></i>

            </span>

            <input
                type="text"
                id="announcementSearch"
                class="form-control"
                placeholder="Search announcements...">

        </div>

    </div>

</div>

<div class="row">

    <div class="col-12">

        @forelse($announcements as $announcement)

        <div class="card shadow-sm border-0 rounded-4 mb-4 announcement-card">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h4 class="fw-bold">

                            <i class="bi bi-megaphone-fill text-primary"></i>

                            {{ $announcement->title }}

                        </h4>

                        <small class="text-muted">

                            Administrator

                            •

                            {{ $announcement->created_at->diffForHumans() }}

                        </small>

                    </div>

                    <span class="badge bg-primary">

                        Announcement

                    </span>

                </div>

                <hr>

                <p class="mt-3">

                    {{ $announcement->message }}

                </p>

                @if($announcement->attachment)

                <a
                    href="{{ asset('storage/'.$announcement->attachment) }}"
                    target="_blank"
                    class="btn btn-outline-primary btn-sm">

                    <i class="bi bi-paperclip"></i>

                    View Attachment

                </a>

                @endif

            </div>

        </div>

        @empty

        <div class="card shadow-sm rounded-4 border-0">

            <div class="card-body text-center py-5">

                <i class="bi bi-megaphone display-2 text-secondary"></i>

                <h4 class="mt-4">

                    No Announcements

                </h4>

                <p class="text-muted">

                    There are no announcements from the administrator.

                </p>

            </div>

        </div>

        @endforelse

    </div>

</div>
</main>



                <footer class="admin-footer">
                    <div class="container-fluid px-3 px-lg-4">
                        <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank"
                                class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan
                                Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success"
                                href="https://themewagon.com">ThemeWagon</a> </span>
                        <span>Professional dashboard template.</span>
                        <span>Responsive table examples.</span>
                    </div>
                </footer>
        </div>
    </div>

    <script src="../../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../../khen/assets/js/main.js"></script>

    <script>

const search=document.getElementById('announcementSearch');

search.addEventListener('keyup',function(){

let value=this.value.toLowerCase();

document.querySelectorAll('.announcement-card').forEach(function(card){

card.style.display=card.innerText.toLowerCase().includes(value)

?

''

:

'none';

});

});

</script>
</body>

</html>
