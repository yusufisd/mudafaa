<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CurrentNewsCategoryController;
use App\Http\Controllers\Backend\CurrentNewsController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\UserController;
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


Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login_post'])->name('admin.login_post');

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // CURRENT NEWS CATEGORY CONTROLLER 
    Route::controller(CurrentNewsCategoryController::class)->prefix('guncel-haber-kategori')->name('currentNewsCategory.')->group(function () {
        Route::get('ekle', 'create')->name('add');
        Route::post('ekle', 'store')->name('store');
        Route::get('liste', 'index')->name('list');
        Route::get('duzenle/{id?}', 'edit')->name('edit');
        Route::post('guncelle/{id?}', 'update')->name('update');
        Route::get('sil/{id?}', 'destroy')->name('destroy');
        Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
    });

    // CURRENT NEWS CONTROLLER
    Route::controller(CurrentNewsController::class)->prefix('guncel-haber')->name('currentNews.')->group(function () {
        Route::get('ekle', 'create')->name('add');
        Route::post('ekle', 'store')->name('store');
        Route::get('liste', 'index')->name('list');
        Route::get('duzenle/{id?}', 'edit')->name('edit');
        Route::post('guncelle/{id?}', 'update')->name('update');
        Route::get('sil/{id?}', 'destroy')->name('destroy');
        Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
    });

    // USER CONTROLLER
    Route::controller(UserController::class)->prefix('kullanici')->name('user.')->group(function () {
        Route::get('ekle', 'create')->name('add');
        Route::post('ekle', 'store')->name('store');
        Route::get('liste', 'index')->name('list');
        Route::get('duzenle/{id?}', 'edit')->name('edit');
        Route::post('guncelle/{id?}', 'update')->name('update');
        Route::get('sil/{id?}', 'destroy')->name('destroy');
    });
});
