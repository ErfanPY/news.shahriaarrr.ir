<?php

namespace App\Services;

use Carbon\Carbon;

class JalaliDateService
{
    /**
     * Convert Gregorian date to Jalali date
     */
    public static function toJalali($date, $format = 'Y/m/d'): string
    {
        if (!$date) return '';
        
        if ($date instanceof Carbon) {
            $year = $date->year;
            $month = $date->month;
            $day = $date->day;
        } else {
            $date = Carbon::parse($date);
            $year = $date->year;
            $month = $date->month;
            $day = $date->day;
        }

        $jalali = self::gregorianToJalali($year, $month, $day);
        
        return self::formatJalali($jalali['year'], $jalali['month'], $jalali['day'], $format);
    }

    /**
     * Get relative time in Persian
     */
    public static function diffForHumans($date): string
    {
        if (!$date) return '';
        
        $date = Carbon::parse($date);
        $now = Carbon::now();
        $diff = $date->diffInSeconds($now);

        if ($diff < 60) {
            return $diff . ' ثانیه پیش';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' دقیقه پیش';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' ساعت پیش';
        } elseif ($diff < 2592000) {
            $days = floor($diff / 86400);
            return $days . ' روز پیش';
        } elseif ($diff < 31536000) {
            $months = floor($diff / 2592000);
            return $months . ' ماه پیش';
        } else {
            $years = floor($diff / 31536000);
            return $years . ' سال پیش';
        }
    }

    /**
     * Convert Gregorian to Jalali
     */
    private static function gregorianToJalali($gy, $gm, $gd): array
    {
        $g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
        
        if ($gy > 1600) {
            $jy = 979;
            $gy -= 1600;
        } else {
            $jy = 0;
            $gy -= 621;
        }
        
        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        $days = (365 * $gy) + ((int)(($gy2 + 3) / 4)) - ((int)(($gy2 + 99) / 100)) + ((int)(($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
        $jy += 33 * ((int)($days / 12053));
        $days %= 12053;
        $jy += 4 * ((int)($days / 1461));
        $days %= 1461;
        
        if ($days > 365) {
            $jy += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        
        $jm = ($days < 186) ? 1 + (int)($days / 31) : 7 + (int)(($days - 186) / 30);
        $jd = 1 + (($days < 186) ? ($days % 31) : (($days - 186) % 30));
        
        return ['year' => $jy, 'month' => $jm, 'day' => $jd];
    }

    /**
     * Format Jalali date
     */
    private static function formatJalali($year, $month, $day, $format): string
    {
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        
        $formatted = str_replace(['Y', 'm', 'd'], [$year, $month, $day], $format);
        
        // Convert numbers to Persian
        return str_replace($englishNumbers, $persianNumbers, $formatted);
    }
}
