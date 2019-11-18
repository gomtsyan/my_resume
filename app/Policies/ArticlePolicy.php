<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any articles.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_articles');
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_articles');
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_articles');
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_articles');
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_articles');
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Article $article
     * @return mixed
     */
    public function restore(User $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Article $article
     * @return mixed
     */
    public function forceDelete(User $user, Article $article)
    {
        //
    }
}
