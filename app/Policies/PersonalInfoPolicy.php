<?php

namespace App\Policies;

use App\Models\PersonalInfo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any personal infos.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_personal_infos');
    }

    /**
     * Determine whether the user can view the personal info.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_personal_infos');
    }

    /**
     * Determine whether the user can create personal infos.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_personal_infos');
    }

    /**
     * Determine whether the user can update the personal info.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_personal_infos');
    }

    /**
     * Determine whether the user can delete the personal info.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_personal_infos');
    }

    /**
     * Determine whether the user can restore the personal info.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\PersonalInfo $personalInfo
     * @return mixed
     */
    public function restore(User $user, PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the personal info.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\PersonalInfo $personalInfo
     * @return mixed
     */
    public function forceDelete(User $user, PersonalInfo $personalInfo)
    {
        //
    }
}
