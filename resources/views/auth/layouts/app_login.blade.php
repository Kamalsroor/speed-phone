<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('metas')

    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Styles -->
    {!! Html::style('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css') !!}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700,900,900i">
    {!! Html::style('public/css/font-awesome.min.css') !!}
    {!! Html::style('public/admin/css/background.css') !!}
    {!! Html::style('public/admin/css/login.css') !!}
    @yield('styles')

</head>
<body>

    <div id="app">
        <div class="wrapper-login">
            <div class="background-cloud">
                <div class='start1'></div>
                <div class='start2'></div>
                <div class='start3'></div>

                <div class="viewport-login">
                    <!--========================================= My Code =======================================-->
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <!-- jQuery 3 -->
    {!! Html::script('public/js/jquery-3.2.1.min.js') !!}
    <!-- Bootstrap 4.1 -->
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js') !!}
    {!! Html::script('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js') !!}
    {!! Html::script('public/admin/js/main.js') !!}
    @yield('scripts')
</body>
</html>