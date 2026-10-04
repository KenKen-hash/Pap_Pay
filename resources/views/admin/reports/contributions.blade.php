<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="PAP PAY Government Contributions Report">

    <title>Government Contributions Report | PAP PAY</title>

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
        }

        .page-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            padding-bottom: 30px;
        }

        .page-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .05);
            overflow: hidden;
        }

        .page-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .page-title {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
        }

        .page-subtitle {
            margin: 5px 0 0;
            font-size: 14px;
            color: #6b7280;
        }

        .filter-section {
            padding: 20px;
        }

        .filter-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            min-height: 43px;
            border-radius: 8px;
            border-color: #d1d5db;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 .15rem rgba(37, 99, 235, .12);
        }

        .generate-btn {
            min-height: 43px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
        }

        .generated-section,
        .history-section {
            padding: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .section-title {
            margin: 0 0 15px;
            font-size: 17px;
            font-weight: 700;
            color: #1f2937;
        }

        .file-card {
            height: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
            background: #fff;
        }

        .file-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            margin-bottom: 12px;
        }

        .pdf-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .excel-icon {
            background: #dcfce7;
            color: #16a34a;
        }

        .file-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
        }

        .file-description {
            margin: 6px 0 15px;
            color: #6b7280;
            font-size: 13px;
        }

        .file-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .file-actions .btn {
            flex: 1 1 120px;
        }

        .history-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }

        .history-card-header {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            border-bottom: 1px solid #e5e7eb;
        }

        .history-card-title {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: #1f2937;
        }

        .history-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .history-table {
            width: 100%;
            margin: 0;
        }

        .history-table th {
            font-size: 12px;
            font-weight: 700;
            color: #6b7280;
            background: #f9fafb;
            white-space: nowrap;
        }

        .history-table td {
            font-size: 13px;
            color: #374151;
            vertical-align: middle;
        }

        .history-empty {
            padding: 25px 15px;
            text-align: center;
            color: #9ca3af;
            font-size: 13px;
        }

        .modal-content {
            border: 0;
            border-radius: 14px;
            overflow: hidden;
        }

        .modal-header {
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-title {
            font-size: 17px;
            font-weight: 700;
        }

        .date-filter {
            padding: 15px;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-record {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .modal-record:last-child {
            border-bottom: 0;
        }

        .modal-record-info {
            min-width: 0;
        }

        .modal-record-name {
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
            overflow-wrap: anywhere;
        }

        .modal-record-details {
            margin-top: 4px;
            font-size: 12px;
            color: #6b7280;
        }

        .modal-record-action {
            flex-shrink: 0;
        }

        .modal-records {
            max-height: 55vh;
            overflow-y: auto;
        }

        .alert-success,
        .alert-warning {
            border-radius: 10px;
        }

        @media (max-width: 767.98px) {

            .page-wrapper {
                padding: 12px;
                padding-bottom: 30px;
            }

            .page-header,
            .filter-section,
            .generated-section,
            .history-section {
                padding: 15px;
            }

            .page-title {
                font-size: 19px;
            }

            .file-actions {
                flex-direction: column;
            }

            .file-actions .btn {
                width: 100%;
            }

            .modal-record {
                align-items: flex-start;
                flex-direction: column;
            }

            .modal-record-action {
                width: 100%;
            }

            .modal-record-action .btn {
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
                    Government Contributions Report
                </h1>

                <p class="page-subtitle">
                    Generate employee government contribution reports.
                </p>

            </div>

            <a
                href="{{ route('reports') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back to Reports
            </a>

        </div>


        <form
            method="GET"
            action="{{ route('reports.contributions') }}"
            id="contributionsReportForm"
        >

            <div class="filter-section">

                <div class="row g-3">

                    <div class="col-12">

                        <label
                            for="department"
                            class="filter-label"
                        >
                            Department
                        </label>

                        <select
                            name="department"
                            id="department"
                            class="form-select"
                        >

                            <option value="">
                                All Departments
                            </option>

                            <option
                                value="Elementary"
                                {{ request('department') === 'Elementary' ? 'selected' : '' }}
                            >
                                Elementary
                            </option>

                            <option
                                value="JHS"
                                {{ request('department') === 'JHS' ? 'selected' : '' }}
                            >
                                JHS
                            </option>

                            <option
                                value="SHS"
                                {{ request('department') === 'SHS' ? 'selected' : '' }}
                            >
                                SHS
                            </option>

                            <option
                                value="College"
                                {{ request('department') === 'College' ? 'selected' : '' }}
                            >
                                College
                            </option>

                            <option
                                value="Admin"
                                {{ request('department') === 'Admin' ? 'selected' : '' }}
                            >
                                Admin
                            </option>

                            <option
                                value="Laborers"
                                {{ request('department') === 'Laborers' ? 'selected' : '' }}
                            >
                                Laborers
                            </option>

                        </select>

                    </div>


                    <div class="col-12">

                        <input
                            type="hidden"
                            name="generate"
                            value="1"
                        >

                        <button
                            type="submit"
                            class="btn btn-primary generate-btn"
                        >
                            <i class="bi bi-file-earmark-bar-graph me-1"></i>
                            Generate Report
                        </button>

                    </div>

                </div>

            </div>

        </form>


        @if(request()->has('generate') || (isset($generated) && $generated))

            <div class="generated-section">

                @if(($totalEmployees ?? 0) > 0)

                    <div class="alert alert-success mb-4">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Government contributions report generated successfully.

                    </div>

                @else

                    <div class="alert alert-warning mb-4">

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>

                        Government contributions report generated successfully.
                        No employee contribution records were found for the
                        selected department.

                    </div>

                @endif


                <h2 class="section-title">
                    Generated Reports
                </h2>


                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="file-card">

                            <div class="file-icon pdf-icon">

                                <i class="bi bi-file-earmark-pdf"></i>

                            </div>

                            <h3 class="file-title">
                                PDF Report
                            </h3>

                            <p class="file-description">
                                Download the government contributions report
                                in PDF format.
                            </p>

                            <div class="file-actions">

                                <a
                                    href="{{ route('reports.contributions.pdf', array_merge(request()->query(), ['download' => 1])) }}"
                                    class="btn btn-danger"
                                    target="_blank"
                                >
                                    <i class="bi bi-download me-1"></i>
                                    Download PDF
                                </a>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="file-card">

                            <div class="file-icon excel-icon">

                                <i class="bi bi-file-earmark-excel"></i>

                            </div>

                            <h3 class="file-title">
                                Excel Report
                            </h3>

                            <p class="file-description">
                                Download the government contributions report
                                in Excel format.
                            </p>

                            <div class="file-actions">

                                <a
                                    href="{{ route('reports.contributions.excel', array_merge(request()->query(), ['download' => 1])) }}"
                                    class="btn btn-success"
                                    target="_blank"
                                >
                                    <i class="bi bi-download me-1"></i>
                                    Download Excel
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @endif


        <div class="history-section">

            <h2 class="section-title">
                Generated Report History
            </h2>


            <div class="row g-3">

                <div class="col-md-6">

                    <div class="history-card">

                        <div class="history-card-header">

                            <h3 class="history-card-title">
                                <i class="bi bi-file-earmark-pdf text-danger me-1"></i>
                                PDF History
                            </h3>

                            <button
                                type="button"
                                class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#pdfHistoryModal"
                            >
                                View All
                            </button>

                        </div>


                        <div class="history-table-wrapper">

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

                                <tbody id="pdfHistoryBody"></tbody>

                            </table>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="history-card">

                        <div class="history-card-header">

                            <h3 class="history-card-title">
                                <i class="bi bi-file-earmark-excel text-success me-1"></i>
                                Excel History
                            </h3>

                            <button
                                type="button"
                                class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#excelHistoryModal"
                            >
                                View All
                            </button>

                        </div>


                        <div class="history-table-wrapper">

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

                                <tbody id="excelHistoryBody"></tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div
    class="modal fade"
    id="generationModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Report Generated
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body text-center py-4">

                <div
                    class="mb-3"
                    style="font-size:48px;color:#198754;"
                >
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <p class="mb-0">
                    Your government contributions PDF and Excel reports
                    have been generated successfully.
                </p>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-dismiss="modal"
                >
                    Done
                </button>

            </div>

        </div>

    </div>

</div>


<div
    class="modal fade"
    id="pdfHistoryModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    PDF Report History
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="date-filter">

                <div class="row g-2">

                    <div class="col-md-8">

                        <input
                            type="date"
                            id="pdfHistoryDate"
                            class="form-control"
                        >

                    </div>

                    <div class="col-md-2">

                        <button
                            type="button"
                            class="btn btn-primary w-100"
                            id="searchPdfHistory"
                        >
                            Search
                        </button>

                    </div>

                    <div class="col-md-2">

                        <button
                            type="button"
                            class="btn btn-outline-secondary w-100"
                            id="clearPdfHistory"
                        >
                            Clear
                        </button>

                    </div>

                </div>

            </div>


            <div
                class="modal-records"
                id="pdfHistoryRecords"
            ></div>

        </div>

    </div>

</div>


<div
    class="modal fade"
    id="excelHistoryModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Excel Report History
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="date-filter">

                <div class="row g-2">

                    <div class="col-md-8">

                        <input
                            type="date"
                            id="excelHistoryDate"
                            class="form-control"
                        >

                    </div>

                    <div class="col-md-2">

                        <button
                            type="button"
                            class="btn btn-success w-100"
                            id="searchExcelHistory"
                        >
                            Search
                        </button>

                    </div>

                    <div class="col-md-2">

                        <button
                            type="button"
                            class="btn btn-outline-secondary w-100"
                            id="clearExcelHistory"
                        >
                            Clear
                        </button>

                    </div>

                </div>

            </div>


            <div
                class="modal-records"
                id="excelHistoryRecords"
            ></div>

        </div>

    </div>

</div>


<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

<script>

    const PDF_HISTORY_KEY =
        'pap_pay_contributions_pdf_history';

    const EXCEL_HISTORY_KEY =
        'pap_pay_contributions_excel_history';

    const REPORTS_PAGE_URL =
        @json(route('reports'));

    const CONTRIBUTIONS_REPORT_URL =
        @json(route('reports.contributions'));


    function getHistory(key) {

        try {

            return JSON.parse(
                localStorage.getItem(key) || '[]'
            );

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


    function formatDateTime(
        dateString,
        timeString
    ) {

        if (!dateString) {
            return '—';
        }

        if (!timeString) {
            return dateString;
        }

        return dateString + ' ' + timeString;

    }


    function addHistory(
        key,
        record
    ) {

        let history =
            getHistory(key);

        history =
            history.filter(function(item) {

                return item.recordKey !== record.recordKey;

            });

        history.unshift(record);

        history =
            history.slice(0, 100);

        saveHistory(
            key,
            history
        );

    }


    function escapeHtml(value) {

        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    }


    function escapeAttribute(value) {

        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

    }


    function renderMainHistory(
        key,
        elementId
    ) {

        const body =
            document.getElementById(elementId);

        if (!body) {
            return;
        }

        const history =
            getHistory(key).slice(0, 5);

        if (!history.length) {

            body.innerHTML = `
                <tr>
                    <td
                        colspan="3"
                        class="history-empty"
                    >
                        No generated reports yet.
                    </td>
                </tr>
            `;

            return;

        }

        body.innerHTML =
            history.map(function(item) {

                return `
                    <tr>

                        <td>

                            <div class="fw-semibold">
                                ${escapeHtml(
                                    item.filename || 'Report'
                                )}
                            </div>

                            <div class="text-muted small">
                                ${escapeHtml(
                                    item.department ||
                                    'All Departments'
                                )}
                            </div>

                        </td>

                        <td>
                            ${escapeHtml(
                                formatDateTime(
                                    item.generatedDate,
                                    item.generatedTime
                                )
                            )}
                        </td>

                        <td>

                            <a
                                href="${escapeAttribute(item.url)}"
                                class="btn btn-sm btn-outline-primary"
                                target="_blank"
                            >
                                <i class="bi bi-download"></i>
                            </a>

                        </td>

                    </tr>
                `;

            }).join('');

    }


    function renderModalHistory(
        key,
        elementId,
        dateValue
    ) {

        const container =
            document.getElementById(elementId);

        if (!container) {
            return;
        }

        let history =
            getHistory(key);

        if (dateValue) {

            history =
                history.filter(function(item) {

                    return item.generatedDate === dateValue;

                });

        }

        if (!history.length) {

            container.innerHTML = `
                <div class="history-empty">
                    No generated reports found.
                </div>
            `;

            return;

        }

        container.innerHTML =
            history.map(function(item) {

                return `
                    <div class="modal-record">

                        <div class="modal-record-info">

                            <div class="modal-record-name">
                                ${escapeHtml(
                                    item.filename || 'Report'
                                )}
                            </div>

                            <div class="modal-record-details">

                                Department:
                                ${escapeHtml(
                                    item.department ||
                                    'All Departments'
                                )}

                                <br>

                                Generated:
                                ${escapeHtml(
                                    formatDateTime(
                                        item.generatedDate,
                                        item.generatedTime
                                    )
                                )}

                            </div>

                        </div>

                        <div class="modal-record-action">

                            <a
                                href="${escapeAttribute(item.url)}"
                                class="btn btn-sm btn-outline-primary"
                                target="_blank"
                            >
                                <i class="bi bi-download me-1"></i>
                                Download
                            </a>

                        </div>

                    </div>
                `;

            }).join('');

    }


    function renderAllHistory() {

        renderMainHistory(
            PDF_HISTORY_KEY,
            'pdfHistoryBody'
        );

        renderMainHistory(
            EXCEL_HISTORY_KEY,
            'excelHistoryBody'
        );

        renderModalHistory(
            PDF_HISTORY_KEY,
            'pdfHistoryRecords',
            document.getElementById(
                'pdfHistoryDate'
            )?.value || ''
        );

        renderModalHistory(
            EXCEL_HISTORY_KEY,
            'excelHistoryRecords',
            document.getElementById(
                'excelHistoryDate'
            )?.value || ''
        );

    }


    document.addEventListener(
        'DOMContentLoaded',
        function() {

            renderAllHistory();


            const pdfSearch =
                document.getElementById(
                    'searchPdfHistory'
                );

            const pdfClear =
                document.getElementById(
                    'clearPdfHistory'
                );

            const pdfDate =
                document.getElementById(
                    'pdfHistoryDate'
                );


            if (pdfSearch) {

                pdfSearch.addEventListener(
                    'click',
                    function() {

                        renderModalHistory(
                            PDF_HISTORY_KEY,
                            'pdfHistoryRecords',
                            pdfDate.value
                        );

                    }
                );

            }


            if (pdfClear) {

                pdfClear.addEventListener(
                    'click',
                    function() {

                        pdfDate.value = '';

                        renderModalHistory(
                            PDF_HISTORY_KEY,
                            'pdfHistoryRecords',
                            ''
                        );

                    }
                );

            }


            const excelSearch =
                document.getElementById(
                    'searchExcelHistory'
                );

            const excelClear =
                document.getElementById(
                    'clearExcelHistory'
                );

            const excelDate =
                document.getElementById(
                    'excelHistoryDate'
                );


            if (excelSearch) {

                excelSearch.addEventListener(
                    'click',
                    function() {

                        renderModalHistory(
                            EXCEL_HISTORY_KEY,
                            'excelHistoryRecords',
                            excelDate.value
                        );

                    }
                );

            }


            if (excelClear) {

                excelClear.addEventListener(
                    'click',
                    function() {

                        excelDate.value = '';

                        renderModalHistory(
                            EXCEL_HISTORY_KEY,
                            'excelHistoryRecords',
                            ''
                        );

                    }
                );

            }


            const params =
                new URLSearchParams(
                    window.location.search
                );


            if (params.has('generate')) {

                const department =
                    params.get('department') ||
                    'All Departments';


                const cleanParams =
                    new URLSearchParams(params);

                cleanParams.delete('generate');

                cleanParams.set(
                    'download',
                    '1'
                );


                const pdfUrl =
                    @json(route('reports.contributions.pdf'))
                    + '?'
                    + cleanParams.toString();


                const excelUrl =
                    @json(route('reports.contributions.excel'))
                    + '?'
                    + cleanParams.toString();


                const now =
                    new Date();


                const generatedDate =
                    now.toISOString().slice(0, 10);


                const generatedTime =
                    now.toLocaleTimeString(
                        [],
                        {
                            hour: '2-digit',
                            minute: '2-digit'
                        }
                    );


                const departmentSlug =
                    department
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '') ||
                    'all-departments';


                const pdfRecord = {

                    recordKey:
                        'contributions-' +
                        departmentSlug,

                    filename:
                        'government-contributions-report-' +
                        departmentSlug +
                        '.pdf',

                    department:
                        department,

                    url:
                        pdfUrl,

                    generatedDate:
                        generatedDate,

                    generatedTime:
                        generatedTime

                };


                const excelRecord = {

                    recordKey:
                        'contributions-' +
                        departmentSlug,

                    filename:
                        'government-contributions-report-' +
                        departmentSlug +
                        '.xlsx',

                    department:
                        department,

                    url:
                        excelUrl,

                    generatedDate:
                        generatedDate,

                    generatedTime:
                        generatedTime

                };


                addHistory(
                    PDF_HISTORY_KEY,
                    pdfRecord
                );


                addHistory(
                    EXCEL_HISTORY_KEY,
                    excelRecord
                );


                renderAllHistory();


                const generationModalElement =
                    document.getElementById(
                        'generationModal'
                    );


                if (generationModalElement) {

                    const generationModal =
                        new bootstrap.Modal(
                            generationModalElement
                        );

                    generationModal.show();

                }

            }


            const navigationEntries =
                performance.getEntriesByType(
                    'navigation'
                );


            if (
                navigationEntries.length &&
                navigationEntries[0].type === 'reload' &&
                window.location.search
            ) {

                window.location.replace(
                    CONTRIBUTIONS_REPORT_URL
                );

                return;

            }


            history.pushState(
                null,
                '',
                window.location.href
            );


            window.addEventListener(
                'popstate',
                function() {

                    window.location.replace(
                        REPORTS_PAGE_URL
                    );

                }
            );

        }
    );

</script>

</body>

</html>
