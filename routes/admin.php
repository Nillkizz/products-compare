<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
  Route::get('/', function () {
    return redirect()->route('login', ['next' => route('admin.dashboard', null, false)]);
  })->name('admin');

  Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'show'])->name('dashboard');
  });
});
