<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SocialMediaController extends Controller
{
    public function list()
    {
        $data = SocialMedia::latest()->first();
        return view('backend.social.edit', compact('data'));
    }

    public function update(Request $request)
    {
        
        if (SocialMedia::latest()->first() != null) {
            $data = SocialMedia::latest()->first();
        } else {
            $data = new SocialMedia();
        }

        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->youtube = $request->youtube;
        $data->instagram = $request->instagram;
        $data->linkedin = $request->linkedin;
        $data->save();

        Alert::success('Ayarlar Başarıyla Düzenlendi');
        return redirect()->back();
    }
}
