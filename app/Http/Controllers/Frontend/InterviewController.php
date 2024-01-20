<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContentEmojiModel;
use App\Models\Dialog;
use App\Models\EmojiType;
use App\Models\EnDialog;
use App\Models\EnInterview;
use App\Models\Interview;
use App\Models\InterviewComment;
use App\Models\PostType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;

class InterviewController extends Controller
{
    public function index(Request $request)
    {
        $locale = session('applocale') ?? config('app.fallback_locale');

        if($locale == "tr"){
            $data = Interview::latest()->where('title','like', '%'. $request->search . '%')->paginate(4);
            $populer_interview = Interview::inRandomOrder()->take(4)->get();
            $keys = Interview::select('seo_key', 'view_counter')->orderBy('view_counter', 'desc')->pluck('seo_key')->take(5)->toArray();
        }else{
            $data = EnInterview::latest()->where('title','like', '%'. $request->search . '%')->paginate(4);
            $populer_interview = EnInterview::inRandomOrder()->take(4)->get();
            $keys = EnInterview::select('seo_key', 'view_counter')->orderBy('view_counter', 'desc')->pluck('seo_key')->take(5)->toArray();
        }

        return view('frontend.interview.list', compact('data', 'populer_interview','keys'));
    }

    public function detail($id)
    {
        $locale = session('applocale') ?? config('app.fallback_locale');
        if ($locale  == "tr") {
            $data = Interview::where('link', $id)->first();
            if (!$data) return abort(404);
            $dialogs = Dialog::where('interview_id', $data->id)->get();
            $other_interview = Interview::select('id','link','image','live_time','title')->where('status',1)->inRandomOrder()->get();
        }else{
            $data = EnInterview::where('link', $id)->first();
            if (!$data) return abort(404);
            $dialogs = EnDialog::where('interview_id', $id)->get();
            $other_interview = EnInterview::select('id','link','image','live_time','title')->where('status',1)->inRandomOrder()->take(8)->get();
        }

        // OKUMA KONTRLÜ
        $readCheck = json_decode(Cookie::get('interview')) ?? [];
        if (!in_array($data->id, $readCheck)){
            $data->view_counter = $data->view_counter + 1;
            $data->save();
            $readCheck[] = $data->id;
            Cookie::queue(Cookie::make('interview', json_encode($readCheck), 30));
        }

        return view('frontend.interview.detail', compact('data', 'dialogs','other_interview'));
    }

    public function addComment(Request $request, $id)
    {
        $new = new InterviewComment();
        $new->full_name = $request->full_name;
        $new->email = $request->email;
        $new->comment = $request->comment;
        $new->post_id = $id;
        $new->save();
        Alert::success('Başarılı','Yorumunuz onaylandıktan sonra görünecektir.');
        return back();
    }
}
