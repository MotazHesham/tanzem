@extends('layouts.frontend')

@section('content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle"
            style="background-image:url('{{ asset('frontend/images/banner/bnr1.jpg') }}');">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">منظمي الفعاليات</h1>
                    <p>{{ $setting->organization_text ?? '' }}</p>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                            <li> منظمي الفعاليات </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="section-full content-inner">
            <div class="container">
                <section id="home--organizers">



                    <div class="container"> 
                        <div class="row border-bottom">

                            @foreach ($companiesAndInstitution as $company)
                                <div class="col-md-3">
                                    <a href="{{ route('frontend.organization', $company->id) }}">
                                        <div class="h-organizer wow bounceIn" data-wow-duration="1s" data-wow-delay="1s "
                                            style=" visibility: visible; animation-duration: 1s; animation-delay: 1s; animation-name: bounceIn; ">
                                            @php
                                                if ($company->user && $company->user->photo) {
                                                    $company_image = $company->user->photo->getUrl('preview2');
                                                } else {
                                                    $company_image = '';
                                                }
                                            @endphp
                                            <img src="{{ $company_image }}" class="img-fluid" />
                                            <p>{{ $company->user->name ?? '' }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach 
                        </div> 
                        <!-- Pagination start -->
                            {{ $companiesAndInstitution->links() }}
                        <!-- Pagination END -->
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!-- Content END-->
@endsection
