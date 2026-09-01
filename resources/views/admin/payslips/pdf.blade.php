    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="UTF-8">

        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                font-size: 12px;
                color: #333;
                margin: 0;
                padding: 0;
            }

            h2 {
                text-align: center;
                margin: 0 0 5px 0;
            }

            h4 {
                margin: 0;
            }

            .company {
                text-align: center;
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }

            td,
            th {
                border: 1px solid #555;
                padding: 7px;
            }

            th {
                background: #198754;
                color: #fff;
                text-align: left;
            }

            .section {
                margin-top: 20px;
            }

            .right {
                text-align: right;
            }

            .center {
                text-align: center;
            }

            .total-row td {
                font-weight: bold;
                font-size: 13px;
            }

            .net-salary {
                margin-top: 25px;
            }

            .net-salary td {
                border: 2px solid #198754;
                font-size: 15px;
                font-weight: bold;
            }

            .page-break {
                page-break-after: always;
            }
        </style>

    </head>


    <body>


        @foreach ($payslips as $payslip)
            {{-- =========================================================
            EMPLOYEE HEADER
        ========================================================== --}}

            <div class="company">

                <h2>Employee Payslip</h2>

                <strong>PAP PAY Payroll System</strong>

            </div>


            {{-- =========================================================
            EMPLOYEE INFORMATION
        ========================================================== --}}

            <table>

                <tr>

                    <td width="35%">
                        <strong>Employee</strong>
                    </td>

                    <td>
                        {{ $payslip->user->first_name }}
                        {{ $payslip->user->last_name }}
                    </td>

                </tr>


                <tr>

                    <td>
                        <strong>Employee ID</strong>
                    </td>

                    <td>
                        {{ $payslip->user->employee_id }}
                    </td>

                </tr>


                <tr>

                    <td>
                        <strong>Department</strong>
                    </td>

                    <td>
                        {{ $payslip->user->department }}
                    </td>

                </tr>


                <tr>

                    <td>
                        <strong>Payroll Period</strong>
                    </td>

                    <td>

                        {{ $payslip->period_start->format('M d, Y') }}

                        -

                        {{ $payslip->period_end->format('M d, Y') }}

                    </td>

                </tr>

            </table>



            {{-- =========================================================
            EARNINGS
        ========================================================== --}}

            <div class="section">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Earnings
                            </th>

                            <th width="30%">
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        {{-- PRESENT DAYS --}}

                        <tr>

                            <td>
                                Present Days
                            </td>

                            <td class="right">
                                {{ $payslip->present_days }}
                            </td>

                        </tr>


                        {{-- DAILY RATE --}}

                        <tr>

                            <td>
                                Daily Rate
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->daily_rate, 2) }}

                            </td>

                        </tr>


                        {{-- HOLIDAY PAY --}}

                        <tr>

                            <td>
                                Holiday Pay
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->holiday_pay, 2) }}

                            </td>

                        </tr>


                        {{-- OVERTIME --}}

                        <tr>

                            <td>
                                Overtime
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->ot, 2) }}

                            </td>

                        </tr>


                        {{-- HONORARIUM --}}

                        <tr>

                            <td>
                                Honorarium
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->honorarium, 2) }}

                            </td>

                        </tr>


                        {{-- TEACHING LOAD --}}

                        <tr>
                            <td>Teaching Load Pay</td>
                            <td class="right">
                                ₱ {{ number_format($payslip->teaching_load_pay ?? 0, 2) }}
                            </td>
                        </tr>


                        {{-- GROSS SALARY --}}

                        <tr class="total-row">

                            <td>
                                GROSS SALARY
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->gross_salary, 2) }}

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>



            {{-- =========================================================
            DEDUCTIONS
        ========================================================== --}}

            <div class="section">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Deductions
                            </th>

                            <th width="30%">
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        {{-- SSS --}}

                        <tr>

                            <td>
                                SSS
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->sss, 2) }}

                            </td>

                        </tr>


                        {{-- PHILHEALTH --}}

                        <tr>

                            <td>
                                PhilHealth
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->philhealth, 2) }}

                            </td>

                        </tr>


                        {{-- PAG-IBIG --}}

                        <tr>

                            <td>
                                Pag-IBIG
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->pagibig, 2) }}

                            </td>

                        </tr>


                        {{-- HMO --}}

                        <tr>

                            <td>
                                HMO
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->hmo, 2) }}

                            </td>

                        </tr>


                        {{-- LATE DEDUCTION --}}

                        <tr>

                            <td>
                                Late Deduction
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->late_deduction, 2) }}

                            </td>

                        </tr>


                        {{-- UNDERTIME DEDUCTION --}}

                        <tr>

                            <td>
                                Undertime Deduction
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->undertime_deduction, 2) }}

                            </td>

                        </tr>


                        {{-- TOTAL BENEFITS --}}

                        <tr class="total-row">

                            <td>
                                TOTAL BENEFITS
                            </td>

                            <td class="right">

                                ₱
                                {{ number_format($payslip->benefits, 2) }}

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>



            {{-- =========================================================
            TOTAL / NET SALARY
        ========================================================== --}}

            <div class="net-salary">

                <table>

                    <tr>

                        <td width="70%">
                            NET SALARY
                        </td>

                        <td class="right">

                            ₱
                            {{ number_format($payslip->net_salary, 2) }}

                        </td>

                    </tr>

                </table>

            </div>



            {{-- =========================================================
            PAGE BREAK
        ========================================================== --}}

            @if (!$loop->last)
                <div class="page-break"></div>
            @endif
        @endforeach


    </body>

    </html>
