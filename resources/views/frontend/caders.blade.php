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
          <!-- Contact area -->
        <div class="content-block">
            <div class="section-full content-inner bg-white">
                <div class="container">
                    <div class="listing-filter m-b40">
                        <div class="d-flex">
                            <div class="ml-auto">
                                <form action="" id="search_cader"> 
                                    <ul class="filter m-b0">
                                        <li>
                                            <select name="specialization_id" id="specialization_id">
                                                <option value="">
                                                   التخصص
                                                </option>
                                                @foreach(\App\Models\CawaderSpecialization::get() as $specialization)
                                                    <option value="{{ $specialization->id }}" @isset($specialization_id) @if($specialization_id == $specialization->id) selected @endif @endisset>{{ $specialization->name_ar }}</option> 
                                                @endforeach
                                                   
                                              
                                            </select>
                                        </li>
                                        <li>
                                            <select name="skill_id" id="skill_id">
                                                <option value="">
                                                المهارات
                                                </option>
                                                
                                                @foreach(\App\Models\Skill::get() as $skill)
                                                <option value="{{ $skill->id }}" @isset($skill_id) @if($skill_id == $skill->id) selected @endif @endisset>{{ $skill->name_ar }}</option> 
                                            @endforeach
                                            </select>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($cawaders as $cader)
                            <div class="col-lg-4 col-md-6 col-sm-6 m-b30">
                                <div class="listing-bx overlap">
                                    <div class="listing-media">
                                        <a href="#">
                                            @php
                                            if($cader->user && $cader->user->photo){
                                                $cader_image = $cader->user->photo->getUrl('preview2');
                                            }else{
                                                $cader_image = '';
                                            } 
                                            $now_date = date('Y-m-d',strtotime('now'));
                                           $event = $cader->events()->where('status','active')->where('start_date','<=',$now_date)->where('end_date','>=',$now_date)->get()->first(); 
                       
                                        @endphp
                                            <img src="{{$cader_image}}" />
                                        </a>
                                    </div>
                                    <div class="listing-info">
                                        
                                        <h3 class="title team-one__name">
                                            <a href="{{ route('frontend.cader',$cader->id)}}">{{ $cader->user->name ?? '' }}</a>
                                        </h3>
                                        <div class="cader-member-info-wrap">
                                        <p class="experience-years">
                                            سنوات الخبرة:
                                            <span>{{$cader->experience_years }} سنوات</span>
                                        </p>
                                        <p class="cader-status"> @if($event)
                                            مشارك الان في فعاليات   
                                           
                                            @else 
                                            متاح الأن
                                            @endif</p>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                    </div>
                    {{ $cawaders->links() }}
                    <!-- Pagination start --> 
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
            $('#search_cader').submit();
        });
        $('#skill_id').on('change',function(){
            $('#search_cader').submit();
        });
    </script>
@endsection