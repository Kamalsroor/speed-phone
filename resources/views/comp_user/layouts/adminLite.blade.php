<?php Config::set('auth.defaults.guard', 'comp_user'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- <link rel="stylesheet" href="{{asset('')}}"> --}}
    {!! Html::style('public/css/bootstrap.min.css') !!}
    <!-- Font Awesome -->
    {!! Html::style('public/css/font-awesome.min.css') !!}
    <!-- Ionicons -->
    {!! Html::style('public/adminCom/bower_components/Ionicons/css/ionicons.min.css') !!}
    <!-- Theme style -->
    {!! Html::style('public/adminCom/dist/css/AdminLTE.min.css') !!}

    {!! Html::style('public/adminCom/dist/css/skins/skin-blue.min.css') !!}

    {!! Html::style('public/admin/css/main.css') !!}

    @yield('styles')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini"> <!-- sidebar-collapse -->
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ get_company()->website }}" target="_blank" class="logo">
      <img style="width:90%; " src="{{url('public/' . get_company()->company_logo)}}" alt="">
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{url('public/adminCom/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{url('public/adminCom/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{ auth()->user()->name }}
                  <small>Member since {{ auth()->user()->created_at->format('M. Y') }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <!--
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!--
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
              -->
                <div class="pull-right">
                  <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();
                  " class="btn btn-sm btn-default btn-flat">Sign out</a>
                  <form id="logout-form" action="{{ route('comp_user.logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
                <div class="pull-left">
                  <a href="{{ route('c_users.edit', auth()->id()) }}" class="btn btn-sm btn-success btn-flat"><i class="fa fa-edit"></i> Edit Profile</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('public/adminCom/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name }}</p>

        </div>
      </div>



      <!-- Sidebar Menu -->
      @include('comp_user.layouts.adminLiteSideBar')
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('pageHeader')
        <small>@yield('headerDescription')</small>
      </h1>
      <ol class="breadcrumb">
        <!--
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      -->
      @section('levelLinks')@show


      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      @section('body')@show


      <!--
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">

    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="http://magrowtech.net/" target="_blank">MagrowTech</a>.</strong> All rights reserved.
  </footer>


  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
{!! Html::script('public/js/jquery-3.2.1.min.js') !!}
<!-- Bootstrap 4.1 -->
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js') !!}
{!! Html::script('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js') !!}

{!! Html::script('https://unpkg.com/sweetalert/dist/sweetalert.min.js') !!}
@include('comp_user.layouts.message')
<!-- AdminLTE App -->
{!! Html::script('public/adminCom/dist/js/adminlte.min.js') !!}
{!! Html::script('public/admin/js/main.js') !!}
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
@section('scripts')@show


</body>
</html>
