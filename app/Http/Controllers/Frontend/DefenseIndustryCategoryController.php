<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DefenseIndustry;
use App\Models\DefenseIndustryCategory;
use App\Models\DefenseIndustryContent;
use Illuminate\Http\Request;

class DefenseIndustryCategoryController extends Controller
{
    public function index($id){
        $defense = DefenseIndustry::where('link',$id)->first();
        $data = DefenseIndustryCategory::where('defense_id',$defense->id)->take(6)->get();
        $contents_first = DefenseIndustryContent::where('defense_id',$defense->id)->orderBy('id','asc')->take(6)->get();
        return view('frontend.defenseIndustryCategory.list',compact('data','contents_first','defense'));
    }

    public function sub_category_index($id){
        $defense = DefenseIndustryCategory::where('link',$id)->first();
        $data = DefenseIndustryCategory::where('defense_id',$defense->defense_id)->take(6)->get();
        $contents_first = DefenseIndustryContent::where('defense_id',$defense->id)->orderBy('id','asc')->take(6)->get();
        return view('frontend.defenseIndustryCategory.list',compact('data','contents_first','defense'));

    }
}
