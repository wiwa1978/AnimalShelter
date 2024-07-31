<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserInvitation;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {       
        //Log::debug("User $user->id | Organisation {$user->organization()->id}: User " . $user->id . " created: " . $user->name);


        $invitation = UserInvitation::where('email', $user->email)->first();

        if ($user->invited && ($user->email == $invitation->email) ) {
            // User is invited, hence not creating an organization
            Log::debug("User {$user->id} with email {$user->email} is invited, hence not creating an organization");
        }
        else {
            // User is not invited, hence creating a new organization
            $organization = new Organization;
            $organization->name = $user->name; 
            $organization->organization_type = $user->organization_type; 
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
        Log::debug("User $user->id | Organisation {$user->organization()->id}: User " . $user->id . " updated: " . $user->name);

        $history = new History();
        $history->model_id = $user->id;
        $history->model_type = 'App\Models\User';
        $history->user_id = Auth::user()->id;
        $history->organization_id = Auth::user()->organization()->id;
        $history->description = 'Gebruiker toegevoegd: '. $user->name;
        $history->save();
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Log::debug("User $user->id | Organisation {$user->organization()->id}: User " . $user->id . " deleted: " . $user->name);

        $organization = Organization::find($user->organizations()->first()->id);
       
        // Remove the organization if it has no users
        Log::debug('Organization ID: ' . $organization->id);
        Log::debug('Organization amount of users: ' . $organization->users->count());

        if ($organization->users->count() == 0) {
            Log::debug("User $user->id | Organisation {$organization->id }: organization" .  $organization->id  . " has no users, soft deleting organization");
            
            // Deactivate all animals associated with the organization
            foreach ($organization->animals as $animal) {
                $animal->delete();
                //$animal->save(); // Save each animal's new state
            }

            // Detaching the user from the organization
            $user->organizations()->detach();

            // Deleting the organization
            $organization->delete();
        }
        else {
            Log::debug("User $user->id | Organisation {$organization->id }: organization" .  $organization->id  . " has users, not deleting organization");
            // Remove the user from the organization
            $user->organizations()->detach();

            $history = new History();
            $history->model_id = $user->id;
            $history->model_type = 'App\Models\User';
            $history->user_id = Auth::user()->id;
            $history->organization_id = Auth::user()->organization()->id;
            $history->description = 'Gebruiker verwijderd uit organizatie: '. $user->name;
            $history->save();
        }

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
