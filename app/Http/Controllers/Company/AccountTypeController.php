<?php

namespace App\Http\Controllers\Company;

use App\Http\Models\Company\AccountType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountTypeController extends Controller
{
    public function __construct() {
        $this->middleware('isAdmin:comp_user')->except('index');
    }
    public function index()
    {
        $account_types = AccountType::orderBy('id', 'desc')->with(['company', 'user'])->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->paginate(10, ['*'], 'page');
        return view('comp_user.account_types.index', compact('account_types'));
    }

    public function create()
    {
        return view('comp_user.account_types.add');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
        $account_types = AccountType::create([
            'company_id' => get_company()->id,
            'comp_user_id' => auth()->guard('comp_user')->id(),
            'name' => $request->name
        ]);
        return back()->with('success', 'Account type has been created successfully');
    }

    public function edit($id)
    {
         $account_type = AccountType::with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->where('id', $id)->first();
        if ($account_type != null) {
            return view('comp_user.account_types.edit', ['account_type' => $account_type]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $account_type = AccountType::with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->where('id', $id)->first();
        if ($account_type != null) {
            $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
            $account_type->update([
                'name' => $request->name
            ]);
            return redirect()->route('account_types.index')->with('success', 'Account type has been updated successfully');
        }
        return back()->with('delete', 'Account type not has been updated');
    }

    public function destroy($id)
    {
        $account_type = AccountType::with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->where('id', $id)->first();
        if ($account_type != null) {
            $account_type->delete();
            return response()->json(['status' => true, 'message' => 'Account type has been deleted successfully']);
        } else {
            return back();
        }
    }
}
