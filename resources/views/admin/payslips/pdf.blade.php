<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Employee Payslip | PAP PAY</title>

    <style>

        @page {
            size: Letter portrait;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            color: #222222;
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
        }


        /*
        |--------------------------------------------------------------------------
        | LETTER PAGE
        |--------------------------------------------------------------------------
        */

        .page {
            width: 8.5in;
            height: 11in;
            margin: 0;
            padding: 0;
            page-break-after: always;
            overflow: hidden;
        }

        .page:last-child {
            page-break-after: auto;
        }


        /*
        |--------------------------------------------------------------------------
        | PAYSLIP POSITIONING
        |--------------------------------------------------------------------------
        |
        | Two payslips per Letter page.
        |
        | Top margin: 1 inch
        | Space between payslips: 1 inch
        |
        */

        .payslip-wrapper {
            width: 8.15in;
            height: 3.72in;
            margin-left: 0.175in;
            margin-top: 1in;
        }

        .payslip-wrapper + .payslip-wrapper {
            margin-top: 1in;
        }


        /*
        |--------------------------------------------------------------------------
        | MAIN PAYSLIP
        |--------------------------------------------------------------------------
        */

        .payslip {
            width: 8.15in;
            height: 3.72in;
            border: 1.2px solid #8b5145;
            border-collapse: collapse;
            table-layout: fixed;
            background: #ffffff;
        }


        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        .header {
            width: 100%;
            height: 0.38in;
            background: #f1e2de;
            border-bottom: 1px solid #8b5145;
            border-collapse: collapse;
        }

        .header-logo-cell {
            width: 0.48in;
            height: 0.38in;
            vertical-align: middle;
            text-align: center;
        }

        .header-logo {
            width: 0.30in;
            height: 0.30in;
            object-fit: contain;
        }

        .header-title-cell {
            height: 0.38in;
            vertical-align: middle;
            text-align: center;
            padding: 0 4px;
        }

        .school-name {
            margin: 0;
            padding: 0;
            color: #713f36;
            font-size: 15px;
            line-height: 18px;
            font-weight: bold;
            white-space: nowrap;
        }


        /*
        |--------------------------------------------------------------------------
        | MAIN BODY
        |--------------------------------------------------------------------------
        */

        .main-body {
            width: 100%;
            height: 2.76in;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .left-column {
            width: 49%;
            vertical-align: top;
            border-right: 1px solid #8b5145;
            padding: 4px 7px 2px 7px;
        }

        .right-column {
            width: 51%;
            vertical-align: top;
            padding: 4px 7px 2px 7px;
        }


        /*
        |--------------------------------------------------------------------------
        | STANDARD INFORMATION
        |--------------------------------------------------------------------------
        */

        .info-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .info-row {
            height: 0.17in;
        }

        .info-label {
            width: 1.05in;
            font-size: 8.5px;
            line-height: 10px;
            font-weight: bold;
            vertical-align: middle;
            white-space: nowrap;
        }

        .info-value {
            font-size: 8.5px;
            line-height: 10px;
            vertical-align: middle;
            border-bottom: 1px dotted #c5c5c5;
            padding-left: 3px;
            white-space: nowrap;
        }


        /*
        |--------------------------------------------------------------------------
        | PAY ITEMS
        |--------------------------------------------------------------------------
        */

        .pay-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .pay-row {
            height: 0.19in;
        }

        .pay-label {
            width: 1.05in;
            font-size: 8.5px;
            line-height: 10px;
            font-weight: bold;
            vertical-align: middle;
            white-space: nowrap;
        }

        .pay-value {
            font-size: 8.5px;
            line-height: 10px;
            text-align: right;
            vertical-align: middle;
            padding-right: 3px;
            white-space: nowrap;
        }


        /*
        |--------------------------------------------------------------------------
        | TEACHING LOAD
        |--------------------------------------------------------------------------
        */

        .section-title {
            font-size: 8.5px;
            line-height: 10px;
            font-weight: bold;
            padding-top: 1px;
            padding-bottom: 1px;
        }

        .teaching-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .teaching-row {
            height: 0.135in;
        }

        .teaching-name {
            width: 50%;
            padding-left: 50px;
            font-size: 7.8px;
            line-height: 9px;
            font-style: italic;
            vertical-align: middle;
        }

        .teaching-value {
            width: 50%;
            padding-right: 3px;
            font-size: 7.8px;
            line-height: 9px;
            text-align: right;
            vertical-align: middle;
        }


        /*
        |--------------------------------------------------------------------------
        | PAY PERIOD
        |--------------------------------------------------------------------------
        */

        .period-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .period-label {
            font-size: 8.2px;
            line-height: 10px;
            font-weight: bold;
            white-space: nowrap;
            vertical-align: middle;
        }

        .period-value {
            font-size: 8.2px;
            line-height: 10px;
            border-bottom: 1px dotted #c5c5c5;
            white-space: nowrap;
            vertical-align: middle;
            padding-left: 3px;
        }

        .period-left {
            width: 13%;
        }

        .period-left-value {
            width: 37%;
        }

        .period-date-label {
            width: 12%;
        }

        .period-date-value {
            width: 38%;
        }


        /*
        |--------------------------------------------------------------------------
        | DEDUCTIONS
        |--------------------------------------------------------------------------
        */

        .deductions-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .deduction-title-row {
            height: 0.17in;
        }

        .deduction-title {
            font-size: 8.5px;
            line-height: 10px;
            font-weight: bold;
        }

        .deduction-row {
            height: 0.175in;
        }

        .deduction-label {
            width: 1.0in;
            font-size: 8.2px;
            line-height: 10px;
            font-weight: bold;
            vertical-align: middle;
            white-space: nowrap;
        }

        .deduction-value {
            font-size: 8.2px;
            line-height: 10px;
            text-align: right;
            padding-right: 3px;
            vertical-align: middle;
            white-space: nowrap;
        }


        /*
        |--------------------------------------------------------------------------
        | LOANS
        |--------------------------------------------------------------------------
        */

        .loan-title-row {
            height: 0.16in;
        }

        .loan-title {
            font-size: 8.2px;
            line-height: 10px;
            font-weight: bold;
        }

        .loan-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .loan-header {
            height: 0.13in;
        }

        .loan-header td {
            font-size: 7.5px;
            line-height: 9px;
            font-weight: bold;
            text-align: right;
            vertical-align: middle;
        }

        .loan-header td:first-child {
            width: 55%;
        }

        .loan-header td:nth-child(2) {
            width: 22.5%;
        }

        .loan-header td:nth-child(3) {
            width: 22.5%;
        }

        .loan-row {
            height: 0.145in;
        }

        .loan-name {
            padding-left: 55px;
            font-size: 7.6px;
            line-height: 9px;
            font-style: italic;
            text-align: left;
            vertical-align: middle;
        }

        .loan-value {
            font-size: 7.6px;
            line-height: 9px;
            text-align: right;
            vertical-align: middle;
            white-space: nowrap;
        }


        /*
        |--------------------------------------------------------------------------
        | BOTTOM TOTALS
        |--------------------------------------------------------------------------
        */

        .totals {
            width: 100%;
            height: 0.30in;
            border-collapse: collapse;
            table-layout: fixed;
            border-top: 1px solid #8b5145;
        }

        .gross-cell {
            width: 49%;
            height: 0.30in;
            border-right: 1px solid #8b5145;
            vertical-align: middle;
            padding: 0 7px;
        }

        .deductions-total-cell {
            width: 51%;
            height: 0.30in;
            vertical-align: middle;
            padding: 0 7px;
        }

        .total-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .total-label {
            width: 70%;
            font-size: 8.5px;
            line-height: 10px;
            font-weight: bold;
        }

        .total-value {
            width: 30%;
            font-size: 8.5px;
            line-height: 10px;
            font-weight: bold;
            text-align: right;
            white-space: nowrap;
        }


        /*
        |--------------------------------------------------------------------------
        | NET PAY
        |--------------------------------------------------------------------------
        */

        .net-pay {
            width: 100%;
            height: 0.30in;
            border-collapse: collapse;
            table-layout: fixed;
            border-top: 1px solid #8b5145;
        }

        .net-label {
            width: 15%;
            height: 0.30in;
            background: #8b5145;
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
            line-height: 13px;
            font-weight: bold;
        }

        .net-amount {
            width: 18%;
            height: 0.30in;
            background: #f1e2de;
            color: #8b5145;
            border-right: 1px solid #8b5145;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
            line-height: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .net-empty {
            width: 67%;
            height: 0.30in;
            background: #ffffff;
        }


        /*
        |--------------------------------------------------------------------------
        | PRINT / DOMPDF
        |--------------------------------------------------------------------------
        */

        @media print {

            html,
            body {
                margin: 0;
                padding: 0;
                background: #ffffff;
            }

            .page {
                width: 8.5in;
                height: 11in;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            .payslip-wrapper {
                width: 8.15in;
                height: 3.72in;
                margin-left: 0.175in;
                margin-top: 1in;
            }

            .payslip-wrapper + .payslip-wrapper {
                margin-top: 1in;
            }

            .payslip,
            .header,
            .net-label,
            .net-amount {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

    </style>

</head>


<body>


@foreach ($payslips->chunk(2) as $pagePayslips)

    <div class="page">


        @foreach ($pagePayslips as $payslip)

            @php

                $employee = $payslip->user;

                $employeeName = trim(
                    ($employee->first_name ?? '') . ' ' .
                    ($employee->middle_name ?? '') . ' ' .
                    ($employee->last_name ?? '')
                );

                if ($employeeName === '') {
                    $employeeName = $employee->name ?? 'N/A';
                }


                /*
                |--------------------------------------------------------------------------
                | BASIC PAY
                |--------------------------------------------------------------------------
                */

                $configuredBasicSalary = data_get(
                    $employee,
                    'salaryConfig.basic_salary',
                    data_get(
                        $payslip,
                        'basic_salary',
                        0
                    )
                );

                $basicPay1 = ((float) $configuredBasicSalary) / 2;


                /*
                |--------------------------------------------------------------------------
                | TEACHING LOADS
                |--------------------------------------------------------------------------
                */

                $teachingLoads = \App\Models\TeachingLoad::where(
                    'user_id',
                    $employee->id
                )
                ->orderBy('id')
                ->get();


                $collegeLoad = (
                    (float) $teachingLoads
                        ->where('department', 'College')
                        ->sum('rate')
                ) / 2;


                $shsLoad = (
                    (float) $teachingLoads
                        ->where('department', 'SHS')
                        ->sum('rate')
                ) / 2;


                $jhsLoad = (
                    (float) $teachingLoads
                        ->where('department', 'JHS')
                        ->sum('rate')
                ) / 2;


                $elementaryLoad = (
                    (float) $teachingLoads
                        ->where('department', 'Elementary')
                        ->sum('rate')
                ) / 2;


                $kindergartenLoad = (
                    (float) $teachingLoads
                        ->where('department', 'Kindergarten')
                        ->sum('rate')
                ) / 2;


                $nurseryLoad = (
                    (float) $teachingLoads
                        ->where('department', 'Nursery')
                        ->sum('rate')
                ) / 2;


                $totalTeachingLoadRate =
                    (float) $teachingLoads->sum('rate');


                $basicPay2 =
                    $totalTeachingLoadRate / 2;


                /*
                |--------------------------------------------------------------------------
                | OTHER EARNINGS
                |--------------------------------------------------------------------------
                */

                $allowances = data_get(
                    $payslip,
                    'allowances',
                    0
                );


                $honorarium = data_get(
                    $payslip,
                    'honorarium',
                    0
                );


                $otHolidayPay =
                    data_get($payslip, 'ot', 0) +
                    data_get($payslip, 'holiday_pay', 0);


                $adjustments = data_get(
                    $payslip,
                    'adjustments',
                    0
                );


                /*
                |--------------------------------------------------------------------------
                | DEDUCTIONS
                |--------------------------------------------------------------------------
                */

                $sss = (
                    (float) data_get(
                        $payslip,
                        'sss',
                        0
                    )
                ) / 2;


                $philhealth = (
                    (float) data_get(
                        $payslip,
                        'philhealth',
                        0
                    )
                ) / 2;


                $pagibig = (
                    (float) data_get(
                        $payslip,
                        'pagibig',
                        0
                    )
                ) / 2;


                $wtax = (
                    (float) data_get(
                        $payslip,
                        'wtax',
                        data_get(
                            $payslip,
                            'tax',
                            0
                        )
                    )
                ) / 2;


                $hmo = (
                    (float) data_get(
                        $payslip,
                        'hmo',
                        0
                    )
                ) / 2;


                /*
                |--------------------------------------------------------------------------
                | LOANS
                |--------------------------------------------------------------------------
                */

                $sssLoanBalance = data_get(
                    $payslip,
                    'sss_loan_balance',
                    0
                );


                $sssLoanDeduction = (
                    (float) data_get(
                        $payslip,
                        'sss_loan',
                        0
                    )
                ) / 2;


                $pagibigLoanBalance = data_get(
                    $payslip,
                    'pagibig_loan_balance',
                    0
                );


                $pagibigLoanDeduction = (
                    (float) data_get(
                        $payslip,
                        'pagibig_loan',
                        0
                    )
                ) / 2;


                $cashAdvanceBalance = data_get(
                    $payslip,
                    'cash_advance_balance',
                    0
                );


                $cashAdvanceDeduction = (
                    (float) data_get(
                        $payslip,
                        'cash_advance',
                        0
                    )
                ) / 2;


                /*
                |--------------------------------------------------------------------------
                | OTHER DEDUCTIONS
                |--------------------------------------------------------------------------
                */

                $otherDeductions = (float) data_get(
                    $payslip,
                    'other_deductions',
                    0
                );


                $lwopAbsent = (float) data_get(
                    $payslip,
                    'lwop_absent',
                    data_get(
                        $payslip,
                        'absent_deduction',
                        0
                    )
                );


                $lateDeduction = (float) data_get(
                    $payslip,
                    'late_deduction',
                    0
                );


                $undertimeDeduction = (float) data_get(
                    $payslip,
                    'undertime_deduction',
                    0
                );


                /*
                |--------------------------------------------------------------------------
                | TOTALS
                |--------------------------------------------------------------------------
                */

                $grossPay = data_get(
                    $payslip,
                    'gross_salary',
                    0
                );


                $totalDeductions =
                    $sss +
                    $philhealth +
                    $pagibig +
                    $wtax +
                    $hmo +
                    $sssLoanDeduction +
                    $pagibigLoanDeduction +
                    $cashAdvanceDeduction +
                    $otherDeductions +
                    $lwopAbsent +
                    $lateDeduction +
                    $undertimeDeduction;


                $netPay = data_get(
                    $payslip,
                    'net_salary',
                    0
                );


                $payDate = now();

            @endphp


            <div class="payslip-wrapper">


                <table class="payslip">

                    <tr>

                        <td colspan="2" style="padding:0;">

                            <table class="header">

                                <tr>

                                    <td class="header-logo-cell">

                                        <img
                                            src="{{ public_path('khen/assets/images/PapLogo.png') }}"
                                            class="header-logo"
                                            alt="PAP Logo"
                                        >

                                    </td>

                                    <td class="header-title-cell">

                                        <div class="school-name">
                                            PROFESSIONAL ACADEMY OF THE PHILIPPINES
                                        </div>

                                    </td>

                                </tr>

                            </table>


                            <table class="main-body">

                                <tr>


                                    <td class="left-column">


                                        <table class="info-table">

                                            <tr class="info-row">

                                                <td class="info-label">
                                                    Employee ID:
                                                </td>

                                                <td class="info-value">
                                                    {{ $employee->employee_id ?? 'N/A' }}
                                                </td>

                                            </tr>


                                            <tr class="info-row">

                                                <td class="info-label">
                                                    Employee Name:
                                                </td>

                                                <td class="info-value">
                                                    {{ $employeeName }}
                                                </td>

                                            </tr>

                                        </table>


                                        <table class="pay-table">

                                            <tr class="pay-row">

                                                <td class="pay-label">
                                                    Basic Pay 1:
                                                </td>

                                                <td class="pay-value">
                                                    ₱{{ number_format($basicPay1, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="pay-row">

                                                <td class="pay-label">
                                                    Basic Pay 2:
                                                </td>

                                                <td class="pay-value">
                                                    ₱{{ number_format($basicPay2, 2) }}
                                                </td>

                                            </tr>

                                        </table>


                                        <div class="section-title">
                                            T. Loads:
                                        </div>


                                        <table class="teaching-table">

                                            <tr class="teaching-row">

                                                <td class="teaching-name">
                                                    College
                                                </td>

                                                <td class="teaching-value">
                                                    ₱{{ number_format($collegeLoad, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="teaching-row">

                                                <td class="teaching-name">
                                                    SHS
                                                </td>

                                                <td class="teaching-value">
                                                    ₱{{ number_format($shsLoad, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="teaching-row">

                                                <td class="teaching-name">
                                                    JHS
                                                </td>

                                                <td class="teaching-value">
                                                    ₱{{ number_format($jhsLoad, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="teaching-row">

                                                <td class="teaching-name">
                                                    Elementary
                                                </td>

                                                <td class="teaching-value">
                                                    ₱{{ number_format($elementaryLoad, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="teaching-row">

                                                <td class="teaching-name">
                                                    Kindergarten
                                                </td>

                                                <td class="teaching-value">
                                                    ₱{{ number_format($kindergartenLoad, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="teaching-row">

                                                <td class="teaching-name">
                                                    Nursery
                                                </td>

                                                <td class="teaching-value">
                                                    ₱{{ number_format($nurseryLoad, 2) }}
                                                </td>

                                            </tr>

                                        </table>


                                        <table class="pay-table">

                                            <tr class="pay-row">

                                                <td class="pay-label">
                                                    Allowances:
                                                </td>

                                                <td class="pay-value">
                                                    ₱{{ number_format($allowances, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="pay-row">

                                                <td class="pay-label">
                                                    Other Honorariums:
                                                </td>

                                                <td class="pay-value">
                                                    ₱{{ number_format($honorarium, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="pay-row">

                                                <td class="pay-label">
                                                    OT/Holiday Pay:
                                                </td>

                                                <td class="pay-value">
                                                    ₱{{ number_format($otHolidayPay, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="pay-row">

                                                <td class="pay-label">
                                                    Adjustments:
                                                </td>

                                                <td class="pay-value">
                                                    ₱{{ number_format($adjustments, 2) }}
                                                </td>

                                            </tr>

                                        </table>

                                    </td>


                                    <td class="right-column">


                                        <table class="period-table">

                                            <tr>

                                                <td class="period-label period-left">
                                                    Pay Period:
                                                </td>

                                                <td class="period-value period-left-value">

                                                    {{ $payslip->period_start->format('M d, Y') }}
                                                    -
                                                    {{ $payslip->period_end->format('M d, Y') }}

                                                </td>

                                                <td class="period-label period-date-label">
                                                    Pay Date:
                                                </td>

                                                <td class="period-value period-date-value">

                                                    {{ \Carbon\Carbon::parse($payDate)->format('M d, Y') }}

                                                </td>

                                            </tr>

                                        </table>


                                        <table class="info-table">

                                            <tr class="info-row">

                                                <td class="info-label">
                                                    Designation:
                                                </td>

                                                <td class="info-value">

                                                    {{ $employee->designation
                                                        ?? $employee->position
                                                        ?? $employee->employment_type
                                                        ?? 'N/A' }}

                                                </td>

                                            </tr>

                                        </table>


                                        <table class="deductions-table">

                                            <tr class="deduction-title-row">

                                                <td colspan="2" class="deduction-title">
                                                    Deductions:
                                                </td>

                                            </tr>


                                            <tr class="deduction-row">

                                                <td class="deduction-label">
                                                    SSS:
                                                </td>

                                                <td class="deduction-value">
                                                    ₱{{ number_format($sss, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="deduction-row">

                                                <td class="deduction-label">
                                                    PhilHealth:
                                                </td>

                                                <td class="deduction-value">
                                                    ₱{{ number_format($philhealth, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="deduction-row">

                                                <td class="deduction-label">
                                                    Pag-IBIG:
                                                </td>

                                                <td class="deduction-value">
                                                    ₱{{ number_format($pagibig, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="deduction-row">

                                                <td class="deduction-label">
                                                    W. Tax:
                                                </td>

                                                <td class="deduction-value">
                                                    ₱{{ number_format($wtax, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="deduction-row">

                                                <td class="deduction-label">
                                                    HMO:
                                                </td>

                                                <td class="deduction-value">
                                                    ₱{{ number_format($hmo, 2) }}
                                                </td>

                                            </tr>

                                        </table>


                                        <table class="loan-table">

                                            <tr class="loan-title-row">

                                                <td colspan="3" class="loan-title">
                                                    Loans:
                                                </td>

                                            </tr>


                                            <tr class="loan-header">

                                                <td></td>

                                                <td>
                                                    Bal.
                                                </td>

                                                <td>
                                                    Ded.
                                                </td>

                                            </tr>


                                            <tr class="loan-row">

                                                <td class="loan-name">
                                                    SSS
                                                </td>

                                                <td class="loan-value">
                                                    ₱{{ number_format($sssLoanBalance, 2) }}
                                                </td>

                                                <td class="loan-value">
                                                    ₱{{ number_format($sssLoanDeduction, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="loan-row">

                                                <td class="loan-name">
                                                    Pag-IBIG
                                                </td>

                                                <td class="loan-value">
                                                    ₱{{ number_format($pagibigLoanBalance, 2) }}
                                                </td>

                                                <td class="loan-value">
                                                    ₱{{ number_format($pagibigLoanDeduction, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="loan-row">

                                                <td class="loan-name">
                                                    Cash Advance
                                                </td>

                                                <td class="loan-value">
                                                    ₱{{ number_format($cashAdvanceBalance, 2) }}
                                                </td>

                                                <td class="loan-value">
                                                    ₱{{ number_format($cashAdvanceDeduction, 2) }}
                                                </td>

                                            </tr>

                                        </table>


                                        <table class="deductions-table">

                                            <tr class="deduction-row">

                                                <td class="deduction-label">
                                                    Other Deductions:
                                                </td>

                                                <td class="deduction-value">
                                                    ₱{{ number_format($otherDeductions, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="deduction-row">

                                                <td class="deduction-label">
                                                    LWOP/Absent:
                                                </td>

                                                <td class="deduction-value">
                                                    ₱{{ number_format($lwopAbsent, 2) }}
                                                </td>

                                            </tr>


                                            <tr class="deduction-row">

                                                <td class="deduction-label">
                                                    Late/Undertime:
                                                </td>

                                                <td class="deduction-value">

                                                    ₱{{ number_format(
                                                        $lateDeduction + $undertimeDeduction,
                                                        2
                                                    ) }}

                                                </td>

                                            </tr>

                                        </table>

                                    </td>

                                </tr>

                            </table>


                            <table class="totals">

                                <tr>

                                    <td class="gross-cell">

                                        <table class="total-table">

                                            <tr>

                                                <td class="total-label">
                                                    GROSS PAY:
                                                </td>

                                                <td class="total-value">
                                                    ₱{{ number_format($grossPay, 2) }}
                                                </td>

                                            </tr>

                                        </table>

                                    </td>


                                    <td class="deductions-total-cell">

                                        <table class="total-table">

                                            <tr>

                                                <td class="total-label">
                                                    DEDUCTIONS:
                                                </td>

                                                <td class="total-value">
                                                    ₱{{ number_format($totalDeductions, 2) }}
                                                </td>

                                            </tr>

                                        </table>

                                    </td>

                                </tr>

                            </table>


                            <table class="net-pay">

                                <tr>

                                    <td class="net-label">
                                        NET PAY
                                    </td>

                                    <td class="net-amount">
                                        ₱{{ number_format($netPay, 2) }}
                                    </td>

                                    <td class="net-empty">
                                    </td>

                                </tr>

                            </table>

                        </td>

                    </tr>

                </table>

            </div>

        @endforeach

    </div>

@endforeach


</body>

</html>
