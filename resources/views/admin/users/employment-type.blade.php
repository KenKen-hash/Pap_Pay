<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employment Type | PAP PAY</title>

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

            height: 100%;
            min-height: 280px;

            padding: 35px;

            border-radius: 22px;
            border: 2px solid rgba(255, 255, 255, .12);

            background: rgba(255, 255, 255, .05);

            text-align: center;

            cursor: pointer;

            transition: .35s ease;
        }

        .department-card:hover {

            transform: translateY(-8px);

            border-color: #4fa3ff;

            box-shadow: 0 20px 45px rgba(79, 163, 255, .25);

        }

        .btn-check:checked+.department-card {


            border-color: #4fa3ff;

            box-shadow: 0 0 25px rgba(79, 163, 255, .45);

        }

        .department-card h5 {

            margin-top: 20px;
            margin-bottom: 12px;

            font-weight: 600;
        }

        .department-card p {

           color:rgba(255,255,255,.75);

    line-height:1.6;

    margin:0;
        }

        .department-card i {

            font-size: 52px;

            color: #4fa3ff;

            margin-bottom: 18px;

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
                STEP 2 OF 3
            </div>

            <h2 class="mt-2">
                Select Employment Type
            </h2>

            <p class="text-light opacity-75">
                Choose the employment classification before assigning the employee to a department.
            </p>

            <form action="{{ route('users.employee') }}" method="GET">

                <div class="row g-4 mt-4">

                    <!-- Regular -->
                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check" type="radio" name="employment_type" id="regular" value="Regular"
                            required>

                        <label class="department-card" for="regular">

                            <i class="bi bi-person-check-fill"></i>

                            <h5>Regular</h5>

                            <p>
                                Permanent employee with complete benefits and monthly salary.
                            </p>

                        </label>
                    </div>

                    <!-- Contractual -->
                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check" type="radio" name="employment_type" id="contractual"
                            value="Contractual">

                        <label class="department-card" for="contractual">

                            <i class="bi bi-file-earmark-text-fill"></i>

                            <h5>Contractual</h5>

                            <p>
                                Employee hired for a fixed contract period.
                            </p>

                        </label>
                    </div>

                    <!-- Part-Time -->
                    <div class="col-lg-4 col-md-6">
                        <input class="btn-check" type="radio" name="employment_type" id="parttime" value="Part-Time">

                        <label class="department-card" for="parttime">

                            <i class="bi bi-clock-history"></i>

                            <h5>Part-Time</h5>

                            <p>
                                Employee paid based on rendered working hours.
                            </p>

                        </label>
                    </div>

                </div>

                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Continue
                        <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                    </button>
                </div>

            </form>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
