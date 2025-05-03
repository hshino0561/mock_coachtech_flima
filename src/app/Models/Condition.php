<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Condition extends Model
{
    use HasFactory;

    // 明示的にfillableを指定（セキュリティ対策）
    protected $fillable = ['label'];
}
