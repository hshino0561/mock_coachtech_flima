<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ログイン画面の表示
    public function showLoginForm()
    {
        return view('auth.pg04_login');
    }

    // ログイン処理（LoginRequest に変更）
    public function login(LoginRequest $request)
    {
        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();

        if (!$user->is_first_login) {
            $user->is_first_login = true;
            $user->save();

            return redirect('/mypage/profile');
        }

        return redirect()->intended('/');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
