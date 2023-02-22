<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DateTime;
use Illuminate\Support\Facades\Log;

class BusfailJobTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    //public $tries = 25;



    //public $maxExceptions = 3;

    //public $timeout = 20;


    //public $failOnTimeout = false;




    /**
     * Determine the time at which the job should timeout.
    */
    // public function retryUntil(): DateTime
    // {
    //     return now()->addMinutes(1);
    // }



    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        //$this->id;
        echo "throttling job test";
        Log::info('Releasing job back to queue after 5 seconds');
        $this->release(60);

    }
    
}
