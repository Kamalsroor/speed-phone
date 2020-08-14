<?php
use App\MobilatEntDetails;
use App\MobilatExDetails;
use App\MobilatDetails;


?>

@extends('admin.layouts.adminLite')
@section('title','حركه الصرف ')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> حركه الصنف</span>
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

      <h3 class="box-title">حركه الصرف</h3>
    </div>
    @if(count($permission_ent_details_freight) > 0)

    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>اسم الصنف</th>
            <th>العميل</th>
            <th>العدد</th>
            <th>رقم اذن الصرف</th>
            <th>اسم المنتج</th>
            <th>التاريخ</th>


        </tr>
        </thead>
        <tbody>
        @foreach ($permission_ex_details_freight as $t)
            <tr>
                <td>{{$t->TypeOfProducttest->name}}</td>
                <td>{{$t->Customersed->name}}</td>
                <td>{{$t->Quantity}}</td>
                <td>{{$t->permission_ex_id}}</td>
                <td>{{$t->ProductName}}</td>
                <td>{{$t->updated_at}}</td>
 
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>اسم الصنف</th>
            <th>العميل</th>
            <th>العدد</th>
            <th>رقم اذن الصرف</th>
            <th>اسم المنتج</th>
            <th>التاريخ</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box">

<div class="box-header">

  <h3 class="box-title">حركه الاستلام</h3>
</div>
   <!-- /.box-header -->
   <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>اسم الصنف</th>
            <th>العميل</th>
            <th>العدد</th>
            <th>رقم اذن الاستلام</th>
            <th>اسم المنتج</th>
            <th>التاريخ</th>


        </tr>
        </thead>
        <tbody>
        @foreach ($permission_ent_details_freight as $t)
            <tr>
                <td>{{$t->TypeOfProduct->name}}</td>
                <td>{{$t->Customersed->name}}</td>
                <td>{{$t->Quantityrecipient}}</td>
                <td>{{$t->permission_ent_id}}</td>
                <td>{{$t->ProductName}}</td>
                <td>{{$t->updated_at}}</td>
 
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>اسم الصنف</th>
            <th>العميل</th>
            <th>العدد</th>
            <th>رقم اذن الصرف</th>
            <th>اسم المنتج</th>
            <th>التاريخ</th>
            </tr>
        </tfoot>
      </table>
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
