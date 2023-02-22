<?php

namespace App\Jobs;

use App\Models\PriorityModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DispacthingJobTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected PriorityModel $priority;

    /**
     * Create a new job instance.
     */
    public function __construct(PriorityModel $priority)
    {
        $this->priority = $priority;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        var_dump($this->priority->name);
    }
}
