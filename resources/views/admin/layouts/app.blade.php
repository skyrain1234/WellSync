
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="icon" href="{{asset('uploads/logo.ico')}}" type="image/x-icon">
    
    
    <!-- 引入 AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- 引入 Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    
    <!-- daterangepicke -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- summernote文字編輯器 -->
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs5.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .dataTable td {
            vertical-align: middle !important;
        }
        /* 確保通知顯示在最上層 */
        .fl-wrapper {
            z-index: 9999 !important;  /* 設置為非常高的 z-index，確保它顯示在最上面 */
        }
        body {
            font-family: 'Noto Sans TC', sans-serif;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- 頂部導航欄 -->
        @include('admin.layouts.component.nav')
        
        <!-- 側邊欄 -->
        @include('admin.layouts.component.sidebar', ['sidebar' => $sidebar])

        <!-- 內容區域 -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- 麵包屑 -->
                    @include('admin.layouts.component.breadcrumb')
                    <!-- 內容區塊 讓其他頁面沿用本頁 -->
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- 頁腳 -->
        @include('admin.layouts.component.footer')


        <!-- jquery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

        <!-- Chart.js -->
        <script src="{{ asset('backend/js/chart.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- 引入 Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <!-- 管理delete按鈕事件 -->
        <script src="{{ asset('js/delete.js') }}"></script>
        <script src="{{asset('js/summernote.js')}}"></script>
        <!--  daterangepicke日期選擇 -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.js"></script>
        <script>
            $('#icon').select2({
                width: '100%',
                placeholder: '選擇 FontAwesome 圖示',
            });

                /** summernote **/
            $('.summernote').summernote({
                height:150
            })
            
                /** date picker **/
            $('.datepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true
            });
            
        </script>
        @stack('scripts')
    </div>
</body>
</html>
