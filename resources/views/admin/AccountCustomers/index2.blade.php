<?php
use App\permission_ex_details_freight;
use App\permission_ent_details_freight;
use App\AccountCustomers;


?>

@extends('admin.layouts.adminLite')
@section('title','العملاء ')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> العملاء</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">العملاء</li>
@endsection

@section('body')
<br>
<a type="link" href="{{url('accountcustomers/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اضافه حساب  جديد</a>
<a type="link" href="{{url('Accountstatement/create')}}" class="btn btn-primary btn-sm text-uppercase pull-left"><i class="fa fa-plus"></i> اضافه مصاريف جديده</a>

<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع العملاء</h3>
    </div>
    <!-- /.box-header -->
    @if(count($AccountCustomers) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th> العميل</th>
            <th>له</th>
            <th>عليه</th>
            <th>الرصيد</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($AccountCustomers as $ACCs)
            <tr>
                <td>{{$ACCs->Customersfreight->name}}</td>
                <td>{{$ACCs->account}}</td>
                <td>
                <?php

                
                ?>
                @if($ACCs->accountss == 1)
                له
                @elseif($ACCs->accountss == 2)
                عليه
                @endif
                </td>
            <td>{{$ACCs->Notes}}</td>
                               <td>
                        <a href="{{url('accountcustomers/action/'.$ACCs->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Created At</th>
                    <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $AccountCustomers->render() }}
    </div>
  @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> Sorry, no account types found</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
@endsection
