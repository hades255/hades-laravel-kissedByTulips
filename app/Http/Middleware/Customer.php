<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Customer
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
      if(Auth::check() && Auth::user()->pk_roles==4) {
       return $next($request);
      }
      else {
       return redirect()->route('login');
      }
    }
}
