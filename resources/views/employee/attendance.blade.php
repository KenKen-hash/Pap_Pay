
@php
    $employee = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Employee attendance dashboard">
    <title>Attendance</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>
        /* =========================================================
           GLOBAL RESPONSIVE RESET
           ========================================================= */

        html,
        body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
            padding: 0;
            overflow-x: hidden !important;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden !important;
        }

        body {
            position: relative;
        }

        img,
        svg,
        video,
        canvas {
            max-width: 100%;
            height: auto;
        }

        button,
        input,
        select,
        textarea {
            max-width: 100%;
        }

        /* =========================================================
           MAIN APPLICATION SHELL
           ========================================================= */

        .admin-shell {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
            min-height: 100vh;
            overflow-x: hidden !important;
        }

        .admin-main {
            min-width: 0 !important;
            width: auto;
            max-width: 100%;
            overflow-x: hidden !important;
        }

        .dashboard-content {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
            overflow-x: hidden !important;
        }

        .dashboard-content > .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
        }

        /* =========================================================
           NAVBAR
           ========================================================= */

        .admin-navbar {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
            overflow: visible;
        }

        .admin-navbar .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
            display: flex;
            align-items: center;
        }

        .admin-navbar form {
            min-width: 0 !important;
            max-width: 100%;
        }

        .admin-navbar .search-input {
            width: 100%;
            min-width: 0 !important;
            max-width: 100%;
        }

        .navbar-actions {
            min-width: 0;
            max-width: 100%;
            flex-shrink: 1;
            display: flex;
            align-items: center;
        }

        .navbar-actions > * {
            min-width: 0;
        }

        .profile-button {
            max-width: 100%;
        }

        .profile-button .profile-name {
            min-width: 0;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dropdown-menu {
            max-width: calc(100vw - 24px);
        }

        .notification-menu {
            width: min(340px, calc(100vw - 24px));
        }

        /* =========================================================
           BOOTSTRAP ROW FIX
           ========================================================= */

        .dashboard-content .row {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
        }

        .dashboard-content .row > [class*="col-"] {
            min-width: 0 !important;
            max-width: 100%;
        }

        /* =========================================================
           PAGE HEADING
           ========================================================= */

        .page-heading,
        .page-heading-copy {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
        }

        .page-heading h1,
        .page-heading h2,
        .page-heading h3,
        .page-heading p {
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: normal;
        }

        /* =========================================================
           RESPONSIVE ALERTS
           ========================================================= */

        .attendance-alert-area {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-top: 20px;
        }

        .attendance-alert {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-bottom: 0;
            overflow-wrap: anywhere;
            word-break: break-word;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .attendance-alert .alert-icon {
            flex: 0 0 auto;
        }

        .attendance-alert .alert-content {
            min-width: 0;
            flex: 1 1 auto;
            overflow-wrap: anywhere;
        }

        .attendance-alert .btn-close {
            flex: 0 0 auto;
            margin-left: auto;
        }

        /* =========================================================
           METRIC CARDS
           ========================================================= */

        .metric-card {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            overflow: hidden;
        }

        .metric-card .metric-top {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }

        .metric-card .metric-label {
            min-width: 0;
            max-width: calc(100% - 45px);
            overflow-wrap: anywhere;
            word-break: normal;
        }

        .metric-card .metric-value {
            max-width: 100%;
            min-width: 0;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .metric-card .metric-meta {
            max-width: 100%;
            min-width: 0;
            overflow-wrap: anywhere;
            word-break: normal;
        }

        .metric-card .metric-icon {
            flex: 0 0 auto;
        }

        /* =========================================================
           PANELS
           ========================================================= */

        .panel {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
            overflow: hidden;
        }

        .panel-header {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
            overflow: hidden;
        }

        .panel-header > div {
            min-width: 0;
            max-width: 100%;
        }

        .panel-header h2,
        .panel-header p {
            max-width: 100%;
            overflow-wrap: anywhere;
        }

        .panel-body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        /* =========================================================
           TODAY'S ATTENDANCE
           ========================================================= */

        .today-attendance-grid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .attendance-time-box {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
            overflow: hidden;
            overflow-wrap: anywhere;
        }

        .attendance-time-box small {
            display: block;
            width: 100%;
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .attendance-time-box h4 {
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        /* =========================================================
           SEARCH SECTION
           ========================================================= */

        .attendance-search-form {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .attendance-search-form .row {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .attendance-search-form .form-control,
        .attendance-search-form .form-select,
        .attendance-search-form .btn {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .attendance-search-form label {
            max-width: 100%;
            overflow-wrap: anywhere;
        }

        /* =========================================================
           ATTENDANCE DESKTOP TABLE
           ========================================================= */

        .attendance-table-wrapper {
            width: 100%;
            max-width: 100%;
            min-width: 0 !important;
            overflow: hidden !important;
        }

        .attendance-table {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            table-layout: fixed;
            margin-bottom: 0 !important;
        }

        .attendance-table th,
        .attendance-table td {
            min-width: 0 !important;
            max-width: 100%;
            white-space: normal !important;
            overflow-wrap: anywhere;
            word-break: break-word;
            vertical-align: middle;
        }

        .attendance-table th:nth-child(1),
        .attendance-table td:nth-child(1) {
            width: 11%;
        }

        .attendance-table th:nth-child(2),
        .attendance-table td:nth-child(2),
        .attendance-table th:nth-child(3),
        .attendance-table td:nth-child(3),
        .attendance-table th:nth-child(4),
        .attendance-table td:nth-child(4),
        .attendance-table th:nth-child(5),
        .attendance-table td:nth-child(5) {
            width: 10%;
        }

        .attendance-table th:nth-child(6),
        .attendance-table td:nth-child(6) {
            width: 11%;
        }

        .attendance-table th:nth-child(7),
        .attendance-table td:nth-child(7) {
            width: 10%;
        }

        .attendance-table th:nth-child(8),
        .attendance-table td:nth-child(8) {
            width: 18%;
        }

        .attendance-table .badge {
            white-space: normal !important;
            display: inline-block;
            max-width: 100%;
            overflow-wrap: anywhere;
        }

        /* =========================================================
           MOBILE ATTENDANCE CARDS
           ========================================================= */

        .attendance-mobile-list {
            display: none;
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .attendance-mobile-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 16px;
            background: #fff;
            overflow: hidden;
        }

        .attendance-mobile-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            padding-bottom: 12px;
            margin-bottom: 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .attendance-mobile-date {
            min-width: 0;
            max-width: 100%;
            font-weight: 700;
            font-size: 1rem;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .attendance-mobile-header > div:last-child {
            flex: 0 0 auto;
            max-width: 100%;
        }

        .attendance-mobile-header .badge {
            max-width: 100%;
            white-space: normal !important;
            overflow-wrap: anywhere;
        }

        .attendance-mobile-grid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .attendance-mobile-item {
            min-width: 0;
            max-width: 100%;
            padding: 10px;
            border-radius: 8px;
            background: #f8f9fa;
            overflow: hidden;
        }

        .attendance-mobile-label {
            display: block;
            max-width: 100%;
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 3px;
            overflow-wrap: anywhere;
        }

        .attendance-mobile-value {
            display: block;
            max-width: 100%;
            min-width: 0;
            font-weight: 600;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .attendance-mobile-remarks {
            grid-column: 1 / -1;
        }

        /* =========================================================
           EMPTY STATE
           ========================================================= */

        .attendance-empty {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .attendance-empty h5,
        .attendance-empty p {
            max-width: 100%;
            overflow-wrap: anywhere;
        }

        /* =========================================================
           MODAL RESPONSIVENESS
           ========================================================= */

        .modal {
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
        }

        .modal-dialog {
            width: auto;
            max-width: min(700px, calc(100vw - 24px));
            margin-left: auto;
            margin-right: auto;
        }

        .modal-dialog.modal-lg {
            max-width: min(900px, calc(100vw - 24px));
        }

        .modal-dialog.modal-xl {
            max-width: min(1140px, calc(100vw - 24px));
        }

        .modal-content {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
            border-radius: 12px;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            min-width: 0;
            max-width: 100%;
            overflow-wrap: anywhere;
        }

        .modal-body {
            overflow-x: hidden;
        }

        .modal-body table {
            width: 100%;
            max-width: 100%;
            table-layout: fixed;
        }

        .modal-body th,
        .modal-body td {
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: break-word;
            white-space: normal;
        }

        .modal-footer {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .modal-footer .btn {
            min-width: 100px;
            max-width: 100%;
        }

        /* =========================================================
           FOOTER
           ========================================================= */

        .admin-footer {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .admin-footer .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 12px 24px;
        }

        .admin-footer span {
            max-width: 100%;
            min-width: 0;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .admin-footer a {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        /* =========================================================
           RECENT ATTENDANCE / HISTORY MODAL
           ========================================================= */

        .recent-attendance-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .recent-attendance-header > div {
            min-width: 0;
        }

        .view-history-btn {
            flex: 0 0 auto;
            white-space: nowrap;
        }

        .attendance-history-modal .modal-dialog {
            width: calc(100% - 24px);
            max-width: 1100px;
            margin: 12px auto;
        }

        .attendance-history-modal .modal-content {
            max-height: calc(100vh - 24px);
        }

        .attendance-history-modal .modal-body {
            overflow-y: auto;
            overflow-x: hidden;
            max-height: calc(100vh - 170px);
        }

        .attendance-history-modal .history-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .attendance-history-modal .history-table {
            width: 100%;
            min-width: 850px;
            margin-bottom: 0;
        }

        .attendance-history-modal .history-table th,
        .attendance-history-modal .history-table td {
            white-space: normal;
            overflow-wrap: anywhere;
            vertical-align: middle;
        }

        .attendance-history-modal .history-mobile-list {
            display: none;
        }

        @media (max-width: 767.98px) {

            .recent-attendance-header {
                align-items: stretch;
                flex-direction: column;
                gap: 12px;
            }

            .view-history-btn {
                width: 100%;
            }

            .attendance-history-modal .modal-dialog {
                width: calc(100% - 16px);
                max-width: calc(100% - 16px);
                margin: 8px auto;
            }

            .attendance-history-modal .modal-content {
                max-height: calc(100vh - 16px);
                border-radius: 12px;
            }

            .attendance-history-modal .modal-header,
            .attendance-history-modal .modal-body,
            .attendance-history-modal .modal-footer {
                padding: 14px !important;
            }

            .attendance-history-modal .modal-body {
                max-height: calc(100vh - 145px);
            }

            .attendance-history-modal .history-table-wrapper {
                display: none;
            }

            .attendance-history-modal .history-mobile-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .attendance-history-modal .attendance-mobile-card {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {

            .attendance-history-modal .modal-dialog {
                width: calc(100% - 12px);
                max-width: calc(100% - 12px);
                margin: 6px auto;
            }

            .attendance-history-modal .modal-body {
                max-height: calc(100vh - 135px);
            }
        }

        /* =========================================================
           LARGE DESKTOP
           ========================================================= */

        @media (min-width: 1200px) {

            .attendance-time-box {
                min-height: 102px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        }

        /* =========================================================
           DESKTOP / TABLET
           ========================================================= */

        @media (max-width: 1199.98px) {

            .dashboard-content > .container-fluid {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            .metric-card {
                min-height: 150px;
            }

            .attendance-table th,
            .attendance-table td {
                font-size: 0.88rem;
                padding: 10px 7px;
            }

            .admin-footer .container-fluid {
                justify-content: center;
                text-align: center;
            }
        }

        /* =========================================================
           TABLET
           ========================================================= */

        @media (max-width: 991.98px) {

            .dashboard-content > .container-fluid {
                padding-left: 18px !important;
                padding-right: 18px !important;
            }

            .page-heading {
                margin-top: 4px;
            }

            .today-attendance-grid {
                row-gap: 12px;
            }

            .attendance-search-form .row {
                row-gap: 12px;
            }

            .attendance-table-wrapper {
                display: none !important;
            }

            .attendance-mobile-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
                padding: 0 16px 16px;
            }

            .modal-dialog,
            .modal-dialog.modal-lg,
            .modal-dialog.modal-xl {
                max-width: calc(100vw - 24px);
            }
        }

        /* =========================================================
           MOBILE
           ========================================================= */

        @media (max-width: 767.98px) {

            .dashboard-content > .container-fluid {
                padding: 16px !important;
            }

            .page-heading {
                margin-top: 0;
                margin-bottom: 18px;
            }

            .page-heading h1,
            .page-heading .h3 {
                font-size: 1.65rem;
                line-height: 1.2;
            }

            .page-heading p {
                font-size: 0.9rem;
                line-height: 1.5;
            }

            .attendance-alert-area {
                margin-top: 16px;
            }

            .attendance-alert {
                padding: 12px;
                font-size: 0.9rem;
            }

            .dashboard-content .row.g-3 {
                --bs-gutter-x: 12px;
                --bs-gutter-y: 12px;
            }

            .metric-card {
                min-height: 135px;
                padding: 16px !important;
            }

            .metric-card .metric-value {
                font-size: 2rem;
            }

            .panel {
                margin-top: 16px !important;
                border-radius: 12px;
            }

            .panel-header {
                padding: 16px !important;
            }

            .panel-body {
                padding: 16px !important;
            }

            .today-attendance-grid {
                padding-left: 16px;
                padding-right: 16px;
                padding-bottom: 16px;
            }

            .attendance-time-box {
                min-height: 90px;
                padding: 14px !important;
            }

            .attendance-time-box h4 {
                font-size: 1.15rem;
            }

            .attendance-search-form {
                padding: 0 16px 16px;
            }

            .attendance-search-form .row {
                margin-left: 0;
                margin-right: 0;
            }

            .attendance-search-form [class*="col-"] {
                width: 100%;
                max-width: 100%;
                padding-left: 0;
                padding-right: 0;
            }

            .attendance-search-form .btn {
                min-height: 46px;
            }

            .attendance-mobile-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
                padding: 0 16px 16px;
            }

            .attendance-mobile-card {
                padding: 14px;
            }

            .attendance-mobile-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .admin-footer {
                padding: 16px 0 !important;
            }

            .admin-footer .container-fluid {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 8px;
            }

            .admin-navbar .container-fluid {
                padding-left: 12px !important;
                padding-right: 12px !important;
                gap: 8px;
            }

            .navbar-actions {
                gap: 5px;
            }

            .profile-button .profile-name {
                display: none !important;
            }

            .modal-dialog,
            .modal-dialog.modal-lg,
            .modal-dialog.modal-xl {
                width: calc(100% - 24px);
                max-width: calc(100% - 24px);
                margin: 12px auto;
            }

            .modal-content {
                border-radius: 12px;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding: 14px !important;
            }

            .modal-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .modal-footer .btn {
                width: 100%;
                min-width: 0;
            }
        }

        /* =========================================================
           SMALL PHONE
           ========================================================= */

        @media (max-width: 575.98px) {

            .dashboard-content > .container-fluid {
                padding: 12px !important;
            }

            .page-heading h1,
            .page-heading .h3 {
                font-size: 1.45rem;
            }

            .page-heading p {
                font-size: 0.85rem;
            }

            .metric-card {
                min-height: 125px;
                padding: 14px !important;
            }

            .metric-card .metric-label {
                font-size: 0.78rem;
            }

            .metric-card .metric-value {
                font-size: 1.8rem;
            }

            .metric-card .metric-meta {
                font-size: 0.78rem;
            }

            .panel-header {
                padding: 14px !important;
            }

            .panel-body {
                padding: 14px !important;
            }

            .today-attendance-grid {
                padding-left: 12px;
                padding-right: 12px;
                padding-bottom: 12px;
            }

            .attendance-time-box {
                padding: 12px !important;
            }

            .attendance-search-form {
                padding-left: 12px;
                padding-right: 12px;
                padding-bottom: 12px;
            }

            .attendance-mobile-list {
                padding-left: 12px;
                padding-right: 12px;
            }

            .attendance-mobile-grid {
                grid-template-columns: 1fr;
            }

            .attendance-mobile-remarks {
                grid-column: auto;
            }

            .attendance-mobile-header {
                flex-direction: column;
                gap: 8px;
            }

            .attendance-mobile-header > div {
                width: 100%;
            }

            .attendance-mobile-header > div:last-child {
                width: auto;
            }

            .attendance-alert {
                font-size: 0.85rem;
                padding: 10px;
            }
        }

        /* =========================================================
           VERY SMALL PHONES
           ========================================================= */

        @media (max-width: 400px) {

            .dashboard-content > .container-fluid {
                padding: 10px !important;
            }

            .metric-card {
                min-height: 120px;
            }

            .metric-card .metric-value {
                font-size: 1.65rem;
            }

            .metric-card .metric-label {
                font-size: 0.75rem;
            }

            .metric-card .metric-meta {
                font-size: 0.72rem;
            }

            .admin-navbar .container-fluid {
                padding-left: 8px !important;
                padding-right: 8px !important;
            }

            .attendance-mobile-card {
                padding: 12px;
            }

            .attendance-time-box {
                min-height: 82px;
            }

            .attendance-time-box h4 {
                font-size: 1rem;
            }

            .modal-dialog,
            .modal-dialog.modal-lg,
            .modal-dialog.modal-xl {
                width: calc(100% - 16px);
                max-width: calc(100% - 16px);
                margin: 8px auto;
            }
        }
    </style>
</head>

<body>

    <div class="admin-shell">

        <div class="sidebar-backdrop" data-sidebar-close></div>

        <!-- =====================================================
             SIDEBAR
             ===================================================== -->

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

            <!-- =================================================
                 NAVIGATION
                 ================================================= -->

            <nav class="sidebar-nav">

                <a class="nav-link"
                    href="{{ route('dashboard') }}">

                    <span class="nav-icon">
                        <i class="bi bi-house-door" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Dashboard
                    </span>

                </a>

                <a class="nav-link active"
                    href="{{ route('attendance') }}"
                    aria-current="page">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-check" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Attendance
                    </span>

                </a>

                <a class="nav-link"
                    href="{{ route('file_leave') }}">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-plus" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        File Leave
                    </span>

                </a>

                <a class="nav-link"
                    href="{{ route('file_ob') }}">

                    <span class="nav-icon">
                        <i class="bi bi-briefcase" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        File OB
                    </span>

                </a>

                <a class="nav-link"
                    href="{{ route('payslip') }}">

                    <span class="nav-icon">
                        <i class="bi bi-receipt" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Payslip
                    </span>

                </a>

                <a class="nav-link"
                    href="{{ route('employee.announcements') }}">

                    <span class="nav-icon">
                        <i class="bi bi-megaphone" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        Announcements
                    </span>

                </a>

                <a class="nav-link"
                    href="{{ route('my_profile') }}">

                    <span class="nav-icon">
                        <i class="bi bi-person" aria-hidden="true"></i>
                    </span>

                    <span class="nav-text">
                        My Profile
                    </span>

                </a>

            </nav>

            <!-- =================================================
                 SIDEBAR USER
                 ================================================= -->

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

            <div class="sidebar-footer">

                <span class="status-dot"></span>

                <span class="sidebar-footer-text">
                    System running smoothly
                </span>

            </div>

        </aside>

        <!-- =====================================================
             MAIN APPLICATION
             ===================================================== -->

        <div class="admin-main">

            <!-- =================================================
                 NAVBAR
                 ================================================= -->

            <nav class="navbar admin-navbar navbar-expand bg-white">

                <div class="container-fluid px-3 px-lg-4">

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

                    <!-- SEARCH -->

                    <form class="d-none d-md-flex ms-3 flex-grow-1"
                        action="{{ route('search') }}"
                        method="GET">

                        <input class="form-control search-input"
                            type="search"
                            name="search"
                            placeholder="Search attendance records..."
                            required>

                    </form>

                    <div class="navbar-actions ms-auto">

                        <!-- THEME -->

                        <button class="icon-button theme-toggle"
                            type="button"
                            data-theme-toggle
                            aria-label="Switch color theme"
                            title="Switch color theme">

                            <i class="bi bi-moon-stars"
                                data-theme-icon
                                aria-hidden="true"></i>

                        </button>

                        <!-- NOTIFICATIONS -->

                        <div class="dropdown">

                            <button class="icon-button"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                aria-label="Notifications">

                                <span class="notification-dot"></span>

                                <i class="bi bi-bell"
                                    aria-hidden="true"></i>

                            </button>

                            <div class="dropdown-menu dropdown-menu-end notification-menu">

                                <div class="dropdown-header fw-bold text-body">
                                    Notifications
                                </div>

                                <a class="dropdown-item"
                                    href="{{ route('attendance') }}">

                                    <span class="notification-title">
                                        New user registered
                                    </span>

                                    <span class="notification-time">
                                        4 minutes ago
                                    </span>

                                </a>

                                <a class="dropdown-item"
                                    href="charts.html">

                                    <span class="notification-title">
                                        Revenue target reached
                                    </span>

                                    <span class="notification-time">
                                        32 minutes ago
                                    </span>

                                </a>

                                <a class="dropdown-item"
                                    href="settings.html">

                                    <span class="notification-title">
                                        Security review completed
                                    </span>

                                    <span class="notification-time">
                                        1 hour ago
                                    </span>

                                </a>

                            </div>

                        </div>

                        <!-- PROFILE -->

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
                 PAGE CONTENT
                 ================================================= -->

            <main class="dashboard-content">

                <div class="container-fluid px-3 px-lg-4 py-4">

                    <!-- =================================================
                         PAGE HEADING
                         ================================================= -->

                    <div class="page-heading">

                        <div class="page-heading-copy">

                            <div>

                                <h1 class="h3 mb-1">
                                    Attendance
                                </h1>

                                <p class="text-muted mb-0">
                                    View your daily attendance records monitored through the Face Recognition Attendance
                                    System.
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- =================================================
                         SESSION ALERTS
                         ================================================= -->

                    @if (session('success'))

                        <div class="attendance-alert-area">

                            <div class="alert alert-success alert-dismissible fade show attendance-alert"
                                role="alert">

                                <span class="alert-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </span>

                                <div class="alert-content">
                                    {{ session('success') }}
                                </div>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>

                        </div>

                    @endif

                    @if (session('error'))

                        <div class="attendance-alert-area">

                            <div class="alert alert-danger alert-dismissible fade show attendance-alert"
                                role="alert">

                                <span class="alert-icon">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </span>

                                <div class="alert-content">
                                    {{ session('error') }}
                                </div>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>

                        </div>

                    @endif

                    @if ($errors->any())

                        <div class="attendance-alert-area">

                            <div class="alert alert-danger alert-dismissible fade show attendance-alert"
                                role="alert">

                                <span class="alert-icon">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </span>

                                <div class="alert-content">

                                    <strong>
                                        Please check the following:
                                    </strong>

                                    <ul class="mb-0 mt-1 ps-3">

                                        @foreach ($errors->all() as $error)

                                            <li>
                                                {{ $error }}
                                            </li>

                                        @endforeach

                                    </ul>

                                </div>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>

                        </div>

                    @endif

                    <!-- =================================================
                         SUMMARY CARDS
                         ================================================= -->

                    <section class="row g-3 mt-3">

                        <div class="col-12 col-sm-6 col-xl-3">

                            <article class="metric-card metric-success">

                                <div class="metric-top">

                                    <span class="metric-label">
                                        Present
                                    </span>

                                    <span class="metric-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </span>

                                </div>

                                <div class="metric-value">
                                    {{ $presentDays }}
                                </div>

                                <div class="metric-meta">
                                    Total Present Days
                                </div>

                            </article>

                        </div>

                        <div class="col-12 col-sm-6 col-xl-3">

                            <article class="metric-card metric-warning">

                                <div class="metric-top">

                                    <span class="metric-label">
                                        Late
                                    </span>

                                    <span class="metric-icon">
                                        <i class="bi bi-alarm-fill"></i>
                                    </span>

                                </div>

                                <div class="metric-value">
                                    {{ $lateDays }}
                                </div>

                                <div class="metric-meta">
                                    Late Records
                                </div>

                            </article>

                        </div>

                        <div class="col-12 col-sm-6 col-xl-3">

                            <article class="metric-card metric-danger">

                                <div class="metric-top">

                                    <span class="metric-label">
                                        Absent
                                    </span>

                                    <span class="metric-icon">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </span>

                                </div>

                                <div class="metric-value">
                                    {{ $absentDays }}
                                </div>

                                <div class="metric-meta">
                                    Absent Records
                                </div>

                            </article>

                        </div>

                        <div class="col-12 col-sm-6 col-xl-3">

                            <article class="metric-card metric-primary">

                                <div class="metric-top">

                                    <span class="metric-label">
                                        Leave / OB
                                    </span>

                                    <span class="metric-icon">
                                        <i class="bi bi-briefcase-fill"></i>
                                    </span>

                                </div>

                                <div class="metric-value">
                                    {{ $leaveDays + $officialBusinessDays }}
                                </div>

                                <div class="metric-meta">
                                    Leave & Official Business
                                </div>

                            </article>

                        </div>

                    </section>

                    <!-- =================================================
                         TODAY'S ATTENDANCE
                         ================================================= -->

                    <section class="panel mt-4">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1">
                                    Today's Attendance
                                </h2>

                                <p class="text-muted mb-0">
                                    Automatically recorded by the Face Recognition System
                                </p>

                            </div>

                        </div>

                        <div class="row g-3 today-attendance-grid">

                            <div class="col-12 col-sm-6 col-lg-3">

                                <div class="attendance-time-box border rounded p-3 text-center">

                                    <small class="text-muted">
                                        Morning Time In
                                    </small>

                                    <h4 class="mt-2 mb-0">

                                        {{ $todayAttendance && $todayAttendance->morning_time_in
                                            ? \Carbon\Carbon::parse($todayAttendance->morning_time_in)->format('h:i A')
                                            : '--' }}

                                    </h4>

                                </div>

                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">

                                <div class="attendance-time-box border rounded p-3 text-center">

                                    <small class="text-muted">
                                        Morning Time Out
                                    </small>

                                    <h4 class="mt-2 mb-0">

                                        {{ $todayAttendance && $todayAttendance->morning_time_out
                                            ? \Carbon\Carbon::parse($todayAttendance->morning_time_out)->format('h:i A')
                                            : '--' }}

                                    </h4>

                                </div>

                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">

                                <div class="attendance-time-box border rounded p-3 text-center">

                                    <small class="text-muted">
                                        Afternoon Time In
                                    </small>

                                    <h4 class="mt-2 mb-0">

                                        {{ $todayAttendance && $todayAttendance->afternoon_time_in
                                            ? \Carbon\Carbon::parse($todayAttendance->afternoon_time_in)->format('h:i A')
                                            : '--' }}

                                    </h4>

                                </div>

                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">

                                <div class="attendance-time-box border rounded p-3 text-center">

                                    <small class="text-muted">
                                        Afternoon Time Out
                                    </small>

                                    <h4 class="mt-2 mb-0">

                                        {{ $todayAttendance && $todayAttendance->afternoon_time_out
                                            ? \Carbon\Carbon::parse($todayAttendance->afternoon_time_out)->format('h:i A')
                                            : '--' }}

                                    </h4>

                                </div>

                            </div>

                        </div>

                    </section>

                    <!-- =================================================
                         ATTENDANCE SEARCH
                         ================================================= -->

                    <section class="panel mt-4">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1">
                                    Attendance Search
                                </h2>

                                <p class="text-muted mb-0">
                                    Select a specific attendance date.
                                </p>

                            </div>

                        </div>

                        <form method="GET"
                            action="{{ route('attendance') }}"
                            class="attendance-search-form">

                            <div class="row g-3 align-items-end">

                                <div class="col-12 col-lg-5">

                                    <label class="form-label">
                                        Select Date
                                    </label>

                                    <input type="date"
                                        name="date"
                                        class="form-control"
                                        value="{{ request('date') }}">

                                </div>

                                <div class="col-12 col-sm-4 col-lg-3">

                                    <button type="submit"
                                        class="btn btn-primary w-100">

                                        <i class="bi bi-search me-1"></i>

                                        Search Attendance

                                    </button>

                                </div>

                                <div class="col-12 col-sm-4 col-lg-2">

                                    <a href="{{ route('attendance') }}"
                                        class="btn btn-outline-secondary w-100">

                                        Reset

                                    </a>

                                </div>

                                <div class="col-12 col-sm-4 col-lg-2">

                                    <a href="{{ route('attendance') }}?date={{ now()->toDateString() }}"
                                        class="btn btn-success w-100">

                                        Today

                                    </a>

                                </div>

                            </div>

                        </form>

                    </section>

                    <!-- =================================================
                         RECENT ATTENDANCE
                         ================================================= -->

                    @php
                        /*
                         * Use the actual Attendance model and attendances
                         * table used by this project.
                         *
                         * Main page:
                         *   Only the 5 most recent records.
                         *
                         * Modal:
                         *   All attendance records.
                         *
                         * No pagination is used here.
                         */
                        $allAttendanceRecords = \App\Models\Attendance::where('user_id', $employee->id)
                            ->orderByDesc('date')
                            ->get();

                        $recentAttendanceRecords = $allAttendanceRecords->take(5);
                    @endphp

                    <section class="panel mt-4">

                        <div class="panel-header recent-attendance-header">

                            <div>

                                <h2 class="h5 mb-1">
                                    Recent Attendance
                                </h2>

                                <p class="text-muted mb-0">
                                    Showing your 5 most recent attendance records.
                                </p>

                            </div>

                            <button type="button"
                                class="btn btn-primary view-history-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#attendanceHistoryModal">

                                <i class="bi bi-clock-history me-1"></i>
                                View All Attendance History

                            </button>

                        </div>

                        <!-- =================================================
                             RECENT ATTENDANCE DESKTOP TABLE
                             ================================================= -->

                        <div class="attendance-table-wrapper">

                            <table class="table align-middle attendance-table">

                                <thead>

                                    <tr>

                                        <th>Date</th>
                                        <th>Morning In</th>
                                        <th>Morning Out</th>
                                        <th>Afternoon In</th>
                                        <th>Afternoon Out</th>
                                        <th>Hours Worked</th>
                                        <th>Status</th>
                                        <th>Remarks</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($recentAttendanceRecords as $attendance)

                                        <tr>

                                            <td>
                                                {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                                            </td>

                                            <td>

                                                {{ $attendance->morning_time_in
                                                    ? \Carbon\Carbon::parse($attendance->morning_time_in)->format('h:i A')
                                                    : '--' }}

                                            </td>

                                            <td>

                                                {{ $attendance->morning_time_out
                                                    ? \Carbon\Carbon::parse($attendance->morning_time_out)->format('h:i A')
                                                    : '--' }}

                                            </td>

                                            <td>

                                                {{ $attendance->afternoon_time_in
                                                    ? \Carbon\Carbon::parse($attendance->afternoon_time_in)->format('h:i A')
                                                    : '--' }}

                                            </td>

                                            <td>

                                                {{ $attendance->afternoon_time_out
                                                    ? \Carbon\Carbon::parse($attendance->afternoon_time_out)->format('h:i A')
                                                    : '--' }}

                                            </td>

                                            <td>
                                                {{ $attendance->hours_worked }} hrs
                                            </td>

                                            <td>

                                                @if ($attendance->status == 'Present')

                                                    <span class="badge bg-success">
                                                        Present
                                                    </span>

                                                @elseif($attendance->status == 'Late')

                                                    <span class="badge bg-warning text-dark">
                                                        Late
                                                    </span>

                                                @elseif($attendance->status == 'Absent')

                                                    <span class="badge bg-danger">
                                                        Absent
                                                    </span>

                                                @elseif($attendance->status == 'Leave')

                                                    <span class="badge bg-primary">
                                                        Leave
                                                    </span>

                                                @elseif($attendance->status == 'Official Business')

                                                    <span class="badge bg-info text-dark">
                                                        Official Business
                                                    </span>

                                                @else

                                                    <span class="badge bg-secondary">
                                                        Unknown
                                                    </span>

                                                @endif

                                            </td>

                                            <td>
                                                {{ $attendance->remarks ?? '-' }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="8"
                                                class="text-center py-5 attendance-empty">

                                                <i class="bi bi-calendar-x fs-1 text-muted"></i>

                                                <h5 class="mt-3">
                                                    No attendance record found.
                                                </h5>

                                                <p class="text-muted mb-0">
                                                    Attendance will automatically appear here after successful Eye Recognition.
                                                </p>

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                        <!-- =================================================
                             RECENT ATTENDANCE MOBILE / TABLET CARDS
                             ================================================= -->

                        <div class="attendance-mobile-list">

                            @forelse($recentAttendanceRecords as $attendance)

                                <article class="attendance-mobile-card">

                                    <div class="attendance-mobile-header">

                                        <div class="attendance-mobile-date">

                                            <i class="bi bi-calendar3 me-1"></i>

                                            {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}

                                        </div>

                                        <div>

                                            @if ($attendance->status == 'Present')

                                                <span class="badge bg-success">
                                                    Present
                                                </span>

                                            @elseif($attendance->status == 'Late')

                                                <span class="badge bg-warning text-dark">
                                                    Late
                                                </span>

                                            @elseif($attendance->status == 'Absent')

                                                <span class="badge bg-danger">
                                                    Absent
                                                </span>

                                            @elseif($attendance->status == 'Leave')

                                                <span class="badge bg-primary">
                                                    Leave
                                                </span>

                                            @elseif($attendance->status == 'Official Business')

                                                <span class="badge bg-info text-dark">
                                                    Official Business
                                                </span>

                                            @else

                                                <span class="badge bg-secondary">
                                                    Unknown
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                    <div class="attendance-mobile-grid">

                                        <div class="attendance-mobile-item">

                                            <span class="attendance-mobile-label">
                                                Morning In
                                            </span>

                                            <span class="attendance-mobile-value">

                                                {{ $attendance->morning_time_in
                                                    ? \Carbon\Carbon::parse($attendance->morning_time_in)->format('h:i A')
                                                    : '--' }}

                                            </span>

                                        </div>

                                        <div class="attendance-mobile-item">

                                            <span class="attendance-mobile-label">
                                                Morning Out
                                            </span>

                                            <span class="attendance-mobile-value">

                                                {{ $attendance->morning_time_out
                                                    ? \Carbon\Carbon::parse($attendance->morning_time_out)->format('h:i A')
                                                    : '--' }}

                                            </span>

                                        </div>

                                        <div class="attendance-mobile-item">

                                            <span class="attendance-mobile-label">
                                                Afternoon In
                                            </span>

                                            <span class="attendance-mobile-value">

                                                {{ $attendance->afternoon_time_in
                                                    ? \Carbon\Carbon::parse($attendance->afternoon_time_in)->format('h:i A')
                                                    : '--' }}

                                            </span>

                                        </div>

                                        <div class="attendance-mobile-item">

                                            <span class="attendance-mobile-label">
                                                Afternoon Out
                                            </span>

                                            <span class="attendance-mobile-value">

                                                {{ $attendance->afternoon_time_out
                                                    ? \Carbon\Carbon::parse($attendance->afternoon_time_out)->format('h:i A')
                                                    : '--' }}

                                            </span>

                                        </div>

                                        <div class="attendance-mobile-item">

                                            <span class="attendance-mobile-label">
                                                Hours Worked
                                            </span>

                                            <span class="attendance-mobile-value">
                                                {{ $attendance->hours_worked }} hrs
                                            </span>

                                        </div>

                                        <div class="attendance-mobile-item attendance-mobile-remarks">

                                            <span class="attendance-mobile-label">
                                                Remarks
                                            </span>

                                            <span class="attendance-mobile-value">
                                                {{ $attendance->remarks ?? '-' }}
                                            </span>

                                        </div>

                                    </div>

                                </article>

                            @empty

                                <div class="text-center py-5 attendance-empty">

                                    <i class="bi bi-calendar-x fs-1 text-muted"></i>

                                    <h5 class="mt-3">
                                        No attendance record found.
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Attendance will automatically appear here after successful Eye Recognition.
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </section>

                    <!-- =================================================
                         ALL ATTENDANCE HISTORY MODAL
                         ================================================= -->

                    <div class="modal fade attendance-history-modal"
                        id="attendanceHistoryModal"
                        tabindex="-1"
                        aria-labelledby="attendanceHistoryModalLabel"
                        aria-hidden="true">

                        <div class="modal-dialog modal-xl modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <div class="min-w-0">

                                        <h5 class="modal-title"
                                            id="attendanceHistoryModalLabel">

                                            Attendance History

                                        </h5>

                                        <p class="text-muted small mb-0">
                                            View all your attendance records.
                                        </p>

                                    </div>

                                    <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>

                                <div class="modal-body">

                                    <!-- =================================================
                                         ALL HISTORY DESKTOP TABLE
                                         ================================================= -->

                                    <div class="history-table-wrapper">

                                        <table class="table table-hover align-middle history-table">

                                            <thead>

                                                <tr>

                                                    <th>Date</th>
                                                    <th>Morning In</th>
                                                    <th>Morning Out</th>
                                                    <th>Afternoon In</th>
                                                    <th>Afternoon Out</th>
                                                    <th>Hours Worked</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                @forelse($allAttendanceRecords as $attendance)

                                                    <tr>

                                                        <td>
                                                            {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                                                        </td>

                                                        <td>

                                                            {{ $attendance->morning_time_in
                                                                ? \Carbon\Carbon::parse($attendance->morning_time_in)->format('h:i A')
                                                                : '--' }}

                                                        </td>

                                                        <td>

                                                            {{ $attendance->morning_time_out
                                                                ? \Carbon\Carbon::parse($attendance->morning_time_out)->format('h:i A')
                                                                : '--' }}

                                                        </td>

                                                        <td>

                                                            {{ $attendance->afternoon_time_in
                                                                ? \Carbon\Carbon::parse($attendance->afternoon_time_in)->format('h:i A')
                                                                : '--' }}

                                                        </td>

                                                        <td>

                                                            {{ $attendance->afternoon_time_out
                                                                ? \Carbon\Carbon::parse($attendance->afternoon_time_out)->format('h:i A')
                                                                : '--' }}

                                                        </td>

                                                        <td>
                                                            {{ $attendance->hours_worked }} hrs
                                                        </td>

                                                        <td>

                                                            @if ($attendance->status == 'Present')

                                                                <span class="badge bg-success">
                                                                    Present
                                                                </span>

                                                            @elseif($attendance->status == 'Late')

                                                                <span class="badge bg-warning text-dark">
                                                                    Late
                                                                </span>

                                                            @elseif($attendance->status == 'Absent')

                                                                <span class="badge bg-danger">
                                                                    Absent
                                                                </span>

                                                            @elseif($attendance->status == 'Leave')

                                                                <span class="badge bg-primary">
                                                                    Leave
                                                                </span>

                                                            @elseif($attendance->status == 'Official Business')

                                                                <span class="badge bg-info text-dark">
                                                                    Official Business
                                                                </span>

                                                            @else

                                                                <span class="badge bg-secondary">
                                                                    Unknown
                                                                </span>

                                                            @endif

                                                        </td>

                                                        <td>
                                                            {{ $attendance->remarks ?? '-' }}
                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>

                                                        <td colspan="8"
                                                            class="text-center py-5 attendance-empty">

                                                            <i class="bi bi-calendar-x fs-1 text-muted"></i>

                                                            <h5 class="mt-3">
                                                                No attendance record found.
                                                            </h5>

                                                            <p class="text-muted mb-0">
                                                                Attendance will automatically appear here after successful Eye Recognition.
                                                            </p>

                                                        </td>

                                                    </tr>

                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                    <!-- =================================================
                                         ALL HISTORY MOBILE CARDS
                                         ================================================= -->

                                    <div class="history-mobile-list">

                                        @forelse($allAttendanceRecords as $attendance)

                                            <article class="attendance-mobile-card">

                                                <div class="attendance-mobile-header">

                                                    <div class="attendance-mobile-date">

                                                        <i class="bi bi-calendar3 me-1"></i>

                                                        {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}

                                                    </div>

                                                    <div>

                                                        @if ($attendance->status == 'Present')

                                                            <span class="badge bg-success">
                                                                Present
                                                            </span>

                                                        @elseif($attendance->status == 'Late')

                                                            <span class="badge bg-warning text-dark">
                                                                Late
                                                            </span>

                                                        @elseif($attendance->status == 'Absent')

                                                            <span class="badge bg-danger">
                                                                Absent
                                                            </span>

                                                        @elseif($attendance->status == 'Leave')

                                                            <span class="badge bg-primary">
                                                                Leave
                                                            </span>

                                                        @elseif($attendance->status == 'Official Business')

                                                            <span class="badge bg-info text-dark">
                                                                Official Business
                                                            </span>

                                                        @else

                                                            <span class="badge bg-secondary">
                                                                Unknown
                                                            </span>

                                                        @endif

                                                    </div>

                                                </div>

                                                <div class="attendance-mobile-grid">

                                                    <div class="attendance-mobile-item">

                                                        <span class="attendance-mobile-label">
                                                            Morning In
                                                        </span>

                                                        <span class="attendance-mobile-value">

                                                            {{ $attendance->morning_time_in
                                                                ? \Carbon\Carbon::parse($attendance->morning_time_in)->format('h:i A')
                                                                : '--' }}

                                                        </span>

                                                    </div>

                                                    <div class="attendance-mobile-item">

                                                        <span class="attendance-mobile-label">
                                                            Morning Out
                                                        </span>

                                                        <span class="attendance-mobile-value">

                                                            {{ $attendance->morning_time_out
                                                                ? \Carbon\Carbon::parse($attendance->morning_time_out)->format('h:i A')
                                                                : '--' }}

                                                        </span>

                                                    </div>

                                                    <div class="attendance-mobile-item">

                                                        <span class="attendance-mobile-label">
                                                            Afternoon In
                                                        </span>

                                                        <span class="attendance-mobile-value">

                                                            {{ $attendance->afternoon_time_in
                                                                ? \Carbon\Carbon::parse($attendance->afternoon_time_in)->format('h:i A')
                                                                : '--' }}

                                                        </span>

                                                    </div>

                                                    <div class="attendance-mobile-item">

                                                        <span class="attendance-mobile-label">
                                                            Afternoon Out
                                                        </span>

                                                        <span class="attendance-mobile-value">

                                                            {{ $attendance->afternoon_time_out
                                                                ? \Carbon\Carbon::parse($attendance->afternoon_time_out)->format('h:i A')
                                                                : '--' }}

                                                        </span>

                                                    </div>

                                                    <div class="attendance-mobile-item">

                                                        <span class="attendance-mobile-label">
                                                            Hours Worked
                                                        </span>

                                                        <span class="attendance-mobile-value">
                                                            {{ $attendance->hours_worked }} hrs
                                                        </span>

                                                    </div>

                                                    <div class="attendance-mobile-item attendance-mobile-remarks">

                                                        <span class="attendance-mobile-label">
                                                            Remarks
                                                        </span>

                                                        <span class="attendance-mobile-value">
                                                            {{ $attendance->remarks ?? '-' }}
                                                        </span>

                                                    </div>

                                                </div>

                                            </article>

                                        @empty

                                            <div class="text-center py-5 attendance-empty">

                                                <i class="bi bi-calendar-x fs-1 text-muted"></i>

                                                <h5 class="mt-3">
                                                    No attendance record found.
                                                </h5>

                                                <p class="text-muted mb-0">
                                                    Attendance will automatically appear here after successful Eye Recognition.
                                                </p>

                                            </div>

                                        @endforelse

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">

                                        Close

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </main>

            <!-- =================================================
                 FOOTER
                 ================================================= -->

            <footer class="admin-footer">

                <div class="container-fluid px-3 px-lg-4">

                    <span>

                        Copyright 2026 adminHMD.
                        <br>

                        Developed by

                        <a target="_blank"
                            class="fw-bold text-success"
                            href="https://github.com/HasanMahmudDev">

                            Md. Hasan Mahmud

                        </a>

                        • Distributed by

                        <a target="_blank"
                            class="fw-bold text-success"
                            href="https://themewagon.com">

                            ThemeWagon

                        </a>

                    </span>

                    <span>
                        Professional dashboard template.
                    </span>

                    <span>
                        User management dashboard.
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

