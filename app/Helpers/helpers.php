<?php

use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\DefenseIndustry;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use App\Models\EnDefenseIndustry;
use App\Models\LogModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function logKayit($id)
{
    $auth = Auth::guard('admin')->user();
    $log = new LogModel();
    $log->title = $id[0];
    $log->description = $id[1];
    $log->user = $auth->name . ' ' . $auth->surname;
    if (isset($id[2])) {
        $log->success = 0;
    }
    $log->save();
}

function currentCats()
{
    $local = \Session::get('applocale');
    if ($local == null) {
        $local = config('app.fallback_locale');
    }
    if ($local == 'tr') {
        $cats = CurrentNewsCategory::orderBy('queue', 'asc')->get();
    } elseif ($local == 'en') {
        $cats = EnCurrentNewsCategory::orderBy('id', 'asc')->get();
    }
    return $cats;
}

function defenseIndustryCat()
{
    $local = \Session::get('applocale');
    if ($local == null) {
        $local = config('app.fallback_locale');
    }
    if ($local == 'tr') {
        $cats = DefenseIndustry::orderBy('queue', 'asc')->get();
        
    } elseif ($local == 'en') {
        $cats = EnDefenseIndustry::orderBy('id', 'asc')->get();
    }
    return $cats;
}


function headline()
{
    $local = \Session::get('applocale');
    if ($local == null) {
        $local = config('app.fallback_locale');
    }
    if ($local == 'tr') {
        $cats = CurrentNews::where('headline',1)->get();
        
    } elseif ($local == 'en') {
        $cats = EnCurrentNews::where('headline',1)->get();
    }
    return $cats;
}


function currentDate(){
    return Carbon::now();
}




