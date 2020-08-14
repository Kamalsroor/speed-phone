<?php
use App\MobilatEntDetails;
use App\MobilatExDetails;
use App\MobilatDetails;


?>

@extends('admin.layouts.adminLite')
@section('title','حركه الصرف ')

@section('pageHeader')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i><span class="text-uppercase"> حركه الصنف</span>
@endsection

@section('levelLinks')

@endsection

@section('body')
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
            <div class="box-body">
               <!-- name -->


          </div>
          <!-- /.box-body -->
        </div>  <!-- /.english tab -->


        <!-- common inputs **************************************** -->
        <div class="box-body">

          <!-- Submit -->
          <div class="box-footer">
          </div>
          <!-- /.Submit -->
        </div>
        <!-- ./ common inputs-->
     <!--./ form -->

    </div>
    <!-- ./ tabs body -->
  </div>
  <!-- ./ main box -->
  <!-- Table -->
  <div class="box">

    <div class="box-header">

      <h3 class="box-title">حركه الصرف - {{$Mobilat_name[0]}}</h3>
    </div>
    @if(count($MobilatEnt) > 0)

    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>التاريخ</th>
            <th>اسم العميل</th>
            <th>نوع الاذن</th>
            <th>رقم الاذن</th>
            <th>اسم الصنف</th>
            <th>العدد</th>


        </tr>
        </thead>
        <tbody>
        @foreach ($MobilatEnt as $MobilatEnts)
            <tr>
                <?php 
                $MobilatEntDetailsCount = MobilatDetails::where('MobilatEntID', $MobilatEnts->id)->where('Prodact_name', $Mobilat_id)->get()->count();

                ?>
                <td>{{$MobilatEnts->created_at->format('d-m-Y')}}</td>
                <td>{{$MobilatEnts->CustomersMod->name}}</td>
                <td>اضافه</td>
                <td>{{$MobilatEnts->id}}</td>
                <td>{{$Mobilat_name[0]}}</td>
                <td>{{$MobilatEntDetailsCount}}</td>

             
            </tr>
            @endforeach
                    @foreach ($MobilatEx as $MobilatExs)
            <tr>
                <?php 
                $MobilatExDetailsCount = MobilatDetails::where('MobilatExID', $MobilatExs->id)->where('Prodact_name', $Mobilat_id)->get()->count();

                ?>
                <td>{{$MobilatExs->created_at->format('d-m-Y')}}</td>
                <td>{{$MobilatExs->Customersed->name}}</td>
                <td>صرف</td>
                <td>{{$MobilatExs->id}}</td>
                <td>{{$Mobilat_name[0]}}</td>
                <td>-{{$MobilatExDetailsCount}}</td>

             
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>التاريخ</th>
            <th>اسم العميل</th>
            <th>نوع الاذن</th>
            <th>رقم الاذن</th>
            <th>اسم الصنف</th>
            <th>العدد</th>
            </tr>
        </tfoot>
      </table>

    </div>
    <!-- /.box-body -->

 @else
    <div  class="alert alert-info alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> عفواً لا يوجد حركه لهاذا الصنف</h4>
    </div>
  @endif
  <!-- /.box -->
<!--/ Table -->
@endsection
@section('scripts')
    {!! Html::script('public/js/admin/delete_row.js') !!}
  <script>

function convertDate(d) {
  var p = d.split("-");
  return +(p[2]+p[1]+p[0]);
}

function sortByDate() {
  var tbody = document.querySelector(".table tbody");
  // get trs as array for ease of use
  var rows = [].slice.call(tbody.querySelectorAll("tr"));
  
  rows.sort(function(a,b) {
    return convertDate(a.cells[0].innerHTML) - convertDate(b.cells[0].innerHTML);
  });
  
  rows.forEach(function(v) {
    tbody.appendChild(v); // note that .appendChild() *moves* elements
  });
}
window.onload=sortByDate;

document.querySelector("button").addEventListener("click", sortByDate);
</script>

@endsection
