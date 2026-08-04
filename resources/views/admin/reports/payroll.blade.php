<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Payroll Reports</title>

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

            color:white;

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

            color:white;

        }

        table th{

            white-space:nowrap;

            font-size:14px;

        }

        table td{

            vertical-align:middle;

            font-size:14px;

        }

        .badge-status{

            padding:7px 15px;

            border-radius:30px;

            font-size:12px;

        }

        .export-btn{

            border-radius:10px;

        }

    </style>

</head>

<body>

<div class="container-fluid py-4">

    <div class="report-header">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2 class="fw-bold">

                    <i class="bi bi-cash-stack text-success"></i>

                    Payroll Reports

                </h2>

                <p class="text-muted mb-0">

                    Generate payroll reports based on payroll period,

                    department and release status.

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

    <!-- FILTERS -->

    <div class="card filter-card mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('reports.payroll') }}">

                <div class="row g-3">

                    <div class="col-lg-3">

                        <label class="form-label">

                            Payroll Start

                        </label>

                        <input type="date"

                               name="start"

                               value="{{ request('start') }}"

                               class="form-control">

                    </div>

                    <div class="col-lg-3">

                        <label class="form-label">

                            Payroll End

                        </label>

                        <input type="date"

                               name="end"

                               value="{{ request('end') }}"

                               class="form-control">

                    </div>

                   <div class="col-lg-2">

    <label class="form-label">
        Department
    </label>

    <select name="department" class="form-select">

        <option value="">All Departments</option>

        <option value="Elementary"
            {{ request('department') == 'Elementary' ? 'selected' : '' }}>
            Elementary
        </option>

        <option value="JHS"
            {{ request('department') == 'JHS' ? 'selected' : '' }}>
            JHS
        </option>

        <option value="SHS"
            {{ request('department') == 'SHS' ? 'selected' : '' }}>
            SHS
        </option>

        <option value="College"
            {{ request('department') == 'College' ? 'selected' : '' }}>
            College
        </option>

        <option value="Admin"
            {{ request('department') == 'Admin' ? 'selected' : '' }}>
            Admin
        </option>

        <option value="Laborers"
            {{ request('department') == 'Laborers' ? 'selected' : '' }}>
            Laborers
        </option>

    </select>

</div>

                    <div class="col-lg-2">

                        <label class="form-label">

                            Status

                        </label>

                        <select name="status"

                                class="form-select">

                            <option value="">

                                All Status

                            </option>

                            <option value="Released"
                                {{ request('status')=='Released' ? 'selected':'' }}>

                                Released

                            </option>

                            <option value="Pending"
                                {{ request('status')=='Pending' ? 'selected':'' }}>

                                Pending

                            </option>

                        </select>

                    </div>

                    <div class="col-lg-2 d-grid">

                        <label>&nbsp;</label>

                        <button class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Generate Report

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    @if(isset($generated) && $generated)

    <div class="alert alert-success alert-dismissible fade show shadow-sm">

        <i class="bi bi-check-circle-fill me-2"></i>

        <strong>Payroll report generated successfully!</strong>

        {{ $totalEmployees }} employee(s) matched your selected filters.

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif

    <!-- SUMMARY CARDS -->

    <div class="row mb-4">

        <div class="col-lg-2">

            <div class="card summary-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Total Employees</small>

                            <h4>

                                {{ $totalEmployees }}

                            </h4>

                        </div>

                        <div class="summary-icon bg-primary">

                            <i class="bi bi-people"></i>

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

                            <small>Gross Payroll</small>

                            <h5>

                                ₱{{ number_format($grossPayroll,2) }}

                            </h5>

                        </div>

                        <div class="summary-icon bg-success">

                            <i class="bi bi-cash-stack"></i>

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

                            <small>Net Payroll</small>

                            <h5>

                                ₱{{ number_format($netPayroll,2) }}

                            </h5>

                        </div>

                        <div class="summary-icon bg-info">

                            <i class="bi bi-wallet2"></i>

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

                            <small>Total Benefits</small>

                            <h5>

                                ₱{{ number_format($totalBenefits,2) }}

                            </h5>

                        </div>

                        <div class="summary-icon bg-warning">

                            <i class="bi bi-gift"></i>

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

                            <small>Total Deductions</small>

                            <h5>

                                ₱{{ number_format($totalDeductions,2) }}

                            </h5>

                        </div>

                        <div class="summary-icon bg-danger">

                            <i class="bi bi-dash-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- EXPORT BUTTONS -->

    <div class="card mb-4 border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h5 class="mb-1">

                        Payroll Report

                    </h5>

                    <small class="text-muted">

                        Export the generated report to PDF or Excel.

                    </small>

                </div>

                <div class="mt-2 mt-lg-0">

                    <a href="{{ route('reports.payroll.pdf', request()->query()) }}"

                       class="btn btn-danger export-btn me-2">

                        <i class="bi bi-file-earmark-pdf-fill"></i>

                        Download PDF

                    </a>

                    <a href="{{ route('reports.payroll.excel', request()->query()) }}"

                       class="btn btn-success export-btn">

                        <i class="bi bi-file-earmark-excel-fill"></i>

                        Download Excel

                    </a>

                </div>

            </div>

        </div>

    </div>



    <!-- PAYROLL TABLE -->

    <div class="card report-table border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bi bi-table"></i>

                Payroll Report Details

            </h5>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Employee ID</th>

                        <th>Employee</th>

                        <th>Department</th>

                        <th>Payroll Period</th>

                        <th class="text-end">Gross</th>

                        <th class="text-end">Benefits</th>

                        <th class="text-end">Deductions</th>

                        <th class="text-end">Net</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($payslips as $index => $pay)

                    @php

                        $deductions =
                            $pay->sss +
                            $pay->philhealth +
                            $pay->pagibig +
                            $pay->hmo +
                            $pay->late_deduction +
                            $pay->undertime_deduction;

                    @endphp

                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td>{{ $pay->user->employee_id }}</td>

                        <td>

                            <strong>

                                {{ $pay->user->name }}

                            </strong>

                        </td>

                        <td>

                            {{ $pay->user->department }}

                        </td>

                        <td>

                            <small>

                                {{ \Carbon\Carbon::parse($pay->period_start)->format('M d, Y') }}

                                <br>

                                to

                                <br>

                                {{ \Carbon\Carbon::parse($pay->period_end)->format('M d, Y') }}

                            </small>

                        </td>

                        <td class="text-end">

                            ₱{{ number_format($pay->gross_salary,2) }}

                        </td>

                        <td class="text-end">

                            ₱{{ number_format($pay->benefits,2) }}

                        </td>

                        <td class="text-end text-danger">

                            ₱{{ number_format($deductions,2) }}

                        </td>

                        <td class="text-end fw-bold text-success">

                            ₱{{ number_format($pay->net_salary,2) }}

                        </td>

                        <td>

                            @if($pay->status == 'Released')

                                <span class="badge bg-success">

                                    Released

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    Pending

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="text-center py-5">

                            <i class="bi bi-folder2-open display-4 text-secondary"></i>

                            <br><br>

                            <strong>

                                No payroll records found.

                            </strong>

                            <br>

                            <small class="text-muted">

                                Try changing the selected filters.

                            </small>

                        </td>

                    </tr>

                @endforelse

                </tbody>

                                <tfoot class="table-light">

                    <tr>

                        <th colspan="5" class="text-end">

                            REPORT TOTALS

                        </th>

                        <th class="text-end text-primary">

                            ₱{{ number_format($grossPayroll,2) }}

                        </th>

                        <th class="text-end text-warning">

                            ₱{{ number_format($totalBenefits,2) }}

                        </th>

                        <th class="text-end text-danger">

                            ₱{{ number_format($totalDeductions,2) }}

                        </th>

                        <th class="text-end text-success">

                            ₱{{ number_format($netPayroll,2) }}

                        </th>

                        <th></th>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>



    <!-- REPORT INFORMATION -->

    <div class="row mt-4">

        <div class="col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5>

                        <i class="bi bi-info-circle"></i>

                        Report Information

                    </h5>

                    <hr>

                    <table class="table table-borderless mb-0">

                        <tr>

                            <td width="180">

                                Report Generated

                            </td>

                            <td>

                                {{ now()->format('F d, Y h:i A') }}

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Payroll Period

                            </td>

                            <td>

                                {{ request('start') ?: 'All Records' }}

                                -

                                {{ request('end') ?: 'Present' }}

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Department

                            </td>

                            <td>

                                {{ request('department') ?: 'All Departments' }}

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Status

                            </td>

                            <td>

                                {{ request('status') ?: 'All Status' }}

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Total Employees

                            </td>

                            <td>

                                <strong>

                                    {{ $totalEmployees }}

                                </strong>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>



        <div class="col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5>

                        <i class="bi bi-pencil-square"></i>

                        Certification

                    </h5>

                    <hr>

                    <p class="text-muted">

                        This payroll report was generated from the

                        Payroll Management System and summarizes the

                        payroll records based on the selected filters.

                    </p>

                    <br><br>

                    <div class="row text-center">

                        <div class="col-6">

                            _______________________

                            <br>

                            <strong>

                                Prepared By

                            </strong>

                        </div>

                        <div class="col-6">

                            _______________________

                            <br>

                            <strong>

                                Approved By

                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- FOOTER -->

    <div class="text-center mt-5 mb-3">

        <small class="text-muted">

            Payroll Management System

            |

            Payroll Reports Module

            |

            Generated on

            {{ now()->format('F d, Y h:i A') }}

        </small>

    </div>

</div>



<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>