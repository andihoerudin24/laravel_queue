<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\Middleware\WithoutOverlapping;


class RateLimitJobTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
       $this->id = $id;
    }

    public function getJobGroup()
    {
        return $this->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        echo "rate limit permenit 1";
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [(new RateLimited('backups'))->dontRelease()];
    }


}
