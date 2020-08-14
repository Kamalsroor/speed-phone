<table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
    <tr>
        <td>
            {!! Form::hidden('id[]', 0) !!}
            {!! Form::select('Prodact_name[]', $mobilats, null, ['class' => ' form-control select2 '   ]) !!}


        </td>
        <td>
            {!! Form::text('sirarnamber[]', null, ['class' => ' form-control', 'placeholder' => 'السريال']) !!}
            <div class="show-error-amount invalid-feedback"></div>
        </td>


        <td class="text-center">
            <button type="button" class="btn btn-danger remove-row" data-id="0"><i class="fa fa-close"></i></button>
        </td>
    </tr>'>
            <!-- Description -->
            <div class="form-group">
                {!! Form::label('اسم العميل', 'اسم العميل') !!}
                {!! Form::text('CustomerNames',  $MobilatExDetails[0]->MobilatEx->CustomerNames, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('اسم العميل', 'اسم العميل') !!}
                {!! Form::text('premission_id',  $MobilatExDetails[0]->MobilatEx->premission_id, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('اسم العميل', 'اسم العميل') !!}
                {!! Form::text('order_id',  $MobilatExDetails[0]->MobilatEx->order_id, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}
                {!! Form::date('date',  $MobilatExDetails[0]->MobilatEx->date, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
            </div>



    <!--./ Description -->
    <thead>
        <tr>
          <th>اسم الصنف</th>
          <th>السريال</th>
          <th>حذف</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($MobilatExDetails as $details)
            <tr>
                <td>
                    {!! Form::hidden('id[]', $details->id) !!}

                    {!! Form::select('Prodact_name[]', $mobilats, $details->Prodact_name, ['class' => ' form-control custom_select select2'   ]) !!}

                </td>
                
                <td>
                  {!! Form::text('sirarnamber[]', $details->sirarnamber, ['class' => 'amount form-control', 'placeholder' => 'Transition Amount']) !!}
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
        <th>اسم الصنف</th>
          <th>السريال</th>
          <th>حذف</th>  
        </tr>
    </tfoot>
</table>

<br>
<br>
