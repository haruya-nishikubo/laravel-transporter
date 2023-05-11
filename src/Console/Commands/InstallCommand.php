<?php

namespace HaruyaNishikubo\Transporter\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transporter:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Transporter Files.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->installApp()
            ->installRoutes();

        return self::SUCCESS;
    }

    protected function installApp(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/app',
            base_path('app')
        );

        return $this;
    }

    protected function installRoutes(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/routes',
            base_path('routes')
        );

        return $this;
    }
}
