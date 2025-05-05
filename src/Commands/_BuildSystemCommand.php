<?php

namespace BinaryBeeTechSolutions\LaraBee\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class _BuildSystemCommand extends Command
{
    protected $signature = 'larabee:build_auto';
    protected $description = 'Run composer';

    public function handle()
    {
        $this->info('---------------------------------------------------------');
        $this->info('Running LaraBee Package v.1.0');
        $this->info('Powered by Binary Bee Tech Solutions');
        $this->info('---------------------------------------------------------');
        $this->info('---START--');
        $this->call('larabee:install-packages');
        $this->call('larabee:build-all');
        $this->info('Running database migrations...');
        if (!$this->runProcess(['php', 'artisan', 'migrate'])) return 1;
        $this->info('---------------------------------------------------------');
        $this->info('---END--');
        $this->info('---------------------------------------------------------');
        return 0; // Success
    }

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