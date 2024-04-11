<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Filament\Support\Facades\FilamentView;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Database\Eloquent\Builder;

class OnTrial
{
    public function handle(Request $request, Closure $next): Response
    {   
        
        if (auth()->check() && auth()->user()->organization && auth()->user()->organization->trial_ends_at > now()) {
            FilamentView::registerRenderHook(
                'panels::global-search.before', function () {
                    return View::make('filament.banner.badge', [
                        'trialEndsAt' => auth()->user()->organization->trial_ends_at,
                    ]);
                }
            );
        }

        return $next($request);
    }
}
