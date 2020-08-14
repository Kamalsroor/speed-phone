<?php

namespace App\Http\Controllers\Admin;
use App\Exports\UsersExport;
use App\permission_ent_freight;

use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class ExcelController extends Controller
{
    
    public function create()
    {
        $roles = Role::get()->pluck('name', 'name');
        return view('admin.user.add', compact('roles'));    

    }

    public function userExport($id){
        $permission_ent_freight = permission_ent_freight::where('id', $id)->get()->pluck('CustomerNames');
        return Excel::download(new UsersExport($id),   '  بيان تسعر شحن رقم   '.$id. '  شحنه   ' . $permission_ent_freight[0]  .'.xlsx');


    }
}
