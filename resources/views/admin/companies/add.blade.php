@extends('admin.layouts.adminLite')
@section('title','Add Company')

@section('pageHeader')
<i class="fa fa-building-o" aria-hidden="true"></i><span class="text-uppercase"> Add Company</span>
@endsection

@section('levelLinks')
<li><a href="{{url('companies')}}"><i class="fa fa-building-o"></i>Companies</a></li>
<li class="active">Add Company</li>
@endsection

@section('styles')
    {!! Html::style('public/plugins/ezdz/jquery.ezdz.min.css') !!}
@endsection

@section('body')
<!-- success-->
@if (session()->has('success'))
<div class="box">
  <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
   Preview all <a href="{{url('companies')}}"> companies</a>.
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

        <!-- form add Company -->
        {!! Form::open(['files' => true, 'route' => ['companies.store']]) !!}
            <div class="box-body">
                @include('admin.companies.form')
          </div>
          <!-- /.box-body -->
        </div>  <!-- /.english tab -->

        <!-- common inputs **************************************** -->
        <div class="box-body">

          <!-- Submit -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add Company</button>
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

@section('scripts')
    @include('admin.layouts.message')
    {!! Html::script('public/plugins/ezdz/jquery.ezdz.min.js') !!}
<script>
$(function () {
    $('[type="file"]').ezdz({
        text: 'drop a profile picture or click to choose one ',
        validators: {

        },
        reject: function(file, errors) {
            if (errors.mimeType) {
                alert(file.name + ' must be an image.');
            }
        }
    });
});
</script>
@endsection

