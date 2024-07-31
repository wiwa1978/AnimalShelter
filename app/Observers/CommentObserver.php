<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\History;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CommentObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Comment $comment): void
    {   
        $currentUser = Auth::user();
        $ticketId = $comment->ticket->identifier;

        Log::debug("User $currentUser->id | Organisation {$currentUser->organization()->id}: Comment " . $comment . " created for Ticket ID: " . $ticketId);


        $history = new History();
        $history->model_id = $comment->id;
        $history->model_type = 'App\Models\Comment';
        $history->user_id = $currentUser->id;
        $history->organization_id = $currentUser->organization()->id;
        $history->description = 'Reactie toegevoegd aan ticket ' . $ticketId ;
        $history->save();

    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        $currentUser = Auth::user();
        $ticketId = $comment->ticket->identifier;
        Log::debug("User $currentUser->id | Organisation {$currentUser->organization()->id}: Comment " . $comment->ticket->ticket_id . " updated");

        $history = new History();
        $history->model_id = $ticket->id;
        $history->model_type = 'App\Models\Ticket';
        $history->user_id = $currentUser->id;
        $history->organization_id = $currentUser->organization()->id;
        $history->description = 'Comment bewerkt vorr ticket ' . $ticketId ;
        $history->save();
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        $currentUser = Auth::user();
        $ticketId = $comment->ticket->identifier;
        Log::debug("User $currentUser->id | Organisation {$currentUser->organization()->id}: Comment " . $comment->ticket->ticket_id . " removed");

        $history = new History();
        $history->model_id = $ticket->id;
        $history->model_type = 'App\Models\Ticket';
        $history->user_id = $currentUser->id;
        $history->organization_id = $currentUser->organization()->id;
        $history->description = 'Comment verwijderd uit ticket ' . $ticketId;
        $history->save();

    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
