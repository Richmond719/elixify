<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // Use Bootstrap-styled pagination links
        Paginator::useBootstrap();
        // Load custom helpers
        $helpers = app_path('Support/helpers.php');
        if (file_exists($helpers)) {
            require_once $helpers;
        }
    }
}
