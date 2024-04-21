<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ApplyTenantScopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Animal::addGlobalScope(
        //     fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        // );

        // User::addGlobalScope(
        //     fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        // );

        return $next($request);
    }
}
