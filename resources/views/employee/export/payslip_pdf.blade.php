<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Payslip</title>

    <style>

        @page {
            margin: 18px 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
            margin: 0;
            padding: 0;
        }

        .company {
            text-align: center;
            margin-bottom: 8px;
        }

        .company h2 {
            margin: 0 0 2px 0;
            font-size: 18px;
        }

        .company p {
            margin: 1px 0;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th,
        td {
            border: 1px solid #555;
            padding: 4px 6px;
            line-height: 1.15;
        }

        th {
            background: #e9ecef;
            color: #222;
            text-align: left;
            font-weight: bold;
        }

        .section-title {
            background: #d9d9d9;
            color: #222;
            font-weight: bold;
            padding: 5px 7px;
            margin-top: 7px;
            border: 1px solid #777;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .total-row {
            background: #eeeeee;
        }

        .total-row th,
        .total-row td {
            font-weight: bold;
        }

        .net-salary {
            margin-top: 8px;
        }

        .net-salary table {
            margin-top: 0;
        }

        .net-salary td {
            border: 2px solid #333;
            font-size: 13px;
            font-weight: bold;
            background: #eeeeee;
            padding: 6px;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 8px;
            color: #666;
        }

    </style>

</head>


<body>


    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="company">

        <h2>PAP PAY</h2>

        <p>
            <strong>Employee Payslip</strong>
        </p>

        <p>

            Payroll Period:

            {{ $payslip->period_start->format('F d, Y') }}

            -

            {{ $payslip->period_end->format('F d, Y') }}

        </p>

    </div>



    {{-- =========================================================
        EMPLOYEE INFORMATION
    ========================================================== --}}

    <div class="section-title">
        Employee Information
    </div>

    <table>

        <tr>

            <th width="35%">
                Employee ID
            </th>

            <td>
                {{ $payslip->user->employee_id }}
            </td>

        </tr>

        <tr>

            <th>
                Name
            </th>

            <td>

                {{ $payslip->user->first_name }}
                {{ $payslip->user->last_name }}

            </td>

        </tr>

        <tr>

            <th>
                Department
            </th>

            <td>
                {{ $payslip->user->department }}
            </td>

        </tr>

        <tr>

            <th>
                Position
            </th>

            <td>
                {{ $payslip->user->position ?? 'N/A' }}
            </td>

        </tr>

        <tr>

            <th>
                Payroll Period
            </th>

            <td>

                {{ $payslip->period_start->format('M d, Y') }}

                -

                {{ $payslip->period_end->format('M d, Y') }}

            </td>

        </tr>

    </table>



    {{-- =========================================================
        ATTENDANCE SUMMARY
    ========================================================== --}}

    <div class="section-title">
        Attendance Summary
    </div>

    <table>

        <tr>

            <th>
                Present Days
            </th>

            <td>
                {{ $payslip->present_days ?? 0 }}
            </td>

        </tr>

        <tr>

            <th>
                Worked Holidays
            </th>

            <td>
                {{ $payslip->worked_holidays ?? 0 }}
            </td>

        </tr>

        <tr>

            <th>
                Late Minutes
            </th>

            <td>
                {{ $payslip->late_minutes ?? 0 }}
            </td>

        </tr>

        <tr>

            <th>
                Undertime Minutes
            </th>

            <td>
                {{ $payslip->undertime_minutes ?? 0 }}
            </td>

        </tr>

        <tr>

            <th>
                Overtime Minutes
            </th>

            <td>
                {{ $payslip->overtime_minutes ?? 0 }}
            </td>

        </tr>

        <tr>

            <th>
                Overtime Hours
            </th>

            <td>
                {{ number_format($payslip->overtime_hours ?? 0, 2) }}
            </td>

        </tr>

    </table>



    {{-- =========================================================
        EARNINGS
    ========================================================== --}}

    <div class="section-title">
        Earnings
    </div>

    <table>

        <tr>

            <th>
                Present Days
            </th>

            <td class="right">

                {{ $payslip->present_days ?? 0 }}
                days

            </td>

        </tr>

        <tr>

            <th>
                Daily Rate
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->daily_rate ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Basic Pay
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->basic_pay ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Holiday Pay
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->holiday_pay ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Overtime
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->ot ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Honorarium
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->honorarium ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Teaching Load Pay
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->teaching_load_pay ?? 0, 2) }}

            </td>

        </tr>

        <tr class="total-row">

            <th>
                GROSS SALARY
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->gross_salary ?? 0, 2) }}

            </td>

        </tr>

    </table>



    {{-- =========================================================
        DEDUCTIONS
    ========================================================== --}}

    <div class="section-title">
        Deductions
    </div>

    <table>

        <tr>

            <th>
                SSS
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->sss ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                PhilHealth
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->philhealth ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Pag-IBIG
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->pagibig ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                HMO
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->hmo ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Late Deduction
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->late_deduction ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Undertime Deduction
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->undertime_deduction ?? 0, 2) }}

            </td>

        </tr>

        <tr class="total-row">

            <th>
                TOTAL BENEFITS
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->benefits ?? 0, 2) }}

            </td>

        </tr>

    </table>



    {{-- =========================================================
        SALARY SUMMARY
    ========================================================== --}}

    <div class="section-title">
        Salary Summary
    </div>

    <table>

        <tr>

            <th>
                Gross Salary
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->gross_salary ?? 0, 2) }}

            </td>

        </tr>

        <tr>

            <th>
                Benefits
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->benefits ?? 0, 2) }}

            </td>

        </tr>

        <tr class="total-row">

            <th>
                Net Salary
            </th>

            <td class="right">

                ₱ {{ number_format($payslip->net_salary ?? 0, 2) }}

            </td>

        </tr>

    </table>



    {{-- =========================================================
        NET SALARY
    ========================================================== --}}

    <div class="net-salary">

        <table>

            <tr>

                <td width="70%">
                    NET SALARY
                </td>

                <td class="right">

                    ₱ {{ number_format($payslip->net_salary ?? 0, 2) }}

                </td>

            </tr>

        </table>

    </div>



    {{-- =========================================================
        FOOTER
    ========================================================== --}}

    <div class="footer">

        This is a computer-generated payslip.

        <br>

        Generated on
        {{ now()->format('F d, Y h:i A') }}

    </div>


</body>

</html>
