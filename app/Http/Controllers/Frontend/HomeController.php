<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Anket;
use App\Models\Answer;
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

            
            if($tek_haber->Category() == null){
                while($tek_haber->Category() == null){
                    $tek_haber = CurrentNews::inRandomOrder()->first();
                }
            }


            $first_cat = CurrentNewsCategory::orderBy('id','asc')->first();
            $second_cat = CurrentNewsCategory::whereNot('id',$first_cat->id)->orderBy('id','asc')->first();
            $third_cat = CurrentNewsCategory::whereNot('id',$first_cat->id)->whereNot('id',$second_cat->id)->first();


            $data = CurrentNews::get();
            foreach($data as $item){
                if(in_array($first_cat->id,$item->category_id)){
                    $ilk_kategori_icerigi = $item;
                }
                break;
            }


            foreach($data as $item){
                if(in_array($second_cat->id,$item->category_id)){
                    $ikinci_kategori_icerigi = $item;
                    break;
                }
            }

            foreach($data as $item){
                if(in_array($third_cat->id,$item->category_id)){
                    $ucuncu_kategori_icerigi = $item;
                    break;
                }
            }


            $ilk_kategori_icerikleri = CurrentNews::where('category_id',$first_cat->id)->whereNot('id',1)->get();
            $cat1_news1 = CurrentNews::whereJsonContains('category_id',$first_cat->id)->orderBy('id','asc')->take(3)->get();
            $cat1_news2 = CurrentNews::whereJsonContains('category_id',$first_cat->id)->orderBy('id','desc')->take(3)->get();
            $cat2_news1 = CurrentNews::whereJsonContains('category_id',$second_cat->id)->orderBy('id','asc')->take(3)->get();
            $cat2_news2 = CurrentNews::whereJsonContains('category_id',$second_cat->id)->orderBy('id','desc')->take(3)->get();
            $cat3_news1 = CurrentNews::whereJsonContains('category_id',$third_cat->id)->orderBy('id','asc')->take(3)->get();
            $cat3_news2 = CurrentNews::whereJsonContains('category_id',$third_cat->id)->orderBy('id','desc')->take(3)->get();

            $activity = Activity::latest()->take(4)->get();

            $populer_haber_first = CurrentNews::inRandomOrder()->take(1)->first();
            $populer_haber_three = CurrentNews::inRandomOrder()->take(3)->get();

            if($populer_haber_first->Category() == null){
                while($populer_haber_first->Category() != null){
                    $populer_haber_first = CurrentNews::inRandomOrder()->take(1)->first();
                }
            }

            $videos = Video::latest()->take(4)->get();

            $interview = Interview::latest()->take(4)->get();


            $anket = Anket::inRandomOrder()->first();


        } elseif ($local == 'en') {
            $cats = EnCurrentNews::latest()
                ->take(4)
                ->get();

            $iki_haber = EnCurrentNews::inRandomOrder()->take(2)->get();
            $tek_haber = EnCurrentNews::inRandomOrder()->first();
            $uc_kategori = EnCurrentNewsCategory::orderBy('id','asc')->take(3)->get();

            if($tek_haber->Category() == null){
                while($tek_haber->Category() == null){
                    $tek_haber = EnCurrentNews::inRandomOrder()->first();
                }
            }

            $first_cat = EnCurrentNewsCategory::orderBy('id','asc')->first();
            $second_cat = EnCurrentNewsCategory::whereNot('id',$first_cat->id)->orderBy('id','asc')->first();
            $third_cat = EnCurrentNewsCategory::whereNot('id',$first_cat->id)->whereNot('id',$second_cat->id)->first();


            $data = EnCurrentNews::get();
            foreach($data as $item){
                if(in_array($first_cat->id,$item->category_id)){
                    $ilk_kategori_icerigi = $item;
                }
                break;
            }

            foreach($data as $item){
                if(in_array($second_cat->id,$item->category_id)){
                    $ikinci_kategori_icerigi = $item;
                    break;
                }
            }

            foreach($data as $item){
                if(in_array($third_cat->id,$item->category_id)){
                    $ucuncu_kategori_icerigi = $item;
                    break;
                }
            }


            $ilk_kategori_icerikleri = EnCurrentNews::where('category_id',$first_cat->id)->whereNot('id',1)->get();
            $cat1_news1 = EnCurrentNews::whereJsonContains('category_id',$first_cat->id)->orderBy('id','asc')->take(3)->get();
            $cat1_news2 = EnCurrentNews::whereJsonContains('category_id',$first_cat->id)->orderBy('id','desc')->take(3)->get();
            $cat2_news1 = EnCurrentNews::whereJsonContains('category_id',$second_cat->id)->orderBy('id','asc')->take(3)->get();
            $cat2_news2 = EnCurrentNews::whereJsonContains('category_id',$second_cat->id)->orderBy('id','desc')->take(3)->get();
            $cat3_news1 = EnCurrentNews::whereJsonContains('category_id',$third_cat->id)->orderBy('id','asc')->take(3)->get();
            $cat3_news2 = EnCurrentNews::whereJsonContains('category_id',$third_cat->id)->orderBy('id','desc')->take(3)->get();


            $activity = EnActivity::latest()->take(4)->get();

            $populer_haber_first = EnCurrentNews::inRandomOrder()->take(1)->first();
            $populer_haber_three = EnCurrentNews::inRandomOrder()->take(3)->get();

            if($populer_haber_first->Category() == null){
                while($populer_haber_first->Category() != null){
                    $populer_haber_first = EnCurrentNews::inRandomOrder()->take(1)->first();
                }
            }

            $videos = EnVideo::latest()->take(4)->get();

            $interview = EnInterview::latest()->take(4)->get();

            $anket = Anket::inRandomOrder()->first();

        }
        return view('frontend.index', compact('cats','iki_haber','tek_haber','uc_kategori','ilk_kategori_icerikleri','ilk_kategori_icerigi','ucuncu_kategori_icerigi','cat1_news1','cat1_news2','cat2_news1','cat2_news2','cat3_news1','cat3_news2','ikinci_kategori_icerigi','activity','populer_haber_first','populer_haber_three','videos','interview','anket'));

    }
}
