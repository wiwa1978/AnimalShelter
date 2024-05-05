<?php

namespace App\Providers;

use Exception;
use Spark\Plan;
use Spark\Spark;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        
        Spark::paymentMethodSessionOptions('user', function ($billable) {
            return [
                'locale' => $billable->language,
            ];
        });

        // Resolve the current team...
        Spark::billable(Organization::class)->resolve(function (Request $request) {
            if ($request->user() && $request->user()->organizations->first()) {
                // Set the plans for organizations
                app('config')->set('spark.billables.organization.plans', [
                    
                        'name' => 'Organization',
                        'short_description' => 'This is a short, human friendly description of the plan.',
                        'monthly_id' => '***',
                        'yearly_id' => '***',
                        'features' => [
                            'Feature 1',
                            'Feature 2',
                            'Feature 3',
                        ],
                    
                ]);
            } else {
                // Set the plans for individuals
                app('config')->set('spark.billables.organization.plans', [
                    'name' => 'Individual',
                    'short_description' => 'This is a short, human friendly description of the plan.',
                    'monthly_id' => '***',
                    'yearly_id' => '***',
                    'features' => [
                        'Feature 1',
                        'Feature 2',
                        'Feature 3',
                    ],
                  
                ]);
            }

            return $request->user()->organizations->first();
        });

        Spark::billable(Organization::class)->authorize(function (Organization $billable, Request $request) {
            return $request->user() && $request->user()->organizations->contains($billable->id);
        });


        Spark::billable(Organization::class)->checkPlanEligibility(function (Organization $billable, Plan $plan) {
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
