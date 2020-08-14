@extends('comp_user.layouts.adminLite')
@section('title','Transitions Details')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> Transitions Details</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">Transitions Details</li>
@endsection

@section('styles')
    <style>
        .table tr th:first-child,
        .table tr td:first-child {
            max-width: 60px !important;
        }
        .table tr th:nth-of-type(5),
        .table tr td:nth-of-type(5) {
            max-width: 90px !important;
        }
    </style>
@endsection

@section('body')
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">All Transitions Details</h3>
    </div>
    <!-- /.box-header -->
    @if(count($transitions_details) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#Id</th>
            <th>Description</th>
            <th>Account Type</th>
            <th>Sub Account</th>
            <th>Operation Type</th>
            <th>Amount</th>
            <th>Added By</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($transitions_details as $transition)
            <tr>
                <td>{{ $transition->transition_id }}</td>
                <td>{{ $transition->transition->description }}</td>
                <td>{{ $transition->account_type->name }}</td>
                <td>{{ $transition->account_name->name }}</td>
                <td>{{ $transition->action }}</td>
                <td>{{ money($transition->amount) }}</td>
                <td>{{ $transition->user->name }}</td>
                <td>{{ $transition->created_at }}</td>
                <td>
                    <a href="{{curl('transitions/'.$transition->transition_id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Transition"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#Id</th>
                <th>Description</th>
                <th>Account Type</th>
                <th>Sub Account</th>
                <th>Operation Type</th>
                <th>Amount</th>
                <th>Added By</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $transitions_details->render() }}
    </div>
  @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> Sorry, no transitions details found</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
@endsection
