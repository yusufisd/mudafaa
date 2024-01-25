<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ActivityCategoryController;
use App\Http\Controllers\Backend\ActivityController;
use App\Http\Controllers\Backend\AdsenseController;
use App\Http\Controllers\Backend\AdsensePageController;
use App\Http\Controllers\Backend\AnketController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CommentController as BackendCommentController;
use App\Http\Controllers\Backend\CompanyCategoryController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\CompanyModelController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ContactFormController;
use App\Http\Controllers\Backend\CooperationPageController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CurrentNewsCategoryController;
use App\Http\Controllers\Backend\CurrentNewsController;
use App\Http\Controllers\Backend\DefenseIndustryCategoryController;
use App\Http\Controllers\Backend\DefenseIndustryContentController;
use App\Http\Controllers\Backend\DefenseIndustryController;
use App\Http\Controllers\Backend\DictionaryController;
use App\Http\Controllers\Backend\GoogleCodeController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\InterviewController;
use App\Http\Controllers\Backend\KunyeController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\SubscribeController;
use App\Http\Controllers\Backend\TopbarController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoCategoryController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\AboutController as FrontendAboutController;
use App\Http\Controllers\Frontend\ActivityController as FrontendActivityController;
use App\Http\Controllers\Frontend\AdsensePageController as FrontendAdsensePageController;
use App\Http\Controllers\Frontend\AnketController as FrontendAnketController;
use App\Http\Controllers\Frontend\ArchiveController;
use App\Http\Controllers\Frontend\AuthorController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\CompanyController as FrontendCompanyController;
use App\Http\Controllers\Frontend\CurrentNewsCategoryController as FrontendCurrentNewsCategoryController;
use App\Http\Controllers\Frontend\CurrentNewsController as FrontendCurrentNewsController;
use App\Http\Controllers\Frontend\DefenseIndustryCategoryController as FrontendDefenseIndustryCategoryController;
use App\Http\Controllers\Frontend\DefenseIndustryContentController as FrontendDefenseIndustryContentController;
use App\Http\Controllers\Frontend\DictionaryController as FrontendDictionaryController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\InterviewController as FrontendInterviewController;
use App\Http\Controllers\Frontend\VideoController as FrontendVideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Frontend\ContactFormController as FrontendContactFormController;
use App\Http\Controllers\Frontend\CooperationPageController as FrontendCooperationPageController;
use App\Http\Controllers\Frontend\KunyeController as FrontendKunyeController;
use App\Http\Controllers\Frontend\SubscribersController;
use App\Http\Controllers\TitleIconController;
use App\Models\CurrentNews;
use App\Models\EnCurrentNews;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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

// CHANGE LANG
Route::get('optimize', function () {
    Artisan::call('optimize:clear');
    return 'Başarılı şekilde optimize edildi.';
});

Route::get('/change-lang/{lang}', [LanguageController::class, 'change'])->name('chaange.lang');

