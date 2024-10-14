<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', '無効なトークンです。');
        }

        $user->email_verified_at = now();
        $user->email_verification_token = null; // トークンをクリア
        $user->save();

        return redirect('/')->with('success', 'メールアドレスが認証されました。');
    }
}
