<?php
use App\MobilatEntDetails;
use App\MobilatExDetails;


?>

@extends('admin.layouts.adminLite')
@section('title','حركه الصرف ')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> حركه الصرف</span>
@endsection

@section('levelLinks')

@endsection

@section('body')
 <!-- main box -->
 <div class="box box-primary">
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
    <!--tabs header  -->
    <div class="box-header with-border">
        @include('admin.layouts.tabs_lang', ['lang' => ['ar']])
    </div>
    <!--./tabs header  -->

    <!-- tabs body -->
    <div class="tab-content">

      <div id="english1" class="tab-pane active in">

        <!-- form add user -->
            <div class="box-body">
               <!-- name -->
                <div class="form-group">
                    {!! Form::label('name', 'السريال') !!}
                    {!! Form::text('search', null, ['class' => 'form-control', 'id' => 'search', 'placeholder' => 'اكتب السريال هنا']) !!}
                </div>
                <!--./ name -->

          </div>
          <!-- /.box-body -->
        </div>  <!-- /.english tab -->


        <!-- common inputs **************************************** -->
        <div class="box-body">

          <!-- Submit -->
          <div class="box-footer">
          </div>
          <!-- /.Submit -->
        </div>
        <!-- ./ common inputs-->
     <!--./ form -->

    </div>
    <!-- ./ tabs body -->
  </div>
  <!-- ./ main box -->
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">حركه الصرف</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>السريال</th>
            <th>اسم الصنف</th>
            <th>اسم العميل</th>
            <th>رقم اذن الصرف</th>
            <th>رقم اذن الاضافه</th>
            <th>رقم الفاتوره</th>
            <th>رقم التاريخ</th>


        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
            <th>السريال</th>
            <th>اسم الصنف</th>
            <th>اسم العميل</th>
            <th>رقم اذن الصرف</th>
            <th>رقم اذن الاضافه</th>
            <th>رقم الفاتوره</th>
            <th>رقم التاريخ</th>

            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->


  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
    
<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('Search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>

@endsection
