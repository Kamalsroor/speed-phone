<?php

namespace App\Http\Controllers\CompUserAuth;

use App\Http\Controllers\Controller;
use App\CompUser;
use Carbon;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guestCompUser')->except(['logout']);
    }

    public function showLoginForm() {
        return view('auth.comp_user.login');
    }

    public function login() {
        $remember = request()->has('remember') ? true : false;
        $user = CompUser::where('email', request('email'))->first();
        $error = null;
        if ($user != null && password_verify(request('password'), $user->password)) {
            if ($user->company->status == 1) {
                // Check has approved
                if ($user->approved == 1) {
                    // check on expire date comp user
                    if ($user->date_expire > Carbon::now() && $user->date_approved < Carbon::now()) {
                        // check on status comp user [ status enabled and disabled from company ]
                        if ($user->status == 1) {
                            auth()->guard('comp_user')->login($user, $remember);
                            return redirect()->intended('company/dashboard');
                        } else {
                            $error = 'This account is disabled.';
                        }
                    } else {
                        $error = 'This account has expired login.';
                    }
                } else {
                    $error = 'This account is pending activation.';
                }
            } else {
                $error = 'The company for this account is disabled.';
            }
        } else {
            $error = 'These credentials do not match our records.';
        }
    if ($error != null) {
        return back()->withInput()->withErrors(['email' => $error]);
    }
}
    
    public function logout() {
        auth()->guard('comp_user')->logout();
        return redirect()->route('comp_user.login');
    }
}
