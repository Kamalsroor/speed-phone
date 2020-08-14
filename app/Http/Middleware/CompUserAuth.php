<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CompUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'comp_user')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('comp_user.login');
        }
        return $next($request);
    }
}
