<?php

namespace App\Policies;

use App\Models\LanguageSkill;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguageSkillPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any language skills.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_language_skills');
    }

    /**
     * Determine whether the user can view the language skill.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_language_skills');
    }

    /**
     * Determine whether the user can create language skills.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_language_skills');
    }

    /**
     * Determine whether the user can update the language skill.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_language_skills');
    }

    /**
     * Determine whether the user can delete the language skill.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_language_skills');
    }

    /**
     * Determine whether the user can restore the language skill.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\LanguageSkill $languageSkill
     * @return mixed
     */
    public function restore(User $user, LanguageSkill $languageSkill)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the language skill.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\LanguageSkill $languageSkill
     * @return mixed
     */
    public function forceDelete(User $user, LanguageSkill $languageSkill)
    {
        //
    }
}
