<p class="h5 mt-2">個人資料</p>
<hr>
<form action="{{route('member.profile.edit')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group mb-2">
        <label>預覽</label>
        <br>
        <img id="oldImagePreview" 
            src="{{ asset( Auth::user()->avatar) }}" 
            style="width:200px; {{ Auth::user()->avatar ? '' : 'display:none;' }}" 
            alt="舊圖片預覽">
        <img id="newImagePreview" src="" style="width:200px; display:none;" alt="預覽圖片">
    </div>

    <div class="form-group mb-2">
        <label>上傳頭像</label>
        <input type="file" class="form-control" name="avatar" id="imageInput">
    </div>

    <div class="form-group mb-2">
        <label>會員名稱</label>
        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
    </div>

    <span>性別</span>
    <div class="form-check form-check-inline mb-2">
        
        <input class="form-check-input" type="radio" name="gender" id="men" value="1" 
            {{ Auth::user()->gender == 1 ? 'checked' : '' }}>
        <label class="form-check-label" for="men">男</label>
    </div>
    <div class="form-check form-check-inline mb-2">
        <input class="form-check-input" type="radio" name="gender" id="women" value="0" 
        {{ Auth::user()->gender == 0 ? 'checked' : '' }}>
        <label class="form-check-label" for="women">女</label>
    </div>

    <div class="form-group mb-2">
        <label>email</label>
        <input type="text" class="form-control"  value="{{ Auth::user()->email }}" readonly>
    </div>

    <div class="form-group mb-2">
        <label>手機號碼</label>
        <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
    </div>

    <div class="form-group mb-2">
        <label>出生日期</label>
        <input type="date" class="form-control" id="birthday" name="birthday" value="{{ Auth::user()->birthday}}">
    </div>

    <div class="row ">
        <div class="col-6 text-end">
            <button type="submit" class="btn btn_addToCart">
                修改會員資料
            </button>
        </div>
        <div class="col-6">
            <a href="{{ route('member.profile') }}" class="btn btn_addToCart">
                取消
            </a>
        </div>
    </div>
</form>