<?php

namespace App\Http\Controllers;

use App\Jobs\GetStatusVideo;
use App\Jobs\Json2VideoJob;
use App\Models\Jsonvideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Throwable;

class Json2VideoController extends Controller
{
    public function index()
    {
        $json2video = DB::table("jsonvideo")->get();
        //$getstatus = DB::table("jsonvideo")->limit(1)->get();
        $jobs = [];
        foreach ($json2video as $key => $value) {
            $jobs[] = new Json2VideoJob($value->id_user);
            //Json2VideoJob::dispatch($value->id_user)->onQueue("upload");
        }
        $jobs[] = new GetStatusVideo;
        //GetStatusVideo::dispatch()->onQueue("status");
        // foreach ($getstatus as $key => $value) {
        //     //$jobs[] = new GetStatusVideo($value->projectid,$value->id_user);
        //     //GetStatusVideo::dispatch($value->projectid,$value->id_user)->onQueue("status");
        // }
        Bus::chain($jobs)->catch(function (Throwable $e) {
             var_dump('error',$e->getMessage());
        })->dispatch();
        
        
        
        

                    
    }
}
