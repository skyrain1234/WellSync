<div class="container mt-4">
        <div class="title-container wow animate__animated animate__fadeIn">
            <div class="line"></div>
            <h2 class="title">用戶評論</h2>
            <div class="line"></div>
        </div>

    @if(isset($reviews) && $reviews->isNotEmpty())
        <div class="row row-cols-1 row-cols-md-3 g-4 wow animate__animated animate__fadeIn"  data-wow-duration="2s" data-wow-iteration="1"> <!-- 每行 3 列，g-4 增加間距 -->
            @foreach ($reviews as $review)
                <div class="col">
                    <div class="card h-100 p-3 text-start custom-card"> <!-- 讓文字靠左 -->
                        <div class="d-flex align-items-center">
                            <!-- 用戶頭像 -->
                            <img src="{{ asset($review->user->avatar ?? 'uploads/avatars/default_avatar_5407167.png') }}" alt="用戶頭像" class="rounded-circle me-3" width="50"
                            height="50">
                            <!-- <img src="{{ asset($review->user->avatar ?? 'uploads/avatars/default_avatar_5407167.png') }}" alt="用戶頭像" class="rounded-circle me-3" width="50"
                                height="50"> -->
                            <div>
                                <p class="mb-1"><strong>用戶: {{ $review->user->name ?? '未知用戶' }}</strong></p>
                                <p class="text-muted mb-0">發表日期：{{ $review->formatted_date }}</p>
                            </div>
                        </div>
                        <hr>
                        <p class="mb-1">評分：<strong>{{ $review->rating }} ⭐</strong></p>
                        <p class="text-secondary">{{ $review->review }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-start">暫無評論</p>
    @endif

    <!-- ✅ 顯示「撰寫評論」按鈕（僅限登入用戶） -->
    @auth
        <div class="mt-5 text-center">
            <a href="{{ route('reviews.write') }}" class="btn btn_addToCart btn_review">撰寫評論</a>
        </div>
    @else
        <p class="mt-4 text-danger text-center fw-bold">
            請先 <a href="{{ route('reviews.write') }}" class="text-primary">登入</a> 才能撰寫評論。
        </p>
    @endauth
</div>