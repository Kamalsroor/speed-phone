@extends('admin.layouts.adminLite')
@section('title','Companies')

@section('pageHeader')
<i class="fa fa-building-o" aria-hidden="true"></i><span class="text-uppercase"> Companies</span>
@endsection

@section('levelLinks')
<li><a href="{{aurl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">Companies</li>
@endsection

@section('body')
@include('admin.companies.modal_view_company')
<br>
<a type="link" href="{{url('companies/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> New Company</a>
<br>
  <br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">All Companies</h3>
    </div>
    <!-- /.box-header -->
    @if(count($companies) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Employment</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
            <tr>
                <td>{{$company->name}}</td>
                <td>{{$company->email}}</td>
                <td>{{$company->employment}}</td>
                <td>{{$company->status == 0 ? 'Inactive' : 'Active'}}</td>
                <td>
                    <a href="{{ route('comp_user.company', $company->id)}}" style="margin-right: 20px;" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Show All Users"><i class="fa fa-users"></i></a>

                    <a style="padding: 0;" href="{{route('companies.show', $company->id)}}" class="btn btn-primary view-company" data-target="#modal_view_company" data-toggle="modal">
                        <div style="width: 100%; height: 100%; padding: .375rem .75rem;" data-toggle="tooltip" data-placement="top" title="View Company">
                            <i class="fa fa-eye"></i>
                        </div>
                    </a>
                    <a href="{{url('companies/'.$company->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Company"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger delete p2" data-title-message="Delete Company" data-message="Company has been deleted successfully" del-name="{{$company->name}}" del-url="{{url('companies/'.$company->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Company"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Employment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $companies->render() }}
    </div>
  @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> Sorry, no companies found</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    @include('admin.layouts.message') 
    {!! Html::script('public/js/admin/delete_row.js') !!}
    {!! Html::script('public/admin/js/view_company.js') !!}
@endsection
