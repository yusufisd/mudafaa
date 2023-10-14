<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

    public function detail($id){
        $data = Video::findOrFail($id);
        return view('frontend.video.detail',compact('data'));
    }
}
