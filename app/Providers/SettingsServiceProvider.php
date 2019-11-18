<?php

namespace App\Providers;

use App\Repositories\Contracts\SettingsRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @param SettingsRepository $repository
     * @return void
     */
    public function boot(SettingsRepository $repository)
    {
        if(Schema::hasTable('settings')) {
            $settings = $repository->pluck();

            if (is_object($settings)) {
                foreach ($settings as $key => $value) {
                    config()->set('settings.' . $key, $value);
                }

            }
        }
    }
}
