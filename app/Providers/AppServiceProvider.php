<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        RateLimiter::for('contact-form', function (Request $request) {
            $ip = (string) $request->ip();

            return [
                Limit::perMinutes(10, 5)->by('contact-burst:'.$ip),
                Limit::perHour(8)->by('contact-hour:'.$ip),
                Limit::perDay(20)->by('contact-day:'.$ip),
            ];
        });
    }
}
