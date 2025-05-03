<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'comment'];

    /**
     * コメントの投稿者（ユーザー）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * コメントが紐づく商品
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
