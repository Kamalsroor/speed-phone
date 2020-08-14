<?php
use App\MobilatEntDetails;
use App\MobilatExDetails;
use App\AccountCustomers;
use App\permission_ent_details_freight;

use App\permission_ent_freight;

?>

@extends('admin.layouts.adminLite')
@section('title','حركه الصرف ')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> 

حسابات العميل ::

{{$namec}}

</span>
<br>

<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase">
الرصيد ::
@php
            $AccountCustomers = AccountCustomers::where('customersname', $ids)->where('accountss', 1)->pluck('account')->sum();
            $AccountCustomSSers = AccountCustomers::where('customersname', $ids)->where('accountss', 2)->pluck('account')->sum();
            $permission_ent_details_freight = permission_ent_details_freight::where('customernames',$ids)->pluck('cost')->sum();
            $total = $permission_ent_details_freight + $AccountCustomSSers - $AccountCustomers;
            @endphp 
            {{$total}}
ج.م
</span>
@endsection

@section('levelLinks')

@endsection

@section('body')
<a type="link" href="{{url('accountcustomers/customer/'.$ids)}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اضافه حساب  جديد</a>
<a type="link" href="{{url('Accountstatement/customer/'.$ids)}}" class="btn btn-primary btn-sm text-uppercase pull-left"><i class="fa fa-plus"></i> اضافه مصاريف جديده</a>
<br>
<br>
 <!-- main box -->
 <div class="box box-primary">
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
    <!--tabs header  -->
    <div class="box-header with-border">
      
    </div>
    <!--./tabs header  -->

    <!-- tabs body -->
    <div class="tab-content">

      <div id="english1" class="tab-pane active in">

        <!-- form add user -->
            <div class="box-body">
               <!-- name -->

   <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th> رقم اذن الاستلام</th>
            <th>عليه </th>
            <th>ملاحظات</th>
            <th>النوع</th>
            <th>التاريخ</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($MobilatDetailss as $Customersfreights)
            <tr>
                
                
                <td>{{$Customersfreights}}</td>
                <td>
                @php
                
            $AccountCustomers = AccountCustomers::where('customersname', $ids)->where('accountss', 2)->where('permissionEntId',$Customersfreights)->pluck('account')->sum();
            $permission_ent_details_freight = permission_ent_details_freight::where('customernames',$ids)->where('permission_ent_id',$Customersfreights)->pluck('cost')->sum();
           $cont = $AccountCustomers + $permission_ent_details_freight
                    @endphp 
                {{$cont}}
  
                
                </td>
                <td></td>
                <td>عليه</td>

                <td>
                @php
                
              $permissionentfreight = permission_ent_freight::where('id', $Customersfreights)->first();
                
                @endphp 
                {{ money($permissionentfreight->updated_at) }}
  
                
                </td>
                <td>
                <a href="{{url('accountcustomers/Accountstatement/'.$Customersfreights.'/'.$ids)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                </td>

            </tr>
            @endforeach
            @foreach ($Customersfreight as $Customersfreights)
            <tr>
                
                
                <td></td>
                <td>
                @if($Customersfreights->accountss == 1)
                -  {{$Customersfreights->account}}
                @elseif($Customersfreights->accountss == 2)
                {{$Customersfreights->account}}
                @endif  
                
                </td>
                <td>{{$Customersfreights->Notes}}</td>
                <td>
                @if($Customersfreights->accountss == 1)
                له
                @elseif($Customersfreights->accountss == 2)
                عليه
                @endif                
                
                </td>
                <td>{{$Customersfreights->date}}</td>
                <td> 
                <a href="{{url('accountcustomers/'.$Customersfreights->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger delete p2" data-title-message="حذف المنتج" data-message="تم حذف المنتج بنجاح" del-name="{{$Customersfreights->name}}" del-url="{{url('accountcustomers/'.$Customersfreights->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>

                </td>

            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th> رقم اذن الاستلام</th>
            <th>عليه </th>
            <th>التاريخ</th>
            </tr>
        </tfoot>
      </table>
      
    </div>
    <!-- /.box-body -->
          </div>
          <!-- /.box-body -->
        </div>  <!-- /.english tab -->


        <!-- common inputs **************************************** -->
        <div class="box-body">

          <!-- Submit -->
          <div class="box-footer">
          </div>
          <!-- /.Submit -->
        </div>
        <!-- ./ common inputs-->
     <!--./ form -->

    </div>
    <!-- ./ tabs body -->
  </div>
  <!-- ./ main box -->
  <!-- Table -->
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
 

@endsection
