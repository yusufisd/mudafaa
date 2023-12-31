<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DefenseIndustry;
use App\Models\DefenseIndustryCategory;
use App\Models\DefenseIndustryContent;
use App\Models\DefenseViewCounter;
use App\Models\EnDefenseIndustryCategory;
use App\Models\EnDefenseIndustryContent;
use Illuminate\Http\Request;

class DefenseIndustryContentController extends Controller
{
    public function detail($id = null){
        if ($id == null) return redirect('/');
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $data = DefenseIndustryContent::where('link',$id)->first();
            $previous_product = DefenseIndustryContent::where('id',$data->id-1)->first();
            $next_product = DefenseIndustryContent::where('id',$data->id+1)->first();
            $other_product = DefenseIndustryContent::inRandomOrder()->get();
        }else{
            $data = EnDefenseIndustryContent::where('link',$id)->first();
            $previous_product = EnDefenseIndustryContent::where('id',$data->id-1)->first();
            $next_product = EnDefenseIndustryContent::where('id',$data->id+1)->first();
            $other_product = EnDefenseIndustryContent::inRandomOrder()->get();
        }

        // OKUMA KONTRLÜ
        $readCheck = json_decode(\Illuminate\Support\Facades\Cookie::get('defense')) ?? [];
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
            \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::make('defense', json_encode($readCheck), 30));
        }

        return view('frontend.defenseIndustry.detail',compact('data','previous_product','next_product','other_product'));
    }

    
}
