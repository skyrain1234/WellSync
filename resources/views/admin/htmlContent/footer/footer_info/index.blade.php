@extends('admin.layouts.app')
 
<!-- 網頁標題 -->
@section('title')
頁尾管理
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('frontend/css/fenghua.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <div class=" mt-3">
        <div class="card">
            <div class="card-header">頁尾管理</div>
            <div class="card-body">
                <!-- route 如果是用resouce會要求傳入id -->
                <form action="{{ route('admin.htmlContent.footer_info.update',1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @php
                            $footerInfo = \App\Models\Footer_info::first();
                        @endphp
                        <div class="form-group">
                            <label>圖片預覽</label>
                            <br>
                            <img src="{{asset($footerInfo->logo)}}" style="width:200px" alt="">
                        </div>
                        <div class="form-group">
                            <label>logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">地址</label>
                            <input type="address" class="form-control @error('address') is-invalid @enderror" 
                                id="address" name="address" value="{{ old('address', $footerInfo->address ?? '') }}" required>
                            @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">聯絡電話</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" name="phone" value="{{ old('phone', $footerInfo->phone ?? '') }}" required>
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">電子郵件</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email', $footerInfo->email ?? '') }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
            </div>
            <div class="card-footer">
                @include('frontend.layouts.footer')
            </div>
        </div>
    </div>
@endsection
 
