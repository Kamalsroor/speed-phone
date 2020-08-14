<!-- name -->
<!--./ name -->
    <div class="form-group">
        {!! Form::label('اسم العميل', 'اسم العميل') !!}
        {!! Form::select('CustomerNames', $Customersfreight, $AccountCustomers->customersname, ['class' => 'sub_account custom_select select2 form-control' ]) !!}

    </div>
    <div class="form-group">
        {!! Form::label('اسم العميل', 'اسم العميل') !!}
        {!! Form::select('permissionEntId', $permission_ent_freight, $AccountCustomers->permissionEntId, ['class' => 'sub_account custom_select select2 form-control' ]) !!}
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
