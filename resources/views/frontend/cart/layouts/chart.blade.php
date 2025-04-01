<style>
.chart-card {
    transition: opacity 0.5s ease;
}

.overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    opacity: 1; /* 確保 overlay 內容不受透明度影響 */
}
.d-none {
    display: none;
}
</style>
<div class="card mb-2 chart-card position-relative">
    <div class="row">
        <div id="assessment-overlay2" class="col-md-6 text-center mt-auto mb-auto d-none">
            <strong class="h1 fw-bold">您好
                @guest
                    @else
                    {{ Auth::user()->name }}
                @endguest
            </strong>
            <p class="mt-5 fw-bold">不確定該吃什麼保健品？<br>讓我們為你推薦最適合您的營養素</p>
            <a href="{{route('assessment.index')}}" target="_blank" class="btn btn_addToCart mt-5">免費評估</a>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <div id="question-container" style="height: 300px;"></div>
        </div>
    </div>
    <div id="assessment-overlay" class="overlay d-none">
        <button class="btn btn_addToCart go-assessment">前往免費評估</button>
    </div>
</div>
