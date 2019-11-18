<?php

namespace App\Policies;

use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any article categories.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_article_categories');
    }

    /**
     * Determine whether the user can view the article category.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_article_categories');
    }

    /**
     * Determine whether the user can create article categories.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_article_categories');
    }

    /**
     * Determine whether the user can update the article category.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_article_categories');
    }

    /**
     * Determine whether the user can delete the article category.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_article_categories');
    }

    /**
     * Determine whether the user can restore the article category.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ArticleCategory $articleCategory
     * @return mixed
     */
    public function restore(User $user, ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the article category.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ArticleCategory $articleCategory
     * @return mixed
     */
    public function forceDelete(User $user, ArticleCategory $articleCategory)
    {
        //
    }
}
