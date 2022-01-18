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
        <h1>{{ trans('panel.site_title') }}</h1>

        <p class="text-muted">{{ trans('global.reset_password') }}</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}"
                    value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-flat btn-block">
                        {{ trans('global.send_password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
