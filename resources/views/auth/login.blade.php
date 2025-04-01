@extends('frontend.layouts.master')
@section('header_class', '')

@section('content')
<style>
        body {
            padding-top: 0px !important;
        }
        .container {
            animation: fadeIn 0.8s ease-in-out;
        }
  
        button:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
  
        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 3px rgba(0, 123, 255, 0.5);
        }
  
        #toggle-form {
            transition: color 0.3s ease-in-out;
        }
  
        #toggle-form:hover {
            color: #ffffff;
        }
  
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .text-forget{
            color:rgb(61, 128, 93);
        }
        .text-forget:hover{
            color: #1E4A3C;
        }
  
</style>

<div class="container mt-3 mb-2">
    <div class="row justify-content-center">
        <div class="col-xl-6 text-center d-xl-block d-none ">
            <img src="{{ asset('uploads/download.png') }}" alt="" style="width: 90%;">
        </div>
        <div class="col-xl-6">
            <div class="container rounded-4  p-4 " style="max-width: 500px; background-color: rgba(163, 163, 163, 0.05);">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-title">歡迎回來</h2>
                    <em class="text-sub_title">請登入或註冊以繼續</em>
                </div>
                <!-- 登入表單 -->
                <form form id="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label text-title h5 fw-bold">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="請輸入email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-title h5 fw-bold">{{ __('密碼') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="請輸入密碼">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <!-- reCAPTCHA -->
                        <div class="g-recaptcha " data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        @error('captcha')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-3 ">
                        <div class="col-md-6 ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('記住我') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if (Route::has('password.request'))
                                <div class="text-end mb-3 ">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none  text-forget">忘記密碼？</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <input id ="averageScores" type="hidden" name="averageScores" value="" >

                    <button type="submit" class="btn btn_login w-100 text-title fs-5">{{ __('登入') }}</button>
                </form>
                 <!-- 底部切換按鈕 -->
                <div class="text-center mt-3">
                    <a href="{{ route('register') }}" style="text-decoration: none;">
                        <span id="toggle-form" class="text-decoration-none small text-sub_title fs-6" style="cursor: pointer;">還沒有帳號？點擊註冊</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    $(document).ready(function () {
        let averageScores = localStorage.getItem('averageScores');

        if (averageScores) {
            $('#averageScores').val(averageScores);
        }
        
        // 監聽表單提交事件
        $('#login-form').submit(function(event) {
            // 在表單提交時，清除 localStorage
            localStorage.clear();
            console.log("localStorage 已清除");
        });

    });
    
</script>
@endsection
