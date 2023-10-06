<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\VideoCategoryImport;
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
use Maatwebsite\Excel\Facades\Excel;

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
        $request->validate(
            [
                'queue' => 'required',
                'name_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
            ],
            [
                'queue.required' => 'Sıralama boş bırakılamaz',
                'name_tr.required' => 'Başlık (TÜRKÇE) boş bırakılamaz',
                'link_tr.required' => 'Link (TÜRKÇE) boş bırakılamaz',
                'name_en.required' => 'Başlık (İNGİLİZCE) boş bırakılamaz',
                'link_en.required' => 'Link (İNGİLİZCE) boş bırakılamaz',
                'seo_title_tr.required' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz',
                'seo_description_tr.required' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz',
                'seo_key_tr.required' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz',
                'seo_title_en.required' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz',
                'seo_description_en.required' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz',
                'seo_key_en.required' => 'Seo anahtarı (İNGİLİZCE) boş bırakılamaz',
            ],
        );
        try {
            DB::beginTransaction();

            $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
            $merge = [];
            foreach ($veri as $v) {
                $merge[] = $v->value;
            }

            $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }

            $new = new VideoCategory();
            $new->title = $request->name_tr;
            $new->link = $request->link_tr;
            $new->seo_title = $request->seo_title_tr;
            $new->seo_description = $request->seo_description_tr;
            $new->queue = $request->queue;
            $new->seo_key = $merge;
            if (!isset($request->status_tr)) {
                $new->status = 0;
            }
            $new->save();

            $news_en = new EnVideoCategory();
            $news_en->title = $request->name_en;
            $news_en->link = $request->link_en;
            $news_en->queue = $request->queue;
            $news_en->category_id = $new->id;
            $news_en->seo_title = $request->seo_title_en;
            $news_en->seo_description = $request->seo_description_en;
            $news_en->seo_key = $merge_en;
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
        $request->validate(
            [
                'queue' => 'required',
                'name_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
            ],
            [
                'queue.required' => 'Sıralama boş bırakılamaz',
                'name_tr.required' => 'Başlık (TÜRKÇE) boş bırakılamaz',
                'link_tr.required' => 'Link (TÜRKÇE) boş bırakılamaz',
                'name_en.required' => 'Başlık (İNGİLİZCE) boş bırakılamaz',
                'link_en.required' => 'Link (İNGİLİZCE) boş bırakılamaz',
                'seo_title_tr.required' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz',
                'seo_description_tr.required' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz',
                'seo_key_tr.required' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz',
                'seo_title_en.required' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz',
                'seo_description_en.required' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz',
                'seo_key_en.required' => 'Seo anahtarı (İNGİLİZCE) boş bırakılamaz',
            ],
        );

        try {
            DB::beginTransaction();

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

            $news_en = EnVideoCategory::where('category_id', $id)->first();
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

    public function ice_aktar(Request $request)
    {
        Excel::import(new VideoCategoryImport(), $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }
}
