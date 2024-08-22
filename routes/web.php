<?php

use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\PdfGeneratorController;
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

Route::get('/', [\App\Http\Controllers\SiteController::class,'home']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/send-sms', [RegisteredUserController::class, 'sendSms'])->name('send_sms');
Route::post('/check-sms/{user:phone}', [RegisteredUserController::class, 'checkSms'])->name('check_sms');
Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);
    Route::resource('incoming',IncomingController::class);
    Route::resource('courier',CourierController::class);
    Route::post('cat/fil',[App\Http\Controllers\GeneralController::class,'region'])->name('cat.filter');
    Route::get('client',[App\Http\Controllers\GeneralController::class,'client'])->name('client');
    Route::post('product/filter',[App\Http\Controllers\GeneralController::class,'search'])->name('product.filter');
    Route::post('name/search',[\App\Http\Controllers\GeneralController::class,'nameSearch'])->name('name.search');
    Route::post('name/id',[\App\Http\Controllers\GeneralController::class,'idSearch'])->name('id.search');
    Route::post('search/cat/id',[\App\Http\Controllers\GeneralController::class,'idCat'])->name('id.cat');
    Route::get('order/index/web',[\App\Http\Controllers\GeneralController::class,'orderIndex'])->name('orderIndex');
    Route::get('order/done',[\App\Http\Controllers\GeneralController::class,'orderDone'])->name('orderDone');
    Route::get('order/view/{order}',[\App\Http\Controllers\GeneralController::class,'orderView'])->name('orderView');
    Route::post('order/product/cancel/{id}',[\App\Http\Controllers\GeneralController::class,'orderProductCancel'])->name('orderProduct.cancel');
    Route::get('order/view/{id}',[\App\Http\Controllers\GeneralController::class,'orderIndex'])->name('orderView');
    Route::get('order/cancel',[\App\Http\Controllers\OrderController::class,'orderCancel'])->name('orderCancel');
    Route::get('order/progress',[\App\Http\Controllers\OrderController::class,'orderProgress'])->name('orderProgress');
    Route::put('order/status/{id}',[\App\Http\Controllers\GeneralController::class,'orderstatus'])->name('orderstatus');
    Route::post('code/search',[\App\Http\Controllers\GeneralController::class,'codeSearch'])->name('code.search');
    Route::get('delete/card/{id}',[\App\Http\Controllers\GeneralController::class,'delCard'])->name('del.card');
    Route::get('add/card',[\App\Http\Controllers\GeneralController::class,'addToCart'])->name('addcart');
    Route::get('clear/card',[\App\Http\Controllers\GeneralController::class,'clearCart'])->name('clearcart');
    Route::get('/less/product',[\App\Http\Controllers\GeneralController::class,'productLess'])->name('product.less');
//    Route::get('product/less',[\App\Http\Controllers\GeneralController::class,'productLess'])->name('product.less');
    Route::get('/check/{id}', [PdfGeneratorController::class, 'index'])->name('check');
    Route::post('/qr/', [PdfGeneratorController::class, 'gen'])->name('gen');
    Route::get('/aa/', function (){
        return view('qq');
    });
//    Route::get('/check',function (){
//        return view('admin.check');
//    });
});
