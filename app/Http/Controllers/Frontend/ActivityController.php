<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\CountryList;
use App\Models\EnActivity;
use App\Models\EnActivityCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            $coming_activity = Activity::where('status',1)->orderBy('start_time', 'desc')
                ->take(4)
                ->get();
            $activity_category = ActivityCategory::where('status',1)->orderBy('queue', 'asc')->get();
            $categories = ActivityCategory::where('status',1)->get();
            $countries = CountryList::get();
        } elseif ($local == 'en') {
            $coming_activity = EnActivity::where('status',1)->where('start_time', '<', $now)
                ->orderBy('start_time', 'asc')
                ->take(4)
                ->get();
            $activity_category = EnActivityCategory::where('status',1)->orderBy('queue', 'asc')->get();
            $categories = EnActivityCategory::where('status',1)->get();
            $countries = CountryList::get();
        }

        return view('frontend.activity.list', compact('coming_activity', 'activity_category', 'categories', 'countries'));
    }

    public function detail($id)
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            $data = Activity::where('link', $id)->first();
            $other_activity = Activity::inRandomOrder()->get();
        } elseif ($local == 'en') {
            $data = EnActivity::where('link', $id)->first();
            $other_activity = EnActivity::inRandomOrder()->get();
        }
        // OKUMA KONTRLÜ
        $readCheck = json_decode(\Illuminate\Support\Facades\Cookie::get('activity')) ?? [];
        if (!in_array($data->id, $readCheck)) {
            $data->view_counter = $data->view_counter + 1;
            $data->save();
            $readCheck[] = $data->id;
            \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::make('activity', json_encode($readCheck), 30));
        }
        return view('frontend.activity.detail', compact('data', 'other_activity'));
    }

    public function categoryDetail($id)
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            $cat = ActivityCategory::where('link', $id)->first();
            $data = Activity::where('status',1)->where('category', $cat->id)->get();
        } elseif ($local == 'en') {
            $cat = EnActivityCategory::where('link', $id)->first();
            $data = EnActivity::where('status',1)->where('category', $cat->id)->get();
        }

        return view('frontend.activity.category.detail', compact('data', 'cat'));
    }

    public function searchActivity(Request $request){

        $data = Activity::where('status',1)->get();
        if ($request->ay != null) {
            $data = Activity::where('status',1)->whereMonth('start_time', '=', $request->ay)->get();
        }
        if ($request->yil != null) {
            $data = Activity::where('status',1)->whereYear('start_time', $request->yil)->get();

        }
        if ($request->kategori != null) {
            $data = Activity::where('status',1)->where('category', $request->kategori)->get();

        }
        if ($request->konum != null) {
            $data = Activity::where('status',1)->where('country_id', $request->konum)->get();

        }
        if($request->search != null){
            $data = Activity::where('status',1)->where('title','like','%'.$request->search.'%')->get();
        }
        $cat = '';
        return view('frontend.activity.category.detail', compact('data', 'cat'));

    }

    
    public function calendar(Request $request)
    {
        if (isset($request->category)) {
            $events = Activity::where('status',1)->where('category', $request->category)
                ->latest()
                ->get();
        } else {
            $events = Activity::where('status',1)->latest()->get();
        }
        $categories = ActivityCategory::where('status',1)->all();
        return view('frontend.activity.calendar', compact('events', 'categories'));
    }

    public function close_activity()
    {
        $now = Carbon::now();

        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $data = Activity::where('start_time', '>=', $now)
                ->orderBy('start_time', 'desc')
                ->get();
        } elseif ($local == 'en') {
            $data = EnActivity::where('start_time', '>=', $now)
                ->orderBy('start_time', 'desc')
                ->get();
        }
        return view('frontend.activity.category.detail', compact('data'));
    }
}
