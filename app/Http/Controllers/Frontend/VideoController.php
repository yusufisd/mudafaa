<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EnVideo;
use App\Models\EnVideoCategory;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(){

        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $categories = VideoCategory::orderBy('queue','asc')->get();
        }else{
            $categories = EnVideoCategory::orderBy('queue','asc')->get();
        }

        return view('frontend.video.list',compact('categories'));
    }

    public function detail($link){
        $data = Video::where('link',$link)->first();
        return view('frontend.video.detail',compact('data'));
    }

    public function category_list($link){
        $cat = VideoCategory::where('link',$link)->first();
        $data = Video::where('category_id',$cat->id)->get();
        return view('frontend.videoCategory.list',compact('data','cat'));
    }

    public function tag_list($tag){
        $local = session('applocale') ?? config('app.fallback_locale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $data = Video::where('seo_key', 'LIKE' , '%'.$tag.'%')->paginate(10);
            
        } elseif ($local == 'en') {
            $data = EnVideo::where('seo_key', 'LIKE' , '%'.$tag.'%')->paginate(10);
        }

        return view('frontend.videoCategory.tag_list',compact('data'));
    }
    
}
