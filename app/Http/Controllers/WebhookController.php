<?php

namespace App\Http\Controllers;

use App\Jobs\WebhookJOb;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function index(Request $request)
    {
       $movie = $request->all();
       WebhookJOb::dispatch($movie["movie"]["project"],$movie)->onQueue("webhook"); 
       return response()->json([
            "status" => "ok"
       ],200);
    }

    public function data()
    {
        $datafull = [];
        $datanotfull=[];
        $config=config('config.datadoa');
        foreach ($config as $key => $value) {
            if (count($config[$key]) == 10 ) {
                array_push($datafull,$config[$key]);
            } else {
                array_push($datanotfull,$config[$key]);
            }
        }
    }
}
