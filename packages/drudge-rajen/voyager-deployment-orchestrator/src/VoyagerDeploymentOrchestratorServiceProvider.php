<?php

namespace DrudgeRajen\VoyagerDeploymentOrchestrator;

use DrudgeRajen\VoyagerDeploymentOrchestrator\Providers\OrchestratorEventServiceProvider;
use Illuminate\Support\ServiceProvider;

class VoyagerDeploymentOrchestratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $publishablePath = dirname(__DIR__).'/publishable';

        $publishable = [
            'seeds' => [
                "{$publishablePath}/database/seeders/" => database_path('seeders/breads'),
            ],
            'config' => [
                "{$publishablePath}/config/voyager-deployment-orchestrator.php" => config_path('voyager-deployment-orchestrator.php'),
            ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }

        $this->commands(Commands\VDOSeed::class);
    }

    public function register()
    {
        $this->app->register(OrchestratorEventServiceProvider::class);
    }
}
