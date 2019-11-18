<?php

namespace App\Policies;

use App\Models\ContactMe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactMePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any contact mes.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_messages');
    }

    /**
     * Determine whether the user can view the contact me.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_messages');
    }

    /**
     * Determine whether the user can create contact mes.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the contact me.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ContactMe $contactMe
     * @return mixed
     */
    public function update(User $user, ContactMe $contactMe)
    {
        //
    }

    /**
     * Determine whether the user can delete the contact me.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_messages');
    }

    /**
     * Determine whether the user can restore the contact me.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ContactMe $contactMe
     * @return mixed
     */
    public function restore(User $user, ContactMe $contactMe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the contact me.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ContactMe $contactMe
     * @return mixed
     */
    public function forceDelete(User $user, ContactMe $contactMe)
    {
        //
    }
}
