<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Attendance Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header h4 {
            margin: 5px 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th {
            background: #e9ecef;
            border: 1px solid #000;
            padding: 8px;
            font-size: 11px;
        }

        .report-table td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        tfoot td {
            background: #f5f5f5;
            font-weight: bold;
        }

        .signature {
            margin-top: 60px;
            width: 100%;
        }

        .signature td {
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>

</head>

<body>

    <div class="header">

        <h2>YOUR SCHOOL NAME</h2>

        <h4>Attendance Report</h4>

        <p>

            Generated on {{ now()->format('F d, Y h:i A') }}

        </p>

    </div>

    <div class="info">

        <table>

            <tr>

                <td>

                    <strong>Date Range:</strong>

                    {{ request('start') ?: 'All Records' }}

                    -

                    {{ request('end') ?: 'Present' }}

                </td>

                <td align="right">

                    <strong>Total Records:</strong>

                    {{ $totalRecords }}

                </td>

            </tr>

        </table>

    </div>

    <table class="report-table">

        <thead>

            <tr>

                <th>ID</th>

                <th>Employee</th>

                <th>Department</th>

                <th>Date</th>

                <th>Morning In</th>

                <th>Morning Out</th>

                <th>Afternoon In</th>

                <th>Afternoon Out</th>

                <th>Hours</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($attendance as $record)
                <tr>

                    <td>

                        {{ $record->user->employee_id }}

                    </td>

                    <td>

                        {{ $record->user->name }}

                    </td>

                    <td>

                        {{ $record->user->department }}

                    </td>

                    <td>

                        {{ optional($record->date)->format('M d, Y') }}

                    </td>

                    <td>

                        {{ optional($record->morning_time_in)->format('h:i A') }}

                    </td>

                    <td>

                        {{ optional($record->morning_time_out)->format('h:i A') }}

                    </td>

                    <td>

                        {{ optional($record->afternoon_time_in)->format('h:i A') }}

                    </td>

                    <td>

                        {{ optional($record->afternoon_time_out)->format('h:i A') }}

                    </td>

                    <td class="text-center">

                        {{ number_format($record->hours_worked, 2) }}

                    </td>

                    <td class="text-center">

                        {{ $record->status }}

                    </td>

                </tr>
            @endforeach

        </tbody>

        <tfoot>

            <tr>

                <td colspan="8" class="text-right">

                    TOTAL HOURS WORKED

                </td>

                <td>

                    {{ number_format($totalHours, 2) }}

                </td>

                <td></td>

            </tr>

        </tfoot>

    </table>

    <br><br>

    <table width="100%">

        <tr>

            <td>

                <strong>Present:</strong>

                {{ $presentCount }}

            </td>

            <td>

                <strong>Late:</strong>

                {{ $lateCount }}

            </td>

            <td>

                <strong>Absent:</strong>

                {{ $absentCount }}

            </td>

        </tr>

    </table>

    <table class="signature">

        <tr>

            <td>

                __________________________

                <br>

                Prepared By

            </td>

            <td>

                __________________________

                <br>

                Approved By

            </td>

        </tr>

    </table>

    <div class="footer">

        PAP PAY • Attendance Report

    </div>

</body>

</html>
