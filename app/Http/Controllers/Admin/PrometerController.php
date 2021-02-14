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

class PrometerController extends Controller
{
    public function index()
    {
        if (! Gate::allows('استلام طلب مبيعات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
      $PrometerRequests = PrometerRequests::where('active',1)->orderBy('id', 'DESC')->paginate(50);

        return view('admin.PrometerRequest.index2', compact('PrometerRequests'));
    }


    public function create($id)
    {
        if (! Gate::allows('استلام طلب مبيعات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $PrometerRequestsDetails = PrometerRequestsDetails::where('prometerrequestsID', $id)->orderBy('id', 'ASC')->get();

        if ($PrometerRequestsDetails->count() > 0) {

            $Customers = Customers::get()->pluck('name', 'id')->toArray();
        
        $Mobilat = Mobilat::orderBy('name')->get()->pluck('name', 'id');
            $PrometerRequestsID = $id;

            return view('admin.MobilatriEx.add', compact('Mobilat','Customers','PrometerRequestsDetails','PrometerRequestsID'));
        } else {
            return back();
        }
        // return view('admin.MobilatEx.add');

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
                'linkShowAll' => '<a href="' . route('prometerrequests.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',
                'root' => '<a href="' . route('prometerrequests.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',

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
        if (! Gate::allows('استلام طلب مبيعات')) {
            
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
        if (! Gate::allows('استلام طلب مبيعات')) {
            
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

            'sirarnamber.*' => 'required|min:6',

         //   'CustomerNames' => 'required|max:350',
            'Total.*' => 'required|max:50',
        ]);
            
            
            // check on amount is integer
        
            $all_totals = [];
            for($i = 0 ; $i < count($request->Total); $i++){
                            
            $all_totals = explode("\n" ,$request->sirarnamber[$i]);
                for ($x = 0; $x < count($all_totals); $x++) {
                                
                 $all_totalSiral[] = $all_totals[$x];
                                
                 }
    
             }
        $TotalS = count($all_totalSiral);
        // check on amout from equal amount to
        $all_total = [];
        // $all_total = [];
        for ($i = 0; $i < count($request->Total); $i++) {
            $all_total[] = $request->Total[$i];
                
        }
            
        for($i = 0 ; $i < count($request->Total); $i++){
            $Prodact_name1 = $request->Prodact_name[$i];
            $totall = $request->Total[$i];
            $all_totals = explode("\n" ,$request->sirarnamber[$i]);
            for ($x = 0; $x < count($all_totals); $x++) {
                    
            $all_totalSiral = $all_totals[$x];
            $cleanHello = trim($all_totalSiral);
            $countCleanHello = strlen($cleanHello);
            $error_count_array3 = ['هذا السريال غير صحيح .' . $all_totalSiral ];
            $error_count_array4 = ['هذا السريال خرج من قبل .' . $all_totalSiral ];
            $error_count_array5 = ['هذا السريال ليس من نفس الصنف .' . $all_totalSiral ];
            $error_count_array7 = ['هذا السريال غير مورد من قبل .' . $all_totalSiral ];
            $error_count_array6 = ['العدد المطلوب من هذا الصنف اكثر من الموجود .' . $Prodact_name1 ];
            $MobilatDetails4 = MobilatDetails::where('action',2)->where('Prodact_name', $Prodact_name1)->get();
            $MobilatDetails3 = MobilatDetails::where('action',1)->where('Prodact_name', $Prodact_name1)->get();
            $totalprodact = count($MobilatDetails3)-count($MobilatDetails4);
            if ($totalprodact < $totall) {
                return response()->json(['errors' => [$error_count_array6]], 422);
                // save transition
                }
            if ($countCleanHello !== 15  && $countCleanHello !== 18 && $countCleanHello !== 13 && $countCleanHello !== 12 && $countCleanHello !== 11 ) {
            return response()->json(['errors' => [$error_count_array3]], 422);
            // save transition
            }
            $MobilatDetails2 = MobilatDetails::where('sirarnamber', $cleanHello)->get()->last();
            // $MobilatDetails5 = MobilatDetails::where('sirarnamber', $all_totalSiral)->orderBy('id', 'DESC')->get()->pluck('action')->frist();
            //  $MobilatDetails5 = MobilatDetails::where('sirarnamber', $all_totalSiral)->orderBy('id', 'DESC')->get()->pluck('action')->first();
            // $MobilatDetails5= MobilatDetails::where('sirarnamber' , 'like', '%' . $cleanHello . '%'  )->orderBy('id', 'DESC')->pluck('action')->get()->first();
                         $MobilatDetails5 = MobilatDetails::where('sirarnamber', 'like', '%' . $cleanHello . '%' )->orderBy('id', 'DESC')->get()->pluck('action')->first();

            // dd($MobilatDetails5);
            // $MobilatDetails3 = MobilatDetails::where('sirarnamber', $cleanHello)->get();
            if($MobilatDetails2 != null){
                $Prodact_name2 = $MobilatDetails2->Prodact_name;
                if($Prodact_name2  !== $Prodact_name1 ){
                    return response()->json(['errors' => [$error_count_array5]], 422);
                    
                }
            }
            if($MobilatDetails5 != null){
                if($MobilatDetails5 == 2 ){
              return response()->json(['errors' => [$error_count_array4]], 422);
        
                }
        }  
            
        if($MobilatDetails5 == null){
                    
            return response()->json(['errors' => [$error_count_array7]], 422);
        }
        }
    }
    
            $total = array_sum($all_total);
            // $total_to = array_sum($all_to);
            //  $error_amount_total = ['The amount total from ( ' . money($total_from) . ' ) must be equal amount total to ( ' . money($total_to) . ' ).'];
            $error_count_array = ['العدد المطلوب لا يساوي عدد السريال.'];
            $error_count_array1 = ['تمت العمليه بنجاح.'. money($total) . ' ' . ($TotalS)];
            // if ($total_from !== $total_to) {
                //    return response()->json(['errors' => [$error_amount_total]], 422);
                $mobilats = Mobilat::get()->pluck('name', 'id')->toArray();
                $Customers = Customers::get()->pluck('name', 'id')->toArray();
                // }
            if ($total !== $TotalS ) {
                return response()->json(['errors' => [$error_count_array]], 422);
                // save transition
            }
            $Entacc=2;
            $active = 0;
            $user_id = auth()->id();
            $MobilatEx = MobilatEx::create([
                'CustomerNames' => $request->CustomerNames,
                'premission_id' => $request->premission_id,
                'accormobiles' =>  $Entacc,
                'note' => $request->note,
                'totals' => $total,
                'active' => $active,
                'user_id' => $user_id,
                ]);
    
            // save transition details
            $Ent = 2;
            for($i = 0 ; $i < count($request->Prodact_name); $i++){

                $siral = explode("\n" ,$request->sirarnamber[$i]);
                for ($x = 0; $x < count($siral); $x++) {
    
                    MobilatDetails::create([
                
                        'MobilatExID' => $MobilatEx->id,
                            'CustomerNames' => $MobilatEx->CustomerNames,
                            'Prodact_name' => $request->Prodact_name[$i],
                            'note' => $request->sraialnote[$i],
                            'sirarnamber' => $siral[$x],
                            'action' => $Ent,
                             'active' => $active,
                            'user_id' => $user_id,
    
                            
                        ]);
                    }
    
                
            }
            $Entaccs = 3 ; 
            $PrometerRequests = PrometerRequests::where('id', $id)->update([
                'active' => $Entaccs,
                ]);
            return response()->json([
                'status' => true,
                'linkShowAll' => '<a href="' . route('mobilatsex.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',
    
                'message' => 'تمت اضافه الاذن بنجاح'
                ]);

    }
    //

    public function action($id)
    {
        if (! Gate::allows('استلام طلب مبيعات')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
//         $MobilatDetails5 = MobilatDetails::where('sirarnamber', 357380100779623)->orderBy('id', 'DESC')->get()->pluck('action')->first();
// dd($MobilatDetails5);
        $PrometerRequestsDetails = PrometerRequestsDetails::where('prometerrequestsID', $id)->orderBy('id', 'ASC')->get();

        if ($PrometerRequestsDetails->count() > 0) {

            $Customers = Customers::get()->pluck('name', 'id')->toArray();
        
              $Mobilat = Mobilat::orderBy('name')->get()->pluck('name', 'id');
            $PrometerRequestsID = $id;

            return view('admin.MobilatriEx.edit', compact('Mobilat','Customers','PrometerRequestsDetails','PrometerRequestsID'));
        } else {
            return back();
        }
       
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
