<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::post('/check-sms/{phone}', [AuthController::class, 'checkSms']);
Route::post('reg',[\App\Http\Controllers\Api\AuthController::class,'reg']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/login/courier', [AuthController::class, 'loginCourier']);

Route::get('cat/list',[\App\Http\Controllers\Api\GeneralController::class,'category'] );
Route::get('rek/list',[\App\Http\Controllers\Api\GeneralController::class,'rek'] );
Route::get('aksiya/list',[\App\Http\Controllers\Api\GeneralController::class,'aksiya'] );
Route::get('product/limit',[\App\Http\Controllers\Api\GeneralController::class,'productLimit'] );
Route::post('product/search/',[\App\Http\Controllers\Api\GeneralController::class,'search'] );
Route::get('getHashesByHashId/{id}',[\App\Http\Controllers\Api\GeneralController::class,'getHashesByHashId'] );
Route::get('getProductsByHash/{id}',[\App\Http\Controllers\Api\GeneralController::class,'getProductsByHash'] );
Route::get('home/list',[\App\Http\Controllers\Api\GeneralController::class,'homelist'] );
Route::get('product/list',[\App\Http\Controllers\Api\GeneralController::class,'productlist'] );
Route::get('product/filter/{id}',[\App\Http\Controllers\Api\GeneralController::class,'productfilter'] );
Route::get('product/hash/filter/{id}',[\App\Http\Controllers\Api\GeneralController::class,'productfilter'] );

Route::middleware(['auth:sanctum'/*, 'abilities:check-status'*/])->group(function () {
//    Route::get('cat/list',[\App\Http\Controllers\Api\GeneralController::class,'category'] );

    Route::get('delete/account/{id}',[\App\Http\Controllers\Api\GeneralController::class,'delAccount'] );
//    Route::get('cat/list',[\App\Http\Controllers\Api\GeneralController::class,'category'] );

    Route::post('product/like/{id}',[\App\Http\Controllers\Api\GeneralController::class,'pLike'] );
    Route::put('user/update',[\App\Http\Controllers\Api\GeneralController::class,'userUpdate'] );
    Route::post('product/dislike/{id}',[\App\Http\Controllers\Api\GeneralController::class,'dLike'] );
    Route::post('liked/list/{id}',[\App\Http\Controllers\Api\GeneralController::class,'liked'] );

    Route::post('order/story/{id}',[\App\Http\Controllers\Api\GeneralController::class,'orderstory'] );
    Route::post('order/cancel/',[\App\Http\Controllers\Api\GeneralController::class,'orderCancel'] );
    Route::get('order/history/{id}',[\App\Http\Controllers\Api\GeneralController::class,'orderhistory'] );
    Route::get('get/orders/',[\App\Http\Controllers\Api\CourierController::class,'getOrder'] );
    Route::post('take/orders/{id}',[\App\Http\Controllers\Api\CourierController::class,'takeOrder'] );
    Route::get('orders/history/{id}',[\App\Http\Controllers\Api\CourierController::class,'historyOrder'] );
    Route::get('get/my/orders/{id}',[\App\Http\Controllers\Api\CourierController::class,'myOrder'] );
    Route::post('start/order/{id}',[\App\Http\Controllers\Api\CourierController::class,'startOrder'] );
    Route::post('finish/order/{id}',[\App\Http\Controllers\Api\CourierController::class,'finishOrder'] );
    Route::get('/order/info/{id}',[\App\Http\Controllers\Api\CourierController::class,'orderInfo'] );

    Route::get('/getMe', [UserController::class, 'getMe']);

    Route::group(['prefix' => 'v1'], function () {
        Route::apiResource('categories', CategoryController::class);
    });
});
