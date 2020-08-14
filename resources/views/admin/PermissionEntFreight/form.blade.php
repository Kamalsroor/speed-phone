  <table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
<tr>
            <td class="TypeOfProduct">
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
        {!! Form::text('CustomerNames', null, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}
        {!! Form::date('PermissionDate', null, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
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
        <tr>
            <td class="TypeOfProduct">
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
        </tr>

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
            <th>ألكميه المشحونه</th>
            <th>ألكميه المتسلمه </th>
            <th>وزن القطعه</th>
            <th>Remove</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
