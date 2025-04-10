<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 載入public資料夾底下的css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/frontend_form/css/form_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/frontend_form/css/quiz.css') }}">

</head>
<body>

    
    <!-- LOGO -->
    @include('frontend/layouts/Logo_form')

    <!--主要內容區塊-->
    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- 載入public資料夾底下的js -->
    
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>
    
    

</body>
</html>