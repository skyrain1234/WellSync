<main class="hero  bg-cover wow animate__animated animate__fadeIn" style="background-image: url({{ asset('uploads/index/header.jpg') }});  background-attachment: fixed; height:100vh">
    <div class="container wow animate__animated animate__fadeInLeft">
        <div class="row mt-5">
            <div class="col-md-6 col-12 ms-auto">
                <strong class="h1 fw-bold">WellSync
                    <span>You</span>
                </strong>
                <p class="mt-5">不確定該吃什麼保健品？總是過期丟掉？<br>快速尋找最適合您的營養素</p>
                <a href="{{route('assessment.index')}}" target="_blank" class="btn btn_addToCart mt-5">免費評估</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 col-12 ms-auto">
                <p class="mt-5">瀏覽以查看更多</p>
                <a href="#carouselExampleSlidesOnly">
                    <img src="{{ asset('uploads/index/arrow.svg') }}" width="50px" alt="" class="animate__animated animate__shakeY animate__infinite infinite section1_arrow">
                </a>
            </div>
        </div>
    </div>
</main>