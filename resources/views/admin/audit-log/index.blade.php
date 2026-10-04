<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Pap Pay administrator activity log"
    >

    <title>Activity Log | Pap Pay</title>

    <!-- Bootstrap -->
    <link
        rel="stylesheet"
        href="../../../../khen/assets/css/bootstrap.min.css"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css"
    >

    <!-- Main Style -->
    <link
        rel="stylesheet"
        href="../../../../khen/assets/css/style.css"
    >

    <style>

        body {
            background: #f4f7fb;
            font-family: Inter, Arial, sans-serif;
        }

        .activity-page {
            max-width: 1050px;
            margin: 0 auto;
            padding: 35px 20px 50px;
        }

        .activity-header {
            background: #ffffff;
            border-radius: 17px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        }

        .activity-title {
            margin: 0;
            font-size: 25px;
            font-weight: 700;
            color: #172554;
        }

        .activity-subtitle {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .filter-card {
            background: #ffffff;
            border-radius: 17px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        }

        .filter-label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border-radius: 10px;
            border: 1px solid #dbe3ef;
            font-size: 14px;
        }

        .filter-button {
            min-height: 42px;
            border-radius: 10px;
            border: none;
            background: #2563eb;
            color: #ffffff;
            font-weight: 600;
            padding: 0 20px;
        }

        .filter-button:hover {
            background: #1d4ed8;
        }

        .clear-button {
            min-height: 42px;
            border-radius: 10px;
            border: 1px solid #dbe3ef;
            background: #ffffff;
            color: #475569;
            font-weight: 600;
            padding: 0 20px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .activity-card {
            background: #ffffff;
            border-radius: 17px;
            padding: 25px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        }

        .activity-date {
            font-size: 15px;
            font-weight: 700;
            color: #172554;
            margin: 10px 0 18px;
        }

        .activity-item {
            display: flex;
            gap: 15px;
            position: relative;
            padding-bottom: 25px;
        }

        .activity-item:last-child {
            padding-bottom: 5px;
        }

        .activity-icon-wrapper {
            position: relative;
            flex: 0 0 42px;
        }

        .activity-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            position: relative;
            z-index: 2;
        }

        .activity-line {
            position: absolute;
            top: 42px;
            left: 20px;
            width: 2px;
            height: calc(100% - 20px);
            background: #e2e8f0;
        }

        .activity-item:last-child .activity-line {
            display: none;
        }

        .activity-content {
            flex: 1;
            min-width: 0;
        }

        .activity-admin {
            font-size: 14px;
            font-weight: 700;
            color: #172554;
            margin-bottom: 3px;
        }

        .activity-description {
            font-size: 14px;
            color: #334155;
            line-height: 1.5;
        }

        .activity-time {
            margin-top: 5px;
            font-size: 12px;
            color: #94a3b8;
        }

        .empty-activity {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-activity i {
            font-size: 42px;
            color: #cbd5e1;
            display: block;
            margin-bottom: 12px;
        }

        .pagination-wrapper {
            margin-top: 25px;
        }

        @media (max-width: 767px) {

            .activity-page {
                padding: 20px 12px 40px;
            }

            .activity-header {
                padding: 20px;
            }

            .activity-card {
                padding: 20px 15px;
            }

            .activity-title {
                font-size: 22px;
            }

            .activity-item {
                gap: 10px;
            }

            .activity-icon-wrapper {
                flex-basis: 36px;
            }

            .activity-icon {
                width: 36px;
                height: 36px;
                font-size: 15px;
            }

            .activity-line {
                left: 17px;
                top: 36px;
            }
        }

    </style>

</head>

<body>

<div class="activity-page">

    {{-- Header --}}
    <div class="activity-header">

        <h1 class="activity-title">
            <i class="bi bi-clock-history me-2"></i>
            Activity Log
        </h1>

        <p class="activity-subtitle">
            View administrative activities performed in Pap Pay.
        </p>

    </div>


    {{-- Filters --}}
    <div class="filter-card">

        <form
            method="GET"
            action="{{ route('admin.audit-log.index') }}"
        >

            <div class="row g-3">

                {{-- Search --}}
                <div class="col-lg-4 col-md-6">

                    <label class="filter-label">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Search activity..."
                    >

                </div>


                {{-- Admin --}}
                <div class="col-lg-3 col-md-6">

                    <label class="filter-label">
                        Admin
                    </label>

                    <select
                        name="admin"
                        class="form-select"
                    >

                        <option value="">
                            All Admins
                        </option>

                        @foreach ($admins as $admin)

                            <option
                                value="{{ $admin->id }}"
                                @selected(request('admin') == $admin->id)
                            >
                                {{ trim($admin->first_name . ' ' . $admin->last_name) }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Action --}}
                <div class="col-lg-2 col-md-6">

                    <label class="filter-label">
                        Action
                    </label>

                    <select
                        name="action"
                        class="form-select"
                    >

                        <option value="">
                            All
                        </option>

                        @foreach ($actions as $action)

                            <option
                                value="{{ $action }}"
                                @selected(request('action') === $action)
                            >
                                {{ $action }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Date from --}}
                <div class="col-lg-3 col-md-6">

                    <label class="filter-label">
                        From
                    </label>

                    <input
                        type="date"
                        name="date_from"
                        class="form-control"
                        value="{{ request('date_from') }}"
                    >

                </div>


                {{-- Date to --}}
                <div class="col-lg-3 col-md-6">

                    <label class="filter-label">
                        To
                    </label>

                    <input
                        type="date"
                        name="date_to"
                        class="form-control"
                        value="{{ request('date_to') }}"
                    >

                </div>


                {{-- Buttons --}}
                <div class="col-lg-9 col-md-6 d-flex align-items-end gap-2">

                    <button
                        type="submit"
                        class="filter-button"
                    >
                        <i class="bi bi-search me-1"></i>
                        Search
                    </button>

                    <a
                        href="{{ route('admin.audit-log.index') }}"
                        class="clear-button"
                    >
                        Clear
                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Activity --}}
    <div class="activity-card">

        @if ($logs->count())

            @php
                $currentDate = null;
            @endphp

            @foreach ($logs as $log)

                @php
                    $logDate = $log->created_at->format('Y-m-d');

                    if ($logDate === now()->format('Y-m-d')) {
                        $displayDate = 'Today';
                    } elseif ($logDate === now()->subDay()->format('Y-m-d')) {
                        $displayDate = 'Yesterday';
                    } else {
                        $displayDate = $log->created_at->format('F d, Y');
                    }
                @endphp


                @if ($currentDate !== $logDate)

                    @php
                        $currentDate = $logDate;
                    @endphp

                    <div class="activity-date">
                        {{ $displayDate }}
                    </div>

                @endif


                <div class="activity-item">

                    <div class="activity-icon-wrapper">

                        <div class="activity-icon">

                            @switch(strtolower($log->action))

                                @case('created')
                                    <i class="bi bi-plus-lg"></i>
                                    @break

                                @case('updated')
                                    <i class="bi bi-pencil"></i>
                                    @break

                                @case('approved')
                                    <i class="bi bi-check-lg"></i>
                                    @break

                                @case('rejected')
                                    <i class="bi bi-x-lg"></i>
                                    @break

                                @case('deleted')
                                    <i class="bi bi-trash"></i>
                                    @break

                                @case('generated')
                                    <i class="bi bi-file-earmark-text"></i>
                                    @break

                                @case('corrected')
                                    <i class="bi bi-wrench-adjustable"></i>
                                    @break

                                @case('paid')
                                    <i class="bi bi-cash-stack"></i>
                                    @break

                                @default
                                    <i class="bi bi-activity"></i>

                            @endswitch

                        </div>

                        <div class="activity-line"></div>

                    </div>


                    <div class="activity-content">

                        <div class="activity-admin">

                            @if ($log->user)

                                {{ trim(
                                    $log->user->first_name . ' ' .
                                    ($log->user->middle_name ? $log->user->middle_name . ' ' : '') .
                                    $log->user->last_name
                                ) }}

                            @else

                                Deleted Admin

                            @endif

                        </div>

                        <div class="activity-description">
                            {{ $log->description }}
                        </div>

                        <div class="activity-time">

                            {{ $log->created_at->format('g:i A') }}

                        </div>

                    </div>

                </div>

            @endforeach


            {{-- Pagination --}}
            @if ($logs->hasPages())

                <div class="pagination-wrapper">

                    {{ $logs->links() }}

                </div>

            @endif

        @else

            <div class="empty-activity">

                <i class="bi bi-clock-history"></i>

                <div>
                    No activity found.
                </div>

            </div>

        @endif

    </div>

</div>

</body>

</html>