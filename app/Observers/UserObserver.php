<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        
            // Check if a user is authenticated
        if (auth()->check()) {
            Log::debug("User authenticated");
            // Get the currently logged-in user's organization
            $organization = auth()->user()->organizations()->first();
            Log::debug("Organization found: {$organization->id}");
            // If the organization exists, add the new user to it
            // if ($organization && !$user->organizations->contains($organization->id)) {
            //     Log::debug("Attaching user to organization");
            //     $user->organizations()->attach($organization->id);
            // }
        } 
        else {
            Log::debug("User not authenticated - probably seeder");
            // Create a new organization if no user is authenticated
            $organization = new Organization;
            $organization->name = $user->name; // Set the organization name
            $organization->save();
            Log::debug("Organization created: {$organization->id}");

            // Add the user to the new organization
            $user->organizations()->attach($organization->id);
            Log::debug("Attaching user {$user->id} to organization {$organization->id}" );
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
