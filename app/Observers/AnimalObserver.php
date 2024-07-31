<?php

namespace App\Observers;

use App\Models\Animal;
use App\Models\History;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AnimalObserver
{
    /**
     * Handle the Animal "created" event.
     */
    public function created(Animal $animal): void
    {   
        if (Auth::check()) {
            $currentUser = Auth::user();

            Log::debug("User $currentUser->id | Organisation {$this->animal->organization_id}: Animal " . $animal->name . " created");

            $history = new History();
            $history->model_id = $animal->id;
            $history->model_type = 'App\Models\Animal';
            $history->user_id = $currentUser->id;
            $history->organization_id = $currentUser->organization()->id;
            $history->description = $animal->name . ' toegevoegd' ;
            $history->save();
        } 


    }

    /**
     * Handle the Animal "updated" event.
     */
    public function updated(Animal $animal): void
    {
       
    }

    /**
     * Handle the Animal "deleted" event.
     */
    public function deleted(Animal $animal): void
    {
        $currentUser = Auth::user();
        Log::debug("User $currentUser->id | Organisation {$this->animal->organization_id}: Animal " . $animal->name . " deleted");

        $history = new History();
        $history->model_id = $animal->id;
        $history->model_type = 'App\Models\Animal';
        $history->user_id = $currentUser->id;
        $history->organization_id = $currentUser->organization()->id;
        $history->description = $animal->name . ' verwijderd' ;
        $history->save();

    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Animal $animal): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(Animal $animal): void
    {
        //
    }
}
