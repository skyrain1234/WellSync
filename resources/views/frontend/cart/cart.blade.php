@extends('frontend.layouts.master')
@section('title')
    購物車
@endsection
@section('content')
<style>
    .table td, .table th {
        vertical-align: middle !important;
        
    }
    .card{
        background-color: rgba(234, 173, 61, 0.1);
    }
</style>
    <div class="container mt-4">
        <div class="row">
            <div class="col-8">
                
            </div>
        </div>
            
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <section class="h-100 gradient-custom">
            <div class="container ">
                <div class="row d-flex justify-content-center my-4">
                    <div class="col-md-8">
                        @include('frontend.cart.layouts.chart')
                        @include('frontend.cart.layouts.cart-content')
                    </div>
                    <div class="col-md-4">
                        @include('frontend.cart.layouts.order')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('backend/js/chart.js') }}"></script>
<!-- 雷達圖 -->
<script>
$(document).ready(function () {
    let hue = 0;
    let myRadarChart = null;
    let intervalId = null;

    function createRadarChart(titleNames, averageScores) {
        const container = $('#question-container');
        container.empty();

        const canvas = $('<canvas id="radarChart"></canvas>');
        container.append(canvas);
        const ctx = canvas[0].getContext('2d');

        if (myRadarChart !== null) {
            myRadarChart.destroy();
            clearInterval(intervalId);
        }

        myRadarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: titleNames,
                datasets: [{
                    label: '您的健康評估',
                    data: averageScores,
                    backgroundColor: `hsla(${hue}, 100%, 50%, 0.3)`,
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
                                size: 12,
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
                            stepSize: 25,
                            color: 'rgba(104, 104, 104, 0.35)',
                            font: {
                                size: 10,
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
                                size: 15,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });

        intervalId = setInterval(() => {
            if (!myRadarChart) {
                clearInterval(intervalId);
                return;
            }
            hue = (hue + 2) % 360;
            myRadarChart.data.datasets[0].backgroundColor = `hsla(${hue}, 100%, 50%, 0.3)`;
            myRadarChart.update();
        }, 500);
    }

    $.when(
        $.ajax({ url: "/Score", method: "GET", dataType: "json" }),
        $.ajax({ url: "/api/formTitles", method: "GET", dataType: "json" })
    ).done(function (scoreResponse, titleResponse) {
        let scoreData = scoreResponse[0];
        let titleNames = titleResponse[0];

        let averageScores = [];

        if (scoreData.length > 0) {
            try {
                averageScores = JSON.parse(scoreData[0].averageScores);
            } catch (error) {
                console.error("解析 averageScores 時出錯:", error);
            }
        } else {
            const storedData = localStorage.getItem('averageScores');
            if (storedData) {
                averageScores = JSON.parse(storedData);
            }
        }

        if (averageScores.length === 0) {
            $(".chart-card").css("background-color","rgba(234, 174, 61, 0.04)");
            $("#assessment-overlay").removeClass("d-none");
            $("#assessment-overlay2").addClass("d-none");
        } else {
            $(".chart-card").css("background-color","rgba(234, 173, 61, 0.1)");
            $("#assessment-overlay").addClass("d-none");
            $("#assessment-overlay2").removeClass("d-none");
            createRadarChart(titleNames, averageScores);
        }
    }).fail(function () {
        console.error("獲取數據時發生錯誤");
    });

    $(".go-assessment").click(function () {
        window.location.href = "assessment";
    });
});
</script>
@endsection
