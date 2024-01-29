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
        $data = DefenseIndustryCategory::orderBy('queue', 'asc')->select('id','title','image','queue','defense_id','status')->get();
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
        $request->validate(
            [
                'queue' => 'required',
                'category' => 'required',
                'title_tr' => 'required',
                'link_tr' => 'required',
                'title_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_descriptipn_en' => 'required',
                'seo_key_en' => 'required',
                'image' => 'required',
            ],
            [
                'queue.required' => 'Sıralama boş bırakılamaz',
                'category.required' => 'Kateogori boş bırakılamaz',
                'title_tr.required' => 'Başlık boş bırakılamaz',
                'link_tr.required' => 'Link boş bırakılamaz',
                'title_en.required' => 'Başlık boş bırakılamaz',
                'link_en.required' => 'Link boş bırakılamaz',
                'seo_title_tr.required' => 'Seo başlığı boş bırakılamaz',
                'seo_description_tr.required' => 'Seo açıklaması boş bırakılamaz',
                'seo_key_tr.required' => 'Seo anahtarı boş bırakılamaz',
                'seo_title_en.required' => 'Seo başlığı boş bırakılamaz',
                'seo_descriptipn_en.required' => 'Seo açıklaması boş bırakılamaz',
                'seo_key_en.required' => 'Seo anahtarı boş bırakılamaz',
                'image.required' => 'Resim boş bırakılamaz',
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


        $news = new DefenseIndustryCategory();

        $news->defense_id = $request->category;
        $news->title = $request->title_tr;
        $news->link = $request->link_tr;
        $news->queue = $request->queue;
        $news->seo_title = $request->seo_title_tr;
        $news->seo_description = $request->seo_description_tr;
        $news->seo_key = $merge;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/defenseIndustryCategory/' . $image_name;
            Image::make($image)
                ->resize(696, 491)
                ->save($save_url);
            $news->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $news->status = 0;
        }
        $news->save();

        $news_en = new EnDefenseIndustryCategory();
        $news_en->defense_id = $news->id;
        $news_en->title = $request->title_en;
        $news_en->link = $request->link_en;
        $news_en->queue = $request->queue;
        $news_en->defense_category_id = $news->id;
        $news_en->seo_title = $request->seo_title_en;
        $news_en->seo_description = $request->seo_descriptipn_en;
        $news_en->seo_key = $merge_en;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/defenseIndustryCategory/' . $image_name;
            Image::make($image)
                ->resize(696, 491)
                ->save($save_url);
            $news_en->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $news_en->status = 0;
        }
        $news_en->save();

        logKayit(['Savunma Sanayi Alt Kategori ', 'Alt Kategori Eklendi']);
        Alert::success('Alt Kategori Başarıyla Eklendi');
        DB::commit();

        return redirect()->route('admin.defenseIndustryCategory.list');
    }

    public function edit($id)
    {
        $cats = DefenseIndustry::latest()->get();
        $data_tr = DefenseIndustryCategory::findOrFail($id);
        $data_en = EnDefenseIndustryCategory::where('defense_category_id', $id)->first();
        return view('backend.defenseIndustryCategory.edit', compact('data_tr', 'data_en', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'queue' => 'required',
                'category' => 'required',
                'title_tr' => 'required',
                'link_tr' => 'required',
                'title_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_descriptipn_en' => 'required',
                'seo_key_en' => 'required',
            ],
            [
                'queue.required' => 'Sıralama boş bırakılamaz',
                'category.required' => 'Kateogori boş bırakılamaz',
                'title_tr.required' => 'Başlık boş bırakılamaz',
                'link_tr.required' => 'Link boş bırakılamaz',
                'title_en.required' => 'Başlık boş bırakılamaz',
                'link_en.required' => 'Link boş bırakılamaz',
                'seo_title_tr.required' => 'Seo başlığı boş bırakılamaz',
                'seo_description_tr.required' => 'Seo açıklaması boş bırakılamaz',
                'seo_key_tr.required' => 'Seo anahtarı boş bırakılamaz',
                'seo_title_en.required' => 'Seo başlığı boş bırakılamaz',
                'seo_descriptipn_en.required' => 'Seo açıklaması boş bırakılamaz',
                'seo_key_en.required' => 'Seo anahtarı boş bırakılamaz',
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

        $news = DefenseIndustryCategory::findOrFail($id);

        if ($request->queue > $news->queue) {
            for ($i = $news->queue; $i <= $request->queue; $i++) {
                $data = DefenseIndustryCategory::where('queue', $i)->first();
                if ($data != null) {
                    $data->queue = $data->queue - 1;
                    $data->save();
                }
            }
            $news->queue = $request->queue;
        }
        if ($request->queue < $news->queue) {
            for ($i = $news->queue; $i >= $request->queue; $i--) {
                $data = DefenseIndustryCategory::where('queue', $i)->first();
                if ($data != null) {
                    $data->queue = $data->queue + 1;
                    $data->save();
                }
            }
            $news->queue = $request->queue;
        }

        $news->defense_id = $request->category;
        $news->title = $request->title_tr;
        $news->link = $request->link_tr;
        $news->queue = $request->queue;
        $news->seo_title = $request->seo_title_tr;
        $news->seo_description = $request->seo_description_tr;
        $news->seo_key = $merge;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/defenseIndustryCategory/' . $image_name;
            Image::make($image)
                ->resize(696, 491)
                ->save($save_url);
            $news->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $news->status = 0;
        } else {
            $news->status = 1;
        }
        $news->save();

        $news_en = EnDefenseIndustryCategory::where('defense_category_id', $id)->first();
        $news_en->defense_id = $request->category;
        $news_en->title = $request->title_en;
        $news_en->link = $request->link_en;
        $news_en->queue = $request->queue;
        $news_en->seo_title = $request->seo_title_en;
        $news_en->seo_description = $request->seo_descriptipn_en;
        $news_en->seo_key = $merge_en;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/defenseIndustryCategory/' . $image_name;
            Image::make($image)
                ->resize(696, 491)
                ->save($save_url);
            $news_en->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $news_en->status = 0;
        } else {
            $news_en->status = 1;
        }
        $news_en->save();

        logKayit(['Savunma Sanayi Alt Kategori ', 'Alt Kategori Düzenlendi']);
        Alert::success('Alt Kategori Düzenlendi');
        DB::commit();

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
            $son_id = DefenseIndustryCategory::orderBy('queue', 'desc')->first()->queue;
            for ($i = $data->queue + 1; $i <= $son_id; $i++) {
                $item = DefenseIndustryCategory::where('queue', $i)->first();
                $item->queue = $item->queue - 1;
                $item->save();
            }
            EnDefenseIndustryCategory::where('defense_category_id', $id)->delete();
            $data->delete();

            logKayit(['Savunma Sanayi Alt Kategori ', 'Kategori silindi']);
            Alert::success('Kategori Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Alt Kategori ', 'Kategori silmede hata', 0]);
            Alert::error('Kategori Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.defenseIndustryCategory.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = DefenseIndustryCategory::findOrFail($id);
            $data->status = !$data->status;
            $data->save();

            logKayit(['Savunma Sanayi Kategori Yönetimi ', 'Kategori durumu değiştirildi']);
            Alert::success(' Kategori Durumu Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Kategori Yönetimi ', 'Kategori durumu değiştirilemedi', 0]);
            Alert::error('Haber durum değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.defenseIndustryCategory.list');
    }
}
