<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRoleMiddleware
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
        if( Auth::check() )
        {
            if( Auth::user()->role == 'admin' )
            {
                return $next($request);
            } 
            else return redirect()->route('dashboard'); 
        }
        return redirect()->route('login-page'); 
    }
}
