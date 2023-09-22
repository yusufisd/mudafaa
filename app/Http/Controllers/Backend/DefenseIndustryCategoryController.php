<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DefenseIndustry;
use App\Models\DefenseIndustryCategory;
use App\Models\EnDefenseIndustryCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;

class DefenseIndustryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DefenseIndustryCategory::latest()->get();
        return view('backend.defenseIndustryCategory.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (DefenseIndustryCategory::latest()->first() == null) {
            $no = 1;
        } else {
            $no = DefenseIndustryCategory::orderBy('queue', 'desc')->first();
            $no = $no->queue + 1;
        }
        $cats = DefenseIndustry::latest()->get();
        return view('backend.defenseIndustryCategory.add', compact('cats', 'no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();



            $news = new DefenseIndustryCategory();

            $news->defense_id = $request->category;
            $news->title = $request->title_tr;
            $news->link = $request->link_tr;
            $news->queue = $request->queue;
            $news->seo_title = $request->seo_title_tr;
            $news->seo_description = $request->seo_description_tr;
            $news->seo_key = $request->seo_key_tr;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/defenseIndustryCategory/' . $image_name;
                Image::make($image)->resize(696, 491)->save($save_url);
                $news->image = $save_url;
            }
            if (!isset($request->status_tr)) {
                $news->status = 0;
            }
            if (!isset($request->seo_statu_tr)) {
                $news->seo_statu = 0;
            }
            $news->save();


            $news_en = new EnDefenseIndustryCategory();
            $news_en->title = $request->title_en;
            $news_en->link = $request->link_en;
            $news_en->category_tr = $news->id;
            $news_en->seo_title = $request->seo_title_en;
            $news_en->seo_description = $request->seo_descriptipn_en;
            $news_en->seo_key = $request->seo_key_en;
            if (!isset($request->status_tr)) {
                $news_en->status = 0;
            }
            if (!isset($request->seo_statu_en)) {
                $news_en->seo_statu = 0;
            }
            logKayit(['Savunma Sanayi Alt Kategori ', 'Alt Kategori Eklendi']);
            Alert::success('Alt Kategori Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Alt Kategori ', 'Alt Kategori Eklemede Hata', 0]);
            Alert::error('Alt Kategori Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.defenseIndustryCategory.list');
    }


    public function edit($id)
    {
        $cate = DefenseIndustry::latest()->get();
        $data_tr = DefenseIndustryCategory::findOrFail($id);
        $data_en = EnDefenseIndustryCategory::where('category_tr', $id)->first();
        return view('backend.defenseIndustryCategory.edit', compact('data_tr', 'data_en', 'cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'activity_seo_keywords_tr' => 'required',
            ]);

            $news = DefenseIndustryCategory::findOrFail($id);
            $news->defense_id = $request->test;
            $news->title = $request->test;
            $news->link = $request->test;
            $news->queue = $request->test;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/defenseIndustryCategory/' . $image_name;
                Image::make($image)->resize(696, 491)->save($save_url);
                $news->image = $save_url;
            }
            $news->save();

            $news_en = EnDefenseIndustryCategory::where('category_tr', $id)->first();
            $news_en->defense_id = $request->test;
            $news_en->$request->test;
            $news_en->title = $request->test;
            $news_en->link = $request->test;
            $news_en->queue = $request->test;
            logKayit(['Savunma Sanayi Alt Kategori ', 'Alt Kategori Eklendi']);
            Alert::success('Alt Kategori Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Alt Kategori ', 'Alt Kategori Eklemede Hata', 0]);
            Alert::error('Alt Kategori Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.defenseIndustryCategory.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = DefenseIndustryCategory::findOrFail($id);
            EnDefenseIndustryCategory::where('currentNews_id', $id)->delete();
            $data->delete();

            logKayit(['Savunma Sanayi Alt Kategori ', 'Haber silindi']);
            Alert::success('Haber Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Alt Kategori ', 'Haber silmede hata', 0]);
            Alert::error('Haber Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.'
            ]);
        }
        return redirect()->route('admin.defenseIndustryCategory.list');
    }
}
