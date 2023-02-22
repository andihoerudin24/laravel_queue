<?php

namespace App\Jobs;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ReleasingAJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //public $tries = 3;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->release(1);
        echo "release";
        Log::info('Releasing job setiap 5 detik');
    }

   
}
