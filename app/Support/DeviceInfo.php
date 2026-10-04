<?php

namespace App\Support;

class DeviceInfo
{
    public static function detect(?string $userAgent): array
    {
        $userAgent = $userAgent ?? '';

        return [
            'device' => self::detectDevice($userAgent),
            'browser' => self::detectBrowser($userAgent),
            'platform' => self::detectPlatform($userAgent),
        ];
    }

    private static function detectDevice(string $userAgent): string
    {
        if (preg_match('/iPad/i', $userAgent)) {
            return 'Tablet';
        }

        if (preg_match('/Tablet|Android(?!.*Mobile)/i', $userAgent)) {
            return 'Tablet';
        }

        if (preg_match('/Mobile|iPhone|Android/i', $userAgent)) {
            return 'Mobile';
        }

        return 'Desktop';
    }

    private static function detectBrowser(string $userAgent): string
    {
        if (preg_match('/Edg/i', $userAgent)) {
            return 'Edge';
        }

        if (preg_match('/OPR|Opera/i', $userAgent)) {
            return 'Opera';
        }

        if (preg_match('/Chrome/i', $userAgent)) {
            return 'Chrome';
        }

        if (preg_match('/Firefox/i', $userAgent)) {
            return 'Firefox';
        }

        if (
            preg_match('/Safari/i', $userAgent) &&
            !preg_match('/Chrome/i', $userAgent)
        ) {
            return 'Safari';
        }

        if (preg_match('/MSIE|Trident/i', $userAgent)) {
            return 'Internet Explorer';
        }

        return 'Unknown';
    }

    private static function detectPlatform(string $userAgent): string
    {
        if (preg_match('/Windows/i', $userAgent)) {
            return 'Windows';
        }

        if (preg_match('/iPhone|iPad|iPod/i', $userAgent)) {
            return 'iOS';
        }

        if (preg_match('/Android/i', $userAgent)) {
            return 'Android';
        }

        if (preg_match('/Macintosh|Mac OS X/i', $userAgent)) {
            return 'macOS';
        }

        if (preg_match('/Linux/i', $userAgent)) {
            return 'Linux';
        }

        return 'Unknown';
    }
}
