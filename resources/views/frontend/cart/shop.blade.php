@extends('frontend.layouts.master') 
@section('content')
<style>
    .catories_name{
        text-decoration: none;
        font-weight: bold;
        font-size: 20px;
        color: #3B7459;
    }
    .catories_name:hover{

        color: #2E5D45;
    }
</style>
<!-- BREADCRUMB START -->
<section id="product__breadcrumb" style="background: url('{{ asset('frontend/images/product_detail_bg.jpg') }}')" class="wow animate__animated animate__fadeIn "  data-wow-duration="1s" data-wow-iteration="1">
    <div class="product_breadcrumb_overlay">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-5  wow animate__animated animate__fadeInLeft "  data-wow-duration="1s" data-wow-iteration="1">
                    <h2 class="text-white fw-bold">商品一覽</h2>
                    <nav aria-label="breadcrumb"  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);">
                        <ol class="breadcrumb" style="justify-content: flex-start   ;" >
                            <li class="breadcrumb-item "><a href="{{ route('home.index') }}" class=" text-white">Home</a></li>
                            <li class="breadcrumb-item " aria-current="page">shop</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-5 d-none d-md-block text-end  wow animate__animated animate__fadeInDown "  data-wow-duration="1s" data-wow-iteration="1">
                    <em class="h2 text-white ">Shop</em>
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
<div class="container mt-4">
    <div class="row">
        <!-- 左側搜尋與分類欄 -->
        <div class="col-md-3">
            <div class="card p-3">
                <h4 class="fw-bold">搜尋列</h4>
                <form action="{{ route('shop.search') }}" method="GET">
                    <input type="text" name="query" class="form-control mb-2" placeholder="搜尋商品...">
                    <button type="submit" class="btn btn_addToCart w-100">搜尋</button>
                </form>
                <hr>
                <h4 class="fw-bold">商品分類</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                    <i class="fa-solid fa-caret-down"></i>
                    <a class="catories_name" href="{{ route('shop') }}">所有商品</a>
                    </li>
                    @foreach ($categories as $categorie)
                    <li class="list-group-item">
                        &nbsp;
                        <i class="fa-solid fa-caret-right"></i>
                        <a class="catories_name" href="{{ route('shop.category', $categorie->id) }}">{{ $categorie->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- 右側商品列表 -->
        <div class="col-md-9">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4 mb-4 wow animate__animated animate__fadeIn ">
                    <div class="card d-flex flex-column h-100">
                        
                        <a href="{{ route('shop.product-detail', $product->name) }}" class="mt-2">
                            <img src="{{ asset($product->thumb_image) }}" style="height: 200px; object-fit: contain;" class="card-img-top" alt="Product Image">
                        </a>
                        
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="badge  me-auto text-center ms-auto" style="background-color: #00adb9;">{{ $product->category ? $product->category->name : 'No category'}}</h6>
                            <h6 class="text-primary  ">{{ $product->short_description }}</h6>

                            <div class="row mt-auto d-flex align-items-center">
                                <div class="col-6 text-end">
                                    <h6 class="text-danger mb-0">${{ $product->price }} / 份</h6>
                                </div>
                                <div class="col-6 d-flex justify-content-center">
                                    <form action="{{ route('add-to-cart', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn_addToCart" data-bs-toggle="tooltip" data-bs-placement="bottom" title="加入購物車">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- end右側商品列表 -->
    </div>
</div>
@endsection




