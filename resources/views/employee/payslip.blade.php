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
                <a class="nav-link active" href="{{ route('payslip') }}" aria-current="page">
                    <span class="nav-icon"><i class="bi bi-receipt" aria-hidden="true"></i></span>
                    <span class="nav-text">Payslip</span>
                </a>
                <a class="nav-link" href="{{ route('employee.announcements') }}">
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

                <main class="dashboard-content">

                    <div class="container-fluid px-3 px-lg-4 py-4">

                        <!-- PAGE HEADER -->
                        <div class="page-heading">

                            <div class="page-heading-copy">

                                    <div>

                                    <p class="eyebrow mb-1">Employee Payroll</p>

                                    <h1 class="h3 mb-1">My Payslips</h1>

                                    <p class="text-muted mb-0">
                                        Download and review all payslips released by HR.
                                    </p>

                                </div>

                            </div>

                        </div>


                       


                        <!-- LATEST PAYSLIP HIGHLIGHT -->
                       <section class="panel mt-4">

    <div
        class="panel-body d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

        <div>

            <h5 class="mb-1">
                Latest Payslip
            </h5>

            <p class="text-muted mb-0">
                Your most recent payroll record is ready for download.
            </p>

        </div>

        <div class="d-flex flex-column flex-sm-row gap-2">

            @if ($payslips->first())

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

            <!-- Appeal / Concern Button -->
            <button type="button"
                class="btn btn-outline-danger"
                data-bs-toggle="modal"
                data-bs-target="#payslipConcernModal">

                <i class="bi bi-exclamation-circle me-1"></i>
                Appeal / Report Concern

            </button>

        </div>

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
                                                    {{ $p->period_start->format('M d, Y') }}
                                                    -
                                                    {{ $p->period_end->format('M d, Y') }}
                                                </td>

                                                <td>
                                                    ₱ {{ number_format($p->gross_salary, 2) }}
                                                </td>

                                                <td>
                                                    ₱
                                                    {{ number_format(
                                                        $p->sss + $p->philhealth + $p->pagibig + $p->hmo + $p->late_deduction + $p->undertime_deduction,
                                                        2,
                                                    ) }}
                                                </td>

                                                <td class="fw-bold">
                                                    ₱ {{ number_format($p->net_salary, 2) }}
                                                </td>

                                                <td>

                                                    @if ($p->status == 'Generated')
                                                        <span class="badge bg-warning">Generated</span>
                                                    @elseif ($p->status == 'Sent')
                                                        <span class="badge bg-success">Sent</span>
                                                    @elseif ($p->status == 'Viewed')
                                                        <span class="badge bg-info">Viewed</span>
                                                    @endif

                                                </td>

                                                <td>

                                                    @if (in_array($p->status, ['Generated', 'Sent', 'Viewed']))
                                                        <a href="{{ route('payslip.download', $p->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-download"></i> Download
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

    <!-- PAYSLIP CONCERN MODAL -->
<div class="modal fade" id="payslipConcernModal" tabindex="-1"
    aria-labelledby="payslipConcernModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div>
                    <h5 class="modal-title" id="payslipConcernModalLabel">
                        Appeal / Report Payslip Concern
                    </h5>

                    <small class="text-muted">
                        Please provide the details of your concern.
                    </small>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <form method="POST"
                action="{{ route('payslip.concern.store') }}"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <!-- Payslip -->
                    <div class="mb-3">

                        <label for="payslip_id" class="form-label fw-semibold">
                            Payslip
                        </label>

                        <select name="payslip_id"
                            id="payslip_id"
                            class="form-select"
                            required>

                            <option value="">
                                Select the payslip you have a concern about
                            </option>

                            @foreach ($payslips as $p)
                                <option value="{{ $p->id }}">

                                    {{ $p->period_start->format('M d, Y') }}
                                    -
                                    {{ $p->period_end->format('M d, Y') }}

                                    — ₱{{ number_format($p->net_salary, 2) }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    <!-- Reason -->
                    <div class="mb-3">

                        <label for="reason" class="form-label fw-semibold">
                            Reason / Concern
                        </label>

                        <textarea name="reason"
                            id="reason"
                            class="form-control"
                            rows="5"
                            placeholder="Please explain your concern about this payslip..."
                            maxlength="2000"
                            required></textarea>

                        <div class="form-text">
                            Please provide enough information for HR to investigate your concern.
                        </div>

                    </div>


                    <!-- Attachment -->
                    <div class="mb-3">

                        <label for="attachment" class="form-label fw-semibold">
                            Upload Payslip / Supporting Document
                        </label>

                        <input type="file"
                            name="attachment"
                            id="attachment"
                            class="form-control"
                            accept=".pdf,.jpg,.jpeg,.png">

                        <div class="form-text">
                            Optional. PDF, JPG, or PNG only. Maximum 5MB.
                        </div>

                    </div>


                    <!-- Notice -->
                    <div class="alert alert-warning mb-0">

                        <i class="bi bi-info-circle me-1"></i>

                        Your concern will be sent to HR/Admin for review.
                        Please make sure the information you provide is accurate.

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                        class="btn btn-danger">

                        <i class="bi bi-send me-1"></i>
                        Submit Concern

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

    <script src="../../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../../khen/assets/js/main.js"></script>
</body>

</html>
