<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// 1. 一般ユーザー用（お問い合わせフォーム）
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// 2. 管理者用（ログインしているユーザーのみアクセス許可）
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/reset', function () {
        return redirect()->route('admin.index');
    })->name('admin.reset');
    Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
});