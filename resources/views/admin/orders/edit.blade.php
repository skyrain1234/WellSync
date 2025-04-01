@extends('admin.layouts.app')

@section('content')
<style>
    .table td, .table th {
        vertical-align: middle !important;
    }
</style>
<div class="container mt-4 ">
    <div>
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
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-6 col-md-4"> <!-- 設定最小寬度為 4，並使用中等螢幕尺寸的設定 -->
            <a href="{{route('admin.order.index')}}">
                <button class="btn btn-secondary w-50">取消/返回前頁</button>
            </a>
        </div>
        <div class="col-6 col-md-4"> <!-- 同樣設定為居中的寬度 -->
            <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="input-group w-100">
                    <select name="status" id="status" class="form-select">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>未處理</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>撿貨中</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>運送中</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>完成</option>
                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }} disabled>取消</option>
                    </select>
                    <button class="btn btn-success" type="submit" {{ $order->status == 'canceled' || $order->status == 'completed' ? 'disabled' : '' }}
                    >更新狀態</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
