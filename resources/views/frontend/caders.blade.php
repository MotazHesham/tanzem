@extends('layouts.frontend')

@section('content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle" style="background-image: url('{{ asset('frontend/images/banner/bnr1.jpg') }}')">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">الكوادر</h1>
                    <p>
                        {{ $setting->caders_text ?? ''}}
                    </p>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                            <li>الكوادر</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="section-full content-inner">
            <div class="container">
                <div class="row"> 
                    @foreach($cawaders as $cader)
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="team-one__single team-one__content">
                                @php
                                    if($cader->user && $cader->user->photo){
                                        $cader_image = $cader->user->photo->getUrl('preview2');
                                    }else{
                                        $cader_image = '';
                                    }   
                                @endphp
                                <div class="team-one__image">
                                    <img src="{{ $cader_image }}" alt="" />
                                </div>
                                <!-- /.team-one__image -->
                                <div class="">
                                    <h2 class="team-one__name">
                                        <a href="{{ route('frontend.cader',$cader->id)}}">{{ $cader->user->name ?? '' }}</a>
                                    </h2>
                                    <!-- /.team-one__name -->
                                    <p>{{ $cader->specializations()->first()->name_ar ?? '' }}</p>
                                    <a href="{{ route('frontend.cader',$cader->id)}}">
                                        <button name="submit" value="Submit" type="submit"
                                            class="site-button radius-xl">
                                            المــزيد
                                        </button></a>
                                    <!-- /.team-one__text -->
                                </div>
                                <!-- /.team-one__content -->
                            </div>
                        </div> 
                    @endforeach
                </div>
                {{ $cawaders->links() }}
            </div>
        </div>
    </div>
    <!-- Content END-->
@endsection
