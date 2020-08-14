<?php

namespace App\Http\Controllers\Admin;

use App\MobilatEnt;
use App\MobilatEntDetails;
use App\Mobilat;
use App\ACC;
use App\MobilatDetails;
use App\Customers;

use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class ACCEntController extends Controller
{
    public function index()
    {
            
    return redirect()->back()->with('delete',  'لا توجد صفحه');
            
        

    }
    public function create()
    {
        if (! Gate::allows('اضافه اذون توريد تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
      $ACC = ACC::get()->pluck('name', 'id')->toArray();
    $Customers = Customers::get()->pluck('name', 'id')->toArray();

        // return view('admin.MobilatEx.add');
        return view('admin.AccessoriessEnt.add', compact('ACC','Customers'));

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
         //   'premission_id' => 'required|max:350',
            'date' => 'required|max:350',
          //  'order_id' => 'required|max:350',
            'qualityacc' => 'required|max:350',
             'mobilats.*' => 'required|max:50',
             'qualityacc.*' => 'required|max:50'
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
            
            $MobilatEnt = MobilatEnt::create([
                'CustomerNames' => $request->CustomerNames,
                'premission_id' => $request->premission_id,
               'order_id' => $request->order_id,
                'accormobiles' =>  $Entacc,
                'totals' => $total,
                'user_id' => $user_id,
                'date' => $request->date,
                ]);
                
    
                    // save transition details
                    $Ent = 1;
                    
                    for($i = 0 ; $i < count($request->Prodact_name); $i++){
                        
                        

                        
                        MobilatDetails::create([
                                    
                                    'MobilatEntID' => $MobilatEnt->id,
                                    'CustomerNames' => $MobilatEnt->CustomerNames,
                                    'Prodact_name' => $request->Prodact_name[$i],
                                    'ACC' => $request->qualityacc[$i],
                                    'user_id' => $user_id,
                                    'date' => $request->date,
                                    'action' => $Ent,


            
                            ]);

                        
                    
            }
            // return redirect()->route('users.index')->with('success',  ' has been updated successfully');
            // return redirect()->route('mobilats.index')->with('success', 'تم اضافه المنتج بنجاح');

           return response()->json([
                'status' => true,
                'linkShowAll' => '<a href="' . route('mobilatsent.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',

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
        if (! Gate::allows('اذون مرتجع تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        
        $MobilatEnt = MobilatEnt::where('id', $id)->first();
        if ($MobilatEnt != null) {
            $MobilatDetails = MobilatDetails::where('MobilatEntID', $id)->orderBy('id', 'ASC')->get();
            $MobilatExDetails = MobilatEntDetails::where('MobilatEntID', $id)->orderBy('id', 'ASC')->get();
            return view('admin.MobilatEnt.show2', compact('MobilatEnt', 'MobilatDetails'));
        } else {
            return back();
        }
    }
    //
    public function edit($id)
    {
        if (! Gate::allows('اذون مرتجع تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $Acc = ACC::get()->pluck('name', 'id')->toArray();
        $Customers = Customers::get()->pluck('name', 'id')->toArray();

 
        $MobilatDetails = MobilatDetails::where('MobilatEntID', $id)->orderBy('id', 'ASC')->get();

        if ($MobilatDetails->count() > 0) {

            $MobilatEnt_id = $id;

            return view('admin.AccessoriessEnt.edit', compact('MobilatDetails', 'MobilatEnt_id' ,'Acc','Customers'));
        } else {
            return back();
        }

    }
    //
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
        MobilatDetails::destroy($delete_ids);
        $user_id = auth()->id();
        
        $Ent = 1 ;

        
        // save transition
        $MobilatEnt = MobilatEnt::where('id', $id)->update([
            'CustomerNames' => $request->CustomerNames,
            'premission_id' => $request->premission_id,
            'order_id' => $request->order_id,
            'date' => $request->date,
            'totals' => $total,
            'user_id' => $user_id,
            ]);
            // save transition details
            for ($x = 0; $x < count($request->Prodact_name); $x++) {
                
      
              
              

                MobilatDetails::updateOrCreate(
                    [
                        'id' => $request->id[$x],
                    ],
                    [
                        'MobilatEntID' => $id,
                        'Prodact_name' => $request->Prodact_name[$x],
                        'ACC' => $request->qualityacc[$x],
                        'date' => $request->date,
                        'CustomerNames' => $request->CustomerNames,
                        'user_id' => $user_id,
                        'action' => $Ent,

                    ]
                );
            }



            return response()->json([
                'status' => true,
                'linkShowAll' => '<a href="' . route('mobilatsent.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',
                'message' => 'تم تعديل الاذن بنجاح'
            ]);

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
