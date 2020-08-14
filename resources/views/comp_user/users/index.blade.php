@extends('comp_user.layouts.adminLite')
@section('title','Users')

@section('pageHeader')
<i class="fa fa-user" aria-hidden="true"></i><span class="text-uppercase"> Users</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">Users</li>
@endsection

@section('body')
@include('comp_user.users.modal_view_comp_user')
<br>

  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">All Users</h3>
    </div>
    <!-- /.box-header -->
    @if(count($users) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>User Status</th>
            <th>User Approved</th>
            <th>Date Expire</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->rule == 0 ? 'User' : 'Admin'}}</td>
                <td>{{$user->status == 0 ? 'Inactive' : 'Active'}}</td>
                <td>{{$user->approved == 0 ? 'Not Enabled' : 'Enabled'}}</td>
                <td>{{$user->date_expire}}</td>
                <td>
                    <a style="padding: 0;" href="{{route('c_user.show', $user->id)}}" class="btn btn-primary view-comp-user from-company" data-target="#modal_view_comp_user" data-toggle="modal">
                        <div style="width: 100%; height: 100%; padding: .375rem .75rem;" data-toggle="tooltip" data-placement="top" title="View User">
                            <i class="fa fa-eye"></i>
                        </div>
                    </a>
                    <a href="{{curl('c_users/'.$user->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="fa fa-edit"></i></a>
                    @unless(Auth::guard('comp_user')->id() == $user->id || Auth::guard('comp_user')->user()->rule == 0 || $user->rule == 1)
                        <a class="btn btn-danger delete p2" data-title-message="Delete User" data-message="User has been deleted successfully" del-name="{{$user->name}}" del-url="{{curl('c_users/'.$user->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete User"><i class="fa fa-trash"></i></a>
                    @endunless
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>User Status</th>
                <th>User Approved</th>
                <th>Date Expire</th>
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
      <h4><i class="icon fa fa-warning"></i> Sorry, no users found</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
    {!! Html::script('public/admin/js/view_comp_user.js') !!}
@endsection
