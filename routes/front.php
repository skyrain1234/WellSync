<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // ✅ 使用 GD 驅動（內建於 PHP）
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\UserProfileController;
use Illuminate\Support\Facades\Response; // ✅ Laravel 的 Response 類
use App\Http\Controllers\Frontend\AssessmentController;
use App\Http\Controllers\Frontend\QuizController;
use App\Http\Controllers\Frontend\UserScoreData;

// 首頁
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// about
Route::get('/about', [AboutController::class, 'index'])->name('about');


// 影像處理（適用 v3）
Route::get('image', function(){
    // 創建 ImageManager 實例（使用 GD 驅動）
    $manager = new ImageManager(new Driver());

    // 讀取圖片
    $img = $manager->read('babyball.png');

    // 裁剪圖片（智能裁切居中）
    $img = $img->cover(width: 300, height: 300);

    // 儲存圖片（可選擇格式）
    $img->toJpeg(100)->save('babyball_processed.jpg'); // 儲存為新檔案，品質 100%

    // **回傳圖片作為 HTTP 響應**
    return response($img->toPng()->toString())->header('Content-Type', 'image/png');
});


// ✅ 【購物車頁面】
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// ✅ 【購物車功能】
// 加入購物車
Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('add-to-cart');

// 移除購物車商品
Route::get('/remove-product/{id}', [CartController::class, 'remove'])->name('remove-product');

// ✅ 【更新購物車數量】
Route::post('/update-cart/{id}', [CartController::class, 'update'])->name('update-cart');

Route::match(['get', 'post'], '/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::get('/cart/item-count', [CartController::class, 'getCartItemCount']);


// ✅ 【商店頁面】
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/search', [ShopController::class, 'search'])->name('shop.search');
Route::get('/shop/category/{id}', [ShopController::class, 'categoryFilter'])->name('shop.category');

// 商品詳細
Route::get('/prodcut-detail/{name}',[ShopController::class, 'showProduct'])->name('shop.product-detail');

// 結帳、評論等需要登入的功能
Route::middleware(['auth'])->group(function () {
    // 結帳
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    
    // 會員後台
    Route::get('/member/profile', [UserProfileController::class, 'index'])->name('member.profile');
    Route::put('/member/profile/edit', [UserProfileController::class, 'profileEdit'])->name('member.profile.edit');
    Route::get('/member/profile/orderDetail/{id}', [UserProfileController::class, 'orderDetail'])->name('member.profile.orderDetail');
    Route::put('/member/profile/orderDetail/update/{id}', [UserProfileController::class, 'orderUpdate'])->name('member.profile.orderDetail.update');
    // 串接綠界測試
    Route::get('/createOrder',[PaymentController::class,'createOrder'])->name('createOrder');
    // 撰寫評論頁面
    Route::get('/reviews/write', function () {
        return view('frontend.reviews.write');
    })->name('reviews.write');

    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
});



// ✅ 【獨立的評論頁面】（只顯示評論）
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews.index');

Route::get('/assessment', [AssessmentController::class, 'index'])->name('assessment.index');
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');


//顯示問題頁面的路由
Route::get('showQuestions', [QuizController::class, 'showQuestionsView'])->name('questions.view');
//透過ajax取得問題
Route::post('showQuestions', [QuizController::class, 'showQuestions'])->name('questions.show');

// 處理答案的路由
Route::post('/submitAnswers', [QuizController::class, 'submitAnswers'])->name('questions.submit');
// 將推薦商品加入購物車
Route::post('/recommend-products', [QuizController::class, 'getRecommendations'])->name('quiz.recommend');

// 獲取分數
Route::get('/Score', [UserScoreData::class, 'getUserScoreData']);