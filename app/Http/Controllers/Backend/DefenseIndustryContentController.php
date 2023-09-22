<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
        $companies = Company::orderBy('name', 'asc')->get();
        $no = 1;
        return view('backend.defenseIndustryContent.add', compact('users', 'categories', 'companies', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $genel_id = DefenseIndustryCategory::where('id',$request->category)->first();
        $new = new DefenseIndustryContent();

        $new->category_id = $request->category;
        $new->defense_id = $genel_id->defense_id;
        $new->title = $request->name_tr;
        $new->short_description = $request->short_description_tr;
        $new->description = $request->description_tr;
        $new->seo_title = $request->seo_title_tr;
        $new->countries = $request->countries;
        $new->companies = $request->company;
        $new->link = $request->link_tr;
        $new->tags = $request->etiket_tr;
        $new->origin = $request->origin;
        $new->author = $request->author;
        $new->seo_description = $request->seo_description_tr;
        $new->seo_key = $request->seo_key_tr;
        $new->seo_statu = $request->seo_statu_tr;
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
                    ->resize(170, 170)
                    ->save($save_url);
                array_push($datas,$save_url);
            }
            $new->multiple_image = $datas;
        }
        if (!isset($request->status_tr)) {
            $new->status = 0;
        }
        if (!isset($request->seo_statu_tr)) {
            $new->seo_statu = 0;
        } else {
            $new->seo_statu = 1;
        }
        if (!isset($request->national)) {
            $new->national = 0;
        }
        $new->save();

        $new_en = new EnDefenseIndustryContent();
        $new_en->title = $request->name_en;
        $new_en->short_description = $request->short_description_en;
        $new_en->description = $request->description_en;
        $new_en->content_id = $new->id;
        $new_en->tags = $request->etiket_en;
        $new_en->link = $request->link_en;
        $new_en->seo_title = $request->seo_title_en;
        $new_en->seo_description = $request->seo_description_en;
        $new_en->seo_key = $request->seo_key_en;
        if (!isset($request->status_en)) {
            $new->status = 0;
        }
        if (!isset($request->seo_statu_en)) {
            $new->seo_statu = 0;
        } else {
            $new->seo_statu = 1;
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
        $countries = Country::orderBy('name', 'asc')->get();
        $companies = Company::orderBy('name', 'asc')->get();
        return view('backend.defenseIndustryContent.edit', compact('data_tr', 'data_en', 'users', 'categories', 'companies', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $genel_id = DefenseIndustryCategory::where('id',$request->category)->first();

            $new = DefenseIndustryContent::findOrFail($id);
            $new->defense_id = $genel_id->defense_id;
            $new->category = $request->category;
            $new->title = $request->name_tr;
            $new->short_description = $request->short_description_tr;
            $new->description = $request->description_tr;
            $new->seo_title = $request->seo_title_tr;
            $new->countries = $request->countries;
            $new->companies = $request->company;
            $new->tags = $request->etiket_tr;
            $new->origin = $request->origin;
            $new->author = $request->author;
            $new->seo_description = $request->seo_description_tr;
            $new->seo_key = $request->seo_key_tr;
            $new->seo_statu = $request->seo_statu_tr;
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
                        ->resize(170, 170)
                        ->save($save_url);
                    array_push($datas,$save_url);
                }
                $new->multiple_image = $datas;
            }
            if ($request->file('multiple_image') != null) {
                foreach ($request->file('multiple_image') as $key) {
                    dd($key);
                }
            }
            if (!isset($request->status_tr)) {
                $new->status = 0;
            }
            if (!isset($request->seo_statu_tr)) {
                $new->seo_statu = 0;
            } else {
                $new->seo_statu = 1;
            }
            if (!isset($request->national)) {
                $new->national = 0;
            }
            $new->save();

            $new_en = EnDefenseIndustryContent::where('content_id', $id)->first();
            $new_en->title = $request->name_en;
            $new_en->short_description = $request->short_description_en;
            $new_en->description = $request->description_en;
            $new_en->content_id = $new->id;
            $new_en->tags = $request->etiket_en;
            $new_en->seo_title = $request->seo_title_en;
            $new_en->seo_description = $request->seo_description_en;
            $new_en->seo_key = $request->seo_key_en;
            if (!isset($request->status_en)) {
                $new->status = 0;
            }
            if (!isset($request->seo_statu_en)) {
                $new->seo_statu = 0;
            } else {
                $new->seo_statu = 1;
            }
            $new_en->save();
            logKayit(['Savunma Sanayi ', 'Savunma sanayi içeriği düzenlendi']);
            Alert::success('İçerik Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi ', 'Savunma sanayi içeriği düzenlemede hata', 0]);
            Alert::error('Savunma Sanayi Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
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
}
