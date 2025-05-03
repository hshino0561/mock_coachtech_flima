<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * 一括代入を許可する属性
     */
    protected $fillable = ['user_id', 'product_id'];

    /**
     * この「いいね」が紐づくユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * この「いいね」が紐づく商品
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
