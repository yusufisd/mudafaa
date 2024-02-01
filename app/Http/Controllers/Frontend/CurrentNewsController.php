<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use App\Models\EnPage;
use App\Models\GoogleNews;
use App\Models\NewsViewCounter;
use App\Models\Page;
use App\Models\ShareCounter;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CurrentNewsController extends Controller
{
    public function detail($id = null){
        if ($id == null) return redirect('/');

        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $data = CurrentNews::where('link',$id)->first();
            if (!$data) return abort(404);
            $other_news = CurrentNews::select('title','live_time','category_id','image','link')->inRandomOrder()->where('status', 1)->whereNot('id',$data->id)->take(10)->get();
            $four_news = CurrentNews::select('title','live_time','image','link')->orderBy('view_counter', 'desc')->where('status', 1)->take(4)->get();
        }else{
            $data = EnCurrentNews::where('link',$id)->first();
            if (!$data) return abort(404);
            $other_news = EnCurrentNews::select('title','live_time','category_id','image','link')->where('status', 1)->inRandomOrder()->whereNot('id',$data->id)->take(10)->get();
            $four_news = EnCurrentNews::select('title','live_time','image','link')->where('status', 1)->orderBy('view_counter', 'desc')->where('status', 1)->take(4)->get();
        }
        // OKUMA KONTRLÜ
        $readCheck = json_decode(Cookie::get('readed')) ?? [];
        if (!in_array($data->id, $readCheck)){
            if(NewsViewCounter::where('news_id',$data->id)->first() != null){
                $news = NewsViewCounter::where('news_id',$data->id)->first();
                $news->view_counter = $news->view_counter + 1;
                $news->save();
            }else{
                $news = new NewsViewCounter();
                $news->news_id = $data->id;
                $news->view_counter = 1;
                $news->save();
            }
            $readCheck[] = $data->id;
            Cookie::queue(Cookie::make('readed', json_encode($readCheck), 30));
        }

        $google_news = GoogleNews::latest()->first();
        $kvkk_tr = Page::where('link','like','%'.'kvkk'.'%')->first();
        $kvkk_en = EnPage::where('link','like','%'.'pdpl'.'%')->first();

        return view('frontend.currentNews.detail',compact('data','other_news','four_news','kvkk_tr','kvkk_en','google_news'));
    }

    public function tag_list($title){

        $local = Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $datas = CurrentNews::where('seo_key', 'LIKE' , '%'.$title.'%')->paginate(10);
            $sub_categories = CurrentNewsCategory::latest()
                ->take(7)
                ->get();
            $other_news = CurrentNews::where('status', 1)->latest()->take(6)->get();
        } elseif ($local == 'en') {
            $datas = EnCurrentNews::where('seo_key', 'LIKE' , '%'.$title.'%')->paginate(10);
            $sub_categories = EnCurrentNewsCategory::latest()
                ->take(7)
                ->get();
            $other_news = EnCurrentNews::latest()->take(6)->get();
        }
        if($title != null){
            $title = ucwords($title);
        }

        return view('frontend.currentNews.tag_list',compact('datas','sub_categories','other_news','title'));
    }

    public function share_counter(){
        $id = request()->id;

        if(ShareCounter::where('content_id',$id)->first() != null){
            $new = ShareCounter::where('content_id',$id)->first();
            $new->share_counter = $new->share_counter + 1;
            $new->save();
        }else{
            $new = new ShareCounter();
            $new-> share_counter = 1;
            $new->content_id = $id;
            $new->save();
        }
        
        return $new;
    }
}
