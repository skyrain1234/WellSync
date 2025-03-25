<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard.index'); // 已登入管理員直接進入後台
        }
        return view('auth.admin-login'); // 指向管理員登入頁面
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => app()->environment('local') ? 'nullable' : 'required',
        ]);
        
        // ✅ 本地環境時，沒勾選 reCAPTCHA 也顯示錯誤
        if (app()->environment('local') && !$request->input('g-recaptcha-response')) {
            return back()->withErrors(['captcha' => '請勾選 reCAPTCHA 驗證'])->with('error', '請勾選 reCAPTCHA 驗證');
        }
        
        // ✅ 正式環境時，才執行 reCAPTCHA API 驗證
        if (!app()->environment('local')) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => config('services.recaptcha.secret_key'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);
        
            $responseBody = $response->json();
        
            if (!$responseBody['success']) {
                $errorMessage = 'reCAPTCHA 驗證失敗，請重試。';
                if (isset($responseBody['error-codes'])) {
                    $errorMessage .= ' (' . implode(', ', $responseBody['error-codes']) . ')';
                }
                return back()->withErrors(['captcha' => $errorMessage]);
            }
        }

        // 驗證帳密
        $credentials = $request->only('email', 'password');

        // 先查找帳號是否存在
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->with('error', '帳號或密碼錯誤');
        }

        // 檢查角色權限
        if ($user->role !== 'admin') {
            return redirect()->route('home.index'); // 無權限
        }

        // 嘗試登入
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard.index'); // 進後台
        }

        return back()->with('error', '帳號或密碼錯誤'); // 密碼錯誤
        }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login'); // 登出後回到管理員登入頁
    }
}
