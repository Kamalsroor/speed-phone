@inject('request', 'Illuminate\Http\Request')

@extends('admin.layouts.adminLite')
@section('title','الصلاحيات')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> الصلاحيات</span>
@endsection

@section('levelLinks')

<li class="active">الصلاحيات</li>
<li><a href="{{url('/')}}">الرئيسيه<i class="fa fa-dashboard"></i></a></li>
@endsection

@section('body')
<br>
<a type="link" href="{{url('permissions/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اضافه صلاحيه جديده</a>
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع الصلاحيات</h3>
    </div>
    <!-- /.box-header -->
    @if(count($permissions) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->created_at}}</td>
                    <td>
                        <a href="{{url('permissions/'.$permission->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger delete p2" data-title-message="حذف المنتج" data-message="تم حذف المنتج بنجاح" del-name="{{$permission->name}}" del-url="{{url('permissions/'.$permission->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>
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
        {{ $permissions->render() }}
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
