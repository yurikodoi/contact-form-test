<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
// バリデーションルールを一括管理しているRequestクラスをインポート
use App\Http\Requests\ContactRequest; 

class ContactConfirmController extends Controller
{
    /**
     * 確認画面を表示する
     * web.phpで 'handleForm' を指定しているなら、名前を合わせる必要があります
     */
    public function handleForm(ContactRequest $request) // RequestではなくContactRequestにする
    {
        // バリデーション済みデータを取得
        $validatedData = $request->validated();
        
        $categories = Category::all();

        // 修正後のファイル名 'contact-confirm' を確実に指定
        return view('contact-confirm', compact('validatedData', 'categories'));
    }

    /**
     * データの保存処理
     */
    public function submitForm(Request $request)
    {
    // 「修正」ボタンの処理
    if ($request->input('action') === 'back') {
        return redirect()->route('contact.form')->withInput();
    }

    // 1. 全データを取得
    $data = $request->all();

    // 2. 名前のズレを「手動」で解消する
    $data['category_id'] = $request->inquiry_type; 
    $data['detail'] = $request->message;

    // 電話番号の合体
    $data['tel'] = $request->phone1 . $request->phone2 . $request->phone3;

    // 3. データベースに保存
    Contact::create($data);

    // 4. サンクスページにリダイレクト
    return redirect()->route('contact.thanks');
    }
}

