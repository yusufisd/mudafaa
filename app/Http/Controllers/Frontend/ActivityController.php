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
            $coming_activity = Activity::where('start_time', '<', $now)
                ->orderBy('start_time', 'asc')
                ->take(4)
                ->get();
            $activity_category = ActivityCategory::orderBy('queue','asc')->get();
            $categories = ActivityCategory::get();
            $countries = CountryList::get();
        } elseif ($local == 'en') {
            $coming_activity = EnActivity::where('start_time', '<', $now)
                ->orderBy('start_time', 'asc')
                ->take(4)
                ->get();
            $activity_category = EnActivityCategory::orderBy('queue','asc')->get();
            $categories = EnActivityCategory::get();
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
            $data = Activity::where('link',$id)->first();
            $other_activity = Activity::inRandomOrder()->get();

        } elseif ($local == 'en') {
            $data = EnActivity::where('link',$id)->first();
            $other_activity = EnActivity::inRandomOrder()->get();
        }
        // OKUMA KONTRLÜ
        $readCheck = json_decode(\Illuminate\Support\Facades\Cookie::get('activity')) ?? [];
        if (!in_array($data->id, $readCheck)){
            $data->view_counter = $data->view_counter + 1;
            $data->save();
            $readCheck[] = $data->id;
            \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::make('activity', json_encode($readCheck), 30));
        }
        return view('frontend.activity.detail', compact('data', 'other_activity'));
    }

    public function categoryDetail($id)
    {
        $cat = ActivityCategory::where('link',$id)->first();
        $data = Activity::where('category', $cat->id)->get();
        return view('frontend.activity.category.detail', compact('data', 'cat'));
    }

    public function searchActivity(Request $request)
    {
        if ($request->ay != null) {
            if ($request->yil != null) {
                if ($request->kategori != null) {
                    if ($request->konum != null) {
                        $cat = '';

                        $data = Activity::whereMonth('start_time', '=', $request->ay)
                            ->whereYear('start_time', $request->yil)
                            ->where('category', $request->kategori)
                            ->where('country_id', $request->konum)
                            ->get();
                        return view('frontend.activity.category.detail', compact('data', 'cat'));
                    }
                    $cat = '';

                    $data = Activity::whereMonth('start_time', '=', $request->ay)
                        ->whereYear('start_time', $request->yil)
                        ->where('category', $request->kategori)
                        ->get();
                    return view('frontend.activity.category.detail', compact('data', 'cat'));
                }
                $cat = '';

                $data = Activity::whereMonth('start_time', '=', $request->ay)
                    ->whereYear('start_time', $request->yil)
                    ->get();
                return view('frontend.activity.category.detail', compact('data', 'cat'));
            }

            if ($request->kategori != null) {
                if ($request->konum != null) {
                    $cat = '';

                    $data = Activity::whereMonth('start_time', '=', $request->ay)
                        ->whereYear('start_time', $request->yil)
                        ->where('category', $request->kategori)
                        ->where('country_id', $request->konum)
                        ->get();
                    return view('frontend.activity.category.detail', compact('data', 'cat'));
                }
                $cat = '';

                $data = Activity::whereMonth('start_time', '=', $request->ay)
                    ->whereYear('start_time', $request->yil)
                    ->where('category', $request->kategori)
                    ->get();
                return view('frontend.activity.category.detail', compact('data', 'cat'));
            }

            if ($request->konum != null) {
                $cat = '';

                $data = Activity::whereMonth('start_time', '=', $request->ay)
                    ->whereYear('start_time', $request->yil)
                    ->where('category', $request->kategori)
                    ->where('country_id', $request->konum)
                    ->get();
                return view('frontend.activity.category.detail', compact('data', 'cat'));
            }
            $cat = '';

            $data = Activity::whereMonth('start_time', '=', $request->ay)->get();
            return view('frontend.activity.category.detail', compact('data', 'cat'));
        }
        if ($request->yil != null) {
            if ($request->kategori != null) {
                if ($request->konum != null) {
                    $cat = '';

                    $data = Activity::whereYear('start_time', $request->yil)
                        ->where('category', $request->kategori)
                        ->where('country_id', $request->konum)
                        ->get();
                    return view('frontend.activity.category.detail', compact('data', 'cat'));
                }
                $cat = '';

                $data = Activity::whereYear('start_time', $request->yil)
                    ->where('category', $request->kategori)
                    ->get();
                return view('frontend.activity.category.detail', compact('data', 'cat'));
            }

            if ($request->konum != null) {
                $cat = '';

                $data = Activity::whereYear('start_time', $request->yil)
                    ->where('category', $request->kategori)
                    ->where('country_id', $request->konum)
                    ->get();
                return view('frontend.activity.category.detail', compact('data', 'cat'));
            }
            $cat = '';

            $data = Activity::whereYear('start_time', $request->yil)->get();
            return view('frontend.activity.category.detail', compact('data', 'cat'));
        }
        if ($request->kategori != null) {
            if ($request->konum != null) {
                $cat = '';

                $data = Activity::where('category', $request->kategori)
                    ->where('country_id', $request->konum)
                    ->get();
                return view('frontend.activity.category.detail', compact('data', 'cat'));
            }
            $cat = '';

            $data = Activity::where('category', $request->kategori)->get();
            return view('frontend.activity.category.detail', compact('data', 'cat'));
        }
        if ($request->konum != null) {
            $cat = '';

            $data = Activity::where('country_id', $request->konum)->get();
            return view('frontend.activity.category.detail', compact('data', 'cat'));
        }
    }

    public function calendar(Request $request){
        if (isset($request->category)){
            $events = Activity::where('category', $request->category)->latest()->get();
        }else{
            $events = Activity::latest()->get();
        }
        $categories = ActivityCategory::all();
        return view('frontend.activity.calendar',compact('events', 'categories'));
    }
}
