<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;

class SuperAdmin
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
      if(Auth::check() && Auth::user()->pk_roles==1) {
       return $next($request);
      }
      else {
       return redirect()->route('login');
      }
    }
}
