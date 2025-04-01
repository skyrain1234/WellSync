@extends('frontend.layouts.master')
<!-- 品牌名稱+Product Details -->
@section('title')
WellSync || Product Details
@endsection

@section('link')
    <!-- slick.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/slick/slick-theme.css') }}" />
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
                    <h2 class="text-white fw-bold">商品詳細</h2>
                    <nav aria-label="breadcrumb"  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);">
                        <ol class="breadcrumb" style="justify-content: flex-start   ;" >
                            <li class="breadcrumb-item "><a href="{{ route('home.index') }}" class=" text-white">Home</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('shop') }}" class=" text-white">全部商品</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-5 d-none d-md-block text-end  wow animate__animated animate__fadeInDown "  data-wow-duration="1s" data-wow-iteration="1">
                    <em class="h2 text-white ">detail</em>
                    <div class=" my-2">
                        <span class="h5">
                            <em class="text-white">Our Products</em>
                            <p  calss="text-end" style="background-color: #C5C4C1; height: 2px; width: 24%;margin-left: auto;"></p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</section>

<!-- BREADCRUMB END -->

<!-- PRODUCT DETAILS START -->
<section id="product__product_details" class="wow animate__animated animate__fadeIn ">
    <div class="container">
        <div class="product__details_bg">
            <div class="row">
                <div class="col-xl-4 col-md-5 col-lg-5" style="z-index:999">
                    <div>
                            <img class="w-100" src="{{asset($product->thumb_image)}}" alt="">
                    </div>
                </div>
            
                <div  id = "details_introduce" class="col-xl-7 col-md-7 col-lg-7">
                    <div class="product__pro_details_text">
                        <p class="title">{{$product->name}}</p>
                        <p class="title">{{$product->slug}}</p>
                        @if ($product->price > 0)
                        <h4><span>${{$product->price}}/份</span> <span class="category-label">{{$product->category->name}} </span></h4>
                        @else
                        <h4><span>詳細金額請撥打客服詢問</span> <span class="category-label">{{$product->category->name}} </span></h4>
                        @endif
                        
                        
                        <hr />
                        @if ($product->qty > 0)
                        <p class="product__stock_area"><span class="in_stock">庫存量</span> ({{$product->qty}} /份)</p>
                        @elseif ($product->qty === 0)
                        <p class="product__stock_area"><span class="in_stock">缺貨中</span> ({{$product->qty}} /份)</p>
                        @endif
                        
                        <!-- 星級評分 -->
                        <!-- <p class="product__pro_rating">
                            @php
                            $avgRating = $product->reviews()->avg('rating');
                            $fullRating = round($avgRating);
                            @endphp    
            
                            @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $fullRating)
                            <i class="fas fa-star"></i>
                            @else                        
                            <i class="far fa-star"></i>        
                            @endif        
                            @endfor       

                            <span>({{count($product->reviews)}} review)</span>
                        </p> -->
                        <p class="description">{!! $product->short_description !!}</p>
                        <p class="description">{!! $product->long_description !!}</p>
                        
                    </div>
                    <div class="row">
                        <form class="text-center w-50 m-auto " action="{{ route('add-to-cart', $product->id) }}" method="POST">
                            @csrf
                            <div class="input-group mb-2">
                                <input type="number" name="quantity" class="form-control text-center"  value="1" min="1">
                                <button type="submit" class="btn btn_addToCart ">加入購物車</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>    
        
        <hr />
        <!-- 商品介紹圖 -->
        <div class ="row">
            <div class="col-xl-12">
                <div class="product__details_bg">
                    @foreach ($product->productImageGalleries as $productImage)
                    <img class="w-100 wow animate__animated animate__fadeIn"  src="{{asset($productImage->image)}}" alt="product"></img>
                    @endforeach
                    <div class="container wow animate__animated animate__fadeIn">
                        <div class="text-block">
                            <p class="Related_products text-center">相關商品</p>
                        </div>
                        <!-- photo -->
                            <section class="my-5 wow animate__animated animate__fadeIn "  data-wow-duration="1.5s" data-wow-iteration="1">
                                <div class="container">
                                    <div class="photo">
                                    @php
                                        $currentCategoryId = $product->category_id;
                                        $relatedProducts = \App\Models\Product::where('category_id', $currentCategoryId)
                                            ->where('id', '!=', $product->id)
                                            ->where('status', 1)
                                            ->get();
                                    @endphp
                                    @forelse ($relatedProducts as $relatedProduct)
                                        <div class="item">
                                            <img src="{{asset($relatedProduct->thumb_image)}}" alt="">
                                            <p class="h4 fw-bold text-title text-center mt-2"><em>{{ $relatedProduct->name }}</em></p>
                                            <p class="h4 fw-bold text-danger text-center mt-2">
                                                <em>${{ $relatedProduct->price }}</em>
                                            </p>
                                            <form class="text-center" action="{{ route('add-to-cart', $relatedProduct->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn_addToCart">加入購物車</button>
                                            </form>
                                        </div>
                                        @empty
                                        <p class="text-center">暫無相關商品</p>
                                    @endforelse
                                    </div>
                                </div>
                            </section>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
    
<!-- PRODUCT DETAILS END -->
@endsection
@section('scripts')
    <script src="{{ asset('frontend/slick/slick.min.js') }}"></script>
    <!-- 載入slick -->
    <script>
    $('.photo').slick({
        infinite: true,
        slidesToShow: 1,
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
@endsection