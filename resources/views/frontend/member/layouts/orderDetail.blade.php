@extends('frontend.layouts.master')
@section('link')
<style>
    
    .table td, .table th {
        vertical-align: middle !important;
    }
    .card{
        background-color: rgba(163, 163, 163, 0)
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
                    <h2 class=" text-white">查看訂單</h2>
               </div>
            </div>
        </div>
    </div>   
</section>

<div class="container my-4 ">
    <div class="row">
        <div class="alert alert-warning text-center">
            <strong id="countdown-area" data-status="{{ $order->status }}" >請在 
                <span id="countdown-timer" data-time="{{ $order->created_at->toIso8601String() }}">
                    
                </span> 內完成付款，否則訂單將被取消！
            </strong>
        </div>
    </div>
    <div class="card p-2">
        <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">
                        收件者姓名
                    </label>
                    <input type="text" class="form-control" value="{{$order->receivers}}" readonly>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">
                        連絡電話
                    </label>
                    <input type="text" class="form-control" value="{{$order->phone}}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2">
                    <label for="" class="form-label">
                        郵遞區號
                    </label>
                    <input type="text" class="form-control" value="{{$order->zipcode}}" readonly>
                </div>
                <div class="col-10">
                    <label for="" class="form-label">
                        收件地址
                    </label>
                    <input type="text" class="form-control" value="{{$order->address}}" readonly>
                </div>
            </div>
            
        <table class="table  table-hover" >
            <thead>
                <tr>
                    <th>產品名稱</th>
                    <th>產品圖</th>
                    <th>數量</th>
                    <th>單價</th>
                    <th>總價</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $orderitem)
                <tr>
                    <td>{{ optional($orderitem->product)->name ?? '產品已下架' }}</td>
                    <td>
                        @if ($orderitem->product && $orderitem->product->thumb_image)
                            <img src="{{ asset($orderitem->product->thumb_image) }}" alt="Product Image" style="width: 100px; height: auto;">
                        @else
                            <span>無圖片</span>
                        @endif
                    </td>
                    <td>{{ $orderitem->quantity }}</td>
                    <td>{{ $orderitem->price }}</td>
                    <td>{{ $orderitem->quantity * $orderitem->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row ">
            <div class="col-6 text-end"> <!-- 設定最小寬度為 4，並使用中等螢幕尺寸的設定 -->
                <a href="{{ route('member.profile') }}#order">
                    <button class="btn btn-secondary w-25">返回</button>
                </a>
            </div>
            <div class="col-6">
                <form action="{{ route('createOrder') }}" method="get">
                    @csrf
                    <input type="hidden" name="MerchantTradeNo" value="{{$order->order_no}}">
                    <input type="hidden" name="TotalAmount" value="{{$order->total_price}}">
                    <input type="hidden" name="ItemName" value="WellSync商品一批X1">
                    <button type="submit"  class="btn btn_addToCart w-25" @if(!in_array($order->status, ['unpaid'])) disabled @endif>
                        前往付款
                    </button>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection

@section('scripts')
<!-- 取消訂單倒計時 -->
<script>
    $(document).ready(function () {
        let $timerElement = $("#countdown-timer");
        let orderCreatedAt = $timerElement.data("time");
        let orderStatus = $("#countdown-area").data("status")
        
        
        if (!orderCreatedAt ) return; // 沒有時間則不執行

        // 設定 10 分鐘倒數
        let cancelTime = new Date(orderCreatedAt).getTime() + 10 * 60 * 1000;

        function updateCountdown() {
            let now = new Date().getTime();
            let timeLeft = cancelTime - now;

            if (timeLeft <= 0) {
                if(orderStatus == "canceled"){
                    $("#countdown-area").text("訂單已取消");
                    $("#countdown-area").closest('.alert').removeClass('alert-warning').addClass('alert-danger');
                    Swal.fire({
                    icon: "error",
                    title: "訂單已取消",
                    text: "未在時間內完成付款",
                    });
                    return;
                  
                }else{
                    $("#countdown-area").text("訂單成立");
                    $("#countdown-area").closest('.alert').removeClass('alert-warning').addClass('alert-success');
                    return;
                }
            }else{
                if(orderStatus != "unpaid"){
                    $("#countdown-area").text("訂單成立");
                    $("#countdown-area").closest('.alert').removeClass('alert-warning').addClass('alert-success');
                    return;
                }
            }

            let minutes = Math.floor((timeLeft / 1000 / 60) % 60);
            let seconds = Math.floor((timeLeft / 1000) % 60);
            $timerElement.text(minutes + " 分 " + seconds + " 秒");

            setTimeout(updateCountdown, 1000);
        }

        updateCountdown();
    });
</script>
@endsection