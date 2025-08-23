<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class PintCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pint {--test : Run Pint in test mode (no changes)} {path? : File or directory to lint}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Laravel Pint code style fixer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('path') ?? base_path();
        $options = $this->option('test') ? ['--test'] : [];

        $binary = base_path('vendor/bin/pint');

        if (! file_exists($binary)) {
            $this->error('Pint is not installed. Run: composer require laravel/pint --dev');

            return Command::FAILURE;
        }

        $command = array_merge([$binary, $path], $options);

        $process = new Process($command, base_path());
        $process->setTty(Process::isTtySupported());
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        return $process->isSuccessful() ? Command::SUCCESS : Command::FAILURE;
    }
}
