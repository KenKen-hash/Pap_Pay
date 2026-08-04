<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Payroll Report</title>

<style>

body{

    font-family: DejaVu Sans, sans-serif;

    font-size:12px;

    color:#333;

}

.header{

    text-align:center;

    margin-bottom:20px;

}

.header h2{

    margin:0;

}

.header h4{

    margin:5px 0;

}

.info{

    margin-bottom:20px;

}

.info table{

    width:100%;

}

.report-table{

    width:100%;

    border-collapse:collapse;

}

.report-table th{

    background:#e9ecef;

    border:1px solid #000;

    padding:8px;

    font-size:11px;

}

.report-table td{

    border:1px solid #000;

    padding:6px;

    font-size:10px;

}

.text-right{

    text-align:right;

}

.text-center{

    text-align:center;

}

tfoot td{

    font-weight:bold;

    background:#f8f9fa;

}

.signature{

    margin-top:60px;

    width:100%;

}

.signature td{

    text-align:center;

}

.footer{

    position:fixed;

    bottom:0;

    width:100%;

    text-align:center;

    font-size:10px;

    color:#777;

}

</style>

</head>

<body>

<div class="header">

    <h2>YOUR SCHOOL NAME</h2>

    <h4>Payroll Report</h4>

    <p>

        Generated on {{ now()->format('F d, Y h:i A') }}

    </p>

</div>

<div class="info">

<table>

<tr>

<td>

<strong>Payroll Period:</strong>

{{ request('start') ?: 'All Records' }}

-

{{ request('end') ?: 'Present' }}

</td>

<td align="right">

<strong>Total Employees:</strong>

{{ $totalEmployees }}

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

<th>Period</th>

<th>Gross</th>

<th>Benefits</th>

<th>Deductions</th>

<th>Net</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($payslips as $pay)

@php

$deduction =
$pay->sss +
$pay->philhealth +
$pay->pagibig +
$pay->hmo +
$pay->late_deduction +
$pay->undertime_deduction;

@endphp

<tr>

<td>

{{ $pay->user->employee_id }}

</td>

<td>

{{ $pay->user->name }}

</td>

<td>

{{ $pay->user->department }}

</td>

<td>

{{ \Carbon\Carbon::parse($pay->period_start)->format('M d, Y') }}

<br>

{{ \Carbon\Carbon::parse($pay->period_end)->format('M d, Y') }}

</td>

<td class="text-right">

₱{{ number_format($pay->gross_salary,2) }}

</td>

<td class="text-right">

₱{{ number_format($pay->benefits,2) }}

</td>

<td class="text-right">

₱{{ number_format($deduction,2) }}

</td>

<td class="text-right">

₱{{ number_format($pay->net_salary,2) }}

</td>

<td class="text-center">

{{ $pay->status }}

</td>

</tr>

@endforeach

</tbody>

<tfoot>

<tr>

<td colspan="4" class="text-right">

TOTAL

</td>

<td class="text-right">

₱{{ number_format($grossPayroll,2) }}

</td>

<td class="text-right">

₱{{ number_format($totalBenefits,2) }}

</td>

<td class="text-right">

₱{{ number_format($totalDeductions,2) }}

</td>

<td class="text-right">

₱{{ number_format($netPayroll,2) }}

</td>

<td></td>

</tr>

</tfoot>

</table>

<table class="signature">

<tr>

<td>

________________________

<br>

Prepared By

</td>

<td>

________________________

<br>

Approved By

</td>

</tr>

</table>

<div class="footer">

Payroll Management System • Payroll Report

</div>

</body>

</html>