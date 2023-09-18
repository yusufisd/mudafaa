<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use Illuminate\Http\Request;

class CurrentNewsCategoryController extends Controller
{
    public function index($id)
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $datas = CurrentNews::where('category_id', $id)->get();
            $sub_categories = CurrentNewsCategory::latest()
                ->take(7)
                ->get();
            $other_news = CurrentNews::latest()->get();
        } elseif ($local == 'en') {
            $datas = EnCurrentNews::where('category_id', $id)->get();
            $sub_categories = EnCurrentNewsCategory::latest()
                ->take(7)
                ->get();
            $other_news = EnCurrentNewsCategory::latest()->get();
        }

        return view('frontend.currentNewsCategory.list', compact('datas', 'sub_categories', 'other_news'));
    }
}
