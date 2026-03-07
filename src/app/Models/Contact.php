<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // 保存を許可するカラムを指定します
    protected $fillable = [
        'category_id', // 👈 ここはDBの設計に合わせて inquiry_type か category_id か確認してください
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',          // 👈 電話番号を1つのカラムにするなら 'tel'
        'address',
        'building',
        'detail',       // 👈 お問い合わせ内容
    ];
    public function category()
    {
        // inquiry_type というカラムを Category の id と紐付ける
        return $this->belongsTo(Category::class, 'category_id');
    }
}