<?php

namespace App\Providers;

use App\Models\Enquiry;
use App\Observers\EnquiryObserver;
use App\Support\MailConfigurator;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        $configuredUrl = (string) env('APP_URL', '');

        if (preg_match('#/public/?$#i', $configuredUrl)) {
            URL::forceRootUrl(config('app.url'));
        }

        Password::defaults(function () {
            return Password::min(8)->mixedCase()->numbers();
        });

        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }

        RateLimiter::for('login', function (Request $request) {
            $key = strtolower((string) $request->input('email')).'|'.$request->ip();

            return Limit::perMinute(5)->by($key);
        });

        RateLimiter::for('admin-login', function (Request $request) {
            $key = strtolower((string) $request->input('email')).'|'.$request->ip();

            return Limit::perMinute(5)->by($key);
        });

        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('password-reset', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('public-form', function (Request $request) {
            return Limit::perMinute(4)->by($request->ip());
        });

        MailConfigurator::apply();

        Enquiry::observe(EnquiryObserver::class);
    }
}
