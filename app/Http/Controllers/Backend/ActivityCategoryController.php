<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ActivityCategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\ActivityCategoryImport;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\EnActivity;
use App\Models\EnActivityCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

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
        $request->validate(
            [
                'queue' => 'required',
                'title_tr' => 'required',
                'link_tr' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'title_en' => 'required',
                'link_en' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
            ],
            [
                'queue' => 'Sıralama boş bırakılamaz.',
                'title_tr' => 'Başlık (TÜRKÇE) boş bırakılamaz.',
                'link_tr' => 'Link (TÜRKÇE) boş bırakılamaz.',
                'seo_title_tr' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz.',
                'seo_description_tr' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz.',
                'seo_key_tr' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz.',
                'title_en' => 'Başlık (İNGİLİZCE) boş bırakılamaz.',
                'link_en' => 'Link (İNGİLİZCE) boş bırakılamaz.',
                'seo_title_en' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz.',
                'seo_description_en' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz.',
                'seo_key_en' => 'Seo anahtarı (İNGİLİZCE) boş bırakılamaz.',
            ],
        );

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


            $category = new ActivityCategory();
            $category->queue = $request->queue;
            $category->title = $request->title_tr;
            $category->link = $request->link_tr;
            $category->color_code = $request->color_code;
            $category->seo_title = $request->seo_title_tr;
            $category->seo_description = $request->seo_description_tr;
            $category->seo_key = $merge;
            if (!isset($request->status_tr)) {
                $category->status = 0;
            }
            $category->save();

            $category_en = new EnActivityCategory();
            $category_en->title = $request->title_en;
            $category_en->link = $request->link_en;
            $category_en->color_code = $request->color_code;
            $category_en->queue = $request->queue;
            $category_en->activity_id = $category->id;
            $category_en->seo_title = $request->seo_title_en;
            $category_en->seo_description = $request->seo_description_en;
            $category_en->seo_key = $merge_en;
            if (!isset($request->status_en)) {
                $category_en->status = 0;
            }

            $category_en->save();

            logKayit(['Etkinlik Kategori', 'Etkinlik kategorisi eklendi']);
            Alert::success('Etkinlik Kategorisi Eklendi');
            DB::commit();
        
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
        $request->validate(
            [
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
            ],
            [
                'queue' => 'Sıralama boş bırakılamaz.',
                'title_tr' => 'Başlık (TÜRKÇE) boş bırakılamaz.',
                'link_tr' => 'Link (TÜRKÇE) boş bırakılamaz.',
                'seo_title_tr' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz.',
                'seo_description_tr' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz.',
                'seo_key_tr' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz.',
                'title_en' => 'Başlık (İNGİLİZCE) boş bırakılamaz.',
                'link_en' => 'Link (İNGİLİZCE) boş bırakılamaz.',
                'seo_title_en' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz.',
                'seo_descriptipn_en' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz.',
                'seo_key_en' => 'Seo anahtarı (İNGİLİZCE) boş bırakılamaz.',
            ],
        );
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
            $category->seo_key = $merge;
            if (!isset($request->status_tr)) {
                $category->status = 0;
            } else {
                $category->status = 1;
            }

            $category->save();

            $category_en = EnActivityCategory::where('activity_id', $id)->first();
            $category_en->title = $request->title_en;
            $category_en->link = $request->link_en;
            $category_en->seo_title = $request->seo_title_en;
            $category_en->seo_description = $request->seo_descriptipn_en;
            $category_en->seo_key = $merge_en;
            if (!isset($request->status_en)) {
                $category_en->status = 0;
            } else {
                $category_en->status = 1;
            }
            $category_en->save();

            logKayit(['Etkinlik Kategori', 'Etkinlik kategorisi düzenlendi']);
            Alert::success('Etkinlik Kategorisi Düzenlendi');
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
       

            $data = ActivityCategory::findOrFail($id);

            Activity::where('category',$data->id)->delete();

            $son_queue = ActivityCategory::orderBy('queue', 'desc')->first()->queue;
            for ($i = $data->queue + 1; $i <= $son_queue; $i++) {
                $item = ActivityCategory::where('queue', $i)->first();
                $item->queue = $item->queue - 1;
                $item->save();
            }



            $data_en = EnActivityCategory::where('activity_id', $id)->first();

            EnActivity::where('category',$data_en->id)->delete();

            $son_queue_en = EnActivityCategory::orderBy('queue','desc')->first()->queue;
            for($i = $data_en->queue+1; $i <= $son_queue_en; $i++){
                $item_en = EnActivityCategory::where('queue',$i)->first();
                $item_en->queue = $item_en->queue - 1;
                $item_en->save();
            }
            $data->delete();
            $data_en->delete();

            logKayit(['Etkinlik Kategori', 'Etkinlik kategorisi silindi']);
            Alert::success('Etkinlik Kategorisi Silindi');
            DB::commit();
        
        return redirect()->route('admin.activityCategory.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = ActivityCategory::findOrFail($id);
            $data_en = EnActivityCategory::where('activity_id', $id)->first();
            $data_en->status = !$data->status;
            $data_en->save();
            $data->status = !$data->status;
            $data->save();
            logKayit(['Etkinlik Kategori', 'Etkinlik kategori durumu değiştirildi']);
            Alert::success('Durum Başarıyla Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Etkinlik Kategori', 'Etkinlik kategori durumu değiştirmede hata', 0]);
            Alert::error('Durum Değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.activityCategory.list');
    }

    public function ice_aktar(Request $request)
    {
        Excel::import(new ActivityCategoryImport(), $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }

    public function disa_aktar(){
        return Excel::download(new ActivityCategoryExport, 'activityCategory.xlsx');
    }
}
