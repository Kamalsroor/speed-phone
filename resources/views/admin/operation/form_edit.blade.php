<table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
    <tr>
        <td>
            {!! Form::hidden('id[]', 0) !!}

            {!! Form::select('typeID[]', $TypeOfProduct, null, ['class' => 'sub_account select2 custom_select form-control']) !!}

            <div class="show-error-amount invalid-feedback"></div>
        </td>
        <td>
              {!! Form::text('Product[]', null, ['class' => 'amount form-control', 'placeholder' => 'Transition Quantity']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td>
              {!! Form::text('ChargedAmount[]', null, ['class' => 'amount form-control', 'placeholder' => 'وزن القطعه']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td>
              {!! Form::text('CustomerName[]', null, ['class' => 'amount form-control', 'placeholder' => 'وزن القطعه']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>


        <td class="text-center">
            <button type="button" class="btn btn-danger remove-row" data-id="0"><i class="fa fa-close"></i></button>
        </td>
    </tr>'>
    <!-- Description -->
    
    <div class="form-group">
        {!! Form::label('رقم البوليصه', ' رقم البوليصه') !!}
        {!! Form::text('policyID', $operationDetailss[0]->operation->policyID, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'رقم البوليصه ']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('رقم فاتوره مورد الخدمه', 'رقم فاتوره مورد الخدمه') !!}
        {!! Form::text('resourceinvoiceID', $operationDetailss[0]->operation->resourceinvoiceID, ['class' => 'form-control', 'id' => 'resourceinvoiceID', 'placeholder' => 'رقم فاتوره مورد الخدمه ']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('قيمه فاتوره المورد', 'قيمه فاتوره المورد') !!}
        {!! Form::text('resourceinvoiceAmount', $operationDetailss[0]->operation->resourceinvoiceAmount, ['class' => 'form-control', 'id' => 'resourceinvoiceAmount', 'placeholder' => 'قيمه فاتوره المورد ']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('معامل تحويل للعمله مصري', 'معامل تحويل للعمله مصري') !!}
        {!! Form::text('CCOTEC', $operationDetailss[0]->operation->CCOTEC, ['class' => 'form-control', 'id' => 'CCOTEC', 'placeholder' => ' معامل تحويل للعمله مصري']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('وزن الفاتوره / البوليصه', 'وزن الفاتوره / البوليصه') !!}
        {!! Form::text('policyWeight', $operationDetailss[0]->operation->policyWeight, ['class' => 'form-control', 'id' => 'policyWeight', 'placeholder' => 'وزن الفاتوره / البوليصه ']) !!}
    </div>


    <!--./ Description -->
    <thead>
        <tr>
          <th>اسم الصنف</th>
          <th>الكميه</th>
          <th>وزن القطعه</th>
          <th>Remove</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($operationDetailss as $operationDetail)
            <tr>
                <td>
                    {!! Form::hidden('id[]', $operationDetail->id) !!}

             {!! Form::select('typeID[]', $operationDetail->typeID, null, ['class' => 'sub_account select2 custom_select form-control']) !!}

            <div class="show-error-amount invalid-feedback"></div>
            </td>
            <td>
            {!! Form::text('Product[]', $operationDetail->Product, ['class' => ' form-control', 'placeholder' => 'Transition Quantity']) !!}
            <div class="show-error-amount invalid-feedback"></div>
            </td>
            <td>
            {!! Form::text('ChargedAmount[]', $operationDetail->ChargedAmount, ['class' => 'amount form-control', 'placeholder' => 'وزن القطعه']) !!}
            <div class="show-error-amount invalid-feedback"></div>
            </td>
            <td>
            {!! Form::text('CustomerName[]', $operationDetail->CustomerName, ['class' => ' form-control', 'placeholder' => 'وزن القطعه']) !!}
            <div class="show-error-amount invalid-feedback"></div>
            </td>
                  

                <td class="text-center">
                    <button type="button" class="btn btn-danger remove-row" data-id="{{ $operationDetail->id }}"><i class="fa fa-close"></i></button>
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
          <th>الكميه</th>
          <th>وزن القطعه</th>
          <th>Remove</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
