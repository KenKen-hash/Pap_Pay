<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Elementary Salary Configuration | PAP PAY</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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
                radial-gradient(circle at top left,
                    #6ee7b755,
                    transparent 35%),
                radial-gradient(circle at bottom right,
                    #34d39955,
                    transparent 35%),
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

        .auto-calculated {
            background: #f3f4f6;
            cursor: not-allowed;
        }

        .additional-entry,
        .teaching-entry {
            background: #f8fffb;
            border: 1px solid #d1fae5;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 15px;
        }

        .additional-entry:last-child,
        .teaching-entry:last-child {
            margin-bottom: 0;
        }

        .add-entry-btn {
            border: 1px dashed #10b981;
            color: #059669;
            background: #ecfdf5;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
        }

        .add-entry-btn:hover {
            background: #d1fae5;
            color: #047857;
        }

        .remove-entry-btn {
            border-radius: 10px;
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

            .modal-dialog {
                margin: 8px;
            }

            .modal-body {
                padding: 15px;
            }

            .card-body {
                padding: 15px;
            }

            .add-entry-btn {
                width: 100%;
            }

            .teaching-entry,
            .additional-entry {
                padding: 15px;
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

                        Elementary Salary Configuration

                    </h1>

                    <p class="page-subtitle">

                        Configure the default payroll settings for all Elementary employees.
                        Individual employees can also have their own salary configuration.

                    </p>

                </div>

                <a href="{{ route('payroll') }}" class="btn btn-outline-success px-4 py-2">

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

                    <input type="hidden" id="department" value="{{ $department }}">


                    <!-- PAYROLL PERIOD -->

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Payroll Period
                            </label>

                            <select id="payroll_period" class="form-select">

                                <option value="Every 15 Days"
                                    {{ optional($departmentConfig)->payroll_period == 'Every 15 Days' ? 'selected' : '' }}>
                                    Every 15 Days
                                </option>

                                <option value="Monthly"
                                    {{ optional($departmentConfig)->payroll_period == 'Monthly' ? 'selected' : '' }}>
                                    Monthly
                                </option>

                                <option value="Weekly"
                                    {{ optional($departmentConfig)->payroll_period == 'Weekly' ? 'selected' : '' }}>
                                    Weekly
                                </option>

                            </select>

                            <div class="small-note mt-2">

                                Your current payroll calculation is designed around
                                a 15-day cycle.

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

                                <input type="text"
                                    inputmode="decimal"
                                    id="late_deduction_rate"
                                    class="form-control"
                                    placeholder="2"
                                    value="{{ old('late_deduction_rate', optional($departmentConfig)->late_deduction_rate ?? 0) }}">

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

                                <input type="text"
                                    inputmode="decimal"
                                    id="undertime_deduction_rate"
                                    class="form-control"
                                    placeholder="2"
                                    value="{{ old('undertime_deduction_rate', optional($departmentConfig)->undertime_deduction_rate ?? 0) }}">

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

                                <input type="text"
                                    inputmode="decimal"
                                    id="sss"
                                    class="form-control"
                                    value="{{ old('sss', optional($departmentConfig)->sss ?? 0) }}">

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

                                <input type="text"
                                    inputmode="decimal"
                                    id="philhealth"
                                    class="form-control"
                                    value="{{ old('philhealth', optional($departmentConfig)->philhealth ?? 0) }}">

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

                                <input type="text"
                                    inputmode="decimal"
                                    id="pagibig"
                                    class="form-control"
                                    value="{{ old('pagibig', optional($departmentConfig)->pagibig ?? 0) }}">

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

                                <input type="text"
                                    inputmode="decimal"
                                    id="hmo"
                                    class="form-control"
                                    value="{{ old('hmo', optional($departmentConfig)->hmo ?? 0) }}">

                            </div>

                        </div>

                    </div>


                    <!-- SAVE -->

                    <div class="text-end mt-4">

                        <button type="button"
                            id="saveDepartmentConfig"
                            class="save-btn">

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

                        Elementary Employees

                    </h3>


                    <input type="text"
                        id="employeeSearch"
                        class="form-control"
                        placeholder="Search employee..."
                        style="max-width:300px;">

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

                                    $salaryConfig = $employee->salaryConfig;

                                    $defaultBasic =
                                        optional($departmentConfig)->default_basic_salary ?? 0;

                                    $basicSalary =
                                        $salaryConfig?->basic_salary ?? $defaultBasic;

                                    $additionalUnits =
                                        $salaryConfig?->teaching_load_units_taken ?? 0;


                                    /*
                                    |--------------------------------------------------------------------------
                                    | Existing Additional Earnings
                                    |--------------------------------------------------------------------------
                                    */

                                    $existingAdditionalEarnings =
                                        ($additionalEarnings ?? collect())->get(
                                            $employee->id,
                                            collect()
                                        );


                                    $additionalEarningsJson =
                                        $existingAdditionalEarnings
                                            ->map(function ($earning) {

                                                return [
                                                    'id' => $earning->id ?? null,
                                                    'amount' => $earning->amount,
                                                    'remarks' => $earning->remarks,
                                                ];

                                            })
                                            ->values()
                                            ->all();


                                    /*
                                    |--------------------------------------------------------------------------
                                    | Existing Additional Teaching Loads
                                    |--------------------------------------------------------------------------
                                    */

                                    $existingTeachingLoads =
                                        ($teachingLoads ?? collect())->get(
                                            $employee->id,
                                            collect()
                                        );


                                    $teachingLoadsJson =
                                        $existingTeachingLoads
                                            ->map(function ($teachingLoad) {

                                                return [
                                                    'id' => $teachingLoad->id ?? null,
                                                    'department' => $teachingLoad->department,
                                                    'subject' => $teachingLoad->subject,
                                                    'units' => $teachingLoad->units ?? 0,
                                                    'rate' => $teachingLoad->rate,
                                                    'remarks' => $teachingLoad->remarks,
                                                ];

                                            })
                                            ->values()
                                            ->all();

                                @endphp


                                <tr class="employee-row">


                                    <!-- EMPLOYEE -->

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <img class="employee-photo"
                                                src="{{ $employee->photo
                                                    ? asset('storage/' . $employee->photo)
                                                    : asset('khen/assets/images/avatar/avatar.jpg') }}"
                                                alt="Employee">

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

                                        <button type="button"
                                            class="btn configure-btn configureEmployee"

                                            data-id="{{ $employee->id }}"

                                            data-name="{{ $employee->first_name }} {{ $employee->last_name }}"

                                            data-employment="{{ $employee->employment_type }}"

                                            data-photo="{{ $employee->photo
                                                ? asset('storage/' . $employee->photo)
                                                : asset('khen/assets/images/avatar/avatar.jpg') }}"

                                            data-salary="{{ $salaryConfig?->basic_salary ?? $defaultBasic }}"

                                            data-daily="{{ $salaryConfig?->daily_rate ?? (optional($departmentConfig)->daily_rate ?? 0) }}"

                                            data-overtime="{{ $salaryConfig?->overtime_rate ?? (optional($departmentConfig)->overtime_rate ?? 0) }}"

                                            data-late="{{ $salaryConfig?->late_deduction_rate ?? (optional($departmentConfig)->late_deduction_rate ?? 0) }}"

                                            data-undertime="{{ $salaryConfig?->undertime_deduction_rate ?? (optional($departmentConfig)->undertime_deduction_rate ?? 0) }}"

                                            data-payroll="{{ $salaryConfig?->payroll_period ?? (optional($departmentConfig)->payroll_period ?? 'Every 15 Days') }}"

                                            data-sss="{{ $salaryConfig?->sss ?? (optional($departmentConfig)->sss ?? 0) }}"

                                            data-philhealth="{{ $salaryConfig?->philhealth ?? (optional($departmentConfig)->philhealth ?? 0) }}"

                                            data-pagibig="{{ $salaryConfig?->pagibig ?? (optional($departmentConfig)->pagibig ?? 0) }}"

                                            data-hmo="{{ $employee->employment_type === 'Regular'
                                                ? ($salaryConfig?->hmo ?? (optional($departmentConfig)->hmo ?? 0))
                                                : 0 }}"

                                            data-honorarium="{{ $salaryConfig?->honorarium ?? (optional($departmentConfig)->honorarium ?? 0) }}"

                                            data-teaching-units="{{ $salaryConfig?->teaching_load_units_taken ?? 0 }}"

                                            data-additional-earnings='@json($additionalEarningsJson, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT)'

                                            data-teaching-loads='@json($teachingLoadsJson, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT)'>

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Configure

                                        </button>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="6"
                                        class="text-center py-5 text-muted">

                                        <i class="bi bi-people fs-1 d-block mb-2"></i>

                                        No Elementary employees found.

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

    <div class="modal fade"
        id="employeeSalaryModal"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

            <div class="modal-content border-0 shadow-lg">


                <!-- HEADER -->

                <div class="modal-header text-white">

                    <h4 class="modal-title">

                        <i class="bi bi-person-badge me-2"></i>

                        Employee Salary Configuration

                    </h4>

                    <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <div class="modal-body">


                    <input type="hidden" id="employee_id">


                    <!-- ================================================= -->
                    <!-- EMPLOYEE INFORMATION -->
                    <!-- ================================================= -->

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-md-2 text-center mb-3 mb-md-0">

                                    <img id="modalPhoto"
                                        src="{{ asset('khen/assets/images/avatar/avatar.jpg') }}"
                                        class="rounded-circle"
                                        style="
                                            width:90px;
                                            height:90px;
                                            object-fit:cover;
                                        ">

                                </div>


                                <div class="col-md-10">

                                    <h3 id="modalName"
                                        class="mb-2">
                                    </h3>

                                    <span class="badge bg-success"
                                        id="modalEmployment">
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- BASIC SALARY & AUTOMATIC RATES -->
                    <!-- ================================================= -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">

                            <strong>

                                <i class="bi bi-wallet2 me-2"></i>

                                Basic Salary & Rates

                            </strong>

                        </div>


                        <div class="card-body">

                            <div class="row">


                                <!-- BASIC SALARY -->

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Basic Salary
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input type="number"
                                            step="0.01"
                                            min="0"
                                            id="basic_salary"
                                            class="form-control">

                                    </div>

                                    <div class="small-note mt-2">

                                        Daily rate is automatically calculated
                                        from Basic Salary ÷ 26.

                                    </div>

                                </div>


                                <!-- DAILY RATE -->

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Daily Rate
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input type="text"
                                            id="daily_rate"
                                            class="form-control auto-calculated"
                                            readonly>

                                    </div>

                                    <div class="small-note mt-2">

                                        Basic Salary ÷ 26

                                    </div>

                                </div>


                                <!-- OVERTIME -->

                                <div class="col-md-4 mb-3">

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

                                        <input type="text"
                                            id="overtime_rate"
                                            class="form-control auto-calculated"
                                            readonly>

                                    </div>

                                    <div class="small-note mt-2">

                                        Daily Rate ÷ 8

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

                                        <input type="number"
                                            step="0.01"
                                            min="0"
                                            id="employee_late_deduction_rate"
                                            class="form-control">

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

                                        <input type="number"
                                            step="0.01"
                                            min="0"
                                            id="employee_undertime_deduction_rate"
                                            class="form-control">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- PAYROLL / BENEFITS -->
                    <!-- ================================================= -->

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

                                    <input id="employee_payroll_period"
                                        class="form-control"
                                        readonly>

                                </div>


                                <div class="col-md-2 mb-3">

                                    <label class="form-label">
                                        SSS
                                    </label>

                                    <input type="number"
                                        step="0.01"
                                        min="0"
                                        id="employee_sss"
                                        class="form-control">

                                </div>


                                <div class="col-md-2 mb-3">

                                    <label class="form-label">
                                        PhilHealth
                                    </label>

                                    <input type="number"
                                        step="0.01"
                                        min="0"
                                        id="employee_philhealth"
                                        class="form-control">

                                </div>


                                <div class="col-md-2 mb-3">

                                    <label class="form-label">
                                        Pag-IBIG
                                    </label>

                                    <input type="number"
                                        step="0.01"
                                        min="0"
                                        id="employee_pagibig"
                                        class="form-control">

                                </div>


                                <div class="col-md-2 mb-3">

                                    <label class="form-label">
                                        HMO
                                    </label>

                                    <input type="number"
                                        step="0.01"
                                        min="0"
                                        id="employee_hmo"
                                        class="form-control">

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- ADDITIONAL EARNINGS -->
                    <!-- ================================================= -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <strong>

                                    <i class="bi bi-plus-circle me-2"></i>

                                    Additional Earnings

                                </strong>


                                <button type="button"
                                    class="btn add-entry-btn"
                                    id="addAdditionalEarning">

                                    <i class="bi bi-plus-circle me-1"></i>

                                    Add Additional Earning

                                </button>

                            </div>

                        </div>


                        <div class="card-body">

                            <div id="additionalEarningsContainer"></div>


                            <div id="noAdditionalEarnings"
                                class="text-muted text-center py-3">

                                <i class="bi bi-info-circle me-1"></i>

                                No additional earnings added.

                            </div>

                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- ADDITIONAL TEACHING LOAD -->
                    <!-- ================================================= -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <strong>

                                    <i class="bi bi-book-half me-2"></i>

                                    Additional Teaching Load

                                </strong>


                                <button type="button"
                                    class="btn add-entry-btn"
                                    id="addTeachingLoad">

                                    <i class="bi bi-plus-circle me-1"></i>

                                    Add Teaching Load

                                </button>

                            </div>

                        </div>


                        <div class="card-body">

                            <div id="teachingLoadContainer"></div>


                            <div id="noTeachingLoad"
                                class="text-muted text-center py-3">

                                <i class="bi bi-info-circle me-1"></i>

                                No additional teaching load added.

                            </div>

                        </div>

                    </div>


                </div>


                <!-- FOOTER -->

                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>


                    <button type="button"
                        class="btn btn-success"
                        id="saveEmployeeSalary">

                        <i class="bi bi-check-circle me-2"></i>

                        Save Configuration

                    </button>

                </div>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>

        document.addEventListener(
            "DOMContentLoaded",
            function() {


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
                | Automatic Daily Rate / Overtime Rate
                |--------------------------------------------------------------------------
                */

                function updateAutomaticRates() {

                    const basicSalary =
                        parseFloat(
                            document.getElementById(
                                "basic_salary"
                            ).value
                        ) || 0;


                    const dailyRate =
                        basicSalary / 26;


                    const overtimeRate =
                        dailyRate / 8;


                    document.getElementById(
                        "daily_rate"
                    ).value =
                        dailyRate.toFixed(2);


                    document.getElementById(
                        "overtime_rate"
                    ).value =
                        overtimeRate.toFixed(2);

                }


                document
                    .getElementById(
                        "basic_salary"
                    )
                    .addEventListener(
                        "input",
                        updateAutomaticRates
                    );


                /*
                |--------------------------------------------------------------------------
                | HTML Escape Helper
                |--------------------------------------------------------------------------
                */

                function escapeHtml(value) {

                    if (
                        value === null ||
                        value === undefined
                    ) {

                        return "";

                    }


                    return String(value)
                        .replace(
                            /&/g,
                            "&amp;"
                        )
                        .replace(
                            /</g,
                            "&lt;"
                        )
                        .replace(
                            />/g,
                            "&gt;"
                        )
                        .replace(
                            /"/g,
                            "&quot;"
                        )
                        .replace(
                            /'/g,
                            "&#039;"
                        );

                }


                /*
                |--------------------------------------------------------------------------
                | Additional Earnings
                |--------------------------------------------------------------------------
                */

                const additionalEarningsContainer =
                    document.getElementById(
                        "additionalEarningsContainer"
                    );


                const noAdditionalEarnings =
                    document.getElementById(
                        "noAdditionalEarnings"
                    );


                function updateAdditionalEarningsMessage() {

                    noAdditionalEarnings.style.display =
                        additionalEarningsContainer.children.length === 0
                            ? ""
                            : "none";

                }


                function createAdditionalEarning(
                    amount = "",
                    remarks = ""
                ) {

                    const entry =
                        document.createElement(
                            "div"
                        );


                    entry.className =
                        "additional-entry";


                    entry.innerHTML =
                        `

                        <div class="row align-items-end">

                            <div class="col-md-5 mb-3 mb-md-0">

                                <label class="form-label">
                                    Amount
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₱
                                    </span>

                                    <input
                                        type="text"
                                        inputmode="decimal"
                                        class="form-control additional-earning-amount"
                                        placeholder="0.00"
                                        value="${escapeHtml(amount)}"
                                    >

                                </div>

                            </div>


                            <div class="col-md-5 mb-3 mb-md-0">

                                <label class="form-label">
                                    Remarks
                                </label>

                                <input
                                    type="text"
                                    class="form-control additional-earning-remarks"
                                    placeholder="Enter remarks"
                                    value="${escapeHtml(remarks)}"
                                >

                            </div>


                            <div class="col-md-2 mb-3 mb-md-0">

                                <button
                                    type="button"
                                    class="btn btn-outline-danger w-100 remove-entry-btn remove-additional-earning"
                                >

                                    <i class="bi bi-trash me-1"></i>

                                    Remove

                                </button>

                            </div>

                        </div>

                        `;


                    additionalEarningsContainer.appendChild(
                        entry
                    );


                    entry
                        .querySelector(
                            ".remove-additional-earning"
                        )
                        .addEventListener(
                            "click",
                            function() {

                                entry.remove();

                                updateAdditionalEarningsMessage();

                            }
                        );


                    updateAdditionalEarningsMessage();

                }


                document
                    .getElementById(
                        "addAdditionalEarning"
                    )
                    .addEventListener(
                        "click",
                        function() {

                            createAdditionalEarning();

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Additional Teaching Load
                |--------------------------------------------------------------------------
                */

                const teachingLoadContainer =
                    document.getElementById(
                        "teachingLoadContainer"
                    );


                const noTeachingLoad =
                    document.getElementById(
                        "noTeachingLoad"
                    );


                function updateTeachingLoadMessage() {

                    noTeachingLoad.style.display =
                        teachingLoadContainer.children.length === 0
                            ? ""
                            : "none";

                }


                /*
                |--------------------------------------------------------------------------
                | Create Teaching Load Entry
                |--------------------------------------------------------------------------
                */

                function createTeachingLoad(
                    department = "",
                    subject = "",
                    units = 0,
                    rate = "",
                    remarks = ""
                ) {

                    const entry =
                        document.createElement(
                            "div"
                        );


                    entry.className =
                        "teaching-entry";


                    entry.innerHTML =
                        `

                        <div class="row align-items-end">

                            <div class="col-md-3 mb-3">

                                <label class="form-label">
                                    Department
                                </label>

                                <select
                                    class="form-select teaching-load-department"
                                >

                                    <option value="">
                                        Select Department
                                    </option>

                                    <option
                                        value="Elementary"
                                        ${department === "Elementary" ? "selected" : ""}
                                    >
                                        Elementary
                                    </option>

                                    <option
                                        value="JHS"
                                        ${department === "JHS" ? "selected" : ""}
                                    >
                                        JHS
                                    </option>

                                    <option
                                        value="SHS"
                                        ${department === "SHS" ? "selected" : ""}
                                    >
                                        SHS
                                    </option>

                                    <option
                                        value="College"
                                        ${department === "College" ? "selected" : ""}
                                    >
                                        College
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-2 mb-3">

                                <label class="form-label">
                                    Subject
                                </label>

                                <input
                                    type="text"
                                    class="form-control teaching-load-subject"
                                    placeholder="Subject"
                                    value="${escapeHtml(subject)}"
                                >

                            </div>


                            <div class="col-md-1 mb-3">

                                <label class="form-label">
                                    Units
                                </label>

                                <input
                                    type="number"
                                    min="0"
                                    step="1"
                                    class="form-control teaching-load-units"
                                    placeholder="0"
                                    value="${escapeHtml(units)}"
                                >

                            </div>


                            <div class="col-md-2 mb-3">

                                <label class="form-label">
                                    Rate
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₱
                                    </span>

                                    <input
                                        type="text"
                                        inputmode="decimal"
                                        class="form-control teaching-load-rate"
                                        placeholder="0.00"
                                        value="${escapeHtml(rate)}"
                                    >

                                </div>

                            </div>


                            <div class="col-md-2 mb-3">

                                <label class="form-label">
                                    Remarks
                                </label>

                                <input
                                    type="text"
                                    class="form-control teaching-load-remarks"
                                    placeholder="Remarks"
                                    value="${escapeHtml(remarks)}"
                                >

                            </div>


                            <div class="col-md-2 mb-3">

                                <button
                                    type="button"
                                    class="btn btn-outline-danger w-100 remove-entry-btn remove-teaching-load"
                                >

                                    <i class="bi bi-trash me-1"></i>

                                    Remove

                                </button>

                            </div>

                        </div>

                        `;


                    teachingLoadContainer.appendChild(
                        entry
                    );


                    entry
                        .querySelector(
                            ".remove-teaching-load"
                        )
                        .addEventListener(
                            "click",
                            function() {

                                entry.remove();

                                updateTeachingLoadMessage();

                            }
                        );


                    updateTeachingLoadMessage();

                }


                document
                    .getElementById(
                        "addTeachingLoad"
                    )
                    .addEventListener(
                        "click",
                        function() {

                            createTeachingLoad();

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Load Existing Additional Earnings
                |--------------------------------------------------------------------------
                */

                function loadAdditionalEarnings(
                    earnings
                ) {

                    additionalEarningsContainer.innerHTML =
                        "";


                    if (
                        !Array.isArray(earnings) ||
                        earnings.length === 0
                    ) {

                        updateAdditionalEarningsMessage();

                        return;

                    }


                    earnings.forEach(
                        function(earning) {

                            createAdditionalEarning(
                                earning.amount ?? "",
                                earning.remarks ?? ""
                            );

                        }
                    );


                    updateAdditionalEarningsMessage();

                }


                /*
                |--------------------------------------------------------------------------
                | Load Existing Teaching Loads
                |--------------------------------------------------------------------------
                */

                function loadTeachingLoads(
                    teachingLoads
                ) {

                    teachingLoadContainer.innerHTML =
                        "";


                    if (
                        !Array.isArray(teachingLoads) ||
                        teachingLoads.length === 0
                    ) {

                        updateTeachingLoadMessage();

                        return;

                    }


                    teachingLoads.forEach(
                        function(teachingLoad) {

                            createTeachingLoad(
                                teachingLoad.department ?? "",
                                teachingLoad.subject ?? "",
                                teachingLoad.units ?? 0,
                                teachingLoad.rate ?? "",
                                teachingLoad.remarks ?? ""
                            );

                        }
                    );


                    updateTeachingLoadMessage();

                }


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
                        function(button) {

                            button.addEventListener(
                                "click",
                                function() {


                                    document.getElementById(
                                        "employee_id"
                                    ).value =
                                        this.dataset.id;


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


                                    document.getElementById(
                                        "basic_salary"
                                    ).value =
                                        this.dataset.salary || 0;


                                    updateAutomaticRates();


                                    document.getElementById(
                                        "employee_late_deduction_rate"
                                    ).value =
                                        this.dataset.late || 0;


                                    document.getElementById(
                                        "employee_undertime_deduction_rate"
                                    ).value =
                                        this.dataset.undertime || 0;


                                    document.getElementById(
                                        "employee_payroll_period"
                                    ).value =
                                        this.dataset.payroll ||
                                        "Every 15 Days";


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
                                    |--------------------------------------------------------------------------
                                    | Load Existing Additional Earnings
                                    |--------------------------------------------------------------------------
                                    */

                                    let additionalEarnings = [];


                                    try {

                                        additionalEarnings =
                                            JSON.parse(
                                                this.dataset.additionalEarnings || "[]"
                                            );

                                    } catch (error) {

                                        console.error(
                                            "Unable to load additional earnings:",
                                            error,
                                            this.dataset.additionalEarnings
                                        );

                                        additionalEarnings = [];

                                    }


                                    loadAdditionalEarnings(
                                        additionalEarnings
                                    );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | Load Existing Teaching Loads
                                    |--------------------------------------------------------------------------
                                    */

                                    let teachingLoads = [];


                                    try {

                                        teachingLoads =
                                            JSON.parse(
                                                this.dataset.teachingLoads || "[]"
                                            );

                                    } catch (error) {

                                        console.error(
                                            "Unable to load teaching loads:",
                                            error,
                                            this.dataset.teachingLoads
                                        );

                                        teachingLoads = [];

                                    }


                                    loadTeachingLoads(
                                        teachingLoads
                                    );


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
                        async function() {


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


                                /*
                                |--------------------------------------------------------------------------
                                | Collect Additional Earnings
                                |--------------------------------------------------------------------------
                                */

                                const additionalEarnings = [];


                                document
                                    .querySelectorAll(
                                        "#additionalEarningsContainer .additional-entry"
                                    )
                                    .forEach(
                                        function(entry) {

                                            const amount =
                                                entry
                                                    .querySelector(
                                                        ".additional-earning-amount"
                                                    )
                                                    .value
                                                    .trim();


                                            const remarks =
                                                entry
                                                    .querySelector(
                                                        ".additional-earning-remarks"
                                                    )
                                                    .value
                                                    .trim();


                                            if (
                                                amount !== "" ||
                                                remarks !== ""
                                            ) {

                                                additionalEarnings.push({

                                                    amount: amount,

                                                    remarks: remarks

                                                });

                                            }

                                        }
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | Collect Additional Teaching Loads
                                |--------------------------------------------------------------------------
                                */

                                const teachingLoads = [];


                                document
                                    .querySelectorAll(
                                        "#teachingLoadContainer .teaching-entry"
                                    )
                                    .forEach(
                                        function(entry) {

                                            const department =
                                                entry
                                                    .querySelector(
                                                        ".teaching-load-department"
                                                    )
                                                    .value
                                                    .trim();


                                            const subject =
                                                entry
                                                    .querySelector(
                                                        ".teaching-load-subject"
                                                    )
                                                    .value
                                                    .trim();


                                            const units =
                                                entry
                                                    .querySelector(
                                                        ".teaching-load-units"
                                                    )
                                                    .value
                                                    .trim();


                                            const rate =
                                                entry
                                                    .querySelector(
                                                        ".teaching-load-rate"
                                                    )
                                                    .value
                                                    .trim();


                                            const remarks =
                                                entry
                                                    .querySelector(
                                                        ".teaching-load-remarks"
                                                    )
                                                    .value
                                                    .trim();


                                            if (
                                                department !== "" ||
                                                subject !== "" ||
                                                units !== "" ||
                                                rate !== "" ||
                                                remarks !== ""
                                            ) {

                                                teachingLoads.push({

                                                    department: department,

                                                    subject: subject,

                                                    units:
                                                        units !== ""
                                                            ? parseInt(units, 10)
                                                            : 0,

                                                    rate: rate,

                                                    remarks: remarks

                                                });

                                            }

                                        }
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | Save Employee Configuration
                                |--------------------------------------------------------------------------
                                */

                                const response =
                                    await fetch(
                                        "{{ route('payroll.save') }}",
                                        {

                                            method: "POST",

                                            headers: {

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

                                            body: JSON.stringify({

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

                                                payroll_period:
                                                    document
                                                        .getElementById(
                                                            "employee_payroll_period"
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

                                                additional_earnings:
                                                    additionalEarnings,

                                                teaching_loads:
                                                    teachingLoads

                                            })

                                        }
                                    );


                                const data =
                                    await response.json();


                                if (!response.ok) {

                                    let errorMessage =
                                        data.message ||
                                        "Unable to save employee configuration.";


                                    if (data.errors) {

                                        const validationErrors =
                                            Object.values(
                                                data.errors
                                            ).flat();


                                        if (
                                            validationErrors.length > 0
                                        ) {

                                            errorMessage =
                                                validationErrors.join(
                                                    "\n"
                                                );

                                        }

                                    }


                                    throw new Error(
                                        errorMessage
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

                                console.error(
                                    error
                                );


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
                        async function() {


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

                                            method: "POST",

                                            headers: {

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


                                            body: JSON.stringify({

                                                department:
                                                    document
                                                        .getElementById(
                                                            "department"
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
                                                        .value

                                            })

                                        }
                                    );


                                const data =
                                    await response.json();


                                if (!response.ok) {

                                    let errorMessage =
                                        data.message ||
                                        "Unable to save department configuration.";


                                    if (data.errors) {

                                        const validationErrors =
                                            Object.values(
                                                data.errors
                                            ).flat();


                                        if (
                                            validationErrors.length > 0
                                        ) {

                                            errorMessage =
                                                validationErrors.join(
                                                    "\n"
                                                );

                                        }

                                    }


                                    throw new Error(
                                        errorMessage
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

                                console.error(
                                    error
                                );


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
                        function() {


                            const search =
                                this.value
                                    .toLowerCase()
                                    .trim();


                            document
                                .querySelectorAll(
                                    ".employee-row"
                                )
                                .forEach(
                                    function(row) {


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
