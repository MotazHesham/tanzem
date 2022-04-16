@extends('layouts.frontend')

@section('content')
    

        <!-- Content -->
        <div class="page-content bg-white">
            <!-- Section Banner -->
            <div class="dlab-bnr-inr dlab-bnr-inr-md bnr-style1" style=" background-image: url('{{asset('frontend/images/slide1.jpg')}}'); background-size: cover; " id="dezParticles">
                <div class="container">
                    <div class="dlab-bnr-inr-entry align-m dlab-home">
                        <div class="bnr-content">
                            <h2> {{ $setting->home_text_1 ?? '' }} </h2>
                            <p>
                                <?php echo nl2br($setting->home_text_2 ?? ''); ?>
                            </p>
                        </div>
                        <div class="search-filter filter-style1">
                            <form action="{{ route('frontend.events') }}"> 
                                <div class="input-group">
                                    <input type="text" class="form-control" name="title" placeholder="ماذا تبحث عن?" /> 
                                    <div class="form-control">
                                        <select name="specialization_id" id="specialization_id" class="select2">
                                            <option value="">فئة الفعالية</option>
                                            @foreach(\App\Models\Specialization::get() as $specialization)
                                                <option value="{{ $specialization->id }}" @isset($specialization_id) @if($specialization_id == $specialization->id) selected @endif @endisset>{{ $specialization->name_ar }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-control">
                                        <select name="city_id" id="city_id">
                                            <option value="">مكان الفعالية</option>
                                            @foreach(\App\Models\City::get() as $city)
                                                <option value="{{ $city->id }}" @isset($city_id) @if($city_id == $city->id) selected @endif @endisset>{{ $city->name_ar }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group-prepend">
                                        <button class="site-button">بحث</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="navbar scroll-button">
                            <a href="#page_content" class="site-button button-style1 scroll"><i
                                    class="la la-long-arrow-down"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section Banner END -->

            <!-- Search Filter -->
            <div class="section-full">
                <div class="container"></div>
            </div>
            <!-- Search Filter END -->

            <div class="content-block">
                <!-- Featured Destinations -->
                <div class="section-full bg-white content-inner">
                    <div class="container">
                        <div class="section-head text-black text-center">
                            <h2 class="box-title">أحدث الفعاليات</h2>
                            <div class="dlab-separator bg-primary"></div>
                            <p>
                                <?php echo nl2br($setting->events_text ?? ''); ?>
                            </p>
                        </div>
                        <div class="row">
                            @foreach($events as $event)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="featured-bx m-b30">
                                        <div class="featured-media">
                                            <img src="{{ $event->photo ? $event->photo->getUrl('preview2') : '' }}" alt="" />
                                        </div>
                                        <div class="featured-info">
                                            <ul class="featured-star">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                            </ul>
                                            <h5 class="title">
                                                <a href="{{ route('frontend.event',$event->id) }}"> {{ $event->title ?? '' }} </a>
                                            </h5>
                                            <ul class="featured-category">
                                                <li><i class="fa fa-calendar"></i> {{ $event->start_date ?? '' }}</li>
                                                <li><i class="fa fa-map-o"></i> {{ $event->city->name ?? '' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Featured Destinations End -->
                
                 <!-- Why Choose Us -->
                <div class=" section-full g-img-fix most-visited content-inner overlay-primary-dark "
                    style="background-image: url('{{ asset('frontend/images/bg1.jpg') }}')">
                    <div class="container">
                        <div class="section-head text-white text-center">
                            <h2 class="box-title">مـــن نحن</h2>
                            <div class="dlab-separator bg-white"></div>
                            <!--<p>-->
                            <!--    <?php echo nl2br($setting->how_we_work_header ?? ''); ?>-->
                            <!--</p>-->
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="icon-bx-wraper sr-box center box1 m-b30">
                                    <div class="icon-bx-lg radius bg-white m-b20">
                                        <a href="javascript:void(0)" class="icon-cell text-primary"><i
                                                class="ti-eye"></i></a>
                                    </div>
                                    <div class="icon-content">
                                        <h3 class="dlab-tilte">الرؤية</h3>
                                        <p>
                                           
                                         {{$setting->vision }}

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="icon-bx-wraper sr-box center m-b30">
                                    <div class="icon-bx-lg radius bg-white m-b20">
                                        <a href="javascript:void(0)" class="icon-cell text-primary"><i
                                                class="ti-book"></i></a>
                                    </div>
                                    <div class="icon-content">
                                        <h3 class="dlab-tilte">
                                            الرسالة
                                        </h3>
                                        <p>
                                           
                                            {{$setting->message }}


                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="icon-bx-wraper sr-box center box1 m-b30">
                                    <div class="icon-bx-lg radius bg-white m-b20">
                                        <a href="javascript:void(0)" class="icon-cell text-primary"><i
                                                class="ti-target"></i></a>
                                    </div>
                                    <div class="icon-content">
                                        <h3 class="dlab-tilte">الأهداف</h3>
                                        <p>
                                            {{$setting->goals }}

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Why Chose Us End -->
                

                <!-- Our Services -->
                <div class="section-full bg-gray content-inner about-us" style="direction: ltr">
                    <div class="container">
                        <div class="section-head text-black text-center">
                            <h2 class="box-title">أحدث الأخبـــار</h2>
                            <div class="dlab-separator bg-primary"></div>
                            <p>
                                <?php echo nl2br($setting->news_text ?? ''); ?>
                            </p>
                        </div>
                        <div class=" most-visite owl-carousel owl-btn-center-lr owl-btn-1 primary ">
                            @foreach($news as $raw)
                                <div class="item">
                                    <div class="listing-bx featured-star-left m-b30">
                                        <div class="listing-media">
                                            <img src="{{ $raw->photo ? $raw->photo->getUrl('preview2') : '' }}" alt="" />
                                        </div>
                                        <div class="listing-info">
                                            <h3 class="title">
                                                <a href="{{ route('frontend.news',$raw->id) }}">{{ $raw->title ?? '' }}</a>
                                            </h3>
                                            <p>
                                                {{ $raw->short_description ?? '' }}
                                            </p>
                                            <ul class="place-info"> 
                                                <li class="open">
                                                    <a href="{{ route('frontend.news',$raw->id) }}"> المزيد <i class="fa fa-plus"></i> </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Our Services -->

                <!-- Why Choose Us -->
                <div class=" section-full g-img-fix most-visited content-inner overlay-primary-dark "
                    style="background-image: url('{{ asset('frontend/images/bg1.jpg') }}')">
                    <div class="container">
                        <div class="section-head text-white text-center">
                            <h2 class="box-title">كيف نعمل</h2>
                            <div class="dlab-separator bg-white"></div>
                            <p>
                                <?php echo nl2br($setting->how_we_work_header ?? ''); ?>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="icon-bx-wraper sr-box center box1 m-b30">
                                    <div class="icon-bx-lg radius bg-white m-b20">
                                        <a href="javascript:void(0)" class="icon-cell text-primary"><i
                                                class="ti-search"></i></a>
                                    </div>
                                    <div class="icon-content">
                                        <h3 class="dlab-tilte">اختيار الفعالية</h3>
                                        <p>
                                            <?php echo nl2br($setting->how_we_work_1 ?? ''); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="icon-bx-wraper sr-box center m-b30">
                                    <div class="icon-bx-lg radius bg-white m-b20">
                                        <a href="javascript:void(0)" class="icon-cell text-primary"><i
                                                class="ti-gift"></i></a>
                                    </div>
                                    <div class="icon-content">
                                        <h3 class="dlab-tilte">الاشتراك بكل سهولة</h3>
                                        <p>
                                            <?php echo nl2br($setting->how_we_work_2 ?? ''); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="icon-bx-wraper sr-box center box1 m-b30">
                                    <div class="icon-bx-lg radius bg-white m-b20">
                                        <a href="javascript:void(0)" class="icon-cell text-primary"><i
                                                class="ti-rocket"></i></a>
                                    </div>
                                    <div class="icon-content">
                                        <h3 class="dlab-tilte">حضور الفعالية</h3>
                                        <p>
                                            <?php echo nl2br($setting->how_we_work_3 ?? ''); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Why Chose Us End -->

                <!-- Our Portfolio -->
                <div class="section-full content-inner bg-gray" style="direction: ltr">
                    <div class="container">
                        <div class="section-head text-center">
                            <h2 class="box-title">قـــالـــوا عـــن تنظيــــم</h2>
                            <div class="dlab-separator bg-primary"></div>
                            <p>
                                <?php echo nl2br($setting->said_about_tanzem ?? ''); ?>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div id="owl-demo" class=" testimonial-one owl-loaded owl-theme owl-carousel owl-btn-center-lr owl-btn-3 owl-dots-primary-big ">
                                        @foreach($saidAboutTanzem as $raw)
                                            <div class="item">
                                                <div class="client-box">
                                                    <div class="client-detail">
                                                        <div class="client-img">
                                                            <img src="{{ $raw->photo ? $raw->photo->getUrl('preview') : '' }}" width="100" height="100"
                                                                alt="" />
                                                        </div>
                                                        <div class="client-info">
                                                            <h5 class="client-name">{{ $raw->name ?? '' }}</h5>
                                                            <span>{{ $raw->job_position ?? ''}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="client-info-bx">
                                                        <h5>
                                                            {{ $raw->text_1 ?? '' }}
                                                        </h5>
                                                        <p>
                                                            <?php echo nl2br($raw->text_2 ?? ''); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> 
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Our Portfolio END -->

                <!-- Featured Destinations -->
                <div class="section-full bg-white content-inner">
                    <div class="container">
                        <div class="section-head text-black text-center">
                            <h2 class="box-title">الشركات والمؤسسات</h2>
                            <div class="dlab-separator bg-primary"></div>
                            <p>
                                <?php echo nl2br($setting->organizers_text ?? ''); ?>
                            </p>
                        </div>

                        <section id="home--organizers">
                            <div class="container">
                                <div class="row border-bottom">
                                    @foreach($companiesAndInstitution as $company)
                                        <div class="col-md-3">
                                            <a href="{{ route('frontend.organization',$company->id) }}">
                                                <div class="h-organizer wow bounceIn" data-wow-duration="1s" data-wow-delay="1s " style=" visibility: visible; animation-duration: 1s; animation-delay: 1s; animation-name: bounceIn; ">
                                                    @php
                                                        if($company->user && $company->user->photo){
                                                            $company_image = $company->user->photo->getUrl('preview2');
                                                        }else{
                                                            $company_image = '';
                                                        }   
                                                    @endphp
                                                    <img src="{{ $company_image }}" class="img-fluid" />
                                                </div>
                                            </a>
                                        </div> 
                                    @endforeach
                                </div> 
                            </div>
                        </section>
                    </div>
                </div>
                <!-- Featured Destinations End -->
            </div>
            <!-- contact area END -->
        </div>
        <!-- Content END-->
@endsection