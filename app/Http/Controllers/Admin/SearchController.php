<?php

namespace App\Http\Controllers\Admin;
use App\MobilatDetails;
use Rule;
use App\permission_ent_freight;
use App\permission_ent_details_freight;
use App\permission_ex_freight;
use App\permission_ex_details_freight;
use App\MobilatEnt;
use App\MobilatEntDetails;
use App\MobilatEx;
use App\MobilatExDetails;
use App\Mobilat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class SearchController extends Controller
{

    public function index()
    {
        $mobilats = Mobilat::get()->pluck('name', 'id')->toArray();


          return view('admin.mobilats.showSril4', compact('mobilats'));
    }
    // show only users deleted  ->unique()

    function action($id)
    {
        $MobilatDetails = MobilatDetails::where('Prodact_name', $id)->orderBy('id', 'DESC')->paginate(100);
        $MobilatEx = MobilatEx::whereHas('MobilatExDetails',function($query) use ($id){
            return $query->where('Prodact_name', $id);
        })->get();
        $MobilatEnt = MobilatEnt::whereHas('MobilatEntDetails',function($query) use ($id){
            return $query->where('Prodact_name', $id);
        })->get();

        
      
        $Mobilat_name = Mobilat::where('id' , $id)->get()->pluck('name');
        $Mobilat_id = $id;
        if ($MobilatDetails != null) {
            return view('admin.mobilats.showSril8', ['MobilatDetails' => $MobilatDetails , 'MobilatEnt' =>$MobilatEnt , 'MobilatEx' => $MobilatEx , 'Mobilat_name' => $Mobilat_name ,'Mobilat_id' => $Mobilat_id]);
        }
        return back();
    }
    function action2($id)
    {


        $permission_ex_details_freight = permission_ex_details_freight::where('TypeOfProduct', $id)->get();
        $permission_ent_details_freight = permission_ent_details_freight::where('type_id', $id)->get();
        $test = MobilatDetails::where('Prodact_name', $id)->pluck('MobilatExID');
        $test .= MobilatDetails::where('Prodact_name', $id)->pluck('MobilatEntID');
        if ($permission_ent_details_freight != null) {
            return view('admin.mobilats.showSril5', ['permission_ex_details_freight' => $permission_ex_details_freight , 'permission_ent_details_freight' => $permission_ent_details_freight ,'test' =>$test]);
        }
        return back();
    }
    public function showInventory()
    {
        $mobilats = Mobilat::where('id', $id)->first();

        $mobilats = Mobilat::orderBy('id', 'DESC')->paginate(50);
        $MobilatDetails= [];
            
            $MobilatDetails = MobilatDetails::where('action', 1)->where('Prodact_name',$mobilats)->get();
           
            $total = count($MobilatDetails);
        
        if ($mobilats != null) {
            return view('admin.mobilats.inventory', compact('mobilats' ));
        } else {
            return back();
        }
    }

    public function showSril(Request $request)
    {
        $MobilatExDetails = MobilatExDetails::where('sirarnamber', 'like','%'.$request->name.'%')->get();
        $MobilatEntDetails = MobilatEntDetails::where('sirarnamber', 'like','%'.$request->name.'%')->get();
        
        if ($MobilatExDetails != null) {
            return view('admin.mobilats.showSril', compact('MobilatExDetails' ,'MobilatEntDetails' ));
        } else {
            return back();
        }
    }


    public function create()
    {
        return view('admin.mobilats.add');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
        $mobilats = Mobilat::create([
            'name' => $request->name
        ]);
        return redirect()->route('mobilats.index')->with('success', 'تم اضافه المنتج بنجاح');
        // return back()->with('success', 'تمام اضافه المنتج بنجاح');
    }

    public function edit($id)
    {
         $mobilats = Mobilat::where('id', $id)->first();
        if ($mobilats != null) {
            return view('admin.mobilats.edit', ['mobilats' => $mobilats]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $mobilats = Mobilat::where('id', $id)->first();
        if ($mobilats != null) {
            $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
            $mobilats->update([
                'name' => $request->name
            ]);
            return redirect()->route('mobilats.index')->with('success', 'تم تعديل المنتج بنجاح');
        }
        return back()->with('delete', 'Account type not has been updated');
    }

    public function destroy($id)
    {
        $mobilats = Mobilat::where('id', $id)->first();

        if ($mobilats != null) {
            $mobilats->delete();
            return response()->json(['status' => true, 'message' => 'mobilats type has been deleted successfully']);
        } else {
            return back();
        }
    }
}
