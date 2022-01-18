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
        @if(session('message'))
            <div class="alert alert-info" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">تحقق من عنوان بريدك الإلكتروني</div>

            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.
                    </div>
                @endif

                قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التحقق.
                إذا لم تستلم البريد الإلكتروني,
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">انقر هنا لطلب آخر</button>.
                </form>
            </div>
        </div>
        <a href="#" class="c-sidebar-nav-link"
            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

            </i>
            {{ trans('global.logout') }}
        </a>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
@endsection
