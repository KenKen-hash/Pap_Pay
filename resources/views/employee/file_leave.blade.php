@php $employee = Auth::user(); @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD professional admin dashboard template">
    <title>File Leave</title>
    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
</head>

<body>
    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>
        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <div class="sidebar-header"> <a class="brand-mark" href="{{ route('dashboard') }}"
                    aria-label="adminHMD dashboard"> <span class="brand-icon"><i class="bi bi-grid-1x2-fill"
                            aria-hidden="true"></i></span> <span class="brand-copy"> <span
                            class="brand-title">adminHMD</span> <span class="brand-subtitle">Admin Template</span>
                    </span> </a> </div>
            <nav class="sidebar-nav"> <a class="nav-link" href="{{ route('dashboard') }}"> <span class="nav-icon"><i
                            class="bi bi-house-door" aria-hidden="true"></i></span> <span
                        class="nav-text">Dashboard</span> </a> <a class="nav-link" href="{{ route('attendance') }}">
                    <span class="nav-icon"><i class="bi bi-calendar-check" aria-hidden="true"></i></span> <span
                        class="nav-text">Attendance</span> </a> <a class="nav-link active"
                    href="{{ route('file_leave') }}" aria-current="page"> <span class="nav-icon"><i
                            class="bi bi-calendar-plus" aria-hidden="true"></i></span> <span class="nav-text">File
                        Leave</span> </a> <a class="nav-link" href="{{ route('file_ob') }}"> <span class="nav-icon"><i
                            class="bi bi-briefcase" aria-hidden="true"></i></span> <span class="nav-text">File OB</span>
                </a> <a class="nav-link" href="{{ route('payslip') }}"> <span class="nav-icon"><i class="bi bi-receipt"
                            aria-hidden="true"></i></span> <span class="nav-text">Payslip</span> </a> <a
                    class="nav-link" href="{{ route('my_profile') }}"> <span class="nav-icon"><i class="bi bi-person"
                            aria-hidden="true"></i></span> <span class="nav-text">My Profile</span> </a> </nav>
            <div class="sidebar-user"> <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                    alt="{{ $employee->name ?? 'Employee' }}"> <strong>{{ $employee->name ?? 'Employee Name' }}</strong>
                <small>{{ $employee->position ?? 'Position' }}</small>
            </div>
            <div class="sidebar-footer"> <span class="status-dot"></span> <span class="sidebar-footer-text">System
                    running smoothly</span> </div>
        </aside>
        <div class="admin-main">
            <nav class="navbar admin-navbar navbar-expand bg-white">
                <div class="container-fluid px-3 px-lg-4"> <button class="sidebar-toggle" type="button"
                        data-sidebar-toggle aria-controls="adminSidebar" aria-expanded="true"
                        aria-label="Toggle sidebar"> <span></span> <span></span> <span></span> </button>
                    <form class="d-none d-md-flex ms-3 flex-grow-1" role="search"> <input
                            class="form-control search-input" type="search" placeholder="Search users, orders, reports"
                            aria-label="Search"> </form>
                    <div class="navbar-actions ms-auto"> <button class="icon-button theme-toggle" type="button"
                            data-theme-toggle aria-label="Switch color theme" title="Switch color theme"> <i
                                class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i> </button>
                        <div class="dropdown"> <button class="icon-button" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="Notifications"> <span class="notification-dot"></span>
                                <i class="bi bi-bell" aria-hidden="true"></i> </button>
                            <div class="dropdown-menu dropdown-menu-end notification-menu">
                                <div class="dropdown-header fw-bold"> Notifications </div>
                                @forelse($notifications as $notification)
                                    <a class="dropdown-item" href="{{ url($notification->url) }}"> <span
                                            class="notification-title"> {{ $notification->title }} </span> <span
                                            class="notification-time"> {{ $notification->message }} </span> </a>
                                @empty <div class="dropdown-item text-muted"> No notifications </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="dropdown"> <button class="profile-button dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"> <img class="avatar-img avatar-sm"
                                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                                    alt="{{ $employee->name ?? 'Employee' }}"> <span
                                    class="profile-name d-none d-sm-inline">{{ $employee->name ?? 'Employee' }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('my_profile') }}">My Profile</a></li>
                                <form method="POST" action="{{ route('logout') }}"> @csrf <button type="submit"
                                        class="dropdown-item"> Sign out </button> </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <main class="dashboard-content">
                <div class="container-fluid px-3 px-lg-4 py-4">
                    <div class="page-heading">
                        <div class="page-heading-copy"> <span class="page-icon"> <i
                                    class="bi bi-calendar2-check"></i> </span>
                            <div>
                                <p class="eyebrow mb-1">Employee</p>
                                <h1 class="h3 mb-1">Leave Application</h1>
                                <p class="text-muted mb-0"> Submit your leave request for approval. </p>
                            </div>
                        </div>
                    </div>
                    <section class="row g-4 align-items-start">
                        <div class="col-xl-8 col-lg-7">
                            @if (session('success'))
                                <div class="alert alert-success"> {{ session('success') }} </div>
                            @endif
                            @if ($errors->has('duplicate'))
                                <div class="alert alert-danger">

                                    <i class="bi bi-exclamation-triangle-fill"></i>

                                    {{ $errors->first('duplicate') }}

                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">

                                    {{ session('error') }}

                                </div>
                            @endif
                            <div class="panel mb-4">

                                <div class="d-flex align-items-center">

                                    <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                                        class="rounded-circle me-3" width="70" height="70"
                                        style="object-fit:cover;">

                                    <div>

                                        <h5 class="mb-1">
                                            {{ $employee->name }}
                                        </h5>

                                        <div class="text-muted">
                                            Employee ID :
                                            {{ $employee->employee_id }}
                                        </div>

                                        <div class="text-muted">
                                            {{ $employee->department }}
                                            •
                                            {{ $employee->position }}
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data"
                                class="panel shadow-sm"> @csrf <div class="panel-header">
                                    <div>
                                        <h2 class="h4 mb-2 section-title"> <i class="bi bi-calendar-plus"></i>
                                            <span>Leave Request Form</span>
                                        </h2>
                                        <p class="text-muted mb-4"> Complete all required fields. </p>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6"> <label class="form-label"> Leave Type </label>
                                        <select class="form-select" name="leave_type" required>

                                            <option value="">Select Leave Type</option>

                                            <option value="Vacation Leave">
                                                Vacation Leave
                                            </option>

                                            <option value="Sick Leave">
                                                Sick Leave
                                            </option>

                                            <option value="Emergency Leave">
                                                Emergency Leave
                                            </option>

                                            <option value="Maternity Leave">
                                                Maternity Leave
                                            </option>

                                            <option value="Paternity Leave">
                                                Paternity Leave
                                            </option>

                                            <option value="Bereavement Leave">
                                                Bereavement Leave
                                            </option>

                                            <option value="Leave Without Pay">
                                                Leave Without Pay
                                            </option>

                                            <option value="Study Leave">
                                                Study Leave
                                            </option>

                                            <option value="Special Leave">
                                                Special Leave
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">

                                        <label class="form-label">

                                            Immediate Supervisor

                                        </label>

                                        <input type="text" class="form-control" name="supervisor"
                                            placeholder="Supervisor Name" required>

                                    </div>
                                    <div class="col-md-3"> <label class="form-label"> Start Date </label> <input
                                            type="date" id="start_date" name="start_date" class="form-control"
                                            required> </div>
                                    <div class="col-md-3"> <label class="form-label"> End Date </label> <input
                                            type="date" id="end_date" name="end_date" class="form-control"
                                            required> </div>
                                    <div class="col-md-4">

                                        <label class="form-label">

                                            Expected Return Date

                                        </label>

                                        <input type="date" class="form-control" name="return_date" required>

                                    </div>
                                    <div class="col-md-2"> <label class="form-label"> Total Days </label> <input
                                            id="days" name="days" class="form-control" readonly> </div>
                                    <div class="col-12"> <label class="form-label"> Reason for Leave </label>
                                        <textarea class="form-control" rows="6" placeholder="Explain the reason for your leave..." name="reason"
                                            required></textarea>
                                    </div>
                                    <div class="col-md-6"> <label class="form-label"> Attachment </label><input
                                            type="file" class="form-control" id="attachment" name="attachment">
                                    </div>
                                </div>
                                <div class="mt-4 text-end"> <button class="btn btn-primary btn-lg px-5"> <i
                                            class="bi bi-send"></i> Submit Leave Request </button> </div>
                            </form>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="panel shadow-sm">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <div>

                                        <h5 class="mb-1">
                                            Leave Summary
                                        </h5>

                                        <small class="text-muted">
                                            Current leave requests
                                        </small>

                                    </div>

                                    <i class="bi bi-clipboard-check fs-3 text-primary"></i>

                                </div>

                                <hr>
                                <div class="d-flex justify-content-between align-items-center py-2">

                                    <span>
                                        <i class="bi bi-clock-history text-warning"></i>
                                        Pending
                                    </span>

                                    <span class="badge rounded-pill bg-warning">
                                        {{ Auth::user()->leaveRequests()->where('status', 'Pending')->count() }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-2">

                                    <span>
                                        <i class="bi bi-check-circle text-success"></i>
                                        Approved
                                    </span> <span class="badge bg-success">
                                        {{ Auth::user()->leaveRequests()->where('status', 'Approved')->count() }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-2">

                                    <span>
                                        <i class="bi bi-x-circle text-danger"></i>
                                        Rejected
                                    </span><span class="badge bg-danger">
                                        {{ Auth::user()->leaveRequests()->where('status', 'Rejected')->count() }}
                                    </span>
                                </div>
                                <hr>

                                <div class="d-flex justify-content-between py-2">

                                    <strong>Total Requests</strong>

                                    <strong>

                                        {{ Auth::user()->leaveRequests()->count() }}

                                    </strong>

                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="mt-4">

                        <div class="panel">

                            <div class="panel-header d-flex justify-content-between align-items-center">

                                <div>

                                    <h5 class="mb-1">
                                        <i class="bi bi-clock-history"></i>
                                        Leave History
                                    </h5>

                                    <small class="text-muted">
                                        Your previous leave requests
                                    </small>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table align-middle">

                                    <thead>

                                        <tr>

                                            <th>Date Filed</th>

                                            <th>Leave Type</th>

                                            <th>Period</th>

                                            <th>Days</th>

                                            <th>Status</th>

                                            <th width="130">Action</th>


                                        </tr>

                                    </thead>

                                    <tbody>

                                        @forelse($leaveHistory as $leave)
                                            <tr>

                                                <td>

                                                    {{ $leave->created_at->format('M d, Y') }}

                                                </td>

                                                <td>

                                                    {{ $leave->leave_type }}

                                                </td>

                                                <td>

                                                    {{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }}

                                                    -

                                                    {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}

                                                </td>

                                                <td>

                                                    {{ $leave->days }}

                                                </td>

                                                <td>

                                                    @if ($leave->status == 'Approved')
                                                        <span class="badge bg-success">

                                                            Approved

                                                        </span>
                                                    @elseif($leave->status == 'Rejected')
                                                        <span class="badge bg-danger">

                                                            Rejected

                                                        </span>
                                                    @elseif($leave->status == 'Cancelled')
                                                        <span class="badge bg-secondary">

                                                            Cancelled

                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">

                                                            Pending

                                                        </span>
                                                    @endif

                                                </td>
                                                <td>

                                                    @if ($leave->status === 'Pending')
                                                        <form action="{{ route('leave.cancel', $leave->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to cancel this leave request?')">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm">

                                                                <i class="bi bi-x-circle"></i>

                                                                Cancel

                                                            </button>

                                                        </form>
                                                    @else
                                                        <span class="text-muted">--</span>
                                                    @endif

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="5" class="text-center text-muted">

                                                    No leave requests yet.

                                                </td>

                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                            <div class="mt-3">

                                {{ $leaveHistory->links() }}

                            </div>

                        </div>

                    </section>
                </div>
            </main>
            <script>
                const start = document.getElementById('start_date');
                const end = document.getElementById('end_date');
                const days = document.getElementById('days');

                function calculateDays() {
                    if (start.value && end.value) {
                        let s = new Date(start.value);
                        let e = new Date(end.value);
                        let diff = (e - s) / (1000 * 60 * 60 * 24) + 1;
                        days.value = diff > 0 ? diff : 0;
                    }
                }
                start.addEventListener('change', calculateDays);
                end.addEventListener('change', calculateDays);

                const leaveType =
                    document.querySelector('select[name="leave_type"]');

                const attachment =
                    document.getElementById('attachment');

                leaveType.addEventListener('change', function() {

                    if (this.value === "Sick Leave") {

                        attachment.required = true;

                    } else {

                        attachment.required = false;

                    }

                });
            </script>
            <footer class="admin-footer">
                <div class="container-fluid px-3 px-lg-4"> <span>Copyright 2026 adminHMD. <br> Developed by <a
                            target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md.
                            Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success"
                            href="https://themewagon.com">ThemeWagon</a> </span> <span>Professional dashboard
                        template.</span> <span>Validated user creation form.</span> </div>
            </footer>
        </div>
    </div>
    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../khen/assets/js/main.js"></script>
</body>

</html>
