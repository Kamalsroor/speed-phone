
<ul class="nav nav-tabs">
    @if ((isset($lang) && in_array('en', $lang)) || !isset($lang))
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#english1">English</a></li>
    @endif

    @if ((isset($lang) && in_array('ar', $lang) || !isset($lang)))
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#arabic2">العربيه</a></li>
    @endif
</ul>