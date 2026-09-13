<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pap Pay | School Payroll Management System</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../../../khen/assets/images/favicon.png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Prevent text from becoming too wide on large screens */
        .content-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Extra-small devices */
        @media (max-width: 480px) {

            .main-container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
                padding-top: 2.5rem !important;
                padding-bottom: 5rem !important;
            }

            .welcome-badge {
                font-size: 0.72rem !important;
                padding: 0.5rem 0.8rem !important;
                margin-bottom: 1rem !important;
            }

            .main-title {
                font-size: 2.15rem !important;
                line-height: 1.2 !important;
                margin-bottom: 1rem !important;
            }

            .description {
                font-size: 0.9rem !important;
                line-height: 1.7 !important;
                margin-bottom: 1.5rem !important;
            }

            .login-button {
                width: 100%;
                justify-content: center;
                padding: 0.85rem 1rem !important;
                font-size: 0.95rem !important;
            }

            .features-card {
                padding: 1rem !important;
                border-radius: 1.25rem !important;
            }

            .feature-item {
                padding: 1rem !important;
            }

            .feature-title {
                font-size: 1rem !important;
            }

            .feature-description {
                font-size: 0.78rem !important;
                line-height: 1.6 !important;
            }

            .footer {
                position: relative !important;
                bottom: auto !important;
                margin-top: -3rem;
                padding: 0 1rem 1.25rem;
                font-size: 0.7rem !important;
                line-height: 1.5 !important;
            }
        }

        /* Small devices */
        @media (min-width: 481px) and (max-width: 767px) {

            .main-container {
                padding-top: 3rem !important;
                padding-bottom: 5rem !important;
            }

            .main-title {
                font-size: 2.8rem !important;
            }

            .description {
                font-size: 1rem !important;
            }

            .login-button {
                width: auto;
            }

            .footer {
                position: relative !important;
                bottom: auto !important;
                margin-top: -3rem;
                padding-bottom: 1.5rem;
            }
        }

        /* Tablets */
        @media (min-width: 768px) and (max-width: 1023px) {

            .main-container {
                padding-top: 4rem !important;
                padding-bottom: 6rem !important;
            }

            .main-title {
                font-size: 3.5rem !important;
            }

            .description {
                font-size: 1.05rem !important;
            }

            .footer {
                position: relative !important;
                bottom: auto !important;
                margin-top: -4rem;
                padding-bottom: 1.5rem;
            }
        }

        /* Prevent cards from overflowing */
        .features-card,
        .feature-item {
            min-width: 0;
        }

        /* Make long text wrap correctly */
        h1,
        h2,
        h3,
        p,
        span,
        a {
            overflow-wrap: break-word;
            word-wrap: break-word;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-900 text-white">

    <!-- Main Content -->
    <main
        class="main-container min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20"
    >

        <div class="content-wrapper w-full">

            <div
                class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 lg:gap-16 items-center"
            >

                <!-- ========================= -->
                <!-- LEFT SIDE -->
                <!-- ========================= -->
                <div class="w-full text-center lg:text-left">

                    <!-- Badge -->
                    <span
                        class="welcome-badge inline-block px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-300 text-xs sm:text-sm mb-5 sm:mb-6"
                    >
                        Payroll Management System
                    </span>

                    <!-- Title -->
                    <h1
                        class="main-title text-4xl sm:text-5xl md:text-6xl font-bold leading-tight mb-5 sm:mb-6"
                    >
                        Welcome to
                        <span class="text-indigo-400">
                            Pap Pay
                        </span>
                    </h1>

                    <!-- Description -->
                    <p
                        class="description text-gray-300 text-base sm:text-lg leading-7 sm:leading-8 mb-7 sm:mb-10 max-w-2xl mx-auto lg:mx-0"
                    >
                        A secure payroll management system designed for schools to
                        efficiently manage employees, attendance, payroll, leave requests,
                        and payslips in one centralized platform.
                    </p>

                    <!-- Login Button -->
                    <a
                        href="{{ route('login') }}"
                        class="login-button inline-flex items-center px-7 sm:px-8 py-3.5 sm:py-4 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 rounded-xl font-semibold text-base sm:text-lg transition duration-300 shadow-xl"
                    >
                        Login to System
                    </a>

                </div>


                <!-- ========================= -->
                <!-- RIGHT SIDE -->
                <!-- ========================= -->
                <div class="w-full flex justify-center">

                    <div
                        class="features-card bg-white/10 backdrop-blur-xl rounded-2xl sm:rounded-3xl p-5 sm:p-6 md:p-8 border border-white/10 shadow-2xl w-full max-w-lg"
                    >

                        <div class="space-y-4 sm:space-y-5 md:space-y-6">

                            <!-- Employee Management -->
                            <div
                                class="feature-item bg-white/5 rounded-xl p-4 sm:p-5"
                            >
                                <h3
                                    class="feature-title text-lg sm:text-xl font-semibold mb-2"
                                >
                                    Employee Management
                                </h3>

                                <p
                                    class="feature-description text-gray-300 text-xs sm:text-sm leading-6"
                                >
                                    Manage faculty, staff, maintenance personnel, and
                                    labor employees.
                                </p>
                            </div>


                            <!-- Payroll Processing -->
                            <div
                                class="feature-item bg-white/5 rounded-xl p-4 sm:p-5"
                            >
                                <h3
                                    class="feature-title text-lg sm:text-xl font-semibold mb-2"
                                >
                                    Payroll Processing
                                </h3>

                                <p
                                    class="feature-description text-gray-300 text-xs sm:text-sm leading-6"
                                >
                                    Generate accurate salaries, deductions, and payslips
                                    automatically.
                                </p>
                            </div>


                            <!-- Attendance & Leave -->
                            <div
                                class="feature-item bg-white/5 rounded-xl p-4 sm:p-5"
                            >
                                <h3
                                    class="feature-title text-lg sm:text-xl font-semibold mb-2"
                                >
                                    Attendance & Leave
                                </h3>

                                <p
                                    class="feature-description text-gray-300 text-xs sm:text-sm leading-6"
                                >
                                    Monitor attendance records and manage employee leave
                                    requests efficiently.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>


    <!-- Footer -->
    <footer
        class="footer fixed bottom-5 left-0 w-full text-center text-gray-400 text-xs sm:text-sm px-4"
    >
        © {{ date('Y') }} Pap Pay | School Payroll Management System
    </footer>

</body>
</html>
