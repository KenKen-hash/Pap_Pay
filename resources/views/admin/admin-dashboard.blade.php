<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Pap Pay professional HR and payroll management dashboard">

    <meta name="theme-color" content="#172554">

    <title>Dashboard | Pap Pay</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <!-- Pap Pay Main CSS -->
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">


    <style>
        /* ==========================================================
           PAP PAY ADMIN DASHBOARD
        ========================================================== */

        :root {

            --pp-primary: #3157d5;
            --pp-primary-dark: #2446b8;
            --pp-primary-soft: #eef2ff;

            --pp-navy: #172554;
            --pp-navy-soft: #e8edff;

            --pp-green: #078a63;
            --pp-green-soft: #e8f8f2;

            --pp-amber: #b86a00;
            --pp-amber-soft: #fff5df;

            --pp-rose: #c92a4b;
            --pp-rose-soft: #fff0f3;

            --pp-purple: #7b3fc6;
            --pp-purple-soft: #f5edff;

            --pp-cyan: #087f91;
            --pp-cyan-soft: #e8faff;

            --pp-teal: #08786e;
            --pp-teal-soft: #e8faf7;

            --pp-text: #172033;
            --pp-text-strong: #0f172a;
            --pp-text-muted: #536174;
            --pp-text-light: #64748b;

            --pp-page: #f3f6fb;
            --pp-surface: #ffffff;
            --pp-surface-soft: #f8fafc;

            --pp-border: #d9e1ec;

            --pp-shadow:
                0 7px 24px rgba(15, 23, 42, 0.07);

            --pp-shadow-hover:
                0 14px 35px rgba(15, 23, 42, 0.12);

            --pp-radius: 17px;
        }


        /* ==========================================================
           GLOBAL
        ========================================================== */

        html {
            font-size: 16px;
            scroll-behavior: smooth;
        }

        body {

            background: var(--pp-page);

            color: var(--pp-text);

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

            overflow-x: hidden;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }


        /* ==========================================================
           DASHBOARD CONTENT
        ========================================================== */

        .dashboard-content {

            min-height:
                calc(100vh - 70px);

            width: 100%;

            overflow-x: hidden;
        }

        .dashboard-content .container-fluid {

            max-width: 1700px;

            margin: 0 auto;
        }


        /* ==========================================================
           DASHBOARD HEADER
           ICON + TITLE + DESCRIPTION
        ========================================================== */

        .dashboard-heading {

            display: flex;

            align-items: flex-start;

            gap: 18px;

            margin-bottom: 1.8rem;

            padding: 4px 2px;
        }

        .dashboard-heading-icon {

            flex: 0 0 58px;

            width: 58px;
            height: 58px;

            display: flex;

            align-items: center;
            justify-content: center;

            color: #ffffff;

            background:
                linear-gradient(135deg,
                    var(--pp-primary),
                    var(--pp-primary-dark));

            border-radius: 15px;

            font-size: 1.5rem;

            box-shadow:
                0 9px 22px rgba(49, 87, 213, .22);
        }

        .dashboard-heading-content {

            min-width: 0;
        }

        .dashboard-heading h1 {

            color: var(--pp-text-strong);

            font-size:
                clamp(1.55rem, 2.4vw, 2.15rem);

            font-weight: 800;

            letter-spacing: -0.035em;

            line-height: 1.2;

            margin: 0 0 5px;
        }

        .dashboard-heading p {

            color: var(--pp-text-muted) !important;

            font-size:
                clamp(.92rem, 1.1vw, 1.02rem);

            line-height: 1.6;

            max-width: 950px;

            margin: 0;
        }


        /* ==========================================================
           METRIC CARDS
        ========================================================== */

        .metric-card {

            position: relative;

            height: 100%;

            min-height: 165px;

            padding: 25px 25px 22px;

            background: var(--pp-surface);

            border:
                1px solid var(--pp-border);

            border-radius: var(--pp-radius);

            box-shadow: var(--pp-shadow);

            overflow: hidden;

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .metric-card:hover {

            transform:
                translateY(-3px);

            box-shadow:
                var(--pp-shadow-hover);
        }

        .metric-card::before {

            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 5px;
            height: 100%;

            background: var(--pp-primary);
        }

        .metric-success::before {
            background: var(--pp-green);
        }

        .metric-warning::before {
            background: var(--pp-amber);
        }

        .metric-danger::before {
            background: var(--pp-rose);
        }

        .metric-label {

            color: var(--pp-text-muted);

            font-size: .92rem;

            font-weight: 750;

            text-transform: uppercase;

            letter-spacing: .055em;

            line-height: 1.4;

            margin-bottom: 9px;
        }

        .metric-value {

            color: var(--pp-text-strong);

            font-size:
                clamp(2rem, 3.2vw, 2.65rem);

            font-weight: 850;

            letter-spacing: -.04em;

            line-height: 1.1;
        }

        .metric-meta {

            color: var(--pp-text-muted);

            font-size: .9rem;

            font-weight: 500;

            line-height: 1.45;

            margin-top: 11px;
        }

        .metric-meta .text-success {

            color: var(--pp-green) !important;

            font-weight: 700;
        }


        /* ==========================================================
           GENERAL PANEL
        ========================================================== */

        .panel {

            width: 100%;

            background: var(--pp-surface);

            border:
                1px solid var(--pp-border);

            border-radius: var(--pp-radius);

            box-shadow: var(--pp-shadow);

            overflow: hidden;
        }

        .panel-header {

            min-height: 76px;

            padding:
                18px 25px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            border-bottom:
                1px solid var(--pp-border);
        }

        .panel-header h2 {

            color: var(--pp-text-strong);

            font-size:
                clamp(1.08rem, 1.5vw, 1.3rem);

            font-weight: 800;

            line-height: 1.3;

            margin: 0;
        }

        .panel-header p {

            color: var(--pp-text-muted);

            font-size: .92rem;

            line-height: 1.5;

            margin: 5px 0 0;
        }


        /* ==========================================================
           SECTION TITLE
           ICON + TITLE + DESCRIPTION
        ========================================================== */

        .section-heading {

            display: flex;

            align-items: flex-start;

            gap: 14px;
        }

        .section-heading-icon {

            flex: 0 0 42px;

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            color: var(--pp-primary);

            background: var(--pp-primary-soft);

            border-radius: 11px;

            font-size: 1.15rem;
        }

        .section-heading-content {

            min-width: 0;
        }


        /* ==========================================================
           SYSTEM DESCRIPTION
        ========================================================== */

        .system-description {

            position: relative;

            padding:
                clamp(25px, 4vw, 38px);

            background:

                linear-gradient(135deg,
                    rgba(49, 87, 213, .10),
                    rgba(49, 87, 213, .025)),

                var(--pp-surface);
        }

        .system-description-content {

            display: flex;

            align-items: flex-start;

            gap:
                clamp(20px, 3vw, 30px);
        }

        .system-description-icon {

            flex: 0 0 68px;

            width: 68px;
            height: 68px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(135deg,
                    var(--pp-primary),
                    var(--pp-primary-dark));

            color: white;

            border-radius: 17px;

            font-size: 1.7rem;

            box-shadow:
                0 10px 24px rgba(49, 87, 213, .25);
        }

        .system-description h2 {

            color: var(--pp-text-strong);

            font-size:
                clamp(1.25rem, 2vw, 1.5rem);

            font-weight: 800;

            line-height: 1.3;

            margin:
                0 0 10px;
        }

        .system-description p {

            color: var(--pp-text-muted);

            font-size:
                clamp(.95rem, 1.2vw, 1.04rem);

            line-height: 1.8;

            margin: 0;

            max-width: 1050px;
        }

        .system-description-features {

            display: flex;

            flex-wrap: wrap;

            gap: 9px;

            margin-top: 21px;
        }

        .description-tag {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding:
                8px 13px;

            background: var(--pp-surface);

            border:
                1px solid var(--pp-border);

            border-radius: 999px;

            color: var(--pp-text-muted);

            font-size: .84rem;

            font-weight: 650;

            line-height: 1.3;
        }

        .description-tag i {

            color: var(--pp-primary);

            font-size: .95rem;
        }


        /* ==========================================================
           QUICK LINKS
        ========================================================== */

        .quick-links-panel {

            margin-top: 24px;
        }

        .quick-links-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 17px;

            padding: 25px;
        }

        .quick-link {

            min-width: 0;

            min-height: 105px;

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 17px;

            text-decoration: none;

            background: var(--pp-surface);

            border:
                1px solid var(--pp-border);

            border-radius: 15px;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease,
                background .2s ease;
        }

        .quick-link:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 10px 25px rgba(15, 23, 42, .08);

            border-color:
                rgba(49, 87, 213, .45);

            background:
                var(--pp-primary-soft);
        }

        .quick-link-icon {

            flex:
                0 0 52px;

            width: 52px;
            height: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                var(--pp-primary-soft);

            color:
                var(--pp-primary);

            font-size: 1.35rem;
        }

        .quick-link-content {

            flex: 1;

            min-width: 0;
        }

        .quick-link-title {

            display: block;

            color: var(--pp-text-strong);

            font-size: 1rem;

            font-weight: 750;

            line-height: 1.35;
        }

        .quick-link-description {

            display: block;

            color: var(--pp-text-muted);

            font-size: .84rem;

            line-height: 1.45;

            margin-top: 4px;
        }

        .quick-link-arrow {

            flex: 0 0 auto;

            color:
                #94a3b8;

            font-size: 1rem;

            transition:
                transform .2s ease,
                color .2s ease;
        }

        .quick-link:hover .quick-link-arrow {

            color:
                var(--pp-primary);

            transform:
                translateX(4px);
        }


        /* QUICK LINK COLORS */

        .quick-link.green .quick-link-icon {

            color: var(--pp-green);

            background: var(--pp-green-soft);
        }

        .quick-link.orange .quick-link-icon {

            color: var(--pp-amber);

            background: var(--pp-amber-soft);
        }

        .quick-link.red .quick-link-icon {

            color: var(--pp-rose);

            background: var(--pp-rose-soft);
        }

        .quick-link.cyan .quick-link-icon {

            color: var(--pp-cyan);

            background: var(--pp-cyan-soft);
        }

        .quick-link.purple .quick-link-icon {

            color: var(--pp-purple);

            background: var(--pp-purple-soft);
        }

        .quick-link.teal .quick-link-icon {

            color: var(--pp-teal);

            background: var(--pp-teal-soft);
        }


        /* ==========================================================
           RECENT EMPLOYEES
        ========================================================== */

        .recent-employees {

            margin-top: 24px;
        }

        .table-responsive {

            width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

            scrollbar-width: thin;
        }

        .employees-table {

            width: 100%;

            min-width: 760px;

            margin: 0;
        }

        .employees-table thead th {

            padding:
                16px 25px;

            background:
                var(--pp-surface-soft);

            border-bottom:
                1px solid var(--pp-border);

            color:
                var(--pp-text-muted);

            font-size:
                .82rem;

            font-weight:
                800;

            text-transform:
                uppercase;

            letter-spacing:
                .055em;

            white-space:
                nowrap;
        }

        .employees-table tbody td {

            padding:
                18px 25px;

            color:
                var(--pp-text);

            font-size:
                .96rem;

            border-color:
                var(--pp-border);

            vertical-align:
                middle;
        }

        .employees-table tbody tr {

            transition:
                background .15s ease;
        }

        .employees-table tbody tr:hover {

            background:
                rgba(49, 87, 213, .035);
        }

        .employees-table tbody tr:last-child td {

            border-bottom: 0;
        }

        .employee-name {

            color:
                var(--pp-text-strong);

            font-size:
                .98rem;

            font-weight:
                750;
        }

        .employee-department,
        .employee-position,
        .employee-date {

            color:
                var(--pp-text-muted);

            font-size:
                .92rem;
        }

        .employee-status {

            padding:
                7px 12px;

            border-radius:
                999px;

            font-size:
                .78rem;

            font-weight:
                750;
        }

        .btn-view-all {

            min-height:
                40px;

            padding:
                7px 14px;

            color:
                var(--pp-primary);

            background:
                var(--pp-surface);

            border:
                1px solid var(--pp-border);

            border-radius:
                9px;

            font-size:
                .88rem;

            font-weight:
                700;

            white-space:
                nowrap;
        }

        .btn-view-all:hover {

            color:
                white;

            background:
                var(--pp-primary);

            border-color:
                var(--pp-primary);
        }


        /* ==========================================================
           FOOTER
        ========================================================== */

        .admin-footer {

            padding:
                25px 0 8px;
        }


        /* ==========================================================
           LARGE SCREENS
        ========================================================== */

        @media (min-width: 1600px) {

            .quick-links-grid {

                grid-template-columns:
                    repeat(4, minmax(0, 1fr));
            }

            .metric-card {

                min-height: 175px;
            }
        }


        /* ==========================================================
           LAPTOP
        ========================================================== */

        @media (max-width: 1399.98px) {

            .quick-links-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }
        }


        /* ==========================================================
           SMALL LAPTOP
        ========================================================== */

        @media (max-width: 1100px) {

            .quick-links-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }
        }


        /* ==========================================================
           TABLET
        ========================================================== */

        @media (max-width: 991.98px) {

            .dashboard-content .container-fluid {

                padding-left:
                    18px !important;

                padding-right:
                    18px !important;
            }

            .metric-card {

                min-height:
                    155px;

                padding:
                    22px;
            }

            .system-description {

                padding:
                    26px;
            }

            .quick-links-grid {

                padding:
                    20px;

                gap:
                    14px;
            }

            .panel-header {

                padding:
                    18px 21px;
            }
        }


        /* ==========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            html {

                font-size:
                    15.5px;
            }

            .dashboard-content .container-fluid {

                padding-left:
                    13px !important;

                padding-right:
                    13px !important;
            }

            .dashboard-heading {

                gap:
                    13px;

                margin-bottom:
                    1.35rem;
            }

            .dashboard-heading-icon {

                flex:
                    0 0 48px;

                width:
                    48px;

                height:
                    48px;

                border-radius:
                    13px;

                font-size:
                    1.25rem;
            }

            .dashboard-heading h1 {

                font-size:
                    1.45rem;
            }

            .dashboard-heading p {

                font-size:
                    .88rem;

                line-height:
                    1.55;
            }

            .metric-card {

                min-height:
                    150px;

                padding:
                    21px;
            }

            .metric-label {

                font-size:
                    .84rem;
            }

            .metric-value {

                font-size:
                    2rem;
            }

            .metric-meta {

                font-size:
                    .84rem;
            }

            .panel-header {

                min-height:
                    auto;

                padding:
                    18px;
            }

            .panel-header h2 {

                font-size:
                    1.12rem;
            }

            .panel-header p {

                font-size:
                    .86rem;
            }

            .system-description {

                padding:
                    22px;
            }

            .system-description-content {

                gap:
                    17px;
            }

            .system-description-icon {

                flex:
                    0 0 56px;

                width:
                    56px;

                height:
                    56px;

                font-size:
                    1.35rem;
            }

            .system-description h2 {

                font-size:
                    1.2rem;
            }

            .system-description p {

                font-size:
                    .93rem;

                line-height:
                    1.72;
            }

            .system-description-features {

                margin-top:
                    17px;
            }

            .description-tag {

                font-size:
                    .78rem;

                padding:
                    7px 10px;
            }

            .quick-links-panel {

                margin-top:
                    18px;
            }

            .quick-links-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                padding:
                    15px;

                gap:
                    11px;
            }

            .quick-link {

                min-height:
                    100px;

                padding:
                    14px;

                gap:
                    11px;
            }

            .quick-link-icon {

                flex:
                    0 0 44px;

                width:
                    44px;

                height:
                    44px;

                font-size:
                    1.15rem;
            }

            .quick-link-title {

                font-size:
                    .91rem;
            }

            .quick-link-description {

                font-size:
                    .76rem;
            }

            .quick-link-arrow {

                display:
                    none;
            }

            .recent-employees {

                margin-top:
                    18px;
            }

            .employees-table {

                min-width:
                    730px;
            }

            .employees-table thead th {

                padding:
                    14px 18px;

                font-size:
                    .76rem;
            }

            .employees-table tbody td {

                padding:
                    16px 18px;

                font-size:
                    .9rem;
            }
        }


        /* ==========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            html {

                font-size:
                    15px;
            }

            .dashboard-content .container-fluid {

                padding-left:
                    10px !important;

                padding-right:
                    10px !important;
            }

            .dashboard-heading {

                align-items:
                    flex-start;

                gap:
                    11px;
            }

            .dashboard-heading-icon {

                flex:
                    0 0 44px;

                width:
                    44px;

                height:
                    44px;

                font-size:
                    1.1rem;
            }

            .dashboard-heading h1 {

                font-size:
                    1.3rem;
            }

            .dashboard-heading p {

                font-size:
                    .84rem;
            }

            .metric-card {

                min-height:
                    145px;

                padding:
                    19px;
            }

            .metric-value {

                font-size:
                    1.9rem;
            }

            .panel-header {

                flex-direction:
                    column;

                align-items:
                    flex-start;
            }

            .panel-header>* {

                max-width:
                    100%;
            }

            .panel-header .btn-view-all {

                width:
                    100%;

                display:
                    flex;

                align-items:
                    center;

                justify-content:
                    center;
            }

            .system-description-content {

                flex-direction:
                    column;
            }

            .system-description-icon {

                flex:
                    0 0 52px;

                width:
                    52px;

                height:
                    52px;
            }

            .system-description {

                padding:
                    20px;
            }

            .system-description p {

                font-size:
                    .9rem;
            }

            .quick-links-grid {

                grid-template-columns:
                    1fr;

                padding:
                    13px;
            }

            .quick-link {

                min-height:
                    88px;
            }

            .quick-link-title {

                font-size:
                    .94rem;
            }

            .quick-link-description {

                font-size:
                    .78rem;
            }

            .notification-menu {

                position:
                    fixed !important;

                top:
                    64px !important;

                left:
                    9px !important;

                right:
                    9px !important;

                width:
                    auto !important;

                max-width:
                    none !important;
            }

            .profile-name {

                display:
                    none !important;
            }
        }


        /* ==========================================================
           VERY SMALL DEVICES
        ========================================================== */

        @media (max-width: 360px) {

            .dashboard-content .container-fluid {

                padding-left:
                    8px !important;

                padding-right:
                    8px !important;
            }

            .dashboard-heading h1 {

                font-size:
                    1.2rem;
            }

            .dashboard-heading p {

                font-size:
                    .8rem;
            }

            .metric-card {

                padding:
                    17px;
            }

            .metric-value {

                font-size:
                    1.75rem;
            }

            .quick-link {

                padding:
                    12px;
            }
        }


        /* ==========================================================
           DARK MODE
        ========================================================== */

        [data-theme="dark"],
        body.dark-mode {

            --pp-page:
                #080f1d;

            --pp-surface:
                #111a2b;

            --pp-surface-soft:
                #172235;

            --pp-text:
                #e7edf7;

            --pp-text-strong:
                #f8fafc;

            --pp-text-muted:
                #b4c0d0;

            --pp-text-light:
                #9eacbf;

            --pp-border:
                #2c3b52;

            --pp-primary-soft:
                rgba(76, 110, 245, .17);

            --pp-green-soft:
                rgba(16, 185, 129, .15);

            --pp-amber-soft:
                rgba(245, 158, 11, .15);

            --pp-rose-soft:
                rgba(244, 63, 94, .15);

            --pp-purple-soft:
                rgba(168, 85, 247, .15);

            --pp-cyan-soft:
                rgba(6, 182, 212, .15);

            --pp-teal-soft:
                rgba(20, 184, 166, .15);

            --pp-shadow:
                0 8px 28px rgba(0, 0, 0, .28);

            --pp-shadow-hover:
                0 15px 38px rgba(0, 0, 0, .38);
        }

        [data-theme="dark"] body,
        body.dark-mode {

            background:
                var(--pp-page);

            color:
                var(--pp-text);
        }

        [data-theme="dark"] .bg-white,
        body.dark-mode .bg-white {

            background:
                var(--pp-surface) !important;
        }

        [data-theme="dark"] .text-muted,
        body.dark-mode .text-muted {

            color:
                var(--pp-text-muted) !important;
        }


        /* PANELS */

        [data-theme="dark"] .metric-card,
        [data-theme="dark"] .panel,
        [data-theme="dark"] .quick-link,
        [data-theme="dark"] .system-description,

        body.dark-mode .metric-card,
        body.dark-mode .panel,
        body.dark-mode .quick-link,
        body.dark-mode .system-description {

            background:
                var(--pp-surface);

            border-color:
                var(--pp-border);

            box-shadow:
                var(--pp-shadow);
        }


        /* DASHBOARD HEADING */

        [data-theme="dark"] .dashboard-heading h1,
        body.dark-mode .dashboard-heading h1 {

            color:
                var(--pp-text-strong);
        }

        [data-theme="dark"] .dashboard-heading p,
        body.dark-mode .dashboard-heading p {

            color:
                var(--pp-text-muted) !important;
        }


        /* SYSTEM DESCRIPTION */

        [data-theme="dark"] .system-description,
        body.dark-mode .system-description {

            background:

                linear-gradient(135deg,
                    rgba(49, 87, 213, .16),
                    rgba(17, 26, 43, .4)),

                var(--pp-surface);
        }


        /* TEXT */

        [data-theme="dark"] .metric-value,
        [data-theme="dark"] .panel-header h2,
        [data-theme="dark"] .system-description h2,
        [data-theme="dark"] .quick-link-title,
        [data-theme="dark"] .employee-name,

        body.dark-mode .metric-value,
        body.dark-mode .panel-header h2,
        body.dark-mode .system-description h2,
        body.dark-mode .quick-link-title,
        body.dark-mode .employee-name {

            color:
                var(--pp-text-strong);
        }


        [data-theme="dark"] .panel-header p,
        [data-theme="dark"] .system-description p,
        [data-theme="dark"] .quick-link-description,
        [data-theme="dark"] .employee-department,
        [data-theme="dark"] .employee-position,
        [data-theme="dark"] .employee-date,

        body.dark-mode .panel-header p,
        body.dark-mode .system-description p,
        body.dark-mode .quick-link-description,
        body.dark-mode .employee-department,
        body.dark-mode .employee-position,
        body.dark-mode .employee-date {

            color:
                var(--pp-text-muted) !important;
        }


        /* TABLE */

        [data-theme="dark"] .employees-table thead th,
        body.dark-mode .employees-table thead th {

            background:
                var(--pp-surface-soft);

            color:
                #bfc9d8;

            border-color:
                var(--pp-border);
        }

        [data-theme="dark"] .employees-table tbody td,
        body.dark-mode .employees-table tbody td {

            color:
                var(--pp-text);

            border-color:
                var(--pp-border);
        }

        [data-theme="dark"] .employees-table tbody tr:hover,
        body.dark-mode .employees-table tbody tr:hover {

            background:
                rgba(76, 110, 245, .06);
        }


        /* QUICK LINKS */

        [data-theme="dark"] .quick-link:hover,
        body.dark-mode .quick-link:hover {

            background:
                rgba(76, 110, 245, .10);

            border-color:
                rgba(129, 150, 255, .45);
        }

        [data-theme="dark"] .quick-link-icon,
        body.dark-mode .quick-link-icon {

            background:
                rgba(76, 110, 245, .17);

            color:
                #8ea7ff;
        }

        [data-theme="dark"] .quick-link.green .quick-link-icon,
        body.dark-mode .quick-link.green .quick-link-icon {

            background:
                rgba(16, 185, 129, .15);

            color:
                #4ade80;
        }

        [data-theme="dark"] .quick-link.orange .quick-link-icon,
        body.dark-mode .quick-link.orange .quick-link-icon {

            background:
                rgba(245, 158, 11, .15);

            color:
                #fbbf24;
        }

        [data-theme="dark"] .quick-link.red .quick-link-icon,
        body.dark-mode .quick-link.red .quick-link-icon {

            background:
                rgba(244, 63, 94, .15);

            color:
                #fb7185;
        }

        [data-theme="dark"] .quick-link.cyan .quick-link-icon,
        body.dark-mode .quick-link.cyan .quick-link-icon {

            background:
                rgba(6, 182, 212, .15);

            color:
                #22d3ee;
        }

        [data-theme="dark"] .quick-link.purple .quick-link-icon,
        body.dark-mode .quick-link.purple .quick-link-icon {

            background:
                rgba(168, 85, 247, .15);

            color:
                #c084fc;
        }

        [data-theme="dark"] .quick-link.teal .quick-link-icon,
        body.dark-mode .quick-link.teal .quick-link-icon {

            background:
                rgba(20, 184, 166, .15);

            color:
                #2dd4bf;
        }


        /* DESCRIPTION TAGS */

        [data-theme="dark"] .description-tag,
        body.dark-mode .description-tag {

            background:
                var(--pp-surface-soft);

            border-color:
                var(--pp-border);

            color:
                var(--pp-text-muted);
        }

        [data-theme="dark"] .description-tag i,
        body.dark-mode .description-tag i {

            color:
                #8ea7ff;
        }


        /* BUTTON */

        [data-theme="dark"] .btn-view-all,
        body.dark-mode .btn-view-all {

            background:
                var(--pp-surface);

            color:
                #a9bcff;

            border-color:
                var(--pp-border);
        }

        [data-theme="dark"] .btn-view-all:hover,
        body.dark-mode .btn-view-all:hover {

            background:
                var(--pp-primary);

            border-color:
                var(--pp-primary);

            color:
                #ffffff;
        }


        /* NOTIFICATIONS */

        [data-theme="dark"] .notification-menu,
        body.dark-mode .notification-menu {

            background:
                var(--pp-surface);

            border-color:
                var(--pp-border);
        }

        [data-theme="dark"] .notification-title,
        body.dark-mode .notification-title {

            color:
                #f8fafc;
        }

        [data-theme="dark"] .notification-message,
        body.dark-mode .notification-message {

            color:
                #b4c0d0;
        }

        [data-theme="dark"] .notification-unread,
        body.dark-mode .notification-unread {

            background:
                rgba(49, 87, 213, .15);
        }

        [data-theme="dark"] .notification-unread:hover,
        body.dark-mode .notification-unread:hover {

            background:
                rgba(49, 87, 213, .23);
        }

        [data-theme="dark"] .dropdown-divider,
        body.dark-mode .dropdown-divider {

            border-color:
                var(--pp-border);
        }

        [data-theme="dark"] .text-body,
        body.dark-mode .text-body {

            color:
                var(--pp-text) !important;
        }


        /* ==========================================================
           ACCESSIBILITY
        ========================================================== */

        a:focus-visible,
        button:focus-visible,
        input:focus-visible {

            outline:
                3px solid rgba(49, 87, 213, .4);

            outline-offset:
                3px;
        }


        /* ==========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                scroll-behavior:
                    auto !important;

                transition-duration:
                    .01ms !important;

                animation-duration:
                    .01ms !important;

                animation-iteration-count:
                    1 !important;
            }
        }
    </style>

</head>


<body>


    <div class="admin-shell">


        <!-- ==========================================================
         SIDEBAR BACKDROP
    ========================================================== -->

        <div class="sidebar-backdrop" data-sidebar-close>
        </div>


        <!-- ==========================================================
         SIDEBAR
    ========================================================== -->

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">


            <div class="sidebar-header">

                <a class="brand-mark" href="{{ route('admin-dashboard') }}" aria-label="Admin Dashboard">

                    <img src="../../../khen/assets/images/logo.jpg" alt="Pap Pay Logo" class="brand-logo">

                </a>

            </div>


            <nav class="sidebar-nav">


                <a class="nav-link active" href="{{ route('admin-dashboard') }}">

                    <span class="nav-icon">
                        <i class="bi bi-speedometer2"></i>
                    </span>

                    <span class="nav-text">
                        Home
                    </span>

                </a>


                <a class="nav-link" href="{{ route('employees.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-people"></i>
                    </span>

                    <span class="nav-text">
                        Employees
                    </span>

                </a>


                <a class="nav-link" href="{{ route('attendance_list') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-check"></i>
                    </span>

                    <span class="nav-text">
                        Attendance
                    </span>

                </a>


                <a class="nav-link" href="{{ route('admin.leaves') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-x"></i>
                    </span>

                    <span class="nav-text">
                        Leave Requests
                    </span>

                </a>


                <a class="nav-link" href="{{ route('official_business') }}">

                    <span class="nav-icon">
                        <i class="bi bi-briefcase"></i>
                    </span>

                    <span class="nav-text">
                        Official Business (OB)
                    </span>

                </a>


                <a class="nav-link" href="{{ route('holidays.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-gear"></i>
                    </span>

                    <span class="nav-text">
                        Holidays
                    </span>

                </a>


                <a class="nav-link" href="{{ route('payroll') }}">

                    <span class="nav-icon">
                        <i class="bi bi-cash-stack"></i>
                    </span>

                    <span class="nav-text">
                        Payroll
                    </span>

                </a>


                <a class="nav-link" href="{{ route('payslip_list') }}">

                    <span class="nav-icon">
                        <i class="bi bi-receipt"></i>
                    </span>

                    <span class="nav-text">
                        Payslips
                    </span>

                </a>


                <a class="nav-link" href="{{ route('admin.payslip-concerns.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-exclamation-circle"></i>
                    </span>

                    <span class="nav-text">
                        Payslip Concerns
                    </span>

                </a>


                <a class="nav-link" href="{{ route('reports') }}">

                    <span class="nav-icon">
                        <i class="bi bi-bar-chart"></i>
                    </span>

                    <span class="nav-text">
                        Reports
                    </span>

                </a>


                <a class="nav-link" href="{{ route('announcements') }}">

                    <span class="nav-icon">
                        <i class="bi bi-megaphone"></i>
                    </span>

                    <span class="nav-text">
                        Announcements
                    </span>

                </a>


            </nav>


            <!-- SIDEBAR USER -->

            <div class="sidebar-user">

                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ Auth::user()->photo
                        ? asset('storage/' . Auth::user()->photo)
                        : asset('khen/assets/images/avatar/avatar.jpg') }}"
                    alt="{{ Auth::user()->name }}">

                <strong>
                    {{ Auth::user()->name }}
                </strong>

                <small>
                    {{ ucfirst(Auth::user()->role ?? 'Employee') }}
                </small>

            </div>


            <div class="sidebar-footer">

                <span class="status-dot"></span>

                <span class="sidebar-footer-text">
                    System running smoothly
                </span>

            </div>


        </aside>


        <!-- ==========================================================
         MAIN
    ========================================================== -->

        <div class="admin-main">


            <!-- ======================================================
             NAVBAR
        ======================================================= -->

            <nav class="navbar admin-navbar navbar-expand bg-white">

                <div class="container-fluid px-3 px-lg-4">


                    <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar"
                        aria-expanded="true" aria-label="Toggle sidebar">

                        <span></span>
                        <span></span>
                        <span></span>

                    </button>


                    <!-- SEARCH -->

                    <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">

                        <input class="form-control search-input" type="search"
                            placeholder="Search users, orders, reports" aria-label="Search">

                    </form>


                    <div class="navbar-actions ms-auto">


                        <!-- THEME -->

                        <button class="icon-button theme-toggle" type="button" data-theme-toggle
                            aria-label="Switch color theme" title="Switch color theme">

                            <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true">
                            </i>

                        </button>


                        <!-- NOTIFICATIONS -->

                        <div class="dropdown">

                            <button class="icon-button" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="Notifications">

                                @if (($unreadNotifications ?? 0) > 0)
                                    <span class="notification-dot"></span>
                                @endif

                                <i class="bi bi-bell" aria-hidden="true">
                                </i>

                            </button>


                            <div class="dropdown-menu dropdown-menu-end notification-menu">


                                <div class="dropdown-header fw-bold text-body">
                                    Notifications
                                </div>


                                @forelse($notifications ?? [] as $notification)
                                    <a class="dropdown-item {{ !$notification->is_read ? 'notification-unread' : '' }}"
                                        href="{{ route('admin.notifications.read', $notification->id) }}">

                                        <span class="notification-title">
                                            {{ $notification->title }}
                                        </span>

                                        <span class="notification-message">
                                            {{ $notification->message }}
                                        </span>

                                        <span class="notification-time">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>

                                    </a>

                                @empty

                                    <div class="dropdown-item text-muted text-center py-3">

                                        <i class="bi bi-bell-slash"></i>

                                        <br>

                                        No notifications

                                    </div>
                                @endforelse


                                <div class="dropdown-divider"></div>


                                <a href="{{ route('admin.notifications') }}" class="dropdown-item text-center">

                                    View all notifications

                                </a>


                            </div>

                        </div>


                        <!-- PROFILE -->

                        <div class="dropdown">


                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">


                                <img class="avatar-img avatar-sm"
                                    src="{{ Auth::user()->photo
                                        ? asset('storage/' . Auth::user()->photo)
                                        : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                    alt="{{ Auth::user()->name }}">


                                <span class="profile-name d-none d-sm-inline">
                                    {{ Auth::user()->name }}
                                </span>


                            </button>


                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>

                                    <form method="POST" action="{{ route('logout') }}">

                                        @csrf

                                        <button type="submit" class="dropdown-item">

                                            Sign out

                                        </button>

                                    </form>

                                </li>


                            </ul>


                        </div>


                    </div>


                </div>

            </nav>


            <!-- ======================================================
             DASHBOARD CONTENT
        ======================================================= -->

            <main class="dashboard-content">


                <div class="container-fluid px-3 px-lg-4 py-4">


                    <!-- ==================================================
                     DASHBOARD PAGE HEADING
                =================================================== -->

                    <section class="dashboard-heading">


                        <div class="dashboard-heading-icon">

                            <i class="bi bi-speedometer2"></i>

                        </div>


                        <div class="dashboard-heading-content">


                            <h1>
                                HR & Payroll Dashboard
                            </h1>


                            <p>
                                Monitor employees, attendance, payroll,
                                requests, and other HR operations from
                                one centralized system.
                            </p>


                        </div>


                    </section>


                    <!-- ==================================================
                     METRICS
                =================================================== -->

                    <section class="row g-3">


                        <!-- TOTAL USERS -->

                        <div class="col-12 col-sm-6 col-xl-3">

                            <div class="metric-card">

                                <div class="metric-label">
                                    Total Users
                                </div>

                                <div class="metric-value">
                                    {{ number_format($totalUsers ?? 0) }}
                                </div>

                                <div class="metric-meta">

                                    <span class="text-success">
                                        Employees + Administrators
                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- PRESENT -->

                        <div class="col-12 col-sm-6 col-xl-3">

                            <div class="metric-card metric-success">

                                <div class="metric-label">
                                    Present Today
                                </div>

                                <div class="metric-value">
                                    {{ $presentToday ?? 0 }}
                                </div>

                                <div class="metric-meta">
                                    Attendance rate
                                </div>

                            </div>

                        </div>


                        <!-- LEAVES -->

                        <div class="col-12 col-sm-6 col-xl-3">

                            <div class="metric-card metric-warning">

                                <div class="metric-label">
                                    Pending Leaves
                                </div>

                                <div class="metric-value">
                                    {{ $pendingLeaves ?? 0 }}
                                </div>

                                <div class="metric-meta">
                                    Requires approval
                                </div>

                            </div>

                        </div>


                        <!-- PAYROLL -->

                        <div class="col-12 col-sm-6 col-xl-3">

                            <div class="metric-card metric-danger">

                                <div class="metric-label">
                                    Payroll Processed
                                </div>

                                <div class="metric-value">
                                    {{ $payrollCount ?? 0 }}
                                </div>

                                <div class="metric-meta">
                                    This month
                                </div>

                            </div>

                        </div>


                    </section>


                    <!-- ==================================================
                     SYSTEM DESCRIPTION
                =================================================== -->

                    <section class="panel mt-4">


                        <div class="system-description">


                            <div class="system-description-content">


                                <div class="system-description-icon">

                                    <i class="bi bi-building-check"></i>

                                </div>


                                <div>


                                    <h2>
                                        About Pap Pay
                                    </h2>


                                    <p>

                                        Pap Pay is a centralized HR and
                                        payroll management system designed
                                        to simplify employee management,
                                        attendance monitoring, leave
                                        processing, official business
                                        requests, payroll preparation,
                                        payslip management, reporting,
                                        and organizational announcements.
                                        The system provides administrators
                                        with a single workspace for managing
                                        daily personnel and payroll
                                        operations while maintaining
                                        accurate and organized employee
                                        records.

                                    </p>


                                    <div class="system-description-features">


                                        <span class="description-tag">

                                            <i class="bi bi-people-fill"></i>

                                            Employee Management

                                        </span>


                                        <span class="description-tag">

                                            <i class="bi bi-calendar-check"></i>

                                            Attendance

                                        </span>


                                        <span class="description-tag">

                                            <i class="bi bi-cash-stack"></i>

                                            Payroll

                                        </span>


                                        <span class="description-tag">

                                            <i class="bi bi-receipt"></i>

                                            Payslips

                                        </span>


                                        <span class="description-tag">

                                            <i class="bi bi-file-earmark-bar-graph"></i>

                                            Reports

                                        </span>


                                        <span class="description-tag">

                                            <i class="bi bi-megaphone"></i>

                                            Announcements

                                        </span>


                                    </div>


                                </div>


                            </div>


                        </div>


                    </section>


                    <!-- ==================================================
                     QUICK LINKS
                =================================================== -->

                    <section class="panel quick-links-panel">


                        <div class="panel-header">


                            <div class="section-heading">


                                <div class="section-heading-icon">

                                    <i class="bi bi-grid-fill"></i>

                                </div>


                                <div class="section-heading-content">

                                    <h2>
                                        Quick Links
                                    </h2>

                                    <p>
                                        Quickly access frequently used
                                        Pap Pay system pages.
                                    </p>

                                </div>


                            </div>


                        </div>


                        <div class="quick-links-grid">


                            <!-- EMPLOYEES -->

                            <a href="{{ route('employees.index') }}" class="quick-link">


                                <div class="quick-link-icon">

                                    <i class="bi bi-people-fill"></i>

                                </div>


                                <div class="quick-link-content">

                                    <span class="quick-link-title">
                                        Employees
                                    </span>

                                    <span class="quick-link-description">
                                        Manage employee accounts and records.
                                    </span>

                                </div>


                                <i class="bi bi-chevron-right quick-link-arrow"></i>


                            </a>


                            <!-- ATTENDANCE -->

                            <a href="{{ route('attendance_list') }}" class="quick-link green">


                                <div class="quick-link-icon">

                                    <i class="bi bi-calendar-check-fill"></i>

                                </div>


                                <div class="quick-link-content">

                                    <span class="quick-link-title">
                                        Attendance
                                    </span>

                                    <span class="quick-link-description">
                                        Review employee attendance records.
                                    </span>

                                </div>


                                <i class="bi bi-chevron-right quick-link-arrow"></i>


                            </a>


                            <!-- LEAVE REQUESTS -->

                            <a href="{{ route('admin.leaves') }}" class="quick-link orange">


                                <div class="quick-link-icon">

                                    <i class="bi bi-calendar-x-fill"></i>

                                </div>


                                <div class="quick-link-content">

                                    <span class="quick-link-title">
                                        Leave Requests
                                    </span>

                                    <span class="quick-link-description">
                                        Review and approve employee leaves.
                                    </span>

                                </div>


                                <i class="bi bi-chevron-right quick-link-arrow"></i>


                            </a>


                            <!-- OFFICIAL BUSINESS -->

                            <a href="{{ route('official_business') }}" class="quick-link cyan">


                                <div class="quick-link-icon">

                                    <i class="bi bi-briefcase-fill"></i>

                                </div>


                                <div class="quick-link-content">

                                    <span class="quick-link-title">
                                        Official Business
                                    </span>

                                    <span class="quick-link-description">
                                        Manage official business requests.
                                    </span>

                                </div>


                                <i class="bi bi-chevron-right quick-link-arrow"></i>


                            </a>


                            <!-- PAYROLL -->

                            <a href="{{ route('payroll') }}" class="quick-link green">


                                <div class="quick-link-icon">

                                    <i class="bi bi-cash-stack"></i>

                                </div>


                                <div class="quick-link-content">

                                    <span class="quick-link-title">
                                        Payroll
                                    </span>

                                    <span class="quick-link-description">
                                        Process and manage employee payroll.
                                    </span>

                                </div>


                                <i class="bi bi-chevron-right quick-link-arrow"></i>


                            </a>


                            <!-- PAYSLIPS -->

                            <a href="{{ route('payslip_list') }}" class="quick-link purple">


                                <div class="quick-link-icon">

                                    <i class="bi bi-receipt-cutoff"></i>

                                </div>


                                <div class="quick-link-content">

                                    <span class="quick-link-title">
                                        Payslips
                                    </span>

                                    <span class="quick-link-description">
                                        View and manage employee payslips.
                                    </span>

                                </div>


                                <i class="bi bi-chevron-right quick-link-arrow"></i>


                            </a>


                            <!-- REPORTS -->

                            <a href="{{ route('reports') }}" class="quick-link red">


                                <div class="quick-link-icon">

                                    <i class="bi bi-bar-chart-fill"></i>

                                </div>


                                <div class="quick-link-content">

                                    <span class="quick-link-title">
                                        Reports
                                    </span>

                                    <span class="quick-link-description">
                                        Generate HR and payroll reports.
                                    </span>

                                </div>


                                <i class="bi bi-chevron-right quick-link-arrow"></i>


                            </a>


                            <!-- ANNOUNCEMENTS -->

                            <a href="{{ route('announcements') }}" class="quick-link teal">


                                <div class="quick-link-icon">

                                    <i class="bi bi-megaphone-fill"></i>

                                </div>


                                <div class="quick-link-content">

                                    <span class="quick-link-title">
                                        Announcements
                                    </span>

                                    <span class="quick-link-description">
                                        Publish and manage system announcements.
                                    </span>

                                </div>


                                <i class="bi bi-chevron-right quick-link-arrow"></i>


                            </a>


                        </div>


                    </section>


                    <!-- ==================================================
                     RECENT EMPLOYEES
                =================================================== -->

                    <section class="panel recent-employees">


                        <div class="panel-header">


                            <div class="section-heading">


                                <div class="section-heading-icon">

                                    <i class="bi bi-person-plus-fill"></i>

                                </div>


                                <div class="section-heading-content">

                                    <h2>
                                        Recent Employees
                                    </h2>

                                    <p>
                                        Recently added employee accounts.
                                    </p>

                                </div>


                            </div>


                            <a href="{{ route('employees.index') }}" class="btn btn-sm btn-view-all">

                                View All

                                <i class="bi bi-arrow-right ms-1"></i>

                            </a>


                        </div>


                        <div class="table-responsive">


                            <table class="table align-middle employees-table">


                                <thead>

                                    <tr>

                                        <th>
                                            Name
                                        </th>

                                        <th>
                                            Department
                                        </th>

                                        <th>
                                            Position
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Date Hired
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>


                                    @forelse($recentEmployees ?? [] as $emp)
                                        <tr>


                                            <td>

                                                <span class="employee-name">
                                                    {{ $emp->name }}
                                                </span>

                                            </td>


                                            <td>

                                                <span class="employee-department">
                                                    {{ $emp->department ?? '—' }}
                                                </span>

                                            </td>


                                            <td>

                                                <span class="employee-position">
                                                    {{ $emp->position ?? '—' }}
                                                </span>

                                            </td>


                                            <td>


                                                @php

                                                    $status = $emp->status ?? 'Unknown';

                                                    $statusClass =
                                                        strtolower($status) === 'active'
                                                            ? 'text-bg-success'
                                                            : 'text-bg-secondary';

                                                @endphp


                                                <span class="badge {{ $statusClass }} employee-status">

                                                    {{ $status }}

                                                </span>


                                            </td>


                                            <td>

                                                <span class="employee-date">

                                                    @if ($emp->hire_date)
                                                        {{ \Carbon\Carbon::parse($emp->hire_date)->format('M d, Y') }}
                                                    @else
                                                        —
                                                    @endif

                                                </span>

                                            </td>


                                        </tr>


                                    @empty


                                        <tr>

                                            <td colspan="5" class="text-center py-5">


                                                <div class="text-muted">

                                                    <i class="bi bi-people fs-3"></i>

                                                    <div class="mt-2">

                                                        No recent employees

                                                    </div>

                                                </div>


                                            </td>

                                        </tr>
                                    @endforelse


                                </tbody>


                            </table>


                        </div>


                    </section>


                    <!-- ==================================================
                     FOOTER
                =================================================== -->

                    <footer class="admin-footer">

                        <div class="container-fluid px-0">

                        </div>

                    </footer>


                </div>


            </main>


        </div>


    </div>



    <!-- ==========================================================
     JAVASCRIPT
========================================================== -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

    <script src="../../../../khen/assets/js/main.js"></script>


</body>

</html>
