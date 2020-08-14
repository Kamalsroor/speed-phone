  
                  <?php
                use App\MobilatDetails;
                use App\MobilatExDetails;
                
                
                ?>

  <table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
    <tr>
      <td>
      
                      <select name="Prodact_name[]" class="sub_account custom_select  form-control">

                @foreach($Mobilats as $Mobilat) 
                
                <?php 
                
                $MobilatDetails4 = MobilatDetails::where('action',2)->where('Prodact_name', $Mobilat->id)->get();
                $MobilatDetails3 = MobilatDetails::where('action',1)->where('Prodact_name', $Mobilat->id)->get();
                $totalprodact = count($MobilatDetails3)-count($MobilatDetails4);
                ?>
                @if($totalprodact > 0 )
                <option value= " {{ $Mobilat->id }} "> {{$Mobilat->name}} </option>
                @endif
                @endforeach
            </select>
      </td>
      <td>
            {!! Form::text('Total[]', null, ['class' => 'amount form-control', 'placeholder' => 'الكميه']) !!}
            <div class="show-error-amount invalid-feedback"></div>
        </td>

        <td class="text-center">
            <button type="button" class="btn btn-danger remove-row"><i class="fa fa-close"></i></button>
        </td>
    </tr>'>

    <!-- Description -->
    <div class="form-group">
        {!! Form::label('اسم العميل', 'اسم العميل') !!}
        {!! Form::select('CustomerNames', $Customers, null, ['class' => 'sub_account custom_select select2 form-control' ]) !!}

    </div>
    
    <!--./ Description -->
    <thead>
        <tr>
            <th>اسم الصنف .</th>
            <th>الكميه</th>
            <th>حذف</th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <td>
              
            <select name="Prodact_name[]" class="sub_account custom_select  form-control">

                @foreach($Mobilats as $Mobilat) 
                
                <?php 
                
                $MobilatDetails4 = MobilatDetails::where('action',2)->where('Prodact_name', $Mobilat->id)->get();
                $MobilatDetails3 = MobilatDetails::where('action',1)->where('Prodact_name', $Mobilat->id)->get();
                $totalprodact = count($MobilatDetails3)-count($MobilatDetails4);
                ?>
                @if($totalprodact > 0 )
                <option value= " {{ $Mobilat->id }} "> {{$Mobilat->name}} </option>
                @endif
                @endforeach
            </select>
          </td>
          <td>
            {!! Form::text('Total[]', null, ['class' => 'amount form-control', 'placeholder' => 'الكميه']) !!}
            <div class="show-error-amount invalid-feedback"></div>
        </td>
         
          <td class="text-center">
              <button type="button" class="btn btn-danger remove-row"><i class="fa fa-close"></i></button>
          </td>
        </tr>
        <tr>
            <td colspan="5">
                <button type="button" class="btn btn-info btn-lg add-row"><i class="fa fa-plus"></i></button>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
        <th>اسم الصنف .</th>
            <th>الكميه</th>
            <th>حذف</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
