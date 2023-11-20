<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\CompanyCategory;
use App\Models\CompanyImage;
use App\Models\CompanyModel;
use App\Models\CompanyTitle;
use App\Models\EnCompanyAddress;
use App\Models\EnCompanyCategory;
use App\Models\EnCompanyModel;
use App\Models\EnCompanyTitle;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == 'tr') {
            $data = CompanyModel::latest()->get();
            $categories = CompanyCategory::orderBy('queue', 'asc')->get();
        } else {
            $data = EnCompanyModel::latest()->get();
            $categories = EnCompanyCategory::orderBy('queue', 'asc')->get();
        }
        return view('frontend.company.list', compact('data', 'categories'));
    }

    public function detail($id)
    {
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == 'tr') {
            $data = CompanyModel::where('link',$id)->first();
            $ekstra = CompanyTitle::where('company_id', $data->id)->get();
            $images = CompanyImage::where('company_id', $data->id)->get();
            $address = CompanyAddress::where('company_id', $data->id)->get();
        } else {
            $data = EnCompanyModel::where('link',$id)->first();
            $ekstra = EnCompanyTitle::where('company_id', $data->id)->get();
            $images = CompanyImage::where('company_id', $data->id)->get();
            $address = EnCompanyAddress::where('company_id', $data->id)->get();
        }
        

        return view('frontend.company.detail', compact('data', 'ekstra', 'images', 'address'));
    }
}
