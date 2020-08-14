<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;

class PermissionsController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('الصلاحيات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
       $permissions = Permission::orderBy('id', 'DESC')->paginate(10);


        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('الصلاحيات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        return view('admin.permissions.add');

    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('الصلاحيات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
        $Permissions = Permission::create([
            'name' => $request->name
        ]);
        return redirect()->route('permissions.index')->with('success', 'تم اضافه الصلاحيه بنجاح');
        
    }
    
    
    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('الصلاحيات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $permission = Permission::findOrFail($id);
        
        return view('admin.permissions.edit', compact('permission'));
    }
    
    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, $id)
    {
        if (! Gate::allows('الصلاحيات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        
        return redirect()->route('permissions.index')->with('success', 'تم تعديل الصلاحيه بنجاح');
    }
    
    
    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        if (! Gate::allows('الصلاحيات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $Permissions = Permission::where('id', $id)->first();

        if ($Permissions != null) {
            $Permissions->delete();
            return response()->json(['status' => true, 'message' => 'mobilats type has been deleted successfully']);
        } else {
            return back();
        }
    }

}
