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
use RealRashid\SweetAlert\Facades\Alert;

class InterviewController extends Controller
{
    public function index()
    {
        $locale = session('applocale') ?? config('app.fallback_locale');

        if($locale == "tr"){
            $data = Interview::latest()->get();
            $populer_interview = Interview::inRandomOrder()
                ->take(4)
                ->get();
            $keys = Interview::select('seo_key', 'view_counter')->orderBy('view_counter', 'desc')->groupBy('id')->pluck('seo_key')->take(5)->toArray();
        }else{
            $data = EnInterview::latest()->get();
            $populer_interview = EnInterview::inRandomOrder()
                ->take(4)
                ->get();
            $keys = EnInterview::select('seo_key', 'view_counter')->orderBy('view_counter', 'desc')->groupBy('id')->pluck('seo_key')->take(5)->toArray();
        }

        return view('frontend.interview.list', compact('data', 'populer_interview','keys'));
    }

    public function detail($id)
    {
        $locale = session('applocale') ?? config('app.fallback_locale');
        if ($locale  == "tr") {
            $data = Interview::where('link', $id)->first();
            $dialogs = Dialog::where('interview_id', $data->id)->get();
            $next_data = Interview::where('id', '>' , $data->id)->first();
            $previous_data = Interview::where('id', '<' , $data->id)->first();
            $other_interview = Interview::inRandomOrder()->get();
        }else{
            $data = EnInterview::where('link', $id)->first();
            $dialogs = EnDialog::where('interview_id', $id)->get();
            $next_data = EnInterview::where('id', '>' , $data->id)->first();
            $previous_data = EnInterview::where('id', '<' , $data->id)->first();
            $other_interview = EnInterview::inRandomOrder()->get();
        }

        // OKUMA KONTRLÜ
        $readCheck = json_decode(\Illuminate\Support\Facades\Cookie::get('interview')) ?? [];
        if (!in_array($data->id, $readCheck)){
            $data->view_counter = $data->view_counter + 1;
            $data->save();
            $readCheck[] = $data->id;
            \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::make('interview', json_encode($readCheck), 30));
        }

        $emojies = [
            "love" => ContentEmojiModel::where('post_id', $data->id)->where('post_type', PostType::INTERVIEWS)->where('emoji_type', EmojiType::LOVE)->count(),
            "dislike" => ContentEmojiModel::where('post_id', $data->id)->where('post_type', PostType::INTERVIEWS)->where('emoji_type', EmojiType::DISLIKE)->count(),
            "clap" => ContentEmojiModel::where('post_id', $data->id)->where('post_type', PostType::INTERVIEWS)->where('emoji_type', EmojiType::CLAP)->count(),
            "sad" => ContentEmojiModel::where('post_id', $data->id)->where('post_type', PostType::INTERVIEWS)->where('emoji_type', EmojiType::SAD)->count(),
            "angry" => ContentEmojiModel::where('post_id', $data->id)->where('post_type', PostType::INTERVIEWS)->where('emoji_type', EmojiType::ANGRY)->count(),
            "shocked" => ContentEmojiModel::where('post_id', $data->id)->where('post_type', PostType::INTERVIEWS)->where('emoji_type', EmojiType::SHOCKED)->count(),
        ];

        return view('frontend.interview.detail', compact('data', 'dialogs', 'emojies', 'next_data', 'previous_data', 'other_interview'));
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
