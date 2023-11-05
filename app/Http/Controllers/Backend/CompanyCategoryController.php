<?php

namespace App\Http\Controllers\Backend;

use App\Exports\CompanyCategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\CompanyCategoryImport;
use App\Models\CompanyCategory;
use App\Models\EnCompanyCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CompanyCategory::latest()->get();
        return view('backend.companyCategory.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (CompanyCategory::latest()->first() == null) {
            $no = 1;
        } else {
            $no = CompanyCategory::orderBy('queue', 'desc')->first();
            $no = $no->queue + 1;
        }
        return view('backend.companyCategory.add', compact('no'));
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
                'image' => 'required',
                'title_en' => 'required',
                'link_en' => 'required',
                'seo_title_en' => 'required',
                'seo_descriptipn_en' => 'required',
                'seo_key_en' => 'required',
            ],
            [
                'queue.required' => 'Sıralama boş bırakılamaz',
                'title_tr.required' => 'Başlık (TÜRKÇE) boş bırakılamaz',
                'link_tr.required' => 'Link (TÜRKÇE) boş bırakılamaz',
                'seo_title_tr.required' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz',
                'seo_description_tr.required' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz',
                'seo_key_tr.required' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz',
                'image.required' => 'Resim boş bırakılamaz',
                'title_en.required' => 'Başlık (İNGİLİZCE) boş bırakılamaz',
                'link_en.required' => 'Link (İNGİLİZCE) boş bırakılamaz',
                'seo_title_en.required' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz',
                'seo_descriptipn_en.required' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz',
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
            $merge = implode(',', $merge);


            $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }
            $merge = implode(',', $merge_en);


            $category = new CompanyCategory();
            $category->queue = $request->queue;
            $category->name = $request->title_tr;
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
                $save_url = 'assets/uploads/companyCategory/' . $image_name;
                Image::make($image)
                    ->resize(311, 75)
                    ->save($save_url);
                $category->image = $save_url;
            }
            $category->save();

            $category_en = new EnCompanyCategory();
            $category_en->queue = $request->queue;
            $category_en->name = $request->title_en;
            $category_en->link = $request->link_en;
            $category_en->category_id = $category->id;
            $category_en->seo_title = $request->seo_title_en;
            $category_en->seo_description = $request->seo_descriptipn_en;
            $category_en->seo_key = $merge_en;
            if (!isset($request->status_en)) {
                $category_en->status = 0;
            }
            $category_en->save();

            logKayit(['Firma Kategori', 'Firma kategorisi eklendi']);
            Alert::success('Firma Kategorisi Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Firma Kategori', 'Kategori eklemede hata', 0]);
            Alert::error('Kategori Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.companyCategory.list');
    }

    public function edit($id)
    {
        $data_tr = CompanyCategory::findOrFail($id);
        $data_en = EnCompanyCategory::where('category_id', $id)->first();
        return view('backend.companyCategory.edit', compact('data_tr', 'data_en'));
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
                'queue.required' => 'Sıralama boş bırakılamaz',
                'title_tr.required' => 'Başlık (TÜRKÇE) boş bırakılamaz',
                'link_tr.required' => 'Link (TÜRKÇE) boş bırakılamaz',
                'seo_title_tr.required' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz',
                'seo_description_tr.required' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz',
                'seo_key_tr.required' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz',
                'title_en.required' => 'Başlık (İNGİLİZCE) boş bırakılamaz',
                'link_en.required' => 'Link (İNGİLİZCE) boş bırakılamaz',
                'seo_title_en.required' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz',
                'seo_descriptipn_en.required' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz',
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

            $category = CompanyCategory::findOrFail($id);
            $category->queue = $request->queue;
            $category->name = $request->title_tr;
            $category->link = $request->link_tr;
            $category->seo_title = $request->seo_title_tr;
            $category->seo_description = $request->seo_description_tr;
            $category->seo_key = $merge;
            if (!isset($request->status_tr)) {
                $category->status = 0;
            } else {
                $category->status = 1;
            }
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/companyCategory/' . $image_name;
                Image::make($image)
                    ->resize(311, 75)
                    ->save($save_url);
                $category->image = $save_url;
            }
            $category->save();

            $category_en = EnCompanyCategory::where('category_id', $id)->first();
            $category_en->queue = $request->queue;
            $category_en->name = $request->title_en;
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

            logKayit(['Firma Kategori', 'Firma kategorisi düzenlendi']);
            Alert::success('Firma Kategorisi Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Firma Kategori', 'Kategori düzenlemede hata', 0]);
            Alert::error('Kategori Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.companyCategory.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = CompanyCategory::findOrFail($id);
            $data->status = !$data->status;
            $data->save();

            logKayit(['Firma Kategori', 'Firma kategorisi düzenlendi']);
            Alert::success('Firma Statüsü Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Firma Kategori ', 'Firma kategori durumu değiştirilemedi', 0]);
            Alert::error('Haber durum değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.companyCategory.list');
    }

    public function ice_aktar(Request $request)
    {
        Excel::import(new CompanyCategoryImport(), $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }

    public function disa_aktar(){
        return Excel::download(new CompanyCategoryExport, 'companyCategory.xlsx');
    }
}
