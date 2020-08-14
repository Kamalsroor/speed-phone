<!-- name -->
<div class="form-group">
    {!! Form::label('name', 'اسم المجموعه') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'اسم المجموعة']) !!}
</div>
<div class="form-group">
    {!! Form::label('permission', 'الصلاحيات', ['class' => 'control-label']) !!}
    {!! Form::select('permission[]',  $permissions, old('permission') ? old('permission') : $role->permissions()->pluck('name', 'name'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
               
</div>

<!--./ name -->
