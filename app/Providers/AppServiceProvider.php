<?php

namespace App\Providers;

use App\Services\JalaliDateService;
use App\View\Components\Layout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Blade::component('layout', Layout::class);

        // Register global helper functions for Jalali date conversion
        if (!function_exists('toJalali')) {
            function toJalali($date, $format = 'Y/m/d') {
                return JalaliDateService::toJalali($date, $format);
            }
        }

        if (!function_exists('toJalaliDiffForHumans')) {
            function toJalaliDiffForHumans($date) {
                return JalaliDateService::diffForHumans($date);
            }
        }
    }
}
