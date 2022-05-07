@extends('layouts.frontend') 

@section('content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle" style="background-image: url('{{ asset('frontend/images/banner/bnr1.jpg') }}')">
            <div class="container"> 
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <div class="container">
                <div class="dlab-post-media m-b50">
                    <a href="javascript:void(0);"><img src="{{ $news->photo ? $news->photo->getUrl() : '' }}" alt="" /></a>
                </div>
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-xl-8 col-lg-7 col-md-12 p-b30">
                        <div class="section-head text-black mb-3">
                            <h2 class="box-title">{{ $news->title ?? ''}}</h2>
                            <p class="m-b0">
                                <?php echo nl2br($news->long_description ?? ''); ?>
                            </p>
                        </div>    

                        <!-- blog END -->
                    </div>
                    <!-- Left part END -->
        <div class="col-xl-4 col-lg-5 col-md-12 sticky-top p-b30">
            <aside class="side-bar listing-side-bar">
                <div class="widget widget_share">
                    <h4 class="m-b10">مشاركة الخبر</h4>
                    <div class="dlab-separator bg-primary m-b20"></div>
                    <ul class="list-inline m-a0 text-white">
                        <li>
                            <a href="http://www.facebook.com/sharer.php?u={{ route('frontend.news',$news->id) }}" class="site-button facebook circle"><i
                                    class="fa fa-facebook"></i></a>
                        </li>
                       <!-- <li>
                            <a href="mailto:?Subject={{ $news->title }}&Body=I%20saw%20this%20and%20thought%20of%20you!%20 {{ route('frontend.event',$news->id) }}" class="site-button google-plus circle"><i
                                    class="fa fa-google-plus"></i></a>
                        </li>-->
                        <li>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ route('frontend.news',$news->id) }}" class="site-button linkedin circle"><i
                                    class="fa fa-linkedin"></i></a>
                        </li>
                        {{-- <li>
                            <a href="javascript:void(0);" class="site-button instagram circle"><i
                                    class="fa fa-instagram"></i></a>
                        </li> --}}
                        <li>
                            <a href="http://twitter.com/share?url={{ route('frontend.news',$news->id) }}"&text={{ $news->title }}&hashtags=#" class="site-button twitter circle"><i
                                    class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
        <!-- contact area END -->
    </div>
            </div>
        </div>
        <!--<div class="container-fluid">-->
            
            
        <!--<div class="event-image-wrap">-->
        <!--                    <div class="container">-->
        <!--                    <h3 class="font-26">الصور</h3>-->
        <!--                    </div>-->
        <!--                     <div id="event-slider" class="events-slider owl-carousel owl-theme owl-container">-->
        <!--                        <div class="item">-->
        <!--                            <img class="events-pic" src="">-->
        <!--                        </div>  -->
                                   
        <!--                    </div> -->
        <!--        </div>-->
                
        <!--        <div class="video-wrap">-->
        <!--                    <div class="container">-->
        <!--                    <h3 class="font-26">مقاطع الفيديو</h3>-->
        <!--                    </div>-->
        <!--                     <div id="video-slider" class="vid-slider owl-carousel owl-theme owl-container">-->
        <!--                        <div class="item">-->
        <!--                            <video width="100%" height="240" controls>-->
        <!--                                      <source src="" type="video/mp4">-->
        <!--                                    Your browser does not support the video tag.-->
        <!--                            </video>-->
        <!--                        </div>-->
                             
        <!--                    </div>  -->
        <!--        </div>-->
        <!--</div>-->
        </div>
    <!-- Content END-->
@endsection 