<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TakeOnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $isOnline = 0; //manual set.. env take cache.
        //set to 0 if not allowed,
        //set 1 if allowed the exam of the application

        if($isOnline == 1){
            return $next($request);
        }

        return response()->view('exam-online-not-allowed');
    }
}
