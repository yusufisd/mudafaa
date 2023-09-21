<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnActivity;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use App\Models\EnInterview;
use App\Models\EnVideo;
use App\Models\Interview;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $cats = CurrentNews::latest()
                ->take(4)
                ->get();

            $iki_haber = CurrentNews::inRandomOrder()->take(2)->get();
            $tek_haber = CurrentNews::inRandomOrder()->first();
            $uc_kategori = CurrentNewsCategory::orderBy('id','asc')->take(3)->get();
            $ilk_kategori_icerikleri = CurrentNews::where('category_id',1)->whereNot('id',1)->get();
            $ilk_kategori_icerigi = CurrentNews::where('category_id',1)->latest()->first();
            $ikinci_kategori_icerigi = CurrentNews::where('category_id',2)->latest()->first();
            $ucuncu_kategori_icerigi = CurrentNews::where('category_id',3)->latest()->first();
            $cat1_news1 = CurrentNews::where('category_id',1)->orderBy('id','asc')->take(3)->get();
            $cat1_news2 = CurrentNews::where('category_id',1)->orderBy('id','desc')->take(3)->get();
            $cat2_news1 = CurrentNews::where('category_id',2)->orderBy('id','asc')->take(3)->get();
            $cat2_news2 = CurrentNews::where('category_id',2)->orderBy('id','desc')->take(3)->get();
            $cat3_news1 = CurrentNews::where('category_id',3)->orderBy('id','asc')->take(3)->get();
            $cat3_news2 = CurrentNews::where('category_id',3)->orderBy('id','desc')->take(3)->get();

            $activity = Activity::latest()->take(4)->get();

            $populer_haber_first = CurrentNews::inRandomOrder()->take(1)->first();
            $populer_haber_three = CurrentNews::inRandomOrder()->take(3)->get();

            $videos = Video::latest()->take(4)->get();

            $interview = Interview::latest()->take(4)->get();



        } elseif ($local == 'en') {
            $cats = EnCurrentNews::latest()
                ->take(4)
                ->get();

            $iki_haber = EnCurrentNews::inRandomOrder()->take(2)->get();
            $tek_haber = CurrentNews::inRandomOrder()->first();
            $uc_kategori = EnCurrentNewsCategory::orderBy('id','asc')->take(3)->get();
            $ilk_kategori_icerikleri = EnCurrentNews::where('category_id',1)->whereNot('id',1)->get();
            $ilk_kategori_icerigi = EnCurrentNews::where('category_id',1)->latest()->first();
            $ikinci_kategori_icerigi = EnCurrentNews::where('category_id',2)->latest()->first();
            $ucuncu_kategori_icerigi = EnCurrentNews::where('category_id',3)->latest()->first();
            $cat1_news1 = EnCurrentNews::where('category_id',1)->orderBy('id','asc')->take(3)->get();
            $cat1_news2 = EnCurrentNews::where('category_id',1)->orderBy('id','desc')->take(3)->get();
            $cat2_news1 = EnCurrentNews::where('category_id',2)->orderBy('id','asc')->take(3)->get();
            $cat2_news2 = EnCurrentNews::where('category_id',2)->orderBy('id','desc')->take(3)->get();
            $cat3_news1 = EnCurrentNews::where('category_id',3)->orderBy('id','asc')->take(3)->get();
            $cat3_news2 = EnCurrentNews::where('category_id',3)->orderBy('id','desc')->take(3)->get();

            $activity = EnActivity::latest()->take(4)->get();

            $populer_haber_first = EnCurrentNews::inRandomOrder()->take(1)->first();
            $populer_haber_three = EnCurrentNews::inRandomOrder()->take(3)->get();

            $videos = EnVideo::latest()->take(4)->get();

            $interview = EnInterview::latest()->take(4)->get();



        }
        return view('frontend.index', compact('cats','iki_haber','tek_haber','uc_kategori','ilk_kategori_icerikleri','ilk_kategori_icerigi','ucuncu_kategori_icerigi','cat1_news1','cat1_news2','cat2_news1','cat2_news2','cat3_news1','cat3_news2','ikinci_kategori_icerigi','activity','populer_haber_first','populer_haber_three','videos','interview'));

    }
}
