<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Employee Payslip | PAP PAY</title>


    <link rel="icon" type="image/x-icon" href="../../../../khen/assets/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <style>

        /* =========================================================
           PAGE
        ========================================================== */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: #e9e9e9;
            font-family: Arial, Helvetica, sans-serif;
            color: #222;
        }

        body {
            padding: 20px 0;
        }


        /* =========================================================
           VARIABLES
        ========================================================== */

        :root {
            --brown: #8b5145;
            --brown-dark: #713f36;
            --brown-light: #f1e2de;
            --border: #8b5145;
            --line: #d9d0cd;
        }


        /* =========================================================
           TOP ACTION
        ========================================================== */

        .top-actions {
            width: 8.5in;
            margin: 0 auto 15px;
            display: flex;
            justify-content: flex-end;
        }

        .back-button {
            display: inline-block;
            padding: 8px 14px;
            background: #fff;
            color: var(--brown);
            border: 1px solid var(--brown);
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .back-button:hover {
            background: var(--brown);
            color: #fff;
        }


        /* =========================================================
           PAYSLIP CONTAINER

           Approx. 1/3 of a Letter/Bond paper:
           8.5in wide × 3.67in high
        ========================================================== */

        .payslip-container {
            width: 8.5in;
            height: 3.67in;
            margin: 0 auto;
            background: #fff;
            padding: 0.05in;
        }


        /* =========================================================
           PAYSLIP CARD
        ========================================================== */

        .payslip-card {
            width: 100%;
            height: 100%;
            border: 1.3px solid var(--border);
            background: #fff;
            overflow: hidden;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .payslip-header {
            height: 0.34in;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--brown-light);
            border-bottom: 1px solid var(--border);
            position: relative;
        }

        .school-name {
            margin: 0;
            color: var(--brown-dark);
            font-size: 18px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 0.3px;
            text-align: center;
        }

        .payslip-logo {
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            object-fit: contain;
        }


        /* =========================================================
           MAIN CONTENT
        ========================================================== */

        .payslip-body {
            height: calc(100% - 0.34in - 0.32in);
            display: grid;
            grid-template-columns: 1fr 1.08fr;
        }


        /* =========================================================
           LEFT / RIGHT COLUMNS
        ========================================================== */

        .left-column {
            border-right: 1px solid var(--border);
            padding: 5px 7px 3px 7px;
        }

        .right-column {
            padding: 5px 7px 3px 7px;
        }


        /* =========================================================
           INFORMATION ROWS
        ========================================================== */

        .info-row {
            display: grid;
            grid-template-columns: 1.05in auto;
            min-height: 0.175in;
            align-items: center;
            font-size: 10px;
            line-height: 1.05;
        }

        .info-label {
            font-weight: 600;
            white-space: nowrap;
        }

        .info-value {
            border-bottom: 1px dotted #bdbdbd;
            min-height: 13px;
            padding-left: 4px;
        }


        /* =========================================================
           RIGHT HEADER INFORMATION
        ========================================================== */

        .right-top-row {
            display: grid;
            grid-template-columns: 1fr 0.65in 1.35in;
            column-gap: 5px;
            min-height: 0.175in;
            align-items: center;
            font-size: 10px;
        }

        .right-top-item {
            display: grid;
            grid-template-columns: auto 1fr;
            column-gap: 4px;
            align-items: center;
        }

        .right-top-item .info-value {
            white-space: nowrap;
            overflow: hidden;
        }


        /* =========================================================
           TEACHING LOADS
        ========================================================== */

        .teaching-load-title {
            font-weight: 600;
            font-size: 10px;
            margin-top: 1px;
            margin-bottom: 1px;
        }

        .teaching-load-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        .teaching-load-table td {
            padding: 0;
            height: 12px;
            line-height: 11px;
        }

        .teaching-load-table td:first-child {
            width: 50%;
            padding-left: 63px;
            font-style: italic;
        }

        .teaching-load-table td:last-child {
            text-align: right;
            padding-right: 4px;
        }


        /* =========================================================
           LEFT PAY ITEMS
        ========================================================== */

        .pay-item {
            display: grid;
            grid-template-columns: 1.05in 1fr;
            min-height: 0.20in;
            align-items: center;
            font-size: 10px;
        }

        .pay-item-label {
            font-weight: 600;
            white-space: nowrap;
        }

        .pay-item-value {
            text-align: right;
            padding-right: 4px;
            min-height: 13px;
        }


        /* =========================================================
           RIGHT DEDUCTIONS
        ========================================================== */

        .deduction-item {
            display: grid;
            grid-template-columns: 0.85in 1fr;
            min-height: 0.185in;
            align-items: center;
            font-size: 9.8px;
        }

        .deduction-label {
            font-weight: 600;
        }

        .deduction-value {
            text-align: right;
            padding-right: 4px;
        }


        /* =========================================================
           LOANS
        ========================================================== */

        .loans-section {
            margin-top: 2px;
        }

        .loans-title {
            font-size: 9.8px;
            font-weight: 600;
            margin-bottom: 1px;
        }

        .loan-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        .loan-table th,
        .loan-table td {
            padding: 0 3px;
            height: 12px;
            line-height: 11px;
        }

        .loan-table th {
            font-weight: 700;
            text-align: right;
        }

        .loan-table th:first-child,
        .loan-table td:first-child {
            text-align: left;
        }

        .loan-table .loan-name {
            padding-left: 72px;
            font-style: italic;
        }

        .loan-table td {
            text-align: right;
        }


        /* =========================================================
           OTHER DEDUCTIONS
        ========================================================== */

        .other-deductions {
            margin-top: 2px;
        }

        .other-deductions-title {
            font-size: 9.8px;
            font-weight: 600;
            margin-bottom: 1px;
        }


        /* =========================================================
           GROSS / DEDUCTIONS LINE
        ========================================================== */

        .bottom-total-row {
            height: 0.32in;
            display: grid;
            grid-template-columns: 1fr 1.08fr;
            border-top: 1px solid var(--border);
        }

        .gross-pay {
            display: grid;
            grid-template-columns: 1fr 0.7in;
            align-items: center;
            padding: 0 7px;
            font-size: 10px;
            font-weight: 800;
        }

        .gross-value {
            text-align: right;
            padding-right: 3px;
        }

        .deductions-total {
            border-left: 1px solid var(--border);
            display: grid;
            grid-template-columns: 1fr 0.7in;
            align-items: center;
            padding: 0 7px;
            font-size: 10px;
            font-weight: 800;
        }

        .deductions-total-value {
            text-align: right;
        }


        /* =========================================================
           NET PAY
        ========================================================== */

        .net-pay-row {
            height: 0.32in;
            display: grid;
            grid-template-columns: 1.25in 1.0in 1fr;
            border-top: 1px solid var(--border);
        }

        .net-pay-label {
            background: var(--brown);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.3px;
        }

        .net-pay-amount {
            background: var(--brown-light);
            color: var(--brown);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 800;
            border-right: 1px solid var(--border);
        }

        .net-pay-empty {
            background: #fff;
        }


        /* =========================================================
           PRINT
        ========================================================== */

        @page {
            size: Letter portrait;
            margin: 0.15in;
        }

        @media print {

            html,
            body {
                background: #fff;
                margin: 0;
                padding: 0;
            }

            .top-actions {
                display: none;
            }

            .payslip-container {
                width: 8.5in;
                height: 3.67in;
                margin: 0;
                padding: 0;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            .payslip-card {
                page-break-inside: avoid;
                break-inside: avoid;
            }

            /*
             * Prevent the browser from adding unnecessary
             * margins/background effects while printing.
             */

            .payslip-header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .net-pay-label,
            .net-pay-amount {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

        }


        /* =========================================================
           SCREEN RESPONSIVE
        ========================================================== */

        @media screen and (max-width: 900px) {

            body {
                padding: 10px;
            }

            .top-actions {
                width: 100%;
            }

            .payslip-container {
                width: 100%;
                height: auto;
                min-width: 760px;
            }

        }

    </style>

</head>


<body>


@php

    /*
    |--------------------------------------------------------------------------
    | BASIC EMPLOYEE DATA
    |--------------------------------------------------------------------------
    */

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
    |
    | Basic Pay 1:
    |
    | Employee's configured monthly/basic salary
    | divided by 2 because payroll is processed
    | every 15 days.
    |
    */

    $configuredBasicSalary =
        data_get(
            $employee,
            'salaryConfig.basic_salary',
            data_get(
                $payslip,
                'basic_salary',
                0
            )
        );


    $basicPay1 =
        ((float) $configuredBasicSalary) / 2;


    /*
    |--------------------------------------------------------------------------
    | ACTUAL TEACHING LOADS
    |--------------------------------------------------------------------------
    |
    | Teaching loads are stored in the TeachingLoad table.
    |
    | IMPORTANT:
    |
    | The configured RATE is already the final amount.
    |
    | We DO NOT multiply:
    |
    |     Units × Rate
    |
    | Instead:
    |
    |     Teaching Load Rate ÷ 2
    |
    | because the payroll cycle is every 15 days.
    |
    */

    $teachingLoads =
        \App\Models\TeachingLoad::where(
            'user_id',
            $employee->id
        )
        ->orderBy('id')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | TEACHING LOAD BY DEPARTMENT
    |--------------------------------------------------------------------------
    |
    | Each department total is the sum of its configured
    | rate values, then divided by 2.
    |
    */

    $collegeLoad =
        (
            (float) $teachingLoads
                ->where('department', 'College')
                ->sum('rate')
        ) / 2;


    $shsLoad =
        (
            (float) $teachingLoads
                ->where('department', 'SHS')
                ->sum('rate')
        ) / 2;


    $jhsLoad =
        (
            (float) $teachingLoads
                ->where('department', 'JHS')
                ->sum('rate')
        ) / 2;


    $elementaryLoad =
        (
            (float) $teachingLoads
                ->where('department', 'Elementary')
                ->sum('rate')
        ) / 2;


    $kindergartenLoad =
        (
            (float) $teachingLoads
                ->where('department', 'Kindergarten')
                ->sum('rate')
        ) / 2;


    $nurseryLoad =
        (
            (float) $teachingLoads
                ->where('department', 'Nursery')
                ->sum('rate')
        ) / 2;


    /*
    |--------------------------------------------------------------------------
    | BASIC PAY 2
    |--------------------------------------------------------------------------
    |
    | Basic Pay 2 is the total configured teaching-load
    | RATE amount divided by 2.
    |
    | Units are intentionally NOT used in this calculation.
    |
    */

    $totalTeachingLoadRate =
        (float) $teachingLoads->sum('rate');


    $basicPay2 =
        $totalTeachingLoadRate / 2;


    /*
    |--------------------------------------------------------------------------
    | TOTAL TEACHING LOAD
    |--------------------------------------------------------------------------
    */

    $teachingLoadTotal =
        $basicPay2;


    /*
    |--------------------------------------------------------------------------
    | ALLOWANCES / OTHER EARNINGS
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

    $otHolidayPay = (
        data_get($payslip, 'ot', 0) +
        data_get($payslip, 'holiday_pay', 0)
    );

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

    $sss = data_get($payslip, 'sss', 0);

    $philhealth = data_get(
        $payslip,
        'philhealth',
        0
    );

    $pagibig = data_get(
        $payslip,
        'pagibig',
        0
    );

    $wtax = data_get(
        $payslip,
        'wtax',
        data_get($payslip, 'tax', 0)
    );

    $hmo = data_get(
        $payslip,
        'hmo',
        0
    );


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

    $sssLoanDeduction = data_get(
        $payslip,
        'sss_loan',
        0
    );

    $pagibigLoanBalance = data_get(
        $payslip,
        'pagibig_loan_balance',
        0
    );

    $pagibigLoanDeduction = data_get(
        $payslip,
        'pagibig_loan',
        0
    );

    $cashAdvanceBalance = data_get(
        $payslip,
        'cash_advance_balance',
        0
    );

    $cashAdvanceDeduction = data_get(
        $payslip,
        'cash_advance',
        0
    );


    /*
    |--------------------------------------------------------------------------
    | OTHER DEDUCTIONS
    |--------------------------------------------------------------------------
    */

    $otherDeductions = data_get(
        $payslip,
        'other_deductions',
        0
    );

    $lwopAbsent = data_get(
        $payslip,
        'lwop_absent',
        data_get($payslip, 'absent_deduction', 0)
    );

    $lateDeduction = data_get(
        $payslip,
        'late_deduction',
        0
    );

    $undertimeDeduction = data_get(
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

    $totalDeductions = data_get(
        $payslip,
        'total_deductions',
        data_get($payslip, 'benefits', 0)
    );

    $netPay = data_get(
        $payslip,
        'net_salary',
        0
    );


    /*
    |--------------------------------------------------------------------------
    | PAY DATE
    |--------------------------------------------------------------------------
    |
    | Pay Date is the actual date this payslip is being
    | generated/viewed.
    |
    */

    $payDate = now();

@endphp



<!-- =========================================================
     BACK BUTTON
========================================================== -->

<div class="top-actions">

    <a href="{{ route('admin.payslips.history', [
        'period_start' => $payslip->period_start->format('Y-m-d'),
        'period_end' => $payslip->period_end->format('Y-m-d'),
    ]) }}"
        class="back-button">

        ← Back to Payslip History

    </a>

