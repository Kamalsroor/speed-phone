
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
          font-size: 37px;
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
        font-size: 28PX;
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
        font-size: 28PX;
        font-weight: bold;
      }
      .box-title-Date strong{

        padding: 30PX;

      }
      .box-title-Name{
        text-align: center;
        position: absolute;
        top: 133px;
        width: 80%;
        right: 273PX;
        border-bottom: 1px solid black;
        font-size: 37PX;
        font-weight: bold;
      }
      .title-name{
        position: absolute;
            top: 180px;
            right: 20PX;
            border-bottom: 1px solid black;
            font-size: 28PX;
            font-weight: bold;
      }
      .box-title-Total{

        display: inline-block;
        border-bottom: 1px solid black;
        font-size: 28PX;
        font-weight: bold;
        position: relative;
right: 644px;
      }
      .box-title-TotalW{

        display: inline-block;
        border-bottom: 1px solid black;
        font-size: 28PX;
        font-weight: bold;
        position: relative;
left: 320px;
      }
      .box-body{
        position: absolute;
        top: 276px;
      }
      .table thead tr {

          /* width: 350px; */
          border: 2px solid;
          right: 67px;
          width: 980px;
          top: -51px;
          font-size: 25px;
          font-weight: bold;
          background-color: rgba(0, 0, 0, 0.3);

      }

      .prodact{
        width: 700px;
        border: 2px solid;

        }
        .Quantity{
          width: 300px;
          border: 2px solid;

        }
        .table tbody  {

          top: -14px;
          /* left: 26px; */
          right: 67px;
          width: 980px;
          border: 2px solid;
          font-size: 25px;
          font-weight: bold;

        }
        .prodact2{
          width: 700px;
          border: 2px solid;

          }
          .Quantity2{
            width: 300px;
            border: 2px solid;

          }
          .box-title-Signature{
            font-size: 25px;
            font-weight: bold;
          }

    </style>
  </head>
  <body>





      <!-- Table -->
      <div class="box">
        <div class="box-header">
            <h3 class="box-title1">أذن استلام بضاعه </h3>
            <h3 class="box-title-id"><strong>  رقم الاذن :</strong> {{ $permissionentfreight->id }}</h3>
            <h3 class="box-title-Date"> <strong>   ألتاريخ :</strong>{{ money($permissionentfreight->PermissionDate) }}</h3>
           <strong class="title-name">يصرح بأستلام بضاعه من : </strong> <h3 class="box-title-Name ">{{ $permissionentfreight->CustomerNames }}</h3>
            <br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="prodact" >اسم الصنف</th>
                <th class="Quantity">الكميه</th>
                <th class="Quantity">وزن القطعه</th>

            </tr>
            </thead>
            <tbody>
                @foreach ($permissionentfreight_details as $details)
                <tr>

                  <td class="prodact2">{{ $details->ProductName }}</td>
                  <td class="Quantity2">{{ $details->Quantity }}</td>
                    <td class="Quantity2">{{ $details->wight }}</td>
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
