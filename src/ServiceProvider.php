<?php

namespace TheBachtiarz\AccountResource;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\AccountResource\Interfaces\Config\ConfigInterface;
use TheBachtiarz\AccountResource\Providers\AppsProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function register(): void
    {
        /**
         * @var AppsProvider $appsProvider
         */
        $appsProvider = new AppsProvider;

        $appsProvider->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands($appsProvider->registerCommands());
        }
    }

    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/' . ConfigInterface::CONFIG_NAME . '.php' => config_path(ConfigInterface::CONFIG_NAME . '.php'),
            ], 'thebachtiarz-account-resource-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'thebachtiarz-account-resource-migrations');
        }
    }
}
