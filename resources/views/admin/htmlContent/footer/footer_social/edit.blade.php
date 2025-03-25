@extends('admin.layouts.app')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>頁尾社群管理</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>編輯</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.htmlContent.footer_social.update', $footer_social->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>名稱</label>
                            <input type="text" class="form-control" name="name" value="{{$footer_social->name}}">
                        </div>
                        <div class="form-group">
                            <label>網址</label>
                            <input type="text" class="form-control" name="url" value="{{$footer_social->url}}">
                        </div>

                        <div class="form-group">
                          <label for="icon">選擇圖示：</label>
                          <select id="icon" name="icon" class="form-control">
                              <option value="{{$footer_social->icon}}" selected>{{$footer_social->name}}</option>
                              <option value="fa-brands fa-square-x-twitter">twitter</option>
                              <option value="fa-brands fa-facebook">facebook</option>
                              <option value="fa-brands fa-line">line</option>
                              <option value="fa-brands fa-instagram">instagram</option>
                              <option value="fa-brands fa-youtube">youtube</option>
                              <option value="fa-brands fa-tiktok">tiktok</option>
                              <!-- 添加更多圖示 -->
                          </select>
                        <div>
                          <label>選擇的圖示:</label>
                          <i id="selected-icon" class="{{$footer_social->icon}}"></i> <!-- 默認顯示 Home 圖示 -->
                        </div>

                        <div class="form-group">
                            <label for="inputState">狀態</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$footer_social->status == 1 ? 'selected': ''}} value="1">啟用</option>
                              <option {{$footer_social->status == 0 ? 'selected': ''}} value="0">停用</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
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
    $('#icon').change(function() {
        var selectedIcon = $(this).val();
        $('#selected-icon').removeClass().addClass('fa ' + selectedIcon);
    });

</script>
@endpush
 