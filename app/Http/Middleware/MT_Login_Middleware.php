<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MT_Login_Middleware
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
        if($request->session()->exists('session_key')){
            #if user already logged in
            return $next($request);
        }
        else{
            # if user not logged in
            return redirect('/login');
        }
    }
}
