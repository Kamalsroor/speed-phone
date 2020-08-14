<?php

namespace App\Http\Controllers\Company;

use App\Http\Models\Company\AccountName;
use App\Http\Models\Company\AccountType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class AccountNameController extends Controller
{
    public function index()
    {
        $sub_accounts = AccountName::orderBy('id', 'desc')->with(['company', 'user', 'account_type'])->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->paginate(10, ['*'], 'page');
        return view('comp_user.sub_accounts.index', compact('sub_accounts'));
    }

    public function create()
    {
        $account_types = AccountType::with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->get();
        $account_types_name = [];
        if (count($account_types) > 0) {
            foreach ($account_types as $type) {
                $account_types_name[$type->id] = $type->name;
            }
        }
        return view('comp_user.sub_accounts.add', ['account_types' => $account_types_name]);
    }

    public function store(Request $request)
    {
        $account_types = AccountType::with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->get();
        $ids = [];
        foreach ($account_types as $type) {
            $ids[] = $type->id;
        }
        $this->validate(request(), [ 
            'name' => 'required|string|max:150',
            'account_type_id' => [
                'required',
                Rule::in($ids)
            ]
        ]);
        $sub_account = AccountName::create([
            'company_id' => get_company()->id,
            'comp_user_id' => auth()->guard('comp_user')->id(),
            'account_type_id' => $request->account_type_id,
            'name' => $request->name
        ]);
        return back()->with('success', 'Sub account has been created successfully');
    }

    public function edit($id)
    {
        $sub_account = AccountName::with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->where('id', $id)->first();
        if ($sub_account != null) {
            $account_types = AccountType::with('company')->whereHas('company', function ($query) {
                $query->where('id', get_company()->id);
            })->get();
            $account_types_name = [];
            if (count($account_types) > 0) {
                foreach ($account_types as $type) {
                    $account_types_name[$type->id] = $type->name;
                }
            }
            return view('comp_user.sub_accounts.edit', ['sub_account' => $sub_account, 'account_types' => $account_types_name]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $sub_account = AccountName::with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->where('id', $id)->first();
        if ($sub_account != null) {
            $account_types = AccountType::with('company')->whereHas('company', function ($query) {
                $query->where('id', get_company()->id);
            })->get();
            $ids = [];
            foreach ($account_types as $type) {
                $ids[] = $type->id;
            }
            $this->validate(request(), [
                'name' => 'required|string|max:150',
                'account_type_id' => [
                    'required',
                    Rule::in($ids)
                ]
            ]);
            $sub_account->update([
                'name' => $request->name,
                'account_type_id' => $request->account_type_id
            ]);
            return redirect()->route('sub_accounts.index')->with('success', 'Sub account has been updated successfully');
        }
        return back()->with('delete', 'Sub account not has been updated');
    }

    public function destroy($id)
    {
        $sub_account = AccountName::with('company')->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->where('id', $id)->first();
        if ($sub_account != null) {
            $sub_account->delete();
            return response()->json(['status' => true, 'message' => 'Sub account has been deleted successfully']);
        } else {
            return back();
        }
    }
}
