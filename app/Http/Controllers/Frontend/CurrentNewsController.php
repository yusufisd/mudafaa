<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use Illuminate\Http\Request;

class CurrentNewsController extends Controller
{
    public function detail($id){
        $data = CurrentNews::findOrFail($id);
        $previous_data = CurrentNews::where('id',$id-1)->first();
        $next_data = CurrentNews::where('id',$id+1)->first();
        $other_news = CurrentNews::where('category_id',$data->category_id)->get();
        $four_news = CurrentNews::inRandomOrder()->take(4)->get();


        return view('frontend.currentNews.detail',compact('data','previous_data','next_data','other_news','four_news'));
    }
}
