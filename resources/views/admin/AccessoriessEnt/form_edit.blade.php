<table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
    <tr>
        <td>
            {!! Form::hidden('id[]', 0) !!}
            {!! Form::select('Prodact_name[]', $Acc, null, ['class' => ' form-control select2 '   ]) !!}


        </td>
        <td>
            {!! Form::text('qualityacc[]', null, ['class' => ' form-control', 'placeholder' => 'الكميه']) !!}
            <div class="show-error-amount invalid-feedback"></div>
        </td>


        <td class="text-center">
            <button type="button" class="btn btn-danger remove-row" data-id="0"><i class="fa fa-close"></i></button>
        </td>
    </tr>'>
            <!-- Description -->
            <div class="form-group">
                {!! Form::label('اسم العميل', 'اسم العميل') !!}
                {!! Form::select('CustomerNames', $Customers, $MobilatDetails[0]->MobilatEnt->CustomerNames, ['class' => 'sub_account custom_select select2 form-control' ]) !!}

            </div>
            <div class="form-group">
                {!! Form::label('اسم العميل', 'اسم العميل') !!}
                {!! Form::text('premission_id',  $MobilatDetails[0]->MobilatEnt->premission_id, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('اسم العميل', 'اسم العميل') !!}
                {!! Form::text('order_id',  $MobilatDetails[0]->MobilatEnt->order_id, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'اسم العميل']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}
                {!! Form::date('date',  $MobilatDetails[0]->MobilatEnt->date, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
            </div>

    <!--./ Description -->
    <thead>
        <tr>
          <th>اسم الصنف</th>
          <th>الكميه</th>
          <th>حذف</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($MobilatDetails as $details)
            <tr>
                <td>
                    {!! Form::hidden('id[]', $details->id) !!}

                    {!! Form::select('Prodact_name[]', $Acc, $details->Prodact_name, ['class' => ' form-control custom_select select2'   ]) !!}

                </td>
                
                <td>
                  {!! Form::text('qualityacc[]', $details->ACC, ['class' => 'amount form-control', 'placeholder' => 'الكميه']) !!}
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
          <th>الكميه</th>
          <th>حذف</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
