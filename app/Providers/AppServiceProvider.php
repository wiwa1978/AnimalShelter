<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Animal;
use App\Models\Ticket;
use App\Models\Comment;
use App\Observers\UserObserver;
use App\Observers\AnimalObserver;
use App\Observers\CommentObserver;
use App\Observers\TicketObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
// use App\Http\Middleware\VerifyOrganizationIsBillable;
use App\Http\Responses\CustomLoginResponse;
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
        Animal::observe(AnimalObserver::class);
        Ticket::observe(TicketObserver::class);
        Comment::observe(CommentObserver::class);

        $this->app->bind(
            'Filament\Billing\Providers\Http\Middleware\VerifySparkBillableIsSubscribed',
            //VerifyOrganizationIsBillable::class
        );

        Gate::define('viewPulse', function (User $user) {
            return $user->isSuperAdmin();
        });
     
    }
}
