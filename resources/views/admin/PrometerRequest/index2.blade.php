@extends('admin.layouts.adminLite')
@section('title','طلبات مبيعات')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> طلبات المبيعات </span>
@endsection

@section('levelLinks')
@endsection

@section('body')
@include('admin.companies.modal_view_company')


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
            <th>أسم العميل</th>
            <th>التاريخ</th>
            <th>العضو </th>

            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($PrometerRequests as $MobilatEnts)
            <tr>
            <td>{{ $MobilatEnts->Customersed->name }}</td>
            <td>{{ $MobilatEnts->created_at }}</td>
            <td>{{ $MobilatEnts->UserMod->name }}</td>
              
            <td>
                <a href="{{url('prometer/action/'.$MobilatEnts->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
               
            @can('تعديل اذون اضافه تجاره')
                
                <a class="btn btn-danger delete p2" data-title-message="حذف المنتج" data-message="تم حذف المنتج بنجاح" del-name="{{$MobilatEnts->name}}" del-url="{{url('prometerrequests/'.$MobilatEnts->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>
            @endcan
           
            </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>أسم العميل</th>
            <th>التاريخ</th>

            <th>العضو </th>
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
