<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any permissions.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_permissions');
    }

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_permissions');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_permissions');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_permissions');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_permissions');
    }

    /**
     * Determine whether the user can restore the permission.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Permission $permission
     * @return mixed
     */
    public function restore(User $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the permission.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Permission $permission
     * @return mixed
     */
    public function forceDelete(User $user, Permission $permission)
    {
        //
    }
}
