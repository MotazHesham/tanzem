@extends('layouts.frontend')

@section('styles') 
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/star-rating-svg.css') }}" />
@endsection

@section('content')


    <!-- Content -->
    <div class="page-content bg-white text-gray-1">
        <!-- inner page banner -->
        <div class="  dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle  inner-particles  "
            id="dezParticles" style="background-image: url('{{asset('frontend/images/banner/bnr1.jpg')}}')">
            <div class="container"></div>
        </div>
        <!-- inner page banner END -->
        <div class="listing-details-head">
            <div class="container">
                <div class="listing-info-box">
                    <div class="listing-theme-logo">
                        @php
                            if($company->user && $company->user->photo){
                                $company_image = $company->user->photo->getUrl('preview2');
                            }else{
                                $company_image = '';
                            }   
                        @endphp
                        <img src="{{ $company_image }}" alt="" />
                    </div>
                    <div class="listing-info">
                        <div class="listing-info-left">
                            <h3 class="title">{{ $company->user->name ?? ''}}</h3> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="listing-details-nav">
            <div class="container">
                <ul class="listing-nav nav">
                    <li>
                        <a data-toggle="tab" href="#listing_home" class="active"><i
                                class="la la-home"></i><span>الرئيسية</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#listing_photos"><i class="la la-image"></i><span>الصور</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#listing_videos"><i
                                class="la la-video-camera"></i><span>الفيديوهات</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#listing_events"><i
                                class="la la-calendar-check-o"></i><span>الفعاليات</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#listing_cader"><i class="la la-user"></i><span>الكوادر</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade modal-bx-info" id="favorite" tabindex="-1" role="dialog"
            aria-labelledby="FavoriteModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="FavoriteModalLongTitle">
                            <i class="la la-unlock"></i>LOGIN
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content nav">
                            <div id="login" class="tab-pane active">
                                <form class="dlab-form">
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control"
                                            placeholder="Username or Email Address" type="text" />
                                    </div>
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control" placeholder="Type Password"
                                            type="password" />
                                    </div>
                                    <div class="form-group field-btn text-left">
                                        <div class="input-block">
                                            <input id="check1" type="checkbox" />
                                            <label for="check1">Remember me</label>
                                        </div>
                                        <a data-toggle="tab" href="#forgot-password" class="btn-link forgot-password">
                                            Forgot Password</a>
                                    </div>
                                    <div class="form-group">
                                        <button class="site-button btn-block button-md">
                                            login
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <p class="info-bottom">
                                            Don’t have an account?
                                            <a data-toggle="tab" href="#register" class="btn-link">Register</a>
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="site-button facebook button-md btn-block"><i
                                                class="fa fa-facebook-official m-r10"></i> Log in
                                            with Facebook</a>
                                    </div>
                                </form>
                            </div>
                            <div id="forgot-password" class="tab-pane fade">
                                <form class="dlab-form">
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control" placeholder="Email Id"
                                            type="text" />
                                    </div>
                                    <div class="form-group">
                                        <button class="site-button btn-block button-md">
                                            Get New Password
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <p class="info-bottom">
                                            <a data-toggle="tab" href="#login" class="btn-link">Login
                                            </a>
                                            |
                                            <a data-toggle="tab" href="#register" class="btn-link">Register</a>
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="site-button facebook button-md btn-block"><i
                                                class="fa fa-facebook-official m-r10"></i> Log in
                                            with Facebook</a>
                                    </div>
                                </form>
                            </div>
                            <div id="register" class="tab-pane fade">
                                <form class="dlab-form">
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control" placeholder="Full Name"
                                            type="text" />
                                    </div>
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control" placeholder="Email Id"
                                            type="text" />
                                    </div>
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control" placeholder="Address"
                                            type="text" />
                                    </div>
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control" placeholder="City/Town"
                                            type="text" />
                                    </div>
                                    <h6 class="text-inherit m-b10">
                                        Enter your account details below:
                                    </h6>
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control" placeholder="User Name"
                                            type="text" />
                                    </div>
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control" placeholder="Password"
                                            type="text" />
                                    </div>
                                    <div class="form-group">
                                        <input name="dzName" required="" class="form-control"
                                            placeholder="Re-type Your Password" type="text" />
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="privacy-policy" />
                                        <label for="privacy-policy">I agree to the
                                            <a href="#" class="btn-link">Terms of Service </a>&
                                            <a href="#" class="btn-link">Privacy Policy
                                            </a></label>
                                    </div>
                                    <div class="form-group">
                                        <button class="site-button button-md btn-block">
                                            Submit
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <p class="info-bottom">
                                            <a data-toggle="tab" href="#login" class="btn-link">Login with username
                                                and password?</a>
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="site-button facebook button-md btn-block"><i
                                                class="fa fa-facebook-official m-r10"></i> Log in
                                            with Facebook</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End -->

        <!-- Modal -->
        <div class="modal fade modal-bx-info modal-lg" id="report-reviews" tabindex="-1" role="dialog"
            aria-labelledby="ReportReviewsModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ReportReviewsModalLongTitle">
                            REPORT ABUSE
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="dlab-form">
                            <div class="clearfix">
                                <p>
                                    If you think this content inappropriate and should be
                                    removed from our website, please let us know by submitting
                                    your reason at the form below.
                                </p>
                            </div>
                            <div class="form-group">
                                <input name="dzName" required="" class="form-control" placeholder="Reason"
                                    type="password" />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Description"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="site-button gray-light">Cancel</a>
                        <a href="#" class="site-button">Submit</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End -->

        <!-- contact area -->
        <div class="section-full listing-details-content">
            <div class="container">
                <div class="tab-content">
                    <div id="listing_home" class="tab-pane active">
                        <div class="row">
                            <!-- Left part start -->
                            <div class="col-xl-8 col-lg-7 col-md-12">
                                <div class="content-box">
                                    <div class="content-header">
                                        <h3 class="title">
                                            <i class="la la-file-text m-r5"></i> الوصف
                                        </h3>
                                    </div>
                                    <div class="content-body">
                                        <p> 
                                            <?php echo nl2br($company->about_company ?? ''); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="content-box">
                                    <div class="content-header">
                                        <h3 class="title">
                                            <i class="la la-calendar-check-o m-r5"></i>الفعاليات
                                        </h3>
                                    </div>
                                    <div class="content-body">
                                        <div class="row">
                                            @foreach($company->companyEvents()->orderBy('created_at','desc')->get()->take(2) as $event)
                                                <div class="col-lg-6">
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
                                    </div>
                                    <div class="content-footer content-btn text-center">
                                        <a data-toggle="tab" href="#listing_events">عرض الكل</a> 
                                    </div>
                                </div>

                                <div class="content-box">
                                    <div class="content-header">
                                        <h3 class="title">
                                            <i class="la la-file-image-o"></i> الصور
                                        </h3>
                                    </div>
                                    <div class="content-body">
                                        <div
                                            class=" widget widget_gallery gallery-grid-4 lightgallery ">
                                            <ul>
                                                @foreach($company->galery as $key => $media) 
                                                    <li>
                                                        <span data-exthumbimage="{{ $media->getUrl('preview2') }}"
                                                            data-src="{{ $media->getUrl('preview2') }}"
                                                            class="check-km" title="Light Gallery Grid 1">
                                                            <a href="javascript:void(0);">
                                                                <div class="dlab-post-thum">
                                                                    <img src="{{ $media->getUrl('preview2') }}" alt="" />
                                                                </div>
                                                            </a>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content-footer content-btn text-center">
                                        <a data-toggle="tab" href="#listing_photos" class="site-button-link">عرض الكل</a>
                                    </div>
                                </div>
                                <div class="content-box">
                                    <div class="content-header">
                                        <h3 class="title">
                                            <i class="la la-video-camera m-r5"></i>فيدوهات
                                        </h3>
                                    </div>
                                    <div class="content-body">
                                        <div class="widget widget_video video-grid-4">
                                            <ul>
                                                @foreach($company->videos as $key => $media) 
                                                    <li>
                                                        <div class="dlab-post-thum video-bx">
                                                            <img src="{{ asset('frontend/images/gallery/pic1.jpg') }}" alt="" />
                                                            <div class="video-play-icon">
                                                                <a href="{{ $media->getUrl() }}"
                                                                    class="popup-youtube video"><i
                                                                        class="la la-play"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content-footer content-btn text-center">
                                        <a data-toggle="tab" href="#listing_videos" href="javascript:void(0);">عرض الكل </a>
                                    </div>
                                </div>
                            </div>
                            <!-- blog END -->
                            <!-- Side bar start -->
                            <div class="col-xl-4 col-lg-5 col-md-12 sticky-top">
                                <aside class="side-bar listing-side-bar">
                                    <div class="content-box">
                                        <div class="content-header">
                                            <h3 class="title">
                                                <i class="la la-map-signs m-r5"></i>بيانات التواصل
                                            </h3>
                                        </div>
                                        <div class="content-body">
                                            <ul class="icon-box-list">
                                                <li>
                                                    <a href="mailto:{{ $company->gmail ?? '' }}" class="icon-box-info">
                                                        <div class="icon-cell bg-gray">
                                                            <i class="la la-envelope"></i>
                                                        </div>
                                                        <span>{{ $company->gmail ?? '' }}</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="tel:{{ $company->user->phone ?? '' }}" class="icon-box-info">
                                                        <div class="icon-cell bg-gray">
                                                            <i class="la la-phone"></i>
                                                        </div>
                                                        <span>{{ $company->user->phone ?? '' }}</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $company->user->website ?? '' }}" class="icon-box-info">
                                                        <div class="icon-cell bg-gray">
                                                            <i class="la la-globe"></i>
                                                        </div>
                                                        <span>{{ $company->user->website ?? '' }}</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="icon-box-info">
                                                        <div class="icon-cell bg-gray">
                                                            <i class="la la-map-marker"></i>
                                                        </div>
                                                        <span>{{ $company->city->name_ar ?? '' }}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="list-inline m-tb20">
                                                <li>
                                                    <a href="{{ $company->facebook ?? '' }}" class="site-button radius-no sharp"><i
                                                            class="fa fa-facebook"></i></a>
                                                </li>
                                                <li>
                                                    <a href="mailto:{{ $company->gmail ?? '' }}" class="site-button radius-no sharp"><i
                                                            class="fa fa-google-plus"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{{ $company->linked ?? '' }}" class="site-button radius-no sharp"><i
                                                            class="fa fa-linkedin"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{{ $company->instagram ?? '' }}" class="site-button radius-no sharp"><i
                                                            class="fa fa-instagram"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{{ $company->twitter ?? '' }}" class="site-button radius-no sharp"><i
                                                            class="fa fa-twitter"></i></a>
                                                </li>
                                            </ul> 
                                        </div>
                                    </div>

                                    <div class="content-box">
                                        <div class="content-header">
                                            <h3 class="title">
                                                <i class="la la-sitemap m-r5"></i>فئة الفعاليات
                                            </h3>
                                        </div>
                                        <div class="content-body">
                                            <ul class="icon-box-list list-col-2">
                                                @foreach($company->specializations as $specialization)
                                                    <li>
                                                        <a href="javascript:void(0);" class="icon-box-info"> 
                                                            <span>{{ $specialization->name_ar ?? '' }}</span>
                                                        </a>
                                                    </li> 
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <div class="content-header">
                                            <h3 class="title">
                                                <i class="la la-bar-chart m-r5"></i>إحصائيات
                                            </h3>
                                        </div>
                                        <div class="content-body">
                                            <ul class="icon-box-list list-col-2">
                                                <li>
                                                    <div class="icon-box-info">
                                                        <div class="icon-cell bg-gray">
                                                            <i class="la la-eye"></i>
                                                        </div>
                                                        <span>{{ $company->cawaders()->count() }} كادر</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon-box-info">
                                                        <div class="icon-cell bg-gray">
                                                            <i class="la la-star-o"></i>
                                                        </div>
                                                        <span> {{ $company->companyEvents()->count() }} فعالية</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="content-box">
                                        <div class="content-header">
                                            <h3 class="title">
                                                <i class="la la-map-marker m-r5"></i>الموقع على
                                                الخريطة
                                            </h3>
                                        </div>
                                        <div class="content-body">
                                            <div id="map3" class="align-self-stretch" style="width: 100%; height: 300px">
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <!-- Side bar END -->
                        </div>
                    </div>

                    <div id="listing_photos" class="tab-pane">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="content-box">
                                    <div class="content-header">
                                        <h3 class="title">الصور</h3>
                                    </div>
                                    <div class="content-body">
                                        <div class="  widget widget_gallery gallery-grid-4  lightgallery ">
                                            <ul>
                                                @foreach($company->galery as $key => $media) 
                                                    <li> 
                                                        <span data-exthumbimage="{{ $media->getUrl('preview2') }}"
                                                            data-src="{{ $media->getUrl('preview2') }}"
                                                            class="check-km" title="Light Gallery Grid 1">
                                                            <img src="{{ $media->getUrl('preview2') }}" />
                                                        </span>
                                                    </li>
                                                @endforeach 
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="listing_videos" class="tab-pane">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="content-box">
                                    <div class="content-header">
                                        <h3 class="title">الفيديوهات</h3>
                                    </div>
                                    <div class="content-body">
                                        <div class="widget widget_video video-grid-4">
                                            <ul>
                                                @foreach($company->videos as $key => $media) 
                                                    <li>
                                                        <div class="dlab-post-thum video-bx">
                                                            <img src="{{ asset('frontend/images/gallery/pic1.jpg') }}" alt="" />
                                                            <div class="video-play-icon">
                                                                <a href="{{ $media->getUrl() }}"
                                                                    class="popup-youtube video"><i
                                                                        class="la la-play"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach 
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="listing_events" class="tab-pane">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="content-box">
                                    <div class="content-header">
                                        <h3 class="title">الفعاليات</h3>
                                    </div>
                                    <div class="content-body">
                                        <div class="row">
                                            
                                            @foreach($company->companyEvents()->orderBy('created_at','desc')->get() as $event)
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="listing_cader" class="tab-pane">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="content-box">
                                    <div class="content-header">
                                        <h3 class="title">الكوادر</h3>
                                    </div>
                                    <div class="content-body">
                                        <div class="row">
                                            @foreach($company->cawaders as $cader)
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->

