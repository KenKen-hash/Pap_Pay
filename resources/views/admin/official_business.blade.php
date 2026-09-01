<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="adminHMD professional admin dashboard template">

    <title>Official Business | Pap Pay</title>

    <link rel="stylesheet"
        href="../../../../khen/assets/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet"
        href="../../../../khen/assets/css/style.css">

</head>

<body>

    <div class="admin-shell">

        <div class="sidebar-backdrop"
            data-sidebar-close>
        </div>


        <!-- =====================================================
             SIDEBAR
             ===================================================== -->

        <aside class="admin-sidebar"
            id="adminSidebar"
            aria-label="Main navigation">

            <div class="sidebar-header">

                <a class="brand-mark"
                    href="{{ route('admin-dashboard') }}"
                    aria-label="Admin Dashboard">

                    <img src="../../../khen/assets/images/logo.jpg"
                        alt="Pap Pay Logo"
                        class="brand-logo">

                </a>

            </div>


            <nav class="sidebar-nav">

                <a class="nav-link"
                    href="{{ route('admin-dashboard') }}">

                    <span class="nav-icon">
                        <i class="bi bi-speedometer2"></i>
                    </span>

                    <span class="nav-text">
                        Home
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('employees.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-people"></i>
                    </span>

                    <span class="nav-text">
                        Employees
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('attendance_list') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-check"></i>
                    </span>

                    <span class="nav-text">
                        Attendance
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('admin.leaves') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-x"></i>
                    </span>

                    <span class="nav-text">
                        Leave Requests
                    </span>

                </a>


                <a class="nav-link active"
                    href="{{ route('official_business') }}">

                    <span class="nav-icon">
                        <i class="bi bi-briefcase"></i>
                    </span>

                    <span class="nav-text">
                        Official Business (OB)
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('holidays.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-gear"></i>
                    </span>

                    <span class="nav-text">
                        Holidays
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('payroll') }}">

                    <span class="nav-icon">
                        <i class="bi bi-cash-stack"></i>
                    </span>

                    <span class="nav-text">
                        Payroll
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('payslip_list') }}">

                    <span class="nav-icon">
                        <i class="bi bi-receipt"></i>
                    </span>

                    <span class="nav-text">
                        Payslips
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('admin.payslip-concerns.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-exclamation-circle"></i>
                    </span>

                    <span class="nav-text">
                        Payslip Concerns
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('reports') }}">

                    <span class="nav-icon">
                        <i class="bi bi-bar-chart"></i>
                    </span>

                    <span class="nav-text">
                        Reports
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('announcements') }}">

                    <span class="nav-icon">
                        <i class="bi bi-megaphone"></i>
                    </span>

                    <span class="nav-text">
                        Announcements
                    </span>

                </a>

            </nav>


            <!-- SIDEBAR USER -->

            <div class="sidebar-user">

                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ Auth::user()->photo
                        ? asset('storage/' . Auth::user()->photo)
                        : asset('khen/assets/images/avatar/avatar.jpg') }}"
                    alt="{{ Auth::user()->name }}">

                <strong>
                    {{ Auth::user()->name }}
                </strong>

                <small>
                    {{ ucfirst(Auth::user()->role ?? 'Employee') }}
                </small>

            </div>


            <div class="sidebar-footer">

                <span class="status-dot"></span>

                <span class="sidebar-footer-text">
                    System running smoothly
                </span>

            </div>

        </aside>


        <!-- =====================================================
             MAIN
             ===================================================== -->

        <div class="admin-main">


            <!-- =================================================
                 NAVBAR
                 ================================================= -->

            <nav class="navbar admin-navbar navbar-expand bg-white">

                <div class="container-fluid px-3 px-lg-4">


                    <button class="sidebar-toggle"
                        type="button"
                        data-sidebar-toggle
                        aria-controls="adminSidebar"
                        aria-expanded="true"
                        aria-label="Toggle sidebar">

                        <span></span>
                        <span></span>
                        <span></span>

                    </button>


                    <form class="d-none d-md-flex ms-3 flex-grow-1"
                        role="search">

                        <input class="form-control search-input"
                            type="search"
                            placeholder="Search users, orders, reports"
                            aria-label="Search">

                    </form>


                    <div class="navbar-actions ms-auto">


                        <!-- THEME -->

                        <button class="icon-button theme-toggle"
                            type="button"
                            data-theme-toggle
                            aria-label="Switch color theme"
                            title="Switch color theme">

                            <i class="bi bi-moon-stars"
                                data-theme-icon
                                aria-hidden="true"></i>

                        </button>


                        <!-- NOTIFICATIONS -->

                        <div class="dropdown">

                            <button class="icon-button"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                aria-label="Notifications">

                                @if (($unreadNotifications ?? 0) > 0)

                                    <span class="notification-dot"></span>

                                @endif

                                <i class="bi bi-bell"
                                    aria-hidden="true"></i>

                            </button>


                            <div class="dropdown-menu dropdown-menu-end notification-menu">

                                <div class="dropdown-header fw-bold text-body">

                                    Notifications

                                </div>


                                @forelse($notifications ?? [] as $notification)

                                    <a class="dropdown-item {{ !$notification->is_read ? 'notification-unread' : '' }}"
                                        href="{{ route('admin.notifications.read', $notification->id) }}">

                                        <span class="notification-title">

                                            {{ $notification->title }}

                                        </span>


                                        <span class="notification-message">

                                            {{ $notification->message }}

                                        </span>


                                        <span class="notification-time">

                                            {{ $notification->created_at->diffForHumans() }}

                                        </span>

                                    </a>

                                @empty

                                    <div class="dropdown-item text-muted text-center py-3">

                                        <i class="bi bi-bell-slash"></i>

                                        <br>

                                        No notifications

                                    </div>

                                @endforelse


                                <div class="dropdown-divider"></div>


                                <a href="{{ route('admin.notifications') }}"
                                    class="dropdown-item text-center">

                                    View all notifications

                                </a>

                            </div>

                        </div>


                        <!-- PROFILE -->

                        <div class="dropdown">

                            <button class="profile-button dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
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
                                <li>

                                    <form method="POST" action="{{ route('logout') }}">

                                        @csrf

                                        <button type="submit" class="dropdown-item">

                                            Sign out

                                        </button>

                                    </form>

                                </li>


                            </ul>

                        </div>

                    </div>

                </div>

            </nav>


            <!-- =================================================
                 MAIN CONTENT
                 ================================================= -->

            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4 py-4">


                    <h2 class="mb-4">

                        Official Business Management

                    </h2>


                    <!-- =================================================
                         SUMMARY CARDS
                         ================================================= -->

                    <div class="row mb-4">


                        <div class="col-md-3">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6>
                                        Pending
                                    </h6>

                                    <h2>
                                        {{ $pendingOB }}
                                    </h2>

                                </div>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6>
                                        Approved
                                    </h6>

                                    <h2>
                                        {{ $approvedOB }}
                                    </h2>

                                </div>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6>
                                        Rejected
                                    </h6>

                                    <h2>
                                        {{ $rejectedOB }}
                                    </h2>

                                </div>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6>
                                        Total
                                    </h6>

                                    <h2>
                                        {{ $totalOB }}
                                    </h2>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         OFFICIAL BUSINESS TABLE
                         ================================================= -->

                    <div class="card shadow-sm">

                        <div class="card-body">


                            <!-- SEARCH -->

                            <form method="GET"
                                class="mb-4">

                                <div class="row">


                                    <div class="col-md-5">

                                        <input type="text"
                                            name="search"
                                            class="form-control"
                                            placeholder="Search employee or employee ID..."
                                            value="{{ request('search') }}">

                                    </div>


                                    <div class="col-md-3">

                                        <select name="status"
                                            class="form-select">

                                            <option value="">
                                                All Status
                                            </option>


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

                                        <input type="date"
                                            name="date"
                                            class="form-control"
                                            value="{{ request('date') }}">

                                    </div>


                                    <div class="col-md-2">

                                        <button class="btn btn-primary w-100">

                                            Search

                                        </button>

                                    </div>

                                </div>

                            </form>


                            <!-- TABLE -->

                            <div class="table-responsive">

                                <table class="table table-hover align-middle">

                                    <thead>

                                        <tr>

                                            <th>
                                                Employee
                                            </th>

                                            <th>
                                                Date
                                            </th>

                                            <th>
                                                Destination
                                            </th>

                                            <th>
                                                Time
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                            <th>
                                                Action
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @forelse($officialBusinesses as $ob)

                                            <tr>

                                                <td>

                                                    <strong>
                                                        {{ $ob->user->name }}
                                                    </strong>

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

                                                    @if($ob->departure_time && $ob->expected_return_time)

                                                        {{ \Carbon\Carbon::parse($ob->departure_time)->format('h:i A') }}

                                                        -

                                                        {{ \Carbon\Carbon::parse($ob->expected_return_time)->format('h:i A') }}

                                                    @else

                                                        <span class="text-muted">
                                                            Not specified
                                                        </span>

                                                    @endif

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

                                                <td colspan="6"
                                                    class="text-center">

                                                    No Official Business Requests

                                                </td>

                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>


                            <!-- PAGINATION -->

                            <div class="mt-3">

                                {{ $officialBusinesses->links() }}

                            </div>


                        </div>

                    </div>

                </div>

            </main>


            <!-- =====================================================
                 VIEW MODALS
                 ===================================================== -->

            @foreach($officialBusinesses as $ob)

                <div class="modal fade"
                    id="obModal{{ $ob->id }}"
                    tabindex="-1"
                    aria-labelledby="obModalLabel{{ $ob->id }}"
                    aria-hidden="true">

                    <div class="modal-dialog modal-lg modal-dialog-scrollable">

                        <div class="modal-content">


                            <!-- MODAL HEADER -->

                            <div class="modal-header">

                                <h5 class="modal-title"
                                    id="obModalLabel{{ $ob->id }}">

                                    Official Business Details

                                </h5>


                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">

                                </button>

                            </div>


                            <!-- MODAL BODY -->

                            <div class="modal-body">


                                <!-- EMPLOYEE -->

                                <div class="row">


                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Employee

                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->user->name }}

                                        </div>

                                    </div>


                                    <!-- EMPLOYEE ID -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Employee ID

                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->user->employee_id }}

                                        </div>

                                    </div>


                                    <!-- DEPARTMENT -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Department

                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->user->department ?? 'Not specified' }}

                                        </div>

                                    </div>


                                    <!-- STATUS -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Status

                                        </label>

                                        <div class="form-control bg-light">

                                            @if($ob->status === 'Pending')

                                                <span class="badge bg-warning text-dark">

                                                    Pending

                                                </span>

                                            @elseif($ob->status === 'Approved')

                                                <span class="badge bg-success">

                                                    Approved

                                                </span>

                                            @else

                                                <span class="badge bg-danger">

                                                    Rejected

                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         EMPLOYEE INPUT 1
                                         PURPOSE
                                         ================================================= -->

                                    <div class="col-12 mb-3">

                                        <label class="form-label fw-bold">

                                            Purpose

                                        </label>

                                        <div class="form-control bg-light"
                                            style="min-height: 80px; height: auto; white-space: pre-wrap;">

                                            {{ $ob->purpose }}

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         EMPLOYEE INPUT 2
                                         DESTINATION
                                         ================================================= -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Destination

                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->destination }}

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         EMPLOYEE INPUT 3
                                         DATE
                                         ================================================= -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Date

                                        </label>

                                        <div class="form-control bg-light">

                                            {{ $ob->ob_date
                                                ? \Carbon\Carbon::parse($ob->ob_date)->format('F d, Y')
                                                : 'Not specified' }}

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         EMPLOYEE INPUT 4
                                         MORNING TIME IN
                                         ================================================= -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Morning Time In

                                        </label>

                                        <div class="form-control bg-light">

                                            @if($ob->morning_time_in)

                                                {{ \Carbon\Carbon::parse($ob->morning_time_in)->format('h:i A') }}

                                            @else

                                                Not specified

                                            @endif

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         EMPLOYEE INPUT 5
                                         MORNING TIME OUT
                                         ================================================= -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Morning Time Out

                                        </label>

                                        <div class="form-control bg-light">

                                            @if($ob->morning_time_out)

                                                {{ \Carbon\Carbon::parse($ob->morning_time_out)->format('h:i A') }}

                                            @else

                                                Not specified

                                            @endif

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         EMPLOYEE INPUT 6
                                         AFTERNOON TIME IN
                                         ================================================= -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Afternoon Time In

                                        </label>

                                        <div class="form-control bg-light">

                                            @if($ob->afternoon_time_in)

                                                {{ \Carbon\Carbon::parse($ob->afternoon_time_in)->format('h:i A') }}

                                            @else

                                                Not specified

                                            @endif

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         EMPLOYEE INPUT 7
                                         AFTERNOON TIME OUT
                                         ================================================= -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-bold">

                                            Afternoon Time Out

                                        </label>

                                        <div class="form-control bg-light">

                                            @if($ob->afternoon_time_out)

                                                {{ \Carbon\Carbon::parse($ob->afternoon_time_out)->format('h:i A') }}

                                            @else

                                                Not specified

                                            @endif

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         EMPLOYEE INPUT 8
                                         ATTACHMENT / PROOF IMAGES
                                         ================================================= -->

                                    <div class="col-12 mb-3">

                                        <label class="form-label fw-bold">

                                            Attachment / Proof Images

                                        </label>


                                        @if($ob->proof_images)

                                            <div class="row g-3 mt-1">

                                                @foreach($ob->proof_images as $image)

                                                    <div class="col-6 col-md-4">

                                                        <a href="{{ asset('storage/' . $image) }}"
                                                            target="_blank">

                                                            <img src="{{ asset('storage/' . $image) }}"
                                                                class="img-fluid rounded border"
                                                                alt="OB Proof Image">

                                                        </a>

                                                    </div>

                                                @endforeach

                                            </div>

                                        @else

                                            <div class="form-control bg-light">

                                                No proof uploaded.

                                            </div>

                                        @endif

                                    </div>


                                </div>

                            </div>


                            <!-- MODAL FOOTER -->

                            <div class="modal-footer">


                                @if($ob->status == 'Pending')


                                    <!-- APPROVE -->

                                    <form action="{{ route('official_business.approve', $ob->id) }}"
                                        method="POST">

                                        @csrf

                                        <button type="submit"
                                            class="btn btn-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Approve

                                        </button>

                                    </form>


                                    <!-- REJECT -->

                                    <form action="{{ route('official_business.reject', $ob->id) }}"
                                        method="POST">

                                        @csrf

                                        <button type="submit"
                                            class="btn btn-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Reject

                                        </button>

                                    </form>


                                @else

                                    <span class="badge bg-secondary fs-6">

                                        {{ $ob->status }}

                                    </span>

                                @endif


                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">

                                    Close

                                </button>

                            </div>


                        </div>

                    </div>

                </div>

            @endforeach


            <!-- =================================================
                 FOOTER
                 ================================================= -->

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">

                </div>

            </footer>

        </div>

    </div>


    <!-- =========================================================
         JAVASCRIPT
         ========================================================= -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

    <script src="../../../../khen/assets/js/main.js"></script>

</body>

</html>
