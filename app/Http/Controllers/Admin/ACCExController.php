<?php

namespace App\Http\Controllers\Admin;

use App\MobilatEx;
use App\MobilatExDetails;
use App\Mobilat;
use App\ACC;
use App\MobilatDetails;
use App\Customers;

use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class ACCExController extends Controller
{
    public function index()
    {
        if (! Gate::allows('اذون صرف تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
      $MobilatEx = MobilatEx::orderBy('id', 'DESC')->paginate(10);

        return view('admin.MobilatEx.index', compact('MobilatEx'));
    }
    public function create()
    {
        if (! Gate::allows('اضافه اذون صرف تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
    $Customers = Customers::get()->pluck('name', 'id')->toArray();

      $ACC = ACC::get()->pluck('name', 'id')->toArray();
        // return view('admin.MobilatEx.add');
        return view('admin.AccessoriessEX.add', compact('ACC','Customers'));

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

            'CustomerNames' => 'required|max:250',
        //    'premission_id' => 'required|max:350',
            'date' => 'required|max:350',
         //   'order_id' => 'required|max:350',
            'qualityacc' => 'required|max:350',
            // 'mobilats' => 'required|max:50',
            // 'sirarnamber' => 'required|max:50'
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
         $all_total = [];
        // $all_total = [];
         for ($i = 0; $i < count($request->qualityacc); $i++) {
                 $all_total[] = $request->qualityacc[$i];
                 $Prodact_name1 = $request->Prodact_name[$i];
                 $all_totals = $request->qualityacc[$i];
                 $MobilatDetailsex = MobilatDetails::where('Prodact_name',$Prodact_name1)->where('action',2)->pluck('ACC')->sum();
                 $MobilatDetailsent = MobilatDetails::where('Prodact_name',$Prodact_name1)->where('action',1)->pluck('ACC')->sum();
                 $totalprodact = $MobilatDetailsent - $MobilatDetailsex;
                 $error_count_array6 = ['العدد المطلوب من هذا الصنف اكثر من الموجود .' . $totalprodact ];
                 if ($totalprodact < $all_totals) {
                     return response()->json(['errors' => [$error_count_array6]], 422);
                     // save transition
                     }
         }
        $total = array_sum($all_total);
        // $total_to = array_sum($all_to);
       //  $error_amount_total = ['The amount total from ( ' . money($total_from) . ' ) must be equal amount total to ( ' . money($total_to) . ' ).'];
        $error_count_array = ['العدد المطلوب لا يساوي عدد السريال.'];
     //   $error_count_array1 = ['تمت العمليه بنجاح.'. money($total) . ' ' . ($TotalS)];
        // if ($total_from !== $total_to) {
         //    return response()->json(['errors' => [$error_amount_total]], 422);
        // }

            $Entacc = 1;
            $user_id = auth()->id();
            
            $MobilatEx = MobilatEx::create([
                'CustomerNames' => $request->CustomerNames,
                'premission_id' => $request->premission_id,
                'order_id' => $request->order_id,
                'accormobiles' =>  $Entacc,
                'totals' => $total,
                'date' => $request->date,
                'user_id' => $user_id,
                ]);
                
                //    $sirali = implode($request->sirarnamber);
                //    $siral2 = $sirali;
                //    
                //    for($z = 0; $z < count($siral2); $z++){
                    //        }
                    //          $siral = $siral;
                    //
                    // save transition details
                    $Ent = 2;
                    
                    for($i = 0 ; $i < count($request->Prodact_name); $i++){
                        
                        

                        
                            MobilatExDetails::create([
                                
                                    'MobilatExID' => $MobilatEx->id,
                                    'CustomerNames' => $MobilatEx->CustomerNames,
                                    'Prodact_name' => $request->Prodact_name[$i],
                                    'qualityacc' => $request->qualityacc[$i],
                                    'date' => $request->date,
                                    'user_id' => $user_id,

                            ]);

                        
                    
            }
            // return redirect()->route('users.index')->with('success',  ' has been updated successfully');
            // return redirect()->route('mobilats.index')->with('success', 'تم اضافه المنتج بنجاح');

           return response()->json([
                'status' => true,
                'linkShowAll' => 'Preview all <a href="' . route('permissionex.index') . '">permissionex</a>.',
                'message' => 'تمت اضافه الاذن بنجاح'
              ]);
            //
            //   return redirect()->route('permissionex');
            // return redirect('permissionex');

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
        if (! Gate::allows('اذون صرف تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $MobilatEx = MobilatEx::where('id', $id)->first();
        if ($MobilatEx != null) {
            $MobilatExDetails = MobilatExDetails::where('MobilatExID', $id)->orderBy('id', 'ASC')->get();
   
            return view('admin.MobilatEx.show2', compact('MobilatEx', 'MobilatExDetails'));
        } else {
            return back();
        }
    }
    //
    public function edit($id)
    {
        if (! Gate::allows('اذون صرف تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $Acc = ACC::get()->pluck('name', 'id')->toArray();
 
        $MobilatExDetails = MobilatExDetails::where('MobilatExID', $id)->orderBy('id', 'ASC')->get();

        if ($MobilatExDetails->count() > 0) {

            $MobilatEx_id = $id;

            return view('admin.AccessoriessEX.edit', compact('MobilatExDetails', 'MobilatEx_id' ,'Acc'));
        } else {
            return back();
        }

    }
    //
    public function update(Request $request, $id)
    {

        $this->validate(request(), [


            'CustomerNames' => 'required|max:350',
            'qualityacc.*' => 'required|max:50',
            'date' => 'required|max:50'
        ]);
        $all_total = [];
        // $all_total = [];
         for ($i = 0; $i < count($request->qualityacc); $i++) {
                 $all_total[] = $request->qualityacc[$i];
        
         }
        $total = array_sum($all_total);

        
        $delete_ids = explode(',', $request->delete_ids);
        MobilatExDetails::destroy($delete_ids);
        MobilatDetails::destroy($delete_ids);
        
        // save transition
        $MobilatEx = MobilatEx::where('id', $id)->update([
            'CustomerNames' => $request->CustomerNames,
            'premission_id' => $request->premission_id,
            'order_id' => $request->order_id,
            'date' => $request->date,
            'totals' => $total,
            ]);
            // save transition details
            for ($x = 0; $x < count($request->Prodact_name); $x++) {
                
      
              
              

              MobilatExDetails::updateOrCreate(
                    [
                        'id' => $request->id[$x],
                    ],
                    [
                        'MobilatExID' => $id,
                        'Prodact_name' => $request->Prodact_name[$x],
                        'qualityacc' => $request->qualityacc[$x],
                        'date' => $request->date,

                    ]
                );
            }



            return response()->json([
                'status' => true,
                'linkShowAll' => 'Preview all <a href="' . route('permissionex.index') . '">transitions</a>.',
                'message' => 'Transition has been updated successfully'
            ]);

    }
    //
    public function destroy($id)
    {
        // delete transtion
        MobilatEx::destroy($id);
        // delete transtion details
        MobilatDetails::where('MobilatExID', $id)->delete();
        return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
    }
}
