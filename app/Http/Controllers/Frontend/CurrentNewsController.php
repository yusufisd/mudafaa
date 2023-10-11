<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\EnCurrentNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CurrentNewsController extends Controller
{
    public function detail($id = null){
        if ($id == null) return redirect('/');
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $data = CurrentNews::where('link',$id)->first();;
            $previous_data = CurrentNews::where('id', '<',$data->id)->where('status', 1)->latest()->first();
            $next_data = CurrentNews::where('id', '>', $data->id)->where('status', 1)->first();
            $other_news = CurrentNews::where('category_id',$data->category_id)->where('status', 1)->get();
            $four_news = CurrentNews::orderBy('view_counter', 'desc')->where('status', 1)->take(4)->get();
        }else{
            $data = EnCurrentNews::where('link',$id)->first();;
            $previous_data = EnCurrentNews::where('id', '<',$data->id)->where('status', 1)->latest()->first();
            $next_data = EnCurrentNews::where('id', '>', $data->id)->where('status', 1)->first();
            $other_news = EnCurrentNews::where('category_id',$data->category_id)->where('status', 1)->get();
            $four_news = EnCurrentNews::orderBy('view_counter', 'desc')->where('status', 1)->take(4)->get();
        }
        // OKUMA KONTRLÜ
        $readCheck = json_decode(Cookie::get('readed')) ?? [];
        if (!in_array($data->id, $readCheck)){
            $data->view_counter = $data->view_counter + 1;
            $data->save();
            $readCheck[] = $data->id;
            Cookie::queue(Cookie::make('readed', json_encode($readCheck), 30));
        }




        return view('frontend.currentNews.detail',compact('data','previous_data','next_data','other_news','four_news'));
    }
}
