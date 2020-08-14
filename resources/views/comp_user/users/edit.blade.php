@extends('comp_user.layouts.adminLite')
@section('title','Edit User')

@section('pageHeader')
<i class="fa fa-user" aria-hidden="true"></i><span class="text-uppercase"> Edit User</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('c_users')}}"><i class="fa fa-user"></i>Users</a></li>
<li class="active">Edit User</li>
@endsection
@section('body')
<!-- success-->
@cadmin
@if (session()->has('success'))
<div class="box">
  <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
   Preview all <a href="{{curl('c_users')}}"> users</a>.
  </div>
</div>
@endif
@endcadmin
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
        
        {!! Form::model($user, ['route' => ['c_users.update', $user->id]]) !!}
            @method('PUT')
            <div class="box-body">
                @include('comp_user.users.form')
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