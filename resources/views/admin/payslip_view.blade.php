<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Payslip | Pap Pay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body {
            background: #f3f4f6;
            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Helvetica,
                Arial,
                sans-serif;
            color: #333;
        }

        .payslip-container {
            max-width: 1050px;
            margin: 40px auto;
        }

        .payslip-card {
            background: #fff;
            border: none;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        /* =========================================================
           HEADER
        ========================================================== */

        .payslip-header {
            text-align: center;
            padding: 30px 25px 25px;
            border-bottom: 1px solid #ddd;
        }

        .payslip-header h2 {
            margin: 0 0 6px;
            font-size: 28px;
            font-weight: 700;
            color: #222;
        }

        .payslip-header .company-name {
            font-size: 15px;
            font-weight: 600;
            color: #198754;
        }

        .payslip-header .subtitle {
            font-size: 13px;
            color: #777;
            margin-top: 5px;
        }

        /* =========================================================
           EMPLOYEE INFORMATION
        ========================================================== */

        .employee-info {
            padding: 25px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            border: 1px solid #555;
            padding: 10px 12px;
            font-size: 14px;
        }

        .info-table td:first-child {
            width: 35%;
            font-weight: 600;
            background: #f8f9fa;
        }

        /* =========================================================
           SECTION
        ========================================================== */

        .section {
            padding: 0 25px;
            margin-bottom: 25px;
        }

        .section-header {
            background: #198754;
            color: #fff;
            padding: 11px 14px;
            font-size: 15px;
            font-weight: 700;
            border: 1px solid #198754;
            border-radius: 4px 4px 0 0;
        }

        .section-header i {
            margin-right: 7px;
        }

        /* =========================================================
           PAYROLL TABLE
        ========================================================== */

        .payroll-table {
            width: 100%;
            border-collapse: collapse;
        }

        .payroll-table th,
        .payroll-table td {
            border: 1px solid #555;
            padding: 9px 12px;
            font-size: 14px;
        }

        .payroll-table th {
            background: #f8f9fa;
            color: #333;
            font-weight: 700;
            text-align: left;
        }

        .payroll-table th.amount-column {
            width: 30%;
            text-align: right;
        }

        .payroll-table td.amount {
            text-align: right;
            font-weight: 500;
        }

        .payroll-table .total-row td {
            font-weight: 700;
            font-size: 15px;
            background: #f8f9fa;
        }

        .payroll-table .earning td.amount {
            color: #198754;
        }

        .payroll-table .deduction td.amount {
            color: #dc3545;
        }

        /* =========================================================
           ATTENDANCE
        ========================================================== */

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .attendance-table th,
        .attendance-table td {
            border: 1px solid #555;
            padding: 9px 12px;
            font-size: 14px;
        }

        .attendance-table th {
            background: #198754;
            color: #fff;
            font-weight: 600;
        }

        .attendance-table td.amount {
            text-align: right;
        }

        /* =========================================================
           NET SALARY
        ========================================================== */

        .net-salary {
            margin: 30px 25px 25px;
        }

        .net-salary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .net-salary-table td {
            border: 2px solid #198754;
            padding: 15px;
            font-size: 20px;
            font-weight: 700;
        }

        .net-salary-table td:last-child {
            text-align: right;
            color: #198754;
        }

        .net-salary-label {
            color: #222;
        }

        /* =========================================================
           FOOTER
        ========================================================== */

        .payslip-footer {
            text-align: center;
            padding: 0 25px 25px;
            color: #777;
            font-size: 12px;
        }

        /* =========================================================
           BACK BUTTON
        ========================================================== */

        .top-actions {
            max-width: 1050px;
            margin: 20px auto 0;
            display: flex;
            justify-content: flex-end;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 767.98px) {

            body {
                background: #fff;
            }

            .payslip-container {
                margin: 0;
                width: 100%;
            }

            .payslip-card {
                border-radius: 0;
                box-shadow: none;
            }

            .top-actions {
                margin: 10px;
            }

            .top-actions a {
                width: 100%;
            }

            .payslip-header {
                padding: 25px 15px 20px;
            }

            .payslip-header h2 {
                font-size: 23px;
            }

            .employee-info,
            .section {
                padding-left: 15px;
                padding-right: 15px;
            }

            .info-table td,
            .payroll-table th,
            .payroll-table td,
            .attendance-table th,
            .attendance-table td {
                padding: 8px;
                font-size: 13px;
            }

            .info-table td:first-child {
                width: 40%;
            }

            .net-salary {
                margin-left: 15px;
                margin-right: 15px;
            }

            .net-salary-table td {
                padding: 12px;
                font-size: 17px;
            }

            /*
             * Allow wide payroll tables to scroll
             * instead of breaking the layout.
             */

            .table-responsive-custom {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .payroll-table,
            .attendance-table {
                min-width: 600px;
            }
        }

        @media print {

            body {
                background: #fff;
            }

            .top-actions {
                display: none;
            }

            .payslip-container {
                margin: 0;
                max-width: none;
            }

            .payslip-card {
                box-shadow: none;
                border-radius: 0;
            }

            .section,
            .employee-info,
            .net-salary {
                break-inside: avoid;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         BACK BUTTON
    ========================================================== -->

    <div class="top-actions">

        <a href="{{ route('admin.payslips.history', [
            'period_start' => $payslip->period_start->format('Y-m-d'),
            'period_end' => $payslip->period_end->format('Y-m-d'),
        ]) }}"
            class="btn btn-outline-success">

            <i class="bi bi-arrow-left me-2"></i>

            Back to Payslip History

        </a>

    </div>



    <!-- =========================================================
         MAIN PAYSLIP
    ========================================================== -->

    <div class="payslip-container">

        <div class="payslip-card">


            <!-- =====================================================
                 HEADER
            ====================================================== -->

            <div class="payslip-header">

                <h2>
                    Employee Payslip
                </h2>

                <div class="company-name">
                    PAP PAY Payroll System
                </div>

                <div class="subtitle">
                    Complete Payroll Breakdown & Summary
                </div>

            </div>



            <!-- =====================================================
                 EMPLOYEE INFORMATION
            ====================================================== -->

            <div class="employee-info">

                <table class="info-table">

                    <tr>

                        <td>
                            Employee
                        </td>

                        <td>

                            {{ $payslip->user->first_name }}
                            {{ $payslip->user->last_name }}

                        </td>

                    </tr>


                    <tr>

                        <td>
                            Employee ID
                        </td>

                        <td>
                            {{ $payslip->user->employee_id }}
                        </td>

                    </tr>


                    <tr>

                        <td>
                            Department
                        </td>

                        <td>
                            {{ $payslip->user->department }}
                        </td>

                    </tr>


                    <tr>

                        <td>
                            Payroll Period
                        </td>

                        <td>

                            {{ $payslip->period_start->format('M d, Y') }}

                            -

                            {{ $payslip->period_end->format('M d, Y') }}

                        </td>

                    </tr>

                </table>

            </div>



            <!-- =====================================================
                 EARNINGS
            ====================================================== -->

            <div class="section">

                <div class="section-header">

                    <i class="bi bi-plus-circle"></i>

                    Earnings

                </div>


                <div class="table-responsive-custom">

                    <table class="payroll-table">

                        <thead>

                            <tr>

                                <th>
                                    Earnings
                                </th>

                                <th class="amount-column">
                                    Amount
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <!-- PRESENT DAYS -->

                            <tr>

                                <td>
                                    Present Days
                                </td>

                                <td class="amount">

                                    {{ $payslip->present_days ?? 0 }}

                                </td>

                            </tr>


                            <!-- DAILY RATE -->

                            <tr>

                                <td>
                                    Daily Rate
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->daily_rate ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- HOLIDAY PAY -->

                            <tr class="earning">

                                <td>
                                    Holiday Pay
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->holiday_pay ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- OVERTIME -->

                            <tr class="earning">

                                <td>
                                    Overtime
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->ot ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- HONORARIUM -->

                            <tr class="earning">

                                <td>
                                    Honorarium
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->honorarium ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- =================================================
                                 TEACHING LOAD PAY
                            ================================================== -->

                            <tr class="earning">

                                <td>
                                    Teaching Load Pay
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->teaching_load_pay ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- GROSS SALARY -->

                            <tr class="total-row">

                                <td>
                                    GROSS SALARY
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->gross_salary ?? 0, 2) }}

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>



            <!-- =====================================================
                 DEDUCTIONS
            ====================================================== -->

            <div class="section">

                <div class="section-header">

                    <i class="bi bi-dash-circle"></i>

                    Deductions

                </div>


                <div class="table-responsive-custom">

                    <table class="payroll-table">

                        <thead>

                            <tr>

                                <th>
                                    Deductions
                                </th>

                                <th class="amount-column">
                                    Amount
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <!-- SSS -->

                            <tr class="deduction">

                                <td>
                                    SSS
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->sss ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- PHILHEALTH -->

                            <tr class="deduction">

                                <td>
                                    PhilHealth
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->philhealth ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- PAG-IBIG -->

                            <tr class="deduction">

                                <td>
                                    Pag-IBIG
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->pagibig ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- HMO -->

                            <tr class="deduction">

                                <td>
                                    HMO
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->hmo ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- LATE -->

                            <tr class="deduction">

                                <td>
                                    Late Deduction
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->late_deduction ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- UNDERTIME -->

                            <tr class="deduction">

                                <td>
                                    Undertime Deduction
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->undertime_deduction ?? 0, 2) }}

                                </td>

                            </tr>


                            <!-- TOTAL BENEFITS -->

                            <tr class="total-row">

                                <td>
                                    TOTAL BENEFITS
                                </td>

                                <td class="amount">

                                    ₱{{ number_format($payslip->benefits ?? 0, 2) }}

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>



            <!-- =====================================================
                 NET SALARY
            ====================================================== -->

            <div class="net-salary">

                <table class="net-salary-table">

                    <tr>

                        <td class="net-salary-label">

                            NET SALARY

                        </td>

                        <td>

                            ₱{{ number_format($payslip->net_salary ?? 0, 2) }}

                        </td>

                    </tr>

                </table>

            </div>



            <!-- =====================================================
                 FOOTER
            ====================================================== -->

            <div class="payslip-footer">

                <i class="bi bi-info-circle me-1"></i>

                This payslip contains the payroll information
                calculated for the selected payroll period.

            </div>


        </div>

    </div>


</body>

</html>
