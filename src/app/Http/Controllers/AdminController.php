<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /**
     * 管理画面の表示 兼 検索処理
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        
        // 検索ロジックを共通メソッドで実行
        $query = $this->applySearch($request);

        // 7件ずつ表示 ＋ 検索条件をURLに保持
        $contacts = $query->paginate(7)->appends($request->all());

        return view('admin', compact('contacts', 'categories'));
    }

    /**
     * 検索機能（ルート用：indexを再利用）
     */
    public function searchContacts(Request $request)
    {
        return $this->index($request);
    }

    /**
     * CSVエクスポート
     */
    public function exportContacts(Request $request)
    {
        // 検索ロジックを共通メソッドで実行
        $contacts = $this->applySearch($request)->get();

        $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容'];

        $callback = function () use ($contacts, $csvHeader) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvHeader);

            foreach ($contacts as $contact) {
                $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];
                fputcsv($file, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $genderLabels[$contact->gender] ?? '不明',
                    $contact->email,
                    $contact->category->name ?? '不明',
                    $contact->detail,
                ]);
            }
            fclose($file);
        };

        $fileName = "contacts_" . date('YmdHis') . ".csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        return response()->stream($callback, 200, $headers);
    }

    /**
     * 削除機能
     */
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('contact.index')->with('success', 'データを削除しました');
    }

    /**
     * 【共通メソッド】検索条件をクエリに適用する
     */
    private function applySearch(Request $request)
    {
        $query = Contact::query()->with('category');

        // キーワード検索
        if ($keyword = $request->input('keyword')) {
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'LIKE', "%{$keyword}%")
                ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhereRaw('CONCAT(last_name, first_name) LIKE ?', ["%{$keyword}%"])
                ->orWhereRaw('CONCAT(last_name, " ", first_name) LIKE ?', ["%{$keyword}%"]);
            });
        }

        // 性別検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 種類検索
        if ($type = $request->input('inquiry_type')) {
            $query->where('category_id', $type);
        }

        // 日付検索
        if ($date = $request->input('date')) {
            $query->whereDate('created_at', $date);
        }

        return $query;
    }
}