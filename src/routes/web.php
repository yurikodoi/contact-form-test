<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ContactConfirmController;
use App\Http\Controllers\ContactThanksController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactDeleteController;
use App\Http\Controllers\ContactController;



// --- お問い合わせフロー ---
// 1. お問い合わせ入力画面
Route::get('/', [ContactFormController::class, 'showForm'])->name('contact.form');

// 2. 入力画面から「確認」を押した時
Route::post('/confirm', [ContactFormController::class, 'handleForm'])->name('contact.confirm');

// 3. 確認画面から「送信」または「修正」を押した時
Route::post('/submit', [ContactConfirmController::class, 'submitForm'])->name('contact.submit');

// 4. 完了画面
Route::get('/thanks', [ContactThanksController::class, 'showThanks'])->name('contact.thanks');


// --- 管理画面系 ---
Route::middleware('auth')->group(function () {

    // 管理画面トップ
    Route::get('/admin', [AdminController::class, 'index'])->name('contact.index');

    // 検索機能
    Route::get('/admin/search', [AdminController::class, 'searchContacts'])->name('contact.search');

    // CSVエクスポート
    Route::get('/export', [AdminController::class, 'exportContacts'])->name('contact.export');

    // 削除機能
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('contact.delete');

    Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
    })->name('logout');

    Route::get('/admin', [AdminController::class, 'index'])->name('contact.index');
});



