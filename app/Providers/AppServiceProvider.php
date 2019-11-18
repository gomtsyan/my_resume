<?php

namespace App\Providers;

use App\Console\Commands\ModelMakeCommand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });

        $this->app->bind('App\Contracts\VisitLogger', 'App\Services\VisitLog');
        $this->app->bind('App\Contracts\Uploader', 'App\Services\UploadFile');
        $this->app->bind('App\Contracts\AnalyzeData', 'App\Services\AnalyzeVisits');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
