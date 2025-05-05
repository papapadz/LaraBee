<?php

namespace BinaryBeeTechSolutions\LaraBee\Commands;

use Illuminate\Console\Command;

class BuildAllFilesCommand extends Command
{
    protected $signature = 'larabee:build-all';
    protected $description = 'Create all pre-built models and migrations';

    public function handle()
    {
        $availableModels = config('bee.available_models');
        
        if (empty($availableModels)) {
            $this->error("No models available. Please check your configuration.");
            return;
        }

        $this->info("Starting to create " . count($availableModels) . " pre-built models and migrations...");
        
        $successCount = 0;
        
        foreach ($availableModels as $model) {
            $this->line("\nProcessing $model...");
            
            // Call the make:prebuilt command for each model
            $exitCode = $this->call('larabee:build-model', [
                'model' => $model
            ]);
            
            if ($exitCode === 0) {
                $successCount++;
            }
        }
        
        $this->info('---------------------------------------------------------');
        $this->info('✅ Created ' . $successCount . 'out of ' . count($availableModels));
        $this->info('---------------------------------------------------------');

        return 0;
    }
}