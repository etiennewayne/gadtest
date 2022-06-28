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
        $isOnline = env('IS_ONLINE');

        if($isOnline == 1){
            return $next($request);
        }

        return response()->view('exam-online-not-allowed');
    }
}
