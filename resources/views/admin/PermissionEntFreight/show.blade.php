
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
          font-size: 22px;
          font-weight: bold;
          border-bottom: 2px solid;
          position: absolute;
          top: -22px;
          right: 37%;
      }
      .box-title-id{

        position: absolute;
        top: 33px;
        left: 20PX;
        border-bottom: 1px solid black;
        font-size: 17PX;
        font-weight: bold;
      }
      .box-title-id strong{

        padding: 30PX;

      }
      .box-title-Date{
        position: absolute;
        top: 33px;
        right: 20PX;
        border-bottom: 1px solid black;
        font-size: 17PX;
        font-weight: bold;
      }
      .box-title-Date strong{

        padding: 30PX;

      }
      .box-title-Name{
        text-align: center;
    position: absolute;
    top: 82px;
    width: 80%;
    right: 175PX;
    border-bottom: 1px solid black;
    font-size: 22PX;
    font-weight: bold;
      }
      .title-name{
        position: absolute;
            top: 110px;
            right: 20PX;
            border-bottom: 1px solid black;
            font-size: 17PX;
            font-weight: bold;
      }
      .box-title-Total{

        display: inline-block;
        border-bottom: 1px solid black;
        font-size: 17PX;
        font-weight: bold;
        position: relative;
right: 644px;
      }
      .box-title-TotalW{

        display: inline-block;
        border-bottom: 1px solid black;
        font-size: 17PX;
        font-weight: bold;
        position: relative;
left: 150px;
      }
      .box-body{
        position: absolute;
        top: 150px;
      }
      .table thead tr {

          /* width: 350px; */
          border: 2px solid;
          right: 67px;
          width: 980px;
          top: -51px;
          font-size: 16px;
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
          font-size: 16px;
          font-weight: bold;

        }
        .prodact2{
          font-size: 14px;
          border: 1px solid;

          }
          .type{
          width: 250px;
          font-size: 14px;

          border: 1px solid;

          }
          .Quantity2{
            width: 300px;
          font-size: 22px;

            border: 1px solid;

          }
          .box-title-Signature{
            font-size: 14px;
            font-weight: bold;
          }
          .box-title2 {
            font-size: 20px;
    position: absolute;
    transform: rotate(-44deg);
    top: 1px;
    right: 97%;
    color: rgba(0,0,0,0.4);
      }
    </style>
  </head>
  <body>





      <!-- Table -->
      <div class="box">
        <div class="box-header">
            <h3 class="box-title1">أذن استلام بضاعه  <span class="box-title2">شحن</span></h3>
            <h3 class="box-title-id"><strong>  رقم الاذن :</strong> {{ $permissionentfreight->id }}</h3>
            <h3 class="box-title-Date"> <strong>   ألتاريخ :</strong>{{ money($permissionentfreight->updated_at) }}</h3>
           <strong class="title-name">يصرح بأستلام بضاعه من : </strong> <h3 class="box-title-Name ">{{ $permissionentfreight->CustomerNames }}</h3>
            <br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="type" >نوع الصنف</th>
                <th class="prodact" >اسم الصنف</th>
                <th class="Quantity">العميل</th>
                <th class="type">الكميه المشحونه</th>
                <th class="type">الكميه المستلمه</th>
                <th class="type">النواقص</th>
                <th class="type">وزن القطعه</th>

            </tr>
            </thead>
            <tbody>
                @foreach ($permissionentfreight_details as $details)
                <tr>

                  <td class="type">{{ $details->TypeOfProduct->name }}</td>
                  <td class="prodact2">{{ $details->ProductName }}</td>
                  <td class="prodact2">{{ $details->Customersed->name }}</td>
                  <td class="type">{{ $details->QuantityCharged }}</td>
                  <td class="type">{{ $details->Quantityrecipient }}</td>
                  <td class="type">{{ $details->Forlack }}</td>
                    <td class="type">{{ $details->wight }}</td>
                </tr>
                @endforeach
            </tbody>

          </table>
          <h3 class="box-title-Total"><strong> اجمالي العدد :</strong> {{ $permissionentfreight->Total }} قطعه فقط لا غير</h3>
          <h3 class="box-title-TotalW"><strong> اجمالي الوزن :</strong> {{ $permissionentfreight->TotalW }} كيلوجرام فقط لا غير</h3>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    <!--/ Table -->

  </body>
</html>
