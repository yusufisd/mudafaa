<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use App\Models\EnVideo;
use App\Models\UserModel;
use App\Models\Video;
use App\Models\VideoCategory;
use App\Models\VideoComment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;

class VideoController extends Controller
{
    public function index()
    {
        $data = Video::latest()->get();
        return view('backend.video.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        $categories = VideoCategory::latest()->get();
        $users = UserModel::latest()->get();
        return view('backend.video.add', compact('now', 'categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'category' => 'required',
            'author' => 'required',
            'live_date' => 'required',
            'name_tr' => 'required',
            'description_tr' => 'required',
            'youtube_tr' => 'required',
            'link_tr' => 'required',
            'name_en' => 'required',
            'description_en' => 'required',
            'youtube_en' => 'required',
            'link_en' => 'required',
            'seo_title_tr' => 'required',
            'seo_description_tr' => 'required',
            'seo_key_tr' => 'required',
            'seo_title_en' => 'required',
            'seo_description_en' => 'required',
            'seo_key_en' => 'required',
        ],
        [
            'image.required' => 'Görsel boş bırakılamaz',
            'category.required' => 'Kategori boş bırakılamaz',
            'author.required' => 'Yazar boş bırakılamaz',
            'live_date.required' => 'Yayınlama tarihi boş bırakılamaz',
            'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
            'description_tr.required' => 'Açıklama (TR) boş bırakılamaz',
            'youtube_tr.required' => 'Youtube linki (TR) boş bırakılamaz',
            'link_tr.required' => 'Link (TR) boş bırakılamaz',
            'name_en.required' => 'Başlık (EN) boş bırakılamaz',
            'description_en.required' => 'Açıklama (EN) boş bırakılamaz',
            'youtube_en.required' => 'Youtube linki (EN) boş bırakılamaz',
            'link_en.required' => 'Link (EN) boş bırakılamaz',
            'seo_title_tr.required' => 'Seo başlık (TR) boş bırakılamaz',
            'seo_description_tr.required' => 'Seo açıklama (TR) boş bırakılamaz',
            'seo_key_tr.required' => 'Seo anahtarı (TR) boş bırakılamaz',
            'seo_title_en.required' => 'Seo başlık (EN) boş bırakılamaz',
            'seo_description_en.required' => 'Seo açıklama (EN) boş bırakılamaz',
            'seo_key_en.required' => 'Seo anahtarı (EN) boş bırakılamaz',
        ]);
        try {
            DB::beginTransaction();

            $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
            $merge = [];
            foreach ($veri as $v) {
                $merge[] = $v->value;
            }
            $merge = implode(',', $merge);


            $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }
            $merge_en = implode(',', $merge_en);


            $news = new Video();
            $news->category_id = $request->category;
            $news->author = $request->author;
            $news->live_date = $request->live_date;
            $news->title = $request->name_tr;
            $news->description = $request->description_tr;
            $news->youtube = $request->youtube_tr;
            $news->link = $request->link_tr;
            $news->seo_title = $request->seo_title_tr;
            $news->seo_description = $request->seo_description_tr;
            $news->seo_key = $merge;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/video/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $news->image = $save_url;
            }
            if (!isset($request->status_tr)) {
                $news->status = 0;
            }
            $news->save();

            $news_en = new EnVideo();

            $news_en->live_date = $request->live_date;
            $news_en->author = $request->author;
            $news_en->category_id = $request->category;
            $news_en->title = $request->name_en;
            $news_en->description = $request->description_en;
            $news_en->youtube = $request->youtube_en;
            $news_en->link = $request->link_en;
            $news_en->seo_title = $request->seo_title_en;
            $news_en->seo_description = $request->seo_description_en;
            $news_en->seo_key = $merge_en;
            $news_en->video_id = $news->id;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/video/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $news_en->image = $save_url;
            }
            if (!isset($request->status_en)) {
                $news_en->status = 0;
            }
            $news_en->save();

