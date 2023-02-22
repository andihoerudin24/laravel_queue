<?php

namespace App\Jobs;

use App\Models\PriorityModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;


class TestUniqueJobs implements ShouldQueue,ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $jobsId;

    /**
     * Create a new job instance.
     */
    // public function __construct($jobsId)
    // {
    //     $this->jobsId = $jobsId;
    // }

    // public $uniqueFor = 40;


    // public function uniqueId()
    // {
    //     return $this->jobsId;
    // }

    /**
     * Get the cache driver for the unique job lock.
     */
    public function uniqueVia(): Repository
    {
        return Cache::driver('database');
    }



    /**
     * Execute the job.
     */
    public function handle(): void
    {
        echo "test unique job";
        Log::info("Running Job");
    }
}
