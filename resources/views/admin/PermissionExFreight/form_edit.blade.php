<table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
    <tr>

        
        <td class="TypeOfProduct"> 
                {!! Form::hidden('id[]', 0) !!}
             {!! Form::select('TypeOfProduct[]', $TypeOfProduct, null, ['class' => '  form-control']) !!}

              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="ProductName">
              {!! Form::text('ProductName[]', null, ['class' => ' form-control', 'placeholder' => 'Transition ProductName']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td Class="Quantity">
              {!! Form::text('Quantity[]', null, ['class' => 'amount form-control', 'placeholder' => 'Transition Quantity']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td >

        <td class="text-center">
            <button type="button" class="btn btn-danger remove-row" data-id="0"><i class="fa fa-close"></i></button>
        </td>
    </tr>'>
    <!-- Description -->
    <div class="form-group">
        {!! Form::label('اسم العميل', 'اسم العميل') !!}
        {!! Form::select('customernames', $Customers, $permissionexfreight_details[0]->permission_ex_freight->CustomerNames, ['class' => '  form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}
        {!! Form::date('PermissionDate',  $permissionexfreight_details[0]->permission_ex_freight->PermissionDate, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
    </div>

    <!--./ Description -->
    <thead>
        <tr>
        <th class="TypeOfProduct">نوع الصنف</th>
            <th class="ProductName">اسم الصنف</th>
            <th Class="Quantity">الكميه</th>
            <th Class="Quantity">حذف</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissionexfreight_details as $details)

            
            <tr>
                <td class="TypeOfProduct"> 
            {!! Form::hidden('id[]', $details->id) !!}
             {!! Form::select('TypeOfProduct[]', $TypeOfProduct, $details->TypeOfProduct, ['class' => '  form-control']) !!}

              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="ProductName">
              {!! Form::text('ProductName[]', $details->ProductName, ['class' => ' form-control', 'placeholder' => 'Transition ProductName']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td Class="Quantity">
              {!! Form::text('Quantity[]', $details->Quantity, ['class' => 'amount form-control', 'placeholder' => 'Transition Quantity']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td >
          <td class="text-center">
                    <button type="button" class="btn btn-danger remove-row" data-id="{{ $details->id }}"><i class="fa fa-close"></i></button>
                </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5">
                <button type="button" class="btn btn-info btn-lg add-row"><i class="fa fa-plus"></i></button>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
          <th>اسم الصنف</th>
          <th>Amount</th>
          <th>Remove</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
