<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Gate;

use App\TypeOfProduct;
use App\MobilatDetails;
use App\permission_ex_details_freight;
use App\permission_ent_details_freight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfProductController extends Controller
{

    public function index()
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $TypeOfProducts = TypeOfProduct::orderBy('id', 'DESC')->paginate(10);

          return view('admin.TypeOfProducts.index', compact('TypeOfProducts'));
    }

    public function create()
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        return view('admin.TypeOfProducts.add');
    }

    public function store(Request $request)
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
        $TypeOfProducts = TypeOfProduct::create([
            'name' => $request->name
        ]);
        return redirect()->route('typeofproduct.index')->with('success', 'تم حفظ نوع الصنف بنجاح');
                // return back()->with('success', 'تمام اضافه المنتج بنجاح');
    }

    public function edit($id)
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
         $TypeOfProducts = TypeOfProduct::where('id', $id)->first();
        if ($TypeOfProducts != null) {
            return view('admin.TypeOfProducts.edit', ['TypeOfProducts' => $TypeOfProducts]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $TypeOfProducts = TypeOfProduct::where('id', $id)->first();
        if ($TypeOfProducts != null) {
            $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
            $TypeOfProducts->update([
                'name' => $request->name
            ]);
            return redirect()->route('typeofproduct.index')->with('success', 'تم تعديل المنتج بنجاح');
        }
        return back()->with('delete', 'Account type not has been updated');
    }

    public function destroy($id)
    {
        if (! Gate::allows('اضافه منتجات تجاره')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $TypeOfProducts = TypeOfProduct::where('id', $id)->first();

        if ($TypeOfProducts != null) {
            $TypeOfProducts->delete();
            return response()->json(['status' => true, 'message' => 'mobilats type has been deleted successfully']);
        } else {
            return back();
        }
    }

    public function showInventory()
    {

        if (! Gate::allows('جرد شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $MobilatDetails4 = MobilatDetails::where('action',2)->where('Prodact_name', 1)->get();
        $MobilatDetails3 = MobilatDetails::where('action',1)->where('Prodact_name', 1)->get();
        $totalprodact = count($MobilatDetails3)-count($MobilatDetails4);

        $TypeOfProduct = TypeOfProduct::orderBy('id', 'DESC')->paginate(50);
        $permission_ex_details_freight = permission_ex_details_freight::where('TypeOfProduct',1)->where('active',1)->pluck('Quantity')->sum();
        $permission_ent_details_freight = permission_ent_details_freight::where('type_id',1)->pluck('Quantityrecipient')->sum();
        $total = $permission_ent_details_freight - $permission_ex_details_freight;
           
        
        if ($TypeOfProduct != null) {
            return view('admin.TypeOfProducts.inventory', compact('TypeOfProduct' ));
        } else {
            return back();
        }
    }
}
