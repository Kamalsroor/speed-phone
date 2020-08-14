@extends('admin.layouts.adminLite')
@section('title','اضافه مجموعه')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> اضافه مجموعه</span>
@endsection

@section('levelLinks')

<li class="active">اضافه مجموعه</li>
<li><a href="{{url('/roles')}}">المجموعات<i class="fa fa-dashboard"></i></a></li>
@endsection
@section('body')
<!-- success-->
@if (session()->has('success'))
    <div class="box">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            Preview all <a href="{{curl('account_types')}}"> accounting types</a>.
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

      <div id="arabic2" class="tab-pane active in">

        <!-- form add user -->
        {!! Form::open(['route' => ['roles.store']]) !!}
            <div class="box-body">
                @include('admin.roles.form')
          </div>
          <!-- /.box-body -->
        </div>  <!-- /.english tab -->


        <!-- common inputs **************************************** -->
        <div class="box-body">

          <!-- Submit -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">اضافه المجموعه</button>
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
