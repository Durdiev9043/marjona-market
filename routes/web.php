<?php

use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\CategoryController;
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
    Route::get('order/index/web',[\App\Http\Controllers\GeneralController::class,'orderIndex'])->name('orderIndex');
    Route::put('order/status,{id}',[\App\Http\Controllers\GeneralController::class,'orderstatus'])->name('orderstatus');
});
