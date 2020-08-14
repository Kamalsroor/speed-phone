<?php
namespace App\Http\Controllers\Admin;

use Excel;

use Illuminate\Http\Request;

class ExportExcelController extends Controller
{
    //
    function excel($id)
    {
        $permissionentfreight_details = permission_ent_details_freight::where('permission_ent_id', $id)->get()->toArray();

        if ($permissionentfreight_details->count() > 0) {
            // $account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            // $sub_accounts = AccountName::where('account_type_id', head(array_keys($account_types)))->with(['company', 'account_type'])
            // ->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->whereHas('account_type', function ($query) {
            //     $query->where('company_id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();


     $customer_data = DB::table('tbl_customer')->get()->toArray();
     $customer_array[] = array('type_id', 'ProductName', 'QuantityCharged', 'Quantityrecipient', 'Forlack');
     foreach($permissionentfreight_details as $customer)
     {
      $customer_array[] = array(
       'type_id'  => $customer->type_id,
       'ProductName'   => $customer->ProductName,
       'QuantityCharged'    => $customer->QuantityCharged,
       'Quantityrecipient'  => $customer->Quantityrecipient,
       'Forlack'   => $customer->Forlack
      );
     }
     Excel::create('permissionentfreight_details', function($excel) use ($customer_array){
      $excel->setTitle('permissionentfreight_details');
      $excel->sheet('permissionentfreight_details', function($sheet) use ($customer_array){
       $sheet->fromArray($customer_array, null, 'A1', false, false);
      });
     })->download('xlsx');

    } else {
        return back();
    }
    }


    public function edit($id)
    {
        if (! Gate::allows('اذون اضافه شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        // $permissionexfreight_details = permission_ex_details_freight::where('permission_ex_id', $id)->with(['company', 'transition', 'account_type', 'account_name'])->whereHas('company', function ($query) {
        //     $query->where('id', get_company()->id);
        // })->get();
        $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();
        $Customers = Customers::get()->pluck('name', 'id')->toArray();
        $permissionentfreight_details = permission_ent_details_freight::where('permission_ent_id', $id)->orderBy('id', 'ASC')->get();

        if ($permissionentfreight_details->count() > 0) {
            // $account_types = AccountType::with(['company'])->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            // $sub_accounts = AccountName::where('account_type_id', head(array_keys($account_types)))->with(['company', 'account_type'])
            // ->whereHas('company', function ($query) {
            //     $query->where('id', get_company()->id);
            // })->whereHas('account_type', function ($query) {
            //     $query->where('company_id', get_company()->id);
            // })->get()->pluck('name', 'id')->toArray();
            $permission_ent_id = $id;

            return view('admin.PermissionEntFreight.edit', compact('permissionentfreight_details', 'permission_ent_id','Customers','TypeOfProduct'));
        } else {
            return back();
        }
    }
}
