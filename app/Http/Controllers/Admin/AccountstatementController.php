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
use App\AccountCustomers;
use App\Customersfreight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AccountstatementController extends Controller
{

    public function index()
    {
        $mobilats = Mobilat::get()->pluck('name', 'id')->toArray();


          return view('admin.mobilats.showSril4', compact('mobilats'));
    }
    // show only users deleted  ->unique()

    function action($id,$test)
    {

        $AccountCustomerss = AccountCustomers::where('customersname', $test)->where('accountss', 2)->where('permissionEntId',$id)->pluck('account')->sum();
        $permission_ent_detailss_freight = permission_ent_details_freight::where('customernames',$test)->where('permission_ent_id',$id)->pluck('cost')->sum();
       $cont = $AccountCustomerss + $permission_ent_detailss_freight;


        $permission_ent_details_freight = permission_ent_details_freight::where('permission_ent_id', $id)->where('customernames', $test)->get();
        $total = permission_ent_details_freight::where('permission_ent_id', $id)->where('customernames', $test)->pluck('Quantityrecipient')->sum();
        $AccountCustomers = AccountCustomers::where('permissionEntId', $id)->where('customersname', $test)->get();
        $Customersfreight = Customersfreight::where('id', $test)->pluck('name');
        $test = $Customersfreight;
        if ($permission_ent_details_freight != null) {
            return view('admin.mobilats.showSril9', ['permission_ent_details_freight' => $permission_ent_details_freight , 'test' =>$test ,'total' =>$total ,'AccountCustomers' =>$AccountCustomers,'cont' =>$cont]);
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
    public function createstatement($id)
    {
        $Customersfreight = Customersfreight::where('id', $id)->get()->pluck('name', 'id')->toArray();
        $permission_ent_freight = permission_ent_freight::whereHas('permission_ent_Details_freight',function($query) use ($id){
            return $query->where('customernames', $id);
        })->get()->pluck('CustomerNames', 'id')->toArray();
        return view('admin.Accountstatement.add2', compact('Customersfreight','permission_ent_freight'));
        
    }

    public function create()
    {
        $Customersfreight = Customersfreight::get()->pluck('name', 'id')->toArray();
        $permission_ent_freight = permission_ent_freight::get()->pluck('CustomerNames', 'id')->toArray();
        return view('admin.Accountstatement.add', compact('Customersfreight','permission_ent_freight'));
        
    }

    public function store(Request $request)
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $user_id = auth()->id();
        $accountss = 2 ;
        $id = $request->CustomerNames; 
        $test = $request->permissionEntId;
        $this->validate(request(), ['account' => 'required|max:150' ]);
        $AccountCustomers = AccountCustomers::create([
            'customersname' => $request->CustomerNames,
            'account' => $request->account,
            'Notes' => $request->Notes,
            'permissionEntId' => $request->permissionEntId,
            'date' => $request->date,
            'accountss' => $accountss,
            'user_id' => $user_id
        ]);
        return redirect()->route('accountcustomers.Accountstatement', [$test,$id])->with('success', 'تم تسجيل المصروفات بنجاح');
                // return back()->with('success', 'تمام اضافه المنتج بنجاح');
    }

    public function edit($id)
    {
         $AccountCustomers = AccountCustomers::where('id', $id)->first();
         $Customersfreight = Customersfreight::get()->pluck('name', 'id')->toArray();
        $permission_ent_freight = permission_ent_freight::get()->pluck('CustomerNames', 'id')->toArray();
        if ($AccountCustomers != null) {
            return view('admin.Accountstatement.edit', ['AccountCustomers' => $AccountCustomers ,'Customersfreight' => $Customersfreight ,'permission_ent_freight' => $permission_ent_freight]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        if (! Gate::allows('حسابات العملاء')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $accountss = 2 ;
        $user_id = auth()->id();
        $AccountCustomers = AccountCustomers::where('id', $id)->first();
        if ($AccountCustomers != null) {
            $this->validate(request(), [ 'account' => 'required|max:150','date' => 'required|max:150' ]);
            $AccountCustomers->update([
                'account' => $request->account,
                'Notes' => $request->Notes,
                'date' => $request->date,
                'customersname' => $request->CustomerNames,
              'permissionEntId' => $request->permissionEntId,
               'accountss' => $accountss,
                'user_id' => $user_id
            ]);
            
        return redirect()->route('accountcustomers.Accountstatement', [$request->permissionEntId,$request->CustomerNames])->with('success', 'تم تسجيل المصروفات بنجاح');
        }
        return back()->with('delete', 'Account type not has been updated');
    }
    public function destroy($id)
    {
        $AccountCustomers = AccountCustomers::where('id', $id)->first();

        if ($AccountCustomers != null) {
            $AccountCustomers->delete();
            return response()->json(['status' => true, 'message' => 'mobilats type has been deleted successfully']);
        } else {
            return back();
        }
    }
}
