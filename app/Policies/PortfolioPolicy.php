<?php

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortfolioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any portfolios.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view_portfolios');
    }

    /**
     * Determine whether the user can view the portfolio.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view_portfolios');
    }

    /**
     * Determine whether the user can create portfolios.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_portfolios');
    }

    /**
     * Determine whether the user can update the portfolio.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update_portfolios');
    }

    /**
     * Determine whether the user can delete the portfolio.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete_portfolios');
    }

    /**
     * Determine whether the user can restore the portfolio.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Portfolio $portfolio
     * @return mixed
     */
    public function restore(User $user, Portfolio $portfolio)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the portfolio.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Portfolio $portfolio
     * @return mixed
     */
    public function forceDelete(User $user, Portfolio $portfolio)
    {
        //
    }
}
