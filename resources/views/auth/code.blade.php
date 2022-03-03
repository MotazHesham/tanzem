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

        <p class="text-muted">برجاء كتابة الكود المرسل لرقم الهاتف {{ Auth::user()->phone }}</p>

        <form method="POST" action="{{ route('code.verify') }}">
            @csrf 
            <div class="form-group">
                <input id="code" type="text" name="code"
                    class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" required 
                    autofocus placeholder="الكود المرسل" value="{{ old('code') }}">

                @if ($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
            </div> 

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        تأكيد الكود
                    </button>
                </div>
            </div>
        </form>
        <br>
        <form method="POST" action="{{ route('code.send') }}">
            @csrf
            <button type="submit" class="btn btn-dark btn-block" id="ExampleButton" disabled>
                أعادة الأرسال <span id="time-remaining"></span>
            </button>
        </form>
        <a class="btn btn-link" href="{{ route('admin.home') }}">التأكيد عن طريق البريد الألكتروني</a>
    </div>

@endsection

@section('scripts') 
<script type='text/javascript'>
    // Time before expiring
    var secondsBeforeExpire = 120;
    
    // This will trigger your timer to begin
    var timer = setInterval(function(){
        // If the timer has expired, disable your button and stop the timer
        if(secondsBeforeExpire <= 0){
            clearInterval(timer);
            $("#ExampleButton").prop('disabled',false);
        }
        // Otherwise the timer should tick and display the results
        else{
            // Decrement your time remaining
            secondsBeforeExpire--;
            if(secondsBeforeExpire == 0){
                $("#time-remaining").text('')
            }else{
                $("#time-remaining").text(secondsBeforeExpire);   
            }   
        }
    },1000);
</script>
@endsection


