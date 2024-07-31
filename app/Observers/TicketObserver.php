<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Models\History;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {       
        $currentUser = Auth::user();
        Log::debug("User $currentUser->id | Organisation {$currentUser->organization()->id}: Ticket (" . $ticket->ticket_id . ") aangemaakt: " . $ticket->title);

        $history = new History();
        $history->model_id = $ticket->id;
        $history->model_type = 'App\Models\Ticket';
        $history->user_id = $currentUser->id;
        $history->organization_id = $currentUser->organization()->id;
        $history->description = 'Ticket (' . $ticket->ticket_id . ') aangemaakt: ' . $ticket->title;
        $history->save();

    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        $currentUser = Auth::user();
        Log::debug("User $currentUser->id | Organisation {$currentUser->organization()->id}: Ticket (" . $ticket->ticket_id . ") updated: " . $ticket->title);

        $history = new History();
        $history->model_id = $ticket->id;
        $history->model_type = 'App\Models\Ticket';
        $history->user_id = $currentUser->id;
        $history->organization_id = $currentUser->organization()->id;
        $history->description = 'Ticket (' . $ticket->ticket_id . ') bewerkt: ' . $ticket->title;
        $history->save();
    }

    /**
     * Handle the Ticket "deleted" event.
     */
    public function deleted(Ticket $ticket): void
    {
        $currentUser = Auth::user();
        Log::debug("User $currentUser->id | Organisation {$currentUser->organization()->id}: Ticket (" . $ticket->ticket_id . ") deleted: " . $ticket->title);

        $history = new History();
        $history->model_id = $ticket->id;
        $history->model_type = 'App\Models\Ticket';
        $history->user_id = $currentUser->id;
        $history->organization_id = $currentUser->organization()->id;
        $history->description = 'Ticket (' . $ticket->ticket_id . ') verwijderd: ' . $ticket->title;
        $history->save();

    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Ticket $ticket): void
    {
        //
    }
}
