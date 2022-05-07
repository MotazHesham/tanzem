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
    
    
    <!-- FONT AWSOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.css" integrity="sha512-1hsteeq9xTM5CX6NsXiJu3Y/g+tj+IIwtZMtTisemEv3hx+S9ngaW4nryrNcPM4xGzINcKbwUJtojslX2KG+DQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
      <!-- FONT AWSOME -->
    
    <!-- Owl Carousel -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
  
    <!-- Owl Carousel End-->
  

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/templete.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/stylesheet.css') }}" type="text/css" charset="utf-8" />
    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/skin/skin-1.css') }}" />
    <style>
        .header-transparent .header-nav .nav > li > a{
            color:black;
            font-size:23px;
        }
    </style>
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
                <div class="main-bar clearfix" style="background:white">
                    <div class="container clearfix">
                        <!-- website logo -->
                        <div class="logo-header mostion">
                            <a href="{{ route('frontend.home') }}" class="logo-1"><img src="{{ asset('frontend/images/logo-black-2.png') }}" style="height:100px" alt="" /></a>
                            <a href="{{ route('frontend.home') }}" class="logo-2"><img src="{{ asset('frontend/images/logo-black-1.png') }}" style="height:100px" alt="" /></a>
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
                                @if(Auth::user()->user_type=='staff'||Auth::user()->user_type=='companiesAndInstitution')
                                    <a href="{{ route('login') }}" class="site-button radius-xl m-l10"><i
                                        class="ti-import m-r5 rotate90" style="font-size: 18px;"></i>لوحة التحكم</a>
                                @else
                                <a href="#"  onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="site-button radius-xl m-l10"><i
                                        class="ti-import m-r5 rotate90" style="font-size: 18px;"></i>تسجيل الخروج </a>
                                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
                                @endif
                                @else 
                                    <a href="{{ route('login') }}" class="site-button radius-xl m-l10" style="font-size: 18px;"><i
                                            class="ti-import m-r5 rotate90"></i> الدخول للمنصة</a>
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
        <div class="fixed-whatsapp">
           <a href="https://wa.me/{{$setting->phone_1}}" target="_blank">
             <i class="fa-brands fa-whatsapp"></i>
            </a> 
        </div>
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
                                  <!--  <li>
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
                                    </li>-->
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
                                    <li><a href="tel:{{ $setting->phone_1}} ">
                                        <i class="ti-mobile"></i><strong>التليفون</strong>{{ $setting->phone_1 ?? '' }} (24/7
                                        Support)
                                    </a>
                                    </li>
                                    <li><a href="mailto:{{ $setting->email_1}}">
                                        <i class="ti-email"></i><strong>
                                            الايميل
                                        </strong>{{ $setting->email_1 ?? '' }}
                                    </a>
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
                            <span class="fbottom-like">© 2022 جميع الحقوق محفوظة لشركة تمكين الوطنية 
                                <a class="like-btn" href="javascript:void(0)"><i class="fa fa-heart"></i></a>
                                تصميم وتنفيذ
                                <a href="https://alliance-sa.com/">شركة تحالف الرؤى</a> 
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
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
        $('.home-slider').owlCarousel({
            center: true,
            loop:true,
            margin:0,
            animateOut: 'fadeOut',
            autoplay:true,
            autoplayTimeout:3000,
            nav:true,
            dots:false,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            rtl:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1120:{
                    items:1
                }
            }
        })
        </script>
        
         <script>
        $('.events-slider').owlCarousel({
            center: true,
            loop:true,
            margin:20,
            autoplay:true,
            autoplayTimeout:3000,
            nav:true,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            dots:true,
            rtl:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1120:{
                    items:4
                }
            }
        })
        </script>


         
         <script>
        $('.vid-slider').owlCarousel({
            center: true,
            loop:true,
            margin:20,
            autoplay:true,
            autoplayTimeout:3000,
            nav:true,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            autoplayHoverPause:true,
            dots:true,
            rtl:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1120:{
                    items:4
                }
            }
        })
        </script>
    <!-- Owl Carousel -->


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
