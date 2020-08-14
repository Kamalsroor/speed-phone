<!-- name -->
<!--./ name -->
    <div class="form-group">
        {!! Form::label('اسم العميل', 'اسم العميل') !!}
        {!! Form::select('CustomerNames', $Customersfreight, null, ['class' => 'sub_account custom_select  form-control' ,'readonly' => 'readonly' ]) !!}

    </div>
    <div class="form-group">
        {!! Form::label('اذن استلام الشحن', 'اذن استلام الشحن ') !!}
        {!! Form::select('permissionEntId', $permission_ent_freight, null, ['class' => 'sub_account custom_select select2 form-control' ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name', 'الحساب بالجنيه المصري ') !!}
        {!! Form::text('account', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'الحساب الجنيه المصري']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'التاريخ') !!}
        {!! Form::text('date', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'dd/mm/yyyy']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'ملاحظات') !!}
        {!! Form::textarea('Notes', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'ملاحظات']) !!}
    </div>
