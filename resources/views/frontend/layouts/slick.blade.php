<div class="container">
    <div class="title-container wow animate__animated animate__fadeIn">
        <div class="line"></div>
        <h2 class="title">新品上市</h2>
        <div class="line"></div>
    </div>
</div>
<section class="my-5 wow animate__animated animate__fadeInRight "  data-wow-duration="1.5s" data-wow-iteration="1">
    <div class="container">
        <div class="photo">
            @foreach ($product_types as $product_type)
                <div class="item">
                    <a href="{{ route('shop.product-detail', $product_type->name) }}">
                        <img src="{{asset($product_type->thumb_image)}}" alt="">
                    </a>
                    <p class="h4 fw-bold text-title text-center mt-2"><em>{{ $product_type -> name }}</em></p>
                </div>
            @endforeach
        </div>
    </div>
</section>
