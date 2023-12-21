<?php

use App\Models\AdsenseModel;
use App\Models\Comment;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\DefenseIndustry;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use App\Models\EnDefenseIndustry;
use App\Models\EnPage;
use App\Models\EnTopbar;
use App\Models\InterviewComment;
use App\Models\LogModel;
use App\Models\Page;
use App\Models\Reklam;
use App\Models\SocialMedia;
use App\Models\Topbar;
use App\Models\UserModel;
use App\Models\VideoComment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function logKayit($id)
{
    $auth = Auth::guard('admin')->user();
    if($auth == null){
        $auth = Auth::guard('user_model')->user();
    }
    $log = new LogModel();
    $log->title = $id[0];
    $log->description = $id[1];
    $log->user = $auth->name . ' ' . $auth->surname;
    if (isset($id[2])) {
        $log->success = 0;
    }
    $log->save();
}

function currentCats()
{
    $local = \Session::get('applocale');
    if ($local == null) {
        $local = config('app.fallback_locale');
    }
    if ($local == 'tr') {
        $cats = CurrentNewsCategory::where('status', 1)->orderBy('queue', 'asc')->get();
    } elseif ($local == 'en') {
        $cats = EnCurrentNewsCategory::where('status', 1)->orderBy('id', 'asc')->get();
    }
    return $cats;
}

function defenseIndustryCat()
{
    $local = \Session::get('applocale');
    if ($local == null) {
        $local = config('app.fallback_locale');
    }
    if ($local == 'tr') {
        $cats = DefenseIndustry::orderBy('queue', 'asc')->get();
    } elseif ($local == 'en') {
        $cats = EnDefenseIndustry::orderBy('id', 'asc')->get();
    }
    return $cats;
}

function headline()
{
    $local = \Session::get('applocale') ?? config('app.fallback_locale');

    if ($local == 'tr') {
        $cats = CurrentNews::where('headline', 1)->where('status',1)->get();
    } elseif ($local == 'en') {
        $cats = EnCurrentNews::where('headline', 1)->where('status',1)->get();
    }
    return $cats;
}

function currentDate()
{
    return Carbon::now();
}

function langua()
{
    return $local = \Session::get('applocale') ?? config('app.fallback_locale');
}

function sayfalar(){
    $local = \Session::get('applocale') ?? config('app.fallback_locale');

    if ($local == 'tr') {
        $data = Page::latest()->get();
    } elseif ($local == 'en') {
        $data = EnPage::latest()->get();
    }
    return $data;
}

function SocialMedia(){
    $data = SocialMedia::latest()->first();
    return $data;
}


function printDesc($desc){
    $desc = str_replace('<ol>', '<ol class="number_list">', $desc);
    $desc = str_replace('<ul>', '<ul class="disc_list">', $desc);
    return $desc;
}


function AuthorUser(){
    $data = Auth::guard('user_model')->user();
    $user = UserModel::where('email',$data->email)->first();
    return $user;
}

function most_popular_new(){
    $local = \Session::get('applocale') ?? config('app.fallback_locale');

    if ($local == 'tr') {
        $data = CurrentNews::orderBy('view_counter','desc')->where('status',1)->first();
    } elseif ($local == 'en') {
        $data = EnCurrentNews::orderBy('view_counter','desc')->where('status',1)->first();
    }
    return $data;
}

function getCaptchaSiteKey(){
    return "6LfCwQgpAAAAAInvavlOQObCUTU_Blegu8we7BOP";
}

function is_adsense($reklam,$id){
    if(Reklam::where('reklam_id',$reklam)->where('alan_id',$id)->first() != null){
        return 1;
    }else{
        return 0;
    }
}

function reklam($id){
    if(Reklam::where('alan_id',$id)->first() != null){
        $data = Reklam::where('alan_id',$id)->first();
        $data2 = AdsenseModel::where('id',$data->reklam_id)->first();
        if($data2 != null){
            return $data2;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function commentsTotal(){
    $haber_yorum = Comment::count();
    $roportaj_yorum = InterviewComment::count();
    $video_yorum = VideoComment::count();
    return $haber_yorum + $roportaj_yorum + $video_yorum;
}

function master_currentCommentsCount(){
    return Comment::count();
}

function master_interviewCommentsCount(){
    return InterviewComment::count();
}

function master_videoCommentsCount(){
    return VideoComment::count();
}

function Topbar(){
    $local = \Session::get('applocale') ?? config('app.fallback_locale');

    $now = Carbon::now();
    $data = '';
    if ($local == 'tr') {
        if(Topbar::where('start_time','<',$now)->where('finish_time','>',$now)->first() != null){
            $data = Topbar::where('start_time','<',$now)->where('finish_time','>',$now)->first();
        }
    } elseif ($local == 'en') {
        if(EnTopbar::where('start_time','<',$now)->where('finish_time','>',$now)->first() != null){
            $data = EnTopbar::where('start_time','<',$now)->where('finish_time','>',$now)->first();
        }
    }
    return $data;
}