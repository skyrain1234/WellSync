<!-- roller_area -->
<section id="s11" class="bg-cover p-5 my-3" style="background-image: url({{ asset('uploads/index/roller/background.png') }}); background-color:#9FCAC7; background-attachment: fixed;">
    <div class="container">
        <div class="row py-3 ">
            @foreach ($roller as $index => $item)
                <div class="col-md-6 my-3 wow animate__animated animate__fadeIn{{ $index % 2 == 0 ? 'Left' : 'Right' }}" data-wow-duration="1s" data-wow-iteration="1">
                    <a class="text-decoration-none text-white d-block d-flex justify-content-center align-item-center" href="{{ route($index % 2 == 0 ? 'shop' : 'assessment.index') }}" target="_blank">
                        <div class="box_roller">
                            <div class="roller_{{ $index % 2 == 0 ? 'left' : 'right' }} bg-cover" style="background-image: url('{{ asset($item->url) }}');"></div>
                            <h5 class="dish_text">{{ $index % 2 == 0 ? '產品一覽 Catalog' : '免費評估 Evaluate' }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
