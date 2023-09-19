<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ActivityCategoryController;
use App\Http\Controllers\Backend\ActivityController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CompanyCategoryController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\CompanyModelController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CurrentNewsCategoryController;
use App\Http\Controllers\Backend\CurrentNewsController;
use App\Http\Controllers\Backend\DefenseIndustryCategoryController;
use App\Http\Controllers\Backend\DefenseIndustryContentController;
use App\Http\Controllers\Backend\DefenseIndustryController;
use App\Http\Controllers\Backend\DictionaryController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\InterviewController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoCategoryController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\ActivityController as FrontendActivityController;
use App\Http\Controllers\Frontend\CurrentNewsCategoryController as FrontendCurrentNewsCategoryController;
use App\Http\Controllers\Frontend\DefenseIndustryCategoryController as FrontendDefenseIndustryCategoryController;
use App\Http\Controllers\Frontend\DefenseIndustryContentController as FrontendDefenseIndustryContentController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\VideoController as FrontendVideoController;
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

Route::prefix('admin')
    ->middleware('auth:admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        // CURRENT NEWS CATEGORY CONTROLLER
        Route::controller(CurrentNewsCategoryController::class)
            ->prefix('guncel-haber-kategori')
            ->name('currentNewsCategory.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
                Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
            });

        // CURRENT NEWS CONTROLLER
        Route::controller(CurrentNewsController::class)
            ->prefix('guncel-haber')
            ->name('currentNews.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
                Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                Route::get('manset-degistir/{id?}', 'change_headline')->name('change_headline');
            });

        // USER CONTROLLER
        Route::controller(UserController::class)
            ->prefix('kullanici')
            ->name('user.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // SAVUNMA SANAYİ İÇERİK CONTROLLER
        Route::controller(DefenseIndustryContentController::class)
            ->prefix('savunma-sanayi-icerik')
            ->name('defenseIndustryContent.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // SAVUNMA SANAYİ  CONTROLLER
        Route::controller(DefenseIndustryController::class)
            ->prefix('savunma-sanayi')
            ->name('defenseIndustry.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // SAVUNMA SANAYİ KATEGORİ CONTROLLER
        Route::controller(DefenseIndustryCategoryController::class)
            ->prefix('savunma-sanayi-kategori')
            ->name('defenseIndustryCategory.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // ÜLKE CONTROLLER
        Route::controller(CountryController::class)
            ->prefix('ulke')
            ->name('country.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // ŞİRKET CONTROLLER
        Route::controller(CompanyController::class)
            ->prefix('firma')
            ->name('company.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // ETKİNLİK KATEGORİSİ CONTROLLER
        Route::controller(ActivityCategoryController::class)
            ->prefix('etkinlik-kategorisi')
            ->name('activityCategory.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
                Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
            });

        // ETKİNLİK  CONTROLLER
        Route::controller(ActivityController::class)
            ->prefix('etkinlik')
            ->name('activity.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // RÖPORTAJ  CONTROLLER
        Route::controller(InterviewController::class)
            ->prefix('roportaj')
            ->name('interview.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
                Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
            });

        // SÖZLÜK  CONTROLLER
        Route::controller(DictionaryController::class)
            ->prefix('sozluk')
            ->name('dictionary.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // VİDEO KATEGORİ  CONTROLLER
        Route::controller(VideoCategoryController::class)
            ->prefix('video-kategori')
            ->name('videoCategory.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // VİDEO  CONTROLLER
        Route::controller(VideoController::class)
            ->prefix('video')
            ->name('video.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // FİRMA  CONTROLLER
        Route::controller(CompanyModelController::class)
            ->prefix('yeni-firma')
            ->name('companyModel.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // FİRMA KATEGORİ CONTROLLER
        Route::controller(CompanyCategoryController::class)
            ->prefix('firma-kategori')
            ->name('companyCategory.')
            ->group(function () {
                Route::get('ekle', 'create')->name('add');
                Route::post('ekle', 'store')->name('store');
                Route::get('liste', 'index')->name('list');
                Route::get('duzenle/{id?}', 'edit')->name('edit');
                Route::post('guncelle/{id?}', 'update')->name('update');
                Route::get('sil/{id?}', 'destroy')->name('destroy');
            });

        // HAKKIMIZDA CONTROLLER
        Route::controller(AboutController::class)
            ->prefix('hakkimizda')
            ->name('about.')
            ->group(function () {
                Route::get('ekle', 'add')->name('add');
            });
    });

Route::prefix('/')
    ->name('front.')
    ->group(function () {
        Route::get('/', [FrontendHomeController::class, 'index'])->name('home');

        // CURRENT NEWS CATEGORY CONTROLLER
        Route::controller(FrontendCurrentNewsCategoryController::class)
            ->prefix('guncel-haber-kategorisi')
            ->name('currentNewsCategory.')
            ->group(function () {
                Route::get('liste/{id?}', 'index')->name('list');
            });

        // DEFENSE INDUSTRY CATEGORY CONTROLLER
        Route::controller(FrontendDefenseIndustryCategoryController::class)
            ->prefix('savunma-sanayi-kategorisi')
            ->name('defenseIndustryCategory.')
            ->group(function () {
                Route::get('liste/{id?}', 'index')->name('list');
            });

        // DEFENSE INDUSTRY CONTENT CONTROLLER
        Route::controller(FrontendDefenseIndustryContentController::class)
            ->prefix('savunma-sanayi')
            ->name('defenseIndustryContent.')
            ->group(function () {
                Route::get('detay/{id?}', 'detail')->name('detail');
            });

        // ACTİVİYY CONTROLLER
        Route::controller(FrontendActivityController::class)
            ->prefix('etkinlik')
            ->name('activity.')
            ->group(function () {
                Route::get('liste', 'index')->name('list');
            });

        // VİDEO CONTROLLER
        Route::controller(FrontendVideoController::class)
            ->prefix('video')
            ->name('video.')
            ->group(function () {
                Route::get('liste', 'index')->name('list');
            });
    });
