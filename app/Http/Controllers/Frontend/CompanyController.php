<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\CompanyModel;
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
        return view('frontend.company.detail',compact('data'));
    }
}
