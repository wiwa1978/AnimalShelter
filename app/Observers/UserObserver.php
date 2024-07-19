<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Invitation;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {       
        $invitation = Invitation::where('email', $user->email)->first();

        if ($user->invited && ($user->email == $invitation->email) ) {
            // User is invited, hence not creating an organization
            Log::debug("User {$user->id} with email {$user->email} is invited, hence not creating an organization");
        }
        else {
            // User is not invited, hence creating a new organization
            $organization = new Organization;
            $organization->name = $user->name; // Set the organization name
            $organization->organization_type = $user->organization_type; // Set the organization type
            $organization->save();
            Log::debug("Organization created: {$organization->id}");
    
            // Add the user to the new organization
            $user->organizations()->attach($organization->id);
    
            // Check if user is a super admin, by checking whether it's equal to an entry in config('app.super_admins'); 
            if (in_array($user->email, config('app.super_admins'))) {
                Log::debug("Not attaching role 'user' to {$user->id} with email {$user->email} => reason: user is super admin" );
            } else {
                $user->assignRole('user');
                    Log::debug("Attaching role 'user' to user {$user->id} with email {$user->email}" );
            }
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
