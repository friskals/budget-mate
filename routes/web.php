<?php

use App\Http\Controllers\Frontsite\BudgetController;
use App\Http\Controllers\Frontsite\BudgetUsageController;
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

Route::prefix('transaction')->group(function (){
   Route::post('/', [TransactionController::class, 'store'])->name('transaction.store');
   Route::put('/{id}', [TransactionController::class, 'update'])->name('transaction.update');
   Route::get('/{id}', [TransactionController::class, 'show'])->name('transaction.show');
   Route::delete('/{id}', [TransactionController::class, 'delete'])->name('transaction.destroy');
});

Route::prefix('budget')->group(function (){
    Route::post('/', [BudgetController::class, 'store'])->name('budget.store');
    Route::put('/{id}', [BudgetController::class, 'update'])->name('budget.update');
    Route::get('/{id}', [BudgetController::class, 'show'])->name('budget.show');
    Route::delete('/{id}', [BudgetController::class, 'destroy'])->name('budget.destroy');

    Route::prefix('/usage')->group(function (){
       Route::post('/',[BudgetUsageController::class, 'index'])->name('budget.usage');
    });
});
