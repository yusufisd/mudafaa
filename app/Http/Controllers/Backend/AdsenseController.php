<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdsenseModel;
use Illuminate\Http\Request;

class AdsenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = AdsenseModel::latest()->get();
        return view('backend.adsense.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.adsense.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    
    public function edit($id)
    {
        dd($id);
    }

   
    public function update(Request $request, $id)
    {
        dd($request->all());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        dd($id);
        
    }
}
