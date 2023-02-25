<?php

namespace Elsayed85\Untouchable\Commands;

use Illuminate\Console\Command;

class UntouchableCommand extends Command
{
    public $signature = 'untouchable';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
