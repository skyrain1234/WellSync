<?php

// 必要的導入
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

// 引用 admin 跟 front 路由
require base_path('routes/admin.php');
require base_path('routes/front.php');



Auth::routes();



