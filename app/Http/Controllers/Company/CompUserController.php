<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\CompUser;
use App\Company;
use Illuminate\Http\Request;

class CompUserController extends Controller
{
    public function __construct() {
        $this->middleware('isAdmin:comp_user')->except(['edit', 'update']);
    }
    public function index()
    {
        $users = CompUser::orderBy('id', 'desc')->with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->paginate(10, ['*'], 'page');
        return view('comp_user.users.index', compact('users'));
    }
    public function show($id) {
        $user = CompUser::find($id);
        if ($user != null) {
            $user->status = $user->status == 0 ? 'Inactive' : 'Active';
            $user->rule = $user->rule == 0 ? 'User' : 'Admin';
            $user->approved = $user->approved == 0 ? 'Not Enabled' : 'Enabled';
            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function edit($id)
    {
        $user = CompUser::find($id);
        if ($user != null) {
            if (auth()->guard('comp_user')->user()->rule === 1 || auth()->guard('comp_user')->user()->rule === 0 && $id == auth()->guard('comp_user')->id()) {
                return view('comp_user.users.edit', ['user' => $user]);
            }
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $user = CompUser::find($id);
        if ($user != null) {
            if (auth()->guard('comp_user')->user()->rule === 1 || auth()->guard('comp_user')->user()->rule === 0 && $id == auth()->guard('comp_user')->id()) {
                $password_hashed = $request->password == null ? $user->password : bcrypt($request->password);
                $password_validate = $request->password == null ? 'nullable' : 'required|string|min:6|max:32|confirmed';

                // remove required unique email on edit
                $validate_unique_email = $request->email != $user->email ? '|unique:comp_users' : '';
                $rules = [
                    'name' => 'required|string|max:150',
                    'email' => 'required|string|email|max:150' . $validate_unique_email,
                    'password' => $password_validate,
                    'phone' => 'nullable|regex:/^\+?\d{10,14}$/',
                    'work_place' => 'required|string|max:150',
                    'job' => 'required|string|max:150'
                ];
                $user_update = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $password_hashed,
                    'phone' => $request->phone,
                    'work_place' => $request->work_place,
                    'job' => $request->job
                ];
                // check user admin 
                if (auth()->guard('comp_user')->user()->rule !== 0) {
                    $rules['rule'] = 'in:1,0';
                    $rules['status'] = 'in:1,0';
                    $user_update['rule'] = $request->rule;
                    $user_update['status'] = $request->status;
                }
                $this->validate(request(), $rules);
                $user->update($user_update);
                $type_user = $user->rule == 1 ? 'Admin' : 'User';
                if (auth()->guard('comp_user')->user()->rule == 1) {
                    return redirect()->route('c_users.index')->with('success', $type_user . ' has been updated successfully');
                } else {
                    return back()->with('success', $type_user . ' has been updated successfully');
                }
            }
        }
        return back();
    }

    public function destroy($id)
    {
        $user = CompUser::find($id);
        if ($user != null) {
            $user_rule = auth()->guard('comp_user')->user()->rule;
            if ($user_rule == 0 || auth()->guard('comp_user')->id() == $id) {
                return back();
            } else {
                $user->delete();
                return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
            }
        } else {
            return back();
        }
    }
}
