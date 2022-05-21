<?php

use App\Http\Controllers\Pages\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('/', function () {
    return redirect()->route('login', ['next' => route('admin.dashboard', null, false)]);
  })->name('');

  Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth'])->name('dashboard');
  // Route::get('/dashboard', function () {
  //   return view('admin.pages.dashboard');
  // })->middleware(['auth'])->name('dashboard');
});
