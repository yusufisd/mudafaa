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
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');

            \Session::get('applocale') == 'tr';
        }
        if ($local == 'tr') {
            $cats = CurrentNews::orderBy('live_time','desc')->where('headline',1)->where('status',1)
                ->take(4);
            $cats_idler = $cats->pluck('id')->toArray();
            $cats = $cats->get();
            $tek_haber = CurrentNews::where('status',1)->orderBy('live_time','desc')->whereNotIn('id',$cats_idler)->first();
            array_push($cats_idler,$tek_haber->id);
            $iki_haber = CurrentNews::orderBy('live_time','desc')->whereNotIn('id',$cats_idler)->take(2)->get();

            $uc_kategori = CurrentNewsCategory::orderBy('id','asc')->take(3)->get();

            
            if($tek_haber->Category() == null){
                while($tek_haber->Category() == null){
                    $tek_haber = CurrentNews::inRandomOrder()->first();
                }
            }


            $first_cat = CurrentNewsCategory::orderBy('id','asc')->first();
            $second_cat = CurrentNewsCategory::whereNot('id',$first_cat->id)->orderBy('id','asc')->first();
            $third_cat = CurrentNewsCategory::whereNot('id',$first_cat->id)->whereNot('id',$second_cat->id)->first();


            $data = CurrentNews::where('status',1)->get();
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
            $now = Carbon::now();
            $now_plus = $now->addMonth(2);


            $cat1_news1 = CurrentNews::whereJsonContains('category_id',$first_cat->id)->where('status',1)->whereNot('id',$ilk_kategori_icerigi->id)->take(3);
            $cat1_news_ids = $cat1_news1->pluck('id')->all();
            $cat1_news1 = $cat1_news1->get();
            $cat1_news2 = CurrentNews::whereJsonContains('category_id',$first_cat->id)->where('status',1)->orderBy('id','asc')->whereNot('id',$ilk_kategori_icerigi->id)->whereNotIn('id',$cat1_news_ids)->take(3)->get();


            $cat2_news1 = CurrentNews::whereJsonContains('category_id',$second_cat->id)->where('status',1)->whereNot('id',$ikinci_kategori_icerigi->id)->orderBy('id','asc')->take(3);
            $cat2_news_ids = $cat2_news1->pluck('id')->all();
            $cat2_news1 = $cat2_news1->get();
            $cat2_news2 = CurrentNews::whereJsonContains('category_id',$second_cat->id)->where('status',1)->orderBy('id','asc')->whereNot('id',$ikinci_kategori_icerigi->id)->whereNotIn('id',$cat2_news_ids)->take(3)->get();

            
            $cat3_news1 = CurrentNews::whereJsonContains('category_id',$third_cat->id)->where('status',1)->whereNot('id',$ucuncu_kategori_icerigi->id)->orderBy('id','asc')->take(3);
            $cat3_news_ids = $cat3_news1->pluck('id')->all();
            $cat3_news1 = $cat3_news1->get();
            $cat3_news2 = CurrentNews::whereJsonContains('category_id',$third_cat->id)->where('status',1)->orderBy('id','asc')->whereNot('id',$ucuncu_kategori_icerigi->id)->whereNotIn('id',$cat3_news_ids)->take(3)->get();

            $activity = Activity::where('status',1)->where('start_time','>=',$now->format('Y-m-d'))->take(4)->get();

            $populer_haber_first = CurrentNews::where('status',1)->orderBy('view_counter','desc')->take(1)->first();
            $populer_haber_three = CurrentNews::where('status',1)->orderBy('view_counter','desc')->whereNot('id',$populer_haber_first->id)->take(3)->get();

            if($populer_haber_first->Category() == null){
                while($populer_haber_first->Category() != null){
                    $populer_haber_first = CurrentNews::inRandomOrder()->take(1)->first();
                }
            }

            $videos = Video::orderBy('live_date','desc')->take(4)->get();

            $interview = Interview::latest()->take(4)->get();


            $anket = Anket::inRandomOrder()->first();


        } elseif ($local == 'en') {
            $cats = EnCurrentNews::orderBy('live_time','desc')->where('headline',1)->where('status',1)
                ->take(4);
            $cats_idler = $cats->pluck('id')->toArray();
            $cats = $cats->get();
            $tek_haber = EnCurrentNews::orderBy('live_time','desc')->whereNotIn('id',$cats_idler)->first();
            array_push($cats_idler,$tek_haber->id);
            $iki_haber = EnCurrentNews::orderBy('live_time','desc')->whereNotIn('id',$cats_idler)->take(2)->get();

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
            $now = Carbon::now();
            $now_plus = $now->addMonth(2);

            $cat1_news1 = EnCurrentNews::whereJsonContains('category_id',$first_cat->id)->where('status',1)->whereNot('id',$ilk_kategori_icerigi->id)->orderBy('id','asc')->take(3);
            $cat1_news_ids = $cat1_news1->pluck('id')->all();
            $cat1_news1 = $cat1_news1->get();
            $cat1_news2 = EnCurrentNews::whereJsonContains('category_id',$first_cat->id)->where('status',1)->orderBy('id','asc')->whereNot('id',$ilk_kategori_icerigi->id)->whereNotIn('id',$cat1_news_ids)->take(3)->get();


            $cat2_news1 = EnCurrentNews::whereJsonContains('category_id',$second_cat->id)->where('status',1)->whereNot('id',$ikinci_kategori_icerigi->id)->orderBy('id','asc')->take(3);
            $cat2_news_ids = $cat2_news1->pluck('id')->all();
            $cat2_news1 = $cat2_news1->get();
            $cat2_news2 = EnCurrentNews::whereJsonContains('category_id',$second_cat->id)->where('status',1)->orderBy('id','asc')->whereNot('id',$ikinci_kategori_icerigi->id)->whereNotIn('id',$cat2_news_ids)->take(3)->get();

            
            $cat3_news1 = EnCurrentNews::whereJsonContains('category_id',$third_cat->id)->where('status',1)->whereNot('id',$ucuncu_kategori_icerigi->id)->orderBy('id','asc')->take(3);
            $cat3_news_ids = $cat3_news1->pluck('id')->all();
            $cat3_news1 = $cat3_news1->get();
            $cat3_news2 = EnCurrentNews::whereJsonContains('category_id',$third_cat->id)->where('status',1)->orderBy('id','asc')->whereNot('id',$ucuncu_kategori_icerigi->id)->whereNotIn('id',$cat3_news_ids)->take(3)->get();



            $activity = EnActivity::where('status',1)->where('start_time','>=',$now->format('Y-m-d'))->take(4)->get();

            $populer_haber_first = EnCurrentNews::where('status',1)->orderBy('view_counter','desc')->take(1)->first();
            $populer_haber_three = EnCurrentNews::where('status',1)->orderBy('view_counter','desc')->whereNot('id',$populer_haber_first->id)->take(3)->get();

            if($populer_haber_first->Category() == null){
                while($populer_haber_first->Category() != null){
                    $populer_haber_first = EnCurrentNews::inRandomOrder()->take(1)->first();
                }
            }

            $videos = EnVideo::orderBy('live_date','desc')->take(4)->get();

            $interview = EnInterview::latest()->take(4)->get();

            $anket = Anket::inRandomOrder()->first();

        }
        return view('frontend.index', compact('cats','iki_haber','tek_haber','uc_kategori','ilk_kategori_icerigi','ucuncu_kategori_icerigi','cat1_news1','cat1_news2','cat2_news1','cat2_news2','cat3_news1','cat3_news2','ikinci_kategori_icerigi','activity','populer_haber_first','populer_haber_three','videos','interview','anket'));

    }
}
