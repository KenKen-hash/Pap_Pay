<?php

namespace App\Providers;

use App\Listeners\RecordLoginHistory;
use App\Listeners\RecordLogoutHistory;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            RecordLoginHistory::class,
        ],

        Logout::class => [
            RecordLogoutHistory::class,
        ],
    ];
}
