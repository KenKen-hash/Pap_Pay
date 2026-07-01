<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Attendance Report</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Status</th>
            <th>Hours</th>
        </tr>
    </thead>

    <tbody>
        @foreach($attendances as $a)
        <tr>
            <td>{{ $a->user->employee_id }}</td>
            <td>{{ $a->user->name }}</td>
            <td>{{ $a->date }}</td>
            <td>{{ $a->status }}</td>
            <td>{{ $a->hours_worked }}</td>
        </tr>
        @endforeach
    </tbody>

</table>

</body>
</html>