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
    public function index($id = null,Request $request){
        if ($id == null) return redirect('/');

        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $defense = DefenseIndustry::where('link',$id)->first();
            $data = DefenseIndustryCategory::where('defense_id',$defense->id)->take(6)->get();
            if($request->search != null){
                $contents_first = DefenseIndustryContent::where('defense_id',$defense->id)->where('status', 1)->where('title','like', '%'. $request->search . '%')->orderBy('id','asc')->paginate(8);
            }else{
                $contents_first = DefenseIndustryContent::where('defense_id',$defense->id)->where('status', 1)->orderBy('id','asc')->paginate(8);
            }

        }else{
            $defense = EnDefenseIndustry::where('link',$id)->first();
            $data = EnDefenseIndustryCategory::where('defense_id',$defense->id)->take(6)->get();
            if($request->search != null){
                $contents_first = EnDefenseIndustryContent::where('defense_id',$defense->id)->where('status', 1)->where('title','like', '%'. $request->search . '%')->orderBy('id','asc')->paginate(8);
            }else{
                $contents_first = EnDefenseIndustryContent::where('defense_id',$defense->id)->where('status', 1)->orderBy('id','asc')->paginate(8);
            }
        }

        $kvkk_tr = Page::where('link','like','%'.'kvkk'.'%')->first();
        $kvkk_en = EnPage::where('link','like','%'.'pdpl'.'%')->first();

        return view('frontend.defenseIndustryCategory.list',compact('data','contents_first','defense','kvkk_tr','kvkk_en'));
    }

    public function sub_category_index($id = null,Request $request){
        if ($id == null) return redirect('/');

        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == "tr"){
            $defense = DefenseIndustryCategory::where('link',$id)->first();
            $data = DefenseIndustryCategory::where('defense_id',$defense->defense_id)->take(6)->get();
            if($request->search != null){
                $contents_first = DefenseIndustryContent::where('category_id',$defense->id)->where('status', 1)->where('title','like', '%'. $request->search . '%')->orderBy('id','asc')->paginate(8);
            }else{
                $contents_first = DefenseIndustryContent::where('category_id',$defense->id)->where('status', 1)->orderBy('id','asc')->paginate(8);
            }
        }else{
            $defense = EnDefenseIndustryCategory::where('link',$id)->first();
            $data = EnDefenseIndustryCategory::where('defense_id',$defense->defense_id)->take(6)->get();
            if($request->search != null){
                $contents_first = EnDefenseIndustryContent::where('category_id',$defense->id)->where('status', 1)->where('title','like', '%'. $request->search . '%')->orderBy('id','asc')->paginate(8);
            }else{
                $contents_first = EnDefenseIndustryContent::where('category_id',$defense->id)->where('status', 1)->orderBy('id','asc')->paginate(8);
            }
        }

        $kvkk_tr = Page::where('link','like','%'.'kvkk'.'%')->first();
        $kvkk_en = EnPage::where('link','like','%'.'pdpl'.'%')->first();

        return view('frontend.defenseIndustryCategory.list',compact('data','contents_first','defense','kvkk_tr','kvkk_en'));

    }

    public function tag_list($title, Request $request){

        $local = session('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            if($request->search != null){
                $datas = DefenseIndustryContent::where('status', 1)->where('seo_key', 'LIKE' , '%'.$title.'%')->where('title','like', '%'. $request->search . '%')->orderBy('id','asc')->paginate(10);
            }else{
                $datas = DefenseIndustryContent::where('status', 1)->where('seo_key', 'LIKE' , '%'.$title.'%')->orderBy('id','asc')->paginate(10);
            }
            $data = DefenseIndustryCategory::inRandomOrder()->take(6)->get();
            
        } elseif ($local == 'en') {
            if($request->search != null){
                $datas = EnDefenseIndustryContent::where('status', 1)->where('seo_key', 'LIKE' , '%'.$title.'%')->where('title','like', '%'. $request->search . '%')->orderBy('id','asc')->paginate(10);
            }else{
                $datas = EnDefenseIndustryContent::where('status', 1)->where('seo_key', 'LIKE' , '%'.$title.'%')->orderBy('id','asc')->paginate(10);
            }
            $data = EnDefenseIndustryCategory::inRandomOrder()->take(6)->get();
        }

        $kvkk_tr = Page::where('link','like','%'.'kvkk'.'%')->first();
        $kvkk_en = EnPage::where('link','like','%'.'pdpl'.'%')->first();
        if($title != null){
            $title = ucwords($title);
        }

        return view('frontend.defenseIndustry.tag_list',compact('datas','data','kvkk_tr','kvkk_en','title'));
    }
}
