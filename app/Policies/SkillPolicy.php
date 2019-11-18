<?php

namespace App\Policies;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkillPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any skills.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_skills');
    }

    /**
     * Determine whether the user can view the skill.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_skills');
    }

    /**
     * Determine whether the user can create skills.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_skills');
    }

    /**
     * Determine whether the user can update the skill.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_skills');
    }

    /**
     * Determine whether the user can delete the skill.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_skills');
    }

    /**
     * Determine whether the user can restore the skill.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Skill $skill
     * @return mixed
     */
    public function restore(User $user, Skill $skill)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the skill.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Skill $skill
     * @return mixed
     */
    public function forceDelete(User $user, Skill $skill)
    {
        //
    }
}
