@extends('admin.layouts.adminLite')
@section('title','اذن خروج شحن')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> اذن استلام شحن</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">اذن استلام شحن</li>
@endsection

@section('body')
@include('admin.companies.modal_view_company')
@can('التحكم في اذون استلام الشحن' )
                    
<br>
<a type="link" href="{{url('permissionent/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اذن جديد</a>
<br>
<br>
@endcan
<!-- Table -->
<div class="box">

    <div class="box-header">
      
      <h3 class="box-title">جميع الاذون</h3>
    </div>
    <!-- /.box-header -->
    @if(count($PermissionEnt) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#Id</th>
            <th>اسم العميل</th>
            <th>الكميه</th>
            <th>الوزن</th>
            <th>التاريخ</th>
            <th>التحكم</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($PermissionEnt as $PermissionEnts)
          <tr>
            <td>{{ $PermissionEnts->id }}</td>
            <td>{{ $PermissionEnts->CustomerNames }}</td>
            <td>{{ $PermissionEnts->Total }}</td>
            <td>{{ $PermissionEnts->TotalW }}</td>
            <td>{{ $PermissionEnts->updated_at }}</td>
            <td>
              
              <a href="{{url('permissionent/'.$PermissionEnts->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Show Transition"><i class="fa fa-eye"></i></a>
              @can('التحكم في اذون استلام الشحن' )
              <a href="{{url('permissionent/'.$PermissionEnts->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Transition"><i class="fa fa-edit"></i></a>
              @can('admin' )
              <a href="{{url('permissionent/pricing/'.$PermissionEnts->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-bar-chart"></i></a>
              <a href="{{url('downloadExcel/'.$PermissionEnts->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-sort-amount-asc"></i></a>
              <a href="{{url('prisess/'.$PermissionEnts->id)}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Show Transition"><i class="fa fa-eye"></i></a>
              <a href="{{url('permissionent/action/'.$PermissionEnts->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-angle-double-right "></i></a>
              <a class="btn btn-danger delete p2" data-title-message="تم حذف المجوعه" data-message="تم حذف المجموعه بنجاح" del-name="{{$PermissionEnts->id}}" del-url="{{url('permissionent/'.$PermissionEnts->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>
          
              @endcan
              
              @endcan
            </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
              <th>#Id</th>
              <th>اسم العميل</th>
            <th>الكميه</th>
            <th>الوزن</th>
            <th>التاريخ</th>
            <th>التحكم</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $PermissionEnt->render() }}
    </div>
  @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> للاسف لا يوجود اي اذن</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
    {!! Html::script('public/admin/js/view_company.js') !!}

@endsection
