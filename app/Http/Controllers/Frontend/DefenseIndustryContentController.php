<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DefenseIndustryContent;
use App\Models\DefenseViewCounter;
use App\Models\EnDefenseIndustryContent;
use Illuminate\Support\Facades\Cookie;

class DefenseIndustryContentController extends Controller
{
    public function detail($id = null){
        if ($id == null) return redirect('/');
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $data = DefenseIndustryContent::where('link',$id)->first();
            if (!$data) return abort(404);
            $other_product = DefenseIndustryContent::select('title','image','live_time','link')->where('status',1)->inRandomOrder()->take(8)->get();
        }else{
            $data = EnDefenseIndustryContent::where('link',$id)->first();
            if (!$data) return abort(404);
            $other_product = EnDefenseIndustryContent::select('title','image','live_time','link')->where('status',1)->inRandomOrder()->take(8)->get();
        }

        // OKUMA KONTRLÜ
        $readCheck = json_decode(Cookie::get('defense')) ?? [];
        if (!in_array($data->id, $readCheck)){
            if(DefenseViewCounter::where('defense_id',$data->id)->first() != null){
                $defense = DefenseViewCounter::where('defense_id',$data->id)->first();
                $defense->view_counter = $defense->view_counter + 1;
                $defense->save();
            }else{
                $defense = new DefenseViewCounter();
                $defense->defense_id = $data->id;
                $defense->view_counter = 1;
                $defense->save();
            }
            $readCheck[] = $data->id;
            Cookie::queue(Cookie::make('defense', json_encode($readCheck), 30));
        }

        return view('frontend.defenseIndustry.detail',compact('data','other_product'));
    }

    
}
