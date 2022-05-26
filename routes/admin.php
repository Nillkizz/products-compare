<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SiteOptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
  Route::get('/', function () {
    if (auth()->user()) return redirect()->route('admin.dashboard');
    return redirect()->route('login', ['next' => route('admin.dashboard', null, false)]);
  })->name('admin');

  Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/merchants', [MerchantController::class, 'list'])->name('merchants');
    Route::get('/products', [ProductController::class, 'list'])->name('products');

    Route::prefix('settings')->group(function () {
      Route::name('settigns.')->middleware(['auth'])->group(function () {
        Route::get('/options', [SiteOptionController::class, 'list'])->name('siteoptions');
      });
    });
  });
});
