<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Prof;
use App\Models\Product;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_first_login' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }

    public function prof()
    {
        return $this->hasOne(Prof::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * ユーザーがいいねした商品一覧
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedProducts()
    {
        return $this->belongsToMany(Product::class, 'likes')->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }
}
