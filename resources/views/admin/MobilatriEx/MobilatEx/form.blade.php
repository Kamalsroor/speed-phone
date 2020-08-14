  <table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
    <tr>
      <td>
          {!! Form::select('Prodact_name[]', $mobilats, null, ['class' => 'sub_account custom_select form-control']) !!}
      </td>
      <td>
            {!! Form::text('Total[]', null, ['class' => 'amount form-control', 'placeholder' => 'الكميه']) !!}
            <div class="show-error-amount invalid-feedback"></div>
        </td>
      <td>
          {!! Form::textarea('sirarnamber[]', null, ['class' => ' form-control', 'placeholder' => 'السريال']) !!}
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
        {!! Form::label(' رقم الاذن', ' رقم الاذن') !!}
        {!! Form::text('premission_id', null, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'رقم الاذن']) !!}
    </div>
    <div class="form-group">
        {!! Form::label(' رقم الفاتوره', ' رقم الفاتوره ') !!}
        {!! Form::text('order_id', null, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => ' رقم الفاتوره']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
    </div>
    <!--./ Description -->
    <thead>
        <tr>
            <th>اسم الصنف .</th>
            <th>الكميه</th>
            <th>السريال</th>
            <th>حذف</th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <td>
              {!! Form::select('Prodact_name[]', $mobilats, null, ['class' => 'sub_account custom_select form-control']) !!}
          </td>
          <td>
            {!! Form::text('Total[]', null, ['class' => 'amount form-control', 'placeholder' => 'الكميه']) !!}
            <div class="show-error-amount invalid-feedback"></div>
        </td>
          <td>
              {!! Form::textarea('sirarnamber[]', null, ['class' => ' form-control', 'placeholder' => 'السريال']) !!}
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
            <th>السريال</th>
            <th>حذف</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
