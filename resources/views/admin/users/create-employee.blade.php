<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee | PAP PAY</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins, sans-serif;
        }

        body {
            background: #081224;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .background {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at top left, #2f6bff55, transparent 40%),
                radial-gradient(circle at bottom right, #17d4b355, transparent 40%),
                #081224;
            z-index: -1;
        }

        .wrapper {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }

        .glass {
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 25px;
            padding: 45px;
            color: white;
        }

        .step {
            color: #4fa3ff;
            font-weight: 600;
            letter-spacing: 2px;
        }

        .department-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 250px;
            height: 100%;
            border: 2px solid rgba(255, 255, 255, .12);
            border-radius: 20px;
            padding: 30px;
            cursor: pointer;
            transition: .3s;
            background: rgba(255, 255, 255, .03);
            text-align: center;
        }

        .department-card:hover {
            transform: translateY(-6px);
            border-color: #4fa3ff;
        }

        .btn-check:checked + .department-card {
            border-color: #4fa3ff;
            box-shadow: 0 0 20px rgba(79, 163, 255, .5);
        }

        .department-card h5 {
            margin-top: 20px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .department-card p {
            margin: 0;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, .75);
            line-height: 1.5;
        }

        .department-card i {
            font-size: 42px;
            color: #4fa3ff;
        }

        .btn-primary {
            padding: 14px;
            font-weight: 600;
        }

        /* Keep Bootstrap modals outside the glass stacking context. */
        .employee-information-modal {
            z-index: 1060;
        }

        .employee-information-modal .modal-content {
            overflow: hidden;
            position: relative;
        }

        .employee-information-modal .modal-body {
            max-height: calc(100vh - 170px);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .form-section {
            padding: 22px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .form-section:first-child {
            padding-top: 0;
        }

        .form-section-title {
            display: flex;
            align-items: center;
            font-size: 1.05rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 18px;
        }

        .employee-information-modal .form-control,
        .employee-information-modal .form-select {
            min-height: 46px;
            border-radius: 10px;
        }

        .employee-information-modal textarea.form-control {
            min-height: auto;
        }

        .employee-information-modal .form-label {
            font-weight: 600;
            font-size: .88rem;
            color: #495057;
            margin-bottom: 7px;
        }

        @media (max-width: 767.98px) {
            .wrapper {
                margin: 20px auto;
                padding: 12px;
            }

            .glass {
                padding: 25px 18px;
                border-radius: 20px;
            }

            .department-card {
                min-height: 190px;
                padding: 22px 15px;
            }

            .department-card i {
                font-size: 35px;
            }

            .employee-information-modal .modal-dialog {
                margin: 8px;
            }

            .employee-information-modal .modal-body {
                max-height: calc(100vh - 135px);
            }

            .employee-information-modal .modal-header,
            .employee-information-modal .modal-body,
            .employee-information-modal .modal-footer {
                padding-left: 18px !important;
                padding-right: 18px !important;
            }
        }
    </style>
</head>

<body>
    <div class="background"></div>

    <form action="{{ route('users.employee.setup') }}" method="POST" id="employeeForm">
        @csrf
        <input type="hidden" name="employment_type" value="{{ old('employment_type', $employmentType ?? request('employment_type')) }}">
        <input type="hidden" name="department" id="selectedDepartment" value="{{ old('department') }}">

    <div class="wrapper">
        <div class="glass">
            <div class="mb-2 step">STEP 2 OF 2</div>

            <h1 class="fw-bold mb-2">Create Employee Account</h1>

            <p class="text-white-50 mb-0">
                Select the employee department, enter the employee information, then generate temporary credentials.
            </p>

            @if ($errors->any())
                <div class="alert alert-danger mt-4 rounded-4">
                    <div class="fw-semibold mb-1">Please check the following:</div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


                <div class="row mt-4 g-4" id="departmentSelection">
                    @if(request('employment_type') !== 'Part-Time')
                        <div class="col-lg-4 col-md-6">
                            <input class="btn-check department-radio" type="radio" name="department_choice"
                                id="elementary" value="Elementary"
                                {{ old('department') === 'Elementary' ? 'checked' : '' }}>
                            <label class="department-card" for="elementary">
                                <i class="bi bi-house-door-fill"></i>
                                <h5>Elementary</h5>
                                <p>Elementary Department</p>
                            </label>
                        </div>
                    @endif

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio" name="department_choice"
                            id="jhs" value="JHS"
                            {{ old('department') === 'JHS' ? 'checked' : '' }}>
                        <label class="department-card" for="jhs">
                            <i class="bi bi-book-fill"></i>
                            <h5>JHS</h5>
                            <p>Junior High School</p>
                        </label>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio" name="department_choice"
                            id="shs" value="SHS"
                            {{ old('department') === 'SHS' ? 'checked' : '' }}>
                        <label class="department-card" for="shs">
                            <i class="bi bi-journal-bookmark-fill"></i>
                            <h5>SHS</h5>
                            <p>Senior High School</p>
                        </label>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio" name="department_choice"
                            id="college" value="College"
                            {{ old('department') === 'College' ? 'checked' : '' }}>
                        <label class="department-card" for="college">
                            <i class="bi bi-mortarboard-fill"></i>
                            <h5>College</h5>
                            <p>College Department</p>
                        </label>
                    </div>

                    @if(request('employment_type') !== 'Part-Time')
                        <div class="col-lg-4 col-md-6">
                            <input class="btn-check department-radio" type="radio" name="department_choice"
                                id="admin" value="Admin"
                                {{ old('department') === 'Admin' ? 'checked' : '' }}>
                            <label class="department-card" for="admin">
                                <i class="bi bi-building-fill-gear"></i>
                                <h5>Admin</h5>
                                <p>Administrative Personnel</p>
                            </label>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <input class="btn-check department-radio" type="radio" name="department_choice"
                                id="laborers" value="Laborers"
                                {{ old('department') === 'Laborers' ? 'checked' : '' }}>
                            <label class="department-card" for="laborers">
                                <i class="bi bi-person-workspace"></i>
                                <h5>Laborers</h5>
                                <p>Maintenance &amp; Utility Personnel</p>
                            </label>
                        </div>
                    @endif
                </div>

                <div class="d-grid mt-5">
                    <button type="button" class="btn btn-primary btn-lg" id="continueToInformation">
                        Continue to Employee Information
                        <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                    </button>
                </div>


        </div>
    </div>


                <div class="modal fade employee-information-modal" id="employeeInformationModal"
                    tabindex="-1" aria-labelledby="employeeInformationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content border-0 rounded-4 shadow-lg">
                            <div class="modal-header border-0 px-4 px-md-5 pt-4 pb-3">
                                <div>
                                    <h4 class="modal-title fw-bold mb-1" id="employeeInformationModalLabel">
                                        Employee Information
                                    </h4>
                                    <p class="text-muted mb-0 small">
                                        Enter the employee's information before generating the account credentials.
                                    </p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body px-4 px-md-5 pb-4">
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="bi bi-person-vcard me-2 text-primary"></i>
                                        Personal Information
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="first_name"
                                                id="create_first_name" value="{{ old('first_name') }}" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name"
                                                id="create_middle_name" value="{{ old('middle_name') }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="last_name"
                                                id="create_last_name" value="{{ old('last_name') }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" name="contact_number"
                                                id="create_contact_number" value="{{ old('contact_number') }}"
                                                placeholder="Enter contact number">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Gender</label>
                                            <select class="form-select" name="gender" id="create_gender">
                                                <option value="">Select</option>
                                                <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Birth Date</label>
                                            <input type="date" class="form-control" name="birth_date"
                                                id="create_birth_date" value="{{ old('birth_date') }}">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" name="address" id="create_address" rows="2"
                                                placeholder="Enter complete address">{{ old('address') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="bi bi-briefcase-fill me-2 text-success"></i>
                                        Employment Information
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Department</label>
                                            <input type="text" class="form-control" id="create_department_display"
                                                value="{{ old('department') }}" readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Position</label>
                                            <input type="text" class="form-control" name="position"
                                                id="create_position" value="{{ old('position') }}"
                                                placeholder="Enter position">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Employment Type</label>
                                            <input type="text" class="form-control" id="create_employment_type_display"
                                                value="{{ old('employment_type', $employmentType ?? request('employment_type')) }}"
                                                readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="status" id="create_status">
                                                <option value="Active" {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ old('status') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Salary Grade</label>
                                            <input type="text" class="form-control" name="salary_grade"
                                                id="create_salary_grade" value="{{ old('salary_grade') }}"
                                                placeholder="Enter salary grade">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Hire Date</label>
                                            <input type="date" class="form-control" name="hire_date"
                                                id="create_hire_date" value="{{ old('hire_date') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="bi bi-card-checklist me-2 text-warning"></i>
                                        Government Benefits Numbers
                                    </div>

                                    <p class="text-muted small mb-3">
                                        Enter the employee's government identification numbers. These are stored as text so leading zeros and formatting are preserved.
                                    </p>

                                    <div class="row g-3">
                                        <div class="col-md-6 col-lg-3">
                                            <label class="form-label">SSS Number</label>
                                            <input type="text" class="form-control" name="sss_number"
                                                id="create_sss_number" maxlength="30"
                                                value="{{ old('sss_number') }}" placeholder="SSS Number">
                                        </div>

                                        <div class="col-md-6 col-lg-3">
                                            <label class="form-label">PhilHealth Number</label>
                                            <input type="text" class="form-control" name="philhealth_number"
                                                id="create_philhealth_number" maxlength="30"
                                                value="{{ old('philhealth_number') }}" placeholder="PhilHealth Number">
                                        </div>

                                        <div class="col-md-6 col-lg-3">
                                            <label class="form-label">Pag-IBIG Number</label>
                                            <input type="text" class="form-control" name="pagibig_number"
                                                id="create_pagibig_number" maxlength="30"
                                                value="{{ old('pagibig_number') }}" placeholder="Pag-IBIG Number">
                                        </div>

                                        <div class="col-md-6 col-lg-3">
                                            <label class="form-label">TIN</label>
                                            <input type="text" class="form-control" name="tin"
                                                id="create_tin" maxlength="30"
                                                value="{{ old('tin') }}" placeholder="TIN">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="bi bi-shield-exclamation me-2 text-danger"></i>
                                        Emergency Contact
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Emergency Contact Person</label>
                                            <input type="text" class="form-control" name="emergency_contact_person"
                                                id="create_emergency_contact_person"
                                                value="{{ old('emergency_contact_person') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Emergency Contact Number</label>
                                            <input type="text" class="form-control" name="emergency_contact_number"
                                                id="create_emergency_contact_number"
                                                value="{{ old('emergency_contact_number') }}">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Bio</label>
                                            <textarea class="form-control" name="bio" id="create_bio" rows="3"
                                                placeholder="Optional employee biography">{{ old('bio') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section mb-0">
                                    <div class="form-section-title">
                                        <i class="bi bi-key-fill me-2 text-info"></i>
                                        Account Credentials
                                    </div>

                                    <div class="alert alert-info border-0 rounded-3 mb-0">
                                        <i class="bi bi-info-circle-fill me-2"></i>
                                        The employee ID, login email, and temporary password will be generated automatically after you submit the information.
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer border-0 px-4 px-md-5 pb-4 pt-2">
                                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                                    Cancel
                                </button>

                                <button type="submit" class="btn btn-primary px-4" id="generateCredentialsButton">
                                    <i class="bi bi-key-fill me-2"></i>
                                    Generate Credentials
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

    </form>

    @if(session('success'))
        <div class="modal fade" id="successModal" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-body p-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size:70px;"></i>
                        </div>

                        <h3 class="fw-bold mb-3">Employee Created Successfully</h3>

                        <p class="text-muted">
                            Give these credentials to the employee.
                        </p>

                        <hr>

                        <div class="text-start">
                            <p>
                                <strong>Employee ID</strong><br>
                                {{ session('employee_id') }}
                            </p>

                            <p>
                                <strong>Email</strong><br>
                                {{ session('email') }}
                            </p>

                            <p>
                                <strong>Temporary Password</strong><br>
                                {{ session('password') }}
                            </p>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <a href="{{ route('employees.index') }}" class="btn btn-primary">
                                <i class="bi bi-people-fill me-2"></i>
                                Back to Employee List
                            </a>

                            <a href="{{ route('users.employment') }}" class="btn btn-success">
                                <i class="bi bi-arrow-repeat me-2"></i>
                                Go to Employment Type
                            </a>

                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-plus-circle me-2"></i>
                                Create Another {{ $employmentType ?? request('employment_type') }} Employee
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('employeeForm');
            const continueButton = document.getElementById('continueToInformation');
            const departmentField = document.getElementById('selectedDepartment');
            const departmentDisplay = document.getElementById('create_department_display');
            const informationModalElement = document.getElementById('employeeInformationModal');

            if (!form || !continueButton || !departmentField || !departmentDisplay || !informationModalElement) {
                return;
            }

            const informationModal = new bootstrap.Modal(informationModalElement, {
                backdrop: 'static',
                keyboard: true
            });

            document.querySelectorAll('.department-radio').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    departmentField.value = this.value;
                    departmentDisplay.value = this.value;
                });
            });

            continueButton.addEventListener('click', function () {
                const selected = document.querySelector('.department-radio:checked');

                if (!selected) {
                    alert('Please select an employee department first.');
                    return;
                }

                departmentField.value = selected.value;
                departmentDisplay.value = selected.value;

                informationModal.show();
            });

            form.addEventListener('submit', function (event) {
                const selected = document.querySelector('.department-radio:checked');

                if (!selected || !departmentField.value) {
                    event.preventDefault();
                    alert('Please select an employee department first.');
                    return;
                }

                departmentField.value = selected.value;

                const firstName = document.getElementById('create_first_name').value.trim();
                const lastName = document.getElementById('create_last_name').value.trim();

                if (!firstName || !lastName) {
                    event.preventDefault();

                    const firstNameField = document.getElementById('create_first_name');

                    if (firstNameField) {
                        firstNameField.focus();
                    }

                    return;
                }

                const generateButton = document.getElementById('generateCredentialsButton');

                if (generateButton) {
                    generateButton.disabled = true;
                    generateButton.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>Generating Credentials...';
                }
            });

            const oldDepartment = @json(old('department'));

            if (oldDepartment) {
                const oldRadio = document.querySelector(
                    '.department-radio[value="' + oldDepartment + '"]'
                );

                if (oldRadio) {
                    oldRadio.checked = true;
                    departmentField.value = oldDepartment;
                    departmentDisplay.value = oldDepartment;
                }
            }

            @if($errors->any())
                informationModal.show();
            @elseif(old('first_name') || old('last_name') || old('position') || old('sss_number'))
                informationModal.show();
            @endif
        });

        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function () {
                const successModalElement = document.getElementById('successModal');

                if (successModalElement) {
                    const successModal = new bootstrap.Modal(successModalElement);
                    successModal.show();
                }
            });
        @endif
    </script>
</body>
</html>
