<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Frontend\FormTitleController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\UserScoreData;

Route::get('/test',[CustomerListController::class,'test']);
//獲取綠界回傳
Route::post('/fake-payment-success', [PaymentController::class, 'fakePaymentSuccess'])->name('fake-payment-success');

Route::get('/formTitles', [FormTitleController::class, 'getFormTitles']); // 新增的路由
