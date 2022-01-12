@extends('layouts.app')

@section('content')
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
<a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

    </i>
    {{ trans('global.logout') }}
</a>
<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@endsection
