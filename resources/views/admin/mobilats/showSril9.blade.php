<?php
use App\MobilatEntDetails;
use App\MobilatExDetails;
use App\MobilatDetails;


?>

@extends('admin.layouts.adminLite')
@section('title','حركه الصرف ')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> حساب الشحنه </span><br>
@endsection

@section('levelLinks')

@endsection

@section('body')
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
        @include('admin.layouts.tabs_lang', ['lang' => ['ar']])
    </div>
    <!--./tabs header  -->

    <!-- tabs body -->
    <div class="tab-content">

      <div id="english1" class="tab-pane active in">

        <!-- form add user -->
            <div class="box-body">
               <!-- name -->


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
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">حساب الشحنه الاجمالي ::{{$cont}}</h3><br>
      <h3 class="box-title">اسم العميل  : {{$test[0]}}</h3><br>
      <h3 class="box-title">اجمالي العدد    : {{$total}}</h3><br>
    </div>

    @if(count($permission_ent_details_freight) > 0)

    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>نوع الصنف</th>
            <th>اسم الصنف</th>
            <th>العدد</th>
            <th>سعر القطعه</th>
            <th>القيمه </th>
            <th>الوزن </th>
            <th>رقم اذن الاستلام</th>
            <th>التاريخ</th>


        </tr>
        </thead>
        <tbody>
        @foreach ($permission_ent_details_freight as $t)
            <tr>
                <td>{{$t->TypeOfProduct->name}}</td>
                <td>{{$t->ProductName}}</td>
                <td>{{$t->Quantityrecipient}}</td>
                <td>{{$t->Tcotpiece}}</td>
                <td>{{$t->cost}}</td>
                <td>{{$t->wight}}</td>
                <td>{{$t->permission_ent_id}}</td>
                <td>{{$t->updated_at}}</td>
 
            </tr>
            @endforeach
            @foreach ($AccountCustomers as $t)
            <tr>
                <td></td>
                <td>{{$t->Notes}}</td>
                <td>{{$t->account}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$t->permissionEntId}}</td>
                <td>{{$t->date}}</td>
                <td>
                <a href="{{url('Accountstatement/'.$t->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger delete p2" data-title-message="حذف المنتج" data-message="تم حذف المنتج بنجاح" del-name="{{$t->name}}" del-url="{{url('accountcustomers/'.$t->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>
                
                </td>
 
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>نوع الصنف</th>
            <th>اسم الصنف</th>
            <th>العدد</th>
            <th>سعر القطعه</th>
            <th>اجمالي السعر</th>
            <th>الوزن </th>
            <th>رقم اذن الاستلام</th>
            <th>التاريخ</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box">

<div class="box-header">

  
    </div>
    <!-- /.box-body -->
 @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> عفواً لا يوجد حركه لهاذا الصنف</h4>
    </div>
  @endif
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
 

@endsection
