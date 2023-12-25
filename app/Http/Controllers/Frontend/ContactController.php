<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use App\Models\EnContactModel;
use App\Models\EnPage;
use App\Models\Page;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(){

        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $datas = ContactModel::latest()->first();
        } elseif ($local == 'en') {
            $datas = EnContactModel::latest()->first();
        }
        $kvkk_tr = Page::where('link','like','%'.'kvkk'.'%')->first();
        $kvkk_en = EnPage::where('link','like','%'.'pdpl'.'%')->first();
        return view('frontend.contact',compact('datas','kvkk_tr','kvkk_en'));
    }
}
