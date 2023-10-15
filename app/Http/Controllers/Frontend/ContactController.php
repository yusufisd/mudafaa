<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use App\Models\EnContactModel;
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
        return view('frontend.contact',compact('datas'));
    }
}
