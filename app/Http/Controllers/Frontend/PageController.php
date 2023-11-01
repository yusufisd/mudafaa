<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EnPage;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function detail($id){
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $data = Page::where('link',$id)->first();
        } elseif ($local == 'en') {
            $data = EnPage::where('link',$id)->first();
        }

        return view('frontend.page.detail',compact('data'));
    }
}
