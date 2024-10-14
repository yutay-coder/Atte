<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Author;

//追加
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
//Auth クラスをインポートする記述を追加
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // ログインフォーム表示
    public function showLoginForm()
    {
        return view('login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 認証成功時のリダイレクト
            return redirect()->intended('/');
        }

        // 認証失敗
        return redirect()->back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています。',
        ]);
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout(); // ユーザーのログアウト
        $request->session()->invalidate(); // セッションの無効化
        $request->session()->regenerateToken(); // CSRFトークンの再生成

        return redirect('/login'); // ログインページへリダイレクト
    }
}
