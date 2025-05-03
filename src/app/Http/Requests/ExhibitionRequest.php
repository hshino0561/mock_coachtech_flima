<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // 認可チェック。必要に応じて変更
    }

    public function rules(): array
    {
        return [
            'product-image' => 'required|file|mimes:jpeg,png|max:2048',
            'category_ids' => 'required|string',
            'condition_id' => 'required',
            'product_name' => 'required|string|max:255',
            'brand' => 'required|string|max:50',
            'product_description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'product-image.required' => '画像を選択してください。',
            'product-image.mimes' => '画像は .jpeg または .png 形式でアップロードしてください',
            'product-image.image' => 'アップロードできるのは画像ファイルのみです',
            'product-image.max' => '画像のサイズは2MB以内にしてください',
            'category_ids.required' => 'カテゴリを1つ以上選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'product_name.required' => '商品名を入力してください',
            'brand.required' => 'ブランド名を入力してください',
            'product_description.required' => '商品の説明を入力してください',
            'price.required' => '販売価格を入力してください',
            'price.numeric' => '販売価格は数値で入力してください',
            'price.min' => '販売価格は0円以上にしてください',
        ];
    }
}
