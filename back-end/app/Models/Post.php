<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // タイムスタンプ無効
    public $timestamps = false;
    protected $guarded = ['id'];
}
