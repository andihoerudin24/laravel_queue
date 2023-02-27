<?php

namespace App\Http\Controllers;

use App\Jobs\GetStatusVideo;
use App\Jobs\Json2VideoJob;
use App\Models\Jsonvideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class Json2VideoController extends Controller
{
    public function index()
    {
        echo "proses";
        $json2video = DB::table("jsonvideo")->get();
        $getstatus = DB::table("jsonvideo")->get();
        Bus::chain([
            function () use($json2video) {
                foreach ($json2video as $key => $value) {
                    Json2VideoJob::dispatch($value->id);
                }
            },

            function () use($getstatus) {
                foreach ($getstatus as $key => $value) {
                    foreach ($getstatus as $key => $value) {
                        GetStatusVideo::dispatch($value->projectid,$value->id);
                    }
                }
            },
        ])->onQueue("upload_and_getstatus")->dispatch();        
    }
}
