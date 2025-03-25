<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Ecpay\Sdk\Factories\Factory;
use Ecpay\Sdk\Services\UrlService;
use Ecpay\Sdk\Response\VerifiedArrayResponse;
use Illuminate\Http\Request;

require __DIR__ . '/../../../../vendor/autoload.php';

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $factory = new Factory([
            'hashKey' => env('ECPAY_HASH_KEY'),
            'hashIv'  => env('ECPAY_HASH_IV'),
        ]);
        $autoSubmitFormService = $factory->create('AutoSubmitFormWithCmvService');
        
        $input = [
            'MerchantID'        => env('ECPAY_MERCHANT_ID'),
            'MerchantTradeNo'   => $request->MerchantTradeNo,
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'PaymentType'       => 'aio',
            'TotalAmount'       => $request->TotalAmount,
            'TradeDesc'         => UrlService::ecpayUrlEncode($request->ItemName),
            'ItemName'          => $request->ItemName,
            'ChoosePayment'     => 'ALL',
            'EncryptType'       => 1,
        
            // 請參考 example/Payment/GetCheckoutResponse.php 範例開發
            'ReturnURL'         => 'https://www.ecpay.com.tw/example/receive',
            'OrderResultURL'    => '',
            // https://a970-118-163-218-100.ngrok-free.app/getOrder
        ];
        $action = env('ECPAY_URL');
        
        echo $autoSubmitFormService->generate($input, $action);
    }

    public function getCheckoutResponse(){
        $factory = new Factory([
            'hashKey' => env('ECPAY_HASH_KEY'),
            'hashIv'  => env('ECPAY_HASH_IV'),
        ]);
        $checkoutResponse = $factory->create(VerifiedArrayResponse::class);
        
        // 模擬綠界付款結果回傳格式範例，非真實付款結果
        $_POST = [
            'MerchantID'           => env('ECPAY_MERCHANT_ID'),
            'MerchantTradeNo'      => 'WPLL4E341E122DB44D62',
            'PaymentDate'          => '2019/05/09 00:01:21',
            'PaymentType'          => 'Credit_CreditCard',
            'PaymentTypeChargeFee' => '1',
            'RtnCode'              => '1',
            'RtnMsg'               => '交易成功',
            'SimulatePaid'         => '0',
            'TradeAmt'             => '500',
            'TradeDate'            => '2019/05/09 00:00:18',
            'TradeNo'              => '1905090000188278',
            'CheckMacValue'        => '6E7F053EF215FC851A050A2FF01D72CBE440EA138DC3E905647985DDF236FD25',
        ];
        
        var_dump($checkoutResponse->get($_POST));
    }

    public function checkOutTest(Request $request){
        $TotalAmount = $request->TotalAmount;
        return view('frontend.member.checkout',compact('TotalAmount'));
    }
}
