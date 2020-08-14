@extends('admin.layouts.adminLite')
@section('title','تعديل العملاء')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> تعديل العملاء</span>
@endsection

@section('body')
<!-- success-->
@if (session()->has('success'))
<div class="box">
  <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
   رؤيه <a href="{{url('account_types')}}">  الحسابات</a>.
  </div>
</div>
@endif
<!--./ success-->
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

        <!-- form Edit user -->

        {!! Form::model($AccountCustomers, ['route' => ['accountcustomers.update', $AccountCustomers->id]]) !!}
            @method('PUT')
            <div class="box-body">
                @include('admin.AccountCustomers.form')
          </div>
          <!-- /.box-body -->
        </div>  <!-- /.english tab -->


        <!-- common inputs **************************************** -->
        <div class="box-body">

          <!-- Submit -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">حفظ</button>
          </div>
          <!-- /.Submit -->
        </div>
        <!-- ./ common inputs-->
      {!! Form::close() !!}
     <!--./ form -->

    </div>
    <!-- ./ tabs body -->
  </div>
  <!-- ./ main box -->

@endsection
