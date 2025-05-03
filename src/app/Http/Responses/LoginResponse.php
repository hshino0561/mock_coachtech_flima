<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // セッションに intended が残っているなら削除（優先回避）
        $request->session()->forget('url.intended');

        // デバッグ用
        Log::info('現在のログレベル: ' . config('logging.channels.stack.level'));
        Log::info(' LoginResponse executed. is_first_login = ' . json_encode($user->is_first_login));

        if (!$user->is_first_login) {
            return redirect('/mypage/profile');
        }

        return redirect('/?page=mylist');
    }
}
