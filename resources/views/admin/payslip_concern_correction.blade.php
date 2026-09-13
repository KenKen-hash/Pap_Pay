@php
    $employee = $concern->user;
    $payslip = $concern->payslip;

    /*
    |--------------------------------------------------------------------------
    | Actual Payroll Values
    |--------------------------------------------------------------------------
    |
    | These values follow the variables used by PayrollController.
    |
    */

    $dailyRate = (float) ($payslip->daily_rate ?? 0);

    $presentDays = (int) ($payslip->present_days ?? 0);

    $basicPay = max(
        0,
        $dailyRate * $presentDays
    );

    $holidayPay = (float) ($payslip->holiday_pay ?? 0);

    $overtimePay = (float) ($payslip->ot ?? 0);

    /*
    |--------------------------------------------------------------------------
    | Current Payslip Storage
    |--------------------------------------------------------------------------
    |
    | In generatePayslips(), the current PayrollController stores
    | additional_earnings_total inside the "honorarium" column.
    |
    */

    $honorarium = (float) ($payslip->honorarium ?? 0);

    /*
    |--------------------------------------------------------------------------
    | Teaching Load
    |--------------------------------------------------------------------------
    */

    $teachingLoad = (float) (
        $payslip->teaching_load_pay
        ?? $payslip->teaching_load
        ?? 0
    );

    /*
    |--------------------------------------------------------------------------
    | Contributions
    |--------------------------------------------------------------------------
    */

    $sss = (float) ($payslip->sss ?? 0);
    $philhealth = (float) ($payslip->philhealth ?? 0);
    $pagibig = (float) ($payslip->pagibig ?? 0);
    $hmo = (float) ($payslip->hmo ?? 0);

    /*
    |--------------------------------------------------------------------------
    | Payroll Period / Benefit Divisor
    |--------------------------------------------------------------------------
    */

    $payrollPeriod = optional($employee->salaryConfig)->payroll_period;

    $isWeeklyPayroll =
        $employee->department === 'Laborers'
        || $payrollPeriod === 'Weekly';

    $benefitDivisor = $isWeeklyPayroll ? 4 : 2;

    /*
    |--------------------------------------------------------------------------
    | Current Stored Benefit Deduction
    |--------------------------------------------------------------------------
    */

    $benefits = (float) (
        $payslip->benefits
        ?? (
            (
                $sss
                + $philhealth
                + $pagibig
                + $hmo
            ) / $benefitDivisor
        )
    );

    /*
    |--------------------------------------------------------------------------
    | Attendance
    |--------------------------------------------------------------------------
    */

    $lateMinutes = (int) ($payslip->late_minutes ?? 0);
    $undertimeMinutes = (int) ($payslip->undertime_minutes ?? 0);
    $overtimeMinutes = (int) ($payslip->overtime_minutes ?? 0);

    $overtimeHours = (float) (
        $payslip->overtime_hours
        ?? ($overtimeMinutes / 60)
    );

    /*
    |--------------------------------------------------------------------------
    | Deductions
    |--------------------------------------------------------------------------
    */

    $lateDeduction = (float) (
        $payslip->late_deduction ?? 0
    );

    $undertimeDeduction = (float) (
        $payslip->undertime_deduction ?? 0
    );

    /*
    |--------------------------------------------------------------------------
    | Original Payroll Totals
    |--------------------------------------------------------------------------
    */

    $originalGross = (float) (
        $payslip->gross_salary
        ?? (
            $basicPay
            + $holidayPay
            + $overtimePay
            + $honorarium
            + $teachingLoad
        )
    );

    $originalNet = (float) (
        $payslip->net_salary
        ?? (
            $originalGross
            - $benefits
            - $lateDeduction
            - $undertimeDeduction
        )
    );
