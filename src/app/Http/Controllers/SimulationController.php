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

class SimulationController extends Controller
{
    public function index(){
        //index.blade.php を呼び出す
        return view('index');
        /*
        $item = [
            'content' => '本文'
        ];
        return view('index', $item);
        */
    }

    // 会員登録
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

    // ログイン
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 認証成功時のリダイレクト
            return redirect()->intended('home');
        }

        // 認証失敗
        return redirect()->back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています。',
        ]);
    }

    public function attendance()
    {
       //attendance.blade.php を呼び出す
        return view('attendance');
    }
}
