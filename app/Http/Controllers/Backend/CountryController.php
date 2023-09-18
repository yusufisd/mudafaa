<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryList;
use App\Models\EnCountry;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;

class CountryController extends Controller
{
    public function index()
    {
        $data = CountryList::orderBy('name', 'asc')->get();
        return view('backend.country.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('backend.country.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name_tr' => 'required',
                'name_en' => 'required',
                'image' => 'required',
            ]);
            $countr = new Country();
            $countr->name = $request->name_tr;

            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/country/' . $image_name;
                Image::make($image)->resize(300, 200)->save($save_url);
                $countr->image = $save_url;
            }
            $countr->save();

            $co_en = new EnCountry();
            $co_en->name = $request->name_en;
            $co_en->country_id = $countr->id;
            $co_en->save();
            


            logKayit(['Ülke Yönetimi ', 'Ülke eklendi']);
            Alert::success('Ülke Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Ülke Yönetimi ', 'Ülke eklemede hata', 0]);
            Alert::error('Ülke Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.country.list');
    }

    public function edit($id)
    {
        $data = Country::findOrFail($id);
        return view('backend.country.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
            ]);
            $countr =Country::findOrFail($id);
            $countr->name = $request->name;

            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/country/' . $image_name;
                Image::make($image)->resize(300, 200)->save($save_url);
                $countr->image = $save_url;
            }
            $countr->save();

            logKayit(['Ülke Yönetimi ', 'Firma düzenlendi']);
            Alert::success('Ülke Başarıyla Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Ülke Yönetimi ', 'Ülke düzenlemede hata', 0]);
            Alert::error('Ülke Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.country.list');
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Country::findOrFail($id);
            $data->delete();
            logKayit(['Ülke Yönetimi ', 'Firma silindi']);
            Alert::success('Ülke Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Ülke Yönetimi ', 'Ülke silmede hata', 0]);
            Alert::error('Ülke Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.country.list');
    }
}
