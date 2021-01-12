<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BitController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TraderController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('stocks', [StockController::class, 'index']);
Route::prefix('stock')->group( function () {
    Route::post('store', [StockController::class, 'store']);
    Route::put('{id}', [StockController::class, 'update']);
    Route::delete('{id}', [StockController::class, 'destroy']);
});

Route::get('traders', [TraderController::class, 'index']);
Route::prefix('trader')->group( function () {
    Route::get('{id}/stock/{st_id}', [TraderController::class, 'stock']);
    Route::post('store', [TraderController::class, 'store']);
    Route::put('{id}', [TraderController::class, 'update']);
    Route::delete('{id}', [TraderController::class, 'destroy']);
});

Route::get('accounts', [AccountController::class, 'index']);
Route::prefix('account')->group( function () {
    Route::post('store', [AccountController::class, 'store']);
    Route::put('{id}', [AccountController::class, 'update']);
    Route::delete('{id}', [AccountController::class, 'destroy']);
});

Route::get('deals', [DealController::class, 'index']);
Route::prefix('deal')->group( function () {
    Route::post('store', [DealController::class, 'store']);
    Route::delete('{id}', [DealController::class, 'destroy']);
});

Route::get('bits', [BitController::class, 'index']);
Route::prefix('bit')->group( function () {
    Route::post('store', [BitController::class, 'store']);
    Route::get('{id}/approve', [BitController::class, 'approve']);
    Route::delete('{id}', [BitController::class, 'destroy']);
});
