<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DefenseIndustry;
use App\Models\DefenseIndustryCategory;
use App\Models\DefenseIndustryContent;
use App\Models\EnDefenseIndustry;
use App\Models\EnDefenseIndustryCategory;
use App\Models\EnDefenseIndustryContent;
use App\Models\EnPage;
use App\Models\Page;
use Illuminate\Http\Request;

class DefenseIndustryCategoryController extends Controller
{
    public function index($id = null){
        if ($id == null) return redirect('/');

        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $defense = DefenseIndustry::where('link',$id)->first();
            $data = DefenseIndustryCategory::where('defense_id',$defense->id)->take(6)->get();
            $contents_first = DefenseIndustryContent::where('defense_id',$defense->id)->where('status', 1)->orderBy('id','asc')->paginate(8);
        }else{
            $defense = EnDefenseIndustry::where('link',$id)->first();
            $data = EnDefenseIndustryCategory::where('defense_id',$defense->id)->take(6)->get();
            $contents_first = EnDefenseIndustryContent::where('defense_id',$defense->id)->where('status', 1)->orderBy('id','asc')->paginate(8);
        }

        $kvkk_tr = Page::where('link','like','%'.'kvkk'.'%')->first();
        $kvkk_en = EnPage::where('link','like','%'.'pdpl'.'%')->first();

        return view('frontend.defenseIndustryCategory.list',compact('data','contents_first','defense','kvkk_tr','kvkk_en'));
    }

    public function sub_category_index($id = null){
        if ($id == null) return redirect('/');

        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $defense = DefenseIndustryCategory::where('link',$id)->first();
            $data = DefenseIndustryCategory::where('defense_id',$defense->defense_id)->take(6)->get();
            $contents_first = DefenseIndustryContent::where('category_id',$defense->id)->where('status', 1)->orderBy('id','asc')->paginate(8);
        }else{
            $defense = EnDefenseIndustryCategory::where('link',$id)->first();
            $data = EnDefenseIndustryCategory::where('defense_id',$defense->defense_id)->take(6)->get();
            $contents_first = EnDefenseIndustryContent::where('category_id',$defense->id)->where('status', 1)->orderBy('id','asc')->paginate(8);
        }

        $kvkk_tr = Page::where('link','like','%'.'kvkk'.'%')->first();
        $kvkk_en = EnPage::where('link','like','%'.'pdpl'.'%')->first();

        return view('frontend.defenseIndustryCategory.list',compact('data','contents_first','defense','kvkk_tr','kvkk_en'));

    }

    public function tag_list($title){

        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $datas = DefenseIndustryContent::where('seo_key', 'LIKE' , '%'.$title.'%')->paginate(10);
            $data = DefenseIndustryCategory::inRandomOrder()->take(6)->get();
            
        } elseif ($local == 'en') {
            $datas = EnDefenseIndustryContent::where('seo_key', 'LIKE' , '%'.$title.'%')->paginate(10);
            $data = EnDefenseIndustryCategory::inRandomOrder()->take(6)->get();
        }

        $kvkk_tr = Page::where('link','like','%'.'kvkk'.'%')->first();
        $kvkk_en = EnPage::where('link','like','%'.'pdpl'.'%')->first();

        return view('frontend.defenseIndustry.tag_list',compact('datas','data','kvkk_tr','kvkk_en'));
    }
}
