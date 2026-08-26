<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Payslip</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f8fafc;
        }

        body {
            background-color: var(--bg-body);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .card {
            border: none;
        }

        .metric-card {
            transition: transform 0.15s ease-in-out;
        }

        .metric-card:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="py-4">

    <div class="container my-4">

        <div class="card shadow-sm rounded-3 overflow-hidden">

            <!-- Card Header with Redirect Button -->
            <div
                class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2 border-0">
                <div>
                    <h3 class="mb-0 fw-bold fs-4">Employee Payslip</h3>
                    <small class="text-white-50">Detailed Breakdown & Summary</small>
                </div>

                <!-- Redirect Button to Payslip History -->
                <div>
                    <a href="{{ route('admin.payslips.history', [
                        'period_start' => $payslip->period_start->format('Y-m-d'),
                        'period_end' => $payslip->period_end->format('Y-m-d'),
                    ]) }}"
                        class="btn btn-light border">

                        <i class="bi bi-arrow-left me-2"></i>
                        Back to Payslip History

                    </a>
                </div>

            </div>

            <div class="card-body p-4 bg-white">

                <!-- Employee Info Header -->
                <div class="d-flex justify-content-between align-items-center flex-wrap border-bottom pb-3 mb-4 gap-2">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small">Employee Name</span>
                        <h2 class="mb-0 fw-bold text-dark fs-3">
                            {{ $payslip->user->first_name }} {{ $payslip->user->last_name }}
                        </h2>
                    </div>
                    <div class="text-md-end">
                        <span class="text-uppercase text-muted fw-bold small d-block">Payroll Period</span>
                        <span class="badge bg-light text-dark fs-6 border px-3 py-2">
                            📅 {{ $payslip->period_start }} – {{ $payslip->period_end }}
                        </span>
                    </div>
                </div>

                <!-- Attendance Metrics Grid -->
                <h5 class="fw-bold text-secondary mb-3">Attendance & Time Logs</h5>
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <div class="p-3 bg-light rounded-3 border metric-card">
                            <span class="text-muted d-block small text-uppercase fw-semibold">Present Days</span>
                            <span class="fs-4 fw-bold text-dark">{{ $payslip->present_days }} <small
                                    class="fs-6 text-muted fw-normal">days</small></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 bg-light rounded-3 border metric-card">
                            <span class="text-muted d-block small text-uppercase fw-semibold">Late Minutes</span>
                            <span class="fs-4 fw-bold text-warning">{{ $payslip->late_minutes }} <small
                                    class="fs-6 text-muted fw-normal">mins</small></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 bg-light rounded-3 border metric-card">
                            <span class="text-muted d-block small text-uppercase fw-semibold">Undertime Minutes</span>
                            <span class="fs-4 fw-bold text-danger">{{ $payslip->undertime_minutes }} <small
                                    class="fs-6 text-muted fw-normal">mins</small></span>
                        </div>
                    </div>
                </div>

                <!-- Salary Summary Section -->
                <h5 class="fw-bold text-secondary mb-3">Salary Summary</h5>
                <div class="bg-light rounded-3 p-3 border mb-4">
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Gross Salary</span>
                        <span class="fw-semibold text-dark">₱{{ number_format($payslip->gross_salary, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Benefits</span>
                        <span class="fw-semibold text-success">+ ₱{{ number_format($payslip->benefits, 2) }}</span>
                    </div>
                </div>

                <!-- Net Salary Hero Card -->
                <div class="card border-success bg-success bg-opacity-10 text-success rounded-3">
                    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2 py-3">
                        <div>
                            <span class="text-uppercase fw-bold small d-block">Take Home Pay</span>
                            <h3 class="mb-0 fw-bold">Net Salary</h3>
                        </div>
                        <div class="fs-2 fw-bolder">
                            ₱{{ number_format($payslip->net_salary, 2) }}
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
