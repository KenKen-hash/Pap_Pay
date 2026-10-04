<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLogService
{
    /**
     * Record an admin activity.
     *
     * Login, logout, profile settings, and other excluded
     * activities should never call this method.
     */
    public static function log(
        string $action,
        string $description
    ): ?AuditLog {
        if (!Auth::check()) {
            return null;
        }

        return AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
        ]);
    }
}
