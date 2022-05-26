<?php

use App\Http\Controllers\Api\SiteOptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::prefix('admin')->group(function () {
  Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('settings')->group(function () {
      Route::name('settigns.')->middleware(['auth'])->group(function () {
        Route::resources([
          'options' => SiteOptionController::class,
        ]);
      });
    });
  });
});
