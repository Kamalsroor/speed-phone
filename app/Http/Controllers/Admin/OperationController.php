<?php

namespace App\Http\Controllers\Admin;

use App\operation;
use App\operationDetails;
use App\TypeOfProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class OperationController extends Controller
{
    public function index()
    {
      $Operations = operation::orderBy('id', 'DESC')->paginate(10);

        return view('admin.operation.index', compact('Operations'));
    }
    public function create()
    {
        $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();
        return view('admin.operation.add', compact('TypeOfProduct'));
    }
    // public function get_account_types() {
    //     $sub_accounts = AccountName::with(['company', 'account_type'])
    //     ->whereHas('company', function ($query) {
    //         $query->where('id', get_company()->id);
    //     })->whereHas('account_type', function ($query) {
    //         $query->where('company_id', get_company()->id);
    //     })->get();
    //     return response()->json(['data' => $sub_accounts]);
    // }

    public function store(Request $request)
    {


        $this->validate(request(), [

    //        'Quantity' => 'required|max:230',
     //       'ProductName' => 'required|max:350',
     //       'CustomerNames' => 'required|max:350',
     //       'PermissionDate' => 'required|max:50',
     //       'wight' => 'required|max:50'
        ]);
        // check on amount is integer
        // $error_amounts = [];
        // foreach ($request->Quantity as $Quantity) {
        //     preg_match("/^[0-9]{0,10}\.?[0-9]{1}?/", $Quantity, $matches);
        //     if ($Quantity !== $matches[0]) {
        //         $error_amounts[] = ['This (' . $Quantity . ') amount invalid.'];
        //     }
        // }
        // if (!empty($error_amounts)) {
        //     return response()->json(['errors' => $error_amounts], 422);
        // }

        // check on amout from equal amount to
        $all_Quantity = [];
        // $all_to = [];
        for ($i = 0; $i < count($request->ChargedAmount); $i++) {
                $all_Quantity[] = $request->ChargedAmount[$i];

        }
        $Total = array_sum($all_Quantity);

        $resourceinvoiceCCOTECAmount = $request->resourceinvoiceAmount * $request->CCOTEC;
         //
        
        $kiloAmount = $resourceinvoiceCCOTECAmount /$request->policyWeight ;
//       $Totalwight = [];

//        for ($i = 0; $i < count($request->Quantity); $i++) {
//                $Totalwight[] = $request->Quantity[$i] * $request->wight[$i] ;

//        }
 //       $TotalW = array_sum($Totalwight);
        // $total_to = array_sum($all_to);
        // $error_amount_total = ['The amount total from ( ' . money($total_from) . ' ) must be equal amount total to ( ' . money($total_to) . ' ).'];
        // $error_count_array = ['Your data is incorrect.'];
        // if ($total_from !== $total_to) {
        //     return response()->json(['errors' => [$error_amount_total]], 422);
        // }
        // if (count($request->account_type_id) == count($request->amount)
        //     && count($request->account_name_id) == count($request->amount)
        //     && count($request->action) == count($request->amount) ) {
            // save transition
            $operation = operation::create([
                'policyID' => $request->policyID,
                'resourceinvoiceID' => $request->resourceinvoiceID,
                'resourceinvoiceAmount' => $request->resourceinvoiceAmount,
                'CCOTEC' => $request->CCOTEC,
                'policyWeight' => $request->policyWeight,
                'resourceinvoiceCCOTECAmount' => $resourceinvoiceCCOTECAmount,
                'kiloAmount' => $kiloAmount,
                'AllAmount' => $Total,
            ]);
            // save transition details
            for ($x = 0; $x < count($request->ChargedAmount); $x++) {
                operationDetails::create([

                    'operationID' => $operation->id,

                    'typeID' => $request->typeID[$x],
                    'Product' => $request->Product[$x],
                    'ChargedAmount' => $request->ChargedAmount[$x],
                    'CustomerName' => $request->CustomerName[$x]
                ]);
            }
            // return redirect()->route('users.index')->with('success',  ' has been updated successfully');

            return response()->json([
                'status' => true,
                'linkShowAll' => 'Preview all <a href="' . route('operation.index') . '">operation</a>.',
                'message' => 'تمت اضافه الاذن بنجاح'
              ]);

              return redirect()->route('permissionex');
            return redirect('permissionex');

        // } else {
        //     return response()->json(['errors' => [$error_count_array]], 422);
        // }
    }


    // public function show($id)
    // {
    //     $permissionexfreight = permission_ex_freight::find($id);
    //     if ($permissionexfreight != null) {
    //         $permissionexfreight->user_id = $permissionexfreight->user->name;
    //         return response()->json([
    //             'status' => true,
    //             'data' => $permissionexfreight
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false
    //         ]);
    //     }
    // }
    public function show($id)
    {
        $operation = operation::where('id', $id)->first();
        if ($operation != null) {
            $operationDetails = operationDetails::where('permission_ent_id', $id)->orderBy('id', 'ASC')->get();
            return view('admin.operation.show', compact('permissionentfreight', 'permissionentfreight_details'));
        } else {
            return back();
        }
    }
    //
    public function edit($id)
    {
        // $permissionexfreight_details = permission_ex_details_freight::where('permission_ex_id', $id)->with(['company', 'transition', 'account_type', 'account_name'])->whereHas('company', function ($query) {
        //     $query->where('id', get_company()->id);
        // })->get();
        $operationDetailss = operationDetails::where('operationID', $id)->orderBy('id', 'ASC')->get();

        if ($operationDetailss->count() > 0) {
            // $account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            // $sub_accounts = AccountName::where('account_type_id', head(array_keys($account_types)))->with(['company', 'account_type'])
            // ->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->whereHas('account_type', function ($query) {
            //     $query->where('company_id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            $operationID = $id;
            $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();

            return view('admin.operation.edit', compact('operationDetailss', 'operationID','TypeOfProduct'));
        } else {
            return back();
        }
    }
    //
    public function update(Request $request, $id)
    {
        // $account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
        //     $query->where('id', get_company()->id);
        // })->get()->pluck('id')->toArray();
        // $sub_accounts = AccountName::with(['company', 'account_type'])
        // ->whereHas('company', function ($query) {
        //     $query->where('id', get_company()->id);
        // })->whereHas('account_type', function ($query) {
        //     $query->where('company_id', get_company()->id);
        // })->get()->pluck('id')->toArray();

        $this->validate(request(), [

            'Quantity' => 'required|max:320',
            'ProductName' => 'required|max:350',
            'CustomerNames' => 'required|max:350',
            'PermissionDate' => 'required|max:50',
            'wight' => 'required|max:50'
        ]);
        // $this->validate(request(), [
        //     'account_type_id.*' => [
        //         'required',
        //         Rule::in($account_types)
        //     ],
        //     'account_name_id.*' => [
        //         'required',
        //         Rule::in($sub_accounts)
        //     ],
        //     'action.*' => 'required|in:from,to',
        //     'amount.*' => 'required|max:13|regex:/^[0-9]{0,10}\.?[0-9]{1,2}/',
        //     'description' => 'required|string|max:1000'
        // ]);
        // check on amount is integer
        // $error_amounts = [];
        // foreach ($request->Quantity as $Quantity) {
        //     preg_match("/^[0-9]{0,10}\.?[0-9]{1,2}/", $Quantity, $matches);
        //     if ($amount !== $matches[0]) {
        //         $error_amounts[] = ['This (' . $Quantity . ') amount invalid.'];
        //     }
        // }
        // if (!empty($error_amounts)) {
        //     return response()->json(['errors' => $error_amounts], 422);
        // }

        // check on amout from equal amount to
        // $all_from = [];
        // $all_to = [];
        // for ($i = 0; $i < count($request->amount); $i++) {
        //     if ($request->action[$i] == 'from') {
        //         $all_from[] = $request->amount[$i];
        //     } else if ($request->action[$i] == 'to') {
        //         $all_to[] = $request->amount[$i];
        //     }
        // }
        // $total_from = array_sum($all_from);
        // $total_to = array_sum($all_to);
        // $error_amount_total = ['The amount total from ( ' . money($total_from) . ' ) must be equal amount total to ( ' . money($total_to) . ' ).'];
        // $error_count_array = ['Your data is incorrect.'];
        // if ($total_from !== $total_to) {
        //     return response()->json(['errors' => [$error_amount_total]], 422);
        // }

        $all_Quantity = [];
        // $all_to = [];
        for ($i = 0; $i < count($request->Quantity); $i++) {
                $all_Quantity[] = $request->Quantity[$i];

        }
        $Total = array_sum($all_Quantity);

        $Totalwight = [];

        for ($i = 0; $i < count($request->Quantity); $i++) {
                $Totalwight[] = $request->Quantity[$i] * $request->wight[$i] ;

        }
        $TotalW = array_sum($Totalwight);


        if (count($request->ProductName) == count($request->Quantity)
            && count($request->id) == count($request->Quantity) ) {
            // delete row removed
            $delete_ids = explode(',', $request->delete_ids);
            permission_ent_details_freight::destroy($delete_ids);

            // save transition
            $permissionentfreight = permission_ent_freight::where('id', $id)->update([
                'CustomerNames' => $request->CustomerNames,
                'PermissionDate' => $request->PermissionDate,
                'Total' => $Total,
                'TotalW' => $TotalW,
            ]);
            // save transition details
            for ($x = 0; $x < count($request->Quantity); $x++) {

              // permission_ex_details_freight::create([
              //
              //     'permission_ex_id' => $permissionexfreight->id,
              //
              //     'ProductName' => $request->ProductName[$x],
              //     'Quantity' => $request->Quantity[$x]
              // ]);


                permission_ent_details_freight::updateOrCreate(
                    [
                        'id' => $request->id[$x],
                    ],
                    [
                    'permission_ent_id' => $id,

                        'ProductName' => $request->ProductName[$x],
                        'Quantity' => $request->Quantity[$x],
                        'wight' => $request->wight[$x]
                    ]
                );
            }



            return response()->json([
                'status' => true,
                'linkShowAll' => 'Preview all <a href="' . route('permissionent.index') . '">transitions</a>.',
                'message' => 'Transition has been updated successfully'
            ]);
        } else {
            return response()->json(['errors' => [$error_count_array]], 422);
        }
    }
    //
    // public function destroy($id)
    // {
    //     // delete transtion
    //     Transition::destroy($id);
    //     // delete transtion details
    //     TransitionDetails::where('transition_id', $id)->delete();
    //     return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
    // }
}
