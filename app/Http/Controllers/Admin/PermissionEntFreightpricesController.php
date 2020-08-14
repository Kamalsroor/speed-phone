<?php

namespace App\Http\Controllers\Admin;

use App\permission_ent_freight;
use App\permission_ent_details_freight;
use App\TypeOfProduct;
use App\Customersfreight;
use App\AccountCustomers;

use App\Customers;
use Excel;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class PermissionEntFreightpricesController extends Controller
{
    public function index()
    {
        if (! Gate::allows('اذون اضافه شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        
        $PermissionEnt = permission_ent_freight::orderBy('id', 'DESC')->paginate(50);
        
        return view('admin.PermissionEntFreight.index', compact('PermissionEnt'));
    }
    public function create()
    {
        if (! Gate::allows('اذون اضافه شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();
        $Customers = Customersfreight::get()->pluck('name', 'id')->toArray();
        return view('admin.PermissionEntFreight.add', compact('TypeOfProduct','Customers'));

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
        if (! Gate::allows('اذون اضافه شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $this->validate(request(), [

            'QuantityCharged.*' => 'required|max:230',
           'ProductName.*' => 'required|max:350',
            'customernames.*' => 'required|max:350',
            'TypeOfProduct.*' => 'required|max:350',
            'CustomerNames' => 'required|max:350',
            'PermissionDate' => 'required|max:50',
           // 'wight.*' => 'required|max:50'
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
        for ($i = 0; $i < count($request->Quantityrecipient); $i++) {
                $all_Quantity[] = $request->Quantityrecipient[$i];

        }
        $Total = array_sum($all_Quantity);

        $Totalwight = [];

        for ($i = 0; $i < count($request->Quantityrecipient); $i++) {
                $Totalwight[] = $request->Quantityrecipient[$i] * $request->wight[$i] ;

        }
        $TotalW = array_sum($Totalwight);
        // $total_to = array_sum($all_to);
        // $error_amount_total = ['The amount total from ( ' . money($total_from) . ' ) must be equal amount total to ( ' . money($total_to) . ' ).'];
        $error_count_array = ['Your data is incorrect.'];
        // if ($total_from !== $total_to) {
        //     return response()->json(['errors' => [$error_amount_total]], 422);
        // }
        // if (count($request->account_type_id) == count($request->amount)
        //     && count($request->account_name_id) == count($request->amount)
        //     && count($request->action) == count($request->amount) ) {
            // save transition
        $user_id = auth()->id();

            $permissionentfreight = permission_ent_freight::create([
                'CustomerNames' => $request->CustomerNames,
                'PermissionDate' => $request->PermissionDate,
                'Total' => $Total,
                'TotalW' => $TotalW,  
                'user_id' => $user_id,  
            ]);
            // save transition details
            for ($x = 0; $x < count($request->ProductName); $x++) {
                $Forlack = $request->QuantityCharged[$x] - $request->Quantityrecipient[$x];
                permission_ent_details_freight::create([

                    'permission_ent_id' => $permissionentfreight->id,
                    'ProductName' => $request->ProductName[$x],
                    'type_id' => $request->TypeOfProduct[$x],
                    'QuantityCharged' => $request->QuantityCharged[$x],
                    'Quantityrecipient' => $request->Quantityrecipient[$x],
                    'customernames' => $request->customernames[$x],
                    'user_id' => $user_id,  
                    'Forlack' => $Forlack,  
                    'wight' => $request->wight[$x]
                ]);
            }
            // return redirect()->route('users.index')->with('success',  ' has been updated successfully');

            return response()->json([
                'status' => true,
                'linkShowAll' => '<a href="' . route('permissionent.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',

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

        $AccountCustomers = AccountCustomers::where('accountss', 2)->where('permissionEntId',$id)->get();
        $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();
        $Customers = Customersfreight::get()->pluck('name', 'id')->toArray();
        $permissionentfreight = permission_ent_freight::where('id', $id)->first();
        if ($permissionentfreight != null) {
            $permissionentfreight_details = permission_ent_details_freight::where('permission_ent_id', $id)->orderBy('id', 'ASC')->get();
            return view('admin.PermissionEntFreight.show2', compact('permissionentfreight', 'permissionentfreight_details','TypeOfProduct','Customers','AccountCustomers'));
        } else {
            return back();
        }
    }
    //
    public function edit($id)
    {
        if (! Gate::allows('اذون اضافه شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        // $permissionexfreight_details = permission_ex_details_freight::where('permission_ex_id', $id)->with(['company', 'transition', 'account_type', 'account_name'])->whereHas('company', function ($query) {
        //     $query->where('id', get_company()->id);
        // })->get();
        $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();
        $Customers = Customersfreight::get()->pluck('name', 'id')->toArray();
        $permissionentfreight_details = permission_ent_details_freight::where('permission_ent_id', $id)->orderBy('id', 'ASC')->get();

        if ($permissionentfreight_details->count() > 0) {
            // $account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            // $sub_accounts = AccountName::where('account_type_id', head(array_keys($account_types)))->with(['company', 'account_type'])
            // ->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->whereHas('account_type', function ($query) {
            //     $query->where('company_id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            $permission_ent_id = $id;

            return view('admin.PermissionEntFreight.edit', compact('permissionentfreight_details', 'permission_ent_id','Customers','TypeOfProduct'));
        } else {
            return back();
        }
    }
    //
  


    public function pricing($id)
    {
        if (! Gate::allows('admin')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        // $permissionexfreight_details = permission_ex_details_freight::where('permission_ex_id', $id)->with(['company', 'transition', 'account_type', 'account_name'])->whereHas('company', function ($query) {
        //     $query->where('id', get_company()->id);
        // })->get();
        $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();
        $Customers = Customersfreight::get()->pluck('name', 'id')->toArray();
        $permissionentfreight_details = permission_ent_details_freight::where('permission_ent_id', $id)->orderBy('id', 'ASC')->get();

        if ($permissionentfreight_details->count() > 0) {
            // $account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            // $sub_accounts = AccountName::where('account_type_id', head(array_keys($account_types)))->with(['company', 'account_type'])
            // ->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->whereHas('account_type', function ($query) {
            //     $query->where('company_id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            $permission_ent_id = $id;

            return view('admin.PermissionEntFreight.edit2', compact('permissionentfreight_details', 'permission_ent_id','Customers','TypeOfProduct'));
        } else {
            return back();
        }
    }
    //
    public function update(Request $request, $id)
    {
        if (! Gate::allows('اذون اضافه شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        
        $this->validate(request(), [

      //      'QuantityCharged.*' => 'required|max:330',
    //        'ProductName.*' => 'required|max:350',
         //   'customernames.*' => 'required|max:350',
       //     'TypeOfProduct.*' => 'required|max:350',
      //     'CustomerNames' => 'required|max:350',
       //     'PermissionDate' => 'required|max:350',
        ]);

        // $account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
        //     $query->where('id', get_company()->id);
        // })->get()->pluck('id')->toArray();
        // $sub_accounts = AccountName::with(['company', 'account_type'])
        // ->whereHas('company', function ($query) {
        //     $query->where('id', get_company()->id);
        // })->whereHas('account_type', function ($query) {
        //     $query->where('company_id', get_company()->id);
        // })->get()->pluck('id')->toArray();

    
 
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
        $error_count_array = ['Your data is incorrect.'];
        // if ($total_from !== $total_to) {
            //     return response()->json(['errors' => [$error_amount_total]], 422);
            // }

            $user_id = auth()->id();
            //     if (count($request->ProductName) == count($request->QuantityCharged)
            //        && count($request->TypeOfProduct) == count($request->QuantityCharged) ) {
                // delete row removed
                $delete_ids = explode(',', $request->delete_ids);
                permission_ent_details_freight::destroy($delete_ids);
            // save transition
            $permissionentfreight = permission_ent_freight::where('id', $id)->update([
                'Policynumber' => $request->Policynumber,
                'extrafees' => $request->extrafees,
                'weightawb' => $request->weightawb,
                'invoicevalue' => $request->invoicevalue,
                'rate' => $request->rate,
                'Priceperkilo' => $request->Priceperkiloe,
                'user_id'=> $user_id,
            ]);
            // save transition details
            for ($x = 0; $x < count($request->ProductName); $x++) {
                

                
                permission_ent_details_freight::updateOrCreate(
                    [
                        'id' => $request->id[$x],
                    ],
                    [
                        'permission_ent_id' => $id,

                        'Tcotpiece' => $request->Tcotpiece[$x],
                        'ProductName' => $request->ProductName[$x],
                        'nitprofit' => $request->nitprofit[$x],
                        'Forlack' => $request->Forlack[$x],
                        'cost' => $request->cost[$x],
                        'commission' => $request->commission[$x],
                        'Clearanceprice' => $request->Clearanceprice[$x],
                        'othercost' => $request->othercost[$x],
                        'Weightratio' => $request->Weightratio[$x],
                        'Weightbearing' => $request->Weightbearing[$x],
                        'Flightcost' => $request->Flightcost[$x],
                        'totalcost' => $request->totalcost[$x],
                        'user_id' => $user_id,  

                      
                    ]
                );
            }



            return response()->json([
                'status' => true,
                'linkShowAll' => '<a href="' . route('permissionent.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',

                'message' => 'تمت تعديل الاذن بنجاح'
            ]);
   //     } else {
   //        return response()->json(['errors' => [$error_count_array]], 422);
   //     }
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

    function excel($id)
    {
        $permissionentfreight_details = permission_ent_details_freight::where('permission_ent_id', $id)->get();

            // $account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            // $sub_accounts = AccountName::where('account_type_id', head(array_keys($account_types)))->with(['company', 'account_type'])
            // ->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->whereHas('account_type', function ($query) {
            //     $query->where('company_id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();


     $customer_array[] = array('type_id', 'ProductName', 'QuantityCharged', 'Quantityrecipient', 'Forlack');
     foreach($permissionentfreight_details as $customer)
     {
      $customer_array[] = array(
       'type_id'  => $customer->type_id,
       'ProductName'   => $customer->ProductName,
       'QuantityCharged'    => $customer->QuantityCharged,
       'Quantityrecipient'  => $customer->Quantityrecipient,
       'Forlack'   => $customer->Forlack
      );
     }
     Excel::create('permissionentfreight_details', function($excel) use ($customer_array){
      $excel->setTitle('permissionentfreight_details');
      $excel->sheet('permissionentfreight_details', function($sheet) use ($customer_array){
       $sheet->fromArray($customer_array, null, 'A1', false, false);
      });
     })->download('xlsx');

    }



}
