<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\DefenseIndustryContent;
use App\Models\EnCurrentNews;
use App\Models\EnDefenseIndustryContent;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function index(Request $request){
        $locale = session('applocale') ?? config('app.fallback_locale');
        if ($locale == "tr") {
            $news = CurrentNews::where('title', 'like', '%' . $request->s . '%')->get();
            $defenses = DefenseIndustryContent::where('title', 'like', '%' . $request->s .'%')->paginate(10);
        }else{
            $news = EnCurrentNews::where('title', 'like', '%' . $request->s . '%')->get();
            $defenses = EnDefenseIndustryContent::where('title', 'like', '%' . $request->s .'%')->paginate(10);
        }
        $mergedata = $news->concat($defenses);
        $currentPage = request()->get('page', 1); // Aktif sayfa numarasını al, varsayılan olarak 1
        $perPage = 10; // Sayfa başına öğe sayısı
        $data = new LengthAwarePaginator(
            $mergedata->forPage($currentPage, $perPage),
            $mergedata->count(),
            $perPage,
            $currentPage
        );

        return view('frontend.search', compact('data'));
    }
}
