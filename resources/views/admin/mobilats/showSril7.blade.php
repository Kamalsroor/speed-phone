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
    @if(count($MobilatDetails) > 0)

    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>السريال</th>
            <th>اسم الصنف</th>
            <th>اسم العميل</th>
            <th>اذن اضافه</th>
            <th>اذن صرف</th>
            <th>العضو</th>
            <th>التاريخ</th>


        </tr>
        </thead>
        <tbody>
        @foreach ($MobilatDetails as $MobilatDetail)
            <tr>
                
                
                <td>{{$MobilatDetail->sirarnamber}}</td>
                <td>{{$MobilatDetail->MobilatMod->name}}</td>

                <td>{{$MobilatDetail->CustomersMod->name}}</td>
                @if($MobilatDetail->MobilatEntID == null)
                <td>----</td>
                @else
                <td>{{$MobilatDetail->MobilatEntID}}</td>
                @endif
                @if($MobilatDetail->MobilatExID == null)
                <td>----</td>
                @else
                <td>{{$MobilatDetail->MobilatExID}}</td>
                @endif
                <td>{{$MobilatDetail->UserMod->name}}</td>
                <td>{{$MobilatDetail->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>السريال</th>
            <th>اسم الصنف</th>
            <th>اسم العميل</th>
            <th>اذن اضافه</th>
            <th>اذن صرف</th>
            <th>العضو</th>
            <th>التاريخ</th>
            </tr>
        </tfoot>
      </table>
      <button>Sort by date</button>

    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $MobilatDetails->render() }}
    </div>
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
