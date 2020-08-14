<?php

namespace App\Http\Controllers\Admin;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class UserController extends Controller
{
    public function index()
    {
        if (! Gate::allows('الاعضاء')) {

            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');

        }

        $users = User::orderBy('id', 'desc')->paginate(10, ['*'], 'page');
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get()->pluck('name', 'name');
        return view('admin.user.add', compact('roles'));    

    }

    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('الاعضاء')) {

            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');

        }
        $rules = [
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:users',
            'password' => 'required|string|min:6|max:32|confirmed',
        ];
        $this->validate(request(), $rules);
        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
        ]);
        $type_user = $request->rule == 1 ? 'Admin' : 'User';
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);
        return redirect()->route('users.index')->with('success',  '  تمت اضافه العضو  '.$request->name . '  بنجاح  ');
        
        
    }
    
    public function edit($id)
    {
        if (! Gate::allows('الاعضاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $roles = Role::get()->pluck('name', 'name');
        
        $user = User::find($id);
        if ($user != null) {
            return view('admin.user.edit', compact('user' ,'roles'));
        } else {
            return back();
        }
    }
    
    public function update(Request $request, $id)
    {
        if (! Gate::allows('الاعضاء')) {

            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $user = User::find($id);
        $old_password = $user->password;
        $password_hashed = $request->password == null ? $old_password : bcrypt($request->password);
        
        // remove required unique email on edit
        $validate_unique_email = $request->email != $user->email ? '|unique:users' : '';
        
        if ($request->password == null) {
            $this->validate(request(), [
                'name' => 'required|string|max:150',
                'email' => 'required|string|email|max:150' . $validate_unique_email,
                'rule' => 'in:1,0',
                'status' => 'in:1,0'
            ]);
        } else {
            $this->validate(request(), [
                'name' => 'required|string|max:150',
                'email' => 'required|string|email|max:150' . $validate_unique_email,
                'password' => 'required|string|min:6|max:32|confirmed',

                ]);
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            'password' => $password_hashed,

        ]);
        $type_user = $request->rule == 1 ? 'Admin' : 'User';

        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success',  '  تمت تعديل العضو  '.$request->name . '  بنجاح  ');
    }
    
    public function destroy($id)
    {
        if (! Gate::allows('الاعضاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $user = User::find($id);
        $user_rule = auth()->user()->rule;
        if ($user_rule == 0 && $user->rule == 1) {
            return back();
        } else {
            if ($id != 1) {
                $user->delete();
                return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
            } else {
                return back();
            }
        }
    }

    public function userExport($type){
        $users = user::get()->toArray();
        return \Excel::create('Products', function($excel) use ($users) {
            $excel->sheet('Product Details', function($sheet) use ($users)
            {
                $sheet->fromArray($users);
            });
        })->download($type);
    }
}
