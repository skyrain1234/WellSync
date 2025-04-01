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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="chart-tab" data-bs-toggle="tab" data-bs-target="#chart" type="button" role="tab" aria-controls="chart" aria-selected="false">評估報表</button>
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
                    <div class="tab-pane fade" id="chart" role="tabpanel" aria-labelledby="chart-tab">
                        <div class="card p-3 text-center">
                        @include('frontend.member.layouts.chart')
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
<script src="{{ asset('backend/js/chart.js') }}"></script>
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
<!-- 預覽圖片 -->
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

<!-- 雷達圖 -->
<script>
$(document).ready(function () {
    let hue = 0;
    let intervalId = null;

    function createRadarChart(titleNames, averageScores) {
       new Chart(document.getElementById('acquisitions'), 
       {
            type: 'radar',
            data: {
                labels: titleNames,
                datasets: [{
                    label: '您的健康評估',
                    data: averageScores,
                    backgroundColor: 'rgba(25, 56, 5, 0.55)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#2E5D45',
                            font: {
                                size: 24,
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 20,
                            color: 'rgb(104, 104, 104)',
                            font: {
                                size: 16,
                                weight: 'bold'
                            },
                            backdropColor: 'rgba(207, 206, 206, 0)',
                            borderWidth: 1,
                            borderColor: 'rgba(0, 0, 0, 0.2)'
                        },
                        grid: {
                            color: 'rgba(0, 128, 0, 0.3)'
                        },
                        angleLines: {
                            color: 'rgba(0, 128, 0, 0.5)'
                        },
                        pointLabels: {
                            color: '#2E5D45',
                            font: {
                                size: 20,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    }

    $.when(
        $.ajax({ url: "/Score", method: "GET", dataType: "json" }),
        $.ajax({ url: "/api/formTitles", method: "GET", dataType: "json" })
    ).done(function (scoreResponse, titleResponse) {
        let scoreData = scoreResponse[0];
        let titleNames = titleResponse[0];

        let averageScores = [0, 0, 0, 0, 0]; // 預設值
        if (scoreData.length > 0) {
            try {
                averageScores = JSON.parse(scoreData[0].averageScores);
            } catch (error) {
                console.error("解析 averageScores 時出錯:", error);
            }
        }
        createRadarChart(titleNames, averageScores);
    }).fail(function () {
        console.error("獲取數據時發生錯誤");
    });
});
</script>
@endsection