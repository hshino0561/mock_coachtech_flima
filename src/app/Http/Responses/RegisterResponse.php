<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // デバッグ用
        // Log::info('RegisterResponse is working');
        // return response('Now on email verify page. User: ' . Auth::id());
        return redirect()->route('verification.notice');
    }
}
