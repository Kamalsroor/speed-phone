<?php
use App\MobilatEntDetails;
use App\MobilatDetails;
use Illuminate\Database\Eloquent\Collection;

use App\Mobilat;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    body{
      direction: rtl;
    }
        .title-transition-details {
            display: block !important;
            margin-bottom: 15px !important;
            background-color: #f5f5f5;
            padding: 8px;
        }
        .title-transition-details strong {
            display: inline-block;
            width: 230px;
            color: #2c3e50;
            margin-right: 10px;
        }
        .table {
            text-align: center;
        }
        .box-title1{
          font-size: 25px;
          font-weight: bold;
          border-bottom: 2px solid;
          position: absolute;
          top: -22px;
          right: 37%;
      }
      .box-title-id{

        position: absolute;
        top: 73px;
        left: 20PX;
        border-bottom: 1px solid black;
        font-size: 20PX;
        font-weight: bold;
      }
      .box-title-id strong{

        padding: 30PX;

      }
      .box-title-Date{
        position: absolute;
        top: 73px;
        right: 20PX;
        border-bottom: 1px solid black;
        font-size: 20PX;
        font-weight: bold;
      }
      .box-title-Date strong{

        padding: 30PX;

      }
      .box-title-Name{
        text-align: center;
        position: absolute;
        top: 110px;
        width: 80%;
        right: 273PX;
        border-bottom: 1px solid black;
        font-size: 29PX;
        font-weight: bold;
      }
      .title-name{
        position: absolute;
            top: 147px;
            right: 20PX;
            border-bottom: 1px solid black;
            font-size: 20PX;
            font-weight: bold;
      }
      .box-title-Total{

        display: inline-block;
        border-bottom: 1px solid black;
        font-size: 20PX;
        font-weight: bold;
        position: relative;
right: 644px;
      }
      .box-body{
        position: absolute;
        top: 185px;
      }
      .table thead tr {

          /* width: 350px; */
          border: 2px solid;
          right: 67px;
          width: 980px;
          top: -51px;
          font-size: 17px;
          font-weight: bold;
          background-color: rgba(0, 0, 0, 0.3);

      }

      .prodact{
        width: 700px;
        border: 1px solid;

        }
        .Quantity{
          width: 300px;
          border: 1px solid;

        }
        .table tbody  {

          top: -14px;
          /* left: 26px; */
          right: 67px;
          width: 980px;
          border: 1px solid;
          font-size: 17px;
          font-weight: bold;

        }
        .prodact2{
          width: 700px;
          border: 1px solid;

          }
          .Quantity2{
            width: 300px;
            border: 1px solid;

          }
          .box-title-Signature{
            font-size: 17px;
            font-weight: bold;
          }
          .user-image{
            float: left;
          }

          .text-center{
            text-align: center;
          }
    </style>
  </head>
  <body>





      <!-- Table -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title1">أذن صرف بضاعه </h3>
          <img src="{{url('public/photos/logo.jpg')}}" class="user-image" alt="User Image">


            <h3 class="box-title-id"><strong>  رقم الاذن :</strong> {{ $MobilatEx->id }}</h3>
            <h3 class="box-title-Date"> <strong>   ألتاريخ :</strong>{{ money($MobilatEx->updated_at) }}</h3>
           <strong class="title-name">يصرح يصرف بضاعه الي : </strong>  <h3 class="box-title-Name ">{{ $MobilatEx->Customersed->name }}</h3>
            <br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="prodact" >اسم الصنف</th>
                <th class="Quantity">الكميه</th>

            </tr>
            </thead>
            <tbody>
                @foreach ($MobilatDetailss as $details)
                <tr>

                  <td class="prodact2">
                    
                  @php
                  
                  $test = Mobilat::where('id', $details)->pluck('name');
                  $teswt = $test[0];
                  @endphp
                  {{$teswt}}
                
                </td>
                @php

$MobilatDetails3 = MobilatDetails::where('MobilatExID', $ids)->where('Prodact_name', $details)->orderBy('id', 'ASC')->get();
$MobilatDetails4 = count($MobilatDetails3);
@endphp
                  <td class="Quantity2">

                  {{$MobilatDetails4}}
                  </td>
                </tr>
                @endforeach
                
            </tbody>
  
          </table>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="prodact" >اسم الصنف</th>
                <th class="Quantity">ألسريال</th>

            </tr>
            </thead>
            <tbody>
                @foreach ($MobilatDetails as $details)
                <tr>

                  <td class="prodact2">{{ $details->MobilatMod->name }}</td>
                  <td class="Quantity2">{{ $details->sirarnamber }}</td>

                </tr>
                @endforeach
            </tbody>

          </table>









          <h3 class="box-title-Total"><strong> اجمالي العدد :</strong> {{ $MobilatEx->totals }} قطعه فقط لا غير</h3>
          <h3 class="box-title-Signature"><strong>استلمت انا الموقع ادناه / ............................................ الاصناف الوارده بالبيان عاليه بحاله جيده</strong> </h3>
        
          <h3 class="box-title-Signature"><strong>التوقيع :</strong> </h3>
          <h3 class="box-title-Signature"><strong>الرقم القومي :</strong> </h3>
          @if($MobilatEx->note != null )
          <h3 class="text-center box-title-Signature"><strong>ملاحظات : </strong> </h3>
          <h3 class="text-center box-title-Signature"><strong>{{ $MobilatEx->note }}</strong> </h3>
          @endif
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    <!--/ Table -->

  </body>
</html>
