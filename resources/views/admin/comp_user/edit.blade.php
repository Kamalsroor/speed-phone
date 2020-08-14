@extends('admin.layouts.adminLite')
@section('title','Edit User')

@section('pageHeader')
<i class="fa fa-user" aria-hidden="true"></i><span class="text-uppercase"> Edit User</span>
@endsection

@section('levelLinks')
<li><a href="{{url('companies_users')}}"><i class="fa fa-user"></i>Users</a></li>
<li class="active">Edit User</li>
@endsection
@section('body')
<!-- success-->
@if (session()->has('success'))
<div class="box">
  <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
   Preview all <a href="{{url('companies_users')}}"> users</a>.
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
		@include('admin.layouts.tabs_lang', ['lang' => ['en']])
    </div>
    <!--./tabs header  -->

    <!-- tabs body -->
    <div class="tab-content">

      <div id="english1" class="tab-pane active in">

        <!-- form Edit user -->
        
        {!! Form::model($user, ['route' => ['companies_users.update', $user->id]]) !!}
            @method('PUT')
            <div class="box-body">
                @include('admin.comp_user.form')
          </div>
          <!-- /.box-body -->
        </div>  <!-- /.english tab -->


        <!-- common inputs **************************************** -->
        <div class="box-body">

          <!-- Submit -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Save</button>
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

@section('styles')
    {!! Html::style('public/plugins/datetimepicker/jquery.datetimepicker.min.css') !!}
@endsection
@section('scripts')
    @include('admin.layouts.message')
    {!! Html::script('public/plugins/datetimepicker/jquery.datetimepicker.full.min.js') !!}
    <script>
        $('.time-stamp').datetimepicker({
            format:'Y-m-d H:i:s',
        });
    </script>
    {!! Html::script('public/admin/js/change_date.js') !!}
@endsection
