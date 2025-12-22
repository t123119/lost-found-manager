<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('items/search', [LostItemController::class, 'search'])->name('items.search');
Route::resource('items', LostItemController::class);