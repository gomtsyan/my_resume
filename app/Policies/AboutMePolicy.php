<?php

namespace App\Policies;

use App\Models\AboutMe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutMePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any about mes.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_profiles');
    }

    /**
     * Determine whether the user can view the about me.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\AboutMe $aboutMe
     * @return mixed
     */
    public function view(User $user, AboutMe $aboutMe)
    {
        //
    }

    /**
     * Determine whether the user can create about mes.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_profiles');
    }

    /**
     * Determine whether the user can update the about me.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_profiles');
    }

    /**
     * Determine whether the user can delete the about me.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_profiles');
    }

    /**
     * Determine whether the user can restore the about me.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\AboutMe $aboutMe
     * @return mixed
     */
    public function restore(User $user, AboutMe $aboutMe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the about me.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\AboutMe $aboutMe
     * @return mixed
     */
    public function forceDelete(User $user, AboutMe $aboutMe)
    {
        //
    }
}
