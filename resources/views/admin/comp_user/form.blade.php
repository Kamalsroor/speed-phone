<!-- user Company -->
<div class="form-group">
    {!! Form::label('company_id', 'User company') !!}
    {!! Form::select('company_id', $companies, null, ['id' => 'company_id', 'class' => 'custom_select form-control']) !!}
</div>
<!--./ user Company -->

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

<!-- user type -->
<div class="form-group">
    {!! Form::label('rule', 'User type') !!}
    {!! Form::select('rule', [1 => 'Admin', 0 => 'User'], null, ['id' => 'rule', 'class' => 'custom_select form-control']) !!}
</div>
<!--./ user type -->

<!-- user Approved -->
<div class="form-group">
    {!! Form::label('approved', 'Approve') !!}
    {!! Form::select('approved', [1 => 'Enabled', 0 => 'Disabled'], null, ['id' => 'approved', 'class' => 'custom_select form-control']) !!}
</div>
<!--./ user Approved -->

<!-- date approved -->
<div class="bootstrap-timepicker">
    <div class="form-group">
        {!! Form::label('date_approved', 'Date Approved') !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text" style="padding: 0;">
                    <label for="date_approved" style="margin-bottom: 0; padding: .375rem .75rem">
                        <i class="fa fa-clock-o"></i>
                    </label>
                </div>
            </div>
            {!! Form::text('date_approved', isset($user) ? null : date('Y-m-d H:i:s'), ['class' => 'form-control time-stamp', 'id' => 'date_approved', 'placeholder' => 'Date approved user']) !!}
        </div>
    </div>
</div>
<!--./ date approved -->

<!-- date approved -->
<div class="bootstrap-timepicker">
    <div class="form-group">
        {!! Form::label('date_expire', 'Date Expired') !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text" style="padding: 0;">
                    <label for="date_expire" style="margin-bottom: 0; padding: .375rem .75rem">
                        <i class="fa fa-clock-o"></i>
                    </label>
                </div>
            </div>
            {!! Form::text('date_expire', isset($user) ? null : date('Y-m-d H:i:s', strtotime('+1 month')), ['class' => 'form-control time-stamp', 'id' => 'date_expire', 'placeholder' => 'Date expired user']) !!}
        </div>
    </div>
</div>
<!--./ date approved -->

<!-- User validity time -->
<div class="form-group">
    {!! Form::label('expire_time', 'Add count days after date now') !!}
    <br>
    User expires after
    {!! Form::number('expire_time', null, ['style' => 'display: inline-block; width: 100px; margin: 0 3px;', 'class' => 'form-control', 'id' => 'expire_time', 'placeholder' => 'days']) !!}
    days.
</div>
<!--./ User validity time -->

