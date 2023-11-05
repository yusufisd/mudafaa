<?php

namespace App\Http\Controllers\Backend;

use App\Exports\CurrentNewsCategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\CurrentNewsCategoryImport;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNewsCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class CurrentNewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CurrentNewsCategory::orderBy('queue', 'asc')->get();

        return view('backend.currentNewsCategory.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (CurrentNewsCategory::latest()->first() == null) {
            $no = 1;
        } else {
            $no = CurrentNewsCategory::orderBy('queue', 'desc')->first();
            $no = $no->queue + 1;
        }
        return view('backend.currentNewsCategory.add', compact('no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'queue' => 'required',
            'title_tr' => 'required',
            'link_tr' => 'required',
            'seo_title_tr' => 'required',
            'seo_description_tr' => 'required',
            'seo_key_tr' => 'required',
            'image' => 'required',

            'title_en' => 'required',
            'link_en' => 'required',
            'seo_title_en' => 'required',
            'seo_descriptipn_en' => 'required',
            'seo_key_en' => 'required',
        ]);

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

        try {
            DB::beginTransaction();

            CurrentNewsCategory::where('queue', '>=', $request->queue)->increment("queue");

            $category = new CurrentNewsCategory();
            $category->queue = $request->queue;
            $category->color_code = $request->color_code;
            $category->title = $request->title_tr;
            $category->link = $request->link_tr;
            $category->seo_title = $request->seo_title_tr;
            $category->seo_description = $request->seo_description_tr;
            $category->seo_key = $merge;
            if (!isset($request->status_tr)) {
                $category->status = 0;
            }

            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/currentNewsCategory/' . $image_name;
                Image::make($image)
                    ->resize(311, 75)
                    ->save($save_url);
                $category->image = $save_url;
            }
            $category->save();

            $category_en = new EnCurrentNewsCategory();
            $category_en->title = $request->title_en;
            $category_en->link = $request->link_en;
            $category_en->queue = $request->queue;
            $category_en->color_code = $request->color_code;
            $category_en->category_id = $category->id;
            $category_en->seo_title = $request->seo_title_en;
            $category_en->seo_description = $request->seo_descriptipn_en;
            $category_en->seo_key = $merge_en;
            if ($request->file('image') != null) {
                $category_en->image = $save_url;
            }
            if (!isset($request->status_en)) {
                $category_en->status = 0;
            }
            $category->queue = $request->queue;
            $category_en->save();


            logKayit(['Güncel Haber Kategori', 'Haber kategorisi eklendi']);
            Alert::success('Güncel Haber Kategorisi Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Güncel Haber Kategori', 'Kategori eklemede hata', 0]);
            Alert::error('Kategori Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.currentNewsCategory.list');
    }

    public function edit($id)
    {
        $data_tr = CurrentNewsCategory::findOrFail($id);
        $data_en = EnCurrentNewsCategory::where('category_id', $id)->first();
        return view('backend.currentNewsCategory.edit', compact('data_tr', 'data_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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

        $category = CurrentNewsCategory::findOrFail($id);

        if ($request->queue > $category->queue) {
            $last_queue = CurrentNewsCategory::orderBy('queue', 'desc')->first();
            if ($request->queue > $last_queue->queue) {
                Alert::error('İçerik sayısını aştınız');
                return back();
            }
            for ($i = $category->queue; $i <= $request->queue; $i++) {
                $data = CurrentNewsCategory::where('queue', $i)->first();
                $data->queue = $data->queue - 1;
                $data->save();
            }
            $category->queue = $request->queue;
        }
        if ($request->queue < $category->queue) {
            for ($i = $category->queue; $i >= $request->queue; $i--) {
                $data = CurrentNewsCategory::where('queue', $i)->first();
                $data->queue = $data->queue + 1;
                $data->save();
            }
            $category->queue = $request->queue;
        }

        $category->color_code = $request->color_code;
        $category->queue = $request->queue;
        $category->title = $request->title_tr;
        $category->link = $request->link_tr;
        $category->seo_title = $request->seo_title_tr;
        $category->seo_description = $request->seo_description_tr;
        $category->seo_key = $merge;
        if (!isset($request->status_tr)) {
            $category->status = 0;
        }

        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/currentNewsCategory/' . $image_name;
            Image::make($image)
                ->resize(311, 75)
                ->save($save_url);
            $category->image = $save_url;
        }
        $category->save();

        $category_en = EnCurrentNewsCategory::where('category_id', $id)->first();
        $category_en->title = $request->title_en;
        $category_en->link = $request->link_en;
        $category_en->category_id = $category->id;
        $category_en->color_code = $request->color_code;
        $category_en->seo_title = $request->seo_title_en;
        $category_en->seo_description = $request->seo_descriptipn_en;
        $category_en->seo_key = $merge_en;
        if (!isset($request->status_en)) {
            $category_en->status = 0;
        }

        $category_en->save();

        logKayit(['Güncel Haber Kategori', 'Haber kategorisi düzenlendi']);
        Alert::success('Güncel Haber Kategorisi Düzenlendi');
        DB::commit();

        return redirect()->route('admin.currentNewsCategory.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = CurrentNewsCategory::findOrFail($id);
            $son_id = CurrentNewsCategory::orderBy('queue', 'desc')->first()->queue;
            for ($i = $data->queue + 1; $i <= $son_id; $i++) {
                $item = CurrentNewsCategory::where('queue', $i)->first();
                $item->queue = $item->queue - 1;
                $item->save();
            }
            EnCurrentNewsCategory::where('category_id', $id)->delete();
            $data->delete();

            logKayit(['Güncel Haber Kategori', 'Haber kategorisi silindi']);
            Alert::success('Güncel Haber Kategorisi Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Güncel Haber Kategori', 'Kategori silmede hata', 0]);
            Alert::error('Kategori Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.currentNewsCategory.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = CurrentNewsCategory::findOrFail($id);
            $data_en = EnCurrentNewsCategory::where('category_id', $id)->first();
            $data_en->status = !$data->status;
            $data_en->save();
            $data->status = !$data->status;
            $data->save();
            logKayit(['Güncel Haber Kategori', 'Haber kategori durumu değiştirildi']);
            Alert::success('Durum Başarıyla Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Güncel Haber Kategori', 'Kategori durumu değiştirmede hata', 0]);
            Alert::error('Durum Değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.currentNewsCategory.list');
    }

    public function ice_aktar(Request $request)
    {
        Excel::import(new CurrentNewsCategoryImport(), $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }

    public function disa_aktar(){
        return Excel::download(new CurrentNewsCategoryExport, 'currentNewsCategory.xlsx');
    }
}
