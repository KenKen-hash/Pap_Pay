<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (Auth::check() && Auth::user()->role === 'admin') {

                $notifications = Notification::where('user_id', Auth::id())
                    ->latest()
                    ->take(10)
                    ->get();

                $unreadNotifications = Notification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count();

                $view->with([
                    'notifications' => $notifications,
                    'unreadNotifications' => $unreadNotifications,
                ]);
            }
        });
    }
}
