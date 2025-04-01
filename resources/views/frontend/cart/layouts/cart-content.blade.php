<div class="card mb-4">
    <div class="card-header py-3">
        <h5 class="mb-0">購物車 - {{ $cartItems->count() }} 件</h5>
    </div>
    <div class="card-body ">
        <div class="d-none d-lg-block">
            <table class="table table-hover table-bordered text-center" style="border: 1px solid #C2BCB1;">
                @if($cartItems->count() == 0)
                    <p class="text-center text-danger">您的購物車是空的！</p>
                    @else
                    <thead >
                        <tr class="fw-bold h5">
                            <td>產品圖片</td>
                            <td>產品名稱</td>
                            <td>數量/份(一份30顆)</td>
                            <td>單價</td>
                            <td>總價</td>
                            <td></td>
                        </tr>
                    </thead>
                @endif
                <tbody>

                @foreach ($cartItems as $cartItem)
                    <tr>
                        @php
                            $imagePath = isset($cartItem->image) ? $cartItem->image : $cartItem->attributes->image;
                        @endphp
                        <!-- 商品圖片 -->
                        <td>
                            @if (file_exists(public_path($imagePath)))
                                <img src="{{ asset($imagePath) }}" class="" style=" object-fit: contain;width:100px" />
                            @else
                                <img src="{{ asset('/images/default.png') }}" class="w-25" />
                            @endif
                        </td>
                        <!-- 商品名稱 -->
                        <td><p><strong>{{ $cartItem->name }}</strong></p></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <!-- 減少數量 -->
                                <form action="{{ Auth::check() ? route('cart.decrease', $cartItem->product_id) : route('cart.decrease', $cartItem->id) }}" method="POST" class="m-0">
                                        @csrf
                                    <button type="submit" class="btn btn_addToCart d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; padding: 0; border-radius: 6px;">
                                        &#8722;
                                    </button>
                                </form>

                                <!-- 顯示數量 -->
                                <input type="text" value="{{ $cartItem->quantity }}"
                                    class="form-control text-center"
                                    style="width: 50px; height: 40px; padding: 0; margin: 0; border-radius: 6px; 
                                        text-align: center; font-weight: bold; border: 1px solid #ccc; box-shadow: none;" readonly />

                                <!-- 增加數量 -->
                                <form action="{{ Auth::check() ? route('update-cart', $cartItem->product_id) : route('update-cart', $cartItem->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" name="quantity" value="{{ $cartItem->quantity + 1 }}"
                                        class="btn btn_addToCart btn-sm d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; padding: 0; border-radius: 6px;">
                                        &#43;
                                    </button>
                                </form>
                            </div>
                        </td>
                        <!-- 商品單價 -->
                        <td>${{ $cartItem->price }}</td>
                        <!-- 商品總價 -->
                        <td><strong>${{ $cartItem->price * $cartItem->quantity }}</strong></td>
                        <!-- 移除 -->
                        <td>
                            <a href="{{ Auth::check() ? route('remove-product', $cartItem->product_id) : route('remove-product', $cartItem->id) }}" class="btn btn-danger btn-sm ">
                                <i class="fa-solid fa-x"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-lg-none d-block">
                @if($cartItems->count() == 0)
                    <p class="text-center text-danger">您的購物車是空的！</p>
                @endif
                @foreach ($cartItems as $cartItem)
                    <div class="row mb-2">
                        <div class="col-6">
                            @php
                                $imagePath = isset($cartItem->image) ? $cartItem->image : $cartItem->attributes->image;
                            @endphp
                            <!-- 商品圖片 -->
                            @if (file_exists(public_path($imagePath)))
                                <img src="{{ asset($imagePath) }}" class="" style=" object-fit: cover;height:200px" />
                            @else
                                <img src="{{ asset('/images/default.png') }}" class="w-25" />
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="row mb-2">
                                <div class="col-9">
                                    <p><strong>{{ $cartItem->name }}</strong></p>
                                </div>
                                <div class="col-3">
                                    <a href="{{ Auth::check() ? route('remove-product', $cartItem->product_id) : route('remove-product', $cartItem->id) }}" class="btn btn-danger btn-sm ">
                                        <i class="fa-solid fa-x"></i>
                                    </a>
                                </div>
                                
                            </div>
                            <div class="row mb-2">
                                <div class="col-9">單價</div>
                                <div class="col-3"><p>${{ $cartItem->price }}</p></div>
                            </div>
                            <div class="row mb-2 ">
                                <div class="col-9">總價</div>
                                <div class="col-3">
                                    <p><strong>${{ $cartItem->price * $cartItem->quantity }}</strong></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center ">
                                <!-- 減少數量 -->
                                <form action="{{ Auth::check() ? route('cart.decrease', $cartItem->product_id) : route('cart.decrease', $cartItem->id) }}" method="POST" class="">
                                        @csrf
                                    <button type="submit" class="btn btn_addToCart d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; padding: 0; border-radius: 6px;">
                                        &#8722;
                                    </button>
                                </form>

                                <!-- 顯示數量 -->
                                <input type="text" value="{{ $cartItem->quantity }}"
                                    class="form-control text-center"
                                    style="width: 50px; height: 40px; padding: 0; margin: 0; border-radius: 6px; 
                                        text-align: center; font-weight: bold; border: 1px solid #ccc; box-shadow: none;" readonly />

                                <!-- 增加數量 -->
                                <form action="{{ Auth::check() ? route('update-cart', $cartItem->product_id) : route('update-cart', $cartItem->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" name="quantity" value="{{ $cartItem->quantity + 1 }}"
                                        class="btn btn_addToCart btn-sm d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; padding: 0; border-radius: 6px;">
                                        &#43;
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                @endforeach
        </div>

    </div>
</div>
