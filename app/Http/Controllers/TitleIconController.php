<?php

namespace App\Http\Controllers;

use App\Models\Title_Icon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TitleIconController extends Controller
{
    public function list(){
        $data = Title_Icon::latest()->get();
        return view('backend.companyModel.title_icon.list',compact('data'));
    }

    public function create(){
        return view('backend.companyModel.title_icon.add');
    }

    public function store(Request $request){
        $request->validate([
            "icon_tr" => "required",
            "title_tr" => "required",
            "icon_en" => "required",
            "title_en" => "required",
        ],[
            "icon_tr.required" => "İkon (TR) boş bırakılamaz",
            "title_tr.required" => "Başlık (TR) boş bırakılamaz",
            "icon_en.required" => "İkon (EN) boş bırakılamaz",
            "title_en.required" => "Başlık (EN) boş bırakılamaz",
        ]);

        $data = new Title_Icon();
        $data->title_tr = $request->title_tr;
        $data->icon_tr = $request->icon_tr;
        $data->title_en = $request->title_en;
        $data->icon_en = $request->icon_en;
        $data->save();

        Alert::success('İkon ve Başlık Eklendi');
        return redirect()->route('admin.titleIcon.list');
    }

    public function edit($id){
        $data = Title_Icon::findOrFail($id);
        return view('backend.companyModel.title_icon.edit',compact('data'));
    }

    public function update(Request $request,$id){
        $request->validate([
            "icon_tr" => "required",
            "title_tr" => "required",
            "icon_en" => "required",
            "title_en" => "required",
        ],[
            "icon_tr.required" => "İkon (TR) boş bırakılamaz",
            "title_tr.required" => "Başlık (TR) boş bırakılamaz",
            "icon_en.required" => "İkon (EN) boş bırakılamaz",
            "title_en.required" => "Başlık (EN) boş bırakılamaz",
        ]);

        $data = Title_Icon::find($id);
        $data->title_tr = $request->title_tr;
        $data->icon_tr = $request->icon_tr;
        $data->title_en = $request->title_en;
        $data->icon_en = $request->icon_en;
        $data->save();

        Alert::success('İkon ve Başlık Düzenlendi');
        return redirect()->route('admin.titleIcon.list');
    }

    public function destroy($id){
        $data = Title_Icon::findOrFail($id);
        $data->delete();

        Alert::success('İkon ve Başlık Silindi');
        return redirect()->route('admin.titleIcon.list');
    }
}

