<!DOCTYPE html>
<html>

<head>

    <style>
        body {

            font-family: DejaVu Sans;

            font-size: 12px;

        }

        table {

            width: 100%;

            border-collapse: collapse;

        }

        th,
        td {

            border: 1px solid black;

            padding: 6px;

            text-align: center;

        }

        th {

            background: #eeeeee;

        }

        h2 {

            text-align: center;

            margin-bottom: 20px;

        }
    </style>

</head>

<body>

    <h2>

        Attendance Report

    </h2>

    <table>

        <thead>

            <tr>

                <th>Employee ID</th>

                <th>Name</th>

                <th>Date</th>

                <th>Morning In</th>

                <th>Morning Out</th>

                <th>Afternoon In</th>

                <th>Afternoon Out</th>

                <th>Work Hours</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($attendances as $attendance)
                <tr>

                    <td>

                        {{ $attendance->user->employee_id }}

                    </td>

                    <td>

                        {{ $attendance->user->name }}

                    </td>

                    <td>

                        {{ $attendance->date }}

                    </td>

                    <td>

                        {{ optional($attendance->morning_time_in)->format('h:i:s A') }}

                    </td>

                    <td>

                        {{ optional($attendance->morning_time_out)->format('h:i:s A') }}

                    </td>

                    <td>

                        {{ optional($attendance->afternoon_time_in)->format('h:i:s A') }}

                    </td>

                    <td>

                        {{ optional($attendance->afternoon_time_out)->format('h:i:s A') }}

                    </td>

                    <td>

                        {{ $attendance->hours_worked }}

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</body>

</html>
