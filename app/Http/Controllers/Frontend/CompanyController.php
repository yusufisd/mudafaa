<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\CompanyCategory;
use App\Models\CompanyImage;
use App\Models\CompanyModel;
use App\Models\CompanyTitle;
use App\Models\EnCompanyCategory;
use App\Models\EnCompanyModel;
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
        $id = explode('-', $id)[0];
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == 'tr') {
            $data = CompanyModel::findOrFail($id);
        } else {
            $data = EnCompanyModel::findOrFail($id);
        }
        $ekstra = CompanyTitle::where('company_id', $id)->get();
        $images = CompanyImage::where('company_id', $id)->get();
        $address = CompanyAddress::where('company_id', $id)->get();

        return view('frontend.company.detail', compact('data', 'ekstra', 'images', 'address'));
    }
}
