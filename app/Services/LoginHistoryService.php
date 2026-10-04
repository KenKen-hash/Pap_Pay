<?php

namespace App\Services;

use App\Models\LoginHistory;
use App\Support\DeviceInfo;
use Illuminate\Http\Request;

class LoginHistoryService
{
    public static function recordLogin(
        $user,
        Request $request
    ): LoginHistory {
        $userAgent = $request->userAgent();

        $deviceInfo = DeviceInfo::detect($userAgent);

        return LoginHistory::create([
            'user_id' => $user->id,
            'session_id' => $request->session()->getId(),
            'login_at' => now(),
            'logout_at' => null,
            'ip_address' => $request->ip(),
            'device' => $deviceInfo['device'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],
            'user_agent' => $userAgent,
            'status' => 'active',
        ]);
    }

    public static function recordLogout(
        string $sessionId
    ): void {
        $loginHistory = LoginHistory::where(
            'session_id',
            $sessionId
        )
            ->where('status', 'active')
            ->latest('id')
            ->first();

        if (!$loginHistory) {
            return;
        }

        $loginHistory->update([
            'logout_at' => now(),
            'status' => 'logged_out',
        ]);
    }

    public static function terminate(
        ?LoginHistory $loginHistory
    ): void {
        if (!$loginHistory) {
            return;
        }

        $loginHistory->update([
            'logout_at' => now(),
            'status' => 'terminated',
        ]);
    }
}
