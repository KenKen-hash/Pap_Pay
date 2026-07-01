<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Tables | adminHMD</title>

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

  <a class="nav-link active" href="{{ route('admin.leaves') }}">
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
      <<div class="sidebar-user">
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

        <span class="page-icon">

            <i class="bi bi-calendar2-check"></i>

        </span>

        <div>

            <p class="eyebrow mb-1">

                Human Resource

            </p>

            <h1 class="h3 mb-1">

                Leave Management

            </h1>

            <p class="text-muted">

                Manage employee leave requests, approvals and leave records.

            </p>

        </div>

    </div>
</div>
<div class="row g-3 mb-4">

<div class="col-xl-3 col-md-6">

<div class="panel h-100">

<h6 class="text-muted">

Pending Requests

</h6>

<h2 class="fw-bold text-warning">

{{ $pending }}

</h2>

<p class="mb-0">

Awaiting approval

</p>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="panel h-100">

<h6 class="text-muted">

Approved

</h6>

<h2 class="fw-bold text-success">

{{ $approved }}

</h2>

<p class="mb-0">

Approved leaves

</p>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="panel h-100">

<h6 class="text-muted">

Rejected

</h6>

<h2 class="fw-bold text-danger">

{{ $rejected }}

</h2>

<p class="mb-0">

Rejected requests

</p>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="panel h-100">

<h6 class="text-muted">

Employees on Leave

</h6>

<h2 class="fw-bold text-primary">

{{ $onLeaveToday }}

</h2>

<p class="mb-0">

Today

</p>

</div>

</div>

</div>
<section class="panel">

    <div class="panel-header d-flex justify-content-between align-items-center">

        <div>

            <h2 class="section-title">
                <i class="bi bi-calendar2-check"></i>
                Employee Leave Requests
            </h2>

            <p class="text-muted mb-0">
                Review, approve or reject employee leave applications.
            </p>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

            <tr>

                <th>Leave ID</th>

                <th>Employee</th>

                <th>Department</th>

                <th>Leave Type</th>

                <th>Leave Period</th>

                <th>Days</th>

                <th>Status</th>

                <th>Filed On</th>

                <th class="text-end">Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($leaveRequests as $leave)

                <tr>

                    <td>

                        <strong>

                            LV-{{ str_pad($leave->id,5,'0',STR_PAD_LEFT) }}

                        </strong>

                    </td>

                    <td>

                        <div class="d-flex align-items-center">

                            @if($leave->user->photo)

                                <img
                                    src="{{ asset('storage/'.$leave->user->photo) }}"
                                    width="45"
                                    height="45"
                                    class="rounded-circle me-2">

                            @else

                                <img
                                    src="{{ asset('images/default-avatar.png') }}"
                                    width="45"
                                    height="45"
                                    class="rounded-circle me-2">

                            @endif

                            <div>

                                <strong>

                                    {{ $leave->user->name }}

                                </strong>

                                <br>

                                <small>

                                    {{ $leave->user->employee_id }}

                                </small>

                            </div>

                        </div>

                    </td>

                    <td>

                        {{ $leave->user->department }}

                    </td>

                    <td>

                        {{ $leave->leave_type }}

                    </td>

                    <td>

                        {{ $leave->start_date->format('M d, Y') }}

                        <br>

                        <small>

                            to

                        </small>

                        <br>

                        {{ $leave->end_date->format('M d, Y') }}

                    </td>

                    <td>

                        {{ $leave->days }}

                    </td>

                    <td>

                        @if($leave->status=='Pending')

                            <span class="badge bg-warning">

                                Pending

                            </span>

                        @elseif($leave->status=='Approved')

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

                        {{ $leave->created_at->format('M d, Y') }}

                    </td>

                    <td class="text-end">

                       <button
    class="btn btn-primary btn-sm viewLeaveBtn"
    data-id="{{ $leave->id }}"
    data-bs-toggle="modal"
    data-bs-target="#leaveModal">

    <i class="bi bi-eye"></i>

    View

</button>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center py-5">

                        <h5>No leave requests found.</h5>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>
    <div class="modal fade" id="leaveModal" tabindex="-1">

<div class="modal-dialog modal-xl">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">

