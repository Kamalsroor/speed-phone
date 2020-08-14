<!-- name -->
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Company name']) !!}
</div>
<!--./ name -->

<!-- Phone -->
<div class="form-group">
    {!! Form::label('phone', 'Phone') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Company phone']) !!}
</div>
<!--./ Phone -->

<!-- Email -->
<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Company email']) !!}
</div>
<!--./ Email -->

<!-- Website -->
<div class="form-group">
    {!! Form::label('website', 'Website') !!}
    {!! Form::text('website', null, ['class' => 'form-control', 'id' => 'website', 'placeholder' => 'Company website']) !!}
</div>
<!--./ Website -->

<!-- Employment -->
<div class="form-group">
    {!! Form::label('employment', 'Employment') !!}
    {!! Form::text('employment', null, ['class' => 'form-control', 'id' => 'employment', 'placeholder' => 'Company employment']) !!}
</div>
<!--./ Employment -->

<!-- Address -->
<div class="form-group">
    {!! Form::label('address', 'Address') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Company address']) !!}
</div>
<!--./ Address -->

<!-- description -->
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Company description']) !!}
</div>
<!--./ description -->

<!-- image path -->
<div class="form-group">
    {!! Form::label('company_logo', 'Logo') !!}
    {!! Form::file('company_logo', ['id' => 'company_logo', 'accept' => '.jpeg, .png, .jpg, .svg']) !!}
</div>
<!-- ./ image path -->

<!-- Status -->
<div class="form-group">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, ['id' => 'status', 'class' => 'custom_select form-control']) !!}
</div>
<!--./ Status -->