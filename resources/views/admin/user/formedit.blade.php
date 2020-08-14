<!-- name -->
<div class="form-group">
    {!! Form::label('name', 'الاسم') !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'User name']) !!}
</div>
<!--./ name -->

<!--email -->
<div class="form-group">
    {!! Form::label('email', 'البريد') !!}
    {!! Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'exapmle@mail.com']) !!}
</div>
<!--./ email -->

<!--password -->
<div class="form-group">
    {!! Form::label('password', 'كلمه السر الجديده') !!}
    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
</div>
<!--./ password -->

<!--password 2 -->
<div class="form-group">
    {!! Form::label('password_confirmation', 'اعاده كلمه السر الجديده') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Password']) !!}
</div>
<!--./ password 2-->

<div class="form-group">
            {!! Form::label('roles', 'الصلاحيات*', ['class' => 'control-label']) !!}
            {!! Form::select('roles[]', $roles, old('roles') ? old('roles') : $user->roles()->pluck('name', 'name'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => '']) !!}
</div>


