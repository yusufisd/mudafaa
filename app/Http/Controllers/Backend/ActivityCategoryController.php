<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityCategory;
use App\Models\EnActivityCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;

class ActivityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ActivityCategory::orderBy('queue', 'asc')->get();
        return view('backend.activityCategory.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (ActivityCategory::latest()->first() == null) {
            $no = 1;
        } else {
            $no = ActivityCategory::orderBy('queue', 'desc')->first();
            $no = $no->queue + 1;
        }
        return view('backend.activityCategory.add', compact('no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'queue' => 'required',
                'title_tr' => 'required',
                'link_tr' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',

                'title_en' => 'required',
                'link_en' => 'required',
                'seo_title_en' => 'required',
                'seo_descriptipn_en' => 'required',
                'seo_key_en' => 'required',
            ]);
            $category = new ActivityCategory();
            $category->queue = $request->queue;
            $category->title = $request->title_tr;
            $category->link = $request->link_tr;
            $category->color_code = $request->color_code;
            $category->seo_title = $request->seo_title_tr;
            $category->seo_description = $request->seo_description_tr;
            $category->seo_key = $request->seo_key_tr;
            if (!isset($request->status_tr)) {
                $category->status = 0;
            }
            if (!isset($request->seo_statu_tr)) {
                $category->seo_statu = 0;
            } else {
                $category->seo_statu = 1;
            }

            $category->save();

            $category_en = new EnActivityCategory();
            $category_en->title = $request->title_en;
            $category_en->link = $request->link_en;
            $category_en->activity_id = $category->id;
            $category_en->seo_title = $request->seo_title_en;
            $category_en->seo_description = $request->seo_descriptipn_en;
            $category_en->seo_key = $request->seo_key_en;
            if (!isset($request->status_en)) {
                $category_en->status = 0;
            }
            if (!isset($request->seo_statu_en)) {
                $category_en->seo_statu = 0;
            } else {
                $category_en->seo_statu = 1;
            }
            $category_en->save();

            logKayit(['Etkinlik Kategori', 'Etkinlik kategorisi eklendi']);
            Alert::success('Etkinlik Kategorisi Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            logKayit(['Etkinlik Kategori', 'Kategori eklemede hata', 0]);
            Alert::error('Kategori Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.activityCategory.list');
    }

    public function edit($id)
    {
        $data_tr = ActivityCategory::findOrFail($id);
        $data_en = EnActivityCategory::where('activity_id', $id)->first();
        return view('backend.activityCategory.edit', compact('data_tr', 'data_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'queue' => 'required',
                'title_tr' => 'required',
                'link_tr' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',

                'title_en' => 'required',
                'link_en' => 'required',
                'seo_title_en' => 'required',
                'seo_descriptipn_en' => 'required',
                'seo_key_en' => 'required',
            ]);
            $category = ActivityCategory::findOrFail($id);

            if ($request->queue > $category->queue) {
                for ($i = $category->queue; $i <= $request->queue; $i++) {
                    $data = ActivityCategory::where('queue', $i)->first();
                    $data->queue = $data->queue - 1;
                    $data->save();
                }
                $category->queue = $request->queue;
            }
            if ($request->queue < $category->queue) {
                for ($i = $category->queue; $i >= $request->queue; $i--) {
                    $data = ActivityCategory::where('queue', $i)->first();
                    $data->queue = $data->queue + 1;
                    $data->save();
                }
                $category->queue = $request->queue;
            }

            $category->queue = $request->queue;
            $category->title = $request->title_tr;
            $category->link = $request->link_tr;
            $category->seo_title = $request->seo_title_tr;
            $category->seo_description = $request->seo_description_tr;
            $category->seo_key = $request->seo_key_tr;
            if (!isset($request->status_tr)) {
                $category->status = 0;
            }
            if (!isset($request->seo_statu_tr)) {
                $category->seo_statu = 0;
            }
            $category->save();

            $category_en = EnActivityCategory::where('category_id', $id)->first();
            $category_en->title = $request->title_en;
            $category_en->link = $request->link_en;
            $category_en->category_id = $category->id;
            $category_en->seo_title = $request->seo_title_en;
            $category_en->seo_description = $request->seo_descriptipn_en;
            $category_en->seo_key = $request->seo_key_en;
            if (!isset($request->status_en)) {
                $category_en->status = 0;
            }
            if (!isset($request->seo_statu_en)) {
                $category_en->seo_statu = 0;
            }
            $category_en->save();

            logKayit(['Etkinlik Kategori', 'Haber kategorisi düzenlendi']);
            Alert::success('Güncel Haber Kategorisi Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            logKayit(['Etkinlik Kategori', 'Kategori düzenlemede hata', 0]);
            Alert::error('Kategori Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.activityCategory.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = ActivityCategory::findOrFail($id);
            $son_id = ActivityCategory::orderBy('queue', 'desc')->first()->queue;
            for ($i = $data->queue + 1; $i <= $son_id; $i++) {
                $item = ActivityCategory::where('queue', $i)->first();
                $item->queue = $item->queue - 1;
                $item->save();
            }
            EnActivityCategory::where('category_id', $id)->delete();
            $data->delete();

            logKayit(['Etkinlik Kategori', 'Haber kategorisi silindi']);
            Alert::success('Güncel Haber Kategorisi Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Etkinlik Kategori', 'Kategori silmede hata', 0]);
            Alert::error('Kategori Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.activityCategory.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = ActivityCategory::findOrFail($id);
            $data_en = EnActivityCategory::where('category_id', $id)->first();
            $data_en->status = !$data->status;
            $data_en->save();
            $data->status = !$data->status;
            $data->save();
            logKayit(['Etkinlik Kategori', 'Haber kategori durumu değiştirildi']);
            Alert::success('Durum Başarıyla Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Etkinlik Kategori', 'Kategori durumu değiştirmede hata', 0]);
            Alert::error('Durum Değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.activityCategory.list');
    }
}
