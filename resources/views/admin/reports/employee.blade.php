<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Reports</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        body {
            background: #f5f7fb;
        }

        .report-header {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .05);
        }

        .summary-card {
            border: none;
            border-radius: 15px;
            transition: .3s;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .06);
        }

        .summary-card:hover {
            transform: translateY(-4px);
        }

        .summary-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
        }

        .filter-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .06);
        }

        .report-table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
        }

        table thead {
            background: #0d6efd;
            color: #fff;
        }

        table th {
            white-space: nowrap;
        }

        .export-btn {
            border-radius: 10px;
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

                        <i class="bi bi-people-fill text-primary"></i>

                        Employee Reports

                    </h2>

                    <p class="text-muted mb-0">

                        Generate employee reports by department and employment status.

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

        <!-- FILTERS -->

        <div class="card filter-card mb-4">

            <div class="card-body">

                <form method="GET" action="{{ route('reports.employee') }}">

                    <div class="row g-3">

                        <div class="col-lg-5">

                            <label class="form-label">

                                Department

                            </label>

                            <select name="department" class="form-select">

                                <option value="">

                                    All Departments

                                </option>

                                @foreach ($departments as $department)
                                    <option value="{{ $department }}"
                                        {{ request('department') == $department ? 'selected' : '' }}>

                                        {{ $department }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-lg-5">

                            <label class="form-label">

                                Employee Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="">

                                    All Status

                                </option>

                                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                        </div>

                        <div class="col-lg-2 d-grid">

                            <label>&nbsp;</label>

                            <button class="btn btn-primary">

                                <i class="bi bi-search"></i>

                                Generate

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- SUCCESS MESSAGE -->

        @if (isset($generated))

            @if ($totalEmployees > 0)
                <div class="alert alert-success alert-dismissible fade show">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    Employee report generated successfully.

                    <strong>{{ $totalEmployees }}</strong>

                    employee(s) found.

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>

                </div>
            @else
                <div class="alert alert-warning alert-dismissible fade show">

                    <i class="bi bi-exclamation-circle-fill me-2"></i>

                    No employees found.

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>

                </div>
            @endif

        @endif

        <!-- SUMMARY CARDS -->

        <div class="row mb-4">

            <div class="col-lg-3">

                <div class="card summary-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small>Total Employees</small>

                                <h3>

                                    {{ $totalEmployees }}

                                </h3>

                            </div>

                            <div class="summary-icon bg-primary">

                                <i class="bi bi-people"></i>

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

                                <small>Active</small>

                                <h3>

                                    {{ $activeEmployees }}

                                </h3>

                            </div>

                            <div class="summary-icon bg-success">

                                <i class="bi bi-person-check"></i>

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

                                <small>Inactive</small>

                                <h3>

                                    {{ $inactiveEmployees }}

                                </h3>

                            </div>

                            <div class="summary-icon bg-danger">

                                <i class="bi bi-person-x"></i>

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

                                <small>Departments</small>

                                <h3>

                                    {{ $departmentCount }}

                                </h3>

                            </div>

                            <div class="summary-icon bg-info">

                                <i class="bi bi-building"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- EXPORT BUTTONS -->

        <div class="d-flex justify-content-end mb-3">

            <a href="{{ route('reports.employee.pdf', request()->query()) }}" class="btn btn-danger export-btn me-2">

                <i class="bi bi-file-earmark-pdf-fill"></i>

                Download PDF

            </a>

            <a href="{{ route('reports.employee.excel', request()->query()) }}" class="btn btn-success export-btn">

                <i class="bi bi-file-earmark-excel-fill"></i>

                Download Excel

            </a>

        </div>

        <!-- EMPLOYEE TABLE -->

        <div class="card report-table">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    Employee Report

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

                                <th>Email</th>

                                <th>Contact Number</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($employees as $employee)
                                <tr>

                                    <td>

                                        {{ $loop->iteration }}

                                    </td>

                                    <td>

                                        {{ $employee->employee_id }}

                                    </td>

                                    <td>

                                        {{ $employee->name }}

                                    </td>

                                    <td>

                                        {{ $employee->department }}

                                    </td>

                                    <td>

                                        {{ $employee->email }}

                                    </td>

                                    <td>

                                        {{ $employee->contact_number }}

                                    </td>

                                    <td>

                                        @if ($employee->status == 'Active')
                                            <span class="badge bg-success">

                                                Active

                                            </span>
                                        @else
                                            <span class="badge bg-danger">

                                                Inactive

                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <i class="bi bi-people display-4 text-muted"></i>

                                        <br><br>

                                        No employee records found.

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

                                Employee Report

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

                        <tr>

                            <th>

                                Total Employees

                            </th>

                            <td>

                                {{ $totalEmployees }}

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

            PAP PAY - Employee Report System

            <br>

            © {{ date('Y') }} All Rights Reserved.

        </small>

    </div>

</div>

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
