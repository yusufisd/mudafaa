<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyAddress;
use App\Models\CompanyCategory;
use App\Models\CompanyImage;
use App\Models\CompanyModel;
use App\Models\CompanyTitle;
use App\Models\EnCompanyModel;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

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
        $new_company = new CompanyModel();
        $new_company->category = $request->category;
        $new_company->title = $request->title_tr;
        $new_company->description = $request->description_tr;
        $new_company->seo_title = $request->seo_title_tr;
        $new_company->seo_description = $request->seo_description_tr;
        $new_company->seo_key = $request->seo_key_tr;

        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/companyModel/' . $image_name;
            Image::make($image)
                ->resize(960, 520)
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
        $new_company_en->seo_key = $request->seo_key_en;
        
        if (!isset($request->status_en)) {
            $new_company_en->status = 0;
        }
        $new_company_en->save();


        for($i = 0; $i < count($request->address_title); $i++){
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

        for($i = 0; $i < count($request->company_icon); $i++){
            $new_title = new CompanyTitle();
            $new_title->title = $request->company_title[$i];
            $new_title->icon = $request->company_icon[$i];
            $new_title->description = $request->company_description[$i];
            $new_title->company_id = $new_company->id;
            $new_title->save();
        }
        

        for($i = 0; $i < count($request->gorseller_image); $i++){
            $new_image = new CompanyImage();
            if ($request->file('gorseller_image')[$i] != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/companyImage/' . $image_name;
                Image::make($image)->resize(960, 520)->save($save_url);
                $new_image->image = $save_url;
            }
            $new_image->queue = $request->gorseller_queue[$i];
            $new_image->company_id = $new_company->id;
            $new_image->save();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
