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
                </div>
            </div>
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection 