<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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


            /*
            Route::dispatchToRoute(Request::create(url()->previous()));
            $params = explode('/', url()->previous());
            $param  = $params[count($params) - 1];
            $route = Route::currentRouteName();
            return redirect()->route($route, $param);
            */
            if (Auth::user()){
                return redirect('/admin');
            }else{
                if($lang == "en"){
                    return redirect('/en');
                }else{
                    return redirect('/');
                }
            }
        }else{

            // session process
            \Session::forget("applocale");
            \App::setLocale(config('app.fallback_locale'));
            // cache process
            /*
            \Artisan::call('cache:clear');
            \Artisan::call('route:clear');
            \Artisan::call('config:clear');
            \Artisan::call('view:clear');
            \Artisan::call('optimize:clear');
            \Artisan::call('config:cache');
            */
            \Artisan::call('optimize:clear');

            /*
            Route::dispatchToRoute(Request::create(url()->previous()));
            $params = explode('/', url()->previous());
            $param  = $params[count($params) - 1];
            $route = Route::currentRouteName();
            return redirect()->route($route, $param);
            */
            if (Auth::user()){
                return redirect('/admin');
            }else{
                return redirect('/');
            }
        }
    }
}
