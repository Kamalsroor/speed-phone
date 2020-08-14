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
        {!! Form::open(['route' => 'comp_user.password.email', 'class' => 'login-form']) !!}
            <!-- ================ Show Message Sent Link ==================== -->
            @if(Session::has('sent_link'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('sent_link') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- ================ Email ==================== -->
            <div class="form-group">
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus placeholder="Email">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <!-- ================ Submit Button ==================== -->
            <div class="form-group">
                <button type="submit" class="btn btn-info btn-block">Send Password Reset Link</button>
            </div>
        {!! Form::close() !!}
        <footer class="form-footer">
            <a class="btn btn-link" href="{{ route('comp_user.login') }}">
                Login
            </a>
        </footer>
    </main>
@endsection
