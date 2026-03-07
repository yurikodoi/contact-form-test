<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /**
     * 管理画面の初期表示
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contacts = Contact::paginate(7);
        $categories = Category::all();

        return view('contact-admin', compact('contacts', 'categories'));
    }

    /**
     * お問い合わせの検索実行
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function searchContacts(Request $request)
    {
        $query = Contact::query();

        // キーワード検索（名前 or メール）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 種類検索
        if ($request->filled('inquiry_type')) {
            $query->where('category_id', $request->inquiry_type);
        }

        // 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);
        
        // Viewでセレクトボックスを表示するために必ず取得する
        $categories = Category::all();

        return view('contact-admin', compact('contacts', 'categories'));
    }

    /**
     * CSVエクスポート処理
     *
     * @return StreamedResponse
     */
    public function exportContacts()
    {
        $csvFileName = 'contacts_export.csv';
        $contacts = Contact::all();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            
            // 文字化け対策（Excel対応）
            stream_filter_append($handle, 'convert.iconv.UTF-8/CP932//TRANSLIT');

            // ヘッダー
            fputcsv($handle, ['お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $this->getGenderLabel($contact->gender),
                    $contact->email,
                    $contact->phone1 . $contact->phone2 . $contact->phone3,
                    $contact->address,
                    $contact->building ?? '',
                    $contact->category->name ?? '不明', // IDではなく名前を出す
                    $contact->message
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$csvFileName}",
        ]);

        return $response;
    }

    /**
     * 性別IDをラベルに変換（プライベートメソッド）
     *
     * @param int $genderId
     * @return string
     */
    private function getGenderLabel(int $genderId): string
    {
        $labels = [1 => '男性', 2 => '女性', 3 => 'その他'];
        return $labels[$genderId] ?? '不明';
    }

/**
     * お問い合わせデータの削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // 1. 対象のデータを取得
        $contact = Contact::find($id);

        // 2. データが存在しない場合の安全策
        if (!$contact) {
            return redirect()->route('contact.index')->with('error', '対象のデータが見つかりませんでした。');
        }

        // 3. 削除実行
        $contact->delete();

        // 4. 一覧画面へリダイレクト
        return redirect()->route('contact.index')->with('success', 'お問い合わせを削除しました。');
    }
}




