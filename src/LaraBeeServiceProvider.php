<?php

namespace BinaryBeeTechSolutions\LaraBee;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LarabeeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish all assets with one tag
        $this->publishes([
            __DIR__.'/../config/bee.php' => config_path('bee.php'),
            __DIR__.'/../database/models' => database_path('models'),
            __DIR__.'/../database/json' => database_path('json'),
            __DIR__.'/../database/seeders' => database_path('seeders')
        ], 'larabee');
        
        // Also publish individual assets for more flexibility
        $this->publishes([
            __DIR__.'/../config/bee.php' => config_path('bee.php'),
        ], 'larabee-config');
        
        $this->publishes([
            __DIR__.'/../database/models' => database_path('models'),
        ], 'larabee-stubs');

        $this->publishes([
            __DIR__.'/../database/json' => database_path('json'),
            __DIR__.'/../database/seeders' => database_path('seeders')
        ], 'larabee-seeders');
        
        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \BinaryBeeTechSolutions\LaraBee\Commands\_BuildSystemCommand::class,
                \BinaryBeeTechSolutions\LaraBee\Commands\BuildFilesCommand::class,
                \BinaryBeeTechSolutions\LaraBee\Commands\BuildAllFilesCommand::class,
                \BinaryBeeTechSolutions\LaraBee\Commands\InstallRequiredPackagesCommands::class
            ]);
        }
    }

    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/../config/bee.php', 'bee'
        );
        
        // Register a boot method to process model stubs when they're published
        $this->app->booted(function () {
            $this->processStubs();
        });
    }
    
    protected function processStubs()
    {
        // Only process stubs after they're published
        $stubPath = database_path('models');
        if (!File::exists($stubPath)) {
            return;
        }
        
        // Get namespace from config
        $namespace = config('bee.model_namespace', 'App\\Models');
        
        // Process all model stubs to replace namespace
        $modelStubs = File::glob($stubPath . '/*.model.stub');
        foreach ($modelStubs as $stubFile) {
            $content = File::get($stubFile);
            // Replace namespace placeholder with configured namespace
            $content = str_replace('{{namespace}}', $namespace, $content);
            File::put($stubFile, $content);
        }
    }
}