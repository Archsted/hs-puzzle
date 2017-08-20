<?php

namespace App\Http\Middleware;

use Closure;
use Crawler;

class SiftCrawler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Crawler::isCrawler()) {
            // true if crawler user agent detected
            abort(403);
        }

        return $next($request);
    }
}
