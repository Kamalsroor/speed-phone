@extends('admin.layouts.adminLite')
@section('title','طلب مبيعات')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> طلبات المبيعات </span>
@endsection

@section('levelLinks')
@endsection

@section('body')
@include('admin.companies.modal_view_company')

<br>
<a type="link" href="{{url('prometerrequests/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اذن مبيعات موبيلات جديد</a>
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع الطلبات</h3>
    </div>
    <!-- /.box-header -->
    @if(count($PrometerRequests) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#Id</th>
            <th>أسم العميل</th>
            <th>التاريخ</th>
            @can('تعديل اذون اضافه تجاره')
            <th>العضو </th>
            @endcan

            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($PrometerRequests as $MobilatEnts)
            <tr>
            <td>{{ $MobilatEnts->id }}</td>
            <td>{{ $MobilatEnts->Customersed->name }}</td>
            <td>{{ $MobilatEnts->created_at }}</td>
            @can('تعديل اذون اضافه تجاره')
            <td>{{ $MobilatEnts->UserMod->name }}</td>
            @endcan
              
            <td>
                <a href="{{url('prometerrequests/'.$MobilatEnts->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
               
                <a class="btn btn-danger delete p2" data-title-message="حذف المنتج" data-message="تم حذف المنتج بنجاح" del-name="{{$MobilatEnts->name}}" del-url="{{url('prometerrequests/'.$MobilatEnts->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>
            @can('تعديل اذون اضافه تجاره')
               
                <a href="{{url('prometerrequests/action/'.$MobilatEnts->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-bolt"></i></a>
            @endcan
           
            </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>#Id</th>
            <th>أسم العميل</th>
            <th>التاريخ</th>

            @can('تعديل اذون اضافه تجاره')
            <th>العضو </th>
            @endcan

            <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $PrometerRequests->render() }}
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
