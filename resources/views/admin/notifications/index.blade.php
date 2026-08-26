<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifications | Pap Pay</title>

    <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../khen/assets/css/style.css">
</head>

<body>

<div class="container py-4">

    <h2 class="mb-4">Notifications</h2>

    @forelse($notifications as $notification)

        <a href="{{ route('admin.notifications.read', $notification->id) }}"
           class="text-decoration-none">

            <div class="card mb-3 {{ !$notification->is_read ? 'border-primary' : '' }}">

                <div class="card-body">

                    <h5 class="card-title">
                        {{ $notification->title }}

                        @if(!$notification->is_read)
                            <span class="badge bg-primary">New</span>
                        @endif
                    </h5>

                    <p class="card-text text-muted">
                        {{ $notification->message }}
                    </p>

                    <small class="text-muted">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>

                </div>

            </div>

        </a>

    @empty

        <div class="text-center text-muted py-5">
            <i class="bi bi-bell-slash fs-1"></i>

            <p class="mt-3">
                No notifications yet.
            </p>
        </div>

    @endforelse

</div>

</body>

</html>
