<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function manageAllTickets(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function manageAssignedTickets (User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function assignTickets(User $user): bool
    {
        return true;
    }

}
