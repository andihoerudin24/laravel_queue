<?php

namespace App\Http\Controllers;

use App\Jobs\BusfailJobTest;
use App\Jobs\DispacthingJobTest;
use App\Jobs\DispatchAfterResponseTest;
use App\Jobs\FailingJob;
use App\Jobs\Jobbatchable;
use App\Jobs\Jobbatchable2;
use App\Jobs\JobmiddlewareTest;
use App\Jobs\JobSeparateMiddleware;
use App\Jobs\OverlapsJob;
use App\Jobs\PriorityTest;
use App\Jobs\ProcessPodcast;
use App\Jobs\RateLimitJobTest;
use App\Jobs\ReleasingAJob;
use App\Jobs\ShowProgressJob;
use App\Jobs\SkipIfBatchCancelledJob;
use App\Jobs\SynchronousJobTest;
use App\Jobs\TestDependencyJob;
use App\Jobs\TestModelJob;
use App\Jobs\TestUniqueJobs;
use App\Jobs\ThrottlingJobTest;
use App\Mail\MyTestMail;
use App\Models\PriorityModel;
use App\Models\Product;
use Exception;
use Throwable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batch;


class IndexController extends Controller
{
    public function index()
    {
        echo "prosess";
        // ProcessPodcast::dispatch()->onQueue("emails");
        // PriorityTest::dispatch();

        
        // $tesmodeldata = new PriorityModel();
        // $tesmodeldata->name = "testnama";
        // $tesmodeldata->save();
        // TestModelJob::dispatch($tesmodeldata);
        //TestDependencyJob::dispatch();

        // $a = new PriorityModel();
        // $a->name = "testnama";
        // $a->save();
        //TestUniqueJobs::dispatch();
        // JobmiddlewareTest::dispatch();
        // JobSeparateMiddleware::dispatch();
        // $a = new Product();
        // $a->id_priorities = 34;
        // $a->name = "testnama";
        // $a->save();
        //RateLimitJobTest::dispatch(1);
        // OverlapsJob::dispatch(3);
        //ThrottlingJobTest::dispatch();

        // $a = new PriorityModel();
        // $a->name = "testnama";
        // $a->save();
        // $b=2;
        // DispacthingJobTest::dispatchUnless($b >= 3,$a);
        

        // $a = new PriorityModel();
        // $a->name = "testnama";
        // $a->save();
        // DispacthingJobTest::dispatch($a)->delay(now()->addMinutes(1));


        
        // DispatchAfterResponseTest::dispatchAfterResponse();
        // SynchronousJobTest::dispatch();

        // DB::transaction(function () {
        //     $a = new PriorityModel();
        //     $a->name = "testnama";
        //     $a->save();
        //     TestModelJob::dispatch($a);
        //     return redirect()->route('dispatch');
        // });

        // DB::transaction(function () {
        //         $a = new PriorityModel();
        //         $a->name = "testnama";
        //         $a->save();
        //         TestModelJob::dispatch($a)->afterCommit();
        //         return redirect()->route('dispatch');
        // });

        // DB::transaction(function () {
        //         $a = new PriorityModel();
        //         $a->name = "testnama";
        //         $a->save();
        //         TestModelJob::dispatch($a)->beforeCommit();
        //         return redirect()->route('dispatch');
        // });

       
        // Bus::chain([
        //     function(){
        //         $a = new PriorityModel();
        //         $a->name = "testnama";
        //         $a->save();
        //         new TestModelJob($a);
        //     },
        //     new PriorityTest,
        //     new BusfailJobTest,
        //     new SynchronousJobTest,
        // ])->dispatch();


        // Bus::chain([
        //     function(){
        //         $a = new PriorityModel();
        //         $a->name = "testnama";
        //         $a->save();
        //         new TestModelJob($a);
        //     },
        //     new PriorityTest,
        //     new SynchronousJobTest,
        // ])->onConnection('redis')->onQueue("andi")->dispatch();

        // Bus::chain([
        //     function(){
        //         $a = new PriorityModel();
        //         $a->name = "testnama";
        //         $a->save();
        //         new TestModelJob($a);
        //     },
        //     new PriorityTest,
        //     new BusfailJobTest,
        //     new SynchronousJobTest,
        // ])->catch(function (Throwable $e){
        //     echo "BusfailJobTest yang membuat error";
        //     var_dump($e->getMessage());
        // })->dispatch();

        //ProcessPodcast::dispatch()->onQueue("emails");


        //ProcessPodcast::dispatch();

        //BusfailJobTest::dispatch();


        //BusfailJobTest::dispatch();

        // ReleasingAJob::dispatch();

        // $jobs = [];

        // for ($i=0; $i < 5; $i++) { 
        //     $jobs[] = new ShowProgressJob($i);
        // }
        // $batch=Bus::batch($jobs)->then(function (Batch $batch) {
        //     // All jobs completed successfully...
        //     var_dump('All jobs completed successfully...');
        // })->catch(function (Batch $batch, Throwable $e) {
        //     // First batch job failure detected...
        //     var_dump('First batch job failure detected...');
        // })->finally(function (Batch $batch) {
        //     // The batch has finished executing...
        //     var_dump('The batch has finished executing...');
        //     var_dump($batch->totalJobs);
        //     var_dump($batch->pendingJobs);
        //     var_dump($batch->failedJobs);
        //     var_dump($batch->processedJobs());
        // })->dispatch();
        // return redirect('/dashboard?batch_id='.$batch->id);

        // $jobs = [];

        // for ($i=0; $i < 200; $i++) { 
        //     $jobs[] = new SkipIfBatchCancelledJob($i);
        // }
        // $batch=Bus::batch($jobs)->then(function (Batch $batch) {
        //     // All jobs completed successfully...
        //     var_dump('All jobs completed successfully...');
        // })->catch(function (Batch $batch, Throwable $e) {
        //     // First batch job failure detected...
        //     var_dump('First batch job failure detected...');
        // })->finally(function (Batch $batch) {
        //     // The batch has finished executing...
        //     var_dump('The batch has finished executing...');
        //     var_dump($batch->totalJobs);
        //     var_dump($batch->pendingJobs);
        //     var_dump($batch->failedJobs);
        // })->dispatch();


        // $batch = Bus::batch([
        //     new Jobbatchable2,
        //     new BusfailJobTest
        //     ])->then(function (Batch $batch) {
        //     var_dump('All jobs completed successfully...');
        // })->allowFailures()->dispatch();


        $finaldata = [];
        $aa = [];
        $datatext = config('config.text');
        $start  = config('config.start');
        foreach ($datatext as $key => $value) {
               foreach ($value as $key2 => $value2) {
                    var_dump($value2);
               }
               foreach ($start as $key4 => $value4) {
                   var_dump($key4);
               }
        }
        //var_dump($datatext);
        
        // foreach ($datatext as $key => $value) {
        //      foreach ($value as $key2 => $value2) {
        //          var_dump($value2);
        //      }
        // }
       //var_dump($aa);
    
    }

    public function dashboard(Request $request)
    {
       $batch = null;
       if($request->batch_id){
            $batch = Bus::findBatch($request->batch_id);
       }
       return view('dashboard',compact('batch'));
    }

}
