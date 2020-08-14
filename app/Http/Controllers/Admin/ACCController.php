<?php

namespace App\Http\Controllers\Admin;
use App\MobilatDetails;
use Rule;
use App\MobilatEntDetails;
use App\MobilatExDetails;
use App\ACC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class ACCController extends Controller
{

    public function index()
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $MobilatDetails2 = MobilatDetails::where('sirarnamber', 352455104943055)->pluck('action')->last();
        

        $ACC = ACC::orderBy('id', 'DESC')->paginate(10);

         return view('admin.ACC.index', compact('ACC'));
    }
    // show only users deleted

    public function showInventory()
    {

        if (! Gate::allows('جرد تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $ACC = ACC::orderBy('id', 'DESC')->paginate(50);
        $MobilatDetails= [];
            
            $MobilatDetails = MobilatDetails::where('action', 1)->where('Prodact_name',$ACC)->get();
           
            $total = count($MobilatDetails);
        
        if ($ACC != null) {
            return view('admin.ACC.inventory', compact('ACC' ));
        } else {
            return back();
        }
    }
    public function create()
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        return view('admin.ACC.add');
    }

    public function store(Request $request)
    {
        $user_id = auth()->id();
        $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
        $ACC = ACC::create([
            'name' => $request->name,
            'user_id' => $user_id,
        ]);
        return redirect()->route('acc.index')->with('success', 'تم اضافه المنتج بنجاح');
        // return back()->with('success', 'تمام اضافه المنتج بنجاح');
    }

    public function edit($id)
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
         $ACC = ACC::where('id', $id)->first();
        if ($ACC != null) {
            return view('admin.ACC.edit', ['ACC' => $ACC]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $user_id = auth()->id();
        $ACC = ACC::where('id', $id)->first();
        if ($ACC != null) {
            $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
            $ACC->update([
                'name' => $request->name,
                'user_id' => $user_id,

            ]);
            return redirect()->route('acc.index')->with('success', 'تم تعديل المنتج بنجاح');
        }
        return back()->with('delete', 'Account type not has been updated');
    }

    public function destroy($id)
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $ACC = ACC::where('id', $id)->first();

        if ($ACC != null) {
            $ACC->delete();
            return response()->json(['status' => true, 'message' => 'mobilats type has been deleted successfully']);
        } else {
            return back();
        }
    }
}
