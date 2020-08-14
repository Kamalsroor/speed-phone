<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class GuestCompUser
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
        if (!Auth::guard('comp_user')->check()) {  // is guest
            return $next($request);
        }
        return redirect()->route('comp_user.dashboard');
    }
}
