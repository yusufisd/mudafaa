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
        $data = DefenseIndustryCategory::where('defense_id',$id)->take(6)->get();
        return view('frontend.defenseIndustryCategory.list',compact('data'));
    }
}
