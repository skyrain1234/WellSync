<?php

// app/Http/Controllers/Api/AuthApiController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\CartSync;
use App\Traits\ScoreSync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    use CartSync, ScoreSync;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => '驗證錯誤',
                'errors'  => $validator->errors(),
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return response()->json(['message' => '帳號或密碼錯誤'], 401);
        }

        $user = $request->user();
        $this->syncCartWithDatabase($user);
        $this->syncScoreWithDatabase($request, $user);

        return response()->json([
            'message' => '登入成功',
            'user'    => $user,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => '已登出']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

