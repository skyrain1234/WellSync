@extends('frontend.layouts.master')
<!-- 品牌名稱+Product Details -->
@section('title')
WellSync || Product Details
@endsection

@section('link')
 <!-- 引入 Bootstrap Icons -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- 引入 DataTables 的 CSS -->
<link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/datatables.net-select-bs5/css/select.bootstrap5.css" rel="stylesheet">

@vite('resources/js/app.js')

    <style>
        .nav-link:hover {
            background-color: #356865;;
            color:#ffffff; ;
        }
        .nav-tabs .nav-link.active {
        background-color: #356865;;
        color:#ffffff; ;
        border-color: #dee2e6; /* 改變選項卡邊框顏色 */
        }
        .card{
            background-color: rgba(163, 163, 163, 0.05)
        }
         /* 修改 hover 顏色 */
        .form-select:hover {
            background-color: #356865;
            color: #ffffff;
        }

        /* 修改 focus 顏色 */
        .form-select:focus {
            background-color: #356865;
            color: #ffffff;
            border-color: #1c3533;
            box-shadow: 0 0 5px rgba(28, 53, 51, 0.5);
        }
         /* 如果是 `selected` 狀態 */
        .form-select option:checked {
            background-color:rgb(155, 6, 6);
            color: #ffffff;
        }
        /* 目前頁數 (active) 按鈕 */
        .page-item.active .page-link {
            background-color: #356865; /* 深色背景 */
            color: #ffffff;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')

<!-- BREADCRUMB START -->
<section id="product__breadcrumb" style="background: url('{{ asset('frontend/images/product_detail_bg.jpg') }}')" class="wow animate__animated animate__fadeIn "  data-wow-duration="1s" data-wow-iteration="1">
    <div class="product_breadcrumb_overlay">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
               <div class="col-6 text-center wow animate__animated animate__fadeInDown "  data-wow-duration="1s" data-wow-iteration="1">
                    <h2 class=" text-white">Hi ! {{ Auth::user()->name }} 歡迎回來</h2>
               </div>
            </div>
        </div>
    </div>   
</section>
<!-- BREADCRUMB END -->

<!-- main content Start -->
 <main>
    <div class="container my-2 wow animate__animated animate__fadeIn">
        <div class="row">
            <div class="col-md-8 ms-auto me-auto">
                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">帳號管理</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab" aria-controls="order" aria-selected="false">帳單管理</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card p-3">
                        @include('frontend.member.layouts.home')
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                        <div class="card p-3">
                        @include('frontend.member.layouts.orderList')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </main>
 <!-- main content End -->

@endsection
@section('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<!-- Cropper.js CDN -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 獲取 URL 中的 fragment 部分 (例如: #order)
        const fragment = window.location.hash;

        // 檢查 fragment 是否存在
        if (fragment) {
            // 根據 fragment 查找對應的 tab 按鈕
            const tabTrigger = document.querySelector(`[data-bs-target="${fragment}"]`);
            if (tabTrigger) {
                // 使用 bootstrap.Tab 類來啟用該 tab
                const bootstrapTab = new bootstrap.Tab(tabTrigger);
                bootstrapTab.show(); // 顯示該 tab
            }
        }
    })

</script>
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
<script>
    // 獲取今天的日期
    const today = new Date().toISOString().split('T')[0];

    // 設置 max 屬性為今天
    document.getElementById('birthday').setAttribute('max', today);
</script>

<!-- 搜索訂單狀態 -->
<script>
    $(document).ready(function() {
        $('#statusFilter').change(function() {
            var status = $(this).val();
            var table = $('#frotnUserOrder-table').DataTable();
            
            // 設定額外的參數，讓 DataTable 重新載入時帶上 status
            table.ajax.url("{{ route('member.profile') }}?status=" + status).load();
        });
    });
</script>
@endsection