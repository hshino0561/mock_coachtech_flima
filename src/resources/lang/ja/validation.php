<?php

return [
    'required' => ':attribute を入力してください。',
    'email' => ':attribute は有効なメールアドレス形式で入力してください。',
    'unique' => 'この :attribute は既に使用されています。',
    'confirmed' => ':attribute が確認用と一致しません。',
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attribute は :max 文字以下で入力してください。',
    ],

    // フィールド名のカスタマイズ
    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => '確認用パスワード',
    ],
];
