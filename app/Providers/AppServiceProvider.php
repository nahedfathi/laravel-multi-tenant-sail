<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::loadKeysFrom(storage_path('oauth'));
            Route::group([
                'as' => 'passport.',
                'middleware' => [
                    InitializeTenancyByPath::class,
                    'universal',
                ],
                'prefix' => config('passport.path', 'oauth'),
                'namespace' => 'Laravel\Passport\Http\Controllers',
            ], function () {
                $this->loadRoutesFrom(__DIR__ . "/../../vendor/laravel/passport/src/../routes/web.php");
            });
    }
}
