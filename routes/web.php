<?php

use App\Http\Controllers\web\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('category', [CategoryController::class, 'index'])->name('category.index');
