
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Salary Report</title>

    <style>

        @page {
            size: Letter landscape;
            margin: 0.45in;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px 3px;
            font-size: 8px;
            line-height: 1.2;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        th {
            background: #eeeeee;
            font-weight: bold;
            text-align: center;
        }

        td {
            vertical-align: middle;
        }

        .header {
            text-align: center;
            margin-bottom: 12px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header h3 {
            margin: 3px 0;
            font-size: 13px;
        }

        .header p {
            margin: 4px 0 0;
            font-size: 9px;
        }

        .summary {
            margin-bottom: 12px;
            font-size: 9px;
            line-height: 1.5;
        }

        .report-table th:nth-child(1) {
            width: 7%;
        }

        .report-table th:nth-child(2) {
            width: 12%;
        }

        .report-table th:nth-child(3) {
            width: 12%;
        }

        .report-table th:nth-child(4) {
            width: 9%;
        }

        .report-table th:nth-child(5) {
            width: 8%;
        }

        .report-table th:nth-child(6) {
            width: 8%;
        }

        .report-table th:nth-child(7) {
            width: 7%;
        }

        .report-table th:nth-child(8) {
            width: 8%;
        }

        .report-table th:nth-child(9) {
            width: 8%;
        }

        .report-table th:nth-child(10),
        .report-table th:nth-child(11),
        .report-table th:nth-child(12),
        .report-table th:nth-child(13) {
            width: 5.25%;
        }

        .report-table td:nth-child(1),
        .report-table td:nth-child(4),
        .report-table td:nth-child(5),
        .report-table td:nth-child(6),
        .report-table td:nth-child(7),
        .report-table td:nth-child(8),
        .report-table td:nth-child(9),
        .report-table td:nth-child(10),
        .report-table td:nth-child(11),
        .report-table td:nth-child(12),
        .report-table td:nth-child(13) {
            text-align: center;
        }

        .signature {
            border: none;
            width: 100%;
            margin-top: 30px;
        }

        .signature td {
            border: none;
            text-align: center;
            font-size: 9px;
            padding: 0;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 8px;
            color: #666;
        }

    </style>

</head>

<body>

    <div class="header">

        <h2>Professional Academy of the Philippines</h2>

        <h3>Salary Configuration Report</h3>

        <p>

            Generated:
            {{ now()->format('F d, Y h:i A') }}

        </p>

    </div>

    <div class="summary">

        <strong>Total Employees:</strong>

        {{ $totalEmployees }}

        &nbsp;&nbsp;&nbsp;&nbsp;

        <strong>Total Basic Salary:</strong>

        ₱{{ number_format($totalBasicSalary,2) }}

        &nbsp;&nbsp;&nbsp;&nbsp;

        <strong>Total Daily Rate:</strong>

        ₱{{ number_format($totalDailyRate,2) }}

        &nbsp;&nbsp;&nbsp;&nbsp;

        <strong>Average Salary:</strong>

        ₱{{ number_format($averageBasicSalary,2) }}

    </div>

    <table class="report-table">

        <thead>

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Department</th>

                <th>Basic Salary</th>

                <th>Daily Rate</th>

                <th>Payroll</th>

                <th>OT</th>

                <th>Honorarium</th>

                <th>Teaching Load</th>

                <th>SSS</th>

                <th>PhilHealth</th>

                <th>Pag-IBIG</th>

                <th>HMO</th>

            </tr>

        </thead>

        <tbody>

            @foreach($salaries as $salary)

                <tr>

                    <td>
                        {{ optional($salary->user)->employee_id }}
                    </td>

                    <td>
                        {{ optional($salary->user)->name }}
                    </td>

                    <td>
                        {{ optional($salary->user)->department }}
                    </td>

                    <td>
                        {{ number_format($salary->basic_salary,2) }}
                    </td>

                    <td>
                        {{ number_format($salary->daily_rate,2) }}
                    </td>

                    <td>
                        {{ $salary->payroll_period }}
                    </td>

                    <td>
                        {{ number_format($salary->ot_rate,2) }}
                    </td>

                    <td>
                        {{ number_format($salary->honorarium,2) }}
                    </td>

                    <td>
                        {{ $salary->teaching_load }}
                    </td>

                    <td>
                        {{ number_format($salary->sss,2) }}
                    </td>

                    <td>
                        {{ number_format($salary->philhealth,2) }}
                    </td>

                    <td>
                        {{ number_format($salary->pagibig,2) }}
                    </td>

                    <td>
                        {{ number_format($salary->hmo,2) }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <table class="signature">

        <tr>

            <td>

                _________________________
                <br>
                Prepared By

            </td>

            <td>

                _________________________
                <br>
                Approved By

            </td>

        </tr>

    </table>

    <div class="footer">

        PAP PAY • Salary Configuration Report

    </div>

</body>

</html>

