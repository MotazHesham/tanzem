@extends('layouts.app')
@section('content')

    <h1 class="h3">Reset Password</h1> 
    <form method="POST" action="{{ route('forgetpassword.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}"> 

        <div class="form-group">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary btn-lg btn-block">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form> 
    
@endsection