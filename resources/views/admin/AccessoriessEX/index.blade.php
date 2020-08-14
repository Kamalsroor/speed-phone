@extends('admin.layouts.adminLite')
@section('title','اذن خروج شحن')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> اذن خروج شحن</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="active">اذن خروج شحن</li>
@endsection

@section('body')
@include('admin.companies.modal_view_company')

<br>
<a type="link" href="{{url('mobilatsex/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اذن موبيلات جديد</a>
<a type="link" href="{{url('accessoriesex/create')}}" class="btn btn-primary btn-sm text-uppercase pull-left"><i class="fa fa-plus"></i> اذن اكسسورات جديد</a>
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع الاذون</h3>
    </div>
    <!-- /.box-header -->
    @if(count($MobilatEx) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#Id</th>
            <th>أسم العميل</th>
            <th>رقم الاذن</th>
            <th>رقم الفاتوره</th>
            <th>التاريخ </th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($MobilatEx as $MobilatExs)
            <tr>
                <td>{{ $MobilatExs->id }}</td>
                <td>{{ $MobilatExs->CustomerNames }}</td>
                <td>{{ $MobilatExs->premission_id }}</td>
                <td>{{ $MobilatExs->order_id }}</td>
                <td>{{ $MobilatExs->date }}</td>
                <td>

                    <a href="{{url('mobilatsex/'.$MobilatExs->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Show Transition"><i class="fa fa-eye"></i></a>
                    <a href="{{url('mobilatsex/'.$MobilatExs->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Transition"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
              <th>#Id</th>
              <th>أسم العميل</th>
              <th>رقم الاذن</th>
              <th>رقم الفاتوره</th>
              <th>التاريخ </th>
              <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $MobilatEx->render() }}
    </div>
  @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> للاسف لا يوجود اي اذن</h4>
    </div>
  @endif
  </div>
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
    {!! Html::script('public/admin/js/view_company.js') !!}

@endsection
