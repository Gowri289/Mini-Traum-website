<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MT_Logout_Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('session_key')){
            return redirect('/dashboard');
        }
            return $next($request);
    }
}
