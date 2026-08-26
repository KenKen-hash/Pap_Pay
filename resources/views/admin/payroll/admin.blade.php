<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Administrative Salary Configuration | PAP PAY</title>

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins, sans-serif;
        }

        body {
            background: #e9faf4;
            min-height: 100vh;
        }

        .background {
            position: fixed;
            inset: 0;

            background:
                radial-gradient(
                    circle at top left,
                    #6ee7b755,
                    transparent 35%
                ),
                radial-gradient(
                    circle at bottom right,
                    #34d39955,
                    transparent 35%
                ),
                #e9faf4;

            z-index: -1;
        }

        .wrapper {
            max-width: 1450px;
            margin: auto;
            padding: 45px;
        }

        .glass {
            background: rgba(255, 255, 255, .78);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
        }

        .page-title {
            font-size: 34px;
            font-weight: 700;
            color: #047857;
        }

        .page-subtitle {
            margin-top: 8px;
            margin-bottom: 35px;
            color: #6b7280;
        }

        .section {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .06);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 23px;
            font-weight: 700;
            color: #059669;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .form-control,
        .form-select {
            height: 50px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 .2rem rgba(16, 185, 129, .12);
        }

        .input-group-text {
            background: #d1fae5;
            font-weight: 700;
            border-radius: 12px 0 0 12px;
        }

        .save-btn {
            background: #10b981;
            color: white;
            padding: 13px 35px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
        }

        .save-btn:hover {
            background: #059669;
            color: white;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: #10b981;
            color: white;
        }

        .table th {
            padding: 18px;
            font-weight: 600;
            white-space: nowrap;
        }

        .table td {
            padding: 16px;
            vertical-align: middle;
        }

        .employee-photo {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .configure-btn {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 18px;
        }

        .configure-btn:hover {
            background: #059669;
            color: white;
        }

        .badge-regular {
            background: #059669;
        }

        .badge-contractual {
            background: #f59e0b;
        }

        .badge-parttime {
            background: #3b82f6;
        }

        .teaching-box {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 15px;
            padding: 20px;
        }

        .teaching-result {
            background: white;
            border-radius: 12px;
            padding: 15px;
            border: 1px solid #d1fae5;
        }

        .small-note {
            font-size: 12px;
            color: #6b7280;
        }

        .summary-value {
            font-size: 20px;
            font-weight: 700;
            color: #047857;
        }

        .modal-header {
            background: #059669;
        }

        .modal-content {
            border-radius: 18px;
            overflow: hidden;
        }

        .card {
            border-radius: 15px;
        }

        .card-header {
            background: #f0fdf4;
            border-bottom: 1px solid #d1fae5;
        }

        @media (max-width: 991px) {

            .wrapper {
                padding: 20px;
            }

            .glass {
                padding: 20px;
            }

            .page-title {
                font-size: 27px;
            }

        }

        @media (max-width: 767px) {

            .wrapper {
                padding: 10px;
            }

            .glass {
                padding: 15px;
                border-radius: 15px;
            }

            .page-title {
                font-size: 23px;
            }

            .page-subtitle {
                font-size: 13px;
            }

            .section {
                padding: 18px;
            }

            .header-actions {
                flex-direction: column;
                gap: 15px;
            }

            .header-actions a {
                width: 100%;
            }

        }

    </style>

</head>


<body>

<div class="background"></div>


<div class="wrapper">

    <div class="glass">


        <!-- ========================================================= -->
        <!-- PAGE HEADER -->
        <!-- ========================================================= -->

        <div class="d-flex justify-content-between align-items-start mb-4 header-actions">

            <div>

                <h1 class="page-title">

                    <i class="bi bi-bank2 me-2"></i>

                    Admin Salary Configuration

                </h1>

                <p class="page-subtitle">

                    Configure the default payroll settings for all Admin employees.
                    Individual employees can also have their own salary configuration.

                </p>

            </div>


            <a
                href="{{ route('payroll') }}"
                class="btn btn-outline-success px-4 py-2"
            >

                <i class="bi bi-arrow-left-circle me-2"></i>

                Back to Payroll

            </a>

        </div>


        <!-- ========================================================= -->
        <!-- DEFAULT CONFIGURATION -->
        <!-- ========================================================= -->

        <div class="section">

            <div class="section-title">

                <i class="bi bi-sliders"></i>

                Default Salary Configuration

            </div>


            <form id="departmentConfigForm">

                <input
                    type="hidden"
                    id="department"
                    value="{{ $department }}"
                >


                <!-- BASIC SALARY / PAYROLL PERIOD -->

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Default Basic Salary
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₱
                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="default_basic_salary"
                                class="form-control"
                                placeholder="22000"
                                value="{{ old('default_basic_salary', optional($departmentConfig)->default_basic_salary ?? 0) }}"
                            >

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Payroll Period
                        </label>

                        <select
                            id="payroll_period"
                            class="form-select"
                        >

                            <option
                                value="Every 15 Days"
                                {{ optional($departmentConfig)->payroll_period == 'Every 15 Days' ? 'selected' : '' }}
                            >
                                Every 15 Days
                            </option>

                            <option
                                value="Monthly"
                                {{ optional($departmentConfig)->payroll_period == 'Monthly' ? 'selected' : '' }}
                            >
                                Monthly
                            </option>

                            <option
                                value="Weekly"
                                {{ optional($departmentConfig)->payroll_period == 'Weekly' ? 'selected' : '' }}
                            >
                                Weekly
                            </option>

                        </select>

                        <div class="small-note mt-2">

                            Your current payroll calculation is designed around
                            a 15-day cycle.

                        </div>

                    </div>

                </div>


                <!-- DAILY / OVERTIME -->

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
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
                                id="default_daily_rate"
                                class="form-control"
                                placeholder="540"
                                value="{{ old('daily_rate', optional($departmentConfig)->daily_rate ?? 0) }}"
                            >

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <label class="form-label">

                            Overtime Rate

                            <span class="text-muted">
                                (Per Hour)
                            </span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₱
                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="default_overtime_rate"
                                class="form-control"
                                placeholder="120"
                                value="{{ old('overtime_rate', optional($departmentConfig)->overtime_rate ?? 0) }}"
                            >

                        </div>

                    </div>

                </div>


                <!-- LATE / UNDERTIME -->

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">

                            Late Deduction Rate

                            <span class="text-muted">
                                (Per Minute)
                            </span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₱
                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="late_deduction_rate"
                                class="form-control"
                                placeholder="2"
                                value="{{ old('late_deduction_rate', optional($departmentConfig)->late_deduction_rate ?? 0) }}"
                            >

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <label class="form-label">

                            Undertime Deduction Rate

                            <span class="text-muted">
                                (Per Minute)
                            </span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₱
                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="undertime_deduction_rate"
                                class="form-control"
                                placeholder="2"
                                value="{{ old('undertime_deduction_rate', optional($departmentConfig)->undertime_deduction_rate ?? 0) }}"
                            >

                        </div>

                    </div>

                </div>


                <hr class="my-4">


                <!-- BENEFITS -->

                <h5 class="mb-4">

                    <i class="bi bi-shield-check text-success me-2"></i>

                    Monthly Benefits / Contributions

                </h5>


                <div class="row">

                    <div class="col-lg-3 col-md-6 mb-3">

                        <label class="form-label">
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
                                id="sss"
                                class="form-control"
                                value="{{ old('sss', optional($departmentConfig)->sss ?? 0) }}"
                            >

                        </div>

                    </div>


                    <div class="col-lg-3 col-md-6 mb-3">

                        <label class="form-label">
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
                                id="philhealth"
                                class="form-control"
                                value="{{ old('philhealth', optional($departmentConfig)->philhealth ?? 0) }}"
                            >

                        </div>

                    </div>


                    <div class="col-lg-3 col-md-6 mb-3">

                        <label class="form-label">
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
                                id="pagibig"
                                class="form-control"
                                value="{{ old('pagibig', optional($departmentConfig)->pagibig ?? 0) }}"
                            >

                        </div>

                    </div>


                    <div class="col-lg-3 col-md-6 mb-3">

                        <label class="form-label">
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
                                id="hmo"
                                class="form-control"
                                value="{{ old('hmo', optional($departmentConfig)->hmo ?? 0) }}"
                            >

                        </div>

                    </div>

                </div>


                <!-- ===================================================== -->
                <!-- FIXED: DEPARTMENT DEFAULT HONORARIUM -->
                <!-- ===================================================== -->

                <div class="row mt-3">

                    <div class="col-md-6">

                        <label class="form-label">

                            Honorarium / Stipend

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₱
                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="default_honorarium"
                                class="form-control"
                                value="{{ old('honorarium', optional($departmentConfig)->honorarium ?? 0) }}"
                            >

                        </div>

                    </div>

                </div>


                <hr class="my-4">


                <!-- ===================================================== -->
                <!-- TEACHING LOAD CONFIGURATION -->
                <!-- ===================================================== -->

                <div class="teaching-box">

                    <div class="d-flex align-items-center mb-3">

                        <i class="bi bi-book-half fs-3 text-success me-3"></i>

                        <div>

                            <h5 class="mb-1">
                                Teaching Load Configuration
                            </h5>

                            <div class="small-note">
                                Set the number of units covered by the teaching-load price.
                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Teaching Load Unit Required
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-123"></i>
                                </span>

                                <input
                                    type="number"
                                    min="0"
                                    step="1"
                                    id="teaching_load_unit_required"
                                    class="form-control"
                                    placeholder="3"
                                    value="{{ old('teaching_load_unit_required', optional($departmentConfig)->teaching_load_unit_required ?? 0) }}"
                                >

                            </div>

                            <div class="small-note mt-2">
                                Example: 3 units
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Teaching Load Price
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    id="teaching_load_price"
                                    class="form-control"
                                    placeholder="1000"
                                    value="{{ old('teaching_load_price', optional($departmentConfig)->teaching_load_price ?? 0) }}"
                                >

                            </div>

                            <div class="small-note mt-2">
                                Price for the required number of units.
                            </div>

                        </div>

                    </div>


                    <div class="alert alert-success mb-0 mt-2">

                        <i class="bi bi-info-circle me-2"></i>

                        <strong>Example:</strong>

                        If required units = 3 and price = ₱1,000:

                        <br>

                        6 additional units =

                        <strong>
                            (6 ÷ 3) × ₱1,000 = ₱2,000
                        </strong>

                        full-period amount.

                        <br>

                        For a 15-day payroll:

                        <strong>
                            ₱2,000 ÷ 2 = ₱1,000
                        </strong>

                    </div>

                </div>


                <!-- SAVE -->

                <div class="text-end mt-4">

                    <button
                        type="button"
                        id="saveDepartmentConfig"
                        class="save-btn"
                    >

                        <i class="bi bi-check-circle me-2"></i>

                        Save Default Configuration

                    </button>

                </div>

            </form>

        </div>


        <!-- ========================================================= -->
        <!-- EMPLOYEE LIST -->
        <!-- ========================================================= -->

        <div class="section">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

                <h3 class="section-title mb-0">

                    <i class="bi bi-people-fill"></i>

                    Admin Employees

                </h3>


                <input
                    type="text"
                    id="employeeSearch"
                    class="form-control"
                    placeholder="Search employee..."
                    style="max-width:300px;"
                >

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>
                                Employee
                            </th>

                            <th>
                                Employment Type
                            </th>

                            <th>
                                Basic Salary
                            </th>

                            <th>
                                Additional Units
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody id="employeeTableBody">

                        @forelse ($employees as $employee)

                            @php

                                $salaryConfig =
                                    $employee->salaryConfig;

                                $defaultBasic =
                                    optional($departmentConfig)->default_basic_salary ?? 0;

                                $basicSalary =
                                    $salaryConfig?->basic_salary
                                    ?? $defaultBasic;

                                $additionalUnits =
                                    $salaryConfig?->teaching_load_units_taken
                                    ?? 0;

                            @endphp


                            <tr class="employee-row">


                                <!-- EMPLOYEE -->

                                <td>

                                    <div class="d-flex align-items-center">

                                        <img
                                            class="employee-photo"
                                            src="{{ $employee->photo
                                                ? asset('storage/' . $employee->photo)
                                                : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                            alt="Employee"
                                        >

                                        <div>

                                            <strong>

                                                {{ $employee->first_name }}

                                                {{ $employee->last_name }}

                                            </strong>

                                            <br>

                                            <small class="text-muted">

                                                {{ $employee->employee_id }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <!-- EMPLOYMENT -->

                                <td>

                                    @if ($employee->employment_type === 'Regular')

                                        <span class="badge badge-regular">
                                            Regular
                                        </span>

                                    @elseif ($employee->employment_type === 'Contractual')

                                        <span class="badge badge-contractual">
                                            Contractual
                                        </span>

                                    @else

                                        <span class="badge badge-parttime">
                                            Part-Time
                                        </span>

                                    @endif

                                </td>


                                <!-- BASIC SALARY -->

                                <td>

                                    ₱{{ number_format($basicSalary, 2) }}

                                </td>


                                <!-- TEACHING UNITS -->

                                <td>

                                    @if ($additionalUnits > 0)

                                        <span class="badge bg-success">

                                            {{ $additionalUnits }}

                                            {{ $additionalUnits == 1 ? 'Unit' : 'Units' }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            0 Units
                                        </span>

                                    @endif

                                </td>


                                <!-- STATUS -->

                                <td>

                                    @if ($salaryConfig)

                                        <span class="badge bg-success">
                                            Individual Configured
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Using Department Default
                                        </span>

                                    @endif

                                </td>


                                <!-- ACTION -->

                                <td>

                                    <button
                                        type="button"
                                        class="btn configure-btn configureEmployee"

                                        data-id="{{ $employee->id }}"

                                        data-name="{{ $employee->first_name }} {{ $employee->last_name }}"

                                        data-employment="{{ $employee->employment_type }}"

                                        data-photo="{{ $employee->photo
                                            ? asset('storage/' . $employee->photo)
                                            : asset('khen/assets/images/avatar/avatar.jpg') }}"

                                        data-salary="{{ $salaryConfig?->basic_salary ?? $defaultBasic }}"

                                        data-daily="{{ $salaryConfig?->daily_rate ?? optional($departmentConfig)->daily_rate ?? 0 }}"

                                        data-overtime="{{ $salaryConfig?->overtime_rate ?? optional($departmentConfig)->overtime_rate ?? 0 }}"

                                        data-late="{{ $salaryConfig?->late_deduction_rate ?? optional($departmentConfig)->late_deduction_rate ?? 0 }}"

                                        data-undertime="{{ $salaryConfig?->undertime_deduction_rate ?? optional($departmentConfig)->undertime_deduction_rate ?? 0 }}"

                                        data-payroll="{{ $salaryConfig?->payroll_period ?? optional($departmentConfig)->payroll_period ?? 'Every 15 Days' }}"

                                        data-sss="{{ $salaryConfig?->sss ?? optional($departmentConfig)->sss ?? 0 }}"

                                        data-philhealth="{{ $salaryConfig?->philhealth ?? optional($departmentConfig)->philhealth ?? 0 }}"

                                        data-pagibig="{{ $salaryConfig?->pagibig ?? optional($departmentConfig)->pagibig ?? 0 }}"

                                        data-hmo="{{ $employee->employment_type === 'Regular'
                                            ? ($salaryConfig?->hmo ?? optional($departmentConfig)->hmo ?? 0)
                                            : 0 }}"

                                        data-honorarium="{{ $salaryConfig?->honorarium ?? optional($departmentConfig)->honorarium ?? 0 }}"

                                        data-teaching-units="{{ $salaryConfig?->teaching_load_units_taken ?? 0 }}"
                                    >

                                        <i class="bi bi-pencil-square me-1"></i>

                                        Configure

                                    </button>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5 text-muted"
                                >

                                    <i class="bi bi-people fs-1 d-block mb-2"></i>

                                    No Admin employees found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


    </div>

