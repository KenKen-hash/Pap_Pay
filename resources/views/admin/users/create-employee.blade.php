<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Employee | PAP PAY</title>

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

        .btn-check:checked+.department-card {

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

        .credentials {

            margin-top: 40px;

            background: rgba(255, 255, 255, .05);

            border-radius: 20px;

            padding: 30px;

        }

        .form-control {

            background: rgba(255, 255, 255, .08);

            border: none;

            color: white;

        }

        .form-control:focus {

            background: rgba(255, 255, 255, .08);

            color: white;

            box-shadow: none;

        }

        .form-control::placeholder {

            color: #bdbdbd;

        }

        .btn-primary {

            padding: 14px;

            font-weight: 600;

        }
    </style>

</head>

<body>


    <div class="background"></div>

    <div class="wrapper">

        <div class="glass">

            <div class="step">

                STEP 2 OF 4

            </div>

            <h2 class="mt-2">

                Create Employee Account

            </h2>

            <p class="text-light opacity-75">

                Select the employee department and generate temporary credentials.

            </p>

            <form action="{{ route('users.employee.setup') }}" method="POST" id="employeeForm">

                @csrf

                <div class="row mt-4 g-4">

                    <div class="col-md-6">

                        <input class="btn-check" type="radio" name="department" id="primary" value="Primary"
                            required>

                        <label class="department-card" for="primary">

                            <i class="bi bi-house-door-fill"></i>

                            <h5>Primary</h5>

                            <p>Elementary Department</p>

                        </label>

                    </div>

                    <div class="col-md-6">

                        <input class="btn-check" type="radio" name="department" id="secondary" value="Secondary">

                        <label class="department-card" for="secondary">

                            <i class="bi bi-book-fill"></i>

                            <h5>Secondary</h5>

                            <p>Junior & Senior High</p>

                        </label>

                    </div>

                    <div class="col-md-6">

                        <input class="btn-check" type="radio" name="department" id="tertiary" value="Tertiary">

                        <label class="department-card" for="tertiary">

                            <i class="bi bi-mortarboard-fill"></i>

                            <h5>Tertiary</h5>

                            <p>College Department</p>

                        </label>

                    </div>

                    <div class="col-md-6">

                        <input class="btn-check" type="radio" name="department" id="nonteaching"
                            value="Non-Teaching Staff">

                        <label class="department-card" for="nonteaching">

                            <i class="bi bi-people-fill"></i>

                            <h5>Non-Teaching Staff</h5>

                            <p>Administrative & Utility Personnel</p>

                        </label>

                    </div>

                </div>


        </div>

        <div class="d-grid mt-5">

            <button type="submit" class="btn btn-primary btn-lg">

                Generate Credentials

                <i class="bi bi-key-fill ms-2"></i>

            </button>

        </div>

        </form>

    </div>

    </div>

    <script>
        const generateBtn = document.getElementById("generate");

        const continueBtn = document.getElementById("continueBtn");

        generateBtn.addEventListener("click", () => {

            const year = new Date().getFullYear();

            const number = Math.floor(Math.random() * 9000) + 1000;

            document.getElementById("email").value =
                `EMP${year}${number}@pap-pay.local`;

            const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%";

            let pass = "";

            for (let i = 0; i < 10; i++) {

                pass += chars.charAt(Math.floor(Math.random() * chars.length));

            }

            document.getElementById("password").value = pass;

            continueBtn.disabled = false;

        });
    </script>

    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <div class="modal-body p-5 text-center">

                        <div class="mb-4">

                            <i class="bi bi-check-circle-fill text-success" style="font-size:70px;"></i>

                        </div>

                        <h3 class="fw-bold mb-3">

                            Employee Created Successfully

                        </h3>

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

                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                                <i class="bi bi-plus-circle me-2"></i>

                                Create Another Employee

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                let modal = new bootstrap.Modal(
                    document.getElementById('successModal')
                );

                modal.show();

            });
        </script>
    @endif

</body>

</html>
