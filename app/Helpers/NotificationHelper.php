<?php

namespace App\Helpers;

use App\Models\Notification;
use App\Models\User;

class NotificationHelper
{
    public static function notifyAdmins(
        string $title,
        string $message,
        string $type,
        string $url
    ): void {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => $title,
                'message' => $message,
                'is_read' => false,
                'type' => $type,
                'url' => $url,
            ]);
        }
    }
}
