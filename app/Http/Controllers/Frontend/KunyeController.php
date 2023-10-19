<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EnKunye;
use App\Models\Kunye;
use Illuminate\Http\Request;

class KunyeController extends Controller
{
    public function index()
    {
        $local = \Session::get('applocale') ?? config('app.fallback_locale');

        if ($local == 'tr') {
            $data = Kunye::orderBy('id','asc')->get();
        } elseif ($local == 'en') {
            $data = EnKunye::orderBy('id','asc')->get();
        }
        return view('frontend.kunye',compact('data'));
    }
}
