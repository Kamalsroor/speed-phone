<!-- Account Type -->
<div class="form-group">
    {!! Form::label('account_type_id', 'Account Type') !!}
    {!! Form::select('account_type_id', $account_types, null, ['class' => 'custom_select form-control', 'id' => 'account_type_id']) !!}
</div>
<!--./ Account Type -->
<!-- name -->
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'User name']) !!}
</div>
<!--./ name -->