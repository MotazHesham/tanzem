@extends('layouts.frontend')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/star-rating-svg.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.css" integrity="sha512-1hsteeq9xTM5CX6NsXiJu3Y/g+tj+IIwtZMtTisemEv3hx+S9ngaW4nryrNcPM4xGzINcKbwUJtojslX2KG+DQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle" style="background-image: url('{{ asset('frontend/images/banner/bnr1.jpg') }}')">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <div class="wonder-bx text-white">
                        @php
                            if($cader->user && $cader->user->photo){
                                $cader_image = $cader->user->photo->getUrl('preview2');
                            }else{
                                $cader_image = '';
                            }  
                            $now_date = date('Y-m-d',strtotime('now'));
                            $event = $cader->events()->where('status','active')->where('start_date','<=',$now_date)->where('end_date','>=',$now_date)->get()->first(); 
                        @endphp
                        <div class="wonder-theme">
                            <img src="{{ $cader_image }}" class="rounded-circle" />
                        </div>
                        <div class="wonder-title">
                            <p>{{ $cader->user->name ?? '' }}</p>
                        </div>
                        <div class="wonder-price"></div>
                        <div class="wonder-btn">
                            <a href="javascript:void(0);" class="site-button button-lg radius-no text-uppercase">
                                @if($event)
                                مشارك الان في فعاليات   
                                {{ $event->title ?? '' }}
                                @else 
                                متاح الأن
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <div class="container">
                <div class="dlab-post-media m-b50">
                    <a href="javascript:void(0);"><img src="{{ asset('frontend/images/event-big.jpg') }}" alt="" /></a>
                </div>
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-xl-8 col-lg-7 col-md-12 p-b30">
                        <div class="section-head text-black mb-3">
                            <h2 class="box-title">{{ $cader->user->name ?? '' }}</h2>
                            <p class="m-b0"> 
                                <?php echo nl2br($cader->desceiption ?? ''); ?>
                            </p>
                        </div>
                        <div class="dlab-divider bg-gray-dark"></div>
                        <div class="widget widget_getintuch widget_listing">
                            @auth
                            <ul>
                                <li>
                                    <i class="fa-solid fa-location-dot text-primary"></i>
                                    <!--<i class="fa fa-map-marker text-primary"></i>-->
                                    <p class="m-b0">{{ $cader->city->name_ar ?? '' }}</p>
                                </li>
                                <li>
                                    <i class="fa fa-phone text-primary"></i>
                                    <p class="m-b0">{{ $cader->user->phone ?? ''}}</p> 
                                </li>
                                <li>
                                    <i class="fa fa-envelope text-primary"></i>
                                    <p class="m-b0">{{ $cader->user->email ?? '' }}</p>
                                </li>
                            </ul>
                            @else
                            <div class="data-shown-message">
                                <p>
                				عذراً.. لا يمكنك رؤية هذه البيانات لأنك لم تقم بتسجيل الدخول... 
                			 <i class="fa-solid fa-face-frown-open" style="position:relative;"></i>
                			    <br>
                			 <a href="https://tanthim.com/login" class="signin-data">قم بتسجيل الدخول الآن</a>
                				</p>
                            </div>
                            @endauth
                        </div>

                        <div class="dlab-divider bg-gray-dark"></div> 

                        <div class="dlab-divider bg-gray-dark"></div>
                        <h4 class="m-b10">الفعاليات الحالية</h4>

                        <div class="row">
                            @forelse($cader->events()->where('status','active')->where('start_date','<=',$now_date)->where('end_date','>=',$now_date)->orderBy('created_at','desc')->get() as $event)
                                <div class="col-lg-4">
                                    <div class="listing-bx event-listing m-b30">
                                        <div class="listing-media">
                                            <a href="#">
                                                <img src="{{ $event->photo ? $event->photo->getUrl('preview3') : '' }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="listing-info">
                                            <h3 class="title">
                                                <a href="{{ route('frontend.event',$event->id) }}">{{ $event->title ?? '' }}</a>
                                            </h3>
                                            <ul class="event-meta">
                                                <li class="event-date">
                                                    <span class="text-primary">{{ date('M',strtotime($event->start_date)) }}</span>
                                                    <strong>{{ date('d',strtotime($event->start_date)) }}</strong>
                                                </li>
                                                <li>{{ date('D',strtotime($event->start_date)) }} {{ $event->start_time}}</li>
                                                <li>{{ $event->city->name_ar ?? ''}}</li>
                                                <li>{{ $event->eventsVisitors()->count() }} مشترك</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @empty 
                                <div class="container text-center mt-4 mb-4 alert alert-dark">
                                    متاح الأن
                                </div>
                            @endforelse 
                        </div>

                        <div class="dlab-divider bg-gray-dark"></div>

                        <h4 class="m-b10">الفعاليات السابقة</h4>
                        <div class="row">
                            @foreach($cader->events()->where('status','active')->where('end_date','<',$now_date)->orderBy('created_at','desc')->get() as $event)
                                <div class="col-lg-4">
                                    <div class="listing-bx event-listing m-b30">
                                        <div class="listing-media">
                                            <a href="#">
                                                <img src="{{ $event->photo ? $event->photo->getUrl('preview3') : '' }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="listing-info">
                                            <h3 class="title">
                                                <a href="{{ route('frontend.event',$event->id) }}">{{ $event->title ?? '' }}</a>
                                            </h3>
                                            <ul class="event-meta">
                                                <li class="event-date">
                                                    <span class="text-primary">{{ date('M',strtotime($event->start_date)) }}</span>
                                                    <strong>{{ date('d',strtotime($event->start_date)) }}</strong>
                                                </li>
                                                <li>{{ date('D',strtotime($event->start_date)) }} {{ $event->start_time}}</li>
                                                <li>{{ $event->city->name_ar ?? ''}}</li>
                                                <li>{{ $event->eventsVisitors()->count() }} مشترك</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach  
                        </div>

                        <!-- blog END -->
                    </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->
                    {{-- <div class="col-xl-4 col-lg-5 col-md-12 sticky-top p-b30">
                        <aside class="side-bar listing-side-bar">
                            <div class="widget widget_time">
                                <h4 class="m-b10">ساعات العمل</h4>
                                <div class="dlab-separator bg-primary m-b20"></div>
                                <ul class="m-b0">
                                    <li>
                                        <a href="javascript:void(0)">السبت</a> 08:00am - 11:00pm
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الاحد</a> 08:00am - 11:00pm
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الاثنين</a> 12:00am -
                                        11:00pm
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الثلاثاء</a> 08:00am -
                                        11:00pm
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الاربعاء</a> 03:00pm -
                                        02:00am
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الخميس</a> 03:00pm -
                                        02:00am
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">الجمعة</a> 03:00pm -
                                        02:00am
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div> --}}
                    <!-- Side bar END -->
                </div>
            </div>
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection


@section('scripts') 

    <script src="{{ asset('frontend/js/jquery.star-rating-svg.js') }}"></script>
    <!-- STAR RATING SVG --> 
@endsection