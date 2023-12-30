<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        if (!$this->app->environment('production')) {
            $this->app->register('App\Providers\FakerServiceProvider');
        }

        $this->app->singleton(
            LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
