<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Register | Payroll Management</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-page: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --primary-blue: #2563eb;
            --status-green-bg: #dcfce7;
            --status-green-text: #15803d;
            --deduction-text: #dc2626;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-main);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 0.95rem;
            line-height: 1.5;
            min-height: 100vh;
            padding-bottom: 3rem;
        }

        /* Page Header */
        .page-header {
            border-bottom: 1px solid var(--border-color);
            background-color: #ffffff;
            padding: 1.25rem 0;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        /* Clean Enterprise Cards */
        .card-container {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-body-padding {
            padding: 1.25rem;
        }

        /* Form Labels & Styling */
        .filter-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.025em;
            margin-bottom: 0.35rem;
        }

        .form-control,
        .form-select {
            border-color: var(--border-color);
            color: var(--text-main);
            font-size: 0.9rem;
            padding: 0.55rem 0.75rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-filter {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.55rem 1rem;
        }

        /* High-Readability Data Table */
        .table-responsive {
            border-radius: 8px;
        }

        .payroll-table {
            color: var(--text-main);
            margin-bottom: 0;
            vertical-align: middle;
        }

        .payroll-table thead th {
            background-color: #f1f5f9;
            color: var(--text-secondary);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
            padding: 0.875rem 1rem;
            white-space: nowrap;
        }

        .payroll-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.15s ease;
        }

        .payroll-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .payroll-table td {
            padding: 1rem;
            white-space: nowrap;
            font-size: 0.95rem;
            border-bottom: 1px solid var(--border-color);
        }

        /* Employee ID Pill */
        .emp-id {
            font-weight: 600;
            color: var(--text-secondary);
            background-color: #f1f5f9;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.85rem;
            display: inline-block;
        }

        .emp-name {
            font-weight: 600;
            color: var(--text-main);
        }

        /* Numerical Formatting */
        .num-val {
            font-variant-numeric: tabular-nums;
        }

        .currency-symbol {
            color: var(--text-muted);
            font-weight: 400;
            margin-right: 2px;
        }

        .net-salary-val {
            font-weight: 700;
            color: var(--text-main);
        }

        .deduction-val {
            color: var(--deduction-text);
            font-weight: 500;
        }

        /* Status Badge */
        .badge-approved {
            background-color: var(--status-green-bg);
            color: var(--status-green-text);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35em 0.75em;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            text-transform: capitalize;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <div class="page-header">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="page-title">Payroll Register</h1>
                    <small class="text-muted">Filter and review employee pay period records</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container-fluid px-3 px-md-5">

        <!-- Filter Card -->
        <div class="card-container">
            <div class="card-body-padding">
                <form method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-12 col-md-3">
                            <label class="filter-label">Start Date</label>
                            <input type="date" name="start" class="form-control" value="{{ request('start') }}">
                        </div>

                        <div class="col-12 col-md-3">
                            <label class="filter-label">End Date</label>
                            <input type="date" name="end" class="form-control" value="{{ request('end') }}">
                        </div>

                        <div class="col-12 col-md-3">
                            <label class="filter-label">Department</label>
                            <select name="department" class="form-select">
                                <option value="">All Departments</option>

                                <option value="Administration"
                                    {{ request('department') == 'Administration' ? 'selected' : '' }}>
                                    Administration
                                </option>

                                <option value="Elementary"
                                    {{ request('department') == 'Elementary' ? 'selected' : '' }}>
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

                        <div class="col-12 col-md-3">
                            <button class="btn btn-primary btn-filter w-100">
                                Filter Results
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card-container">
            <div class="table-responsive">
                <table class="table payroll-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Department</th>
                            <th scope="col" class="text-end">Gross Salary</th>
                            <th scope="col" class="text-end">Benefits</th>
                            <th scope="col" class="text-end">Deductions</th>
                            <th scope="col" class="text-end">Net Salary</th>
                            <th scope="col" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payslips as $p)
                            <tr>
                                <td>
                                    <span class="emp-id">{{ $p->user->employee_id }}</span>
                                </td>
                                <td>
                                    <span class="emp-name">{{ $p->user->name }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary">{{ $p->user->department }}</span>
                                </td>
                                <td class="text-end num-val">
                                    ₱ {{ number_format($p->gross_salary, 2) }}
                                </td>
                                <td class="text-end num-val">
                                    ₱ {{ number_format($p->benefits, 2) }}
                                </td>
                                <td class="text-end num-val deduction-val">
                                    ₱
                                    {{ number_format(
                                        $p->sss + $p->philhealth + $p->pagibig + $p->hmo + $p->late_deduction + $p->undertime_deduction,
                                        2,
                                    ) }}
                                </td>
                                <td class="text-end num-val net-salary-val">
                                    ₱ {{ number_format($p->net_salary, 2) }}
                                </td>
                                <td class="text-center">
                                    <span class="badge-approved">
                                        {{ $p->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
