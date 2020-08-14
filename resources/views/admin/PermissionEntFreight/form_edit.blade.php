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
        {!! Form::label('اسم العميل', 'اسم العميل') !!}
        {!! Form::text('CustomerNames',  $permissionentfreight_details[0]->permission_ent_freight->CustomerNames, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}
        {!! Form::date('PermissionDate',  $permissionentfreight_details[0]->permission_ent_freight->PermissionDate, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
    </div>

    <!--./ Description -->
    <thead>
    <tr>
            <th>نوع الصنف</th>
            <th>اسم الصنف</th>
            <th>العميل</th>
            <th>الكمه المشحونه</th>
            <th>الكميه المستلمه  </th>
            <th>وزن القطعه</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissionentfreight_details as $details)


               <tr>
            <td class="TypeOfProduct">
            {!! Form::hidden('id[]', $details->id) !!}

        {!! Form::select('TypeOfProduct[]', $TypeOfProduct, $details->type_id, ['class' => '  form-control']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="ProductName">
              {!! Form::text('ProductName[]', $details->ProductName, ['class' => ' form-control', 'placeholder' => 'Transition ProductName']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="TypeOfProduct">
        {!! Form::select('customernames[]', $Customers, $details->customernames, ['class' => '  form-control']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="Quantity">
              {!! Form::text('QuantityCharged[]', $details->QuantityCharged, ['class' => 'amount form-control', 'placeholder' => 'Transition Quantity']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="Quantity">
              {!! Form::text('Quantityrecipient[]', $details->Quantityrecipient, ['class' => 'amount form-control', 'placeholder' => 'Transition Quantity']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="Quantity">
              {!! Form::text('wight[]', $details->wight, ['class' => 'amount form-control', 'placeholder' => 'وزن القطعه']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
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
            <th>نوع الصنف</th>
            <th>اسم الصنف</th>
            <th>العميل</th>
            <th>الكمه المشحونه</th>
            <th>الكميه المستلمه  </th>
            <th>وزن القطعه</th>
            <th>Remove</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
