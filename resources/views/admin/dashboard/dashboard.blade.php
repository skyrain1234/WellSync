@extends('admin.layouts.app')

@section('title', '儀表板')



@section('content')
    <!-- 上方圖表 -->
    @include('admin.dashboard.layout.small-box')
    <!-- 銷售圖表 -->
    @include('admin.dashboard.layout.chart')
@endsection

@push('scripts')

<script>
   $(document).ready(function () {
    let ctx = document.getElementById("userChart").getContext("2d");
    let userChart = null;

    // 類型對應 API 與標題
    const chartConfig = {
        "orders": { api: "/admin/monthly-orders", title: "訂單狀況" , },
        "inventory": { api: "/admin/monthly-inventory", title: "剩餘庫存" },
        "users": { api: "/admin/monthly-new-users", title: "新加入的會員" },
        "reports": { api: "/admin/monthly-reports", title: "網站瀏覽人次" }
    };

    // 在載入時自動更新所有 `small-box` 數據 
    Object.keys(chartConfig).forEach(type => {
        fetchSmallBoxData(type);
    });

    function fetchSmallBoxData(type) {
        if (!chartConfig[type]) return;

        let { api } = chartConfig[type];

        $.ajax({
            url: api,
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data && typeof data.count !== "undefined") {
                    // **動態更新對應的 h3 數值**
                    console.log(data);
                    
                    $(`.small-box[data-type="${type}"] .inner h3`).text(data.count);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(`Error fetching ${type} data:`, textStatus, errorThrown);
            }
        });
    }


    // 綁定 .small-box 點擊事件
    $(".small-box").on("click", function () {
        let type = $(this).data("type");
        if(type =="inventory"){
            window.location.href = "{{ route('admin.product.stockZero') }}";
        }else{
            fetchChartData(type);
        }
        
    });

    function fetchChartData(type) {
        if (!chartConfig[type]) {
            console.warn("未知的數據類型:", type);
            return;
        }

        let { api, title } = chartConfig[type];

        // 更新標題
        $("#card-title").text(title);

        // 發送 AJAX 請求
        $.ajax({
            url: api,
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (!data || !Array.isArray(data.labels) || !Array.isArray(data.data)) {
                    console.error("回傳的數據格式不正確", data);
                    return;
                }
                updateUserChart(data.chart_type,data.labels, data.data, data.startColor, data.endColor, data.backgroundColors,data.hoverColor,);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error fetching data:", textStatus, errorThrown);
            }
        });
    }

    function updateUserChart(chart_type, labels, data, startColor="", endColor="", backgroundColors="",hoverColor,) {
        // 創建漸變色
        
        let custom_bgColor,custom_borderColor;
        
        if(chart_type=="bar"){
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, startColor);
            gradient.addColorStop(1, endColor);
            custom_bgColor=Array(labels.length).fill(gradient);
            custom_borderColor=startColor
        }else{
            custom_bgColor=backgroundColors;
            custom_borderColor=hoverColor;
        }
        // **如果圖表已經存在，則先銷毀它**
        if (userChart) {
            userChart.destroy();
            
        }

        // **重新創建新圖表**
        userChart = new Chart(ctx, {
            type: chart_type,  // **這裡的類型可以動態變更**
            data: {
                labels: labels,
                datasets: [{
                    label: "人數",
                    data: data,
                    backgroundColor: custom_bgColor,
                    borderColor: custom_borderColor,
                    borderWidth: 2,
                    borderRadius: 8,
                    hoverBackgroundColor: hoverColor,
                    tension: 0.2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: chart_type === "pie" ? {} : { // 如果是 pie，就不需要 X/Y 軸
                    x: { grid: { display: false } },
                    y: { beginAtZero: true }
                }
            }
        });
    }

    // 頁面載入時，預設顯示 "新加入的會員" 圖表
    fetchChartData("users");
});


</script>
@endpush
