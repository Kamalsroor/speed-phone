<?php

namespace App\Http\Controllers\Admin;
use App\permission_ent_details_freight;
use App\permission_ent_freight;

use App\Customersfreight;
use App\AccountCustomers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AccountCustomersController extends Controller
{


    public function index()
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $Customersfreight = Customersfreight::orderBy('id', 'DESC')->paginate(200);

        
        return view('admin.AccountCustomers.index', compact('Customersfreight'));
    }
    public function index2()
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $AccountCustomers = AccountCustomers::orderBy('id', 'DESC')->paginate(200);

        
        return view('admin.AccountCustomers.index2', compact('AccountCustomers'));
    }

    public function Action($id)
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $Customersfreight = AccountCustomers::where('customersname', $id)->where('accountss', 1)->get();
        $Customersfreights = Customersfreight::where('id', $id)->pluck('name');
       
        $permission_ent_details_freight = permission_ent_details_freight::where('customernames', $id)->pluck('permission_ent_id');
        $MobilatDetailss = collect($permission_ent_details_freight)->unique();
        $namec = $Customersfreights[0] ;
        
        $ids = $id;
        return view('admin.Customersfreight.inventory', compact('Customersfreight' ,'MobilatDetailss','ids','permissionentfreight','namec'));
    }
    
    public function create()
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $Customersfreight = Customersfreight::get()->pluck('name', 'id')->toArray();

        return view('admin.AccountCustomers.add', compact('Customersfreight'));
    }
    public function createstatement($id)
    {
        $Customersfreight = Customersfreight::where('id', $id)->get()->pluck('name', 'id')->toArray();
        return view('admin.AccountCustomers.add2', compact('Customersfreight'));
        
    }
    public function store(Request $request)
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $accountss = 1 ;
        $user_id = auth()->id();
        $this->validate(request(), ['account' => 'required|max:150','date' => 'required|max:150' ]);
        $AccountCustomers = AccountCustomers::create([
            'customersname' => $request->CustomerNames,
            'account' => $request->account,
            'Notes' => $request->Notes,
            'date' => $request->date,
            'accountss' => $accountss,
            'user_id' => $user_id
        ]);
        return redirect()->route('accountcustomers.index')->with('success', 'تم تسجيل العميل بنجاح');
                // return back()->with('success', 'تمام اضافه المنتج بنجاح');
    }

    public function edit($id)
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $Customersfreight = Customersfreight::get()->pluck('name', 'id')->toArray();

         $AccountCustomers = AccountCustomers::where('id', $id)->first();
        if ($AccountCustomers != null) {
            return view('admin.AccountCustomers.edit', ['AccountCustomers' => $AccountCustomers , 'Customersfreight' => $Customersfreight]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $accountss = 1 ;
        $user_id = auth()->id();
        $AccountCustomers = AccountCustomers::where('id', $id)->first();
        if ($AccountCustomers != null) {
            $this->validate(request(), [ 'account' => 'required|max:150','date' => 'required|max:150' ]);
            $AccountCustomers->update([
                'account' => $request->account,
                'Notes' => $request->Notes,
                'date' => $request->date,
                'customersname' => $request->CustomerNames,
            'accountss' => $accountss,

                'user_id' => $user_id
            ]);
            return redirect()->route('accountcustomers.index')->with('success', 'تم تعديل العميل بنجاح');
        }
        return back()->with('delete', 'Account type not has been updated');
    }

    public function destroy($id)
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $AccountCustomers = AccountCustomers::where('id', $id)->first();

        if ($AccountCustomers != null) {
            $AccountCustomers->delete();
            return response()->json(['status' => true, 'message' => 'mobilats type has been deleted successfully']);
        } else {
            return back();
        }
    }

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

}
