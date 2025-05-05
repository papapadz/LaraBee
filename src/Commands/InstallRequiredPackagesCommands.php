<?php

namespace BinaryBeeTechSolutions\LaraBee\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class InstallRequiredPackagesCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larabee:install-packages {--stack=inertia : The Jetstream stack (livewire or inertia)} {--teams : Install Jetstream teams support}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install and configure Laravel Jetstream and Spatie Permissions packages.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting installation of Jetstream and Spatie Permissions...');

        // Step 1: Install Jetstream
        $this->info('Installing Jetstream...');
        $this->runProcess(['composer', 'require', 'laravel/jetstream']);
        $stack = $this->option('stack');
        $jetstreamCommand = ['php', 'artisan', 'jetstream:install', $stack];
        if ($this->option('teams')) {
            $jetstreamCommand[] = '--teams';
        }
        if (!$this->runProcess($jetstreamCommand)) return 1;

        // Step 2: Install NPM dependencies
        $this->info('Installing NPM dependencies (this might take a while)...');
        if (! $this->runProcess(['npm', 'install'])) return 1;

        // Step 3: Build assets
        $this->info('Building frontend assets...');
         if (! $this->runProcess(['npm', 'run', 'build'])) return 1;

        // Step 4: Install Spatiel Roles
        $this->runProcess(['composer', 'require', 'spatie/laravel-permission']);
        $this->runProcess(['php', 'artisan', 'vendor:publish', '--provider="Spatie\Permission\PermissionServiceProvider"']);
        
        $this->info('---------------------------------------------------------');
        $this->info('✅ Jetstream and Spatie Permissions installed successfully!');
        $this->warn('Remember to configure the Spatie User model trait if needed.');
        $this->info('---------------------------------------------------------');

        return 0; // Success
    }

    /**
     * Helper function to run shell commands and display output.
     *
     * @param array $command The command and its arguments.
     * @return bool True on success, false on failure.
     */
    protected function runProcess(array $command): bool
    {
        // Increase timeout for potentially long-running processes like composer require or npm install
        $process = new Process($command, base_path(), null, null, timeout: 360);

        // Enable TTY mode for interactive processes if available
        if (Process::isTtySupported()) {
            $process->setTty(true);
        } else {
             $this->output->writeln('TTY not supported, output might be less interactive.');
        }


        $this->line(''); // Add some spacing
        $this->line('$ '. $process->getCommandLine()); // Show the command being run

        try {
            // Run the process and stream output to the console
             $process->mustRun(function ($type, $buffer) {
                $this->output->write($buffer);
            });
            return true; // Command succeeded
        } catch (ProcessFailedException $exception) {
            $this->error("Process failed: " . $exception->getMessage());
            return false; // Command failed
        }
    }
}
