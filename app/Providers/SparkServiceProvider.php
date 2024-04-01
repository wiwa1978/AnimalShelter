<?php

namespace App\Providers;

use Spark\Plan;
use Spark\Spark;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
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
        
        // Resolve the current team...
        Spark::billable(Organization::class)->resolve(function (Request $request) {
            
            return $request->user()->currentOrganization;
        });

        // Spark::billable(User::class)->resolve(function (Request $request) {
        //     return $request->user();
        // });

        Spark::billable(Organization::class)->authorize(function (Organization $billable, Request $request) {
            return $request->user() && $request->user()->organizations->contains($billable->id);
            //return true;
           
        });

        // Spark::billable(User::class)->authorize(function (User $billable, Request $request) {
        //     return $request->user() &&
        //            $request->user()->id == $billable->id;
        // });

        Spark::billable(Organization::class)->checkPlanEligibility(function (Organization $billable, Plan $plan) {
            // if ($billable->projects > 5 && $plan->name == 'Basic') {
            //     throw ValidationException::withMessages([
            //         'plan' => 'You have too many projects for the selected plan.'
            //     ]);
            // }
        });
    }
}
