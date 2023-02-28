<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class WebhookJOb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $projectid;

    protected $movie;
    /**
     * Create a new job instance.
    */
    public function __construct($projectid,$movie)
    {
        $this->projectid = $projectid;
        $this->movie = $movie;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        DB::transaction(function () {
            DB::table("jsonvideo")
            ->where('projectid',$this->projectid)
            ->update(
                [   
                    "url" => $this->movie["movie"]["url"],
                    "custom_data" => $this->movie
                    
                ]
            );
        });
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
    */
    public function middleware(): array
    {
        return [new WithoutOverlapping($this->projectid)];
    }

    /**
     * Handle a job failure.
    */
    public function failed(Throwable $exception): void
    {
        Log::info("WEBHOOK",["error"=>$exception->getMessage()]);
    }
}
