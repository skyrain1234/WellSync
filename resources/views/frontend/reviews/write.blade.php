@extends('frontend.layouts.master')
@section('title')
    WellSync || 撰寫評論
@endsection

@section('content')
    <section id="product__breadcrumb" style="background: url('{{ asset('frontend/images/product_detail_bg.jpg') }}')" >
        <div class="product_breadcrumb_overlay">
            <div class="container mt-5 ">
                <div class="row">
                    <div class="col-10 ms-auto me-auto">
                        <h2 class="text-center text-light">撰寫評論</h2>
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label text-light">評分</label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                    <option value="4">⭐⭐⭐⭐ (4)</option>
                                    <option value="3">⭐⭐⭐ (3)</option>
                                    <option value="2">⭐⭐ (2)</option>
                                    <option value="1">⭐ (1)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label text-light">評論內容</label>
                                <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn_addToCart w-100">提交評論</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection