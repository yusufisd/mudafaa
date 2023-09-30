<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\CountryList;
use App\Models\EnAbout;
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
            $cat1_name = ActivityCategory::where('id', 1)->first();
            $cat2_name = ActivityCategory::where('id', 2)->first();
            $cat3_name = ActivityCategory::where('id', 3)->first();
            $cat1_activites = Activity::where('category', 1)
                ->take(4)
                ->get();
            $cat3_activites = Activity::where('category', 3)
                ->take(4)
                ->get();
            $cat2_activites = Activity::where('category', 2)
                ->take(4)
                ->get();
            $categories = ActivityCategory::get();
            $countries = CountryList::get();
        } elseif ($local == 'en') {
            $coming_activity = Activity::where('start_time', '<', $now)
                ->orderBy('start_time', 'asc')
                ->take(4)
                ->get();
            $cat1_name = EnActivityCategory::where('id', 1)->first();
            $cat2_name = EnActivityCategory::where('id', 2)->first();
            $cat3_name = EnActivityCategory::where('id', 3)->first();
            $cat1_activites = EnActivity::where('category', 1)
                ->take(4)
                ->get();
            $cat3_activites = EnActivity::where('category', 3)
                ->take(4)
                ->get();
            $cat2_activites = EnActivity::where('category', 2)
                ->take(4)
                ->get();
            $categories = EnActivityCategory::get();
            $countries = CountryList::get();
        }

        return view('frontend.activity.list', compact('coming_activity', 'cat1_activites', 'cat2_activites', 'cat3_activites', 'cat1_name', 'cat2_name', 'cat3_name', 'categories', 'countries'));
    }

    public function detail($id)
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            $data = Activity::findOrFail($id);
            $other_activity = Activity::inRandomOrder()->get();

        } elseif ($local == 'en') {
            $data = EnActivity::where('activity_id',$id);
            $other_activity = EnActivity::inRandomOrder()->get();
        }
        return view('frontend.activity.detail', compact('data', 'other_activity'));
    }

    public function categoryDetail($id)
    {
        $cat = ActivityCategory::findOrFail($id);
        $data = Activity::where('category', $id)->get();
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
}
