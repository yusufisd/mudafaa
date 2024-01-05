<?php

namespace App\Http\Controllers\Backend;

use App\Exports\DefenseIndustryContentExport;
use App\Http\Controllers\Controller;
use App\Imports\DefenseIndustryContentImport;
use App\Models\Company;
use App\Models\Country;
use App\Models\CountryList;
use App\Models\DefenseIndustry;
use App\Models\DefenseIndustryCategory;
use App\Models\DefenseIndustryContent;
use App\Models\EnDefenseIndustryContent;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class DefenseIndustryContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DefenseIndustryContent::latest()->get();
        return view('backend.defenseIndustryContent.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = UserModel::latest()->get();
        $categories = DefenseIndustryCategory::latest()->get();
        $countries = CountryList::orderBy('name', 'asc')->get();
        $companies = Company::orderBy('title', 'asc')->get();
        $no = 1;
        return view('backend.defenseIndustryContent.add', compact('users', 'categories', 'companies', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'category' => 'required',
                'name_tr' => 'required',
                'short_description_tr' => 'required',
                'description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'author' => 'required',
                'short_description_en' => 'required',
                'description_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
                'image' => 'required',
            ],
            [
                'category.required' => 'Kategori boş bırakılamaz',
                'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
                'short_description_tr.required' => 'Kısa açıklama (TR) boş bırakılamaz',
                'description_tr.required' => 'İçerik (TR) boş bırakılamaz',
                'link_tr.required' => 'Link (TR) boş bırakılamaz',
                'name_en.required' => 'Başlık (EN) boş bırakılamaz',
                'author.required' => 'Yazar (EN) boş bırakılamaz',
                'short_description_en.required' => 'Kısa açıklama (EN) boş bırakılamaz',
                'description_en.required' => 'Açıklama (EN) boş bırakılamaz',
                'link_en.required' => 'Link (EN) boş bırakılamaz',
                'seo_title_tr.required' => 'Seo başlık (TR) boş bırakılamaz',
                'seo_description_tr.required' => 'Seo açıklama (TR) boş bırakılamaz',
                'seo_key_tr.required' => 'Seo anahtar (TR) boş bırakılamaz',
                'seo_title_en.required' => 'Seo başlık (EN) boş bırakılamaz',
                'seo_description_en.required' => 'Seo açıklama (EN) boş bırakılamaz',
                'seo_key_en.required' => 'Seo anahtar (EN) boş bırakılamaz',
                'image.required' => 'Görsel boş bırakılamaz',
            ],
        );
        $genel_id = DefenseIndustryCategory::where('id', $request->category)->first();
        $new = new DefenseIndustryContent();

        $read_time_tr = (int) round(str_word_count($request->description_tr) / 200);
        $read_time_en = (int) round(str_word_count($request->description_en) / 200);

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

        $new->category_id = $request->category;
        $new->defense_id = $genel_id->defense_id;
        $new->title = $request->name_tr;
        $new->short_description = $request->short_description_tr;
        $new->description = $request->description_tr;
        $new->read_time = $read_time_tr;
        $new->seo_title = $request->seo_title_tr;
        $new->link = $request->link_tr;
        $new->countries = $request->countries;
        $new->companies = $request->company;
        $new->origin = $request->origin;
        $new->author = $request->author;
        $new->seo_description = $request->seo_description_tr;
        $new->seo_key = $merge;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/defenceIndustryContent/' . $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
            $new->image = $save_url;
        }
        if ($request->file('multiple_image') != null) {
            $datas = [];
            foreach ($request->file('multiple_image') as $key) {
                $image = $key;
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/defenceIndustryContent/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                array_push($datas, $save_url);
            }
            $new->multiple_image = $datas;
        }
        if (!isset($request->status_tr)) {
            $new->status = 0;
        }

        if (!isset($request->national)) {
            $new->national = 0;
        }
        $new->save();

        $new_en = new EnDefenseIndustryContent();
        $new_en->defense_id = $genel_id->defense_id;
        $new_en->category_id = $request->category;
        $new_en->title = $request->name_en;
        $new_en->read_time = $read_time_en;
        $new_en->countries = $request->countries;
        $new_en->companies = $request->company;
        $new_en->origin = $request->origin;
        $new_en->author = $request->author;
        $new_en->short_description = $request->short_description_en;
        $new_en->description = $request->description_en;
        $new_en->content_id = $new->id;
        $new_en->link = $request->link_en;
        $new_en->seo_title = $request->seo_title_en;
        $new_en->seo_description = $request->seo_description_en;
        $new_en->seo_key = $merge_en;
        if ($request->file('image') != null) {
            $new_en->image = $save_url;
        }
        if ($request->file('multiple_image') != null) {
            $datas = [];
            foreach ($request->file('multiple_image') as $key) {
                $image = $key;
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/defenceIndustryContent/' . $image_name;
                array_push($datas, $save_url);
            }
            $new_en->multiple_image = $datas;
        }
        if (!isset($request->status_en)) {
            $new->status = 0;
        }

        $new_en->save();
        logKayit(['Savunma Sanayi ', 'Savunma sanayi içeriği eklendi']);
        Alert::success('İçerik Başarıyla Eklendi');
        DB::commit();

        return redirect()->route('admin.defenseIndustryContent.list');
    }

    public function edit($id)
    {
        $data_tr = DefenseIndustryContent::findOrFail($id);
        $data_en = EnDefenseIndustryContent::where('content_id', $id)->first();
        $users = UserModel::latest()->get();
        $categories = DefenseIndustryCategory::latest()->get();
        $countries = CountryList::orderBy('name', 'asc')->get();
        $companies = Company::orderBy('title', 'asc')->get();
        return view('backend.defenseIndustryContent.edit', compact('data_tr', 'data_en', 'users', 'categories', 'companies', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'category' => 'required',
                'name_tr' => 'required',
                'short_description_tr' => 'required',
                'description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'short_description_en' => 'required',
                'description_en' => 'required',
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
                'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
                'short_description_tr.required' => 'Kısa açıklama (TR) boş bırakılamaz',
                'description_tr.required' => 'İçerik (TR) boş bırakılamaz',
                'link_tr.required' => 'Link (TR) boş bırakılamaz',
                'name_en.required' => 'Başlık (EN) boş bırakılamaz',
                'short_description_en.required' => 'Kısa açıklama (EN) boş bırakılamaz',
                'description_en.required' => 'Açıklama (EN) boş bırakılamaz',
                'link_en.required' => 'Link (EN) boş bırakılamaz',
                'seo_title_tr.required' => 'Seo başlık (TR) boş bırakılamaz',
                'seo_description_tr.required' => 'Seo açıklama (TR) boş bırakılamaz',
                'seo_key_tr.required' => 'Seo anahtar (TR) boş bırakılamaz',
                'seo_title_en.required' => 'Seo başlık (EN) boş bırakılamaz',
                'seo_description_en.required' => 'Seo açıklama (EN) boş bırakılamaz',
                'seo_key_en.required' => 'Seo anahtar (EN) boş bırakılamaz',
            ],
        );
        $read_time_tr = (int) round(str_word_count($request->description_tr) / 200);
        $read_time_en = (int) round(str_word_count($request->description_en) / 200);

        $genel_id = DefenseIndustryCategory::where('id', $request->category)->first();

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

        $new = DefenseIndustryContent::findOrFail($id);
        $new->category_id = $request->category;
        $new->defense_id = $genel_id->defense_id;
        $new->title = $request->name_tr;
        $new->short_description = $request->short_description_tr;
        $new->description = $request->description_tr;
        $new->read_time = $read_time_tr;
        $new->seo_title = $request->seo_title_tr;
        $new->countries = $request->countries;
        $new->companies = $request->company;
        $new->link = $request->link_tr;
        $new->origin = $request->origin;
        $new->author = $request->author;
        $new->seo_description = $request->seo_description_tr;
        $new->seo_key = $merge;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/defenceIndustryContent/' . $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
            $new->image = $save_url;
        }
        if ($request->file('multiple_image') != null) {
            $datas = [];
            foreach ($request->file('multiple_image') as $key) {
                $image = $key;
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/defenceIndustryContent/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                array_push($datas, $save_url);
            }
            $new->multiple_image = $datas;
        }
        if (!isset($request->status_tr)) {
            $new->status = 0;
        } else {
            $new->status = 1;
        }

        if (!isset($request->national)) {
            $new->national = 0;
        } else {
            $new->national = 1;
        }
        $new->save();

        $new_en = EnDefenseIndustryContent::where('content_id', $id)->first();
        $new_en->defense_id = $genel_id->defense_id;
        $new_en->category_id = $request->category;
        $new_en->title = $request->name_en;
        $new_en->read_time = $read_time_en;
        $new_en->short_description = $request->short_description_en;
        $new_en->description = $request->description_en;
        $new_en->content_id = $new->id;
        $new_en->seo_title = $request->seo_title_en;
        $new_en->seo_description = $request->seo_description_en;
        $new_en->seo_key = $merge_en;
        if ($request->file('image') != null) {
            $new_en->image = $save_url;
        }
        if ($request->file('multiple_image') != null) {
            $datas = [];
            foreach ($request->file('multiple_image') as $key) {
                $image = $key;
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/defenceIndustryContent/' . $image_name;
                array_push($datas, $save_url);
            }
            $new_en->multiple_image = $datas;
        }
        if (!isset($request->status_en)) {
            $new->status = 0;
        }

        $new_en->save();
        logKayit(['Savunma Sanayi ', 'Savunma sanayi içeriği düzenlendi']);
        Alert::success('İçerik Başarıyla Düzenlendi');
        DB::commit();
        return redirect()->route('admin.defenseIndustryContent.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = DefenseIndustryContent::findOrFail($id);
            EnDefenseIndustryContent::where('content_id', $id)->delete();
            $data->delete();

            logKayit(['Savunma Sanayi ', 'İçerik silindi']);
            Alert::success('İçerik Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi ', 'İçerik silmede hata', 0]);
            Alert::error('İçerik Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.defenseIndustryContent.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = DefenseIndustryContent::findOrFail($id);
            $data->status = !$data->status;
            $data->save();
            logKayit(['Savunma Sanayi', 'İçerik durumu değiştirildi']);
            Alert::success('Durum Başarıyla Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi', 'İçerik durumu değiştirmede hata', 0]);
            Alert::error('Durum Değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.defenseIndustryContent.list');
    }

    public function multipleImage($id)
    {
        $data2 = DefenseIndustryContent::findOrFail($id);
        $data = $data2->multiple_image;

        return view('backend.defenseIndustryContent.multipleImage.multiple_image', compact('data', 'id'));
    }

    public function multipleImage_add($id)
    {
        return view('backend.defenseIndustryContent.multipleImage.add', compact('id'));
    }

    public function multipleImage_store(Request $request)
    {
        $data = DefenseIndustryContent::findOrFail($request->id);

        if($request->previousData == null){
            $request->previousData = [];
        }
        $old_data = [];
        
        foreach($request->previousData as $item){
            $control = in_array($item,$data->multiple_image);
            if($control){
                array_push($old_data,$item);
            }
        }

        if ($request->file('image') != null) {
            foreach($request->file('image') as $image){
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/defenceIndustryContent/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
            array_push($old_data, $save_url);
            }
        }
        
        $data->multiple_image = $old_data;
        $data->save();
        Alert::success('Görsel Başarıyla Eklendi');
        return redirect()->route('admin.defenseIndustryContent.list');
    }



    public function ice_aktar(Request $request)
    {
        Excel::import(new DefenseIndustryContentImport(), $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }

    public function disa_aktar()
    {
        return Excel::download(new DefenseIndustryContentExport(), 'defenseIndustryContent.xlsx');
    }
}
