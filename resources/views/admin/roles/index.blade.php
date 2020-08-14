@inject('request', 'Illuminate\Http\Request')

@extends('admin.layouts.adminLite')
@section('title','المجموعات')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> المجموعات</span>
@endsection

@section('levelLinks')
<li class="active">المجموعات</li>
<li><a href="{{url('/')}}">الرئيسيه<i class="fa fa-dashboard"></i></a></li>
@endsection

@section('body')
<br>
<a type="link" href="{{url('roles/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اضافه مجموعه جديده</a>
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع المجموعات</h3>
    </div>
    <!-- /.box-header -->
    @if(count($roles) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID#</th>
            <th>اسم المجموعه</th>
            <th>الصلاحيات</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>
                @foreach ($role->permissions()->pluck('name') as $permission)
                                        <span class="label label-info label-many">{{ $permission }}</span>
                @endforeach
                
                </td>
                
                    <td>
                        <a href="{{url('roles/'.$role->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger delete p2" data-title-message="تم حذف المجوعه" data-message="تم حذف المجموعه بنجاح" del-name="{{$role->name}}" del-url="{{url('roles/'.$role->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>
                    </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>ID#</th>
            <th>اسم المجموعه</th>
            <th>الصلاحيات</th>
            <th>Action</th> 
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $roles->render() }}
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
