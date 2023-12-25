<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CooperationPage;
use App\Models\EnCooperationPage;
use Illuminate\Http\Request;

class CooperationPageController extends Controller
{
    public function index(){
        $locale = session('applocale') ?? config('app.fallback_locale');
        if ($locale == "tr"){
           $data = CooperationPage::latest()->first();
        }else{
           $data = EnCooperationPage::latest()->first();
        }
        return view('frontend.cooperationPage',compact('data'));
    }
}