</div>



<!-- =============================================================== -->
<!-- EMPLOYEE SALARY CONFIGURATION MODAL -->
<!-- =============================================================== -->

<div
    class="modal fade"
    id="employeeSalaryModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 shadow-lg">


            <!-- HEADER -->

            <div class="modal-header text-white">

                <h4 class="modal-title">

                    <i class="bi bi-person-badge me-2"></i>

                    Employee Salary Configuration

                </h4>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">


                <input
                    type="hidden"
                    id="employee_id"
                >


                <!-- EMPLOYEE INFORMATION -->

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">

                        <div class="row align-items-center">

                            <div class="col-md-2 text-center mb-3 mb-md-0">

                                <img
                                    id="modalPhoto"
                                    src="{{ asset('khen/assets/images/avatar/avatar.jpg') }}"
                                    class="rounded-circle"
                                    style="
                                        width:90px;
                                        height:90px;
                                        object-fit:cover;
                                    "
                                >

                            </div>


                            <div class="col-md-10">

                                <h3
                                    id="modalName"
                                    class="mb-2"
                                ></h3>


                                <span
                                    class="badge bg-success"
                                    id="modalEmployment"
                                ></span>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- BASIC SALARY -->

                <div class="card shadow-sm mb-4">

                    <div class="card-header">

                        <strong>

                            <i class="bi bi-wallet2 me-2"></i>

                            Basic Salary & Rates

                        </strong>

                    </div>


                    <div class="card-body">

                        <div class="row">


                            <!-- BASIC -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Basic Salary
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₱
                                    </span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="basic_salary"
                                        class="form-control"
                                    >

                                </div>

                            </div>


                            <!-- DAILY -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
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
                                        id="daily_rate"
                                        class="form-control"
                                    >

                                </div>

                            </div>


                            <!-- OVERTIME -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Overtime Rate

                                    <span class="text-muted">
                                        (Per Hour)
                                    </span>

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₱
                                    </span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="overtime_rate"
                                        class="form-control"
                                    >

                                </div>

                            </div>


                            <!-- LATE -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Late Deduction

                                    <span class="text-muted">
                                        (Per Minute)
                                    </span>

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₱
                                    </span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="employee_late_deduction_rate"
                                        class="form-control"
                                    >

                                </div>

                            </div>


                            <!-- UNDERTIME -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Undertime Deduction

                                    <span class="text-muted">
                                        (Per Minute)
                                    </span>

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₱
                                    </span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="employee_undertime_deduction_rate"
                                        class="form-control"
                                    >

                                </div>

                            </div>


                        </div>

                    </div>

                </div>



                <!-- PAYROLL / BENEFITS -->

                <div class="card shadow-sm mb-4">

                    <div class="card-header">

                        <strong>

                            <i class="bi bi-shield-check me-2"></i>

                            Payroll & Benefits

                        </strong>

                    </div>


                    <div class="card-body">

                        <div class="row">


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Payroll Period
                                </label>

                                <input
                                    id="employee_payroll_period"
                                    class="form-control"
                                    readonly
                                >

                            </div>


                            <div class="col-md-2 mb-3">

                                <label class="form-label">
                                    SSS
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    id="employee_sss"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-2 mb-3">

                                <label class="form-label">
                                    PhilHealth
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    id="employee_philhealth"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-2 mb-3">

                                <label class="form-label">
                                    Pag-IBIG
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    id="employee_pagibig"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-2 mb-3">

                                <label class="form-label">
                                    HMO
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    id="employee_hmo"
                                    class="form-control"
                                >

                            </div>


                        </div>

                    </div>

                </div>



                <!-- ADDITIONAL EARNINGS -->

                <div class="card shadow-sm mb-4">

                    <div class="card-header">

                        <strong>

                            <i class="bi bi-plus-circle me-2"></i>

                            Additional Earnings

                        </strong>

                    </div>


                    <div class="card-body">

                        <div class="row">


                            <!-- ================================================= -->
                            <!-- FIXED: INDIVIDUAL EMPLOYEE HONORARIUM -->
                            <!-- ================================================= -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Honorarium / Stipend
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₱
                                    </span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="employee_honorarium"
                                        class="form-control"
                                    >

                                </div>

                            </div>


                            <!-- OT EXPLANATION -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Overtime Calculation
                                </label>

                                <div class="alert alert-info mb-0">

                                    <i class="bi bi-info-circle me-1"></i>

                                    Overtime pay is automatically calculated from
                                    attendance overtime minutes using the
                                    overtime hourly rate.

                                </div>

                            </div>


                        </div>

                    </div>

                </div>



                <!-- ================================================= -->
                <!-- TEACHING LOAD -->
                <!-- ================================================= -->

                <div class="card shadow-sm mb-4">

                    <div class="card-header">

                        <strong>

                            <i class="bi bi-book-half me-2"></i>

                            Additional Teaching Load

                        </strong>

                    </div>


                    <div class="card-body">

                        <div class="row">


                            <!-- EMPLOYEE UNITS -->

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Employee Additional Units
                                </label>

                                <input
                                    type="number"
                                    min="0"
                                    step="1"
                                    id="teaching_load_units_taken"
                                    class="form-control"
                                >

                                <div class="small-note mt-2">

                                    Whole numbers only.

                                    <br>

                                    Example: 3, 6, 9

                                </div>

                            </div>


                            <!-- REQUIRED -->

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Required Units
                                </label>

                                <input
                                    type="number"
                                    id="display_teaching_required"
                                    class="form-control"
                                    value="{{ optional($departmentConfig)->teaching_load_unit_required ?? 0 }}"
                                    readonly
                                >

                            </div>


                            <!-- PRICE -->

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Price
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₱
                                    </span>

                                    <input
                                        type="number"
                                        id="display_teaching_price"
                                        class="form-control"
                                        value="{{ optional($departmentConfig)->teaching_load_price ?? 0 }}"
                                        readonly
                                    >

                                </div>

                            </div>

                        </div>


                        <!-- TEACHING LOAD CALCULATION -->

                        <div class="teaching-result mt-3">

                            <div class="row text-center">


                                <div class="col-md-4 mb-3 mb-md-0">

                                    <div class="small-note">
                                        Full-Period Teaching Load
                                    </div>

                                    <div
                                        class="summary-value"
                                        id="fullTeachingLoadDisplay"
                                    >
                                        ₱0.00
                                    </div>

                                </div>


                                <div class="col-md-4 mb-3 mb-md-0">

                                    <div class="small-note">
                                        15-Day Teaching Load
                                    </div>

                                    <div
                                        class="summary-value"
                                        id="halfTeachingLoadDisplay"
                                    >
                                        ₱0.00
                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <div class="small-note">
                                        Formula
                                    </div>

                                    <div
                                        class="fw-semibold"
                                        id="teachingFormulaDisplay"
                                    >
                                        0 ÷ 0 × ₱0 ÷ 2
                                    </div>

                                </div>


                            </div>

                        </div>


                        <div class="alert alert-success mt-3 mb-0">

                            <i class="bi bi-calculator me-2"></i>

                            The system automatically calculates:

                            <strong>
                                Employee Units ÷ Required Units × Price ÷ 2
                            </strong>

                            for each 15-day payroll.

                        </div>

                    </div>

                </div>


            </div>


            <!-- FOOTER -->

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Cancel
                </button>


                <button
                    type="button"
                    class="btn btn-success"
                    id="saveEmployeeSalary"
                >

                    <i class="bi bi-check-circle me-2"></i>

                    Save Configuration

                </button>

            </div>


        </div>

    </div>

