<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Batch - Payslip List</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-body: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --radius: 8px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            padding: 24px 16px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Header Layout */
        .header-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 20px 24px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .header-title h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .period-info {
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        .period-info strong {
            color: var(--text-main);
        }

        /* Redirect Button */
        .btn-redirect {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #ffffff;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .btn-redirect:hover {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            color: var(--primary-color);
        }

        /* Table Layout */
        .table-responsive {
            background: var(--card-bg);
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .payroll-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .payroll-table th,
        .payroll-table td {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .payroll-table th {
            background-color: #f1f5f9;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            font-weight: 600;
        }

        .payroll-table tr:last-child td {
            border-bottom: none;
        }

        .payroll-table tr:hover {
            background-color: #f8fafc;
        }

        .emp-name {
            font-weight: 600;
            color: var(--text-main);
        }

        .dept-badge {
            display: inline-block;
            background-color: #f1f5f9;
            color: #475569;
            font-size: 0.85rem;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 500;
        }

        .salary {
            font-weight: 600;
            color: #0f172a;
        }

        .btn-view {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 6px;
            background-color: #eff6ff;
            transition: background-color 0.2s ease;
        }

        .btn-view:hover {
            background-color: #dbeafe;
            color: var(--primary-hover);
        }

        /* Mobile View (under 640px) */
        @media (max-width: 640px) {
            .header-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-redirect {
                width: 100%;
                justify-content: center;
            }

            .payroll-table thead {
                display: none;
            }

            .payroll-table,
            .payroll-table tbody,
            .payroll-table tr,
            .payroll-table td {
                display: block;
                width: 100%;
            }

            .payroll-table tr {
                border-bottom: 1px solid var(--border-color);
                padding: 12px 16px;
            }

            .payroll-table tr:last-child {
                border-bottom: none;
            }

            .payroll-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border: none;
                padding: 8px 0;
            }

            .payroll-table td::before {
                content: attr(data-label);
                font-weight: 600;
                font-size: 0.85rem;
                color: var(--text-muted);
                text-transform: uppercase;
            }

            .action-td {
                margin-top: 8px;
                padding-top: 12px !important;
                border-top: 1px dashed var(--border-color) !important;
            }
        }

        .btn-paid {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    color: #166534;
    background-color: #dcfce7;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-paid:hover {
    background-color: #bbf7d0;
    color: #14532d;
}

.paid-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #166534;
    background-color: #dcfce7;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 6px 12px;
    border-radius: 6px;
}
    </style>
</head>

<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header-card">
            <div class="header-title">
                <h2>Payroll Batch</h2>
                <div class="period-info">
                    Period: <strong>{{ $period_start }}</strong> – <strong>{{ $period_end }}</strong>
                </div>
            </div>

            <!-- Redirect Back Button -->
            <a href="{{ route('payslip_list') }}" class="btn-redirect">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Payroll
            </a>
        </div>

        <!-- Payslips Table -->
        <div class="table-responsive">
            <table class="payroll-table">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Net Salary</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payslips as $payslip)
                        <tr>
                            <td data-label="Employee">
                                <span class="emp-name">{{ $payslip->user->first_name }}
                                    {{ $payslip->user->last_name }}</span>
                            </td>
                            <td data-label="Department">
                                <span class="dept-badge">{{ $payslip->user->department }}</span>
                            </td>
                            <td data-label="Net Salary">
                                <span class="salary">₱{{ number_format($payslip->net_salary, 2) }}</span>
                            </td>
                            <td data-label="Action" class="action-td" style="text-align: right;">

                                <div style="display: flex; gap: 8px; justify-content: flex-end; align-items: center;">

                                    {{-- VIEW --}}
                                    <a href="{{ route('admin.payslips.show', $payslip->id) }}" class="btn-view">

                                        <svg width="16" height="16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>

                                        </svg>

                                        View
                                    </a>


                                    {{-- PAID --}}
                                    @if ($payslip->status === 'Paid')
                                        <span class="paid-badge">
                                            ✓ Paid
                                        </span>
                                    @else
                                        <form action="{{ route('admin.payslips.markPaid', $payslip->id) }}"
                                            method="POST" style="margin: 0;"
                                            onsubmit="return confirm('Are you sure you want to mark this payslip as paid?');">

                                            @csrf

                                            <button type="submit" class="btn-paid">
                                                ✓ Mark as Paid
                                            </button>

                                        </form>
                                    @endif

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
