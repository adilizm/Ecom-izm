<?php

use App\Http\Controllers\api\SlidersController;
use App\Http\Controllers\api\prodectsController;
use App\Http\Controllers\api\CreateordersController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
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
/* 
Route::prefix('categoreis')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::put('/update/{slug}', [CategoryController::class, 'update']);
    Route::delete('/delete/{slug}', [CategoryController::class, 'destroy']);
});

Route::prefix('prodect')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::put('/update/{slug}', [CategoryController::class, 'update']);
    Route::delete('/delete/{slug}', [CategoryController::class, 'destroy']);
});
 */
Route::get('/sliders', [SlidersController::class, 'index']);
Route::get('/prodects', [prodectsController::class, 'index']);
Route::get('/prodect/{slug}', [prodectsController::class, 'productwithslug']);
Route::post('/CreateOrder', [CreateordersController::class, 'CreateOrder']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
