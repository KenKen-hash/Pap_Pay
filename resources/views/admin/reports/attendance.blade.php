<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Attendance Reports</title>

    <link rel="stylesheet"
          href="../../../../khen/assets/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet"
          href="../../../../khen/assets/css/style.css">

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
            font-size:28px;
            color:#fff;
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

        table th{
            white-space:nowrap;
        }

        .export-btn{
            border-radius:10px;
        }

    </style>

</head>

<body>

<div class="container-fluid py-4">

    <!-- PAGE HEADER -->

    <div class="report-header">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2 class="fw-bold">

                    <i class="bi bi-calendar-check text-primary"></i>

                    Attendance Reports

                </h2>

                <p class="text-muted mb-0">

                    Generate attendance reports based on attendance date,
                    department and attendance status.

                </p>

            </div>

            <div class="col-md-4 text-end">

                <a href="{{ route('reports') }}"
                   class="btn btn-outline-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Back to Reports

                </a>

            </div>

        </div>

    </div>

    <!-- FILTER CARD -->

    <div class="card filter-card mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('reports.attendance') }}">

                <div class="row g-3">

                    <div class="col-lg-3">

                        <label class="form-label">

                            Date From

                        </label>

                        <input type="date"
                               name="start"
                               class="form-control"
                               value="{{ request('start') }}">

                    </div>

                    <div class="col-lg-3">

                        <label class="form-label">

                            Date To

                        </label>

                        <input type="date"
                               name="end"
                               class="form-control"
                               value="{{ request('end') }}">

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label">

                            Department

                        </label>

                        <select
                            name="department"
                            class="form-select">

                            <option value="">

                                All Departments

                            </option>

                            @foreach($departments as $department)

                                <option
                                    value="{{ $department }}"
                                    {{ request('department') == $department ? 'selected' : '' }}>

                                    {{ $department }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="">

                                All Status

                            </option>

                            <option value="Present"
                                {{ request('status')=='Present' ? 'selected':'' }}>

                                Present

                            </option>

                            <option value="Late"
                                {{ request('status')=='Late' ? 'selected':'' }}>

                                Late

                            </option>

                            <option value="Absent"
                                {{ request('status')=='Absent' ? 'selected':'' }}>

                                Absent

                            </option>

                            <option value="Leave"
                                {{ request('status')=='Leave' ? 'selected':'' }}>

                                Leave

                            </option>

                        </select>

                    </div>

                    <div class="col-lg-2 d-grid">

                        <label>&nbsp;</label>

                        <button
                            class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Generate Report

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- SUCCESS MESSAGE -->

    @if(isset($generated))

        @if($totalRecords > 0)

            <div class="alert alert-success alert-dismissible fade show">

                <i class="bi bi-check-circle-fill me-2"></i>

                Attendance report generated successfully.

                <strong>{{ $totalRecords }}</strong>

                record(s) found.

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @else

            <div class="alert alert-warning alert-dismissible fade show">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                No attendance records found.

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif

    @endif

    <!-- SUMMARY CARDS -->

    <div class="row mb-4">

        <div class="col-lg-2">

            <div class="card summary-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Total Records</small>

                            <h4>

                                {{ $totalRecords }}

                            </h4>

                        </div>

                        <div class="summary-icon bg-primary">

                            <i class="bi bi-clipboard-data"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card summary-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Present</small>

                            <h4>

                                {{ $presentCount }}

                            </h4>

                        </div>

                        <div class="summary-icon bg-success">

                            <i class="bi bi-check-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card summary-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Late</small>

                            <h4>

                                {{ $lateCount }}

                            </h4>

                        </div>

                        <div class="summary-icon bg-warning">

                            <i class="bi bi-clock-history"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

                <div class="col-lg-2">

            <div class="card summary-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Absent</small>

                            <h4>

                                {{ $absentCount }}

                            </h4>

                        </div>

                        <div class="summary-icon bg-danger">

                            <i class="bi bi-x-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card summary-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small>Total Hours Worked</small>

                            <h3 class="fw-bold">

                                {{ number_format($totalHours,2) }}

                            </h3>

                        </div>

                        <div class="summary-icon bg-info">

                            <i class="bi bi-hourglass-split"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- EXPORT BUTTONS -->

    <div class="d-flex justify-content-end mb-3">

        <a href="{{ route('reports.attendance.pdf', request()->query()) }}"
           class="btn btn-danger export-btn me-2">

            <i class="bi bi-file-earmark-pdf-fill"></i>

            Download PDF

        </a>

        <a href="{{ route('reports.attendance.excel', request()->query()) }}"
           class="btn btn-success export-btn">

            <i class="bi bi-file-earmark-excel-fill"></i>

            Download Excel

        </a>

    </div>

    <!-- ATTENDANCE TABLE -->

    <div class="card report-table">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Attendance Records

            </h5>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover table-bordered mb-0">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Employee ID</th>

                            <th>Employee</th>

                            <th>Department</th>

                            <th>Date</th>

                            <th>Morning In</th>

                            <th>Morning Out</th>

                            <th>Afternoon In</th>

                            <th>Afternoon Out</th>

                            <th>Hours</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($attendance as $record)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $record->user->employee_id }}

                            </td>

                            <td>

                                {{ $record->user->name }}

                            </td>

                            <td>

                                {{ $record->user->department }}

                            </td>

                            <td>

                                {{ optional($record->date)->format('M d, Y') }}

                            </td>

                            <td>

                                {{ optional($record->morning_time_in)->format('h:i A') }}

                            </td>

                            <td>

                                {{ optional($record->morning_time_out)->format('h:i A') }}

                            </td>

                            <td>

                                {{ optional($record->afternoon_time_in)->format('h:i A') }}

                            </td>

                            <td>

                                {{ optional($record->afternoon_time_out)->format('h:i A') }}

                            </td>

                            <td>

                                {{ number_format($record->hours_worked,2) }}

                            </td>

                            <td>

                                @if($record->status=='Present')

                                    <span class="badge bg-success">

                                        Present

                                    </span>

                                @elseif($record->status=='Late')

                                    <span class="badge bg-warning text-dark">

                                        Late

                                    </span>

                                @elseif($record->status=='Absent')

                                    <span class="badge bg-danger">

                                        Absent

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        {{ $record->status }}

                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="11" class="text-center py-5">

                                <i class="bi bi-inbox display-4 text-muted"></i>

                                <br><br>

                                No attendance records found.

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

                                Attendance Report

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

                                Department

                            </th>

                            <td>

                                {{ request('department') ?: 'All Departments' }}

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

            PAP PAY - Attendance Report System

            <br>

            © {{ date('Y') }} All Rights Reserved.

        </small>

    </div>

</div>

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>