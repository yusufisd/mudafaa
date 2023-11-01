<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ArchiveController extends Controller
{
    public function index(Request $request){



        if(isset($request->t) && isset($request->c)){
            if(isset($request->t) && $request->t != "all"){
                $year   = explode('-',$request->t)[0];
                $month  = explode('-',$request->t)[1];
            }
            
            $local  = session('applocale') ?? config('app.fallback_locale');
            $category_id = $request->c;
    
            if ($local == 'tr') {
                $data = new CurrentNews();
                $top_news = CurrentNews::orderBy('view_counter','desc')->take(6)->get();
                $cats = CurrentNewsCategory::orderBy('queue','asc')->get();
                if(isset($request->t) && $request->t != "all"){
                    $data = $data->whereYear('live_time', '=', $year)->whereMonth('live_time', '=', $month);
                }
            }else{
                $data = new EnCurrentNews();
                if(isset($request->t) && $request->t != "all"){
                    $data = $data->whereYear('live_time', '=', $year)->whereMonth('live_time', '=', $month);
                }
                $top_news = EnCurrentNews::orderBy('view_counter','desc')->take(6)->get();
                $cats = EnCurrentNewsCategory::orderBy('queue','asc')->get();
            }
            if($category_id != "all") $data = $data->whereRaw('JSON_CONTAINS(category_id, ?)', [$category_id]);
            
            $data = $data->paginate(10);
            




        }else{
            $local = session('applocale') ?? config('app.fallback_locale');
            if ($local == 'tr') {
                $data = CurrentNews::inRandomOrder()->paginate(10);
                $top_news = CurrentNews::orderBy('view_counter','desc')->take(6)->get();
                $cats = CurrentNewsCategory::orderBy('queue','asc')->get();
            } elseif ($local == 'en') {
                $data = EnCurrentNews::inRandomOrder()->paginate(10);
                $top_news = EnCurrentNews::orderBy('view_counter','desc')->take(6)->get();
                $cats = EnCurrentNewsCategory::orderBy('queue','asc')->get();
                
            }
        }

        $etiketler = CurrentNews::orderBy('view_counter','desc')->first();

        $min_date = CurrentNews::orderBy('live_time','asc')->first()->live_time->format('Y');
        $max_date = CurrentNews::orderBy('live_time','desc')->first()->live_time->format('Y');

        $dates = [];
        for($y = $min_date; $y<= $max_date; $y++){
            $datas = [$y];
            for($i = 1; $i<=12; $i++){
                $icerik = CurrentNews::whereYear('live_time',$y)->whereMonth('live_time', '=', $i)->first();
                if($icerik == null){ continue;} 
                array_push($datas,$i);
            }
            array_push($dates,$datas);
        }

        $dates = array_reverse($dates);
       
        
        return view('frontend.archive',compact('data','top_news','cats','etiketler', 'dates', 'min_date','max_date'));
    }
}
