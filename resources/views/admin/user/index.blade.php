@extends('admin.layouts.adminLite')
@section('title','الاعضاء')

@section('pageHeader')
<i class="fa fa-user" aria-hidden="true"></i><span class="text-uppercase"> الاعضاء</span>
@endsection

@section('levelLinks')
<li class="active">الاعضاء</li>
<li><a href="{{url('/')}}">الرئيسيه<i class="fa fa-dashboard"></i></a></li>
@endsection

@section('body')
<br>
<a type="link" href="{{url('users/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> New User</a>
<br>
  <br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع الاعضاء</h3>
    </div>
    <!-- /.box-header -->
    @if(count($users) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>الاسم</th>
          <th>البريد</th>
          <th>المجموعه</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                     @foreach ($user->roles()->pluck('name') as $role)
                 <span class="label label-info label-many">{{ $role }}</span>
                   @endforeach
                </td>
                <td>{{$user->created_at}}</td>
                <td>
                    <a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="fa fa-edit"></i></a>
                    @unless($user->id === 1 && $user->rule === 1 || $user->rule === 1 && auth()->user()->rule === 0 || $user->id === auth()->id())
                        <a class="btn btn-danger delete p2" data-title-message="تم حذف العضو {{$user->name}} بنجاح" data-message="تم الحذف بنجاح" del-name="{{$user->name}}" del-url="{{url('users/'.$user->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete User"><i class="fa fa-trash"></i></a>
                    @endunless
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>الاسم</th>
                <th>البريد</th>
                <th>المجموعه</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $users->render() }}
    </div>
  @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> Sorry, no user found</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
@endsection
