<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Payroll Reports | PAP PAY</title>

<link rel="icon"
      type="image/x-icon"
      href="../../../../khen/assets/images/favicon.png">

<link rel="stylesheet"
      href="../../../../khen/assets/css/bootstrap.min.css">

<link rel="stylesheet"
      href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

<link rel="stylesheet"
      href="../../../../khen/assets/css/style.css">

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
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
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
    box-shadow: 0 0 0 0.15rem rgba(37, 99, 235, 0.12);
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
    background: #ffffff;
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
    background: #ffffff;
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

.alert-success {
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
                Payroll Reports
            </h1>

            <p class="page-subtitle">
                Generate and manage payroll reports.
            </p>

        </div>

        <a href="{{ route('reports') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Back to Reports

        </a>

    </div>


    <div class="filter-section">

        <form method="GET"
              action="{{ route('reports.payroll') }}"
              id="payrollReportForm">

            <div class="row g-3">

                <div class="col-12 col-md-6 col-lg-3">

                    <label for="payrollStart"
                           class="filter-label">

                        Payroll Start

                    </label>

                    <input type="date"
                           name="start"
                           id="payrollStart"
                           class="form-control"
                           value="{{ request('start') }}">

                </div>


                <div class="col-12 col-md-6 col-lg-3">

                    <label for="payrollEnd"
                           class="filter-label">

                        Payroll End

                    </label>

                    <input type="date"
                           name="end"
                           id="payrollEnd"
                           class="form-control"
                           value="{{ request('end') }}">

                </div>


                <div class="col-12 col-md-6 col-lg-3">

                    <label for="department"
                           class="filter-label">

                        Department

                    </label>

                    <select name="department"
                            id="department"
                            class="form-select">

                        <option value="">
                            All Departments
                        </option>

                        <option value="Elementary"
                            {{ request('department') === 'Elementary' ? 'selected' : '' }}>
                            Elementary
                        </option>

                        <option value="JHS"
                            {{ request('department') === 'JHS' ? 'selected' : '' }}>
                            JHS
                        </option>

                        <option value="SHS"
                            {{ request('department') === 'SHS' ? 'selected' : '' }}>
                            SHS
                        </option>

                        <option value="College"
                            {{ request('department') === 'College' ? 'selected' : '' }}>
                            College
                        </option>

                        <option value="Admin"
                            {{ request('department') === 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="Laborers"
                            {{ request('department') === 'Laborers' ? 'selected' : '' }}>
                            Laborers
                        </option>

                    </select>

                </div>


                <div class="col-12 col-md-6 col-lg-3">

                    <label for="status"
                           class="filter-label">

                        Status

                    </label>

                    <select name="status"
                            id="status"
                            class="form-select">

                        <option value="">
                            All Status
                        </option>

                        <option value="Released"
                            {{ request('status') === 'Released' ? 'selected' : '' }}>
                            Released
                        </option>

                        <option value="Pending"
                            {{ request('status') === 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                    </select>

                </div>


                <div class="col-12">

                    <button type="submit"
                            class="btn btn-primary generate-btn">

                        <i class="bi bi-file-earmark-bar-graph me-1"></i>

                        Generate Report

                    </button>

                </div>

            </div>

        </form>

    </div>


    @if(isset($generated) && $generated)

        <div class="generated-section"
             id="generatedFilesSection">

            <div class="alert alert-success mb-4">

                <i class="bi bi-check-circle-fill me-1"></i>

                Payroll report generated successfully.

            </div>


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
                            Download the generated payroll PDF report.
                        </p>

                        <div class="file-actions">

                            <a href="{{ route('reports.payroll.pdf', array_merge(request()->query(), ['download' => 1])) }}"
                               class="btn btn-danger w-100">

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
                            Download the generated payroll Excel report.
                        </p>

                        <div class="file-actions">

                            <a href="{{ route('reports.payroll.excel', array_merge(request()->query(), ['download' => 1])) }}"
                               class="btn btn-success w-100">

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

            <div class="col-12 col-lg-6">

                <div class="history-card">

                    <div class="history-card-header">

                        <h3 class="history-card-title">
                            PDF History
                        </h3>

                        <button type="button"
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#pdfHistoryModal">

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


            <div class="col-12 col-lg-6">

                <div class="history-card">

                    <div class="history-card-header">

                        <h3 class="history-card-title">
                            Excel History
                        </h3>

                        <button type="button"
                                class="btn btn-sm btn-outline-success"
                                data-bs-toggle="modal"
                                data-bs-target="#excelHistoryModal">

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


<div class="modal fade"
     id="generationModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-check-circle text-success me-1"></i>

                    Report Generated

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                Your payroll PDF and Excel reports have been generated successfully.

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-primary"
                        data-bs-dismiss="modal">

                    Done

                </button>

            </div>

        </div>

    </div>

</div>


<div class="modal fade"
     id="pdfHistoryModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-file-earmark-pdf text-danger me-1"></i>

                    PDF Report History

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <div class="date-filter">

                <div class="row g-2 align-items-end">

                    <div class="col-12 col-md">

                        <label for="pdfHistoryDateFilter"
                               class="filter-label">

                            Search by generated date

                        </label>

                        <input type="date"
                               id="pdfHistoryDateFilter"
                               class="form-control">

                    </div>


                    <div class="col-12 col-md-auto">

                        <button type="button"
                                class="btn btn-danger"
                                id="pdfSearchButton">

                            <i class="bi bi-search me-1"></i>

                            Search

                        </button>

                    </div>


                    <div class="col-12 col-md-auto">

                        <button type="button"
                                class="btn btn-outline-secondary"
                                id="pdfClearButton">

                            Clear

                        </button>

                    </div>

                </div>

            </div>


            <div class="modal-records"
                 id="pdfModalRecords"></div>

        </div>

    </div>

</div>


<div class="modal fade"
     id="excelHistoryModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-file-earmark-excel text-success me-1"></i>

                    Excel Report History

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <div class="date-filter">

                <div class="row g-2 align-items-end">

                    <div class="col-12 col-md">

                        <label for="excelHistoryDateFilter"
                               class="filter-label">

                            Search by generated date

                        </label>

                        <input type="date"
                               id="excelHistoryDateFilter"
                               class="form-control">

                    </div>


                    <div class="col-12 col-md-auto">

                        <button type="button"
                                class="btn btn-success"
                                id="excelSearchButton">

                            <i class="bi bi-search me-1"></i>

                            Search

                        </button>

                    </div>


                    <div class="col-12 col-md-auto">

                        <button type="button"
                                class="btn btn-outline-secondary"
                                id="excelClearButton">

                            Clear

                        </button>

                    </div>

                </div>

            </div>


            <div class="modal-records"
                 id="excelModalRecords"></div>

        </div>

    </div>

</div>


<script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const REPORTS_PAGE_URL =
        @json(route('reports'));

    const PAYROLL_REPORT_URL =
        @json(route('reports.payroll'));


    const PDF_HISTORY_KEY =
        'pap_pay_payroll_pdf_history';

    const EXCEL_HISTORY_KEY =
        'pap_pay_payroll_excel_history';


    const payrollStart =
        document.getElementById('payrollStart');

    const payrollEnd =
        document.getElementById('payrollEnd');

    const department =
        document.getElementById('department');

    const status =
        document.getElementById('status');


    const pdfHistoryTableBody =
        document.getElementById('pdfHistoryTableBody');

    const excelHistoryTableBody =
        document.getElementById('excelHistoryTableBody');


    const pdfModalRecords =
        document.getElementById('pdfModalRecords');

    const excelModalRecords =
        document.getElementById('excelModalRecords');


    const pdfDateFilter =
        document.getElementById('pdfHistoryDateFilter');

    const excelDateFilter =
        document.getElementById('excelHistoryDateFilter');


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


    function addHistory(
        type,
        url,
        start,
        end,
        selectedDepartment,
        selectedStatus
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
                start,
                end,
                selectedDepartment,
                selectedStatus
            );


        const alreadyExists =
            history.some(function (record) {

                return record.recordKey === recordKey;

            });


        if (alreadyExists) {

            return;

        }


        const now =
            new Date();


        const record = {

            id: Date.now(),

            recordKey: recordKey,

            fileName:
                getFileName(
                    type,
                    start,
                    end,
                    selectedDepartment
                ),

            start:
                start || '',

            end:
                end || '',

            department:
                selectedDepartment ||
                'All Departments',

            status:
                selectedStatus ||
                'All Status',

            url:
                url,

            generatedDate:
                now.toISOString().split('T')[0],

            generatedAt:
                now.toLocaleString()

        };


        history.unshift(record);


        saveHistory(
            key,
            history
        );

    }


    function getFileName(
        type,
        start,
        end,
        selectedDepartment
    ) {

        const startText =
            start || 'all';

        const endText =
            end || 'all';

        const departmentText =
            selectedDepartment ||
            'all-departments';


        return 'payroll-report-' +
            departmentText
                .toLowerCase()
                .replace(/\s+/g, '-') +
            '-' +
            startText +
            '-to-' +
            endText +
            '.' +
            (
                type === 'pdf'
                    ? 'pdf'
                    : 'xlsx'
            );

    }


    function createDownloadButton(
        record,
        type
    ) {

        const button =
            document.createElement('a');


        button.href =
            record.url;


        button.className =
            type === 'pdf'
                ? 'btn btn-sm btn-danger'
                : 'btn btn-sm btn-success';


        button.innerHTML =
            '<i class="bi bi-download me-1"></i>Download';


        return button;

    }


    function renderHistory() {

        const pdfHistory =
            getHistory(
                PDF_HISTORY_KEY
            );

        const excelHistory =
            getHistory(
                EXCEL_HISTORY_KEY
            );


        renderMainHistory(
            pdfHistory,
            pdfHistoryTableBody,
            'pdf'
        );


        renderMainHistory(
            excelHistory,
            excelHistoryTableBody,
            'excel'
        );


        renderModalRecords(
            pdfHistory,
            pdfModalRecords,
            'pdf'
        );


        renderModalRecords(
            excelHistory,
            excelModalRecords,
            'excel'
        );

    }


    function renderMainHistory(
        history,
        container,
        type
    ) {

        container.innerHTML = '';


        const recentHistory =
            history.slice(0, 5);


        if (
            recentHistory.length === 0
        ) {

            const row =
                document.createElement('tr');


            row.innerHTML =
                '<td colspan="3" class="history-empty">' +
                'No generated reports yet.' +
                '</td>';


            container.appendChild(row);

            return;

        }


        recentHistory.forEach(
            function (record) {

                const row =
                    document.createElement('tr');


                const fileCell =
                    document.createElement('td');


                fileCell.textContent =
                    record.fileName;


                const dateCell =
                    document.createElement('td');


                dateCell.textContent =
                    record.generatedAt;


                const actionCell =
                    document.createElement('td');


                actionCell.appendChild(
                    createDownloadButton(
                        record,
                        type
                    )
                );


                row.appendChild(
                    fileCell
                );

                row.appendChild(
                    dateCell
                );

                row.appendChild(
                    actionCell
                );


                container.appendChild(
                    row
                );

            }
        );

    }


    function renderModalRecords(
        history,
        container,
        type,
        dateFilter
    ) {

        container.innerHTML = '';


        let filteredHistory =
            history.slice();


        if (dateFilter) {

            filteredHistory =
                filteredHistory.filter(
                    function (record) {

                        return (
                            record.generatedDate ===
                            dateFilter
                        );

                    }
                );

        }


        if (
            filteredHistory.length === 0
        ) {

            const empty =
                document.createElement('div');


            empty.className =
                'history-empty';


            empty.textContent =
                dateFilter
                    ? 'No reports were generated on the selected date.'
                    : 'No generated reports yet.';


            container.appendChild(
                empty
            );

            return;

        }


        filteredHistory.forEach(
            function (record) {

                const wrapper =
                    document.createElement('div');


                wrapper.className =
                    'modal-record';


                const info =
                    document.createElement('div');


                info.className =
                    'modal-record-info';


                const name =
                    document.createElement('div');


                name.className =
                    'modal-record-name';


                name.textContent =
                    record.fileName;


                const details =
                    document.createElement('div');


                details.className =
                    'modal-record-details';


                details.textContent =
                    'Generated: ' +
                    record.generatedAt +
                    ' | Payroll: ' +
                    (
                        record.start ||
                        'All'
                    ) +
                    ' to ' +
                    (
                        record.end ||
                        'All'
                    ) +
                    ' | ' +
                    record.department;


                info.appendChild(
                    name
                );

                info.appendChild(
                    details
                );


                const action =
                    document.createElement('div');


                action.className =
                    'modal-record-action';


                action.appendChild(
                    createDownloadButton(
                        record,
                        type
                    )
                );


                wrapper.appendChild(
                    info
                );

                wrapper.appendChild(
                    action
                );


                container.appendChild(
                    wrapper
                );

            }
        );

    }


    function showGeneratedFiles() {

        const pdfUrl =
            @json(
                route(
                    'reports.payroll.pdf',
                    request()->query()
                )
            );


        const excelUrl =
            @json(
                route(
                    'reports.payroll.excel',
                    request()->query()
                )
            );


        const start =
            @json(request('start'));


        const end =
            @json(request('end'));


        const selectedDepartment =
            @json(request('department'));


        const selectedStatus =
            @json(request('status'));


        addHistory(
            'pdf',
            pdfUrl,
            start,
            end,
            selectedDepartment,
            selectedStatus
        );


        addHistory(
            'excel',
            excelUrl,
            start,
            end,
            selectedDepartment,
            selectedStatus
        );


        renderHistory();


        const generationModal =
            document.getElementById(
                'generationModal'
            );


        if (generationModal) {

            const modal =
                new bootstrap.Modal(
                    generationModal
                );


            modal.show();

        }

    }


    document.getElementById(
        'pdfSearchButton'
    ).addEventListener(
        'click',
        function () {

            const history =
                getHistory(
                    PDF_HISTORY_KEY
                );


            renderModalRecords(
                history,
                pdfModalRecords,
                'pdf',
                pdfDateFilter.value
            );

        }
    );


    document.getElementById(
        'pdfClearButton'
    ).addEventListener(
        'click',
        function () {

            pdfDateFilter.value = '';


            const history =
                getHistory(
                    PDF_HISTORY_KEY
                );


            renderModalRecords(
                history,
                pdfModalRecords,
                'pdf'
            );

        }
    );


    document.getElementById(
        'excelSearchButton'
    ).addEventListener(
        'click',
        function () {

            const history =
                getHistory(
                    EXCEL_HISTORY_KEY
                );


            renderModalRecords(
                history,
                excelModalRecords,
                'excel',
                excelDateFilter.value
            );

        }
    );


    document.getElementById(
        'excelClearButton'
    ).addEventListener(
        'click',
        function () {

            excelDateFilter.value = '';


            const history =
                getHistory(
                    EXCEL_HISTORY_KEY
                );


            renderModalRecords(
                history,
                excelModalRecords,
                'excel'
            );

        }
    );


    document.getElementById(
        'payrollReportForm'
    ).addEventListener(
        'submit',
        function (event) {

            if (
                payrollStart.value &&
                payrollEnd.value &&
                payrollStart.value >
                payrollEnd.value
            ) {

                event.preventDefault();


                alert(
                    'Payroll Start cannot be later than Payroll End.'
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Browser Refresh Protection
    |--------------------------------------------------------------------------
    |
    | When the Payroll Reports page is refreshed, immediately remove the
    | generated query parameters and return to the clean Payroll Reports page.
    |
    | This prevents the previous payroll report from being generated/displayed
    | again simply because the browser refreshed the page.
    |
    */

    const navigationEntries =
        performance.getEntriesByType(
            'navigation'
        );


    const isReload =
        navigationEntries.length > 0
            ? navigationEntries[0].type === 'reload'
            : (
                performance.navigation &&
                performance.navigation.type === 1
            );


    if (isReload) {

        window.location.replace(
            PAYROLL_REPORT_URL
        );

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | Browser Back Button
    |--------------------------------------------------------------------------
    |
    | If the browser Back button is pressed while inside the Payroll Reports
    | page, immediately redirect to the main Reports page.
    |
    */

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


    renderHistory();


    @if(isset($generated) && $generated)

        showGeneratedFiles();

    @endif

});

</script>

</body>

</html>
