<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubscribersController extends Controller
{
    public function subscribe(Request $request){
        $request->validate([
            "email" => "required",
            "accept" => "required"
        ],[
            "email" => "E-mail boş bırakılamaz",
            "accept" => "Kullanım koşulları onaylanmalıdır",
        ]);

        $new = new Subscriber();
        $new->email = $request->email;
        $new->save();

        Alert::success('Abone Olundu');
        return back();
    }
}
