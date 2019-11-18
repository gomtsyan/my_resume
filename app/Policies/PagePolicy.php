<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any pages.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_pages');
    }

    /**
     * Determine whether the user can view the page.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_pages');
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_pages');
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_pages');
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_pages');
    }

    /**
     * Determine whether the user can restore the page.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Page $page
     * @return mixed
     */
    public function restore(User $user, Page $page)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the page.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Page $page
     * @return mixed
     */
    public function forceDelete(User $user, Page $page)
    {
        //
    }
}
