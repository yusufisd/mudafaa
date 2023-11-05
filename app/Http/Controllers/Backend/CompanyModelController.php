<?php

namespace App\Http\Controllers\Backend;

use App\Exports\CompanyExport;
use App\Http\Controllers\Controller;
use App\Models\CompanyAddress;
use App\Models\CompanyCategory;
use App\Models\CompanyImage;
use App\Models\CompanyModel;
use App\Models\CompanyTitle;
use App\Models\EnCompanyAddress;
use App\Models\EnCompanyModel;
use App\Models\EnCompanyTitle;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompanyImport;


class CompanyModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CompanyModel::latest()->get();
        return view('backend.companyModel.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CompanyCategory::latest()->get();
        return view('backend.companyModel.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'category' => 'required',
                'title_tr' => 'required',
                'description_tr' => 'required',
                'title_en' => 'required',
                'description_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_descriptipn_en' => 'required',
                'seo_key_en' => 'required',
                'company_icon' => 'required',
                'company_title' => 'required',
                'company_description' => 'required',
            ],
            [
                'category' => 'category required',
                'title_tr' => 'title_tr required',
                'description_tr' => 'description_tr required',
                'title_en' => 'title_en required',
                'description_en' => 'description_en required',
                'seo_title_tr' => 'seo_title_tr required',
                'seo_description_tr' => 'seo_description_tr required',
                'seo_key_tr' => 'seo_key_tr required',
                'seo_title_en' => 'seo_title_en required',
                'seo_descriptipn_en' => 'seo_descriptipn_en required',
                'seo_key_en' => 'seo_key_en required',
                'company_icon' => 'company_icon required',
                'company_title' => 'company_title required',
                'company_description' => 'company_description required',
            ],
        );

        $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
        $merge = [];
        foreach ($veri as $v) {
            $merge[] = $v->value;
        }
        $merge = implode(',', $merge);


        $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
        $merge_en = [];
        foreach ($veri_en as $v) {
            $merge_en[] = $v->value;
        }
        $merge_en = implode(',', $merge_en);


        $new_company = new CompanyModel();
        $new_company->category = $request->category;
        $new_company->title = $request->title_tr;
        $new_company->description = $request->description_tr;
        $new_company->seo_title = $request->seo_title_tr;
        $new_company->seo_description = $request->seo_description_tr;
        $new_company->seo_key = $merge;

        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/companyModel/' . $image_name;
            Image::make($image)
                ->resize(300, 300)
                ->save($save_url);
            $new_company->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $new_company->status = 0;
        }
        $new_company->save();

        $new_company_en = new EnCompanyModel();
        $new_company_en->title = $request->title_en;
        $new_company_en->description = $request->description_en;
        $new_company_en->company_id = $new_company->id;
        $new_company_en->seo_title = $request->seo_title_en;
        $new_company_en->seo_description = $request->seo_descriptipn_en;
        $new_company_en->seo_key = $merge_en;
        $new_company_en->category = $request->category;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/companyModel/' . $image_name;
            Image::make($image)
                ->resize(300, 300)
                ->save($save_url);
            $new_company_en->image = $save_url;
        }
        if (!isset($request->status_en)) {
            $new_company_en->status = 0;
        }
        $new_company_en->save();

        for ($i = 0; $i < count($request->address_title); $i++) {
            if($request->address_title[$i] == null ) continue;
            $new_adres = new CompanyAddress();
            $new_adres->title = $request->address_title[$i];
            $new_adres->address = $request->address_address[$i];
            $new_adres->phone = $request->address_phone[$i];
            $new_adres->email = $request->address_email[$i];
            $new_adres->map = $request->address_map[$i];
            $new_adres->website = $request->address_website[$i];
            $new_adres->company_id = $new_company->id;
            $new_adres->save();
        }

        for ($i = 0; $i < count($request->address_title_en); $i++) {
            if($request->address_title_en[$i] == null ) continue;
            $new_adres = new EnCompanyAddress();
            $new_adres->title = $request->address_title_en[$i];
            $new_adres->address = $request->address_address_en[$i];
            $new_adres->phone = $request->address_phone_en[$i];
            $new_adres->email = $request->address_email_en[$i];
            $new_adres->map = $request->address_map_en[$i];
            $new_adres->website = $request->address_website_en[$i];
            $new_adres->company_id = $new_company->id;
            $new_adres->save();
        }
        if ($request->company_icon[0] != null) {
            for ($i = 0; $i < count($request->company_icon); $i++) {
                $new_title = new CompanyTitle();
                $new_title->title = $request->company_title[$i];
                $new_title->icon = $request->company_icon[$i];
                $new_title->description = $request->company_description[$i];
                $new_title->company_id = $new_company->id;
                $new_title->save();
            }
        }
        if ($request->company_icon_en[0] != null) {
            for ($i = 0; $i < count($request->company_icon_en); $i++) {
                $new_title = new EnCompanyTitle();
                $new_title->title = $request->company_title[$i];
                $new_title->icon = $request->company_icon[$i];
                $new_title->description = $request->company_description[$i];
                $new_title->company_id = $new_company->id;
                $new_title->save();
            }
        }
        if ($request->gorseller_image != null) {
            for ($i = 0; $i < count($request->gorseller_image); $i++) {
                $new_image = new CompanyImage();
                if ($request->file('gorseller_image')[$i] != null) {
                    $image = $request->file('gorseller_image')[$i];
                    $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                    $save_url = 'assets/uploads/companyImage/' . $image_name;
                    Image::make($image)
                        ->resize(960, 520)
                        ->save($save_url);
                    $new_image->image = $save_url;
                }
                $new_image->queue = $request->gorseller_queue[$i];
                $new_image->company_id = $new_company->id;
                $new_image->save();
            }
        }
        Alert::success('Firma Başarıyla Eklendi');
        return redirect()->route('admin.companyModel.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = CompanyCategory::latest()->get();
        $adresler = CompanyAddress::where('company_id', $id)->get();
        $adresler_en = EnCompanyAddress::where('company_id', $id)->get();
        $basliklar = CompanyTitle::where('company_id', $id)->get();
        $basliklar_en = EnCompanyTitle::where('company_id', $id)->get();
        $gorseller = CompanyImage::where('company_id', $id)->get();
        $data_tr = CompanyModel::findOrFail($id);
        $data_en = EnCompanyModel::where('company_id', $id)->first();
        return view('backend.companyModel.edit', compact('categories', 'adresler', 'basliklar', 'gorseller', 'data_tr', 'data_en', 'basliklar_en', 'adresler_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'category' => 'required',
                'title_tr' => 'required',
                'description_tr' => 'required',
                'title_en' => 'required',
                'description_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_descriptipn_en' => 'required',
                'seo_key_en' => 'required',
                'company_icon' => 'required',
                'company_title' => 'required',
                'company_description' => 'required',
            ],
            [
                'category' => 'category required',
                'title_tr' => 'title_tr required',
                'description_tr' => 'description_tr required',
                'title_en' => 'title_en required',
                'description_en' => 'description_en required',
                'seo_title_tr' => 'seo_title_tr required',
                'seo_description_tr' => 'seo_description_tr required',
                'seo_key_tr' => 'seo_key_tr required',
                'seo_title_en' => 'seo_title_en required',
                'seo_descriptipn_en' => 'seo_descriptipn_en required',
                'seo_key_en' => 'seo_key_en required',
                'company_icon' => 'company_icon required',
                'company_title' => 'company_title required',
                'company_description' => 'company_description required',
            ],
        );

        $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
        $merge = [];
        foreach ($veri as $v) {
            $merge[] = $v->value;
        }
        $merge = implode(',', $merge);

        $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
        $merge_en = [];
        foreach ($veri_en as $v) {
            $merge_en[] = $v->value;
        }
        $merge_en = implode(',', $merge_en);


        $new_company = CompanyModel::findOrFail($id);
        $new_company->category = $request->category;
        $new_company->title = $request->title_tr;
        $new_company->description = $request->description_tr;
        $new_company->seo_title = $request->seo_title_tr;
        $new_company->seo_description = $request->seo_description_tr;
        $new_company->seo_key = $merge;

        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/companyModel/' . $image_name;
            Image::make($image)
                ->resize(300, 300)
                ->save($save_url);
            $new_company->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $new_company->status = 0;
        } else {
            $new_company->status = 1;
        }
        $new_company->save();

        $new_company_en = EnCompanyModel::where('company_id', $id)->first();
        $new_company_en->title = $request->title_en;
        $new_company_en->description = $request->description_en;
        $new_company_en->company_id = $new_company->id;
        $new_company_en->seo_title = $request->seo_title_en;
        $new_company_en->seo_description = $request->seo_descriptipn_en;
        $new_company_en->seo_key = $merge_en;
        $new_company_en->category = $request->category;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/companyModel/' . $image_name;
            Image::make($image)
                ->resize(300, 300)
                ->save($save_url);
            $new_company_en->image = $save_url;
        }
        if (!isset($request->status_en)) {
            $new_company_en->status = 0;
        } else {
            $new_company_en->status = 1;
        }
        $new_company_en->save();

        CompanyAddress::where('company_id', $new_company->id)->delete();
        EnCompanyAddress::where('company_id', $new_company->id)->delete();


        for ($i = 0; $i < count($request->address_title); $i++) {
            if($request->address_title[$i] == null ) continue;
            $new_adres = new CompanyAddress();
            $new_adres->title = $request->address_title[$i];
            $new_adres->address = $request->address_address[$i];
            $new_adres->phone = $request->address_phone[$i];
            $new_adres->email = $request->address_email[$i];
            $new_adres->map = $request->address_map[$i];
            $new_adres->website = $request->address_website[$i];
            $new_adres->company_id = $new_company->id;
            $new_adres->save();
        }

        for ($i = 0; $i < count($request->address_title_en); $i++) {
            if($request->address_title_en[$i] == null ) continue;
            $new_adres = new EnCompanyAddress();
            $new_adres->title = $request->address_title_en[$i];
            $new_adres->address = $request->address_address_en[$i];
            $new_adres->phone = $request->address_phone_en[$i];
            $new_adres->email = $request->address_email_en[$i];
            $new_adres->map = $request->address_map_en[$i];
            $new_adres->website = $request->address_website_en[$i];
            $new_adres->company_id = $new_company->id;
            $new_adres->save();
        }

        CompanyTitle::where('company_id', $id)->delete();
        for ($i = 0; $i < count($request->company_icon); $i++) {
            if ($request->company_title[$i] == null ) continue;
            $new_title = new CompanyTitle();
            $new_title->title = $request->company_title[$i];
            $new_title->icon = $request->company_icon[$i];
            $new_title->description = $request->company_description[$i];
            $new_title->company_id = $new_company->id;
            $new_title->save();
        }
        EnCompanyTitle::where('company_id', $id)->delete();
        for ($i = 0; $i < count($request->company_icon_en); $i++) {
            if ($request->company_title_en[$i] == null ) continue;
            $new_title = new EnCompanyTitle();
            $new_title->title = $request->company_title_en[$i];
            $new_title->icon = $request->company_icon_en[$i];
            $new_title->description = $request->company_description_en[$i];
            $new_title->company_id = $new_company->id;
            $new_title->save();
        }

        CompanyImage::where('company_id', $id)->whereNotIn('id', $request->image_id ?? [])->delete();
        if (isset($request->gorseller_image)) {
            for ($i = 0; $i < count($request->gorseller_image); $i++) {
                if ($request->gorseller_image[$i] == null) continue;
                $new_image = new CompanyImage();
                $image = $request->gorseller_image[$i];
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/companyImage/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new_image->image = $save_url;
                $new_image->queue = $request->gorseller_queue[$i];
                $new_image->company_id = $new_company->id;
                $new_image->save();
            }
        }

        if (isset($request->gorseller_queue) && count($request->gorseller_queue)){
            foreach ($request->gorseller_queue as $id => $queue) {
                CompanyImage::where('id', $id)->update([
                    "queue" => $queue
                ]);
            }
        }

        Alert::success('Firma Başarıyla Düzenlendi');
        return redirect()->route('admin.companyModel.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CompanyModel::where('id', $id)->delete();
        Alert::success('Firma Başarıyla Silindi');
        return redirect()->route('admin.companyModel.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = CompanyModel::findOrFail($id);
            $data->status = !$data->status;
            $data->save();

            logKayit(['Firma Yönetimi', 'Firma düzenlendi']);
            Alert::success('Firma Statüsü Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Firma Yönetimi', 'Firma durumu değiştirilemedi', 0]);
            Alert::error('Firma durum değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.companyModel.list');
    }

    public function ice_aktar(Request $request)
    {
        Excel::import(new CompanyImport(), $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }

    public function disa_aktar(){
        return Excel::download(new CompanyExport, 'company.xlsx');
    }
}
