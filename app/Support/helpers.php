<?php

if (! function_exists('format_ghs')) {
    /**
     * Format a salary string with GHS prefix if not already present.
     */
    function format_ghs(?string $value): string
    {
        if (empty($value)) {
            return 'N/A';
        }

        // If value already contains GHS or ₵, return as-is
        if (stripos($value, 'ghs') !== false || mb_strpos($value, '₵') !== false) {
            return $value;
        }

        // If numeric ranges like '80000 - 140000' convert to formatted string
        // Otherwise, just prefix with GHS
        return 'GHS ' . $value;
    }
}
