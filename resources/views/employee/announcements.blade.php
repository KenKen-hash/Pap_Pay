@php
    $employee = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="Employee announcements - PAP Pay Payroll Management System">

    <title>Announcements | PAP Pay</title>

    <link rel="icon"
        type="image/x-icon"
        href="../../../../khen/assets/images/favicon.png">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="../../../../khen/assets/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <!-- Main Template CSS -->
    <link rel="stylesheet"
        href="../../../../khen/assets/css/style.css">


    <style>

        /* =========================================================
           GLOBAL RESPONSIVE RESET
           ========================================================= */

        html {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

        body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: #f7f9fc;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        img,
        svg,
        video,
        iframe {
            max-width: 100%;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        a,
        small,
        strong {
            max-width: 100%;
        }


        /* =========================================================
           MAIN APPLICATION SHELL
           ========================================================= */

        .admin-shell {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }

        .admin-main {
            min-width: 0 !important;
            max-width: 100%;
            overflow-x: hidden;
        }

        .dashboard-content {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow-x: hidden;
        }


        /* =========================================================
           NAVBAR
           ========================================================= */

        .admin-navbar {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .admin-navbar .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .admin-navbar form {
            min-width: 0;
            max-width: 100%;
        }

        .admin-navbar .search-input {
            width: 100%;
            min-width: 0;
            max-width: 100%;
        }

        .navbar-actions {
            min-width: 0;
            flex-shrink: 0;
        }


        /* =========================================================
           PAGE CONTAINER
           ========================================================= */

        .announcement-container {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0 auto;
        }

        .announcement-container > .row {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-left: 0;
            margin-right: 0;
        }

        .announcement-container .row > * {
            min-width: 0;
        }


        /* =========================================================
           PAGE HEADER
           ========================================================= */

        .announcement-page-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .announcement-page-header h2 {
            margin: 0;
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-page-header p {
            max-width: 100%;
            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =========================================================
           SEARCH
           ========================================================= */

        .announcement-search-row {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-left: 0;
            margin-right: 0;
        }

        .announcement-search-wrapper {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .announcement-search-wrapper .input-group {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .announcement-search-wrapper .input-group-text {
            flex: 0 0 auto;
            border-color: #e5e7eb;
        }

        .announcement-search-wrapper input {
            min-width: 0;
            width: 100%;
            max-width: 100%;
            border-color: #e5e7eb;
            box-shadow: none !important;
        }

        .announcement-search-wrapper input:focus {
            border-color: #2563eb;
        }


        /* =========================================================
           ANNOUNCEMENT LIST
           ========================================================= */

        .announcement-list {
            width: 100%;
            max-width: 100%;
        }


        /* =========================================================
           ANNOUNCEMENT CARD
           ========================================================= */

        .announcement-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;

            background: #ffffff;
            border: 1px solid #edf0f5 !important;
            border-radius: 16px !important;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }

        .announcement-card:hover {
            transform: translateY(-2px);

            border-color: #dce4f2 !important;

            box-shadow:
                0 10px 25px rgba(15, 23, 42, .08) !important;
        }

        .announcement-card .card-body {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            overflow: hidden;
            padding: 1.25rem 1.35rem;
        }


        /* =========================================================
           ANNOUNCEMENT CARD HEADER
           ========================================================= */

        .announcement-header {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 1rem;
        }

        .announcement-title-area {
            flex: 1 1 auto;
            min-width: 0;
            max-width: 100%;
        }

        .announcement-title {
            margin: 0;

            max-width: 100%;

            overflow-wrap: anywhere;
            word-break: break-word;

            line-height: 1.4;
            font-size: 1.08rem;
            font-weight: 700;
            color: #1f2937;
        }

        .announcement-title-icon {
            color: #2563eb;
        }

        .announcement-meta {
            display: block;

            max-width: 100%;

            margin-top: .3rem;

            overflow-wrap: anywhere;
            word-break: break-word;

            line-height: 1.5;
            font-size: .78rem;
        }

        .announcement-badge {
            flex: 0 0 auto;

            white-space: nowrap;

            max-width: 100%;

            font-size: .7rem;
            font-weight: 600;

            padding: .4rem .65rem;

            border-radius: 999px;
        }


        /* =========================================================
           ANNOUNCEMENT PREVIEW
           ========================================================= */

        .announcement-preview {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            margin-top: 1rem;
            margin-bottom: 1rem;

            color: #6b7280;

            overflow: hidden;
            overflow-wrap: anywhere;
            word-break: break-word;

            line-height: 1.6;

            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;

            line-clamp: 2;
        }


        /* =========================================================
           CARD FOOTER / VIEW BUTTON
           ========================================================= */

        .announcement-card-footer {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 1rem;

            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .announcement-attachment-indicator {
            min-width: 0;
            max-width: 100%;

            color: #6b7280;

            font-size: .78rem;

            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-view-btn {
            flex: 0 0 auto;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: .4rem;

            min-height: 38px;

            padding: .5rem .9rem;

            border-radius: 9px;

            font-size: .82rem;
            font-weight: 600;

            white-space: nowrap;

            transition:
                background-color .2s ease,
                transform .2s ease;
        }

        .announcement-view-btn:hover {
            transform: translateY(-1px);
        }


        /* =========================================================
           ANNOUNCEMENT MODAL
           ========================================================= */

        .announcement-modal .modal-dialog {
            max-width: 760px;
            width: calc(100% - 2rem);
            margin: 1rem auto;
        }

        .announcement-modal .modal-content {
            border: 0;
            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, .2);
        }

        .announcement-modal .modal-header {
            padding: 1.15rem 1.35rem;

            background: #ffffff;

            border-bottom: 1px solid #edf0f5;
        }

        .announcement-modal-title-wrapper {
            min-width: 0;
            max-width: calc(100% - 40px);
        }

        .announcement-modal .modal-title {
            margin: 0;

            max-width: 100%;

            color: #1f2937;

            font-size: 1.2rem;
            font-weight: 700;

            line-height: 1.4;

            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-modal-meta {
            display: block;

            margin-top: .3rem;

            color: #6b7280;

            font-size: .78rem;
            line-height: 1.5;

            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-modal .btn-close {
            flex: 0 0 auto;
        }

        .announcement-modal .modal-body {
            max-height: 65vh;

            overflow-y: auto;
            overflow-x: hidden;

            padding: 1.35rem;
        }

        .announcement-modal-message {
            width: 100%;
            max-width: 100%;

            margin: 0;

            color: #374151;

            font-size: .95rem;
            line-height: 1.8;

            white-space: pre-wrap;

            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-modal-attachment {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: .4rem;

            margin-top: 1.25rem;

            max-width: 100%;

            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-modal .modal-footer {
            padding: .9rem 1.35rem;

            border-top: 1px solid #edf0f5;

            background: #fafbfc;
        }


        /* =========================================================
           EMPTY STATE
           ========================================================= */

        .announcement-empty {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            overflow: hidden;

            border-radius: 16px !important;
        }

        .announcement-empty .card-body {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            overflow: hidden;

            padding: 4rem 1.5rem;
        }

        .announcement-empty i {
            font-size: 3.5rem;
        }

        .announcement-empty h4 {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .announcement-empty p {
            max-width: 100%;

            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =========================================================
           SEARCH EMPTY STATE
           ========================================================= */

        #noSearchResults {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            border-radius: 16px !important;
        }

        #noSearchResults .card-body {
            padding: 3rem 1.5rem;
        }


        /* =========================================================
           FOOTER
           ========================================================= */

        .admin-footer {
            width: 100%;
            max-width: 100%;
            min-width: 0;

            overflow-x: hidden;
        }

        .admin-footer .container-fluid {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }

        .admin-footer span {
            max-width: 100%;

            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =========================================================
           TABLET
           ========================================================= */

        @media (max-width: 991.98px) {

            .admin-shell {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                overflow-x: hidden !important;
            }

            .admin-main {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                overflow-x: hidden !important;
            }

            .dashboard-content {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                overflow-x: hidden !important;
            }

            .admin-navbar {
                width: 100% !important;
                max-width: 100% !important;
            }

            .admin-navbar .container-fluid {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;
            }

            .admin-navbar form {
                min-width: 0;
                max-width: 100%;
            }

            .announcement-container {
                width: 100% !important;
                max-width: 100% !important;

                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .announcement-modal .modal-dialog {
                max-width: 720px;
            }

        }


        /* =========================================================
           MOBILE
           ========================================================= */

        @media (max-width: 767.98px) {

            html,
            body {
                width: 100%;
                max-width: 100%;

                overflow-x: hidden !important;
            }

            .admin-shell {
                display: block !important;

                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                overflow-x: hidden !important;
            }

            .admin-main {
                display: block !important;

                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                margin-left: 0 !important;
                padding-left: 0 !important;

                overflow-x: hidden !important;
            }

            .dashboard-content {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                margin-left: 0 !important;
                padding-left: 0 !important;

                overflow-x: hidden !important;
            }


            /* =====================================================
               MOBILE SIDEBAR
               ===================================================== */

            .admin-sidebar {
                position: fixed !important;

                top: 0 !important;
                left: 0 !important;
                bottom: 0 !important;

                width: min(280px, 86vw) !important;
                max-width: 86vw !important;

                z-index: 1050 !important;

                transform: translateX(-105%) !important;

                transition:
                    transform .25s ease,
                    box-shadow .25s ease !important;

                overflow-y: auto !important;
                overflow-x: hidden !important;
            }

            body.sidebar-open .admin-sidebar,
            .admin-shell.sidebar-open .admin-sidebar,
            .admin-sidebar.sidebar-open,
            .admin-sidebar.is-open,
            .admin-sidebar.show {
                transform: translateX(0) !important;

                box-shadow:
                    10px 0 30px rgba(0, 0, 0, .18) !important;
            }


            /* =====================================================
               SIDEBAR BACKDROP
               ===================================================== */

            .sidebar-backdrop {
                position: fixed !important;

                inset: 0 !important;

                z-index: 1040 !important;

                background: rgba(15, 23, 42, .45);

                opacity: 0;
                visibility: hidden;

                transition:
                    opacity .25s ease,
                    visibility .25s ease !important;
            }

            body.sidebar-open .sidebar-backdrop,
            .admin-shell.sidebar-open .sidebar-backdrop,
            .sidebar-backdrop.show,
            .sidebar-backdrop.is-visible {
                opacity: 1 !important;
                visibility: visible !important;
            }


            /* =====================================================
               NAVBAR
               ===================================================== */

            .admin-navbar {
                width: 100% !important;
                max-width: 100% !important;

                position: relative;
                z-index: 1000;
            }

            .admin-navbar .container-fluid {
                width: 100% !important;
                max-width: 100% !important;

                padding-left: .75rem !important;
                padding-right: .75rem !important;
            }

            .sidebar-toggle {
                flex: 0 0 auto;

                width: 44px;
                height: 44px;
            }

            .admin-navbar form {
                display: none !important;
            }

            .navbar-actions {
                display: flex;

                align-items: center;

                gap: .35rem;

                margin-left: auto !important;

                min-width: 0;

                flex-shrink: 0;
            }

            .icon-button {
                flex: 0 0 auto;
            }

            .profile-button {
                flex: 0 0 auto;

                max-width: 44px;

                overflow: hidden;
            }


            /* =====================================================
               MAIN PAGE CONTAINER
               ===================================================== */

            .announcement-container {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;

                padding: 1rem !important;

                overflow-x: hidden !important;
            }


            /* =====================================================
               PAGE HEADER
               ===================================================== */

            .announcement-page-header {
                width: 100%;

                margin-bottom: 1rem !important;
            }

            .announcement-page-header h2 {
                font-size: 1.55rem;

                line-height: 1.25;

                margin-bottom: .5rem !important;
            }

            .announcement-page-header p {
                font-size: .9rem;

                line-height: 1.55;
            }


            /* =====================================================
               SEARCH
               ===================================================== */

            .announcement-search-row {
                width: 100% !important;
                max-width: 100% !important;

                margin-bottom: 1rem !important;
            }

            .announcement-search-wrapper {
                width: 100% !important;
                max-width: 100% !important;

                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .announcement-search-wrapper .input-group {
                width: 100% !important;
                max-width: 100% !important;
            }

            .announcement-search-wrapper input {
                min-width: 0 !important;

                width: 100% !important;

                font-size: .9rem;
            }


            /* =====================================================
               ANNOUNCEMENT CARD
               ===================================================== */

            .announcement-card {
                width: 100% !important;
                max-width: 100% !important;

                margin-bottom: .75rem !important;

                border-radius: 14px !important;
            }

            .announcement-card .card-body {
                width: 100% !important;
                max-width: 100% !important;

                padding: 1rem !important;
            }

            .announcement-header {
                align-items: flex-start;

                gap: .65rem !important;
            }

            .announcement-title {
                font-size: 1rem;

                line-height: 1.4;
            }

            .announcement-meta {
                margin-top: .25rem;

                font-size: .74rem;

                line-height: 1.45;
            }

            .announcement-badge {
                font-size: .65rem;

                padding: .35rem .55rem;
            }

            .announcement-preview {
                margin-top: .8rem;
                margin-bottom: .85rem;

                font-size: .86rem;

                line-height: 1.6;

                -webkit-line-clamp: 2;
                line-clamp: 2;
            }

            .announcement-card-footer {
                gap: .65rem;
            }

            .announcement-attachment-indicator {
                font-size: .72rem;
            }

            .announcement-view-btn {
                min-height: 36px;

                padding: .45rem .75rem;

                font-size: .76rem;
            }


            /* =====================================================
               MODAL
               ===================================================== */

            .announcement-modal .modal-dialog {
                width: calc(100% - 1rem);

                max-width: none;

                margin: .5rem auto;
            }

            .announcement-modal .modal-content {
                border-radius: 15px;
            }

            .announcement-modal .modal-header {
                padding: 1rem;
            }

            .announcement-modal .modal-title {
                font-size: 1.05rem;
            }

            .announcement-modal-meta {
                font-size: .72rem;
            }

            .announcement-modal .modal-body {
                max-height: 70vh;

                padding: 1rem;
            }

            .announcement-modal-message {
                font-size: .88rem;

                line-height: 1.7;
            }

            .announcement-modal .modal-footer {
                padding: .75rem 1rem;
            }


            /* =====================================================
               EMPTY STATE
               ===================================================== */

            .announcement-empty {
                width: 100% !important;
                max-width: 100% !important;

                border-radius: 14px !important;
            }

            .announcement-empty .card-body {
                padding: 3rem 1rem !important;
            }

            .announcement-empty i {
                font-size: 3.25rem !important;
            }

            .announcement-empty h4 {
                font-size: 1.15rem;

                line-height: 1.4;
            }

            .announcement-empty p {
                font-size: .88rem;

                line-height: 1.6;
            }


            /* =====================================================
               SEARCH EMPTY STATE
               ===================================================== */

            #noSearchResults .card-body {
                padding: 2.5rem 1rem;
            }


            /* =====================================================
               FOOTER
               ===================================================== */

            .admin-footer {
                width: 100% !important;
                max-width: 100% !important;

                overflow-x: hidden !important;
            }

            .admin-footer .container-fluid {
                width: 100% !important;
                max-width: 100% !important;

                display: flex !important;

                flex-direction: column !important;

                align-items: flex-start !important;

                gap: .65rem !important;

                padding: 1rem !important;
            }

            .admin-footer span {
                width: 100%;

                max-width: 100%;

                font-size: .8rem;

                line-height: 1.5;
            }

        }


        /* =========================================================
           SMALL PHONES
           ========================================================= */

        @media (max-width: 575.98px) {

            .announcement-container {
                padding: .75rem !important;
            }

            .admin-navbar .container-fluid {
                padding-left: .65rem !important;
                padding-right: .65rem !important;
            }

            .sidebar-toggle {
                width: 40px;
                height: 40px;
            }

            .icon-button {
                width: 38px;
                height: 38px;

                padding: 0;
            }

            .profile-button {
                width: 40px;
                max-width: 40px;

                padding: 0 !important;
            }

            .announcement-page-header h2 {
                font-size: 1.4rem;
            }

            .announcement-page-header p {
                font-size: .84rem;
            }

            .announcement-search-wrapper input {
                font-size: .84rem;
            }

            .announcement-card .card-body {
                padding: .9rem !important;
            }

            .announcement-title {
                font-size: .95rem;
            }

            .announcement-preview {
                font-size: .82rem;
            }

            .announcement-view-btn {
                padding: .42rem .65rem;

                font-size: .72rem;
            }

            .announcement-attachment-indicator {
                font-size: .68rem;
            }

            .announcement-modal .modal-dialog {
                width: calc(100% - .75rem);
            }

            .announcement-modal .modal-body {
                max-height: 72vh;
            }

            .admin-footer span {
                font-size: .75rem;
            }

        }


        /* =========================================================
           VERY SMALL PHONES
           ========================================================= */

        @media (max-width: 380px) {

            .announcement-container {
                padding: .6rem !important;
            }

            .admin-navbar .container-fluid {
                padding-left: .5rem !important;
                padding-right: .5rem !important;
            }

            .sidebar-toggle {
                width: 38px;
                height: 38px;
            }

            .icon-button {
                width: 36px;
                height: 36px;
            }

            .profile-button {
                width: 38px;
                max-width: 38px;
            }

            .announcement-page-header h2 {
                font-size: 1.3rem;
            }

            .announcement-page-header p {
                font-size: .8rem;
            }

            .announcement-search-wrapper input {
                font-size: .8rem;
            }

            .announcement-card {
                border-radius: .85rem !important;
            }

            .announcement-card .card-body {
                padding: .75rem !important;
            }

            .announcement-title {
                font-size: .9rem;
            }

            .announcement-meta {
                font-size: .68rem;
            }

            .announcement-preview {
                font-size: .78rem;

                line-height: 1.55;
            }

            .announcement-badge {
                font-size: .58rem;
            }

            .announcement-view-btn {
                font-size: .68rem;

                padding: .4rem .55rem;
            }

            .announcement-modal .modal-title {
                font-size: .95rem;
            }

            .announcement-modal-message {
                font-size: .82rem;
            }

            .announcement-empty .card-body {
                padding: 2rem .65rem !important;
            }

            .announcement-empty i {
                font-size: 2.7rem !important;
            }

            .announcement-empty h4 {
                font-size: 1rem;
            }

            .announcement-empty p {
                font-size: .78rem;
            }

        }


        /* =========================================================
           EXTRA PROTECTION AGAINST HORIZONTAL OVERFLOW
           ========================================================= */

        .container,
        .container-fluid,
        .row,
        [class*="col-"] {
            min-width: 0;
        }

        .card,
        .card-body,
        .input-group {
            min-width: 0;
            max-width: 100%;
        }

        input,
        textarea,
        select,
        button {
            max-width: 100%;
        }

        a {
            overflow-wrap: anywhere;
        }

    </style>

</head>


<body>


<div class="admin-shell">


    <!-- =========================================================
         SIDEBAR BACKDROP
         ========================================================= -->

    <div class="sidebar-backdrop"
        data-sidebar-close>
    </div>


    <!-- =========================================================
         SIDEBAR
         ========================================================= -->

    <aside class="admin-sidebar"
        id="adminSidebar"
        aria-label="Main navigation">


        <!-- SIDEBAR HEADER -->

        <div class="sidebar-header">

            <a class="brand-mark"
               href="{{ route('dashboard') }}"
               aria-label="Admin Dashboard">

                <img src="../../../khen/assets/images/logo.jpg"
                     alt="Pap Pay Logo"
                     class="brand-logo">

            </a>

        </div>


        <!-- SIDEBAR NAVIGATION -->

        <nav class="sidebar-nav">


            <a class="nav-link"
                href="{{ route('dashboard') }}">

                <span class="nav-icon">

                    <i class="bi bi-house-door"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Home
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


            <a class="nav-link active"
                href="{{ route('employee.announcements') }}"
                aria-current="page">

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


        <!-- =====================================================
             SIDEBAR USER
             ===================================================== -->

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


        <!-- =====================================================
             SIDEBAR FOOTER
             ===================================================== -->

        <div class="sidebar-footer">

            <span class="status-dot"></span>

            <span class="sidebar-footer-text">
                System running smoothly
            </span>

        </div>


    </aside>


    <!-- =========================================================
         MAIN
         ========================================================= -->

    <div class="admin-main">


        <!-- =====================================================
             NAVBAR
             ===================================================== -->

        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">


                <!-- SIDEBAR TOGGLE -->

                <button class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="false"
                    aria-label="Toggle sidebar">

                    <span></span>
                    <span></span>
                    <span></span>

                </button>


                <!-- NAVBAR SEARCH -->

                <form class="admin-search-form d-none d-md-flex ms-3 flex-grow-1"
                    action="{{ route('search') }}"
                    method="GET"
                    role="search">

                    <div class="admin-search-wrapper">

                        <i class="bi bi-search admin-search-icon"
                            aria-hidden="true">
                        </i>

                        <input
                            type="search"
                            name="search"
                            id="adminSearchInput"
                            class="admin-search-input"
                            placeholder="Search Pap Pay..."
                            aria-label="Search Pap Pay"
                            autocomplete="off">

                        <button
                            type="button"
                            class="admin-search-clear"
                            id="adminSearchClear"
                            aria-label="Clear search">

                            <i class="bi bi-x-lg"
                                aria-hidden="true">
                            </i>

                        </button>

                        <div
                            class="admin-search-results"
                            id="adminSearchResults">
                        </div>

                    </div>

                </form>


                <!-- NAVBAR ACTIONS -->

                <div class="navbar-actions ms-auto">


                    <!-- NOTIFICATIONS -->

                    <div class="dropdown">

                        <button class="icon-button"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="Notifications">

                            <span class="notification-dot"></span>

                            <i class="bi bi-bell"
                                aria-hidden="true">
                            </i>

                        </button>


                        <div class="dropdown-menu dropdown-menu-end notification-menu">

                            <div class="dropdown-header fw-bold text-body">
                                Notifications
                            </div>


                            <a class="dropdown-item"
                                href="{{ route('employee.announcements') }}">

                                <span class="notification-title">
                                    New announcement
                                </span>

                                <span class="notification-time">
                                    Recent
                                </span>

                            </a>


                            <a class="dropdown-item"
                                href="{{ route('attendance') }}">

                                <span class="notification-title">
                                    Attendance records
                                </span>

                                <span class="notification-time">
                                    View attendance
                                </span>

                            </a>


                            <a class="dropdown-item"
                                href="{{ route('payslip') }}">

                                <span class="notification-title">
                                    Payslip
                                </span>

                                <span class="notification-time">
                                    View payslips
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


        <!-- =====================================================
             PAGE CONTENT
             ===================================================== -->

        <main class="dashboard-content">


            <div class="container-fluid announcement-container px-3 px-lg-4 py-4">


                <!-- =================================================
                     PAGE HEADER
                     ================================================= -->

                <div class="announcement-page-header mb-4">

                    <h2 class="fw-bold mb-2">
                        Announcements
                    </h2>

                    <p class="text-muted mb-0">
                        Stay updated with the latest announcements
                        from the administrator.
                    </p>

                </div>


                <!-- =================================================
                     SEARCH
                     ================================================= -->

                <div class="row announcement-search-row mb-4">

                    <div class="col-12 col-lg-6 announcement-search-wrapper">

                        <div class="input-group shadow-sm">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search"></i>

                            </span>

                            <input
                                type="text"
                                id="announcementSearch"
                                class="form-control"
                                placeholder="Search announcements..."
                                autocomplete="off">

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     ANNOUNCEMENTS
                     ================================================= -->

                <div class="row">

                    <div class="col-12">

                        <div class="announcement-list">

                            @forelse($announcements as $announcement)

                                <!-- =================================================
                                     ANNOUNCEMENT CARD
                                     ================================================= -->

                                <div class="card shadow-sm border-0 announcement-card mb-3"
                                    data-announcement-card
                                    data-search-text="{{ strtolower($announcement->title . ' ' . $announcement->message) }}">

                                    <div class="card-body">


                                        <!-- CARD HEADER -->

                                        <div class="announcement-header">

                                            <div class="announcement-title-area">

                                                <h4 class="announcement-title">

                                                    <span class="announcement-title-icon">

                                                        <i class="bi bi-megaphone-fill me-1"></i>

                                                    </span>

                                                    {{ $announcement->title }}

                                                </h4>


                                                <small class="text-muted announcement-meta">

                                                    Administrator

                                                    <span class="mx-1">
                                                        •
                                                    </span>

                                                    {{ $announcement->created_at->diffForHumans() }}

                                                </small>

                                            </div>


                                            <span class="badge bg-primary announcement-badge">

                                                Announcement

                                            </span>

                                        </div>


                                        <!-- SHORT PREVIEW -->

                                        <div class="announcement-preview">

                                            {{ $announcement->message }}

                                        </div>


                                        <!-- CARD FOOTER -->

                                        <div class="announcement-card-footer">


                                            <div class="announcement-attachment-indicator">

                                                @if ($announcement->attachment)

                                                    <i class="bi bi-paperclip me-1"></i>

                                                    Attachment available

                                                @else

                                                    <i class="bi bi-megaphone me-1"></i>

                                                    Administrator announcement

                                                @endif

                                            </div>


                                            <!-- VIEW BUTTON -->

                                            <button
                                                type="button"
                                                class="btn btn-primary announcement-view-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#announcementModal{{ $announcement->id }}">

                                                <i class="bi bi-eye"></i>

                                                <span>
                                                    View
                                                </span>

                                            </button>


                                        </div>


                                    </div>

                                </div>


                                <!-- =================================================
                                     ANNOUNCEMENT MODAL
                                     ================================================= -->

                                <div
                                    class="modal fade announcement-modal"
                                    id="announcementModal{{ $announcement->id }}"
                                    tabindex="-1"
                                    aria-labelledby="announcementModalLabel{{ $announcement->id }}"
                                    aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content">


                                            <!-- MODAL HEADER -->

                                            <div class="modal-header">

                                                <div class="announcement-modal-title-wrapper">

                                                    <h5
                                                        class="modal-title"
                                                        id="announcementModalLabel{{ $announcement->id }}">

                                                        <i class="bi bi-megaphone-fill text-primary me-1"></i>

                                                        {{ $announcement->title }}

                                                    </h5>


                                                    <small class="announcement-modal-meta">

                                                        Administrator

                                                        <span class="mx-1">
                                                            •
                                                        </span>

                                                        {{ $announcement->created_at->diffForHumans() }}

                                                    </small>

                                                </div>


                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>

                                            </div>


                                            <!-- MODAL BODY -->

                                            <div class="modal-body">


                                                <!-- FULL ANNOUNCEMENT -->

                                                <p class="announcement-modal-message">

                                                    {{ $announcement->message }}

                                                </p>


                                                <!-- ATTACHMENT -->

                                                @if ($announcement->attachment)

                                                    <a
                                                        href="{{ asset('storage/' . $announcement->attachment) }}"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="btn btn-outline-primary btn-sm announcement-modal-attachment">

                                                        <i class="bi bi-paperclip"></i>

                                                        View Attachment

                                                    </a>

                                                @endif


                                            </div>


                                            <!-- MODAL FOOTER -->

                                            <div class="modal-footer">

                                                <button
                                                    type="button"
                                                    class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">

                                                    Close

                                                </button>

                                            </div>


                                        </div>

                                    </div>

                                </div>


                            @empty


                                <!-- =================================================
                                     EMPTY STATE
                                     ================================================= -->

                                <div class="card shadow-sm border-0 announcement-empty">

                                    <div class="card-body text-center">

                                        <i class="bi bi-megaphone text-secondary"></i>

                                        <h4 class="mt-4">
                                            No Announcements
                                        </h4>

                                        <p class="text-muted mb-0">
                                            There are no announcements
                                            from the administrator.
                                        </p>

                                    </div>

                                </div>


                            @endforelse


                            <!-- =================================================
                                 NO SEARCH RESULTS
                                 ================================================= -->

                            @if ($announcements->count() > 0)

                                <div
                                    id="noSearchResults"
                                    class="card shadow-sm border-0"
                                    style="display:none;">

                                    <div class="card-body text-center">

                                        <i class="bi bi-search display-5 text-secondary"></i>

                                        <h5 class="mt-3">
                                            No matching announcements
                                        </h5>

                                        <p class="text-muted mb-0">
                                            Try a different search term.
                                        </p>

                                    </div>

                                </div>

                            @endif


                        </div>

                    </div>

                </div>


            </div>

        </main>


        <!-- =====================================================
             FOOTER
             ===================================================== -->

        <footer class="admin-footer">

            <div class="container-fluid px-3 px-lg-4">

                <span>

                    Copyright 2026 adminHMD.

                    <br>

                    Developed by

                    <a
                        target="_blank"
                        class="fw-bold text-success"
                        href="https://github.com/HasanMahmudDev">

                        Md. Hasan Mahmud

                    </a>

                    •

                    Distributed by

                    <a
                        target="_blank"
                        class="fw-bold text-success"
                        href="https://themewagon.com">

                        ThemeWagon

                    </a>

                </span>


                <span>
                    Professional dashboard template.
                </span>


                <span>
                    Responsive announcement system.
                </span>


            </div>

        </footer>


    </div>

</div>


<!-- =========================================================
     BOOTSTRAP
     ========================================================= -->

<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

<script src="../../../../khen/assets/js/main.js"></script>


<!-- =========================================================
     RESPONSIVE SIDEBAR + ANNOUNCEMENT SEARCH
     ========================================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | SIDEBAR
    |--------------------------------------------------------------------------
    */

    const sidebarToggle =
        document.querySelector('[data-sidebar-toggle]');

    const sidebar =
        document.getElementById('adminSidebar');

    const backdrop =
        document.querySelector('[data-sidebar-close]');

    const shell =
        document.querySelector('.admin-shell');


    function isMobile() {

        return window.innerWidth <= 767.98;

    }


    function openMobileSidebar() {

        if (!sidebar || !isMobile()) {
            return;
        }

        document.body.classList.add('sidebar-open');

        if (shell) {
            shell.classList.add('sidebar-open');
        }

        sidebar.classList.add('is-open');

        if (backdrop) {
            backdrop.classList.add('is-visible');
        }

        if (sidebarToggle) {

            sidebarToggle.setAttribute(
                'aria-expanded',
                'true'
            );

        }

    }


    function closeMobileSidebar() {

        document.body.classList.remove('sidebar-open');

        if (shell) {
            shell.classList.remove('sidebar-open');
        }

        if (sidebar) {
            sidebar.classList.remove('is-open');
        }

        if (backdrop) {
            backdrop.classList.remove('is-visible');
        }

        if (sidebarToggle) {

            sidebarToggle.setAttribute(
                'aria-expanded',
                'false'
            );

        }

    }


    if (sidebarToggle) {

        sidebarToggle.addEventListener(
            'click',
            function (event) {

                if (!isMobile()) {
                    return;
                }

                event.preventDefault();
                event.stopPropagation();


                if (
                    document.body.classList.contains(
                        'sidebar-open'
                    )
                ) {

                    closeMobileSidebar();

                } else {

                    openMobileSidebar();

                }

            },
            true
        );

    }


    if (backdrop) {

        backdrop.addEventListener(
            'click',
            function () {

                if (isMobile()) {
                    closeMobileSidebar();
                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE SIDEBAR WHEN NAVIGATION LINK IS CLICKED
    |--------------------------------------------------------------------------
    */

    if (sidebar) {

        sidebar.querySelectorAll('.nav-link')
            .forEach(function (link) {

                link.addEventListener(
                    'click',
                    function () {

                        if (isMobile()) {
                            closeMobileSidebar();
                        }

                    }
                );

            });

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE SIDEBAR WHEN SCREEN BECOMES DESKTOP
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        'resize',
        function () {

            if (!isMobile()) {
                closeMobileSidebar();
            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ANNOUNCEMENT SEARCH
    |--------------------------------------------------------------------------
    */

    const search =
        document.getElementById(
            'announcementSearch'
        );


    const cards =
        document.querySelectorAll(
            '[data-announcement-card]'
        );


    const noResults =
        document.getElementById(
            'noSearchResults'
        );


    if (search) {

        search.addEventListener(
            'input',
            function () {

                const value =
                    this.value
                        .trim()
                        .toLowerCase();


                let visibleCards = 0;


                cards.forEach(
                    function (card) {

                        const searchText =
                            card.dataset.searchText || '';


                        if (
                            value === '' ||
                            searchText.includes(value)
                        ) {

                            card.style.display = '';

                            visibleCards++;

                        } else {

                            card.style.display = 'none';

                        }

                    }
                );


                if (noResults) {

                    if (
                        value !== '' &&
                        visibleCards === 0
                    ) {

                        noResults.style.display = '';

                    } else {

                        noResults.style.display = 'none';

                    }

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | RESET SEARCH WHEN MODAL CLOSES
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.announcement-modal')
        .forEach(function (modal) {

            modal.addEventListener(
                'hidden.bs.modal',
                function () {

                    /*
                     * Keep the search text as it is.
                     * This only ensures the modal returns to
                     * its normal scroll position.
                     */

                    const modalBody =
                        modal.querySelector('.modal-body');

                    if (modalBody) {
                        modalBody.scrollTop = 0;
                    }

                }
            );

        });


});

</script>


</body>

</html>
