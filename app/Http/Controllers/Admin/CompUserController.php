<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CompUser;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon;

class CompUserController extends Controller
{

    // show all users no trashed
    public function index()
    {
        $users = CompUser::orderBy('id', 'desc')->with('company')->paginate(10, ['*'], 'page');
        $title_page = 'All Users';
        return view('admin.comp_user.index', compact('users', 'title_page'));
    }

    // show all users no trashed
    public function showCompanyUser($id)
    {
        $company = Company::find($id);
        if ($company != null) {
            $users = CompUser::withTrashed()->orderBy('id', 'desc')->with('company')->whereHas('company', function ($query) use ($id) {
                $query->where('company_id', $id);
            })->paginate(10, ['*'], 'page');
            $title_page = $company->name . ' Users';
            return view('admin.comp_user.index', compact('users', 'title_page'));
        } else {
            return back();
        }
    }

    // show only users pending
    public function showPending()
    {
        $users = CompUser::where('approved', '!=', 1)->orderBy('id', 'desc')->with('company')->paginate(10, ['*'], 'page');
        $title_page = 'Pending Users';
        return view('admin.comp_user.index', compact('users', 'title_page'));
    }


    // show only users deleted
    public function showDeleted()
    {
        $users = CompUser::onlyTrashed()->orderBy('id', 'desc')->with('company')->paginate(10, ['*'], 'page');
        $title_page = 'Deleted Users';
        return view('admin.comp_user.index', compact('users', 'title_page'));
    }


    public function show($id) {
        $user = CompUser::find($id);
        if ($user != null) {
            $user->user_id = $user->user->name;
            $user->company_id = $user->company->name;
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

    public function create()
    {
        $companeis = Company::get();
        $companeis_names = [];
        if (count($companeis) > 0) {
            foreach ($companeis as $company) {
                $companeis_names[$company->id] = $company->name;
            }
        }
        return view('admin.comp_user.add', ['companies' => $companeis_names]);
    }

    public function store(Request $request)
    {
        $companeis = Company::get();
        $ids = [];
        foreach ($companeis as $company) {
            $ids[] = $company->id;
        }
        $rules = [
            'company_id' => ['required', Rule::in($ids)],
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:comp_users',
            'password' => 'required|string|min:6|max:32|confirmed',
            'phone' => 'nullable|regex:/^\+?\d{10,14}$/',
            'work_place' => 'required|string|max:150',
            'job' => 'required|string|max:150',
            'rule' => 'in:1,0',
            'approved' => 'in:1,0',
            'date_approved' => 'required|date',
            'date_expire' => 'required|date'
        ];
        $this->validate(request(), $rules);
        // dd( Carbon::createFromFormat('Y-m-d h:i:s', $date_approved->addMonth())->toDateTimeString() );
        // dd( Carbon::now()->adddays($request->expire_time));
        // $date_expire = Carbon::createFromFormat('Y-m-d h:i:s',  Carbon::now()->adddays($request->expire_time))->toDateTimeString();
        // $date_expire = Carbon::now()->adddays($request->expire_time);
        $user = CompUser::create([
            'company_id' => $request->company_id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'work_place' => $request->work_place,
            'job' => $request->job,
            'rule' => $request->rule,
            'approved' => $request->approved,
            'date_approved' => $request->date_approved,
            'date_expire' => $request->date_expire
        ]);
        $type_user = $request->rule == 1 ? 'Admin' : 'User';
        return back()->with('success', $type_user . ' has been created successfully');
    }

    public function edit($id)
    {
        $user = CompUser::find($id);
        if ($user != null) {
            $companeis = Company::get();
            $companeis_names = [];
            if (count($companeis) > 0) {
                foreach ($companeis as $company) {
                    $companeis_names[$company->id] = $company->name;
                }
            }
            return view('admin.comp_user.edit', ['user' => $user, 'companies' => $companeis_names]);
        } else {
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $user = CompUser::find($id);
        $password_hashed = $request->password == null ? $user->password : bcrypt($request->password);
        $password_validate = $request->password == null ? 'nullable' : 'required|string|min:6|max:32|confirmed';
        // $date_expire = $request->expire_time == null ? $user->date_expire : Carbon::now()->adddays($request->expire_time);

        // remove required unique email on edit
        $validate_unique_email = $request->email != $user->email ? '|unique:comp_users' : '';

        $companeis = Company::get();
        $ids = [];
        foreach ($companeis as $company) {
            $ids[] = $company->id;
        }
        $this->validate(request(), [
            'company_id' => ['required', Rule::in($ids)],
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:150' . $validate_unique_email,
            'password' => $password_validate,
            'phone' => 'nullable|regex:/^\+?\d{10,14}$/',
            'work_place' => 'required|string|max:150',
            'job' => 'required|string|max:150',
            'rule' => 'in:1,0',
            'approved' => 'in:1,0',
            'date_approved' => 'required|date',
            'date_expire' => 'required|date'
        ]);
        $user->update([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password_hashed,
            'phone' => $request->phone,
            'work_place' => $request->work_place,
            'job' => $request->job,
            'rule' => $request->rule,
            'approved' => $request->approved,
            'date_approved' => $request->date_approved,
            'date_expire' => $request->date_expire
        ]);
        $type_user = $request->rule == 1 ? 'Admin' : 'User';
        return redirect()->route('companies_users.index')->with('success', $type_user . ' has been updated successfully');
    }

    public function destroy($id)
    {
        $user = CompUser::find($id);
        if ($user != null) {
            $user->delete();
            return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
        } else {
            return back();
        }
    }
    public function restore($id)
    {
        $user = CompUser::onlyTrashed()->where('id', $id)->first();
        if ($user != null) {
            $user->restore();
            return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
        } else {
            return back();
        }
    }

    public function force_delete($id)
    {
        $user = CompUser::onlyTrashed()->where('id', $id)->first();
        if ($user != null) {
            $user->forceDelete();
            return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
        } else {
            return back();
        }
    }
    public function approve($id) {
        $user = CompUser::withTrashed()->where('id', $id)->first();
        if ($user != null) {
            $user->approved = 1;
            $user->save();
            return response()->json(['status' => true, 'message' => 'User has been approved successfully']);
        } else {
            return back();
        }
    }
}
