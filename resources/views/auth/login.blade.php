
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="PAP PAY Payroll Management System">

    <title>PAP PAY | Payroll Management System</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: [
                            'Inter',
                            'ui-sans-serif',
                            'system-ui',
                            '-apple-system',
                            'BlinkMacSystemFont',
                            '"Segoe UI"',
                            'sans-serif'
                        ],
                    },

                    animation: {
                        'float': 'float 8s ease-in-out infinite',
                        'float-reverse': 'floatReverse 9s ease-in-out infinite',
                        'pulse-soft': 'pulseSoft 3s ease-in-out infinite',
                    },

                    keyframes: {

                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-18px)'
                            }
                        },

                        floatReverse: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(18px)'
                            }
                        },

                        pulseSoft: {
                            '0%, 100%': {
                                opacity: '0.4'
                            },
                            '50%': {
                                opacity: '1'
                            }
                        }
                    }
                }
            }
        }
    </script>


    <style>

        /* =========================================================
           BASE
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: #1e293b;

            overflow-x: hidden;
        }


        /* =========================================================
           LIGHT FUTURISTIC BACKGROUND
        ========================================================= */

        .page-background {

            background:
                radial-gradient(
                    circle at 8% 10%,
                    rgba(59, 130, 246, 0.14),
                    transparent 28%
                ),

                radial-gradient(
                    circle at 92% 12%,
                    rgba(14, 165, 233, 0.13),
                    transparent 28%
                ),

                radial-gradient(
                    circle at 80% 90%,
                    rgba(99, 102, 241, 0.10),
                    transparent 30%
                ),

                linear-gradient(
                    135deg,
                    #f8fbff 0%,
                    #eef6ff 50%,
                    #f9fbff 100%
                );
        }


        /* =========================================================
           BACKGROUND GRID
        ========================================================= */

        .grid-background {

            background-image:
                linear-gradient(
                    rgba(37, 99, 235, 0.045) 1px,
                    transparent 1px
                ),

                linear-gradient(
                    90deg,
                    rgba(37, 99, 235, 0.045) 1px,
                    transparent 1px
                );

            background-size: 44px 44px;

            mask-image:
                radial-gradient(
                    ellipse at center,
                    black 15%,
                    transparent 80%
                );

            -webkit-mask-image:
                radial-gradient(
                    ellipse at center,
                    black 15%,
                    transparent 80%
                );
        }


        /* =========================================================
           MAIN CARD
        ========================================================= */

        .main-card {

            background:
                rgba(255, 255, 255, 0.88);

            border:
                1px solid rgba(148, 163, 184, 0.18);

            box-shadow:
                0 35px 90px rgba(30, 64, 175, 0.10),
                0 10px 35px rgba(15, 23, 42, 0.05);

            backdrop-filter:
                blur(24px);

            -webkit-backdrop-filter:
                blur(24px);
        }


        /* =========================================================
           TOP ACCENT
        ========================================================= */

        .top-accent {

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    #60a5fa,
                    #22d3ee,
                    #818cf8,
                    transparent
                );
        }


        /* =========================================================
           LOGO
        ========================================================= */

        .logo-box {

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #4f46e5
                );

            box-shadow:
                0 12px 30px rgba(37, 99, 235, 0.22),
                0 0 0 5px rgba(59, 130, 246, 0.06);
        }


        /* =========================================================
           FEATURE CARDS
        ========================================================= */

        .feature-card {

            background:
                rgba(248, 250, 252, 0.90);

            border:
                1px solid #e2e8f0;

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease,
                background 0.25s ease;
        }


        .feature-card:hover {

            transform:
                translateY(-3px);

            background:
                #ffffff;

            border-color:
                #bfdbfe;

            box-shadow:
                0 14px 30px rgba(37, 99, 235, 0.08);
        }


        /* =========================================================
           LOGIN PANEL
        ========================================================= */

        .login-panel {

            background:
                rgba(255, 255, 255, 0.95);

            border:
                1px solid #e2e8f0;

            box-shadow:
                0 20px 45px rgba(15, 23, 42, 0.06);
        }


        /* =========================================================
           INPUTS
        ========================================================= */

        .login-input {

            background:
                #ffffff;

            border:
                1px solid #cbd5e1;

            color:
                #0f172a;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .login-input:hover {

            border-color:
                #94a3b8;
        }


        .login-input:focus {

            outline:
                none;

            border-color:
                #3b82f6;

            background:
                #ffffff;

            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.10);
        }


        .login-input::placeholder {

            color:
                #94a3b8;
        }


        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .login-button {

            position:
                relative;

            overflow:
                hidden;

            background:
                linear-gradient(
                    100deg,
                    #2563eb,
                    #4f46e5
                );

            box-shadow:
                0 12px 25px rgba(37, 99, 235, 0.20);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                filter 0.2s ease;
        }


        .login-button::before {

            content:
                "";

            position:
                absolute;

            top:
                0;

            left:
                -120%;

            width:
                70%;

            height:
                100%;

            transform:
                skewX(-20deg);

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,0.25),
                    transparent
                );

            transition:
                left 0.65s ease;
        }


        .login-button:hover::before {

            left:
                140%;
        }


        .login-button:hover {

            transform:
                translateY(-2px);

            filter:
                brightness(1.05);

            box-shadow:
                0 16px 32px rgba(37, 99, 235, 0.25);
        }


        .login-button:active {

            transform:
                scale(0.985);
        }


        /* =========================================================
           STATUS DOT
        ========================================================= */

        .status-dot {

            box-shadow:
                0 0 0 4px rgba(34, 197, 94, 0.08),
                0 0 14px rgba(34, 197, 94, 0.45);
        }


        /* =========================================================
           DECORATIVE ORBS
        ========================================================= */

        .blue-orb {

            background:
                rgba(59, 130, 246, 0.12);

            filter:
                blur(85px);
        }


        .cyan-orb {

            background:
                rgba(6, 182, 212, 0.10);

            filter:
                blur(95px);
        }


        .violet-orb {

            background:
                rgba(99, 102, 241, 0.09);

            filter:
                blur(100px);
        }


        /* =========================================================
           SYSTEM LINE
        ========================================================= */

        .system-line {

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(59, 130, 246, 0.30),
                    transparent
                );
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1023px) {

            .main-card {
                max-width: 760px;
            }

        }


        @media (max-width: 639px) {

            .grid-background {

                background-size:
                    28px 28px;
            }


            .main-card {

                border-radius:
                    22px;
            }


            .feature-card {

                padding:
                    14px;
            }

        }


        @media (max-width: 380px) {

            .main-card {

                border-radius:
                    18px;
            }

        }


        @media (max-height: 700px) {

            .page-container {

                padding-top:
                    25px;

                padding-bottom:
                    70px;
            }

        }


        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                animation-duration:
                    0.01ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    0.01ms !important;
            }

        }

    </style>

