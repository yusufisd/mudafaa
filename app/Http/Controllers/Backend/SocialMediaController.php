<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GoogleNews;
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
        $google_news = GoogleNews::latest()->first();
        return view('backend.social.edit', compact('data','store','google_news'));
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

        if($request->google_news_link != null){
            $google_news = GoogleNews::latest()->first();
            if($google_news){
                $google_news->google_news_link = $request->google_news_link;
                $google_news->save();
            }else{
                $google_news = new GoogleNews();
                $google_news->google_news_link = $request->google_news_link;
                $google_news->save();
            }
        }else{
            $google_news = GoogleNews::latest()->first();
            if($google_news){
                $google_news->delete();
            }
        }

        Alert::success('Ayarlar Başarıyla Düzenlendi');
        return redirect()->back();
    }
}
