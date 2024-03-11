<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('view_any_permission');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return bool
     */
    public function view(User $user, Permission $permission): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('view_permission');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('create_permission');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return bool
     */
    public function update(User $user, Permission $permission): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('update_permission');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return bool
     */
    public function delete(User $user, Permission $permission): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('delete_permission');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('delete_any_permission');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return bool
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('force_delete_permission');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('force_delete_any_permission');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return bool
     */
    public function restore(User $user, Permission $permission): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('restore_permission');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('restore_any_permission');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return bool
     */
    public function replicate(User $user, Permission $permission): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('replicate_permission');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->isSuperAdmin();
        //return $user->can('reorder_permission');
    }
}