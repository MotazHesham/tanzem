<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no" />

    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}" />
    <!-- PAGE TITLE HERE -->
    <title>تنظيم</title>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/templete.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/stylesheet.css') }}" type="text/css" charset="utf-8" />
    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/skin/skin-1.css') }}" />

    @yield('styles')

</head>
@php
    $setting = \App\Models\Setting::first();
@endphp
<body id="bg">
    <div id="loading-area"></div>
    <div class="page-wraper">
        <!-- header -->
        <header class="site-header header-transparent mo-left">
            <!-- main header -->
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix">
                    <div class="container clearfix">
                        <!-- website logo -->
                        <div class="logo-header mostion">
                            <a href="{{ route('frontend.home') }}" class="logo-1"><img src="{{ asset('frontend/images/logo-black-1.png') }}" alt="" /></a>
                            <a href="{{ route('frontend.home') }}" class="logo-2"><img src="{{ asset('frontend/images/logo-black-2.png') }}" alt="" /></a>
                        </div>
                        <!-- nav toggle button -->
                        <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                            data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <!-- extra nav -->
                        <div class="extra-nav">
                            <div class="extra-cell">
                                @auth 
                                    <a href="{{ route('login') }}" class="site-button radius-xl m-l10"><i
                                        class="ti-import m-r5 rotate90"></i>لوحة التحكم</a>
                                @else 
                                    <a href="{{ route('login') }}" class="site-button radius-xl m-l10"><i
                                            class="ti-import m-r5 rotate90"></i> تسجيل الدخول</a>
                                @endauth
                            </div>
                        </div>
                        <!-- main nav -->
                        <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                            <ul class="nav navbar-nav">
                                <li class="down"><a href="{{ route('frontend.home') }}">الرئيسية </a></li>
                                <li><a href="{{ route('frontend.organizations') }}">إدارة الحشود </a></li>
                                <li><a href="{{ route('frontend.events') }}"> الفعاليات</a></li>
                                <li><a href="{{ route('frontend.caders') }}"> الكوادر</a></li>
                                <li><a href="{{ route('frontend.contactus') }}">تواصل معنا</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main header END -->
        </header>
        <!-- header END -->

        @yield('content')

        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12">
                            <div class="widget">
                                <img src="{{ asset('frontend/images/logo-black-1.png') }}" class="m-b15" alt="" width="80" />
                                <p class="text-capitalize m-b20"> 
                                    <?php echo nl2br($setting->about_us ?? ''); ?>
                                </p>
                                <div class="subscribe-form m-b20">
                                    <form  action="{{ route('frontend.subscription') }}" method="post">
                                        @csrf 
                                        <div class="input-group">
                                            <input name="email" required="required" class="form-control"
                                                placeholder="ادخل البريد الألكتروني الخاص بك" type="email" />
                                            <span class="input-group-btn">
                                                <button name="submit" value="Submit" type="submit"
                                                    class="site-button radius-xl">
                                                    اشترك الان
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <ul class="list-inline m-a0">
                                    <li>
                                        <a href="{{ $setting->facebook ?? ''}}" class="site-button facebook circle"><i
                                                class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->gmail ?? ''}}" class="site-button google-plus circle"><i
                                                class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->linkedin ?? ''}}" class="site-button linkedin circle"><i
                                                class="fa fa-linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->instagram ?? ''}}" class="site-button instagram circle"><i
                                                class="fa fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->twitter ?? ''}}" class="site-button twitter circle"><i
                                                class="fa fa-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-12 col-12">
                            <div class="widget border-0">
                                <h5 class="m-b30 text-white">روابط تهمك</h5>
                                <ul class="list-2 list-line">
                                    @foreach(\App\Models\ImportantLink::get() as $link)
                                        <li><a href="{{ $link->link ?? '' }}">{{ $link->text ?? '' }}</a></li> 
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
                            <div class="widget widget_getintuch">
                                <h5 class="m-b30 text-white">تواصل معنا</h5>
                                <ul>
                                    <li>
                                        <i class="ti-location-pin"></i><strong>العنوان</strong>
                                        {{ $setting->address ?? '' }}
                                    </li>
                                    <li>
                                        <i class="ti-mobile"></i><strong>التليفون</strong>{{ $setting->phone_1 ?? '' }} (24/7
                                        Support)
                                    </li>
                                    <li>
                                        <i class="ti-email"></i><strong>اللايميل</strong>{{ $setting->email_1 ?? '' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <span class="fbottom-like">© 2022 جميع الحقوق محفوظة
                                <a class="like-btn" href="javascript:void(0)"><i class="fa fa-heart"></i></a>
                                تصميم وبرمجة
                                <a href="https://alliance-sa.com/">تحالف الرؤى</a> 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer END-->
        <button class="scroltop fa fa-chevron-up"></button>
    </div>

    @include('sweetalert::alert')


    <!-- JAVASCRIPT FILES ========================================= -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <!-- JQUERY.MIN JS -->
    <script src="{{ asset('frontend/plugins/bootstrap/js/popper.min.js') }}"></script>
    <!-- BOOTSTRAP.MIN JS -->
    <script src="{{ asset('frontend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- BOOTSTRAP.MIN JS -->
    <script src="{{ asset('frontend/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <!-- FORM JS -->
    <script src="{{ asset('frontend/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <!-- FORM JS -->
    <script src="{{ asset('frontend/plugins/magnific-popup/magnific-popup.js') }}"></script>
    <!-- MAGNIFIC POPUP JS -->
    <script src="{{ asset('frontend/plugins/counter/waypoints-min.js') }}"></script>
    <!-- WAYPOINTS JS -->
    <script src="{{ asset('frontend/plugins/counter/counterup.min.js') }}"></script>
    <!-- COUNTERUP JS -->
    <script src="{{ asset('frontend/plugins/imagesloaded/imagesloaded.js') }}"></script>
    <!-- IMAGESLOADED -->
    <script src="{{ asset('frontend/plugins/masonry/masonry-3.1.4.js') }}"></script>
    <!-- MASONRY -->
    <script src="{{ asset('frontend/plugins/masonry/masonry.filter.js') }}"></script>
    <!-- MASONRY -->
    <script src="{{ asset('frontend/plugins/rangeslider/rangeslider.js') }}"></script>
    <!-- RANGESLIDER -->
    <script src="{{ asset('frontend/plugins/owl-carousel/owl.carousel.js') }}"></script>
    <!-- OWL SLIDER -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <!-- CUSTOM FUCTIONS  -->
    <script src="{{ asset('frontend/js/dz.carousel.js') }}"></script>
    <!-- SORTCODE FUCTIONS  -->
    <script src="{{ asset('frontend/js/dz.ajax.js') }}"></script>
    <!-- CONTACT JS  -->

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    <script>
        function showFrontendAlert(type, title, message){
            swal({ 
                title: title,
                text: message,
                type: type, 
                showConfirmButton: 'Okay',
                timer: 3000
            });
        }

        function deleteConfirmation(route, div = null, partials = false) { 
            swal({
                title: "{{trans('global.flash.delete_')}}",
                text: "{{trans('global.flash.sure_')}}",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "{{trans('global.flash.yes_')}}",
                cancelButtonText: "{{trans('global.flash.no_')}}",
                reverseButtons: !0
            }).then(function (e) {

                if (e.value === true) { 

                    $.ajax({
                        type: 'DELETE',
                        url: route, 
                        data: { _token: '{{ csrf_token() }}', partials: partials}, 
                        success: function (results) { 
                            if(div != null){ 
                            showFrontendAlert('success', '{{trans('global.flash.deleted')}}', '');
                            $(div).html(null);
                            $(div).html(results);
                            }else{
                            location.reload(); 
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function (dismiss) {
                return false;
            })
        }
    </script>
    @yield('scripts')

</body>

</html>
