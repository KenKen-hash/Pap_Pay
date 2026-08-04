<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Official Business Report</title>

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    border:1px solid #000;
    padding:6px;
    font-size:11px;
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

<h3>Official Business Report</h3>

<p>

Generated:

{{ now()->format('F d, Y h:i A') }}

</p>

</div>

<div class="summary">

<strong>Total Records:</strong>

{{ $totalOB }}

<br>

<strong>Approved:</strong>

{{ $approvedOB }}

<br>

<strong>Pending:</strong>

{{ $pendingOB }}

<br>

<strong>Rejected:</strong>

{{ $rejectedOB }}

</div>

<table>

<thead>

<tr>

<th>ID</th>

<th>Name</th>

<th>Department</th>

<th>Purpose</th>

<th>Destination</th>

<th>OB Date</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($obs as $ob)

<tr>

<td>{{ optional($ob->user)->employee_id }}</td>

<td>{{ optional($ob->user)->name }}</td>

<td>{{ optional($ob->user)->department }}</td>

<td>{{ $ob->purpose }}</td>

<td>{{ $ob->destination }}</td>

<td>{{ optional($ob->ob_date)->format('M d, Y') }}</td>

<td>{{ $ob->status }}</td>

</tr>

@endforeach

</tbody>

</table>

<br><br>

<table width="100%" style="border:none;">

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

PAP PAY • Official Business Report

</div>

</body>

</html>