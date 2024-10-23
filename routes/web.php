<?php

use App\Http\Controllers\Frontsite\AccountController;
use App\Http\Controllers\Frontsite\BudgetController;
use App\Http\Controllers\Frontsite\BudgetUsageController;
use App\Http\Controllers\Frontsite\CategoryController;
use App\Http\Controllers\Frontsite\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function (){
    Route::prefix('category')->group(function (){
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    Route::prefix('account')->group(function (){
        Route::get('/', [AccountController::class, 'index'])->name('account.index');
        Route::get('/create', [AccountController::class, 'create'])->name('account.create');
        Route::get('/edit/{id}', [AccountController::class, 'edit'])->name('account.edit');
        Route::post('/', [AccountController::class, 'store'])->name('account.store');
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
        Route::get('/create', [BudgetController::class, 'create'])->name('budget.create');
        Route::get('/', [BudgetController::class, 'index'])->name('budget.index');
        Route::post('/', [BudgetController::class, 'store'])->name('budget.store');
        Route::get('/edit/{id}', [BudgetController::class, 'edit'])->name('budget.edit');
        Route::put('/{id}', [BudgetController::class, 'update'])->name('budget.update');
        Route::delete('/{id}', [BudgetController::class, 'destroy'])->name('budget.destroy');
        Route::prefix('/usage')->group(function (){
            Route::post('/',[BudgetUsageController::class, 'index'])->name('budget.usage');
        });
    });


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

//display login register in dashboard
require __DIR__.'/auth.php';
