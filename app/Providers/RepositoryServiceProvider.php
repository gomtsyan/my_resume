<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @return array
     */
    protected function registeredRepositories()
    {
        // 'Repository Interface' => 'Implementation'
        return [
            'App\Repositories\Contracts\PagesRepository' => 'App\Repositories\EloquentPagesRepository',
            'App\Repositories\Contracts\PersonalInfoRepository' => 'App\Repositories\EloquentPersonalInfoRepository',
            'App\Repositories\Contracts\ContactsRepository' => 'App\Repositories\EloquentContactsRepository',
            'App\Repositories\Contracts\ContactMeRepository' => 'App\Repositories\EloquentContactMeRepository',
            'App\Repositories\Contracts\PortfolioRepository' => 'App\Repositories\EloquentPortfolioRepository',
            'App\Repositories\Contracts\AboutMeRepository' => 'App\Repositories\EloquentAboutMeRepository',
            'App\Repositories\Contracts\EducationsRepository' => 'App\Repositories\EloquentEducationsRepository',
            'App\Repositories\Contracts\ExperiencesRepository' => 'App\Repositories\EloquentExperiencesRepository',
            'App\Repositories\Contracts\SkillsRepository' => 'App\Repositories\EloquentSkillsRepository',
            'App\Repositories\Contracts\SkillCategoriesRepository' => 'App\Repositories\EloquentSkillCategoriesRepository',
            'App\Repositories\Contracts\LanguageSkillsRepository' => 'App\Repositories\EloquentLanguageSkillsRepository',
            'App\Repositories\Contracts\ArticlesRepository' => 'App\Repositories\EloquentArticlesRepository',
            'App\Repositories\Contracts\ArticleCategoriesRepository' => 'App\Repositories\EloquentArticleCategoriesRepository',
            'App\Repositories\Contracts\CommentsRepository' => 'App\Repositories\EloquentCommentsRepository',
            'App\Repositories\Contracts\VisitorsRepository' => 'App\Repositories\EloquentVisitorsRepository',
            'App\Repositories\Contracts\VisitedPagesRepository' => 'App\Repositories\EloquentVisitedPagesRepository',
            'App\Repositories\Contracts\SettingsRepository' => 'App\Repositories\EloquentSettingsRepository',
            'App\Repositories\Contracts\PermissionsRepository' => 'App\Repositories\EloquentPermissionsRepository',
            'App\Repositories\Contracts\RolesRepository' => 'App\Repositories\EloquentRolesRepository',
            'App\Repositories\Contracts\PrivilegesRepository' => 'App\Repositories\EloquentPrivilegesRepository',
            'App\Repositories\Contracts\UsersRepository' => 'App\Repositories\EloquentUsersRepository',
        ];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $repos = $this->registeredRepositories();

        foreach ($repos as $interface => $implemented) {
            $this->app->bind($interface, $implemented);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
