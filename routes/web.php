<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\SearchController;
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

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/search', [SearchController::class, 'show'])->name('search');





require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
