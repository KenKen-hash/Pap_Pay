<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Employee Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 11px;
        }

        th {
            background: #eeeeee;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .summary {
            margin-bottom: 20px;
        }
    </style>

</head>

<body>

    <div class="header">

        <h2>PAP PAY</h2>

        <h3>Employee Report</h3>

        <p>

            Generated:

            {{ now()->format('F d, Y h:i A') }}

        </p>

    </div>

    <div class="summary">

        <strong>Total Employees:</strong>

        {{ $totalEmployees }}

        <br>

        <strong>Active Employees:</strong>

        {{ $activeEmployees }}

        <br>

        <strong>Inactive Employees:</strong>

        {{ $inactiveEmployees }}

    </div>

    <table>

        <thead>

            <tr>

                <th>Employee ID</th>

                <th>Name</th>

                <th>Department</th>

                <th>Email</th>

                <th>Contact Number</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($employees as $employee)
                <tr>

                    <td>{{ $employee->employee_id }}</td>

                    <td>{{ $employee->name }}</td>

                    <td>{{ $employee->department }}</td>

                    <td>{{ $employee->email }}</td>

                    <td>{{ $employee->contact_number }}</td>

                    <td>{{ $employee->status }}</td>

                </tr>
            @endforeach

        </tbody>

    </table>

    <br><br>

    <table width="100%" style="border:none;">

        <tr style="border:none;">

            <td style="border:none;text-align:center;">

                _________________________<br>

                Prepared By

            </td>

            <td style="border:none;text-align:center;">

                _________________________<br>

                Approved By

            </td>

        </tr>

    </table>

    <div class="footer">

        PAP PAY Employee Report

    </div>

</body>

</html>
