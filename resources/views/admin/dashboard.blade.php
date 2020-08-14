@extends('admin.layouts.adminLite')

@section('title','Dashboard')

@section('pageHeader')
<i class="fa fa-dashboard" aria-hidden="true"></i><span class="text-uppercase"> Dashboard</span>
@endsection

@section('headerDescription','Dashboard')

@section('levelLinks')
<li class="active" ><i class="fa fa-dashboard"></i> Dashboard</a></li>
@endsection

@section('body')
  <!-- Small boxes (Stat box) -->
  <div class="row">

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count_model('User', 'App') }}</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{ count_model('permission_ex_freight', 'App') }}</h3>

          <p>عدد اذون صرف الشحن</p>
        </div>
        <div class="icon">
          <i class="fa fa-building-o"></i>
        </div>
        <a href="{{ route('permissionex.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{ count_model('permission_ent_freight', 'App') }}</h3>

          <p>عدد اذون استلام الشحن</p>
        </div>
        <div class="icon">
          <i class="fa fa-building-o"></i>
        </div>
        <a href="{{ route('permissionent.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count_model('MobilatEnt', 'App') }}</h3>

          <p>عدد اذون استلام التجاره</p>
        </div>
        <div class="icon">
          <i class="fa fa-building-o"></i>
        </div>
        <a href="{{ route('mobilatsent.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count_model('MobilatEx', 'App') }}</h3>

          <p>عدد اذون صرف التجاره</p>
        </div>
        <div class="icon">
          <i class="fa fa-building-o"></i>
        </div>
        <a href="{{ route('mobilatsent.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

  </div>
  <!-- /.row -->
@endsection