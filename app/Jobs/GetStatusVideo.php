<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use JSON2Video\Movie;
use DateTime;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetStatusVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $projectId;

    protected $userId;


    /**
     * Create a new job instance.
    */
    public function __construct($projectId, $userId)
    {
        $this->projectId = $projectId;
        $this->userId    = $userId;
    }

    /**
     * Execute the job.
    */
    public function handle(): void
    {
        $movie = new Movie;
        $movie->setAPIKey(config('config.token'));
        $status = $movie->getStatus($this->projectId);
        if (!$status["movie"]["success"]) {
               $this->release();
        } else {
            DB::transaction(function () use($status) {
                DB::table("jsonvideo")
                ->where('id_user',$this->userId)
                ->where('projectid',$this->projectId)
                ->update(
                    [   
                        "url" => $status["movie"]["url"],
                        "custom_data" => $status
                    ]
                );
            });
        }     
    }
    /**
        * Determine the time at which the job should timeout.
    */
    public function retryUntil(): DateTime
    {
        return now()->addMinutes(2);
    }

     /**
     * Handle a job failure.
    */
    public function failed(Throwable $exception): void
    {
        Log::info("FAILED",$exception);
    }
}
