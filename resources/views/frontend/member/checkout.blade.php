<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>結帳</title>
    <link rel="icon" href="./image/food/logo_small.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('frontend/css/fenghua.css') }}">
    <link rel="stylesheet" href="css/fenghua_index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .checkout-container {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .checkout-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .checkout-header h1 {
            color: #212529;
        }
        .summary {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
        }
        .summary .total {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .btn-submit {
            background-color: #b89965;
            color: white;
            border: none;
            padding: 10px 20px;
        }
        .btn-submit:hover {
            color: white;
            background-color: rgb(19, 105, 71);
        }
        
    </style>
</head>
<body>

<div class="checkout-container">
    <div class="checkout-header">
        <h1>結帳</h1>
        <p>確認你的訂單並完成交易</p>
    </div>

    <div class="row">
        <!-- Order Summary -->
        <div class="col-md-8">
            <h4>Order Details</h4>
                <table class="table  table-hover align-middle" >
                    <thead>
                        <tr >
                            <th>產品名稱</th>
                            <th>數量/份</th>
                            <th>單價</th>
                            <th>總價</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $orderitem)
                        <tr >
                            <td>{{ optional($orderitem->product)->name ?? '產品已下架' }}</td>
                            <td>{{ $orderitem->quantity }}</td>
                            <td>${{ $orderitem->price }}</td>
                            <td>${{ $orderitem->quantity * $orderitem->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>

        <!-- Summary and Payment -->
        <div class="col-md-4">
            <div class="summary">
                <h4>Summary</h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>稅金</span>
                        <strong>0</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>總金額</span>
                        <strong id="total-price">${{$order->total_price}}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Payment Form -->
    <div class="mt-4">
        <h4>付款資訊/Payment Information</h4>
        <form action="{{ route('paymentSuccess',['id' => $order->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="cardName" class="form-label">持卡者姓名/Name on Card</label>
                <input type="text" class="form-control" name="cardName" id="cardName" placeholder="John Doe" required>
            </div>

            <div class="mb-3">
                <label for="cardNumber" class="form-label">卡號/Credit Card Number</label>
                <input type="text" class="form-control" name="cardNumber" id="cardNumber" placeholder="1234 5678 9012 3456" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="expiryDate" class="form-label">到期日/Expiry Date</label>
                    <input type="text" class="form-control" name="expiryDate" id="expiryDate" placeholder="MM/YY" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cvv" class="form-label">安全碼/CVV</label>
                    <input type="text" class="form-control" name="cvv" id="cvv" placeholder="123" required>
                </div>
            </div>
            <button type="submit" class="btn btn_addToCart w-100 mt-4" id="checkout_btn">確認交易</button>
        </form>
        
    </div>
</div>

<!-- js -->
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>
</body>
</html>