Leave Request Details

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<div class="row">

<div class="col-md-4 text-center">

<img
id="employeePhoto"
src=""
class="rounded-circle mb-3"
width="140"
height="140">

<h4 id="employeeName"></h4>

<p id="employeeDepartment"></p>

<p id="employeePosition"></p>

</div>

<div class="col-md-8">

<table class="table">

<tr>

<th>Leave Type</th>

<td id="leaveType"></td>

</tr>

<tr>

<th>Leave Period</th>

<td id="leavePeriod"></td>

</tr>

<tr>

<th>Total Days</th>

<td id="leaveDays"></td>

</tr>

<tr>

<th>Status</th>

<td id="leaveStatus"></td>

</tr>

<tr>

<th>Emergency Contact</th>

<td id="emergencyContact"></td>

</tr>

<tr>

<th>Contact Number</th>

<td id="contactNumber"></td>

</tr>

<tr>

<th>Reason</th>

<td id="leaveReason"></td>

</tr>

<tr>

<th>Attachment</th>

<td id="attachment"></td>

</tr>

</table>

<div class="mt-4">

<label>

Remarks

</label>

<textarea
class="form-control"
id="remarks"
rows="4"></textarea>

</div>

</div>

</div>

</div>

<div class="modal-footer">

<button
class="btn btn-success"
id="approveBtn">

Approve

</button>

<button
class="btn btn-danger"
id="rejectBtn">

Reject

</button>

<button
class="btn btn-secondary"
data-bs-dismiss="modal">

Close

</button>

</div>

</div>

</div>

</div>
</section>
</main>


      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Responsive table examples.</span>
        </div>
      </footer>
    </div>
  </div>
  <input type="hidden" id="leaveId">

  <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../khen/assets/js/main.js"></script>
  <script>

document.querySelectorAll('.viewLeaveBtn').forEach(button=>{

button.addEventListener('click',function(){

const id=this.dataset.id;

fetch('/admin/leaves/'+id)

.then(response=>response.json())

.then(data=>{

document.getElementById('employeeName').innerHTML=data.user.name;

document.getElementById('leaveId').value = data.id;

document.getElementById('employeeDepartment').innerHTML=data.user.department;

document.getElementById('employeePosition').innerHTML=data.user.position;

document.getElementById('leaveType').innerHTML=data.leave_type;

document.getElementById('leavePeriod').innerHTML=
data.start_date+" - "+data.end_date;

document.getElementById('leaveDays').innerHTML=data.days;

document.getElementById('leaveStatus').innerHTML=data.status;

document.getElementById('leaveReason').innerHTML=data.reason;

document.getElementById('emergencyContact').innerHTML=data.emergency_contact;

document.getElementById('contactNumber').innerHTML=data.contact_number;

if(data.user.photo){

document.getElementById('employeePhoto').src='/storage/'+data.user.photo;

}else{

document.getElementById('employeePhoto').src='/images/default-avatar.png';

}

if(data.attachment){

document.getElementById('attachment').innerHTML=
'<a href="/storage/'+data.attachment+'" target="_blank" class="btn btn-outline-primary btn-sm">Download Attachment</a>';

}else{

document.getElementById('attachment').innerHTML='No attachment uploaded';

}


});

});

});


document.getElementById('approveBtn').addEventListener('click', function () {

    const id = document.getElementById('leaveId').value;

    fetch(`/admin/leaves/${id}/status`, {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content

        },

        body: JSON.stringify({

            status: 'Approved',

            remarks: document.getElementById('remarks').value

        })

    })

    .then(res => res.json())

    .then(response => {

        if(response.success){

            alert(response.message);

            location.reload();

        }else{

            alert(response.message);

        }

    });

});
document.getElementById('rejectBtn').addEventListener('click', function () {

    const id = document.getElementById('leaveId').value;

    fetch(`/admin/leaves/${id}/status`, {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content

        },

        body: JSON.stringify({

            status: 'Rejected',

            remarks: document.getElementById('remarks').value

        })

    })

    .then(res => res.json())

    .then(response => {

        if(response.success){

            alert(response.message);

            location.reload();

        }else{

            alert(response.message);

        }

    });

});

</script>
</body>
</html>
