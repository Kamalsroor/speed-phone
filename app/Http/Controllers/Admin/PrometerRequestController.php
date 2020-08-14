<?php

namespace App\Http\Controllers\Admin;

use App\MobilatEx;
use App\MobilatExDetails;
use App\Mobilat;
use App\Acc;
use App\MobilatDetails;
use App\Customers;
use App\PrometerRequests;
use App\PrometerRequestsDetails;


use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class PrometerRequestController extends Controller
{
    public function index()
    {
        if (! Gate::allows('اضافه طلب مبيعات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
      $PrometerRequests = PrometerRequests::where('active',0)->orderBy('id', 'DESC')->paginate(10);

        return view('admin.PrometerRequest.index', compact('PrometerRequests'));
    }


    public function create()
    {
        if (! Gate::allows('اضافه طلب مبيعات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
    $Customers = Customers::get()->pluck('name', 'id')->toArray();

        $Mobilats = Mobilat::orderBy('name')->get();
        // return view('admin.MobilatEx.add');
        return view('admin.PrometerRequest.add', compact('Mobilats','Customers'));

    }


      public function store(Request $request)
    {


        $this->validate(request(), [

            'CustomerNames' => 'required|max:250',
            'Total*' => 'required|max:350',
            'Prodact_name*' => 'required|max:350',
        ]);


           // check on amout from equal amount to
         $all_total = [];
        // $all_total = [];
         for ($i = 0; $i < count($request->Total); $i++) {
                 $Prodact_name1 = $request->Prodact_name[$i];
                 $all_totals = $request->Total[$i];

                 $MobilatDetails4 = MobilatDetails::where('action',2)->where('Prodact_name', $Prodact_name1)->get();
                 $MobilatDetails3 = MobilatDetails::where('action',1)->where('Prodact_name', $Prodact_name1)->get();
                 $totalprodact = count($MobilatDetails3)-count($MobilatDetails4);

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

            $Entacc = 0;
            $user_id = auth()->id();
            
            $PrometerRequests = PrometerRequests::create([
                'CustomerNames' => $request->CustomerNames,
                'totals' => $total,
                'user_id' => $user_id,
                'active' => $Entacc
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
                        
                        

                        
                        PrometerRequestsDetails::create([
                                
                                    'prometerrequestsID' => $PrometerRequests->id,
                                    'Prodact_name' => $request->Prodact_name[$i],
                                    'qualityacc' => $request->Total[$i],
                                    'user_id' => $user_id,

                            ]);

                        
                    
            }
            // return redirect()->route('users.index')->with('success',  ' has been updated successfully');
            // return redirect()->route('mobilats.index')->with('success', 'تم اضافه المنتج بنجاح');

           return response()->json([
                'status' => true,
                'redirect_url' => route('prometerrequests.index'),
                'linkShowAll' => '<a href="' . route('prometerrequests.index') . '">لمشاهده جميع الاذssون اضغط هنا</a>.',
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
        if (! Gate::allows('اضافه طلب مبيعات')) {
            
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
        if (! Gate::allows('اضافه طلب مبيعات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $Customers = Customers::get()->pluck('name', 'id')->toArray();

        $Mobilat = Mobilat::orderBy('name')->get()->pluck('name', 'id');

 
        $PrometerRequestsDetails = PrometerRequestsDetails::where('prometerrequestsID', $id)->orderBy('id', 'ASC')->get();

        if ($PrometerRequestsDetails->count() > 0) {

            $PrometerRequestsID = $id;

            return view('admin.PrometerRequest.edit', compact('PrometerRequestsDetails', 'PrometerRequestsID' ,'Customers','Mobilat'));
        } else {
            return back();
        }

    }
    //
    public function update(Request $request, $id)
    {

        $this->validate(request(), [


            'CustomerNames' => 'required|max:350',
            'Total.*' => 'required|max:50',
        ]);
        $all_total = [];
        // $all_total = [];

         for ($i = 0; $i < count($request->Total); $i++) {
            $Prodact_name1 = $request->Prodact_name[$i];
            $all_totals = $request->Total[$i];

            $MobilatDetails4 = MobilatDetails::where('action',2)->where('Prodact_name', $Prodact_name1)->get();
            $MobilatDetails3 = MobilatDetails::where('action',1)->where('Prodact_name', $Prodact_name1)->get();
            $totalprodact = count($MobilatDetails3)-count($MobilatDetails4);

            $error_count_array6 = ['العدد المطلوب من هذا الصنف اكثر من الموجود .' . $totalprodact ];
            if ($totalprodact < $all_totals) {
                return response()->json(['errors' => [$error_count_array6]], 422);
                // save transition
                }
    }
        $total = array_sum($all_total);
        $user_id = auth()->id();

        
        $delete_ids = explode(',', $request->delete_ids);
        PrometerRequestsDetails::destroy($delete_ids);

        // save transition
        $PrometerRequests = PrometerRequests::where('id', $id)->update([
            'CustomerNames' => $request->CustomerNames,
            'user_id' => $user_id,
            'totals' => $total,
            ]);
            // save transition details
            for ($x = 0; $x < count($request->Prodact_name); $x++) {
                
      
              
              

                PrometerRequestsDetails::updateOrCreate(
                    [
                        'id' => $request->id[$x],
                    ],
                    [
                        'prometerrequestsID' => $id,
                        'Prodact_name' => $request->Prodact_name[$x],
                        'qualityacc' => $request->Total[$x],
                        'user_id' => $user_id,

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

    public function action($id)
    {

        $Entacc = 1;


        // delete transtion
        $PrometerRequests = PrometerRequests::where('id', $id)->update([
            'active' => $Entacc,
            ]);
        // delete transtion details
        return redirect()->route('prometerrequests.index')->with('success', 'تم الموافقه المنتج بنجاح');
    }

    public function action2($id)
    {

        $Entacc = 2;


        // delete transtion
        $PrometerRequests = PrometerRequests::where('id', $id)->update([
            'active' => $Entacc,
            ]);
        // delete transtion details
        return redirect()->route('prometerrequests.index')->with('success', 'تم الموافقه المنتج بنجاح');
    }

    public function destroy($id)
    {
        // delete transtion
        PrometerRequests::destroy($id);
        // delete transtion details
        PrometerRequestsDetails::where('prometerrequestsID', $id)->delete();

        return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
    }
}