</head>


<body class="page-background">


    <!-- =========================================================
         BACKGROUND DECORATION
    ========================================================== -->

    <div class="fixed inset-0 pointer-events-none overflow-hidden">


        <!-- Grid -->

        <div class="grid-background absolute inset-0"></div>


        <!-- Blue Orb -->

        <div
            class="blue-orb
                   absolute
                   -top-32
                   -left-32
                   w-72
                   h-72
                   sm:w-[28rem]
                   sm:h-[28rem]
                   rounded-full
                   animate-float">
        </div>


        <!-- Cyan Orb -->

        <div
            class="cyan-orb
                   absolute
                   top-1/4
                   -right-40
                   w-80
                   h-80
                   sm:w-[32rem]
                   sm:h-[32rem]
                   rounded-full
                   animate-float-reverse">
        </div>


        <!-- Violet Orb -->

        <div
            class="violet-orb
                   absolute
                   -bottom-40
                   left-1/3
                   w-80
                   h-80
                   sm:w-[34rem]
                   sm:h-[34rem]
                   rounded-full
                   animate-float">
        </div>


        <!-- Small Decorative Dots -->

        <div class="absolute top-[15%] left-[7%]">

            <span
                class="block
                       w-1.5
                       h-1.5
                       rounded-full
                       bg-blue-400
                       status-dot
                       animate-pulse-soft">
            </span>

        </div>


        <div class="absolute top-[30%] right-[9%]">

            <span
                class="block
                       w-1.5
                       h-1.5
                       rounded-full
                       bg-cyan-400
                       animate-pulse-soft">
            </span>

        </div>


        <div class="absolute bottom-[22%] left-[9%]">

            <span
                class="block
                       w-1
                       h-1
                       rounded-full
                       bg-indigo-400
                       animate-pulse-soft">
            </span>

        </div>


        <div class="absolute bottom-[14%] right-[16%]">

            <span
                class="block
                       w-1.5
                       h-1.5
                       rounded-full
                       bg-blue-400
                       animate-pulse-soft">
            </span>

        </div>

    </div>



    <!-- =========================================================
         MAIN PAGE
    ========================================================== -->

    <main
        class="page-container
               relative
               z-10
               min-h-screen
               flex
               items-center
               justify-center
               px-3
               py-6
               sm:px-6
               sm:py-10
               lg:px-8">


        <div
            class="w-full
                   max-w-6xl">


            <!-- =================================================
                 MAIN CARD
            ================================================== -->

            <div
                class="main-card
                       relative
                       rounded-3xl
                       overflow-hidden">


                <!-- Top accent -->

                <div
                    class="absolute
                           top-0
                           left-0
                           right-0
                           h-1
                           top-accent">
                </div>



                <!-- =================================================
                     CONTENT
                ================================================== -->

                <div
                    class="grid
                           grid-cols-1
                           lg:grid-cols-12">


                    <!-- =============================================
                         LEFT INFORMATION
                    ============================================== -->

                    <section
                        class="lg:col-span-7
                               relative
                               p-6
                               sm:p-10
                               md:p-12
                               lg:p-14
                               xl:p-16
                               flex
                               flex-col
                               justify-center
                               overflow-hidden">


                        <!-- Decorative glow -->

                        <div
                            class="absolute
                                   -top-32
                                   -left-32
                                   w-80
                                   h-80
                                   rounded-full
                                   bg-blue-500/10
                                   blur-3xl">
                        </div>


                        <div
                            class="relative
                                   z-10">


                            <!-- =====================================
                                 BRAND
                            ====================================== -->

                            <div
                                class="flex
                                       items-center
                                       gap-3
                                       mb-8">


                                <!-- Logo -->

                                <div
                                    class="logo-box
                                           w-12
                                           h-12
                                           sm:w-14
                                           sm:h-14
                                           rounded-2xl
                                           flex
                                           items-center
                                           justify-center
                                           flex-shrink-0">


                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 sm:w-7 sm:h-7 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9.5" />

                                        <path
                                            stroke-linecap="round"
                                            d="M12 7v10" />

                                        <path
                                            stroke-linecap="round"
                                            d="M8.5 9.5c0-1.1 1.57-2 3.5-2s3.5.9 3.5 2-1.57 2-3.5 2-3.5.9-3.5 2 1.57 2 3.5 2 3.5-.9 3.5-2" />

                                    </svg>

                                </div>


                                <div>

                                    <div
                                        class="text-xl
                                               sm:text-2xl
                                               font-black
                                               tracking-tight
                                               text-slate-900">

                                        PAP
                                        <span class="text-blue-600">
                                            PAY
                                        </span>

                                    </div>


                                    <div
                                        class="text-[9px]
                                               sm:text-[10px]
                                               uppercase
                                               tracking-[0.18em]
                                               font-bold
                                               text-slate-400">

                                        Payroll Management System

                                    </div>

                                </div>

                            </div>



                            <!-- =====================================
                                 SYSTEM STATUS
                            ====================================== -->

                            <div
                                class="inline-flex
                                       items-center
                                       gap-2
                                       px-3
                                       py-1.5
                                       rounded-full
                                       bg-emerald-50
                                       border
                                       border-emerald-100
                                       mb-6">


                                <span
                                    class="w-1.5
                                           h-1.5
                                           rounded-full
                                           bg-emerald-500
                                           status-dot
                                           animate-pulse">
                                </span>


                                <span
                                    class="text-[9px]
                                           sm:text-[10px]
                                           uppercase
                                           tracking-[0.2em]
                                           font-bold
                                           text-emerald-600">

                                    System Online

                                </span>

                            </div>



                            <!-- =====================================
                                 MAIN HEADING
                            ====================================== -->

                            <div
                                class="max-w-2xl">


                                <h1
                                    class="text-3xl
                                           sm:text-4xl
                                           md:text-5xl
                                           lg:text-5xl
                                           xl:text-6xl
                                           font-black
                                           tracking-tight
                                           leading-[1.05]
                                           text-slate-900">

                                    Payroll made
                                    <br>

                                    <span
                                        class="text-transparent
                                               bg-clip-text
                                               bg-gradient-to-r
                                               from-blue-600
                                               via-indigo-600
                                               to-cyan-500">

                                        simple.

                                    </span>

                                </h1>


                                <p
                                    class="mt-5
                                           text-sm
                                           sm:text-base
                                           leading-7
                                           text-slate-500
                                           max-w-xl">

                                    Manage employees, attendance, salary,
                                    benefits, and payslips in one secure
                                    and easy-to-use system.

                                </p>

                            </div>



                            <!-- =====================================
                                 FEATURES
                            ====================================== -->

                            <div
                                class="mt-8
                                       sm:mt-10
                                       grid
                                       grid-cols-1
                                       sm:grid-cols-3
                                       gap-3">


                                <!-- Attendance -->

                                <div
                                    class="feature-card
                                           rounded-2xl
                                           p-4">


                                    <div
                                        class="w-9
                                               h-9
                                               rounded-xl
                                               bg-blue-50
                                               text-blue-600
                                               flex
                                               items-center
                                               justify-center
                                               mb-3">


                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.7">

                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="17"
                                                rx="2" />

                                            <path
                                                stroke-linecap="round"
                                                d="M8 2v4M16 2v4M3 9h18" />

                                        </svg>

                                    </div>


                                    <p
                                        class="text-xs
                                               font-bold
                                               text-slate-800">

                                        Attendance

                                    </p>


                                    <p
                                        class="text-[10px]
                                               sm:text-[11px]
                                               text-slate-500
                                               mt-1">

                                        Track work time

                                    </p>

                                </div>



                                <!-- Salary -->

                                <div
                                    class="feature-card
                                           rounded-2xl
                                           p-4">


                                    <div
                                        class="w-9
                                               h-9
                                               rounded-xl
                                               bg-indigo-50
                                               text-indigo-600
                                               flex
                                               items-center
                                               justify-center
                                               mb-3">


                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.7">

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9" />

                                            <path
                                                stroke-linecap="round"
                                                d="M12 7v10" />

                                            <path
                                                stroke-linecap="round"
                                                d="M8.5 9.5c0-1.1 1.57-2 3.5-2s3.5.9 3.5 2-1.57 2-3.5 2-3.5.9-3.5 2 1.57 2 3.5 2 3.5-.9 3.5-2" />

                                        </svg>

                                    </div>


                                    <p
                                        class="text-xs
                                               font-bold
                                               text-slate-800">

                                        Salary

                                    </p>


                                    <p
                                        class="text-[10px]
                                               sm:text-[11px]
                                               text-slate-500
                                               mt-1">

                                        Manage payroll

                                    </p>

                                </div>



                                <!-- Payslip -->

                                <div
                                    class="feature-card
                                           rounded-2xl
                                           p-4">


                                    <div
                                        class="w-9
                                               h-9
                                               rounded-xl
                                               bg-cyan-50
                                               text-cyan-600
                                               flex
                                               items-center
                                               justify-center
                                               mb-3">


                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.7">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 3h9l4 4v14H6a2 2 0 01-2-2V5a2 2 0 012-2z" />

                                            <path
                                                stroke-linecap="round"
                                                d="M15 3v5h5" />

                                            <path
                                                stroke-linecap="round"
                                                d="M8 12h7M8 16h7" />

                                        </svg>

                                    </div>


                                    <p
                                        class="text-xs
                                               font-bold
                                               text-slate-800">

                                        Payslip

                                    </p>


                                    <p
                                        class="text-[10px]
                                               sm:text-[11px]
                                               text-slate-500
                                               mt-1">

                                        View salary details

                                    </p>

                                </div>

                            </div>



                            <!-- =====================================
                                 SYSTEM LINE
                            ====================================== -->

                            <div
                                class="mt-8
                                       sm:mt-10
                                       flex
                                       items-center
                                       gap-3">


                                <div
                                    class="h-px
                                           flex-1
                                           system-line">
                                </div>


                                <span
                                    class="text-[8px]
                                           sm:text-[9px]
                                           uppercase
                                           tracking-[0.25em]
                                           text-slate-400
                                           font-bold
                                           whitespace-nowrap">

                                    Secure Payroll Platform

                                </span>


                                <div
                                    class="h-px
                                           flex-1
                                           system-line">
                                </div>

                            </div>

                        </div>

                    </section>



                    <!-- =============================================
                         LOGIN SECTION
                    ============================================== -->

                    <section
                        class="lg:col-span-5
                               relative
                               p-5
                               sm:p-8
                               md:p-10
                               lg:p-10
                               xl:p-12
                               flex
                               items-center
                               border-t
                               lg:border-t-0
                               lg:border-l
                               border-slate-200">


                        <!-- Background glow -->

                        <div
                            class="absolute
                                   -top-32
                                   -right-32
                                   w-80
                                   h-80
                                   rounded-full
                                   bg-blue-500/5
                                   blur-3xl
                                   pointer-events-none">
                        </div>



                        <!-- LOGIN PANEL -->

                        <div
                            class="login-panel
                                   relative
                                   w-full
                                   rounded-3xl
                                   p-6
                                   sm:p-8
                                   md:p-9
                                   xl:p-10">


                            <!-- Small top accent -->

                            <div
                                class="absolute
                                       top-0
                                       left-8
                                       right-8
                                       h-px
                                       bg-gradient-to-r
                                       from-transparent
                                       via-blue-400
                                       to-transparent">
                            </div>



                            <!-- =====================================
                                 LOGIN HEADER
                            ====================================== -->

                            <div
                                class="mb-7">


                                <h2
                                    class="text-2xl
                                           sm:text-3xl
                                           font-black
                                           tracking-tight
                                           text-slate-900">

                                    Sign in

                                </h2>


                                <p
                                    class="text-sm
                                           text-slate-500
                                           mt-2
                                           leading-6">

                                    Enter your account details to continue.

                                </p>

                            </div>



                            <!-- =====================================
                                 STATUS MESSAGE
                            ====================================== -->

                            @if (session('status'))

                                <div
                                    class="mb-6
                                           rounded-xl
                                           border
                                           border-emerald-200
                                           bg-emerald-50
                                           p-4
                                           flex
                                           items-start
                                           gap-3">


                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-emerald-600 flex-shrink-0"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 13l4 4L19 7" />

                                    </svg>


                                    <p
                                        class="text-sm
                                               leading-5
                                               text-emerald-700">

                                        {{ session('status') }}

                                    </p>

                                </div>

                            @endif



                            <!-- =====================================
                                 LOGIN FORM
                            ====================================== -->

                            <form
                                method="POST"
                                action="{{ route('login') }}"
                                class="space-y-5">

                                @csrf


                                <!-- =================================
                                     EMAIL
                                ================================== -->

                                <div>

                                    <label
                                        for="email"
                                        class="block
                                               text-sm
                                               font-semibold
                                               text-slate-700
                                               mb-2">

                                        Email Address

                                    </label>


                                    <div
                                        class="relative">


                                        <!-- Email icon -->

                                        <div
                                            class="absolute
                                                   inset-y-0
                                                   left-0
                                                   pl-4
                                                   flex
                                                   items-center
                                                   pointer-events-none">


                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 text-slate-400"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.7">

                                                <rect
                                                    x="3"
                                                    y="5"
                                                    width="18"
                                                    height="14"
                                                    rx="2" />

                                                <path
                                                    stroke-linecap="round"
                                                    d="M4 7l8 6 8-6" />

                                            </svg>

                                        </div>


                                        <input
                                            id="email"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autofocus
                                            autocomplete="username"
                                            placeholder="Enter your email"
                                            class="login-input
                                                   w-full
                                                   rounded-xl
                                                   pl-12
                                                   pr-4
                                                   py-3.5
                                                   sm:py-4
                                                   text-sm
                                                   font-medium" />

                                    </div>


                                    @if ($errors->has('email'))

                                        <p
                                            class="mt-2
                                                   text-xs
                                                   font-medium
                                                   text-red-600">

                                            {{ $errors->first('email') }}

                                        </p>

                                    @endif

                                </div>



                                <!-- =================================
                                     PASSWORD
                                ================================== -->

                                <div>


                                    <label
                                        for="password"
                                        class="block
                                               text-sm
                                               font-semibold
                                               text-slate-700
                                               mb-2">

                                        Password

                                    </label>


                                    <div
                                        class="relative">


                                        <!-- Lock icon -->

                                        <div
                                            class="absolute
                                                   inset-y-0
                                                   left-0
                                                   pl-4
                                                   flex
                                                   items-center
                                                   pointer-events-none">


                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 text-slate-400"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.7">

                                                <rect
                                                    x="4"
                                                    y="10"
                                                    width="16"
                                                    height="10"
                                                    rx="2" />

                                                <path
                                                    stroke-linecap="round"
                                                    d="M8 10V7a4 4 0 018 0v3" />

                                            </svg>

                                        </div>


                                        <input
                                            id="password"
                                            type="password"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            placeholder="Enter your password"
                                            class="login-input
                                                   w-full
                                                   rounded-xl
                                                   pl-12
                                                   pr-12
                                                   py-3.5
                                                   sm:py-4
                                                   text-sm
                                                   font-medium" />


                                        <!-- Show password -->

                                        <button
                                            type="button"
                                            id="togglePassword"
                                            class="absolute
                                                   inset-y-0
                                                   right-0
                                                   px-4
                                                   flex
                                                   items-center
                                                   text-slate-400
                                                   hover:text-blue-600
                                                   transition"
                                            aria-label="Show password">


                                            <!-- Eye open -->

                                            <svg
                                                id="eyeOpen"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.7">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z" />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="2.5" />

                                            </svg>


                                            <!-- Eye closed -->

                                            <svg
                                                id="eyeClosed"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 hidden"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.7">

                                                <path
                                                    stroke-linecap="round"
                                                    d="M3 3l18 18" />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M10.6 10.6a2 2 0 002.8 2.8" />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M9.9 5.3A10.8 10.8 0 0112 5c6 0 9.5 7 9.5 7a18 18 0 01-3.1 3.9" />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6.2 6.2C3.8 8 2.5 12 2.5 12a17.8 17.8 0 004.7 5.2A9.9 9.9 0 0012 19c1.1 0 2.1-.2 3-.5" />

                                            </svg>

                                        </button>

                                    </div>


                                    @if ($errors->has('password'))

                                        <p
                                            class="mt-2
                                                   text-xs
                                                   font-medium
                                                   text-red-600">

                                            {{ $errors->first('password') }}

                                        </p>

                                    @endif

                                </div>



                                <!-- =================================
                                     REMEMBER ME
                                ================================== -->

                                <div>

                                    <label
                                        class="inline-flex
                                               items-center
                                               cursor-pointer
                                               select-none">


                                        <input
                                            id="remember_me"
                                            type="checkbox"
                                            name="remember"
                                            class="w-4
                                                   h-4
                                                   rounded
                                                   border-slate-300
                                                   text-blue-600
                                                   focus:ring-blue-500">


                                        <span
                                            class="ml-2.5
                                                   text-sm
                                                   text-slate-500">

                                            Remember me

                                        </span>

                                    </label>

                                </div>



                                <!-- =================================
                                     SIGN IN BUTTON
                                ================================== -->

                                <button
                                    type="submit"
                                    class="login-button
                                           w-full
                                           flex
                                           items-center
                                           justify-center
                                           gap-2
                                           rounded-xl
                                           py-3.5
                                           sm:py-4
                                           px-6
                                           text-sm
                                           font-bold
                                           text-white">


                                    <span>
                                        Sign In
                                    </span>


                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12h14M13 6l6 6-6 6" />

                                    </svg>

                                </button>

                            </form>



                            <!-- =====================================
                                 SECURITY NOTE
                            ====================================== -->

                            <div
                                class="mt-7
                                       pt-6
                                       border-t
                                       border-slate-100">


                                <div
                                    class="flex
                                           items-center
                                           justify-center
                                           gap-2">


                                    <span
                                        class="flex
                                               items-center
                                               justify-center
                                               w-5
                                               h-5
                                               rounded-full
                                               bg-emerald-50
                                               text-emerald-600">


                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-3 h-3"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2.5">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 13l4 4L19 7" />

                                        </svg>

                                    </span>


                                    <span
                                        class="text-[11px]
                                               text-slate-400">

                                        Your account is secure

                                    </span>

                                </div>

                            </div>

                        </div>

                    </section>

                </div>

            </div>



            <!-- =================================================
                 FOOTER
            ================================================== -->

            <footer
                class="mt-5
                       sm:mt-6
                       text-center
                       px-4">


                <div
                    class="flex
                           flex-wrap
                           items-center
                           justify-center
                           gap-x-3
                           gap-y-1
                           text-[9px]
                           sm:text-[10px]
                           uppercase
                           tracking-[0.15em]
                           text-slate-400
                           font-semibold">


                    <span>
                        PAP PAY
                    </span>


                    <span class="text-slate-300">
                        /
                    </span>


                    <span>
                        Payroll Management
                    </span>


                    <span class="text-slate-300">
                        /
                    </span>


                    <span>
                        Secure System
                    </span>

                </div>


                <p
                    class="mt-2
                           text-[9px]
                           sm:text-[10px]
                           text-slate-400">

                    © {{ date('Y') }} PAP PAY. All rights reserved.

                </p>

            </footer>


        </div>

    </main>



    <!-- =========================================================
         PASSWORD TOGGLE
    ========================================================== -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const passwordInput =
                document.getElementById('password');

            const togglePassword =
                document.getElementById('togglePassword');

            const eyeOpen =
                document.getElementById('eyeOpen');

            const eyeClosed =
                document.getElementById('eyeClosed');


            if (
                passwordInput &&
                togglePassword &&
                eyeOpen &&
                eyeClosed
            ) {

                togglePassword.addEventListener(
                    'click',
                    function () {

                        const isHidden =
                            passwordInput.type === 'password';


                        passwordInput.type =
                            isHidden
                                ? 'text'
                                : 'password';


                        eyeOpen.classList.toggle(
                            'hidden',
                            isHidden
                        );


                        eyeClosed.classList.toggle(
                            'hidden',
                            !isHidden
                        );


                        togglePassword.setAttribute(
                            'aria-label',
                            isHidden
                                ? 'Hide password'
                                : 'Show password'
                        );

                    }
                );

            }

        });

    </script>

</body>

</html>
