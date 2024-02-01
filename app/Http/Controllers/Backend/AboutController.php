<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\EnAbout;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class AboutController extends Controller
{
    public function add()
    {
        $data_tr = About::latest()->first();
        $data_en = EnAbout::latest()->first();
        return view('backend.about.add', compact('data_tr', 'data_en'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'activity_name_tr' => 'required',
                'tinymce_activity_detail_tr' => 'required',
                'activity_url_tr' => 'required',
                'activity_name_en' => 'required',
                'tinymce_activity_detail_en' => 'required',
                'activity_url_en' => 'required',
                'activity_seo_title_tr' => 'required',
                'activity_seo_description_tr' => 'required',
                'activity_seo_keywords_tr' => 'required',
                'activity_seo_title_en' => 'required',
                'activity_seo_description_en' => 'required',
                'activity_seo_keywords_en' => 'required',
            ],
            [
                'activity_name_tr' => 'Başlık (TÜRKÇE) boş bırakılamaz',
                'tinymce_activity_detail_tr' => 'İçerik (TÜRKÇE) boş bırakılamaz',
                'activity_url_tr' => 'Link (TÜRKÇE) boş bırakılamaz',
                'activity_name_en' => ' boş bırakılamaz',
                'tinymce_activity_detail_en' => 'İçerik (İNGİLİZCE) boş bırakılamaz',
                'activity_url_en' => 'Link (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_title_tr' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz',
                'activity_seo_description_tr' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz',
                'activity_seo_keywords_tr' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz',
                'activity_seo_title_en' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_description_en' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_keywords_en' => 'Seo anahtarı (İNGİLİZCE) boş bırakılamaz',
            ],
        );

        $data = About::latest()->first();
        if ($data == null) {
            $veri = json_decode(json_decode(json_encode($request->activity_seo_keywords_tr[0])));
            $merge = [];
            foreach ($veri as $v) {
                $merge[] = $v->value;
            }
            $merge = implode(',', $merge);

            $veri_en = json_decode(json_decode(json_encode($request->activity_seo_keywords_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }
            $merge_en = implode(',', $merge_en);

            $data = new About();
            $data->title = $request->activity_name_tr;
            $data->link = $request->activity_url_tr;
            $data->description = $request->tinymce_activity_detail_tr;
            $data->seo_title = $request->activity_seo_title_tr;
            $data->seo_description = $request->activity_seo_description_tr;
            $data->seo_key = $merge;
            if ($request->file('image1') != null) {
                $image = $request->file('image1');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 630)
                    ->save($save_url);
                $data->image1 = $save_url;
            }
            if ($request->file('image2') != null) {
                $image = $request->file('image2');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 555)
                    ->save($save_url);
                $data->image2 = $save_url;
            }
            if ($request->file('image3') != null) {
                $image = $request->file('image3');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 320)
                    ->save($save_url);
                $data->image3 = $save_url;
            }
            $data->save();

            $data_en = new EnAbout();
            $data_en->title = $request->activity_name_en;
            $data_en->link = $request->activity_url_en;
            $data_en->description = $request->tinymce_activity_detail_en;
            $data_en->seo_title = $request->activity_seo_title_en;
            $data_en->seo_description = $request->activity_seo_description_en;
            $data_en->seo_key = $merge_en;
            if ($request->file('image1') != null) {
                $image = $request->file('image1');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 630)
                    ->save($save_url);
                $data_en->image1 = $save_url;
            }
            if ($request->file('image2') != null) {
                $image = $request->file('image2');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 555)
                    ->save($save_url);
                $data_en->image2 = $save_url;
            }
            if ($request->file('image3') != null) {
                $image = $request->file('image3');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 320)
                    ->save($save_url);
                $data_en->image3 = $save_url;
            }
            $data_en->save();

            FacadesAlert::success('Hakkımızda Düzenlendi');
            return redirect()->route('admin.about.add');
        } else {
            $veri = json_decode(json_decode(json_encode($request->activity_seo_keywords_tr[0])));
            $merge = [];
            foreach ($veri as $v) {
                $merge[] = $v->value;
            }
            $merge = implode(',', $merge);

            $veri_en = json_decode(json_decode(json_encode($request->activity_seo_keywords_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }
            $merge_en = implode(',', $merge_en);

            $data = About::latest()->first();
            $data->title = $request->activity_name_tr;
            $data->link = $request->activity_url_tr;
            $data->description = $request->tinymce_activity_detail_tr;
            $data->seo_title = $request->activity_seo_title_tr;
            $data->seo_description = $request->activity_seo_description_tr;
            $data->seo_key = $merge;
            if ($request->file('image1') != null) {
                $image = $request->file('image1');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 630)
                    ->save($save_url);
                $data->image1 = $save_url;
            }
            if ($request->file('image2') != null) {
                $image = $request->file('image2');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 555)
                    ->save($save_url);
                $data->image2 = $save_url;
            }
            if ($request->file('image3') != null) {
                $image = $request->file('image3');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 320)
                    ->save($save_url);
                $data->image3 = $save_url;
            }
            $data->save();

            $data_en = EnAbout::latest()->first();

            $data_en->title = $request->activity_name_en;
            $data_en->link = $request->activity_url_en;
            $data_en->description = $request->tinymce_activity_detail_en;
            $data_en->seo_title = $request->activity_seo_title_en;
            $data_en->seo_description = $request->activity_seo_description_en;
            $data_en->seo_key = $merge_en;
            if ($request->file('image1') != null) {
                $image = $request->file('image1');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 630)
                    ->save($save_url);
                $data_en->image1 = $save_url;
            }
            if ($request->file('image2') != null) {
                $image = $request->file('image2');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 555)
                    ->save($save_url);
                $data_en->image2 = $save_url;
            }
            if ($request->file('image3') != null) {
                $image = $request->file('image3');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/about/' . $image_name;
                Image::make($image)
                    ->resize(551, 320)
                    ->save($save_url);
                $data_en->image3 = $save_url;
            }
            $data_en->save();
        }
        FacadesAlert::success('Hakkımızda Düzenlendi');
        return redirect()->route('admin.about.add');
    }

    public function uploadContentImage(Request $request)
    {
        if ($request->file('file') != null) {
            $image = $request->file('file');
            $image_name = hexdec(uniqid()) . '.'. $image->getClientOriginalExtension();
            $save_url = public_path('assets/uploads/about').'/'. $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
                
            $save_url = asset('assets/uploads/about').'/'. $image_name;
            return response()->json(['location' => $save_url]);
        }
    }
}
