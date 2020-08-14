@extends('admin.layouts.adminLite')
@section('title','اذن توريد تجاره')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> اذن توريد تجاره </span>
@endsection

@section('levelLinks')
@endsection

@section('body')
@include('admin.companies.modal_view_company')

<br>
<a type="link" href="{{url('mobilatsent/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اذن تورد موبيلات جديد</a>
<a type="link" href="{{url('accessoriesent/create')}}" class="btn btn-primary btn-sm text-uppercase pull-left"><i class="fa fa-plus"></i> اذن تورد اكسسورات جديد</a>
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع الاذون</h3>
    </div>
    <!-- /.box-header -->
    @if(count($MobilatEnt) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#Id</th>
            <th>أسم العميل</th>
            <th>رقم الاذن</th>
            <th>رقم الفاتوره</th>
            <th>التاريخ </th>
            @can('تعديل اذون اضافه تجاره')
            <th>العضو </th>
            @endcan

            <th>اكسسوار/ موبيل </th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($MobilatEnt as $MobilatEnts)
            <tr>
                <td>{{ $MobilatEnts->id }}</td>
                <td>{{ $MobilatEnts->CustomersMod->name }}</td>
                <td>{{ $MobilatEnts->premission_id }}</td>
                <td>{{ $MobilatEnts->order_id }}</td>
                <td>{{ $MobilatEnts->created_at }}</td>
                @can('تعديل اذون اضافه تجاره')
                <td>{{ $MobilatEnts->UserMod->name }}</td>
                @endcan
                <td>
                  @if( $MobilatEnts->accormobiles == 1 )
                  اكسسور
                  @endif
                  @if( $MobilatEnts->accormobiles !== 1 )
                  موبيل
                  @endif
                </td>
                <td>
                  @if( $MobilatEnts->accormobiles == 1 )
                  @can('تعديل اذون اضافه تجاره')
                    <a class="btn btn-danger delete p2" data-title-message="حذف المنتج" data-message="تم حذف المنتج بنجاح" del-name="{{$MobilatEnts->name}}" del-url="{{url('accessoriesent/'.$MobilatEnts->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>

                    <a href="{{url('accessoriesent/'.$MobilatEnts->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Transition"><i class="fa fa-edit"></i></a>
                @endcan
                    <a href="{{url('accessoriesent/'.$MobilatEnts->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Show Transition"><i class="fa fa-eye"></i></a>
                    @endif

                  @if( $MobilatEnts->accormobiles !== 1 )
                  @can('تعديل اذون اضافه تجاره')
                    <a class="btn btn-danger delete p2" data-title-message="حذف المنتج" data-message="تم حذف المنتج بنجاح" del-name="{{$MobilatEnts->name}}" del-url="{{url('mobilatsent/'.$MobilatEnts->id)}}" tabindex="1" data-toggle="tooltip" data-placement="top" title="Delete Account Type"><i class="fa fa-trash"></i></a>

                    <a href="{{url('mobilatsent/'.$MobilatEnts->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Transition"><i class="fa fa-edit"></i></a>
                @endcan
                    <a href="{{url('mobilatsent/'.$MobilatEnts->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Show Transition"><i class="fa fa-eye"></i></a>
                  @endif
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
            @can('تعديل اذون اضافه تجاره')
            <th>العضو </th>
            @endcan
            <th>اكسسوار/ موبيل </th>
            <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $MobilatEnt->render() }}
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
