<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="Employee Dashboard - PAP PAY Payroll Management System">

    <title>Dashboard | Employee Portal</title>

    <link rel="stylesheet"
        href="../../../../khen/assets/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet"
        href="../../../../khen/assets/css/style.css">


    <style>

        /* =========================================================
           PAP PAY EMPLOYEE DASHBOARD
           PAGE-SPECIFIC CSS ONLY
        ========================================================= */

        :root {

            --payroll-primary: #2563eb;
            --payroll-primary-dark: #1d4ed8;

            --payroll-navy: #0f172a;
            --payroll-heading: #172033;
            --payroll-text: #334155;
            --payroll-muted: #64748b;
            --payroll-light-text: #94a3b8;

            --payroll-border: #dbe3ec;
            --payroll-border-light: #edf1f5;

            --payroll-background: #f4f7fb;
            --payroll-white: #ffffff;

            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --info: #0891b2;

            --shadow-sm:
                0 2px 8px rgba(15, 23, 42, 0.045);

            --shadow-md:
                0 8px 24px rgba(15, 23, 42, 0.075);

            --shadow-lg:
                0 16px 40px rgba(15, 23, 42, 0.12);
        }


        /* =========================================================
           PAGE BASE
        ========================================================= */

        html {
            scroll-behavior: smooth;
        }

        body {

            margin: 0;

            background: var(--payroll-background);

            color: var(--payroll-text);

            /* SAME FONT FAMILY AS ATTENDANCE / ADMIN PAGES */
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Helvetica,
                Arial,
                sans-serif;

            font-size: 1rem;

            line-height: 1.6;

            -webkit-font-smoothing: antialiased;

            text-rendering: optimizeLegibility;

            overflow-x: hidden;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        button,
        input,
        textarea,
        select {
            font: inherit;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        .admin-shell {
            min-height: 100vh;
        }

        .admin-main {

            min-height: 100vh;

            background:
                var(--payroll-background);
        }

        .dashboard-content {

            min-height:
                calc(100vh - 72px);
        }

        .dashboard-container {

            width: 100%;

            max-width: 1700px;

            margin: 0 auto;
        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .admin-navbar {

            height: 72px;

            background: #ffffff !important;

            border-bottom:
                1px solid var(--payroll-border);

            box-shadow:
                0 2px 10px rgba(15, 23, 42, 0.05);

            position: sticky;

            top: 0;

            z-index: 100;
        }


        /* =========================================================
           SEARCH
        ========================================================= */

        .search-input {

            height: 44px;

            border:
                1px solid #d6e0eb !important;

            background:
                #f8fafc !important;

            border-radius: 10px !important;

            color:
                var(--payroll-heading);

            font-size: 0.92rem;

            font-weight: 500;

            padding-left: 16px;

            padding-right: 16px;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .search-input::placeholder {

            color:
                #64748b;

            opacity: 1;
        }

        .search-input:focus {

            background:
                #ffffff !important;

            border-color:
                rgba(37, 99, 235, 0.55) !important;

            box-shadow:
                0 0 0 3px
                rgba(37, 99, 235, 0.10) !important;

            outline: none;
        }


        /* =========================================================
           NAVBAR ACTIONS
        ========================================================= */

        .navbar-actions {

            display: flex;

            align-items: center;

            gap: 7px;
        }


        .icon-button {

            width: 42px;

            height: 42px;

            flex: 0 0 42px;

            border:
                1px solid transparent;

            border-radius: 10px;

            background:
                transparent;

            color:
                #475569;

            display: flex;

            align-items: center;

            justify-content: center;

            position: relative;

            cursor: pointer;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                border-color 0.2s ease;
        }

        .icon-button:hover {

            background:
                #f1f5f9;

            color:
                var(--payroll-primary);

            border-color:
                #e2e8f0;
        }

        .icon-button:focus-visible {

            outline:
                3px solid
                rgba(37, 99, 235, 0.18);

            outline-offset: 2px;
        }

        .icon-button i {

            font-size: 1.2rem;

            line-height: 1;
        }


        /* =========================================================
           NOTIFICATION DOT
        ========================================================= */

        .notification-dot {

            position: absolute;

            top: 6px;

            right: 6px;

            width: 9px;

            height: 9px;

            border-radius: 50%;

            background:
                #ef4444;

            border:
                2px solid #ffffff;
        }


        /* =========================================================
           NOTIFICATION DROPDOWN
        ========================================================= */

        .notification-menu {

            width: 365px;

            max-width:
                calc(100vw - 24px);

            padding: 0;

            border:
                1px solid var(--payroll-border);

            border-radius: 13px;

            overflow: hidden;

            box-shadow:
                var(--shadow-lg);
        }

        .notification-menu .dropdown-header {

            padding:
                16px 18px;

            background:
                #f8fafc;

            border-bottom:
                1px solid var(--payroll-border-light);

            color:
                var(--payroll-navy);

            font-size:
                0.88rem;

            font-weight:
                750;

            letter-spacing:
                0.01em;
        }

        .notification-menu .dropdown-item {

            padding:
                14px 18px;

            white-space:
                normal;

            border-bottom:
                1px solid #f1f5f9;

            transition:
                background 0.15s ease;
        }

        .notification-menu .dropdown-item:last-child {
            border-bottom: 0;
        }

        .notification-menu .dropdown-item:hover {

            background:
                #f8fafc;
        }

        .notification-menu .dropdown-item:focus {

            background:
                #eff6ff;

            color:
                inherit;
        }

        .notification-title {

            display: block;

            color:
                var(--payroll-heading);

            font-size:
                0.86rem;

            font-weight:
                700;

            line-height:
                1.45;

            margin-bottom:
                4px;
        }

        .notification-time {

            display: block;

            color:
                #64748b;

            font-size:
                0.78rem;

            line-height:
                1.55;
        }


        /* =========================================================
           PROFILE
        ========================================================= */

        .profile-button {

            border:
                1px solid transparent;

            background:
                transparent;

            border-radius:
                10px;

            padding:
                4px 8px;

            display:
                flex;

            align-items:
                center;

            gap:
                9px;

            color:
                var(--payroll-heading);

            transition:
                background 0.2s ease,
                border-color 0.2s ease;
        }

        .profile-button:hover {

            background:
                #f8fafc;

            border-color:
                var(--payroll-border);
        }

        .profile-button:focus-visible {

            outline:
                3px solid
                rgba(37, 99, 235, 0.18);

            outline-offset:
                2px;
        }

        .profile-name {

            font-size:
                0.88rem;

            font-weight:
                650;

            color:
                var(--payroll-heading);
        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .dashboard-header {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                20px;

            margin-bottom:
                24px;
        }

        .dashboard-header h1 {

            margin:
                0;

            color:
                var(--payroll-navy);

            font-size:
                clamp(1.65rem, 2.5vw, 2.1rem);

            line-height:
                1.2;

            font-weight:
                750;

            letter-spacing:
                -0.035em;
        }

        .dashboard-header p {

            margin:
                7px 0 0;

            color:
                #64748b;

            font-size:
                0.92rem;

            line-height:
                1.6;

            font-weight:
                450;
        }

        .header-date {

            display:
                flex;

            align-items:
                center;

            gap:
                8px;

            padding:
                10px 14px;

            border:
                1px solid var(--payroll-border);

            border-radius:
                10px;

            background:
                #ffffff;

            color:
                #475569;

            font-size:
                0.8rem;

            font-weight:
                600;

            white-space:
                nowrap;

            box-shadow:
                var(--shadow-sm);
        }

        .header-date i {

            color:
                var(--payroll-primary);

            font-size:
                0.95rem;
        }


        /* =========================================================
           HERO
        ========================================================= */

        .hero-banner {

            position:
                relative;

            width:
                100%;

            min-height:
                260px;

            margin-bottom:
                28px;

            border-radius:
                17px;

            overflow:
                hidden;

            background:
                var(--payroll-navy);

            box-shadow:
                var(--shadow-md);
        }

        .hero-banner img {

            display:
                block;

            width:
                100%;

            height:
                260px;

            object-fit:
                cover;

            filter:
                brightness(0.55);
        }

        .hero-overlay {

            position:
                absolute;

            inset:
                0;

            display:
                flex;

            flex-direction:
                column;

            justify-content:
                center;

            padding:
                clamp(28px, 5vw, 52px);

            color:
                #ffffff;

            background:
                linear-gradient(
                    90deg,
                    rgba(15, 23, 42, 0.96) 0%,
                    rgba(15, 23, 42, 0.78) 43%,
                    rgba(15, 23, 42, 0.18) 100%
                );
        }

        .hero-badge {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                7px;

            width:
                fit-content;

            padding:
                7px 12px;

            margin-bottom:
                13px;

            border:
                1px solid rgba(255, 255, 255, 0.24);

            border-radius:
                999px;

            background:
                rgba(255, 255, 255, 0.11);

            backdrop-filter:
                blur(8px);

            font-size:
                0.73rem;

            font-weight:
                650;

            line-height:
                1.3;

            letter-spacing:
                0.02em;
        }

        .hero-overlay h2 {

            max-width:
                780px;

            margin:
                0 0 10px;

            font-size:
                clamp(1.5rem, 3vw, 2.15rem);

            line-height:
                1.25;

            font-weight:
                750;

            letter-spacing:
                -0.03em;

            color:
                #ffffff;
        }

        .hero-overlay p {

            max-width:
                760px;

            margin:
                0;

            color:
                rgba(255, 255, 255, 0.91);

            font-size:
                0.92rem;

            line-height:
                1.7;

            font-weight:
                450;
        }


        /* =========================================================
           DASHBOARD STATISTICS

           MATCHES THE ATTENDANCE PAGE METRIC CARDS
        ========================================================= */

        .stats-section {

            margin-bottom:
                34px;
        }


        /*
         * EXACT ATTENDANCE-STYLE CARD
         *
         * Attendance reference:
         * - min-height: 165px
         * - padding: 25px 25px 22px
         * - label: .92rem / 750
         * - value: clamp(2rem, 3.2vw, 2.65rem) / 850
         * - meta: .9rem / 500
         */

        .stats-section .stat-card {

            position:
                relative;

            height:
                100%;

            min-height:
                165px;

            padding:
                25px 25px 22px;

            display:
                flex;

            flex-direction:
                column;

            background:
                #ffffff;

            border:
                1px solid var(--payroll-border);

            border-radius:
                17px;

            box-shadow:
                0 7px 24px rgba(15, 23, 42, 0.07);

            overflow:
                hidden;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }


        /* Colored left border */

        .stats-section .stat-card::before {

            content:
                "";

            position:
                absolute;

            top:
                0;

            left:
                0;

            width:
                5px;

            height:
                100%;

            background:
                #2563eb;
        }

        .stats-section .stat-card.stat-present::before {

            background:
                #078a63;
        }

        .stats-section .stat-card.stat-leave::before {

            background:
                #b86a00;
        }

        .stats-section .stat-card.stat-pending::before {

            background:
                #078a63;
        }

        .stats-section .stat-card.stat-ob::before {

            background:
                #3157d5;
        }


        /* Hover */

        .stats-section .stat-card:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 14px 35px rgba(15, 23, 42, 0.12);
        }


        /* =========================================================
           STAT TOP ROW
        ========================================================= */

        .stats-section .stat-top {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                15px;

            min-height:
                45px;
        }


        /* =========================================================
           STAT LABEL

           SAME AS ATTENDANCE
        ========================================================= */

        .stats-section .stat-label {

            color:
                #536174;

            font-size:
                0.92rem;

            font-weight:
                750;

            text-transform:
                uppercase;

            letter-spacing:
                0.055em;

            line-height:
                1.4;

            margin:
                0;

            padding-left:
                2px;
        }


        /* =========================================================
           STAT ICON
        ========================================================= */

        .stats-section .stat-icon {

            width:
                46px;

            height:
                46px;

            flex:
                0 0 46px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                11px;

            font-size:
                1.15rem;

            line-height:
                1;
        }


        /* Present */

        .stats-section .stat-icon.blue {

            background:
                #e8f8f2;

            color:
                #078a63;
        }


        /* Leave */

        .stats-section .stat-icon.orange {

            background:
                #fff5df;

            color:
                #b86a00;
        }


        /* Pending */

        .stats-section .stat-icon.green {

            background:
                #e8f8f2;

            color:
                #078a63;
        }


        /* OB */

        .stats-section .stat-icon.cyan {

            background:
                #eef2ff;

            color:
                #3157d5;
        }


        /* =========================================================
           STAT VALUE

           SAME AS ATTENDANCE
        ========================================================= */

        .stats-section .stat-value {

            color:
                #0f172a;

            font-size:
                clamp(2rem, 3.2vw, 2.65rem);

            font-weight:
                850;

            letter-spacing:
                -0.04em;

            line-height:
                1.1;

            margin:
                18px 0 0;

        }


        /* =========================================================
           STAT META

           SAME AS ATTENDANCE
        ========================================================= */

        .stats-section .stat-subtitle {

            color:
                #536174;

            font-size:
                0.9rem;

            font-weight:
                500;

            line-height:
                1.45;

            margin:
                11px 0 0;
        }


        /* =========================================================
           SECTION HEADERS
        ========================================================= */

        .section-header {

            margin-bottom:
                16px;
        }

        .section-header h3 {

            margin:
                0;

            color:
                var(--payroll-navy);

            font-size:
                1.12rem;

            line-height:
                1.35;

            font-weight:
                750;
        }

        .section-header p {

            margin:
                5px 0 0;

            color:
                #64748b;

            font-size:
                0.8rem;

            line-height:
                1.5;
        }


        /* =========================================================
           QUICK ACTIONS
        ========================================================= */

        .quick-actions-section {

            margin-bottom:
                34px;
        }

        .quick-action {

            position:
                relative;

            height:
                100%;

            min-height:
                165px;

            display:
                flex;

            flex-direction:
                column;

            align-items:
                flex-start;

            justify-content:
                flex-start;

            padding:
                21px;

            overflow:
                hidden;

            background:
                #ffffff;

            border:
                1px solid var(--payroll-border);

            border-radius:
                14px;

            color:
                inherit;

            text-decoration:
                none;

            box-shadow:
                var(--shadow-sm);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }

        .quick-action::after {

            content:
                "";

            position:
                absolute;

            right:
                -38px;

            bottom:
                -38px;

            width:
                95px;

            height:
                95px;

            border-radius:
                50%;

            background:
                rgba(37, 99, 235, 0.045);

            pointer-events:
                none;
        }

        .quick-action:hover {

            transform:
                translateY(-3px);

            color:
                inherit;

            border-color:
                rgba(37, 99, 235, 0.30);

            box-shadow:
                0 10px 25px rgba(15, 23, 42, 0.085);
        }

        .quick-action:focus-visible {

            outline:
                3px solid
                rgba(37, 99, 235, 0.18);

            outline-offset:
                2px;
        }

        .quick-action-icon {

            width:
                47px;

            height:
                47px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            margin-bottom:
                17px;

            border-radius:
                11px;

            font-size:
                1.25rem;
        }

        .quick-action-icon.leave {

            background:
                #eef2ff;

            color:
                #4f46e5;
        }

        .quick-action-icon.payslip {

            background:
                #ecfdf5;

            color:
                #059669;
        }

        .quick-action-icon.attendance {

            background:
                #eff6ff;

            color:
                #2563eb;
        }

        .quick-action h5 {

            margin:
                0 0 6px;

            color:
                var(--payroll-navy);

            font-size:
                0.98rem;

            line-height:
                1.35;

            font-weight:
                750;
        }

        .quick-action p {

            margin:
                0;

            color:
                #64748b;

            font-size:
                0.8rem;

            line-height:
                1.55;

            font-weight:
                450;
        }


        /* =========================================================
           SECONDARY QUICK LINKS
        ========================================================= */

        .secondary-actions {

            margin-top:
                13px;
        }

        .small-action {

            min-height:
                82px;

            flex-direction:
                row;

            align-items:
                center;

            gap:
                12px;

            padding:
                15px 17px;
        }

        .small-action::after {

            width:
                65px;

            height:
                65px;

            right:
                -28px;

            bottom:
                -28px;
        }

        .small-action-icon {

            width:
                40px;

            height:
                40px;

            flex:
                0 0 40px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                9px;

            background:
                #f8fafc;

            color:
                #64748b;

            font-size:
                1rem;
        }

        .small-action h6 {

            margin:
                0;

            color:
                var(--payroll-navy);

            font-size:
                0.82rem;

            line-height:
                1.4;

            font-weight:
                700;
        }


        /* =========================================================
           ANNOUNCEMENTS
        ========================================================= */

        .announcements-section {

            margin-bottom:
                32px;
        }

        .dashboard-panel {

            width:
                100%;

            background:
                #ffffff;

            border:
                1px solid var(--payroll-border);

            border-radius:
                15px;

            overflow:
                hidden;

            box-shadow:
                var(--shadow-sm);
        }

        .panel-header {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                15px;

            padding:
                20px 22px;

            border-bottom:
                1px solid var(--payroll-border-light);
        }

        .panel-header h2 {

            margin:
                0 0 5px;

            color:
                var(--payroll-navy);

            font-size:
                1.08rem;

            line-height:
                1.35;

            font-weight:
                750;
        }

        .panel-header p {

            margin:
                0;

            color:
                #64748b;

            font-size:
                0.78rem;

            line-height:
                1.5;
        }

        .panel-header .btn {

            border:
                1px solid var(--payroll-border);

            border-radius:
                9px;

            background:
                #ffffff;

            color:
                var(--payroll-navy);

            font-size:
                0.78rem;

            font-weight:
                650;

            padding:
                8px 12px;

            white-space:
                nowrap;

            transition:
                background 0.2s ease,
                border-color 0.2s ease;
        }

        .panel-header .btn:hover {

            background:
                #f8fafc;

            border-color:
                #cbd5e1;
        }

        .activity-list {

            padding:
                2px 22px 7px;
        }

        .activity-item {

            display:
                flex;

            align-items:
                flex-start;

            gap:
                13px;

            padding:
                17px 0;

            border-bottom:
                1px solid #f1f5f9;
        }

        .activity-item:last-child {

            border-bottom:
                0;
        }

        .activity-dot {

            width:
                9px;

            height:
                9px;

            flex:
                0 0 9px;

            margin-top:
                7px;

            border-radius:
                50%;
        }

        .activity-item p {

            line-height:
                1.55;
        }

        .activity-item .fw-semibold {

            color:
                var(--payroll-navy);

            font-size:
                0.85rem;

            line-height:
                1.45;

            font-weight:
                700;
        }

        .activity-item .small {

            color:
                #64748b !important;

            font-size:
                0.77rem;

            line-height:
                1.6;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .admin-footer {

            margin-top:
                0;

            border-top:
                1px solid var(--payroll-border);

            background:
                #ffffff;
        }

        .admin-footer .container-fluid {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                15px;

            padding-top:
                18px;

            padding-bottom:
                18px;

            color:
                #64748b;

            font-size:
                0.73rem;

            line-height:
                1.6;
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 1199.98px) {

            .dashboard-container {

                max-width:
                    100%;
            }

            .stats-section .stat-card {

                min-height:
                    165px;

                padding:
                    23px 23px 21px;
            }

            .stats-section .stat-value {

                font-size:
                    2.35rem;
            }

            .quick-action {

                min-height:
                    158px;
            }
        }


        /* =========================================================
           SMALL LAPTOP / TABLET
        ========================================================= */

        @media (max-width: 991.98px) {

            .admin-navbar {

                height:
                    68px;
            }

            .dashboard-content {

                min-height:
                    auto;
            }

            .dashboard-header {

                margin-bottom:
                    21px;
            }

            .dashboard-header h1 {

                font-size:
                    1.75rem;
            }

            .dashboard-header p {

                font-size:
                    0.87rem;
            }

            .hero-banner {

                min-height:
                    250px;
            }

            .hero-banner img {

                height:
                    250px;
            }

            .hero-overlay {

                padding:
                    30px;
            }

            .hero-overlay h2 {

                font-size:
                    1.65rem;
            }

            .hero-overlay p {

                font-size:
                    0.86rem;
            }


            /* Attendance-style cards */

            .stats-section .stat-card {

                min-height:
                    155px;

                padding:
                    22px;
            }

            .stats-section .stat-top {

                min-height:
                    42px;
            }

            .stats-section .stat-icon {

                width:
                    43px;

                height:
                    43px;

                flex-basis:
                    43px;
            }

            .stats-section .stat-label {

                font-size:
                    0.84rem;
            }

            .stats-section .stat-value {

                font-size:
                    2.2rem;

                margin-top:
                    15px;
            }

            .stats-section .stat-subtitle {

                font-size:
                    0.86rem;

                margin-top:
                    10px;
            }

            .quick-action {

                min-height:
                    150px;

                padding:
                    18px;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767.98px) {

            .admin-navbar {

                height:
                    64px;
            }

            .dashboard-content .container-fluid {

                padding-top:
                    20px !important;

                padding-left:
                    14px !important;

                padding-right:
                    14px !important;
            }


            /* Header */

            .dashboard-header {

                align-items:
                    flex-start;

                flex-direction:
                    column;

                gap:
                    12px;

                margin-bottom:
                    19px;
            }

            .dashboard-header h1 {

                font-size:
                    1.5rem;

                line-height:
                    1.25;
            }

            .dashboard-header p {

                font-size:
                    0.8rem;

                line-height:
                    1.55;
            }

            .header-date {

                width:
                    100%;

                justify-content:
                    center;

                padding:
                    9px 10px;

                font-size:
                    0.76rem;
            }


            /* Hero */

            .hero-banner {

                min-height:
                    275px;

                margin-bottom:
                    22px;

                border-radius:
                    14px;
            }

            .hero-banner img {

                height:
                    275px;
            }

            .hero-overlay {

                padding:
                    22px;

                justify-content:
                    flex-end;

                background:
                    linear-gradient(
                        0deg,
                        rgba(15, 23, 42, 0.96) 0%,
                        rgba(15, 23, 42, 0.70) 58%,
                        rgba(15, 23, 42, 0.16) 100%
                    );
            }

            .hero-badge {

                padding:
                    6px 10px;

                margin-bottom:
                    9px;

                font-size:
                    0.65rem;
            }

            .hero-overlay h2 {

                font-size:
                    1.22rem;

                line-height:
                    1.3;

                margin-bottom:
                    7px;
            }

            .hero-overlay p {

                font-size:
                    0.75rem;

                line-height:
                    1.6;
            }


            /* =====================================================
               MOBILE STATISTICS

               SAME PROPORTIONS AS ATTENDANCE
            ===================================================== */

            .stats-section {

                margin-bottom:
                    27px;
            }

            .stats-section .stat-card {

                min-height:
                    145px;

                padding:
                    19px 17px 17px;

                border-radius:
                    13px;

                border-left-width:
                    5px;
            }

            .stats-section .stat-top {

                min-height:
                    38px;
            }

            .stats-section .stat-icon {

                width:
                    39px;

                height:
                    39px;

                flex-basis:
                    39px;

                border-radius:
                    9px;

                font-size:
                    0.95rem;
            }

            .stats-section .stat-label {

                font-size:
                    0.69rem;

                letter-spacing:
                    0.045em;

                line-height:
                    1.3;
            }

            .stats-section .stat-value {

                font-size:
                    1.8rem;

                margin-top:
                    13px;
            }

            .stats-section .stat-subtitle {

                margin-top:
                    9px;

                font-size:
                    0.72rem;

                line-height:
                    1.4;
            }


            /* Section headings */

            .section-header {

                margin-bottom:
                    13px;
            }

            .section-header h3 {

                font-size:
                    1rem;
            }

            .section-header p {

                font-size:
                    0.73rem;

                line-height:
                    1.5;
            }


            /* Quick actions */

            .quick-actions-section {

                margin-bottom:
                    27px;
            }

            .quick-action {

                min-height:
                    143px;

                padding:
                    17px;
            }

            .quick-action-icon {

                width:
                    43px;

                height:
                    43px;

                margin-bottom:
                    12px;

                font-size:
                    1.1rem;
            }

            .quick-action h5 {

                font-size:
                    0.88rem;

                margin-bottom:
                    5px;
            }

            .quick-action p {

                font-size:
                    0.72rem;

                line-height:
                    1.55;
            }


            /* Small actions */

            .small-action {

                min-height:
                    72px;

                padding:
                    12px 13px;
            }

            .small-action-icon {

                width:
                    37px;

                height:
                    37px;

                flex-basis:
                    37px;

                font-size:
                    0.9rem;
            }

            .small-action h6 {

                font-size:
                    0.75rem;

                line-height:
                    1.4;
            }


            /* Announcements */

            .dashboard-panel {

                border-radius:
                    13px;
            }

            .panel-header {

                padding:
                    16px;

                align-items:
                    flex-start;
            }

            .panel-header h2 {

                font-size:
                    0.97rem;
            }

            .panel-header p {

                font-size:
                    0.71rem;

                line-height:
                    1.5;
            }

            .panel-header .btn {

                font-size:
                    0.7rem;

                padding:
                    7px 10px;
            }

            .activity-list {

                padding-left:
                    16px;

                padding-right:
                    16px;
            }

            .activity-item {

                padding:
                    15px 0;

                gap:
                    11px;
            }

            .activity-item .fw-semibold {

                font-size:
                    0.79rem;
            }

            .activity-item .small {

                font-size:
                    0.72rem;

                line-height:
                    1.55;
            }


            /* Notification */

            .notification-menu {

                position:
                    fixed !important;

                top:
                    60px !important;

                left:
                    10px !important;

                right:
                    10px !important;

                width:
                    auto !important;

                max-width:
                    none;
            }


            /* Profile */

            .profile-button {

                padding:
                    3px;
            }

            .profile-name {

                display:
                    none !important;
            }


            /* Footer */

            .admin-footer .container-fluid {

                flex-direction:
                    column;

                justify-content:
                    center;

                text-align:
                    center;

                padding-top:
                    16px;

                padding-bottom:
                    16px;
            }
        }


        /* =========================================================
           SMALL PHONES
        ========================================================= */

        @media (max-width: 575.98px) {

            .navbar-actions {

                gap:
                    1px;
            }

            .icon-button {

                width:
                    37px;

                height:
                    37px;

                flex-basis:
                    37px;
            }

            .dashboard-content .container-fluid {

                padding-left:
                    11px !important;

                padding-right:
                    11px !important;
            }


            /* Header */

            .dashboard-header h1 {

                font-size:
                    1.4rem;
            }

            .dashboard-header p {

                font-size:
                    0.76rem;
            }


            /* Hero */

            .hero-banner {

                min-height:
                    290px;
            }

            .hero-banner img {

                height:
                    290px;
            }

            .hero-overlay {

                padding:
                    19px;
            }

            .hero-overlay h2 {

                font-size:
                    1.1rem;
            }

            .hero-overlay p {

                font-size:
                    0.71rem;

                line-height:
                    1.55;
            }


            /* =====================================================
               SMALL PHONE STAT CARDS
            ===================================================== */

            .stats-section .stat-card {

                min-height:
                    135px;

                padding:
                    17px 14px 15px;

                border-radius:
                    11px;
            }

            .stats-section .stat-top {

                min-height:
                    34px;
            }

            .stats-section .stat-icon {

                width:
                    35px;

                height:
                    35px;

                flex-basis:
                    35px;

                font-size:
                    0.85rem;

                border-radius:
                    8px;
            }

            .stats-section .stat-label {

                font-size:
                    0.59rem;

                letter-spacing:
                    0.035em;
            }

            .stats-section .stat-value {

                font-size:
                    1.55rem;

                margin-top:
                    11px;
            }

            .stats-section .stat-subtitle {

                margin-top:
                    8px;

                font-size:
                    0.65rem;

                line-height:
                    1.35;
            }


            /* Quick actions */

            .quick-action {

                min-height:
                    126px;

                padding:
                    14px;
            }

            .quick-action-icon {

                width:
                    39px;

                height:
                    39px;

                margin-bottom:
                    10px;

                font-size:
                    1rem;
            }

            .quick-action h5 {

                font-size:
                    0.81rem;
            }

            .quick-action p {

                font-size:
                    0.68rem;

                line-height:
                    1.5;
            }


            /* Small actions */

            .small-action {

                min-height:
                    67px;
            }

            .small-action h6 {

                font-size:
                    0.69rem;
            }


            /* Announcements */

            .panel-header {

                gap:
                    9px;
            }

            .panel-header h2 {

                font-size:
                    0.9rem;
            }

            .panel-header p {

                font-size:
                    0.67rem;
            }

            .panel-header .btn {

                font-size:
                    0.67rem;

                padding:
                    6px 9px;
            }
        }


        /* =========================================================
           EXTRA SMALL PHONES
        ========================================================= */

        @media (max-width: 380px) {

            body {

                font-size:
                    14px;
            }

            .dashboard-content .container-fluid {

                padding-left:
                    9px !important;

                padding-right:
                    9px !important;
            }

            .dashboard-header h1 {

                font-size:
                    1.3rem;
            }

            .dashboard-header p {

                font-size:
                    0.72rem;
            }


            /* Hero */

            .hero-banner {

                min-height:
                    305px;
            }

            .hero-banner img {

                height:
                    305px;
            }

            .hero-overlay {

                padding:
                    17px;
            }

            .hero-overlay h2 {

                font-size:
                    1.02rem;
            }

            .hero-overlay p {

                font-size:
                    0.67rem;

                line-height:
                    1.5;
            }


            /* Stats */

            .stats-section .stat-card {

                min-height:
                    125px;

                padding:
                    15px 12px 13px;
            }

            .stats-section .stat-top {

                min-height:
                    31px;
            }

            .stats-section .stat-icon {

                width:
                    32px;

                height:
                    32px;

                flex-basis:
                    32px;

                font-size:
                    0.76rem;
            }

            .stats-section .stat-label {

                font-size:
                    0.52rem;

                letter-spacing:
                    0.025em;
            }

            .stats-section .stat-value {

                font-size:
                    1.35rem;

                margin-top:
                    9px;
            }

            .stats-section .stat-subtitle {

                margin-top:
                    7px;

                font-size:
                    0.58rem;
            }


            /* Quick actions */

            .quick-action {

                min-height:
                    118px;

                padding:
                    12px;
            }

            .quick-action-icon {

                width:
                    37px;

                height:
                    37px;

                margin-bottom:
                    9px;
            }

            .quick-action h5 {

                font-size:
                    0.76rem;
            }

            .quick-action p {

                font-size:
                    0.62rem;

                line-height:
                    1.45;
            }


            /* Small action */

            .small-action {

                min-height:
                    63px;

                padding:
                    10px;
            }

            .small-action-icon {

                width:
                    34px;

                height:
                    34px;

                flex-basis:
                    34px;

                font-size:
                    0.82rem;
            }

            .small-action h6 {

                font-size:
                    0.65rem;
            }
        }


        /* =========================================================
           ACCESSIBILITY
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            html {
                scroll-behavior:
                    auto !important;
            }

            *,
            *::before,
            *::after {

                animation-duration:
                    0.01ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    0.01ms !important;

                scroll-behavior:
                    auto !important;
            }
        }

    </style>

</head>


<body>

    <div class="admin-shell">


        <!-- =====================================================
             SIDEBAR BACKDROP
        ====================================================== -->

        <div class="sidebar-backdrop"
            data-sidebar-close>
        </div>


        <!-- =====================================================
             SIDEBAR
        ====================================================== -->

        <aside class="admin-sidebar"
            id="adminSidebar"
            aria-label="Main navigation">

            <div class="sidebar-header">

            <a class="brand-mark"
               href="{{ route('dashboard') }}"
               aria-label="Admin Dashboard">

                <img src="../../../khen/assets/images/logo.jpg"
                     alt="Pap Pay Logo"
                     class="brand-logo">

            </a>

        </div>


            <!-- Sidebar Navigation -->

            <nav class="sidebar-nav">

                <a class="nav-link active"
                    href="{{ route('dashboard') }}"
                    aria-current="page">

                    <span class="nav-icon">
                        <i class="bi bi-grid-1x2"
                            aria-hidden="true">
                        </i>
                    </span>

                    <span class="nav-text">
                        Dashboard
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('attendance') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-check"
                            aria-hidden="true">
                        </i>
                    </span>

                    <span class="nav-text">
                        Attendance
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('file_leave') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-plus"
                            aria-hidden="true">
                        </i>
                    </span>

                    <span class="nav-text">
                        File Leave
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('file_ob') }}">

                    <span class="nav-icon">
                        <i class="bi bi-briefcase"
                            aria-hidden="true">
                        </i>
                    </span>

                    <span class="nav-text">
                        File OB
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('payslip') }}">

                    <span class="nav-icon">
                        <i class="bi bi-receipt"
                            aria-hidden="true">
                        </i>
                    </span>

                    <span class="nav-text">
                        Payslip
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('employee.announcements') }}">

                    <span class="nav-icon">
                        <i class="bi bi-megaphone"
                            aria-hidden="true">
                        </i>
                    </span>

                    <span class="nav-text">
                        Announcements
                    </span>

                </a>


                <a class="nav-link"
                    href="{{ route('my_profile') }}">

                    <span class="nav-icon">
                        <i class="bi bi-person"
                            aria-hidden="true">
                        </i>
                    </span>

                    <span class="nav-text">
                        My Profile
                    </span>

                </a>

            </nav>


            <!-- Sidebar Employee -->

            <div class="sidebar-user">

                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ $employee->photo
                        ? asset('storage/' . $employee->photo)
                        : asset('images/default-avatar.png') }}"
                    alt="{{ $employee->name ?? 'Employee' }}">

                <strong>
                    {{ $employee->name ?? 'Employee Name' }}
                </strong>

                <small>
                    {{ $employee->position ?? 'Position' }}
                </small>

            </div>


            <!-- Sidebar Footer -->

            <div class="sidebar-footer">

                <span class="status-dot"></span>

                <span class="sidebar-footer-text">
                    System Online
                </span>

            </div>

        </aside>


        <!-- =====================================================
             MAIN
        ====================================================== -->

        <div class="admin-main">


            <!-- =================================================
                 NAVBAR
            ================================================== -->

            <nav class="navbar admin-navbar navbar-expand bg-white">

                <div class="container-fluid px-3 px-lg-4">


                    <!-- Sidebar Toggle -->

                    <button class="sidebar-toggle"
                        type="button"
                        data-sidebar-toggle
                        aria-controls="adminSidebar"
                        aria-expanded="true"
                        aria-label="Toggle sidebar">

                        <span></span>
                        <span></span>
                        <span></span>

                    </button>


                    <!-- Search -->

                    <form class="d-none d-md-flex ms-3 flex-grow-1"
                        action="{{ route('search') }}"
                        method="GET">

                        <input
                            class="form-control search-input"
                            type="search"
                            name="search"
                            placeholder="Search attendance, leave, payroll..."
                            aria-label="Search employee portal"
                            required>

                    </form>


                    <!-- Navbar Actions -->

                    <div class="navbar-actions ms-auto">


                        <!-- Theme -->

                        <button class="icon-button theme-toggle"
                            type="button"
                            data-theme-toggle
                            aria-label="Switch color theme"
                            title="Switch color theme">

                            <i class="bi bi-moon-stars"
                                data-theme-icon
                                aria-hidden="true">
                            </i>

                        </button>


                        <!-- Notifications -->

                        <div class="dropdown">

                            <button class="icon-button"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                aria-label="Notifications">

                                @if (isset($notifications) && $notifications->count())

                                    <span class="notification-dot"></span>

                                @endif

                                <i class="bi bi-bell"
                                    aria-hidden="true">
                                </i>

                            </button>


                            <div class="dropdown-menu dropdown-menu-end notification-menu">

                                <div class="dropdown-header fw-bold">
                                    Notifications
                                </div>


                                @forelse ($notifications ?? [] as $notification)

                                    <a class="dropdown-item"
                                        href="{{ url($notification->url) }}">

                                        <span class="notification-title">
                                            {{ $notification->title }}
                                        </span>

                                        <span class="notification-time">
                                            {{ $notification->message }}
                                        </span>

                                    </a>

                                @empty

                                    <div class="dropdown-item text-muted py-3">

                                        <i class="bi bi-check-circle me-2"></i>

                                        No notifications

                                    </div>

                                @endforelse

                            </div>

                        </div>


                        <!-- Profile -->

                        <div class="dropdown">

                            <button class="profile-button dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <img class="avatar-img avatar-sm"
                                    src="{{ $employee->photo
                                        ? asset('storage/' . $employee->photo)
                                        : asset('images/default-avatar.png') }}"
                                    alt="{{ $employee->name ?? 'Employee' }}">

                                <span class="profile-name d-none d-sm-inline">
                                    {{ $employee->name ?? 'Employee' }}
                                </span>

                            </button>


                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>

                                    <a class="dropdown-item"
                                        href="{{ route('my_profile') }}">

                                        <i class="bi bi-person me-2"></i>

                                        My Profile

                                    </a>

                                </li>


                                <li>

                                    <hr class="dropdown-divider">

                                </li>


                                <li>

                                    <form method="POST"
                                        action="{{ route('logout') }}">

                                        @csrf

                                        <button type="submit"
                                            class="dropdown-item">

                                            <i class="bi bi-box-arrow-right me-2"></i>

                                            Sign out

                                        </button>

                                    </form>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </nav>


            <!-- =================================================
                 CONTENT
            ================================================== -->

            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4 py-4 dashboard-container">


                    <!-- =================================================
                         DASHBOARD HEADER
                    ================================================== -->

                    <div class="dashboard-header">

                        <div>

                            <h1>
                                Dashboard
                            </h1>

                            <p>
                                Welcome back,
                                {{ $employee->name ?? 'Employee' }}.
                                Here's your employee portal overview.
                            </p>

                        </div>


                        <div class="header-date">

                            <i class="bi bi-calendar3"></i>

                            <span>
                                {{ now()->format('l, F d, Y') }}
                            </span>

                        </div>

                    </div>


                    <!-- =================================================
                         HERO BANNER
                    ================================================== -->

                    <div class="hero-banner">

                        <img src="../../../../khen/assets/images/image.png"
                            alt="School Campus">

                        <div class="hero-overlay">

                            <div class="hero-badge">

                                <i class="bi bi-shield-check"></i>

                                Employee Payroll Portal

                            </div>


                            <h2>
                                PAP PAY Payroll Management System
                            </h2>


                            <p>
                                Manage your attendance, leave requests,
                                payroll documents, official business records,
                                and employee information from one secure portal.
                            </p>

                        </div>

                    </div>


                    <!-- =================================================
                         STATISTICS
                    ================================================== -->

                    <section class="row g-3 stats-section"
                        aria-label="Employee statistics">


                        <!-- =================================================
                             DAYS PRESENT
                        ================================================== -->

                        <div class="col-6 col-lg-3">

                            <div class="stat-card stat-present">

                                <div class="stat-top">

                                    <div class="stat-label">
                                        Days Present
                                    </div>

                                    <div class="stat-icon blue">

                                        <i class="bi bi-calendar-check"></i>

                                    </div>

                                </div>


                                <div class="stat-value">
                                    {{ $presentDays ?? 0 }}
                                </div>


                                <div class="stat-subtitle">
                                    Total Present Days
                                </div>

                            </div>

                        </div>


                        <!-- =================================================
                             LEAVE BALANCE
                        ================================================== -->

                        <div class="col-6 col-lg-3">

                            <div class="stat-card stat-leave">

                                <div class="stat-top">

                                    <div class="stat-label">
                                        Leave Balance
                                    </div>

                                    <div class="stat-icon orange">

                                        <i class="bi bi-calendar-minus"></i>

                                    </div>

                                </div>


                                <div class="stat-value">
                                    {{ $leaveBalance ?? 0 }}
                                </div>


                                <div class="stat-subtitle">
                                    Available Leave Days
                                </div>

                            </div>

                        </div>


                        <!-- =================================================
                             PENDING REQUESTS
                        ================================================== -->

                        <div class="col-6 col-lg-3">

                            <div class="stat-card stat-pending">

                                <div class="stat-top">

                                    <div class="stat-label">
                                        Pending Requests
                                    </div>

                                    <div class="stat-icon green">

                                        <i class="bi bi-hourglass-split"></i>

                                    </div>

                                </div>


                                <div class="stat-value">
                                    {{ $pendingRequests ?? 0 }}
                                </div>


                                <div class="stat-subtitle">
                                    Awaiting Approval
                                </div>

                            </div>

                        </div>


                        <!-- =================================================
                             OB RECORDS
                        ================================================== -->

                        <div class="col-6 col-lg-3">

                            <div class="stat-card stat-ob">

                                <div class="stat-top">

                                    <div class="stat-label">
                                        OB Records
                                    </div>

                                    <div class="stat-icon cyan">

                                        <i class="bi bi-briefcase"></i>

                                    </div>

                                </div>


                                <div class="stat-value">
                                    {{ $obCount ?? 0 }}
                                </div>


                                <div class="stat-subtitle">
                                    Official Business Records
                                </div>

                            </div>

                        </div>

                    </section>


                    <!-- =================================================
                         QUICK ACTIONS
                    ================================================== -->

                    <section class="quick-actions-section">


                        <div class="section-header">

                            <h3>

                                <i class="bi bi-lightning-charge-fill text-warning me-2"></i>

                                Quick Actions

                            </h3>

                            <p>
                                Frequently used employee services
                            </p>

                        </div>


                        <!-- Primary Actions -->

                        <div class="row g-3">


                            <!-- File Leave -->

                            <div class="col-12 col-md-4">

                                <a href="{{ route('file_leave') }}"
                                    class="quick-action">

                                    <div class="quick-action-icon leave">

                                        <i class="bi bi-calendar-plus"></i>

                                    </div>

                                    <h5>
                                        File Leave
                                    </h5>

                                    <p>
                                        Submit a new leave request
                                    </p>

                                </a>

                            </div>


                            <!-- Payslip -->

                            <div class="col-12 col-md-4">

                                <a href="{{ route('payslip') }}"
                                    class="quick-action">

                                    <div class="quick-action-icon payslip">

                                        <i class="bi bi-receipt"></i>

                                    </div>

                                    <h5>
                                        View Payslip
                                    </h5>

                                    <p>
                                        Review your payroll records
                                    </p>

                                </a>

                            </div>


                            <!-- Attendance -->

                            <div class="col-12 col-md-4">

                                <a href="{{ route('attendance') }}"
                                    class="quick-action">

                                    <div class="quick-action-icon attendance">

                                        <i class="bi bi-calendar-check"></i>

                                    </div>

                                    <h5>
                                        Attendance
                                    </h5>

                                    <p>
                                        View your attendance records
                                    </p>

                                </a>

                            </div>

                        </div>


                        <!-- Secondary Actions -->

                        <div class="row g-3 secondary-actions">


                            <!-- File OB -->

                            <div class="col-6 col-md-3">

                                <a href="{{ route('file_ob') }}"
                                    class="quick-action small-action">

                                    <span class="small-action-icon">

                                        <i class="bi bi-briefcase"></i>

                                    </span>

                                    <h6>
                                        File OB
                                    </h6>

                                </a>

                            </div>


                            <!-- My Profile -->

                            <div class="col-6 col-md-3">

                                <a href="{{ route('my_profile') }}"
                                    class="quick-action small-action">

                                    <span class="small-action-icon">

                                        <i class="bi bi-person"></i>

                                    </span>

                                    <h6>
                                        My Profile
                                    </h6>

                                </a>

                            </div>


                            <!-- Announcements -->

                            <div class="col-6 col-md-3">

                                <a href="{{ route('employee.announcements') }}"
                                    class="quick-action small-action">

                                    <span class="small-action-icon">

                                        <i class="bi bi-megaphone"></i>

                                    </span>

                                    <h6>
                                        Announcements
                                    </h6>

                                </a>

                            </div>


                            <!-- Attendance Log -->

                            <div class="col-6 col-md-3">

                                <a href="{{ route('attendance') }}"
                                    class="quick-action small-action">

                                    <span class="small-action-icon">

                                        <i class="bi bi-clock-history"></i>

                                    </span>

                                    <h6>
                                        Attendance Log
                                    </h6>

                                </a>

                            </div>

                        </div>

                    </section>


                    <!-- =================================================
                         ANNOUNCEMENTS
                    ================================================== -->

                    <section class="announcements-section">

                        <div class="dashboard-panel">


                            <!-- Panel Header -->

                            <div class="panel-header">

                                <div>

                                    <h2>

                                        <i class="bi bi-megaphone text-primary me-2"></i>

                                        Announcements

                                    </h2>

                                    <p>
                                        Latest updates from administration and HR
                                    </p>

                                </div>


                                <a class="btn btn-light btn-sm"
                                    href="{{ route('employee.announcements') }}">

                                    View All

                                </a>

                            </div>


                            <!-- Announcement List -->

                            <div class="activity-list">

                                @forelse($announcements ?? [] as $announcement)

                                    <div class="activity-item">

                                        <span class="activity-dot bg-{{ $announcement->color }}"></span>

                                        <div>

                                            <p class="mb-1 fw-semibold">

                                                {{ $announcement->title }}

                                            </p>

                                            <p class="text-muted small mb-0">

                                                {{ $announcement->description }}

                                            </p>

                                        </div>

                                    </div>

                                @empty

                                    <div class="activity-item">

                                        <span class="activity-dot bg-secondary"></span>

                                        <div>

                                            <p class="mb-1 fw-semibold">
                                                No announcements
                                            </p>

                                            <p class="text-muted small mb-0">
                                                There are currently no new
                                                announcements from administration.
                                            </p>

                                        </div>

                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </section>

                </div>

            </main>


            <!-- =================================================
                 FOOTER
            ================================================== -->

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">

                    <span>

                        © 2026 Pap Pay Payroll Management System

                        <br>

                        Developed by Pap Pay Capstone Team

                    </span>


                    <span>
                        Version 1.0
                    </span>

                </div>

            </footer>

        </div>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================= -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

    <script src="../../../../khen/assets/js/main.js"></script>

</body>

</html>
