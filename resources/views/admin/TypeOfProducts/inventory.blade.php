<?php
use App\permission_ex_details_freight;
use App\permission_ent_details_freight;
use App\MobilatExDetails;
use App\MobilatDetails;

?>

@extends('admin.layouts.adminLite')
@section('title','جرد اصناف الشحن')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> جرد اصناف الشحن</span>
@endsection

@section('levelLinks')
@endsection

@section('body')

  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جرد اصناف الشحن</h3>
    </div>
    <!-- /.box-header -->
    @if(count($TypeOfProduct) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>اسم الصنف</th>
            <th> الكميه الفعليه</th>
            @can('حركه الاصناف' )
            <th> كرت صنف</th>
                @endcan

        </tr>
        </thead>
        <tbody>
            @foreach ($TypeOfProduct as $ACCs)
            <tr>
                <td>{{$ACCs->name}}</td>
                <td>
                @php
                
                
            $permission_ex_details_freight = permission_ex_details_freight::where('TypeOfProduct', $ACCs->id)->where('active',1)->pluck('Quantity')->sum();
            $permission_ent_details_freight = permission_ent_details_freight::where('type_id',$ACCs->id)->pluck('Quantityrecipient')->sum();
            $total = $permission_ent_details_freight - $permission_ex_details_freight;
                @endphp 
                {{$total}}
  
                </td>
                @can('حركه الاصناف' )
                <td>
                
                        <a href="{{url('inventorytype/action/'.$ACCs->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
    
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $TypeOfProduct->render() }}
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
