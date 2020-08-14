@extends('comp_user.layouts.adminLite')
@section('title','Show Transitions')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> Show Transitions</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">Show Transitions</li>
@endsection

@section('styles')
    <style>
        .title-transition-details {
            display: block !important;
            margin-bottom: 15px !important;
            background-color: #f5f5f5;
            padding: 8px;
        }
        .title-transition-details strong {
            display: inline-block;
            width: 230px;
            color: #2c3e50;
            margin-right: 10px;
        }
        .table {
            text-align: center;
        }
    </style>
@endsection

@section('body')
<br>
<a type="link" href="{{route('transitions.edit', $transition->id)}}" class="btn btn-success btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> Edit Transition</a>
<br>
<br>
  <!-- Table -->
  <div class="box">
    <div class="box-header">
        <h3 class="box-title title-transition-details"><strong>Transition Id</strong> {{ $transition->id }}</h3>
        <h3 class="box-title title-transition-details"><strong>Transition Description</strong> {{ $transition->description }}</h3>
        <h3 class="box-title title-transition-details"><strong>Total Amount</strong> {{ money($transition->amount) }}</h3>
        <h3 class="box-title title-transition-details"><strong>Added By</strong> {{ $transition->user->name }}</h3>
        <h3 class="box-title title-transition-details"><strong>Created At</strong> {{ $transition->created_at }}</h3>
        <br>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Account Type</th>
            <th>Sub Account</th>
            <th>From</th>
            <th>To</th>
            <th>Added By</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($transition_details as $details)
            <tr>
                <td>{{ $details->account_type->name }}</td>
                <td>{{ $details->account_name->name }}</td>
                <td>{{ $details->action == 'from' ? money($details->amount) : 'ـــــــــــــ' }}</td>
                <td>{{ $details->action == 'to' ? money($details->amount) : 'ـــــــــــــ' }}</td>
                <td>{{ $details->user->name }}</td>
                <td>{{ $details->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Account Type</th>
                <th>Sub Account</th>
                <th>From</th>
                <th>To</th>
                <th>Added By</th>
                <th>Created At</th>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td></td>
                <th>Total Amount Is: </th>
                <th>{{ money($transition->amount) }}</th>
                <th>{{ money($transition->amount) }}</th>
                <td colspan="2"></td>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
  
@endsection