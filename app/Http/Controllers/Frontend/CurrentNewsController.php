<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CurrentNewsController extends Controller
{
    public function detail($id){

        $data = CurrentNews::where('link',$id)->first();
        // OKUMA KONTRLÜ
        $readCheck = json_decode(Cookie::get('readed')) ?? [];
        if (!in_array($data->id, $readCheck)){
            $data->view_counter = $data->view_counter + 1;
            $data->save();
            $readCheck[] = $data->id;
            Cookie::queue(Cookie::make('readed', json_encode($readCheck), 30));
        }

        $previous_data = CurrentNews::where('id',$data->id-1)->first();
        $next_data = CurrentNews::where('id',$data->id+1)->first();
        $other_news = CurrentNews::where('category_id',$data->category_id)->get();
        $four_news = CurrentNews::inRandomOrder()->take(4)->get();


        return view('frontend.currentNews.detail',compact('data','previous_data','next_data','other_news','four_news'));
    }
}
