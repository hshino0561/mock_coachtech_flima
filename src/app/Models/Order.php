<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'item_id',
        'price',
        'delivery_postal_code',
        'delivery_address',
        'delivery_building',
        'payment_method',
    ];

    // リレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id'); // 外部キーが item_id の場合
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