@endphp


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Correct and review employee payslip information"
    >

    <title>Correct Payslip | Pap Pay</title>

    <link
        rel="stylesheet"
        href="{{ asset('khen/assets/css/bootstrap.min.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('khen/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}"
    >

    <style>

        /* =========================================================
           BASE
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html {
            width: 100%;
            min-height: 100%;
            overflow-x: hidden;
        }

        body {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;

            background:
                linear-gradient(
                    135deg,
                    #f7f9fc 0%,
                    #eef4ff 50%,
                    #f8fafc 100%
                );

            color: #172033;

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        a {
            text-decoration: none;
        }

        button,
        input,
        textarea,
        select {
            font: inherit;
        }

        /* =========================================================
           PAGE
        ========================================================= */

        .correction-page {
            width: 100%;
            min-height: 100vh;
            padding: 28px 20px 50px;
        }

        .correction-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        /* =========================================================
           TOP NAVIGATION
        ========================================================= */

        .page-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;
            margin-bottom: 22px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 43px;
            padding: 9px 15px;

            border: 1px solid #d7dee9;
            border-radius: 10px;

            background: rgba(255, 255, 255, .92);

            color: #344054;

            font-size: 13px;
            font-weight: 750;

            transition: .2s ease;
        }

        .back-button:hover {
            background: #ffffff;
            border-color: #b8c4d5;
            color: #172033;
            transform: translateX(-2px);
        }

        .page-label {
            display: flex;
            align-items: center;
            gap: 9px;

            color: #667085;

            font-size: 12px;
            font-weight: 700;
        }

        .page-label-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 36px;
            height: 36px;

            border-radius: 10px;

            background: #e8f0ff;
            color: #2563eb;

            font-size: 17px;
        }

        /* =========================================================
           HERO
        ========================================================= */

        .correction-header {
            position: relative;
            overflow: hidden;

            margin-bottom: 22px;
            padding: 28px 30px;

            border: 1px solid #d9e5fa;
            border-radius: 19px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb 0%,
                    #1d4ed8 100%
                );

            color: #ffffff;

            box-shadow:
                0 14px 35px rgba(37, 99, 235, .16);
        }

        .correction-header::before {
            content: "";

            position: absolute;

            width: 240px;
            height: 240px;

            right: -90px;
            top: -120px;

            border-radius: 50%;

            background: rgba(255, 255, 255, .08);

            pointer-events: none;
        }

        .correction-header::after {
            content: "";

            position: absolute;

            width: 150px;
            height: 150px;

            right: 90px;
            bottom: -105px;

            border-radius: 50%;

            background: rgba(255, 255, 255, .05);

            pointer-events: none;
        }

        .header-content {
            position: relative;
            z-index: 1;

            display: flex;
            align-items: center;

            gap: 16px;
        }

        .header-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 54px;
            height: 54px;

            flex: 0 0 54px;

            border-radius: 14px;

            background: rgba(255, 255, 255, .14);

            font-size: 25px;
        }

        .header-eyebrow {
            margin-bottom: 4px;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: .09em;

            opacity: .78;
        }

        .header-title {
            margin: 0;

            font-size: clamp(1.45rem, 2.5vw, 2rem);
            font-weight: 850;

            line-height: 1.2;
        }

        .header-description {
            margin: 7px 0 0;

            max-width: 720px;

            color: rgba(255, 255, 255, .78);

            font-size: 13px;
            line-height: 1.6;
        }

        /* =========================================================
           ALERTS
        ========================================================= */

        .alert {
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 18px;

            box-shadow:
                0 5px 18px rgba(15, 23, 42, .04);
        }

        .alert ul {
            padding-left: 20px;
        }

        /* =========================================================
           CARDS
        ========================================================= */

        .content-card {
            width: 100%;
            overflow: hidden;

            border: 1px solid #e0e7f0;
            border-radius: 16px;

            background: #ffffff;

            box-shadow:
                0 8px 27px rgba(15, 23, 42, .05);
        }

        .content-card + .content-card {
            margin-top: 18px;
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 17px 21px;

            border-bottom: 1px solid #edf1f6;

            background: #ffffff;

            color: #182230;

            font-size: 15px;
            font-weight: 800;
        }

        .card-header-title {
            display: flex;
            align-items: center;
            gap: 8px;

            min-width: 0;
        }

        .card-header-title i {
            color: #2563eb;
        }

        .card-body-custom {
            padding: 21px;
        }

        /* =========================================================
           EMPLOYEE
        ========================================================= */

        .employee-layout {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 25px;
        }

        .employee-profile {
            display: flex;
            align-items: center;
            gap: 15px;

            min-width: 0;
        }

        .employee-avatar {
            width: 72px;
            height: 72px;

            flex: 0 0 72px;

            object-fit: cover;

            border: 3px solid #edf3ff;
            border-radius: 50%;

            box-shadow:
                0 5px 15px rgba(15, 23, 42, .08);
        }

        .employee-details {
            min-width: 0;
        }

        .employee-name {
            margin: 0 0 4px;

            color: #172033;

            font-size: 18px;
            font-weight: 800;

            overflow-wrap: anywhere;
        }

        .employee-position {
            margin: 0 0 9px;

            color: #667085;

            font-size: 13px;
        }

        .employee-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .employee-tag {
            display: inline-flex;
            align-items: center;

            min-height: 27px;
            padding: 4px 9px;

            border-radius: 7px;

            background: #f2f4f7;
            color: #475467;

            font-size: 11px;
            font-weight: 750;
        }

        .employee-tag.department {
            background: #eaf2ff;
            color: #1d4ed8;
        }

        .period-box {
            flex: 0 0 auto;

            padding: 13px 16px;

            border: 1px solid #e6ebf2;
            border-radius: 11px;

            background: #f8fafc;

            text-align: right;
        }

        .period-label {
            margin-bottom: 4px;

            color: #8a94a6;

            font-size: 10px;
            font-weight: 750;

            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .period-value {
            color: #344054;

            font-size: 13px;
            font-weight: 800;

            white-space: nowrap;
        }

        .concern-status {
            display: inline-flex;
            align-items: center;

            margin-top: 7px;
            padding: 5px 9px;

            border-radius: 999px;

            background: #fff4cc;
            color: #8a5a00;

            font-size: 10px;
            font-weight: 800;
        }

        /* =========================================================
           CONCERN
        ========================================================= */

        .concern-box {
            padding: 16px;

            border-left: 4px solid #f59e0b;
            border-radius: 9px;

            background: #fff8e1;

            color: #4b5563;

            font-size: 13px;
            line-height: 1.7;

            overflow-wrap: anywhere;
        }

        .concern-title {
            margin-bottom: 7px;

            color: #344054;

            font-size: 13px;
            font-weight: 800;
        }

        .attachment-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;

            gap: 10px;

            margin-top: 17px;
            padding-top: 17px;

            border-top: 1px solid #edf1f6;
        }

        .attachment-label {
            color: #475467;

            font-size: 12px;
            font-weight: 750;
        }

        /* =========================================================
           ORIGINAL PAYSLIP
        ========================================================= */

        .original-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 12px;
        }

        .original-item {
            padding: 14px;

            border: 1px solid #edf0f4;
            border-radius: 10px;

            background: #fbfcfe;
        }

        .item-label {
            display: block;

            margin-bottom: 5px;

            color: #8a94a6;

            font-size: 10px;
            font-weight: 750;

            text-transform: uppercase;
            letter-spacing: .035em;
        }

        .item-value {
            display: block;

            color: #253044;

            font-size: 14px;
            font-weight: 800;

            overflow-wrap: anywhere;
        }

        /* =========================================================
           CALCULATION CARDS
        ========================================================= */

        .section-description {
            margin: -4px 0 18px;

            color: #8a94a6;

            font-size: 12px;
            line-height: 1.55;
        }

        .field-label {
            display: block;

            margin-bottom: 7px;

            color: #344054;

            font-size: 12px;
            font-weight: 800;
        }

        .amount-input {
            font-weight: 700;
        }

        .input-group-text {
            min-width: 43px;

            justify-content: center;

            border-color: #d9e0e9;

            background: #f8fafc;

            color: #667085;

            font-weight: 700;
        }

        .form-control {
            min-height: 44px;

            border-color: #d9e0e9;
            border-radius: 9px;

            color: #344054;

            font-size: 13px;

            box-shadow: none;
        }

        .input-group .form-control {
            border-radius: 0 9px 9px 0;
        }

        .form-control:focus {
            border-color: #7da2e8;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .10);
        }

        .original-value {
            margin-top: 6px;

            color: #8a94a6;

            font-size: 10px;
            line-height: 1.4;
        }

        .field-help {
            display: block;

            margin-top: 6px;

            color: #8a94a6;

            font-size: 10px;
            line-height: 1.45;
        }

        /* =========================================================
           LIVE PREVIEW
        ========================================================= */

        .summary-card {
            overflow: hidden;

            border: 1px solid #dbe5f3;
            border-radius: 16px;

            background:
                linear-gradient(
                    135deg,
                    #f8fbff 0%,
                    #ffffff 100%
                );

            box-shadow:
                0 8px 27px rgba(15, 23, 42, .045);
        }

        .summary-header {
            display: flex;
            align-items: center;
            gap: 8px;

            padding: 17px 21px;

            border-bottom: 1px solid #e5ebf3;

            color: #182230;

            font-size: 15px;
            font-weight: 800;
        }

        .summary-header i {
            color: #2563eb;
        }

        .summary-body {
            padding: 21px;
        }

        .summary-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 12px;
        }

        .summary-item {
            padding: 15px;

            border: 1px solid #e7edf5;
            border-radius: 11px;

            background: rgba(255, 255, 255, .85);
        }

        .summary-label {
            margin-bottom: 6px;

            color: #8a94a6;

            font-size: 10px;
            font-weight: 750;

            text-transform: uppercase;
            letter-spacing: .035em;
        }

        .summary-value {
            color: #253044;

            font-size: 17px;
            font-weight: 850;
        }

        .summary-value.deduction {
            color: #dc2626;
        }

        .summary-value.net {
            color: #15803d;

            font-size: 21px;
        }

        /* =========================================================
           RESPONSE
        ========================================================= */

        .response-help {
            margin: -3px 0 15px;

            color: #8a94a6;

            font-size: 12px;
            line-height: 1.55;
        }

        textarea.form-control {
            min-height: 125px;

            resize: vertical;

            border-radius: 10px;
        }

        /* =========================================================
           ACTIONS
        ========================================================= */

        .action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 14px;

            margin-top: 20px;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            min-height: 45px;

            padding: 10px 17px;

            border-radius: 10px;

            font-size: 13px;
            font-weight: 800;

            transition: all .2s ease;
        }

        .action-button:hover {
            transform: translateY(-1px);
        }

        .button-back {
            border: 1px solid #d2d9e3;

            background: #ffffff;

            color: #475467;
        }

        .button-back:hover {
            background: #f8fafc;
            color: #344054;
        }

        .button-save {
            border: 1px solid #198754;

            background: #198754;

            color: #ffffff;

            box-shadow:
                0 5px 15px rgba(25, 135, 84, .14);
        }

        .button-save:hover {
            border-color: #157347;

            background: #157347;

            color: #ffffff;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .page-footer {
            margin-top: 25px;

            color: #98a2b3;

            font-size: 10px;

            text-align: center;
        }

        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 850px) {

            .employee-layout {
                align-items: flex-start;

                flex-direction: column;
            }

            .period-box {
                width: 100%;

                text-align: left;
            }

            .original-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .summary-grid {
                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 600px) {

            .correction-page {
                padding: 14px 10px 35px;
            }

            .page-top {
                align-items: stretch;

                flex-direction: column;

                gap: 10px;

                margin-bottom: 15px;
            }

            .back-button {
                width: 100%;
            }

            .page-label {
                justify-content: center;
            }

            .correction-header {
                padding: 21px 18px;

                border-radius: 15px;
            }

            .header-content {
                align-items: flex-start;

                gap: 12px;
            }

            .header-icon {
                width: 45px;
                height: 45px;

                flex-basis: 45px;

                border-radius: 11px;

                font-size: 20px;
            }

            .header-title {
                font-size: 1.4rem;
            }

            .header-description {
                font-size: 12px;
            }

            .content-card,
            .summary-card {
                border-radius: 14px;
            }

            .card-header-custom,
            .summary-header {
                padding: 15px 16px;
            }

            .card-body-custom,
            .summary-body {
                padding: 16px;
            }

            .employee-profile {
                align-items: flex-start;
            }

            .employee-avatar {
                width: 62px;
                height: 62px;

                flex-basis: 62px;
            }

            .employee-name {
                font-size: 16px;
            }

            .original-grid {
                grid-template-columns: 1fr 1fr;

                gap: 9px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .summary-item {
                padding: 13px;
            }

            .summary-value.net {
                font-size: 19px;
            }

            .action-bar {
                align-items: stretch;

                flex-direction: column;
            }

            .action-button {
                width: 100%;
            }

            .attachment-row {
                align-items: flex-start;

                flex-direction: column;
            }

        }

        /* =========================================================
           VERY SMALL PHONES
        ========================================================= */

        @media (max-width: 390px) {

            .correction-page {
                padding-left: 8px;
                padding-right: 8px;
            }

            .employee-profile {
                align-items: flex-start;

                flex-direction: column;
            }

            .employee-avatar {
                width: 68px;
                height: 68px;

                flex-basis: 68px;
            }

            .employee-details {
                width: 100%;
            }

            .original-grid {
                grid-template-columns: 1fr;
            }

            .period-value {
                white-space: normal;
            }

            .header-title {
                font-size: 1.28rem;
            }

        }

        /* =========================================================
           REDUCED MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                transition: none !important;
                animation: none !important;
            }

        }

    </style>

</head>


<body>

<div class="correction-page">

    <div class="correction-container">


        {{-- =====================================================
             TOP
        ====================================================== --}}

        <div class="page-top">

            <a
                href="{{ route('admin.payslip-concerns.show', $concern->id) }}"
                class="back-button"
            >

                <i class="bi bi-arrow-left"></i>

                <span>Back to Concern</span>

            </a>


            <div class="page-label">

                <span class="page-label-icon">

                    <i class="bi bi-pencil-square"></i>

                </span>

                <span>
                    Payslip Correction
                </span>

            </div>

        </div>


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <section class="correction-header">

            <div class="header-content">

                <div class="header-icon">

                    <i class="bi bi-pencil-square"></i>

                </div>


                <div>

                    <div class="header-eyebrow">
                        PAYSLIP CONCERN
                    </div>


                    <h1 class="header-title">
                        Correct Payslip
                    </h1>


                    <p class="header-description">

                        Review the employee's concern and manually
                        correct the payroll values where necessary.

                    </p>

                </div>

            </div>

        </section>


        {{-- =====================================================
             SUCCESS
        ====================================================== --}}

        @if (session('success'))

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- =====================================================
             ERROR
        ====================================================== --}}

        @if (session('error'))

            <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert"
            >

                <i class="bi bi-exclamation-triangle me-2"></i>

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Please correct the following:
                </strong>


                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             EMPLOYEE INFORMATION
        ====================================================== --}}

        <section class="content-card">

            <div class="card-body-custom">

                <div class="employee-layout">


                    <div class="employee-profile">

                        <img
                            src="{{ $employee->photo
                                ? asset('storage/' . $employee->photo)
                                : asset('images/default-avatar.png') }}"
                            class="employee-avatar"
                            alt="{{ $employee->name }}"
                        >


                        <div class="employee-details">

                            <h2 class="employee-name">

                                {{ $employee->name }}

                            </h2>


                            <p class="employee-position">

                                {{ $employee->position ?? 'Employee' }}

                            </p>


                            <div class="employee-tags">

                                <span class="employee-tag department">

                                    <i class="bi bi-building me-1"></i>

                                    {{ $employee->department }}

                                </span>


                                <span class="employee-tag">

                                    <i class="bi bi-person-badge me-1"></i>

                                    ID: {{ $employee->employee_id }}

                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="period-box">

                        <div class="period-label">
                            Pay Period
                        </div>


                        <div class="period-value">

                            {{ $payslip->period_start->format('M d, Y') }}

                            <span class="mx-1">—</span>

                            {{ $payslip->period_end->format('M d, Y') }}

                        </div>


                        <span class="concern-status">

                            <i class="bi bi-exclamation-circle me-1"></i>

                            Concern: {{ $concern->status }}

                        </span>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             EMPLOYEE CONCERN
        ====================================================== --}}

        <section class="content-card">

            <div class="card-header-custom">

                <div class="card-header-title">

                    <i class="bi bi-chat-left-text"></i>

                    <span>
                        Employee's Concern
                    </span>

                </div>

            </div>


            <div class="card-body-custom">

                <div class="concern-box">

                    <div class="concern-title">
                        Reason for Concern
                    </div>


                    <div>
                        {{ $concern->reason }}
                    </div>

                </div>


                @if ($concern->attachment)

                    <div class="attachment-row">

                        <span class="attachment-label">

                            <i class="bi bi-paperclip me-1"></i>

                            Employee Attachment

                        </span>


                        <a
                            href="{{ asset('storage/' . $concern->attachment) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm btn-outline-primary"
                        >

                            <i class="bi bi-eye me-1"></i>

                            View Attachment

                        </a>

                    </div>

                @endif

            </div>

        </section>


        {{-- =====================================================
             ORIGINAL PAYSLIP
        ====================================================== --}}

        <section class="content-card">

            <div class="card-header-custom">

                <div class="card-header-title">

                    <i class="bi bi-receipt"></i>

                    <span>
                        Original Payslip
                    </span>

                </div>

            </div>


            <div class="card-body-custom">

                <div class="original-grid">


                    <div class="original-item">

                        <span class="item-label">
                            Present Days
                        </span>

                        <span class="item-value">

                            {{ number_format($presentDays) }}

                        </span>

                    </div>


                    <div class="original-item">

                        <span class="item-label">
                            Basic Pay
                        </span>

                        <span class="item-value">

                            ₱ {{ number_format($basicPay, 2) }}

                        </span>

                    </div>


                    <div class="original-item">

                        <span class="item-label">
                            Holiday Pay
                        </span>

                        <span class="item-value">

                            ₱ {{ number_format($holidayPay, 2) }}

                        </span>

                    </div>


                    <div class="original-item">

                        <span class="item-label">
                            Overtime Pay
                        </span>

                        <span class="item-value">

                            ₱ {{ number_format($overtimePay, 2) }}

                        </span>

                    </div>


                    <div class="original-item">

                        <span class="item-label">
                            Other Earnings
                        </span>

                        <span class="item-value">

                            ₱ {{ number_format($honorarium, 2) }}

                        </span>

                    </div>


                    <div class="original-item">

                        <span class="item-label">
                            Teaching Load
                        </span>

                        <span class="item-value">

                            ₱ {{ number_format($teachingLoad, 2) }}

                        </span>

                    </div>


                    <div class="original-item">

                        <span class="item-label">
                            Gross Salary
                        </span>

                        <span class="item-value">

                            ₱ {{ number_format($originalGross, 2) }}

                        </span>

                    </div>


                    <div class="original-item">

                        <span class="item-label">
                            Benefit Deduction
                        </span>

                        <span class="item-value">

                            ₱ {{ number_format($benefits, 2) }}

                        </span>

                    </div>


                    <div class="original-item">

                        <span class="item-label">
                            Net Salary
                        </span>

                        <span class="item-value text-success">

                            ₱ {{ number_format($originalNet, 2) }}

                        </span>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             CORRECTION FORM
        ====================================================== --}}

        <form
            method="POST"
            action="{{ route(
                'admin.payslip-concerns.update-correction',
                $concern->id
            ) }}"
        >

            @csrf


            {{-- =================================================
                 EARNINGS
            ================================================== --}}

            <section class="content-card">

                <div class="card-header-custom">

                    <div class="card-header-title">

                        <i class="bi bi-plus-circle text-success"></i>

                        <span>
                            Earnings
                        </span>

                    </div>

                </div>


                <div class="card-body-custom">

                    <p class="section-description">

                        These fields correspond to the actual payroll
                        earnings used when generating the employee payslip.

                    </p>


                    <div class="row g-3">


                        {{-- PRESENT DAYS --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="present_days"
                                class="field-label"
                            >

                                Present Days

                            </label>


                            <input
                                type="number"
                                min="0"
                                step="1"
                                name="present_days"
                                id="present_days"
                                class="form-control amount-input"
                                value="{{ old(
                                    'present_days',
                                    $presentDays
                                ) }}"
                                required
                            >


                            <div class="original-value">

                                Original:
                                {{ number_format($presentDays) }} days

                            </div>

                        </div>


                        {{-- DAILY RATE --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="daily_rate"
                                class="field-label"
                            >

                                Daily Rate

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="daily_rate"
                                    id="daily_rate"
                                    class="form-control amount-input"
                                    value="{{ old(
                                        'daily_rate',
                                        $dailyRate
                                    ) }}"
                                    required
                                >

                            </div>


                            <div class="original-value">

                                Original:
                                ₱ {{ number_format($dailyRate, 2) }}

                            </div>


                            <small class="field-help">

                                Basic Pay is calculated as Daily Rate × Present Days.

                            </small>

                        </div>


                        {{-- BASIC PAY --}}

                        <div class="col-12 col-md-6">

                            <label
                                class="field-label"
                            >

                                Basic Pay

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="text"
                                    id="basic_pay_display"
                                    class="form-control amount-input"
                                    value="{{ number_format($basicPay, 2) }}"
                                    readonly
                                >

                            </div>


                            <small class="field-help">

                                Automatically calculated from the actual
                                payroll formula.

                            </small>

                        </div>


                        {{-- HOLIDAY PAY --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="holiday_pay"
                                class="field-label"
                            >

                                Holiday Pay

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="holiday_pay"
                                    id="holiday_pay"
                                    class="form-control amount-input"
                                    value="{{ old(
                                        'holiday_pay',
                                        $holidayPay
                                    ) }}"
                                    required
                                >

                            </div>


                            <div class="original-value">

                                Original:
                                ₱ {{ number_format($holidayPay, 2) }}

                            </div>

                        </div>


                        {{-- OVERTIME --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="ot"
                                class="field-label"
                            >

                                Overtime Pay

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="ot"
                                    id="ot"
                                    class="form-control amount-input"
                                    value="{{ old(
                                        'ot',
                                        $overtimePay
                                    ) }}"
                                    required
                                >

                            </div>


                            <div class="original-value">

                                Original:
                                ₱ {{ number_format($overtimePay, 2) }}

                            </div>


                            <small class="field-help">

                                Overtime Pay is the stored payroll
                                overtime amount.

                            </small>

                        </div>


                        {{-- HONORARIUM / ADDITIONAL EARNINGS --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="honorarium"
                                class="field-label"
                            >

                                Other Earnings

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="honorarium"
                                    id="honorarium"
                                    class="form-control amount-input"
                                    value="{{ old(
                                        'honorarium',
                                        $honorarium
                                    ) }}"
                                    required
                                >

                            </div>


                            <div class="original-value">

                                Original:
                                ₱ {{ number_format($honorarium, 2) }}

                            </div>


                            <small class="field-help">

                                This corresponds to the current payslip
                                value stored in the honorarium field.

                            </small>

                        </div>


                        {{-- TEACHING LOAD --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="teaching_load"
                                class="field-label"
                            >

                                Teaching Load Pay

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="teaching_load"
                                    id="teaching_load"
                                    class="form-control amount-input"
                                    value="{{ old(
                                        'teaching_load',
                                        $teachingLoad
                                    ) }}"
                                    required
                                >

                            </div>


                            <div class="original-value">

                                Original:
                                ₱ {{ number_format($teachingLoad, 2) }}

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 BENEFITS / DEDUCTIONS
            ================================================== --}}

            <section class="content-card">

                <div class="card-header-custom">

                    <div class="card-header-title">

                        <i class="bi bi-dash-circle text-danger"></i>

                        <span>
                            Benefits and Deductions
                        </span>

                    </div>

                </div>


                <div class="card-body-custom">

                    <p class="section-description">

                        Adjust the actual contribution and attendance
                        deductions used for the corrected payslip.

                    </p>


                    <div class="row g-3">


                        {{-- SSS --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="sss"
                                class="field-label"
                            >
                                SSS
                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="sss"
                                    id="sss"
                                    class="form-control amount-input deduction-input"
                                    value="{{ old(
                                        'sss',
                                        $sss
                                    ) }}"
                                    required
                                >

                            </div>

                        </div>


                        {{-- PHILHEALTH --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="philhealth"
                                class="field-label"
                            >
                                PhilHealth
                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="philhealth"
                                    id="philhealth"
                                    class="form-control amount-input deduction-input"
                                    value="{{ old(
                                        'philhealth',
                                        $philhealth
                                    ) }}"
                                    required
                                >

                            </div>

                        </div>


                        {{-- PAGIBIG --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="pagibig"
                                class="field-label"
                            >
                                Pag-IBIG
                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="pagibig"
                                    id="pagibig"
                                    class="form-control amount-input deduction-input"
                                    value="{{ old(
                                        'pagibig',
                                        $pagibig
                                    ) }}"
                                    required
                                >

                            </div>

                        </div>


                        {{-- HMO --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="hmo"
                                class="field-label"
                            >
                                HMO
                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="hmo"
                                    id="hmo"
                                    class="form-control amount-input deduction-input"
                                    value="{{ old(
                                        'hmo',
                                        $hmo
                                    ) }}"
                                    required
                                >

                            </div>

                        </div>


                        {{-- LATE --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="late_deduction"
                                class="field-label"
                            >

                                Late Deduction

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="late_deduction"
                                    id="late_deduction"
                                    class="form-control amount-input deduction-input"
                                    value="{{ old(
                                        'late_deduction',
                                        $lateDeduction
                                    ) }}"
                                    required
                                >

                            </div>


                            <div class="original-value">

                                Late Minutes:
                                {{ number_format($lateMinutes) }}

                            </div>

                        </div>


                        {{-- UNDERTIME --}}

                        <div class="col-12 col-md-6">

                            <label
                                for="undertime_deduction"
                                class="field-label"
                            >

                                Undertime Deduction

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>


                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="undertime_deduction"
                                    id="undertime_deduction"
                                    class="form-control amount-input deduction-input"
                                    value="{{ old(
                                        'undertime_deduction',
                                        $undertimeDeduction
                                    ) }}"
                                    required
                                >

                            </div>


                            <div class="original-value">

                                Undertime Minutes:
                                {{ number_format($undertimeMinutes) }}

                            </div>

                        </div>


                        {{-- BENEFIT DIVISOR --}}

                        <div class="col-12">

                            <div class="original-value">

                                <strong>Payroll Benefit Rule:</strong>

                                SSS + PhilHealth + Pag-IBIG + HMO
                                ÷ {{ $benefitDivisor }}

                                @if ($isWeeklyPayroll)
                                    (Weekly Payroll)
                                @else
                                    (Regular / Non-Weekly Payroll)
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 LIVE CALCULATION
            ================================================== --}}

            <section class="summary-card content-card">

                <div class="summary-header">

                    <i class="bi bi-calculator"></i>

                    <span>
                        Corrected Payroll Preview
                    </span>

                </div>


                <div class="summary-body">

                    <div class="summary-grid">


                        <div class="summary-item">

                            <div class="summary-label">
                                Basic Pay
                            </div>


                            <div
                                id="basicPayPreview"
                                class="summary-value"
                            >

                                ₱ 0.00

                            </div>

                        </div>


                        <div class="summary-item">

                            <div class="summary-label">
                                Gross Salary
                            </div>


                            <div
                                id="grossPreview"
                                class="summary-value"
                            >

                                ₱ 0.00

                            </div>

                        </div>


                        <div class="summary-item">

                            <div class="summary-label">
                                Total Deductions
                            </div>


                            <div
                                id="deductionsPreview"
                                class="summary-value deduction"
                            >

                                ₱ 0.00

                            </div>

                        </div>


                        <div class="summary-item">

                            <div class="summary-label">
                                Corrected Net Salary
                            </div>


                            <div
                                id="netPreview"
                                class="summary-value net"
                            >

                                ₱ 0.00

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 ADMIN RESPONSE
            ================================================== --}}

            <section class="content-card">

                <div class="card-header-custom">

                    <div class="card-header-title">

                        <i class="bi bi-chat-left-text"></i>

                        <span>
                            Response to Employee
                        </span>

                    </div>

                </div>


                <div class="card-body-custom">

                    <p class="response-help">

                        Explain what was corrected and why. This response
                        will be saved with the payslip concern and can be
                        shown to the employee.

                    </p>


                    <label
                        for="admin-response"
                        class="field-label"
                    >

                        Admin Response

                    </label>


                    <textarea
                        id="admin-response"
                        name="admin_response"
                        rows="5"
                        class="form-control"
                        placeholder="Explain what was corrected and why..."
                        required
                    >{{ old(
                        'admin_response',
                        $concern->admin_response
                    ) }}</textarea>

                </div>

            </section>


            {{-- =================================================
                 ACTION BUTTONS
            ================================================== --}}

            <div class="action-bar">

                <a
                    href="{{ route(
                        'admin.payslip-concerns.show',
                        $concern->id
                    ) }}"
                    class="action-button button-back"
                >

                    <i class="bi bi-arrow-left"></i>

                    Back to Concern

                </a>


                <button
                    type="submit"
                    class="action-button button-save"
                >

                    <i class="bi bi-check-circle"></i>

                    Save Correction & Resolve Concern

                </button>

            </div>

        </form>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="page-footer">

            Pap Pay Payroll Management System

        </div>

    </div>

</div>


<script src="{{ asset('khen/assets/js/bootstrap.bundle.min.js') }}"></script>


<script>

    /*
    |--------------------------------------------------------------------------
    | Live Payslip Calculation
    |--------------------------------------------------------------------------
    |
    | This follows the actual PayrollController calculation:
    |
    | basicPay
    | + holidayPay
    | + overtimePay
    | + additionalEarnings
    | + teachingLoad
    | = grossSalary
    |
    | benefits
    | + lateDeduction
    | + undertimeDeduction
    | = total deductions
    |
    | grossSalary - deductions
    | = netSalary
    |
    */


    const benefitDivisor = {{ $benefitDivisor }};


    function getValue(id) {

        const element =
            document.getElementById(id);

        if (!element) {
            return 0;
        }

        return parseFloat(element.value) || 0;

    }


    function formatMoney(value) {

        return '₱ ' + Number(value).toLocaleString(
            'en-PH',
            {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        );

    }


    function calculatePayslip() {

        /*
        |--------------------------------------------------------------------------
        | Attendance / Basic Pay
        |--------------------------------------------------------------------------
        */

        const presentDays =
            Math.max(
                0,
                getValue('present_days')
            );


        const dailyRate =
            Math.max(
                0,
                getValue('daily_rate')
            );


        const basicPay =
            dailyRate *
            presentDays;


        /*
        |--------------------------------------------------------------------------
        | Other Earnings
        |--------------------------------------------------------------------------
        */

        const holidayPay =
            Math.max(
                0,
                getValue('holiday_pay')
            );


        const overtimePay =
            Math.max(
                0,
                getValue('ot')
            );


        const honorarium =
            Math.max(
                0,
                getValue('honorarium')
            );


        const teachingLoad =
            Math.max(
                0,
                getValue('teaching_load')
            );


        /*
        |--------------------------------------------------------------------------
        | Gross Salary
        |--------------------------------------------------------------------------
        */

        const grossSalary =
            basicPay
            + holidayPay
            + overtimePay
            + honorarium
            + teachingLoad;


        /*
        |--------------------------------------------------------------------------
        | Contributions
        |--------------------------------------------------------------------------
        */

        const sss =
            Math.max(
                0,
                getValue('sss')
            );


        const philhealth =
            Math.max(
                0,
                getValue('philhealth')
            );


        const pagibig =
            Math.max(
                0,
                getValue('pagibig')
            );


        const hmo =
            Math.max(
                0,
                getValue('hmo')
            );


        /*
        |--------------------------------------------------------------------------
        | Benefits
        |--------------------------------------------------------------------------
        |
        | This follows PayrollController:
        |
        | Weekly / Laborers = divide by 4
        | Others = divide by 2
        |
        */

        const benefits =
            (
                sss
                + philhealth
                + pagibig
                + hmo
            ) / benefitDivisor;


        /*
        |--------------------------------------------------------------------------
        | Attendance Deductions
        |--------------------------------------------------------------------------
        */

        const lateDeduction =
            Math.max(
                0,
                getValue('late_deduction')
            );


        const undertimeDeduction =
            Math.max(
                0,
                getValue('undertime_deduction')
            );


        /*
        |--------------------------------------------------------------------------
        | Total Deductions
        |--------------------------------------------------------------------------
        */

        const totalDeductions =
            benefits
            + lateDeduction
            + undertimeDeduction;


        /*
        |--------------------------------------------------------------------------
        | Net Salary
        |--------------------------------------------------------------------------
        */

        const netSalary =
            Math.max(
                0,
                grossSalary
                - totalDeductions
            );


        /*
        |--------------------------------------------------------------------------
        | Basic Pay Display
        |--------------------------------------------------------------------------
        */

        const basicPayDisplay =
            document.getElementById(
                'basic_pay_display'
            );


        if (basicPayDisplay) {

            basicPayDisplay.value =
                Number(basicPay).toLocaleString(
                    'en-PH',
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Basic Pay Preview
        |--------------------------------------------------------------------------
        */

        const basicPayPreview =
            document.getElementById(
                'basicPayPreview'
            );


        if (basicPayPreview) {

            basicPayPreview.textContent =
                formatMoney(basicPay);

        }


        /*
        |--------------------------------------------------------------------------
        | Gross Preview
        |--------------------------------------------------------------------------
        */

        const grossPreview =
            document.getElementById(
                'grossPreview'
            );


        if (grossPreview) {

            grossPreview.textContent =
                formatMoney(grossSalary);

        }


        /*
        |--------------------------------------------------------------------------
        | Deduction Preview
        |--------------------------------------------------------------------------
        */

        const deductionsPreview =
            document.getElementById(
                'deductionsPreview'
            );


        if (deductionsPreview) {

            deductionsPreview.textContent =
                formatMoney(totalDeductions);

        }


        /*
        |--------------------------------------------------------------------------
        | Net Preview
        |--------------------------------------------------------------------------
        */

        const netPreview =
            document.getElementById(
                'netPreview'
            );


        if (netPreview) {

            netPreview.textContent =
                formatMoney(netSalary);

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Listen for Changes
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            'input[type="number"]'
        )
        .forEach(function (input) {

            input.addEventListener(
                'input',
                calculatePayslip
            );

            input.addEventListener(
                'change',
                calculatePayslip
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Initial Calculation
    |--------------------------------------------------------------------------
    */

    calculatePayslip();

</script>


</body>

</html>
