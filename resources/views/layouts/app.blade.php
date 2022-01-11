<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}" />

    <!-- PAGE TITLE HERE -->
    <title> تنظيم </title>


    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/templete.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/stylesheet.css') }}" type="text/css" charset="utf-8" />

    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/skin/skin-1.css') }}">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" /> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

</head>

<body id="bg">
    <div id="loading-area"></div>
    <div class="page-wraper">

        <!-- Content -->
        <div class="page-content dlab-login bg-primary"
            style="background-image: url('{{ asset('frontend/images/bg7.jpg') }}'); background-position: top right;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 login-form-box">
                        <div class="login-form">
                            <div class="logo">
                                <a href="{{ route('frontend.home' )}}"><img src="{{ asset('frontend/images/logo-black-1.png') }}"
                                        alt="" /></a>
                            </div>
                            @if ($errors->count() > 0)
                                <div class="alert alert-danger"> 
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach 
                                </div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="content-info">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content END-->
        <button class="scroltop fa fa-chevron-up"></button>
    </div>
</body>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')
<!-- CONTACT JS  -->
</body>

</html>
