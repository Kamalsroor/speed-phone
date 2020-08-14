@extends('admin.layouts.adminLite')
@section('title','Add Transition')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> اذن صرف شحن</span>
@endsection

@section('levelLinks')

<li class="active">اضافه اذن جديد</li>
<li><a href="{{url('/permissionex')}}">اذون صرف شحن<i class="fa fa-dashboard"></i></a></li>
@endsection
@section('body')
<!-- success-->
@if (session()->has('success'))
    <div class="box">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            Preview all <a href="{{curl('transitions')}}"> transitions</a>.
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
            <!-- form add user -->
            {!! Form::open(['route' => ['permissionex.store'], 'class' => 'form-transition add-transition']) !!}
                <div class="box-body">
                    @include('admin.PermissionExFreight.form')
                </div> <!-- /.box-body -->

                <div class="box-body">

                    <div class="show-messages alert alert-danger">
                        <button type="button" class="close">x</button>
                        <span class="error"></span>
                    </div>
                    <!-- Submit -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-submit">اضافه الاذن <img class="loading" src="{{ url('public/admin/images/loader-ellip-w.gif') }}"></button>
                    </div>
                    <!-- /.Submit -->
                </div>
            {!! Form::close() !!} <!--./ form -->
        </div> <!-- /.english tab -->
    </div> <!-- /. tab content -->

@endsection

@section('styles')
    {!! Html::style('public/admin/css/transition2.css') !!}
@endsection
@section('scripts')
    {!! Html::script('public/admin/js/transition.js') !!}
@endsection
