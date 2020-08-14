@extends('auth.layouts.app_login')

@section('title')
    Company Admin
@endsection

@section('content')
    <main class="form-wrapper">
        <header class="form-header">
            <div class="form-title">
                <h4 class="text">Company Login</h4>
            </div>
        </header>
        {!! Form::open(['route' => 'comp_user.login', 'class' => 'login-form']) !!}
            <!-- ================ Email ==================== -->
            <div class="form-group">
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus placeholder="Email">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <!-- ================ Password ==================== -->
            <div class="form-group">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <!-- ================ Remember Me ==================== -->
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    {!! Form::checkbox('remember', null, false, ['class' => 'custom-control-input', 'id' => 'remember']) !!}
                    {!! Form::label('remember', 'Remember Me', ['class' => 'custom-control-label']) !!}
                </div>
            </div>

            <!-- ================ Submit Button ==================== -->
            <div class="form-group">
                <button type="submit" class="btn btn-info btn-block">Login</button>
            </div>
        {!! Form::close() !!}
        <footer class="form-footer">
            @if (Route::has('comp_user.password.request'))
                <a class="btn btn-link" href="{{ route('comp_user.password.request') }}">
                    Forgot Your Password ?
                </a>
            @endif
            <br>
            <a class="btn btn-link" href="{{ route('admin.login') }}">
                Admin Login
            </a>
        </footer>
    </main>
@endsection
