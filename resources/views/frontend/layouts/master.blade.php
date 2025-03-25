<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('uploads/logo.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- 載入public資料夾底下的css -->
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- adnimate.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- 自定義css 柏元 -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- 自定義css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/fenghua.css') }}">
    
    <!-- slick.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/slick/slick-theme.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/css/product_grid_view.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style_product_details.css') }}">
    <!-- 可插入單獨作用於其他分頁 不需要全域載入的js -->
    <style>
        body {
            padding-top: 90px; /* 確保內容往下移動 */
        }
    </style>
    @yield('link')
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-LBM860D4X2"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-LBM860D4X2');
        </script>
</head>
<body>
    <!-- header -->
    @include('frontend.layouts.header')

     <!--主要內容區塊-->
    @yield('content')

    <!-- footer -->
    @include('frontend.layouts.footer')

    <!-- 返回頂部 -->
    @include('frontend.layouts.back_to_top')

    <!-- 購物車按鈕 -->
    @include('frontend.layouts.cart')


    <!-- js -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- sweetalert2彈出視窗 -->
    <script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- 動畫套件 -->
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <!-- 處理滾輪監聽事件 -->
    <script src="{{ asset('frontend/js/fenghua.js') }}"></script>

    <!-- 可插入單獨作用於其他分頁 不需要全域載入的js -->
    @yield('scripts')

    <script>
        $(function () {
            new WOW().init(); //待處理 wow.js動畫套件尚未載入
            // 載入fenghua.js裡面的navbar()函式
            navbar();
        });
    </script>

    <!-- 載入cart -->
    <script>
        function cart_btn_index(){
            $(window).on("scroll",function () {
                    let scrollTop = $(this).scrollTop();

                    // 顯示/隱藏返回頂部按鈕
                    if (scrollTop) {
                        $(".floating-cart-button").addClass("show_btn");
                        $(".back_to_top").addClass("show_btn");
                    } else {
                        $(".floating-cart-button").removeClass("show_btn");
                        $(".back_to_top").removeClass("show_btn");
                    }
                }
            );
            };
        cart_btn_index();
    </script>
    <!-- 購物車更新 -->
    <script>
        function updateCartQuantity() {
            fetch("{{ url('/cart/item-count') }}")
                .then(response => response.json())
                .then(data => {
                    // 取得數量並更新網頁內容
                    document.getElementById("cart_quantity").textContent = data.count;
                    document.getElementById("cart_quantity_nav").textContent = data.count;
                })
                .catch(error => console.error("Error fetching cart count:", error));
        }
        // 當頁面載入時更新
        document.addEventListener("DOMContentLoaded", updateCartQuantity);
    </script>
</body>
</html>