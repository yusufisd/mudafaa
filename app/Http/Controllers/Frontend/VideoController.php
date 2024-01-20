<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EnVideo;
use App\Models\EnVideoCategory;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use App\Models\ContentEmojiModel;
use App\Models\PostType;
use App\Models\EmojiType;
use App\Models\VideoComment;
use RealRashid\SweetAlert\Facades\Alert;

class VideoController extends Controller
{
    public function index()
    {
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == 'tr') {
            $categories = VideoCategory::where('status',1)->orderBy('queue', 'asc')->get();
        } else {
            $categories = EnVideoCategory::where('status',1)->orderBy('queue', 'asc')->get();
        }

        return view('frontend.video.list', compact('categories'));
    }

    public function detail($link)
    {
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == 'tr') {
            $data = Video::where('link', $link)->first();
            if (!$data) return abort(404);
            $onceki = Video::where('status',1)->where('id','<',$data->id)->first();
            $sonraki = Video::where('status',1)->where('id','>',$data->id)->first();
            $other = Video::whereNot('link',$link)->get();
            $popular = Video::where('status',1)->orderBy('view_counter','desc')->first();
                
        } else {
            $data = EnVideo::where('status',1)->where('link', $link)->first();
            if (!$data) return abort(404);
            $onceki = EnVideo::where('status',1)->where('id','<',$data->id)->first();
            $sonraki = EnVideo::where('id','>',$data->id)->first();
            $other = EnVideo::whereNot('link',$link)->get();
            $popular = EnVideo::where('status',1)->orderBy('view_counter','desc')->first();
        }

        $emojies = [
            'love' => ContentEmojiModel::where('post_id', $data->id)
                ->where('post_type', PostType::NEWS)
                ->where('emoji_type', EmojiType::LOVE)
                ->count(),
            'dislike' => ContentEmojiModel::where('post_id', $data->id)
                ->where('post_type', PostType::NEWS)
                ->where('emoji_type', EmojiType::DISLIKE)
                ->count(),
            'clap' => ContentEmojiModel::where('post_id', $data->id)
                ->where('post_type', PostType::NEWS)
                ->where('emoji_type', EmojiType::CLAP)
                ->count(),
            'sad' => ContentEmojiModel::where('post_id', $data->id)
                ->where('post_type', PostType::NEWS)
                ->where('emoji_type', EmojiType::SAD)
                ->count(),
            'angry' => ContentEmojiModel::where('post_id', $data->id)
                ->where('post_type', PostType::NEWS)
                ->where('emoji_type', EmojiType::ANGRY)
                ->count(),
            'shocked' => ContentEmojiModel::where('post_id', $data->id)
                ->where('post_type', PostType::NEWS)
                ->where('emoji_type', EmojiType::SHOCKED)
                ->count(),
        ];

        // OKUMA KONTRLÜ
        $readCheck = json_decode(\Illuminate\Support\Facades\Cookie::get('video')) ?? [];
        if (!in_array($data->id, $readCheck)){
            $data->view_counter = $data->view_counter + 1;
            $data->save();
            $readCheck[] = $data->id;
            \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::make('video', json_encode($readCheck), 30));
        }

        return view('frontend.video.detail', compact('data', 'emojies','onceki','sonraki','other','popular'));
    }

    public function category_list($link)
    {
        $local = session('applocale') ?? config('app.fallback_locale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $cat = VideoCategory::where('status',1)->where('link', $link)->first();
            $data = Video::where('status',1)->where('category_id', $cat->id)->get();
        } elseif ($local == 'en') {
            $cat = EnVideoCategory::where('status',1)->where('link', $link)->first();
            $data = EnVideo::where('status',1)->where('category_id', $cat->id)->get();
        }

        return view('frontend.videoCategory.list', compact('data', 'cat'));
    }

    public function tag_list($tag)
    {
        $local = session('applocale') ?? config('app.fallback_locale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $data = Video::where('status',1)->where('seo_key', 'LIKE', '%' . $tag . '%')->paginate(10);
        } elseif ($local == 'en') {
            $data = EnVideo::where('status',1)->where('seo_key', 'LIKE', '%' . $tag . '%')->paginate(10);
        }

        return view('frontend.videoCategory.tag_list', compact('data'));
    }

    public function commentStore(Request $request, $id)
    {
        $request->validate(
            [
                'full_name' => 'required',
                'email' => 'required',
                'comment' => 'required',
            ],
            [
                'full_name.required' => 'İsim soyisim boş bırakılamaz',
                'email.required' => 'Email alanı boş bırakılamaz',
                'comment.required' => 'Yorum alanı boş bırakılamaz',
            ],
        );

        $new = new VideoComment();
        $new->full_name = $request->full_name;
        $new->email = $request->email;
        $new->comment = $request->comment;
        $new->post_id = $id;
        $new->save();
        Alert::success('Başarılı', 'Yorumunuz onaylandıktan sonra görünecektir.');
        return redirect()->back();
    }

    public function sub_commentStore(Request $request, $id)
    {
        if ($id != null) {
            $request->validate(
                [
                    'fullname' => 'required',
                    'email' => 'required',
                    'comment' => 'required',
                ],
                [
                    'full_name.required' => 'İsim soyisim boş bırakılamaz',
                    'email.required' => 'Email alanı boş bırakılamaz',
                    'comment.required' => 'Yorum alanı boş bırakılamaz',
                ],
            );

            $new = new VideoComment();
            $new->full_name = $request->fullname;
            $new->email = $request->email;
            $new->comment = $request->comment;
            $new->post_id = $id;
            $new->is_post = 0;
            $new->save();
            Alert::success('Başarılı', 'Yorumunuz onaylandıktan sonra görünecektir.');
            return redirect()->back();
        } else {
            Alert::error('hata');
            return back();
        }
    }
}
