<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ActivityCategoryController;
use App\Http\Controllers\Backend\ActivityController;
use App\Http\Controllers\Backend\AnketController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CompanyCategoryController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\CompanyModelController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CurrentNewsCategoryController;
use App\Http\Controllers\Backend\CurrentNewsController;
use App\Http\Controllers\Backend\DefenseIndustryCategoryController;
use App\Http\Controllers\Backend\DefenseIndustryContentController;
use App\Http\Controllers\Backend\DefenseIndustryController;
use App\Http\Controllers\Backend\DictionaryController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\InterviewController;
use App\Http\Controllers\Backend\KunyeController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoCategoryController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\AboutController as FrontendAboutController;
use App\Http\Controllers\Frontend\ActivityController as FrontendActivityController;
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
use App\Http\Controllers\Frontend\KunyeController as FrontendKunyeController;

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
                    Route::middleware('per:currentNews_list')->get('yorumlar/{id?}', 'commentList')->name('commentList');
                    Route::middleware('per:currentNews_list')->get('yorumlar/ek/{id?}', 'comment_commentList')->name('comment_commentList');
                    Route::get('yorum-statu/{id?}', 'changeCommentStatus')->name('changeCommentStatus');
                    Route::get('yorum-sil/{id?}', 'commentDestroy')->name('commentDestroy');
                    Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
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
                Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
                Route::get('yorumlar/{id?}', 'commentList')->name('commentList');
                Route::get('yorumlar/ek/{id?}', 'comment_commentList')->name('comment_commentList');
                Route::get('yorum-statu/{id?}', 'changeCommentStatus')->name('changeCommentStatus');
                Route::get('yorum-sil/{id?}', 'commentDestroy')->name('commentDestroy');
                Route::post('ice-aktar', 'ice_aktar')->name('ice_aktar');
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

                    Route::get('/coklu-gorsel/{id?}', 'multipleImage')->name('multipleImage');
                    Route::get('/coklu-gorsel-ekle/{id?}', 'multipleImage_add')->name('multipleImage_add');
                    Route::post('/coklu-gorsel-ekle/{id?}', 'multipleImage_store')->name('multipleImage_store');
                    Route::get('/coklu-gorsel-sil/{id?}', 'multipleImage_destroy')->name('multipleImage_destroy');
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
                    Route::middleware('per:kunye_list')->get('/', 'list')->name('list');
                    Route::middleware('per:kunye_add')->get('/ekle', 'create')->name('add');
                    Route::middleware('per:kunye_add')->post('/ekle', 'store')->name('store');
                    Route::middleware('per:kunye_edit')->get('/duzenle/{id?}', 'edit')->name('edit');
                    Route::middleware('per:kunye_edit')->post('/duzenle/{id?}', 'update')->name('update');
                    Route::middleware('per:kunye_delete')->get('/sil/{id?}', 'destroy')->name('destroy');
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
                    Route::middleware('per:anket_list')->get('/', 'list')->name('list');
                    Route::middleware('per:anket_add')->get('/ekle', 'create')->name('add');
                    Route::middleware('per:anket_add')->post('/ekle', 'store')->name('store');
                    Route::middleware('per:anket_edit')->get('/duzenle/{id?}', 'edit')->name('edit');
                    Route::middleware('per:anket_edit')->post('/duzenle/{id?}', 'update')->name('update');
                    Route::middleware('per:anket_delete')->get('/sil/{id?}', 'destroy')->name('destroy');
                });
        });

    Route::prefix('/')
        ->name('front.')
        ->group(function () {
            Route::get('/', [FrontendHomeController::class, 'index'])->name('home');
            // SET EMOJI
            Route::post('/setEmoji', [\App\Http\Controllers\Frontend\EmojiController::class, 'index'])->name('setEmoji');

            // SEARCH
            Route::get('/search', [\App\Http\Controllers\Frontend\SearchController::class, 'index'])->name('search');

            // CURRENT NEWS CATEGORY CONTROLLER
            Route::controller(FrontendCurrentNewsCategoryController::class)
                ->prefix('guncel-haber-kategorisi')
                ->name('currentNewsCategory.')
                ->group(function () {
                    Route::get('/{id?}', 'index')->name('list');
                });

            // CURRENT NEWS  CONTROLLER
            Route::controller(FrontendCurrentNewsController::class)
                ->prefix('guncel-haber')
                ->name('currentNews.')
                ->group(function () {
                    Route::get('/{id?}', 'detail')->name('detail');
                    Route::get('etiket/{title?}', 'tag_list')->name('tag_list');
                });

            // DEFENSE INDUSTRY CATEGORY CONTROLLER
            Route::controller(FrontendDefenseIndustryCategoryController::class)
                ->prefix('savunma-sanayi-kategorisi')
                ->name('defenseIndustryCategory.')
                ->group(function () {
                    Route::get('/{id?}', 'index')->name('list');
                    Route::get('etiket/{id?}', 'tag_list')->name('tag_list');
                });

            // DEFENSE INDUSTRY CATEGORY2 CONTROLLER
            Route::controller(FrontendDefenseIndustryCategoryController::class)
                ->prefix('savunma-sanayi-alt-kategorisi')
                ->name('defenseIndustrySubCategory.')
                ->group(function () {
                    Route::get('/{id?}', 'sub_category_index')->name('list2');
                });

            // DEFENSE INDUSTRY CONTENT CONTROLLER
            Route::controller(FrontendDefenseIndustryContentController::class)
                ->prefix('savunma-sanayi')
                ->name('defenseIndustryContent.')
                ->group(function () {
                    Route::get('/{id?}', 'detail')->name('detail');
                });

            // ACTİVİYY CONTROLLER
            Route::controller(FrontendActivityController::class)
                ->prefix('etkinlik')
                ->name('activity.')
                ->group(function () {
                    Route::get('liste', 'index')->name('list');
                    Route::get('yaklasan-etkinlikler', 'close_activity')->name('close_activity');
                    Route::get('/{id?}', 'detail')->name('detail');
                    Route::get('kategori-detay/{id?}', 'categoryDetail')->name('categoryDetail');
                    Route::post('etkinlik-ara', 'searchActivity')->name('searchActivity');
                    Route::get('etkinlik-takvimi', 'calendar')->name('calendar');
                });

            // VİDEO CONTROLLER
            Route::controller(FrontendVideoController::class)
                ->prefix('video')
                ->name('video.')
                ->group(function () {
                    Route::get('liste', 'index')->name('list');
                    Route::get('etiket/{tag?}', 'tag_list')->name('tag_list');
                    Route::get('kategori/{link?}', 'category_list')->name('category_list');
                    Route::get('detay/{id?}', 'detail')->name('detail');
                    Route::post('yorum-ekle/{id?}', 'commentStore')->name('commentStore');
                    Route::post('alt-yorum-ekle/{id?}', 'sub_commentStore')->name('sub_commentStore');
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
                ->prefix('roportaj')
                ->name('interview.')
                ->group(function () {
                    Route::get('liste', 'index')->name('list');
                    Route::get('/{id?}', 'detail')->name('detail');
                    Route::post('yorum-ekle/{id?}', 'addComment')->name('addComment');
                });

            // dictionary CONTROLLER
            Route::controller(FrontendDictionaryController::class)
                ->prefix('sozluk')
                ->name('dictionary.')
                ->group(function () {
                    Route::get('liste/{id?}', 'index')->name('list');
                    Route::get('etiket/{title?}', 'tag_list')->name('tag_list');
                    Route::get('/{id?}', 'detail')->name('detail');
                    Route::get('ara/{id?}', 'searchPost')->name('searchPost');
                });

            // COMPANY CONTROLLER
            Route::controller(FrontendCompanyController::class)
                ->prefix('firma')
                ->name('company.')
                ->group(function () {
                    Route::get('liste', 'index')->name('list');
                    Route::get('/{id?}', 'detail')->name('detail');
                });

            // ABOUT CONTROLLER
            Route::controller(FrontendAboutController::class)
                ->prefix('hakkimizda')
                ->name('about.')
                ->group(function () {
                    Route::get('/', 'detail')->name('detail');
                });

            // ABOUT CONTROLLER
            Route::controller(FrontendAboutController::class)
                ->prefix('hakkimizda')
                ->name('about.')
                ->group(function () {
                    Route::get('/', 'detail')->name('detail');
                });

            // PAGE CONTROLLER
            Route::controller(FrontendPageController::class)
                ->name('page.')->prefix('sayfa')
                ->group(function () {
                    Route::get('/{id?}', 'detail')->name('detail');
                });

            // Archive CONTROLLER
            Route::controller(ArchiveController::class)
                ->prefix('haber')
                ->name('archive.')
                ->group(function () {
                    Route::get('/arsiv', 'index')->name('index');
                    Route::get('/filter', 'filterArchive')->name('filterArchive');
                });

            // anket frontend
            Route::controller(FrontendAnketController::class)
                ->prefix('anket')
                ->name('anket.')
                ->group(function () {
                    Route::post('ekle', 'anketStore')->name('store');
                });

            Route::get('iletisim', [FrontendContactController::class, 'contact'])->name('contact');
            Route::get('kunye', [FrontendKunyeController::class, 'index'])->name('kunye');

            // yazar detay
            Route::get('yazar/{id?}',[AuthorController::class,'detail'])->name('author.detail');
        });

        
});

Route::get('test',function(){
    $data = "https://www.instagram.com/millimudafaacom/?__a=1";
    $data = file_get_contents($data);
    return $data;
});
