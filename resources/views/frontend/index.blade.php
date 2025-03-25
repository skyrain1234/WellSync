@extends('frontend.layouts.master')

<!-- 網頁標題 -->
@section('title')
    WellSync - 健康管理
@endsection
@section('link')
    <!-- 首頁css -->
         <!-- slick.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/slick/slick-theme.css') }}" />
    <link rel="stylesheet" href="{{asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/values_style.css')}}">
    
    <style>
        body {
            padding-top: 0px; /* 確保內容往下移動 */
        }
        .custom-card {
            background-color: rgba(163, 163, 163, 0.05);
            transition: background-color 0.3s ease-in-out;
        }

        .custom-card:hover {
            background-color: rgba(163, 163, 163, 0.15);
        }
        .section1_arrow{
            --animate-duration: 10s;
        }
        .btn_review {
            display: inline-block;
            padding: 15px 50px;
            background: #2b6653;
            color: white;
            font-size: 18px;
            border-radius: 25px;
            text-decoration: none;
        }
        .count_area{
            background-color: #FCEDB1;
        }
    </style>
@endsection


<!-- 網頁內容 -->
@section('content')

    <!-- 網頁開頭大圖 -->
    @include('frontend.layouts.section1')

    <!-- 輪播圖 -->
    @include('frontend.layouts.carousel')

    <!-- 計數器 -->
    @include('frontend.layouts.count')
    <!-- 三大理由 -->
    @include('frontend.layouts.values')
    
    <!-- 評論 -->
    @include('frontend.layouts.product_review')


    <!-- 輪播圖-最新商品 -->
    @include('frontend.layouts.slick')


    <!-- 捲簾區塊 -->
    @include('frontend.layouts.roller')

@endsection
    
@section('scripts')
    <script src="{{ asset('frontend/slick/slick.min.js') }}"></script>
    <script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"></script>
    <!-- 載入slick -->
    <script>
    $('.photo').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 500,
        autoplaySpeed: 3000,
        autoplay: true,
        centerMode: true,
        centerPadding: 0,
        prevArrow: '<button type="button" class="slick-prev custom-prev"><i class="fa-solid fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next custom-next"><i class="fa-solid fa-chevron-right"></i></button>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: true, // 手機版禁用箭頭
                    centerMode: true,
                    centerPadding: 0,
                    slidesToShow: 1,
                }
            }
        ]
    });
    </script>
    <script>
        //計數器
        const counterUp = window.counterUp.default;

        const callback = entries => {
            entries.forEach( entry => {
                const el = entry.target
                if ( entry.isIntersecting && ! el.classList.contains( 'is-visible' ) ) {
                    counterUp( el, {
                        duration: 1000,
                        delay: 16,
                    } )
                    el.classList.add( 'is-visible' );
                };
            } )
        };

        const IO = new IntersectionObserver( callback, { threshold: 1 } )

        const el01 = document.querySelector( '.counter01' );
        IO.observe( el01 );
    </script>
@endsection

