@extends('layouts.app')

@section('content')
    <form class="dlab-form">

        <div class="form-group">
            <input name="dzName" required="" class="form-control" placeholder="الاسم" type="text" />
        </div>
        <div class="form-group">
            <input name="dzName" required="" class="form-control" placeholder="البريد الالكتروني" type="text" />
        </div>

        <div class="form-group">
            <input name="dzName" required="" class="form-control" placeholder="الهاتف" type="text" />
        </div>

        <div class="form-group">
            <input name="dzName" required="" class="form-control" placeholder="عدد افراد الاسرة" type="text" />
        </div>
        <h6 class="text-inherit m-b10">بيانات افراد الاسرة </h6>

        <div class="form-group">
            <input name="dzName" required="" class="form-control" placeholder="الاسم" type="text" />
        </div>


        <div class="form-group">
            <input name="dzName" required="" class="form-control" placeholder="صلة القرابة" type="text" />
        </div>

        <div class="form-group">
            <p class="info-bottom">
                <a href="" class="btn-link">اضف فرد اخر + </a>
            </p>
        </div>

        <div class="form-group">
            <button class="site-button button-md btn-block">تسجيل</button>
        </div>
        <div class="form-group">
            <p class="info-bottom">
                <a data-toggle="tab" href="#login" class="btn-link">لديك حساب
                    بالفعل </a>
            </p>
        </div>
    </form>
@endsection
