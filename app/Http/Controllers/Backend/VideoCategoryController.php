<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNews;
use App\Models\EnVideoCategory;
use App\Models\UserModel;
use App\Models\VideoCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;

class VideoCategoryController extends Controller
{
    public function index()
    {
        $data = VideoCategory::latest()->get();
        return view('backend.videoCategory.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (VideoCategory::latest()->first() == null) {
            $no = 1;
        } else {
            $no = VideoCategory::orderBy('queue', 'desc')->first();
            $no = $no->queue + 1;
        }
        $now = Carbon::now();
        $categories = CurrentNewsCategory::latest()->get();
        $users = UserModel::latest()->get();
        return view('backend.videoCategory.add', compact('now', 'categories', 'users', 'no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                "queue" => "required",
                "name_tr" => "required",
                "link_tr" => "required",
                "name_en" => "required",
                "link_en" => "required",
                "seo_title_tr" => "required",
                "seo_description_tr" => "required",
                "seo_key_tr" => "required",
                "seo_title_en" => "required",
                "seo_description_en" => "required",
                "seo_key_en" => "required",
            ]);
            							

            $new = new VideoCategory();
            $new->title = $request->name_tr;
            $new->link = $request->link_tr;
            $new->seo_title = $request->seo_title_tr;
            $new->seo_description = $request->seo_description_tr;
            $new->seo_key = $request->seo_key_tr;
            $new->queue = $request->queue;
            if (!isset($request->status_tr)) {
                $new->status = 0;
            }
            $new->save();


            $news_en = new EnVideoCategory();
            $news_en->title = $request->name_en;
            $news_en->link = $request->link_en;
            $news_en->category_id = $new->id;
            $news_en->seo_title = $request->seo_title_en;
            $news_en->seo_description = $request->seo_description_en;
            $news_en->seo_key = $request->seo_key_en;
            $news_en->save();
            if (!isset($request->status_en)) {
                $news_en->status = 0;
            }
            $news_en->save();

            logKayit(['Video Kategori Yönetimi ', 'Video kategori eklendi']);
            Alert::success('Video Kategori Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Video Kategori Yönetimi ', 'Video Kategori eklemede hata', 0]);
            Alert::error('Video Kategori Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.videoCategory.list');
    }

    public function edit($id)
    {
        $categories = CurrentNewsCategory::latest()->get();
        $users = UserModel::latest()->get();
        $data_tr = VideoCategory::findOrFail($id);
        $data_en = EnVideoCategory::where('category_id', $id)->first();
        return view('backend.videoCategory.edit', compact('data_tr', 'data_en', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name_tr' => 'required',
                'short_description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'short_description_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_statu_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
                'seo_statu_en' => 'required',
                'queue' => 'required',
            ]);

            $new = VideoCategory::findOrFail($id);
            $new->title = $request->name_tr;
            $new->description = $request->short_description_tr;
            $new->link = $request->link_tr;
            $new->seo_title = $request->seo_title_tr;
            $new->seo_description = $request->seo_description_tr;
            $new->seo_key = $request->seo_key_tr;
            $new->queue = $request->queue;
            if (!isset($request->seo_statu_tr)) {
                $new->seo_statu = 0;
            }
            $new->save();

            $news_en = EnVideoCategory::where('category_id',$id)->first();
            $news_en->title = $request->name_en;
            $news_en->description = $request->short_description_en;
            $news_en->link = $request->link_en;
            $news_en->category_id = $new->id;
            $news_en->seo_title = $request->seo_title_en;
            $news_en->seo_description = $request->seo_description_en;
            $news_en->seo_key = $request->seo_key_en;
            $news_en->save();
            if (!isset($request->seo_statu_en)) {
                $news_en->seo_statu = 0;
            }
            $news_en->save();

            logKayit(['Video Kategori Yönetimi ', 'Video kategori eklendi']);
            Alert::success('Video Kategori Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Video Kategori Yönetimi ', 'Video Kategori eklemede hata', 0]);
            Alert::error('Video Kategori Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.videoCategory.list');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = VideoCategory::findOrFail($id);
            EnVideoCategory::where('category_id', $id)->delete();
            $data->delete();

            logKayit(['Video Kategori Yönetimi ', 'Haber silindi']);
            Alert::success('Haber Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Video Kategori Yönetimi ', 'Haber silmede hata', 0]);
            Alert::error('Haber Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.videoCategory.list');
    }




}
