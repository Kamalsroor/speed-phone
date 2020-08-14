<?php

namespace App\Http\Middleware;

use Closure;
use Carbon;
use Auth;
use App\CompUser;

class CompUserIsEnabled
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
        $user = Auth::guard('comp_user')->user();
        if ($user->company->status == 1
            && $user->approved == 1
            && $user->date_expire > Carbon::now()
            && $user->date_approved < Carbon::now()
            && $user->status == 1) 
        {
            return $next($request);

        } else {

            Auth::guard('comp_user')->logout();
            return redirect()->route('comp_user.login');

        }
    }
}
