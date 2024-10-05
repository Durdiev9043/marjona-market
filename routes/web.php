<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\PdfGeneratorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RekController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/send-sms', [RegisteredUserController::class, 'sendSms'])->name('send_sms');
Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('incoming', IncomingController::class);
    Route::resource('courier', CourierController::class);
    Route::resource('rek', RekController::class);
    Route::get('status/1', [App\Http\Controllers\GeneralController::class, 'pstatus'])->name('pstatus');
    Route::post('cat/fil', [App\Http\Controllers\GeneralController::class, 'region'])->name('cat.filter');
    Route::post('product/filter', [App\Http\Controllers\GeneralController::class, 'search'])->name('product.filter');
    Route::post('name/search', [\App\Http\Controllers\GeneralController::class, 'nameSearch'])->name('name.search');
    Route::post('name/id', [\App\Http\Controllers\GeneralController::class, 'idSearch'])->name('id.search');
    Route::post('search/cat/id', [\App\Http\Controllers\GeneralController::class, 'idCat'])->name('id.cat');
    Route::get('order/index/web', [\App\Http\Controllers\GeneralController::class, 'orderIndex'])->name('orderIndex');
    Route::get('order/done', [\App\Http\Controllers\GeneralController::class, 'orderDone'])->name('orderDone');
    Route::get('order/view/{order}', [\App\Http\Controllers\GeneralController::class, 'orderView'])->name('orderView');
    Route::post('order/product/cancel/{id}', [\App\Http\Controllers\GeneralController::class, 'orderProductCancel'])
        ->name('orderProduct.cancel');
    Route::get('order/cancel', [\App\Http\Controllers\OrderController::class, 'orderCancellist'])->name('orderCancel');
    Route::post('order/cancel', [\App\Http\Controllers\OrderController::class, 'orderCancel'])->name('cancel');
    Route::get('order/progress', [\App\Http\Controllers\OrderController::class, 'orderProgress'])
        ->name('orderProgress');
    Route::put('order/status/{id}', [\App\Http\Controllers\GeneralController::class, 'orderstatus'])
        ->name('orderstatus');
    Route::post('code/search', [\App\Http\Controllers\GeneralController::class, 'codeSearch'])->name('code.search');
    Route::get('delete/card/{id}', [\App\Http\Controllers\GeneralController::class, 'delCard'])->name('del.card');
    Route::get('add/card', [\App\Http\Controllers\GeneralController::class, 'addToCart'])->name('addcart');
    Route::get('clear/card', [\App\Http\Controllers\GeneralController::class, 'clearCart'])->name('clearcart');
    Route::get('/less/product', [\App\Http\Controllers\GeneralController::class, 'productLess'])->name('product.less');
    Route::get('/minus/product', [\App\Http\Controllers\GeneralController::class, 'productMinus'])
        ->name('product.minus');
    Route::get('/sms', [\App\Http\Controllers\GeneralController::class, 'sms']);
    Route::get('/check/{id}', [PdfGeneratorController::class, 'index'])->name('check');
    Route::post('/qr/', [PdfGeneratorController::class, 'gen'])->name('gen');

    Route::get('clients', [ClientController::class, 'index'])->name('clients');
});
