<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdsensePage;
use App\Models\EnAdsensePage;
use Illuminate\Http\Request;

class AdsensePageController extends Controller
{
    public function index(){
        $locale = session('applocale') ?? config('app.fallback_locale');
        if ($locale == "tr"){
           $data = AdsensePage::latest()->first();
        }else{
           $data = EnAdsensePage::latest()->first();
        }
        return view('frontend.adsensePage',compact('data'));
    }
}
