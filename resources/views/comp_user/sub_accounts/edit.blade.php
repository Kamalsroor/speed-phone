@extends('comp_user.layouts.adminLite')
@section('title','Edit Sub Account')

@section('pageHeader')
<i class="fa fa-window-restore" aria-hidden="true"></i><span class="text-uppercase"> Edit Sub Account</span>
@endsection

@section('levelLinks')
<li><a href="{{curl('sub_accounts')}}"><i class="fa fa-user"></i> Sub Accounts</a></li>
<li class="active">Edit Sub Account</li>
@endsection
@section('body')
<!-- success-->
@if (session()->has('success'))
<div class="box">
  <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
   Preview all <a href="{{curl('sub_accounts')}}"> sub accounts</a>.
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
        
        {!! Form::model($sub_account, ['route' => ['sub_accounts.update', $sub_account->id]]) !!}
            @method('PUT')
            <div class="box-body">
                @include('comp_user.sub_accounts.form')
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