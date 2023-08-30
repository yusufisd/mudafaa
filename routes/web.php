<?php

use App\Http\Controllers\Backend\CurrentNewsCategoryController;
use App\Http\Controllers\Backend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin',[HomeController::class,'index'])->name('admin.index');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(CurrentNewsCategoryController::class)->prefix('guncel-haber-kategori')->name('currentNewsCategory.')->group(function(){
        Route::get('ekle','create')->name('add');
        Route::post('ekle','store')->name('store');
        Route::get('liste','index')->name('list');
        Route::get('duzenle/{id?}','edit')->name('edit');
        Route::post('guncelle/{id?}','update')->name('update');
        Route::get('sil/{id?}','destroy')->name('destroy');
    });
});
