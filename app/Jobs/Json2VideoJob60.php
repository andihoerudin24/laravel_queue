<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Json2VideoJob60 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userid;
    

    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct($userid)
    {
        $this->userid = $userid;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->combinedata();
    }

    private function combinedata()
    {
        $compilingdata = [];
        $finaldata = [];
        $datatext =   config('config.text60');
        echo '<pre>';print_r($datatext);die;
        
        $start    =   config('config.start');
        foreach ($datatext as $value) {
           $compilingdata[]["text"] = $value;  
        }
        
        for ($i=0; $i <= count($compilingdata) - 1 ; $i++) { 
            $finaldata[] = [
                "text" => $compilingdata[$i]["text"],
                "start" => $start[$i],
                "fadein"  => config('config.fade.fadein'),
                "fadeout" => config('config.fade.fadeout'),
                "duration" => config('config.duration')
            ];
        }
       return $finaldata;
    }
}
