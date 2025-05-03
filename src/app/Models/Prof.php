<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    use HasFactory;

    protected $table = 'profs'; // 明示的にテーブル名を指定

    protected $fillable = [
        'user_id',
        'postal_code',
        'address',
        'building',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
