@extends('admin.layouts.app')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Product</h1>

          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>產品更新</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.product.productList.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>圖片預覽</label>
                            <br>
                            <img id="oldImagePreview" 
                                src="{{ asset($product->thumb_image) }}" 
                                style="width:200px; {{ $product->thumb_image ? '' : 'display:none;' }}" 
                                alt="舊圖片預覽">
                            <img id="newImagePreview" src="" style="width:200px; display:none;" alt="預覽圖片">
                        </div>

                        <div class="form-group">
                            <label>產品圖</label>
                            <input type="file" class="form-control" name="image" id="imageInput">
                        </div>

                        <div class="form-group">
                            <label>產品名稱</label>
                            <input type="text" class="form-control" name="name" value="{{$product->name}}">
                        </div>

                         <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">產品分類</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                      <option value="" disabled>----請選擇商品類別---</option>
                                      @foreach ($categories as $category)
                                        <option {{$category->id == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>SKU 庫存單位</label>
                            <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
                        </div>

                        <div class="form-group">
                            <label>價格</label>
                            <input type="text" class="form-control" name="price" value="{{$product->price}}">
                        </div>

                        <div class="form-group">
                            <label>優惠價</label>
                            <input type="text" class="form-control" name="offer_price" value="{{$product->offer_price}}">
                        </div>

                        <div class="row">
                          <h2>上架/優惠期間</h2>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>開始期間</label>
                                    <input type="text" class="form-control datepicker" name="offer_start_date" value="{{$product->offer_start_date}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>結束期間</label>
                                    <input type="text" class="form-control datepicker" name="offer_end_date" value="{{$product->offer_end_date}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>庫存</label>
                            <input type="number" min="0" class="form-control" name="qty" value="{{$product->qty}}" required>
                        </div>

                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea name="short_description" class="form-control">{!! $product->short_description !!}</textarea>
                        </div>


                        <div class="form-group">
                            <label>Long Description</label>
                            <textarea name="long_description" class="form-control summernote">{!! $product->long_description !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">商品狀態(熱銷/新品)</label>
                            <select id="inputState" class="form-control" name="product_type">
                                <option value="">無</option>
                                <option {{$product->product_type == 'new_arrival' ? 'selected' : ''}} value="new_arrival">新品</option>
                                <option {{$product->product_type == 'featured_product' ? 'selected' : ''}} value="featured_product">精選產品</option>
                                <option {{$product->product_type == 'top_product' ? 'selected' : ''}} value="top_product">暢銷商品</option>
                                <option {{$product->product_type == 'best_product' ? 'selected' : ''}} value="best_product">最佳商品</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Seo Title</label>
                            <input type="text" class="form-control" name="seo_title" value="{{$product->seo_title}}">
                        </div>

                        <div class="form-group">
                            <label>Seo Description</label>
                            <textarea name="seo_description" class="form-control">{!!$product->seo_description!!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                              <option {{$product->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div> 
                        <input type="hidden" name="redirect_from" value="{{ request()->get('redirect_from') }}">
                        <div class="row ">
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary">
                                    更新
                                </button>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin.product.productList.index') }}" class="btn btn-secondary">
                                    取消
                                </a>
                            </div>
                        </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection

@push('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        let oldImagePreview = document.getElementById('oldImagePreview');
        let newImagePreview = document.getElementById('newImagePreview');
        let file = event.target.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                newImagePreview.src = e.target.result;
                newImagePreview.style.display = 'block';
                oldImagePreview.style.display = 'none'; // 隱藏舊圖片
            }

            reader.readAsDataURL(file);
        }
    });
</script>
@endpush