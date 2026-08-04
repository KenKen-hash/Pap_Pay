<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Salary Report</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        body {
            background: #f5f7fb;
        }


        .report-header {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
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
            color: #fff;
            font-size: 28px;
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
    </style>

</head>

<body>

    <div class="container-fluid py-4">

        <div class="report-header">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h2 class="fw-bold">

                        <i class="bi bi-cash-stack text-success"></i>

                        Salary Report

                    </h2>

                    <p class="text-muted mb-0">

                        Generate salary configuration reports.

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

                <form method="GET" action="{{ route('reports.salary') }}">

                    <div class="row">

                        <div class="col-md-10">

                            <label class="form-label">

                                Department

                            </label>

                            <select name="department" class="form-select">

                                <option value="">All Departments</option>

                                <option value="Elementary" {{ request('department') == 'Elementary' ? 'selected' : '' }}>

                                    Elementary

                                </option>

                                <option value="JHS" {{ request('department') == 'JHS' ? 'selected' : '' }}>

                                    JHS

                                </option>

                                <option value="SHS" {{ request('department') == 'SHS' ? 'selected' : '' }}>

                                    SHS

                                </option>

                                <option value="College" {{ request('department') == 'College' ? 'selected' : '' }}>

                                    College

                                </option>

                                <option value="Admin" {{ request('department') == 'Admin' ? 'selected' : '' }}>

                                    Admin

                                </option>

                                <option value="Laborers" {{ request('department') == 'Laborers' ? 'selected' : '' }}>

                                    Laborers

                                </option>

                            </select>

                        </div>

                        <div class="col-md-2 d-grid">

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

        @if (isset($generated))

            @if ($totalEmployees)
                <div class="alert alert-success alert-dismissible fade show">

                    Salary report generated successfully.

                    <button class="btn-close" data-bs-dismiss="alert"></button>

                </div>
            @else
                <div class="alert alert-warning alert-dismissible fade show">

                    No salary configurations found.

                    <button class="btn-close" data-bs-dismiss="alert"></button>

                </div>
            @endif

        @endif

        <!-- SUMMARY -->

        <div class="row mb-4">

            <div class="col-lg-3">

                <div class="card summary-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small>Total Employees</small>

                                <h3>{{ $totalEmployees }}</h3>

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

                                <small>Total Basic Salary</small>

                                <h3>₱{{ number_format($totalBasicSalary, 2) }}</h3>

                            </div>

                            <div class="summary-icon bg-success">

                                <i class="bi bi-cash"></i>

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

                                <small>Average Salary</small>

                                <h3>₱{{ number_format($averageBasicSalary, 2) }}</h3>

                            </div>

                            <div class="summary-icon bg-warning">

                                <i class="bi bi-graph-up"></i>

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

                                <small>Total Daily Rate</small>

                                <h3>₱{{ number_format($totalDailyRate, 2) }}</h3>

                            </div>

                            <div class="summary-icon bg-danger">

                                <i class="bi bi-wallet2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- EXPORT BUTTONS -->

        <div class="d-flex justify-content-end mb-3">

            <a href="{{ route('reports.salary.pdf', request()->query()) }}" class="btn btn-danger me-2">

                <i class="bi bi-file-earmark-pdf-fill"></i>

                Download PDF

            </a>

            <a href="{{ route('reports.salary.excel', request()->query()) }}" class="btn btn-success">

                <i class="bi bi-file-earmark-excel-fill"></i>

                Download Excel

            </a>

        </div>

        <!-- SALARY TABLE -->

        <div class="card report-table">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    Salary Configuration Report

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
                                <th>Basic Salary</th>
                                <th>Daily Rate</th>
                                <th>Payroll Period</th>
                                <th>OT Rate</th>
                                <th>Honorarium</th>
                                <th>Teaching Load</th>
                                <th>SSS</th>
                                <th>PhilHealth</th>
                                <th>Pag-IBIG</th>
                                <th>HMO</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($salaries as $salary)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $salary->user->employee_id }}</td>

                                    <td>{{ $salary->user->name }}</td>

                                    <td>{{ $salary->user->department }}</td>

                                    <td>₱{{ number_format($salary->basic_salary, 2) }}</td>

                                    <td>₱{{ number_format($salary->daily_rate, 2) }}</td>

                                    <td>{{ $salary->payroll_period }}</td>

                                    <td>₱{{ number_format($salary->ot_rate, 2) }}</td>

                                    <td>₱{{ number_format($salary->honorarium, 2) }}</td>

                                    <td>{{ $salary->teaching_load }}</td>

                                    <td>₱{{ number_format($salary->sss, 2) }}</td>

                                    <td>₱{{ number_format($salary->philhealth, 2) }}</td>

                                    <td>₱{{ number_format($salary->pagibig, 2) }}</td>

                                    <td>₱{{ number_format($salary->hmo, 2) }}</td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="14" class="text-center py-5">

                                        <i class="bi bi-cash-stack display-4 text-muted"></i>

                                        <br><br>

                                        No salary configurations found.

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

                                    Salary Configuration Report

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

                                    Total Employees

                                </th>

                                <td>

                                    {{ $totalEmployees }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Average Salary

                                </th>

                                <td>

                                    ₱{{ number_format($averageBasicSalary, 2) }}

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

                PAP PAY - Salary Configuration Report

                <br>

                © {{ date('Y') }} All Rights Reserved.

            </small>

        </div>

    </div>

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
