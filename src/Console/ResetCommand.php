<?php

namespace Brycedev\Peek\Console;

use Illuminate\Console\Command;

class ResetCommand extends Command
{
    protected $signature = 'peek:reset';

    protected $description = 'Remove all request entries';

    public function handle()
    {
        $model_class = config('peek.model');
        $records = $model_class::all();
        $count = $records->count();
        $records->each->delete();
        $this->info("$count records cleaned");
    }
}