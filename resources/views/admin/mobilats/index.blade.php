@extends('admin.layouts.adminLite')
@section('title',' اصناف تليفونات')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> اصناف الموبيلات</span>
@endsection

@section('levelLinks')

@endsection

@section('body')
<br>
<a type="link" href="{{url('mobilats/create')}}" class="btn btn-primary btn-sm text-uppercase pull-right"><i class="fa fa-plus"></i> اضافه صنف جديد</a>
<br>
<br>
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">جميع الاصناف</h3>
    </div>
    <!-- /.box-header -->
    @if(count($mobilats) > 0)
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>اسم الصنف</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($mobilats as $mobilat)
            <tr>
                <td>{{$mobilat->name}}</td>
                <td>{{$mobilat->created_at}}</td>
                    <td>
                        <a href="{{url('mobilats/'.$mobilat->id.'/edit')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Account Type"><i class="fa fa-edit"></i></a>
                    </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>اسم الصنف</th>
                <th>Created At</th>
                    <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="link-paginate">
        {{ $mobilats->render() }}
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
