<?php

namespace App\Providers;

use Spark\Plan;
use Spark\Spark;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Instruct Cashier to use the `Team` model instead of the `User` model...
        Cashier::useCustomerModel(Organization::class);

        Spark::checkoutSessionOptions('user', function ($billable, Plan $plan) {
            return [
                'locale' => $billable->language,
            ];
        });

        Spark::billable(Organization::class)->resolve(function (Request $request) {
            return $request->user()->organizations->first();
        });

        Spark::paymentMethodSessionOptions('user', function ($billable) {
            return [
                'locale' => $billable->language,
            ];
        });

        Spark::billable(Organization::class)->authorize(function (Organization $billable, Request $request) {
            return $request->user() && $request->user()->organizations->contains($billable->id);
        });


        Spark::billable(Organization::class)->checkPlanEligibility(function (Organization $billable, Plan $plan) {
            // if ($billable->projects > 5 && $plan->name == 'Basic') {
            //     throw ValidationException::withMessages([
            //         'plan' => 'You have too many projects for the selected plan.'
            //     ]);
            // }
             // Get the user's organization
             $organization = Auth::user()->organizations()->first();
             Log::info($organization);
 
             // if ($plan->name == 'Bronze') {
             //     $organization->update(['organization_type' => 'Individual']);
             //     Log::info('Updated organization {$organization->name} to not be a shelter.');
             // }
 
             // if ($plan->name == 'Stichting') {
             //     //$organization->update(['is_shelter' => true]);
             //     $organization->update(['organization_type' => 'Stichting']);
             //     Log::info('Updated organization {$organization->name} to be a shelter.');
             // }
 
             // if ($plan->name == 'Asiel') {
             //     //$organization->update(['is_shelter' => true]);
             //     $organization->update(['organization_type' => 'Asiel']);
             //     Log::info('Updated organization {$organization->name} to be a shelter.');
             // }
 
      
             if ($billable->animals->count() > $plan->options['animals']) {
                 Log::info('You have too many animals for the selected plan');
                 throw ValidationException::withMessages([
                     'plan' => 'You have too many animals for the selected plan.'
                 ]);
                 
             }
 
        });
    }
}
