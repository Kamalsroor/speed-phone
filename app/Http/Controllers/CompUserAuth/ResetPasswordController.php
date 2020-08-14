<?php

namespace App\Http\Controllers\CompUserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CompUser;
use DB;
use Carbon;
use Rule;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guestCompUser');
    }
    
    public function showResetForm($token) {
        return view('auth.comp_user.passwords.reset', ['token' => $token]);
    }

    public function reset() {
        $token = request('token');
        $this->validate(request(), [
            'email' => 'required|email|exists:password_resets',
            'password' => 'required|string|min:6|max:16|confirmed'
        ]);
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(1))->first();
        if ($check_token != null) {
            $user = CompUser::where('email', $check_token->email)->update([
                'password' => bcrypt(request('password'))
            ]);
            $user_id = CompUser::where('email', $check_token->email)->first()->id;
            DB::table('password_resets')->where('email', $check_token->email)->delete();
            auth()->guard('comp_user')->loginUsingId($user_id);
            return redirect()->route('comp_user.dashboard');
        } else {
            return back()->with('invalid_token', 'This password reset token is invalid.');
        }
    }
}
