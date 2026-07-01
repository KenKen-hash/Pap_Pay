<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pap Pay | School Payroll Management System</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Poppins',sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-900 text-white">

<div class="min-h-screen flex items-center justify-center px-6">

    <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-16 items-center">

        <!-- Left Side -->
        <div>

            <span class="inline-block px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-300 text-sm mb-6">
                Payroll Management System
            </span>

            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                Welcome to
                <span class="text-indigo-400">
                    Pap Pay
                </span>
            </h1>

            <p class="text-gray-300 text-lg leading-8 mb-10">
                A secure payroll management system designed for schools to
                efficiently manage employees, attendance, payroll, leave requests,
                and payslips in one centralized platform.
            </p>

            <a href="{{ route('login') }}"
               class="inline-flex items-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-semibold text-lg transition duration-300 shadow-xl">

                Login to System

            </a>

        </div>

        <!-- Right Side -->
        <div class="flex justify-center">

            <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/10 shadow-2xl w-full max-w-lg">

                <div class="space-y-6">

                    <div class="bg-white/5 rounded-xl p-5">
                        <h3 class="text-xl font-semibold mb-2">
                            Employee Management
                        </h3>

                        <p class="text-gray-300 text-sm">
                            Manage faculty, staff, maintenance personnel, and labor employees.
                        </p>
                    </div>

                    <div class="bg-white/5 rounded-xl p-5">
                        <h3 class="text-xl font-semibold mb-2">
                            Payroll Processing
                        </h3>

                        <p class="text-gray-300 text-sm">
                            Generate accurate salaries, deductions, and payslips automatically.
                        </p>
                    </div>

                    <div class="bg-white/5 rounded-xl p-5">
                        <h3 class="text-xl font-semibold mb-2">
                            Attendance & Leave
                        </h3>

                        <p class="text-gray-300 text-sm">
                            Monitor attendance records and manage employee leave requests efficiently.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<footer class="absolute bottom-5 w-full text-center text-gray-400 text-sm">
    © {{ date('Y') }} Pap Pay | School Payroll Management System
</footer>

</body>
</html>