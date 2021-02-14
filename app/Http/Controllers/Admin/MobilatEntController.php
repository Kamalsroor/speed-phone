<?php

namespace App\Http\Controllers\Admin;

use App\MobilatEnt;
use App\MobilatDetails;
use App\MobilatEntDetails;
use App\Customers;

use App\MobilatEntTotal;
use App\Mobilat;
use Illuminate\Support\Facades\Gate;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rule;

class MobilatEntController extends Controller
{
public function index()
{
    if (! Gate::allows('اذون توريد تجاره')) {
        
        return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        
    }

    $MobilatEnt = MobilatEnt::orderBy('id', 'DESC')->paginate(50);

    return view('admin.MobilatEnt.index', compact('MobilatEnt'));
}
public function create()
{
    if (! Gate::allows('اضافه اذون توريد تجاره')) {
        
        return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        
    }
    $mobilats = Mobilat::get()->pluck('name', 'id')->toArray();
    $Customers = Customers::get()->pluck('name', 'id')->toArray();
    // return view('admin.MobilatEx.add');
    return view('admin.MobilatEnt.add', compact('mobilats','Customers'));
    
}

            
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
        if (count($all_totals) != $request->Total[$i] ) {
       
                
           $mobilats = Mobilat::find($request->Prodact_name[$i]);
          $error_count_array = ['العدد المطلوب لا يساوي عدد السريالات .' . $request->Prodact_name[$i].' '. $mobilats->name];
                return response()->json(['errors' => [$error_count_array]], 422);
            // save transition
            }
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
        $all_totals = explode("\n" ,$request->sirarnamber[$i]);
        for ($x = 0; $x < count($all_totals); $x++) {
                
        $all_totalSiral = $all_totals[$x];
        $cleanHello = trim($all_totalSiral);
        
        $countCleanHello = strlen($cleanHello);
        
        $error_count_array3 = ['هذا السريال غير صحيح .' . $all_totalSiral ];
        $error_count_array4 = ['هذا السريال مورد من قبل .' . $all_totalSiral ];
        $error_count_array5 = ['هذا السريال ليس من نفس الصنف .' . $all_totalSiral ];

    
        
        if ($countCleanHello !== 15  && $countCleanHello !== 18 && $countCleanHello !== 13 && $countCleanHello !== 11 && $countCleanHello !== 12 ) {
        return response()->json(['errors' => [$error_count_array3]], 422);
        // save transition
        }
        $MobilatDetails2 = MobilatDetails::where('sirarnamber', $all_totalSiral)->get()->last();
        // $MobilatDetails5 = MobilatDetails::where('sirarnamber', $all_totals[$x])->orderBy('id', 'DESC')->get()->first();
        $MobilatDetails5= MobilatDetails::where('sirarnamber' , 'like', '%' . $cleanHello . '%'  )->orderBy('id', 'DESC')->get()->first();

       
        if($MobilatDetails2 != null){
            $Prodact_name2 = $MobilatDetails2->Prodact_name;
            if($Prodact_name2  !== $Prodact_name1 ){
                return response()->json(['errors' => [$error_count_array5]], 422);
                
            }
        }
        if($MobilatDetails5 != null){
            $test = $MobilatDetails5->action;

            if($test == 1 ){
            return response()->json(['errors' => [$error_count_array4]], 422);
    
            }
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
        $MobilatEnt = MobilatEnt::create([
            'CustomerNames' => $request->CustomerNames,
            'premission_id' => $request->premission_id,
            'order_id' => $request->order_id,
            'accormobiles' =>  $Entacc,
            'totals' => $total,
            'date' => $request->date,
            'user_id' => $user_id,
            ]);

        // save transition details
        $Ent = 1;
        for($i = 0 ; $i < count($request->Prodact_name); $i++){
            
            MobilatEntTotal::create([
            
                'MobilatEnttotalID' => $MobilatEnt->id,
                    'Prodact_name' => $request->Prodact_name[$i],
                    'totalss' => $request->Total[$i],
                ]);
            $siral = explode("\n" ,$request->sirarnamber[$i]);
            for ($x = 0; $x < count($siral); $x++) {
            $all_totalSiral = $siral[$x];
            $cleanHello = trim($all_totalSiral);
                MobilatDetails::create([
            
                    'MobilatEntID' => $MobilatEnt->id,
                        'CustomerNames' => $MobilatEnt->CustomerNames,
                        'Prodact_name' => $request->Prodact_name[$i],
                        'sirarnamber' => $cleanHello,
                        'date' => $request->date,
                        'note' => $request->sraialnote[$i],
                        'action' => $Ent,
                        'user_id' => $user_id,

                        
                    ]);
                }

            
        }

        return response()->json([
            'status' => true,
            'linkShowAll' => '<a href="' . route('mobilatsent.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',

            'message' => 'تمت اضافه الاذن بنجاح'
            ]);

}


public function show($id)
{
    if (! Gate::allows('اذون صرف تجاره')) {
        
        return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
    }
    
    
    
    $MobilatEnt = MobilatEnt::where('id', $id)->first();
    if ($MobilatEnt != null) {
        $MobilatDetails = MobilatDetails::where('MobilatEntID', $id)->orderBy('Prodact_name')->get();
        $MobilatDetailsent = MobilatDetails::where('MobilatEntID',$id)->pluck('Prodact_name');
        $MobilatDetailss = collect($MobilatDetailsent)->unique();
        $id1 = $id;
        return view('admin.MobilatEnt.show', compact('MobilatEnt', 'MobilatDetails','id1','MobilatDetailss'));
    } else {
        return back();
    }
}

//
public function edit($id)
{
    if (! Gate::allows('تعديل اذون اضافه تجاره')) {
        
        return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        
    }
    $Customers = Customers::get()->pluck('name', 'id')->toArray();

    $mobilats = Mobilat::get()->pluck('name', 'id')->toArray();

    $MobilatDetails = MobilatDetails::where('MobilatEntID', $id)->orderBy('id', 'ASC')->paginate(100);
    $MobilatEntTotal = MobilatEntTotal::where('MobilatEnttotalID', $id)->orderBy('id', 'ASC')->get();
    
    
    if ($MobilatDetails->count() > 0) {

        $MobilatEnt_id = $id;

        return view('admin.MobilatEnt.edit', compact('MobilatDetails', 'MobilatEnt_id' ,'mobilats','Customers','MobilatEntTotal'));
    } else {
        return back();
    }
}


public function getRow(Request $request)
{
    $mobilats = Mobilat::get()->pluck('name', 'id')->toArray();
    $MobilatDetails = MobilatDetails::where('MobilatEntID', $request->get('MobilatEnt_id'))->orderBy('id', 'ASC')->paginate(100);
    return view('admin.MobilatEnt.form_edit_row', compact('MobilatDetails','mobilats'));
}


//
public function update(Request $request, $id)
{
    if (! Gate::allows('اذون توريد تجاره')) {
        
        return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        
    }
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


    
    for($i = 0 ; $i < count($request->sirarnamber); $i++){
        
                
        $all_totalSiral = $request->sirarnamber[$i];
        $cleanHello = trim($all_totalSiral);
        $countCleanHello = strlen($cleanHello);
        $error_count_array3 = ['هذا السريال غير صحيح .' . $all_totalSiral ];
        $error_count_array4 = ['هذا السريال مورد من قبل .' . $all_totalSiral ];
        $error_count_array5 = ['هذا السريال ليس من نفس الصنف .' . $all_totalSiral ];

        if ($countCleanHello !== 15  && $countCleanHello !== 18 && $countCleanHello !== 13 && $countCleanHello !== 12 && $countCleanHello !== 11 ) {
        return response()->json(['errors' => [$error_count_array3]], 422);
        // save transition
        }



    }

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
                    'CustomerNames' => $request->CustomerNames,
                    'sirarnamber' => $request->sirarnamber[$x],
                    'date' => $request->date,
                    'note' => $request->sraialnote[$x],
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
 public function destroy($id)
 {
     // delete transtion
     MobilatEnt::destroy($id);
     // delete transtion details
     MobilatEntTotal::where('MobilatEnttotalID', $id)->delete();
     MobilatDetails::where('MobilatEntID', $id)->delete();
     return response()->json(['status' => true, 'message' => 'User has been deleted successfully']);
 }
}
