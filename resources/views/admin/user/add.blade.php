@extends('admin.layouts.adminLite')
@section('title','اضافه عضو')

@section('pageHeader')
<i class="fa fa-user" aria-hidden="true"></i><span class="text-uppercase"> اضافه عضو</span>
@endsection

@section('levelLinks')
<li class="active">اضافه عضو</li>
<li><a href="{{url('users')}}">الاعضاء<i class="fa fa-user"></i></a></li>
@endsection
@section('body')
<!-- success-->
@if (session()->has('success'))
<div class="box">
  <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
   مشاهده جميع  <a href="{{url('users')}}"> الاعضاء</a>.
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
        {!! Form::open(['route' => ['users.store']]) !!}
            <div class="box-body">
                @include('admin.user.form')
          </div>
          <!-- /.box-body -->
        </div>  <!-- /.english tab -->


        <!-- common inputs **************************************** -->
        <div class="box-body">

          <!-- Submit -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">اضافه العضو</button>
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
    {{-- {!! Html::style('public/plugins/ezdz/jquery.ezdz.min.css') !!} --}}
@endsection
@section('scripts')
    @include('admin.layouts.message')
    {{-- {!! Html::script('public/plugins/ezdz/jquery.ezdz.min.js') !!} --}}
@endsection
