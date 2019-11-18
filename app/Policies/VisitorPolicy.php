<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitorPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any visitors.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_visitors');
    }

    /**
     * Determine whether the user can view the visitor.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_visitors');
    }

    /**
     * Determine whether the user can create visitors.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_visitors');
    }

    /**
     * Determine whether the user can update the visitor.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_visitors');
    }

    /**
     * Determine whether the user can delete the visitor.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_visitors');
    }

    /**
     * Determine whether the user can restore the visitor.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visitor  $visitor
     * @return mixed
     */
    public function restore(User $user, Visitor $visitor)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the visitor.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visitor  $visitor
     * @return mixed
     */
    public function forceDelete(User $user, Visitor $visitor)
    {
        //
    }
}
