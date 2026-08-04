<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Leave Report</title>

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

        <h3>Leave Report</h3>

        <p>

            Generated:

            {{ now()->format('F d, Y h:i A') }}

        </p>

    </div>

    <div class="summary">

        <strong>Total Leave Requests:</strong>

        {{ $totalLeaves }}

        <br>

        <strong>Approved:</strong>

        {{ $approvedLeaves }}

        <br>

        <strong>Pending:</strong>

        {{ $pendingLeaves }}

        <br>

        <strong>Rejected:</strong>

        {{ $rejectedLeaves }}

    </div>

    <table>

        <thead>

            <tr>

                <th>Employee ID</th>

                <th>Name</th>

                <th>Department</th>

                <th>Leave Type</th>

                <th>Start Date</th>

                <th>End Date</th>

                <th>Days</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($leaves as $leave)
                <tr>

                    <td>{{ $leave->user->employee_id }}</td>

                    <td>{{ $leave->user->name }}</td>

                    <td>{{ $leave->user->department }}</td>

                    <td>{{ $leave->leave_type }}</td>

                    <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}</td>

                    <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}</td>

                    <td>{{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}
                    </td>

                    <td>{{ $leave->status }}</td>

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

        PAP PAY • Leave Report

    </div>

</body>

</html>
