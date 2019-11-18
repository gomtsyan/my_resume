<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExperiencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any experiences.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_experiences');
    }

    /**
     * Determine whether the user can view the experience.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_experiences');
    }

    /**
     * Determine whether the user can create experiences.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_experiences');
    }

    /**
     * Determine whether the user can update the experience.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_experiences');
    }

    /**
     * Determine whether the user can delete the experience.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_experiences');
    }

    /**
     * Determine whether the user can restore the experience.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Experience $experience
     * @return mixed
     */
    public function restore(User $user, Experience $experience)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the experience.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Experience $experience
     * @return mixed
     */
    public function forceDelete(User $user, Experience $experience)
    {
        //
    }
}