Route::middleware('lang')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login_post'])->name('admin.login_post');

    Route::prefix('admin')
        ->middleware('panel')
        ->name('admin.')
        ->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('index');
            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

            //  GOOGLE KOD
            Route::get('/google-kod', [GoogleCodeController::class, 'edit'])->name('google-kod.index');
            Route::post('/google-kod', [GoogleCodeController::class, 'update'])->name('google-kod.post');
            // CURRENT NEWS CATEGORY CONTROLLER
            Route::controller(CurrentNewsCategoryController::class)
                ->prefix('guncel-haber-kategori')
                ->name('currentNewsCategory.')
                ->group(function () {
                    Route::middleware('per:currentNewsCategory_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:currentNewsCategory_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:currentNewsCategory_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:currentNewsCategory_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:currentNewsCategory_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:currentNewsCategory_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
                });

            // CURRENT NEWS CONTROLLER
            Route::controller(CurrentNewsController::class)
                ->prefix('guncel-haber')
                ->name('currentNews.')
                ->group(function () {
                    Route::middleware('per:currentNews_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:currentNews_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:currentNews_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:currentNews_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:currentNews_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:currentNews_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                    Route::get('manset-degistir/{id?}', 'change_headline')->name('change_headline');
                    Route::middleware('per:currentNews_list')
                        ->get('yorumlar/{id?}', 'commentList')
                        ->name('commentList');
                    Route::middleware('per:currentNews_list')
                        ->get('yorumlar/ek/{id?}', 'comment_commentList')
                        ->name('comment_commentList');
                    Route::get('yorum-statu/{id?}', 'changeCommentStatus')->name('changeCommentStatus');
                    Route::get('yorum-sil/{id?}', 'commentDestroy')->name('commentDestroy');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
                    Route::post('filter-post', 'filter')->name('filterPost');
                });

            // RÖPORTAJ  CONTROLLER
            Route::controller(InterviewController::class)
                ->prefix('roportaj')
                ->name('interview.')
                ->group(function () {
                    Route::middleware('per:interview_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:interview_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:interview_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:interview_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:interview_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:interview_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                    Route::get('yorumlar/{id?}', 'commentList')->name('commentList');
                    Route::get('yorumlar/ek/{id?}', 'comment_commentList')->name('comment_commentList');
                    Route::get('yorum-statu/{id?}', 'changeCommentStatus')->name('changeCommentStatus');
                    Route::get('yorum-sil/{id?}', 'commentDestroy')->name('commentDestroy');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
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
                    Route::middleware('per:defenseIndustryContent_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:defenseIndustryContent_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:defenseIndustryContent_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:defenseIndustryContent_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:defenseIndustryContent_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:defenseIndustryContent_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');

                    Route::get('/coklu-gorsel/{id?}', 'multipleImage')->name('multipleImage');
                    Route::get('/coklu-gorsel-ekle/{id?}', 'multipleImage_add')->name('multipleImage_add');
                    Route::post('/coklu-gorsel-ekle', 'multipleImage_store')->name('multipleImage_store');
                });

            // SAVUNMA SANAYİ  CONTROLLER
            Route::controller(DefenseIndustryController::class)
                ->prefix('savunma-sanayi')
                ->name('defenseIndustry.')
                ->group(function () {
                    Route::middleware('per:defenseIndustry_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:defenseIndustry_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:defenseIndustry_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:defenseIndustry_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:defenseIndustry_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:defenseIndustry_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
                });

            // SAVUNMA SANAYİ KATEGORİ CONTROLLER
            Route::controller(DefenseIndustryCategoryController::class)
                ->prefix('savunma-sanayi-kategori')
                ->name('defenseIndustryCategory.')
                ->group(function () {
                    Route::middleware('per:defenseIndustryCategory_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:defenseIndustryCategory_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:defenseIndustryCategory_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:defenseIndustryCategory_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:defenseIndustryCategory_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:defenseIndustryCategory_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                });

            // ÜLKE CONTROLLER
            Route::controller(CountryController::class)
                ->prefix('ulke')
                ->name('country.')
                ->group(function () {
                    Route::middleware('per:defenseIndustryCategory_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:defenseIndustryCategory_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:defenseIndustryCategory_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:defenseIndustryCategory_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:defenseIndustryCategory_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:defenseIndustryCategory_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                });

            // ŞİRKET CONTROLLER
            Route::controller(CompanyController::class)
                ->prefix('firma')
                ->name('company.')
                ->group(function () {
                    Route::middleware('per:company_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:company_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:company_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:company_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:company_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:company_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                });

            // ETKİNLİK KATEGORİSİ CONTROLLER
            Route::controller(ActivityCategoryController::class)
                ->prefix('etkinlik-kategorisi')
                ->name('activityCategory.')
                ->group(function () {
                    Route::middleware('per:activityCategory_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:activityCategory_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:activityCategory_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:activityCategory_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:activityCategory_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:activityCategory_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
                });

            // ETKİNLİK  CONTROLLER
            Route::controller(ActivityController::class)
                ->prefix('etkinlik')
                ->name('activity.')
                ->group(function () {
                    Route::middleware('per:activity_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:activity_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:activity_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:activity_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:activity_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:activity_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
                });

            // SÖZLÜK  CONTROLLER
            Route::controller(DictionaryController::class)
                ->prefix('sozluk')
                ->name('dictionary.')
                ->group(function () {
                    Route::middleware('per:dictionary_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:dictionary_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:dictionary_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:dictionary_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:dictionary_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:dictionary_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                });

            // VİDEO KATEGORİ  CONTROLLER
            Route::controller(VideoCategoryController::class)
                ->prefix('video-kategori')
                ->name('videoCategory.')
                ->group(function () {
                    Route::middleware('per:videoCategory_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:videoCategory_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:videoCategory_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:videoCategory_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:videoCategory_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:videoCategory_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
                });

            // VİDEO  CONTROLLER
            Route::controller(VideoController::class)
                ->prefix('video')
                ->name('video.')
                ->group(function () {
                    Route::middleware('per:video_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:video_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:video_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:video_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:video_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:video_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                    Route::get('yorumlar/{id?}', 'commentList')->name('commentList');
                    Route::get('yorumlar/ek/{id?}', 'comment_commentList')->name('comment_commentList');
                    Route::get('yorum-statu/{id?}', 'changeCommentStatus')->name('changeCommentStatus');
                    Route::get('yorum-sil/{id?}', 'commentDestroy')->name('commentDestroy');
                });

            // FİRMA  CONTROLLER
            Route::controller(CompanyModelController::class)
                ->prefix('yeni-firma')
                ->name('companyModel.')
                ->group(function () {
                    Route::middleware('per:company_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:company_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:company_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:company_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:company_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:company_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');
                });

            // FİRMA KATEGORİ CONTROLLER
            Route::controller(CompanyCategoryController::class)
                ->prefix('firma-kategori')
                ->name('companyCategory.')
                ->group(function () {
                    Route::middleware('per:companyCategory_add')
                        ->get('ekle', 'create')
                        ->name('add');
                    Route::middleware('per:companyCategory_add')
                        ->post('ekle', 'store')
                        ->name('store');
                    Route::middleware('per:companyCategory_list')
                        ->get('liste', 'index')
                        ->name('list');
                    Route::middleware('per:companyCategory_edit')
                        ->get('duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:companyCategory_edit')
                        ->post('guncelle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:companyCategory_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                    Route::get('disa-aktar', 'disa_aktar')->name('disa_aktar');

                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                });

            // HAKKIMIZDA CONTROLLER
            Route::controller(AboutController::class)
                ->prefix('hakkimizda')
                ->name('about.')
                ->group(function () {
                    Route::get('ekle', 'add')->name('add');
                    Route::post('ekle', 'store')->name('store');
                });

            // PAGE CONTROLLER
            Route::controller(PageController::class)
                ->prefix('sayfa')
                ->name('page.')
                ->group(function () {
                    Route::middleware('per:page_list')
                        ->get('/', 'list')
                        ->name('list');
                    Route::middleware('per:page_add')
                        ->get('/ekle', 'add')
                        ->name('add');
                    Route::middleware('per:page_add')
                        ->post('/ekle', 'store')
                        ->name('store');
                    Route::middleware('per:page_edit')
                        ->get('/duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:page_edit')
                        ->post('/duzenle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:page_delete')
                        ->get('sil/{id?}', 'destroy')
                        ->name('destroy');
                });

            // ROLE CONTROLLER
            Route::controller(RoleController::class)
                ->prefix('rol')
                ->name('role.')
                ->middleware('auth:admin')
                ->group(function () {
                    Route::get('/', 'list')->name('list');
                    Route::get('/ekle', 'add')->name('add');
                    Route::post('/ekle', 'store')->name('store');
                    Route::get('/duzenle/{id?}', 'edit')->name('edit');
                    Route::post('/duzenle/{id?}', 'update')->name('update');
                });

            // kunye CONTROLLER
            Route::controller(KunyeController::class)
                ->prefix('kunye')
                ->name('kunye.')
                ->group(function () {
                    Route::middleware('per:kunye_list')
                        ->get('/', 'list')
                        ->name('list');
                    Route::middleware('per:kunye_add')
                        ->get('/ekle', 'create')
                        ->name('add');
                    Route::middleware('per:kunye_add')
                        ->post('/ekle', 'store')
                        ->name('store');
                    Route::middleware('per:kunye_edit')
                        ->get('/duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:kunye_edit')
                        ->post('/duzenle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:kunye_delete')
                        ->get('/sil/{id?}', 'destroy')
                        ->name('destroy');
                });

            // iletişim
            Route::controller(ContactController::class)
                ->prefix('iletisim')
                ->name('contact.')
                ->group(function () {
                    Route::get('/duzenle', 'edit')->name('edit');
                    Route::post('/duzenle', 'update')->name('update');
                });

            // SOSYAL MEDYA
            Route::controller(SocialMediaController::class)
                ->prefix('sosyal-medya')
                ->name('social.')
                ->group(function () {
                    Route::get('/', 'list')->name('list');
                    Route::post('/duzenle', 'update')->name('update');
                });

            // ANKET YÖNETİM
            Route::controller(AnketController::class)
                ->prefix('anket')
                ->name('anket.')
                ->group(function () {
                    Route::middleware('per:anket_list')
                        ->get('/', 'list')
                        ->name('list');
                    Route::middleware('per:anket_add')
                        ->get('/ekle', 'create')
                        ->name('add');
                    Route::middleware('per:anket_add')
                        ->post('/ekle', 'store')
                        ->name('store');
                    Route::middleware('per:anket_edit')
                        ->get('/duzenle/{id?}', 'edit')
                        ->name('edit');
                    Route::middleware('per:anket_edit')
                        ->post('/duzenle/{id?}', 'update')
                        ->name('update');
                    Route::middleware('per:anket_delete')
                        ->get('/sil/{id?}', 'destroy')
                        ->name('destroy');
                });

            // title icon
            Route::controller(TitleIconController::class)
                ->prefix('baslik-icon')
                ->name('titleIcon.')
                ->group(function () {
                    Route::get('/', 'list')->name('list');
                    Route::get('/ekle', 'create')->name('add');
                    Route::post('/ekle', 'store')->name('store');
                    Route::get('/duzenle/{id?}', 'edit')->name('edit');
                    Route::post('/duzenle/{id?}', 'update')->name('update');
                    Route::get('/sil/{id?}', 'destroy')->name('destroy');
                });

            // adsense
            Route::controller(AdsenseController::class)
                ->prefix('reklam')
                ->name('adsense.')
                ->group(function () {
                    Route::get('/', 'list')->name('list');
                    Route::get('/ekle', 'create')->name('add');
                    Route::post('/ekle', 'store')->name('store');
                    Route::get('/duzenle/{id?}', 'edit')->name('edit');
                    Route::post('/duzenle/{id?}', 'update')->name('update');
                    Route::get('/sil/{id?}', 'destroy')->name('destroy');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                });

            Route::controller(BackendCommentController::class)
                ->name('comments.')
                ->prefix('yorumlar')
                ->group(function () {
                    // Current News Comments
                    Route::get('haber', 'NewsComment')->name('currentNews');
                    Route::get('roportaj', 'interviewsComments')->name('interviews');
                    Route::get('video', 'videosComments')->name('videos');
                });

            // topbar controller
            Route::controller(TopbarController::class)
                ->prefix('header')
                ->name('topbar.')
                ->group(function () {
                    Route::get('/', 'list')->name('list');
                    Route::get('/ekle', 'create')->name('add');
                    Route::post('/ekle', 'store')->name('store');
                    Route::get('/duzenle/{id?}', 'edit')->name('edit');
                    Route::post('/duzenle/{id?}', 'update')->name('update');
                    Route::get('/sil/{id?}', 'destroy')->name('destroy');
                    Route::get('/gorsel/sil/{id?}', 'imageDestroy')->name('image.destroy');
                });

            Route::get('yetkisiz-deneme', [HomeController::class, 'unauthorizedPage'])->name('unauthorizedPage');

            // MENU CONTROLLER
            Route::controller(MenuController::class)
                ->prefix('menu')
                ->name('menu.')
                ->group(function () {
                    Route::get('/', 'edit')->name('edit');
                    Route::get('/ekle', 'ekle')->name('ekle');
                    Route::get('durum-degistir/{id?}', 'change_status')->name('change_status');
                });

            // ADSENSE PAGE
            Route::get('/reklam-sayfasi', [AdsensePageController::class, 'edit'])->name('adsensePageEdit');
            Route::post('/reklam-sayfasi', [AdsensePageController::class, 'update'])->name('adsensePageEdit.update');

            // COOPERATİON PAGE
            Route::get('/is-birligi', [CooperationPageController::class, 'edit'])->name('cooperationPageEdit');
            Route::post('/is-birligi', [CooperationPageController::class, 'update'])->name('cooperationPageEdit.update');

            // subsribe controller
            Route::prefix('aboneler')
                ->name('subscriber.')
                ->controller(SubscribeController::class)
                ->group(function () {
                    Route::get('/liste', 'index')->name('list');
                    Route::get('/statu-degistir/{id?}', 'change_status')->name('change_status');
                });

            // İletşim formu
            Route::prefix('iletisim-formu')
                ->name('contactForm.')
                ->controller(ContactFormController::class)
                ->group(function () {
                    Route::get('/liste', 'index')->name('index');
                    Route::get('/sil/{id?}', 'delete')->name('delete');
                });
        });

    Route::prefix('/')
        ->name('front.')
        ->group(function () {
            Route::get('/', [FrontendHomeController::class, 'index'])->name('home');
            Route::get('/en', [FrontendHomeController::class, 'index'])->name('home_en');
            // SET EMOJI
            Route::post('/setEmoji', [\App\Http\Controllers\Frontend\EmojiController::class, 'index'])->name('setEmoji');

            // SEARCH
            Route::get('/search', [\App\Http\Controllers\Frontend\SearchController::class, 'index'])->name('search');

            // CURRENT NEWS CATEGORY CONTROLLER
            Route::get('guncel-haber-kategorisi/{id?}', [FrontendCurrentNewsCategoryController::class, 'index'])->name('currentNewsCategory.list');
            Route::get('guncel-haber/{id?}', [FrontendCurrentNewsController::class, 'detail'])->name('currentNews.detail');
            Route::post('paylas-sayi', [FrontendCurrentNewsController::class, 'share_counter'])->name('currentNews.share_counter');
            Route::get('guncel-haber/etiket/{title?}', [FrontendCurrentNewsController::class, 'tag_list'])->name('currentNews.tag_list');
            // DEFENSE INDUSTRY CATEGORY CONTROLLER
            Route::get('savunma-sanayi-kategorisi/{id?}', [FrontendDefenseIndustryCategoryController::class, 'index'])->name('defenseIndustryCategory.list');
            Route::get('savunma-sanayi-kategorisi/etiket/{id?}', [FrontendDefenseIndustryCategoryController::class, 'tag_list'])->name('defenseIndustryCategory.tag_list');
            // DEFENSE INDUSTRY CATEGORY2 CONTROLLER
            Route::get('savunma-sanayi-alt-kategorisi/{id?}', [FrontendDefenseIndustryCategoryController::class, 'sub_category_index'])->name('defenseIndustrySubCategory.list2');
            // DEFENSE INDUSTRY CONTENT CONTROLLER
            Route::get('savunma-sanayi/{id?}', [FrontendDefenseIndustryContentController::class, 'detail'])->name('defenseIndustryContent.detail');

            // CURRENT NEWS  CONTROLLER
            Route::get('current-news-category/{id?}', [FrontendCurrentNewsCategoryController::class, 'index'])->name('currentNewsCategory.list_en');
            Route::get('current-news/{id?}', [FrontendCurrentNewsController::class, 'detail'])->name('currentNews.detail_en');
            Route::get('current-news/tag/{title?}', [FrontendCurrentNewsController::class, 'tag_list'])->name('currentNews.tag_list_en');
            Route::get('defense-industry-category/{id?}', [FrontendDefenseIndustryCategoryController::class, 'index'])->name('defenseIndustryCategory.list_en');
            Route::get('defense-industry-category/tag/{id?}', [FrontendDefenseIndustryCategoryController::class, 'tag_list'])->name('defenseIndustryCategory.tag_list_en');
            Route::get('defense-industry-sub-category/{id?}', [FrontendDefenseIndustryCategoryController::class, 'sub_category_index'])->name('defenseIndustrySubCategory.list2_en');
            Route::get('defense-industry/{id?}', [FrontendDefenseIndustryContentController::class, 'detail'])->name('defenseIndustryContent.detail_en');

            // ACTİVİYY CONTROLLER
            Route::controller(FrontendActivityController::class)
                ->name('activity.')
                ->group(function () {
                    Route::prefix('etkinlik')->group(function () {
                        Route::get('/', 'index')->name('list');
                        Route::get('/{id?}', 'detail')->name('detail');
                        Route::get('yaklasan/etkinlikler', 'close_activity')->name('close_activity');
                        Route::get('kategori-detay/{id?}', 'categoryDetail')->name('categoryDetail');
                        Route::post('/ara', 'searchActivity')->name('searchActivity');
                        Route::get('/takvim/ozet', 'calendar')->name('calendar');
                        Route::get('/etiket/{title?}', 'tag_list')->name('tag_list');
                    });
                    Route::prefix('activity')->group(function () {
                        Route::get('/', 'index')->name('list_en');
                        Route::get('/{id?}', 'detail')->name('detail_en');
                        Route::get('/upcoming/activites', 'close_activity')->name('close_activity_en');
                        Route::get('/category/{id?}', 'categoryDetail')->name('categoryDetail_en');
                        Route::get('/calendar/summary', 'calendar')->name('calendar_en');
                        Route::get('/tag/{title?}', 'tag_list')->name('tag_list_en');
                    });
                });

            // VİDEO CONTROLLER
            Route::controller(FrontendVideoController::class)
                ->name('video.')
                ->group(function () {
                    Route::prefix('video')->group(function () {
                        Route::get('/', 'index')->name('list');
                        Route::get('etiket/{tag?}', 'tag_list')->name('tag_list');
                        Route::get('tag/{tag?}', 'tag_list')->name('tag_list_en');
                        Route::get('kategori/{link?}', 'category_list')->name('category_list');
                        Route::get('category/{link?}', 'category_list')->name('category_list_en');
                        Route::get('/{id?}', 'detail')->name('detail');
                        Route::get('en/{id?}', 'detail')->name('detail_en');
                        Route::post('yorum-ekle/{id?}', 'commentStore')->name('commentStore');
                        Route::post('alt-yorum-ekle/{id?}', 'sub_commentStore')->name('sub_commentStore');
                    });
                });

            // YORUM CONTROLLER
            Route::controller(CommentController::class)
                ->prefix('yorum')
                ->name('comment.')
                ->group(function () {
                    Route::post('ekle/{id?}', 'store')->name('store');
                    Route::post('ekle-yorum/{test?}', 'storeComment')->name('storeComment');
                });

            // ROPÖRTAJ CONTROLLER
            Route::controller(FrontendInterviewController::class)
                ->name('interview.')
                ->group(function () {
                    Route::get('roportaj', 'index')->name('list');
                    Route::get('interview', 'index')->name('list_en');
                    Route::prefix('roportaj')->group(function () {
                        Route::get('/{id?}', 'detail')->name('detail');
                        Route::post('yorum-ekle/{id?}', 'addComment')->name('addComment');
                    });
                });

            // dictionary CONTROLLER
            Route::controller(FrontendDictionaryController::class)
                ->name('dictionary.')
                ->group(function () {
                    Route::prefix('dictionary')->group(function () {
                        Route::get('/', 'index')->name('list_en');
                        Route::get('/{id?}', 'detail')->name('detail_en');
                        Route::get('tag/{title?}', 'tag_list')->name('tag_list_en');
                    });

                    Route::prefix('sozluk')->group(function () {
                        Route::get('/', 'index')->name('list');
                        Route::get('/{id?}', 'detail')->name('detail');
                        Route::get('etiket/{title?}', 'tag_list')->name('tag_list');
                        Route::get('ara/{id?}', 'searchPost')->name('searchPost');
                    });
                });

            // COMPANY CONTROLLER
            Route::controller(FrontendCompanyController::class)
                ->name('company.')
                ->group(function () {
                    Route::get('firma', 'index')->name('list');
                    Route::get('company', 'index')->name('list_en');
                    Route::prefix('firma')->group(function () {
                        Route::get('/{id?}', 'detail')->name('detail');
                        Route::get('/kategori/{link?}', 'categoryList')->name('categoryList');
                    });
                    Route::prefix('company')->group(function () {
                        Route::get('/{id?}', 'detail')->name('detail_en');
                        Route::get('/category/{link?}', 'categoryList')->name('categoryList_en');
                    });
                });

            // ABOUT CONTROLLER
            Route::get('/hakkimizda', [FrontendAboutController::class, 'detail'])->name('about.detail');
            Route::get('/about', [FrontendAboutController::class, 'detail'])->name('about.detail_en');

            Route::get('iletisim', [FrontendContactController::class, 'contact'])->name('contact');
            Route::get('contact', [FrontendContactController::class, 'contact'])->name('contact_en');
            Route::get('kunye', [FrontendKunyeController::class, 'index'])->name('kunye');
            Route::get('publisher', [FrontendKunyeController::class, 'index'])->name('kunye_en');

            // Archive CONTROLLER
            Route::get('haber-arsiv', [ArchiveController::class, 'index'])->name('archive.index');
            Route::get('news-archive', [ArchiveController::class, 'index'])->name('archive.index_en');
            Route::get('/filter', [ArchiveController::class, 'filterArchive'])->name('archive.filterArchive');

            // PAGE CONTROLLER
            Route::controller(FrontendPageController::class)
                ->name('page.')
                ->prefix('sayfa')
                ->group(function () {
                    Route::get('/{id?}', 'detail')->name('detail');
                });

            // anket frontend
            Route::controller(FrontendAnketController::class)
                ->prefix('anket')
                ->name('anket.')
                ->group(function () {
                    Route::post('ekle', 'anketStore')->name('store');
                });

            // yazar detay
            Route::get('yazar/{id?}', [AuthorController::class, 'detail'])->name('author.detail');
            Route::get('yazarlar', [AuthorController::class, 'list'])->name('author.list');

            // Adsense COntroller
            Route::get('reklam-sayfasi', [FrontendAdsensePageController::class, 'index'])->name('adsensePage.index');

            // Copperation COntroller
            Route::get('is-birligi', [FrontendCooperationPageController::class, 'index'])->name('cooperationPage.index');

            // SUBSCRİBE CONTROLLER
            Route::post('abone-ol', [SubscribersController::class, 'subscribe'])->name('subscribePost');

            // İletişim Formu
            Route::post('iletisim-formu-post', [FrontendContactFormController::class, 'formPost'])->name('contactFormPost');

            Route::get('abonelikten-cik/{email?}',[SubscribersController::class,'inActiveSubscribe'])->name('abonelikten-cik');
        });
});

Route::get('/view_counter', [FrontendHomeController::class, 'view_counter']);
Route::get('/random-editor', [FrontendHomeController::class, 'randomEditor']);
Route::get('/manset-on-sinir', [FrontendHomeController::class, 'mansetOnSinir']);

Route::get('/defense_view_counter', [FrontendHomeController::class, 'defense_view_counter']);
Route::get('/defense-random-editor', [FrontendHomeController::class, 'defenseRandomEditor']);

Route::get('random/kategori/integer', function () {
    $data = CurrentNews::get();
    $data_en = EnCurrentNews::get();
    foreach ($data as $key) {
        if ($key->category_id != null) {
            $key->category_id = array_map('intval', $key->category_id);
            $key->save();
        }
    }
    foreach ($data_en as $key) {
        if ($key->category_id != null) {
            $key->category_id = array_map('intval', $key->category_id);
            $key->save();
        }
    }
    return 'başarılı';
});
