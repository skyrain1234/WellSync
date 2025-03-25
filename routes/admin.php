<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Footer_infoController;
use App\Http\Controllers\Backend\Footer_socialController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Middleware\AdminMiddleware;

// 路由群組，使用 auth 和 admin 兩個 middleware，並且設定路徑前綴為 'admin'
// resource會自動定義controller裡的所有function的路由  blade就可以直接呼叫 ex admin.category.create

Route::prefix('admin')->as('admin.')->group(function (){
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    
    Route::middleware(AdminMiddleware::class)->group(function(){
        // 顧客列表
        Route::get('customer', [CustomerListController::class, 'index'])->name('customer.index');
        // 顧客狀態變更
        Route::post('customer/status_change', [CustomerListController::class, 'changeStatus'])->name('customer.status_change');

        // 訂單管理
        Route::resource('order', OrderController::class);

        // 後台儀表板
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/new-users',[DashboardController::class,'getNewMember'] ) ;
        Route::get('/monthly-new-users', [DashboardController::class, 'getMonthlyNewUsers']);
        Route::get('/monthly-orders', [DashboardController::class, 'getMonthlyOrders']);
        Route::get('/monthly-inventory', [DashboardController::class, 'getInventory']);
        Route::get('/monthly-reports', [DashboardController::class, 'getMonthlyReports']);

        // **Product 模块**
        Route::prefix('product')->as('product.')->group(function () {
            // 商品分類
            Route::resource('category', CategoryController::class);
            Route::post('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');

            // 商品管理
            Route::resource('productList', ProductController::class);
            Route::post('productList/change-status', [ProductController::class, 'changeStatus'])->name('productList.change-status');
            Route::get('stock-zero', [ProductController::class, 'showStockZero'])->name('stockZero');
            });
            

        // **html模塊**
        Route::prefix('htmlContent')->as('htmlContent.')->group(function () {
            // 頁尾
            Route::resource('footer_info', Footer_infoController::class);
            Route::post('footer_info/change-status', [Footer_infoController::class, 'changeStatus'])->name('footer_info.change-status');

            Route::resource('footer_social', Footer_socialController::class);
            Route::post('footer_social/change-status', [Footer_socialController::class, 'changeStatus'])->name('footer_social.change-status');

            });
    });
    

});