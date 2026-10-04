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

    <title>Salary Report | PAP PAY</title>

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

        .generation-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #dcfce7;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 15px;
        }

        .generation-message {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
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
                    Salary Report
                </h1>

                <p class="page-subtitle">
                    Generate salary configuration reports.
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
            action="{{ route('reports.salary') }}"
            id="salaryReportForm"
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

                            <option
                                value=""
                                {{ request('department', '') === '' ? 'selected' : '' }}
                            >
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


        @if(
            request()->has('generate') ||
            (isset($generated) && $generated)
        )

            <div class="generated-section">

                @if(isset($totalEmployees) && $totalEmployees)

                    <div
                        class="alert alert-success mb-4"
                        role="alert"
                    >

                        <i class="bi bi-check-circle me-1"></i>

                        Salary report generated successfully.
                        {{ $totalEmployees }} employee(s) found.

                    </div>

                @else

                    <div
                        class="alert alert-warning mb-4"
                        role="alert"
                    >

                        <i class="bi bi-exclamation-circle me-1"></i>

                        No salary configurations found.

                    </div>

                @endif


                <h2 class="section-title">
                    Generated Reports
                </h2>


                <div class="row g-3">

                    <div class="col-12 col-md-6">

                        <div class="file-card">

                            <div class="file-icon pdf-icon">

                                <i class="bi bi-file-earmark-pdf"></i>

                            </div>


                            <h3 class="file-title">
                                PDF Report
                            </h3>


                            <p class="file-description">
                                Download the salary configuration report as a PDF document.
                            </p>


                            <div class="file-actions">

                                <a
                                    href="{{ route('reports.salary.pdf', request()->except('generate')) }}"
                                    class="btn btn-danger"
                                    id="pdfDownloadBtn"
                                >
                                    <i class="bi bi-download me-1"></i>
                                    Download PDF
                                </a>

                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="file-card">

                            <div class="file-icon excel-icon">

                                <i class="bi bi-file-earmark-excel"></i>

                            </div>


                            <h3 class="file-title">
                                Excel Report
                            </h3>


                            <p class="file-description">
                                Download the salary configuration report as an Excel spreadsheet.
                            </p>


                            <div class="file-actions">

                                <a
                                    href="{{ route('reports.salary.excel', request()->except('generate')) }}"
                                    class="btn btn-success"
                                    id="excelDownloadBtn"
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

                <div class="col-12 col-md-6">

                    <div class="history-card">

                        <div class="history-card-header">

                            <h3 class="history-card-title">
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


                                <tbody id="pdfHistoryTableBody"></tbody>

                            </table>

                        </div>

                    </div>

                </div>


                <div class="col-12 col-md-6">

                    <div class="history-card">

                        <div class="history-card-header">

                            <h3 class="history-card-title">
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


                                <tbody id="excelHistoryTableBody"></tbody>

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

                <div class="generation-icon">

                    <i class="bi bi-check-lg"></i>

                </div>


                <div class="generation-message">

                    Your salary configuration PDF and Excel reports
                    have been generated successfully.

                </div>

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

                    <div class="col-12 col-md">

                        <input
                            type="date"
                            id="pdfHistoryDate"
                            class="form-control"
                        >

                    </div>


                    <div class="col-6 col-md-auto">

                        <button
                            type="button"
                            class="btn btn-primary w-100"
                            id="searchPdfHistory"
                        >
                            Search
                        </button>

                    </div>


                    <div class="col-6 col-md-auto">

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

                    <div class="col-12 col-md">

                        <input
                            type="date"
                            id="excelHistoryDate"
                            class="form-control"
                        >

                    </div>


                    <div class="col-6 col-md-auto">

                        <button
                            type="button"
                            class="btn btn-primary w-100"
                            id="searchExcelHistory"
                        >
                            Search
                        </button>

                    </div>


                    <div class="col-6 col-md-auto">

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

    const REPORTS_PAGE_URL =
        @json(route('reports'));

    const SALARY_REPORT_URL =
        @json(route('reports.salary'));

    const PDF_REPORT_URL =
        @json(route('reports.salary.pdf'));

    const EXCEL_REPORT_URL =
        @json(route('reports.salary.excel'));

    const PDF_HISTORY_KEY =
        'pap_pay_salary_pdf_history';

    const EXCEL_HISTORY_KEY =
        'pap_pay_salary_excel_history';


    function getHistory(key) {

        try {

            const history =
                JSON.parse(
                    localStorage.getItem(key) || '[]'
                );

            return Array.isArray(history)
                ? history
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


    function createRecordKey(
        type,
        selectedDepartment
    ) {

        return [
            type,
            selectedDepartment || 'all-departments'
        ].join('|');

    }


    function getFileName(
        type,
        selectedDepartment
    ) {

        const department =
            selectedDepartment
                ? selectedDepartment
                    .toLowerCase()
                    .replace(/\s+/g, '-')
                : 'all-departments';


        const extension =
            type === 'pdf'
                ? 'pdf'
                : 'xlsx';


        return `salary-report-${department}.${extension}`;

    }


    function addHistory(
        type,
        selectedDepartment,
        url
    ) {

        const key =
            type === 'pdf'
                ? PDF_HISTORY_KEY
                : EXCEL_HISTORY_KEY;


        const history =
            getHistory(key);


        const recordKey =
            createRecordKey(
                type,
                selectedDepartment
            );


        const existingIndex =
            history.findIndex(
                item =>
                    item.recordKey === recordKey
            );


        if (existingIndex !== -1) {

            history.splice(
                existingIndex,
                1
            );

        }


        const now =
            new Date();


        const record = {

            recordKey:
                recordKey,

            filename:
                getFileName(
                    type,
                    selectedDepartment
                ),

            department:
                selectedDepartment || '',

            url:
                url,

            generatedDate:
                now.toISOString()
                    .split('T')[0],

            generatedAt:
                now.toLocaleString()

        };


        history.unshift(record);


        saveHistory(
            key,
            history.slice(0, 100)
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


    function renderMainHistory() {

        const pdfBody =
            document.getElementById(
                'pdfHistoryTableBody'
            );


        const excelBody =
            document.getElementById(
                'excelHistoryTableBody'
            );


        const pdfHistory =
            getHistory(
                PDF_HISTORY_KEY
            );


        const excelHistory =
            getHistory(
                EXCEL_HISTORY_KEY
            );


        if (!pdfHistory.length) {

            pdfBody.innerHTML = `
                <tr>
                    <td colspan="3">
                        <div class="history-empty">
                            No PDF reports generated yet.
                        </div>
                    </td>
                </tr>
            `;

        } else {

            pdfBody.innerHTML =
                pdfHistory
                    .slice(0, 5)
                    .map(record => {

                        return `
                            <tr>

                                <td>
                                    <span class="text-break">
                                        ${escapeHtml(record.filename)}
                                    </span>
                                </td>

                                <td>
                                    ${escapeHtml(record.generatedAt)}
                                </td>

                                <td>

                                    <a
                                        href="${escapeHtml(record.url)}"
                                        class="btn btn-sm btn-outline-danger"
                                        target="_blank"
                                    >
                                        <i class="bi bi-download"></i>
                                    </a>

                                </td>

                            </tr>
                        `;

                    })
                    .join('');

        }


        if (!excelHistory.length) {

            excelBody.innerHTML = `
                <tr>
                    <td colspan="3">
                        <div class="history-empty">
                            No Excel reports generated yet.
                        </div>
                    </td>
                </tr>
            `;

        } else {

            excelBody.innerHTML =
                excelHistory
                    .slice(0, 5)
                    .map(record => {

                        return `
                            <tr>

                                <td>
                                    <span class="text-break">
                                        ${escapeHtml(record.filename)}
                                    </span>
                                </td>

                                <td>
                                    ${escapeHtml(record.generatedAt)}
                                </td>

                                <td>

                                    <a
                                        href="${escapeHtml(record.url)}"
                                        class="btn btn-sm btn-outline-success"
                                        target="_blank"
                                    >
                                        <i class="bi bi-download"></i>
                                    </a>

                                </td>

                            </tr>
                        `;

                    })
                    .join('');

        }

    }


    function renderModalHistory(
        type,
        dateFilter = ''
    ) {

        const key =
            type === 'pdf'
                ? PDF_HISTORY_KEY
                : EXCEL_HISTORY_KEY;


        const container =
            document.getElementById(
                type === 'pdf'
                    ? 'pdfHistoryRecords'
                    : 'excelHistoryRecords'
            );


        let history =
            getHistory(key);


        if (dateFilter) {

            history =
                history.filter(
                    record =>
                        record.generatedDate === dateFilter
                );

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
            history
                .map(record => {

                    const department =
                        record.department ||
                        'All Departments';


                    const buttonClass =
                        type === 'pdf'
                            ? 'btn-outline-danger'
                            : 'btn-outline-success';


                    return `

                        <div class="modal-record">

                            <div class="modal-record-info">

                                <div class="modal-record-name">
                                    ${escapeHtml(record.filename)}
                                </div>

                                <div class="modal-record-details">

                                    Generated:
                                    ${escapeHtml(record.generatedAt)}

                                    <br>

                                    Department:
                                    ${escapeHtml(department)}

                                </div>

                            </div>


                            <div class="modal-record-action">

                                <a
                                    href="${escapeHtml(record.url)}"
                                    class="btn btn-sm ${buttonClass}"
                                    target="_blank"
                                >
                                    <i class="bi bi-download me-1"></i>
                                    Download
                                </a>

                            </div>

                        </div>

                    `;

                })
                .join('');

    }


    function buildReportUrl(
        baseUrl,
        selectedDepartment
    ) {

        const params =
            new URLSearchParams();


        if (selectedDepartment) {

            params.set(
                'department',
                selectedDepartment
            );

        }


        params.set(
            'download',
            '1'
        );


        return baseUrl +
            '?' +
            params.toString();

    }


    function showGeneratedFiles() {

        const params =
            new URLSearchParams(
                window.location.search
            );


        const selectedDepartment =
            params.get('department') || '';


        const pdfUrl =
            buildReportUrl(
                PDF_REPORT_URL,
                selectedDepartment
            );


        const excelUrl =
            buildReportUrl(
                EXCEL_REPORT_URL,
                selectedDepartment
            );


        addHistory(
            'pdf',
            selectedDepartment,
            pdfUrl
        );


        addHistory(
            'excel',
            selectedDepartment,
            excelUrl
        );


        renderMainHistory();

        renderModalHistory('pdf');

        renderModalHistory('excel');


        const modalElement =
            document.getElementById(
                'generationModal'
            );


        if (modalElement) {

            const modal =
                bootstrap.Modal.getOrCreateInstance(
                    modalElement
                );

            modal.show();

        }

    }


    document
        .getElementById('searchPdfHistory')
        .addEventListener(
            'click',
            function () {

                renderModalHistory(
                    'pdf',
                    document.getElementById(
                        'pdfHistoryDate'
                    ).value
                );

            }
        );


    document
        .getElementById('clearPdfHistory')
        .addEventListener(
            'click',
            function () {

                document.getElementById(
                    'pdfHistoryDate'
                ).value = '';

                renderModalHistory(
                    'pdf'
                );

            }
        );


    document
        .getElementById('searchExcelHistory')
        .addEventListener(
            'click',
            function () {

                renderModalHistory(
                    'excel',
                    document.getElementById(
                        'excelHistoryDate'
                    ).value
                );

            }
        );


    document
        .getElementById('clearExcelHistory')
        .addEventListener(
            'click',
            function () {

                document.getElementById(
                    'excelHistoryDate'
                ).value = '';

                renderModalHistory(
                    'excel'
                );

            }
        );


    const navigationEntry =
        performance.getEntriesByType('navigation')[0];


    if (
        navigationEntry &&
        navigationEntry.type === 'reload'
    ) {

        window.location.replace(
            SALARY_REPORT_URL
        );

    }


    history.pushState(
        null,
        '',
        window.location.href
    );


    window.addEventListener(
        'popstate',
        function () {

            window.location.replace(
                REPORTS_PAGE_URL
            );

        }
    );


    renderMainHistory();

    renderModalHistory('pdf');

    renderModalHistory('excel');


    @if(
        request()->has('generate') ||
        (isset($generated) && $generated)
    )

        showGeneratedFiles();

    @endif

</script>

</body>

</html>
