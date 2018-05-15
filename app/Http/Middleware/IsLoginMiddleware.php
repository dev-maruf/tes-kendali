<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsLoginMiddleware
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
        
        if(Auth::check()){
            $expire = \Carbon\Carbon::now()->addMinutes(2);
            \Cache::put('user-online-'.Auth::user()->id, true, $expire);
        }
        return $next($request);
    }
}
