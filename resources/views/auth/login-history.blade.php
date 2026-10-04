<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login History</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f4f7fb;
            color: #1f2937;
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
            padding: 9px 15px;
            border: 1px solid #dbe2ea;
            border-radius: 9px;
            background: #ffffff;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .back-button:hover {
            background: #f8fafc;
            color: #111827;
            border-color: #cbd5e1;
        }

        .page-title {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
            color: #111827;
        }

        .page-description {
            margin: 8px 0 0;
            color: #6b7280;
            font-size: 15px;
        }

        .account-card {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
        }

        .account-icon {
            width: 50px;
            height: 50px;
            flex: 0 0 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 22px;
        }

        .account-name {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: #111827;
        }

        .account-role {
            margin-top: 4px;
            color: #6b7280;
            font-size: 13px;
            text-transform: capitalize;
        }

        .history-card {
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
        }

        .history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .history-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #111827;
        }

        .history-count {
            padding: 5px 10px;
            border-radius: 20px;
            background: #f3f4f6;
            color: #4b5563;
            font-size: 12px;
            font-weight: 600;
        }

        .history-list {
            width: 100%;
        }

        .history-item {
            display: grid;
            grid-template-columns: 56px minmax(0, 1fr) auto;
            align-items: center;
            gap: 18px;
            padding: 22px;
            border-bottom: 1px solid #eef0f3;
        }

        .history-item:last-child {
            border-bottom: 0;
        }

        .device-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #f3f4f6;
            color: #374151;
            font-size: 21px;
        }

        .device-title {
            margin: 0 0 5px;
            color: #111827;
            font-size: 16px;
            font-weight: 700;
        }

        .device-details {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            color: #6b7280;
            font-size: 13px;
        }

        .detail-item {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .detail-separator {
            color: #cbd5e1;
        }

        .ip-address {
            margin-top: 9px;
            color: #4b5563;
            font-size: 13px;
        }

        .login-time {
            text-align: right;
            white-space: nowrap;
        }

        .login-time-label {
            margin-bottom: 4px;
            color: #9ca3af;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .login-time-value {
            color: #374151;
            font-size: 13px;
            font-weight: 600;
        }

        .empty-state {
            padding: 60px 25px;
            text-align: center;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: #f3f4f6;
            color: #9ca3af;
            font-size: 27px;
        }

        .empty-state h3 {
            margin: 0 0 7px;
            color: #374151;
            font-size: 18px;
            font-weight: 700;
        }

        .empty-state p {
            margin: 0;
            color: #9ca3af;
            font-size: 14px;
        }

        @media (max-width: 700px) {

            .page-wrapper {
                padding: 25px 14px 40px;
            }

            .page-title {
                font-size: 25px;
            }

            .history-item {
                grid-template-columns: 46px minmax(0, 1fr);
                gap: 14px;
                padding: 18px;
            }

            .device-icon {
                width: 46px;
                height: 46px;
                font-size: 19px;
            }

            .login-time {
                grid-column: 2;
                text-align: left;
                margin-top: -5px;
            }

            .history-header {
                padding: 17px;
            }

            .account-card {
                padding: 17px;
            }
        }

        @media (max-width: 420px) {

            .device-details {
                display: block;
            }

            .detail-item {
                margin-bottom: 4px;
            }

            .detail-separator {
                display: none;
            }

            .history-item {
                padding: 16px;
            }
        }

    </style>

</head>

<body>

<div class="page-wrapper">

    <div class="page-header">

        <a
            href="{{ url()->previous() }}"
            class="back-button"
        >
            <i class="bi bi-arrow-left"></i>
            Back
        </a>

        <h1 class="page-title">
            Login History
        </h1>

        <p class="page-description">
            Review where and when your account has been used to log in.
        </p>

    </div>


    <div class="account-card">

        <div class="account-icon">
            <i class="bi bi-shield-lock"></i>
        </div>

        <div>

            <p class="account-name">
                {{ Auth::user()->name }}
            </p>

            <div class="account-role">
                {{ Auth::user()->role }}
            </div>

        </div>

    </div>


    <div class="history-card">

        <div class="history-header">

            <h2>
                Recent Login Activity
            </h2>

            <span class="history-count">
                {{ $loginHistories->count() }}
                {{ $loginHistories->count() === 1 ? 'Login' : 'Logins' }}
            </span>

        </div>


        @if ($loginHistories->count())

            <div class="history-list">

                @foreach ($loginHistories as $history)

                    @php

                        $deviceIcon = match ($history->device) {
                            'Mobile' => 'bi-phone',
                            'Tablet' => 'bi-tablet',
                            default => 'bi-display'
                        };

                    @endphp

                    <div class="history-item">

                        <div class="device-icon">
                            <i class="bi {{ $deviceIcon }}"></i>
                        </div>


                        <div>

                            <h3 class="device-title">
                                {{ $history->browser ?? 'Unknown Browser' }}
                            </h3>

                            <div class="device-details">

                                <span class="detail-item">
                                    <i class="bi bi-window"></i>
                                    {{ $history->platform ?? 'Unknown Platform' }}
                                </span>

                                <span class="detail-separator">
                                    •
                                </span>

                                <span class="detail-item">
                                    <i class="bi bi-pc-display"></i>
                                    {{ $history->device ?? 'Unknown Device' }}
                                </span>

                            </div>

                            <div class="ip-address">
                                <i class="bi bi-globe2"></i>
                                IP Address:
                                <strong>
                                    {{ $history->ip_address ?? 'Unavailable' }}
                                </strong>
                            </div>

                        </div>


                        <div class="login-time">

                            <div class="login-time-label">
                                Logged in
                            </div>

                            <div class="login-time-value">
                                {{ $history->login_at?->format('M d, Y') }}
                            </div>

                            <div class="login-time-value">
                                {{ $history->login_at?->format('h:i A') }}
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <h3>
                    No login history
                </h3>

                <p>
                    There are no login records for this account yet.
                </p>

            </div>

        @endif

    </div>

</div>

</body>

</html>
