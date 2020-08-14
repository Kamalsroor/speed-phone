@extends('auth.layouts.app_login')

@section('title')
    Reset Password
@endsection

@section('content')
    <main class="form-wrapper">
        <header class="form-header">
            <div class="form-title">
                <h4 class="text">Reset Password</h4>
            </div>
        </header>
        {!! Form::open(['route' => 'comp_user.password.update', 'class' => 'login-form']) !!}
            <!-- ================ Show Message Sent Link ==================== -->
            @if(Session::has('invalid_token'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('invalid_token') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- ================ Token ==================== -->
            <input type="hidden" name="token" value="{{ $token }}">

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
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Password">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <!-- ================ Confirm Password ==================== -->
            <div class="form-group">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password">
            </div>

            <!-- ================ Submit Button ==================== -->
            <div class="form-group">
                <button type="submit" class="btn btn-info btn-block">Reset Password</button>
            </div>
        {!! Form::close() !!}
    </main>
@endsection
