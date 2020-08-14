<?php
use App\MobilatDetails;
use App\MobilatExDetails;


?>

@extends('admin.layouts.adminLite')
@section('title','جرد الموبيلات')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> جرد الموبيلات</span>
@endsection

@section('levelLinks')

@endsection

@section('body')

  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جرد الموبيلات</h3>
    </div>
    <!-- /.box-header -->
    @if(count($mobilats) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>اسم الصنف</th>
            <th>جاهز للبيع</th>

        </tr>
        </thead>
        <tbody>
        
            @foreach ($mobilats as $mobilat)
            @php

            $MobilatDetailsex = MobilatDetails::where('Prodact_name',$mobilat->id)->where('active',1)->where('action',2)->get();
            $MobilatDetailsent = MobilatDetails::where('Prodact_name',$mobilat->id)->where('action',1)->get();
            $total = count($MobilatDetailsent) - count($MobilatDetailsex);
                @endphp
                @if($total > 0)
            <tr>
                <td>{{$mobilat->name}}</td>
                <td>

                {{$total}}
                
                </td>
                @can('حركه الاصناف' )
                    <td>
                        <a href="{{url('inventory/action/'.$mobilat->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                    </td>
                @endcan
            </tr>
            @endif
            @endforeach
            
            @foreach ($mobilats as $mobilat)
            @php

            $MobilatDetailsex = MobilatDetails::where('Prodact_name',$mobilat->id)->where('active',1)->where('action',2)->get();
            $MobilatDetailsent = MobilatDetails::where('Prodact_name',$mobilat->id)->where('action',1)->get();
            $total = count($MobilatDetailsent) - count($MobilatDetailsex);
                @endphp
                @if($total == 0)
            <tr>
                <td>{{$mobilat->name}}</td>
                <td>

                {{$total}}
                
                </td>
                @can('حركه الاصناف' )
                    <td>
                        <a href="{{url('inventory/action/'.$mobilat->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                    </td>
                @endcan
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>اسم الصنف</th>
                <th>جاهز للبيع</th>
    
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $mobilats->render() }}
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
