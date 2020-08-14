<option>--- Select State ---</option>
@if(!empty($permission_ent_freight))
  @foreach($permission_ent_freight as $key => $value)
    <option value="{{ $key }}">{{ $value }}</option>
  @endforeach
@endif