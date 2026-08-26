@php
    $admin = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payslip Concerns</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../../khen/assets/css/style.css">
</head>

<body>

<div class="admin-shell">

    <div class="sidebar-backdrop" data-sidebar-close></div>

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar" id="adminSidebar">

       <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('admin-dashboard') }}" aria-label="Admin Dashboard">
                    <img src="../../../khen/assets/images/logo.jpg" alt="Pap Pay Logo" class="brand-logo">
                </a>
            </div>


         <nav class="sidebar-nav">
                <a class="nav-link" href="{{ route('admin-dashboard') }}">
                    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
                    <span class="nav-text">Home</span>
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

                <a class="nav-link" href="{{ route('holidays.index') }}">
                    <span class="nav-icon"><i class="bi bi-gear"></i></span>
                    <span class="nav-text">Holidays</span>
                </a>
                <a class="nav-link" href="{{ route('payroll') }}">
                    <span class="nav-icon"><i class="bi bi-cash-stack"></i></span>
                    <span class="nav-text">Payroll</span>
                </a>

                <a class="nav-link" href="{{ route('payslip_list') }}">
                    <span class="nav-icon"><i class="bi bi-receipt"></i></span>
                    <span class="nav-text">Payslips</span>
                </a>
                <a class="nav-link active" href="{{ route('admin.payslip-concerns.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-exclamation-circle"></i>
                    </span>

                    <span class="nav-text">
                        Payslip Concerns
                    </span>

                </a>

                <a class="nav-link" href="{{ route('reports') }}">
                    <span class="nav-icon"><i class="bi bi-bar-chart"></i></span>
                    <span class="nav-text">Reports</span>
                </a>

                <a class="nav-link" href="{{ route('announcements') }}">
                    <span class="nav-icon"><i class="bi bi-megaphone"></i></span>
                    <span class="nav-text">Announcements</span>
                </a>


            </nav>

        <div class="sidebar-user">

            <img
                class="avatar-img avatar-md sidebar-user-avatar"
                src="{{ $admin->photo
                    ? asset('storage/' . $admin->photo)
                    : asset('images/default-avatar.png') }}"
                alt="{{ $admin->name }}"
            >

            <strong>{{ $admin->name }}</strong>

            <small>Administrator</small>

        </div>

        <div class="sidebar-footer">

            <span class="status-dot"></span>

            <span class="sidebar-footer-text">
                System running smoothly
            </span>

        </div>

    </aside>


    {{-- MAIN --}}
    <div class="admin-main">

        {{-- NAVBAR --}}
        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">

                <button
                    class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="true"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="navbar-actions ms-auto">

                    <div class="dropdown">

                        <button
                            class="profile-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                        >

                            <img
                                class="avatar-img avatar-sm"
                                src="{{ $admin->photo
                                    ? asset('storage/' . $admin->photo)
                                    : asset('images/default-avatar.png') }}"
                                alt="{{ $admin->name }}"
                            >

                            <span class="profile-name d-none d-sm-inline">
                                {{ $admin->name }}
                            </span>

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('my_profile') }}"
                                >
                                    My Profile
                                </a>
                            </li>

                            <li>

                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item"
                                    >
                                        Sign out
                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </nav>


        {{-- CONTENT --}}
        <main class="dashboard-content">

            <div class="container-fluid px-3 px-lg-4 py-4">

                {{-- HEADER --}}
                <div class="page-heading">

                    <div class="page-heading-copy">

                        <span class="page-icon">
                            <i class="bi bi-exclamation-circle"></i>
                        </span>

                        <div>

                            <p class="eyebrow mb-1">
                                Payroll Management
                            </p>

                            <h1 class="h3 mb-1">
                                Payslip Concerns
                            </h1>

                            <p class="text-muted mb-0">
                                Review employee concerns and correct payroll errors.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show mt-4">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                @endif


                {{-- ERROR MESSAGE --}}
                @if(session('error'))

                    <div class="alert alert-danger alert-dismissible fade show mt-4">

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        {{ session('error') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                @endif


                {{-- CONCERNS TABLE --}}
                <section class="panel mt-4">

                    <div class="panel-header">

                        <div>

                            <h2 class="h5 mb-1">
                                Employee Concerns
                            </h2>

                            <p class="text-muted mb-0">
                                Payslip concerns submitted by employees
                            </p>

                        </div>

                    </div>


                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>

                                <tr>

                                    <th>Employee</th>

                                    <th>Pay Period</th>

                                    <th>Reason</th>

                                    <th>Status</th>

                                    <th>Date Submitted</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($concerns as $concern)

                                    <tr>

                                        {{-- EMPLOYEE --}}
                                        <td>

                                            <div class="d-flex align-items-center gap-2">

                                                <img
                                                    src="{{ $concern->user->photo
                                                        ? asset('storage/' . $concern->user->photo)
                                                        : asset('images/default-avatar.png') }}"
                                                    width="40"
                                                    height="40"
                                                    class="rounded-circle"
                                                    style="object-fit:cover;"
                                                >

                                                <div>

                                                    <strong>
                                                        {{ $concern->user->name }}
                                                    </strong>

                                                    <small class="d-block text-muted">
                                                        {{ $concern->user->employee_id }}
                                                    </small>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- PAY PERIOD --}}
                                        <td>

                                            @if($concern->payslip)

                                                {{ $concern->payslip->period_start->format('M d, Y') }}

                                                <br>

                                                <small class="text-muted">
                                                    to
                                                </small>

                                                <br>

                                                {{ $concern->payslip->period_end->format('M d, Y') }}

                                            @else

                                                <span class="text-danger">
                                                    Payslip unavailable
                                                </span>

                                            @endif

                                        </td>


                                        {{-- REASON --}}
                                        <td>

                                            <span
                                                title="{{ $concern->reason }}"
                                            >

                                                {{ \Illuminate\Support\Str::limit(
                                                    $concern->reason,
                                                    60
                                                ) }}

                                            </span>

                                        </td>


                                        {{-- STATUS --}}
                                        <td>

                                            @if($concern->status === 'Pending')

                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>

                                            @elseif($concern->status === 'Reviewed')

                                                <span class="badge bg-info">
                                                    Reviewed
                                                </span>

                                            @elseif($concern->status === 'Resolved')

                                                <span class="badge bg-success">
                                                    Resolved
                                                </span>

                                            @elseif($concern->status === 'Rejected')

                                                <span class="badge bg-danger">
                                                    Rejected
                                                </span>

                                            @endif

                                        </td>


                                        {{-- DATE --}}
                                        <td>

                                            {{ $concern->created_at->format('M d, Y') }}

                                            <small class="d-block text-muted">
                                                {{ $concern->created_at->format('h:i A') }}
                                            </small>

                                        </td>


                                        {{-- ACTION --}}
                                        <td>

                                            <a
                                                href="{{ route(
                                                    'admin.payslip-concerns.show',
                                                    $concern->id
                                                ) }}"
                                                class="btn btn-sm btn-outline-primary"
                                            >

                                                <i class="bi bi-eye me-1"></i>

                                                View

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="text-center py-5"
                                        >

                                            <i class="bi bi-inbox fs-1 text-muted"></i>

                                            <h5 class="mt-3">
                                                No Payslip Concerns
                                            </h5>

                                            <p class="text-muted mb-0">
                                                Employees have not submitted
                                                any payslip concerns yet.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- PAGINATION --}}
                    @if($concerns->hasPages())

                        <div class="p-3">

                            {{ $concerns->links() }}

                        </div>

                    @endif

                </section>

            </div>

        </main>


        <footer class="admin-footer">

            <div class="container-fluid px-3 px-lg-4">

                <span>
                    Copyright 2026 Pap Pay.
                </span>

                <span>
                    Payroll Management System.
                </span>

            </div>

        </footer>

    </div>

</div>


<script src="../../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../../../khen/assets/js/main.js"></script>

</body>
</html>
