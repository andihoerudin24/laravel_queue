<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redis;

class JobMiddleware
{
    /**
     * Handle an incoming request.
     *
     *  @param  \Closure(object): void  $next
     */
    public function handle(object $job, Closure $next): void
    {
        Redis::throttle('andi')
        ->block(0)->allow(1)->every(30)
        ->then(function () use ($job,$next) {
            $next($job);
        }, function () use ($job) {
            $job->release(30);
        });
    }
}
