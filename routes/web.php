<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Managment\ManagmentController;
use App\Http\Controllers\Managment\OrdersController;




Auth::routes();
Route::prefix('order')->group(function () {
Route::put('confirm/{id}','App\Http\Controllers\Managment\OrdersController@Confirme')->name('confirm_order');
Route::put('no_response/{id}','App\Http\Controllers\Managment\OrdersController@no_response')->name('no_response');
Route::put('call_back/{id}','App\Http\Controllers\Managment\OrdersController@call_back')->name('call_back');
Route::get('to_call_back_orders','App\Http\Controllers\Managment\OrdersController@to_call_back_orders')->name('to_call_back_orders');
Route::get('returned_Orders','App\Http\Controllers\Managment\OrdersController@returned_Orders')->name('returned_Orders');
Route::get('success_Orders','App\Http\Controllers\Managment\OrdersController@success_Orders')->name('success_Orders');
Route::get('all_Orders','App\Http\Controllers\Managment\OrdersController@all_Orders')->name('all_Orders');
Route::get('noresponse_Orders','App\Http\Controllers\Managment\OrdersController@noresponse_Orders')->name('noresponse_Orders');
Route::put('delivred/{id}','App\Http\Controllers\Managment\OrdersController@delivred')->name('deliver_order');
Route::get('returned/{id}','App\Http\Controllers\Managment\OrdersController@returned')->name('returned_order');
Route::get('success/{id}','App\Http\Controllers\Managment\OrdersController@success')->name('success_order');
});
Route::get('orders/confirmed','App\Http\Controllers\Managment\OrdersController@confirmed_Orders')->name('confirmed_orders');
Route::get('orders/delivred','App\Http\Controllers\Managment\OrdersController@delivred_Orders')->name('delivred_orders');
Route::get('managment', [ManagmentController::class, 'index'])->name('home');
Route::resource('categories', 'App\Http\Controllers\Managment\CategoryController');
Route::resource('prodects', 'App\Http\Controllers\Managment\ProdectsController');
Route::resource('sliders','App\Http\Controllers\Managment\SlidersController');
Route::resource('orders','App\Http\Controllers\Managment\OrdersController');
Route::get('new-orders','App\Http\Controllers\Managment\OrdersController@new_Order')->name('new-orders');
Route::post('ckeditor/image_upload', 'App\Http\Controllers\CKEditorController@upload')->name('upload');

Route::get('/', function () {
    return view('welcome');
});
