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

    public $tries = 5;

    // protected $projectId;

    // protected $userId;


    /**
     * Create a new job instance.
    */
    public function __construct(
        //$projectId, $userId
        )
    {
        // $this->projectId = $projectId;
        // $this->userId    = $userId;
    }

    /**
     * Execute the job.
    */
    public function handle(): void
    {
        //echo $this->projectId;
        $getstatus = DB::table("jsonvideo")->get();
        $movie = new Movie;
        $movie->setAPIKey(config('config.token'));
        foreach ($getstatus as $key => $value) {
            echo $value->projectid;
            $status = $movie->getStatus($value->projectid);
            if (!$status["movie"]["success"]) {
                  $this->release();
            } else {
                DB::transaction(function () use($value,$status) {
                    DB::table("jsonvideo")
                    ->where('id_user',$value->id_user)
                    ->where('projectid',$value->projectid)
                    ->update(
                        [   
                            "url" => $status["movie"]["url"],
                            "custom_data" => $status
                            
                        ]
                    );
                });
            }
        }
        
    }

    public function backoff(): array
    {
        return [10, 30, 30,30,30];
    }


     /**
     * Handle a job failure.
    */
    public function failed(Throwable $exception): void
    {
        Log::info("FAILED",$exception);
    }
}
