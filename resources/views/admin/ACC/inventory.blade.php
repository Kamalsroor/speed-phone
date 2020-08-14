<?php
use App\MobilatDetails;
use App\MobilatExDetails;


?>

@extends('admin.layouts.adminLite')
@section('title','جرد الاكسسوارت')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> جرد الاكسسوارات</span>
@endsection

@section('levelLinks')
@endsection

@section('body')

  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جرد الاكسسوارت</h3>
    </div>
    <!-- /.box-header -->
    @if(count($ACC) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>اسم المنتج</th>
            <th>جاهز للبيع</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($ACC as $ACCs)
            <tr>
                <td>{{$ACCs->name}}</td>
                <td>
                <input type="hidden" value="{{$ACCs->id}}">
             @php
                
            $MobilatDetailsex = MobilatExDetails::where('Prodact_name',$ACCs->id)->pluck('qualityacc')->sum();
            $MobilatDetailsent = MobilatDetails::where('Prodact_name',$ACCs->id)->where('action' , 1)->pluck('ACC')->sum();
          
            $total = $MobilatDetailsent - $MobilatDetailsex;
                @endphp
                {{$total}}
                </td>
                    
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
        {{ $ACC->render() }}
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
