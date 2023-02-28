<?php

namespace App\Jobs;

use App\Models\Jsonvideo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use JSON2Video\Movie;
use DateTime;
use Illuminate\Support\Facades\DB;
use Throwable;

class ShouldBeUniqueUntilProcessingJob implements ShouldQueue,ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $projectid;

    public $id_user;
    /**
     * Create a new job instance.
     */
    public function __construct($projectid,$id_user)
    {
        $this->projectid = $projectid;
        $this->id_user = $id_user;
    }

    public function handle(): void
    {
        echo $this->projectid;
        $movie = new Movie;
        $movie->setAPIKey(config('config.token'));
        // /foreach ($getstatus as $key => $value) {
            echo $this->projectid;
            $status = $movie->getStatus($this->projectid);
            if (!$status["movie"]["success"]) {
                  $this->release();
            } else {
                DB::transaction(function () use($status) {
                    DB::table("jsonvideo")
                    ->where('id_user',$this->id_user)
                    ->where('projectid',$this->projectid)
                    ->update(
                        [   
                            "url" => $status["movie"]["url"],
                            "custom_data" => $status
                            
                        ]
                    );
                });
            }
        
    }

    public function backoff(): array
    {
        return [10, 30, 30,30,30];
    }

     /**
     * The unique ID of the job.
     */
    public function uniqueId()
    {
        return $this->projectid;
    }


     /**
     * Handle a job failure.
    */
    public function failed(Throwable $exception): void
    {
        Log::info("FAILED",$exception);
    }
}
