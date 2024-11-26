<?php

class TimeFormatter
{
    /**
     * Converts a timestamp into a formatted string.
     * For timestamps within the last 12 months,
     *      it returns a relative format such as "5 minutes ago" or "3 hours ago".
     * For timestamps older than 12 months,
     *      it returns the actual date in the format "M d, Y" (e.g., "Jan 5, 2022").
     * @param int $timestamp Unix timestamp
     **/
    public static function formatTimestamp($timestamp): string
    {
        $now = time();
        $diff = $now - $timestamp;
        if ($diff < 60) {
            return 'Just now';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 2592000) {
            $days = floor($diff / 86400);
            return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 31536000) {
            $months = floor($diff / 2592000);
            return $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
        } else {
            return date('M d, Y', $timestamp);
        }
    }
}