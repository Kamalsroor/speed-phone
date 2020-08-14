@extends('comp_user.layouts.adminLite')
@section('title','Accounting Types')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> Accounting Types</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">Accounting Types</li>
@endsection

@section('body')
<br>
@cadmin
<a type="link" href="{{curl('account_types/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> New Account Type</a>
<br>
<br>
@endcadmin
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">All Account Types</h3>
    </div>
    <!-- /.box-header -->
    @if(count($account_types) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Added By</th>
            <th>Created At</th>
            @cadmin
                <th>Action</th>
            @endcadmin
        </tr>
        </thead>
        <tbody>
            @foreach ($account_types as $type)
            <tr>
                <td>{{$type->name}}</td>
                <td>{{$type->user->name}}</td>
                <td>{{$type->created_at}}</td>
                @cadmin
                    <td>
                        <a href="{{curl('account_types/'.$type->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger delete p2" data-title-message="Delete Account Type" data-message="Account type has been deleted successfully" del-name="{{$type->name}}" del-url="{{curl('account_types/'.$type->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>
                    </td>
                @endcadmin
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Added By</th>
                <th>Created At</th>
                @cadmin
                    <th>Action</th>
                @endcadmin
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $account_types->render() }}
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
