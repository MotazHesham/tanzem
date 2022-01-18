@extends('layouts.app')
@section('content')


    <div class="login-form">
        <div class="logo">
            <a href="{{ route('frontend.home') }}"><img src="{{ asset('frontend/images/logo-black-2.png') }}"
                    alt="" /></a>
        </div>
        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-info" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <p class="text-muted">{{ trans('global.reset_password') }}</p>

        <form method="POST" action="{{ route('password.request') }}">
            @csrf

            <input name="token" value="{{ $token }}" type="hidden">

            <div class="form-group">
                <input id="email" type="email" name="email"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email"
                    autofocus placeholder="{{ trans('global.login_email') }}" value="{{ $email ?? old('email') }}">

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <input id="password" type="password" name="password" class="form-control" required
                    placeholder="{{ trans('global.login_password') }}">

                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required
                    placeholder="{{ trans('global.login_password_confirmation') }}">
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        {{ trans('global.reset_password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
