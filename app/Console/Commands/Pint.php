<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Pint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pint';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Check user wants to proceed
        if (! $this->confirm('Are you sure you want to proceed?')) {
            exit;
        }

        // Check operating system
        $os = strtoupper(PHP_OS);
        // Define command suppression by operating system
        $accessor = str_contains($os, 'WIN') ? 'php ' : './';

        // Find all uncommitted files
        $output = shell_exec('git diff --name-only');
        $file_paths = explode("\n", trim($output));
        $file_paths = array_filter($file_paths);

        // Run Pint on each found file
        foreach ($file_paths as $file_path) {
            $command = "{$accessor}vendor/bin/pint $file_path";
            $this->info("Running [$command]");
            echo shell_exec($command)."\n";
        }

        $this->info('Pint finished');
    }
}
