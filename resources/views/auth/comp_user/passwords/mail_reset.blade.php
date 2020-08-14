@component('mail::message')

# Reset Account

### Welcome {{ $username }}
@component('mail::button', ['url' => url('company/password/reset/' . $token)])
Click here to reset your password
@endcomponent

Or copy this link
<br>
{!! Html::link(url('company/password/reset/' . $token)) !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
