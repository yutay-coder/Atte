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

//ユーザー認証機能の追加に際し追加
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    // 会員登録フォーム表示
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            //required：必須、型、最小最大文字数、unique:users：一意、
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|max:191|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('register')->with('success', '会員登録が完了しました。ページ下のボタンよりログインページに遷移してログインしてください。');
    }

    /* メール認証用
    // 会員登録処理
    public function register(Request $request)
    {
        $request->validate([
            //required：必須、型、最小最大文字数、unique:users：一意、
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|max:191|confirmed',
        ]);

        $token = Str::random(60); // 認証用トークンを生成

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => $token, // トークンを保存
        ]);

        // メール送信
        Mail::to($user->email)->send(new VerifyEmail($token));

        return redirect()->route('register')->with('success', '会員登録が完了しました。メールを確認して認証してください。');
    }
    */
}
