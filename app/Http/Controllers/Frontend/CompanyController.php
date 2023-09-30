<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\CompanyCategory;
use App\Models\CompanyImage;
use App\Models\CompanyModel;
use App\Models\CompanyTitle;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        $data = CompanyModel::latest()->get();
        $categories = CompanyCategory::latest()->get();
        return view('frontend.company.list',compact('data','categories'));
    }

    public function detail($id){
        $data = CompanyModel::findOrFail($id);
        $ekstra = CompanyTitle::where('company_id',$id)->get();
        $images = CompanyImage::where('company_id',$id)->get();
        $address = CompanyAddress::where('company_id',$id)->get();
        return view('frontend.company.detail',compact('data','ekstra','images','address'));
    }
}
