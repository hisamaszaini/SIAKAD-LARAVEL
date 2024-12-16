<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Override layout master bawaan Jetstream
        View::composer('jetstream::layouts.app', function ($view) {
            $view->with('layout', 'stislaauth');
        });
    }
}