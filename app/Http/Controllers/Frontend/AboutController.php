<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\EnAbout;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function detail()
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $data = About::latest()->first();
        } elseif ($local == 'en') {
            $data = EnAbout::latest()->first();
        }
        return view('frontend.about',compact('data'));
    }
}
