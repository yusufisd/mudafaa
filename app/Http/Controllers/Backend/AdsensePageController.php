<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdsensePage;
use App\Models\EnAdsensePage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class AdsensePageController extends Controller
{
    public function edit()
    {
        $data = AdsensePage::latest()->first();
        $data_en = EnAdsensePage::latest()->first();
        return view('backend.adsensePage.edit',compact('data','data_en'));
    }

    public function update(Request $request)
    {
        $data = AdsensePage::latest()->first();
        $data_en = EnAdsensePage::latest()->first();

        if ($data == null) {
            $data = new AdsensePage();
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
            $data_en = new EnAdsensePage();
        }
        $data_en->adsense_id = $data->id;
        $data_en->title = $request->name_en;
        $data_en->description = $request->description_en;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/pages/' . $image_name;
            Image::make($image)->resize(1320,320)->save($save_url);
            $data_en->image = $save_url;
        }
        $data_en->save();

        Alert::success('Reklam Sayfası Başarıyla Düzenlendi');
        return redirect()->route('admin.adsensePageEdit');
    }

    public function uploadContentImage(Request $request)
    {
        if ($request->file('file') != null) {
            $image = $request->file('file');
            $image_name = hexdec(uniqid()) . '.'. $image->getClientOriginalExtension();
            $save_url = public_path('assets/uploads/adsensePage').'/'. $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
                
            $save_url = asset('assets/uploads/adsensePage').'/'. $image_name;
            return response()->json(['location' => $save_url]);
        }
    }
}
