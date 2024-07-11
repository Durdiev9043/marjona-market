<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisteredUserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::post('/send-sms', [RegisteredUserController::class, 'sendSms'])->name('send_sms');
Route::post('/check-sms/{phone}', [AuthController::class, 'checkSms'])->name('check_sms');
Route::post('reg',[\App\Http\Controllers\Api\AuthController::class,'reg']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/login/courier', [AuthController::class, 'loginCourier']);

Route::middleware(['auth:sanctum'/*, 'abilities:check-status'*/])->group(function () {
    Route::get('cat/list',[\App\Http\Controllers\Api\GeneralController::class,'category'] );
    Route::get('product/search/',[\App\Http\Controllers\Api\GeneralController::class,'search'] );
    Route::get('getHashesByHashId/{id}',[\App\Http\Controllers\Api\GeneralController::class,'getHashesByHashId'] );
    Route::get('getProductsByHash/{id}',[\App\Http\Controllers\Api\GeneralController::class,'getProductsByHash'] );
    Route::get('home/list',[\App\Http\Controllers\Api\GeneralController::class,'homelist'] );
    Route::get('product/list',[\App\Http\Controllers\Api\GeneralController::class,'productlist'] );
    Route::get('product/filter/{id}',[\App\Http\Controllers\Api\GeneralController::class,'productfilter'] );
    Route::get('product/hash/filter/{id}',[\App\Http\Controllers\Api\GeneralController::class,'productfilter'] );
    Route::post('order/story/{id}',[\App\Http\Controllers\Api\GeneralController::class,'orderstory'] );
    Route::get('order/history/{id}',[\App\Http\Controllers\Api\GeneralController::class,'orderhistory'] );
    Route::get('get/orders/',[\App\Http\Controllers\Api\CourierController::class,'getOrder'] );
    Route::post('take/orders/{id}',[\App\Http\Controllers\Api\CourierController::class,'takeOrder'] );
    Route::get('orders/history/{id}',[\App\Http\Controllers\Api\CourierController::class,'historyOrder'] );
    Route::get('get/my/orders/{id}',[\App\Http\Controllers\Api\CourierController::class,'myOrder'] );
    Route::post('finish/order/{id}',[\App\Http\Controllers\Api\CourierController::class,'finishOrder'] );
});
