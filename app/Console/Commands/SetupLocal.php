<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SetupLocal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:local {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build local environment from scratch';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if .env needs creating
        if (! File::exists(base_path('.env'))) {
            echo "Copying .env.example to .env...\n";
            File::copy(base_path('.env.example'), base_path('.env'));
            echo "Please run command again...\n";
            exit;
        }

        if (config('app.env') !== 'local') {
            echo "Command can only be run in local environments...\n";
            exit;
        }

        if (! $this->option('force') && ! $this->confirm('Are you sure you want to proceed?')) {
            echo "Aborting...\n";
            exit;
        }

        // Check operating system
        $os = strtoupper(PHP_OS);
        // Define command suppression by operating system
        $suppressor = str_contains($os, 'WIN') ? ' > NUL 2>&1' : ' > /dev/null 2>&1 &';

        echo "Checking database connection...\n";
        try {
            DB::connection()->getPdo();
            echo "Database connection is valid. \n";
        } catch (\Exception $e) {
            echo "Could not connect to the database. \n";
            echo 'Error: '.$e->getMessage()."\n";
            exit;
        }

        sleep(1);
        echo "Composer Install...\n";
        shell_exec('composer install'.$suppressor);

        sleep(1);
        echo "Generating new key...\n";
        $this->callSilent('key:generate');

        sleep(1);
        echo "Creating test environment...\n";
        $this->callSilent('migrate:fresh');
        $this->callSilent('db:seed');
        // TODO - Build test service

        sleep(1);
        echo "Clearing caches...\n";
        shell_exec('composer dump-autoload'.$suppressor);
        $this->callSilent('cache:clear');

        sleep(1);
        echo "Setting SSL verification to false, this is to avoid SSL issues locally, do not do this on a live environment!\n";
        $command = "sed -i.bak \"s/'verify' *=> *true/'verify' => false/\" ./vendor/guzzlehttp/guzzle/src/Client.php";
        shell_exec($command.$suppressor);

        sleep(1);
        echo "Creating git pre commit hooks\n";
        // Path to the pre-commit hook file
        $hook_file_path = base_path('.git/hooks/pre-commit');

        // Create the .git/hooks directory if it doesn't exist
        if (! File::exists(dirname($hook_file_path))) {
            File::makeDirectory(dirname($hook_file_path), 0755, true);
        }

        // Write the hook script to the pre-commit file
        $hook_script = "#!/bin/sh \n# Get the list of staged PHP files\nfiles=$(git diff --cached --name-only --diff-filter=ACM -- '*.php')\n\n# Check if files variable is not empty\nif [ -n \"".
            '$files'."\" ]; then\n    # Run pint with the list of files\n    vendor/bin/pint ".
            '$files'."\nelse \n    echo \"No PHP files to lint\"\nfi";

        File::put($hook_file_path, $hook_script);

        // Make the hook script executable
        chmod($hook_file_path, 0755);

        sleep(1);
        echo "Node Install...\n";
        shell_exec('npm install'.$suppressor);

        sleep(1);
        echo "Npm build...\n";
        shell_exec('npm run build'.$suppressor);

        sleep(1);
        echo "Setup Complete.\n";
    }
}
