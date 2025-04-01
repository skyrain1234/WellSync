<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>管理員登入</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    管理員登入
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                    </ul>
                </div>
            </div>
        </nav>

        <main class="d-flex justify-content-center align-items-center" style=" padding-top: 60px;">
            <div class="card shadow-lg p-5 border-0" style="width: 400px; border-radius: 10px;">
                <h2 class="text-center mb-4 fw-bold text-primary">管理員登入</h2>
                    @error('email')
                        <div class="alert alert-danger text-center">
                            {{ $message }}
                        </div>
                    @enderror
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email：</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">密碼：</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="d-flex justify-content-center mb-3">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    </div>
                    @error('captcha')
                        <p class="text-danger text-center">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">登入</button>
                </form>
            </div>
        </main>

        <footer class="fixed-bottom bg-white shadow-sm text-center py-3">
            <div class="container">
                <p class="m-0 text-muted fw-light">Copyright © WellSync {{ date('Y') }}. All Rights Reserved.</p>
            </div>
        </footer>
    </div>

    <!-- 載入 Google reCAPTCHA API -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>
