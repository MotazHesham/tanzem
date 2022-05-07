@extends('layouts.frontend')

@section('content')

    <head>
        <style>
            .conditions-section p {
                max-width: 80%;
                font-weight: bold;
                color: #512d6d;
            }
            ul.conditions-list ul {
                padding-right: 30px;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .conditions-section ul {
                max-width: 85%;
            }
            ul.conditions-list li {
                padding: 5px 0px;
            }
            .conditions-section ul.conditions-list ol {
                padding-right: 30px;
                margin: 10px 0px;
            }
            
            @media (max-width:992px){
            .conditions-section p {
                max-width: 100%;
            }
            ul.conditions-list ul {
                padding-right: 20px;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .conditions-section ul {
                max-width: 100%;
            }
            ul.conditions-list li {
                padding: 5px 0px;
            }
            .conditions-section ul.conditions-list ol {
                padding-right: 20px;
                margin: 10px 0px;
            }
        }
            
        </style>
    </head>
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle" style="background-image: url('{{ asset('frontend/images/banner/bnr1.jpg') }}')">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">الشروط والأحكام</h1>
                    <p>
                      
                    </p>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                            <li>الشروط والأحكام</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="section-full conditions-section content-inner">
            <div class="container">
              <p>يخضع استخدامك لهذا الموقع الألكتروني والخدمات المتوفرة فيه لشروط وأحكام الاستخدام لذا يرجى قراءتها بعناية قبل الدخول للموقع لأن دخولك يعتبر قبولاً غير مشروط وتقيداً منك بشروط الاستخدام التالية :</p>
            <ul class="conditions-list">
             
                <li>
                   <?php echo  $terms ?>
                 
                </li>
                
                </ul>
            </div>
        </div>
    </div>
    <!-- Content END-->
@endsection
