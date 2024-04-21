<?php

namespace App\Http\Middleware;

use Filament\Billing\Providers\Http\Middleware\VerifySparkBillableIsSubscribed;
use Filament\Facades\Filament;

class VerifyOrganizationIsBillable extends VerifySparkBillableIsSubscribed
{
    public function handle($request, $next, $subscription = 'default', $plan = null)
    {
        $organization = Filament::getTenant();

        if ($this->shouldRedirectToBilling($organization, $request)) {
            return parent::handle($request, $next, $subscription, $plan);
        }

        return $next($request);
    }

    protected function shouldRedirectToBilling($organization, $request): bool
    {

        return $organization
            && $organization->isBillable() 
            && $organization->organizationIsShelter()
            && ! $organization->isOnTrialOrSubscribed();
    }
}