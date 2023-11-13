<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LangMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Artisan::call('optimize:clear');
        if (Session()->has('applocale') AND array_key_exists(Session()->get('applocale'), config('languages'))) {
            \App::setLocale(Session()->get('applocale'));
        \Artisan::call('optimize:clear');

        }else{
            //App::setLocale(Session()->get('tur'));
            \App::setLocale(config('app.fallback_locale'));
        \Artisan::call('optimize:clear');

        }

        return $next($request);    
    }
}
