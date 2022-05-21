<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('/', function () {
    return redirect()->route('login', ['next' => route('admin.dashboard', null, false)]);
  })->name('');

  Route::get('/dashboard', [AdminDashboardController::class, 'show'])->middleware(['auth'])->name('dashboard');
  // Route::get('/dashboard', function () {
  //   return view('admin.pages.dashboard');
  // })->middleware(['auth'])->name('dashboard');
});
