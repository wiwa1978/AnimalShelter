<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CheckTenantSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = Filament::getTenant();

        if (!$tenant) {
            return $next($request);
        }

        // Check if the tenant is within their trial period
        if ($tenant->trial_ends_at && Carbon::now()->lessThan($tenant->trial_ends_at)) {
            return $next($request);
        }

        // Check for active subscription
        if (!$tenant->subscribed()) {
            return redirect()->route('spark.portal', ['type' => 'organization', 'id' => $tenant->id]);
        }

        return $next($request);
    }
}
