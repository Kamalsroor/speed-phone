@extends('admin.layouts.adminLite')
@section('title','اذن خروج شحن')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> اذن تسليم شحن</span>
@endsection

@section('levelLinks')
<li class="active">اذون خروج شحن</li>
<li><a href="{{url('/')}}">الرئيسيه<i class="fa fa-dashboard"></i></a></li>

@endsection

@section('body')
@include('admin.companies.modal_view_company')

  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع الاذون</h3>
    </div>
    <!-- /.box-header -->
    @if(count($PermissionEx) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#Id</th>
            <th>اسم العميل</th>
            <th>المجموع</th>
            <th> تاريخ الصرف</th>
            @can('admin')
            <th> العضو</th>
           @endcan

            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($PermissionEx as $PermissionExs)
            <tr>
                <td>{{ $PermissionExs->id }}</td>
                <td>{{ $PermissionExs->Customersed->name }}</td>
                <td>{{ $PermissionExs->Total }}</td>
                <td>{{ $PermissionExs->updated_at }}</td>
                @can('admin')
                <td>{{ $PermissionExs->UserMod->name }}</td>
                 @endcan
                <td>
            @can('admin')
               
               <a href="{{url('permissionex/action/'.$PermissionExs->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-bolt"></i></a>
               <a href="{{url('permissionex/'.$PermissionExs->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Transition"><i class="fa fa-edit"></i></a>
           @endcan
                    <a href="{{url('permissionex/'.$PermissionExs->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Show Transition"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>#Id</th>
            <th>اسم العميل</th>
            <th>المجموع</th>
            <th> تاريخ الصرف</th>
            @can('admin')
            <th> العضو</th>
           @endcan

            <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $PermissionEx->render() }}
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
