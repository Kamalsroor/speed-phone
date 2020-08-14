<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->user() &&  Auth::guard($guard)->user()->rule == 1) {
            return $next($request);
        }
        if ($guard == 'comp_user') {
            return redirect('company');
        }
        return redirect('/');
    }
}
