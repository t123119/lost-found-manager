<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostItemController;

// 1. トップページにアクセスしたら一覧画面を表示する
Route::get('/', [LostItemController::class, 'index'])->name('top');

// 2. 登録完了画面
Route::get('items/complete', function () {
    return view('items.complete');
})->name('items.complete');

// 3. 検索画面
Route::get('items/search', [LostItemController::class, 'search'])->name('items.search');

// 4. CRUD基本ルート
Route::resource('items', LostItemController::class);