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

// Example Routes
Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function () {
  return view('admin.dashboard');
});
Route::view('/pages/slick', 'admin.pages.slick');
Route::view('/pages/datatables', 'admin.pages.datatables');
Route::view('/pages/blank', 'admin.pages.blank');
