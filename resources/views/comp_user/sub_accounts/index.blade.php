@extends('comp_user.layouts.adminLite')
@section('title','Sub Accounts')

@section('pageHeader')
<i class="fa fa-window-restore" aria-hidden="true"></i><span class="text-uppercase"> Sub Accounts</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">Sub Accounts</li>
@endsection

@section('body')
<br>
<a type="link" href="{{curl('sub_accounts/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> New Sub Account</a>
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">All Sub Accounts</h3>
    </div>
    <!-- /.box-header -->
    @if(count($sub_accounts) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Account Type</th>
            <th>Added By</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($sub_accounts as $account)
            <tr>
                <td>{{$account->name}}</td>
                <td>{{$account->account_type->name}}</td>
                <td>{{$account->user->name}}</td>
                <td>{{$account->created_at}}</td>
                <td>
                    <a href="{{curl('sub_accounts/'.$account->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Sub Account"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger delete p2" data-title-message="Delete Sub Account" data-message="Sub account has been deleted successfully" del-name="{{$account->name}}" del-url="{{curl('sub_accounts/'.$account->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Sub Account"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Account Type</th>
                <th>Added By</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $sub_accounts->render() }}
    </div>
  @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> Sorry, no sub accounts found</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
@endsection
