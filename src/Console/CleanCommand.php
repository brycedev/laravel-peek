<?php

namespace Brycedev\Peek\Console;

use Illuminate\Console\Command;

class CleanCommand extends Command
{
    protected $signature = 'peek:clean';

    protected $description = 'Remove request entries older than the archival period';

    public function handle()
    {
        $model_class = config('peek.model');
        $records = $model_class::stale()->get();
        $count = $records->count();
        $records->each->delete();
        $this->info("$count records cleaned");
    }
}