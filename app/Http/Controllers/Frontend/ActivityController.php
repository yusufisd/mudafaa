<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){

        $now = Carbon::now();

        $coming_activity = Activity::where('start_time','<',$now)->orderBy('start_time','asc')->take(4)->get();
        $cat1_name = ActivityCategory::find(1)->title;
        $cat2_name = ActivityCategory::find(2)->title;
        $cat3_name = ActivityCategory::find(3)->title;
        $cat1_activites = Activity::where('category',1)->take(4)->get();
        $cat3_activites = Activity::where('category',3)->take(4)->get();
        $cat2_activites = Activity::where('category',2)->take(4)->get();
        return view('frontend.activity.list',compact('coming_activity','cat1_activites','cat2_activites','cat3_activites','cat1_name','cat2_name','cat3_name'));
    }
}
