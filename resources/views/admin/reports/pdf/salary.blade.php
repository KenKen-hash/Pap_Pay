<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Salary Report</title>

<style>

body{
font-family: DejaVu Sans,sans-serif;
font-size:12px;
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
border:1px solid #000;
padding:6px;
font-size:10px;
}

th{
background:#eeeeee;
}

.header{
text-align:center;
margin-bottom:20px;
}

.summary{
margin-bottom:20px;
}

.footer{
margin-top:30px;
text-align:center;
font-size:10px;
color:#666;
}

</style>

</head>

<body>

<div class="header">

<h2>PAP PAY</h2>

<h3>Salary Configuration Report</h3>

<p>

Generated:
{{ now()->format('F d, Y h:i A') }}

</p>

</div>

<div class="summary">

<strong>Total Employees:</strong>

{{ $totalEmployees }}

<br>

<strong>Total Basic Salary:</strong>

₱{{ number_format($totalBasicSalary,2) }}

<br>

<strong>Total Daily Rate:</strong>

₱{{ number_format($totalDailyRate,2) }}

<br>

<strong>Average Salary:</strong>

₱{{ number_format($averageBasicSalary,2) }}

</div>

<table>

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

<td>{{ optional($salary->user)->employee_id }}</td>

<td>{{ optional($salary->user)->name }}</td>

<td>{{ optional($salary->user)->department }}</td>

<td>{{ number_format($salary->basic_salary,2) }}</td>

<td>{{ number_format($salary->daily_rate,2) }}</td>

<td>{{ $salary->payroll_period }}</td>

<td>{{ number_format($salary->ot_rate,2) }}</td>

<td>{{ number_format($salary->honorarium,2) }}</td>

<td>{{ $salary->teaching_load }}</td>

<td>{{ number_format($salary->sss,2) }}</td>

<td>{{ number_format($salary->philhealth,2) }}</td>

<td>{{ number_format($salary->pagibig,2) }}</td>

<td>{{ number_format($salary->hmo,2) }}</td>

</tr>

@endforeach

</tbody>

</table>

<br><br>

<table style="border:none;width:100%;">

<tr>

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

PAP PAY • Salary Configuration Report

</div>

</body>

</html>