<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // ← 必ず追加


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

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // ユーザー名かメールアドレスで認証
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$field => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user(); // ログイン中のユーザー情報を取得:明示的にUserモデルとして扱う

            // ✅ 初回ログインチェック
            if ($user->is_first_login) {
                $user->is_first_login = false; // フラグを false に更新
                $user->save();

                return redirect('/mypage/profile'); // 初回ログイン先
            }

            return redirect()->intended('/mypage'); // 通常のログイン遷移先
        }

        return back()->withErrors([
            'login' => 'ユーザー名またはメールアドレス、またはパスワードが正しくありません。',
        ]);
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
