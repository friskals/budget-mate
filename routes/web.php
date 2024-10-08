<?php

use App\Http\Controllers\Frontsite\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontsite\AccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('category')->group(function (){
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

Route::prefix('account')->group(function (){
    Route::post('/', [AccountController::class, 'store'])->name('account.store');
    Route::get('/{id}', [AccountController::class,'show'])->name('account.show');
    Route::put('/{id}', [AccountController::class,'update'])->name('account.update');
    Route::delete('/{id}', [AccountController::class,'destroy'])->name('account.destroy');
});

Route::prefix('/transaction')->group(function (){
   Route::post('/', [TransactionController::class, 'store'])->name('transaction.store');
});
