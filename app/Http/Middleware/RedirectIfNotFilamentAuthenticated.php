<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as Middleware;

class RedirectIfNotFilamentAuthenticated extends Middleware
{
    protected function redirectTo($request): ?string
    {
        return route('filament.auth.auth.login');
    }
}