</div>



<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


<script>

document.addEventListener(
    "DOMContentLoaded",
    function () {


        /*
        |--------------------------------------------------------------------------
        | Bootstrap Modal
        |--------------------------------------------------------------------------
        */

        const modalElement =
            document.getElementById(
                "employeeSalaryModal"
            );

        const employeeModal =
            new bootstrap.Modal(
                modalElement
            );


        /*
        |--------------------------------------------------------------------------
        | Department Teaching Load Values
        |--------------------------------------------------------------------------
        */

        const departmentRequiredUnits =
            Number(
                document.getElementById(
                    "display_teaching_required"
                ).value || 0
            );


        const departmentTeachingPrice =
            Number(
                document.getElementById(
                    "display_teaching_price"
                ).value || 0
            );


        /*
        |--------------------------------------------------------------------------
        | Teaching Load Preview
        |--------------------------------------------------------------------------
        */

        function updateTeachingLoadPreview() {

            const units =
                Number(
                    document.getElementById(
                        "teaching_load_units_taken"
                    ).value || 0
                );


            const required =
                departmentRequiredUnits;


            const price =
                departmentTeachingPrice;


            let fullAmount = 0;


            if (
                units > 0 &&
                required > 0 &&
                price > 0
            ) {

                fullAmount =
                    (
                        units /
                        required
                    ) *
                    price;

            }


            const fifteenDayAmount =
                fullAmount / 2;


            document.getElementById(
                "fullTeachingLoadDisplay"
            ).textContent =
                "₱" +
                fullAmount.toLocaleString(
                    "en-PH",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                );


            document.getElementById(
                "halfTeachingLoadDisplay"
            ).textContent =
                "₱" +
                fifteenDayAmount.toLocaleString(
                    "en-PH",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                );


            document.getElementById(
                "teachingFormulaDisplay"
            ).textContent =
                units +
                " ÷ " +
                required +
                " × ₱" +
                price.toLocaleString(
                    "en-PH",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                ) +
                " ÷ 2";

        }


        document
            .getElementById(
                "teaching_load_units_taken"
            )
            .addEventListener(
                "input",
                updateTeachingLoadPreview
            );



        /*
        |--------------------------------------------------------------------------
        | Configure Employee Buttons
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                ".configureEmployee"
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        "click",
                        function () {


                            /*
                             * Employee ID
                             */

                            document.getElementById(
                                "employee_id"
                            ).value =
                                this.dataset.id;


                            /*
                             * Employee Information
                             */

                            document.getElementById(
                                "modalName"
                            ).textContent =
                                this.dataset.name;


                            document.getElementById(
                                "modalEmployment"
                            ).textContent =
                                this.dataset.employment;


                            document.getElementById(
                                "modalPhoto"
                            ).src =
                                this.dataset.photo;



                            /*
                             * Salary
                             */

                            document.getElementById(
                                "basic_salary"
                            ).value =
                                this.dataset.salary || 0;


                            document.getElementById(
                                "daily_rate"
                            ).value =
                                this.dataset.daily || 0;


                            document.getElementById(
                                "overtime_rate"
                            ).value =
                                this.dataset.overtime || 0;



                            /*
                             * Deductions
                             */

                            document.getElementById(
                                "employee_late_deduction_rate"
                            ).value =
                                this.dataset.late || 0;


                            document.getElementById(
                                "employee_undertime_deduction_rate"
                            ).value =
                                this.dataset.undertime || 0;



                            /*
                             * Payroll
                             */

                            document.getElementById(
                                "employee_payroll_period"
                            ).value =
                                this.dataset.payroll ||
                                "Every 15 Days";



                            /*
                             * Benefits
                             */

                            document.getElementById(
                                "employee_sss"
                            ).value =
                                this.dataset.sss || 0;


                            document.getElementById(
                                "employee_philhealth"
                            ).value =
                                this.dataset.philhealth || 0;


                            document.getElementById(
                                "employee_pagibig"
                            ).value =
                                this.dataset.pagibig || 0;


                            document.getElementById(
                                "employee_hmo"
                            ).value =
                                this.dataset.hmo || 0;



                            /*
                             * ==================================================
                             * FIXED: INDIVIDUAL HONORARIUM
                             * ==================================================
                             *
                             * This now targets employee_honorarium,
                             * NOT the department default honorarium.
                             */

                            document.getElementById(
                                "employee_honorarium"
                            ).value =
                                this.dataset.honorarium || 0;



                            /*
                             * Teaching Units
                             */

                            document.getElementById(
                                "teaching_load_units_taken"
                            ).value =
                                this.dataset.teachingUnits || 0;


                            /*
                             * Update teaching load calculation.
                             */

                            updateTeachingLoadPreview();


                            /*
                             * Open modal.
                             */

                            employeeModal.show();

                        }

                    );

                }
            );



        /*
        |--------------------------------------------------------------------------
        | Save Employee Configuration
        |--------------------------------------------------------------------------
        */

        document
            .getElementById(
                "saveEmployeeSalary"
            )
            .addEventListener(
                "click",
                async function () {


                    const button =
                        this;


                    button.disabled =
                        true;


                    button.innerHTML =
                        `
                        <span
                            class="spinner-border spinner-border-sm me-2"
                        ></span>
                        Saving...
                        `;


                    try {


                        const response =
                            await fetch(
                                "{{ route('payroll.save') }}",
                                {

                                    method:
                                        "POST",

                                    headers:
                                        {

                                            "Content-Type":
                                                "application/json",

                                            "X-CSRF-TOKEN":
                                                document
                                                    .querySelector(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                    .content,

                                            "Accept":
                                                "application/json"

                                        },


                                    body:
                                        JSON.stringify(
                                            {

                                                user_id:
                                                    document
                                                        .getElementById(
                                                            "employee_id"
                                                        )
                                                        .value,


                                                basic_salary:
                                                    document
                                                        .getElementById(
                                                            "basic_salary"
                                                        )
                                                        .value,


                                                payroll_period:
                                                    document
                                                        .getElementById(
                                                            "employee_payroll_period"
                                                        )
                                                        .value,


                                                daily_rate:
                                                    document
                                                        .getElementById(
                                                            "daily_rate"
                                                        )
                                                        .value,


                                                overtime_rate:
                                                    document
                                                        .getElementById(
                                                            "overtime_rate"
                                                        )
                                                        .value,


                                                late_deduction_rate:
                                                    document
                                                        .getElementById(
                                                            "employee_late_deduction_rate"
                                                        )
                                                        .value,


                                                undertime_deduction_rate:
                                                    document
                                                        .getElementById(
                                                            "employee_undertime_deduction_rate"
                                                        )
                                                        .value,


                                                sss:
                                                    document
                                                        .getElementById(
                                                            "employee_sss"
                                                        )
                                                        .value,


                                                philhealth:
                                                    document
                                                        .getElementById(
                                                            "employee_philhealth"
                                                        )
                                                        .value,


                                                pagibig:
                                                    document
                                                        .getElementById(
                                                            "employee_pagibig"
                                                        )
                                                        .value,


                                                hmo:
                                                    document
                                                        .getElementById(
                                                            "employee_hmo"
                                                        )
                                                        .value,


                                                /*
                                                |--------------------------------------------------------------------------
                                                | FIXED HONORARIUM
                                                |--------------------------------------------------------------------------
                                                |
                                                | The HTML field is now employee_honorarium,
                                                | but the JSON key remains "honorarium"
                                                | because that is what PayrollController::save()
                                                | expects.
                                                |
                                                */

                                                honorarium:
                                                    document
                                                        .getElementById(
                                                            "employee_honorarium"
                                                        )
                                                        .value,


                                                teaching_load_units_taken:
                                                    document
                                                        .getElementById(
                                                            "teaching_load_units_taken"
                                                        )
                                                        .value

                                            }

                                        )

                                }

                            );


                        const data =
                            await response.json();


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                "Unable to save employee configuration."
                            );

                        }


                        if (data.success) {

                            alert(
                                "Employee salary configuration saved successfully."
                            );


                            location.reload();

                        } else {

                            throw new Error(
                                data.message ||
                                "Unable to save configuration."
                            );

                        }


                    } catch (error) {


                        console.error(error);


                        alert(
                            error.message ||
                            "Something went wrong while saving the configuration."
                        );


                        button.disabled =
                            false;


                        button.innerHTML =
                            `
                            <i class="bi bi-check-circle me-2"></i>
                            Save Configuration
                            `;

                    }

                }

            );



        /*
        |--------------------------------------------------------------------------
        | Save Department Default Configuration
        |--------------------------------------------------------------------------
        */

        document
            .getElementById(
                "saveDepartmentConfig"
            )
            .addEventListener(
                "click",
                async function () {


                    const button =
                        this;


                    button.disabled =
                        true;


                    button.innerHTML =
                        `
                        <span
                            class="spinner-border spinner-border-sm me-2"
                        ></span>
                        Saving...
                        `;


                    try {


                        const response =
                            await fetch(
                                "{{ route('payroll.default.save') }}",
                                {

                                    method:
                                        "POST",

                                    headers:
                                        {

                                            "Content-Type":
                                                "application/json",

                                            "Accept":
                                                "application/json",

                                            "X-CSRF-TOKEN":
                                                document
                                                    .querySelector(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                    .content

                                        },


                                    body:
                                        JSON.stringify(
                                            {

                                                department:
                                                    document
                                                        .getElementById(
                                                            "department"
                                                        )
                                                        .value,


                                                default_basic_salary:
                                                    document
                                                        .getElementById(
                                                            "default_basic_salary"
                                                        )
                                                        .value,


                                                daily_rate:
                                                    document
                                                        .getElementById(
                                                            "default_daily_rate"
                                                        )
                                                        .value,


                                                overtime_rate:
                                                    document
                                                        .getElementById(
                                                            "default_overtime_rate"
                                                        )
                                                        .value,


                                                late_deduction_rate:
                                                    document
                                                        .getElementById(
                                                            "late_deduction_rate"
                                                        )
                                                        .value,


                                                undertime_deduction_rate:
                                                    document
                                                        .getElementById(
                                                            "undertime_deduction_rate"
                                                        )
                                                        .value,


                                                payroll_period:
                                                    document
                                                        .getElementById(
                                                            "payroll_period"
                                                        )
                                                        .value,


                                                sss:
                                                    document
                                                        .getElementById(
                                                            "sss"
                                                        )
                                                        .value,


                                                philhealth:
                                                    document
                                                        .getElementById(
                                                            "philhealth"
                                                        )
                                                        .value,


                                                pagibig:
                                                    document
                                                        .getElementById(
                                                            "pagibig"
                                                        )
                                                        .value,


                                                hmo:
                                                    document
                                                        .getElementById(
                                                            "hmo"
                                                        )
                                                        .value,


                                                /*
                                                |--------------------------------------------------------------------------
                                                | FIXED: DEPARTMENT HONORARIUM
                                                |--------------------------------------------------------------------------
                                                */

                                                honorarium:
                                                    document
                                                        .getElementById(
                                                            "default_honorarium"
                                                        )
                                                        .value,


                                                teaching_load_unit_required:
                                                    document
                                                        .getElementById(
                                                            "teaching_load_unit_required"
                                                        )
                                                        .value,


                                                teaching_load_price:
                                                    document
                                                        .getElementById(
                                                            "teaching_load_price"
                                                        )
                                                        .value

                                            }

                                        )

                                }

                            );


                        const data =
                            await response.json();


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                "Unable to save department configuration."
                            );

                        }


                        if (data.success) {

                            alert(
                                "Department default configuration saved successfully."
                            );


                            location.reload();

                        } else {

                            throw new Error(
                                data.message ||
                                "Unable to save department configuration."
                            );

                        }


                    } catch (error) {


                        console.error(error);


                        alert(
                            error.message ||
                            "Something went wrong while saving the department configuration."
                        );


                        button.disabled =
                            false;


                        button.innerHTML =
                            `
                            <i class="bi bi-check-circle me-2"></i>
                            Save Default Configuration
                            `;

                    }

                }

            );



        /*
        |--------------------------------------------------------------------------
        | Employee Search
        |--------------------------------------------------------------------------
        */

        document
            .getElementById(
                "employeeSearch"
            )
            .addEventListener(
                "input",
                function () {


                    const search =
                        this.value
                            .toLowerCase()
                            .trim();


                    document
                        .querySelectorAll(
                            ".employee-row"
                        )
                        .forEach(
                            function (row) {


                                const text =
                                    row.textContent
                                        .toLowerCase();


                                row.style.display =
                                    text.includes(search)
                                        ? ""
                                        : "none";

                            }
                        );

                }

            );


    }

);

</script>


</body>

</html>
