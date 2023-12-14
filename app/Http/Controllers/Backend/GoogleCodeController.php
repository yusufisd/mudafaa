<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GoogleCode;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GoogleCodeController extends Controller
{
    public function edit()
    {
        $data = GoogleCode::latest()->first();
        return view('backend.google.edit',compact('data'));
    }

    public function update(Request $request)
    {
        $data = GoogleCode::latest()->first();
        if ($data == null) {
            $data = new GoogleCode();
        }
        $data->adsense = $request->adsense;
        $data->adverds = $request->adverds;
        $data->news = $request->news;
        $data->google_code = $request->google_code;
        $data->save();

        Alert::success('Başarılı');
        return back();
    }
}
