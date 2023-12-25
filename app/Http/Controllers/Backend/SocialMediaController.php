<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MobileApp;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SocialMediaController extends Controller
{
    public function list()
    {
        $data = SocialMedia::latest()->first();
        $store = MobileApp::latest()->first();
        return view('backend.social.edit', compact('data','store'));
    }

    public function update(Request $request)
    {
        if (SocialMedia::latest()->first() != null) {
            $data = SocialMedia::latest()->first();
        } else {
            $data = new SocialMedia();
        }

        if(MobileApp::latest()->first() != null){
            $mobile_data = MobileApp::latest()->first();
        }else{
            $mobile_data = new MobileApp();
        }

        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->youtube = $request->youtube;
        $data->instagram = $request->instagram;
        $data->linkedin = $request->linkedin;
        $data->save();

        $mobile_data->google = $request->google_play_store;
        $mobile_data->ios = $request->app_store;
        $mobile_data->huawei = $request->huawei_store;
        $mobile_data->save();

        Alert::success('Ayarlar Başarıyla Düzenlendi');
        return redirect()->back();
    }
}
