<?php

namespace App\Listeners;

use App\Services\LoginHistoryService;
use Illuminate\Auth\Events\Logout;

class RecordLogoutHistory
{
    public function handle(Logout $event): void
    {
        if (!request()->hasSession()) {
            return;
        }

        LoginHistoryService::recordLogout(
            request()->session()->getId()
        );
    }
}
