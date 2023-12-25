<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CooperationPage;
use App\Models\EnCooperationPage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class CooperationPageController extends Controller
{
    public function edit(){
        $data = CooperationPage::latest()->first();
        $data_en = EnCooperationPage::latest()->first();
        return view('backend.cooperationPage.edit',compact('data','data_en'));
    }

    public function update(Request $request){
        $data = CooperationPage::latest()->first();
        $data_en = EnCooperationPage::latest()->first();

        if ($data == null) {
            $data = new CooperationPage();
        }
        $data->title = $request->name_tr;
        $data->description = $request->description_tr;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/pages/' . $image_name;
            Image::make($image)->resize(1320,320)->save($save_url);
            $data->image = $save_url;
        }
        $data->save();

        if ($data_en == null) {
            $data_en = new EnCooperationPage();
        }
        
        $data_en->title = $request->name_en;
        $data_en->cooperation_id = $data->id;
        $data_en->description = $request->description_en;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/pages/' . $image_name;
            Image::make($image)->resize(1320,320)->save($save_url);
            $data_en->image = $save_url;
        }
        $data_en->save();
        Alert::success('İş Birliği Sayfası Başarıyla Düzenlendi');
        return redirect()->route('admin.cooperationPageEdit');
    }
}
