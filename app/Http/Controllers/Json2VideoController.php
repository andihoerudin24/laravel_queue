<?php

namespace App\Http\Controllers;

use App\Jobs\GetStatusVideo;
use App\Jobs\Json2VideoJob;
use App\Jobs\Json2VideoJob60;
use App\Jobs\ShouldBeUniqueUntilProcessingJob;
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
        $jobs = [];
        foreach ($json2video as $key => $value) {
            $jobs[] = new Json2VideoJob($value->id_user);
        }
        //$jobs[] = new GetStatusVideo;
        Bus::chain($jobs)->catch(function (Throwable $e) {
             var_dump('error',$e->getMessage());
        })->dispatch();


        // foreach ($json2video as $key => $value) {
        //     ShouldBeUniqueUntilProcessingJob::dispatch($value->id,$value->id_user);
        // }

                    
    }

    public function index60()
    {
        $json2video = DB::table("jsonvideo")->get();
        $jobs = [];
        foreach ($json2video as $key => $value) {
            $jobs[] = new Json2VideoJob60($value->id_user);
        }
        //$jobs[] = new GetStatusVideo;
        Bus::chain($jobs)->catch(function (Throwable $e) {
             var_dump('error',$e->getMessage());
        })->dispatch();
    }
}
