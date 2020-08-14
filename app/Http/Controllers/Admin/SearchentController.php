<?php

namespace App\Http\Controllers\Admin;
use App\MobilatDetails;
use Rule;
use App\MobilatEnt;
use App\MobilatEntDetails;
use App\MobilatEx;
use App\MobilatExDetails;
use App\Mobilat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class SearchentController extends Controller
{

    public function index()
    {



          return view('admin.mobilats.showSril2');
    }
    // show only users deleted

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {

       $data = MobilatEntDetails::
         where('sirarnamber', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
         
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
        <td>'.$row->sirarnamber.'</td>
         <td>'.$row->Mobilat->name.'</td>
         <td>'.$row->MobilatEx->CustomerNames.'</td>
         <td>'.$row->MobilatEx->premission_id.'</td>
         <td>'.$row->MobilatEx->order_id.'</td>
         <td>'.$row->date.'</td>
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
