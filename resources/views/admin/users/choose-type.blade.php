<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | PAP PAY</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
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
            min-height: 100vh;
            background: #081224;
            overflow-x: hidden;
        }

        .background {

            position: fixed;

            inset: 0;

            background:
                radial-gradient(circle at top left, #2f6bff55, transparent 45%),
                radial-gradient(circle at bottom right, #14d9b655, transparent 40%),
                #081224;

        }

        .container {

            position: relative;

            z-index: 2;

        }

        .main-card {

            background: rgba(255, 255, 255, .08);

            backdrop-filter: blur(25px);

            border: 1px solid rgba(255, 255, 255, .15);

            border-radius: 25px;

            width: 100%;
            max-width: 1000px;
            margin: auto;
            padding: 60px;

            color: white;

            box-shadow: 0 30px 60px rgba(0, 0, 0, .35);

        }

        .step {

            color: #7ab7ff;

            font-weight: 600;

            letter-spacing: 2px;

            margin-bottom: 10px;

        }

        .main-card h1 {

            font-size: 40px;

            font-weight: 700;

        }

        .main-card p {

            color: #b9c4d6;

        }

        .type-card {

            display: block;

            border: 2px solid rgba(255, 255, 255, .15);

            border-radius: 20px;

            padding: 35px;

            cursor: pointer;

            transition: .35s;

            height: 100%;

            background: rgba(255, 255, 255, .04);

        }

        .type-card:hover {

            transform: translateY(-8px);

            border-color: #4d8dff;

        }

        .btn-check:checked+.type-card {

            border-color: #4d8dff;

            box-shadow: 0 0 30px #2563eb66;

        }

        .icon {

            width: 90px;

            height: 90px;

            border-radius: 22px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: white;

            font-size: 38px;

            margin-bottom: 25px;

        }

        .employee {

            background: linear-gradient(135deg, #2563eb, #4f9cff);

        }

        .admin {

            background: linear-gradient(135deg, #00c58e, #18e0ab);

        }

        .type-card h3 {

            margin-bottom: 10px;

        }

        .type-card small {

            color: #cfd7e6;

        }

        .type-card ul {

            margin-top: 25px;

            padding-left: 18px;

            color: #d7e2ef;

        }

        .continue-btn {

            width: 100%;

            margin-top: 45px;

            border: none;

            padding: 18px;

            border-radius: 15px;

            background: linear-gradient(135deg, #2563eb, #4f9cff);

            color: white;

            font-size: 18px;

            font-weight: 600;

            transition: .3s;

        }

        .continue-btn:hover {

            transform: translateY(-3px);

            box-shadow: 0 15px 35px rgba(37, 99, 235, .45);

        }

        @media (max-width:992px) {

            .main-card {
                padding: 45px;
            }

        }

        @media (max-width:768px) {

            .main-card {

                padding: 30px 22px;

            }

            .main-card h1 {

                font-size: 28px;

            }

            .type-card {

                padding: 25px;

            }

            .icon {

                width: 70px;
                height: 70px;
                font-size: 30px;

            }

        }

        @media (max-width:576px) {

            .main-card {

                border-radius: 18px;

            }

            .step {

                font-size: 13px;

            }

            .main-card p {

                font-size: 14px;

            }

        }
    </style>

</head>

<body>

    <form action="{{ route('users.choose') }}" method="POST">

        @csrf

        <div class="background"></div>

        <div class="container py-5">

            <div class="main-card">

                <div class="step">

                    STEP 1 OF 4

                </div>

                <h1>Create New Account</h1>

                <p>

                    Choose which type of account you would like to create.

                </p>

                <div class="row mt-5 g-4">

                    <!-- Employee -->

                    <div class="col-lg-6">

                        <input type="radio" class="btn-check" name="role" id="employee" value="employee" checked>

                        <label class="type-card" for="employee">

                            <div class="icon employee">

                                <i class="bi bi-person-workspace"></i>

                            </div>

                            <h3>Employee</h3>

                            <small>

                                Faculty, Staff, Maintenance,
                                Laborers and other personnel.

                            </small>

                            <ul>

                                <li>Attendance</li>

                                <li>Payroll</li>

                                <li>Leave Request</li>

                                <li>Official Business</li>

                            </ul>

                        </label>

                    </div>

                    <!-- Admin -->

                    <div class="col-lg-6">

                        <input type="radio" class="btn-check" name="role" id="admin" value="admin">

                        <label class="type-card" for="admin">

                            <div class="icon admin">

                                <i class="bi bi-shield-lock-fill"></i>

                            </div>

                            <h3>Administrator</h3>

                            <small>

                                HR, Finance and Payroll Personnel

                            </small>

                            <ul>

                                <li>User Management</li>

                                <li>Payroll Management</li>

                                <li>Reports</li>

                                <li>System Settings</li>

                            </ul>

                        </label>

                    </div>

                </div>

                <button class="continue-btn">

                    Continue

                    <i class="bi bi-arrow-right-circle-fill ms-2"></i>

                </button>

            </div>

        </div>

    </form>

</body>

</html>
