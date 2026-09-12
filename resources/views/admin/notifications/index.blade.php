<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Pap Pay Notifications">

    <title>Notifications | Pap Pay</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <!-- Main Style -->
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">

    <style>

        /* =========================================================
           NOTIFICATIONS PAGE
        ========================================================= */

        body {
            background: #f6f8fb;
            color: #212529;
        }

        .notifications-page {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px 20px 50px;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .notifications-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .notifications-header-left {
            min-width: 0;
        }

        .notifications-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #212529;
        }

        .notifications-title-icon {
            width: 46px;
            height: 46px;
            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(13, 110, 253, 0.10);
            color: #0d6efd;

            border-radius: 12px;

            font-size: 22px;
        }

        .notifications-subtitle {
            margin: 7px 0 0 58px;
            color: #6c757d;
            font-size: 14px;
            line-height: 1.5;
        }


        /* =========================================================
           NOTIFICATION SUMMARY
        ========================================================= */

        .notification-summary {
            display: flex;
            align-items: center;
            gap: 10px;

            flex-shrink: 0;
        }

        .notification-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 34px;
            padding: 6px 13px;

            border-radius: 20px;

            background: #ffffff;
            border: 1px solid #e5e7eb;

            color: #495057;
            font-size: 13px;
            font-weight: 600;

            white-space: nowrap;
        }

        .notification-count.unread {
            background: rgba(13, 110, 253, 0.08);
            border-color: rgba(13, 110, 253, 0.18);
            color: #0d6efd;
        }


        /* =========================================================
           NOTIFICATION LIST
        ========================================================= */

        .notifications-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }


        /* =========================================================
           NOTIFICATION ITEM
        ========================================================= */

        .notification-item {
            position: relative;

            display: flex;
            align-items: flex-start;
            gap: 16px;

            width: 100%;

            padding: 20px;

            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 14px;

            text-decoration: none;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease,
                background-color 0.2s ease;

            overflow: hidden;
        }

        .notification-item:hover {
            transform: translateY(-2px);

            border-color: #d8dee6;

            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);

            background: #ffffff;
        }


        /* =========================================================
           UNREAD NOTIFICATION
        ========================================================= */

        .notification-item.unread {
            background: #f8fbff;
            border-color: rgba(13, 110, 253, 0.20);
        }

        .notification-item.unread:hover {
            border-color: rgba(13, 110, 253, 0.35);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.08);
        }

        .notification-item.unread::before {
            content: "";

            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;

            width: 4px;

            background: #0d6efd;
        }


        /* =========================================================
           NOTIFICATION ICON
        ========================================================= */

        .notification-icon {
            width: 46px;
            height: 46px;

            flex: 0 0 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: #f1f3f5;
            color: #6c757d;

            font-size: 19px;
        }

        .notification-item.unread .notification-icon {
            background: rgba(13, 110, 253, 0.10);
            color: #0d6efd;
        }


        /* =========================================================
           NOTIFICATION CONTENT
        ========================================================= */

        .notification-content {
            flex: 1 1 auto;
            min-width: 0;
        }

        .notification-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 6px;
        }

        .notification-title {
            margin: 0;

            color: #212529;

            font-size: 16px;
            font-weight: 650;
            line-height: 1.45;

            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .notification-item:not(.unread) .notification-title {
            font-weight: 600;
        }

        .notification-message {
            margin: 0;

            color: #6c757d;

            font-size: 14px;
            line-height: 1.6;

            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =========================================================
           TIME
        ========================================================= */

        .notification-time {
            flex-shrink: 0;

            color: #8a9199;

            font-size: 12px;
            line-height: 1.4;

            white-space: nowrap;
        }


        /* =========================================================
           READ / UNREAD INDICATOR
        ========================================================= */

        .notification-read-indicator {
            width: 7px;
            height: 7px;

            flex: 0 0 7px;

            margin-top: 7px;

            border-radius: 50%;

            background: #ced4da;
        }

        .notification-item.unread .notification-read-indicator {
            background: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.10);
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .notifications-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            min-height: 360px;

            padding: 50px 25px;

            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;

            text-align: center;
        }

        .notifications-empty-icon {
            width: 76px;
            height: 76px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 18px;

            border-radius: 50%;

            background: #f1f3f5;
            color: #adb5bd;

            font-size: 32px;
        }

        .notifications-empty h4 {
            margin: 0 0 7px;

            color: #343a40;

            font-size: 18px;
            font-weight: 650;
        }

        .notifications-empty p {
            max-width: 420px;

            margin: 0;

            color: #868e96;

            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================================================
           LARGE DESKTOP
        ========================================================= */

        @media (min-width: 1400px) {

            .notifications-page {
                max-width: 1200px;
                padding-top: 40px;
            }

            .notifications-title {
                font-size: 30px;
            }

            .notification-item {
                padding: 22px;
            }
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 991.98px) {

            .notifications-page {
                max-width: 100%;
                padding: 25px 18px 40px;
            }

            .notifications-header {
                margin-bottom: 20px;
            }

            .notifications-title {
                font-size: 25px;
            }

            .notifications-title-icon {
                width: 43px;
                height: 43px;
            }

            .notifications-subtitle {
                margin-left: 55px;
            }

            .notification-item {
                padding: 18px;
                gap: 14px;
            }

            .notification-icon {
                width: 44px;
                height: 44px;
                flex-basis: 44px;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767.98px) {

            .notifications-page {
                padding: 20px 14px 35px;
            }

            .notifications-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .notifications-title {
                font-size: 23px;
                gap: 10px;
            }

            .notifications-title-icon {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                font-size: 19px;
            }

            .notifications-subtitle {
                margin-left: 50px;
                font-size: 13px;
            }

            .notification-summary {
                width: 100%;
            }

            .notification-count {
                flex: 1;
                justify-content: center;
            }

            .notifications-list {
                gap: 10px;
            }

            .notification-item {
                padding: 16px;
                gap: 12px;
                border-radius: 12px;
            }

            .notification-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 10px;
                font-size: 17px;
            }

            .notification-top {
                display: block;
                margin-bottom: 5px;
            }

            .notification-title {
                font-size: 15px;
                line-height: 1.45;
            }

            .notification-message {
                font-size: 13px;
                line-height: 1.55;
            }

            .notification-time {
                display: block;
                margin-top: 7px;
                font-size: 11px;
            }

            .notification-read-indicator {
                width: 6px;
                height: 6px;
                flex-basis: 6px;
                margin-top: 6px;
            }

            .notifications-empty {
                min-height: 300px;
                padding: 40px 20px;
            }

            .notifications-empty-icon {
                width: 68px;
                height: 68px;
                font-size: 28px;
            }
        }


        /* =========================================================
           SMALL MOBILE
        ========================================================= */

        @media (max-width: 575.98px) {

            .notifications-page {
                padding: 16px 10px 30px;
            }

            .notifications-title {
                font-size: 21px;
            }

            .notifications-subtitle {
                margin-left: 49px;
                margin-top: 5px;
            }

            .notification-item {
                padding: 14px;
                gap: 10px;
            }

            .notification-icon {
                width: 36px;
                height: 36px;
                flex-basis: 36px;
                font-size: 15px;
            }

            .notification-title {
                font-size: 14px;
            }

            .notification-message {
                font-size: 12.5px;
            }

            .notification-time {
                font-size: 10.5px;
            }
        }


        /* =========================================================
           VERY SMALL SCREENS
        ========================================================= */

        @media (max-width: 380px) {

            .notifications-page {
                padding-left: 8px;
                padding-right: 8px;
            }

            .notifications-title {
                font-size: 19px;
            }

            .notifications-title-icon {
                width: 36px;
                height: 36px;
                font-size: 17px;
            }

            .notifications-subtitle {
                margin-left: 46px;
                font-size: 12px;
            }

            .notification-item {
                padding: 12px;
            }

            .notification-icon {
                width: 34px;
                height: 34px;
                flex-basis: 34px;
                font-size: 14px;
            }

            .notification-title {
                font-size: 13px;
            }

            .notification-message {
                font-size: 12px;
            }
        }


        /* =========================================================
           REDUCE MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            .notification-item {
                transition: none;
            }

            .notification-item:hover {
                transform: none;
            }
        }

    </style>

</head>


<body>

    <main class="notifications-page">

        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="notifications-header">

            <div class="notifications-header-left">

                <h1 class="notifications-title">

                    <span class="notifications-title-icon">
                        <i class="bi bi-bell"></i>
                    </span>

                    <span>Notifications</span>

                </h1>

                <p class="notifications-subtitle">
                    Stay updated with the latest activities and important updates.
                </p>

            </div>


            <!-- Notification Summary -->

            <div class="notification-summary">

                @php
                    $totalNotifications = $notifications->count();
                    $unreadNotifications = $notifications->where('is_read', false)->count();
                @endphp

                <span class="notification-count">

                    {{ $totalNotifications }}

                    {{ $totalNotifications === 1 ? 'Notification' : 'Notifications' }}

                </span>

                @if($unreadNotifications > 0)

                    <span class="notification-count unread">

                        <i class="bi bi-circle-fill me-1"
                           style="font-size: 6px;"></i>

                        {{ $unreadNotifications }} Unread

                    </span>

                @endif

            </div>

        </div>


        <!-- =====================================================
             NOTIFICATION LIST
        ====================================================== -->

        @forelse($notifications as $notification)

            <div class="notifications-list">

                <a href="{{ route('admin.notifications.read', $notification->id) }}"
                   class="notification-item {{ !$notification->is_read ? 'unread' : '' }}">

                    <!-- Notification Icon -->

                    <div class="notification-icon">

                        @if(!$notification->is_read)

                            <i class="bi bi-bell-fill"></i>

                        @else

                            <i class="bi bi-bell"></i>

                        @endif

                    </div>


                    <!-- Notification Content -->

                    <div class="notification-content">

                        <div class="notification-top">

                            <h5 class="notification-title">
                                {{ $notification->title }}
                            </h5>

                            <span class="notification-time">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>

                        </div>


                        <p class="notification-message">
                            {{ $notification->message }}
                        </p>

                    </div>


                    <!-- Read / Unread Indicator -->

                    <span class="notification-read-indicator"></span>

                </a>

            </div>

        @empty

            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <div class="notifications-empty">

                <div class="notifications-empty-icon">

                    <i class="bi bi-bell-slash"></i>

                </div>

                <h4>
                    No notifications yet
                </h4>

                <p>
                    You're all caught up. New notifications and important
                    updates will appear here.
                </p>

            </div>

        @endforelse

    </main>


    <!-- Bootstrap JS -->

    <script src="../../../../khen/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
