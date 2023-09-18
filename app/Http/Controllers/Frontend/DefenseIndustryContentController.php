<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DefenseIndustry;
use App\Models\DefenseIndustryContent;
use Illuminate\Http\Request;

class DefenseIndustryContentController extends Controller
{
    public function detail($id){
        $data = DefenseIndustryContent::findOrFail($id);
        
        $previous_product = DefenseIndustryContent::where('id',$id-1)->first();
        $next_product = DefenseIndustryContent::where('id',$id+1)->first();
        $other_product = DefenseIndustryContent::inRandomOrder()->get();
        
        return view('frontend.defenseIndustry.detail',compact('data','previous_product','next_product','other_product'));
    }
}
