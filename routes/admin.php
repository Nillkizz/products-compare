<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SiteOptionController;
use App\Http\Controllers\Admin\StoreReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
  Route::get('/', function () {
    if (auth()->user()) return redirect()->route('admin.dashboard');
    return redirect()->route('login', ['next' => route('admin.dashboard', null, false)]);
  })->name('admin');

  Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::resource('/pages', PageController::class)->except('show');

    Route::resource('/store-reviews', StoreReviewController::class)->only('destroy');
    Route::post('/store-reviews/{store_review}/action', [StoreReviewController::class, 'action'])->name('action');

    Route::resource('/stores', StoreController::class)->except('show');
    Route::get('/stores/{store}/do_xml_import_products', [StoreController::class, 'do_xml_import_products'])->name('store.do_xml_import_products');

    Route::get('/products', [ProductController::class, 'list'])->name('products');

    Route::prefix('settings')->group(function () {
      Route::name('settings.')->group(function () {
        Route::resource('/options', SiteOptionController::class)->only(['index', 'update']);
      });
    });
  });
});
