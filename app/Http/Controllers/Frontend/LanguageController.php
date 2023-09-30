<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function change($lang){
        $saved_langs = \Config::get('languages');
        if (array_key_exists($lang, $saved_langs)) {
            // session process
            \Session::forget("applocale");
            \Session::put("applocale", $lang);
            \App::setLocale($lang);
            \Config::set('app.current_lang', $lang);
            // cache process
            \Artisan::call('cache:clear');
            \Artisan::call('route:clear');
            \Artisan::call('config:clear');
            \Artisan::call('view:clear');
            \Artisan::call('optimize:clear');
            \Artisan::call('config:cache');

            Route::dispatchToRoute(Request::create(url()->previous()));
            $route = Route::currentRouteName();
            return redirect()->route($route);
        }else{
            // session process
            Session::forget("applocale");
            App::setLocale(config('app.fallback_locale'));
            // cache process
            \Artisan::call('cache:clear');
            \Artisan::call('route:clear');
            \Artisan::call('config:clear');
            \Artisan::call('view:clear');
            \Artisan::call('optimize:clear');
            \Artisan::call('config:cache');
            \Artisan::call('optimize');
            
            Route::dispatchToRoute(Request::create(url()->previous()));
            $route = Route::currentRouteName();
            return redirect()->route($route);
        }
    }
}
