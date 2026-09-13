@php

    $admin = Auth::user();

    $payslip = $concern->payslip;

    $employee = $concern->user;

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
        content="Payslip concern review and resolution"
    >

    <title>Payslip Concern | Pap Pay</title>

    <link
        rel="stylesheet"
        href="../../../../khen/assets/css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            width: 100%;
            min-height: 100%;
            overflow-x: hidden;
        }

        body {
            margin: 0;
            width: 100%;
            min-height: 100vh;
            overflow-x: hidden;

            background:
                linear-gradient(
                    135deg,
                    #f8fafc 0%,
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
        select,
        textarea {
            font: inherit;
        }


        /* =========================================================
           PAGE
        ========================================================= */

        .concern-page {
            width: 100%;
            min-height: 100vh;
            padding: 28px 20px 50px;
        }

        .concern-container {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
        }


        /* =========================================================
           TOP HEADER
        ========================================================= */

        .page-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 44px;

            padding: 10px 16px;

            border: 1px solid #d7dee9;
            border-radius: 11px;

            background: rgba(255, 255, 255, 0.9);

            color: #344054;

            font-size: 14px;
            font-weight: 700;

            transition:
                background .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }

        .back-button:hover {
            background: #ffffff;
            border-color: #b9c4d3;
            color: #172033;
            transform: translateX(-2px);
        }

        .page-context {
            display: flex;
            align-items: center;
            gap: 11px;

            color: #667085;

            font-size: 13px;
            font-weight: 600;
        }

        .page-context-icon {
            width: 38px;
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: #e8f0ff;
            color: #2563eb;

            font-size: 18px;
        }


        /* =========================================================
           ALERTS
        ========================================================= */

        .alert {
            border-radius: 13px;
            border-width: 1px;

            padding: 14px 16px;

            margin-bottom: 20px;

            box-shadow:
                0 5px 18px rgba(15, 23, 42, .04);
        }


        /* =========================================================
           HERO
        ========================================================= */

        .concern-hero {
            position: relative;
            overflow: hidden;

            margin-bottom: 24px;
            padding: 28px 30px;

            border: 1px solid #dfe7f2;
            border-radius: 20px;

            background:
                linear-gradient(
                    135deg,
                    #ffffff 0%,
                    #f8fbff 100%
                );

            box-shadow:
                0 12px 35px rgba(15, 23, 42, .06);
        }

        .concern-hero::after {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            right: -90px;
            top: -100px;

            border-radius: 50%;

            background:
                rgba(37, 99, 235, .07);

            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 25px;
        }

        .hero-left {
            min-width: 0;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 9px;

            color: #2563eb;

            font-size: 12px;
            font-weight: 800;

            letter-spacing: .08em;

            text-transform: uppercase;
        }

        .hero-title {
            margin: 0;

            color: #111827;

            font-size: clamp(1.45rem, 2.5vw, 2rem);

            font-weight: 800;

            line-height: 1.2;
        }

        .hero-description {
            max-width: 720px;

            margin: 9px 0 0;

            color: #667085;

            font-size: 14px;

            line-height: 1.65;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            flex: 0 0 auto;

            min-height: 38px;

            padding: 8px 14px;

            border-radius: 999px;

            font-size: 13px;
            font-weight: 800;

            white-space: nowrap;
        }

        .status-pending {
            background: #fff4cc;
            color: #8a5a00;
        }

        .status-reviewed {
            background: #dff5ff;
            color: #05668d;
        }

        .status-resolved {
            background: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }


        /* =========================================================
           MAIN GRID
        ========================================================= */

        .content-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1.65fr)
                minmax(300px, .8fr);

            gap: 22px;

            align-items: start;
        }

        .left-column,
        .right-column {
            min-width: 0;
        }

        .right-column {
            position: sticky;
            top: 20px;
        }


        /* =========================================================
           CARDS
        ========================================================= */

        .section-card {
            width: 100%;

            overflow: hidden;

            border: 1px solid #e0e7f0;
            border-radius: 17px;

            background: #ffffff;

            box-shadow:
                0 8px 28px rgba(15, 23, 42, .055);
        }

        .section-card + .section-card {
            margin-top: 22px;
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 19px 22px;

            border-bottom: 1px solid #edf1f6;

            background: #ffffff;
        }

        .card-title-wrap {
            min-width: 0;
        }

        .card-title {
            margin: 0;

            color: #182230;

            font-size: 16px;
            font-weight: 800;
        }

        .card-subtitle {
            margin: 4px 0 0;

            color: #8a94a6;

            font-size: 12px;

            line-height: 1.5;
        }

        .card-body-custom {
            padding: 22px;
        }


        /* =========================================================
           EMPLOYEE
        ========================================================= */

        .employee-profile {
            display: flex;
            align-items: center;

            gap: 16px;
        }

        .employee-avatar {
            width: 76px;
            height: 76px;

            flex: 0 0 76px;

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

            line-height: 1.3;

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
            font-weight: 700;
        }

        .employee-tag.department {
            background: #eaf2ff;
            color: #1d4ed8;
        }


        /* =========================================================
           CONCERN
        ========================================================= */

        .reason-label {
            display: block;

            margin-bottom: 9px;

            color: #344054;

            font-size: 13px;
            font-weight: 800;
        }

        .reason-box {
            width: 100%;

            padding: 17px;

            border: 1px solid #e7ebf1;
            border-radius: 12px;

            background: #f8fafc;

            color: #344054;

            font-size: 14px;

            line-height: 1.7;

            overflow-wrap: anywhere;
        }

        .attachment-area {
            margin-top: 20px;

            padding-top: 20px;

            border-top: 1px solid #edf1f6;
        }

        .attachment-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            min-height: 42px;

            padding: 9px 14px;

            border: 1px solid #bfd2f8;
            border-radius: 10px;

            background: #f5f8ff;

            color: #2563eb;

            font-size: 13px;
            font-weight: 750;

            transition: all .2s ease;
        }

        .attachment-button:hover {
            background: #eaf1ff;

            border-color: #9db9ef;

            color: #1d4ed8;
        }


        /* =========================================================
           PAYSLIP
        ========================================================= */

        .payslip-period {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            margin-bottom: 20px;

            padding: 8px 11px;

            border-radius: 8px;

            background: #f5f7fa;

            color: #475467;

            font-size: 12px;
            font-weight: 700;
        }

        .payslip-group {
            margin-top: 22px;
        }

        .payslip-group:first-of-type {
            margin-top: 0;
        }

        .payslip-group-title {
            display: flex;
            align-items: center;

            gap: 8px;

            margin-bottom: 11px;

            color: #182230;

            font-size: 13px;
            font-weight: 800;
        }

        .payslip-group-title i {
            color: #2563eb;
        }

        .payslip-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 12px;
        }

        .pay-item {
            min-width: 0;

            padding: 14px;

            border: 1px solid #edf0f4;
            border-radius: 11px;

            background: #fbfcfe;
        }

        .pay-label {
            display: block;

            margin-bottom: 6px;

            color: #8a94a6;

            font-size: 11px;
            font-weight: 700;

            line-height: 1.4;
        }

        .pay-value {
            display: block;

            color: #253044;

            font-size: 14px;
            font-weight: 800;

            line-height: 1.35;

            overflow-wrap: anywhere;
        }

        .net-salary {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-top: 22px;

            padding: 17px 18px;

            border: 1px solid #ccebd8;
            border-radius: 12px;

            background: #f0fdf4;
        }

        .net-label {
            color: #344054;

            font-size: 14px;
            font-weight: 800;
        }

        .net-value {
            color: #15803d;

            font-size: 20px;
            font-weight: 900;

            text-align: right;
        }


        /* =========================================================
           ACTION CARD
        ========================================================= */

        .action-card {
            border-color: #dce5f2;
        }

        .action-intro {
            margin: 0 0 18px;

            color: #667085;

            font-size: 13px;

            line-height: 1.6;
        }

        .action-block {
            padding: 17px;

            border: 1px solid #e8edf4;
            border-radius: 13px;

            background: #fbfcfe;
        }

        .action-block + .action-block {
            margin-top: 14px;
        }

        .action-block-title {
            display: flex;
            align-items: center;

            gap: 8px;

            margin-bottom: 7px;

            color: #1f2937;

            font-size: 14px;
            font-weight: 800;
        }

        .action-block-title i {
            color: #2563eb;
        }

        .action-description {
            margin: 0 0 13px;

            color: #7a8494;

            font-size: 12px;

            line-height: 1.55;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            width: 100%;

            min-height: 43px;

            padding: 9px 13px;

            border-radius: 10px;

            font-size: 13px;
            font-weight: 800;

            transition: all .2s ease;
        }

        .action-button-primary {
            border: 1px solid #2563eb;

            background: #2563eb;

            color: #ffffff;
        }

        .action-button-primary:hover {
            border-color: #1d4ed8;

            background: #1d4ed8;

            color: #ffffff;

            transform: translateY(-1px);
        }

        .action-button-outline {
            border: 1px solid #c8d6ef;

            background: #ffffff;

            color: #2563eb;
        }

        .action-button-outline:hover {
            border-color: #9db8e9;

            background: #f4f7ff;

            color: #1d4ed8;
        }

        .status-section {
            margin-top: 16px;

            padding-top: 18px;

            border-top: 1px solid #edf1f6;
        }

        .form-label-custom {
            display: block;

            margin-bottom: 7px;

            color: #344054;

            font-size: 12px;
            font-weight: 800;
        }

        .form-control,
        .form-select {
            min-height: 44px;

            border-color: #d9e0e9;
            border-radius: 10px;

            color: #344054;

            font-size: 13px;

            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #7da2e8;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .10);
        }

        textarea.form-control {
            min-height: 110px;

            resize: vertical;
        }

        .save-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            width: 100%;

            min-height: 45px;

            border: 0;
            border-radius: 10px;

            background: #172033;

            color: #ffffff;

            font-size: 13px;
            font-weight: 800;

            transition: all .2s ease;
        }

        .save-button:hover {
            background: #0f172a;

            color: #ffffff;

            transform: translateY(-1px);
        }


        /* =========================================================
           EMPTY PAYSLIP
        ========================================================= */

        .no-payslip {
            display: flex;
            align-items: flex-start;

            gap: 12px;

            padding: 15px;

            border: 1px solid #fde2b8;
            border-radius: 11px;

            background: #fffaf0;

            color: #8a5a00;

            font-size: 13px;

            line-height: 1.55;
        }

        .no-payslip i {
            margin-top: 2px;

            font-size: 17px;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .page-footer {
            margin-top: 26px;

            text-align: center;

            color: #98a2b3;

            font-size: 11px;
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 1100px) {

            .content-grid {
                grid-template-columns:
                    minmax(0, 1.45fr)
                    minmax(280px, .8fr);
            }

            .payslip-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        /* =========================================================
           MOBILE / TABLET
        ========================================================= */

        @media (max-width: 900px) {

            .concern-page {
                padding: 20px 15px 40px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .right-column {
                position: static;
            }

            .hero-content {
                align-items: flex-start;

                flex-direction: column;
            }

            .status-badge {
                align-self: flex-start;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================= */

        @media (max-width: 600px) {

            .concern-page {
                padding: 14px 10px 30px;
            }

            .page-top {
                align-items: stretch;

                flex-direction: column;

                gap: 12px;

                margin-bottom: 16px;
            }

            .back-button {
                width: 100%;
            }

            .page-context {
                justify-content: center;
            }

            .concern-hero {
                margin-bottom: 16px;

                padding: 21px 18px;

                border-radius: 15px;
            }

            .hero-title {
                font-size: 1.4rem;
            }

            .hero-description {
                font-size: 13px;
            }

            .section-card {
                border-radius: 14px;
            }

            .section-card + .section-card {
                margin-top: 16px;
            }

            .card-header-custom {
                align-items: flex-start;

                flex-direction: column;

                padding: 16px;
            }

            .card-body-custom {
                padding: 16px;
            }

            .employee-profile {
                align-items: flex-start;

                gap: 12px;
            }

            .employee-avatar {
                width: 62px;
                height: 62px;

                flex-basis: 62px;
            }

            .employee-name {
                font-size: 16px;
            }

            .employee-position {
                font-size: 12px;
            }

            .payslip-grid {
                grid-template-columns:
                    1fr 1fr;

                gap: 9px;
            }

            .pay-item {
                padding: 12px;
            }

            .pay-label {
                font-size: 10px;
            }

            .pay-value {
                font-size: 13px;
            }

            .net-salary {
                align-items: flex-start;

                flex-direction: column;

                gap: 6px;

                padding: 15px;
            }

            .net-value {
                font-size: 18px;

                text-align: left;
            }

        }


        /* =========================================================
           VERY SMALL PHONES
        ========================================================= */

        @media (max-width: 390px) {

            .concern-page {
                padding-left: 8px;
                padding-right: 8px;
            }

            .payslip-grid {
                grid-template-columns: 1fr;
            }

            .employee-profile {
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

            .status-badge {
                width: 100%;
            }

            .hero-title {
                font-size: 1.3rem;
            }

        }


        /* =========================================================
           REDUCE MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;

                transition: none !important;

                animation: none !important;
            }

        }

    </style>

</head>


<body>

<div class="concern-page">

    <div class="concern-container">


        {{-- =====================================================
             TOP
        ====================================================== --}}

        <div class="page-top">

            <a
                href="{{ route('admin.payslip-concerns.index') }}"
                class="back-button"
            >

                <i class="bi bi-arrow-left"></i>

                <span>
                    Back to Concerns
                </span>

            </a>


            <div class="page-context">

                <span class="page-context-icon">

                    <i class="bi bi-receipt-cutoff"></i>

                </span>

                <span>
                    Payslip Concern Review
                </span>

            </div>

        </div>


        {{-- =====================================================
             SUCCESS
        ====================================================== --}}

        @if(session('success'))

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

        @if(session('error'))

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
             HERO
        ====================================================== --}}

        <section class="concern-hero">

            <div class="hero-content">

                <div class="hero-left">

                    <div class="hero-eyebrow">

                        <i class="bi bi-shield-check"></i>

                        Payroll Administration

                    </div>


                    <h1 class="hero-title">

                        Review Payslip Concern

                    </h1>


                    <p class="hero-description">

                        Review the employee's concern, verify the affected
                        payslip information, and take the appropriate action
                        to resolve the issue.

                    </p>

                </div>


                <div>

                    @if($concern->status === 'Pending')

                        <span class="status-badge status-pending">

                            <i class="bi bi-clock"></i>

                            Pending

                        </span>

                    @elseif($concern->status === 'Reviewed')

                        <span class="status-badge status-reviewed">

                            <i class="bi bi-eye"></i>

                            Reviewed

                        </span>

                    @elseif($concern->status === 'Resolved')

                        <span class="status-badge status-resolved">

                            <i class="bi bi-check-circle"></i>

                            Resolved

                        </span>

                    @else

                        <span class="status-badge status-rejected">

                            <i class="bi bi-x-circle"></i>

                            Rejected

                        </span>

                    @endif

                </div>

            </div>

        </section>


        {{-- =====================================================
             MAIN CONTENT
        ====================================================== --}}

        <div class="content-grid">


            {{-- =================================================
                 LEFT COLUMN
            ================================================== --}}

            <div class="left-column">


                {{-- =============================================
                     EMPLOYEE
                ============================================== --}}

                <section class="section-card">

                    <div class="card-header-custom">

                        <div class="card-title-wrap">

                            <h2 class="card-title">
                                Employee Information
                            </h2>

                            <p class="card-subtitle">
                                Employee who submitted this concern
                            </p>

                        </div>

                    </div>


                    <div class="card-body-custom">

                        <div class="employee-profile">

                            <img
                                src="{{ $employee->photo
                                    ? asset('storage/' . $employee->photo)
                                    : asset('images/default-avatar.png') }}"
                                width="76"
                                height="76"
                                class="employee-avatar"
                                alt="{{ $employee->name }}"
                            >


                            <div class="employee-details">

                                <h3 class="employee-name">
                                    {{ $employee->name }}
                                </h3>


                                <p class="employee-position">
                                    {{ $employee->position }}
                                </p>


                                <div class="employee-tags">

                                    <span class="employee-tag department">

                                        <i class="bi bi-building me-1"></i>

                                        {{ $employee->department }}

                                    </span>


                                    <span class="employee-tag">

                                        <i class="bi bi-person-badge me-1"></i>

                                        ID:
                                        {{ $employee->employee_id }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- =============================================
                     EMPLOYEE CONCERN
                ============================================== --}}

                <section class="section-card">

                    <div class="card-header-custom">

                        <div class="card-title-wrap">

                            <h2 class="card-title">
                                Employee's Concern
                            </h2>

                            <p class="card-subtitle">
                                Details submitted by the employee
                            </p>

                        </div>


                        @if($concern->status === 'Pending')

                            <span class="status-badge status-pending">
                                Pending
                            </span>

                        @elseif($concern->status === 'Reviewed')

                            <span class="status-badge status-reviewed">
                                Reviewed
                            </span>

                        @elseif($concern->status === 'Resolved')

                            <span class="status-badge status-resolved">
                                Resolved
                            </span>

                        @else

                            <span class="status-badge status-rejected">
                                Rejected
                            </span>

                        @endif

                    </div>


                    <div class="card-body-custom">

                        <span class="reason-label">
                            Reason
                        </span>


                        <div class="reason-box">

                            {!! nl2br(e($concern->reason)) !!}

                        </div>


                        {{-- ATTACHMENT --}}

                        @if($concern->attachment)

                            <div class="attachment-area">

                                <span class="reason-label">
                                    Employee Attachment
                                </span>


                                <a
                                    href="{{ asset('storage/' . $concern->attachment) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="attachment-button"
                                >

                                    <i class="bi bi-paperclip"></i>

                                    View Attachment

                                </a>

                            </div>

                        @endif

                    </div>

                </section>


                {{-- =============================================
                     PAYSLIP
                ============================================== --}}

                @if($payslip)

                    <section class="section-card">

                        <div class="card-header-custom">

                            <div class="card-title-wrap">

                                <h2 class="card-title">
                                    Payslip Information
                                </h2>

                                <p class="card-subtitle">
                                    Actual payroll information recorded for this employee
                                </p>

                            </div>

                        </div>


                        <div class="card-body-custom">


                            {{-- PAYROLL PERIOD --}}

                            <div class="payslip-period">

                                <i class="bi bi-calendar3"></i>

                                <span>

                                    {{ $payslip->period_start->format('M d, Y') }}

                                    <span class="mx-1">—</span>

                                    {{ $payslip->period_end->format('M d, Y') }}

                                </span>

                            </div>


                            {{-- =================================================
                                 ATTENDANCE
                            ================================================== --}}

                            <div class="payslip-group">

                                <div class="payslip-group-title">

                                    <i class="bi bi-calendar-check"></i>

                                    Attendance & Payroll Basis

                                </div>


                                <div class="payslip-grid">


                                    {{-- PRESENT DAYS --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Present Days
                                        </span>

                                        <span class="pay-value">

                                            {{ number_format(
                                                $payslip->present_days ?? 0,
                                                0
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- WORKED HOLIDAYS --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Worked Holidays
                                        </span>

                                        <span class="pay-value">

                                            {{ number_format(
                                                $payslip->worked_holidays ?? 0,
                                                0
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- LATE MINUTES --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Late Minutes
                                        </span>

                                        <span class="pay-value">

                                            {{ number_format(
                                                $payslip->late_minutes ?? 0,
                                                0
                                            ) }}
                                            min

                                        </span>

                                    </div>


                                    {{-- UNDERTIME MINUTES --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Undertime Minutes
                                        </span>

                                        <span class="pay-value">

                                            {{ number_format(
                                                $payslip->undertime_minutes ?? 0,
                                                0
                                            ) }}
                                            min

                                        </span>

                                    </div>


                                    {{-- OVERTIME MINUTES --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Overtime Minutes
                                        </span>

                                        <span class="pay-value">

                                            {{ number_format(
                                                $payslip->overtime_minutes ?? 0,
                                                0
                                            ) }}
                                            min

                                        </span>

                                    </div>


                                    {{-- OVERTIME HOURS --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Overtime Hours
                                        </span>

                                        <span class="pay-value">

                                            {{ number_format(
                                                $payslip->overtime_hours ?? 0,
                                                2
                                            ) }}
                                            hrs

                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                 EARNINGS
                            ================================================== --}}

                            <div class="payslip-group">

                                <div class="payslip-group-title">

                                    <i class="bi bi-cash-stack"></i>

                                    Earnings

                                </div>


                                <div class="payslip-grid">


                                    {{-- DAILY RATE --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Daily Rate
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->daily_rate ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- HOLIDAY PAY --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Holiday Pay
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->holiday_pay ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- OVERTIME PAY --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Overtime Pay
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->ot ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- HONORARIUM --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Honorarium / Additional Earnings
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->honorarium ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- TEACHING LOAD PAY --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Teaching Load Pay
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->teaching_load_pay
                                                ?? $payslip->teaching_load
                                                ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- GROSS SALARY --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Gross Salary
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->gross_salary ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                 CONTRIBUTIONS AND DEDUCTIONS
                            ================================================== --}}

                            <div class="payslip-group">

                                <div class="payslip-group-title">

                                    <i class="bi bi-dash-circle"></i>

                                    Contributions & Deductions

                                </div>


                                <div class="payslip-grid">


                                    {{-- SSS --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            SSS
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->sss ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- PHILHEALTH --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            PhilHealth
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->philhealth ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- PAG-IBIG --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Pag-IBIG
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->pagibig ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- HMO --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            HMO
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->hmo ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- TOTAL BENEFIT DEDUCTION --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Total Benefit Deduction
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->benefits ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- LATE DEDUCTION --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Late Deduction
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->late_deduction ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>


                                    {{-- UNDERTIME DEDUCTION --}}

                                    <div class="pay-item">

                                        <span class="pay-label">
                                            Undertime Deduction
                                        </span>

                                        <span class="pay-value">

                                            ₱
                                            {{ number_format(
                                                $payslip->undertime_deduction ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                 NET SALARY
                            ================================================== --}}

                            <div class="net-salary">

                                <span class="net-label">
                                    Net Salary
                                </span>

                                <span class="net-value">

                                    ₱
                                    {{ number_format(
                                        $payslip->net_salary ?? 0,
                                        2
                                    ) }}

                                </span>

                            </div>

                        </div>

                    </section>

                @else

                    <section class="section-card">

                        <div class="card-body-custom">

                            <div class="no-payslip">

                                <i class="bi bi-exclamation-circle"></i>

                                <span>
                                    No payslip is currently associated
                                    with this concern.
                                </span>

                            </div>

                        </div>

                    </section>

                @endif

            </div>


            {{-- =================================================
                 RIGHT COLUMN
            ================================================== --}}

            <div class="right-column">

                <section class="section-card action-card">

                    <div class="card-header-custom">

                        <div class="card-title-wrap">

                            <h2 class="card-title">
                                Concern Actions
                            </h2>

                            <p class="card-subtitle">
                                Review and resolve this concern
                            </p>

                        </div>

                    </div>


                    <div class="card-body-custom">

                        <p class="action-intro">

                            Use the available actions to recalculate,
                            manually correct, or update the status of
                            this payslip concern.

                        </p>


                        {{-- =====================================
                             RECALCULATE
                        ====================================== --}}

                        <div class="action-block">

                            <div class="action-block-title">

                                <i class="bi bi-calculator"></i>

                                Recalculate Payslip

                            </div>


                            <p class="action-description">

                                Recalculate this payslip using the
                                employee's current salary configuration,
                                attendance, holidays, overtime,
                                deductions, and teaching load records.

                            </p>


                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.payslip-concerns.recalculate',
                                    $concern->id
                                ) }}"
                                onsubmit="return confirm(
                                    'Recalculate this payslip using the current payroll records?'
                                );"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="action-button action-button-primary"
                                >

                                    <i class="bi bi-arrow-repeat"></i>

                                    Recalculate Payslip

                                </button>

                            </form>

                        </div>


                        {{-- =====================================
                             MANUAL CORRECTION
                        ====================================== --}}

                        <div class="action-block">

                            <div class="action-block-title">

                                <i class="bi bi-pencil-square"></i>

                                Manual Correction

                            </div>


                            <p class="action-description">

                                Manually change the payroll values
                                if the employee's concern is valid.

                            </p>


                            <a
                                href="{{ route(
                                    'admin.payslip-concerns.correct',
                                    $concern->id
                                ) }}"
                                class="action-button action-button-outline"
                            >

                                <i class="bi bi-pencil-square"></i>

                                Correct Payslip

                            </a>

                        </div>


                        {{-- =====================================
                             STATUS
                        ====================================== --}}

                        <div class="status-section">

                            <div class="action-block-title">

                                <i class="bi bi-check2-circle"></i>

                                Update Status

                            </div>


                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.payslip-concerns.status',
                                    $concern->id
                                ) }}"
                            >

                                @csrf


                                <div class="mb-3">

                                    <label
                                        for="concern-status"
                                        class="form-label-custom"
                                    >

                                        Concern Status

                                    </label>


                                    <select
                                        id="concern-status"
                                        name="status"
                                        class="form-select"
                                        required
                                    >

                                        <option
                                            value="Pending"
                                            @selected(
                                                $concern->status === 'Pending'
                                            )
                                        >
                                            Pending
                                        </option>


                                        <option
                                            value="Reviewed"
                                            @selected(
                                                $concern->status === 'Reviewed'
                                            )
                                        >
                                            Reviewed
                                        </option>


                                        <option
                                            value="Resolved"
                                            @selected(
                                                $concern->status === 'Resolved'
                                            )
                                        >
                                            Resolved
                                        </option>


                                        <option
                                            value="Rejected"
                                            @selected(
                                                $concern->status === 'Rejected'
                                            )
                                        >
                                            Rejected
                                        </option>

                                    </select>

                                </div>


                                <div class="mb-3">

                                    <label
                                        for="admin-response"
                                        class="form-label-custom"
                                    >

                                        Response to Employee

                                    </label>


                                    <textarea
                                        id="admin-response"
                                        name="admin_response"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Write your response to the employee..."
                                    >{{ $concern->admin_response }}</textarea>

                                </div>


                                <button
                                    type="submit"
                                    class="save-button"
                                >

                                    <i class="bi bi-check2-circle"></i>

                                    Save Response

                                </button>

                            </form>

                        </div>

                    </div>

                </section>

            </div>

        </div>


        <div class="page-footer">

            Pap Pay Payroll Management System

        </div>

    </div>

</div>


<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
