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

        // Register Blade directives for Jalali date conversion
        Blade::directive('jalali', function ($expression) {
            return "<?php echo \App\Services\JalaliDateService::toJalali($expression); ?>";
        });

        Blade::directive('jalaliDiff', function ($expression) {
            return "<?php echo \App\Services\JalaliDateService::diffForHumans($expression); ?>";
        });
    }
}
