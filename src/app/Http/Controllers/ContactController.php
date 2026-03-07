<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // お問い合わせ入力画面の表示
    public function index()
    {
        return view('contact'); // contact.blade.php を表示する場合
    }

    // お問い合わせの確認・送信処理など
    public function store(Request $request)
    {
        // ここにバリデーションや送信処理を書く
    }
}