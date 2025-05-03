<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules()
    {
        return [
            'payment_method' => ['required', 'in:コンビニ支払い,カード支払い'],
            // 住所情報は nullable（プロフから取得される可能性あり）
            'postal_code'    => ['nullable'],
            'address'        => ['nullable'],
            'building'       => ['nullable'],
        ];
    }

    /**
     * カスタムバリデーション（プロフに情報がない場合のみ必須チェック）
     */
    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            $user = $this->user();
            $prof = $user->prof;

            // profの住所が1つでも欠けていて、かつフォームにも入力されていない場合にエラー
            foreach (['postal_code', 'address', 'building'] as $field) {
                $profileValue = $prof?->$field;
                $inputValue = $this->input($field);
                if (empty($profileValue) && empty($inputValue)) {
                    $v->errors()->add($field, '配送先情報を入力してください');
                }
            }
        });
    }

    /**
     * エラーメッセージ
     */
    public function messages()
    {
        return [
            'payment_method.required' => '支払い方法を選択してください',
            'payment_method.in'       => '支払い方法の選択が不正です',
        ];
    }
}
