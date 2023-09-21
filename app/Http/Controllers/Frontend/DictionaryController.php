<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function index(){
        $data = Dictionary::latest()->get();
        return view('frontend.dictionary.list',compact('data'));
    }
}
