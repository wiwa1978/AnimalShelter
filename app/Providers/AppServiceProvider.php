<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use App\Http\Responses\CustomLoginResponse;
use App\Http\Middleware\VerifyOrganizationIsBillable;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

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
        $this->app->singleton(
            LoginResponse::class, CustomLoginResponse::class
        );

        User::observe(UserObserver::class);

        $this->app->bind(
            'Filament\Billing\Providers\Http\Middleware\VerifySparkBillableIsSubscribed',
            VerifyOrganizationIsBillable::class
        );
    }
}
