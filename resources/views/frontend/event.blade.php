@extends('layouts.frontend')

@section('styles') 
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/star-rating-svg.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <style>
              .customer-opinins-div {
       border: 7px solid #fff;
       height: 160px;
       display: flex;
       justify-content: center;
       align-items: center;
   }
   
   .customers-opinins, .customers-opinins a {
       font-size: 21px;
       color: #005376;
       font-weight: 500;
       text-align: center;
       transition: all .2s ease-in-out;
   }
   .customers-opinins a:hover {
       color: #B896A2;
       transform: scale(1.1);
       transition: all .2s ease-in-out;
   }
   .rating.rating2 {
       text-align: center;
   }
   
   label {
     cursor: pointer;
   }
   
   svg {
     width: 3rem;
     height: 3rem;
     padding: 0.15rem;
   }
   
   
   /* hide radio buttons */
   
   input[name="star"] {
     display: inline-block;
     width: 0;
     opacity: 0;
     margin-left: -2px;
   }
   
   /* hide source svg */
   
   .star-source {
     width: 0;
     height: 0;
     visibility: hidden;
   }
   
   
   /* set initial color to transparent so fill is empty*/
   
   .star {
     color: transparent;
     transition: color 0.2s ease-in-out;
       width: 24px;
   }
   
   
   /* set direction to row-reverse so 5th star is at the end and ~ can be used to fill all sibling stars that precede last starred element*/
   
   .star-container {
     display: flex;
     flex-direction: row;
     justify-content: center;
   }
   
   label:hover ~ label .star,
   svg.star:hover,
   input[name="star"]:focus ~ label .star,
   input[name="star"]:checked ~ label .star {
     color: #ffc600;
   }
   
   input[name="star"]:checked + label .star {
     animation: starred 0.5s;
   }
   
   input[name="star"]:checked + label {
     animation: scaleup 1s;
   }
   
            </style>
    @endsection

