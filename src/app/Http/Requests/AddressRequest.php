<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認可は一旦 true（ログイン中前提）
    }

    public function rules(): array
    {
        if ($this->is('mypage/profile')) {
            // プロフィール画面用
            return [
                // 'username'     => 'required',
                'postal_code'  => ['required', 'regex:/^\d{3}-\d{4}$/'],
                'address'      => 'required',
                'building'     => 'required',
            ];
        }

        // 配送先住所用（デフォルト）
        return [
            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address'     => 'required',
            'building'    => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            // 'username.required'     => 'お名前を入力してください',
            'postal_code.required'  => '郵便番号を入力してください',
            'postal_code.regex'     => 'ハイフンありの8文字（例：123-4567）で入力してください',
            'address.required'      => '住所を入力してください',
            'building.required'     => '建物名を入力してください',
        ];
    }
}
