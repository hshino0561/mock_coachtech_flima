<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Prof;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;

class ProfController extends Controller
{
    // マイページ表示
    public function prof()
    {
        $user = Auth::user();
        $profile = Prof::where('user_id', $user->id)->first();
        $products = Product::where('user_id', $user->id)->get();

        return view('pg09_prof', [
            'user' => $user,
            'profile' => $profile,
            'products' => $products,
        ]);
    }

    public function mypage(Request $request)
    {
        $user = Auth::user();
        $page = $request->query('page', 'sell'); // デフォルトは「出品」

        if ($page === 'buy') {
            // 購入した商品を取得（ordersテーブルとのリレーション想定）
            $products = Product::whereHas('orders', function ($query) use ($user) {
                $query->where('buyer_id', $user->id);
            })->get();
        } else {
            // 出品した商品
            $products = Product::where('user_id', $user->id)->get();
        }

        return view('pg09_prof', compact('user', 'products', 'page'));
    }

    // プロフィール編集画面表示
    public function profUpd()
    {
        $user = Auth::user();
        $prof = $user->prof; // nullでもOK

        return view('pg10_prof_edit', compact('user', 'prof'));
    }

    // プロフィール更新処理
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2つのリクエストのバリデーションルールを結合
        $registerRules = (new RegisterRequest)->rules();

        $rules = array_merge(
            ['username' => $registerRules['name']], // ユーザー名のみ抽出
            (new AddressRequest)->rules(),
            (new ProfileRequest)->rules()
        );

        $messages = array_merge(
            [
                'username.required' => $registerMessages['name.required'] ?? 'お名前を入力してください',
            ],
            (new AddressRequest)->messages(),
            (new ProfileRequest)->messages()
        );

        Validator::make($request->all(), $rules, $messages)->validate();

        // ユーザー名更新
        $user->name = $request->input('username');
        $wasFirstLogin = !$user->is_first_login;

        if ($wasFirstLogin) {
            $user->is_first_login = true;
        }

        $user->save();

        // アバター処理
        $avatarName = null;
        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');
            $originalName = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $avatarFile->getClientOriginalExtension();
            $avatarName = $originalName . '_' . time() . '.' . $extension;
            $avatarFile->storeAs('public/avatars', $avatarName);
        }

        // profテーブルの更新
        $user->prof()->updateOrCreate(
            [],
            [
                'postal_code' => $request->postal_code,
                'address'     => $request->address,
                'building'    => $request->building,
                'avatar'      => $avatarName ?? optional($user->prof)->avatar,
            ]
        );

        return $wasFirstLogin ? redirect('/') : redirect()->route('mypage');
    }
}
