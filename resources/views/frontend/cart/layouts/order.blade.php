<!-- 總金額 -->
 <style>
    .bigcard{
        background-color: rgba(255, 255, 255, 0);
    }
    .smallcard{
        background-color: rgba(163, 163, 163, 0.05);
    }
 </style>
<div class="card mb-4 bigcard">
    <div class="card-head">
        <h2 class="text-center fw-bold mt-2 text-title">您的方案</h2>
    </div>
    <div class="card-body">
        <!-- 原始價格 -->
        <div class="card smallcard">
            <div class="card-body">
                <table class="table table-borderless align-middle">
                    <tbody>
                        <tr>
                            <td class="text-start w-50 ">客製化咖米營養方案</td>
                            <td class="text-end">NT$</td>
                            <td class="text-end"><strong id="cart-total">{{$cartTotal}}</strong></td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
        <!-- 運送方式 -->
        <div class="card my-2 smallcard">
            <div class="card-head">
                <h4 class="fw-bold text-center my-2 text-title">運送方式</h4>
            </div>
            <div class="card-text">
                <table class="table table-borderless align-middle">
                    <tbody>
                        <tr>
                            <td class="text-start w-50 ">原始運費</td>
                            <td class="text-end">NT$</td>
                            <td class="text-end"><strong id="shipping-fee">0</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start w-50">超過1000免運</td>
                            <td class="text-end">NT$</td>
                            <td class="text-end"><strong id="shipping-discount">0</strong></td>
                        </tr>
                    </tbody>
                    <tfoot class="border-top border-dark">
                        <tr>
                            <td class="text-start w-50">最終運費</td>
                            <td class="text-end">NT$</td>
                            <td class="text-end"><strong id="final-shipping">0</strong></td>
                        </tr>
                    </tfoot>
                </table>    
            </div>
        </div>
        <!-- 最終金額 -->
        <div class="card my-3 smallcard">
            <div class="card-text">
                <table class="table table-borderless ">
                    <tbody>
                        <tr>
                            <td class="text-start w-50">總金額</td>
                            <td class="text-end">NT$</td>
                            <td class="text-end"><strong id="final-total">{{$cartTotal}}</strong></td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
        <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
            @csrf
            @if(!empty($userInfo)) 
            <div class="form-check form-check-inline mb-3">
                <input type="radio" class="form-check-input" name="shipping" id="black_cat" value="blackCat" required>
                <label for="black_cat" class="form-check-label">宅配</label>
            </div>
            <!-- 選擇縣市 -->
             <div class="row d-none" id="select-country">
                <div class="col-6">
                    <div class="mb-3">
                        <select class="form-select" aria-label="選擇縣市" id="city" name="city">
                        </select>
                    </div>
                </div>
                <!-- 鄉鎮市區選擇 -->
                <div class="col-6">
                    <div class="mb-3">
                        <select class="form-select" aria-label="選擇鄉鎮市區" id="area" name="area">
                            <option value="">請選擇鄉鎮市區</option>
                        </select>
                    </div>
                </div>
                <!-- 郵遞區號 -->
                <div class="col-6">
                    <div class="mb-3">
                        <input type="hidden" class="form-control"  id="zipcode" name="zipcode" value="">
                    </div>
                </div>
                <!-- 詳細住址 -->
                <div class="col-12">
                    <div class="mb-3">
                        <input type="text" class="form-control"  id="address" name="address" value="" placeholder="請輸入收件者地址">
                        <div id="address-error" class="text-danger d-none">請填入收件者地址</div>
                    </div>
                </div> 
             </div>
                <div class="mb-3">
                    <label for="receiver">收件者姓名</label>
                    <input type="text" class="form-control" name="receiver" id="receiver" placeholder="收件者姓名" required value="{{ $userInfo->first()->name ?? '' }}">
                    <small class="text-danger d-none" id="receiver-error">請輸入收件者姓名</small>
                </div>
                <div class="mb-3">
                    <label for="email">電子信箱</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="電子信箱" required value="{{ $userInfo->first()->email ?? '' }}">
                    <small class="text-danger d-none" id="email-error">請輸入有效的電子信箱</small>
                </div>
                <div class="mb-3">
                    <label for="phone">手機號碼</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="手機號碼" required
                    value="{{ $userInfo->first()->phone ?? '' }}">
                    <small class="text-danger d-none" id="phone-error">請輸入正確的手機號碼（09開頭，共10碼）</small>
                </div>
            @endif


            <input type="hidden" name="cart_total" id="cart_total_input" value="">
            <input type="hidden" name="shipping_fee" id="shipping_fee_input" value="">

            <div class="row ">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn_addToCart mt-3">訂購</button>
                </div>
            </div>
           
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        let cityData = []; // 用來存 JSON 內的資料

        function updateShipping() {
            let cartTotal = parseFloat($("#cart-total").text());

            if ($("#black_cat").is(":checked")) {
                let shippingFee = cartTotal >= 1000 ? 0 : 80; // 1000 免運
                let finalTotal = cartTotal + shippingFee;

                // 更新畫面
                $("#shipping-fee").text(80);
                $("#shipping-discount").text(shippingFee === 0 ? "-80" : "0");
                $("#final-shipping").text(shippingFee);
                $("#final-total").text(finalTotal);

                // 更新隱藏 input，確保結帳時傳遞正確資料
                $("#cart_total_input").val(finalTotal);
                $("#shipping_fee_input").val(shippingFee);
            }
        }

        // 頁面載入時先執行一次
        updateShipping();

        // 監聽「宅配」選取事件
        $("#black_cat").change(function () {
            updateShipping();
            $('#select-country').removeClass("d-none");
            // 初始化select2
            $('.form-select').select2({language: 'zh-CN'});
            
                $.ajax({
                type: "GET",
                url: "{{ asset('frontend/js/CityCountyData.json') }}", // 確保路徑正確
                dataType: "json", // 修正大小寫
                success:function(data){
                    cityData = data; // 儲存數據
                    loadCities(cityData); // 載入縣市
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("AJAX 錯誤:", textStatus, errorThrown);
                }
            });

            // 載入縣市
            function loadCities(data) {
                
                let cityDropdown = $("#city");
                cityDropdown.empty().append('<option value="">請選擇縣市</option>'); // 初始化

                $.each(data, function (index, city) {
                    cityDropdown.append(`<option value="${city.CityName}">${city.CityName}</option>`);
                });
            }; // end function

            // 當選擇縣市時，動態載入對應的鄉鎮市區
            $("#city").change(function () {
                let selectedCity = $(this).val();
                let areaDropdown = $("#area");

                areaDropdown.empty().append('<option value="">請選擇鄉鎮市區</option>'); // 初始化
                $("#zipcode").val(""); // 重置郵遞區號

                if (selectedCity) {
                    let selectedData = cityData.find(city => city.CityName === selectedCity);                    
                    if (selectedData && selectedData.AreaList) {
                        $.each(selectedData.AreaList, function (index, area) {
                            areaDropdown.append(`<option value="${area.AreaName}">${area.AreaName}</option>`);
                        });
                    }
                }
            });// end function

            // 當選擇鄉鎮市區時，更新郵遞區號
            $("#area").change(function () {
                let selectedCity = $("#city").val();
                let selectedArea = $(this).val();

                if (selectedCity && selectedArea) {
                    let selectedData = cityData.find(city => city.CityName === selectedCity);
                    if (selectedData && selectedData.AreaList) {
                        let areaData = selectedData.AreaList.find(area => area.AreaName === selectedArea);
                        if (areaData) {
                            $("#zipcode").val(areaData.ZipCode);
                        }
                    }
                }
            });
        }); //end function

        // 監聽表單事件
        $("#checkout-form").submit(function (e) {
            let isValid = true;

            let receiver = $("#receiver").val().trim();
            let email = $("#email").val().trim();
            let phone = $("#phone").val().trim();
            let address = $("#address").val().trim(); // 取得住址欄位的值

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let phonePattern = /^09\d{8}$/; // 台灣手機格式 09XXXXXXXX (共 10 位數)

            // 驗證姓名
            if (receiver === "") {
                $("#receiver-error").removeClass("d-none");
                isValid = false;
            } else {
                $("#receiver-error").addClass("d-none");
            }

            // 驗證電子信箱
            if (!emailPattern.test(email)) {
                $("#email-error").removeClass("d-none");
                isValid = false;
            } else {
                $("#email-error").addClass("d-none");
            }

            // 驗證手機號碼
            if (!phonePattern.test(phone)) {
                $("#phone-error").removeClass("d-none");
                isValid = false;
            } else {
                $("#phone-error").addClass("d-none");
            }

            // 驗證住址，僅當選擇「宅配」時進行驗證
            if ($("#black_cat").is(":checked")) {
                if (address === "") {
                    $("#address-error").removeClass("d-none"); // 顯示住址錯誤訊息
                    isValid = false;
                } else {
                    $("#address-error").addClass("d-none"); // 隱藏住址錯誤訊息
                }
            }
            if (!isValid) {
                e.preventDefault(); // 阻止表單送出
            }
        }); //end function
    });
</script>
