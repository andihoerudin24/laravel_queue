<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batch;

class ShowProgressJob implements ShouldQueue
{
    use Dispatchable,Batchable, InteractsWithQueue, Queueable, SerializesModels;

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
        var_dump($this->id);
        if ($this->id === 3) {
           return $this->batch()->cancel();
        }
        if ($this->batch()->cancelled()) {
            return;
        }
       
        sleep(10);
        //$this->name;
        echo "shwo progressjob";
        
    }
}
