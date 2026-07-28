<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrative Salary Configuration | PAP PAY</title>

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
                radial-gradient(circle at top left, #6ee7b755, transparent 35%),
                radial-gradient(circle at bottom right, #34d39955, transparent 35%),
                #e9faf4;

            z-index: -1;

        }

        .wrapper {

            max-width: 1450px;
            margin: auto;
            padding: 45px;

        }

        .glass {

            background: rgba(255, 255, 255, .72);

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

        .form-control,
        .form-select {

            height: 50px;

            border-radius: 12px;

        }

        .input-group-text {

            background: #d1fae5;

            font-weight: bold;

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
    </style>

</head>

<body>

    <div class="background"></div>

    <div class="wrapper">

        <div class="glass">

            <div class="d-flex justify-content-between align-items-start mb-4">

                <div>

                    <h1 class="page-title">

                        <i class="bi bi-bank2 me-2"></i>

                         Administrative Salary Configuration

                    </h1>

                    <p class="page-subtitle">

                        Configure the default payroll settings for all Administrative employees.

                        Employees may also have their own salary configuration.

                    </p>

                </div>

                <a href="{{ route('payroll') }}" class="btn btn-outline-success px-4 py-2">

                    <i class="bi bi-arrow-left-circle me-2"></i>

                    Back to Payroll

                </a>

            </div>

            <!-- ==================================== -->
            <!-- DEFAULT CONFIGURATION -->
            <!-- ==================================== -->

            <div class="section">

                <div class="section-title">

                    <i class="bi bi-sliders"></i>

                    Default Salary Configuration

                </div>

                <form>
                    <input type="hidden" id="department" value="Admin">

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Default Basic Salary

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    ₱

                                </span>

                                <input type="number" id="default_basic_salary" class="form-control" placeholder="22000"
                                    value="{{ old('default_basic_salary', optional($departmentConfig)->default_basic_salary) }}">

                            </div>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Payroll Release

                            </label>

                            <select id="payroll_period" class="form-select">

                                <option value="Monthly"
                                    {{ optional($departmentConfig)->payroll_period == 'Monthly' ? 'selected' : '' }}>
                                    Monthly
                                </option>

                                <option value="Every 15 Days"
                                    {{ optional($departmentConfig)->payroll_period == 'Every 15 Days' ? 'selected' : '' }}>
                                    Every 15 Days
                                </option>

                                <option value="Weekly"
                                    {{ optional($departmentConfig)->payroll_period == 'Weekly' ? 'selected' : '' }}>
                                    Weekly
                                </option>

                            </select>

                        </div>

                    </div>



                    <div class="row">

                        <!-- Daily Rate -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Daily Rate
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>

                                <input type="number" id="default_daily_rate" class="form-control" placeholder="0.00"
                                    value="{{ old('default_daily_rate', optional($departmentConfig)->daily_rate) }}">

                            </div>

                        </div>

                        <!-- Overtime Rate -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Overtime Rate
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>

                                <input type="number" id="default_overtime_rate" class="form-control" placeholder="0.00"
                                    value="{{ old('default_overtime_rate', optional($departmentConfig)->overtime_rate) }}">

                            </div>

                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-4">

                        Benefits

                    </h5>

                    <div class="row">

                        <div class="col-lg-3 mb-3">

                            <label class="form-label">

                                SSS

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    ₱

                                </span>

                                <input type="number" id="sss" class="form-control" placeholder="0"
                                    value="{{ old('sss', optional($departmentConfig)->sss) }}">

                            </div>

                        </div>

                        <div class="col-lg-3 mb-3">

                            <label class="form-label">

                                PhilHealth

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    ₱

                                </span>

                                <input type="number" id="philhealth" class="form-control" placeholder="0"
                                    value="{{ old('philhealth', optional($departmentConfig)->philhealth) }}">

                            </div>

                        </div>

                        <div class="col-lg-3 mb-3">

                            <label class="form-label">

                                Pag-IBIG

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    ₱

                                </span>

                                <input type="number" id="pagibig" class="form-control" placeholder="0"
                                    value="{{ old('pagibig', optional($departmentConfig)->pagibig) }}">

                            </div>

                        </div>

                        <div class="col-lg-3 mb-3">

                            <label class="form-label">

                                HMO (Regular Only)

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    ₱

                                </span>

                                <input type="number" id="hmo" class="form-control" placeholder="0"
                                    value="{{ old('hmo', optional($departmentConfig)->hmo) }}">

                            </div>

                        </div>

                    </div>

                    <div class="text-end mt-4">

                        <button type="button" id="saveDepartmentConfig" class="save-btn">

                            Save Default Configuration

                        </button>

                    </div>

                </form>

            </div>

            <!-- ==================================== -->
            <!-- EMPLOYEE LIST -->
            <!-- ==================================== -->

            <div class="section">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h3 class="section-title mb-0">

                        <i class="bi bi-people-fill"></i>

                        Administrative Employees

                    </h3>

                    <input type="text" class="form-control" placeholder="Search employee..."
                        style="width:300px;">

                </div>

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>Employee</th>

                                <th>Employment Type</th>

                                <th>Basic Salary</th>

                                <th>Status</th>

                                <th width="150">

                                    Action

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($employees as $employee)
                                <tr>

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <img class="employee-photo"
                                                src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('khen/assets/images/avatar/avatar.jpg') }}">

                                            <div>

                                                <strong>

                                                    {{ $employee->first_name }}

                                                    {{ $employee->last_name }}

                                                </strong>

                                                <br>

                                                <small>

                                                    {{ $employee->employee_id }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        @if ($employee->employment_type == 'Regular')
                                            <span class="badge badge-regular">

                                                Regular

                                            </span>
                                        @elseif($employee->employment_type == 'Contractual')
                                            <span class="badge badge-contractual">

                                                Contractual

                                            </span>
                                        @else
                                            <span class="badge badge-parttime">

                                                Part-Time

                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        ₱ {{ number_format(optional($employee->salaryConfig)->basic_salary ?? 0, 2) }}

                                    </td>

                                    <td>

                                        @if ($employee->salaryConfig)
                                            <span class="badge bg-success">

                                                Configured

                                            </span>
                                        @else
                                            <span class="badge bg-secondary">

                                                Using Default

                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        <button class="btn configure-btn configureEmployee"
                                            data-id="{{ $employee->id }}"
                                            data-name="{{ $employee->first_name }} {{ $employee->last_name }}"
                                            data-employment="{{ $employee->employment_type }}"
                                            data-salary="{{ optional($employee->salaryConfig)->basic_salary ?? optional($departmentConfig)->default_basic_salary }}"
                                            data-daily="{{ optional($employee->salaryConfig)->daily_rate ?? optional($departmentConfig)->daily_rate }}"
                                            data-overtime="{{ optional($employee->salaryConfig)->overtime_rate ?? optional($departmentConfig)->overtime_rate }}"
                                            data-payroll="{{ optional($employee->salaryConfig)->payroll_period ?? optional($departmentConfig)->payroll_period }}"
                                            data-sss="{{ optional($employee->salaryConfig)->sss ?? optional($departmentConfig)->sss }}"
                                            data-philhealth="{{ optional($employee->salaryConfig)->philhealth ?? optional($departmentConfig)->philhealth }}"
                                            data-pagibig="{{ optional($employee->salaryConfig)->pagibig ?? optional($departmentConfig)->pagibig }}"
                                            data-hmo="{{ $employee->employment_type == 'Regular'
                                                ? optional($employee->salaryConfig)->hmo ?? optional($departmentConfig)->hmo
                                                : 0 }}"
                                            data-ot="{{ optional($employee->salaryConfig)->ot_rate ?? 0 }}"
                                            data-honorarium="{{ optional($employee->salaryConfig)->honorarium ?? 0 }}"
                                            data-teaching="{{ optional($employee->salaryConfig)->teaching_load ?? 0 }}">

                                            Configure

                                        </button>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- ================================================= -->
    <!-- EMPLOYEE SALARY CONFIGURATION MODAL -->
    <!-- ================================================= -->

    <div class="modal fade" id="employeeSalaryModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header bg-success text-white">

                    <h4 class="modal-title">

                        <i class="bi bi-sliders me-2"></i>

                        Employee Salary Configuration

                    </h4>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input type="hidden" id="employee_id">

                    <!-- Employee Information -->

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-md-2 text-center">

                                    <img id="modalPhoto" src="{{ asset('khen/assets/images/avatar/avatar.jpg') }}"
                                        class="rounded-circle" style="width:90px;height:90px;object-fit:cover;">

                                </div>

                                <div class="col-md-10">

                                    <h3 id="modalName"></h3>

                                    <span class="badge bg-success" id="modalEmployment">

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Basic Salary -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">

                            <strong>

                                Basic Salary

                            </strong>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <!-- Basic Salary -->

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Basic Salary
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input type="number" id="basic_salary" class="form-control">

                                    </div>

                                </div>



                            </div>

                            <div class="row">

                                <!-- Daily Rate -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Daily Rate
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input type="number" id="daily_rate" class="form-control">

                                    </div>

                                </div>

                                <!-- Overtime Rate -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Overtime Rate
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>

                                        <input type="number" id="overtime_rate" class="form-control">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="card shadow-sm mb-4">

                        <div class="card-header">
                            <strong>Payroll & Benefits</strong>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <!-- Payroll Period -->

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Payroll Period
                                    </label>

                                    <input id="employee_payroll_period" class="form-control" readonly>

                                </div>
                                <div class="col-md-2 mb-3">

                                    <label class="form-label">
                                        SSS
                                    </label>

                                    <input type="number" id="employee_sss" class="form-control">

                                </div>

                                <div class="col-md-2 mb-3">

                                    <label class="form-label">
                                        PhilHealth
                                    </label>

                                    <input type="number" id="employee_philhealth" class="form-control">

                                </div>

                                <div class="col-md-2 mb-3">

                                    <label class="form-label">
                                        Pag-IBIG
                                    </label>

                                    <input type="number" id="employee_pagibig" class="form-control">

                                </div>

                                <div class="col-md-2 mb-3">

                                    <label class="form-label">
                                        HMO
                                    </label>

                                    <input type="number" id="employee_hmo" class="form-control" readonly>

                                </div>

                            </div>

                        </div>


                    </div>


                    <!-- Additional Earnings -->

                    <div class="card shadow-sm">

                        <div class="card-header">

                            <strong>

                                Additional Earnings

                            </strong>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">

                                        OT

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">

                                            ₱

                                        </span>

                                        <input type="number" id="ot_rate" class="form-control" value="0">

                                    </div>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">

                                        Honorarium / Stipend

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">

                                            ₱

                                        </span>

                                        <input type="number" id="honorarium" class="form-control" value="0">

                                    </div>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">

                                        Teaching Load

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">

                                            ₱

                                        </span>

                                        <input type="number" id="teaching_load" class="form-control"
                                            value="0">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="button" class="btn btn-success" id="saveEmployeeSalary">

                        <i class="bi bi-check-circle me-2"></i>

                        Save Configuration

                    </button>

                </div>

            </div>

        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>






    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Create Bootstrap Modal
            const employeeModal = new bootstrap.Modal(
                document.getElementById("employeeSalaryModal")
            );

            // Configure Button
            document.querySelectorAll(".configureEmployee").forEach(function(button) {

                button.addEventListener("click", function() {

                    document.getElementById("employee_id").value =
                        this.dataset.id;

                    document.getElementById("modalName").textContent =
                        this.dataset.name;

                    document.getElementById("modalEmployment").textContent =
                        this.dataset.employment;

                    document.getElementById("basic_salary").value =
                        this.dataset.salary ?? "";

                    document.getElementById("daily_rate").value =
                        this.dataset.daily ?? "";

                    document.getElementById("overtime_rate").value =
                        this.dataset.overtime ?? "";

                    document.getElementById("employee_payroll_period").value =
                        this.dataset.payroll;

                    document.getElementById("employee_sss").value =
                        this.dataset.sss;

                    document.getElementById("employee_philhealth").value =
                        this.dataset.philhealth;

                    document.getElementById("employee_pagibig").value =
                        this.dataset.pagibig;

                    document.getElementById("employee_hmo").value =
                        this.dataset.hmo;

                    document.getElementById("ot_rate").value =
                        this.dataset.ot ?? 0;

                    document.getElementById("honorarium").value =
                        this.dataset.honorarium ?? 0;

                    document.getElementById("teaching_load").value =
                        this.dataset.teaching ?? 0;

                    employeeModal.show();

                });

            });

        });



        document.getElementById("saveEmployeeSalary").addEventListener("click", function() {

            fetch("{{ route('payroll.save') }}", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    },

                    body: JSON.stringify({

                        user_id: document.getElementById("employee_id").value,

                        basic_salary: document.getElementById("basic_salary").value,

                        payroll_period: document.getElementById("employee_payroll_period").value,

                        daily_rate: document.getElementById("daily_rate").value,

                        overtime_rate: document.getElementById("overtime_rate").value,

                        sss: document.getElementById("employee_sss").value,

                        philhealth: document.getElementById("employee_philhealth").value,

                        pagibig: document.getElementById("employee_pagibig").value,

                        hmo: document.getElementById("employee_hmo").value,

                        ot_rate: document.getElementById("ot_rate").value,

                        honorarium: document.getElementById("honorarium").value,

                        teaching_load: document.getElementById("teaching_load").value

                    })

                })

                .then(response => response.json())

                .then(data => {

                    if (data.success) {

                        alert("Salary configuration saved successfully!");

                        location.reload();

                    }

                })

                .catch(error => {

                    console.error(error);

                    alert("Something went wrong.");

                });

        });

        document.getElementById("saveDepartmentConfig").addEventListener("click", function() {

            fetch("{{ route('payroll.default.save') }}", {

                    method: "POST",

                    headers: {

                        "Content-Type": "application/json",

                        "Accept": "application/json",

                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .content

                    },

                    body: JSON.stringify({

                        department: document.getElementById("department").value,

                        default_basic_salary: document.getElementById("default_basic_salary").value,

                        daily_rate: document.getElementById("default_daily_rate").value,

                        overtime_rate: document.getElementById("default_overtime_rate").value,

                        payroll_period: document.getElementById("payroll_period").value,

                        sss: document.getElementById("sss").value,

                        philhealth: document.getElementById("philhealth").value,

                        pagibig: document.getElementById("pagibig").value,

                        hmo: document.getElementById("hmo").value

                    })

                })

                .then(response => response.json())

                .then(data => {

                    if (data.success) {

                        alert("Department default configuration saved successfully!");

                    }

                })

                .catch(error => {

                    console.error(error);

                    alert("Unable to save configuration.");

                });

        });
    </script>
</body>

</html>
