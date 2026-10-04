<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="description"
        content="PAP PAY Attendance Reports"
    >

    <title>Attendance Reports | PAP PAY</title>

    <link
        rel="icon"
        type="image/x-icon"
        href="../../../../khen/assets/images/favicon.png"
    >

    <link
        rel="stylesheet"
        href="../../../../khen/assets/css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css"
    >

    <link
        rel="stylesheet"
        href="../../../../khen/assets/css/style.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            background: #f5f7fb;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #172033;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 12px 0 30px;
        }

        .page-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.045);
            overflow: hidden;
        }

        .page-header {
            padding: 20px 22px;
            border-bottom: 1px solid #edf0f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .page-title {
            margin: 0;
            font-size: 24px;
            line-height: 1.25;
            font-weight: 700;
            color: #172033;
        }

        .page-subtitle {
            margin: 5px 0 0;
            color: #687385;
            font-size: 14px;
        }

        .filter-section,
        .generated-section,
        .history-section {
            padding: 27px 22px 22px;
        }

        .generated-section,
        .history-section {
            border-top: 1px solid #edf0f5;
        }

        .filter-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #172033;
        }

        .form-control,
        .form-select {
            min-height: 48px;
            border-radius: 9px;
            border: 1px solid #d1d7e0;
            font-size: 14px;
            color: #273244;
            box-shadow: none !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08) !important;
        }

        .generate-btn {
            width: 100%;
            min-height: 49px;
            border: 0;
            border-radius: 9px;
            background: #2563eb;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            padding: 10px 16px;
            transition: 0.2s ease;
        }

        .generate-btn:hover {
            background: #1d4ed8;
            color: #ffffff;
        }

        .btn-back {
            min-height: 44px;
            border-radius: 9px;
            padding: 8px 14px;
            font-size: 16px;
            font-weight: 600;
            color: #172033;
            border-color: #d9e0e9;
            background: #ffffff;
            box-shadow: 0 6px 15px rgba(15, 23, 42, 0.04);
        }

        .btn-back:hover {
            background: #f8fafc;
            color: #172033;
            border-color: #cbd5e1;
        }

        .generated-alert {
            border-radius: 9px;
            font-size: 14px;
        }

        .generated-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .generated-file {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            min-width: 0;
        }

        .generated-file-info {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .generated-file-icon {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .generated-file-icon.pdf {
            background: #fde8eb;
            color: #dc3545;
        }

        .generated-file-icon.excel {
            background: #e6f5ed;
            color: #198754;
        }

        .generated-file-text {
            min-width: 0;
        }

        .generated-file-text strong {
            display: block;
            color: #1f2937;
            font-size: 14px;
            font-weight: 700;
        }

        .generated-file-text span {
            display: block;
            margin-top: 3px;
            color: #6b7280;
            font-size: 12px;
            overflow-wrap: anywhere;
        }

        .btn-download {
            flex: 0 0 auto;
            border-radius: 8px;
            border: 0;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            padding: 9px 13px;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-download.pdf {
            background: #dc3545;
        }

        .btn-download.pdf:hover {
            background: #bb2d3b;
            color: #ffffff;
        }

        .btn-download.excel {
            background: #198754;
        }

        .btn-download.excel:hover {
            background: #157347;
            color: #ffffff;
        }

        .history-title {
            margin: 0 0 15px;
            color: #172033;
            font-size: 18px;
            font-weight: 700;
        }

        .history-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .history-box {
            border: 1px solid #dfe4eb;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .history-box-header {
            min-height: 69px;
            padding: 14px 10px 14px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px solid #dfe4eb;
        }

        .history-box-title {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
            padding-left: 0;
        }

        .history-box-title i {
            display: none;
        }

        .history-box-title strong {
            font-size: 16px;
            font-weight: 700;
            color: #172033;
        }

        .btn-view-all {
            border-radius: 8px;
            background: #ffffff;
            padding: 7px 12px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .btn-view-all.pdf {
            border: 1px solid #dc3545;
            color: #dc3545;
        }

        .btn-view-all.pdf:hover {
            background: #dc3545;
            color: #ffffff;
        }

        .btn-view-all.excel {
            border: 1px solid #198754;
            color: #198754;
        }

        .btn-view-all.excel:hover {
            background: #198754;
            color: #ffffff;
        }

        .history-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .history-table {
            width: 100%;
            min-width: 540px;
            margin: 0;
        }

        .history-table th {
            background: #fafbfc;
            color: #687385;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            font-weight: 700;
            padding: 12px 10px;
            border-bottom: 1px solid #dfe4eb;
            white-space: nowrap;
        }

        .history-table td {
            padding: 14px 10px;
            color: #29405f;
            font-size: 13px;
            vertical-align: middle;
            border-bottom: 1px solid #dfe4eb;
        }

        .history-table tr:last-child td {
            border-bottom: 0;
        }

        .history-file-name {
            color: #29405f;
            font-weight: 500;
            overflow-wrap: anywhere;
        }

        .history-empty {
            padding: 28px 15px !important;
            text-align: center;
            color: #8b94a3;
            font-size: 12px;
        }

        .history-download {
            display: inline-block;
            border-radius: 8px;
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
            padding: 8px 12px;
            text-decoration: none;
            white-space: nowrap;
        }

        .history-download.pdf {
            background: #dc3545;
        }

        .history-download.pdf:hover {
            background: #bb2d3b;
            color: #ffffff;
        }

        .history-download.excel {
            background: #198754;
        }

        .history-download.excel:hover {
            background: #157347;
            color: #ffffff;
        }

        .modal-content {
            border: 0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.18);
        }

        .modal-header {
            border-bottom: 1px solid #edf0f5;
            padding: 17px 20px;
        }

        .modal-title {
            font-size: 15px;
            font-weight: 700;
            color: #1f2937;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            border-top: 1px solid #edf0f5;
            padding: 13px 20px;
        }

        .history-modal-table-wrap {
            max-height: 440px;
            overflow: auto;
            border: 1px solid #e9edf2;
            border-radius: 10px;
        }

        .history-modal-table {
            width: 100%;
            min-width: 700px;
            margin: 0;
        }

        .history-modal-table th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: #fafbfc;
            color: #7a8495;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 10px 12px;
            border-bottom: 1px solid #e8ebef;
            white-space: nowrap;
        }

        .history-modal-table td {
            padding: 11px 12px;
            color: #4b5563;
            font-size: 11px;
            border-bottom: 1px solid #f0f2f5;
            vertical-align: middle;
        }

        .modal-empty {
            text-align: center;
            color: #8b94a3;
            padding: 35px 15px !important;
        }

        .generation-modal-icon {
            width: 55px;
            height: 55px;
            margin: 0 auto 14px;
            border-radius: 50%;
            background: #e8f0ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .generation-modal-text {
            text-align: center;
        }

        .generation-modal-text h5 {
            margin-bottom: 6px;
            color: #1f2937;
            font-weight: 800;
        }

        .generation-modal-text p {
            margin: 0;
            color: #737d8d;
            font-size: 13px;
            line-height: 1.6;
        }

        .report-footer {
            margin-top: 20px;
            text-align: center;
            color: #8b94a3;
            font-size: 11px;
        }

        @media (max-width: 991.98px) {

            .page-wrapper {
                padding-left: 12px;
                padding-right: 12px;
            }

            .generated-grid,
            .history-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 767.98px) {

            .page-wrapper {
                padding: 12px;
                padding-bottom: 30px;
            }

            .page-header {
                padding: 17px;
            }

            .filter-section,
            .generated-section,
            .history-section {
                padding: 17px;
            }

            .page-title {
                font-size: 20px;
            }

            .page-subtitle {
                font-size: 13px;
            }

            .btn-back {
                width: 100%;
                justify-content: center;
            }

            .generated-file {
                align-items: flex-start;
                flex-direction: column;
            }

            .btn-download {
                width: 100%;
                text-align: center;
            }

            .history-box-header {
                padding: 14px;
            }

            .btn-view-all {
                padding: 7px 10px;
            }

        }

        @media (max-width: 575.98px) {

            .history-box-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .btn-view-all {
                width: 100%;
            }

        }

    </style>

</head>

<body>

<div class="page-wrapper">

    <div class="page-card">

        <div class="page-header">

            <div>

                <h1 class="page-title">
                    Attendance Reports
                </h1>

                <p class="page-subtitle">
                    Generate and manage attendance reports.
                </p>

            </div>

            <a
                href="{{ route('reports') }}"
                class="btn btn-outline-secondary btn-back"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back to Reports
            </a>

        </div>


        <div class="filter-section">

            <form
                method="GET"
                action="{{ route('reports.attendance') }}"
                id="attendanceReportForm"
            >

                <div class="row g-3">

                    <div class="col-12 col-md-6 col-lg-3">

                        <label
                            for="attendanceStart"
                            class="filter-label"
                        >
                            Attendance Start
                        </label>

                        <input
                            type="date"
                            name="start"
                            id="attendanceStart"
                            class="form-control"
                            value="{{ request('start') }}"
                        >

                    </div>


                    <div class="col-12 col-md-6 col-lg-3">

                        <label
                            for="attendanceEnd"
                            class="filter-label"
                        >
                            Attendance End
                        </label>

                        <input
                            type="date"
                            name="end"
                            id="attendanceEnd"
                            class="form-control"
                            value="{{ request('end') }}"
                        >

                    </div>


                    <div class="col-12 col-md-6 col-lg-3">

                        <label
                            for="attendanceDepartment"
                            class="filter-label"
                        >
                            Department
                        </label>

                        <select
                            name="department"
                            id="attendanceDepartment"
                            class="form-select"
                        >

                            <option value="">
                                All Departments
                            </option>

                            @foreach($departments as $department)

                                <option
                                    value="{{ $department }}"
                                    {{ request('department') == $department ? 'selected' : '' }}
                                >
                                    {{ $department }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-12 col-md-6 col-lg-3">

                        <label
                            for="attendanceStatus"
                            class="filter-label"
                        >
                            Status
                        </label>

                        <select
                            name="status"
                            id="attendanceStatus"
                            class="form-select"
                        >

                            <option value="">
                                All Status
                            </option>

                            <option
                                value="Present"
                                {{ request('status') === 'Present' ? 'selected' : '' }}
                            >
                                Present
                            </option>

                            <option
                                value="Late"
                                {{ request('status') === 'Late' ? 'selected' : '' }}
                            >
                                Late
                            </option>

                            <option
                                value="Absent"
                                {{ request('status') === 'Absent' ? 'selected' : '' }}
                            >
                                Absent
                            </option>

                            <option
                                value="Leave"
                                {{ request('status') === 'Leave' ? 'selected' : '' }}
                            >
                                Leave
                            </option>

                        </select>

                    </div>


                    <div class="col-12">

                        <button
                            type="submit"
                            class="generate-btn"
                        >
                            <i class="bi bi-file-earmark-bar-graph me-1"></i>
                            Generate Report
                        </button>

                    </div>

                </div>

            </form>

        </div>


        @if(isset($generated) && $generated)

            <div class="generated-section">

                @if(($totalRecords ?? 0) > 0)

                    <div class="alert alert-success generated-alert mb-4">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Attendance report generated successfully.

                    </div>

                @else

                    <div class="alert alert-warning generated-alert mb-4">

                        <i class="bi bi-exclamation-circle-fill me-2"></i>

                        The attendance report was generated, but no attendance records
                        matched the selected filters.

                    </div>

                @endif


                @php

                    $attendanceReportFilters = $reportFilters
                        ?? request()->only([
                            'start',
                            'end',
                            'department',
                            'status'
                        ]);

                    $attendanceReportFilters = array_filter(
                        $attendanceReportFilters,
                        function ($value) {
                            return $value !== null && $value !== '';
                        }
                    );

                    $attendancePdfUrl = route(
                        'reports.attendance.pdf',
                        array_merge(
                            $attendanceReportFilters,
                            ['download' => 1]
                        )
                    );

                    $attendanceExcelUrl = route(
                        'reports.attendance.excel',
                        array_merge(
                            $attendanceReportFilters,
                            ['download' => 1]
                        )
                    );

                @endphp


                <div class="generated-grid">

                    <div class="generated-file">

                        <div class="generated-file-info">

                            <div class="generated-file-icon pdf">

                                <i class="bi bi-file-earmark-pdf"></i>

                            </div>

                            <div class="generated-file-text">

                                <strong>
                                    Attendance PDF Report
                                </strong>

                                <span>
                                    Download the generated attendance PDF report.
                                </span>

                            </div>

                        </div>

                        <a
                            href="{{ $attendancePdfUrl }}"
                            class="btn-download pdf"
                        >
                            <i class="bi bi-download me-1"></i>
                            Download PDF
                        </a>

                    </div>


                    <div class="generated-file">

                        <div class="generated-file-info">

                            <div class="generated-file-icon excel">

                                <i class="bi bi-file-earmark-spreadsheet"></i>

                            </div>

                            <div class="generated-file-text">

                                <strong>
                                    Attendance Excel Report
                                </strong>

                                <span>
                                    Download the generated attendance Excel report.
                                </span>

                            </div>

                        </div>

                        <a
                            href="{{ $attendanceExcelUrl }}"
                            class="btn-download excel"
                        >
                            <i class="bi bi-download me-1"></i>
                            Download Excel
                        </a>

                    </div>

                </div>

            </div>

        @endif


        <div class="history-section">

            <h2 class="history-title">
                Generated Report History
            </h2>


            <div class="history-grid">

                <div class="history-box">

                    <div class="history-box-header">

                        <div class="history-box-title">

                            <strong>
                                PDF History
                            </strong>

                        </div>

                        <button
                            type="button"
                            class="btn-view-all pdf"
                            data-bs-toggle="modal"
                            data-bs-target="#attendancePdfHistoryModal"
                        >
                            View All
                        </button>

                    </div>


                    <div class="history-table-wrap">

                        <table class="table history-table">

                            <thead>

                                <tr>

                                    <th>
                                        File
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody id="attendancePdfHistoryTable">

                                <tr>

                                    <td
                                        colspan="3"
                                        class="history-empty"
                                    >
                                        No generated PDF reports yet.
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>


                <div class="history-box">

                    <div class="history-box-header">

                        <div class="history-box-title">

                            <strong>
                                Excel History
                            </strong>

                        </div>

                        <button
                            type="button"
                            class="btn-view-all excel"
                            data-bs-toggle="modal"
                            data-bs-target="#attendanceExcelHistoryModal"
                        >
                            View All
                        </button>

                    </div>


                    <div class="history-table-wrap">

                        <table class="table history-table">

                            <thead>

                                <tr>

                                    <th>
                                        File
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody id="attendanceExcelHistoryTable">

                                <tr>

                                    <td
                                        colspan="3"
                                        class="history-empty"
                                    >
                                        No generated Excel reports yet.
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="report-footer">

        PAP PAY Attendance Management System

    </div>

</div>


<div
    class="modal fade"
    id="attendancePdfHistoryModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-file-earmark-pdf me-2"></i>

                    Attendance PDF Report History

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body">

                <div class="row g-3 align-items-end mb-3">

                    <div class="col-12 col-md-7">

                        <label
                            for="attendancePdfHistoryDate"
                            class="filter-label"
                        >
                            Search by Generated Date
                        </label>

                        <input
                            type="date"
                            id="attendancePdfHistoryDate"
                            class="form-control"
                        >

                    </div>


                    <div class="col-12 col-md-5">

                        <div class="d-flex gap-2">

                            <button
                                type="button"
                                class="generate-btn"
                                id="searchAttendancePdfHistory"
                            >
                                <i class="bi bi-search me-1"></i>
                                Search
                            </button>

                            <button
                                type="button"
                                class="btn btn-outline-secondary flex-fill"
                                id="clearAttendancePdfHistory"
                            >
                                Clear
                            </button>

                        </div>

                    </div>

                </div>


                <div class="history-modal-table-wrap">

                    <table class="table history-modal-table">

                        <thead>

                            <tr>

                                <th>
                                    File
                                </th>

                                <th>
                                    Generated Date
                                </th>

                                <th>
                                    Report Period
                                </th>

                                <th>
                                    Department
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody id="attendancePdfModalTable"></tbody>

                    </table>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>

            </div>

        </div>

    </div>

</div>


<div
    class="modal fade"
    id="attendanceExcelHistoryModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-file-earmark-spreadsheet me-2"></i>

                    Attendance Excel Report History

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body">

                <div class="row g-3 align-items-end mb-3">

                    <div class="col-12 col-md-7">

                        <label
                            for="attendanceExcelHistoryDate"
                            class="filter-label"
                        >
                            Search by Generated Date
                        </label>

                        <input
                            type="date"
                            id="attendanceExcelHistoryDate"
                            class="form-control"
                        >

                    </div>


                    <div class="col-12 col-md-5">

                        <div class="d-flex gap-2">

                            <button
                                type="button"
                                class="generate-btn"
                                id="searchAttendanceExcelHistory"
                            >
                                <i class="bi bi-search me-1"></i>
                                Search
                            </button>

                            <button
                                type="button"
                                class="btn btn-outline-secondary flex-fill"
                                id="clearAttendanceExcelHistory"
                            >
                                Clear
                            </button>

                        </div>

                    </div>

                </div>


                <div class="history-modal-table-wrap">

                    <table class="table history-modal-table">

                        <thead>

                            <tr>

                                <th>
                                    File
                                </th>

                                <th>
                                    Generated Date
                                </th>

                                <th>
                                    Report Period
                                </th>

                                <th>
                                    Department
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody id="attendanceExcelModalTable"></tbody>

                    </table>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>

            </div>

        </div>

    </div>

</div>


<div
    class="modal fade"
    id="attendanceGenerationModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body p-4">

                <div class="generation-modal-icon">

                    <i
                        id="attendanceGenerationIcon"
                        class="bi bi-check-lg"
                    ></i>

                </div>

                <div class="generation-modal-text">

                    <h5 id="attendanceGenerationTitle">
                        Report Generated
                    </h5>

                    <p id="attendanceGenerationMessage">
                        Your attendance PDF and Excel reports are ready for download.
                    </p>

                </div>

                <div class="d-flex justify-content-center mt-4">

                    <button
                        type="button"
                        class="btn generate-btn"
                        style="width:auto;"
                        data-bs-dismiss="modal"
                    >
                        Done
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const reportsPageUrl =
        @json(route('reports'));

    const attendanceReportsUrl =
        @json(route('reports.attendance'));


    const attendanceForm =
        document.getElementById('attendanceReportForm');

    const attendanceStart =
        document.getElementById('attendanceStart');

    const attendanceEnd =
        document.getElementById('attendanceEnd');


    const pdfHistoryKey =
        'pap_pay_attendance_pdf_history';

    const excelHistoryKey =
        'pap_pay_attendance_excel_history';


    const attendancePdfUrl =
        @json($attendancePdfUrl ?? null);

    const attendanceExcelUrl =
        @json($attendanceExcelUrl ?? null);


    const serverStart =
        @json(
            $reportFilters['start']
            ?? request('start')
            ?? ''
        );

    const serverEnd =
        @json(
            $reportFilters['end']
            ?? request('end')
            ?? ''
        );

    const serverDepartment =
        @json(
            $reportFilters['department']
            ?? request('department')
            ?? ''
        );

    const serverStatus =
        @json(
            $reportFilters['status']
            ?? request('status')
            ?? ''
        );


    function getHistory(key) {

        try {

            const stored =
                localStorage.getItem(key);

            if (!stored) {
                return [];
            }

            const parsed =
                JSON.parse(stored);

            return Array.isArray(parsed)
                ? parsed
                : [];

        } catch (error) {

            return [];

        }

    }


    function saveHistory(key, history) {

        localStorage.setItem(
            key,
            JSON.stringify(history)
        );

    }


    function formatDate(dateValue) {

        if (!dateValue) {
            return '—';
        }

        const date =
            new Date(dateValue + 'T00:00:00');

        if (Number.isNaN(date.getTime())) {
            return dateValue;
        }

        return date.toLocaleDateString(
            undefined,
            {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric'
            }
        );

    }


    function formatGeneratedDate(dateValue) {

        if (!dateValue) {
            return '—';
        }

        const date =
            new Date(dateValue);

        if (Number.isNaN(date.getTime())) {
            return dateValue;
        }

        return date.toLocaleString(
            undefined,
            {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit'
            }
        );

    }


    function formatPeriod(start, end) {

        if (start && end) {

            return formatDate(start)
                + ' - '
                + formatDate(end);

        }

        if (start) {

            return 'From '
                + formatDate(start);

        }

        if (end) {

            return 'Until '
                + formatDate(end);

        }

        return 'All Dates';

    }


    function cleanFilePart(value) {

        return String(value || 'all')
            .trim()
            .replace(
                /[^a-zA-Z0-9_-]+/g,
                '-'
            )
            .replace(
                /-+/g,
                '-'
            )
            .replace(
                /^-|-$/g,
                ''
            )
            .toLowerCase();

    }


    function getFileName(
        type,
        start,
        end,
        department
    ) {

        const departmentPart =
            cleanFilePart(
                department || 'all-departments'
            );

        const startPart =
            cleanFilePart(
                start || 'all'
            );

        const endPart =
            cleanFilePart(
                end || 'all'
            );

        const extension =
            type === 'pdf'
                ? 'pdf'
                : 'xlsx';

        return (
            'attendance-report-'
            + departmentPart
            + '-'
            + startPart
            + '-to-'
            + endPart
            + '.'
            + extension
        );

    }


    function getRecordKey(
        type,
        start,
        end,
        department,
        status
    ) {

        return [
            type,
            start || '',
            end || '',
            department || '',
            status || ''
        ].join('|');

    }


    function addHistoryRecord(
        type,
        url
    ) {

        if (!url) {
            return;
        }

        const start =
            serverStart || '';

        const end =
            serverEnd || '';

        const department =
            serverDepartment || '';

        const status =
            serverStatus || '';


        const key =
            type === 'pdf'
                ? pdfHistoryKey
                : excelHistoryKey;


        const history =
            getHistory(key);


        const recordKey =
            getRecordKey(
                type,
                start,
                end,
                department,
                status
            );


        const existingIndex =
            history.findIndex(
                function (item) {

                    return item.recordKey === recordKey;

                }
            );


        if (existingIndex !== -1) {

            history.splice(
                existingIndex,
                1
            );

        }


        const now =
            new Date();


        const generatedDate =
            now.getFullYear()
            + '-'
            + String(
                now.getMonth() + 1
            ).padStart(2, '0')
            + '-'
            + String(
                now.getDate()
            ).padStart(2, '0');


        const record = {

            id:
                Date.now()
                + '-'
                + type,

            recordKey:
                recordKey,

            fileName:
                getFileName(
                    type,
                    start,
                    end,
                    department
                ),

            start:
                start,

            end:
                end,

            department:
                department
                || 'All Departments',

            status:
                status
                || 'All Status',

            url:
                url,

            generatedDate:
                generatedDate,

            generatedAt:
                now.toLocaleString()

        };


        history.unshift(record);


        saveHistory(
            key,
            history
        );

    }


    function createDownloadButton(
        url,
        type
    ) {

        const link =
            document.createElement('a');

        link.href =
            url;

        link.className =
            'history-download '
            + (
                type === 'pdf'
                    ? 'pdf'
                    : 'excel'
            );

        link.innerHTML =
            '<i class="bi bi-download me-1"></i> Download';

        return link;

    }


    function renderHistory(type) {

        const key =
            type === 'pdf'
                ? pdfHistoryKey
                : excelHistoryKey;


        const target =
            type === 'pdf'
                ? document.getElementById(
                    'attendancePdfHistoryTable'
                )
                : document.getElementById(
                    'attendanceExcelHistoryTable'
                );


        if (!target) {
            return;
        }


        const history =
            getHistory(key);


        const recentHistory =
            history.slice(0, 5);


        target.innerHTML =
            '';


        if (!recentHistory.length) {

            target.innerHTML = `
                <tr>
                    <td colspan="3" class="history-empty">
                        No generated ${type.toUpperCase()} reports yet.
                    </td>
                </tr>
            `;

            return;

        }


        recentHistory.forEach(
            function (record) {

                const row =
                    document.createElement('tr');


                const reportCell =
                    document.createElement('td');

                reportCell.className =
                    'history-file-name';

                reportCell.textContent =
                    record.fileName
                    || 'Attendance Report';


                const dateCell =
                    document.createElement('td');

                dateCell.textContent =
                    formatGeneratedDate(
                        record.generatedAt
                    );


                const actionCell =
                    document.createElement('td');

                actionCell.appendChild(
                    createDownloadButton(
                        record.url,
                        type
                    )
                );


                row.appendChild(
                    reportCell
                );

                row.appendChild(
                    dateCell
                );

                row.appendChild(
                    actionCell
                );


                target.appendChild(
                    row
                );

            }
        );

    }


    function renderModalHistory(
        type,
        dateFilter = ''
    ) {

        const key =
            type === 'pdf'
                ? pdfHistoryKey
                : excelHistoryKey;


        const target =
            type === 'pdf'
                ? document.getElementById(
                    'attendancePdfModalTable'
                )
                : document.getElementById(
                    'attendanceExcelModalTable'
                );


        if (!target) {
            return;
        }


        let history =
            getHistory(key);


        if (dateFilter) {

            history =
                history.filter(
                    function (record) {

                        return record.generatedDate
                            === dateFilter;

                    }
                );

        }


        target.innerHTML =
            '';


        if (!history.length) {

            target.innerHTML = `
                <tr>
                    <td colspan="6" class="modal-empty">
                        No ${type.toUpperCase()} report history found.
                    </td>
                </tr>
            `;

            return;

        }


        history.forEach(
            function (record) {

                const row =
                    document.createElement('tr');


                const reportCell =
                    document.createElement('td');

                reportCell.className =
                    'history-file-name';

                reportCell.textContent =
                    record.fileName
                    || 'Attendance Report';


                const dateCell =
                    document.createElement('td');

                dateCell.textContent =
                    formatGeneratedDate(
                        record.generatedAt
                    );


                const periodCell =
                    document.createElement('td');

                periodCell.textContent =
                    formatPeriod(
                        record.start,
                        record.end
                    );


                const departmentCell =
                    document.createElement('td');

                departmentCell.textContent =
                    record.department
                    || 'All Departments';


                const statusCell =
                    document.createElement('td');

                statusCell.textContent =
                    record.status
                    || 'All Status';


                const actionCell =
                    document.createElement('td');

                actionCell.appendChild(
                    createDownloadButton(
                        record.url,
                        type
                    )
                );


                row.appendChild(
                    reportCell
                );

                row.appendChild(
                    dateCell
                );

                row.appendChild(
                    periodCell
                );

                row.appendChild(
                    departmentCell
                );

                row.appendChild(
                    statusCell
                );

                row.appendChild(
                    actionCell
                );


                target.appendChild(
                    row
                );

            }
        );

    }


    renderHistory('pdf');

    renderHistory('excel');


    const navigationEntries =
        performance.getEntriesByType(
            'navigation'
        );


    const isReload =
        navigationEntries.length > 0
            ? navigationEntries[0].type === 'reload'
            : (
                performance.navigation
                && performance.navigation.type === 1
            );


    @if(isset($generated) && $generated)

        if (!isReload) {

            addHistoryRecord(
                'pdf',
                attendancePdfUrl
            );

            addHistoryRecord(
                'excel',
                attendanceExcelUrl
            );


            renderHistory('pdf');

            renderHistory('excel');


            const generationModalElement =
                document.getElementById(
                    'attendanceGenerationModal'
                );


            if (generationModalElement) {

                const generationModal =
                    new bootstrap.Modal(
                        generationModalElement
                    );


                const title =
                    document.getElementById(
                        'attendanceGenerationTitle'
                    );


                const message =
                    document.getElementById(
                        'attendanceGenerationMessage'
                    );


                const icon =
                    document.getElementById(
                        'attendanceGenerationIcon'
                    );


                title.textContent =
                    'Report Generated';


                message.textContent =
                    'Your attendance PDF and Excel reports are ready for download.';


                icon.className =
                    'bi bi-check-lg';


                generationModal.show();

            }

        }

    @endif


    if (isReload) {

        window.location.replace(
            attendanceReportsUrl
        );

        return;

    }


    if (attendanceForm) {

        attendanceForm.addEventListener(
            'submit',
            function (event) {

                if (
                    attendanceStart.value
                    &&
                    attendanceEnd.value
                    &&
                    attendanceStart.value >
                    attendanceEnd.value
                ) {

                    event.preventDefault();


                    alert(
                        'The start date cannot be later than the end date.'
                    );


                    attendanceStart.focus();

                }

            }
        );

    }


    const pdfDateInput =
        document.getElementById(
            'attendancePdfHistoryDate'
        );


    const excelDateInput =
        document.getElementById(
            'attendanceExcelHistoryDate'
        );


    const pdfSearchButton =
        document.getElementById(
            'searchAttendancePdfHistory'
        );


    const excelSearchButton =
        document.getElementById(
            'searchAttendanceExcelHistory'
        );


    const pdfClearButton =
        document.getElementById(
            'clearAttendancePdfHistory'
        );


    const excelClearButton =
        document.getElementById(
            'clearAttendanceExcelHistory'
        );


    if (pdfSearchButton) {

        pdfSearchButton.addEventListener(
            'click',
            function () {

                renderModalHistory(
                    'pdf',
                    pdfDateInput.value
                );

            }
        );

    }


    if (excelSearchButton) {

        excelSearchButton.addEventListener(
            'click',
            function () {

                renderModalHistory(
                    'excel',
                    excelDateInput.value
                );

            }
        );

    }


    if (pdfClearButton) {

        pdfClearButton.addEventListener(
            'click',
            function () {

                pdfDateInput.value =
                    '';

                renderModalHistory(
                    'pdf'
                );

            }
        );

    }


    if (excelClearButton) {

        excelClearButton.addEventListener(
            'click',
            function () {

                excelDateInput.value =
                    '';

                renderModalHistory(
                    'excel'
                );

            }
        );

    }


    const pdfModal =
        document.getElementById(
            'attendancePdfHistoryModal'
        );


    if (pdfModal) {

        pdfModal.addEventListener(
            'shown.bs.modal',
            function () {

                renderModalHistory(
                    'pdf',
                    pdfDateInput.value
                );

            }
        );

    }


    const excelModal =
        document.getElementById(
            'attendanceExcelHistoryModal'
        );


    if (excelModal) {

        excelModal.addEventListener(
            'shown.bs.modal',
            function () {

                renderModalHistory(
                    'excel',
                    excelDateInput.value
                );

            }
        );

    }


    if (!window.__attendanceReportsBackHandlerInitialized) {

        history.pushState(
            {
                attendanceReportPage: true
            },
            '',
            window.location.href
        );


        window.addEventListener(
            'popstate',
            function () {

                window.location.replace(
                    reportsPageUrl
                );

            }
        );


        window.__attendanceReportsBackHandlerInitialized =
            true;

    }

});

</script>

</body>

</html>
