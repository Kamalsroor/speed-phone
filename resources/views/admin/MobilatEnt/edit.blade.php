@extends('admin.layouts.adminLite')
@section('title','تعديل اذن توريد')

@section('pageHeader')
<i class="fa fa-money" aria-hidden="true"></i><span class="text-uppercase"> تعديل اذن توريد</span>
@endsection

@section('levelLinks')
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

        <!-- form Edit user -->

        {!! Form::open(['route' => ['mobilatsent.update', $MobilatEnt_id], 'class' => 'form-transition edit-transition']) !!}
            @method('PUT')
            <div class="box-body">
                @include('admin.MobilatEnt.form_edit')
            </div>
            <!-- /.box-body -->

        <div class="box-body">
            <div class="show-messages alert alert-danger">
                <button type="button" class="close">x</button>
                <span class="error"></span>
            </div>
            <!-- Submit -->
            <div class="box-footer">
                <button type="submit" class="btn btn-success btn-submit">حفظ <img class="loading" src="{{ url('public/admin/images/loader-ellip-w.gif') }}"></button>
            </div>
          <!-- /.Submit -->
        </div>
      {!! Form::close() !!} <!--./ form -->
    </div> <!-- ./ tabs body -->
  </div> <!-- ./ tab content -->

@endsection

@section('styles')
    {!! Html::style('public/admin/css/transition.css') !!}
@endsection
@section('scripts')
    {!! Html::script('public/admin/js/transition.js') !!}
     <script>
      $(document).ready(function() {

        $(window).on('scroll', function() {
          setTimeout(
        function() 
        {
          //do something special
        }, 1000);
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
              
              if($('#suggestion_page_loader').css('display') == 'none'){
                  if ($('#table-add-transition tbody').find('input#no_products_found').length > 0) {
                        $('#suggestion_page_loader').fadeOut(700);
                        return false;
                    }
              
              var page = parseInt($('#suggestion_page').val());
              page += 1;
              $('#suggestion_page').val(page);
              
              get_product_suggestion_list();
            }
            
          }   
      });
      
          
        function get_product_suggestion_list(MobilatEnt_id  = {{$MobilatEnt_id}}, url = null) {
          
      
            if (url == null) {
                url = '{{ url("ent/get-row") }}';
            }
            $('#suggestion_page_loader').fadeIn(700);
            var page = $('input#suggestion_page').val();
            if (page == 1) {
                $('#table-add-transition tbody').html('');
            }
  
            $.ajax({
                method: 'GET',
                url: url,
                data: {
                    MobilatEnt_id: MobilatEnt_id,
                    page: page
                },
                dataType: 'html',
                success: function(result) {
                //   console.log(result );
                    table = $('#table-add-transition'),
                    // $('#table-add-transition tbody').append(result);
                   $(result).insertBefore(table.find('tbody tr:last-child'));
                   
                   $('.select2').select2();
                    $('#suggestion_page_loader').fadeOut(700);
      
                },
            });
        }
      });
      
//       $(window).scroll(function() {
//    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
//        alert("near bottom!");
//    }
// });



  </script>
@endsection
