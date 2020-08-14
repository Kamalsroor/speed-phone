@extends('comp_user.layouts.adminLite')
@section('title','Transitions')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> Transitions</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">Transitions</li>
@endsection

@section('body')
<br>
<a type="link" href="{{curl('transitions/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> New Transition</a>
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">All Transitions</h3>
    </div>
    <!-- /.box-header -->
    @if(count($transitions) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#Id</th>
            <th>Transition</th>
            <th>Amount</th>
            <th>Added By</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($transitions as $transition)
            <tr>
                <td>{{ $transition->id }}</td>
                <td>{{ $transition->description }}</td>
                <td>{{ money($transition->amount) }}</td>
                <td>{{ $transition->user->name }}</td>
                <td>{{ $transition->created_at }}</td>
                <td>
                    <a href="{{curl('transitions/'.$transition->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Show Transition"><i class="fa fa-eye"></i></a>
                    <a href="{{curl('transitions/'.$transition->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Transition"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger delete p2" data-title-message="Delete Transition" data-message="Transition has been deleted successfully" del-name="{{$transition->descprition}}" del-url="{{curl('transitions/'.$transition->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Transition"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#Id</th>
                <th>Transition</th>
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
        {{ $transitions->render() }}
    </div>
  @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> Sorry, no transitions found</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
@endsection
