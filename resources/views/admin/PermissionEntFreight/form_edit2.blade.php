<table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
    <tr>.

        <td class="TypeOfProduct">
            {!! Form::hidden('id[]', 0) !!}
        {!! Form::select('TypeOfProduct[]', $TypeOfProduct, null, ['class' => '  form-control']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="ProductName">
              {!! Form::text('ProductName[]', null, ['class' => ' form-control', 'placeholder' => 'Transition ProductName']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="TypeOfProduct">
        {!! Form::select('customernames[]', $Customers, null, ['class' => '  form-control']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="Quantity">
              {!! Form::text('QuantityCharged[]', null, ['class' => 'amount form-control', 'placeholder' => 'Transition Quantity']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="Quantity">
              {!! Form::text('Quantityrecipient[]', null, ['class' => 'amount form-control', 'placeholder' => 'Transition Quantity']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="Quantity">
              {!! Form::text('wight[]', null, ['class' => 'amount form-control', 'placeholder' => 'وزن القطعه']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="text-center">
              <button type="button" class="btn btn-danger remove-row"><i class="fa fa-close"></i></button>
          </td>
    </tr>'>
    <!-- Description -->
    <div class="form-group">
        {!! Form::label('اسم العميل', 'اسم العميل') !!}<br>

        {!! Form::text('CustomerNames', $permissionentfreight_details[0]->permission_ent_freight->CustomerNames, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل','readonly' => 'readonly']) !!}
        {!! Form::hidden('permissionentid', $permissionentfreight_details[0]->permission_ent_freight->id, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل']) !!}
    </div>
    <div class="form-group">
        
        {!! Form::label('مصروفات اضافيه', 'مصروفات اضافيه') !!}<br>
       {!! Form::text('extrafees', $permissionentfreight_details[0]->permission_ent_freight->extrafees, ['class' => 'form-control ', 'id' => 'extrafees', 'placeholder' => 'اسم العميل' ]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}<br>
        {!! Form::text('PermissionDate', $permissionentfreight_details[0]->permission_ent_freight->PermissionDate, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل' ,'readonly' => 'readonly']) !!}
    </div>
    <div class="form-group">
        {!! Form::label(' رقم الفاتوره ', 'رقم الفاتوره') !!}<br>
        {!! Form::text('Policynumber', $permissionentfreight_details[0]->permission_ent_freight->Policynumber, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('وزن البوليصه', 'وزن البوليصه') !!}<br>
        {!! Form::text('weightawb', $permissionentfreight_details[0]->permission_ent_freight->weightawb, ['class' => 'form-control', 'id' => 'weightawb', 'placeholder' => 'اسم العميل']) !!}
    </div>
    <div class="form-group">
         {!! Form::label('قيمةالفاتوره', 'قيمه الفاتوره') !!}<br>
        {!! Form::text('invoicevalue', $permissionentfreight_details[0]->permission_ent_freight->invoicevalue, ['class' => 'form-control invoicevalue ', 'id' => 'invoicevalue', 'placeholder' => 'اسم العميل']) !!}
    </div>
    <div class="form-group">
        
       {!! Form::label('معامل التحويل', 'معامل التحويل') !!}<br>
       {!! Form::text('rate', $permissionentfreight_details[0]->permission_ent_freight->rate, ['class' => 'form-control ', 'id' => 'rate', 'placeholder' => 'اسم العميل']) !!}
   </div>
   <div class="form-group">
        
        {!! Form::label('اجمالي الوزن', 'اجمالي الوزن') !!}<br>
       {!! Form::text('TotalW', $permissionentfreight_details[0]->permission_ent_freight->TotalW, ['class' => 'form-control ', 'id' => 'TotalW', 'placeholder' => 'اسم العميل' ,'readonly' => 'readonly']) !!}
    </div>
   <div class="form-group">
        
        {!! Form::label('سعر الكيلو', 'سعر الكيلو ') !!}<br>
       {!! Form::text('Priceperkiloe', $permissionentfreight_details[0]->permission_ent_freight->Priceperkilo, ['class' => 'Priceperkiloe form-control ', 'id' => 'Priceperkiloe', 'placeholder' => 'اسم العميل','readonly' => 'readonly' ]) !!}
    </div>
    <!--./ Description -->
    <thead>
    <tr>
            <th width="8%">نوع الصنف</th>
            <th width="17%">اسم الصنف</th>
            <th width="8%">العميل</th>
            <th width="6%">الكميه المستلمه</th>
            <th width="6%">سعر القطعه</th>
            <th width="6%">عموله</th>
            <th width="6%">سعر التخليص</th>
            <th width="6%">صافي الربح</th>

        </tr>
    </thead>
    <tbody>


                     <?php
                   
                    $m = 0;
                    foreach($permissionentfreight_details as $details)
                    {
                      $m = $m + 1;
                      ?>
                    <tr>
                      <input type="hidden" name="id[]" id="id<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->id; ?>"readonly />
                      <td ><input type="text" name="TypeOfProduct[]" id="TypeOfProduct<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->TypeOfProduct->name; ?>"readonly /></td>
                      <td><input type="text" name="ProductName[]" id="ProductName<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->ProductName; ?>"readonly /></td>
                      <td><input type="text" name="customernames[]" id="customernames<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->Customersed->name; ?>"readonly /></td>
                      <td><input type="text" name="Quantityrecipient[]" id="Quantityrecipient<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->Quantityrecipient; ?>"readonly /></td>
                      <input type="hidden" name="wight[]" id="wight<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->wight; ?>" />
                      <td><input type="text" name="Tcotpiece[]" id="Tcotpiece<?php echo $m; ?>" class="form-control input-sm  Tcotpiece " value="<?php echo  $details->Tcotpiece; ?>" /></td>
                      <input type="hidden" name="cost[]" id="cost<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->cost; ?>" readonly/>
                      <td><input type="text" name="commission[]" id="commission<?php echo $m; ?>" class="form-control commission input-sm" value="<?php echo  $details->commission; ?>" /></td>
                      <td><input type="text" name="Clearanceprice[]" id="Clearanceprice<?php echo $m; ?>" class="form-control Clearanceprices input-sm" value="<?php echo  $details->Clearanceprice; ?>" /></td>
                      <input type="hidden" name="othercost[]" id="othercost<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->othercost; ?>" readonly/>
                      <input type="hidden" name="Weightratio[]" id="Weightratio<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->Weightratio; ?>" readonly/>
                      <input type="hidden" name="Weightbearing[]" id="Weightbearing<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->Weightbearing; ?>" readonly/>
                      <input type="hidden" name="Flightcost[]" id="Flightcost<?php echo $m; ?>" class="form-control Flightcost input-sm" value="<?php echo  $details->Flightcost; ?>" readonly/>
                      <input type="hidden" name="totalcost[]" id="totalcost<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->totalcost; ?>"readonly />
                      <input type="hidden" name="Forlack[]" id="Forlack<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->Forlack; ?>"readonly />
                      <td><input type="text" name="nitprofit[]" id="nitprofit<?php echo $m; ?>" class="form-control input-sm" value="<?php echo  $details->nitprofit; ?>" readonly/></td>
                     
                    </tr>
                    <?php
                    }
                    ?>

    </tbody>
    <tfoot>
    <tr>
    <th>نوع الصنف</th>
            <th>اسم الصنف</th>
            <th>العميل</th>
            <th>الكميه المستلمه</th>
            <th>سعر القطعه</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
<script>
var count = "<?php echo $m; ?>";
function cal_final_total(count)
        {
          var final_item_total = 0;
          for(j=1; j<=count; j++)
          {
            var Quantityrecipient = 0;
            var Tcotpiece = 0;
            var actual_amount = 0;
            var rate = 0;
            var tax1_amount = 0;
            var tax2_rate = 0;
            var tax2_amount = 0;
            var tax3_rate = 0;
            var tax3_amount = 0;
            var item_total = 0;
            Quantityrecipient = $('#Quantityrecipient'+j).val();
                Tcotpiece = $('#Tcotpiece'+j).val();
                actual_amount = parseFloat(Quantityrecipient) * parseFloat(Tcotpiece);
                $('#cost'+j).val(actual_amount);
                

            

          }
          $('#final_total_amt').text(final_item_total);
        }



        $(document).on('blur', '#invoicevalue', function(){
            cal_final_total(count);
        });
        $(document).on('blur', '#weightawb', function(){
            cal_final_total(count);
        });
        $(document).on('blur', '#rate', function(){
            cal_final_total(count);
        });
        $(document).on('blur', '#extrafees', function(){
            cal_final_total(count);
        });
        $(document).on('blur', '.Tcotpiece', function(){
            cal_final_total(count);
        });
        $(document).on('blur', '.commission', function(){
            cal_final_total(count);
        });
        $(document).on('blur', '.Clearanceprice', function(){
            cal_final_total(count);
        });

        function Priceperkiloe()
        {

            var weightawb = 0;
            var invoicevalue = 0;
            var Priceperkiloe = 0;
            var rate = 0;
            weightawb = $('#weightawb').val();
            invoicevalue = $('#invoicevalue').val();
            rate = $('#rate').val();
 
                actual_amount = parseFloat(rate) * parseFloat(invoicevalue) /parseFloat(weightawb) ;
                $('#Priceperkiloe').val(actual_amount);
                

              }
   

        $(document).on('blur', '#invoicevalue', function(){
            Priceperkiloe();
        });
        $(document).on('blur', '#weightawb', function(){
            Priceperkiloe();
        });
        $(document).on('blur', '#rate', function(){
            Priceperkiloe();
        });
        $(document).on('blur', '#extrafees', function(){
            Priceperkiloe();
        });
        $(document).on('blur', '.Tcotpiece', function(){
            Priceperkiloe();
        });
        $(document).on('blur', '.commission', function(){
            Priceperkiloe();
        });
        $(document).on('blur', '.Clearanceprice', function(){
            Priceperkiloe();
        });
// test



        function Weightbearing(count)
        {
            for(j=1; j<=count; j++)
            {
                var TotalW = 0;
            var Weightratio = 0;
            var weightawb = 0;
            TotalW = $('#TotalW').val();
            weightawb = $('#weightawb').val();
            Weightratio = $('#Weightratio'+j).val();
 
                actual_amount = ( parseFloat(weightawb) - parseFloat(TotalW) ) * parseFloat(Weightratio) ;
                $('#Weightbearing'+j).val(actual_amount);
                

              }
            }
            


  
        
        $(document).on('blur', '#invoicevalue', function(){
            Weightbearing(count);
        });
        $(document).on('blur', '#weightawb', function(){
            Weightbearing(count);
        });
        $(document).on('blur', '#rate', function(){
            Weightbearing(count);
        });
        $(document).on('blur', '#extrafees', function(){
            Weightbearing(count);
        });
        $(document).on('blur', '.Tcotpiece', function(){
            Weightbearing(count);
        });
        $(document).on('blur', '.commission', function(){
            Weightbearing(count);
        });
        $(document).on('blur', '.Clearanceprice', function(){
            Weightbearing(count);
        });


        function Flightcost(count)
        {
            for(j=1; j<=count; j++)
            {
                var Flightcost = 0;
            var wight = 0;
            var Weightbearing = 0;
            var Priceperkiloe = 0;
            Priceperkiloe = $('#Priceperkiloe').val();
            wight = $('#wight'+j).val();
            Weightbearing = $('#Weightbearing'+j).val();
 
                actual_amount = ( parseFloat(wight) + parseFloat(Weightbearing) ) *  parseFloat(Priceperkiloe) ;
                $('#Flightcost'+j).val(actual_amount);
                

              }
            }
            


$(document).on('blur', '#invoicevalue', function(){
    Flightcost(count);
        });
        $(document).on('blur', '#weightawb', function(){
            Flightcost(count);
        });
        $(document).on('blur', '#rate', function(){
            Flightcost(count);
        });
        $(document).on('blur', '#extrafees', function(){
            Flightcost(count);
        });
        $(document).on('blur', '.Tcotpiece', function(){
            Flightcost(count);
        });
        $(document).on('blur', '.commission', function(){
            Flightcost(count);
        });
        $(document).on('blur', '.Clearanceprice', function(){
            Flightcost(count);
        });


        function totalcost(count)
        {
            for(j=1; j<=count; j++)
            {
                var Flightcost = 0;
            var totalcost = 0;
            var othercost = 0;
            var Clearanceprice = 0;
            Flightcost = $('#Flightcost'+j).val();
            othercost = $('#othercost'+j).val();
            Clearanceprice = $('#Clearanceprice'+j).val();
 
                actual_amount =  parseFloat(Flightcost) + parseFloat(othercost) +  parseFloat(Clearanceprice) ;
                $('#totalcost'+j).val(actual_amount);
                

              }
            }
            




        $(document).on('blur', '#invoicevalue', function(){
            totalcost(count);
        });
        $(document).on('blur', '#weightawb', function(){
            totalcost(count);
        });
        $(document).on('blur', '#rate', function(){
            totalcost(count);
        });
        $(document).on('blur', '#extrafees', function(){
            totalcost(count);
        });
        $(document).on('blur', '.Tcotpiece', function(){
            totalcost(count);
        });
        $(document).on('blur', '.commission', function(){
            totalcost(count);
        });
        $(document).on('blur', '.Clearanceprice', function(){
            totalcost(count);
        });

                function nitprofit(count)
        {
            for(j=1; j<=count; j++)
            {
                var commission = 0;
            var totalcost = 0;
            var Tcotpiece = 0;
            Tcotpiece = $('#Tcotpiece'+j).val();
            commission = $('#commission'+j).val();
            totalcost = $('#totalcost'+j).val();
 
                actual_amount =  parseFloat(Tcotpiece) - parseFloat(totalcost) -  parseFloat(commission) ;
                $('#nitprofit'+j).val(actual_amount);
                

              }
            }

        $(document).on('blur', '#invoicevalue', function(){
            nitprofit(count);
        });
        $(document).on('blur', '#weightawb', function(){
            nitprofit(count);
        });
        $(document).on('blur', '#rate', function(){
            nitprofit(count);
        });
        $(document).on('blur', '#extrafees', function(){
            nitprofit(count);
        });
        $(document).on('blur', '.Tcotpiece', function(){
            nitprofit(count);
        });
        $(document).on('blur', '.commission', function(){
            nitprofit(count);
        });
        $(document).on('blur', '.Clearanceprice', function(){
            nitprofit(count);
        });

      
        function cal_finafl_torrtal(count)
        {
            for(j=1; j<=count; j++)
            {
            var extrafees = 0;
            var othercost = 0;
            var Weightratio = 0;
            Weightratio = $('#Weightratio'+j).val();
            extrafees = $('#extrafees').val();
            othercost = $('#othercost'+j).val();
 
                actual_amount =  parseFloat(extrafees) * parseFloat(Weightratio) ;
                $('#othercost'+j).val(actual_amount);
                

              }
            }
            


     
        
        $(document).on('blur', '#invoicevalue', function(){
            cal_finafl_torrtal(count);
        });
        $(document).on('blur', '#weightawb', function(){
            cal_finafl_torrtal(count);
        });
        $(document).on('blur', '#rate', function(){
            cal_finafl_torrtal(count);
        });
        $(document).on('blur', '#extrafees', function(){
            cal_finafl_torrtal(count);
        });
        $(document).on('blur', '.Tcotpiece', function(){
            cal_finafl_torrtal(count);
        });
        $(document).on('blur', '.commission', function(){
            cal_finafl_torrtal(count);
        });
        $(document).on('blur', '.Clearanceprice', function(){
            cal_finafl_torrtal(count);
        });
</script>

