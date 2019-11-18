<?php

namespace App\Policies;

use App\Models\Education;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any education.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_education');
    }

    /**
     * Determine whether the user can view the education.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_education');
    }

    /**
     * Determine whether the user can create education.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_education');
    }

    /**
     * Determine whether the user can update the education.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_education');
    }

    /**
     * Determine whether the user can delete the education.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_education');
    }

    /**
     * Determine whether the user can restore the education.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Education $education
     * @return mixed
     */
    public function restore(User $user, Education $education)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the education.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Education $education
     * @return mixed
     */
    public function forceDelete(User $user, Education $education)
    {
        //
    }
}
