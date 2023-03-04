<?php

namespace Brycedev\Peek\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'peek:publish {--force : Overwrite existing configuration }';

    protected $description = 'Publish Laravel Peek resources';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'peek-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'peek-assets',
            '--force' => true,
        ]);
    }
}