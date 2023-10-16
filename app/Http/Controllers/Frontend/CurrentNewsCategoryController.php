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
    public function index($id = null, Request $request)
    {
        if ($id == null) return redirect('/');

        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $name = CurrentNewsCategory::where('link',$id)->first();
            if(!$name)  return redirect('/');

            if(isset($request->search)){
                $datas = CurrentNews::where('status', 1)->where('title','like', '%'. $request->search . '%')->whereJsonContains('category_id', $name->id)->paginate(10);
            }else{
                $datas = CurrentNews::where('status', 1)->whereJsonContains('category_id', $name->id)->paginate(10);
            }

            /*
            $datas = [];
            foreach($datas2 as $item){
                if(in_array($name->id,$item->category_id)){
                    array_push($datas,$item);
                }
            }

            $datas = array_chunk($datas, 10);

            dd($datas);

            */

            $sub_categories = CurrentNewsCategory::latest()
                ->take(7)
                ->get();
            $other_news = CurrentNews::where('status', 1)->latest()->take(6)->get();
        } elseif ($local == 'en') {
            $name = EnCurrentNewsCategory::where('link',$id)->first();
            if(!$name)  return redirect('/');

            if(isset($request->search)){
                $datas = EnCurrentNews::where('status', 1)->where('title','like', '%'. $request->search . '%')->whereJsonContains('category_id', $name->id)->paginate(10);
            }else{
                $datas = EnCurrentNews::where('status', 1)->whereJsonContains('category_id', $name->id)->paginate(10);
            }

            $sub_categories = EnCurrentNewsCategory::latest()
                ->take(7)
                ->get();
            $other_news = EnCurrentNews::latest()->take(6)->get();
        }

        return view('frontend.currentNewsCategory.list', compact('datas', 'sub_categories', 'other_news','name'));
    }
}
