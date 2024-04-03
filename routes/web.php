<?php

use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\ProductController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/send-sms', [RegisteredUserController::class, 'sendSms'])->name('send_sms');
Route::post('/check-sms/{user:phone}', [RegisteredUserController::class, 'checkSms'])->name('check_sms');
Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);
    Route::resource('incoming',IncomingController::class);
    Route::post('cat/fil',[App\Http\Controllers\GeneralController::class,'region'])->name('cat.filter');
    Route::get('order/index/web',[\App\Http\Controllers\GeneralController::class,'orderIndex'])->name('orderIndex');
    Route::get('order/done',[\App\Http\Controllers\GeneralController::class,'orderDone'])->name('orderDone');
    Route::get('order/view/{order}',[\App\Http\Controllers\GeneralController::class,'orderView'])->name('orderView');
    Route::post('order/product/cancel/{id}',[\App\Http\Controllers\GeneralController::class,'orderProductCancel'])->name('orderProduct.cancel');
    Route::get('order/view/{id}',[\App\Http\Controllers\GeneralController::class,'orderIndex'])->name('orderView');
    Route::get('order/cancel',[\App\Http\Controllers\OrderController::class,'orderCancel'])->name('orderCancel');
    Route::put('order/status/{id}',[\App\Http\Controllers\GeneralController::class,'orderstatus'])->name('orderstatus');
    Route::post('code/search',[\App\Http\Controllers\GeneralController::class,'codeSearch'])->name('code.search');
    Route::get('add/card',[\App\Http\Controllers\GeneralController::class,'addToCart'])->name('addcart');
    Route::get('clear/card',[\App\Http\Controllers\GeneralController::class,'clearCart'])->name('clearcart');
});
