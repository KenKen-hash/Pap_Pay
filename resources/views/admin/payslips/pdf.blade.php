<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        h4 {
            margin: 0;
        }

        .company {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td,
        th {
            border: 1px solid #555;
            padding: 6px;
        }

        th {
            background: #198754;
            color: #fff;
        }

        .section {
            margin-top: 20px;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
    </style>

</head>

<body>

    @foreach ($payslips as $payslip)
        <div class="company">

            <h2>Employee Payslip</h2>

            <strong>PAP PAY Payroll System</strong>

        </div>

        <table>

            <tr>
                <td width="35%"><strong>Employee</strong></td>
                <td>{{ $payslip->user->first_name }} {{ $payslip->user->last_name }}</td>
            </tr>

            <tr>
                <td><strong>Employee ID</strong></td>
                <td>{{ $payslip->user->employee_id }}</td>
            </tr>

            <tr>
                <td><strong>Department</strong></td>
                <td>{{ $payslip->user->department }}</td>
            </tr>

            <tr>
                <td><strong>Payroll Period</strong></td>
                <td>
                    {{ $payslip->period_start->format('M d, Y') }}
                    -
                    {{ $payslip->period_end->format('M d, Y') }}
                </td>
            </tr>

        </table>

        <div class="section">

            <table>

                <thead>

                    <tr>

                        <th>Description</th>

                        <th width="30%">Amount</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>Present Days</td>
                        <td class="right">{{ $payslip->present_days }}</td>
                    </tr>

                    <tr>
                        <td>Daily Rate</td>
                        <td class="right">₱ {{ number_format($payslip->daily_rate, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Overtime</td>
                        <td class="right">₱ {{ number_format($payslip->ot, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Honorarium</td>
                        <td class="right">₱ {{ number_format($payslip->honorarium, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Teaching Load</td>
                        <td class="right">₱ {{ number_format($payslip->teaching_load, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Gross Salary</td>
                        <td class="right">
                            <strong>
                                ₱ {{ number_format($payslip->gross_salary, 2) }}
                            </strong>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <div class="section">

            <table>

                <thead>

                    <tr>

                        <th>Deductions</th>

                        <th width="30%">Amount</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>SSS</td>
                        <td class="right">₱ {{ number_format($payslip->sss, 2) }}</td>
                    </tr>

                    <tr>
                        <td>PhilHealth</td>
                        <td class="right">₱ {{ number_format($payslip->philhealth, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Pag-IBIG</td>
                        <td class="right">₱ {{ number_format($payslip->pagibig, 2) }}</td>
                    </tr>

                    <tr>
                        <td>HMO</td>
                        <td class="right">₱ {{ number_format($payslip->hmo, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Late Deduction</td>
                        <td class="right">₱ {{ number_format($payslip->late_deduction, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Undertime Deduction</td>
                        <td class="right">₱ {{ number_format($payslip->undertime_deduction, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Total Benefits</td>
                        <td class="right">
                            ₱ {{ number_format($payslip->benefits, 2) }}
                        </td>
                    </tr>

                    <tr>

                        <td>

                            <strong>NET SALARY</strong>

                        </td>

                        <td class="right">

                            <strong>

                                ₱ {{ number_format($payslip->net_salary, 2) }}

                            </strong>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>

</html>
