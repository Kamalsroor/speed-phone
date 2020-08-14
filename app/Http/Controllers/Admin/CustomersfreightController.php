<?php

namespace App\Http\Controllers\Admin;

use App\Customersfreight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CustomersfreightController extends Controller
{

    public function index()
    {
        if (! Gate::allows('تكويد عملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $Customers = Customersfreight::orderBy('id', 'DESC')->paginate(300);

          return view('admin.Customersfreight.index', compact('Customers'));
    }

    public function create()
    {
        if (! Gate::allows('تكويد عملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        return view('admin.Customersfreight.add');
    }

    public function store(Request $request)
    {
        if (! Gate::allows('تكويد عملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $user_id = auth()->id();
        $this->validate(request(), [ 'name' => 'required|string|max:150|unique:customersfreight' ]);
        $Customers = Customersfreight::create([
            'name' => $request->name,
            'user_id' => $user_id
        ]);
        return redirect()->route('customersfreight.index')->with('success', 'تم تسجيل العميل بنجاح');
                // return back()->with('success', 'تمام اضافه المنتج بنجاح');
    }

    public function edit($id)
    {
        if (! Gate::allows('تكويد عملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

         $Customers = Customersfreight::where('id', $id)->first();
        if ($Customers != null) {
            return view('admin.Customersfreight.edit', ['Customers' => $Customers]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        if (! Gate::allows('تكويد عملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $user_id = auth()->id();
        $Customers = Customersfreight::where('id', $id)->first();
        if ($Customers != null) {
            $this->validate(request(), [ 'name' => 'required|string|max:150' ]);
            $Customers->update([
                'name' => $request->name,
                'user_id' => $user_id
            ]);
            return redirect()->route('customersfreight.index')->with('success', 'تم تعديل العميل بنجاح');
        }
        return back()->with('delete', 'Account type not has been updated');
    }

    public function destroy($id)
    {
        if (! Gate::allows('تكويد عملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $Customers = Customersfreight::where('id', $id)->first();

        if ($Customers != null) {
            $Customers->delete();
            return response()->json(['status' => true, 'message' => 'mobilats type has been deleted successfully']);
        } else {
            return back();
        }
    }
}
