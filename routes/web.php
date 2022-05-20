<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('home');
})->name('home');



Route::view('/pages/slick', 'admin.pages.slick');
Route::view('/pages/datatables', 'admin.pages.datatables');
Route::view('/pages/blank', 'admin.pages.blank');


require __DIR__ . '/auth.php';

Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('/', function () {
    return redirect()->route('login', ['next' => route('admin.dashboard', null, false)]);
  })->name('');

  Route::match(['get', 'post'], '/dashboard', function () {
    return view('admin.pages.dashboard');
  })->middleware(['auth'])->name('dashboard');
});
