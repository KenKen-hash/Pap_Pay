<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Leave Reports</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>

        body{
            background:#f5f7fb;
        }

        .report-header{
            background:#fff;
            border-radius:15px;
            padding:30px;
            margin-bottom:25px;
            box-shadow:0 3px 15px rgba(0,0,0,.05);
        }

        .summary-card{
            border:none;
            border-radius:15px;
            transition:.3s;
            box-shadow:0 5px 18px rgba(0,0,0,.06);
        }

        .summary-card:hover{
            transform:translateY(-4px);
        }

        .summary-icon{
            width:60px;
            height:60px;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-size:28px;
        }

        .filter-card{
            border:none;
            border-radius:15px;
            box-shadow:0 4px 18px rgba(0,0,0,.06);
        }

        .report-table{
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 4px 20px rgba(0,0,0,.06);
        }

        table thead{
            background:#0d6efd;
            color:#fff;
        }

    </style>

</head>

<body>

<div class="container-fluid py-4">

<div class="report-header">

<div class="row align-items-center">

<div class="col-md-8">

<h2 class="fw-bold">

<i class="bi bi-calendar-check text-primary"></i>

Leave Reports

</h2>

<p class="text-muted mb-0">

Generate employee leave reports.

</p>

</div>

<div class="col-md-4 text-end">

<a href="{{ route('reports') }}" class="btn btn-outline-secondary">

<i class="bi bi-arrow-left"></i>

Back to Reports

</a>

</div>

</div>

</div>

<!-- FILTER -->

<div class="card filter-card mb-4">

<div class="card-body">

<form method="GET" action="{{ route('reports.leave') }}">

<div class="row g-3">

<div class="col-md-3">

<label class="form-label">

Date From

</label>

<input
type="date"
name="start"
class="form-control"
value="{{ request('start') }}">

</div>

<div class="col-md-3">

<label class="form-label">

Date To

</label>

<input
type="date"
name="end"
class="form-control"
value="{{ request('end') }}">

</div>

<div class="col-md-3">

<label class="form-label">

Leave Type

</label>

<select
name="leave_type"
class="form-select">

<option value="">

All Types

</option>

@foreach($leaveTypes as $type)

<option
value="{{ $type }}"
{{ request('leave_type')==$type ? 'selected':'' }}>

{{ $type }}

</option>

@endforeach

</select>

</div>

<div class="col-md-2">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option value="">

All Status

</option>

<option value="Pending"
{{ request('status')=='Pending'?'selected':'' }}>

Pending

</option>

<option value="Approved"
{{ request('status')=='Approved'?'selected':'' }}>

Approved

</option>

<option value="Rejected"
{{ request('status')=='Rejected'?'selected':'' }}>

Rejected

</option>

</select>

</div>

<div class="col-md-1 d-grid">

<label>&nbsp;</label>

<button class="btn btn-primary">

<i class="bi bi-search"></i>

</button>

</div>

</div>

</form>

</div>

</div>

@if(isset($generated))

@if($totalLeaves)

<div class="alert alert-success alert-dismissible fade show">

<i class="bi bi-check-circle-fill me-2"></i>

Leave report generated successfully.

<button
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

@else

<div class="alert alert-warning alert-dismissible fade show">

No leave records found.

<button
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

@endif

@endif

<div class="row mb-4">

<div class="col-lg-3">

<div class="card summary-card">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small>Total Leaves</small>

<h3>{{ $totalLeaves }}</h3>

</div>

<div class="summary-icon bg-primary">

<i class="bi bi-calendar-event"></i>

</div>

</div>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="card summary-card">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small>Approved</small>

<h3>{{ $approvedLeaves }}</h3>

</div>

<div class="summary-icon bg-success">

<i class="bi bi-check-circle"></i>

</div>

</div>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="card summary-card">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small>Pending</small>

<h3>{{ $pendingLeaves }}</h3>

</div>

<div class="summary-icon bg-warning">

<i class="bi bi-hourglass-split"></i>

</div>

</div>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="card summary-card">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small>Rejected</small>

<h3>{{ $rejectedLeaves }}</h3>

</div>

<div class="summary-icon bg-danger">

<i class="bi bi-x-circle"></i>

</div>

</div>

</div>

</div>

</div>

</div>

    <!-- EXPORT BUTTONS -->

    <div class="d-flex justify-content-end mb-3">

        <a href="{{ route('reports.leave.pdf', request()->query()) }}"
           class="btn btn-danger me-2">

            <i class="bi bi-file-earmark-pdf-fill"></i>

            Download PDF

        </a>

        <a href="{{ route('reports.leave.excel', request()->query()) }}"
           class="btn btn-success">

            <i class="bi bi-file-earmark-excel-fill"></i>

            Download Excel

        </a>

    </div>

    <!-- LEAVE TABLE -->

    <div class="card report-table">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Leave Report

            </h5>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover table-bordered mb-0">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Employee ID</th>

                            <th>Employee Name</th>

                            <th>Department</th>

                            <th>Leave Type</th>

                            <th>Start Date</th>

                            <th>End Date</th>

                            <th>Total Days</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($leaves as $leave)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $leave->user->employee_id }}

                            </td>

                            <td>

                                {{ $leave->user->name }}

                            </td>

                            <td>

                                {{ $leave->user->department }}

                            </td>

                            <td>

                                {{ $leave->leave_type }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}

                            </td>

                            <td class="text-center">

                                {{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}

                            </td>

                            <td>

                                @if($leave->status == 'Approved')

                                    <span class="badge bg-success">

                                        Approved

                                    </span>

                                @elseif($leave->status == 'Pending')

                                    <span class="badge bg-warning text-dark">

                                        Pending

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Rejected

                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="9" class="text-center py-5">

                                <i class="bi bi-calendar-x display-4 text-muted"></i>

                                <br><br>

                                No leave records found.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

        <!-- REPORT INFORMATION -->

    <div class="card mt-4 shadow-sm">

        <div class="card-header bg-light">

            <h5 class="mb-0">

                <i class="bi bi-info-circle"></i>

                Report Information

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <table class="table table-borderless">

                        <tr>

                            <th width="180">

                                Report Type

                            </th>

                            <td>

                                Leave Report

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Generated Date

                            </th>

                            <td>

                                {{ now()->format('F d, Y h:i A') }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Generated By

                            </th>

                            <td>

                                {{ auth()->user()->name }}

                            </td>

                        </tr>

                    </table>

                </div>

                <div class="col-md-6">

                    <table class="table table-borderless">

                        <tr>

                            <th width="180">

                                Date From

                            </th>

                            <td>

                                {{ request('start') ?: 'All Records' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Date To

                            </th>

                            <td>

                                {{ request('end') ?: 'Present' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Leave Type

                            </th>

                            <td>

                                {{ request('leave_type') ?: 'All Types' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

                                {{ request('status') ?: 'All Status' }}

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- SIGNATURES -->

    <div class="row mt-5">

        <div class="col-md-6 text-center">

            <br><br>

            _______________________________

            <br>

            <strong>Prepared By</strong>

        </div>

        <div class="col-md-6 text-center">

            <br><br>

            _______________________________

            <br>

            <strong>Approved By</strong>

        </div>

    </div>

    <!-- FOOTER -->

    <div class="text-center text-muted mt-5 mb-3">

        <small>

            PAP PAY - Leave Report System

            <br>

            © {{ date('Y') }} All Rights Reserved.

        </small>

    </div>

</div>

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>