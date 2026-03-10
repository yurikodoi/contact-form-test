<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // 保存を許可するカラムを指定します
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];
    public function category()
    {
        // inquiry_type というカラムを Category の id と紐付ける
        return $this->belongsTo(Category::class, 'category_id');
    }
}