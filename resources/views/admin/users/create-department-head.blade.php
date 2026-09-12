<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Department Head | PAP PAY</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

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
            -webkit-backdrop-filter: blur(25px);
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
            min-height: 230px;
            height: 100%;
            border: 2px solid rgba(255, 255, 255, .12);
            border-radius: 20px;
            padding: 30px;
            cursor: pointer;
            transition: .3s;
            background: rgba(255, 255, 255, .03);
            text-align: center;
            color: white;
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
            margin-top: 18px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .department-card p {
            margin: 0;
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

        .form-control {
            min-height: 50px;
            border-radius: 12px;
        }

        .modal-content {
            color: #212529;
        }

        .modal-body {
            max-height: calc(100vh - 180px);
            overflow-y: auto;
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
                min-height: 200px;
                padding: 22px 15px;
            }
        }
    </style>

</head>

<body>

    <div class="background"></div>

    <div class="wrapper">

        <div class="glass">

            <div class="step">ADMIN ACCOUNT • DEPARTMENT HEAD</div>

            <h2 class="mt-2">Select Department</h2>

            <p class="text-light opacity-75">
                Select the department that this Department Head will manage.
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

            <form action="{{ route('users.department-head.setup') }}" method="POST" id="departmentHeadForm">
                @csrf

                <input type="hidden" name="category" value="Department Heads">

                <div class="row mt-4 g-4">

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio"
                            name="department" id="elementary" value="Elementary" required>
                        <label class="department-card" for="elementary">
                            <i class="bi bi-house-door-fill"></i>
                            <h5>Elementary</h5>
                            <p>Elementary Department</p>
                        </label>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio"
                            name="department" id="jhs" value="JHS">
                        <label class="department-card" for="jhs">
                            <i class="bi bi-book-fill"></i>
                            <h5>JHS</h5>
                            <p>Junior High School</p>
                        </label>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio"
                            name="department" id="shs" value="SHS">
                        <label class="department-card" for="shs">
                            <i class="bi bi-journal-bookmark-fill"></i>
                            <h5>SHS</h5>
                            <p>Senior High School</p>
                        </label>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio"
                            name="department" id="college" value="College">
                        <label class="department-card" for="college">
                            <i class="bi bi-mortarboard-fill"></i>
                            <h5>College</h5>
                            <p>College Department</p>
                        </label>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio"
                            name="department" id="admin" value="Admin">
                        <label class="department-card" for="admin">
                            <i class="bi bi-building-fill-gear"></i>
                            <h5>Admin</h5>
                            <p>Administrative Personnel</p>
                        </label>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check department-radio" type="radio"
                            name="department" id="laborers" value="Laborers">
                        <label class="department-card" for="laborers">
                            <i class="bi bi-person-workspace"></i>
                            <h5>Laborers</h5>
                            <p>Maintenance &amp; Utility Personnel</p>
                        </label>
                    </div>

                </div>

                <div class="d-flex flex-column flex-sm-row gap-3 mt-5">

                    <a href="{{ route('users.admin') }}"
                        class="btn btn-outline-light btn-lg flex-fill">
                        <i class="bi bi-arrow-left me-2"></i>
                        Back
                    </a>

                    <button type="button" class="btn btn-primary btn-lg flex-fill"
                        id="continueDepartmentButton">
                        Continue to Information
                        <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- BASIC INFORMATION MODAL -->
    <div class="modal fade" id="departmentHeadInformationModal" tabindex="-1"
        aria-labelledby="departmentHeadInformationModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

            <div class="modal-content border-0 rounded-4 shadow-lg">

                <div class="modal-header border-0 px-4 px-md-5 pt-4 pb-3">

                    <div>
                        <h4 class="modal-title fw-bold mb-1"
                            id="departmentHeadInformationModalLabel">
                            Department Head Information
                        </h4>

                        <p class="text-muted mb-0 small">
                            Enter the basic information needed for the Department Head audit record.
                        </p>
                    </div>

                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <form action="{{ route('users.department-head.setup') }}"
                    method="POST" id="departmentHeadInformationForm">

                    @csrf

                    <input type="hidden" name="category" value="Department Heads">
                    <input type="hidden" name="department" id="selectedDepartment"
                        value="{{ old('department') }}">

                    <div class="modal-body px-4 px-md-5 pb-4">

                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">
                                    First Name <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control"
                                    name="first_name" id="head_first_name"
                                    value="{{ old('first_name') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>

                                <input type="text" class="form-control"
                                    name="middle_name"
                                    value="{{ old('middle_name') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">
                                    Last Name <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control"
                                    name="last_name" id="head_last_name"
                                    value="{{ old('last_name') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>

                                <input type="text" class="form-control"
                                    name="contact_number"
                                    value="{{ old('contact_number') }}"
                                    placeholder="Enter contact number">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Gender</label>

                                <select class="form-select" name="gender">
                                    <option value="">Select</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Birth Date</label>

                                <input type="date" class="form-control"
                                    name="birth_date"
                                    value="{{ old('birth_date') }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Address</label>

                                <textarea class="form-control" name="address" rows="3"
                                    placeholder="Enter complete address">{{ old('address') }}</textarea>
                            </div>

                        </div>

                        <div class="alert alert-info border-0 rounded-3 mt-4 mb-0">
                            <i class="bi bi-info-circle-fill me-2"></i>

                            Department:
                            <strong id="selectedDepartmentDisplay">
                                {{ old('department') ?: 'Not selected' }}
                            </strong>
                        </div>

                        <div class="alert alert-secondary border-0 rounded-3 mt-3 mb-0">
                            <i class="bi bi-shield-check me-2"></i>

                            The Department Head ID, login email, and temporary password
                            will be generated automatically.
                        </div>

                    </div>

                    <div class="modal-footer border-0 px-4 px-md-5 pb-4 pt-2">

                        <button type="button" class="btn btn-light px-4"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary px-4"
                            id="generateHeadCredentialsButton">
                            <i class="bi bi-shield-lock-fill me-2"></i>
                            Generate Credentials
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    @if (session('success'))

        <div class="modal fade" id="successModal" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <div class="modal-body p-5 text-center">

                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success"
                                style="font-size:70px;"></i>
                        </div>

                        <h3 class="fw-bold mb-3">
                            Department Head Created Successfully
                        </h3>

                        <p class="text-muted">
                            Give these credentials to the Department Head.
                        </p>

                        <hr>

                        <div class="text-start">

                            <p>
                                <strong>Administrator ID</strong><br>
                                {{ session('admin_id') }}
                            </p>

                            <p>
                                <strong>Department</strong><br>
                                {{ session('department') }}
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

                            <a href="{{ route('employees.index') }}"
                                class="btn btn-primary">
                                <i class="bi bi-people-fill me-2"></i>
                                Back to Employee List
                            </a>

                            <a href="{{ route('users.admin') }}"
                                class="btn btn-success">
                                <i class="bi bi-plus-circle me-2"></i>
                                Create Another Administrator
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const continueDepartmentButton =
                document.getElementById('continueDepartmentButton');

            const selectedDepartment =
                document.getElementById('selectedDepartment');

            const selectedDepartmentDisplay =
                document.getElementById('selectedDepartmentDisplay');

            const informationModalElement =
                document.getElementById('departmentHeadInformationModal');

            const informationModal =
                new bootstrap.Modal(informationModalElement, {
                    backdrop: 'static',
                    keyboard: true
                });

            document.querySelectorAll('.department-radio').forEach(function (radio) {

                radio.addEventListener('change', function () {
                    selectedDepartment.value = this.value;
                    selectedDepartmentDisplay.textContent = this.value;
                });

            });

            continueDepartmentButton.addEventListener('click', function () {

                const selected =
                    document.querySelector('.department-radio:checked');

                if (!selected) {
                    alert('Please select a department first.');
                    return;
                }

                selectedDepartment.value = selected.value;
                selectedDepartmentDisplay.textContent = selected.value;

                informationModal.show();
            });

            const informationForm =
                document.getElementById('departmentHeadInformationForm');

            const generateButton =
                document.getElementById('generateHeadCredentialsButton');

            informationForm.addEventListener('submit', function (event) {

                const selected =
                    document.querySelector('.department-radio:checked');

                if (!selected && !selectedDepartment.value) {
                    event.preventDefault();
                    alert('Please select a department first.');
                    informationModal.hide();
                    return;
                }

                if (selected) {
                    selectedDepartment.value = selected.value;
                }

                const firstName =
                    document.getElementById('head_first_name').value.trim();

                const lastName =
                    document.getElementById('head_last_name').value.trim();

                if (!firstName || !lastName) {
                    event.preventDefault();

                    if (!firstName) {
                        document.getElementById('head_first_name').focus();
                    } else {
                        document.getElementById('head_last_name').focus();
                    }

                    return;
                }

                generateButton.disabled = true;

                generateButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>' +
                    'Generating Credentials...';
            });

            @if(old('first_name') || old('last_name') || $errors->any())

                const oldDepartment = @json(old('department'));

                if (oldDepartment) {

                    const oldRadio =
                        document.querySelector(
                            '.department-radio[value="' + oldDepartment + '"]'
                        );

                    if (oldRadio) {
                        oldRadio.checked = true;
                    }

                    selectedDepartment.value = oldDepartment;
                    selectedDepartmentDisplay.textContent = oldDepartment;
                }

                @if($errors->any())
                    informationModal.show();
                @endif

            @endif

            @if(session('success'))

                const successModalElement =
                    document.getElementById('successModal');

                if (successModalElement) {

                    const successModal =
                        new bootstrap.Modal(successModalElement);

                    successModal.show();
                }

            @endif

        });
    </script>

</body>

</html>
