<?php

namespace App\Http\Controllers\Admin;

use App\permission_ex_freight;
use App\permission_ex_details_freight;
use App\permission_ent_details_freight;
use App\permission_ent_freight;
use Illuminate\Support\Facades\Gate;
use App\TypeOfProduct;
use App\Customers;
use App\Customersfreight;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Rule;

class PermissionExFreightController extends Controller
{
    public function index()
    {
        if (! Gate::allows('استلام طلبات شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
      $PermissionEx = permission_ex_freight::where('active',0)->orderBy('id', 'DESC')->paginate(50);
      
      return view('admin.PermissionExFreight.index', compact('PermissionEx'));
    }
    public function index2()
    {
        if (! Gate::allows('طلبات تسليم شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $PermissionEx = permission_ex_freight::where('active',1)->orderBy('id', 'DESC')->paginate(50);

        return view('admin.PermissionExFreight.index2', compact('PermissionEx'));
    }
    public function create()
    {
        if (! Gate::allows('اذون خروج شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }


        $permission_ent_details_freight = permission_ent_details_freight::where('customernames', 9)->get();
        $Customers = Customersfreight::get()->pluck('name', 'id')->toArray();
        $permission_ent_freight = permission_ent_freight::get()->pluck('CustomerNames', 'id')->toArray();
        $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();
        return view('admin.PermissionExFreight.add', compact('Customers','TypeOfProduct','permission_ent_freight'));
    }

    public function action2(Request $request) {
        if($request->ajax())
        {
         $output = '';
         $query = $request->get('query');
         if($query != '')
         {
   




            $data = permission_ent_details_freight::
            where('customernames',  'like', '%5%')
            ->get();

         }
         $total_row = $data->count();
         if($total_row > 0)
         {
          foreach($data as $row)
          {
           $output .= '
           <tr>
           <td>'.$row->ProductName.'</td>
            <td>'.$row->ProductName.'</td>
            <td>'.$row->Quantityrecipient.'</td>
           </tr>
           ';
          }
         }
         else
         {
          $output = '
          <tr>
           <td align="center" colspan="5">    <div  class="alert alert-info alert-dismissible ">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h4><i class="icon fa fa-warning"></i> للاسف هذا السريال غير موجود</h4>
         </div>
       </div></td>
          </tr>
          ';
         }
         $data = array(
          'table_data'  => $output,
          'total_data'  => $total_row
         );
   
         echo json_encode($data);
        }
            
       
    }

    
    public function store(Request $request)
    {
        if (! Gate::allows('اذون خروج شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        
        $this->validate(request(), [
            
            'Quantity.*' => 'required',
            'ProductName.*' => 'required|max:350',
            'customernames' => 'required|max:350',
            'PermissionDate' => 'required|max:50'
            ]);
       
                        
            // Total Quantity
            $all_Quantity = [];
            for ($i = 0; $i < count($request->Quantity); $i++) {
                $all_Quantity[] = $request->Quantity[$i];
                $all_Quantitys = $request->Quantity[$i];
                $Prodact_name1 = $request->TypeOfProduct[$i];
                $Prodact_name1 = $request->TypeOfProduct[$i];
                $customernames = $request->customernames;

                $permission_ex_details_freight = permission_ex_details_freight::where('TypeOfProduct',$Prodact_name1)->where('CustomerNames',$customernames)->pluck('Quantity')->sum();
                $permission_ent_details_freight = permission_ent_details_freight::where('type_id',$Prodact_name1)->where('customernames',$customernames)->pluck('Quantityrecipient')->sum();

                $permission_ent_details_freightss = permission_ent_details_freight::where('id',$request->idrow[$i])->pluck('Quantityrecipient')->sum();
                $permission_ent_details_freightsss = permission_ent_details_freight::where('id',$request->idrow[$i])->pluck('quantitydelivered')->sum();

                $totalprodact = $permission_ent_details_freight - $permission_ex_details_freight;
                $error_count_array5 = ['هذا العدد لا يخص العميل بالكامل  .' . $totalprodact ];
  
                $totalprodacts = $permission_ent_details_freightss - $permission_ent_details_freightsss;
                $error_count_array6 = ['هذا العدد اكثر من اللازم.' . $totalprodacts ];
                if ($totalprodacts < $all_Quantitys) {
                    return response()->json(['errors' => [$error_count_array6]], 422);
                    // save transition
                }
            }
            
            $Total = array_sum($all_Quantity);

                
            $error_count_array2 = ['قم بادخال جميع الحقول' . count($request->Quantity) . count($request->ProductName)];
                
                            
        $user_id = auth()->id();
              $active = 0 ;              
            // save transition
            $permissionexfreight = permission_ex_freight::create([
            'CustomerNames' => $request->customernames,
            'PermissionDate' => $request->PermissionDate,
            'Total' => $Total,
            'active' => $active,
            'user_id' => $user_id,
            ]);
            // save transition details
            for ($x = 0; $x < count($request->Quantity); $x++) {

                
                permission_ex_details_freight::create([
                    
                    'permission_ex_id' => $permissionexfreight->id,
                    'CustomerNames' => $request->customernames,
                    'ProductName' => $request->ProductName[$x],
                    'TypeOfProduct' => $request->TypeOfProduct[$x],
                    'active' => $active,
                    'user_id' => $user_id,
                    'Quantity' => $request->Quantity[$x]
                    ]);

                    permission_ent_details_freight::where('id', $request->idrow[$x])->update([
                    
                        'quantitydelivered' => $request->Quantity[$x]
                        ]);
                }
                
                return response()->json([
                'status' => true,
                'linkShowAll' => '<a href="' . route('permissionex.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',

                'message' => 'تمت اضافه الاذن بنجاح'
              ]);
                                
                  
    }

    
    public function show($id)
    {
        $permissionexfreight = permission_ex_freight::where('id', $id)->first();
        if ($permissionexfreight != null) {
            $permissionexfreight_details = permission_ex_details_freight::where('permission_ex_id', $id)->orderBy('id', 'ASC')->get();
            return view('admin.PermissionExFreight.show', compact('permissionexfreight', 'permissionexfreight_details'));
        } else {
            return back();
        }
    }
    //
    public function edit($id)
    {
        if (! Gate::allows('اذون خروج شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }
        $permissionexfreight_details = permission_ex_details_freight::where('permission_ex_id', $id)->orderBy('id', 'ASC')->get();
        $Customers = Customersfreight::get()->pluck('name', 'id')->toArray();
        $TypeOfProduct = TypeOfProduct::get()->pluck('name', 'id')->toArray();
        if ($permissionexfreight_details->count() > 0) {
            $permission_ex_id = $id;

            return view('admin.PermissionExFreight.edit', compact('permissionexfreight_details', 'permission_ex_id','TypeOfProduct','Customers'));
        } else {
            return back();
        }
    }
    //
    public function update(Request $request, $id)
    {
        if (! Gate::allows('اذون خروج شحن')) {
            
            return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            
        }

        $this->validate(request(), [

            'Quantity.*' => 'required',
            'ProductName.*' => 'required|max:350',
            'customernames' => 'required|max:350',
            'PermissionDate' => 'required|max:50'
        ]);


        $user_id = auth()->id();
                            
        // save transition



        $all_Quantity = [];
        // $all_to = [];
        for ($i = 0; $i < count($request->Quantity); $i++) {
                $all_Quantity[] = $request->Quantity[$i];
                $all_Quantitys = $request->Quantityrecipient[$i];
                $Prodact_name1 = $request->TypeOfProduct[$i];

                $error_count_array6 = ['العدد المطلوب من هذا الصنف اكثر من الموجود .' . $Prodact_name1 ];

                $permission_ex_details_freight = permission_ex_details_freight::where('TypeOfProduct',$Prodact_name1)->pluck('Quantity')->sum();
                $permission_ent_details_freight = permission_ent_details_freight::where('type_id',$Prodact_name1)->pluck('Quantityrecipient')->sum();
                $totalprodact = $permission_ent_details_freight - $permission_ex_details_freight;
                if ($totalprodact < $all_Quantitys) {
                    return response()->json(['errors' => [$error_count_array6]], 422);
                    // save transition
                    }
        }
        $Total = array_sum($all_Quantity);


        if (count($request->ProductName) == count($request->Quantity)
            && count($request->id) == count($request->Quantity) ) {
            // delete row removed
            $delete_ids = explode(',', $request->delete_ids);
            permission_ex_details_freight::destroy($delete_ids);

            // save transition
            $permissionexfreight = permission_ex_freight::where('id', $id)->update([
                'CustomerNames' => $request->customernames,
                'PermissionDate' => $request->PermissionDate,
                'user_id' => $user_id,                
                'Total' => $Total
            ]);
            // save transition details
            for ($x = 0; $x < count($request->Quantity); $x++) {



                permission_ex_details_freight::updateOrCreate(
                    [
                        'id' => $request->id[$x],
                        'permission_ex_id' => $id,
                    ],
                    [

                        'ProductName' => $request->ProductName[$x],
                        'Quantity' => $request->Quantity[$x],
                        'TypeOfProduct' => $request->TypeOfProduct[$x],
                        'user_id' => $user_id,                

                    ]
                );
            }



            return response()->json([
                'status' => true,

                'linkShowAll' => '<a href="' . route('permissionex.index') . '">لمشاهده جميع الاذون اضغط هنا</a>.',

                'message' => 'تم تعديل الاذن بنجاح'
            ]);
        } else {
            return response()->json(['errors' => [$error_count_array]], 422);
        }
    }
    public function action($id)
    {

        $Entacc = 1;


        // delete transtion
        $permissionexfreight = permission_ex_freight::where('id', $id)->update([
            'active' => $Entacc,
            ]);
            $permission_ex_details_freight = permission_ex_details_freight::where('permission_ex_id', $id)->update([
                'active' => $Entacc,
                ]);

            
        // delete transtion details
        return redirect()->route('permissionex.index')->with('success', 'تم الموافقه المنتج بنجاح');
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
}