@endsection

@section('scripts')
    
    <script src="{{ asset('frontend/plugins/lightgallery/js/lightgallery-all.min.js') }}"></script>
    <!-- Lightgallery --> 
    <script src="{{ asset('frontend/js/jquery.star-rating-svg.js') }}"></script>
    <!-- STAR RATING SVG -->
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBjirg3UoMD5oUiFuZt3P9sErZD-2Rxc68&sensor=false"></script>
    <!-- GOOGLE MAP -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Google API For Recaptcha  -->
    <script src="{{ asset('frontend/js/map.script.js') }}"></script>
    <!-- CONTACT JS  -->
    <script src="{{ asset('frontend/plugins/calendar/moment.min.js') }}"></script>
    <!-- SORTCODE FUCTIONS  -->
    <script src="{{ asset('frontend/plugins/calendar/calendar.js') }}"></script>
    <!-- SORTCODE FUCTIONS  -->
    <script src="{{ asset('frontend/plugins/particles/particles.js') }}"></script>
    <script src="{{ asset('frontend/plugins/particles/particles.app.js') }}"></script>
    <script>
    $(document).ready(function () {
        $("#calendar").fullCalendar({
        header: {
            left: "prev",
            center: "title",
            right: "next",
        },
        defaultDate: "2020-12-12",
        navLinks: true, // can click day/week names to navigate views
        businessHours: false, // display business hours
        editable: false,
        });
    });
    </script>
@endsection
