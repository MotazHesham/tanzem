@extends('layouts.app')
@section('content')

    <form method="POST" action="{{ route('forgetpassword.create.token') }}">
        @csrf
        <h3 class="form-title m-t0">Find Your Account</h3>

        <div class="form-group">
            <input name="email" required="" class="form-control" placeholder="Your Email" type="email" />
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <button class="site-button btn-block button-md">Get New Password</button>
        </div>
        <div class="form-group">
            <p class="info-bottom">
                <a href=" {{ route('login') }}" class="btn-link">Login </a> |
                {{-- <a data-toggle="tab" href="#register"
                        class="btn-link">Register</a> --}}
            </p>
        </div>
    </form>

@endsection
