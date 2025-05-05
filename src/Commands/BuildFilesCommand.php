<?php

namespace BinaryBeeTechSolutions\LaraBee\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BuildFilesCommand extends Command
{
    protected $signature = 'larabee:build-model {model}';
    protected $description = 'Create pre-built model and migration';

    public function handle()
    {
        $model = $this->argument('model');
        $availableModels = config('bee.available_models');

        if (!in_array($model, $availableModels)) {
            $this->error("Model not available. Available models: " . implode(', ', $availableModels));
            return;
        }

        // Try to get stub from published location first
        $stubPath = config('bee.stub_models_path') . "/$model.model.stub";
        $migrationStubPath = config('bee.stub_migrations_path') . "/$model.migration.stub";
        
        // If not published, use the vendor path
        if (!File::exists($stubPath)) {
            $stubPath = $this->getVendorStubPath("$model.model.stub");
        }
        
        if (!File::exists($migrationStubPath)) {
            $migrationStubPath = $this->getVendorStubPath("$model.migration.stub");
        }
        
        // Check if stubs exist in either location
        if (!File::exists($stubPath)) {
            $this->error("Model stub not found. Please check available models.");
            return;
        }
        
        if (!File::exists($migrationStubPath)) {
            $this->error("Migration stub not found. Please check available models.");
            return;
        }

        $this->createModel($model, $stubPath);
        $this->createMigration($model, $migrationStubPath);
        
        $this->info("Pre-built $model model and migration created successfully!");

        return 0;
    }

    protected function getVendorStubPath($filename)
    {
        // Get the path to the package directory using reflection
        $reflector = new \ReflectionClass(get_class($this));
        $packageRootPath = dirname(dirname(dirname($reflector->getFileName())));
        
        // Determine the appropriate stub path
        if (str_contains($filename, '.model.')) {
            return $packageRootPath . '/database/models/' . $filename;
        } else {
            return $packageRootPath . '/database/migrations/' . $filename;
        }
    }

    protected function createModel($model, $stubPath)
    {
        $stub = File::get($stubPath);
        
        // Get model namespace from config
        $namespace = config('bee.model_namespace', 'App\\Models');
        
        // Process stub content to replace placeholders
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{modelName}}', $model, $stub);
        
        // Generate proper path based on namespace
        $relativePath = str_replace('\\', '/', str_replace('App\\', '', $namespace));
        $path = app_path($relativePath . "/$model.php");
        
        File::ensureDirectoryExists(dirname($path));
        File::put($path, $stub);
    }

    protected function createMigration($model, $stubPath)
    {
        $table = Str::snake(Str::pluralStudly($model));
        $migrationName = "create_{$table}_table";
        $stub = File::get($stubPath);
        
        // Replace any placeholders in migration stub
        $stub = str_replace('{{table}}', $table, $stub);
        $stub = str_replace('{{model}}', $model, $stub);
        
        // Create a proper filename with 
        $filename = (new \DateTime())->format('Y_m_d_u') . "_$migrationName.php";
        
        // Get the full migration path from config
        $migrationPath = config('bee.migration_path');
        
        // Ensure the path is absolute
        if (!str_starts_with($migrationPath, '/')) {
            $migrationPath = base_path($migrationPath);
        }
        
        // Debug the path
        $this->line("Migration path: $migrationPath");
        
        // Ensure the directory exists
        if (!File::exists($migrationPath)) {
            File::makeDirectory($migrationPath, 0755, true);
        }
        
        $path = $migrationPath . '/' . $filename;
        
        try {
            File::put($path, $stub);
            $this->info("Migration created: $filename");
        } catch (\Exception $e) {
            $this->error("Failed to create migration: " . $e->getMessage());
            return false;
        }
        
        return true;
    }
}