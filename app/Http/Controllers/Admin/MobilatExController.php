<?php

namespace App\Http\Controllers\Admin;

use App\MobilatEx;
use App\MobilatExDetails;
use App\MobilatEntDetails;
use App\Mobilat;
use App\MobilatDetails;
use App\MobilatExTotal;

use Illuminate\Support\Facades\Gate;
use App\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class MobilatExController extends Controller
{
    public function index()
    {
        if (! Gate::allows('اذون صرف تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
      $MobilatEx = MobilatEx::where('active', 1)->orderBy('id', 'DESC')->paginate(50);

        return view('admin.MobilatEx.index', compact('MobilatEx'));
    }
    public function create()
    {
        if (! Gate::allows('اضافه اذون صرف تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
    $Customers = Customers::get()->pluck('name', 'id')->toArray();

      $mobilats = Mobilat::get()->pluck('name', 'id')->toArray();
        // return view('admin.MobilatEx.add');
        return view('admin.MobilatEx.add', compact('mobilats','Customers'));

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
            'date' => 'required|max:350',
            'mobilats.*' => 'required|max:50',
            'sirarnamber.*' => 'required|min:6',
            'Total.*' => 'required'
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
            $MobilatDetails2 = MobilatDetails::where('sirarnamber', $all_totalSiral)->get()->last();
            $MobilatDetails3 = MobilatDetails::where('sirarnamber', $all_totalSiral)->get();
            if($MobilatDetails2 != null){
                $Prodact_name2 = $MobilatDetails2->Prodact_name;
                if($Prodact_name2  !== $Prodact_name1 ){
                    return response()->json(['errors' => [$error_count_array5]], 422);
                    
                }
            }

            if($MobilatDetails2 != null){
                $test = $MobilatDetails2->action;
                if($test !== 1 ){
                return response()->json(['errors' => [$error_count_array4]], 422);
        
            }
            }
            
        if($MobilatDetails3 == null){
                    
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
            $user_id = auth()->id();
            $MobilatEx = MobilatEx::create([
                'CustomerNames' => $request->CustomerNames,
                'premission_id' => $request->premission_id,
                'note' => $request->note,
                'order_id' => $request->order_id,
                'accormobiles' =>  $Entacc,
                'totals' => $total,
                'date' => $request->date,
                'user_id' => $user_id,
                ]);
                
            // save transition details
            $Ent = 2;
            for($i = 0 ; $i < count($request->Prodact_name); $i++){
                MobilatExTotal::create([
            
                    'MobilatExtotalID' => $MobilatEx->id,
                        'Prodact_name' => $request->Prodact_name[$i],
                        'totalss' => $request->Total[$i],
    
                        
                    ]);
                $siral = explode("\n" ,$request->sirarnamber[$i]);
                for ($x = 0; $x < count($siral); $x++) {
    
                    MobilatDetails::create([
                
                        'MobilatExID' => $MobilatEx->id,
                            'CustomerNames' => $MobilatEx->CustomerNames,
                            'Prodact_name' => $request->Prodact_name[$i],
                            'sirarnamber' => $siral[$x],
                            'date' => $request->date,
                            'action' => $Ent,
                            'user_id' => $user_id,
    
                            
                        ]);
                    }
    
                
            }
    
            return response()->json([
                'status' => true,
                'linkShowAll' => '<a href="' . route('mobilatsex.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',
    
                'message' => 'تمت اضافه الاذن بنجاح'
                ]);
    
    }

  //   public function show($id)
  //   {
  //       $MobilatExDetails = MobilatExDetails::find($id);
  //       if ($MobilatExDetails != null) {
  //           $MobilatExDetails->user_id = $MobilatExDetails->user->name;
  //           return response()->json([
  //               'status' => true,
  //              'data' => $MobilatExDetails
   //          ]);
   //      } else {
   //          return response()->json([
   //              'status' => false
   //          ]);
   //      }
   //  }
    public function show($id)
    {
        if (! Gate::allows('اذون صرف تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        }

        
    

        
        $MobilatEx = MobilatEx::where('id', $id)->first();
        if ($MobilatEx != null) {
            
            $MobilatDetails = MobilatDetails::where('MobilatExID', $id)->orderBy('id', 'ASC')->get();
            $MobilatDetailsent = MobilatDetails::where('MobilatExID',$id)->pluck('Prodact_name');
            $MobilatDetailss = collect($MobilatDetailsent)->unique();
          $ids =$id;
            return view('admin.MobilatEx.show', compact('MobilatEx', 'MobilatDetails','MobilatDetailss','MobilatDetails','ids'));
        } else {
            return back();
        }
    }
    //
    public function edit($id)
    {
        if (! Gate::allows('تعديل اذون صرف تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $Customers = Customers::get()->pluck('name', 'id')->toArray();

        $mobilats = Mobilat::get()->pluck('name', 'id')->toArray();
    
        $MobilatDetails = MobilatDetails::where('MobilatExID', $id)->orderBy('id', 'ASC')->get();



 

        if ($MobilatDetails->count() > 0) {

            $MobilatEx_id = $id;

            return view('admin.MobilatEx.edit', compact('MobilatDetails', 'MobilatEx_id' ,'mobilats','Customers'));
        } else {
            return back();
        }

    }
    //
    public function update(Request $request, $id)
    {

        $this->validate(request(), [


            'CustomerNames' => 'required|max:350',
            'sirarnamber.*' => 'required|max:50',
            'date' => 'required|max:50'
        ]);
        $all_total = [];
        // $all_total = [];
        for ($i = 0; $i < count($request->sirarnamber); $i++) {
            $all_total[] = $request->sirarnamber[$i];
            
         }
         $total = count($all_total);

         
        for($i = 0 ; $i < count($request->Prodact_name); $i++){
            $Prodact_name1 = $request->Prodact_name[$i];
            $all_totals =$request->sirarnamber[$i];

        }





         for ($x = 0; $x < count($request->Prodact_name); $x++) {
            $all_totalSiral = $request->sirarnamber[$x];
            $cleanHello = trim($all_totalSiral);
            $countCleanHello = strlen($cleanHello);
            $error_count_array3 = ['هذا السريال غير صحيح .' . $all_totalSiral ];
    
            if ($countCleanHello !== 15  && $countCleanHello !== 18 && $countCleanHello !== 13 && $countCleanHello !== 12 && $countCleanHello !== 11) {
            return response()->json(['errors' => [$error_count_array3]], 422);
            // save transition
            }
        }
        
        $delete_ids = explode(',', $request->delete_ids);
        MobilatDetails::destroy($delete_ids);
        $user_id = auth()->id();
        $Ent = 2 ;
        
        // save transition
        $MobilatEx = MobilatEx::where('id', $id)->update([
            'CustomerNames' => $request->CustomerNames,
            'premission_id' => $request->premission_id,
            'order_id' => $request->order_id,
            'date' => $request->date,
            'totals' => $total,
            'user_id' => $user_id,
            'note' => $request->note,
            ]);
            
            // save transition details
            for ($x = 0; $x < count($request->Prodact_name); $x++) {


              
                $active = 1;
                MobilatDetails::updateOrCreate(
                    [
                        'id' => $request->id[$x],
                    ],
                    [
                        'MobilatExID' => $id,
                          'CustomerNames' => $request->CustomerNames,
                        'Prodact_name' => $request->Prodact_name[$x],
                        'sirarnamber' => $request->sirarnamber[$x],
                        'date' => $request->date,
                        'user_id' => $user_id,
                        'active' => $active,
                        'action' => $Ent,

                    ]
                );
            }



            return response()->json([
                'status' => true,
                'linkShowAll' => '<a href="' . route('mobilatsex.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',
    
                'message' => 'تمت اضافه الاذن بنجاح'
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

    public function destroy($id)
    {
        // delete transtion
        MobilatEx::destroy($id);
        // delete transtion details
        MobilatExTotal::where('MobilatExtotalID', $id)->delete();
        MobilatDetails::where('MobilatExID', $id)->delete();
        return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
    }
}
