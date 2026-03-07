<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    /**
     * お問い合わせ入力画面を表示する
     */
    public function showForm()
    {
        // カテゴリー一覧を取得
        $categories = Category::all();

        // 【重要】入力画面を表示するだけなので、validatedDataは渡しません。
        // これで「未定義の変数」エラーの根本原因を断ちます。
        return view('contact-form', compact('categories'));
    }

    /**
     * 入力内容をチェックして確認画面を表示する
     */
    public function handleForm(ContactFormRequest $request)
    {
        // バリデーション成功済みのデータを取得
        $validatedData = $request->validated();
        
        $categories = Category::all();

        // 確認画面を表示（ここで初めて $validatedData を渡す）
        return view('contact-confirm', compact('validatedData', 'categories'));
    }
}
