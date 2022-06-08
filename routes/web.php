<?php

use App\Http\Controllers\GoToProductController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\MerchantController;
use App\Http\Controllers\Public\PageController as FrontPageController;
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
Route::get('/store/{slug}', [MerchantController::class, 'show'])->name('merchant');
Route::get('/click.php', [GoToProductController::class, 'reloadToShop'])->name('goto_product');

Route::get('/search', [SearchController::class, 'show'])->name('search');
Route::post('/search', [SearchController::class, 'show_erotic_items'])->name('show_erotic_items');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/{path?}', [FrontPageController::class, 'show'])->where(['path' => '.*'])->name('page');
