<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Payslip</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 7px;
        }

        th {
            background: #f2f2f2;
            text-align: left;
        }

        .section-title {
            background: #e9ecef;
            font-weight: bold;
            padding: 8px;
            margin-top: 20px;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .total {
            background: #f5f5f5;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>PAP PAY</h2>
        <p>Employee Payslip</p>

        <p>
            Payroll Period:
            {{ $payslip->period_start->format('F d, Y') }}
            -
            {{ $payslip->period_end->format('F d, Y') }}
        </p>
    </div>


    <div class="section-title">
        Employee Information
    </div>

    <table>

        <tr>
            <th width="35%">Employee ID</th>
            <td>{{ $payslip->user->employee_id }}</td>
        </tr>

        <tr>
            <th>Name</th>
            <td>{{ $payslip->user->name }}</td>
        </tr>

        <tr>
            <th>Department</th>
            <td>{{ $payslip->user->department }}</td>
        </tr>

        <tr>
            <th>Position</th>
            <td>{{ $payslip->user->position }}</td>
        </tr>

    </table>


    <div class="section-title">
        Attendance Summary
    </div>

    <table>

        <tr>
            <th>Present Days</th>
            <td>{{ $payslip->present_days }}</td>
        </tr>

        <tr>
            <th>Late Minutes</th>
            <td>{{ $payslip->late_minutes }}</td>
        </tr>

        <tr>
            <th>Undertime Minutes</th>
            <td>{{ $payslip->undertime_minutes }}</td>
        </tr>

    </table>


    <div class="section-title">
        Earnings
    </div>

    <table>

        <tr>
            <th>Daily Rate</th>
            <td class="right">₱ {{ number_format($payslip->daily_rate,2) }}</td>
        </tr>

        <tr>
            <th>Overtime</th>
            <td class="right">₱ {{ number_format($payslip->ot,2) }}</td>
        </tr>

        <tr>
            <th>Honorarium</th>
            <td class="right">₱ {{ number_format($payslip->honorarium,2) }}</td>
        </tr>

        <tr>
            <th>Teaching Load</th>
            <td class="right">₱ {{ number_format($payslip->teaching_load,2) }}</td>
        </tr>

        <tr class="total">
            <th>Gross Salary</th>
            <td class="right">
                ₱ {{ number_format($payslip->gross_salary,2) }}
            </td>
        </tr>

    </table>


    <div class="section-title">
        Deductions
    </div>

    <table>

        <tr>
            <th>SSS</th>
            <td class="right">₱ {{ number_format($payslip->sss,2) }}</td>
        </tr>

        <tr>
            <th>PhilHealth</th>
            <td class="right">₱ {{ number_format($payslip->philhealth,2) }}</td>
        </tr>

        <tr>
            <th>Pag-IBIG</th>
            <td class="right">₱ {{ number_format($payslip->pagibig,2) }}</td>
        </tr>

        <tr>
            <th>HMO</th>
            <td class="right">₱ {{ number_format($payslip->hmo,2) }}</td>
        </tr>

        <tr>
            <th>Late Deduction</th>
            <td class="right">₱ {{ number_format($payslip->late_deduction,2) }}</td>
        </tr>

        <tr>
            <th>Undertime Deduction</th>
            <td class="right">₱ {{ number_format($payslip->undertime_deduction,2) }}</td>
        </tr>

    </table>


    <div class="section-title">
        Salary Summary
    </div>

    <table>

        <tr>
            <th>Benefits</th>
            <td class="right">
                ₱ {{ number_format($payslip->benefits,2) }}
            </td>
        </tr>

        <tr class="total">
            <th>Net Salary</th>
            <td class="right">
                ₱ {{ number_format($payslip->net_salary,2) }}
            </td>
        </tr>

    </table>


    <div class="footer">

        This is a computer-generated payslip.<br>

        Generated on {{ now()->format('F d, Y h:i A') }}

    </div>

</body>

</html>