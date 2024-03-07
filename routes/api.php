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

Route::middleware(['auth:sanctum'/*, 'abilities:check-status'*/])->group(function () {
    Route::get('cat/list',[\App\Http\Controllers\Api\GeneralController::class,'category'] );
    Route::get('product/list',[\App\Http\Controllers\Api\GeneralController::class,'productlist'] );
    Route::get('product/filter/{id}',[\App\Http\Controllers\Api\GeneralController::class,'productfilter'] );
    Route::post('order/story/{id}',[\App\Http\Controllers\Api\GeneralController::class,'orderstory'] );
    Route::get('order/history/{id}',[\App\Http\Controllers\Api\GeneralController::class,'orderhistory'] );
});
