<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Government Contributions Report</title>

<style>

body{
    font-family: DejaVu Sans,sans-serif;
    font-size:11px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    border:1px solid #000;
    padding:5px;
    text-align:center;
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
}

</style>

</head>

<body>

<div class="header">

<h2>PAP PAY</h2>

<h3>Government Contributions Report</h3>

<p>

Generated:

{{ now()->format('F d, Y h:i A') }}

</p>

</div>

<div class="summary">

<strong>Total Employees:</strong>

{{ $totalEmployees }}

<br>

<strong>Total SSS:</strong>

₱{{ number_format($totalSSS,2) }}

<br>

<strong>Total PhilHealth:</strong>

₱{{ number_format($totalPhilHealth,2) }}

<br>

<strong>Total Pag-IBIG:</strong>

₱{{ number_format($totalPagibig,2) }}

<br>

<strong>Total HMO:</strong>

₱{{ number_format($totalHMO,2) }}

<br>

<strong>Grand Total:</strong>

₱{{ number_format($grandTotal,2) }}

</div>

<table>

<thead>

<tr>

<th>ID</th>

<th>Name</th>

<th>Department</th>

<th>SSS</th>

<th>PhilHealth</th>

<th>Pag-IBIG</th>

<th>HMO</th>

<th>Total</th>

</tr>

</thead>

<tbody>

@foreach($contributions as $contribution)

@php
$total =
    $contribution->sss +
    $contribution->philhealth +
    $contribution->pagibig +
    $contribution->hmo;
@endphp

<tr>

<td>{{ optional($contribution->user)->employee_id }}</td>

<td>{{ optional($contribution->user)->name }}</td>

<td>{{ optional($contribution->user)->department }}</td>

<td>{{ number_format($contribution->sss,2) }}</td>

<td>{{ number_format($contribution->philhealth,2) }}</td>

<td>{{ number_format($contribution->pagibig,2) }}</td>

<td>{{ number_format($contribution->hmo,2) }}</td>

<td>{{ number_format($total,2) }}</td>

</tr>

@endforeach

</tbody>

</table>

<br><br>

<table style="width:100%;border:none;">

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

PAP PAY • Government Contributions Report

</div>

</body>

</html>