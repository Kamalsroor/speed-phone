<?php

namespace App\Http\Controllers\Company;

use App\Http\Models\Company\Transition;
use App\Http\Models\Company\TransitionDetails;
use App\Http\Models\Company\AccountType;
use App\Http\Models\Company\AccountName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class TransitionDetailsController extends Controller
{
    public function index()
    {
        $transitions_details = TransitionDetails::orderBy('transition_id', 'desc')->with(['company', 'user', 'transition', 'account_type', 'account_name'])->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->paginate(10, ['*'], 'page');
        return view('comp_user.transitions_details.index', compact('transitions_details'));
    }
    public function create()
    {
        $get_account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->get();
        $account_types = [];
        foreach ($get_account_types as $type) {
            $account_types[$type->id] = $type->name;
        }
        $get_sub_accounts = AccountName::where('account_type_id', head(array_keys($account_types)))->with(['company', 'account_type'])
        ->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->whereHas('account_type', function ($query) {
            $query->where('company_id', get_company()->id);
        })->get();
        $sub_accounts = [];
        foreach ($get_sub_accounts as $account) {
            $sub_accounts[$account->id] = $account->name;
        }
        return view('comp_user.transitions.add', compact('transitions', 'account_types', 'sub_accounts'));
    }
    public function get_account_types() {
        $sub_accounts = AccountName::with(['company', 'account_type'])
        ->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->whereHas('account_type', function ($query) {
            $query->where('company_id', get_company()->id);
        })->get();
        return response()->json(['data' => $sub_accounts]);
    }

    public function store(Request $request)
    {
        $get_account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->get();
        $account_types = [];
        foreach ($get_account_types as $type) {
            $account_types[] = $type->id;
        }
        $get_sub_accounts = AccountName::with(['company', 'account_type'])
        ->whereHas('company', function ($query) {
            $query->where('id', get_company()->id);
        })->whereHas('account_type', function ($query) {
            $query->where('company_id', get_company()->id);
        })->get();
        $sub_accounts = [];
        foreach ($get_sub_accounts as $account) {
            $sub_accounts[] = $account->id;
        }
        $this->validate(request(), [
            'account_type_id.*' => [
                'required',
                Rule::in($account_types)
            ],
            'account_name_id.*' => [
                'required',
                Rule::in($sub_accounts)
            ],
            'action.*' => 'required|in:from,to',
            'amount.*' => 'required|max:13|regex:/^[0-9]{0,10}\.?[0-9]{1,2}/',
            'description' => 'required|string|max:1000'
        ]);
        // check on amount is integer
        $error_amounts = [];
        foreach ($request->amount as $amount) {
            preg_match("/^[0-9]{0,10}\.?[0-9]{1,2}/", $amount, $matches);
            if ($amount !== $matches[0]) {
                $error_amounts[] = ['This (' . $amount . ') it\'s not number valid.'];
            }
        }
        if (!empty($error_amounts)) {
            return response()->json(['errors' => $error_amounts], 422);
        }

        // check on amout from equal amount to
        $all_from = [];
        $all_to = [];
        for ($i = 0; $i < count($request->amount); $i++) {
            if ($request->action[$i] == 'from') {
                $all_from[] = $request->amount[$i];
            } else if ($request->action[$i] == 'to') {
                $all_to[] = $request->amount[$i];
            }
        }
        $total_from = array_sum($all_from);
        $total_to = array_sum($all_to);
        $error_amount_total = ['The amount total from ( ' . $total_from . ' ) must be equal amount total to ( ' . $total_to . ' ).'];
        $error_count_array = ['Your data is incorrect.'];
        if ($total_from !== $total_to) {
            return response()->json(['errors' => [$error_amount_total]], 422);
        }
        if (count($request->account_type_id) == count($request->amount) 
            && count($request->account_name_id) == count($request->amount) 
            && count($request->action) == count($request->amount) ) {
            // save transition 
            $transition = Transition::create([
                'company_id' => get_company()->id,
                'comp_user_id' => auth()->guard('comp_user')->id(),
                'description' => $request->description,
                'amount' => $total_from
            ]);
            // save transition details
            for ($x = 0; $x < count($request->amount); $x++) {
                TransitionDetails::create([
                    'company_id' => get_company()->id,
                    'comp_user_id' => auth()->guard('comp_user')->id(),
                    'transition_id' => $transition->id,
                    'account_type_id' => $request->account_type_id[$x],
                    'account_name_id' => $request->account_name_id[$x],
                    'action' => $request->action[$x],
                    'amount' => $request->amount[$x]
                ]);
            }
            return response()->json([
                'status' => true,
                'linkShowAll' => 'Preview all <a href="' . route('transitions.index') . '">transitions</a>.',
                'message' => 'Transition has been added successfully'
            ]);
        } else {
            return response()->json(['errors' => [$error_count_array]], 422);
        }
    }

    public function show(Transition $transition)
    {
        //
    }
    
    public function edit(Transition $transition)
    {
        //
    }

    public function update(Request $request, Transition $transition)
    {
        //
    }

    public function destroy(Transition $transition)
    {
        //
    }
}
