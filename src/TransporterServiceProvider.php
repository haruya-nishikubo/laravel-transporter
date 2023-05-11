<?php

namespace HaruyaNishikubo\Transporter;

use HaruyaNishikubo\Transporter\Console\Commands\ConnectorTaskLineRetryCommand;
use HaruyaNishikubo\Transporter\Console\Commands\ConnectorTaskLineRunnerCommand;
use HaruyaNishikubo\Transporter\Console\Commands\ConnectorTaskRegisterCommand;
use HaruyaNishikubo\Transporter\Console\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class TransporterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/transporter.php', 'transporter');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'transporter');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'transporter');

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
            ConnectorTaskLineRunnerCommand::class,
            ConnectorTaskRegisterCommand::class,
            ConnectorTaskLineRetryCommand::class,
        ]);
    }
}
