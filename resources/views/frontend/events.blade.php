@extends('layouts.frontend')

@section('content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle" style="background-image: url('{{ asset('frontend/images/banner/bnr1.jpg') }}')">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">الفعاليات</h1>
                    <p>{{$setting->events_text }}</p>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                            <li>الفعاليات</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Contact area -->
        <div class="content-block">
            <div class="section-full content-inner bg-white">
                <div class="container">
                    <div class="listing-filter m-b40">
                        <div class="d-flex">
                            <div class="ml-auto">
                                <form action="" id="search_events"> 
                                    <ul class="filter m-b0">
                                        <li>
                                            <select name="specialization_id" id="specialization_id">
                                                <option value="">فئة الفعالية</option>
                                                @foreach(\App\Models\Specialization::get() as $specialization)
                                                    <option value="{{ $specialization->id }}" @isset($specialization_id) @if($specialization_id == $specialization->id) selected @endif @endisset>{{ $specialization->name_ar }}</option> 
                                                @endforeach
                                            </select>
                                        </li>
                                        <li>
                                            <select name="city_id" id="city_id">
                                                <option value="">مكان الفعالية</option>
                                                @foreach(\App\Models\City::get() as $city)
                                                    <option value="{{ $city->id }}" @isset($city_id) @if($city_id == $city->id) selected @endif @endisset>{{ $city->name_ar }}</option> 
                                                @endforeach
                                            </select>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($events as $event)
                            <div class="col-lg-4 col-md-6 col-sm-6 m-b30">
                                <div class="listing-bx overlap">
                                    <div class="listing-media">
                                        <a href="#">
                                            <img src="{{ $event->photo ? $event->photo->getUrl('preview3') : '' }}" alt="" />
                                        </a>
                                    </div>
                                    <div class="listing-info">
                                        <ul class="featured-star">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <h3 class="title">
                                            <a href="{{ route('frontend.event',$event->id) }}">{{ $event->title ?? '' }}</a>
                                        </h3>
                                        <ul class="featured-category">  
                                            <li><i class="fa fa-calendar"></i> {{ $event->start_date ?? ''}}</li>
                                            <li><i class="fa fa-map-o"></i> {{ $event->city->name_ar ?? ''}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                    </div>
                    <!-- Pagination start --> 
                    {{ $events->links() }}
                    <!-- Pagination END -->
                </div>
            </div>
        </div>
        <!-- Contact area END -->
    </div>
    <!-- Content END-->
@endsection

@section('scripts')
    <script>
        $('#specialization_id').on('change',function(){
            $('#search_events').submit();
        });
        $('#city_id').on('change',function(){
            $('#search_events').submit();
        });
    </script>
@endsection