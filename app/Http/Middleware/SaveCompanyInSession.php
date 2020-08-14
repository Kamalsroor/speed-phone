<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\CompUser;

class SaveCompanyInSession
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
        $current_company = $user != null ? $user->company : collect([]);
        session()->put('current_company', json_decode(json_encode($current_company->toArray())));
        return $next($request);
    }
}
