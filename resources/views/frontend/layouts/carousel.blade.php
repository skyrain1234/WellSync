<div id="carouselExampleSlidesOnly" class="carousel slide wow animate__animated animate__fadeIn" data-bs-ride="carousel" data-wow-offset="100">
  <div class="carousel-inner">
    @foreach($carousel_image_paths as $carousel_image_path)
    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
      <img src="{{ asset($carousel_image_path->image_path) }}" class="d-block w-100" alt="..." style="max-height: 80vh; object-fit: cover;">
    </div>
  @endforeach
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    let myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleSlidesOnly'), {
      interval: 3000, // 自動播放間隔 3 秒
      wrap: true, // 允许循环播放
      pause: false // 禁止鼠標懸停暫停
    });
  });
</script>