@section('content')

    <!-- Content -->
    <div id="event_page" class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle" style="background-image: url('{{ asset('frontend/images/banner/bnr1.jpg') }}')">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <div class="wonder-bx text-white">
                        @php
                            if($event->company && $event->company->user && $event->company->user->photo){
                                $company_image = $event->company->user->photo->getUrl('preview');
                            }else{
                                $company_image = '';
                            }
                        @endphp
                        <div class="wonder-theme">
                            <img src="{{ $company_image }}" class="rounded-circle" />
                            <p>{{ $event->company->user->name ?? '' }}</p>
                        </div> 
                        <div class="wonder-price">
                            <p>السعر</p>
                            <h3 class="m-b0">{{ $event->cost ?? ''}} ريال سعودي - للفرد</h3>
                        </div>
                        <div class="wonder-btn">
                            <a href="javascript:void(0);" class="site-button button-lg radius-no text-uppercase">احجز الان
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
                            <h2 class="box-title">{{ $event->title ?? '' }}</h2>
                            <p class="m-b0">
                                <?php echo nl2br($event->description ?? ''); ?>
                            </p>
                            <input type="hidden" value="{{$event->latitude}}" name="latitude" id="latitude">
                            <input type="hidden" value="{{$event->longitude}}" name="longitude" id="longitude">
                        </div>
                        <div class="dlab-divider bg-gray-dark"></div>
                        <div class="widget widget_getintuch widget_listing">
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker text-primary"></i>
                                    <p class="m-b0">{{ $event->city->name_ar ?? '' }}</p>
                                </li>
                                <li>
                                    <i class="fa fa-phone text-primary"></i>
                                    <a style="color: #212529;" href="tel:{{ $event->company->user->phone ?? ''}}"><p class="m-b0">{{ $event->company->user->phone ?? ''}}</p></a> 
                                </li>
                                <li>
                                    <i class="fa fa-envelope text-primary"></i>
                                    <a style="color: #212529;" href="mailto:{{ $event->company->user->email ?? '' }}"><p class="m-b0">{{ $event->company->user->email ?? '' }}</p></a>
                                    <a  style="color: #212529;" href="{{ $event->company->user->website ?? '' }}"><p class="m-b0">{{ $event->company->user->website ?? '' }}</p></a>
                                </li>
                            </ul>
                        </div>
                        <div class="dlab-divider bg-gray-dark"></div> 

                        <div class="content-box">
                            <div class="content-header">
                                <h3 class="title">
                                    <i class="la la-list-ul"></i> الأقسام الداخلية
                                </h3>
                            </div>
                            <div class="content-body">
                                <ul id="iconbox" class="icon-box-list list-col-4">
                                    @foreach($event->eventBrands as $brand)
                                        <li>
                                    <button id="myBtn" type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal{{$brand->id}}">
                                        
                                        <a href="javascript:void(0);" class="icon-box-info">
                                                <div class="icon-cell bg-gray">
                                                    <img src="{{ $brand->photo ? $brand->photo->getUrl('thumb') : '' }}" class="rounded-circle" alt="">
                                                </div>
                                                <span>{{ $brand->title ?? ''}}</span>
                                            </a>
                                            
                                      </button>
                                       <!-- Modal pop up-->
                                        <div class="modal fade" id="exampleModal{{$brand->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ $brand->title ?? ''}}</h5>
                                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="brand-info">
                                                    <p class="brand_tit">الصورة</p>
                                                    <img src="{{ $brand->photo ? $brand->photo->getUrl('thumb') : '' }}" class="" alt="">
                                                    
                                                </div>
                                                <div class="brand-info">
                                                    <p class="brand_tit">المكان</p>
                                                                   <p>{{ $brand->zone_name ?? ''}}</p>
                                                 
                                                    </div>
                                               <div class="brand-info">      
                                                                                            <p class="brand_tit">التفاصيل</p>
                                                    <p>{{ $brand->description ?? ''}}</p>
                                                    </div>
                                              </div>
                                        
                                            </div>
                                          </div>
                                        </div>
                                            <!--<a href="javascript:void(0);" class="icon-box-info">-->
                                            <!--    <div class="icon-cell bg-gray">-->
                                            <!--        <img src="{{ $brand->photo ? $brand->photo->getUrl('thumb') : '' }}" class="rounded-circle" alt="">-->
                                            <!--    </div>-->
                                            <!--    <span>{{ $brand->title ?? ''}}</span>-->
                                            
                                            <!--</a>-->
                                        </li> 
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="dlab-divider bg-gray-dark"></div>
                        <div class="clear" id="comment-list">
                            <div class="comments-area" id="comments">
                                <h3 class="font-26">تقييم الزوار</h3>
                                <div class="clearfix">
                                    <!-- comment list END -->
                                    <ol class="comment-list">
                                        @foreach($event->reviews as $review)
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <div class="comment-author vcard">
                                                        @php
                                                            if($review->user && $review->user->photo){
                                                                $user_image = $review->user->photo->getUrl('preview');
                                                            }else{
                                                                $user_image =asset('frontend/images/user.png');
                                                            }
                                                        @endphp
                                                        <img class="avatar photo" src="{{ $user_image }}" alt="" />
                                                        <cite class="fn">{{ $review->user->name ?? '' }} </cite>
                                                    </div>
                                                    <div class="comment-meta">
                                                        <a href="javascript:void(0);">{{ $review->pivot->created_at ? date('F j, Y',strtotime($review->pivot->created_at)) : '' }}</a>
                                                        <ul class="featured-star">
                                                            @for($i = 0 ; $i < round($review->pivot->rate) ; $i++)
                                                                <li><i class="fa fa-star"></i></li>
                                                            @endfor 
                                                        </ul>
                                                    </div>
                                                    <p>
                                                        {{ $review->pivot->review ?? '' }}
                                                    </p>
                                                </div>
                                            </li> 
                                        @endforeach
                                    </ol>
                                    <!-- comment list END -->
                                    <!-- Form -->
                                           @auth
                                     <h3 class="font-26">اكتب تعليقك</h3>
                                    <div class="comment-respond" id="respond">
                                        <form class="comment-form" id="commentform" action="{{ route('frontend.event.rate') }}" method="Post">
                                            @csrf
                                            <div class="comment-form-rating">
                                                <div class="starrr"></div>
                                                <div class="rating-widget">
                                                    <!-- Rating Stars Box -->
                                                    <div class="star-source">
                                                        <svg>
                                                            <linearGradient x1="50%" y1="5.41294643%" x2="87.5527344%" y2="65.4921875%" id="grad">
                                                                <stop stop-color="#005376" offset="0%"></stop>
                                                            </linearGradient>
                                                            <symbol id="star" viewBox="153 89 106 108">
                                                                <polygon id="star-shape" stroke="url(#grad)" stroke-width="5" fill="currentColor"
                                                                    points="206 162.5 176.610737 185.45085 189.356511 150.407797 158.447174 129.54915 195.713758 130.842203 206 95 216.286242 130.842203 253.552826 129.54915 222.643489 150.407797 235.389263 185.45085">
                                                                </polygon>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                    @php
                                                        $rate = $event->reviews()->where('user_id',Auth::id())->first()->rate ?? 0;
                                                    @endphp
                                                    <div class="star-container">
                                                        <input type="radio" name="star" data-event_id="{{$event->id}}" id="five" value="5" @if($rate == 5) checked @endif/>
                                                        <label for="five">
                                                            <svg class="star">
                                                                <use xlink:href="#star" />
                                                            </svg>
                                                        </label>
                                                        <input type="radio" name="star" data-event_id="{{$event->id}}" id="four" value="4" @if($rate == 4) checked @endif/>
                                                        <label for="four">
                                                            <svg class="star">
                                                                <use xlink:href="#star" />
                                                            </svg>
                                                        </label>
                                                        <input type="radio" name="star"  data-event_id="{{$event->id}}" id="three" value="3" @if($rate == 3) checked @endif/>
                                                        <label for="three">
                                                            <svg class="star">
                                                                <use xlink:href="#star" />
                                                            </svg>
                                                        </label>
                                                        <input type="radio" name="star" data-product_id="{{$event->id}}" id="two" value="2" @if($rate == 2) checked @endif/>
                                                        <label for="two">
                                                            <svg class="star">
                                                                <use xlink:href="#star" />
                                                            </svg>
                                                        </label>
                                                        <input type="radio" name="star" data-product_id="{{$event->id}}" id="one" value="1" @if($rate == 1) checked @endif/>
                                                        <label for="one">
                                                            <svg class="star">
                                                                <use xlink:href="#star" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                          
                                                </div>
                                            </div>
                                            <p class="comment-form-comment">
                                                <label for="comment">التعليقات</label>
                                                <textarea rows="8" name="comment" placeholder="من فضلك اكتب تعليقك"
                                                    id="comment" required></textarea>
                                            </p>
                                          <input type="hidden" value="{{$event->id}}" name="event_id">
                                            <p class="form-submit">
                                                <input type="submit" value="نشر التعليق" class="submit site-button"
                                                    id="submit" name="submit" />
                                            </p>
                                        </form>
                                    </div> 
                                
                                   @endauth
                                    <!-- Form -->
                                </div>
                            </div>
                        </div>
                        <!-- blog END -->
                    </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->
                    <div class="col-xl-4 col-lg-5 col-md-12 sticky-top p-b30">
                        <aside class="side-bar listing-side-bar">
                            <div class="widget widget_map">
                                <div id="map" class="m-b30 align-self-stretch" style="width: 100%; height: 400px"></div>
                               <!-- <a href="javascript:void(0)"
                                    class=" site-button button-lg radius-xl m-b30  text-uppercase ">الموقع
                                    على الخريطة</a>-->
                            </div>
                            {{-- <div class="widget widget_time">
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
                            </div> --}}
                            <div class="widget widget_share">
                                <h4 class="m-b10">مشاركة الفعالية</h4>
                                <div class="dlab-separator bg-primary m-b20"></div>
                                <ul class="list-inline m-a0 text-white">
                                    <li>
                                        <a href="http://www.facebook.com/sharer.php?u={{ route('frontend.event',$event->id) }}" class="site-button facebook circle"><i
                                                class="fa fa-facebook"></i></a>
                                    </li>
                                   <!-- <li>
                                        <a href="mailto:?Subject={{ $event->title }}&Body=I%20saw%20this%20and%20thought%20of%20you!%20 {{ route('frontend.event',$event->id) }}" class="site-button google-plus circle"><i
                                                class="fa fa-google-plus"></i></a>
                                    </li>-->
                                    <li>
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ route('frontend.event',$event->id) }}" class="site-button linkedin circle"><i
                                                class="fa fa-linkedin"></i></a>
                                    </li>
                                    {{-- <li>
                                        <a href="javascript:void(0);" class="site-button instagram circle"><i
                                                class="fa fa-instagram"></i></a>
                                    </li> --}}
                                    <li>
                                        <a href="http://twitter.com/share?url={{ route('frontend.event',$event->id) }}&text={{ $event->title }}&hashtags=#" class="site-button twitter circle"><i
                                                class="fa fa-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <!-- Side bar END -->
                </div>
            </div>
        </div>
        <!-- contact area END -->
            <div class="event-image-wrap">
                            <div class="container">
                            <h3 class="font-26">الصور</h3>
                            </div>
                             <div id="event-slider" class="events-slider owl-carousel owl-theme owl-container">
                                @foreach($event->photos as $key => $media)
                                <div class="item">
                                    <img class="events-pic" src="{{ $media->getUrl() }}">
                                </div>  
                                   
                               @endforeach
                            </div> 
                </div>
                
                <div class="video-wrap">
                            <div class="container">
                            <h3 class="font-26">مقاطع الفيديو</h3>
                            </div>
                            @foreach($event->videos as $key => $media)
                             <div id="video-slider" class="vid-slider owl-carousel owl-theme owl-container">
                                <div class="item">
                                    <video width="100%" height="240" controls>
                                              <source src="{{ $media->getUrl() }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                    </video>
                                </div>
                             
                            @endforeach
                            </div>  
                </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection


@section('scripts')
    
    <script src="{{ asset('frontend/js/jquery.star-rating-svg.js')}}"></script>
    <!-- STAR RATING SVG -->
    
    <!-- GOOGLE MAP -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Google API For Recaptcha  -->
    <script src="{{ asset('frontend/js/map.script.js') }}"></script>
    <!-- CONTACT JS  -->
    <script type="text/javascript">

        var map;
        var lat = parseFloat(document.getElementById('latitude').value);
        var lng = parseFloat(document.getElementById('longitude').value);
       
           function initAutocomplete() {
                  var pos = {lat:  lat ,  lng:lng };
                  map = new google.maps.Map(document.getElementById('map'), {
                      zoom: 12,
                      center: pos
                  });
              infoWindow = new google.maps.InfoWindow;
                  geocoder = new google.maps.Geocoder();
                  marker = new google.maps.Marker({
                      position: pos,
                      map: map,
                      title: ''
                  });
                  infoWindow.setContent('موقع الفعاليه');
                  infoWindow.open(map, marker);
          }
      </script>
      
      <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9D9VYMWp1sTVSDnGToKdKN4RnEtfyuAY&callback=initAutocomplete">
      </script>
       
      @endsection
