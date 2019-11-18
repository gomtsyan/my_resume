<?php

namespace App\Policies;

use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkillCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any skill categories.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_skill_categories');
    }

    /**
     * Determine whether the user can view the skill category.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_skill_categories');
    }

    /**
     * Determine whether the user can create skill categories.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_skill_categories');
    }

    /**
     * Determine whether the user can update the skill category.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_skill_categories');
    }

    /**
     * Determine whether the user can delete the skill category.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_skill_categories');
    }

    /**
     * Determine whether the user can restore the skill category.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\SkillCategory $skillCategory
     * @return mixed
     */
    public function restore(User $user, SkillCategory $skillCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the skill category.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\SkillCategory $skillCategory
     * @return mixed
     */
    public function forceDelete(User $user, SkillCategory $skillCategory)
    {
        //
    }
}
