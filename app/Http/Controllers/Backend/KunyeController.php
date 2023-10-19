<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EnKunye;
use App\Models\Kunye;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KunyeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = Kunye::latest()->get();
        return view('backend.kunye.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kunye.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title_tr" => "required",
            "title_en" => "required",
            "description_tr" => "required",
            "description_en" => "required",
        ],[
            "title_tr" => "Başlık (TR) boş bırakılamaz",
            "title_en" => "Başlık (EN) boş bırakılamaz",
            "description_tr" => "Açıklama (TR) boş bırakılamaz",
            "description_en" => "Açıklama (EN) boş bırakılamaz",
        ]);

        $data = new Kunye();
        $data->title = $request->title_tr;
        $data->description = $request->description_tr;
        $data->save();
        
        $data_en = new EnKunye();
        $data_en->title = $request->title_tr;
        $data_en->description = $request->description_tr;
        $data_en->save();

        Alert::success('İçerik başarıyla eklendi');
        return redirect()->route('admin.kunye.list');
    }

    
    public function edit($id)
    {
        $data = Kunye::findOrFail($id);
        $data_en = EnKunye::findOrFail($id);

        return view('backend.kunye.edit',compact('data','data_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title_tr" => "required",
            "title_en" => "required",
            "description_tr" => "required",
            "description_en" => "required",
        ],[
            "title_tr" => "Başlık (TR) boş bırakılamaz",
            "title_en" => "Başlık (EN) boş bırakılamaz",
            "description_tr" => "Açıklama (TR) boş bırakılamaz",
            "description_en" => "Açıklama (EN) boş bırakılamaz",
        ]);

        $data = Kunye::findOrFail($id);
        $data->title = $request->title_tr;
        $data->description = $request->description_tr;
        $data->save();
        
        $data_en = EnKunye::findOrFail($id);
        $data_en->title = $request->title_tr;
        $data_en->description = $request->description_tr;
        $data_en->save();

        Alert::success('İçerik başarıyla düzenlendi');
        return redirect()->route('admin.kunye.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kunye::findOrFail($id);
        $data_en = EnKunye::findOrFail($id);
        
        $data->delete();
        $data_en->delete();

        Alert::success('İçerik başarıyla silindi');
        return redirect()->route('admin.kunye.list');
    }
}
