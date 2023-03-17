<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use JSON2Video\Movie;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JSON2Video\Scene;
use Throwable;

class Json2VideoJob implements ShouldQueue
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
        $compilingdata = $this->combinedata();
        $this->buildVideo($compilingdata);
    }


    private function combinedata()
    {
        $compilingdata = [];
        $finaldata = [];
        $datatext = config('config.text');
        $start  = config('config.start');
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

    private function buildVideo($data)
    {
        $movie = new Movie;
        $movie->setAPIKey(config('config.token'));
        $movie->resolution = 'instagram-story';
        $movie->quality = 'high';
        $movie->draft = true;
        $scene1 = new Scene;
        $scene1->addElement([
            'type' => 'video',
            'src' => config('config.url')
        ]);
        foreach ($data as $key => $value) {
            $scene1->addElement([
                'type' => 'html',
                'html' => '<div class="min-w-screen font-medium font-sans absolute mx-auto w-full top-[45rem] flex items-end justify-center px-5 py-5">
                    <div class="w-full max-w-screen-md mx-auto rounded-[1.4rem] bg-white border-t-[4rem] border-solid border-yellow-500 opacity-95 shadow-lg px-5 pt-2 pb-11 text-gray-800">
                        <div class="w-full">
                            <div class="text-7xl text-emerald-700 text-left leading-tight h-3">“</div>
                            <p class="text-[2.1rem] text-gray-600 text-center px-7 break-word max-h-[16rem]">'.$value["text"][0].'</p>
                            <div class="flow-root text-7xl text-emerald-700 text-right leading-tight h-3 -mt-3">”</div>
                        </div>
            
                        <hr class="flow-root mt-9 border-solid border-emerald-800">
            
                        <div class="w-full">
                            <div class="text-7xl text-emerald-700 text-left leading-tight h-3">“</div>
                            <p class="text-[2.1rem] text-gray-600 text-center px-7 break-word max-h-[16rem] ">'.$value["text"][1].'</p>
                            <div class="flow-root text-7xl text-emerald-700 text-right leading-tight h-3 -mt-3">”</div>
                        </div>
            
                        <hr class="flow-root mt-9 border-solid border-emerald-800">
                        
                        <div class="w-full">
                            <div class="text-7xl text-emerald-700 text-left leading-tight h-3">“</div>
                            <p class="text-[2.1rem] text-gray-600 text-center px-7 break-word max-h-[16rem]">'.$value["text"][2].'</p>
                            <div class="flow-root text-7xl text-emerald-700 text-right leading-tight h-3 -mt-3">”</div>
                        </div>
            
                        <hr class="flow-root mt-9 border-solid border-emerald-800">
            
                        </div>
                    </div>',
                'tailwindcss' => true,
                'start' => $value["start"],
                'duration' =>$value["duration"][0],
                'fade-in' => $value["fadein"],
                'fade-out' => $value["fadeout"],
            ]);	
        }
        $movie->addScene($scene1);
        $movie->render();
        //$movie->waitToFinish();

        $statusmovie = $movie->getStatus();
        if ($statusmovie["success"]) {
            DB::transaction(function () use ($statusmovie)  {
                DB::table("jsonvideo")->where('id_user',$this->userid)->update(
                    [   
                        "projectid" => $statusmovie["movie"]["project"],
                        "custom_data" => $statusmovie
                    ]
                );
            });
            
        } else {
            Log::info("antrian gagal".$this->userid);
            $this->fail();
        }
        
    }


    /**
     * Handle a job failure.
    */
    public function failed(Throwable $exception): void
    {
        Log::info("FAILED",$exception->getMessage());
    }


}
