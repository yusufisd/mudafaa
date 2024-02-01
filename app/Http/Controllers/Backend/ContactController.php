<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use App\Models\EnContactModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class ContactController extends Controller
{
    public function edit()
    {
        if (ContactModel::latest()->first() != null) {
            $data = ContactModel::latest()->first();
        } else {
            $data = '';
        }
        if (EnContactModel::latest()->first() != null) {
            $data_en = EnContactModel::latest()->first();
        } else {
            $data_en = '';
        }
        return view('backend.contact.add', compact('data', 'data_en'));
    }

    public function update(Request $request)
    {
        if (ContactModel::latest()->first() != null) {
            $data = ContactModel::latest()->first();
        } else {
            $data = new ContactModel();
        }

        if (EnContactModel::latest()->first() != null) {
            $data_en = EnContactModel::latest()->first();
        } else {
            $data_en = new EnContactModel();
        }

        $data->title = $request->title_tr;
        $data->description = $request->description_tr;
        $data->phone = $request->phone_tr;
        $data->email = $request->email_tr;
        $data->website = $request->website_tr;
        $data->address = $request->address_tr;
        $data->map = $request->harita_tr;
        $data->save();

        $data_en->title = $request->title_en;
        $data_en->description = $request->description_en;
        $data_en->phone = $request->phone_en;
        $data_en->email = $request->email_en;
        $data_en->website = $request->website_en;
        $data_en->address = $request->address_en;
        $data_en->map = $request->harita_en;
        $data_en->save();

        Alert::success('İletişim Ayarları Düzenlendi');
        return redirect()->back();
    }

    public function uploadContentImage(Request $request)
    {
        if ($request->file('file') != null) {
            $image = $request->file('file');
            $image_name = hexdec(uniqid()) . '.'. $image->getClientOriginalExtension();
            $save_url = public_path('assets/uploads/contact').'/'. $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
                
            $save_url = asset('assets/uploads/contact').'/'. $image_name;
            return response()->json(['location' => $save_url]);
        }
    }
}
