<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('id', 'DESC')->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }
    
    public function create_captcha(Request $request) {
        $form_name = 'form_contact';
        $code = $request->_captcha_code;
        $exists_code = \DB::table('captcha')->where('form', $form_name)->count();
        if ($exists_code > 0) {
            \DB::table('captcha')->update(['code' => $code, 'created_at' => date('Y-m-d h:i:s')]);
        } else {
            \DB::table('captcha')->insert(['form' => $form_name, 'code' => $code, 'created_at' => date('Y-m-d h:i:s')]);
        }
    }

    public function store(Request $request)
    {
        // validation
        $rules = [
            'name' => 'required|string|max:100',
            'phone' => 'required|regex:/^\+?\d{10,14}$/',
            'email' => 'required|email|max:100',
            'address' => 'required|string|max:150',
            'city' => 'required|string|max:50',
            'country' => 'required|string|max:50',
            'postcode' => 'required|integer|max:999999',
            'message' => 'required|string|max:1000',
        ];
        $this->validate(request(), $rules);
        $captcha_code = \DB::table('captcha')->where('form', 'form_contact')->first()->code;
        if (strtolower($request->captcha) != strtolower($captcha_code)) {
            return back()->withInput()->withErrors(['captcha' => __('home.error_captcha')]);
        }
        Message::create($request->except('_token'));
        return back()->with('success', __('home.message_sent'));
    }
   
    public function viewMessage($id)
    {
        $message = Message::find($id);
        if ($message != null) {
            $view = 0;
            if ($message->view == 0) {
                $message->update(['view' => 1]);
                $view = 1;
            }
            return response()->json([
                'status' => true,
                'view' => $view,
                'message' => $message
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        if ($message != null) {
            $message->delete();
            return response()->json(['status' => true, 'message' => 'Message has been deleted successfully']);
        } else {
            return back();
        }
    }
}
