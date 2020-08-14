@extends('admin.layouts.adminLite')
@section('title','Companies Users')

@section('pageHeader')
<i class="fa fa-user" aria-hidden="true"></i><span class="text-uppercase"> Companies Users</span>
@endsection

@section('levelLinks')
<li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">Companies Users</li>
@endsection

@section('body')
@include('admin.comp_user.modal_view_comp_user')
@include('admin.companies.modal_view_company')
<br>
<a type="link" href="{{url('companies_users/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> New User</a>
<br>
  <br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">{{ $title_page }}</h3>
    </div>
    <!-- /.box-header -->
    @if(count($users) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Name</th>
          <th>Company</th>
          <th>Email</th>
          <th>User Type</th>
          <th>User Approved</th>
          <th>Date Expire</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>
                    <a style="padding: 0;" href="{{route('companies.show', $user->company->id)}}" class="btn btn-link view-company" data-target="#modal_view_company" data-toggle="modal">
                        {{$user->company->name}}
                    </a>
                </td>
                <td>{{$user->email}}</td>
                <td>{{$user->rule == 0 ? 'User' : 'Admin'}}</td>
                <td>{{$user->approved == 0 ? 'Disabled' : 'Enabled'}}</td>
                <td>{{$user->date_expire}}</td>
                <td>
                    @if ($user->approved == 0)
                        <a 
                            class="btn btn-info approve-comp-user"
                            data-page="{{ $title_page == 'Pending Users' ? 'pending' : '' }}"
                            data-title-message="Approve User" 
                            data-message="User has been approved successfully" 
                            del-name="{{$user->name}}" 
                            del-url="{{ route('comp_user.approve', $user->id) }}" 
                            tabindex="1" 
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Approve User">
                            <i class="fa fa-check"></i>
                        </a>
                    @endif
                    @if ($user->deleted_at != null)
                        <a 
                            class="btn btn-info delete p2" 
                            data-title-message="Restore User" 
                            data-message="User has been restored successfully" 
                            del-name="{{$user->name}}" 
                            del-url="{{ route('comp_user.restore', $user->id) }}" 
                            tabindex="1" 
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Restore User">
                            <i class="fa fa-undo"></i>
                        </a>
                        @else
                            <a style="padding: 0;" href="{{route('comp_user.show', $user->id)}}" class="btn btn-primary view-comp-user" data-target="#modal_view_comp_user" data-toggle="modal">
                                <div style="width: 100%; height: 100%; padding: .375rem .75rem;" data-toggle="tooltip" data-placement="top" title="View User">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </a>
                            <a href="{{url('companies_users/'.$user->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="fa fa-edit"></i></a>
                    @endif
                    <a 
                        class="btn btn-danger delete p2" 
                        data-title-message="Delete User" 
                        data-message="User has been deleted successfully" 
                        del-name="{{$user->name}}" 
                        del-url="{{ $user->deleted_at != null ? route('comp_user.force_delete', $user->id) : url('companies_users/'.$user->id) }}" 
                        tabindex="1" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Delete User">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>User Type</th>
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
      <h4><i class="icon fa fa-warning"></i> Sorry, no companies users found</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
    {!! Html::script('public/admin/js/view_comp_user.js') !!}
    {!! Html::script('public/admin/js/view_company.js') !!}
    {!! Html::script('public/admin/js/approve_comp_user.js') !!}
@endsection
