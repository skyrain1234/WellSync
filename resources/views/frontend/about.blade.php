@extends('frontend.layouts.master')

@section('title')
WellSync || About
@endsection

@section('link')
    <!-- slick.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/product-detail.css') }}" />
    <style>

    </style>
@endsection

@section('content')

<!-- BREADCRUMB START -->
<section id="product__breadcrumb" style="background: url('{{ asset('frontend/images/product_detail_bg.jpg') }}')" class="wow animate__animated animate__fadeIn "  data-wow-duration="1s" data-wow-iteration="1">
    <div class="product_breadcrumb_overlay">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-5  wow animate__animated animate__fadeInLeft "  data-wow-duration="1s" data-wow-iteration="1">
                    <h2 class="text-white fw-bold">關於我們</h2>
                    <nav aria-label="breadcrumb"  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);">
                        <ol class="breadcrumb" style="justify-content: flex-start   ;" >
                            <li class="breadcrumb-item "><a href="{{ route('home.index') }}" class=" text-white">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">關於我們</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-5 d-none d-md-block text-end  wow animate__animated animate__fadeInDown "  data-wow-duration="1s" data-wow-iteration="1">
                    <em class="h2 text-white ">About</em>
                    <div class=" my-2">
                        <span class="h5">
                            <em class="text-white">Our Story</em>
                            <p  calss="text-end" style="background-color: #C5C4C1; height: 2px; width: 24%;margin-left: auto;"></p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</section>
<!-- BREADCRUMB END -->    
<!-- main_area -->
<main style="">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6 wow animate__animated animate__fadeIn "  data-wow-duration="1s" data-wow-iteration="1">
                <div class="titleBox">
                    <div class="mt-5 text-title" style="font-size:26px; line-height: 1em;">
                        <span style="font-size:36px;">
                            <strong>科學營養 與 健康守護</strong>
                        </span>
                        <div class="text-sub_title">
                            <span class="h5">
                                <em>Science & Wellness</em>
                                <p style="background-color: #C5C4C1; height: 2px; width: 80%;"></p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="my-4 text-black" style="font-size:20px;">
                    <p>
                        <p>WellSync 以「精準營養」為核心理念，嚴選全球優質原料，結合最新科學研究，打造最適合個人體質的保健食品。我們的配方經過嚴格測試，確保安全、有效，幫助每位使用者提升健康。</p>
                        <p>我們致力於提供全方位的營養解決方案，無論是日常保健、增強免疫力，還是專業運動補給，都能找到適合您的產品。</p>
                    </p>
                </div>    
            </div>
            <div class="col-md-6 bg-cover my-3 wow animate__animated animate__fadeIn "  data-wow-duration="1s" data-wow-iteration="1" style="background-image: url({{ asset('uploads/about/about1.jpg') }}); height: 500px;">
            </div>
        </div>
        <div class="row d-flex align-items-center justify-content-center flex-row-reverse">
            <div class="col-md-6 wow animate__animated animate__fadeIn "  data-wow-duration="1s" data-wow-iteration="1">
                <div class="titleBox">
                    <div class="mt-5 text-title" style="font-size:26px; line-height: 1em;">
                        <span style="font-size:36px;">
                            <strong>明星產品</strong>
                        </span>
                        <div class="text-sub_title">
                            <span class="h5">
                                <em>Top Supplements</em>
                                <p style="background-color: #C5C4C1; height: 2px; width: 80%;"></p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="my-4 text-black" style="font-size:20px;">
                    <p>
                        <p>WellSync 提供多種專業配方，適合不同健康需求：</p>
                        <br>
                        <div>🔹 **深海魚油**：富含 Omega-3，有助於大腦與心血管健康。</div>
                        <div>🔹 **高濃縮螯合鈣**：專為關節保護設計，減少運動不適。</div>   
                        <div>🔹 **綜合維他命**：補足現代人缺乏關鍵維生素礦物質。</div>
                    </p>
                </div>    
            </div>
            <div class="col-md-6 bg-cover my-3 wow animate__animated animate__fadeIn "  data-wow-duration="1s" data-wow-iteration="1" style="background-image: url({{ asset('uploads/about/about2.jpg') }});height: 500px;">
            </div>
        </div>
    </div>
</main>

@endsection