            logKayit(['Video Yönetimi ', 'Video eklendi']);
            Alert::success('Video Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Video Yönetimi ', 'Video eklemede hata', 0]);
            Alert::error('Video Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.video.list');
    }

    public function edit($id)
    {
        $categories = VideoCategory::latest()->get();
        $users = UserModel::latest()->get();
        $data_tr = Video::findOrFail($id);
        $data_en = EnVideo::where('video_id', $id)->first();
        return view('backend.video.edit', compact('data_tr', 'data_en', 'categories', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'author' => 'required',
            'live_date' => 'required',
            'name_tr' => 'required',
            'description_tr' => 'required',
            'youtube_tr' => 'required',
            'link_tr' => 'required',
            'name_en' => 'required',
            'description_en' => 'required',
            'youtube_en' => 'required',
            'link_en' => 'required',
            'seo_title_tr' => 'required',
            'seo_description_tr' => 'required',
            'seo_key_tr' => 'required',
            'seo_title_en' => 'required',
            'seo_description_en' => 'required',
            'seo_key_en' => 'required',
        ],
        [
            'category.required' => 'Kategori boş bırakılamaz',
            'author.required' => 'Yazar boş bırakılamaz',
            'live_date.required' => 'Yayınlama tarihi boş bırakılamaz',
            'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
            'description_tr.required' => 'Açıklama (TR) boş bırakılamaz',
            'youtube_tr.required' => 'Youtube linki (TR) boş bırakılamaz',
            'link_tr.required' => 'Link (TR) boş bırakılamaz',
            'name_en.required' => 'Başlık (EN) boş bırakılamaz',
            'description_en.required' => 'Açıklama (EN) boş bırakılamaz',
            'youtube_en.required' => 'Youtube linki (EN) boş bırakılamaz',
            'link_en.required' => 'Link (EN) boş bırakılamaz',
            'seo_title_tr.required' => 'Seo başlık (TR) boş bırakılamaz',
            'seo_description_tr.required' => 'Seo açıklama (TR) boş bırakılamaz',
            'seo_key_tr.required' => 'Seo anahtarı (TR) boş bırakılamaz',
            'seo_title_en.required' => 'Seo başlık (EN) boş bırakılamaz',
            'seo_description_en.required' => 'Seo açıklama (EN) boş bırakılamaz',
            'seo_key_en.required' => 'Seo anahtarı (EN) boş bırakılamaz',
        ]);
        $request->validate([
            
        ]);
        try {
            DB::beginTransaction();

            $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
            $merge = [];
            foreach ($veri as $v) {
                $merge[] = $v->value;
            }
            $merge = implode(',', $merge);


            $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }
            $merge_en = implode(',', $merge_en);


            $news = Video::findOrFail($id);
            $news->category_id = $request->category;
            $news->author = $request->author;
            $news->live_date = $request->live_date;
            $news->title = $request->name_tr;
            $news->description = $request->description_tr;
            $news->youtube = $request->youtube_tr;
            $news->link = $request->link_tr;
            $news->seo_title = $request->seo_title_tr;
            $news->seo_description = $request->seo_description_tr;
            $news->seo_key = $merge;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/video/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $news->image = $save_url;
            }
            
            $news->save();


            $news_en = EnVideo::where('video_id', $id)->first();
            $news_en->live_date = $request->live_date;
            $news_en->author = $request->author;
            $news_en->category_id = $request->category;
            $news_en->title = $request->name_en;
            $news_en->description = $request->description_en;
            $news_en->youtube = $request->youtube_en;
            $news_en->link = $request->link_en;
            $news_en->seo_title = $request->seo_title_en;
            $news_en->seo_description = $request->seo_description_en;
            $news_en->seo_key = $merge_en;
            $news_en->video_id = $news->id;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/video/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $news_en->image = $save_url;
            }
            
            $news_en->save();

            logKayit(['Video Yönetimi ', 'Video düzenlendi']);
            Alert::success('Video Başarıyla Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Video Yönetimi ', 'Video düzenlemede hata', 0]);
            Alert::error('Video Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.video.list');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Video::findOrFail($id);
            EnVideo::where('video_id', $id)->delete();
            $data->delete();

            logKayit(['Video Yönetimi ', 'Video silindi']);
            Alert::success('Video Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Video Yönetimi ', 'Video silmede hata', 0]);
            Alert::error('Video Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.video.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = Video::findOrFail($id);
            $data_en = EnVideo::where('video_id', $id)->first();
            $data_en->status = !$data_en->status;
            $data_en->save();
            $data->status = !$data->status;
            $data->save();
            logKayit(['Video Yönetimi ', 'Video statüsü değiştirildi.']);
            Alert::success('Durum Başarıyla Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Video Yönetimi ', 'Video durum değiştirmede hata', 0]);
            Alert::error('Durum Değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.video.list');
    }

    public function commentList($id)
    {
        $data = VideoComment::where('is_post',1)->where('post_id', $id)->get();
        return view('backend.video.comments.list', compact('data'));
    }

    public function changeCommentStatus($id)
    {
        $data = VideoComment::findOrFail($id);
        $data->update([
            'status' => !$data->status,
        ]);
        Alert::success('Yorum Statüsü Değiştixrildi');
        return redirect()->back();
    }

    public function commentDestroy($id)
    {
        $data = VideoComment::findOrFail($id);
        VideoComment::where('is_post',0)->where('post_id',$id)->delete();
        $data->delete();
        Alert::success('Yorum Silindi');
        return redirect()->back();
    }

    public function comment_commentList($id)
    {
        $data = VideoComment::where('is_post',0)->where('post_id', $id)->get();
        return view('backend.video.comments.comments.list', compact('data'));
    }

    public function uploadContentImage(Request $request)
    {
        if ($request->file('file') != null) {
            $image = $request->file('file');
            $image_name = hexdec(uniqid()) . '.'. $image->getClientOriginalExtension();
            $save_url = public_path('assets/uploads/video').'/'. $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
                
            $save_url = asset('assets/uploads/video').'/'. $image_name;
            return response()->json(['location' => $save_url]);
        }
    }
}
