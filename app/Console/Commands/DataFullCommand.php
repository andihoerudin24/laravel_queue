<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DataFullCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'full:video';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Full video template 60 Seconds';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        var_dump('this ok');
    }
}
