<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CurrentNewsCategoryController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) return redirect('/');

        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $name = CurrentNewsCategory::where('link',$id)->first();
            $datas = CurrentNews::where('category_id', $name->id)->where('status', 1)->paginate(8);
            $sub_categories = CurrentNewsCategory::latest()
                ->take(7)
                ->get();
            $other_news = CurrentNews::where('status', 1)->latest()->take(6)->get();
        } elseif ($local == 'en') {
            $name = EnCurrentNewsCategory::where('link',$id)->first();
            $datas = EnCurrentNews::where('category_id', $name->id)->where('status', 1)->paginate(8);
            $sub_categories = EnCurrentNewsCategory::latest()
                ->take(7)
                ->get();
            $other_news = EnCurrentNews::latest()->take(6)->get();
        }

        return view('frontend.currentNewsCategory.list', compact('datas', 'sub_categories', 'other_news','name'));
    }
}
