<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\DictionaryImport;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\Dictionary;
use App\Models\EnCurrentNews;
use App\Models\EnDictionary;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class DictionaryController extends Controller
{
    public function index()
    {
        $data = Dictionary::latest()->get();
        return view('backend.dictionary.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        $categories = CurrentNewsCategory::latest()->get();
        $users = UserModel::latest()->get();
        return view('backend.dictionary.add', compact('now', 'categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'author' => 'required',
                'live_date' => 'required',
                'name_tr' => 'required',
                'short_description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'short_description_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
            ],
            [
                'author.required' => 'author',
                'live_date.required' => 'live_date',
                'name_tr.required' => 'name_tr',
                'short_description_tr.required' => 'short_description_tr',
                'link_tr.required' => 'link_tr',
                'name_en.required' => 'name_en',
                'short_description_en.required' => 'short_description_en',
                'link_en.required' => 'link_en',
                'seo_title_tr.required' => 'seo_title_tr',
                'seo_description_tr.required' => 'seo_description_tr',
                'seo_key_tr.required' => 'seo_key_tr',
                'seo_title_en.required' => 'seo_title_en',
                'seo_description_en.required' => 'seo_description_en',
                'seo_key_en.required' => 'seo_key_en',
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
            $new = new Dictionary();

            $new->author = $request->author;
            $new->live_date = $request->live_date;
            $new->title = $request->name_tr;
            $new->description = $request->short_description_tr;
            $new->link = $request->link_tr;
            $new->seo_title = $request->seo_title_tr;
            $new->seo_description = $request->seo_description_tr;
            $new->seo_key = $merge;
            if (!isset($request->status_tr)) {
                $new->status = 0;
            }
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/dictionary/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new->image = $save_url;
            }
            $new->save();

            $new_en = new EnDictionary();
            $new_en->dictionary_id = $new->id;
            $new_en->author = $request->author;
            $new_en->live_date = $request->live_date;
            $new_en->title = $request->name_en;
            $new_en->description = $request->short_description_en;
            $new_en->link = $request->link_en;
            $new_en->seo_title = $request->seo_title_en;
            $new_en->seo_description = $request->seo_description_en;
            $new_en->seo_key = $merge_en;
            if (!isset($request->status_en)) {
                $new_en->status = 0;
            }
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/dictionary/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new_en->image = $save_url;
            }
            $new_en->save();

            logKayit(['Sözlük Yönetimi ', 'Sözlük başarıyla eklendi']);
            Alert::success('Sözlük Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Sözlük Yönetimi ', 'Sözlük eklemede hata', 0]);
            Alert::error('Sözlük Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.dictionary.list');
    }

    public function edit($id)
    {
        $users = UserModel::latest()->get();
        $data_tr = Dictionary::findOrFail($id);
        $data_en = EnDictionary::where('dictionary_id', $id)->first();
        return view('backend.dictionary.edit', compact('data_tr', 'data_en',  'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'author' => 'required',
                'live_date' => 'required',
                'name_tr' => 'required',
                'short_description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'short_description_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
            ],
            [
                'author.required' => 'author',
                'live_date.required' => 'live_date',
                'name_tr.required' => 'name_tr',
                'short_description_tr.required' => 'short_description_tr',
                'link_tr.required' => 'link_tr',
                'name_en.required' => 'name_en',
                'short_description_en.required' => 'short_description_en',
                'link_en.required' => 'link_en',
                'seo_title_tr.required' => 'seo_title_tr',
                'seo_description_tr.required' => 'seo_description_tr',
                'seo_key_tr.required' => 'seo_key_tr',
                'seo_title_en.required' => 'seo_title_en',
                'seo_description_en.required' => 'seo_description_en',
                'seo_key_en.required' => 'seo_key_en',
            ],
        );
  

            $new = Dictionary::findOrFail($id);

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

            $new->author = $request->author;
            $new->live_date = $request->live_date;
            $new->title = $request->name_tr;
            $new->description = $request->short_description_tr;
            $new->link = $request->link_tr;
            $new->seo_title = $request->seo_title_tr;
            $new->seo_description = $request->seo_description_tr;
            $new->seo_key = $merge;
            if (!isset($request->status_tr)) {
                $new->status = 0;
            }
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/dictionary/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new->image = $save_url;
            }
            $new->save();

            

            $new_en = EnDictionary::where('dictionary_id', $id)->first();
            $new_en->dictionary_id = $new->id;
            $new_en->author = $request->author;
            $new_en->live_date = $request->live_date;
            $new_en->title = $request->name_en;
            $new_en->description = $request->short_description_en;
            $new_en->link = $request->link_en;
            $new_en->seo_title = $request->seo_title_en;
            $new_en->seo_description = $request->seo_description_en;
            $new_en->seo_key = $merge_en;
            if (!isset($request->status_en)) {
                $new_en->status = 0;
            }
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/dictionary/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new_en->image = $save_url;
            }
            $new_en->save();

            logKayit(['Sözlük Yönetimi ', 'Sözlük başarıyla düzenlendi']);
            Alert::success('Sözlük Başarıyla Düzenlendi');
            DB::commit();
        
        return redirect()->route('admin.dictionary.list');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = CurrentNews::findOrFail($id);
            EnCurrentNews::where('currentNews_id', $id)->delete();
            $data->delete();

            logKayit(['Haber Yönetimi ', 'Haber silindi']);
            Alert::success('Haber Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Sözlük Yönetimi ', 'Sözlük silmede hata', 0]);
            Alert::error('Sözlük Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.dictionary.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = Dictionary::findOrFail($id);
            $data->status = !$data->status;
            $data->save();

            logKayit(['Sözlük Yönetimi ', 'Sözlük durumu değiştirildi']);
            Alert::success('Sözlük Durumu Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Sözlük Yönetimi ', 'Sözlük durumu değiştirilemedi', 0]);
            Alert::error('Sözlük durum değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.dictionary.list');
    }

    public function ice_aktar(Request $request)
    {
        Excel::import(new DictionaryImport(), $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }
}
