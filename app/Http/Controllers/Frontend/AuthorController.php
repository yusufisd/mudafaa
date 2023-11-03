<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\EnCurrentNews;
use App\Models\UserModel;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function detail($id)
    {
        $data = UserModel::findOrFail($id);

        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == 'tr') {
            $news = CurrentNews::where('author_id', $id)->paginate(10);
            $popular_news = CurrentNews::orderBy('view_counter', 'desc')
                ->take(6)
                ->get();
        } else {
            $news = EnCurrentNews::where('author_id', $id)->paginate(10);
            $popular_news = EnCurrentNews::orderBy('view_counter', 'desc')
                ->take(6)
                ->get();
        }

        return view('frontend.author.detail', compact('data', 'news', 'popular_news'));
    }
}
