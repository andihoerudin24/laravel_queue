<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
 

class SkipIfBatchCancelledJob implements ShouldQueue
{
    use Dispatchable, Batchable ,InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle() 
    {
        // if ($this->id === 3) {
        //     var_dump('ssss');
        //     return $this->batch()->cancel();
        //  }
        //  if ($this->batch()->cancelled()) {
        //     var_dump('satu');
        //      return;
        //  }
        
         //sleep(10);
         echo "shwo progressjob";
    }

    // public function middleware(): array
    // {
    //     return [new SkipIfBatchCancelled];
    // }
}
