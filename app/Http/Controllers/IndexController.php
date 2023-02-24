<?php

namespace App\Http\Controllers;

use App\Jobs\BusfailJobTest;
use App\Jobs\DispacthingJobTest;
use App\Jobs\DispatchAfterResponseTest;
use App\Jobs\FailingJob;
use App\Jobs\Jobbatchable;
use App\Jobs\Jobbatchable2;
use Illuminate\Bus\Batch;
use App\Jobs\JobmiddlewareTest;
use App\Jobs\JobSeparateMiddleware;
use App\Jobs\OverlapsJob;
use App\Jobs\PriorityTest;
use App\Jobs\ProcessPodcast;
use App\Jobs\RateLimitJobTest;
use App\Jobs\ReleasingAJob;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Bus;


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
        //JobmiddlewareTest::dispatch();
        //JobSeparateMiddleware::dispatch();
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

        //ReleasingAJob::dispatch();


        //FailingJob::dispatch();


        //Jobbatchable::dispatch();


        // $batch = Bus::batch([
        //     new Jobbatchable,
        //     //new BusfailJobTest
        // ])->then(function (Batch $batch) {
        //    var_dump('semua job selsai');
        // })->catch(function (Batch $batch, Throwable $e) {
        //     var_dump('job pertama agagal');
        // })->finally(function (Batch $batch) {
        //     var_dump('job selesai di execute');
        //     // The batch has finished executing...
        // })->name('ANDI')->dispatch();
        // return $batch->id;

        // $batch = Bus::batch([
        //     new Jobbatchable,
        //     //new BusfailJobTest
        // ])->then(function (Batch $batch) {
        //    var_dump('semua job selsai');
        // })->catch(function (Batch $batch, Throwable $e) {
        //     var_dump('job pertama agagal');
        // })->finally(function (Batch $batch) {
        //     var_dump('job selesai di execute');
        //     // The batch has finished executing...
        // })->onConnection("database")->onQueue("hoerudin")->name('ANDI')->dispatch();
        // return $batch->id;


        // Bus::batch([
        //     [
        //         new Jobbatchable(),
        //         new Jobbatchable2(),
        //     ],
        //     [
        //         new Jobbatchable(),
        //         new Jobbatchable2(),
        //     ],
        // ])->then(function (Batch $batch) {
        //     var_dump($batch->id);
        // })->dispatch();


        $batch=Bus::batch([
            [
                new Jobbatchable(),
                new Jobbatchable2(),
            ],
            [
                new Jobbatchable(),
                new Jobbatchable2(),
            ],
        ])->then(function (Batch $batch) {
             var_dump($batch->id);
        })->dispatch();
        echo $batch->progress();
    
    }

}
