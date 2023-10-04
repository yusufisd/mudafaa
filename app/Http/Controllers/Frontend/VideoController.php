<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(){
        $data = Video::latest()->get();
        $cat_first_name = VideoCategory::find(1)->first();
        $cat_second_name = VideoCategory::find(2)->first();
        $cat_third_name = VideoCategory::find(3)->first();
        $cat_first = Video::where('category_id',1)->take(4)->get();
        $cat_second = Video::where('category_id',2)->take(4)->get();
        $cat_third = Video::where('category_id',3)->take(4)->get();

        return view('frontend.video.list',compact('data','cat_first','cat_second','cat_third','cat_first_name','cat_second_name','cat_third_name'));
    }

    public function detail($id){
        $data = Video::findOrFail($id);
        return view('frontend.video.detail',compact('data'));
    }
}
