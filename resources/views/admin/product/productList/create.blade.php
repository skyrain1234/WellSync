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
                    <h4>新增產品</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.product.productList.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>圖片預覽</label>
                          <br>
                          <img id="imagePreview" src="" style="width:200px; display:none;" alt="預覽圖片">
                        </div>
                        <div class="form-group">
                            <label>產品圖</label>
                            <input type="file" class="form-control" name="image" id="imageInput" required>
                        </div>

                        <div class="form-group">
                            <label>產品名稱</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control main-category" name="category" required>
                                      <option value="" disabled>Select</option>
                                      @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>SKU 庫存單位</label>
                            <input type="text" class="form-control" name="sku" value="{{old('sku')}}">
                        </div>

                        <div class="form-group">
                            <label>價格</label>
                            <input type="text" class="form-control" name="price" value="{{old('price')}}" required>
                        </div>

                        <div class="form-group">
                            <label>優惠價</label>
                            <input type="text" class="form-control" name="offer_price" value="{{old('offer_price')}}">
                        </div>

                        <div class="row">
                          <h2>上架/優惠期間</h2>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>開始期間</label>
                                    <input type="text" class="form-control datepicker" name="offer_start_date" value="{{old('offer_start_date')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>結束期間</label>
                                    <input type="text" class="form-control datepicker" name="offer_end_date" value="{{old('offer_end_date')}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>庫存</label>
                            <input type="number" min="0" class="form-control" name="qty" value="{{old('qty')}}" required>
                        </div>

                        <div class="form-group">
                            <label>商品描述(短)</label>
                            <textarea name="short_description" class="form-control" required></textarea>
                        </div>


                        <div class="form-group">
                            <label>商品描述(長)</label>
                            <textarea name="long_description" class="form-control summernote" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">商品狀態(熱銷/新品)</label>
                            <select id="inputState" class="form-control" name="product_type">
                                <option value="">無</option>
                                <option value="new_arrival">新品</option>
                                <option value="featured_product">精選產品</option>
                                <option value="top_product">暢銷商品</option>
                                <option value="best_product">最佳商品</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>SEO關鍵字 標題(非必填)</label>
                            <input type="text" class="form-control" name="seo_title" value="{{old('seo_title')}}">
                        </div>

                        <div class="form-group">
                            <label>SEO關鍵字 描述(非必填)</label>
                            <textarea name="seo_description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">產品狀態</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1" selected>上架</option>
                              <option value="0">下架</option>
                            </select>
                        </div>
                        <div class="row ">
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary">
                                    新增商品
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
        let imagePreview = document.getElementById('imagePreview');
        let file = event.target.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    });
</script>
@endpush


