<?php

namespace App\Http\Controllers\CompUserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CompUser;
use App\Mail\ResetPasswordCompUser;
use DB;
use Mail;
use Carbon;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guestCompUser');
    }
    
    public function showLinkRequestForm() {
        return view('auth.comp_user.passwords.email');
    }

    public function sendResetLinkEmail(Request $request) {
        $email = $request->email;
        $user = CompUser::where('email', $email)->where('approved', 1)->first();
        if ($user != null) {
            $token = str_random(64);
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($email)->send(new ResetPasswordCompUser(['name' => $user->name, 'token' => $token]));
            return back()->with('sent_link', 'We have e-mailed your password reset link!');
        } else {
            return back()->withInput()->withErrors(['email' => 'We can\'t find a user with that e-mail address.']);
        }
    }
}