</div>



<!-- =========================================================
     PAYSLIP
========================================================== -->

<div class="payslip-container">

    <div class="payslip-card">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="payslip-header">

            <img src="../../../khen/assets/images/PapLogo.png"
                class="payslip-logo"
                alt="PAP Logo">

            <h1 class="school-name">
                PROFESSIONAL ACADEMY OF THE PHILIPPINES
            </h1>

        </div>



        <!-- =====================================================
             MAIN CONTENT
        ====================================================== -->

        <div class="payslip-body">


            <!-- =================================================
                 LEFT COLUMN
            ================================================== -->

            <div class="left-column">


                <!-- EMPLOYEE ID -->

                <div class="info-row">

                    <div class="info-label">
                        Employee ID:
                    </div>

                    <div class="info-value">
                        {{ $employee->employee_id ?? 'N/A' }}
                    </div>

                </div>


                <!-- EMPLOYEE NAME -->

                <div class="info-row">

                    <div class="info-label">
                        Employee Name:
                    </div>

                    <div class="info-value">
                        {{ $employeeName }}
                    </div>

                </div>


                <!-- BASIC PAY 1 -->

                <div class="pay-item">

                    <div class="pay-item-label">
                        Basic Pay 1:
                    </div>

                    <div class="pay-item-value">
                        ₱{{ number_format($basicPay1, 2) }}
                    </div>

                </div>


                <!-- BASIC PAY 2 -->

                <div class="pay-item">

                    <div class="pay-item-label">
                        Basic Pay 2:
                    </div>

                    <div class="pay-item-value">
                        ₱{{ number_format($basicPay2, 2) }}
                    </div>

                </div>


                <!-- TEACHING LOADS -->

                <div class="teaching-load-title">
                    T. Loads:
                </div>

                <table class="teaching-load-table">

                    <tr>

                        <td>
                            College
                        </td>

                        <td>
                            ₱{{ number_format($collegeLoad, 2) }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            SHS
                        </td>

                        <td>
                            ₱{{ number_format($shsLoad, 2) }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            JHS
                        </td>

                        <td>
                            ₱{{ number_format($jhsLoad, 2) }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            Elementary
                        </td>

                        <td>
                            ₱{{ number_format($elementaryLoad, 2) }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            Kindergarten
                        </td>

                        <td>
                            ₱{{ number_format($kindergartenLoad, 2) }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            Nursery
                        </td>

                        <td>
                            ₱{{ number_format($nurseryLoad, 2) }}
                        </td>

                    </tr>

                </table>


                <!-- ALLOWANCES -->

                <div class="pay-item">

                    <div class="pay-item-label">
                        Allowances:
                    </div>

                    <div class="pay-item-value">
                        ₱{{ number_format($allowances, 2) }}
                    </div>

                </div>


                <!-- OTHER HONORARIUMS -->

                <div class="pay-item">

                    <div class="pay-item-label">
                        Other Honorariums:
                    </div>

                    <div class="pay-item-value">
                        ₱{{ number_format($honorarium, 2) }}
                    </div>

                </div>


                <!-- OT / HOLIDAY -->

                <div class="pay-item">

                    <div class="pay-item-label">
                        OT/Holiday Pay:
                    </div>

                    <div class="pay-item-value">
                        ₱{{ number_format($otHolidayPay, 2) }}
                    </div>

                </div>


                <!-- ADJUSTMENTS -->

                <div class="pay-item">

                    <div class="pay-item-label">
                        Adjustments:
                    </div>

                    <div class="pay-item-value">
                        ₱{{ number_format($adjustments, 2) }}
                    </div>

                </div>


            </div>



            <!-- =================================================
                 RIGHT COLUMN
            ================================================== -->

            <div class="right-column">


                <!-- PAY PERIOD / PAY DATE -->

                <div class="right-top-row">

                    <div class="right-top-item">

                        <div class="info-label">
                            Pay Period:
                        </div>

                        <div class="info-value">

                            {{ $payslip->period_start->format('M d, Y') }}
                            -
                            {{ $payslip->period_end->format('M d, Y') }}

                        </div>

                    </div>


                    <div></div>


                    <div class="right-top-item">

                        <div class="info-label">
                            Pay Date:
                        </div>

                        <div class="info-value">

                            {{ \Carbon\Carbon::parse($payDate)->format('M d, Y') }}

                        </div>

                    </div>

                </div>


                <!-- DESIGNATION -->

                <div class="info-row">

                    <div class="info-label">
                        Designation:
                    </div>

                    <div class="info-value">
                        {{ $employee->designation ?? $employee->position ?? $employee->employment_type ?? 'N/A' }}
                    </div>

                </div>


                <!-- SSS -->

                <div class="deduction-item">

                    <div class="deduction-label">
                        SSS:
                    </div>

                    <div class="deduction-value">
                        ₱{{ number_format($sss, 2) }}
                    </div>

                </div>


                <!-- PHILHEALTH -->

                <div class="deduction-item">

                    <div class="deduction-label">
                        PhilHealth:
                    </div>

                    <div class="deduction-value">
                        ₱{{ number_format($philhealth, 2) }}
                    </div>

                </div>


                <!-- PAG-IBIG -->

                <div class="deduction-item">

                    <div class="deduction-label">
                        Pag-IBIG:
                    </div>

                    <div class="deduction-value">
                        ₱{{ number_format($pagibig, 2) }}
                    </div>

                </div>


                <!-- WITHHOLDING TAX -->

                <div class="deduction-item">

                    <div class="deduction-label">
                        W. Tax:
                    </div>

                    <div class="deduction-value">
                        ₱{{ number_format($wtax, 2) }}
                    </div>

                </div>


                <!-- HMO -->

                <div class="deduction-item">

                    <div class="deduction-label">
                        HMO:
                    </div>

                    <div class="deduction-value">
                        ₱{{ number_format($hmo, 2) }}
                    </div>

                </div>


                <!-- LOANS -->

                <div class="loans-section">

                    <div class="loans-title">
                        Loans:
                    </div>

                    <table class="loan-table">

                        <thead>

                            <tr>

                                <th>
                                </th>

                                <th>
                                    Bal.
                                </th>

                                <th>
                                    Ded.
                                </th>

                            </tr>

                        </thead>

                        <tbody>


                            <!-- SSS LOAN -->

                            <tr>

                                <td class="loan-name">
                                    SSS
                                </td>

                                <td>
                                    ₱{{ number_format($sssLoanBalance, 2) }}
                                </td>

                                <td>
                                    ₱{{ number_format($sssLoanDeduction, 2) }}
                                </td>

                            </tr>


                            <!-- PAG-IBIG LOAN -->

                            <tr>

                                <td class="loan-name">
                                    Pag-IBIG
                                </td>

                                <td>
                                    ₱{{ number_format($pagibigLoanBalance, 2) }}
                                </td>

                                <td>
                                    ₱{{ number_format($pagibigLoanDeduction, 2) }}
                                </td>

                            </tr>


                            <!-- CASH ADVANCE -->

                            <tr>

                                <td class="loan-name">
                                    Cash Advance
                                </td>

                                <td>
                                    ₱{{ number_format($cashAdvanceBalance, 2) }}
                                </td>

                                <td>
                                    ₱{{ number_format($cashAdvanceDeduction, 2) }}
                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>


                <!-- OTHER DEDUCTIONS -->

                <div class="other-deductions">

                    <div class="other-deductions-title">
                        Other Deductions:
                    </div>

                    <div class="deduction-item">

                        <div class="deduction-label">
                        </div>

                        <div class="deduction-value">
                            ₱{{ number_format($otherDeductions, 2) }}
                        </div>

                    </div>

                </div>


                <!-- LWOP / ABSENT -->

                <div class="deduction-item">

                    <div class="deduction-label">
                        LWOP/Absent:
                    </div>

                    <div class="deduction-value">
                        ₱{{ number_format($lwopAbsent, 2) }}
                    </div>

                </div>


                <!-- LATE / UNDERTIME -->

                <div class="deduction-item">

                    <div class="deduction-label">
                        Late/Undertime:
                    </div>

                    <div class="deduction-value">

                        ₱{{ number_format(
                            $lateDeduction + $undertimeDeduction,
                            2
                        ) }}

                    </div>

                </div>


            </div>

        </div>



        <!-- =====================================================
             GROSS PAY / TOTAL DEDUCTIONS
        ====================================================== -->

        <div class="bottom-total-row">


            <!-- GROSS PAY -->

            <div class="gross-pay">

                <div>
                    GROSS PAY:
                </div>

                <div class="gross-value">
                    ₱{{ number_format($grossPay, 2) }}
                </div>

            </div>


            <!-- DEDUCTIONS -->

            <div class="deductions-total">

                <div>
                    DEDUCTIONS:
                </div>

                <div class="deductions-total-value">
                    ₱{{ number_format($totalDeductions, 2) }}
                </div>

            </div>

        </div>



        <!-- =====================================================
             NET PAY
        ====================================================== -->

        <div class="net-pay-row">


            <div class="net-pay-label">
                NET PAY
            </div>


            <div class="net-pay-amount">
                ₱{{ number_format($netPay, 2) }}
            </div>


            <div class="net-pay-empty"></div>


        </div>


    </div>

</div>


</body>

</html>
