<?php

namespace App\Jobs;

use App\Mail\MyTestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    //public $backoff = 3;

    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->onQueue('emails');
        //$this->onConnection("redis");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $this->id;
       echo "hello";
    }

    /**
        * Calculate the number of seconds to wait before retrying the job.
    */
    // public function backoff(): int
    // {
    //     return 3;
    // }

    /**
        * Calculate the number of seconds to wait before retrying the job.
    */
    public function backoff(): array
    {
        return [1,5,20];
    }


    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
       var_dump('gagal');
        $details = [
            'title' => 'Mail from ',
            'body' => 'This is for testing email using smtp',
            'exception' => $exception
        ];
        Mail::to('taylor@example.com')->send(new MyTestMail($details));

    }


}
