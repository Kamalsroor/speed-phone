<!-- name -->
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'User name']) !!}
</div>
<!--./ name -->

<!--email -->
<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'exapmle@mail.com']) !!}
</div>
<!--./ email -->

<!--password -->
<div class="form-group">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
</div>
<!--./ password -->

<!--password 2 -->
<div class="form-group">
    {!! Form::label('password_confirmation', 'Confirm Password') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Password']) !!}
</div>
<!--./ password 2-->

<!-- Phone -->
<div class="form-group">
    {!! Form::label('phone', 'Phone') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'User phone']) !!}
</div>
<!--./ Phone -->

<!-- work_place -->
<div class="form-group">
    {!! Form::label('work_place', 'Work place') !!}
    {!! Form::text('work_place', null, ['class' => 'form-control', 'id' => 'work_place', 'placeholder' => 'User work place']) !!}
</div>
<!--./ work_place -->

<!-- job -->
<div class="form-group">
    {!! Form::label('job', 'Job') !!}
    {!! Form::text('job', null, ['class' => 'form-control', 'id' => 'job', 'placeholder' => 'User job in company']) !!}
</div>
<!--./ job -->
@cadmin
    @if (isset($user) && $user->rule == 0)
        {{-- <!-- user type -->
        <div class="form-group">
            {!! Form::label('rule', 'User type') !!}
            {!! Form::select('rule', [1 => 'Admin', 0 => 'User'], null, ['id' => 'rule', 'class' => 'custom_select form-control']) !!}
        </div>
        <!--./ user type --> --}}

        <!-- user Status -->
        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {!! Form::select('status', [1 => 'Enabled', 0 => 'Disabled'], null, ['id' => 'status', 'class' => 'custom_select form-control']) !!}
        </div>
        <!--./ user Status -->
    @endif
@endcadmin